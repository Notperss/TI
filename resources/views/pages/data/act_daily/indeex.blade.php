@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aktivitas Harian')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Aktivitas Harian</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Aktivitas Harian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('backsite.act_daily.create') }}" class="btn btn-success col-3 mb-2">
                Tambah Aktivitas Harian</a>
            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List Aktivitas Harian</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered text-inputs-searching default-table"
                                                id='activity_table'>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">No.Aktvts</th>
                                                        <th class="text-center">Pelaksana</th>
                                                        <th class="text-center">Tgl Mulai</th>
                                                        <th class="text-center">Jenis Pekerjaan</th>
                                                        <th class="text-center">Kegiatan</th>
                                                        <th class="text-center">Tgl Selesai</th>
                                                        <th class="text-center">Status</th>
                                                        <th style="text-align:center; width:20px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($daily_activity as $key => $daily_activity_item)
                                                        <tr data-entry-id="{{ $daily_activity_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $daily_activity_item->id }}</td>
                                                            <td class="text-center">
                                                                {{ $daily_activity_item->detail_user->user->name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ date('d-m-y H:i', strtotime($daily_activity_item->start_date)) ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $daily_activity_item->work_type->job_type ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {!! $daily_activity_item->activity ?? '' !!}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ date('d-m-y H:i', strtotime($daily_activity_item->finish_date)) ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($daily_activity_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($daily_activity_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button" class="btn btn-cyan btn-sm mr-1"
                                                                        title="Tambah File"
                                                                        onclick="upload('{{ $daily_activity_item->id }}')"><i
                                                                            class="bx bx-file"></i></button>
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="btnGroupDrop2">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.act_daily.show', encrypt($daily_activity_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Aktivitas Harian"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.act_daily.edit', encrypt($daily_activity_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.act_daily.destroy', encrypt($daily_activity_item->id)) }}"
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
                                                <tfoot hidden>
                                                    <th>No</th>
                                                    <th>No. Aktivitas</th>
                                                    <th>Pelaksana</th>
                                                    <th>Tgl Mulai</th>
                                                    <th>Jenis Pekerjaan</th>
                                                    <th>Kegiatan</th>
                                                    <th>Tgl Selesai</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

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

        // test caseman
        // function link() {
        //     let windowPopUp = window.open('http://google.com', "Test Page", "width=800,height=800");

        //     windowPopUp.focus();
        // }

        function upload(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.act_daily.form_upload') }}",
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
