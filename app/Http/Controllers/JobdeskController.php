<?php

namespace App\Http\Controllers;

use App\Models\Jobdesk;
use App\Http\Requests\StoreJobdeskRequest;
use App\Http\Requests\UpdateJobdeskRequest;

class JobdeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobdesk = Jobdesk::orderBy('created_at', 'desc')->get();

        return view('pages.data.jobdesk.index', compact('jobdesk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data.jobdesk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJobdeskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobdeskRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $jobdesk = Jobdesk::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.jobdesk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jobdesk  $jobdesk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $jobdesk = Jobdesk::find($decrypt_id);

        return view('pages.data.jobdesk.show', compact('jobdesk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobdesk  $jobdesk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $jobdesk = Jobdesk::find($decrypt_id);

        return view('pages.data.jobdesk.edit', compact('jobdesk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobdeskRequest  $request
     * @param  \App\Models\Jobdesk  $jobdesk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobdeskRequest $request, Jobdesk $jobdesk)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $jobdesk->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.jobdesk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobdesk  $jobdesk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $jobdesk = Jobdesk::find($decrypt_id);

        // hapus jobdesk
        $jobdesk->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
