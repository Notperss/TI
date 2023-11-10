<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Adm\LendingFacility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\LendingFacility\StoreLendingFacilityRequest;
use App\Http\Requests\Adm\LendingFacility\UpdateLendingFacilityRequest;

class LendingFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $lendingfacility = LendingFacility::orderby('created_at', 'desc');

            return DataTables::of($lendingfacility)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.lendingfacility.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.lendingfacility.edit', $item->id) . '">
                        Edit
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.bill.create_bill', $item->id) . '">
                        Tambah tagihan
                    </a>
                    <form action="' . route('backsite.lendingfacility.destroy', encrypt($item->id)) . '" method="POST"
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
        return view("pages.adm.lendingfacility.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.adm.lendingfacility.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\LendingFacility\StoreLendingFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLendingFacilityRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $lendingfacility = LendingFacility::create($data);
        $lendingfacility_id = $lendingfacility->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.lendingfacility.edit', $lendingfacility_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $lendingfacility = LendingFacility::find($decrypt_id);

        return view('pages.adm.lendingfacility.show', compact('lendingfacility'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lendingfacility = LendingFacility::find($id);
        $datafile = LendingFacility_file::where('lendingfacility_id', $id)->get();
        return view('pages.adm.lendingfacility.edit', compact('lendingfacility', 'datafile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\LendingFacility\UpdateLendingFacilityRequest  $request
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLendingFacilityRequest $request, LendingFacility $lendingfacility)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $lendingfacility->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.lendingfacility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $lendingfacility = LendingFacility::find($decrypt_id);

        $lendingfacility->forceDelete();

        $lendingfacility_file = LendingFacility_file::where('lendingfacility_id', $decrypt_id)->get();
        // hapus file
        foreach ($lendingfacility_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }

        }
        $lendingfacility_file = LendingFacility_file::where('lendingfacility_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = LendingFacility::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.lendingfacility.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        $lendingfacility = LendingFacility::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-lendingfacility', $fullname);
                LendingFacility_file::create([
                    'lendingfacility_id' => $request->id,
                    'name_file' => $request->name_file,
                    'type_file' => $request->type_file,
                    'description_file' => $request->description_file,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.lendingfacility.edit', $lendingfacility);
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $lendingfacility_file = LendingFacility_file::where('lendingfacility_id', $id)->get();
            $data = [
                'datafile' => $lendingfacility_file,
            ];

            $msg = [
                'data' => view('pages.adm.lendingfacility.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $lendingfacility_file = LendingFacility_file::find($id);

        // cari old photo
        $path_file = $lendingfacility_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $lendingfacility_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
