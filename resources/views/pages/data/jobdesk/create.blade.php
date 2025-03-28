@extends('layouts.app')

{{-- set title --}}
@section('title', 'Jobdesk')

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
          <h4 class="card-title text-white">Tambah Data Jobdesk</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          </a>
        </div>

        <div class="card-body card-dashboard ">

          <form class="form form-horizontal" action="{{ route('backsite.jobdesk.store') }}" method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="form-body">
              <div class="form-section">
                <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
              </div>

              <div class="form-group row">
                <label class="col-md-2 label-control" for="jobdesk">Jobdesk
                  <code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <select name="jobdesk" id="jobdesk" class="form-control select2" required>
                    <option value="" disabled selected>
                      Choose
                    </option>

                    <option value="1" {{ old('jobdesk') == 1 ? 'selected' : '' }}>
                      Teknologi Informasi</option>
                    <option value="2" {{ old('jobdesk') == 2 ? 'selected' : '' }}>
                      Hardware</option>
                    <option value="3" {{ old('jobdesk') == 3 ? 'selected' : '' }}>
                      Jaringan</option>
                    <option value="4" {{ old('jobdesk') == 4 ? 'selected' : '' }}>
                      Peralatan Tol</option>
                    <option value="5" {{ old('jobdesk') == 5 ? 'selected' : '' }}>
                      Sistem Informasi</option>
                  </select>

                  @if ($errors->has('jobdesk'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('jobdesk') }}</p>
                  @endif
                </div>
                <label class="col-md-2 label-control" for="year">Tahun
                  <code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                    data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off" value="{{ old('year') }}"
                    required>

                  @if ($errors->has('year'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('year') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 label-control" for="general">Umum<code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <textarea rows="5" class="form-control" id="general" name="general" required>{{ old('general') }}</textarea>
                  @if ($errors->has('general'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('type') }}</p>
                  @endif
                </div>

                <label class="col-md-2 label-control" for="technical">Teknis<code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <textarea rows="5" class="form-control" id="technical" name="technical" required>{{ old('technical') }}</textarea>
                  @if ($errors->has('technical'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('type') }}</p>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2 label-control" for="type">Jenis
                  <code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <select name="type" id="type" class="form-control select2" required>
                    <option value="{{ '' }}" disabled selected>
                      Choose
                    </option>
                    <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>Rutin</option>
                    <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>target</option>

                  </select>

                  @if ($errors->has('type'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('type') }}</p>
                  @endif
                </div>
                <label class="col-md-2 label-control" for="status">Status<code style="color:red;">*</code></label>
                <div class="col-md-4">
                  <select name="status" id="status" class="form-control select2" required>
                    <option value="{{ '' }}" disabled selected>
                      Choose
                    </option>
                    <option value="1" @if (old('status') == 1) {{ 'selected' }} @endif>Aktif</option>
                    <option value="2" @if (old('status') == 2) {{ 'selected' }} @endif> Tidak Aktif
                    </option>
                  </select>

                  @if ($errors->has('status'))
                    <p style="font-style: bold; color: red;">
                      {{ $errors->first('status') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 label-control" for="description">Keterangan<code style="color:red;"></code></label>
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

              <a href="{{ route('backsite.jobdesk.index') }}" class="btn btn-success text-left ml-2">
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

    // summernote
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
