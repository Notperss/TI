@extends('layouts.app')

{{-- set title --}}
@section('title', 'Vendor TI')

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
          <h3 class="content-header-title mb-0 d-inline-block">Vendor TI</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Vendor TI</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.vendor_ti.create') }}" class="btn btn-success col-2 mb-1">Tambah Vendor TI</a>
      <div class="card">


        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Vendor TI</h4>
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
                        <table id="vendor-table"
                          class="table table-striped table-bordered text-inputs-searching default-table">
                          <thead>
                            <tr>
                              <th style="text-align:center; width:25px;">No</th>
                              <th class="text-center">Nama Vendor</th>
                              <th class="text-center">No. Telp</th>
                              <th class="text-center">PIC</th>
                              <th class="text-center">Alamat</th>
                              <th class="text-center">Status</th>
                              <th style="text-align:center; width:50px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- @forelse($vendorti as $key => $vendorti_item)
                              <tr data-entry-id="{{ $vendorti_item->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                  {{ $vendorti_item->nama_vendor ?? '' }}
                                </td>
                                <td class="text-center">
                                  {{ $vendorti_item->telp ?? '' }}
                                </td>
                                <td class="text-center">
                                  {{ $vendorti_item->pic ?? '' }}
                                </td>
                                <td class="text-center">
                                  {{ $vendorti_item->address ?? '' }}
                                </td>
                                <td class="text-center">
                                  @if ($vendorti_item->status == 1)
                                    <span class="badge badge-success">{{ 'Aktif' }}</span>
                                  @elseif($vendorti_item->status == 2)
                                    <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                  @else
                                    <span>{{ 'N/A' }}</span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <div class="btn-group mr-1 mb-1">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item"
                                        href="{{ route('backsite.vendor_ti.edit', encrypt($vendorti_item->id)) }}">
                                        Edit
                                      </a>
                                      <form
                                        action="{{ route('backsite.vendor_ti.destroy', encrypt($vendorti_item->id)) }}"
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
                            <th>Nama Vendor</th>
                            <th>No. Telp</th>
                            <th>PIC</th>
                            <th>Alamat</th>
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
  </div>
  <!-- END: Content-->

@endsection

@push('after-script')
  <script>
    var datatable = $('#vendor-table').dataTable({
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
        url: "{{ route('backsite.vendor_ti.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
        },

        {
          data: 'nama_vendor',
          name: 'nama_vendor',
        },
        {
          data: 'telp',
          name: 'telp',
        },
        {
          data: 'pic',
          name: 'pic',
        },
        {
          data: 'address',
          name: 'address',
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
