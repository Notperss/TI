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
    public function index()
    {
        if (request()->ajax()) {

            $lendingfacility = LendingFacility::orderby('created_at', 'desc');

            return DataTables::of($lendingfacility)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.lendingfacility.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
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
                })->editColumn('date_return', function ($item) {
                return Carbon::parse($item->date_return)->translatedFormat('l, d F Y');
            })->editColumn('date_lend', function ($item) {
                return Carbon::parse($item->date_lend)->translatedFormat('l, d F Y');
            })
                ->rawColumns(['action', 'date_return', 'date_lend'])
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
        return view("pages.adm.lendingfacility.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\LendingFacility\StoreLendingFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLendingFacilityRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $lendingfacility = LendingFacility::create($data);
        $lendingfacility_id = $lendingfacility->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.lendingfacility.edit', $lendingfacility_id);


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
        $lendingfacility = LendingFacility::find($decrypt_id);

        $lendingfacility->forceDelete();

        $lending_goods = LendingGoods::where('lendingfacility_id', $decrypt_id)->get();
        // hapus file
        foreach ($lending_goods as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }

        }
        $lending_goods = LendingGoods::where('lendingfacility_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = LendingFacility::with('barang')->find($id);
            $barang = Barang::orderBy('id', 'asc')->get();
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
        $lendingGoods->delete();


        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
