@extends('layouts.app')

{{-- set title --}}
@section('title', 'TPT')
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
                  <h4 class="card-title text-white">Edit Data TPT</h4>
                </div>
                <form class="form" action="{{ route('backsite.tpt.update', $tpt->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description', $tpt->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date">Tanggal<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" id="date" name="date" class="form-control"
                          value="{{ old('date', $tpt->date) }}" required>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File
                        <code style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file"
                            onchange="updateList()" required>
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                          @if ($tpt->file)
                            <p>Latest File : {{ pathinfo($tpt->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $tpt->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $tpt->file) }}" class="btn btn-warning btn-sm"
                              download>
                              Unduh
                            </a>
                          @else
                            <p>File not found!</p>
                          @endif
                        </div>
                        @if ($errors->has('file'))
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
                      <a href="{{ route('backsite.tpt.index') }}" class="btn btn-success text-left ml-2">
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
