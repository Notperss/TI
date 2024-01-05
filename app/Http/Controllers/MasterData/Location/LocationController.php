<?php

namespace App\Http\Controllers\MasterData\Location;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

// use libarary here
use App\Http\Controllers\Controller;
use App\Models\MasterData\Location\Location;

// use model here
use App\Http\Requests\MasterData\Location\Location\StoreLocationRequest;
use App\Http\Requests\MasterData\Location\Location\UpdateLocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $location = Location::orderBy('created_at', 'desc')->get();

            return DataTables::of($location)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="' . route('backsite.location.edit', encrypt($item->id)) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.location.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }

        return view('pages.master-data.location.location.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.location.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location = Location::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location.index');
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
        $location = Location::find($decrypt_id);

        return view('pages.master-data.location.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location.index');
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
        $location = Location::find($decrypt_id);

        // hapus location
        $location->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
