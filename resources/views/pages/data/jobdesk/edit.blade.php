@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Jobdesk')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Jobdesk</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Jobdesk</li>
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
                                            action="{{ route('backsite.jobdesk.update', [$jobdesk->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit.
                                                    </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jobdesk">Jobdesk
                                                        <code style="color:red;">*</code></label>
                                                    <div class="col-md-4">
                                                        <select name="jobdesk" id="jobdesk" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $jobdesk->jobdesk == 1 ? 'selected' : '' }}>
                                                                Teknologi Informasi</option>
                                                            <option value="2"
                                                                {{ $jobdesk->jobdesk == 2 ? 'selected' : '' }}>
                                                                Hardware</option>
                                                            <option value="3"
                                                                {{ $jobdesk->jobdesk == 3 ? 'selected' : '' }}>
                                                                Jaringan</option>
                                                            <option value="4"
                                                                {{ $jobdesk->jobdesk == 4 ? 'selected' : '' }}>
                                                                Peralatan Tol</option>
                                                            <option value="5"
                                                                {{ $jobdesk->jobdesk == 5 ? 'selected' : '' }}>
                                                                Sistem Informasi</option>
                                                        </select>

                                                        @if ($errors->has('jobdesk'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jobdesk') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="year">Tahun
                                                        <code style="color:red;">*</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="year"
                                                            id="year" data-provide="datepicker" data-date-format="yyyy"
                                                            data-date-min-view-mode="2"
                                                            value="{{ isset($jobdesk->year) ? $jobdesk->year : '' }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('year'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('year') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="general">Umum<code
                                                            style="color:red;">*</code></label>
                                                    <div class="col-md-4">
                                                        <textarea rows="5" class="form-control" id="general" name="general" required>{{ isset($jobdesk->general) ? $jobdesk->general : '' }}</textarea>
                                                    </div>
                                                    <label class="col-md-2 label-control" for="technical">Teknis</label>
                                                    <div class="col-md-4">
                                                        <textarea rows="5" class="form-control" id="technical" name="technical">{{ isset($jobdesk->technical) ? $jobdesk->technical : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="type">Jenis
                                                        <code style="color:red;">*</code></label>
                                                    <div class="col-md-4">
                                                        <select name="type" id="type" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $jobdesk->type == '1' ? 'selected' : '' }}>
                                                                Rutin</option>
                                                            <option value="2"
                                                                {{ $jobdesk->type == '2' ? 'selected' : '' }}>
                                                                Target</option>
                                                        </select>

                                                        @if ($errors->has('type'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="status">Status<code
                                                            style="color:red;">*</code></label>
                                                    <div class="col-md-4">
                                                        <select name="status" id="status"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $jobdesk->status == 1 ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="2"
                                                                {{ $jobdesk->status == 2 ? 'selected' : '' }}>Tidak
                                                                Aktif</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('status') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control"
                                                        for="description">Keterangan<code
                                                            style="color:red;"></code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($jobdesk->description) ? $jobdesk->description : '' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.jobdesk.index') }}" style="width:120px;"
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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
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
