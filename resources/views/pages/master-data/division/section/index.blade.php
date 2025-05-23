@extends('layouts.app')

{{-- set title --}}
@section('title', 'Seksi')

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
          <h3 class="content-header-title mb-0 d-inline-block">Seksi</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Seksi</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.section.create') }}" class="btn btn-success col-2 mb-2">
        Tambah Data Seksi</a>

      {{-- table card --}}
      <div class="content-body">
        <section id="table-home">
          <!-- Zero configuration table -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">List Seksi</h4>
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
                            <th class="text-center">Seksi</th>
                            <th style="text-align:center; width:150px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($section as $key => $section_item)
                            <tr data-entry-id="{{ $section_item->id }}">
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">
                                {{ $section_item->division->name ?? '' }}</td>
                              <td class="text-center">
                                {{ $section_item->department->name ?? '' }}
                              </td>
                              <td class="text-center">{{ $section_item->name ?? '' }}
                              </td>
                              <td class="text-center">
                                <div class="btn-group mr-1 mb-1">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                      href="{{ route('backsite.section.edit', encrypt($section_item->id)) }}">
                                      Edit
                                    </a>
                                    <form action="{{ route('backsite.section.destroy', encrypt($section_item->id)) }}"
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
{{-- 
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
    });
  </script>
@endpush --}}
