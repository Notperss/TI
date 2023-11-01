@extends('layouts.app')

{{-- set title --}}
@section('title', 'Data User')

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
          <h3 class="content-header-title mb-0 d-inline-block">Data User</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Data User</li>
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


              <a href="{{ route('backsite.employee.create') }}" class="btn btn-success col-2 mb-0">Tambah Data
                User PC </a>
              <div class="card">
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
                  <h4 class="card-title">List User PC</h4>
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
                            <th style="text-align:center; width:20px;">No</th>
                            <th class="text-center">Nip</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Departemen</th>
                            <th class="text-center">Seksi</th>
                            <th class="text-center">Tipe User</th>
                            <th style="text-align:center; width:50px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($employee as $key => $employee_item)
                            <tr data-entry-id="{{ $employee_item->id }}">
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class=" text-center h5 "> <span class="badge badge-info font-weight-bold">
                                  {{ $employee_item->nip ?? '' }}</td>
                              <td class="text-center">
                                {{ $employee_item->name ?? '' }}</td>
                              <td class="text-center">
                                {{ $employee_item->job_position ?? '' }}</td>
                              <td class="text-center">
                                {{ $employee_item->division->name ?? '' }}</td>
                              <td class="text-center">
                                {{ $employee_item->department->name ?? '' }}
                              </td>
                              <td class="text-center">
                                {{ $employee_item->section->name ?? '' }}
                              </td>
                              <td class="text-center">
                                @if ($employee_item->type_user == 1)
                                  <span class="badge badge-success">{{ 'User' }}</span>
                                @elseif($employee_item->type_user == 2)
                                  <span class="badge badge-danger">{{ 'Divisi' }}</span>
                                @else
                                  <span>{{ 'N/A' }}</span>
                                @endif
                              </td>
                              <td class="text-center">
                                <div class="btn-group mr-1 mb-1">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu">
                                    <a href="#mymodal"
                                      data-remote="{{ route('backsite.employee.show', encrypt($employee_item->id)) }}"
                                      data-toggle="modal" data-target="#mymodal" data-title="Detail User"
                                      class="dropdown-item">
                                      Show
                                    </a>
                                    <a class="dropdown-item"
                                      href="{{ route('backsite.employee.edit', encrypt($employee_item->id)) }}">
                                      Edit
                                    </a>
                                    <form action="{{ route('backsite.employee.destroy', encrypt($employee_item->id)) }}"
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
                          <tr>
                            <th>No</th>
                            <th>Program Kerja</th>
                            <th>Tahun</th>
                            <th>Umum</th>
                            <th>Teknis</th>
                            <th>Progress</th>
                            <th>Status</th>
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

@push('after-script')
  <script>
    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

    });

    $('.default-table').DataTable({
      "order": [],
      "paging": true,
      "lengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "pageLength": 10
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $('#division_id').on('change', function() {
        var idDivision = this.value;
        $("#department_id").html('');
        $.ajax({
          url: "{{ route('backsite.section.get_department') }}",
          type: "POST",
          data: {
            division_id: idDivision,
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(result) {
            $('#department_id').html(
              '<option value=""> Choose </option>');
            $.each(result.department, function(key, value) {
              $("#department_id").append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      });
      $('#department_id').on('change', function() {
        var idDepartment = this.value;
        $("#section_id").html('');
        $.ajax({
          url: "{{ route('backsite.section.get_section') }}",
          type: "POST",
          data: {
            department_id: idDepartment,
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(result) {
            $('#section_id').html(
              '<option value=""> Choose </option>');
            $.each(result.section, function(key, value) {
              $("#section_id").append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
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
