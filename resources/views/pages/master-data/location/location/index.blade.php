@extends('layouts.app')

{{-- set title --}}
@section('title', 'Lokasi Utama')

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
          <h3 class="content-header-title mb-0 d-inline-block">Lokasi Utama</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Lokasi Utama</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.location.create') }}" class="btn btn-success col-3 mb-1">Tambah Lokasi Utama</a>
      <div class="card">

        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Lokasi Utama</h4>
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
                        <table id="location-table"
                          class="table table-striped table-bordered text-inputs-searching default-table">
                          <thead>
                            <tr>
                              <th style="text-align:center; width:5px;">No</th>
                              <th class="text-center">Lokasi Utama</th>
                              <th style="text-align:center; width:10px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- @forelse($location as $key => $location_item)
                              <tr data-entry-id="{{ $location_item->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $location_item->name ?? '' }}
                                </td>
                                <td class="text-center">
                                  <div class="btn-group mr-1 mb-1">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item"
                                        href="{{ route('backsite.location.edit', encrypt($location_item->id)) }}">
                                        Edit
                                      </a>
                                      <form action="{{ route('backsite.location.destroy', encrypt($location_item->id)) }}"
                                        method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="dropdown-item" value="Delete">
                                      </form>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            @empty
                            @endforelse --}}
                          </tbody>
                          <tfoot hidden>
                            <th>No</th>
                            <th>lokasi</th>
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
    var datatable = $('#location-table').dataTable({
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
        url: "{{ route('backsite.location.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          width: '5px',
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
          className: 'no-print text-center',
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
