<?php

namespace App\Http\Controllers\Maintenance;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterData\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\Maintenance;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ManagementAccess\DetailUser;
use App\Models\Maintenance\MaintenanceStatus;
use App\Models\Network\Distribution\Distribution;
use App\Http\Requests\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;

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

            $maintenance = Maintenance::with('maintenanceStatus', 'user')->orderby('created_at', 'desc');

            // if ($request->filled('from_date') && $request->filled('to_date')) {
            //     $maintenance = $maintenance->whereBetween('created_at', [$request->from_date, $request->to_date]);
            // }

            return DataTables::of($maintenance)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $user = auth()->user()->detail_user;
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
        <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.maintenance.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Laporan" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.maintenance.edit', encrypt($item->id)).'" '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                        Edit
                                </a>
                    <form action="'.route('backsite.maintenance.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete" '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                    </form>
            </div>
            </div>
             <div class="btn-group mr-1 mb-1">
                   <button type="button" class="btn btn-success btn-sm" title="Fixing" onclick="fixing('.$item->id.')" '.(MaintenanceStatus::where('maintenance_id', $item->id)->exists() ? 'hidden' : '').'>
                    Fixing</button>
                   <button type="button" class="btn btn-warning btn-sm" title="Info User" onclick="analysis('.$item->id.')" '.($item->stats == 2 || $item->barcode || $item->type_malfunction ? 'hidden' : '').'>
                  Info User</button>
                    <button type="button" class="btn btn-cyan btn-sm" title="Update" onclick="update('.$item->id.')" '.($item->stats == 2 ? 'hidden' : '').'>
                    Update</button>
            </div>
        </div>
                ';

                })->editColumn('numberAndStatus', function ($item) {
                    if ($item->stats == 1) {
                        return ' '.$item->report_number.'<br><span class="badge bg-danger">Open</span>';
                    } elseif ($item->stats == 2) {
                        return '  '.$item->report_number.'<br><span class="badge bg-info">Closed</span>';
                    }
                })->editColumn('recipient', function ($item) {
                    // Access the distribution_asset relationship
                    $maintenanceStatuses = $item->maintenanceStatus;

                    // Check if maintenanceStatus is not empty
                    if ($maintenanceStatuses->isNotEmpty()) {
                        // Initialize an array to store user names
                        $userNames = [];

                        // Loop through each distributionAsset
                        foreach ($maintenanceStatuses as $maintenanceStatus) {
                            // Check if the distribution relationship exists
                            if ($user = $maintenanceStatus->user) {
                                // Check if the detail_user relationship exists
                                $userNames[] = $user->name;
                            }
                        }

                        // Check if there are any user names in the array
                        if (! empty($userNames)) {
                            // return implode(', ', $userNames);
    
                            $latestUserName = end($userNames);
                            return $latestUserName;
                        } else {
                            return 'N/A';
                        }
                    } else {
                        return 'N/A';
                    }
                })->editColumn('LastDesc', function ($item) {
                    // Access the distribution_asset relationship
                    $maintenanceStatuses = $item->maintenanceStatus;

                    // Check if maintenanceStatus is not empty
                    if ($maintenanceStatuses->isNotEmpty()) {
                        // Initialize an array to store user names
                        $descriptions = [];

                        // Loop through each distributionAsset
                        foreach ($maintenanceStatuses as $maintenanceStatus) {
                            // Check if the distribution relationship exists
                            if ($description = $maintenanceStatus->description) {
                                // Check if the detail_user relationship exists
                                $descriptions[] = $description;
                            }
                        }

                        // Check if there are any user names in the array
                        if (! empty($descriptions)) {
                            // return implode(', ', $descriptions);
    
                            $latestDesc = end($descriptions);
                            return $latestDesc;
                        } else {
                            return 'N/A';
                        }
                    } else {
                        return 'N/A';
                    }
                })->editColumn('LastStats', function ($item) {
                    // Access the distribution_asset relationship
                    $maintenanceStatuses = $item->maintenanceStatus;

                    // Check if maintenanceStatus is not empty
                    if ($maintenanceStatuses->isNotEmpty()) {
                        // Initialize an array to store user names
                        $statuses = [];
                        $dates = [];

                        // Loop through each distributionAsset
                        foreach ($maintenanceStatuses as $maintenanceStatus) {
                            // Check if the distribution relationship exists
                            if ($status = $maintenanceStatus->report_status) {
                                // Check if the detail_user relationship exists
                                $statuses[] = $status;
                            }
                            if ($date = $maintenanceStatus->date) {
                                // Check if the detail_user relationship exists
                                $dates[] = $date;
                            }
                        }

                        // Check if there are any user names in the array
                        if (! empty($statuses)) {
                            // return implode(', ', $userNames);
    
                            $latestDate = end($dates);
                            $lateststatus = end($statuses);

                            $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $latestDate);
                            $formattedDate = $carbonDate->translatedFormat('d-m-Y, H:i');

                            if ($lateststatus == 1) {
                                return '<span class="badge bg-info">Open</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 2) {
                                return '<span class="badge bg-warning">Penanganan</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 3) {
                                return '<span class="badge bg-warning">Penanganan Lanjutan</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 4) {
                                return '<span class="badge bg-warning">Form LK</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 5) {
                                return '<span class="badge bg-warning">Perbaikan Vendor</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 6) {
                                return '<span class="badge bg-warning">Menyerahkan Barang ke Vendor</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 7) {
                                return '<span class="badge bg-warning">Menerima Barang dari Vendor</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 8) {
                                return '<span class="badge bg-warning">BA</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 9) {
                                return '<span class="badge bg-success">Selesai</span><br>'.$formattedDate.'';
                            } elseif ($lateststatus == 10) {
                                return '<span class="badge bg-danger">Tidak Selesai - Rusak</span><br>'.$formattedDate.'';
                            }

                            // return $lateststatus;
                        } else {
                            return 'N/A';
                        }
                    } else {
                        return 'N/A';
                    }
                })->editColumn('employee_id', function ($item) {
                    return $item->employee_id ? $item->employee->name : 'N/A';
                })->editColumn('date', function ($item) {
                    // Assuming $item->date is a string in 'Y-m-d H:i:s' format
                    $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $item->date);

                    // Return the formatted date for display in the DataTable
                    return $carbonDate->translatedFormat('d-m-Y, H:i');
                })
                ->rawColumns(['action', 'employee_id', 'numberAndStatus', 'recipient', 'LastStats'])
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
        $users = User::where('name', '!=', 'Administrator')
            ->whereHas('detail_user', function ($query) {
                $query->where('status', '=', '1');
            })
            ->orderBy('name', 'asc')
            ->get();
        // $users = User::where(['name', '!=', 'Administrator'], [DetailUser::where('status', '=', '1')])->orderBy('name', 'asc')->get();
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
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-laporan-maintenance', $fullname);
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

        // $barang = Barang::where('id', $maintenance->goods_id)->orderBy('barcode', 'asc')->get();
        $barang = Barang::orderBy('barcode', 'asc')->get();
        $users = User::where('name', '!=', 'Administrator')
            ->whereHas('detail_user', function ($query) {
                $query->where('status', '=', '1');
            })
            ->orderBy('name', 'asc')
            ->get();
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
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-laporan-maintenance', $fullname);
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

    public function form_analysis(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            // $barang = Barang::where('id', $maintenance->goods_id)->orderBy('barcode', 'asc')->get();
            $barang = Barang::orderBy('barcode', 'asc')->get();
            $employees = Employee::orderBy('name', 'asc')->get();
            $users = User::where('name', '!=', 'Administrator')
                ->whereHas('detail_user', function ($query) {
                    $query->where('status', '=', '1');
                })
                ->orderBy('name', 'asc')
                ->get();

            $row = Maintenance::find($id);
            $data = [
                'id' => $row['id'],
                'users' => $users,
                'barang' => $barang,
                'maintenance' => $row,
                'employees' => $employees,
            ];

            $msg = [
                'data' => view('pages.maintenance.maintenance.form_analysis', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function form_update_status(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->id;
            $users = User::where('name', '!=', 'Administrator')
                ->whereHas('detail_user', function ($query) {
                    $query->where('status', '=', '1');
                })
                ->orderBy('name', 'asc')
                ->get();
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

        $validator = Validator::make($request->all(), [
            'report_status' => 'required',
            'date' => [
                'required',
                'date', // Pastikan input adalah format tanggal yang valid
                function ($attribute, $value, $fail) use ($maintenance) {
                    $inputDate = Carbon::parse($value);
                    $maintenanceDate = Carbon::parse($maintenance->date);

                    if ($inputDate->lessThan($maintenanceDate)) { // Ubah ke lessThan
                        $fail('Tanggal tidak boleh kurang dari '.$maintenanceDate->format('Y-m-d H:i:s'));
                    }
                }
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-laporan-status', $fullname);

                MaintenanceStatus::create([
                    'maintenance_id' => $request->id,
                    'users_id' => $request->users_id,
                    'report_status' => $request->report_status,
                    'date' => $request->date,
                    'file' => $file,
                    'description' => $request->description,
                ]);
            }
        } else {
            // File is not present, save other data without file
            MaintenanceStatus::create([
                'maintenance_id' => $request->id,
                'users_id' => $request->users_id,
                'report_status' => $request->report_status,
                'date' => $request->date,
                'description' => $request->description,
                // Assuming 'file' column in the database is nullable, it will be set to null by default
            ]);
        }
        // dd($request->all());

        if ($request->report_status == 9 || $request->report_status == 10) {
            $maintenance->update(['stats' => 2]);
            if ($maintenance->goods_id && $request->report_status == 10) {
                $goods = Barang::find($maintenance->goods_id);
                $goods->update(['stats' => 4]);

                $goods->distribution_asset()->update(['stats' => 2]);
            }
        }

        // dd($request->all());

        alert()->success('Success', 'Status successfully added');
        // return redirect()->route('backsite.maintenance.edit', encrypt($maintenance->id));
        return redirect()->route('backsite.maintenance.index');
    }

    public function show_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $user = auth()->user()->detail_user;
            $isAdmin = $user->type_user_id === 1;

            $maintenanceStatus = MaintenanceStatus::where('maintenance_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $maintenanceStatus,
                'isAdmin' => $isAdmin,
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

        // $maintenance = Maintenance::all();

        if ($file->maintenance->stats == 2) {
            $file->maintenance->update(['stats' => 1]);
        }

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function fixing(Request $request)
    {
        $maintenance = Maintenance::find($request->id);

        if ($maintenance) {
            MaintenanceStatus::create([
                'maintenance_id' => $request->id,
                'users_id' => auth()->id(),
                'report_status' => '2',
                'date' => now()->format('Y-m-d H:i:s'),
                'description' => 'penanganan',
            ]);

            // Retrieve the corresponding Maintenance model after creating MaintenanceStatus
            // $maintenanceWithStatus = Maintenance::with('maintenanceStatus')->find($request->id);

            $success = true; // Replace with your actual success condition
            $message = 'Data berhasil di Update'; // Replace with your actual success message

            return response()->json(['success' => $success, 'message' => $message]);
            // alert()->success('Sukses', 'Data berhasil di Update');
            // return back();
        }
        // return back()->with(['maintenance' => $maintenanceWithStatus]);
        // } else {
        //     // Return a 404 response if the maintenance record is not found
        //     return response()->json(['message' => 'Maintenance record not found'], 404);
        // }

    }
}
