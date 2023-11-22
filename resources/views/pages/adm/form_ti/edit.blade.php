@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pemijaman Fasilitas')
@section('content')
  <div class="app-content content" id="pp">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data Pemijaman Fasilitas</h4>
                </div>
                <form class="form" action="{{ route('backsite.form_ti.update', $form_ti->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="type_form">Tipe Form<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <select name="type_form" id="type_form" class="form-control">
                          <option value="" disabled selected>Choose</option>
                          @foreach ($forms as $form)
                            <option
                              value="{{ $form->name_form }}"{{ $form_ti->type_form == $form->name_form ? 'selected' : '' }}>
                              {{ $form->name_form }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('type_form'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_form') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_form">No Form<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" id="no_form" name="no_form"
                          value="{{ old('no_form', $form_ti->no_form) }}" required>
                        </select>
                        @if ($errors->has('no_form'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_form') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_form">Tanggal Form<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_form" name="date_form"
                          value="{{ old('date_form', $form_ti->date_form) }}" required>
                        </select>
                        @if ($errors->has('date_form'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_form') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-5">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file" required>
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                          @if ($form_ti->file)
                            <p>Latest File : {{ pathinfo($form_ti->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $form_ti->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $form_ti->file) }}"
                              class="btn btn-warning btn-sm" download>
                              Unduh
                            </a>
                          @else
                            <p>File not found!</p>
                          @endif
                        </div>
                        <p class="text-muted mb-0"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control mb-3" id="description" name="description" required>{{ old('description', $form_ti->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-actions ">
                    <button type="submit" name="action" value="submit" style=""
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.form_ti.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
              </div>

            </div>
          </div>
      </div>
    </div>
    </section>
  </div>
  </div>

  <div class="viewmodal" style="display: none;"></div>
@endsection


@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    function thisFileDelete() {
      document.getElementById("delete_file").click();
    }
  </script>
  <script>
    function upload(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.form_ti.form_upload') }}",
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

  <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script>
@endpush
