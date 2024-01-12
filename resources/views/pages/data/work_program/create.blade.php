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

      <div class="card">
        <div class="card-header bg-success text-white">
          <h4 class="card-title text-white">Tambah Data Program Kerja</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          </a>
        </div>

        <div class="card-body card-dashboard ">

          <form class="form form-horizontal" action="{{ route('backsite.work_program.store') }}" method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="form-body">
              <div class="form-section">
                <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
              </div>

              <div class="form-group row">
                <label class="col-md-2 label-control" for="work_program">Program Kerja
                  <code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <select name="work_program" id="work_program" class="form-control select2" required>
                    <option value="{{ '' }}" disabled selected>
                      Choose
                    </option>
                    <option value="1">Teknologi Informasi</option>
                    <option value="2">Hardware</option>
                    <option value="3">Jaringan</option>
                    <option value="4">Peralatan Tol</option>
                    <option value="5">Sistem Informasi</option>
                  </select>

                  @if ($errors->has('work_program'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('work_program') }}</p>
                  @endif
                </div>
                <label class="col-md-2 label-control" for="year">Tahun
                  <code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                    data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off" readonly required>

                  @if ($errors->has('year'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('year') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 label-control" for="general">Umum<code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <textarea rows="5" class="form-control" id="general" name="general" required></textarea>
                </div>
                <label class="col-md-2 label-control" for="technical">Teknis</label>
                <div class="col-md-4">
                  <textarea rows="5" class="form-control" id="technical" name="technical"></textarea>
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
                    <option value="0 %">0 %</option>
                    <option value="10 %">10 %</option>
                    <option value="20 %">20 %</option>
                    <option value="30 %">30 %</option>
                    <option value="40 %">40 %</option>
                    <option value="50 %">50 %</option>
                    <option value="60 %">60 %</option>
                    <option value="70 %">70 %</option>
                    <option value="80 %">80 %</option>
                    <option value="90 %">90 %</option>
                    <option value="100 %">100 %</option>
                  </select>

                  @if ($errors->has('progress'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('progress') }}</p>
                  @endif
                </div>
                <label class="col-md-2 label-control" for="status">Status<code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <select name="status" id="status" class="form-control select2">
                    <option value="{{ '' }}" disabled selected>
                      Choose
                    </option>
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>
                  </select>

                  @if ($errors->has('status'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('status') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 label-control" for="description">Keterangan</label>
                <div class="col-md-10">
                  <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                </div>
              </div>

            </div>

            <div class="form-actions ">
              <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                <i class="la la-check-square-o"></i> Submit
              </button>

              <a href="{{ route('backsite.work_program.index') }}" class="btn btn-success text-left ml-2">
                <i class="la la-arrow-left"></i> Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>

    {{-- summernote --}}
  </div>
  </div>
  <!-- END: Content-->

@endsection

@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

  <script>
    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
    });

    // // summernote
    // $('.summernote').summernote({
    //     tabsize: 2,
    //     height: 100,
    //     toolbar: [
    //         ['style', ['style']],
    //         ['font', ['bold', 'italic', 'underline', 'clear']],
    //         ['fontname', ['fontname']],
    //         ['fontsize', ['fontsize']],
    //         ['color', ['color']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['height', ['height']],
    //         ['table', ['table']],
    //         ['insert', ['link', 'picture', 'hr']],
    //         ['view', ['fullscreen', 'codeview']],
    //     ],
    // });

    // $('.summernote').summernote('fontSize', '12');
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
