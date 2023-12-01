<?php

namespace App\Http\Controllers\MasterData\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// request
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationSub;
// use model here
use App\Http\Requests\MasterData\Location\LocationSub\StoreLocationSubRequest;
use App\Http\Requests\MasterData\Location\LocationSub\UpdateLocationSubRequest;

class LocationSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $location_sub = LocationSub::with('location')->orderby('created_at', 'desc');

            return DataTables::of($location_sub)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="' . route('backsite.location_sub.edit', encrypt($item->id)) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.location_sub.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action', 'date_form', 'file'])
                ->toJson();
        }
        return view("pages.master-data.location.location_sub.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = Location::orderBy('created_at', 'desc')->get();
        return view('pages.master-data.location.location_sub.create', compact('location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationSubRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location_sub = LocationSub::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location_sub.index');
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
        $location_sub = LocationSub::find($decrypt_id);

        $location = Location::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.location.location_sub.edit', compact('location_sub', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationSubRequest $request, LocationSub $location_sub)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location_sub->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location_sub.index');
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
        $location_sub = LocationSub::find($decrypt_id);

        // hapus location
        $location_sub->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
