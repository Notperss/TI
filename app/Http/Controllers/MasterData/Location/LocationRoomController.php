<?php

namespace App\Http\Controllers\MasterData\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// request
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Location\Location;

// use model here
use App\Models\MasterData\Location\LocationRoom;
use App\Http\Requests\MasterData\Location\LocationRoom\StoreLocationRoomRequest;
use App\Http\Requests\MasterData\Location\LocationRoom\UpdateLocationRoomRequest;
use App\Models\MasterData\Location\LocationSub;

class LocationRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $location_room = LocationRoom::with('location', 'sub_location')->orderby('created_at', 'desc');

            return DataTables::of($location_room)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.location_room.edit', encrypt($item->id)).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.location_room.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }
        return view("pages.master-data.location.location_room.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location_id = Location::orderBy('created_at', 'desc')->get();
        $sub_location = LocationSub::orderBy('created_at', 'desc')->get();
        return view('pages.master-data.location.location_room.create', compact('location_id', 'sub_location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRoomRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location_room = LocationRoom::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location_room.index');
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
        // deskripsi id
        $decrypt_id = decrypt($id);
        $location_room = LocationRoom::find($decrypt_id);
        $location = Location::orderBy('created_at', 'desc')->get();
        // Filter sub-locations by the selected location
        $sub_location = LocationSub::where('location_id', $location_room->location_id)->orderBy('created_at', 'desc')->get();

        return view('pages.master-data.location.location_room.edit', compact('location_room', 'location', 'sub_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRoomRequest $request, LocationRoom $location_room)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location_room->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location_room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $location_room = LocationRoom::find($decrypt_id);

        // hapus location
        $location_room->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function getSubLocations(Request $request)
    {
        $locationId = $request->input('location_id');
        $subLocations = LocationSub::where('location_id', $locationId)->get();
        return response()->json($subLocations);
    }

    public function getLocationRooms(Request $request)
    {
        $sub_locationId = $request->input('sub_location_id');
        $locationRooms = LocationRoom::where('sub_location_id', $sub_locationId)->get();
        return response()->json($locationRooms);
    }
}
