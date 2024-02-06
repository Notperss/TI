<?php

namespace App\Http\Controllers\Maintenance;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterData\Employee;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\Maintenance;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Network\Distribution\Distribution;
use App\Http\Requests\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Models\Maintenance\MaintenanceStatus;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $maintenance = Maintenance::orderby('created_at', 'desc');

            // if ($request->filled('from_date') && $request->filled('to_date')) {
            //     $maintenance = $maintenance->whereBetween('created_at', [$request->from_date, $request->to_date]);
            // }

            return DataTables::of($maintenance)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
                        <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.maintenance.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Laporan" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.maintenance.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.maintenance.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
            </div>
                    <form action="' . route('backsite.maintenance.edit', encrypt($item->id)) . '" method="POST"
                    onsubmit="
                    ' . ($item->stats == 1 ? 'return confirm(\'Are You Sure Want to Approve?\')' : 'return confirm(\'Are You Sure Want to Cancel Approve?\')') . '
                    ">
                        ' . method_field('PUT') . csrf_field() . '
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="btn btn-sm btn-' . ($item->stats == 1 ? 'success' : 'danger') . ' w-100" value="' . ($item->stats == 1 ? 'Approve' : 'Cancel-Approve') . '">
                    </form>

                ';

                })->editColumn('employee_id', function ($item) {
                    return $item->employee->name;
                })
                ->rawColumns(['action',])
                ->toJson();
        }

        return view('pages.maintenance.maintenance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::orderBy('name', 'asc')->get();
        $users = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
        return view('pages.maintenance.maintenance.create', compact('employees', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Maintenance\StoreMaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-laporan-gangguan', $fullname);
        }
        // store to database
        Maintenance::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.maintenance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $maintenance = Maintenance::find($decrypt_id);
        return view('pages.maintenance.maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id = $maintenance->id;
        $decrypt_id = decrypt($id);
        $maintenance = Maintenance::with('employee.distribution.distribution_asset')->find($decrypt_id);
        $employees = Employee::orderBy('name', 'asc')->get();

        // $users = User::where(['name', '!=', 'Administrator'], ['status', '1'])->orderBy('name', 'asc')->get();
        $barang = Barang::where('id', $maintenance->goods_id)->orderBy('barcode', 'asc')->get();
        $users = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();

        $statusReport = MaintenanceStatus::where('maintenance_id', $maintenance->id)->orderBy('created_at', 'desc')->get();
        return view('pages.maintenance.maintenance.edit', compact('employees', 'users', 'maintenance', 'barang', 'statusReport'));
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
        $data = $request->all();

        // cari old photo
        $path_file = $maintenance['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-laporan-gangguan', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $maintenance->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $maintenance = Maintenance::find($decrypt_id);

        // cari old photo
        $path_file = $maintenance['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $maintenance->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
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

    public function getAsset(Request $request)
    {

        $assetId = $request->input('asset_id');

        $getAsset = Distribution::with('distribution_asset.distribution.employee')
            ->where('user_id', $assetId)
            ->get();

        // Transform the data to include user names
        // $result = $getAsset->map(function ($item) {
        //     $assetBarcode = [];
        //     $assetId = [];

        //     foreach ($item->distribution_asset as $distributionAsset) {
        //         if ($asset = $distributionAsset->asset) {
        //             $assetBarcode[] = $asset->barcode;
        //             $assetId[] = $asset->id;
        //         }
        //     }

        //     $item->asset_barcode = implode(', ', $assetBarcode);
        //     $item->asset_ids = implode(', ', $assetId);

        //     return $item;
        // });

        $result = $getAsset->map(function ($item) {
            $assetDetails = [];

            foreach ($item->distribution_asset as $distributionAsset) {
                if ($asset = $distributionAsset->asset) {
                    $assetDetails[] = [
                        'barcode' => $asset->barcode,
                        'id' => $asset->id,
                    ];
                }
            }

            $item->asset_details = $assetDetails;

            // Example usage with error handling
            $barcodes = array_column($assetDetails, 'barcode');
            $ids = array_column($assetDetails, 'id');

            // Check if $barcodes and $ids are arrays before using implode
            if (is_array($barcodes)) {
                $item->asset_barcode = implode(', ', $barcodes);
            } else {
                $item->asset_barcode = 'N/A';
            }

            if (is_array($ids)) {
                $item->asset_ids = implode(', ', $ids);
            } else {
                $item->asset_ids = 'N/A';
            }

            return $item;
        });



        return response()->json($result);
    }

    public function form_update_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $users = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
            $row = Maintenance::find($id);
            $data = [
                'id' => $row['id'],
                'users' => $users,
            ];

            $msg = [
                'data' => view('pages.maintenance.maintenance.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function add_status(Request $request)
    {
        $maintenance = Maintenance::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-maintenance-status', $fullname);

                MaintenanceStatus::create([
                    'maintenance_id' => $request->id,
                    'users_id' => $request->users_id,
                    'report_status' => $request->report_status,
                    'date' => $request->date,
                    'file' => $file,
                    'description' => $request->description,
                ]);
            }
        }

        // dd($request->all());

        alert()->success('Success', 'Status successfully added');
        return redirect()->route('backsite.maintenance.edit', encrypt($maintenance->id));
    }

    public function show_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $maintenanceStatus = MaintenanceStatus::where('maintenance_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $maintenanceStatus,
            ];

            $msg = [
                'data' => view('pages.maintenance.maintenance.detail_status', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function delete_status($id)
    {
        $file = MaintenanceStatus::find($id);
        $file->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
