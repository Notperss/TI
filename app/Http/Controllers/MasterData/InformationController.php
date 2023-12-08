<?php

namespace App\Http\Controllers\MasterData;


use App\Models\Information;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;

class InformationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(request()->ajax()) {

            $information = Information::orderBy('created_at', 'desc')->get();

            return DataTables::of($information)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="'.route('backsite.information.edit', encrypt($item->id)).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.vendor_ti.destroy', encrypt($item->id)).'" method="POST"
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
        return view('pages.master-data.information.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.master-data.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInformationRequest $request) {
        $data = $request->all();

        Information::create($data);
        $information = Information::OrderBy('created_at', 'desc')->get();

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.information.index', compact('information'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Information $information) {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $decrypt_id = decrypt($id);
        $information = Information::find($decrypt_id);

        return view('pages.master-data.information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInformationRequest  $request
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInformationRequest $request, Information $information) {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $information->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.information.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $information = Information::find($decrypt_id);

        // hapus information
        $information->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
