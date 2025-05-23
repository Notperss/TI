<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Adm\Form;
use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ManagementAccess\DetailUser;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $attendance = Attendance::with('user')->orderby('start_date', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $attendance = $attendance->whereBetween('start_date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {

                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
                        <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.attendance.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Absensi" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.attendance.edit', encrypt($item->id)).'" 
                    '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                        Edit
                                </a>
                    <form action="'.route('backsite.attendance.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete" '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
            </div>
            </div>
                    <form action="'.route('backsite.attendance.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="
                    '.($item->stats == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'
                    ">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-sm btn-'.($item->stats == 1 ? 'success' : 'danger').' w-100" value="'.($item->stats == 1 ? 'Close' : 'Open').'"
                        '.(($isAdmin || ($item->stats == 1 && Auth::user()->jobPosition->name == 'Administrasi')) ? '' : 'hidden').'>
                    </form>
                ';
                })
                ->editColumn('start_date', function ($item) {
                    return Carbon::parse($item->start_date)->translatedFormat('d-m-Y');
                })
                ->editColumn('finish_date', function ($item) {
                    return Carbon::parse($item->finish_date)->translatedFormat('d-m-Y');
                })
                ->editColumn('category', function ($item) {

                    $dataFile = 'data-fancybox  title="Lihat File"
                                data-src="'.asset('storage/'.$item->file).'"';

                    if ($item->category === '0') {
                        return '<span>N/A</span>';
                    } elseif ($item->category === 'Absen') {
                        return '<h5><span type="button" class="badge bg-danger" '.$dataFile.'>Absen</span></h5>';
                    } elseif ($item->category === 'Sakit') {
                        return '<h5><span type="button" class="badge bg-warning" '.$dataFile.'>Sakit</span></h5>';
                    } elseif ($item->category === 'Dinas') {
                        return '<h5><span type="button" class="badge bg-info" '.$dataFile.'>Dinas</span></h5>';
                    } elseif ($item->category === 'Cuti') {
                        return '<h5><span type="button" class="badge bg-secondary" '.$dataFile.'>Cuti</span></h5>';
                    } else {
                        return '<h5><span type="button" class="badge bg-default" '.$dataFile.'>'.$item->category.'</span></h5>';
                    }
                })
                ->rawColumns(['action', 'category'])
                ->toJson();
        }

        return view('pages.adm.attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where(['name', '!=', 'Administrator'],[DetailUser::where('status','1')])->orderBy('name', 'asc')->get();
        $user = DetailUser::where('status', '1')->get();
        $forms = Form::where('category', 'ABSENSI')->orderby("created_at", "desc")->get();

        return view('pages.adm.attendance.create', compact('user', 'forms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-attendance', $fullname);
        }
        // store to database
        Attendance::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.attendance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $attendance = Attendance::find($decrypt_id);


        return view('pages.adm.attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $attendance = Attendance::find($decrypt_id);
        // $users = User::where(['name', '!=', 'Administrator'], ['status', '1'])->orderBy('name', 'asc')->get();
        $users = DetailUser::where('status', '1')->get();
        $forms = Form::where('category', 'ABSENSI')->orderby("created_at", "desc")->get();

        return view('pages.adm.attendance.edit', compact('attendance', 'users', 'forms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceRequest  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $attendance['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-attendance', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $attendance->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $attendance = Attendance::find($decrypt_id);

        // cari old photo
        $path_file = $attendance['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $attendance->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $attendance = Attendance::find($decrypt_id);
        if ($attendance->stats == 1) {
            $attendance->update(['stats' => 2]);
        } else if ($attendance->stats == 2) {
            $attendance->update(['stats' => 1]);
        } else {
            alert()->error('Error', 'Data gagal di ubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil di ubah');
        return back();

    }
}
