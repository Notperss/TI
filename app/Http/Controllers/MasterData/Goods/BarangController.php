<?php

namespace App\Http\Controllers\MasterData\Goods;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Goods\Barang;
use App\Models\MasterData\Hardware\Ram;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Goods\GoodsRam;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterData\Goods\Goodsfile;
use App\Models\MasterData\Hardware\Hardisk;
use App\Models\MasterData\Goods\GoodsHardisk;
use App\Models\MasterData\Hardware\Processor;
use App\Models\MasterData\Goods\GoodsProcessor;
use App\Models\Network\Distribution\DistributionAsset;
use App\Http\Requests\MasterData\Goods\StoreGoodsRequest;
use App\Http\Requests\MasterData\Goods\UpdateGoodsRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $barang = Barang::with('distribution_asset.distribution.detail_user.user')->orderby('created_at', 'desc');

            return DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    // Access the distribution_asset relationship
                    $distributionAssets = $item->distribution_asset;

                    // Check if distributionAssets is not empty
                    if ($distributionAssets->isNotEmpty()) {
                        // Initialize an array to store distribution asset creation dates
                        $StatsValue = [];

                        // Loop through each distributionAsset
                        foreach ($distributionAssets as $distributionAsset) {
                            // Add the created_at value to the array
                            $StatsValue[] = $distributionAsset->stats;

                        }

                        // Check if there are any created_at values in the array
                        if (! empty($StatsValue)) {
                            return '
            <div class="btn-group">
                <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.barang.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.barang.edit', $item->id) . '">
                        Edit
                    </a>
            </div>
                ';
                        } else {
                            return 'No created_at values found';
                        }
                    } else {
                        return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.barang.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.barang.edit', $item->id) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.barang.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                    }
                })
                ->editColumn('name', function ($item) {

                    return '
                    <a  style="text-decoration: none; color: white; display:"  title="Lihat semua data history ' . $item->name . '" class="btn btn-sm btn-info"
                        href="' . route('backsite.barang.history_index', $item->id) . '" >' . $item->name . '</a>
                    ';


                })
                ->editColumn('distribution_asset', function ($item) {
                    // Access the distribution_asset relationship
                    $distributionAssets = $item->distribution_asset;

                    // Check if distributionAssets is not empty
                    if ($distributionAssets->isNotEmpty()) {
                        // Initialize an array to store user names
                        $userNames = [];

                        // Loop through each distributionAsset
                        foreach ($distributionAssets as $distributionAsset) {
                            // Check if the distribution relationship exists
                            if ($distribution = $distributionAsset->distribution) {
                                // Check if the detail_user relationship exists
                                if ($detailUser = $distribution->detail_user) {
                                    // Check if the user relationship exists
                                    if ($user = $detailUser->user) {
                                        // Add the user's name to the array
                                        $userNames[] = $user->name;
                                    }
                                }
                            }
                        }

                        // Check if there are any user names in the array
                        if (! empty($userNames)) {
                            // return implode(', ', $userNames);
    
                            $latestUserName = end($userNames);
                            return ($item->stats == 1) ? 'Available' : $latestUserName;
                        } else {
                            return 'No user names found';
                        }
                    } else {
                        return 'Available';
                    }
                })
                ->editColumn('distribution_asset_created_at', function ($item) {
                    // Access the distribution_asset relationship
                    $distributionAssets = $item->distribution_asset;

                    // Check if distributionAssets is not empty
                    if ($distributionAssets->isNotEmpty()) {
                        // Initialize an array to store distribution asset creation dates
                        $createdAtValues = [];

                        // Loop through each distributionAsset
                        foreach ($distributionAssets as $distributionAsset) {
                            // Add the created_at value to the array
                            $createdAtValues[] = $distributionAsset->created_at->format('l, d F Y');

                        }

                        // Check if there are any created_at values in the array
                        if (! empty($createdAtValues)) {
                            // return implode(', ', $createdAtValues);
                            $latestCreatedAt = end($createdAtValues);

                            return ($item->stats == 1) ? 'Available' : $latestCreatedAt;
                        } else {
                            return 'No created_at values found';
                        }
                    } else {
                        return 'Available';
                    }
                })
                ->rawColumns(['action', 'distribution_asset', 'distribution_asset_created_at', 'name'])

                ->toJson();
        }
        return view("pages.master-data.barang.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-goods', $fullname);
        }
        // store to database
        $barang = Barang::create($data);
        $id = $barang->id;
        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.barang.edit', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Goods\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $decrypt_id = decrypt($id);
        $barang = Barang::find($decrypt_id);
        return view('pages.master-data.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Goods\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $barang = Barang::find($barang->id);
        $files = Goodsfile::where('goods_id', $barang->id)->orderBy('created_at', 'desc')->get();
        $processors = GoodsProcessor::with('processor')->where('goods_id', $barang->id)->orderBy('created_at', 'desc')->get();
        $rams = GoodsRam::with('ram')->where('goods_id', $barang->id)->orderBy('created_at', 'desc')->get();
        $hardisks = GoodsHardisk::with('hardisk')->where('goods_id', $barang->id)->orderBy('created_at', 'desc')->get();
        $assets = DistributionAsset::where('asset_id', $barang->id)->get();
        return view('pages.master-data.barang.edit', compact('barang', 'files', 'hardisks', 'processors', 'rams', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Goods\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoodsRequest $request, Barang $barang)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $barang['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-goods', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $barang->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Goods\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $barang = Barang::find($decrypt_id);

        // cari old photo
        $path_file = $barang['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $barang->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_upload_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Barang::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.master-data.barang.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_file(Request $request)
    {
        $barang = Barang::find($request->id);
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-barang', $fullname);
            }
        }
        Goodsfile::create([
            'goods_id' => $request->id,
            'file' => $file,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.barang.edit', $barang);
    }

    public function delete_file($id)
    {
        $file = Goodsfile::find($id);
        $file->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function form_processor(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Barang::find($id);
            $processor = Processor::orderBy('created_at', 'desc')->get();

            $data = [
                'id' => $row['id'],
                'processors' => $processor,
            ];

            $msg = [
                'data' => view('pages.master-data.barang.upload_processor_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_processor(Request $request)
    {
        $barang = Barang::find($request->id);
        GoodsProcessor::create([
            'goods_id' => $request->id,
            'processor_id' => $request->processor_id,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.barang.edit', $barang);
    }

    public function delete_processor($id)
    {
        $processor = GoodsProcessor::find($id);
        $processor->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_ram(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Barang::find($id);
            $ram = Ram::orderBy('created_at', 'desc')->get();

            $data = [
                'id' => $row['id'],
                'rams' => $ram,
            ];

            $msg = [
                'data' => view('pages.master-data.barang.upload_ram_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_ram(Request $request)
    {
        $barang = Barang::find($request->id);
        GoodsRam::create([
            'goods_id' => $request->id,
            'ram_id' => $request->ram_id,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.barang.edit', $barang);
    }

    public function delete_ram($id)
    {
        $ram = GoodsRam::find($id);
        $ram->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_hardisk(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Barang::find($id);
            $hardisk = Hardisk::orderBy('created_at', 'desc')->get();

            $data = [
                'id' => $row['id'],
                'hardisks' => $hardisk,
            ];

            $msg = [
                'data' => view('pages.master-data.barang.upload_hardisk_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_hardisk(Request $request)
    {
        $barang = Barang::find($request->id);
        GoodsHardisk::create([
            'goods_id' => $request->id,
            'hardisk_id' => $request->hardisk_id,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.barang.edit', $barang);
    }

    public function delete_hardisk($id)
    {
        $hardisk = GoodsHardisk::find($id);
        $hardisk->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $barang = Barang::find($id);
            $file = Goodsfile::where('goods_id', $id)->get();
            $processor = GoodsProcessor::where('goods_id', $id)->get();
            $ram = GoodsRam::where('goods_id', $id)->get();
            $hardisk = GoodsHardisk::where('goods_id', $id)->get();
            $data = [
                'datafile' => $file,
                'processor' => $processor,
                'ram' => $ram,
                'hardisk' => $hardisk,
                'barang' => $barang,
            ];

            $msg = [
                'data' => view('pages.master-data.barang.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function history_index(Request $request)
    {
        // $decrypt_id = decrypt($id);
        $id = $request->id;
        $barang = Barang::find($id);

        // if (request()->ajax()) {
        //     $barang = Barang::with('distribution_asset.distribution.detail_user.user')
        //     ->where('')
        //     ->orderby('created_at', 'desc');

        //     return DataTables::of($barang)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($item) {
        //             // Access the distribution_asset relationship
        //             $distributionAssets = $item->distribution_asset;

        //             // Check if distributionAssets is not empty
        //             if ($distributionAssets->isNotEmpty()) {
        //                 // Initialize an array to store distribution asset creation dates
        //                 $StatsValue = [];

        //                 // Loop through each distributionAsset
        //                 foreach ($distributionAssets as $distributionAsset) {
        //                     // Add the created_at value to the array
        //                     $StatsValue[] = $distributionAsset->stats;

        //                 }

        //                 // Check if there are any created_at values in the array
        //                 if (! empty($StatsValue)) {
        //                     return '
        //     <div class="btn-group">
        //         <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        //             aria-expanded="false">Action</button>
        //         <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
        //             <a href="#mymodal" data-remote="' . route('backsite.barang.show', encrypt($item->id)) . '" data-toggle="modal"
        //                 data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
        //                 Show
        //             </a>
        //             <a class="dropdown-item" href="' . route('backsite.barang.edit', $item->id) . '">
        //                 Edit
        //             </a>
        //     </div>
        //         ';
        //                 } else {
        //                     return 'No created_at values found';
        //                 }
        //             } else {
        //                 return '
        //     <div class="btn-group">
        //         <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        //             aria-expanded="false">Action</button>
        //         <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
        //             <a href="#mymodal" data-remote="' . route('backsite.barang.show', encrypt($item->id)) . '" data-toggle="modal"
        //                 data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
        //                 Show
        //             </a>
        //             <a class="dropdown-item" href="' . route('backsite.barang.edit', $item->id) . '">
        //                 Edit
        //             </a>
        //             <form action="' . route('backsite.barang.destroy', encrypt($item->id)) . '" method="POST"
        //             onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
        //                 ' . method_field('delete') . csrf_field() . '
        //                 <input type="hidden" name="_method" value="DELETE">
        //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
        //                 <input type="submit" class="dropdown-item" value="Delete">
        //             </form>
        //     </div>
        //         ';
        //             }
        //         })
        //         ->editColumn('distribution_asset', function ($item) {
        //             // Access the distribution_asset relationship
        //             $distributionAssets = $item->distribution_asset;

        //             // Check if distributionAssets is not empty
        //             if ($distributionAssets->isNotEmpty()) {
        //                 // Initialize an array to store user names
        //                 $userNames = [];

        //                 // Loop through each distributionAsset
        //                 foreach ($distributionAssets as $distributionAsset) {
        //                     // Check if the distribution relationship exists
        //                     if ($distribution = $distributionAsset->distribution) {
        //                         // Check if the detail_user relationship exists
        //                         if ($detailUser = $distribution->detail_user) {
        //                             // Check if the user relationship exists
        //                             if ($user = $detailUser->user) {
        //                                 // Add the user's name to the array
        //                                 $userNames[] = $user->name;
        //                             }
        //                         }
        //                     }
        //                 }

        //                 // Check if there are any user names in the array
        //                 if (! empty($userNames)) {
        //                     // return implode(', ', $userNames);

        //                     $latestUserName = end($userNames);
        //                     return ($item->stats == 1) ? 'Available' : $latestUserName;
        //                 } else {
        //                     return 'No user names found';
        //                 }
        //             } else {
        //                 return 'Available';
        //             }
        //         })
        //         ->editColumn('distribution_asset_created_at', function ($item) {
        //             // Access the distribution_asset relationship
        //             $distributionAssets = $item->distribution_asset;

        //             // Check if distributionAssets is not empty
        //             if ($distributionAssets->isNotEmpty()) {
        //                 // Initialize an array to store distribution asset creation dates
        //                 $createdAtValues = [];

        //                 // Loop through each distributionAsset
        //                 foreach ($distributionAssets as $distributionAsset) {
        //                     // Add the created_at value to the array
        //                     $createdAtValues[] = $distributionAsset->created_at->format('l, d F Y');

        //                 }

        //                 // Check if there are any created_at values in the array
        //                 if (! empty($createdAtValues)) {
        //                     // return implode(', ', $createdAtValues);
        //                     $latestCreatedAt = end($createdAtValues);

        //                     return ($item->stats == 1) ? 'Available' : $latestCreatedAt;
        //                 } else {
        //                     return 'No created_at values found';
        //                 }
        //             } else {
        //                 return 'Available';
        //             }
        //         })
        //         ->rawColumns(['action', 'distribution_asset', 'distribution_asset_created_at'])

        //         ->toJson();
        // }

        if (request()->ajax()) {

            // $distribution = Distribution::with('location_room', 'detail_user.user', 'distribution')->orderby('created_at', 'desc');
            $distribution = DistributionAsset::
                with('distribution.detail_user.user', 'asset', 'distribution.location_room', 'distribution')
                ->where('asset_id', $barang->id)
                ->orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $distribution = $distribution->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }
            return DataTables::of($distribution)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-' . ($item->stats == 2 ? 'warning' : 'info') . ' btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                  <a href="#mymodal" data-remote="' . route('backsite.distribution.show', encrypt($item->distribution->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data" class="dropdown-item">
                        Show
                    </a>
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
                })->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->translatedFormat('l, d F Y');
                })->editColumn('updated_at', function ($item) {
                    return ($item->updated_at == $item->created_at ? 'Belum Dikembalikan' : Carbon::parse($item->updated_at)->translatedFormat('l, d F Y'));
                })

                ->rawColumns(['asset.barcode', 'action', 'asset.name', 'created_at', 'updated_at'])
                ->toJson();
        }

        return view("pages.master-data.barang.history_index", compact('barang'));
    }

    public function generateBarcode()
    {
        // Fetch the next barcode value from the database.
        // Assuming your table has an auto-incremented ID field for the barcode.

        $lastRecord = Barang::where('barcode', 'like', 'TI-%')->latest()->first();
        $nextBarcode = $lastRecord ? (int) str_replace('TI-', '', $lastRecord->barcode) + 1 : 1;
        $finalBarcode = 'TI-' . $nextBarcode;

        return response()->json(['finalBarcode' => $finalBarcode]);


    }
}
