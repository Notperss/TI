@extends('layouts.app')

{{-- set title --}}
@section('title', 'Inspection')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">



      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Inspection</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Inspection</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.inspection.create') }}" class="btn btn-success col-md-2 col-sm-6 mb-1">
        Tambah Data Inspeksi</a>

      <div class="card">
        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Informasi</h4>
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
                        <table id="inspection-table" class="table table-striped table-bordered ">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Inspektor</th>
                              <th>Lokasi</th>
                              <th>Shift</th>
                              <th>Tanggal</th>
                              <th>Keterangan</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot hidden>
                            <tr>
                              <th>No</th>
                              <th>Inspektor</th>
                              <th>Lokasi</th>
                              <th>Shift</th>
                              <th>Tanggal</th>
                              <th>Keterangan</th>
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
  </div>
  <!-- END: Content-->
@endsection

@push('after-script')
  <script>
    var datatable = $('#inspection-table').dataTable({
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
            columns: ':not(.no-print)'
          }
        },
      ],
      ajax: {
        url: "{{ route('backsite.inspection.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
        },

        {
          data: 'user.name',
          name: 'user.name',
        },
        {
          data: 'location.name',
          name: 'location.name',
        },
        {
          data: 'shift',
          name: 'shift',
        },
        {
          data: 'date_inspection',
          name: 'date_inspection',
        },
        {
          data: 'description',
          name: 'description',
        },
        // {
        //   data: 'status',
        //   name: 'status',
        //   render: function(data) {
        //     if (data === '0') {
        //       return '<span>N/A</span>';
        //     } else if (data === '1') {
        //       return '<span class="badge bg-info">Aktif</span>';
        //     } else if (data === '2') {
        //       return '<span class="badge bg-danger">Tidak Aktif</span>';
        //     } else {
        //       return '-';
        //     }
        //   }
        // },
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
  </script>
@endpush
