<?php

namespace App\Http\Controllers\Data;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

// request
use App\Models\Data\WorkProgram;
use Yajra\DataTables\DataTables;

// use mode here
use App\Http\Controllers\Controller;
use App\Models\Data\WorkProgramFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Data\WorkProgram\StoreWorkProgramRequest;
use App\Http\Requests\Data\WorkProgram\UpdateWorkProgramRequest;

class WorkProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {
            $work_program = WorkProgram::orderBy('work_program', 'desc')
                ->orderBy('year', 'desc')
                ->orderBy('status', 'asc')
                ->get();

            // if ($request->filled('from_date') && $request->filled('to_date')) {
            //     $work_program = $work_program->whereBetween('start_date', [$request->from_date, $request->to_date]);
            // }

            return DataTables::of($work_program)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.work_program.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Absensi" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.work_program.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.work_program.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->rawColumns(['action',])
                ->toJson();
        }

        return view('pages.data.work_program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data.work_program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkProgramRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $work_program = WorkProgram::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.work_program.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $work_program = WorkProgram::find($decrypt_id);

        return view('pages.data.work_program.show', compact('work_program'));
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
        $work_program = WorkProgram::find($decrypt_id);
        $files = WorkProgramFile::where('work_program_id', $work_program->id)->orderBy('created_at', 'desc')->get();

        return view('pages.data.work_program.edit', compact('work_program', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkProgramRequest $request, WorkProgram $work_program)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $work_program->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.work_program.index');
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
        $work_program = WorkProgram::find($decrypt_id);

        // hapus work_program
        $work_program->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = WorkProgram::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.work_program.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }
    public function upload(Request $request)
    {
        $work_program_id = WorkProgram::find($request->id);
        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename . '.' . $ext;
                $file = $image->storeAs('assets/file-work-program', $fullname);

                WorkProgramFile::create([
                    'work_program_id' => $request->id,
                    'uraian' => $request->uraian,
                    'date' => $request->date,
                    'description' => $request->description,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return back();
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_file = WorkProgramFile::where('work_program_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $pp_file,
            ];

            $msg = [
                'data' => view('pages.data.work_program.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }
    // hapus file dailiy activity
    public function delete_file($id)
    {
        $work_program_file = WorkProgramFile::find($id);

        // cari old photo
        $path_file = $work_program_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $work_program_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
