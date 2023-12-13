<?php

namespace App\Http\Controllers\MasterData;

use App\Models\VendorTi;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorTiRequest;
use App\Http\Requests\UpdateVendorTiRequest;

class VendorTiController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(request()->ajax()) {

            $vendorti = VendorTi::orderBy('created_at', 'desc')->get();

            return DataTables::of($vendorti)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.vendor_ti.edit', encrypt($item->id)).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.vendor_ti.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }

        return view('pages.master-data.vendorti.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.master-data.vendorti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorTiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorTiRequest $request) {
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
    public function show(VendorTi $vendorTi) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorTi  $vendorTi
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
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
    public function update(UpdateVendorTiRequest $request, VendorTi $vendorTi) {
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
    public function destroy($id) {
        $decrypt_id = decrypt($id);
        $vendorti = VendorTi::find($decrypt_id);

        // hapus vendorti
        $vendorti->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
