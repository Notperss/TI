<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\ManagementAccess\DetailUser;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $attendance = Attendance::with('detail_user.user')->orderby('created_at', 'desc');

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.attendance.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Aktivitas Harian" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.attendance.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.attendance.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->editColumn('start_date', function ($item) {
                    return Carbon::parse($item->start_date)->translatedFormat('l, d F Y');
                })
                ->editColumn('finish_date', function ($item) {
                    return Carbon::parse($item->finish_date)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action',])
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
        return view('pages.adm.attendance.create', compact('user'));
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
            $data['file'] = $request->file('file')->store('storage/app/assets/file-attendance');
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
        return view('pages.adm.attendance.edit', compact('attendance', 'users'));
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

            $data['file'] = $request->file('file')->store('storage/app/assets/file-attendance');
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
}
