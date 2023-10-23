<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Data\DeviceHardware\StoreDeviceHardwareRequest;
use App\Http\Requests\Data\DeviceHardware\UpdateDeviceHardwareRequest;

// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\Data\Hardware\Device;
use App\Models\Data\Hardware\DeviceAdditionalDevice;
use App\Models\Data\Hardware\DeviceMonitor;
use App\Models\Data\Hardware\DeviceSpesificationPc;
use App\Models\MasterData\Hardware\AdditionalDevice;
use App\Models\MasterData\Hardware\Hardisk;
use App\Models\MasterData\Hardware\Monitor;
use App\Models\MasterData\Hardware\Motherboard;
use App\Models\MasterData\Hardware\Processor;
use App\Models\MasterData\Hardware\Ram;
use App\Models\MasterData\Hardware\TypeDevice;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device_hardware = Device::orderby('created_at', 'desc')->get();
        $type_device = TypeDevice::orderby('name', 'asc')->get();
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();
        $monitor = Monitor::orderby('name', 'asc')->get();
        $data_monitor = Monitor::orderby('name', 'asc')->get()->toJson();
        $additional_device = AdditionalDevice::orderby('name', 'asc')->get();
        $data_additional_device =  AdditionalDevice::orderby('name', 'asc')->get()->toJson();

        return view('pages.data.device_hardware.index', compact('device_hardware', 'type_device', 'motherboard', 'processor', 'ram', 'hardisk', 'monitor', 'data_monitor', 'additional_device', 'data_additional_device'));
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
    public function store(StoreDeviceHardwareRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-hardware', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_hardware = Device::create($data);

        // save to spesification_pc, set to your device_hardware
        if ($request->motherboard_id) {
            $spesification_pc = new DeviceSpesificationPc;

            $spesification_pc->device_id = $device_hardware['id'];
            $spesification_pc->motherboard_id = $request['motherboard_id'];
            $spesification_pc->processor_id = $request['processor_id'];
            $spesification_pc->hardisk_id = implode(',', $request['hardisk_id']);
            $spesification_pc->ram_id = implode(',', $request['ram_id']);
            $spesification_pc->save();
        }

        // save to device_monitor
        if ($request->monitor_id) {
            foreach ($request->monitor_id  as $key => $monitor) {
                $data_monitor = [
                    'device_id' =>  $device_hardware['id'],
                    'monitor_id' => $monitor,
                    'asset_monitor' => $request->asset_monitor[$key]
                ];
                DeviceMonitor::create($data_monitor);
            }
        }

        // save to device_additional_device
        if ($request->additional_device_id) {
            foreach ($request->additional_device_id as $key => $additional_device) {
                $data_additional = [
                    'device_id' =>  $device_hardware['id'],
                    'additional_device_id' => $additional_device,
                    'asset_additional_device' => $request->asset_additional_device[$key]
                ];
                DeviceAdditionalDevice::create($data_additional);
            }
        }

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
        // deskripsi id
        $decrypt_id = decrypt($id);
        $device_hardware = Device::find($decrypt_id);

        $device_spesification_pc = DeviceSpesificationPc::where('device_id', $device_hardware['id'])->get();
        $device_monitor = DeviceMonitor::where('device_id', $device_hardware['id'])->get();
        $device_additional = DeviceAdditionalDevice::where('device_id', $device_hardware['id'])->get();

        return view('pages.data.device_hardware.show', compact('device_hardware', 'device_spesification_pc', 'device_monitor', 'device_additional'));
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
        $device_hardware = Device::find($decrypt_id);

        $type_device = TypeDevice::orderby('name', 'asc')->get();
        $device_spesification_pc = DeviceSpesificationPc::where('device_id', $device_hardware['id'])->first();
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();
        $device_monitor = DeviceMonitor::where('device_id', $device_hardware['id'])->get();
        $monitor = Monitor::orderby('name', 'asc')->get();
        $data_monitor = Monitor::orderby('name', 'asc')->get()->toJson();
        $device_additional = DeviceAdditionalDevice::where('device_id', $device_hardware['id'])->get();
        $additional_device = AdditionalDevice::orderby('name', 'asc')->get();
        $data_additional_device =  AdditionalDevice::orderby('name', 'asc')->get()->toJson();

        return view('pages.data.device_hardware.edit', compact('device_hardware', 'type_device', 'device_spesification_pc', 'motherboard', 'processor', 'ram', 'hardisk', 'device_monitor', 'monitor', 'data_monitor', 'device_additional', 'additional_device', 'data_additional_device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceHardwareRequest $request, $id)
    {
        // get all request from frontsite
        $data = $request->all();

        $device = Device::find($id);

        // cari old photo
        $path_file = $device['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-hardware', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $device->update($data);

        // save to spesification_pc, set to your device_hardware
        if ($request->motherboard_id) {
            // save to detail user , to set type user
            $spesification_pc = DeviceSpesificationPc::where('device_id', $id)->first();
            $spesification_pc->motherboard_id = $request['motherboard_id'];
            $spesification_pc->processor_id = $request['processor_id'];
            $spesification_pc->hardisk_id = implode(',', $request['hardisk_id']);
            $spesification_pc->ram_id = implode(',', $request['ram_id']);
            $spesification_pc->save();
        }

        // save to device_monitor
        if ($request->monitor_id) {
            foreach ($request->monitor_id  as $key => $monitor) {
                $data_monitor = [
                    'device_id' =>  $id,
                    'monitor_id' => $monitor,
                    'asset_monitor' => $request->asset_monitor[$key]
                ];
                DeviceMonitor::create($data_monitor);
            }
        }

        // save to device_additional_device
        if ($request->additional_device_id) {
            foreach ($request->additional_device_id as $key => $additional_device) {
                $data_additional = [
                    'device_id' =>  $id,
                    'additional_device_id' => $additional_device,
                    'asset_additional_device' => $request->asset_additional_device[$key]
                ];
                DeviceAdditionalDevice::create($data_additional);
            }
        }

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
        $device_hardware = Device::find($decrypt_id);

        // cari old photo
        $path_file = $device_hardware['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus device_hardware
        $device_hardware->forceDelete();

        // delete data device_spesification_pc
        $device_spesification_pc = DeviceSpesificationPc::where('device_id', $decrypt_id)->forceDelete();
        // delete data device_monitor
        $device_monitor = DeviceMonitor::where('device_id', $decrypt_id)->forceDelete();
        // delete data device_additional
        $device_additional = DeviceAdditionalDevice::where('device_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // hapus monitor
    public function hapus_monitor(Request $request)
    {
        $monitor = DeviceMonitor::find($request->id);

        $monitor->forceDelete();

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];

        return response()->json($msg);
    }

    // hapus additional_device
    public function hapus_additional(Request $request)
    {
        $additional_device = DeviceAdditionalDevice::find($request->id);

        $additional_device->forceDelete();

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];

        return response()->json($msg);
    }
}
