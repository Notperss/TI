<?php

namespace App\Http\Controllers\Adm;

use App\Models\Adm\PP;
use App\Models\Adm\Bill;
use App\Models\Adm\Pp_file;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\Bill\StoreBillRequest;
use App\Http\Requests\Adm\Bill\UpdateBillRequest;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $pp = PP::orderby('created_at', 'desc');

            return DataTables::of($pp)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="' . route('backsite.bill.create_bill', $item->id) . '">
                        Tambah Tagihan </a>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }
        return view("pages.adm.bill.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\Bill\StoreBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-bill', $image->getClientOriginalName());
                Bill::create([
                    'pp_id' => $request->id,
                    'bill_to' => $request->bill_to,
                    'bill_value' => $request->bill_value,
                    'date' => $request->date,
                    'description' => $request->description,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.bill.create_bill', $pp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);
        $filepath = storage_path($bill->file);
        $fileName = basename($filepath);
        return view('pages.adm.bill.edit', compact('bill', 'fileName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\Bill\UpdateBillRequest  $request
     * @param  \App\Models\Adm\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $bill['file'];

        // upload process here
        if ($request->hasFile('file')) {

            $data['file'] = $request->file('file')->storeAs('assets/file-bill', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $bill->update($data);

        $pp_id = $bill->pp_id;

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.bill.create_bill', $pp_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = PP::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.bill.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-pp', $image->getClientOriginalName());
                Pp_file::create([
                    'pp_id' => $request->id,
                    'name_file' => $request->name_file,
                    'type_file' => $request->type_file,
                    'description_file' => $request->description_file,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.pp.edit', $pp);
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_file = Pp_file::where('pp_id', $id)->get();
            $data = [
                'datafile' => $pp_file,
            ];

            $msg = [
                'data' => view('pages.adm.pp.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $bill = Bill::find($id);

        // cari old photo
        $path_file = $bill['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $bill->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
    public function create_bill(Request $request)
    {
        $id = $request->id;
        $pp = PP::find($id);
        $datafile = Pp_file::where('pp_id', $id)->get();
        $bills = Bill::where('pp_id', $id)->get();
        return view('pages.adm.bill.create_bill', compact('pp', 'datafile', 'bills'));
    }
}
