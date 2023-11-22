<?php

namespace App\Http\Controllers\SystemInformation\TPT;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SystemInformation\TPT\TPT;
use App\Http\Requests\SystemInformation\TPT\StoreTPTRequest;
use App\Http\Requests\SystemInformation\TPT\UpdateTPTRequest;

class TPTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $tpt = TPT::orderby('created_at', 'desc');

            return DataTables::of($tpt)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.tpt.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Surat" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.tpt.edit', $item->id) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.tpt.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('file', function ($item) {
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
                            <span>File not found</span>
                                ';
                }
            })
                ->rawColumns(['action', 'file'])
                ->toJson();
        }
        return view("pages.system-information.tpt.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.system-information.tpt.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTPTRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-tpt', $fullname);
        }

        // store to database
        TPT::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.tpt.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SystemInformation\TPT\TPT  $tpt
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $tpt = TPT::find($decrypt_id);

        return view('pages.system-information.tpt.show', compact('tpt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\TPT\TPT  $tpt
     * @return \Illuminate\Http\Response
     */
    public function edit(TPT $tpt)
    {
        $tpt = TPT::findOrFail($tpt->id);
        return view('pages.system-information.tpt.edit', compact('tpt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemInformation\TPT\TPT  $tpt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTPTRequest $request, TPT $tpt)
    {
        // get all request from frontsite
        $data = $request->all();

        $path_file = $tpt['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-tpt', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $tpt->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.tpt.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\TPT\TPT  $tpt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $tpt = TPT::find($decrypt_id);

        // hapus location
        $tpt->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
