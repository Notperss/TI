<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\Monitor\StoreMonitorRequest;
use App\Http\Requests\MasterData\Hardware\Monitor\UpdateMonitorRequest;

// use model here
use App\Models\MasterData\Hardware\Monitor;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitor = Monitor::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.monitor.index', compact('monitor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.hardware.monitor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonitorRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $monitor = Monitor::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.monitor.index');
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
        $monitor = Monitor::find($decrypt_id);

        return view('pages.master-data.hardware.monitor.edit', compact('monitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMonitorRequest $request, Monitor $monitor)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $monitor->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.monitor.index');
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
        $monitor = Monitor::find($decrypt_id);

        // hapus location
        $monitor->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
