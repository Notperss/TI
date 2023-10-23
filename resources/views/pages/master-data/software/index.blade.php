@extends('layouts.app')

{{-- set title --}}
@section('title', 'Software')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Software</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Software</li>
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

                                        <form class="form form-horizontal" action="{{ route('backsite.software.store') }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="software_name">Nama Software
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="software_name" name="software_name"
                                                            class="form-control" placeholder="Isi nama software"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('software_name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('software_name') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="software_category">Kategori
                                                        Software<code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="software_category" id="software_category"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1">Os</option>
                                                            <option value="2">Office</option>
                                                            <option value="3">Software Lisensi</option>
                                                            <option value="4">Kall</option>
                                                            <option value="5">Lain-lain</option>
                                                        </select>

                                                        @if ($errors->has('software_category'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('software_category') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="software_type">Tipe Software
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="software_type" name="software_type"
                                                            class="form-control" placeholder="Isi tipe software"
                                                            value="{{ old('software_type') }}" autocomplete="off" required>

                                                        @if ($errors->has('software_type'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('software_type') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="variant">Varian<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="variant" name="variant"
                                                            class="form-control" placeholder="Isi jumlah lisensi"
                                                            value="{{ old('variant') }}" autocomplete="off">

                                                        @if ($errors->has('variant'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('variant') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="serial_number">Serial Number
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="serial_number" name="serial_number"
                                                            class="form-control" placeholder="Isi serial number"
                                                            value="{{ old('serial_number') }}" autocomplete="off">

                                                        @if ($errors->has('serial_number'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('serial_number') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="license_amount">Jumlah
                                                        Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="license_amount" name="license_amount"
                                                            class="form-control" placeholder="Isi jumlah lisensi"
                                                            value="{{ old('license_amount') }}" autocomplete="off">

                                                        @if ($errors->has('license_amount'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('license_amount') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="start_license">Awal Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="start_license" name="start_license"
                                                            class="form-control" value="{{ old('start_license') }}"
                                                            required>

                                                        @if ($errors->has('start_license'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('start_license') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="finish_license">Akhir
                                                        Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="finish_license" name="finish_license"
                                                            class="form-control" value="{{ old('finish_license') }}">

                                                        @if ($errors->has('finish_license'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('finish_license') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_pp">No PP
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_pp" name="no_pp"
                                                            class="form-control" placeholder="Isi no pp"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('no_pp'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_pp') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="license_type">Tipe
                                                        Lisensi<code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="license_type" id="license_type"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1">Perpetual</option>
                                                            <option value="2">Subscribe</option>
                                                        </select>

                                                        @if ($errors->has('license_type'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('license_type') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="purchase_year">Tahun
                                                        Pembelian
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="purchase_year"
                                                            id="purchase_year" data-provide="datepicker"
                                                            data-date-format="yyyy" data-date-min-view-mode="2"
                                                            autocomplete="off" placeholder="Isi tahun pembelian">

                                                        @if ($errors->has('purchase_year'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('purchase_year') }}</p>
                                                        @endif
                                                    </div>
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
                                    <h4 class="card-title">List Software</h4>
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
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Nama Software</th>
                                                        <th class="text-center">Kategori Software</th>
                                                        <th class="text-center">Tipe Software</th>
                                                        <th class="text-center">Varian</th>
                                                        <th class="text-center">Jumlah Lisensi</th>
                                                        <th class="text-center">Status</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($software as $key => $software_item)
                                                        <tr data-entry-id="{{ $software_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">
                                                                {{ $software_item->software_name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($software_item->software_category == 1)
                                                                    <span>{{ 'Os' }}</span>
                                                                @elseif($software_item->software_category == 2)
                                                                    <span>{{ 'Office' }}</span>
                                                                @elseif($software_item->software_category == 3)
                                                                    <span>{{ 'Software Lisensi' }}</span>
                                                                @elseif($software_item->software_category == 4)
                                                                    <span>{{ 'Kall' }}</span>
                                                                @elseif($software_item->software_category == 5)
                                                                    <span>{{ 'Lain-lain' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $software_item->software_type ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $software_item->variant ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $software_item->license_amount ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($software_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($software_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-cyan btn-sm mr-1"
                                                                        title="Tambah File"
                                                                        onclick="upload('{{ $software_item->id }}')"><i
                                                                            class="bx bx-file"></i></button>
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="btnGroupDrop2">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.software.show', encrypt($software_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Software"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.software.edit', encrypt($software_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.software.destroy', encrypt($software_item->id)) }}"
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
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
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

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });

        // Date Picker
        const fpDate = flatpickr('#start_license', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // Date Picker
        const foDate = flatpickr('#finish_license', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // summernote 2
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

        function upload(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.software.form_upload') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalupload').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
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
