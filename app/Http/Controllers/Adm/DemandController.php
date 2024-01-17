<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\Demand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\Demand\StoreDemandRequest;
use App\Http\Requests\Adm\Demand\UpdateDemandRequest;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $demand = Demand::orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $demand = $demand->whereBetween('date_demand', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($demand)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.demand.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Absensi" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.demand.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.demand.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->editColumn('date_demand', function ($item) {
                    return Carbon::parse($item->date_demand)->translatedFormat('l, d F Y');
                })
                ->editColumn('date_pj', function ($item) {
                    if ($item->date_pj) {
                        return '<span class="badge badge-success">Selesai</span>';
                    } else {
                        return '<span class="badge badge-danger">Proccess</span>';
                    }
                })
                ->rawColumns(['action', 'date_demand', 'date_pj'])
                ->toJson();
        }

        return view('pages.adm.demand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where(['name', '!=', 'Administrator'],[DetailUser::where('status','1')])->orderBy('name', 'asc')->get();
        return view('pages.adm.demand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\Demand\StoreDemandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDemandRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-demand', $fullname);
        }
        // upload process here
        if ($request->hasFile('file_pj')) {
            $files = $request->file('file_pj');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file_pj'] = $request->file('file_pj')->storeAs('assets/file-demand', $fullname);
        }

        // store to database
        Demand::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.demand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $demand = Demand::find($decrypt_id);


        return view('pages.adm.demand.show', compact('demand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $demand = Demand::find($decrypt_id);
        $filepath = storage_path($demand->file);
        $filepathPj = storage_path($demand->file_pj);
        $fileName = basename($filepath);
        $fileNamePj = basename($filepathPj);
        return view('pages.adm.demand.edit', compact('demand', 'fileName', 'fileNamePj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\Bill\UpdateBillRequest  $request
     * @param  \App\Models\Adm\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemandRequest $request, Demand $demand)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $demand['file'];
        $path_file_pj = $demand['file_pj'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-demand', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // upload process here
        if ($request->hasFile('file_pj')) {
            $files = $request->file('file_pj');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file_pj'] = $request->file('file_pj')->storeAs('assets/file-demand', $fullname);
            // hapus file
            if ($path_file_pj != null || $path_file_pj != '') {
                Storage::delete($path_file_pj);
            }
        } else {
            $data['file_pj'] = $path_file_pj;
        }


        // update to database
        $demand->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.demand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $demand = Demand::find($decrypt_id);

        // cari old photo
        $path_file = $demand['file'];
        $path_file_pj = $demand['file_pj'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }
        if ($path_file_pj != null || $path_file_pj != '') {
            Storage::delete($path_file_pj);
        }

        // hapus location
        $demand->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
