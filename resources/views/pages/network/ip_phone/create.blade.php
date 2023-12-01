@extends('layouts.app')

{{-- set title --}}
@section('title', 'IP Phone')
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
                  <h4 class="card-title text-white">Tambah Data IP Phone</h4>
                </div>
                <form class="form" action="{{ route('backsite.ip_phone.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="caller">Caller ID<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="caller" id="caller" class="form-control" value="{{ old('caller') }}" required>
                        @if ($errors->has('caller'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('caller') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="ip">IP<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="ip" id="ip" class="form-control" value="{{ old('ip') }}" required>
                        @if ($errors->has('ip'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('ip') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="location">Lokasi<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                        @if ($errors->has('location'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type">Tipe<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="type" id="type" class="form-control" value="{{ old('type') }}" required>
                        @if ($errors->has('type'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="barcode">Barcode<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" required>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="installation_date">Tanggal Pasang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="installation_date" name="installation_date" class="form-control"
                          value="{{ old('installation_date') }}" autocomplete="off" required>
                        @if ($errors->has('installation_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('installation_date') }}</p>
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
                          <option value="2">TIdak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
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
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.ip_phone.index') }}" class="btn btn-success text-left ml-2">
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
