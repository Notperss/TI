@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Device Hardware')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Edit Device Hardware</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device Hardware</li>
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
                                        <ul class="mb-0 list-inline">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.device_hardware.update', [$device_hardware->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
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
                                                            @foreach ($type_device as $key => $type_device_item)
                                                                <option value="{{ $type_device_item->id }}"
                                                                    {{ $type_device_item->id == $device_hardware->type_device_id ? 'selected' : '' }}>
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
                                                            class="form-control"
                                                            value="{{ old('asset_device', isset($device_hardware->asset_device) ? $device_hardware->asset_device : '') }}"
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
                                                                            @foreach ($motherboard as $key => $motherboard_item)
                                                                                <option value="{{ $motherboard_item->id }}"
                                                                                    {{ $motherboard_item->id == $device_spesification_pc->motherboard_id ? 'selected' : '' }}>
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
                                                                            @foreach ($processor as $key => $processor_item)
                                                                                <option value="{{ $processor_item->id }}"
                                                                                    {{ $processor_item->id == $device_spesification_pc->processor_id ? 'selected' : '' }}>
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
                                                                            @php
                                                                                $data_ram = explode(',', $device_spesification_pc->ram_id);
                                                                            @endphp
                                                                            @foreach ($ram as $key => $ram_item)
                                                                                <option value="{{ $ram_item->id }}"
                                                                                    {{ in_array($ram_item->id, $data_ram) ? 'selected' : '' }}>
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
                                                                            @php
                                                                                $data_hardisk = explode(',', $device_spesification_pc->hardisk_id);
                                                                            @endphp
                                                                            @foreach ($hardisk as $key => $hardisk_item)
                                                                                <option value="{{ $hardisk_item->id }}"
                                                                                    {{ in_array($hardisk_item->id, $data_hardisk) ? 'selected' : '' }}>
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
                                                                            <th>No</th>
                                                                            <th>Monitor</th>
                                                                            <th>No Asset</th>
                                                                            <th>#</th>
                                                                        </tr>
                                                                        @forelse ($device_monitor as $monitor_item)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}.</td>
                                                                                <td>{{ $monitor_item->monitor->name ?? 'N/A' }}
                                                                                </td>
                                                                                <td> <span
                                                                                        class="badge badge-success">{{ $monitor_item->asset_monitor ?? 'N/A' }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="btn-sm btn-danger"
                                                                                        onclick="hapusMonitor('{{ $monitor_item->id }}')"><i
                                                                                            class="la la-trash"></i></button>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            {{-- not found --}}
                                                                        @endforelse
                                                                        <tr>
                                                                            <td colspan="2"><select name="monitor_id[]"
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
                                                                        <th>No</th>
                                                                        <th>Perangkat Tambahan</th>
                                                                        <th>No Non Asset</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                    @forelse ($device_additional as $additional_item)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}.</td>
                                                                            <td>
                                                                                {{ $additional_item->additional_device->category ?? 'N/A' }}
                                                                                -
                                                                                {{ $additional_item->additional_device->name ?? 'N/A' }}
                                                                            </td>
                                                                            <td> <span
                                                                                    class="badge badge-success">{{ $additional_item->asset_additional_device ?? 'N/A' }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn-sm btn-danger"
                                                                                    onclick="hapusAdditional('{{ $additional_item->id }}')"><i
                                                                                        class="la la-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        {{-- not found --}}
                                                                    @endforelse
                                                                    <tr>
                                                                        <td colspan="2"><select
                                                                                name="additional_device_id[]"
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
                                                            <option value="1"
                                                                {{ $device_hardware->status == 1 ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="2"
                                                                {{ $device_hardware->status == 2 ? 'selected' : '' }}>Tidak
                                                                Aktif</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('status') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="file">Ganti File
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
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($device_hardware->description) ? $device_hardware->description : '' }}</textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-right form-actions">
                                                <a href="{{ route('backsite.device_hardware.index') }}"
                                                    style="width:120px;" class="mr-1 text-white btn bg-blue-grey"
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
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/third-party/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('/assets/third-party/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
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

        function hapusMonitor(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Hapus',
                html: `Apakah anda yakin ingin menghapus data ini ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('backsite.device_hardware.hapus_monitor') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    html: response.sukses
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        }

        function hapusAdditional(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: 'Hapus',
                html: `Apakah anda yakin ingin menghapus data ini ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('backsite.device_hardware.hapus_additional') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    html: response.sukses
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        }
    </script>
@endpush
