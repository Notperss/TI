<?php

namespace App\Http\Controllers\Inspection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Inspection\Inspection;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Inspection\InspectionIndicatorAsset;

class LattolInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {

            $inspection = InspectionIndicatorAsset::with('asset', 'inspection')
                ->whereHas('inspection', function ($query) {
                    $query->where('job_position_id', Auth::user()->job_position_id);
                })->whereNot('status', 'Baik')
                ->orderby('created_at', 'desc');

            return DataTables::of($inspection)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
            <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.lattol-inspection.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Inspeksi" class="dropdown-item">
                        Show
                    </a>
                 
            </div>
            </div>
            
                <form action="'.route('backsite.lattol-inspection.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="
                    '.($item->is_approve == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'
                    ">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-sm btn-'.($item->is_approve == 1 ? 'success' : 'danger').' w-100" value="'.($item->is_approve == 1 ? 'Close' : 'Open').'"
                        '.($item->is_approve == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
                ';
                })
                ->rawColumns(['action', 'date', 'file'])
                ->toJson();
        }

        return view('pages.lattol.inspection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $decrypt_id = decrypt($id);
        $inspection = InspectionIndicatorAsset::with('asset', 'inspection', 'hardwareIndicator')
            ->find($decrypt_id);
        return view('pages.lattol.inspection.show', compact('inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inspection\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        //
    }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection = InspectionIndicatorAsset::find($decrypt_id);
        if ($inspection->is_approve == 1) {
            $inspection->update(['is_approve' => 2]);
        } elseif ($inspection->is_approve == 2) {
            $inspection->update(['is_approve' => 1]);
        } else {
            alert()->error('Error', 'Data gagal diubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil diubah');
        return back();
    }
}
