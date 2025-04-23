<?php

namespace App\Http\Controllers\Act_daily;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Act_daily\Workcat;
use App\Models\Act_daily\ActDaily;
use App\Models\Data\DailyActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Data\DailyActivityFile;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterData\Work\WorkType;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Console\View\Components\Confirm;
use App\Models\MasterData\Location\LocationRoom;
use App\Http\Requests\Data\Act_daily\StoreActDailyRequest;
use App\Http\Requests\Data\Act_daily\UpdateActDailyRequest;
use App\Models\ManagementAccess\DetailUser;

class ActDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $actdaily = ActDaily::with('work_type', 'user')->orderby('start_date', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $actdaily = $actdaily->whereBetween('start_date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($actdaily)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
                    <div class="container">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn btn-cyan btn-sm" title="Tambah File" onclick="upload('.$item->id.')" 
                            '.(Auth::user()->id == $item->executor && $item->status == 1 || $isAdmin ? '' : 'hidden').'><i
                                    class="bx bx-file"></i></button>
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <a href="#mymodal" data-remote="'.route('backsite.act_daily.show', $item->id).'" data-toggle="modal"
                                    data-target="#mymodal" data-title="Detail Aktivitas Harian" class="dropdown-item">
                                    Show
                                </a>
                                <a class="dropdown-item" href="'.route('backsite.act_daily.edit', $item->id).'"
                                '.(Auth::user()->id == $item->executor && $item->status == 1 || $isAdmin ? '' : 'hidden').'>
                                Edit </a>
                            <form action="'.route('backsite.act_daily.destroy', $item->id).'" method="POST"
                            onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                                '.method_field('delete').csrf_field().'
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="submit" class="dropdown-item" value="Delete" '.(Auth::user()->id == $item->executor && $item->status == 1 || $isAdmin ? '' : 'hidden').'>
                            </form>
                            </div>
                        </div>
                    </div>

                    <form action="'.route('backsite.act_daily.approve', encrypt($item->id)).'" method="POST"
                            onsubmit="'.($item->status == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'">
                                '.method_field('PUT').csrf_field().'
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="submit"
                                title="approve" class="btn btn-sm btn-'.($item->status == 1 ? 'success' : 'danger').' w-100" value="'.($item->status == 1 ? 'Close' : 'Open').'" 
                                '.(Auth::user()->id == $item->executor && $item->status == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
                            ';
                    //             if ($item->status == '1' || Auth::user()->hasRole('super-admin')) {
                    //                 $actionAdmin .= '<a class="dropdown-item" href="'.route('backsite.act_daily.edit', $item->id).'">
                    //             Edit </a>
                    //         <form action="'.route('backsite.act_daily.destroy', $item->id).'" method="POST"
                    //         onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                    //             '.method_field('delete').csrf_field().'
                    //             <input type="hidden" name="_method" value="DELETE">
                    //             <input type="hidden" name="_token" value="'.csrf_token().'">
                    //             <input type="submit" class="dropdown-item" value="Delete">
                    //         </form>
                    //         </div>
                    //         </div>';
                    //         if (Auth::user()->hasRole('super-admin') || Auth::user()->id == $item->executor) {
                    //             $actionAdmin = '
                    // <div class="container">
                    //     <div class="btn-group mb-1">
                    //     <button type="button" class="btn btn-cyan btn-sm" title="Tambah File" onclick="upload('.$item->id.')"><i
                    //             class="bx bx-file"></i></button>
                    //     <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    //         aria-expanded="false">Action</button>
                    //     <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    //         <a href="#mymodal" data-remote="'.route('backsite.act_daily.show', $item->id).'" data-toggle="modal"
                    //             data-target="#mymodal" data-title="Detail Aktivitas Harian" class="dropdown-item">
                    //             Show
                    //         </a>';
                    //             if ($item->status == '1' || Auth::user()->hasRole('super-admin')) {
                    //                 $actionAdmin .= '<a class="dropdown-item" href="'.route('backsite.act_daily.edit', $item->id).'">
                    //             Edit </a>
                    //         <form action="'.route('backsite.act_daily.destroy', $item->id).'" method="POST"
                    //         onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                    //             '.method_field('delete').csrf_field().'
                    //             <input type="hidden" name="_method" value="DELETE">
                    //             <input type="hidden" name="_token" value="'.csrf_token().'">
                    //             <input type="submit" class="dropdown-item" value="Delete">
                    //         </form>
                    //         </div>
                    //         </div>
    
                    //         <form action="'.route('backsite.act_daily.approve', encrypt($item->id)).'" method="POST"
                    //         onsubmit="'.($item->status == 1 ? 'return confirm(\'Are You Sure Want to Approve?\')' : 'return confirm(\'Are You Sure Want to Cancel Approve?\')').'">
                    //             '.method_field('PUT').csrf_field().'
                    //             <input type="hidden" name="_method" value="PUT">
                    //             <input type="hidden" name="_token" value="'.csrf_token().'">
                    //             <input type="submit" 
                    //             title="Approve/Cancel approve" class="btn btn-sm btn-'.($item->status == 1 ? 'success' : 'danger').' w-100" value="'.($item->status == 1 ? 'Approve' : 'Cancel-Approve').'">
                    //         </form>
    
                    //     ';
                    //             }
                    //             return $actionAdmin;
                    //         } else {
                    //             if ($item->status == '1' && ! Auth::user()->hasRole('super-admin')) {
                    //                 return '
                    // <div class="btn-group mr-1 mb-1">
                    //     <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    //         aria-expanded="false">Action</button>
                    //     <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    //         <a href="#mymodal" data-remote="'.route('backsite.act_daily.show', $item->id).'" data-toggle="modal"
                    //             data-target="#mymodal" data-title="Detail Data Absensi" class="dropdown-item">Show</a>
                    // </div>';
                    //             } else if ($item->status == '2') {
                    //                 return '
                    // <div class="btn-group mr-2 mb-1">
                    //     <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    //         aria-expanded="false">Action</button>
                    //     <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    //         <a href="#mymodal" data-remote="'.route('backsite.act_daily.show', $item->id).'" data-toggle="modal"
                    //             data-target="#mymodal" data-title="Detail Data Absensi" class="dropdown-item">Show</a>
                    //     </div>
                    // </div>';
                    //             } else {
                    //                 return '  <form action="'.route('backsite.act_daily.destroy', encrypt($item->id)).'" method="POST"
                    //         onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                    //             '.method_field('delete').csrf_field().'
                    //             <input type="hidden" name="_method" value="DELETE">
                    //             <input type="hidden" name="_token" value="'.csrf_token().'">
                    //             <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                    //         </form>';
                    //             }
                    //         }
                })->editColumn('start_date', function ($item) {
                    return Carbon::parse($item->start_date)->translatedFormat('l, d F Y');
                })->editColumn('finish_date', function ($item) {
                    return Carbon::parse($item->finish_date)->translatedFormat('l, d F Y');
                })->editColumn('executor', function ($item) {
                    // $detail_user = DetailUser::where($item->executor);
                    $user_id = $item->executor; // Assuming $item->executor contains the user ID
    
                    $user = User::find($user_id);

                    if ($user) {
                        return $user->name;
                    } else {
                        return '<span>N/A</span>';
                    }
                })
                ->rawColumns(['action', 'start_date', 'finish_date', 'executor'])
                ->toJson();
        }

        // $actdaily = ActDaily::orderBy('start_date', 'desc')->limit(100)->get();

        return view('pages.data.act_daily.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $executor = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
        $work_type = Workcat::latest()->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();
        $actdaily = ActDaily::orderBy('created_at', 'desc')->get();

        return view('pages.data.act_daily.create', compact('executor', 'user_id', 'user', 'work_type', 'location_room', 'actdaily'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActDailyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActDailyRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        ActDaily::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.act_daily.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActDaily  $actDaily
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        // $decrypt_id = decrypt($id);
        // $actdaily = DailyActivity::find($decrypt_id);

        $actdaily = ActDaily::find($id);

        return view('pages.data.act_daily.show', compact('actdaily'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActDaily  $actDaily
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $decrypt_id = decrypt($id);
        // $actdaily = DailyActivity::find($decrypt_id);

        $actdaily = ActDaily::find($id);


        $executor = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
        $work_type = Workcat::latest()->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();

        return view('pages.data.act_daily.edit', compact(
            'executor',
            'user_id',
            'user',
            'work_type',
            'location_room',
            'actdaily'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActDailyRequest  $request
     * @param  \App\Models\ActDaily  $actDaily
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActDailyRequest $request, ActDaily $actDaily)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $actDaily->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.act_daily.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActDaily  $actDaily
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        // $decrypt_id = decrypt($id);
        // $actdaily = DailyActivity::find($decrypt_id);

        // dd($id);
        $actdaily = ActDaily::findOrFail($id);
        // hapus daily activity
        $actdaily->forceDelete();

        // get file daily activity
        $daily_activity_file = DailyActivityFile::where('daily_activity_id', $id)->get();
        // hapus file
        foreach ($daily_activity_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }
        }

        // delete data file daily activity
        $daily_activity_file = DailyActivityFile::where('daily_activity_id', $id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = ActDaily::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.act_daily.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-daily-activity', $fullname);

                DailyActivityFile::create([
                    'daily_activity_id' => $request->id,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.act_daily.index');
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $daily_activity_file = DailyActivityFile::where('daily_activity_id', $id)->get();
            $data = [
                'datafile' => $daily_activity_file,
            ];

            $msg = [
                'data' => view('pages.data.act_daily.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $daily_activity_file = DailyActivityFile::find($id);

        // cari old photo
        $path_file = $daily_activity_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $daily_activity_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // public function action_activity(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id = $request->id;

    //         $row = ActDaily::find($id);
    //         $data = [
    //             'id' => $row['id'],
    //         ];

    //         $msg = [
    //             'data' => view('pages.data.act_daily.action_activity', $data)->render(),
    //         ];

    //         return response()->json($msg);
    //     }
    // }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $act_daily = ActDaily::find($decrypt_id);
        if ($act_daily->status == 1) {
            $act_daily->update(['status' => 2]);
        } elseif ($act_daily->status == 2) {
            $act_daily->update(['status' => 1]);
        } else {
            alert()->error('Error', 'Data gagal di Approve');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil di Approve');
        return back();

    }
}
