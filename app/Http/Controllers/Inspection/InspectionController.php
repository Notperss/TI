<?php

namespace App\Http\Controllers\Inspection;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Inspection\Inspection;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationSub;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\Inspection\InspectionTestingAsset;
use App\Models\Network\Distribution\Distribution;
use App\Models\Inspection\InspectionIndicatorAsset;
use App\Http\Requests\Inspection\InspectionStoreRequest;
use App\Http\Requests\Inspection\InspectionUpdateRequest;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $inspections = Inspection::with('user', 'location')
            ->when(! Auth()->user()->hasAnyRole(['manager', 'super-admin']), function ($query) {
                return $query->where('job_position_id', Auth()->user()->job_position_id);
            })
            ->latest();

        if (request()->ajax()) {

            return DataTables::of($inspections)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.inspection.edit', $item->id).'">
                        Check Aset
                    </a>
                    <form action="'.route('backsite.inspection.destroy', $item->id).'" method="POST"
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
        return view('pages.inspection.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::orderBy('name', 'asc')->get();
        $subLocations = LocationSub::orderBy('name', 'asc')->get();
        $roomLocations = LocationRoom::orderBy('name', 'asc')->get();
        $users = User::whereNotNull('email_verified_at')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'super-admin');
            })
            ->orderBy('name', 'asc')
            ->get();
        $assets = Barang::orderBy('name', 'asc')->get();
        return view('pages.inspection.create', compact('locations', 'users', 'assets', 'subLocations', 'roomLocations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InspectionStoreRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $inspection = Inspection::create($validatedData);

            // Cek dan simpan file jika ada
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = 'inspection_'.time().'.'.$file->getClientOriginalExtension();
                $filePath = $file->storeAs('assets/inspections', $fileName);
                $inspection->file_path = $filePath;
                $inspection->save();
            }

            $assets = json_decode($validatedData['assets'], associative: true);

            if (is_array($assets) && count($assets) > 0) {
                $inspection->assets()->sync(collect($assets)->pluck('id'));
            }

            alert()->success('Sukses', 'Data berhasil ditambahkan');
            return redirect()->route('backsite.inspection.edit', $inspection->id);
        } catch (Exception $e) {
            alert()->error('Gagal', 'Terjadi kesalahan: '.$e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $locations = Location::orderBy('name', 'asc')->get();
        $subLocations = LocationSub::orderBy('name', 'asc')->get();
        $roomLocations = LocationRoom::where('sub_location_id', $inspection->sub_location_id)->orderBy('name', 'asc')->get();
        $users = User::whereNotNull('email_verified_at')->orderBy('name', 'asc')->get();
        // $assets = Barang::orderBy('name', 'asc')->get();

        return view('pages.inspection.edit', compact('locations', 'users', 'subLocations', 'roomLocations', 'inspection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(InspectionUpdateRequest $request, Inspection $inspection)
    {
        $validatedData = $request->validated();

        $inspection->update($validatedData);

        alert()->success('Sukses', 'Data berhasil diubah');
        return redirect()->route('backsite.inspection.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        try {
            $inspection->assets()->detach();

            $inspection->delete();

            alert()->success('Sukses', 'Data berhasil dihapus');
        } catch (Exception $e) {
            alert()->error('Error', 'Gagal menghapus data!');
        }

        return redirect()->route('backsite.inspection.index');
    }

    // public function getInspectionAsset(Request $request)
    // {
    //     $locationId = $request->input('locationId');

    //     // Ambil data hanya jika distribution memiliki distribution_asset dan asset dengan filter langsung di query
    //     $distributions = Distribution::with([
    //         'distribution_asset' => function ($query) {
    //             $query->where('stats', 1)->with([
    //                 'asset' => function ($query) {
    //                     $query->where('is_inspected', 1);
    //                 }
    //             ]);
    //         },
    //         'location_room.sub_location',
    //     ])
    //         ->where('location_id', $locationId)
    //         ->get();

    //     // Ambil asset yang valid dari hasil query di atas
    //     $assets = $distributions->flatMap(function ($distribution) {
    //         return $distribution->distribution_asset->map(function ($distributionAsset) use ($distribution) {
    //             $asset = $distributionAsset->asset;

    //             // Cek apakah asset tidak null sebelum mengakses propertinya
    //             if ($asset) {
    //                 return [
    //                     'id' => $asset->id,
    //                     'barcode' => $asset->barcode,
    //                     'name' => $asset->name,
    //                     'location_room' => optional($distribution->location_room)->name,
    //                     'sub_room' => optional($distribution->location_room->sub_location)->name,
    //                 ];
    //             }

    //             return null; // Jika asset null, kembalikan null
    //         })->filter(); // Hapus elemen null dari koleksi
    //     });

    //     return response()->json($assets);
    // }


    public function getInspectionAsset(Request $request)
    {
        $subLocationId = $request->input('sub_location_id');
        $roomId = $request->input('location_room_id');
        $inspectionId = $request->input('inspection_id');

        // Query dasar dengan relasi
        $query = Distribution::with([
            'distribution_asset.asset',
            'location_room.sub_location',
            'user',
        ])->whereHas('distribution_asset', function ($q) {
            $q->where('stats', 1)->whereHas('asset', function ($q) {
                $q->where('is_inspected', 1);
            });
        })->when(! auth()->user()->hasAnyRole(['manager', 'super-admin']), function ($query) {
            return $query->where('job_position_id', auth()->user()->job_position_id);
        });

        // Filter berdasarkan sub lokasi atau room jika ada
        if ($subLocationId) {
            $query->whereHas('location_room.sub_location', function ($q) use ($subLocationId) {
                $q->where('id', $subLocationId);
            });
        }

        if ($roomId) {
            $query->where('location_room_id', $roomId);
        }

        $distributions = $query->get();

        $assets = $distributions->flatMap(function ($distribution) use ($inspectionId) {
            return $distribution->distribution_asset->map(function ($distributionAsset) use ($distribution, $inspectionId) {
                $asset = $distributionAsset->asset;

                if ($asset) {
                    // Cek jika inspectionId ada
                    $filePath = null;
                    $assetInspectionId = null;

                    if ($inspectionId) {
                        $fileData = DB::table('asset_inspection')
                            ->where('inspection_id', $inspectionId)
                            ->where('asset_id', $asset->id)
                            ->select('id', 'file_path')
                            ->first();

                        $filePath = $fileData->file_path ?? null;
                        $assetInspectionId = $fileData->id ?? null;
                    }

                    return [
                        'id' => $asset->id,
                        'barcode' => $asset->barcode,
                        'name' => $asset->name,
                        'description' => $distribution->description,
                        'location_room' => optional($distribution->location_room)->name,
                        'sub_room' => optional($distribution->location_room->sub_location)->name,
                        'file_path' => $filePath,
                        'asset_inspection_id' => $assetInspectionId,
                    ];
                }

                return null;
            })->filter();
        });

        return response()->json($assets);
    }

    public function assetIndicatorStore(Request $request)
    {

        $validatedData = $request->validate([
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
            // 'indicator_name' => 'required|max:255',
            'indicators' => 'required|array',
            'indicators.*.status' => 'required|string',
            'indicators.*.indicator_name' => 'required|string',
            'indicators.*.description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->indicators as $id => $indicatorData) {
                InspectionIndicatorAsset::create([
                    'asset_id' => $request->asset_id,
                    'inspection_id' => $request->inspection_id,
                    'indicator_name' => $indicatorData['indicator_name'],
                    'hardware_indicator_id' => $id,
                    'status' => $indicatorData['status'],
                    'description' => $indicatorData['description'],
                ]);
            }

            DB::commit();
            alert()->success('Sukses', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan: '.$e->getMessage());
        }

        return redirect()->back();
    }

    public function deleteAllIndicator(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
        ]);

        // Hapus semua data testing berdasarkan asset & inspection
        $deleted = InspectionindicatorAsset::where('asset_id', $request->asset_id)
            ->where('inspection_id', $request->inspection_id)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Semua data indikator berhasil dihapus']);
        }

        return response()->json(['message' => 'Gagal menghapus data indikator'], 500);
    }

    public function assetTestingStore(Request $request)
    {
        // dd($request->all());

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
            'testings' => 'required|array',
            'testings.*.result' => 'required|string',
            'testings.*.testing_name' => 'required|string',
            'testings.*.description' => 'nullable|string',
        ]);

        // dd($validatedData);

        try {
            DB::beginTransaction();

            // Looping tiap testing untuk menyimpan datanya
            foreach ($request->testings as $id => $testingData) {
                // Hitung nomor tes berdasarkan urutan input
                $existingCount = InspectionTestingAsset::where('asset_id', $request->asset_id)
                    ->where('inspection_id', $request->inspection_id)
                    ->where('hardware_testing_id', $id)
                    ->count();

                $testNumber = $existingCount + 1;

                InspectionTestingAsset::create([
                    'asset_id' => $request->asset_id,
                    'inspection_id' => $request->inspection_id,
                    'hardware_testing_id' => $id,
                    'number' => $testNumber,
                    'testing_name' => $testingData['testing_name'],
                    'result' => $testingData['result'],
                    'description' => $testingData['description'],
                ]);
            }

            DB::commit();
            alert()->success('Sukses', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan: '.$e->getMessage());
        }

        return redirect()->back();
    }

    public function deleteAllTesting(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
        ]);

        // Hapus semua data testing berdasarkan asset & inspection
        $deleted = InspectionTestingAsset::where('asset_id', $request->asset_id)
            ->where('inspection_id', $request->inspection_id)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Semua data testing berhasil dihapus']);
        }

        return response()->json(['message' => 'Gagal menghapus data testing'], 500);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx,xlsx,png,jpg|max:2048',
            'asset_id' => 'required|exists:goods,id',
            'inspection_id' => 'required|exists:inspections,id',
        ]);

        try {
            $inspection = Inspection::find($request->inspection_id);

            // Ambil file dan simpan
            $file = $request->file('file');
            $fileName = "asset_{$request->asset_id}_{$inspection->id}_".Str::random(3).'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('assets/inspection-image-asset', $fileName);

            // Cari inspection yang cocok

            if (! $inspection) {
                return redirect()->back()->with('error', 'Inspection tidak ditemukan');
            }

            // Update atau attach ke pivot asset_inspection
            $inspection->assets()->syncWithoutDetaching([
                $request->asset_id => ['file_path' => $filePath],
            ]);

            alert()->success('success', 'File berhasil diunggah');
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error('error', 'Gagal mengunggah file: '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:barangs,id',
        ]);

        try {
            $assetId = $request->asset_id;

            $inspection = Inspection::whereHas('assets', function ($query) use ($assetId) {
                $query->where('asset_id', $assetId);
            })->first();

            if ($inspection) {
                $currentFile = $inspection->assets()->wherePivot('asset_id', $assetId)->first()->pivot->file_path;

                if ($currentFile && Storage::exists(str_replace('storage/', 'public/', $currentFile))) {
                    Storage::delete(str_replace('storage/', 'public/', $currentFile));
                }

                $inspection->assets()->updateExistingPivot($assetId, ['file_path' => null]);

                return response()->json(['success' => true, 'message' => 'File berhasil dihapus']);
            }

            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus file: '.$e->getMessage()]);
        }
    }

    public function allProblematicItems()
    {

        if (request()->ajax()) {

            $inspection = InspectionIndicatorAsset::with('asset', 'inspection')
                ->whereHas('inspection', function ($query) {
                    $query->where('job_position_id', Auth::user()->job_position_id);
                })->whereNot('status', 'Baik')
                ->orderby('created_at', 'desc');

            return DataTables::of($inspection)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
            <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.inspection.problem.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Inspeksi" class="dropdown-item">
                        Show
                    </a>
                 
            </div>
            </div>
            
                <form action="'.route('backsite.inspection.problem.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="
                    '.($item->is_approve == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'
                    ">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-sm btn-'.($item->is_approve == 1 ? 'success' : 'danger').' w-100" value="'.($item->is_approve == 1 ? 'Close' : 'Open').'"
                        '.($item->is_approve == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
                ';
                })
                ->rawColumns(['action', 'date', 'file'])
                ->toJson();
        }

        return view('pages.inspection.problem.index');
    }

    public function showProblematicItem($id)
    {
        $decrypt_id = decrypt($id);
        $inspection = InspectionIndicatorAsset::with('asset', 'inspection', 'hardwareIndicator')
            ->find($decrypt_id);
        return view('pages.inspection.problem.show', compact('inspection'));
    }

    public function approveProblematicItem($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection = InspectionIndicatorAsset::find($decrypt_id);
        if ($inspection->is_approve == 1) {
            $inspection->update(['is_approve' => 2]);
        } elseif ($inspection->is_approve == 2) {
            $inspection->update(['is_approve' => 1]);
        } else {
            alert()->error('Error', 'Data gagal diubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil diubah');
        return back();
    }



}
