@extends('layouts.app')

{{-- set title --}}
@section('title', 'Departemen')

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
          <h3 class="content-header-title mb-0 d-inline-block">Departemen</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Departemen</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.department.create') }}" class="btn btn-success col-2 mb-1">Tambah Data Departemen</a>
      <div class="card">

        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Departemen</h4>
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
                        <table class="table table-striped table-bordered text-inputs-searching default-table">
                          <thead>
                            <tr>
                              <th style="text-align:center; width:100px;">No</th>
                              <th class="text-center">Divisi</th>
                              <th class="text-center">Departemen</th>
                              <th style="text-align:center; width:150px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($department as $key => $department_item)
                              <tr data-entry-id="{{ $department_item->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                  {{ $department_item->division->name ?? '' }}</td>
                                <td class="text-center">{{ $department_item->name ?? '' }}
                                </td>
                                <td class="text-center">
                                  <div class="btn-group mr-1 mb-1">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item"
                                        href="{{ route('backsite.department.edit', encrypt($department_item->id)) }}">
                                        Edit
                                      </a>
                                      <form
                                        action="{{ route('backsite.department.destroy', encrypt($department_item->id)) }}"
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
                              {{-- not found --}}
                            @endforelse
                          </tbody>
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
