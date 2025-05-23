@extends('layouts.app')

{{-- set title --}}
@section('title', 'Informasi')

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
          <h3 class="content-header-title mb-0 d-inline-block">Informasi</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Informasi</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.information.create') }}" class="btn btn-success col-2 mb-1">Tambah Informasi</a>
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
                        <table id="information-table"
                          class="table table-striped table-bordered text-inputs-searching default-table">
                          <thead>
                            <tr>
                              <th style="text-align:center; width:100px;">No</th>
                              <th class="text-center">Informasi</th>
                              <th class="text-center">Keterangan</th>
                              <th class="text-center">Status</th>
                              <th style="text-align:center; width:150px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- @forelse($information as $key => $information_item)
                                                            <tr data-entry-id="{{ $information_item->id }}">
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td class="text-center">
                                                                    {{ $information_item->informasi ?? '' }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $information_item->keterangan ?? '' }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($information_item->status == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Aktif' }}</span>
                                                                    @elseif($information_item->status == 2)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('backsite.information.edit', encrypt($information_item->id)) }}">
                                                                                Edit
                                                                            </a>
                                                                            <form
                                                                                action="{{ route('backsite.information.destroy', encrypt($information_item->id)) }}"
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
                                                          
                                                        @endforelse --}}
                          </tbody>
                          <tfoot hidden>
                            <tr>
                              <th>No</th>
                              <th>Informasi</th>
                              <th>Keterangan</th>
                              <th>Status</th>
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
    var datatable = $('#information-table').dataTable({
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
        url: "{{ route('backsite.information.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
        },

        {
          data: 'informasi',
          name: 'informasi',
        },
        {
          data: 'keterangan',
          name: 'keterangan',
        },
        {
          data: 'status',
          name: 'status',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === '1') {
              return '<span class="badge bg-info">Aktif</span>';
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
