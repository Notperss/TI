<?php

namespace App\Http\Controllers\MasterData\HardwareCategory;

use App\Http\Controllers\Controller;
use App\Models\MasterData\HardwareCategory\HardwareCategory;
use Illuminate\Http\Request;

class HardwareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hardwareCategories = HardwareCategory::latest()->get();

        return view('pages.master-data.hardware-category.index', compact('hardwareCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master-data.hardware-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'has_indicator' => ['required', 'boolean'],
            'has_testing' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        HardwareCategory::create($validatedData);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.hardware-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function show(HardwareCategory $hardwareCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(HardwareCategory $hardwareCategory)
    {
        return view('pages.master-data.hardware-category.edit', compact('hardwareCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\HardwareCategory\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HardwareCategory $hardwareCategory)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'has_indicator' => ['required', 'boolean'],
            'has_testing' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        $hardwareCategory->update($validatedData);

        alert()->success('Sukses', 'Data berhasil di update');
        return redirect()->route('backsite.hardware-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\HardwareCategory\HardwareCategory  $hardwareCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(HardwareCategory $hardwareCategory)
    {
        $hardwareCategory->Delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
