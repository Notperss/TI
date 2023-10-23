@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - CCTV')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit CCTV</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">CCTV</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.cctv.update', [$cctv->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="name">Nama <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="name" name="name"
                                                                class="form-control"
                                                                value="{{ old('name', isset($cctv->name) ? $cctv->name : '') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="latitude">Latitude <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="latitude" name="latitude"
                                                                class="form-control"
                                                                value="{{ old('latitude', isset($cctv->latitude) ? $cctv->latitude : '') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('latitude'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('latitude') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="km">KM <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="km" name="km"
                                                                class="form-control"
                                                                value="{{ old('km', isset($cctv->km) ? $cctv->km : '') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('km'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('km') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="longitude">Longitude
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="longitude" name="longitude"
                                                                class="form-control"
                                                                value="{{ old('longitude', isset($cctv->longitude) ? $cctv->longitude : '') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('longitude'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('longitude') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="link_cctv">Link CCTV
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="link_cctv" name="link_cctv"
                                                                class="form-control"
                                                                value="{{ old('link_cctv', isset($cctv->link_cctv) ? $cctv->link_cctv : '') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('link_cctv'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('link_cctv') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="logo">Ganti Logo
                                                            <code style="color:red;">optional</code></label>
                                                        <div class="col-md-4">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="logo" name="logo">
                                                                <label class="custom-file-label" for="file"
                                                                    aria-describedby="file">Pilih
                                                                    Logo</label>
                                                            </div>
                                                            <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                    mengunggah 1 logo</small></p>

                                                            @if ($errors->has('logo'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('logo') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control"
                                                            for="description">Keterangan<code
                                                                style="color:red;">optional</code></label>
                                                        <div class="col-md-10">
                                                            <textarea rows="4" class="form-control summernote" id="description" name="description">{{ isset($cctv->description) ? $cctv->description : '' }}</textarea>
                                                            <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                    + Enter jika ingin pindah baris</small></p>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.cctv.index') }}" style="width:120px;"
                                                    class="btn bg-blue-grey text-white mr-1"
                                                    onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                    <i class="la la-check-square-o"></i> Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <!-- END: Content-->

@endsection

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        // summernote 
        $('.summernote').summernote({
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('.summernote').summernote('fontSize', '12');
    </script>
@endpush
