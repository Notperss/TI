<?php

namespace App\Http\Controllers\MasterData\Network;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request 
use App\Http\Requests\MasterData\Network\StoreCctvRequest;
use App\Http\Requests\MasterData\Network\UpdateCctvRequest;

// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\MasterData\Network\Cctv;

class CctvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cctv = Cctv::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.network.cctv.index', compact('cctv'));
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
    public function store(StoreCctvRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();
        $name = $request->name;

        // upload process here
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->storeAs('assets/logo-marker', $name . '-' . $request->file('logo')->getClientOriginalName());
        }

        // store to database
        $cctv = Cctv::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.cctv.index');
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
        $cctv = Cctv::find($decrypt_id);

        return view('pages.master-data.network.cctv.show', compact('cctv'));
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
        $cctv = Cctv::find($decrypt_id);

        return view('pages.master-data.network.cctv.edit', compact('cctv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCctvRequest $request, Cctv $cctv)
    {
        // get all request from frontsite
        $data = $request->all();
        $name = $request->name;

        // cari old photo
        $path_file = $cctv['logo'];

        // upload process here
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->storeAs('assets/logo-marker', $name . '-' . $request->file('logo')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['logo'] = $path_file;
        }

        // update to database
        $cctv->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.cctv.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decrypt_id = decrypt($id);
        $cctv = Cctv::find($decrypt_id);

        // cari old photo
        $path_file = $cctv['logo'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $cctv->forceDelete();

        alert()->success('Sukses', 'Data Berhasil dihapus');
        return back();
    }
}
