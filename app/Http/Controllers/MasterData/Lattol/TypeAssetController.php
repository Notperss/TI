<?php

namespace App\Http\Controllers\MasterData\Lattol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Lattol\TypeAsset;

class TypeAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $typeAsset = TypeAsset::orderBy('created_at', 'desc');

            return DataTables::of($typeAsset)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.type-asset.edit', $item->id).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.type-asset.destroy', $item->id).'" method="POST"
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
        return view('pages.master-data.lattol.type-asset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.lattol.type-asset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        TypeAsset::create($validatedData);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.type-asset.index', );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Lattol\TypeAsset  $typeAsset
     * @return \Illuminate\Http\Response
     */
    public function show(TypeAsset $typeAsset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Lattol\TypeAsset  $typeAsset
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeAsset $typeAsset)
    {
        return view('pages.master-data.lattol.type-asset.edit', compact('typeAsset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Lattol\TypeAsset  $typeAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeAsset $typeAsset)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        $typeAsset->update($validatedData);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.type-asset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Lattol\TypeAsset  $typeAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeAsset $typeAsset)
    {
        $typeAsset->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
