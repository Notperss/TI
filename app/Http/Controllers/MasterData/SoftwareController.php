<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Software\StoreSoftwareRequest;
use App\Http\Requests\MasterData\Software\UpdateSoftwareRequest;

// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\MasterData\Software\Software;
use App\Models\MasterData\Software\SoftwareFile;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $software = Software::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.software.index', compact('software'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoftwareRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $software = Software::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.software.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $software = Software::find($decrypt_id);

        return view('pages.master-data.software.show', compact('software'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $software = Software::find($decrypt_id);

        return view('pages.master-data.software.edit', compact('software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $software->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.software.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $software = Software::find($decrypt_id);

        // hapus software
        $software->forceDelete();

        // get file software
        $software_file = SoftwareFile::where('software_id', $decrypt_id)->get();
        // hapus file
        foreach ($software_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }
        }

        // delete data file software
        $software_file = SoftwareFile::where('software_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload software
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Software::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.master-data.software.upload_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // upload file
    public function upload(Request $request)
    {
        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-software', $image->getClientOriginalName());
                SoftwareFile::create([
                    'software_id' => $request->id,
                    'file'        => $file
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.software.index');
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $software_file = SoftwareFile::where('software_id', $id)->get();
            $data = [
                'datafile' => $software_file
            ];

            $msg = [
                'data' => view('pages.master-data.software.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // hapus file software
    public function hapus_file($id)
    {
        $software_file = SoftwareFile::find($id);

        // cari old photo
        $path_file = $software_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $software_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
