<?php

namespace App\Http\Controllers\Network\IpPhone;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Network\IpPhone\IpPhone;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Network\IpPhone\StoreIpPhoneTRequest;
use App\Http\Requests\Network\IpPhone\UpdateIpPhoneTRequest;

class IpPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $ip_phone = IpPhone::orderby('created_at', 'desc');

            return DataTables::of($ip_phone)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="' . route('backsite.ip_phone.show', encrypt($item->id)) . '" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data IP Phone" class="dropdown-item">
                        Show
                    </a>
                    <a class="dropdown-item" href="' . route('backsite.ip_phone.edit', encrypt($item->id)) . '">
                        Edit
                                </a>
                    <form action="' . route('backsite.ip_phone.destroy', encrypt($item->id)) . '" method="POST"
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

        return view('pages.network.ip_phone.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.network.ip_phone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Network\IpPhone\StoreIpPhoneTRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIpPhoneTRequest $request)
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
            $data['file'] = $request->file('file')->storeAs('assets/file-ip_phone', $fullname);
        }
        // store to database
        IpPhone::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.ip_phone.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone  $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);

        return view('pages.network.ip_phone.show', compact('ip_phone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone  $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);
        return view('pages.network.ip_phone.edit', compact('ip_phone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Network\IpPhone\UpdateIpPhoneTRequest  $request
     * @param  \App\Models\Network\IpPhone\IpPhone $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIpPhoneTRequest $request, IpPhone $ip_phone)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $ip_phone['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('assets/file-ip_phone', $fullname);
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }


        // update to database
        $ip_phone->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.ip_phone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network\IpPhone\IpPhone $ip_phone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $ip_phone = IpPhone::find($decrypt_id);

        // cari old photo
        $path_file = $ip_phone['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $ip_phone->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
