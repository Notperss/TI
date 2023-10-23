@extends('layouts.app')

{{-- set title --}}
@section('title', 'Monitor')
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
                                    <h4 class="card-title text-white">Tambah Monitor</h4>
                                </div>
                                <form class="form form-horizontal" action="{{ route('backsite.monitor.store') }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body">
                                        <div class="form-section">
                                            <p class="ml-2">Isi input <code>Required (*)</code>, Sebelum menekan tombol
                                                submit. </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="no_asset">No. Asset <code
                                                    style="color:red;">*</code></label>
                                            <div class="mx-auto col-md-9">
                                                <input type="text" id="no_asset" name="no_asset" class="form-control"
                                                    placeholder="No. Asset" value="{{ old('no_asset') }}" autocomplete="off"
                                                    required autofocus>

                                                @if ($errors->has('no_asset'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('no_asset') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="name">Nama Monitor <code
                                                    style="color:red;">*</code></label>
                                            <div class="mx-auto col-md-9">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="example Samsung or LG" value="{{ old('name') }}"
                                                    autocomplete="off" required>

                                                @if ($errors->has('name'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="size">Ukuran/Kapasitas
                                                <code style="color:red;">*</code></label>
                                            <div class="mx-auto col-md-9">
                                                <input type="text" id="size" name="size" class="form-control"
                                                    placeholder="example 14 in" value="{{ old('size') }}"
                                                    autocomplete="off" required>

                                                @if ($errors->has('size'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('size') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="status">Status<code
                                                    style="color:red;">*</code></label>
                                            <div class="mx-left col-md-2">
                                                <select name="status" id="status" class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak Aktif</option>
                                                </select>

                                                @if ($errors->has('status'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('status') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="description">Keterangan<code
                                                    style="color:red;"></code></label>
                                            <div class="mx-auto col-md-9">
                                                <textarea rows="5" class="form-control" id="description" name="description"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
                                        <a href="{{ route('backsite.monitor.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


@endsection
