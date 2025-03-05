<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagementAccess\JobPosition;


class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobPositions = JobPosition::orderBy('name', 'asc')->get();

        return view('pages.management-access.job-position.index', compact('jobPositions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.management-access.job-position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
        ]);

        JobPosition::create($validatedData);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('job-position.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $jobPosition = JobPosition::find($decrypt_id);

        return view('pages.management-access.job-position.edit', compact('jobPosition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPosition $jobPosition)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama indikator wajib diisi.',
            'name.max' => 'Nama indikator tidak boleh lebih dari 255 karakter.',
        ]);
        $jobPosition->update($validatedData);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('job-position.index');
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
        $jobPosition = JobPosition::find($decrypt_id);

        // hapus jobposition
        $jobPosition->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}
