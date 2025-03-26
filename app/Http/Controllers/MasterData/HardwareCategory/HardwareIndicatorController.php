<?php

namespace App\Http\Controllers\MasterData\HardwareCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inspection\Inspection;
use App\Models\MasterData\Goods\Barang;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\HardwareCategory\HardwareCategory;
use App\Models\MasterData\HardwareCategory\HardwareIndicator;

class HardwareIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $hardwareIndicators = HardwareIndicator::with('hardwareCategory')->orderBy('name', 'asc')->latest();

            return DataTables::of($hardwareIndicators)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.hardware-indicator.edit', $item->id).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.hardware-indicator.destroy', $item->id).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->addColumn('hardwareCategory.name', function ($item) {
                    return $item->hardwareCategory ? $item->hardwareCategory->name : 'N/A'; // Jika null, tampilkan "N/A"
                })
                ->rawColumns(['action',])
                ->toJson();
        }
        return view('pages.master-data.hardware-category.hardware-indicator.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hardwareCategories = HardwareCategory::where('has_indicator', true)->get();
        return view('pages.master-data.hardware-category.hardware-indicator.create', compact('hardwareCategories'));
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
            'hardware_category_id' => ['required', 'exists:hardware_categories,id'], // Pastikan ID aset valid
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'hardware_category_id.required' => 'Peralatan wajib diisi.',
            'hardware_category_id.exists' => 'Peralatan yang dipilih tidak valid.',
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        HardwareIndicator::create($validatedData);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.hardware-indicator.index', );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareIndicator  $hardwareIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(HardwareIndicator $hardwareIndicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareIndicator  $hardwareIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(HardwareIndicator $hardwareIndicator)
    {
        $hardwareCategories = HardwareCategory::where('has_indicator', true)->get();
        return view('pages.master-data.hardware-category.hardware-indicator.edit', compact('hardwareCategories', 'hardwareIndicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\HardwareCategory\HardwareIndicator  $hardwareIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HardwareIndicator $hardwareIndicator)
    {
        // Validasi data
        $validatedData = $request->validate([
            'hardware_category_id' => ['required', 'exists:hardware_categories,id'], // Pastikan ID aset valid
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'hardware_category_id.required' => 'Peralatan wajib diisi.',
            'hardware_category_id.exists' => 'Peralatan yang dipilih tidak valid.',
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        $hardwareIndicator->update($validatedData);

        alert()->success('Sukses', 'Data berhasil di update');
        return redirect()->route('backsite.hardware-indicator.index', );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareIndicator  $hardwareIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(HardwareIndicator $hardwareIndicator)
    {
        $hardwareIndicator->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // public function getIndicators(Request $request)
    // {
    //     $asset = Barang::with('hardwareCategory.hardwareIndicators')->find($request->asset_id);

    //     if (! $asset) {

    //         return response()->json([], 404);
    //     }

    //     $indicators = $asset->hardwareCategory->hardwareIndicators->map(function ($indicator) use ($asset) {
    //         return [
    //             'id' => $indicator->id,
    //             'name' => $indicator->name,
    //             // 'value' => $asset->indicators()->where('indicator_id', $indicator->id)->value('value'),
    //             'asset' => $asset->inspectionIndicatorAssets()->where('indicator_id', $indicator->id)->value('value'),
    //         ];
    //     });

    //     return response()->json($indicators);
    // }

    public function getIndicators(Request $request)
    {
        // Validasi request
        $request->validate([
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
            // 'shift' => 'required',
            // 'location_id' => 'required',
            // 'sub_location_id' => 'required',
            // 'date_inspection' => 'required|date',
        ]);

        $inspectionId = $request->inspection_id;


        // // Cek apakah kombinasi inspeksi sudah ada
        // $duplicateInspection = Inspection::where([
        //     'shift' => $request->shift,
        //     'location_id' => $request->location_id,
        //     'sub_location_id' => $request->sub_location_id,
        //     'date_inspection' => $request->date_inspection,
        // ])->where('id', '!=', $inspectionId) // Supaya tidak bentrok dengan inspeksi yang sedang diedit
        //     ->exists();

        // if ($duplicateInspection) {
        //     return response()->json([
        //         'message' => 'Inspeksi dengan kombinasi shift, lokasi, sub lokasi, dan tanggal ini sudah ada!',
        //     ], 422);
        // }

        $asset = Barang::with('hardwareCategory.hardwareIndicators')->find($request->asset_id);

        if (! $asset) {
            return response()->json(['message' => 'Asset tidak ditemukan'], 404);
        }


        $inspectionData = $asset->inspectionIndicatorAssets()
            ->where('inspection_id', $inspectionId)
            ->get()
            ->keyBy('hardware_indicator_id');

        $indicators = $asset->hardwareCategory->hardwareIndicators->map(function ($indicator) use ($inspectionData) {
            $data = $inspectionData->get($indicator->id);
            return [
                'id' => $indicator->id,
                'name' => $indicator->name,
                'status' => $data->status ?? null,
                'description' => $data->description ?? '',
            ];
        });

        return response()->json($indicators);
    }


}
