@extends('layouts.app')

{{-- set title --}}
@section('title', 'Barang')
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
                  <h4 class="card-title text-white">Tambah Barang</h4>
                </div>
                <form class="form" action="{{ route('backsite.barang.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Nama Barang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name"
                          value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="sku">SKU<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="sku" id="sku"
                          value="{{ old('sku') }}" required>
                        @if ($errors->has('sku'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sku') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Category</label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PC">PC</option>
                          <option value="PC AIO">PC AIO</option>
                          <option value="MONITOR">Monitor</option>
                          <option value="TV">TV</option>
                          <option value="PROYEKTOR">Proyektor</option>
                          <option value="SCANNER">Scanner</option>
                          <option value="PRINTER">Printer</option>
                          <option value="PRINTER AIO">Printer AIO</option>
                          <option value="SWITCH">Switch</option>
                          <option value="MIKROTIK">Mikrotik</option>
                          <option value="WIFI">WiFi</option>
                          <option value="CONVERTER FO">Converter FO</option>
                          <option value="SERVER">Server</option>
                          <option value="NAS">NAS</option>
                          <option value="CAMERA">Camera</option>
                          <option value="MIC">Mic</option>
                          <option value="SPEAKER">Speaker</option>
                          <option value="UPS">UPS</option>
                          <option value="CCTV">CCTV</option>
                          <option value="IP PHONE">IP Phone</option>
                          <option value="HARDDISK EXTERNAL">Hard Disk External</option>
                          <option value="PART PC">Part PC</option>
                          <option value="PART SERVER">Part Server</option>
                          <option value="PART NETWORK">Part Network</option>
                          <option value="TOOLS">Tools</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="type_assets">Tipe Assets</label>
                      <div class="col-md-4">
                        <select name="type_assets" id="type_assets" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="ASET">Aset</option>
                          <option value="ASET TI">Aset TI</option>
                          <option value="ASET LATOL">Aset Lattol</option>
                        </select>
                        @if ($errors->has('type_assets'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_assets') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="barcode">Barcode</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="barcode" id="barcode"
                          value="{{ old('barcode') }}" required>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="size">Ukuran</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="size" id="size"
                          value="{{ old('size') }}" required>
                        @if ($errors->has('size'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('size') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="brand">Merk</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="brand" id="brand"
                          value="{{ old('brand') }}" required>
                        @if ($errors->has('brand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('brand') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="stats">Status</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="stats" id="stats"
                          value="{{ old('stats') }}" required>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
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
                    <a href="{{ route('backsite.barang.index') }}" class="btn btn-success text-left ml-2">
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
