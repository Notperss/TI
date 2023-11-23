<?php

namespace App\Http\Controllers\SystemInformation\DRC;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SystemInformation\DRC\DRC;
use Illuminate\Support\Facades\Validator;
use App\Models\SystemInformation\DRC\DRCMonitoring;

class DRCMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $drc = DRCMonitoring::with('drc_monitoring')->orderby('d_r_c_monitorings.created_at', 'desc');

            return DataTables::of($drc)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.drc-monitoring.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Surat" class="dropdown-item">
                        Show
                    </a>
                    <form action="' . route('backsite.drc-monitoring.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('drc_monitoring.created_at', function ($item) {
                return Carbon::parse($item->drc_monitoring->created_at)->translatedFormat('l, d F Y');
            })
                ->rawColumns(['action', 'app_monitoring.created_at'])
                ->toJson();
        }
        return view("pages.system-information.drc-monitoring.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drcs = DRC::with('drc')->orderBy('id', 'asc')->get();
        return view("pages.system-information.drc-monitoring.create", compact('drcs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'drc_id' => [
                'required',
                Rule::unique('d_r_c_monitorings', 'drc_id'),
            ],
        ];

        // Custom validation messages
        $messages = [
            'drc_id.required' => 'Data tidak boleh kosong..',
            'drc_id.unique' => 'Data tidak boleh sama.',
            // Add custom messages for other rules as needed
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        // store to database
        DRCMonitoring::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.drc-monitoring.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SystemInformation\DRC\DRCMonitoring  $drcmonitoring
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $drc = DRCMonitoring::with('drc_monitoring')->find($decrypt_id);

        return view('pages.system-information.drc-monitoring.show', compact('drc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\DRC\DRCMonitoring  $drcmonitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(DRCMonitoring $drcmonitoring)
    {
        $drcmonitoring = DRCMonitoring::findOrFail($drcmonitoring->id);
        return view('pages.system-information.drc-monitoring.edit', compact('DRCmonitoring'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemInformation\DRC\DRCMonitoring  $drcmonitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DRCMonitoring $drcmonitoring)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\DRC\DRCMonitoring  $drcmonitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $drcmonitoring = DRCMonitoring::find($decrypt_id);

        // hapus location
        $drcmonitoring->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
