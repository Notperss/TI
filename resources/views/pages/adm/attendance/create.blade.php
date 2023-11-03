@extends('layouts.app')

{{-- set title --}}
@section('title', 'Absensi')
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
                  <h4 class="card-title text-white">Tambah Absensi</h4>
                </div>
                <form class="form" action="{{ route('backsite.attendance.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container ml-3">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="nik">Nama<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="users_id" id="users_id" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($user as $key => $user_item)
                            <option value="{{ $user_item->id }}">
                              {{ $user_item->user->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('nik'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('nik') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Kategori Absensi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1">Absen</option>
                          <option value="2">Sakit</option>
                          <option value="3">Dinas</option>
                          <option value="4">Cuti</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="start_date">Tanggal Mulai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="start_date" name="start_date" class="form-control"
                          value="{{ old('start_date') }}" autocomplete="off">
                        @if ($errors->has('start_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('start_date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="finish_date">Tanggal Selesai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="finish_date" name="finish_date" class="form-control"
                          value="{{ old('finish_date') }}" autocomplete="off">
                        @if ($errors->has('finish_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('finish_date') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        <img class="img-preview img-fluid mb-1 col-md-6">
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
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
                      <a href="{{ route('backsite.attendance.index') }}" class="btn btn-success text-left ml-2">
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
