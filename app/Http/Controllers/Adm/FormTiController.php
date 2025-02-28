<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\Form;
use App\Models\Adm\FormTi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MasterData\Division\Division;
use App\Http\Requests\Adm\FormTi\StoreFormTiRequest;
use App\Http\Requests\Adm\FormTi\UpdateFormTiRequest;


class FormTiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $form_ti = FormTi::with('division')->orderby('created_at', 'desc');

            return DataTables::of($form_ti)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.form_ti.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.form_ti.edit', $item->id).'">
                        Edit
                    </a>
                    <form action="'.route('backsite.form_ti.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete">
                    </form>
            </div>
                ';
                })->editColumn('date_form', function ($item) {
                    return Carbon::parse($item->date_form)->translatedFormat('l, d F Y');
                })
                ->editColumn('file', function ($item) {
                    if ($item->file) {
                        return '<a type="button" data-fancybox
                                data-src="'.asset('storage/'.$item->file).'"
                                class="btn btn-info btn-sm text-white ">
                                Lihat
                            </a>
                            <a type="button" href="'.asset('storage/'.$item->file).'"
                                class="btn btn-warning btn-sm" download>
                                Unduh
                            </a>
                                ';
                    } else {
                        return '<span>File not found</span>';
                    }
                })
                ->rawColumns(['action', 'date_form', 'file'])
                ->toJson();
        }
        return view("pages.adm.form_ti.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $forms = Form::where('category', '!=', 'ABSENSI')->orderby("created_at", "desc")->get();
        $divisions = Division::orderBy('name', 'asc')->get();
        return view("pages.adm.form_ti.create", compact("forms", 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\FormTi\StoreFormTiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormTiRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-form', $fullname);
        }

        $form_ti = FormTi::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.form_ti.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\FormTi  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $form_ti = FormTi::find($decrypt_id);

        return view('pages.adm.form_ti.show', compact('form_ti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\FormTi  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form_ti = FormTi::find($id);
        $forms = Form::where('category', '!=', 'ABSENSI')->orderBy('created_at', 'desc')->get();
        $divisions = Division::orderBy('name', 'asc')->get();
        return view('pages.adm.form_ti.edit', compact('form_ti', 'forms', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\FormTi\UpdateFormTiRequest  $request
     * @param  \App\Models\Adm\FormTi  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormTiRequest $request, FormTi $form_ti)
    {
        // get all request from frontsite
        $data = $request->all();

        $path_file = $form_ti['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-form', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $form_ti->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.form_ti.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\FormTi  $lendingFacility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $form_ti = FormTi::find($decrypt_id);

        // cari old photo
        $path_file = $form_ti['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $form_ti->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
