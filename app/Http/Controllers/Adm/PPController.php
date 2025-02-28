<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use App\Models\Adm\PP;
use App\Models\Adm\Pp_file;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Adm\PP\StorePPRequest;
use App\Http\Requests\Adm\PP\UpdatePPRequest;
use App\Models\Adm\Bill;
use App\Models\Adm\Pp_status;

class PPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {



            // $isManagerOrViceManager = $user->job_position === 1 || $user->job_position === 3 || $user->nik === 'M0203002';

            $isAdmin = Auth::user()->hasRole('super-admin');
            $administrasi = Auth::user()->job_position == 'Administrasi';

            $ppQuery = $isAdmin || $administrasi ? PP::with('detail_user.user', 'pp_status')->orderBy('created_at', 'desc')
                : PP::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');

            $pp = $ppQuery->get();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $pp = $pp->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($pp)
                ->addIndexColumn()
                ->addColumn('action', function ($item) use ($isAdmin, $administrasi) {
                    $action = '
        <div class="container">
            <div class="btn-group mb-1">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a href="#mymodal" data-remote="'.route('backsite.pp.show', encrypt($item->id)).'" data-toggle="modal"
                        data-target="#mymodal" data-title="Detail Data PR" class="dropdown-item">
                        Show
                    </a>
                       
                    <a class="dropdown-item" href="'.route('backsite.pp.edit', encrypt($item->id)).'"
                     '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                        Edit
                    </a>

                    <a class="dropdown-item" href="'.route('backsite.bill.create_bill', $item->id).'"
                    '.($isAdmin || $item->stats == 2 ? '' : 'hidden').'>
                        Tambah tagihan
                    </a>

                    <form action="'.route('backsite.pp.destroy', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Are You Sure Want to Delete?\')">
                        '.method_field('delete').csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="dropdown-item" value="Delete" '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                    </form>
                </div>
            </div>
        </div>';

                    if ($isAdmin || $administrasi || $item->stats == 1) {
                        $action .= '<form action="'.route('backsite.pp.approve', encrypt($item->id)).'" method="POST"
                    onsubmit="return confirm(\'Apakah anda yakin?\')">
                        '.method_field('PUT').csrf_field().'
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-primary flex-grow-1" name="status" value="Tagihan" title="Tagihan" '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                                Tagihan
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger flex-grow-1" name="status" value="Batal" title="Batal"  '.($isAdmin || $item->stats == 1 ? '' : 'hidden').'>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-sm btn-success flex-grow-1" name="status" value="Close" title="Close" '.($isAdmin || $item->stats == 2 ? '' : 'hidden').'>
                                Close
                            </button>
                        </div>
                    </form>';
                    }
                    return $action;
                })->editColumn('date', function ($item) {
                    return Carbon::parse($item->date)->translatedFormat('d-m-Y');
                })->editColumn('dokumentasiStats', function ($item) {
                    // Access the distribution_asset relationship
                    $dokumentasiStats = $item->pp_status;

                    // Check if dokumentasiStats is not empty
                    if ($dokumentasiStats->isNotEmpty()) {
                        // Initialize an array to store distribution asset creation dates
                        $type_status = [];

                        // Loop through each distributionAsset
                        foreach ($dokumentasiStats as $dokumentasiStat) {
                            // Add the created_at value to the array
                            $type_status[] = $dokumentasiStat->type_status;
                        }

                        // Check if there are any created_at values in the array
                        if (! empty($type_status)) {
                            // return implode(', ', $type_status);
                            $latestStatus = end($type_status);
                            // return $latestStatus;
                            if ($latestStatus == 1) {
                                return 'Pembuatan';
                            } elseif ($latestStatus == 2) {
                                return 'Input SHP direktorat';
                            } elseif ($latestStatus == 3) {
                                return 'Kirim Dokumen PP ke Divisi SIMA';
                            } elseif ($latestStatus == 4) {
                                return 'Ambil Dokumen PP dari Divisi SIMA';
                            } elseif ($latestStatus == 5) {
                                return 'Kirim Dokumen ke Divisi Teknik';
                            } elseif ($latestStatus == 6) {
                                return 'Undangan aawijing';
                            } elseif ($latestStatus == 7) {
                                return 'Undangan Rapat Negosiasi';
                            } elseif ($latestStatus == 8) {
                                return 'Penginformasian Pemenang OP/KONTRAK';
                            } elseif ($latestStatus == 9) {
                                return 'Mulai Pekerjaan (SPMK)';
                            } elseif ($latestStatus == 10) {
                                return 'Akhir Pekerjaan (BA)';
                            } elseif ($latestStatus == 11) {
                                return 'Penerimaan Barang';
                            } elseif ($latestStatus == 12) {
                                return 'Tagihan';
                            } elseif ($latestStatus == 13) {
                                return 'Dikembalikan ke User';
                            } elseif ($latestStatus == 14) {
                                return 'Dibatalkan (Closed)';
                            } else {
                                return '<p style="color:red;">N/A</p>';
                            }
                        } else {
                            return 'N/A';
                        }
                    } else {
                        return 'N/A';
                    }
                })
                // ->addColumn('username', function ($item) {
                //     $user = auth()->user()->detail_user;
                //     $access = $user->job_position === 1 || $user->job_position === 3 || $user->nik === 'M0203002';

