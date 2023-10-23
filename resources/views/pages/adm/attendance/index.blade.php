@extends('layouts.app')

{{-- set title --}}
@section('title', 'Absensi')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Absensi</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Absensi</li>
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

                            <a href="{{ route('backsite.attendance.create') }}" class="btn btn-success col-2 mb-2">
                                Tambah Absensi</a>
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
                                    <h4 class="card-title">List Absensi</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>


                                <div class="card-body card-dashboard">

                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered text-inputs-searching default-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Hadir</th>
                                                    <th class="text-center">Absen</th>
                                                    <th class="text-center">Izin</th>
                                                    <th class="text-center">Sakit</th>
                                                    <th class="text-center">Cuti</th>
                                                    <th class="text-center">File</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th style="text-align:center; width:50px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($attendance as $key => $attendance_item)
                                                    <tr data-entry-id="{{ $attendance_item->id }}">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $attendance_item->tanggal ?? '' }}
                                                        </td>
                                                        <td class="text-center">{{ $attendance_item->hadir ?? '' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $attendance_item->absen ?? '' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $attendance_item->izin ?? '' }}
                                                        </td>
                                                        <td class="text-center"> {{ $attendance_item->sakit ?? '' }}
                                                        </td>
                                                        <td class="text-center"> {{ $attendance_item->cuti ?? '' }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a data-fancybox
                                                                data-src="{{ asset('storage/' . $attendance_item->file) }}"
                                                                class="blue accent-4">Show</a>
                                                        </td>
                                                        <td class="text-center"> {{ $attendance_item->keterangan ?? '' }}
                                                        </td>

                                                        <td class="text-center">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button type="button"
                                                                    class="btn btn-info btn-sm dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                                                    <a href="#mymodal"
                                                                        data-remote="{{ route('backsite.attendance.show', encrypt($attendance_item->id)) }}"
                                                                        data-toggle="modal" data-target="#mymodal"
                                                                        data-title="Detail Kehadiran" class="dropdown-item">
                                                                        Show
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('backsite.attendance.edit', encrypt($attendance_item->id)) }}">
                                                                        Edit
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('backsite.attendance.destroy', encrypt($attendance_item->id)) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                        <input type="hidden" name="_method" value="DELETE">
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
                                            <tfoot hidden>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Program Kerja</th>
                                                    <th>Tahun</th>
                                                    <th>Umum</th>
                                                    <th>Teknis</th>
                                                    <th>Progress</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>

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
@push('after-script')
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



        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });
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
