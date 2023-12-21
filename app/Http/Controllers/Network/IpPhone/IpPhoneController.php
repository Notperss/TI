<?php

namespace App\Http\Controllers\Network\IpPhone;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Goods\Barang;
use App\Models\Network\IpPhone\IpPhone;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Network\Distribution\IpDeployment;
use App\Models\Network\Distribution\DistributionAsset;
use App\Http\Requests\Network\IpPhone\StoreIpPhoneTRequest;
use App\Http\Requests\Network\IpPhone\UpdateIpPhoneTRequest;

class IpPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $ip_phone = IpPhone::with('distribution_asset.asset', 'distribution_asset.distribution.location_room')->orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $ip_phone = $ip_phone->whereBetween('installation_date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($ip_phone)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    if ($item->stats == 1) {
                        return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.ip_phone.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data IP Phone" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.ip_phone.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.ip_phone.returning_update', $item->id) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Update?\')">
                        ' . method_field('PUT') . csrf_field() . '
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Dikembalikan">
                    </form>
                    <form action="' . route('backsite.ip_phone.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                    } else {
                        return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.ip_phone.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data IP Phone" class="dropdown-item">
                        Show
                    </a>
            </div>
                ';
                    }
                })->editColumn('installation_date', function ($item) {
                    return Carbon::parse($item->installation_date)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action', 'installation_date'])
                ->toJson();
        }

        return view('pages.network.ip_phone.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $distribution_id = $request->distribution_id;

        $distributionAsset = DistributionAsset::
            with(
                ['asset' => function ($query) {
                    $query
                        ->where('stats', 2)
                        ->where('category', '=', 'IP PHONE');
                },
                    'distribution' => function () {
                        // IpDeployment::where('distribution_id', $request->distribution_id)->get();
                    },
                    'ip_deployment' => function ($query) use ($distribution_id) {

                        $query->where('distribution_id', $distribution_id);
                    },
                ])
            // ['asset', 'distribution'])
            // ->with('distribution')
            ->orderBy('id', 'asc')->get();

        // $distribution = Distribution::with('ip');

        return view('pages.network.ip_phone.create', compact('distributionAsset'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Network\IpPhone\StoreIpPhoneTRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIpPhoneTRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-ip_phone', $fullname);
        }
        // store to database
        $ipPhone = IpPhone::create($data);
        $assetId = $ipPhone->distribution_asset->asset_id;


        // Update 'stats' field only once for each unique 'asset_id'
        Barang::where('id', $assetId)
            ->where('stats', '!=', 6)
            ->update(['stats' => 6]);





        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.ip_phone.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone  $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);

        return view('pages.network.ip_phone.show', compact('ip_phone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone  $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);

        $distributionAsset = DistributionAsset::
            with(
                ['asset' => function ($query) {
                    // $query->where('stats', 2);
                },
                    'distribution',
                    'ip_deployment',
                ])
            ->orderBy('id', 'asc')->get();

        return view('pages.network.ip_phone.edit', compact('ip_phone', 'distributionAsset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Network\IpPhone\UpdateIpPhoneTRequest  $request
     * @param  \App\Models\Network\IpPhone\IpPhone $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIpPhoneTRequest $request, IpPhone $ip_phone)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $ip_phone['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-ip_phone', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // $stats = $ip_phone->distribution_asset->asset['stats'];

        // // $assetId = $stats->distribution_asset->asset_id;

        // if ($stats == 6) {
        //     //update stats
        //     $goods = Barang::find($ip_phone->distribution_asset->asset->id);
        //     $goods->update(['stats' => 2]);
        // }

        // Update to database
        $ip_phone->update($data);

        //update stats
        // $goodsId = Barang::find($ip_phone->distribution_asset->asset->id);
        // Update for new data
        Barang::where('id', $ip_phone->distribution_asset->asset->id)->update(['stats' => 6]);

        // Update for old data
        Barang::where('id', '<>', $ip_phone->distribution_asset->asset->id)->update(['stats' => 2]);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.ip_phone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);

        // cari old photo
        $path_file = $ip_phone['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        //update stats
        $goods = Barang::find($ip_phone->distribution_asset->asset->id);
        $goods->update(['stats' => 2]);

        // hapus location
        $ip_phone->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function getIp(Request $request)
    {
        // $distributionId = $request->input('distribution_id');
        // $getIp = IpDeployment::where('distribution_id', $distributionId)->get();
        $distributionDataId = $request->input('distribution_data_id');
        $getIp = IpDeployment::where('distribution_id', $distributionDataId)->get();
        return response()->json($getIp);
    }

    public function returning_update(IpPhone $ipPhone)
    {

        $ipPhone->update(['stats' => 2]);

        $assetId = $ipPhone->distribution_asset->asset_id;
        // Update 'stats' field only once for each unique 'asset_id'
        Barang::where('id', $assetId)
            ->where('stats', '!=', 2)
            ->update(['stats' => 2]);


        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.ip_phone.index');
    }
}
