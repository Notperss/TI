<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Models\Data\WorkProgram;

// request
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

// use mode here
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
            $work_program = WorkProgram::orderBy('created_at', 'desc')->get();

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

        return view('pages.data.work_program.edit', compact('work_program'));
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
}
