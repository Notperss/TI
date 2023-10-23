<?php

namespace App\Http\Controllers\Data\Hardware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// request
use App\Http\Controllers\Controller;
use App\Models\Data\Hardware\DevicePc;

// use library here
use App\Models\MasterData\Hardware\Ram;

// use model here
use Illuminate\Support\Facades\Storage;
use App\Models\Data\Hardware\DeviceMore;
use App\Models\Data\Hardware\DeviceMonitor;
use App\Models\MasterData\Hardware\Hardisk;
use App\Models\MasterData\Hardware\Monitor;
use App\Models\MasterData\Hardware\Processor;
use App\Models\Data\Hardware\DeviceAdditional;
use App\Models\MasterData\Hardware\TypeDevice;
use App\Models\MasterData\Hardware\Motherboard;
use App\Models\MasterData\Hardware\AdditionalDevice;
use App\Http\Requests\Data\Hardware\DevicePc\StoreDevicePcRequest;
use App\Http\Requests\Data\Hardware\DevicePc\UpdateDevicePcRequest;

class DevicePcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // device_pc
        $device_pc = DevicePc::with('ram', 'hardisk',)->latest()->get();
        //     $hardisk = {@foreach (explode(',', $device_pc_item->hardisk_id) as $data_hardisk)
        //     @php
        //         $spek_hardisk = DB::table('hardware_hardisk')
        //             ->where('id', $data_hardisk)
        //             ->get();
        //     @endphp
        //     @foreach ($spek_hardisk as $hardisk)
        //         {{ $hardisk->name }} - {{ $hardisk->size }} ||
        //     @endforeach
        // @endforeach};

        // $motherboard = Motherboard::latest()->get();
        // $processor = Processor::latest()->get();
        // $ram = Ram::latest()->get();
        // $hardisk = Hardisk::latest()->get();





        // device_monitor
        // $device_monitor = DeviceMonitor::orderby('created_at', 'desc')->get();
        // $monitor = Monitor::orderby('name', 'asc')->get();

        // device_additional
        // $device_additional = DeviceAdditional::orderby('created_at', 'desc')->get();
        // $additional = AdditionalDevice::orderby('name', 'asc')->get();
        // // create no_non_asset
        // $q = DB::table('device_additional')->select(DB::raw('MAX(RIGHT(no_non_asset, 6)) as kode'));
        // $kd = "";
        // if ($q->count() > 0) {
        //     foreach ($q->get() as $k) {
        //         $tmp = ((int)$k->kode) + 1;
        //         $kd = sprintf("%06s", $tmp);
        //     }
        // } else {
        //     $kd = "000001";
        // }

        // device_mmore
        // $device_more = DeviceMore::orderby('created_at', 'desc')->get();
        // $type_device = TypeDevice::orderby('name', 'asc')->get();
        // dd($device_pc);
        // return view('pages.data.hardware.device-pc.index', compact('device_pc', 'motherboard', 'processor', 'ram', 'hardisk', 'device_monitor', 'monitor', 'device_additional', 'additional', 'kd', 'device_more', 'type_device'));
        return view('pages.data.hardware.device-pc.index', compact('device_pc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        // device_pc
        $device_pc = DevicePc::orderby('created_at', 'desc')->get();
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();

        // device_monitor
        $device_monitor = DeviceMonitor::orderby('created_at', 'desc')->get();
        $monitor = Monitor::orderby('name', 'asc')->get();

        // device_additional
        $device_additional = DeviceAdditional::orderby('created_at', 'desc')->get();
        $additional = AdditionalDevice::orderby('name', 'asc')->get();
        // create no_non_asset
        $q = DB::table('device_additional')->select(DB::raw('MAX(RIGHT(no_non_asset, 6)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }

        // device_mmore
        $device_more = DeviceMore::orderby('created_at', 'desc')->get();
        $type_device = TypeDevice::orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-pc.create', compact('device_pc', 'motherboard', 'processor', 'ram', 'hardisk', 'device_monitor', 'monitor', 'device_additional', 'additional', 'kd', 'device_more', 'type_device'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDevicePcRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('storage/app/assets/file-device-pc');
        }

        // process implode
        $data['hardisk_id'] = implode(',', $request['hardisk_id']);
        $data['ram_id'] = implode(',', $request['ram_id']);

        // store to database
        $device_pc = DevicePc::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.device_pc.index');
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
        $device_pc = DevicePc::find($decrypt_id);

        return view('pages.data.hardware.device-pc.show', compact('device_pc'));
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
        $device_pc = DevicePc::find($decrypt_id);

        // device_pc
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-pc.edit', compact('device_pc', 'motherboard', 'processor', 'ram', 'hardisk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevicePcRequest $request, DevicePc $device_pc)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $device_pc['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('storage/app/assets/file-device-pc', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // process implode
        $data['hardisk_id'] = implode(',', $request['hardisk_id']);
        $data['ram_id'] = implode(',', $request['ram_id']);

        // update to database
        $device_pc->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.device_pc.index');
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
        $device_pc = DevicePc::find($decrypt_id);

        // cari old photo
        $path_file = $device_pc['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $device_pc->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
