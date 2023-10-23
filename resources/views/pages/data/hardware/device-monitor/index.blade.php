@extends('layouts.app')

{{-- set title --}}
@section('title', 'Monitor')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Monitor</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Monitor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <a href="{{ route('backsite.device_monitor.create') }}" class="btn btn-success col-2 mb-1">Tambah
                Data Monitor</a>
            {{-- <div class="content-body">
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

                                        <form class="form" action="{{ route('backsite.device_monitor.store') }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                    </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="monitor_id">Monitor
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="monitor" name="monitor"
                                                            class="form-control" value="{{ old('monitor') }}"
                                                            autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_asset">No
                                                        Asset
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_asset" name="no_asset"
                                                            class="form-control" value="{{ old('no_asset') }}"
                                                            autocomplete="off" required>

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
            </div> --}}

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List Monitor</h4>
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
                                                        <th style="text-align:center; width:50px;">No</th>
                                                        <th style="text-align:center;">No Asset</th>
                                                        <th style="text-align:center;">Monitor</th>
                                                        <th style="text-align:center;">File</th>
                                                        <th style="text-align:center;">Keterangan</th>
                                                        <th style="text-align:center; width:100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($device_monitor as $key => $device_monitor_item)
                                                        <tr data-entry-id="{{ $device_monitor_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center"> <span
                                                                    class="badge badge-success">{{ $device_monitor_item->no_asset }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $device_monitor_item->monitor->name }}</td>
                                                            <td class="text-center">
                                                                <a data-fancybox="gallery"
                                                                    data-src="{{ asset('storage/' . $device_monitor_item->file) }}"
                                                                    class="blue accent-4 dropdown-item">Show</a>
                                                            </td>
                                                            <td class="text-center">{!! $device_monitor_item->description !!}</td>
                                                            <td class="text-center">
                                                                <div class="mb-1 mr-1 btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.device_monitor.edit', encrypt($device_monitor_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.device_monitor.destroy', encrypt($device_monitor_item->id)) }}"
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
        @endsection
