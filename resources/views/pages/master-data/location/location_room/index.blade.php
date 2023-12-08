@extends('layouts.app')

{{-- set title --}}
@section('title', 'Ruangan')

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
          <h3 class="content-header-title mb-0 d-inline-block">Ruangan</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Ruangan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.location_room.create') }}" class="btn btn-success col-2 mb-1">Tambah Ruangan</a>
      <div class="card">

        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Ruangan</h4>
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
                        <table class="table table-striped table-bordered text-inputs-searching default-table"
                          id="room_location">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Lokasi</th>
                              <th>Sub Lokasi</th>
                              <th>Ruangan</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot hidden>
                            <th>No</th>
                            <th>Lokasi</th>
                            <th>Sub Lokasi</th>
                            <th>Ruangan</th>
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
  </div>

  <!-- END: Content-->

@endsection
@push('after-script')
  <script>
    var datatable = $('#room_location').dataTable({
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
        url: "{{ route('backsite.location_room.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          width: '3%',
        },
        {
          data: 'location.name',
          name: 'location.name',
        },
        {
          data: 'sub_location.name',
          name: 'sub_location.name',
        },
        {
          data: 'name',
          name: 'name',
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
