@extends('layouts.app')

{{-- set title --}}
@section('title', 'Motherboard')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- error --}}
      @if ($errors->any())
        <div class="mb-2 alert bg-danger alert-dismissible" role="alert">
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
        <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
          <h3 class="mb-0 content-header-title d-inline-block">Motherboard</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Motherboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <a href="{{ route('backsite.motherboard.create') }}" class="btn btn-success col-3 mb-1">Tambah
        Data Motherboard</a>

      {{-- table card --}}
      <div class="content-body">
        <section id="table-home">
          <!-- Zero configuration table -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">List Motherboard</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="mb-0 list-inline">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    </ul>
                  </div>
                </div>

                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

                    <div class="table-responsive">
                      <table class="table table-striped table-bordered text-inputs-searching default-table">
                        <thead>
                          <tr>
                            <th style="text-align:center; width:100px;">No</th>
                            <th style="text-align:center;">Merk</th>
                            <th style="text-align:center;">Keterangan</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center; width:150px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($motherboard as $key => $motherboard_item)
                            <tr data-entry-id="{{ $motherboard_item->id }}">
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $motherboard_item->name }}</td>
                              <td class="text-center">{{ $motherboard_item->description }}
                              </td>
                              <td class="text-center">
                                @if ($motherboard_item->status == 1)
                                  <span class="badge badge-success">{{ 'Aktif' }}</span>
                                @elseif($motherboard_item->status == 2)
                                  <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                @else
                                  <span>{{ 'N/A' }}</span>
                                @endif
                              </td>
                              <td class="text-center">
                                <div class="mb-1 mr-1 btn-group">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                      href="{{ route('backsite.motherboard.edit', encrypt($motherboard_item->id)) }}">
                                      Edit
                                    </a>
                                    <form
                                      action="{{ route('backsite.motherboard.destroy', encrypt($motherboard_item->id)) }}"
                                      method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="submit" class="dropdown-item" value="Delete">
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
                          <th>Name</th>
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
    $('.default-table').DataTable({
      "order": [],
      "paging": true,
      "lengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "pageLength": 10
    });
  </script>
@endpush
