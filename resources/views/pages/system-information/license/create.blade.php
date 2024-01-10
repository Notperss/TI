@extends('layouts.app')

{{-- set title --}}
@section('title', 'Lisensi')
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
                  <h4 class="card-title text-white">Tambah Data Lisensi</h4>
                </div>
                <form class="form" action="{{ route('backsite.license.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code> (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_app">Nama Aplikasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_app" name="name_app"
                          value="{{ old('name_app') }}" Required>
                        </select>
                        @if ($errors->has('name_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_app') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type_app">Tipe Aplikasi</label>
                      <div class="col-md-4">
                        <select name="type_app" id="type_app" class="form-control select2">
                          <option value="" disabled selected>Choose</option>
                          <option value="LISENSI">Lisensi</option>
                          <option value="NON LISENSI">Non Lisensi</option>
                        </select>
                        </select>
                        @if ($errors->has('type_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_app') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_vendor">Nama Produsen</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_vendor" name="name_vendor"
                          value="{{ old('name_vendor') }}">
                        </select>
                        @if ($errors->has('name_vendor'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_vendor') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="product">Product</label>
                      <div class="col-md-4">
                        <select name="product" id="product" class="form-control select2">
                          <option value="" disabled selected>Choose</option>
                          <option value="MICROSOFT">Microsoft</option>
                          <option value="NON MICROSOFT">Non Microsoft</option>
                        </select>
                        </select>
                        @if ($errors->has('product'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('product') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="version">Versi</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="version" name="version"
                          value="{{ old('version') }}">
                        </select>
                        @if ($errors->has('version'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('version') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="date_start">Tanggal Mulai</label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="{{ old('date_start') }}">
                        </select>
                        @if ($errors->has('date_start'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_start') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="pp">PP</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="pp" name="pp"
                          value="{{ old('pp') }}">
                        </select>
                        @if ($errors->has('pp'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('pp') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="date_finish">Tanggal Berakhir</label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_finish" name="date_finish"
                          value="{{ old('date_finish') }}">
                        </select>
                        @if ($errors->has('date_finish'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_finish') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="barcode">Barcode</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="barcode" name="barcode"
                          value="{{ old('barcode') }}">
                        </select>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="num_of_licenses">Jumlah Lisensi</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="num_of_licenses" name="num_of_licenses"
                          value="{{ old('num_of_licenses') }}">
                        </select>
                        @if ($errors->has('num_of_licenses'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('num_of_licenses') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan</label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
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
