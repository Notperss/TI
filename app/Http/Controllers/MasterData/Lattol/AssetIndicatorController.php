<?php

namespace App\Http\Controllers\MasterData\Lattol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Lattol\AssetIndicator;
use App\Models\MasterData\Lattol\TypeAsset;

class AssetIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $assetIndicator = AssetIndicator::with('typeAsset')->orderBy('type_asset_id', 'desc')->latest();

            return DataTables::of($assetIndicator)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.asset-indicator.edit', $item->id).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.asset-indicator.destroy', $item->id).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->addColumn('typeAsset.name', function ($item) {
                    return $item->typeAsset ? $item->typeAsset->name : 'N/A'; // Jika null, tampilkan "N/A"
                })
                ->rawColumns(['action',])
                ->toJson();
        }
        return view('pages.master-data.lattol.asset-indicator.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeAssets = TypeAsset::all();
        return view('pages.master-data.lattol.asset-indicator.create', compact('typeAssets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'type_asset_id' => ['required', 'exists:type_assets,id'], // Pastikan ID aset valid
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'type_asset_id.required' => 'Peralatan wajib diisi.',
            'type_asset_id.exists' => 'Peralatan yang dipilih tidak valid.',
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        AssetIndicator::create($validatedData);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.asset-indicator.index', );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Lattol\AssetIndicator  $assetIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(AssetIndicator $assetIndicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Lattol\AssetIndicator  $assetIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetIndicator $assetIndicator)
    {
        $typeAssets = TypeAsset::all();
        return view('pages.master-data.lattol.asset-indicator.edit', compact('typeAssets', 'assetIndicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Lattol\AssetIndicator  $assetIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetIndicator $assetIndicator)
    {
        $validatedData = $request->validate([
            'type_asset_id' => ['required', 'exists:type_assets,id'], // Pastikan ID aset valid
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'type_asset_id.required' => 'Peralatan wajib diisi.',
            'type_asset_id.exists' => 'Peralatan yang dipilih tidak valid.',
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        $assetIndicator->update($validatedData);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.asset-indicator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Lattol\AssetIndicator  $assetIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetIndicator $assetIndicator)
    {
        $assetIndicator->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
