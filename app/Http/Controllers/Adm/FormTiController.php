<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\Form;
use App\Models\Adm\FormTi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
                    $isAdmin = Auth::user()->hasRole('super-admin');
                    return '
            <div class="container">
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.form_ti.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data Peminjaman Fasilitas" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="'.route('backsite.form_ti.edit', $item->id).'"  '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                        Edit
                    </a>
                    <form action="'.route('backsite.form_ti.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete"  '.($item->stats == 1 || $isAdmin ? '' : 'hidden').'>
                    </form>
            </div>
             </div>
             <form action="'.route('backsite.form_ti.approve', encrypt($item->id)).'" method="POST"
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
                })->editColumn('date_form', function ($item) {
                    return Carbon::parse($item->date_form)->translatedFormat('l, d F Y');
                })
                ->editColumn('type_form', function ($item) {
                    if ($item->file) {
                        return '<button type="button" class="btn btn-primary btn-min-width" style="font-size:80%;" data-fancybox  title="Lihat File"
                                data-src="'.asset('storage/'.$item->file).'">'.$item->type_form.'</button>';
                    } else {
                        return '<h5><span type="button" class="badge bg-secondary">-</span></h5>';
                    }
                })
                ->rawColumns(['action', 'date_form', 'type_form'])
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

    public function approve($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $form = FormTi::find($decrypt_id);
        if ($form->stats == 1) {
            $form->update(['stats' => 2]);
        } elseif ($form->stats == 2) {
            $form->update(['stats' => 1]);
        } else {
            alert()->error('Error', 'Data gagal diubah');
            return back();
        }
        alert()->success('Sukses', 'Data berhasil diubah');
        return back();
    }
}
