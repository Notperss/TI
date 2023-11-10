@extends('layouts.app')

{{-- set title --}}
@section('title', 'Permintaan Uang')

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
          <h3 class="content-header-title mb-0 d-inline-block">Permintaan Uang</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Permintaan Uang</li>
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

              <a href="{{ route('backsite.demand.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Data Permintaan</a>
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
                  <h4 class="card-title">List Permintaan Uang</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-body card-dashboard">

                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
                      id="demand-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tipe</th>
                          <th>Nomor</th>
                          <th>Tanggal</th>
                          <th>Nominal</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot hidden>
                        <th>No</th>
                        <th>Tipe</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
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
@endsection
@push('after-script')
  <script>
    var datatable = $('#demand-table').dataTable({
      processing: true,
      serverSide: true,
      ordering: true,
      ajax: {
        url: "{{ route('backsite.demand.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
        },
        {
          data: 'type_demand',
          name: 'type_demand',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === 'PETYCASH') {
              return '<h5><span class="badge bg-primary">Petycash</span></h5>';
            } else if (data === 'REIMBURSE') {
              return '<h5><span class="badge bg-info">Reimburse</span></h5>';
            } else {
              return '-';
            }
          },
        },
        {
          data: 'no_demand',
          name: 'no_demand',
        },
        {
          data: 'date_demand',
          name: 'date_demand',
        },
        {
          data: 'nominal',
          name: 'nominal',
        },
        {
          data: 'description',
          name: 'description',
        },
        {
          data: 'date_pj',
          name: 'date_pj',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          width: '15%',
        },
      ],
      columnDefs: [{
        className: 'text-center',
        targets: '_all'
      }, ],
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
