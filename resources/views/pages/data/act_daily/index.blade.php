@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aktivitas Harian')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                                                class="table table-striped table-bordered text-inputs-searching default-table activity-table"
                                                id="activity-table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No.Aktvts</th>
                                                        <th>Pelaksana</th>
                                                        <th>Tgl Mulai</th>
                                                        <th>Jenis Pekerjaan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Tgl Selesai</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot hidden>
                                                    <th>No</th>
                                                        <th>No.Aktvts</th>
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
            </div>
        </div>
        </section>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        $('#activity-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{ route('backsite.act_daily.index') }}",
            columns: [
                // {
                //     data: null,
                //     render: function(data, type, row, meta) {
                //         return meta.row + meta.settings._iDisplayStart + 1;
                //     },
                //     name: 'row_number',
                //     searchable: false,
                //     orderable: false,
                // },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable:false,
                    searchable:false,
                },
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'detail_user.user.name',
                    name: 'executor',
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                },
                {
                    data: 'work_type.job_type',
                    name: 'work_type_id',
                },
                {
                    data: 'activity',
                    name: 'activity',
                },
                {
                    data: 'finish_date',
                    name: 'finish_date',
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        if (data === '0') {
                            return '<span>N/A</span>';
                        } else if (data === '1') {
                            return '<span class="badge bg-success">Aktif</span>';
                        } else if (data === '2') {
                            return '<span class="badge bg-danger">Tidak Aktif</span>';
                        } else {
                            return '-';
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ]
        });


        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

        // $('.default-table').DataTable({
        //     "order": [],
        //     "paging": true,
        //     "lengthMenu": [
        //         [5, 10, 25, 50, 100, -1],
        //         [5, 10, 25, 50, 100, "All"]
        //     ],
        //     "pageLength": 10
        // });

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
