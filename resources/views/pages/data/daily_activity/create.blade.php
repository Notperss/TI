@extends('layouts.app')

{{-- set title --}}
@section('title', 'Jobdesk')

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
                    <h4 class="card-title text-white">Tambah Data Jobdesk</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </a>
                </div>

                <div class="card-body card-dashboard ">
                    {{-- asdasd --}}

                    <form class="form form-horizontal" action="{{ route('backsite.daily_activity.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="form-body">
                            <div class="form-section">
                                <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                            </div>

                            <input type="hidden" id="executor" name="executor"
                                value="{{ isset($user_id) ? $user_id : '' }}">
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="executor">Pelaksana
                                    <code style="color:red;">*</code></label>
                                <div class="col-md-4">
                                    <input type="text" id="executor" class="form-control"
                                        value="{{ isset($executor) ? $executor : '' }}" readonly>

                                    @if ($errors->has('executor'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('executor') }}</p>
                                    @endif
                                </div>
                                <label class="col-md-2 label-control" for="work_category_id">Kategori
                                    Pekerjaan <code style="color:red;">*</code></label>
                                <div class="col-md-4">
                                    <select name="work_category_id" id="work_category_id" class="form-control select2"
                                        required>
                                        <option value="{{ '' }}" disabled selected>
                                            Choose
                                        </option>
                                        @foreach ($work_category as $key => $work_category_item)
                                            <option value="{{ $work_category_item->id }}">
                                                {{ $work_category_item->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('work_category_id'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('work_category_id') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="users_id">Pendamping <code
                                        style="color:red;">optional</code></label>
                                <div class="col-md-4">
                                    <select name="users_id" id="users_id" class="form-control select2">
                                        <option value="{{ '' }}" disabled selected>
                                            Choose
                                        </option>
                                        @foreach ($user as $key => $user_item)
                                            <option value="{{ $user_item->id }}">
                                                {{ $user_item->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('users_id'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('users_id') }}</p>
                                    @endif
                                </div>
                                <label class="col-md-2 label-control" for="work_type_id">Jenis
                                    Pekerjaan <code style="color:red;">*</code></label>
                                <div class="col-md-4">
                                    <select name="work_type_id" id="work_type_id" class="form-control select2" required>
                                        <option value="{{ '' }}" disabled selected>
                                            Choose
                                        </option>
                                        @foreach ($work_type as $key => $work_type_item)
                                            <option value="{{ $work_type_item->id }}">
                                                {{ $work_type_item->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('work_type_id'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('work_type_id') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="start_date">Tanggal Mulai
                                    <code style="color:red;">*</code></label>
                                <div class="col-md-4">
                                    <input type="datetime-local" id="start_date" name="start_date" class="form-control"
                                        value="{{ old('start_date') }}" required>

                                    @if ($errors->has('start_date'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('start_date') }}</p>
                                    @endif
                                </div>
                                <label class="col-md-2 label-control" for="finish_date">Tanggal
                                    Selesai
                                    <code style="color:red;">optional</code></label>
                                <div class="col-md-4">
                                    <input type="datetime-local" id="finish_date" name="finish_date" class="form-control"
                                        value="{{ old('finish_date') }}">

                                    @if ($errors->has('finish_date'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('finish_date') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="status">Status<code
                                        style="color:red;">optional</code></label>
                                <div class="col-md-4">
                                    <select name="status" id="status" class="form-control select2">
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
                                <label class="col-md-2 label-control" for="location_room_id">Lokasi
                                    <code style="color:red;">optional</code></label>
                                <div class="col-md-4">
                                    <select name="location_room_id" id="location_room_id" class="form-control select2">
                                        <option value="{{ '' }}" disabled selected>
                                            Choose
                                        </option>
                                        @foreach ($location_room as $key => $location_room_item)
                                            <option value="{{ $location_room_item->id }}">
                                                {{ $location_room_item->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('location_room_id'))
                                        <p style="font-style: bold; color: red;">
                                            {{ $errors->first('location_room_id') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="activity">Kegiatan<code
                                        style="color:red;">reqired</code></label>
                                <div class="col-md-10">
                                    <textarea rows="5" class="form-control summernote" id="activity" name="activity" required></textarea>
                                    <p class="text-muted"><small class="text-danger">Gunakan Shift
                                            + Enter jika ingin pindah baris</small></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control" for="description">Catatan<code
                                        style="color:red;">optional</code></label>
                                <div class="col-md-10">
                                    <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                    <p class="text-muted"><small class="text-danger">Gunakan Shift
                                            + Enter jika ingin pindah baris</small></p>
                                </div>
                            </div>

                        </div>

                        <div class="form-actions text-right">
                            <button type="submit" style="width:120px;" class="btn btn-cyan"
                                onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                <i class="la la-check-square-o"></i> Submit
                            </button>
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
