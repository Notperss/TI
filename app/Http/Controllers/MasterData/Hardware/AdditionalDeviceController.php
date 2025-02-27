<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\AdditionalDevice\StoreAdditionalDeviceRequest;
use App\Http\Requests\MasterData\Hardware\AdditionalDevice\UpdateAdditionalDeviceRequest;

// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\MasterData\Hardware\AdditionalDevice;

class AdditionalDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additional_device = AdditionalDevice::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.additional_device.index', compact('additional_device'));
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
    public function store(StoreAdditionalDeviceRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-additional-device', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $additional_device = AdditionalDevice::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.additional_device.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
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
        $additional_device = AdditionalDevice::find($decrypt_id);

        return view('pages.master-data.hardware.additional_device.edit', compact('additional_device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdditionalDeviceRequest $request, AdditionalDevice $additional_device)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $additional_device['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-additional-device', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $additional_device->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.additional_device.index');
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
        $additional_device = AdditionalDevice::find($decrypt_id);

        // cari old photo
        $path_file = $additional_device['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $additional_device->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
