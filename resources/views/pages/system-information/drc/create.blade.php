@extends('layouts.app')

{{-- set title --}}
@section('title', 'DRC')
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
                  <h4 class="card-title text-white">Tambah Data DRC</h4>
                </div>
                <form class="form" action="{{ route('backsite.drc.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Nama Item<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name"
                          value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_source">Path Source<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" name="path_source" id="path_source" class="form-control"
                          value="{{ old('path_source') }}" required>
                        @if ($errors->has('path_source'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_source') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Category Item<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="APLIKASI">Aplikasi</option>
                          <option value="DATABASE">Database</option>
                          <option value="FILE">File</option>
                          <option value="DOKUMEN">Dokumen</option>
                          <option value="SOURCECODE">Source Code</option>
                          <option value="VM">VM</option>
                          <option value="LAIN-LAIN">Lain-lain</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="path_backup">Path Backup<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" name="path_backup" id="path_backup" class="form-control"
                          value="{{ old('path_backup') }}" required>
                        @if ($errors->has('path_backup'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_backup') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="backup_frequency">Backup Frequency<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="backup_frequency" id="backup_frequency" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="6JAM">6 Jam</option>
                          <option value="12JAM">12 Jam</option>
                          <option value="FILE">File</option>
                          <option value="PERHARI">Perhari</option>
                          <option value="PERMINGGU">Perminggu</option>
                          <option value="PERBULAN">Perbulan</option>
                        </select>
                        @if ($errors->has('backup_frequency'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('backup_frequency') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="path_drc">Path DRC<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" name="path_drc" id="path_drc" class="form-control"
                          value="{{ old('path_drc') }}" required>
                        @if ($errors->has('path_drc'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_drc') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="backup_time">Jam Backup<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" name="backup_time" id="backup_time" class="form-control"
                          value="{{ old('backup_time') }}" required>
                        @if ($errors->has('backup_time'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('backup_time') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required></textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-actions ">
                      <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Submit
                      </button>
                      <a href="{{ route('backsite.drc.index') }}" class="btn btn-success text-left ml-2">
                        <i class="la la-arrow-left"></i> Kembali</a>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>


@endsection
