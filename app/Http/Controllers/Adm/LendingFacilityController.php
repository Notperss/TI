<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Adm\LendingGoods;
use App\Models\Adm\LendingFacility;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Adm\LendingFacility\StoreLendingFacilityRequest;
use App\Http\Requests\Adm\LendingFacility\UpdateLendingFacilityRequest;

class LendingFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $lendingfacility = LendingFacility::orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $lendingfacility = $lendingfacility->whereBetween('date_lend', [$request->from_date, $request->to_date]);
            }


            return DataTables::of($lendingfacility)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    if ($item->stats == 1) {
                        return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.lendingfacility.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.lendingfacility.returning', $item->id) . '">
                    Dikembalikan
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.lendingfacility.edit', $item->id) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.lendingfacility.destroy', encrypt($item->id)) . '" method="POST"
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
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.lendingfacility.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.lendingfacility.returning', $item->id) . '">
                    Dikembalikan
                    </a>
            </div>
                ';
                    }
                })->editColumn('date_return', function ($item) {
                    if ($item->date_return) {
                        return Carbon::parse($item->date_return)->translatedFormat('l, d F Y');
                    } else {
                        return '<span> - </span>';
                    }
                })->editColumn('date_lend', function ($item) {
                    return Carbon::parse($item->date_lend)->translatedFormat('l, d F Y');
                })->editColumn('note', function ($item) {
                    if ($item->note) {
                        return $item->note;
                    } else {
                        return '<span> - </span>';
                    }
                })
                ->rawColumns(['action', 'date_return', 'date_lend', 'note'])
                ->toJson();
        }
        return view("pages.adm.lendingfacility.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $barang = Barang::where('stats', '1')->get();
        $barang = Barang::where('type_assets', 'ASET TI')->where('stats', 1)->orderBy('id', 'asc')->get();
        return view("pages.adm.lendingfacility.create", compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\LendingFacility\StoreLendingFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // get all request from frontsite
        // $data = $request->all();

        // get all request from frontsite
        $data = $request->all();
        $rules = [
            'inputs' => 'required|array',
            // 'inputs.*.goods_id' => 'required|integer|unique:lending_goods,goods_id',
            'date_lend' => 'required|max:255',
            'borrower' => 'required|max:255',
            'description' => 'required|max:255',
            // Add any other rules you need
        ];
        // Custom validation messages
        $messages = [
            'inputs' => 'Data asset tidak boleh kosong.',
            // 'inputs.*.asset_id' => 'Nama barang tidak boleh sama',
            'date_lend.required' => 'tanggal pinjam tidak boleh kosong',
            'date_lend.max' => 'tanggal pinjam terlalu panjang',
            'borrower.required' => 'Peminjam tidak boleh kosong',
            'borrower.max' => 'Nama peminjam terlalu panjang (Maks. 255)',
            'description.required' => 'Keterangan tidak boleh kosong',
            'description.max' => 'Keterangan terlalu panjang (Maks. 255)',
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

        // store to database
        $lendingfacility = LendingFacility::create($data);
        $lendingfacility_id = $lendingfacility->id;

        $assetIdsToUpdate = [];

        foreach ($request->inputs as $key => $value) {
            LendingGoods::create([
                'lendingfacility_id' => $lendingfacility_id,
                'goods_id' => $value['goods_id'],
            ]);

            // Collect unique 'asset_id' values to update 'stats' field later
            $assetIdsToUpdate[] = $value['goods_id'];
        }

        // Update 'stats' field only once for each unique 'asset_id'
        Barang::whereIn('id', array_unique($assetIdsToUpdate))
            ->where('stats', '!=', 2)
            ->update(['stats' => 2]);



        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.lendingfacility.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $lendingfacility = LendingFacility::find($decrypt_id);

        return view('pages.adm.lendingfacility.show', compact('lendingfacility'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lendingfacility = LendingFacility::find($id);
        $lending_goods = LendingGoods::with('barang')->where('lendingfacility_id', $id)->get();
        return view('pages.adm.lendingfacility.edit', compact('lendingfacility', 'lending_goods'));
    }

    public function returning($id)
    {
        $lendingfacility = LendingFacility::find($id);
        $lending_goods = LendingGoods::with('barang')->where('lendingfacility_id', $id)->get();
        return view('pages.adm.lendingfacility.return', compact('lendingfacility', 'lending_goods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\LendingFacility\UpdateLendingFacilityRequest  $request
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLendingFacilityRequest $request, LendingFacility $lendingfacility)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $lendingfacility->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.lendingfacility.index');
    }
    public function returning_update(Request $request, LendingFacility $lendingfacility)
    {
        $data = $request->all();
        $rules = [
            // 'inputs' => 'required|array',
            // 'inputs.*.goods_id' => 'required|integer|unique:lending_goods,goods_id',
            'date_lend' => 'required|max:255',
            'date_return' => 'required|max:255',
            'borrower' => 'required|max:255',
            'description' => 'required|max:255',
            'note' => 'required',
            // Add any other rules you need
        ];
        // Custom validation messages
        $messages = [
            // 'inputs' => 'Data asset tidak boleh kosong.',
            // 'inputs.*.asset_id' => 'Nama barang tidak boleh sama',
            'date_lend.required' => 'tanggal pinjam tidak boleh kosong',
            'date_return.required' => 'tanggal kembali tidak boleh kosong',
            'date_lend.max' => 'tanggal pinjam terlalu panjang',
            'borrower.required' => 'Peminjam tidak boleh kosong',
            'borrower.max' => 'Nama peminjam terlalu panjang (Maks. 255)',
            'description.required' => 'Keterangan tidak boleh kosong',
            'note.required' => 'Catatan tidak boleh kosong',
            'description.max' => 'Keterangan terlalu panjang (Maks. 255)',
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

        $lendingfacility->update($data);

        $id = $lendingfacility->id;
        $goods = LendingGoods::where('lendingfacility_id', $id)->get();
        foreach ($goods as $good) {
            $goods_id = $good->goods_id;
            // Do something with $goods_id if needed

            // Update stats for Barang with the given goods_id
            $barang = Barang::find($goods_id);

            // dd($barang);


            if ($barang) {
                $barang->update(['stats' => 1]);
            } else {
                // Log or redirect with an error message if Barang not found
                return redirect()->route('backsite.lendingfacility.index')->with('error', "Barang not found for asset_id: $asset_id");
            }
        }

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.lendingfacility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\LendingFacility  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $lending = LendingFacility::find($decrypt_id);

        $lending->forceDelete();

        $goods = LendingGoods::where('lendingfacility_id', $decrypt_id)->get();
        foreach ($goods as $good) {
            $goods_id = $good->goods_id;
            // Do something with $goods_id if needed

            // Update stats for Barang with the given goods_id
            $barang = Barang::find($goods_id);

            // dd($barang);


            if ($barang) {
                $barang->update(['stats' => 1]);
            } else {
                // Log or redirect with an error message if Barang not found
                return redirect()->route('backsite.lendingfacility.index')->with('error', "Barang not found for asset_id: $asset_id");
            }
        }

        $goods = LendingGoods::where('lendingfacility_id', $decrypt_id)->forceDelete();


        // Redirect back in both success and error cases
        return redirect()->route('backsite.lendingfacility.index');

    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = LendingFacility::with('barang')->find($id);
            $barang = Barang::where('type_assets', 'ASET TI')->where('stats', 1)->orderBy('id', 'asc')->get();
            $data = [
                'id' => $row['id'],
                'barang' => $barang,
            ];

            $msg = [
                'data' => view('pages.adm.lendingfacility.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        // Validation rules
        $rules = [
            'goods_id' => ['required',
                Rule::unique('lending_goods')->where(function ($query) use ($request) {
                    return $query->where('lendingfacility_id', $request->id);
                }),
            ], // Add any other rules you need
        ];

        // Custom validation messages
        $messages = [
            'goods_id.required' => 'Nama barang tidak boleh kosong.',
            'goods_id.unique' => 'Nama barang tidak boleh sama',
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

        // If validation passes, proceed with your original logic
        $lendingfacility = LendingFacility::find($request->id);

        LendingGoods::create([
            'lendingfacility_id' => $request->id,
            'goods_id' => $request->goods_id,
        ]);

        $goods = Barang::find($request->goods_id);
        $goods->update(['stats' => 2]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.lendingfacility.edit', $lendingfacility);
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $lendinggoods = Lendinggoods::where('lendingfacility_id', $id)->with('barang')->get();
            $data = [
                'datafile' => $lendinggoods,
            ];

            $msg = [
                'data' => view('pages.adm.lendingfacility.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {

        $lendingGoods = LendingGoods::find($id);

        if (! $lendingGoods) {
            // Handle the case where the distribution asset is not found
            // ...
            alert()->error('Error', 'Distribution Asset not found.');
            return redirect()->route('backsite.distribution.index');
        }

        // Get the distribution ID 
        $goodsId = $lendingGoods->goods_id;

        //update stats
        $goods = Barang::find($goodsId);
        $goods->update(['stats' => 1]);

        $lendingGoods->delete();


        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
