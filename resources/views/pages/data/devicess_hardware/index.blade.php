@extends('layouts.app')

{{-- set title --}}
@section('title', 'Device Hardware')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="mb-2 alert bg-danger alert-dismissible" role="alert">
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
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">Device Hardware</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Device Hardware</li>
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
                                <div class="text-white card-header bg-success">
                                    <a data-action="collapse">
                                        <h4 class="text-white card-title">Tambah Data</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="mb-0 list-inline">
                                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>

                                <div class="card-content collapse hide">
                                    <div class="card-body card-dashboard">

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.device_hardware.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="type_device_id">Tipe Device
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="type_device_id" id="type_device_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($type_device as $type_device => $type_device_item)
                                                                <option value="{{ $type_device_item->id }}">
                                                                    {{ $type_device_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('type_device_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type_device_id') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="asset_device">No
                                                        Asset
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="asset_device" name="asset_device"
                                                            class="form-control" value="{{ old('asset_device') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('asset_device'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('asset_device') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mb-2" style="margin-left: 225px;">
                                                    <a class="btn btn-primary" data-toggle="collapse"
                                                        href="#multiCollapseExample1" role="button" aria-expanded="false"
                                                        aria-controls="multiCollapseExample1">PC</a>
                                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                        data-target="#multiCollapseExample2" aria-expanded="false"
                                                        aria-controls="multiCollapseExample2">Monitor</button>
                                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                        data-target="#multiCollapseExample3" aria-expanded="false"
                                                        aria-controls="multiCollapseExample3">Perangkat Tambahan</button>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                            <div class="card card-body">
                                                                <div class="form-group row">
                                                                    <label class="col-md-2 label-control"
                                                                        for="motherboard_id">Motherboard
                                                                        <code style="color:red;">required</code></label>
                                                                    <div class="col-md-4">
                                                                        <select name="motherboard_id" id="motherboard_id"
                                                                            class="form-control select2">
                                                                            <option value="{{ '' }}" disabled
                                                                                selected>
                                                                                Choose
                                                                            </option>
                                                                            @foreach ($motherboard as $motherboard => $motherboard_item)
                                                                                <option value="{{ $motherboard_item->id }}">
                                                                                    {{ $motherboard_item->name }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('motherboard_id'))
                                                                            <p style="font-style: bold; color: red;">
                                                                                {{ $errors->first('motherboard_id') }}</p>
                                                                        @endif
                                                                    </div>
                                                                    <label class="col-md-2 label-control"
                                                                        for="processor_id">Processor <code
                                                                            style="color:red;">required</code></label>
                                                                    <div class="col-md-4">
                                                                        <select name="processor_id" id="processor_id"
                                                                            class="form-control select2">
                                                                            <option value="{{ '' }}" disabled
                                                                                selected>
                                                                                Choose
                                                                            </option>
                                                                            @foreach ($processor as $processor => $processor_item)
                                                                                <option value="{{ $processor_item->id }}">
                                                                                    {{ $processor_item->name }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('processor_id'))
                                                                            <p style="font-style: bold; color: red;">
                                                                                {{ $errors->first('processor_id') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-2 label-control"
                                                                        for="ram_id">Ram <code
                                                                            style="color:red;">required</code></label>
                                                                    <div class="col-md-4">
                                                                        <label for="role">
                                                                            <span
                                                                                class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                                            <span
                                                                                class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                                        </label>
                                                                        <select name="ram_id[]" id="role"
                                                                            class="form-control select2-full-bg"
                                                                            data-bgcolor="teal"
                                                                            data-bgcolor-variation="lighten-3"
                                                                            data-text-color="black" multiple="multiple">
                                                                            @foreach ($ram as $ram => $ram_item)
                                                                                <option value="{{ $ram_item->id }}">
                                                                                    {{ $ram_item->name }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('ram_id'))
                                                                            <p style="font-style: bold; color: red;">
                                                                                {{ $errors->first('ram_id') }}</p>
                                                                        @endif
                                                                    </div>
                                                                    <label class="col-md-2 label-control"
                                                                        for="hardisk_id">Hardisk <code
                                                                            style="color:red;">required</code></label>
                                                                    <div class="col-md-4">
                                                                        <label for="roel">
                                                                            <span
                                                                                class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                                            <span
                                                                                class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                                        </label>
                                                                        <select name="hardisk_id[]" id="roel"
                                                                            class="form-control select2-full-bg"
                                                                            data-bgcolor="teal"
                                                                            data-bgcolor-variation="lighten-3"
                                                                            data-text-color="black" multiple="multiple">
                                                                            @foreach ($hardisk as $hardisk => $hardisk_item)
                                                                                <option value="{{ $hardisk_item->id }}">
                                                                                    {{ $hardisk_item->name }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('hardisk_id'))
                                                                            <p style="font-style: bold; color: red;">
                                                                                {{ $errors->first('hardisk_id') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                            <div class="card card-body">
                                                                <div class="form-group row">
                                                                    <table align="center" width="60%"
                                                                        id="dynamicTable">
                                                                        <tr>
                                                                            <th>Monitor</th>
                                                                            <th>No Asset</th>
                                                                            <th>#</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><select name="monitor_id[]"
                                                                                    id="monitor_id"
                                                                                    class="form-control select2">
                                                                                    <option value="{{ '' }}"
                                                                                        disabled selected>
                                                                                        Choose
                                                                                    </option>
                                                                                    @foreach ($monitor as $monitor => $monitor_item)
                                                                                        <option
                                                                                            value="{{ $monitor_item->id }}">
                                                                                            {{ $monitor_item->name }} -
                                                                                            {{ $monitor_item->size }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" id="asset_monitor"
                                                                                    name="asset_monitor[]"
                                                                                    class="form-control"
                                                                                    value="{{ old('asset_monitor') }}"
                                                                                    autocomplete="off">
                                                                            </td>
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn-sm btn-success"
                                                                                    id="btnPlus"><i
                                                                                        class="la la-plus"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                                                            <div class="card card-body">
                                                                <table align="center" width="60%" id="tableDevice">
                                                                    <tr>
                                                                        <th>Perangkat Tambahan</th>
                                                                        <th>No Non Asset</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><select name="additional_device_id[]"
                                                                                id="additional_device_id"
                                                                                class="form-control select2">
                                                                                <option value="{{ '' }}"
                                                                                    disabled selected>
                                                                                    Choose
                                                                                </option>
                                                                                @foreach ($additional_device as $additional_device => $additional_device_item)
                                                                                    <option
                                                                                        value="{{ $additional_device_item->id }}">
                                                                                        {{ $additional_device_item->category }}
                                                                                        -
                                                                                        {{ $additional_device_item->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                id="asset_additional_device"
                                                                                name="asset_additional_device[]"
                                                                                class="form-control"
                                                                                value="{{ old('asset_additional_device') }}"
                                                                                autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn-sm btn-success"
                                                                                id="btnTambah"><i
                                                                                    class="la la-plus"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="status">Status<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="status" id="status"
                                                            class="form-control select2">
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
                                                    <label class="col-md-2 label-control" for="file">File
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="file" name="file">
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
                                                    <label class="col-md-2 label-control"
                                                        for="description">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-right form-actions">
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
                                    <h4 class="card-title">List Device</h4>
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
                                                        <th style="text-align:center; width:100px;">No</th>
                                                        <th style="text-align:center;">No Asset</th>
                                                        <th style="text-align:center;">Tipe Device</th>
                                                        <th style="text-align:center;">File</th>
                                                        <th style="text-align:center;">Status</th>
                                                        <th style="text-align:center;">Keterangan</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($device_hardware as $key => $device_hardware_item)
                                                        <tr data-entry-id="{{ $device_hardware_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="badge badge-success">{{ $device_hardware_item->asset_device }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $device_hardware_item->type_device->name }}</td>
                                                            <td class="text-center">
                                                                <a data-fancybox="gallery"
                                                                    data-src="{{ asset('storage/' . $device_hardware_item->file) }}"
                                                                    class="blue accent-4 dropdown-item">Show</a>
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($device_hardware_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($device_hardware_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {!! $device_hardware_item->description !!}</td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.device_hardware.show', encrypt($device_hardware_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Device"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.device_hardware.edit', encrypt($device_hardware_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.device_hardware.destroy', encrypt($device_hardware_item->id)) }}"
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
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
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

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });

        // create multiple input monitor
        $("#btnPlus").click(function() {
            let msg = JSON.parse({!! json_encode($data_monitor) !!});

            $(function() {
                $.each(msg, function(i, item) {
                    $(".supervisoronly").append("<option value='" + item.id + "'>" + item.name +
                        "</option>");
                });
            });

            $("#dynamicTable").append(`
                <tr>
                    <td><select name="monitor_id[]" id="monitor_device" class="form-control select2 supervisoronly">
                            <option value="" disabled selected>Choose</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="asset_monitor" name="asset_monitor[]" class="form-control" autocomplete="off">
                    </td>
                    <td>
                        <button type="button" class="btn-sm btn-danger" id="btnMin"><i class="la la-minus"></i></button>
                    </td>
                </tr>
            `);

        });

        $(document).on('click', '#btnMin', function() {
            $(this).parents('tr').remove();
        });

        // create multiple input monitor
        $("#btnTambah").click(function() {
            let data = JSON.parse({!! json_encode($data_additional_device) !!});

            $(function() {
                $.each(data, function(i, item) {
                    $(".optional").append("<option value='" + item.id + "'>" + item.category +
                        " - " + item.name +
                        "</option>");
                });
            });

            $("#tableDevice").append(`
                <tr>
                    <td><select name="additional_device_id[]" id="additional_device" class="form-control select2 optional">
                            <option value="" disabled selected>Choose</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="asset_additional_device" name="asset_additional_device[]" class="form-control" autocomplete="off">
                    </td>
                    <td>
                        <button type="button" class="btn-sm btn-danger" id="btnKurang"><i class="la la-minus"></i></button>
                    </td>
                </tr>
            `);

        });

        $(document).on('click', '#btnKurang', function() {
            $(this).parents('tr').remove();
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
        <div class="modal-dialog  modal-lg" role="document">
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
