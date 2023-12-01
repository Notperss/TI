<?php

namespace App\Http\Controllers\Network\Distribution;

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
    public function index()
    {
        if (request()->ajax()) {

            // $distribution = Distribution::with('location_room', 'detail_user.user', 'distribution')->orderby('created_at', 'desc');
            $distribution = DistributionAsset::
                with('distribution.detail_user.user', 'asset', 'distribution.location_room', )
                ->orderby('created_at', 'desc');
            return DataTables::of($distribution)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.distribution.show', encrypt($item->distribution->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data IP Phone" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.distribution.edit', $item->distribution->id) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.distribution.destroy', encrypt($item->distribution->id)) . '" method="POST"
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
            })

                ->rawColumns(['asset.barcode', 'action', 'asset.name'])
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
        return view('pages.network.distribution.create', compact('location_room', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Network\Distribution\StoreDistributionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributionRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-distribution', $fullname);
        }
        // store to database
        $distribution = Distribution::create($data);
        $distribution_id = $distribution->id;

        DistributionAsset::create([
            'distribution_id' => $distribution_id,
        ]);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.distribution.edit', $distribution_id);
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
        $location_room = LocationRoom::all();
        $user = DetailUser::where('status', '1')->get();
        return view('pages.network.distribution.show', compact('distribution', 'location_room', 'user'));
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
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $distribution = Distribution::find($decrypt_id);

        // cari old photo
        $path_file = $distribution['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $distribution->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

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

    public function delete_file($id)
    {
        $file = DistributionAsset::find($id);
        $file->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
