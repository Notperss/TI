<?php

namespace App\Http\Controllers\SystemInformation\Application;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\SystemInformation\Application\FileApp;
use App\Models\SystemInformation\Application\NoteApp;
use App\Models\SystemInformation\Application\Application;
use App\Http\Requests\SystemInformation\Application\StoreApplicationRequest;
use App\Http\Requests\SystemInformation\Application\UpdateApplicationRequest;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $application = Application::latest();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $application = $application->whereBetween('date_finish', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($application)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
            <div class="container">
            <div class="btn-group mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.application.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Aplikasi" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.application.edit', $item->id).'"  
                    '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                        Edit
                    </a>
                    <form action="'.route('backsite.application.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete" 
                         '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
            </div>
             </div>
             <form action="'.route('backsite.application.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="
                    '.($item->stats == 1 ? 'return confirm(\'Are You Sure Want to Close?\')' : 'return confirm(\'Are You Sure Want to Open?\')').'
                    ">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-sm btn-'.($item->stats == 1 ? 'success' : 'danger').' w-100" value="'.($item->stats == 1 ? 'Close' : 'Open').'"
                        '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
                ';
                })->editColumn('date_finish', function ($item) {
                    return Carbon::parse($item->date_finish)->translatedFormat('l, d F Y');
                })->editColumn('name_app', function ($item) {
                    return $item->name_app.'<br><span class="badge badge-'.($item->is_active ? 'success' : 'danger').'">'.
                        ($item->is_active ? 'Aktif' : 'Tidak Aktif').'</span>';
                })->rawColumns(['action', 'date_finish', 'name_app'])
                ->toJson();
        }
        return view("pages.system-information.application.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user()->name;
        $user_id = Auth::user()->id;
        return view("pages.system-information.application.create", compact('user', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SystemInformation\Application\StoreApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $application = Application::create($data);
        $application_id = $application->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.application.edit', $application_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemInformation\Application\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $app = Application::find($decrypt_id);

        return view('pages.system-information.application.show', compact('app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\Application\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = Application::find($id);
        $notes = NoteApp::where('app_id', $id)->orderBy('created_at', 'desc')->get();
        $files = FileApp::where('app_id', $id)->orderBy('created_at', 'desc')->get();
        return view('pages.system-information.application.edit', compact('app', 'files', 'notes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SystemInformation\Application\UpdateApplicationRequest  $request
     * @param  \App\Models\SystemInformation\Application\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $application->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.application.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\Application\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $application = Application::find($decrypt_id);

        $application->forceDelete();

        $note = NoteApp::where('app_id', $decrypt_id)->get();
        // hapus file
        foreach ($note as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }
        }

        $file = FileApp::where('app_id', $decrypt_id)->get();
        // hapus file
        foreach ($file as $fil) {
            if ($fil->file != null || $fil->file != '') {
                Storage::delete($fil->file);
            }
        }

        FileApp::where('app_id', $decrypt_id)->forceDelete();
        NoteApp::where('app_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload note
    public function form_upload_note(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Application::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.system-information.application.upload_note', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_note(Request $request)
    {
        // Validation rules
        $rules = [
            'note' => ['required'], // Add any other rules you need
            'date' => ['required'], // Add any other rules you need
        ];

        // Custom validation messages
        $messages = [
            'note.required' => 'Catatan tidak boleh kosong.',
            'date.required' => 'Tanggal tidak boleh kosong.',
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

        // If validation passes, proceed with your original logic
        $application = Application::find($request->id);
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-app-note', $fullname);
            }
        }
        NoteApp::create([
            'app_id' => $request->id,
            'note' => $request->note,
            'date' => $request->date,
            'file' => $file,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.application.edit', $application);
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $noteapp = NoteApp::where('application_id', $id)->with('barang')->get();
            $data = [
                'datafile' => $noteapp,
            ];

            $msg = [
                'data' => view('pages.system-information.application.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file note
    public function delete_file_note($id)
    {
        $noteApp = NoteApp::find($id);
        $noteApp->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function form_upload_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = Application::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.system-information.application.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload_file(Request $request)
    {
        // Validation rules
        $rules = [
            'description' => ['required'], // Add any other rules you need
            'date' => ['required'], // Add any other rules you need
        ];

        // Custom validation messages
        $messages = [
            'description.required' => 'Keterangan tidak boleh kosong.',
            'date.required' => 'Tanggal tidak boleh kosong.',
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

        // If validation passes, proceed with your original logic
        $application = Application::find($request->id);
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-app', $fullname);
            }
        }
        FileApp::create([
            'app_id' => $request->id,
            'description' => $request->description,
            'date' => $request->date,
            'file' => $file,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.application.edit', $application);
    }

    public function delete_file($id)
    {
        $file = FileApp::find($id);
        $file->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function app_link(Request $request)
    {
        if (request()->ajax()) {

            $application = Application::latest();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $application = $application->whereBetween('date_finish', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($application)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.application.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Aplikasi" class="dropdown-item">
                        Show
                    </a>
            </div>
                ';
                })->editColumn('date_finish', function ($item) {
                    return Carbon::parse($item->date_finish)->translatedFormat('l, d F Y');
                })->rawColumns(['action', 'date_finish',])
                ->toJson();
        }
        return view("pages.system-information.application.index_link");
    }

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $app = Application::find($decrypt_id);
        if ($app->stats == 1) {
            $app->update(['stats' => 2]);
        } elseif ($app->stats == 2) {
            $app->update(['stats' => 1]);
        } else {
            alert()->error('Error', 'Data gagal diubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil diubah');
        return back();
    }

}
