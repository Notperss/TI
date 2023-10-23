<?php

namespace App\Http\Controllers\MasterData;

use App\Models\VendorTi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorTiRequest;
use App\Http\Requests\UpdateVendorTiRequest;

class VendorTiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorti = VendorTi::orderBy('created_at', 'desc')->get();
        return view('pages.master-data.vendorti.index', compact('vendorti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.vendorti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorTiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorTiRequest $request)
    {
        $data = $request->all();

        VendorTi::create($data);
        $vendorti = VendorTi::OrderBy('created_at', 'desc')->get();
        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.vendor_ti.index', compact('vendorti'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorTi  $vendorTi
     * @return \Illuminate\Http\Response
     */
    public function show(VendorTi $vendorTi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorTi  $vendorTi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $vendorti = vendorti::find($decrypt_id);
        return view('pages.master-data.vendorti.edit', compact('vendorti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorTiRequest  $request
     * @param  \App\Models\VendorTi  $vendorTi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorTiRequest $request, VendorTi $vendorTi)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $vendorTi->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.vendor_ti.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorTi  $vendorTi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decrypt_id = decrypt($id);
        $vendorti = VendorTi::find($decrypt_id);

        // hapus vendorti
        $vendorti->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
