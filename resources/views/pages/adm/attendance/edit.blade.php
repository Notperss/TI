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
                  <h4 class="card-title text-white">Edit Absensi</h4>
                </div>
                <form class="form" action="{{ route('backsite.attendance.update', $attendance->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @method('put')
                  @csrf

                  <div class="form-body container ml-3">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="users_id">Nama<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input hidden type="text" id="users_id" name="users_id" class="form-control"
                          value="{{ $attendance->users_id }}" readonly>
                        <input class="form-control" value="{{ $attendance->detail_user->user->name }}" readonly>
                        @if ($errors->has('users_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('users_id') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Kategori Absensi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control">
                          <option value="" disabled selected>Choose</option>
                          @foreach ($forms as $form)
                            <option
                              value="{{ $form->name_form }}"{{ $attendance->category == $form->name_form ? 'selected' : '' }}>
                              {{ $form->name_form }}</option>
                          @endforeach
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
                          value="{{ old('start_date', $attendance->start_date) }}" autocomplete="off">
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
                          value="{{ old('finish_date', $attendance->finish_date) }}" autocomplete="off">
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
                          @if ($attendance->file)
                            <p class="mt-1">Latest File : {{ pathinfo($attendance->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $attendance->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $attendance->file) }}"
                              class="btn btn-warning btn-sm" download>
                              Unduh
                            </a>
                          @else
                            <p class="mt-1">Latest File : File not found!</p>
                          @endif
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
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
                      <div class="col-md-7" id="editor">
                        <textarea rows="5" class="form-control" id="description" name="description">{{ $attendance->description }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
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
