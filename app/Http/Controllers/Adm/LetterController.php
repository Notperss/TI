<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\Letter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\Letter\StoreLetterRequest;
use App\Http\Requests\Adm\Letter\UpdateLetterRequest;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $letter = Letter::orderby('created_at', 'desc');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $letter = $letter->whereBetween('date_letter', [$request->from_date, $request->to_date]);
            }

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
                       <a type="button" href="' . asset('storage/' . $item->file) . '"
                                class="dropdown-item  ' . ($item->file ? '' : 'hidden') . '" download>
                                Unduh File
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
                ->editColumn('type_letter', function ($item) {

                    $filePath = asset('storage/' . $item->file);

                    if ($item->type_letter == '') {
                        return '<span>N/A</span>';
                    } elseif ($item->type_letter == 'SURAT MASUK') {
                        return '<h5><span type="button" class="badge bg-primary" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Surat Masuk</span></h5>';
                    } elseif ($item->type_letter == 'BA') {
                        return '<h5><span type="button" class="badge bg-info" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Berita Acara</span></h5>';
                    } elseif ($item->type_letter == 'PPFTI') {
                        return '<h5><span type="button" class="badge bg-success" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">PPFTI</span></h5>';
                    } elseif ($item->type_letter == 'LK') {
                        return '<h5><span type="button" class="badge bg-danger" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Laporan Kerusakan</span></h5>';
                    } elseif ($item->type_letter == 'SURAT KELUAR') {
                        return '<h5><span type="button" class="badge bg-warning" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Surat Keluar</span></h5>';
                    } elseif ($item->type_letter == 'MEMO') {
                        return '<h5><span type="button" class="badge bg-info" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Memo</span></h5>';
                    } elseif ($item->type_letter == 'MEMO IN') {
                        return '<h5><span type="button" class="badge bg-primary" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Memo In</span></h5>';
                    } elseif ($item->type_letter == 'MEMO OUT') {
                        return '<h5><span class="badge  bg-warning" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Memo Out</span></h5>';
                    } elseif ($item->type_letter == 'LAIN-LAIN') {
                        return '<h5><span type="button" class="badge bg-secondary" data-fancybox  title="Lihat File"
                                data-src="' . $filePath . '">Lain-lain</span></h5>';
                    } else {
                        return '-';
                    }
                })
                ->editColumn('date_letter', function ($item) {
                    return Carbon::parse($item->date_letter)->translatedFormat('d-m-Y');
                })
                ->rawColumns(['action', 'type_letter'])
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
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-form', $fullname);
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
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-form', $fullname);
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
