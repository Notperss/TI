<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\PP;
use App\Models\Adm\Pp_file;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\PP\StorePPRequest;
use App\Http\Requests\Adm\PP\UpdatePPRequest;

class PPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $pp = PP::orderby('created_at', 'desc');

            return DataTables::of($pp)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.pp.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data PP" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.pp.edit', $item->id) . '">
                        Edit
                     </a>
                    <a class="dropdown-item" href="' . route('backsite.bill.create_bill', $item->id) . '">
                        Tambah tagihan
                     </a>
                    <form action="' . route('backsite.pp.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }
        return view("pages.adm.pp.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.adm.pp.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\StorePPRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePPRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $pp = PP::create($data);
        $pp_id = $pp->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.pp.edit', $pp_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        return view('pages.adm.pp.show', compact('pp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pp = PP::find($id);
        $datafile = Pp_file::where('pp_id', $id)->get();
        return view('pages.adm.pp.edit', compact('pp', 'datafile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\UpdatePPRequest  $request
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePPRequest $request, PP $pp)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $pp->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.pp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        $pp->forceDelete();

        $pp_file = Pp_file::where('pp_id', $decrypt_id)->get();
        // hapus file
        foreach ($pp_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }

        }
        $pp_file = Pp_file::where('pp_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = PP::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.pp.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-pp', $image->getClientOriginalName());
                Pp_file::create([
                    'pp_id' => $request->id,
                    'name_file' => $request->name_file,
                    'type_file' => $request->type_file,
                    'description_file' => $request->description_file,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.pp.edit', $pp);
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_file = Pp_file::where('pp_id', $id)->get();
            $data = [
                'datafile' => $pp_file,
            ];

            $msg = [
                'data' => view('pages.adm.pp.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $pp_file = Pp_file::find($id);

        // cari old photo
        $path_file = $pp_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $pp_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
