@extends('layouts.app')

{{-- set title --}}
@section('title', 'Barang')

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
          <h3 class="content-header-title mb-0 d-inline-block">Barang</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Barang</li>
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

              <a href="{{ route('backsite.barang.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Data Barang</a>
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
                  <h4 class="card-title">List Barang</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-body card-dashboard">

                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table "
                      id="barang-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Barcode</th>
                          <th>Nama Barang</th>
                          <th>Category</th>
                          <th>User</th>
                          <th>Tanggal Pinjam</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot hidden>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Category</th>
                        <th>Barcode</th>
                        <th>File</th>
                        <th>File</th>
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
    var datatable = $('#barang-table').dataTable({
      processing: true,
      serverSide: true,
      ordering: false,
      dom: 'Bfrtip',
      lengthMenu: [10, 25, 50, 75, 100, 250],
      buttons: [{
          extend: 'copy',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'excel',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'print',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'pageLength',
          className: "btn btn-info",
        },
      ],
      ajax: {
        url: "{{ route('backsite.barang.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,

        },
        {
          data: 'barcode',
          name: 'barcode',
        },
        {
          data: 'name',
          name: 'name',
        },
        {
          data: 'category',
          name: 'category',
        },
        {
          data: 'distribution_asset',
          name: 'distribution_asset',
          searchable: false,

        },
        {
          data: 'distribution_asset_created_at',
          name: 'distribution_asset_created_at',
          searchable: false,

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
