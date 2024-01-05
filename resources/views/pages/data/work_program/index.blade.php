@extends('layouts.app')

{{-- set title --}}
@section('title', 'Program Kerja')

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
          <h3 class="content-header-title mb-0 d-inline-block">Program Kerja</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Program Kerja</li>
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

              <a href="{{ route('backsite.work_program.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Program Kerja</a>
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
                  <h4 class="card-title">List Program Kerja</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    </ul>
                  </div>
                </div>

                <div class="card-body card-dashboard">

                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table" id="work-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Program Kerja</th>
                          <th>Tahun</th>
                          <th>Umum</th>
                          <th>Teknis</th>
                          <th>Progress</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
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

@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}

  <script>
    var datatable = $('#work-table').dataTable({
      processing: true,
      serverSide: true,
      ordering: false,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'copy',
          className: "btn btn-info"
        },
        {
          extend: 'excel',
          className: "btn btn-info"
        },
        {
          extend: 'print',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
      ],
      ajax: {
        url: "{{ route('backsite.work_program.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,

        },
        {
          data: 'work_program',
          name: 'work_program',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === '1') {
              return '<span class="badge badge-success">Teknologi Informasi</span>';
            } else if (data === '2') {
              return '<span class="badge bg-warning">Hardware</span>';
            } else if (data === '3') {
              return '<span class="badge bg-secondary">Jaringan</span>';
            } else if (data === '4') {
              return '<span class="badge bg-danger">Peralatan Tol</span>';
            } else if (data === '5') {
              return '<span class="badge bg-info">Sistem Informasi</span>';
            } else {
              return '-';
            }
          }

        },
        {
          data: 'year',
          name: 'year',
        },
        {
          data: 'general',
          name: 'general',
        },
        {
          data: 'technical',
          name: 'technical',
        },
        {
          data: 'progress',
          name: 'progress',
        },
        {
          data: 'status',
          name: 'status',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === '2') {
              return '<span class="badge bg-danger">Tidak Aktif</span>';
            } else if (data === '1') {
              return '<span class="badge bg-success">Aktif</span>';
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
          width: '15%',
          className: 'no-print'
        },
      ],
      columnDefs: [{
        className: 'text-center',
        targets: '_all'
      }, ],
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
    //   "order": [],
    //   "paging": true,
    //   "lengthMenu": [
    //     [5, 10, 25, 50, 100, -1],
    //     [5, 10, 25, 50, 100, "All"]
    //   ],
    //   "pageLength": 10

    // });
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
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
