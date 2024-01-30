<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Maintenance;
use App\Http\Requests\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Maintenance\StoreMaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceRequest $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Maintenance\UpdateMaintenanceRequest  $request
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        abort(403);
    }

    public function detailBarang($id)
    {
        // $id = $request->id;
        // $decrypt_id = decrypt($id);
        $barang = Barang::findOrFail($id);
        // if ($barang) {
        //     // Perform actions based on the selected asset, such as refreshing the page
        //     // For demonstration purposes, let's assume you want to display the selected asset's details
        //    return response()->json(['redirectUrl' => route('detailBarang', ['id' => $barang->id])]); // Adjust with your desired route
        // } else {
        //     // Handle the case where the asset with the provided ID is not found
        //     abort(404);
        // }
        $assets = Barang::orderBy('created_at', 'asc')->get();
        return view('pages.maintenance.maintenance.detail-barang', compact('barang', 'assets'));
    }

    public function updatePage($assetId)
    {
        // Retrieve the asset based on the provided ID
        $selectedAsset = Barang::find($assetId);

        if ($selectedAsset) {
            // Perform actions based on the selected asset, such as refreshing the page
            // For demonstration purposes, let's assume you want to display the selected asset's details
            return view('de', compact('selectedAsset'));
        } else {
            // Handle the case where the asset with the provided ID is not found
            abort(404);
        }
    }
}
