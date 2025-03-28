<?php

namespace App\Http\Controllers\Adm;

use App\Models\Adm\ATK;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\ATK\StoreATKRequest;
use App\Http\Requests\Adm\ATK\UpdateATKRequest;

class ATKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $atk = ATK::orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $atk = $atk->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($atk)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
            <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.atk.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data ATK" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.atk.edit', encrypt($item->id)).'" 
                    '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                        Edit</a>
                    <form action="'.route('backsite.atk.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete" '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
            </div>
            </div>
             <form action="'.route('backsite.atk.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="
                    '.($item->stats == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'
                    ">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-sm btn-'.($item->stats == 1 ? 'success' : 'danger').' w-100" value="'.($item->stats == 1 ? 'Close' : 'Open').'"
                        '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
                ';
                })
                ->editColumn('file', function ($item) {
                    if ($item->file) {
                        return '<a type="button" data-fancybox
                                data-src="'.asset('storage/'.$item->file).'"
                                class="btn btn-info btn-sm text-white ">
                                Lihat
                            </a>
                            <a type="button" href="'.asset('storage/'.$item->file).'"
                                    class="btn btn-primary btn-sm" download>
                                    Unduh  
                            </a>
                                ';
                    } else {
                        return '
                            <span>File Not Found!</span>
                                ';
                    }
                })
                ->editColumn('date', function ($item) {
                    return Carbon::parse($item->date)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action', 'date', 'file'])
                ->toJson();
        }

        return view('pages.adm.atk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.adm.atk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\ATK\StoreATKRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreATKRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-atk', $fullname);
        }
        // store to database
        ATK::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.atk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\ATK  $atk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $atk = ATK::find($decrypt_id);


        return view('pages.adm.atk.show', compact('atk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\ATK  $atk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $atk = ATK::find($decrypt_id);
        return view('pages.adm.atk.edit', compact('atk', ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\ATK\UpdateATKRequest  $request
     * @param  \App\Models\Adm\ATK  $atk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateATKRequest $request, ATK $atk)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $atk['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-atk', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $atk->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.atk.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Adm\ATK  $atk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $atk = ATK::find($decrypt_id);

        // cari old photo
        $path_file = $atk['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $atk->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $atk = ATK::find($decrypt_id);
        if ($atk->stats == 1) {
            $atk->update(['stats' => 2]);
        } elseif ($atk->stats == 2) {
            $atk->update(['stats' => 1]);
        } else {
            alert()->error('Error', 'Data gagal diubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil diubah');
        return back();
    }
}
