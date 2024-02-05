<?php

namespace App\Http\Controllers\Network\Distribution;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\MasterData\Employee;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ManagementAccess\DetailUser;
use App\Models\MasterData\Division\Division;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationSub;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\Network\Distribution\Distribution;
use App\Models\Network\Distribution\IpDeployment;
use App\Models\Network\Distribution\DistributionApp;
use App\Models\Network\Distribution\DistributionAsset;
use App\Http\Requests\Network\Distribution\StoreDistributionRequest;
use App\Http\Requests\Network\Distribution\UpdateDistributionRequest;
use App\Models\SystemInformation\License\License;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

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
            $distribution = DistributionAsset::with('distribution.detail_user.user', 'asset', 'distribution.location_room', 'distribution', 'distribution.employee')
                ->orderBy('stats', 'asc')
                ->orderBy('created_at', 'desc');

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
                <button type="button" class="btn btn-' . ($item->stats == 2 ? 'warning' : 'info') . ' btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.distribution.show', $item->distribution->id) . '" data-toggle="modal"
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
                        <input type="submit" class="dropdown-item" style="display:' . ($item->stats == 2 ? 'none' : '') . '" value="Delete">
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
        $location_id = Location::orderBy('created_at', 'desc')->get();
        $sub_location = LocationSub::orderBy('created_at', 'desc')->get();
        $user = Employee::where('status', '1')->orderBy('name', 'asc')->get();
        // $user = DetailUser::where('status', '1')->get();
        $barang = Barang::where('stats', '1')->get();
        $apps = License::orderBy('created_at', 'desc')->get();
        $division = Division::orderBy('name', 'asc')->get();
        return view('pages.network.distribution.create', compact(
            'location_id',
            'sub_location',
            'apps',
            'user',
            'barang',
            'division'));
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
            // 'ip' => 'required|array',
            'app' => 'array',
            'inputs.*.asset_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($data) {
                    $found = collect($data['inputs'])->where('asset_id', $value)->count();

                    if ($found > 1) {
                        $fail("Duplicate asset_id found in inputs array.");
                    }
                },
                // ->where(function ($query) {
                //     // Add a condition to check for the specific array
                //     $query->where('distribution_type', 'inputs');
                // }),
            ],
            'app.*.license_id' => 'required',
            'ip.*.ip' => 'required',
            'ip.*.internet_access' => 'required',
            'ip.*.gateway' => 'required',
            'location_room_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            // Add any other rules you need
        ];
        // Custom validation messages
        $messages = [
            'inputs' => 'Data asset tidak boleh kosong.',
            // 'ip' => 'Data IP tidak boleh kosong.',
            'inputs.*.asset_id.unique' => 'Data asset tidak boleh sama',
            'inputs.*.asset_id.required' => 'Data asset tidak boleh kosong',
            'app.*.license_id' => 'Aplikasi tidak boleh kosong.',
            'ip.*.ip' => 'IP tidak boleh kosong.',
            'ip.*.internet_access' => 'Akses internet tidak boleh kosong.',
            'ip.*.gateway' => 'Gateway tidak boleh kosong.',
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
                'stats' => 1,
            ]);

            // Collect unique 'asset_id' values to update 'stats' field later
            $assetIdsToUpdate[] = $value['asset_id'];
        }

        // Update 'stats' field only once for each unique 'asset_id'
        Barang::whereIn('id', array_unique($assetIdsToUpdate))
            ->where('stats', '!=', 2)
            ->update(['stats' => 2]);

        // foreach ($request->ip as $value) {
        //     IpDeployment::create([
        //         'distribution_id' => $distribution_id,
        //         'ip' => $value['ip'],
        //         'internet_access' => $value['internet_access'],
        //         'gateway' => $value['gateway'],
        //     ]);
        // }

        if (! empty($request->ip)) {
            foreach ($request->ip as $value) {
                IpDeployment::create([
                    'distribution_id' => $distribution_id,
                    'ip' => $value['ip'],
                    'internet_access' => $value['internet_access'],
                    'gateway' => $value['gateway'],
                ]);
            }
        }

        if (! empty($request->app)) {
            foreach ($request->app as $value) {
                DistributionApp::create([
                    'distribution_id' => $distribution_id,
                    'license_id' => $value['license_id'],
                ]);
            }
        }


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
        // $decrypt_id = decrypt($id);
        // $distribution = Distribution::find($decrypt_id);
        $distribution = Distribution::find($id);

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
        // $location_room = LocationRoom::all();
        // $user = DetailUser::where('status', '1')->get();
        $user = Employee::where('status', '1')->orderBy('name', 'asc')->get();
        $assets = DistributionAsset::where('distribution_id', $id)->with('asset')->orderBy('created_at', 'desc')->get();
        $ip_deployment = IpDeployment::where('distribution_id', $id)->orderBy('created_at', 'desc')->get();
        $apps = DistributionApp::where('distribution_id', $id)->with('app')->orderBy('created_at', 'desc')->get();
        $division = Division::orderBy('name', 'asc')->get();
        // $department = Department::where('division_id', $employee->division->id)->orderBy('name', 'asc')->get();
        // $section = Section::where('department_id', $employee->department->id)->orderBy('name', 'asc')->get();

        $location_id = Location::orderBy('created_at', 'desc')->get();
        $location_room = LocationRoom::where('sub_location_id', $distribution->location_room->sub_location->id)->orderBy('name', 'asc')->get();
        $sub_location = LocationSub::where('location_id', $distribution->location_room->sub_location->location->id)->orderBy('name', 'asc')->get();
        // $location_room = LocationRoom::orderBy('name', 'asc')->get();

        // $stats = DB::table('distribution_asset')->find($id);

        return view('pages.network.distribution.edit', compact(
            'distribution',
            'location_room',
            'user',
            'apps',
            'assets',
            'ip_deployment',
            'division',
            'location_id',
            'sub_location',
            'location_room',
        ));
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
            // Retrieve the file path directly from the database
            $path_file = Distribution::where('id', $distributionId)->value('file');

            // Delete the distribution
            Distribution::where('id', $distributionId)->delete();

            // Delete the file if it exists
            if ($path_file && Storage::exists($path_file)) {
                Storage::delete($path_file);
            }

            IpDeployment::where('distribution_id', $distributionId)->delete();

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
        // // Validation rules
        // $rules = [
        //     'asset_id' => ['required',
        //         Rule::unique('distribution_assets')->where(function ($query) use ($request) {
        //             return $query->where('distribution_id', $request->id);
        //         }),
        //     ], // Add any other rules you need
        // ];
        $rules = [
            'asset_id' => [
                'required',
                Rule::unique('distribution_assets', 'asset_id')->where(function ($query) use ($request) {
                    return $query->where('distribution_id', $request->id)
                        ->where('stats', '!=', 2);
                }),
            ],
            // Add any other rules you need
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
            'stats' => 1,
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
            $ip_deployments = IpDeployment::where('distribution_id', $id)->orderBy('created_at', 'desc')->get();
            $applications = DistributionApp::where('distribution_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $assets,
                'ip_deployments' => $ip_deployments,
                'apps' => $applications,
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

        // if ($remainingDistributionAssets->count() === 0) {
        //     // Delete the distribution
        //     Distribution::where('id', $distributionId)->delete();
        if ($remainingDistributionAssets->count() === 0) {
            // Retrieve the file path directly from the database
            $path_file = Distribution::where('id', $distributionId)->value('file');

            // Delete the distribution
            Distribution::where('id', $distributionId)->delete();

            // Delete the file if it exists
            if ($path_file && Storage::exists($path_file)) {
                Storage::delete($path_file);
            }

            IpDeployment::where('distribution_id', $distributionId)->delete();

            alert()->success('Success', 'All data has been deleted');
            return redirect()->route('backsite.distribution.index');
        }

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_ip(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $row = Distribution::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.network.distribution.upload_ip', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function store_ip(Request $request)
    {
        // Validation rules
        $rules = [
            'ip' => 'required|max:255',
            'internet_access' => 'required|max:255',
            'gateway' => 'required|max:255',
            // Add any other rules you need
        ];

        // Custom validation messages
        $messages = [
            'ip.required' => 'IP tidak boleh kosong.',
            'internet_access.required' => 'Akses Internet tidak boleh kosong.',
            'gateway.required' => 'Gateway tidak boleh kosong.',
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
        IpDeployment::create([
            'distribution_id' => $request->id,
            'ip' => $request->ip,
            'internet_access' => $request->internet_access,
            'gateway' => $request->gateway,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.distribution.edit', $distribution);
    }

    public function delete_ip($id)
    {
        $ip = IpDeployment::find($id);
        $ip->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function form_app(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $apps = License::all();
            $row = Distribution::find($id);
            $data = [
                'id' => $row['id'],
                'apps' => $apps,
            ];

            $msg = [
                'data' => view('pages.network.distribution.upload_app', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function store_app(Request $request)
    {
        // // Validation rules
        // $rules = [
        //     'ip' => 'required|max:255',
        //     'internet_access' => 'required|max:255',
        //     'gateway' => 'required|max:255',
        //     // Add any other rules you need
        // ];

        // // Custom validation messages
        // $messages = [
        //     'ip.required' => 'IP tidak boleh kosong.',
        //     'internet_access.required' => 'Akses Internet tidak boleh kosong.',
        //     'gateway.required' => 'Gateway tidak boleh kosong.',
        //     // Add custom messages for other rules as needed
        // ];

        // // Validate the request
        // $validator = Validator::make($request->all(), $rules, $messages);

        // // Check if the validation fails
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $distribution = Distribution::find($request->id);
        DistributionApp::create([
            'distribution_id' => $request->id,
            'license_id' => $request->license_id,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.distribution.edit', $distribution);
    }

    public function delete_app($id)
    {
        $app = DistributionApp::find($id);
        $app->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function return ($id)
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

        if ($distributionAsset->stats) {
            $distributionAsset->update(['stats' => 2]);
        } else {
            alert()->error('Error', 'Data gagal di Approve');
            return back();
        }

        // Get the distribution ID
        // $distributionId = $distributionAsset->distribution_id;
        $assetId = $distributionAsset->asset_id;

        //update stats
        $goods = Barang::find($assetId);
        $goods->update(['stats' => 1]);



        // // Check if there's only one distribution asset remaining
        // $remainingDistributionAssets = DistributionAsset::where('distribution_id', $distributionId)->get();

        // if ($remainingDistributionAssets->count() === 0) {
        //     // Retrieve the file path directly from the database
        //     $path_file = Distribution::where('id', $distributionId)->value('file');

        //     // Delete the distribution
        //     Distribution::where('id', $distributionId)->delete();

        //     // Delete the file if it exists
        //     if ($path_file && Storage::exists($path_file)) {
        //         Storage::delete($path_file);
        //     }

        //     IpDeployment::where('distribution_id', $distributionId)->delete();

        // }


        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function filter_barcode(Request $request)
    {
        $id = $request->id;
        $assets = DistributionAsset::with('asset')->get();
        $employee = Employee::orderBy('name', 'asc')->get();
        $locations = LocationRoom::orderBy('name', 'asc')->get();
        // Retrieve filter parameters
        $name = $request->input('name');
        $category = $request->input('category');
        $location = $request->input('location');

        // Query to retrieve filtered assets
        $query = DistributionAsset::with('asset', 'distribution.location_room', 'distribution', 'distribution.employee')->where('stats', 1);
        $barang = Barang::all();

        // Apply filters
        if ($name) {
            $query->whereHas('distribution.employee', function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            });
        }

        if ($category) {
            $query->whereHas('asset', function ($q) use ($category) {
                $q->where('category', '=', $category);
            });
        }

        if ($location) {
            $query->whereHas('distribution.location_room', function ($q) use ($location) {
                $q->where('name', 'like', '%' . $location . '%');
            });
        }

        $assets = $query->get();

        // Filter barang based on asset conditions

        // $barangQuery = Barang::with('distribution_asset.distribution.employee', 'distribution.employee', 'distribution_asset.distribution.location_room', );

        // if ($name) {
        //     // Filter based on exact match of the employee name
        //     $barangQuery->whereHas('distribution.employee', function ($q) use ($name) {
        //         $q->where('name', '=', $name);
        //     });
        // }

        // if ($category) {
        //     $barangQuery->where('category', '=', $category);
        // }

        // if ($location) {
        //     // Filter based on exact match of the employee location
        //     $barangQuery->whereHas('distribution_asset.distribution.location_room', function ($q) use ($location) {
        //         $q->where('name', '=', $location)->latest();
        //     });
        // }

        // $barang = $barangQuery->with('distribution_asset.distribution.employee')->get();

        // Pass the filtered assets to a partial view
        return view('pages.network.distribution.filter-barcode', compact('assets', 'id', 'barang', 'employee', 'locations'));
    }
}


