<?php

namespace App\Http\Controllers\Act_daily;

use App\Models\User;
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
use App\Models\MasterData\Location\LocationRoom;
use App\Http\Requests\Data\Act_daily\StoreActDailyRequest;
use App\Http\Requests\Data\Act_daily\UpdateActDailyRequest;

class ActDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $actdaily = ActDaily::with('work_type', 'detail_user.user')->orderby('start_date', 'desc');

            return DataTables::of($actdaily)
                ->addIndexColumn()

                ->addColumn('action', 'pages/data/act_daily/action_activity')

                ->rawColumns(['action'])
                ->toJson();
        }

        // $actdaily = ActDaily::orderBy('start_date', 'desc')->limit(100)->get();

        return view(
            'pages.data.act_daily.index'
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $executor =  Auth::user()->name;
        $user_id =  Auth::user()->id;
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


        $executor =  Auth::user()->name;
        $user_id =  Auth::user()->id;
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
                'data' => view('pages.data.act_daily.upload_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-daily-activity', $image->getClientOriginalName());
                DailyActivityFile::create([
                    'daily_activity_id' => $request->id,
                    'file'        => $file
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
                'datafile' => $daily_activity_file
            ];

            $msg = [
                'data' => view('pages.data.act_daily.detail_file', $data)->render()
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

    public function action_activity(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = ActDaily::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.act_daily.action_activity', $data)->render()
            ];

            return response()->json($msg);
        }
    }
}
