<?php

namespace App\Http\Controllers\Network\Distribution;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ManagementAccess\DetailUser;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\Network\Distribution\Distribution;
use App\Models\Network\Distribution\DistributionAsset;
use App\Http\Requests\Network\Distribution\StoreDistributionRequest;
use App\Http\Requests\Network\Distribution\UpdateDistributionRequest;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            // $distribution = Distribution::with('location_room', 'detail_user.user', 'distribution')->orderby('created_at', 'desc');
            $distribution = DistributionAsset::
                with('distribution.detail_user.user', 'asset', 'distribution.location_room', 'distribution')
                ->orderby('created_at', 'desc');

            // if($request->filled('from_date') && $request->filled('to_date')) {
            //     $distribution = $distribution->whereBetween('created_at', [$request->from_date, $request->to_date]);
            // }
            if ($request->has('from_date') && $request->has('to_date')) {
                $distribution->whereHas('distribution', function ($query) use ($request) {
                    $query->whereBetween('date', [
                        $request->input('from_date'),
                        $request->input('to_date'),
                    ]);
                });
            }
            // if($request->filled('daterange') && $request->filled('end_date')) {
            //     $distribution = $distribution->whereBetween('created_at', [$request->daterange, $request->end_date]);
            // }
            return DataTables::of($distribution)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                  <a href="#mymodal" data-remote="' . route('backsite.distribution.show', encrypt($item->distribution->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.distribution.edit', $item->distribution->id) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.distribution.destroy_asset', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('asset.barcode', function ($item) {
                    if ($item->asset_id) {
                        return $item->asset->barcode;
                    } else {
                        return '<span>{ Data Empty }</span>';
                    }
                })->editColumn('asset.name', function ($item) {
                    if ($item->asset_id) {
                        return $item->asset->name;
                    } else {
                        return '<span>{ Data Empty }</span>';
                    }
                })->editColumn('distribution.date', function ($item) {
                    return Carbon::parse($item->distribution->date)->translatedFormat('l, d F Y');
                })

                ->rawColumns(['asset.barcode', 'action', 'asset.name', 'distribution.date'])
                ->toJson();
        }

        return view('pages.network.distribution.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location_room = LocationRoom::all();
        $user = DetailUser::where('status', '1')->get();
        $barang = Barang::where('stats', '1')->get();
        return view('pages.network.distribution.create', compact('location_room', 'user', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Network\Distribution\StoreDistributionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get all request from frontsite
        $data = $request->all();
        $rules = [
            'inputs' => 'required|array',
            'inputs.*.asset_id' => 'required|integer|unique:distribution_assets,asset_id',
            'location_room_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            // Add any other rules you need
        ];
        // Custom validation messages
        $messages = [
            'inputs' => 'Data asset tidak boleh kosong.',
            'inputs.*.asset_id' => 'Nama barang tidak boleh sama',
            'location_room_id' => 'Ruangan tidak boleh kosong',
            'user_id' => 'User tidak boleh kosong',
            'description' => 'Keterangan tidak boleh kosong',
            // Add custom messages for other rules as needed
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-distribution', $fullname);
        }
        // store to database
        $distribution = Distribution::create($data);
        $distribution_id = $distribution->id;


        // foreach ($request->inputs as $key => $value) {
        //     DistributionAsset::create([
        //         'distribution_id' => $distribution_id,
        //         'asset_id' => $value['asset_id'],
        //     ]);
        // }

        // // $goods = Barang::find($request->asset_id);
        // $goods = Barang::find($value['asset_id']);
        // $goods->update(['stats' => 2]);

        $assetIdsToUpdate = [];

        foreach ($request->inputs as $key => $value) {
            DistributionAsset::create([
                'distribution_id' => $distribution_id,
                'asset_id' => $value['asset_id'],
            ]);

            // Collect unique 'asset_id' values to update 'stats' field later
            $assetIdsToUpdate[] = $value['asset_id'];
        }

        // Update 'stats' field only once for each unique 'asset_id'
        Barang::whereIn('id', array_unique($assetIdsToUpdate))
            ->where('stats', '!=', 2)
            ->update(['stats' => 2]);


        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.distribution.index');
        // return redirect()->route('backsite.distribution.edit', $distribution_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network\Distribution\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);

        $distribution = Distribution::find($decrypt_id);

        return view('pages.network.distribution.show', compact('distribution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Network\Distribution\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $distribution = Distribution::find($id);
        $location_room = LocationRoom::all();
        $user = DetailUser::where('status', '1')->get();
        $assets = DistributionAsset::where('distribution_id', $id)->with('asset')->orderBy('created_at', 'desc')->get();
        return view('pages.network.distribution.edit', compact('distribution', 'location_room', 'user', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Network\Distribution\UpdateDistributionRequest  $request
     * @param  \App\Models\Network\Distribution\Distribution $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributionRequest $request, Distribution $distribution)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $distribution['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-distribution', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $distribution->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.distribution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network\Distribution\Distribution $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy_asset($id)
    {

        $distributionAssetId = decrypt($id);

        // Find the distribution asset
        $distributionAsset = DistributionAsset::find($distributionAssetId);

        if (! $distributionAsset) {
            // Handle the case where the distribution asset is not found
            // ...
            alert()->error('Error', 'Distribution Asset not found.');
            return redirect()->route('backsite.distribution.index');
        }

        // Get the distribution ID
        $distributionId = $distributionAsset->distribution_id;
        $assetId = $distributionAsset->asset_id;

        //update stats
        $goods = Barang::find($assetId);
        $goods->update(['stats' => 1]);

        // Delete the specific distribution asset
        $distributionAsset->delete();

        // Check if there's only one distribution asset remaining
        $remainingDistributionAssets = DistributionAsset::where('distribution_id', $distributionId)->get();

        if ($remainingDistributionAssets->count() === 0) {
            // cari old photo
            $path_file = $distributionId['file'];

            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }

            // Delete the distribution
            Distribution::where('id', $distributionId)->delete();
        }


        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // public function destroy($id)
    // {
    //     // deskripsi id
    //     $decrypt_id = decrypt($id);
    //     $distribution = Distribution::find($decrypt_id);

    //     // cari old photo
    //     $path_file = $distribution['file'];

    //     // hapus file
    //     if ($path_file != null || $path_file != '') {
    //         Storage::delete($path_file);
    //     }

    //     // hapus location
    //     $distribution->forceDelete();

    //     alert()->success('Sukses', 'Data berhasil dihapus');
    //     return back();
    // }

    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $barang = Barang::where('stats', '1')->get();
            $row = Distribution::find($id);
            $data = [
                'id' => $row['id'],
                'barang' => $barang,
            ];

            $msg = [
                'data' => view('pages.network.distribution.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_file(Request $request)
    {
        // Validation rules
        $rules = [
            'asset_id' => ['required',
                Rule::unique('distribution_assets')->where(function ($query) use ($request) {
                    return $query->where('distribution_id', $request->id);
                }),
            ], // Add any other rules you need
        ];

        // Custom validation messages
        $messages = [
            'asset_id.required' => 'Nama barang tidak boleh kosong.',
            'asset_id.unique' => 'Nama barang tidak boleh sama',
            // Add custom messages for other rules as needed
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $distribution = Distribution::find($request->id);
        DistributionAsset::create([
            'distribution_id' => $request->id,
            'asset_id' => $request->asset_id,
        ]);

        $goods = Barang::find($request->asset_id);
        $goods->update(['stats' => 2]);


        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.distribution.edit', $distribution);
    }

    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $assets = DistributionAsset::where('distribution_id', $id)->with('asset')->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $assets,
            ];

            $msg = [
                'data' => view('pages.network.distribution.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function delete_file(Request $request)
    {
        $distributionAssetId = $request->id;

        // Find the distribution asset
        $distributionAsset = DistributionAsset::find($distributionAssetId);

        if (! $distributionAsset) {
            // Handle the case where the distribution asset is not found
            // ...
            alert()->error('Error', 'Distribution Asset not found.');
            return redirect()->route('backsite.distribution.index');
        }

        // Get the distribution ID
        $distributionId = $distributionAsset->distribution_id;
        $assetId = $distributionAsset->asset_id;

        //update stats
        $goods = Barang::find($assetId);
        $goods->update(['stats' => 1]);


        // Delete the specific distribution asset
        $distributionAsset->delete();

        // Check if there's only one distribution asset remaining
        $remainingDistributionAssets = DistributionAsset::where('distribution_id', $distributionId)->get();

        if ($remainingDistributionAssets->count() === 0) {
            // Delete the distribution
            Distribution::where('id', $distributionId)->delete();

            alert()->success('Success', 'All data has been deleted');
            return redirect()->route('backsite.distribution.index');
        }

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function goods($distributionId)
    {

        $distribution = Distribution::findOfail($distributionId);
        $goods = $distribution->goods()->select('goods.id', 'goods.name')->get();

        // Mendapatkan vendor yang dipilih berdasarkan data procurement
        $selectedGoods = $distribution->goods()->pluck('goods.id')->toArray();

        return response()->json([
            'goods' => $goods,
            'selectedGoods' => $selectedGoods,
        ]);
    }
}

