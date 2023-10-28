@extends('layouts.app')

{{-- set title --}}
@section('title', 'Program Kerja')

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
          <h3 class="content-header-title mb-0 d-inline-block">Program Kerja</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Program Kerja</li>
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

              <a href="{{ route('backsite.work_program.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Program Kerja</a>
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
                  <h4 class="card-title">List Program Kerja</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    </ul>
                  </div>
                </div>

                <div class="card-body card-dashboard">

                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Program Kerja</th>
                          <th class="text-center">Tahun</th>
                          <th class="text-center ">Umum</th>
                          <th class="text-center">Teknis</th>
                          <th class="text-center">Progress</th>
                          <th class="text-center">Status</th>
                          <th style="text-align:center; width:50px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($work_program as $key => $work_program_item)
                          <tr data-entry-id="{{ $work_program_item->id }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                              @if ($work_program_item->work_program == 1)
                                <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
                              @elseif($work_program_item->work_program == 2)
                                <span class="badge badge-warning">{{ 'Hardware' }}</span>
                              @elseif($work_program_item->work_program == 3)
                                <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
                              @elseif($work_program_item->work_program == 4)
                                <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
                              @elseif($work_program_item->work_program == 5)
                                <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
                              @else
                                <span>{{ 'N/A' }}</span>
                              @endif
                            </td>
                            <td class="text-center">
                              {{ $work_program_item->year ?? '' }}
                            </td>
                            <td class="text-center ">
                              {{ $work_program_item->general ?? '' }}
                            </td>
                            <td class="text-center">
                              {{ $work_program_item->technical ?? '' }}
                            </td>
                            <td class="text-center">
                              {{ $work_program_item->progress ?? '' }}
                            </td>
                            <td class="text-center">
                              @if ($work_program_item->status == 1)
                                <span class="badge badge-success">{{ 'Aktif' }}</span>
                              @elseif($work_program_item->status == 2)
                                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                              @else
                                <span>{{ 'N/A' }}</span>
                              @endif
                            </td>
                            <td class="text-center">
                              <div class="btn-group mr-1 mb-1">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <a href="#mymodal"
                                    data-remote="{{ route('backsite.work_program.show', encrypt($work_program_item->id)) }}"
                                    data-toggle="modal" data-target="#mymodal" data-title="Detail Program Kerja"
                                    class="dropdown-item">
                                    Show
                                  </a>
                                  <a class="dropdown-item"
                                    href="{{ route('backsite.work_program.edit', encrypt($work_program_item->id)) }}">
                                    Edit
                                  </a>
                                  <form
                                    action="{{ route('backsite.work_program.destroy', encrypt($work_program_item->id)) }}"
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

@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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

    // summernote
    $('.summernote').summernote({
      tabsize: 2,
      height: 100,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']],
      ],
    });

    $('.summernote').summernote('fontSize', '12');
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
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
