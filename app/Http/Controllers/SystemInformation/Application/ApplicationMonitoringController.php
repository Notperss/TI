<?php

namespace App\Http\Controllers\SystemInformation\Application;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\SystemInformation\Application\Application;
use App\Models\SystemInformation\Application\ApplicationMonitoring;

class ApplicationMonitoringController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if(request()->ajax()) {

            $app = ApplicationMonitoring::with('app_monitoring')->orderby('application_monitorings.created_at', 'desc');

            if($request->has('from_date') && $request->has('to_date')) {
                $app->whereHas('app_monitoring', function ($query) use ($request) {
                    $query->whereBetween('date_start', [
                        $request->input('from_date'),
                        $request->input('to_date'),
                    ]);
                });
            }

            return DataTables::of($app)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.application-monitoring.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Surat" class="dropdown-item">
                        Show
                    </a>
                    <form action="'.route('backsite.application-monitoring.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('app_monitoring.date_start', function ($item) {
                    return Carbon::parse($item->app_monitoring->date_start)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action', 'app_monitoring.date_start'])
                ->toJson();
        }
        return view("pages.system-information.application-monitoring.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $apps = Application::with('app')->orderBy('id', 'asc')->get();
        return view("pages.system-information.application-monitoring.create", compact('apps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'application_id' => [
                'required',
                Rule::unique('application_monitorings', 'application_id'),
            ],
        ];

        // Custom validation messages
        $messages = [
            'application_id.required' => 'The application ID is required.',
            'application_id.unique' => 'The application ID must be unique.',
            // Add custom messages for other rules as needed
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        // store to database
        ApplicationMonitoring::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.application-monitoring.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SystemInformation\Application\ApplicationMonitoring  $applicationmonitoring
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $decrypt_id = decrypt($id);
        $app = ApplicationMonitoring::with('app_monitoring')->find($decrypt_id);

        return view('pages.system-information.application-monitoring.show', compact('app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\Application\ApplicationMonitoring  $applicationmonitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationMonitoring $applicationmonitoring) {
        $applicationmonitoring = ApplicationMonitoring::findOrFail($applicationmonitoring->id);
        return view('pages.system-information.application-monitoring.edit', compact('applicationmonitoring'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemInformation\Application\ApplicationMonitoring  $applicationmonitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationMonitoring $applicationmonitoring) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\Application\ApplicationMonitoring  $applicationmonitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $applicationmonitoring = ApplicationMonitoring::find($decrypt_id);

        // hapus location
        $applicationmonitoring->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}

