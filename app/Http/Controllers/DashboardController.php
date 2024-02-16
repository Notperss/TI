<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Maintenance\Maintenance;
use App\Models\ManagementAccess\DetailUser;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\DB;

// use model here
use App\Models\MasterData\Network\Cctv;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $detail_user = DetailUser::all();
        // $cctv = Cctv::all()->toJson();

        // $daily_activity = DB::table('daily_activity')
        //     ->leftJoin('users as a', 'daily_activity.executor', '=', 'a.id')
        //     ->leftJoin('users as b', 'daily_activity.users_id', '=', 'b.id')
        //     ->leftJoin('detail_user', 'daily_activity.executor', '=', 'detail_user.user_id')
        //     ->leftJoin('work_category', 'daily_activity.work_category_id', '=', 'work_category.id')
        //     ->leftJoin('work_type', 'daily_activity.work_type_id', '=', 'work_type.id')
        //     // ->leftJoin('location_room', 'daily_activity.location_room_id', '=', 'location_room.id')
        //     ->whereDate('start_date', date('Y-m-d'))
        //     ->select('daily_activity.*', 'a.name as executor', 'b.name as users_id', 'detail_user.icon as icon', 'work_category.name as work_category_id', 'work_type.name as work_type_id', 'location_room.name as location_room_id', 'location_room.latitude', 'location_room.longitude')
        //     ->get()
        //     ->toJson();

        $attendances = Attendance::orderBy('start_date', 'desc')->limit(5)->get();
        $modelMaintenance = Maintenance::with('employee', 'asset_barcode')->orderBy('date', 'desc')->get();

        $maintenances = $modelMaintenance->where('stats', 1)->take(5);
        // $totalMalfunction = $modelMaintenance->where('goods_id', $modelMaintenance->goods_id)->orderBy('date', 'desc')->get();
        $totalMalfunctions = Maintenance::select('barcode', 'asset_name', DB::raw('count(*) as count'))
            ->groupBy('barcode', 'asset_name')
            ->orderByRaw('barcode IS NULL, count DESC')
            ->take(5)
            ->get();
        return view('pages.dashboard.index', compact('attendances', 'maintenances', 'totalMalfunctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
