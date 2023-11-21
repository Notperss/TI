<?php

namespace App\Http\Controllers\SystemInformation\DRC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SystemInformation\DRC\DRC;
use App\Http\Requests\SystemInformation\DRC\StoreDRCRequest;
use App\Http\Requests\SystemInformation\DRC\UpdateDRCRequest;

class DRCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $drc = DRC::orderby('created_at', 'desc');

            return DataTables::of($drc)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.drc.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Surat" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.drc.edit', $item->id) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.drc.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view("pages.system-information.drc.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.system-information.drc.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDRCRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        DRC::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.drc.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SystemInformation\DRC\DRC  $drc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $drc = DRC::find($decrypt_id);

        return view('pages.system-information.drc.show', compact('drc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\DRC\DRC  $drc
     * @return \Illuminate\Http\Response
     */
    public function edit(DRC $drc)
    {
        $drc = DRC::findOrFail($drc->id);
        return view('pages.system-information.drc.edit', compact('drc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemInformation\DRC\DRC  $drc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDRCRequest $request, DRC $drc)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $drc->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.drc.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\DRC\DRC  $drc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $drc = DRC::find($decrypt_id);

        // hapus location
        $drc->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
