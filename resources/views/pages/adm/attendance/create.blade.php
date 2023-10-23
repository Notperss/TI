@extends('layouts.app')

{{-- set title --}}
@section('title', 'Absensi')
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
                                    <h4 class="card-title text-white">Tambah Absensi</h4>
                                </div>
                                <form class="form" action="{{ route('backsite.attendance.store') }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body container">
                                        <div class="form-section">
                                            <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="tanggal">Tanggal<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="date" id="tanggal" name="tanggal" class="form-control"
                                                    value="{{ old('tanggal') }}" autocomplete="off">
                                                @if ($errors->has('tanggal'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('tanggal') }}</p>
                                                @endif
                                            </div>

                                            <label class="col-md-2 label-control" for="hadir">Hadir<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="hadir" name="hadir" class="form-control"
                                                    value="{{ old('hadir') }}" autocomplete="off">
                                                @if ($errors->has('hadir'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('hadir') }}</p>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="absen">Absen<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="absen" name="absen" class="form-control"
                                                    value="{{ old('absen') }}" autocomplete="off">
                                                @if ($errors->has('absen'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('absen') }}</p>
                                                @endif
                                            </div>

                                            <label class="col-md-2 label-control" for="izin">Izin<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="izin" name="izin" class="form-control"
                                                    value="{{ old('izin') }}" autocomplete="off">
                                                @if ($errors->has('izin'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('izin') }}</p>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="sakit">Sakit<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="sakit" name="sakit" class="form-control"
                                                    value="{{ old('sakit') }}" autocomplete="off">
                                                @if ($errors->has('sakit'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('sakit') }}</p>
                                                @endif
                                            </div>

                                            <label class="col-md-2 label-control" for="cuti">Cuti<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="cuti" name="cuti" class="form-control"
                                                    value="{{ old('cuti') }}" autocomplete="off">
                                                @if ($errors->has('cuti'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('cuti') }}</p>
                                                @endif
                                            </div>

                                            <label class="col-md-2 label-control mt-2" for="file">file<code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-4 mt-2">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file"
                                                        name="file" onchange="previewImage()">
                                                    <label class="custom-file-label" for="file"
                                                        aria-describedby="file">Pilih
                                                        File</label>
                                                </div>
                                                <p class="text-muted"><small class="text-danger">Hanya dapat
                                                        mengunggah 1 file</small></p>
                                                <img class="img-preview img-fluid mb-1 col-sm-8">

                                                @if ($errors->has('file'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('file') }}</p>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="keterangan">Keterangan<code
                                                    style="color:red;"></code></label>
                                            <div class="col-md-10">
                                                <textarea rows="5" class="form-control summernote" id="keterangan" name="keterangan"></textarea>
                                                <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                        + Enter jika ingin pindah baris</small></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
                                        <a href="{{ route('backsite.attendance.index') }}"
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
