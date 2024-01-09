<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\PP;
use App\Models\Adm\Pp_file;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\PP\StorePPRequest;
use App\Http\Requests\Adm\PP\UpdatePPRequest;
use App\Models\Adm\Pp_status;

class PPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {



            $user = auth()->user()->detail_user;
            $isManagerOrViceManager = $user->job_position === 1 || $user->job_position === 3 || $user->nik === 'M0203002';

            $ppQuery = $isManagerOrViceManager ? PP::orderBy('created_at', 'desc') : PP::where('user_id', $user->job_position)->orderBy('created_at', 'desc');

            $pp = $ppQuery->get();


            if ($request->filled('from_date') && $request->filled('to_date')) {
                $pp = $pp->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($pp)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $action = '
        <div class="container">
            <div class="btn-group mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.pp.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data PP" class="dropdown-item">
                        Show
                    </a>';

                    $user = auth()->user()->detail_user;
                    $Access = $user->job_position === 1 || $user->nik === 'M0203002';

                    if ($item->stats == 1 || $Access) {
                        $action .= '<a class="dropdown-item" href="' . route('backsite.pp.edit', encrypt($item->id)) . '">
                        Edit
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.bill.create_bill', $item->id) . '">
                        Tambah tagihan
                    </a>
                    <form action="' . route('backsite.pp.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
        </div>';
                    }
                    if ($Access) {
                        $action .= '<form action="' . route('backsite.pp.approve', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('PUT') . csrf_field() . '
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                     <input type="submit" 
                        title="Approve/Cancel approve" class="btn btn-sm btn-' . ($item->stats == 1 ? 'success' : 'danger') . ' w-100" value="' . ($item->stats == 1 ? 'Approve' : 'Cancel-Approve') . '">
                    </form>';
                    }
                    return $action;
                })->editColumn('date', function ($item) {
                    return Carbon::parse($item->date)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action', 'date'])
                ->toJson();
        }
        return view("pages.adm.pp.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->detail_user->job_position;
        return view("pages.adm.pp.create", compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\StorePPRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePPRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $pp = PP::create($data);
        $pp_id = $pp->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.pp.edit', encrypt($pp_id));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        return view('pages.adm.pp.show', compact('pp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);
        $datafile = Pp_file::where('pp_id', $decrypt_id)->get();
        $data = Pp_status::where('pp_id', $decrypt_id)->get();
        return view('pages.adm.pp.edit', compact('pp', 'datafile', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\UpdatePPRequest  $request
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePPRequest $request, PP $pp)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $pp->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.pp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        $pp->forceDelete();

        $pp_file = Pp_file::where('pp_id', $decrypt_id)->get();
        // hapus file
        foreach ($pp_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }

        }
        $pp_file = Pp_file::where('pp_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
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
                'data' => view('pages.adm.pp.upload_file', $data)->render(),
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
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-pp', $fullname);
                Pp_file::create([
                    'pp_id' => $request->id,
                    'name_file' => $request->name_file,
                    'type_file' => $request->type_file,
                    'description_file' => $request->description_file,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil disimpan');
        return back();
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
        $pp_file = Pp_file::find($id);

        // cari old photo
        $path_file = $pp_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $pp_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = PP::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.pp.upload_status', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function add_status(Request $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-pp', $fullname);
                Pp_status::create([
                    'pp_id' => $request->id,
                    'type_status' => $request->type_status,
                    'date' => $request->date,
                    'description' => $request->description,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil disimpan');
        return back();
    }

    // get show_file software
    public function show_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_status = Pp_status::where('pp_id', $id)->get();
            $data = [
                'datafile' => $pp_status,
            ];

            $msg = [
                'data' => view('pages.adm.pp.detail_status', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function delete_status($id)
    {
        $pp_status = Pp_status::find($id);

        // cari old photo
        $path_file = $pp_status['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $pp_status->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);
        if ($pp->stats == 1) {
            $pp->update(['stats' => 2]);
        } elseif ($pp->stats == 2) {
            $pp->update(['stats' => 1]);
        } else {
            alert()->error('Error', 'Data gagal di Approve');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil di Approve');
        return back();

    }

}