                //     return $access ? $item->detail_user->user->name : null;
                // })

                ->rawColumns(['action', 'date', 'dokumentasiStats'])
                ->toJson();
        }
        return view("pages.adm.pp.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        return view("pages.adm.pp.create", compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\StorePPRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePPRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $pp = PP::create($data);
        $pp_id = $pp->id;

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.pp.edit', encrypt($pp_id));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        return view('pages.adm.pp.show', compact('pp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);
        $datafile = Pp_file::where('pp_id', $decrypt_id)->get();
        $data = Pp_status::where('pp_id', $decrypt_id)->get();
        return view('pages.adm.pp.edit', compact('pp', 'datafile', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Adm\PP\UpdatePPRequest  $request
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePPRequest $request, PP $pp)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $pp->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.pp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm\PP  $pP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Decrypt the $id
        $decrypt_id = decrypt($id);
        // Find the PP record with the decrypted $id
        $pp = PP::find($decrypt_id);
        // Check if there are records in the 'Bill' table with 'pp_id' equal to $id
        if (Bill::where('pp_id', $decrypt_id)->exists()) {
            // Display error message if there are related records in the 'Bill' table
            alert()->error('Error', 'Data Tidak dapat dihapus karena ada record Tagihan');
            return back();
        }
        // Check if the PP record exists before deleting
        if ($pp) {
            // Force delete the PP record
            $pp->forceDelete();
            // Retrieve all associated PP files with the decrypted $id
            $pp_file = Pp_file::where('pp_id', $decrypt_id)->get();
            // Delete associated files
            foreach ($pp_file as $file) {
                if ($file->file != null || $file->file != '') {
                    Storage::delete($file->file);
                }
            }
            // Force delete the PP files
            Pp_file::where('pp_id', $decrypt_id)->forceDelete();
            Pp_status::where('pp_id', $decrypt_id)->forceDelete();

            // Display success message
            alert()->success('Sukses', 'Data berhasil dihapus');
            return back();
        } else {
            // Display error message if the PP record does not exist
            alert()->error('Gagal', 'Data PP tidak ditemukan');
            return back();
        }

    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = PP::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.pp.upload_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function upload(Request $request)
    {
        $pp = PP::find($request->id);

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->getClientOriginalName();
                $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(5);
                $ext = $image->getClientOriginalExtension();
                $fullname = $basename.'.'.$ext;
                $file = $image->storeAs('assets/file-pp', $fullname);
                Pp_file::create([
                    'pp_id' => $request->id,
                    'name_file' => $request->name_file,
                    'type_file' => $request->type_file,
                    'description_file' => $request->description_file,
                    'file' => $file,
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil disimpan');
        return back();
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_file = Pp_file::where('pp_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $pp_file,
            ];

            $msg = [
                'data' => view('pages.adm.pp.detail_file', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $pp_file = Pp_file::find($id);

        // cari old photo
        $path_file = $pp_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $pp_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }


    public function form_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = PP::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.adm.pp.upload_status', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    public function add_status(Request $request)
    {
        $pp = PP::find($request->id);

        // // save to file test material
        // if ($request->hasFile('file')) {
        //     foreach ($request->file('file') as $image) {
        //         $file = $image->getClientOriginalName();
        //         $basename = pathinfo($file, PATHINFO_FILENAME) . ' - ' . Str::random(5);
        //         $ext = $image->getClientOriginalExtension();
        //         $fullname = $basename . '.' . $ext;
        //         $file = $image->storeAs('assets/file-pp', $fullname);
        //         Pp_status::create([
        //             'pp_id' => $request->id,
        //             'type_status' => $request->type_status,
        //             'date' => $request->date,
        //             'description' => $request->description,
        //             'file' => $file,
        //         ]);
        //     }
        // }
        Pp_status::create([
            'pp_id' => $request->id,
            'type_status' => $request->type_status,
            'date' => $request->date,
            'description' => $request->description,
        ]);
        // dd($request->all());
        alert()->success('Sukses', 'Data berhasil disimpan');
        return back();
    }

    // get show_file software
    public function show_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $pp_status = Pp_status::where('pp_id', $id)->orderBy('created_at', 'desc')->get();
            $data = [
                'datafile' => $pp_status,
            ];

            $msg = [
                'data' => view('pages.adm.pp.detail_status', $data)->render(),
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function delete_status($id)
    {
        $pp_status = Pp_status::find($id);

        // cari old photo
        $path_file = $pp_status['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $pp_status->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function approve($id, Request $request)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $pp = PP::find($decrypt_id);

        if ($request->status) {
            if ($request->status == 'Tagihan') {
                $statusPP = 2;
            } elseif ($request->status == 'Batal') {
                $statusPP = 4;
            } elseif ($request->status == 'Close') {
                $statusPP = 3;
            } else {
                alert()->error('Error', 'Status tidak valid');
                return back();
            }

            $pp->update(['stats' => $statusPP]);
            alert()->success('Sukses', 'Data berhasil dirubah');
        } else {
            alert()->error('Error', 'Data gagal dirubah');
        }
        return back();
    }
}
