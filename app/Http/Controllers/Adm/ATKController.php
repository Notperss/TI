<?php

namespace App\Http\Controllers\Adm;

use App\Models\Adm\ATK;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
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
    public function index()
    {
        if (request()->ajax()) {

            $atk = ATK::orderby('created_at', 'desc');

            return DataTables::of($atk)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.atk.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data ATK" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.atk.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.atk.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->editColumn('file', function ($item) {
                    if ($item->file) {
                        return '<a type="button" data-fancybox
                                data-src="' . asset('storage/' . $item->file) . '"
                                class="btn btn-info btn-sm text-white ">
                                Lihat
                            </a>
                            <a type="button" href="' . asset('storage/' . $item->file) . '"
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
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
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
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
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
}
