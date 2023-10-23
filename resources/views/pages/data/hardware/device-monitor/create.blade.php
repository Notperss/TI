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

                                <form class="form" action="{{ route('backsite.device_monitor.store') }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body ml-2">
                                        <div class="form-section">
                                            <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit.
                                            </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="monitor_id">Monitor
                                                <code style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="monitor" name="monitor" class="form-control"
                                                    value="{{ old('monitor') }}" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="no_asset">No
                                                Asset
                                                <code style="color:red;">*</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="no_asset" name="no_asset" class="form-control"
                                                    value="{{ old('no_asset') }}" autocomplete="off" required>

                                                @if ($errors->has('no_asset'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('no_asset') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="file">File
                                                <code style="color:red;">optional</code></label>
                                            <div class="col-md-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file"
                                                        name="file">
                                                    <label class="custom-file-label" for="file"
                                                        aria-describedby="file">Pilih
                                                        File</label>
                                                </div>
                                                <p class="text-muted"><small class="text-danger">Hanya dapat
                                                        mengunggah 1 file</small></p>

                                                @if ($errors->has('file'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('file') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="description">Keterangan<code
                                                    style="color:red;">optional</code></label>
                                            <div class="col-md-10">
                                                <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
                                        <a href="{{ route('backsite.device_monitor.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@endsection
