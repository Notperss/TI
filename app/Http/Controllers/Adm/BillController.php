<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\PP;
use App\Models\Adm\Bill;
use App\Models\Adm\Pp_file;
use Illuminate\Support\Str;
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
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $bill = Bill::with('pp')->orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $bill = $bill->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($bill)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="' . route('backsite.bill.edit', $item->id) . '">
                        Edit </a>
                        <form action="' . route('backsite.bill.hapus_file', $item->id ?? '') . '" method="POST"
                onsubmit="return confirm(\'Anda yakin ingin menghapus data ini ?\');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="submit" id="delete_file" class="dropdown-item" value="Delete">
            </form>
            </div>
                ';
                })->editColumn('file', function ($item) {
                    return '<a type="button" data-fancybox
                                data-src="' . asset('storage/' . $item->file) . '"
                                class="btn btn-info btn-sm text-white ">
                                Lihat
                            </a>
                            <a type="button" href="' . asset('storage/' . $item->file) . '"
                                class="btn btn-primary btn-sm" download>
                                Unduh
                            </a>
                                ';
                })
                ->editColumn('date', function ($item) {
                    return Carbon::parse($item->date)->translatedFormat('l, d F Y');
                })
                ->editColumn('pp.no_pp', function ($item) {
                    return '
                    <a  style="text-decoration: none; color: inherit;"  title="Lihat Semua Tagihan"
                        href="' . route('backsite.bill.create_bill', $item->pp_id) . '" >' . $item->pp->no_pp . '</a>
                    ';

                })
                ->rawColumns(['action', 'file', 'date', 'pp.no_pp',])
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
        $pp = PP::orderBy("created_at", "desc")->get();
        return view("pages.adm.bill.create", compact('pp'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\Bill\StoreBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-bill', $fullname);
        }
        // store to database
        Bill::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.bill.index');
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
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-bill', $fullname);
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
        return redirect()->route('backsite.bill.index');
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

    public function store_bill(Request $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-bill', $fullname);
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

}
