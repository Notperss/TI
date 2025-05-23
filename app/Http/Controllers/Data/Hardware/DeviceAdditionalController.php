<?php

namespace App\Http\Controllers\Data\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Data\Hardware\DeviceAdditional\StoreDeviceAdditionalRequest;
use App\Http\Requests\Data\Hardware\DeviceAdditional\UpdateDeviceAdditionalRequest;

// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\Data\Hardware\DeviceAdditional;
use App\Models\MasterData\Hardware\AdditionalDevice;

class DeviceAdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
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
    public function store(StoreDeviceAdditionalRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-additional', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_additional = DeviceAdditional::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.device_hardware.index');
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
        $device_additional = DeviceAdditional::find($decrypt_id);

        // device_monitor
        $additional = AdditionalDevice::orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-additional.edit', compact('device_additional', 'additional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceAdditionalRequest $request, DeviceAdditional $device_additional)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $device_additional['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-additional', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }
        // update to database
        $device_additional->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.device_hardware.index');
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
        $device_additional = DeviceAdditional::find($decrypt_id);

        // cari old photo
        $path_file = $device_additional['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $device_additional->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
