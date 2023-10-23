<?php

namespace App\Http\Controllers\Act_daily;

use App\Models\Act_daily\Workcat;
use App\Http\Controllers\Controller;

use App\Http\Requests\Data\Act_daily\StoreWorkcatRequest;
use App\Http\Requests\Data\Act_daily\UpdateWorkcatRequest;

class WorkcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_type = Workcat::latest()->get();

        return view('pages.data.workcat.index', compact('work_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data.workcat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkcatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkcatRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $work_category = Workcat::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.workcat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workcat  $workcat
     * @return \Illuminate\Http\Response
     */
    public function show(Workcat $workcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workcat  $workcat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $workcat = Workcat::find($decrypt_id);
        return view('pages.data.workcat.edit', compact('workcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Data\Act_daily\UpdateWorkcatRequest  $request
     * @param  \App\Models\Workcat  $workcat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkcatRequest $request, Workcat $workcat)
    {

        // get all request from frontsite
        $data = $request->all();

        // update to database
        $workcat->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.workcat.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workcat  $workcat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decrypt_id = decrypt($id);
        $work_category = Workcat::find($decrypt_id);

        // hapus location
        $work_category->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
