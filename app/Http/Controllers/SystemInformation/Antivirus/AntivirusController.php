<?php

namespace App\Http\Controllers\SystemInformation\Antivirus;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\SystemInformation\Antivirus\Antivirus;
use App\Models\SystemInformation\Antivirus\AntivirusFile;
use App\Http\Requests\SystemInformation\Antivirus\StoreAntivirusRequest;
use App\Http\Requests\SystemInformation\Antivirus\UpdateAntivirusRequest;

class AntivirusController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if(request()->ajax()) {

            $antivirus = Antivirus::orderby('created_at', 'desc');

            if($request->filled('from_date') && $request->filled('to_date')) {
                $antivirus = $antivirus->whereBetween('date_start', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($antivirus)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.antivirus.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Lisensi" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.antivirus.edit', $item->id).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.antivirus.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('date_finish', function ($item) {
                    return Carbon::parse($item->date_finish)->translatedFormat('l, d F Y');
                })->editColumn('date_start', function ($item) {
                    return Carbon::parse($item->date_start)->translatedFormat('l, d F Y');
                })->rawColumns(['action', 'date_finish', 'date_start'])
                ->toJson();
        }
        return view("pages.system-information.antivirus.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return view("pages.system-information.antivirus.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SystemInformation\Antivirus\StoreAntivirusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAntivirusRequest $request) {
        // get all request from frontsite
        $data = $request->all();
        // dd($data);
        // store to database
        $antivirus = Antivirus::create($data);
        $antivirus_id = $antivirus->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.antivirus.edit', $antivirus_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemInformation\Antivirus\Antivirus  $antivirus
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $decrypt_id = decrypt($id);
        $antivirus = Antivirus::find($decrypt_id);

        return view('pages.system-information.antivirus.show', compact('antivirus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemInformation\Antivirus\Antivirus  $antivirus
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $antivirus = Antivirus::find($id);
        $files = AntivirusFile::where('antivirus_id', $id)->orderBy('created_at', 'desc')->get();
        return view('pages.system-information.antivirus.edit', compact('antivirus', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SystemInformation\Antivirus\UpdateAntivirusRequest  $request
     * @param  \App\Models\SystemInformation\Antivirus\Antivirus  $antivirus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAntivirusRequest $request, $id) {
        // get all request from frontsite
        $data = $request->all();

        $antivirus = Antivirus::find($id);
        // update to database
        $antivirus->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.antivirus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemInformation\Antivirus\Antivirus  $antivirus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $antivirus = Antivirus::find($decrypt_id);

        $antivirus->forceDelete();

        $note = AntivirusFile::where('antivirus_id', $decrypt_id)->get();
        // hapus file
        foreach($note as $file) {
            if($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }
        }

        AntivirusFile::where('antivirus_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload note
    public function form_upload(Request $request) {
        if($request->ajax()) {
            $id = $request->id;

            $row = Antivirus::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.system-information.antivirus.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request) {
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
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If validation passes, proceed with your original logic
        $antivirus = Antivirus::find($request->id);
        if($request->hasFile('file')) {
            foreach($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-antivirus-file', $fullname);
            }
        }
        AntivirusFile::create([
            'antivirus_id' => $request->id,
            'note' => $request->note,
            'date' => $request->date,
            'file' => $file,
        ]);

        alert()->success('Success', 'File successfully uploaded');
        return redirect()->route('backsite.antivirus.edit', $antivirus);
    }

    // get show_file software
    public function show_file(Request $request) {
        if($request->ajax()) {
            $id = $request->id;

            $antivirusfile = AntivirusFile::where('antivirus_id', $id)->get();
            $data = [
                'datafile' => $antivirusfile,
            ];

            $msg = [
                'data' => view('pages.system-information.antivirus.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file note
    public function delete_file($id) {
        $antivirusFile = AntivirusFile::find($id);
        $antivirusFile->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

}