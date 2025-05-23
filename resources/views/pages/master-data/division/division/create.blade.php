@extends('layouts.app')

{{-- set title --}}
@section('title', 'Divisi')
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h4 class="card-title text-white">Tambah Data Divisi </h4>
                                </div>

                                <div class="card-body card-dashboard">


                                    <form class="form form-horizontal" action="{{ route('backsite.division.store') }}"
                                        method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-body">
                                            <div class="form-section">
                                                <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="kode">Kode Divisi <code
                                                        style="color:red;">*</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="kode" name="kode" class="form-control"
                                                        placeholder="Masukan Kode Divisi" value="{{ old('kode') }}"
                                                        autocomplete="off" required>

                                                    @if ($errors->has('kode'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('kode') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name">Divisi <code
                                                        style="color:red;">*</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name" name="name" class="form-control"
                                                        placeholder="Masukan Nama Divisi" value="{{ old('name') }}"
                                                        autocomplete="off" required>

                                                    @if ($errors->has('name'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('name') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-actions ">
                                            <button type="submit" style="width:120px;"
                                                class="btn btn-cyan float-right mr-2"
                                                onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                <i class="la la-check-square-o"></i> Submit
                                            </button>

                                            <a href="{{ route('backsite.division.index') }}"
                                                class="btn btn-success text-left ml-2">
                                                <i class="la la-arrow-left"></i> Kembali</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

        </div>
    </div>

@endsection
