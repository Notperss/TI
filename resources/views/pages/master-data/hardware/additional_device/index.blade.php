@extends('layouts.app')

{{-- set title --}}
@section('title', 'Perangkat Tambahan')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Perangkat Tambahan</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Perangkat Tambahan</li>
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
                                            action="{{ route('backsite.additional_device.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Nama <code
                                                            style="color:red;">required</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="isi nama perangkat"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="category">Kategori<code
                                                            style="color:red;">required</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <select name="category" id="category" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="Keyboard">Keyboard</option>
                                                            <option value="Mouse">Mouse</option>
                                                            <option value="Webcam">Webcam</option>
                                                            <option value="Switch kecil">Switch Kecil</option>
                                                            <option value="Mikrotik kecil">Mikrotik Kecil</option>
                                                        </select>

                                                        @if ($errors->has('category'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('category') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="specification">Spesifikasi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <input type="text" id="specification" name="specification"
                                                            class="form-control" placeholder="isi spesifikasi perangkat"
                                                            value="{{ old('specification') }}" autocomplete="off">

                                                        @if ($errors->has('specification'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('specification') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="file">File
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="mx-auto col-md-9">
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
                                                    <label class="col-md-3 label-control" for="status">Status<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="mx-auto col-md-9">
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
                                    <h4 class="card-title">List Perangkat Tambahan</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="mb-0 list-inline">
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
                                                        <th style="text-align:center;">Name</th>
                                                        <th style="text-align:center;">Kategori</th>
                                                        <th style="text-align:center;">Spesifikasi</th>
                                                        <th style="text-align:center;">File</th>
                                                        <th style="text-align:center;">Status</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($additional_device as $key => $additional_device_item)
                                                        <tr data-entry-id="{{ $additional_device_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $additional_device_item->name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $additional_device_item->category }}</td>
                                                            <td class="text-center">
                                                                {{ $additional_device_item->specification }}</td>
                                                            <td class="text-center">
                                                                <a data-fancybox="gallery"
                                                                    data-src="{{ asset('storage/' . $additional_device_item->file) }}"
                                                                    class="blue accent-4 dropdown-item">Show</a>
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($additional_device_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($additional_device_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="mb-1 mr-1 btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.additional_device.edit', encrypt($additional_device_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.additional_device.destroy', encrypt($additional_device_item->id)) }}"
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
                                                        <th>Name</th>
                                                        <th>Kategori</th>
                                                        <th>Spesifikasi</th>
                                                        <th>File</th>
                                                        <th>Status</th>
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
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

    <script>
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
    </script>
@endpush
