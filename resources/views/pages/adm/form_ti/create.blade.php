@extends('layouts.app')

{{-- set title --}}
@section('title', 'Form')
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
                  <h4 class="card-title text-white">Tambah Data Form</h4>
                </div>
                <form class="form" action="{{ route('backsite.form_ti.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="type_form">Tipe Form<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <select name="type_form" id="type_form" class="form-control select2">
                          <option value="" disabled selected>Choose</option>
                          @foreach ($forms as $form)
                            <option value="{{ $form->name_form }}">{{ $form->name_form }}</option>
                          @endforeach
                        </select>
                        </select>
                        @if ($errors->has('type_form'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_form') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="sender">Pengirim<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" id="sender" name="sender"
                          value="{{ old('sender') }}" required>
                        </select>
                        @if ($errors->has('sender'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sender') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="division_id">Divisi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <select id="division_id" name="division_id" class="form-control select2"
                          value="{{ old('division_id') }}">
                          <option value="">Choose</option>
                          @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('division_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('division_id') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_form">Tanggal Form<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_form" name="date_form"
                          value="{{ old('date_form') }}" required>
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
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
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
                        <textarea rows="5" class="form-control mb-3" id="description" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-actions ">
                    <button type="submit" name="action" value="submit" style="width:120px;"
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
      </section>
    </div>
  </div>
  </div>

@endsection
