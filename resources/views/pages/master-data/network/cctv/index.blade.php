@extends('layouts.app')

{{-- set title --}}
@section('title', 'CCTV')

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
                    <h3 class="content-header-title mb-0 d-inline-block">CCTV</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">CCTV</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <a data-action="collapse">
                                        <h4 class="card-title text-white">Tambah Data</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>

                                <div class="card-content collapse hide">
                                    <div class="card-body card-dashboard">

                                        <form class="form form-horizontal" action="{{ route('backsite.cctv.store') }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="name">Nama <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="latitude">Latitude <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="latitude" name="latitude"
                                                            class="form-control" placeholder="example -6.229121731299446"
                                                            value="{{ old('latitude') }}" autocomplete="off" required>

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
                                                            class="form-control" placeholder="example KM 24 + 800"
                                                            value="{{ old('km') }}" autocomplete="off" required>

                                                        @if ($errors->has('km'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('km') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="longitude">Longitude <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="longitude" name="longitude"
                                                            class="form-control" placeholder="example 106.875659"
                                                            value="{{ old('longitude') }}" autocomplete="off" required>

                                                        @if ($errors->has('longitude'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('longitude') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="link_cctv">Link CCTV <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="link_cctv" name="link_cctv"
                                                            class="form-control" placeholder="example youtube.com"
                                                            value="{{ old('link_cctv') }}" autocomplete="off" required>

                                                        @if ($errors->has('link_cctv'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('link_cctv') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="logo">Logo
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="logo" name="logo" required>
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
                                                        <textarea rows="4" class="form-control summernote" id="description" name="description"></textarea>
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

                        </div>
                    </div>
                </section>
            </div>

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List CCTV</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered text-inputs-searching default-table">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center; width:50px;">No</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">KM</th>
                                                        <th class="text-center">Latitude</th>
                                                        <th class="text-center">Longitude</th>
                                                        <th class="text-center">Link CCTV</th>
                                                        <th class="text-center">Logo</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($cctv as $key => $cctv_item)
                                                        <tr data-entry-id="{{ $cctv_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $cctv_item->name ?? '' }}</td>
                                                            <td class="text-center">{{ $cctv_item->km ?? '' }}</td>
                                                            <td class="text-center">{{ $cctv_item->latitude ?? '' }}</td>
                                                            <td class="text-center">{{ $cctv_item->longitude ?? '' }}</td>
                                                            <td class="text-center"><a
                                                                    href="{{ $cctv_item->link_cctv ?? '' }}"
                                                                    target="_blank">CCTV
                                                                    {{ $cctv_item->name ?? '' }}</a></td>
                                                            <td class="text-center"><img
                                                                    src="{{ asset('storage/' . $cctv_item->logo) }}"
                                                                    alt="Logo CCTV" width="50px">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.cctv.show', encrypt($cctv_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail CCTV"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.cctv.edit', encrypt($cctv_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.cctv.destroy', encrypt($cctv_item->id)) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <input type="hidden" name="_token"
                                                                                value="{{ csrf_token() }}">
                                                                            <input type="submit" class="dropdown-item"
                                                                                value="Delete">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{-- not found --}}
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>KM</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Link CCTV</th>
                                                        <th>Logo</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

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
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10
        });

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

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
