@extends('layouts.app')

{{-- set title --}}
@section('title', 'Vendor')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header bg-success text-white my-1">
                                    <h4 class="card-title text-white">Tambah Vendor</h4>
                                </div>

                                <form class="form form-horizontal"
                                    action="{{ route('backsite.vendor_ti.update', [$vendorti->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf

                                    <div class="form-body">
                                        <div class="form-section">
                                            <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                                                submit. </p>
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="nama_vendor">Nama Vendor<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="nama_vendor" name="nama_vendor"
                                                    class="form-control" placeholder=""
                                                    value="{{ old('nama_vendor', $vendorti->nama_vendor) }}"
                                                    autocomplete="off" autofocus required>
                                            </div>
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="telp">No.Telp <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="telp" name="telp" class="form-control"
                                                    placeholder="" value="{{ old('telp', $vendorti->telp) }}"
                                                    autocomplete="off" autofocus required>
                                            </div>
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="pic">PIC <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="pic" name="pic" class="form-control"
                                                    placeholder="" value="{{ old('pic', $vendorti->pic) }}"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="address">Alamat <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $vendorti->address) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="status">Status <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-2">
                                                <select name="status" id="status" class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Pilih Status
                                                    </option>
                                                    </option>
                                                    <option value="1" {{ $vendorti->status == 1 ? 'selected' : '' }}>
                                                        Aktif
                                                    </option>
                                                    <option value="2" {{ $vendorti->status == 2 ? 'selected' : '' }}>
                                                        Tidak
                                                        Aktif</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>

                                        <a href="{{ route('backsite.vendor_ti.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>


@endsection
