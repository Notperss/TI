<?php

namespace App\Http\Controllers\Adm;

use App\Http\Requests\Adm\Letter\StoreLetterRequest;
use Carbon\Carbon;
use App\Models\Adm\Letter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\Letter\UpdateLetterRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $letter = Letter::orderby('created_at', 'desc');

            return DataTables::of($letter)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.letter.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Surat" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.letter.edit', $item->id) . '">
                        Edit
                    </a>
                    <form action="' . route('backsite.letter.destroy', encrypt($item->id)) . '" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        ' . method_field('delete') . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })
                ->editColumn('file', function ($item) {
                    return '<a type="button" data-fancybox
                                data-src="' . asset('storage/' . $item->file) . '"
                                class="btn btn-info btn-sm text-white ">
                                Show
                            </a>
                            <a type="button" href="' . asset('storage/' . $item->file) . '"
                                    class="btn btn-primary btn-sm" download>Download    
                            </a>
                                ';
                })
                ->editColumn('date_letter', function ($item) {
                    return Carbon::parse($item->date_letter)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action', 'file'])
                ->toJson();
        }
        return view("pages.adm.letter.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.adm.letter.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLetterRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();


        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-letter', $request->file('file')->getClientOriginalName());
        }
        // store to database
        Letter::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.letter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $letter = Letter::find($decrypt_id);

        return view('pages.adm.letter.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
        $letter = Letter::findOrFail($letter->id);
        $filepath = storage_path($letter->file);
        $fileName = basename($filepath);
        return view('pages.adm.letter.edit', compact('letter', 'fileName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adm\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $letter['file'];

        // upload process here
        if ($request->hasFile('file')) {

            $data['file'] = $request->file('file')->storeAs('assets/file-letter', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $letter->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.letter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $letter = Letter::find($decrypt_id);

        // cari old photo
        $path_file = $letter['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $letter->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
