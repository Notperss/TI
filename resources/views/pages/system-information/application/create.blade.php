@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aplikasi')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data Aplikasi</h4>
                </div>
                <form class="form" action="{{ route('backsite.application.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_app">Nama Aplikasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_app" name="name_app"
                          value="{{ old('name_app') }}" required>
                        </select>
                        @if ($errors->has('name_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_app') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_app">Path Aplikasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_app" name="path_app"
                          value="{{ old('path_app') }}" required>
                        </select>
                        @if ($errors->has('path_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_app') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="user">User<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="user" name="user"
                          value="{{ old('user') }}" required>
                        </select>
                        @if ($errors->has('user'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('user') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_database">Path Database<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_database" name="path_database"
                          value="{{ old('path_database') }}" required>
                        </select>
                        @if ($errors->has('path_database'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_database') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="creator">Pembuat<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="creator" name="creator"
                          value="{{ old('creator') }}" required>
                        </select>
                        @if ($errors->has('creator'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('creator') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_file">Path File/Dokumen<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_file" name="path_file"
                          value="{{ old('path_file') }}" required>
                        </select>
                        @if ($errors->has('path_file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_start">Tanggal Mulai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="{{ old('date_start') }}" required>
                        </select>
                        @if ($errors->has('date_start'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_start') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="date_finish">Tanggal Selesai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_finish" name="date_finish"
                          value="{{ old('date_finish') }}" required>
                        </select>
                        @if ($errors->has('date_finish'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_finish') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code
                          style="color:red;">*</code></label>
                      <div class="col-md-3">
                        <select name="stats" id="stats" class="form-control select2">
                          <option value="" disabled selected>Choose</option>
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
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
                    <a href="{{ route('backsite.application.index') }}" class="btn btn-success text-left ml-2">
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
