<?php

namespace App\Http\Controllers\MasterData;


use App\Models\Information;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Information::orderBy('created_at', 'desc')->get();
        return view('pages.master-data.information.index', compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInformationRequest $request)
    {
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
    public function show(Information $information)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(UpdateInformationRequest $request, Information $information)
    {
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
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $information = Information::find($decrypt_id);

        // hapus information
        $information->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
