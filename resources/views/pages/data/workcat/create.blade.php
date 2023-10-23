@extends('layouts.app')

{{-- set title --}}
@section('title', 'Jenis Pekerjaan')

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

            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title text-white">Tambah Data Jenis Pekerjaan</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </a>
                </div>

                <div class="card-body card-dashboard ">
                    {{-- asdasd --}}

                    <form class="form form-horizontal" action="{{ route('backsite.workcat.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="form-body">
                            <div class="form-section">
                                <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="job_type">Jenis Pekerjaan
                                    <code style="color:red;">*</code></label>
                                <div class="col-md-7 mx-left">
                                    <input type="text" id="job_type" name="job_type" class="form-control" placeholder=""
                                        value="{{ old('job_type') }}" autocomplete="off" required>
                                    @if ($errors->has('job_type'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('job_type') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="description">Keterangan
                                    <code style="color:red;">*</code></label>
                                <div class="col-md-7 mx-left">
                                    <textarea class="form-control" placeholder="Leave a comment here" rows="3" id="description" name="description"> {{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                            </div>


                            <div class="form-actions ">
                                <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>

                                <a href="{{ route('backsite.workcat.index') }}" class="btn btn-success text-left ml-2">
                                    <i class="la la-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>

        {{-- summernote --}}
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
