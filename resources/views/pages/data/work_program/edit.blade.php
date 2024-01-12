@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Program Kerja')

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
          <h3 class="content-header-title mb-0 d-inline-block">Edit Program Kerja</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Program Kerja</li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      {{-- forms --}}
      <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal"
                      action="{{ route('backsite.work_program.update', [$work_program->id]) }}" method="POST"
                      enctype="multipart/form-data">

                      @method('PUT')
                      @csrf

                      <div class="form-body">
                        <div class="form-section">
                          <p>Isi input <code>required (*)</code>, Sebelum menekan tombol submit.
                          </p>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="work_program">Program Kerja
                            <code style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <select name="work_program" id="work_program" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose
                              </option>
                              <option value="1" {{ $work_program->work_program == 1 ? 'selected' : '' }}>
                                Teknologi Informasi</option>
                              <option value="2" {{ $work_program->work_program == 2 ? 'selected' : '' }}>
                                Hardware</option>
                              <option value="3" {{ $work_program->work_program == 3 ? 'selected' : '' }}>
                                Jaringan</option>
                              <option value="4" {{ $work_program->work_program == 4 ? 'selected' : '' }}>
                                Peralatan Tol</option>
                              <option value="5" {{ $work_program->work_program == 5 ? 'selected' : '' }}>
                                Sistem Informasi</option>
                            </select>

                            @if ($errors->has('work_program'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('work_program') }}</p>
                            @endif
                          </div>
                          <label class="col-md-2 label-control" for="year">Tahun
                            <code style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" name="year" id="year"
                              data-provide="datepicker" data-date-format="yyyy" data-date-min-view-mode="2"
                              value="{{ isset($work_program->year) ? $work_program->year : '' }}" autocomplete="off"
                              readonly required>

                            @if ($errors->has('year'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('year') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="general">Umum<code
                              style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <textarea rows="5" class="form-control" id="general" name="general" required>{{ isset($work_program->general) ? $work_program->general : '' }}</textarea>
                          </div>
                          <label class="col-md-2 label-control" for="technical">Teknis<code
                              style="color:red;"></code></label>
                          <div class="col-md-4">
                            <textarea rows="5" class="form-control" id="technical" name="technical">{{ isset($work_program->technical) ? $work_program->technical : '' }}</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="progress">Progress
                            <code style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <select name="progress" id="progress" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose
                              </option>
                              <option value="0 %" {{ $work_program->progress == '0 %' ? 'selected' : '' }}>
                                0 %</option>
                              <option value="10 %" {{ $work_program->progress == '10 %' ? 'selected' : '' }}>
                                10 %</option>
                              <option value="20 %" {{ $work_program->progress == '20 %' ? 'selected' : '' }}>
                                20 %</option>
                              <option value="30 %" {{ $work_program->progress == '30 %' ? 'selected' : '' }}>
                                30 %</option>
                              <option value="40 %" {{ $work_program->progress == '40 %' ? 'selected' : '' }}>
                                40 %</option>
                              <option value="50 %" {{ $work_program->progress == '50 %' ? 'selected' : '' }}>
                                50 %</option>
                              <option value="60 %" {{ $work_program->progress == '60 %' ? 'selected' : '' }}>
                                60 %</option>
                              <option value="70 %" {{ $work_program->progress == '70 %' ? 'selected' : '' }}>
                                70 %</option>
                              <option value="80 %" {{ $work_program->progress == '80 %' ? 'selected' : '' }}>
                                80 %</option>
                              <option value="90 %" {{ $work_program->progress == '90 %' ? 'selected' : '' }}>
                                90 %</option>
                              <option value="100 %" {{ $work_program->progress == '100 %' ? 'selected' : '' }}>
                                100 %</option>
                            </select>

                            @if ($errors->has('progress'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('progress') }}</p>
                            @endif
                          </div>
                          <label class="col-md-2 label-control" for="status">Status<code
                              style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <select name="status" id="status" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose
                              </option>
                              <option value="1" {{ $work_program->status == 1 ? 'selected' : '' }}>Aktif
                              </option>
                              <option value="2" {{ $work_program->status == 2 ? 'selected' : '' }}>Tidak
                                Aktif</option>
                            </select>

                            @if ($errors->has('status'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('status') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="description">Keterangan<code
                              style="color:red;"></code></label>
                          <div class="col-md-10">
                            <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($work_program->description) ? $work_program->description : '' }}</textarea>
                          </div>
                        </div>

                      </div>

                      <div class="form-actions text-right">
                        <a href="{{ route('backsite.work_program.index') }}" style="width:120px;"
                          class="btn btn-warning text-white mr-1"
                          onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                          <i class="ft-x"></i> Kembali
                        </a>
                        <button type="submit" style="width:120px;" class="btn btn-cyan"
                          onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                          <i class="la la-check-square-o"></i> Submit
                        </button>
                      </div>
                    </form>

                    <hr class="rounded">
                    {{-- File --}}
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                          title="Tambah file" onclick="upload({{ $work_program->id }})"><i class="bx bx-file"></i>
                          Tambah File</button>
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered default-table activity-table mb-4"
                        aria-label="">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">File</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        @forelse ($files as $file)
                          <tbody>
                            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $file->uraian }}</td>
                            <td class="text-center">
                              {{ Carbon\Carbon::parse($file->date)->translatedFormat('l, d F Y') }}</td>
                            <td class="text-center">{{ $file->description ? $file->description : 'N/A' }}</td>
                            <td class="text-center">
                              <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}"
                                class="btn btn-info btn-sm text-white ">
                                Lihat
                              </a> <a type="button" href="{{ asset('storage/' . $file->file) }}"
                                class="btn btn-warning btn-sm text-white" download>Unduh</a>
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form action="{{ route('backsite.work_program.delete_file', $file->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_file" class="btn"value="Delete">
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tbody>
                        @empty
                          <td class="text-center" colspan="6">No data available in table</td>
                        @endforelse
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
  <div class="viewmodal" style="display: none;"></div>

  <!-- END: Content-->

@endsection

@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    function upload(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.work_program.form_upload') }}",
        data: {
          id: id
        },
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#upload').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }
  </script>
@endpush
