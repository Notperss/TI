@extends('layouts.app')

{{-- set title --}}
@section('title', 'Barang')
@section('content')
  <div class="app-content content" id="app">
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
                <form class="form" action="{{ route('backsite.barang.update', $barang->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <input name="stats" id="stats" class="form-control" value="1" hidden>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Nama Barang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name"
                          value="{{ old('name', $barang->name) }}" @if ($assets->isEmpty()) @else readonly @endif
                          required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="sku">SKU</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="sku" id="sku"
                          value="{{ old('sku', $barang->sku) }}" @if ($assets->isEmpty()) @else readonly @endif>
                        @if ($errors->has('sku'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sku') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Category<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select21" onchange="showDiv(this)"
                          @if ($assets->isEmpty()) @else disabled @endif required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PC" {{ $barang->category == 'PC' ? 'selected' : '' }}>PC</option>
                          <option value="PC AIO"{{ $barang->category == 'PC AIO' ? 'selected' : '' }}>PC AIO</option>
                          <option value="MONITOR"{{ $barang->category == 'MONITOR' ? 'selected' : '' }}>Monitor</option>
                          <option value="TV"{{ $barang->category == 'TV' ? 'selected' : '' }}>TV</option>
                          <option value="PROYEKTOR"{{ $barang->category == 'PROYEKTOR' ? 'selected' : '' }}>Proyektor
                          </option>
                          <option value="SCANNER"{{ $barang->category == 'SCANNER' ? 'selected' : '' }}>Scanner</option>
                          <option value="PRINTER"{{ $barang->category == 'PRINTER' ? 'selected' : '' }}>Printer</option>
                          <option value="PRINTER AIO"{{ $barang->category == 'PRINTER AIO' ? 'selected' : '' }}>Printer
                            AIO</option>
                          <option value="SWITCH"{{ $barang->category == 'SWITCH' ? 'selected' : '' }}>Switch</option>
                          <option value="MIKROTIK"{{ $barang->category == 'MIKROTIK' ? 'selected' : '' }}>Mikrotik
                          </option>
                          <option value="WIFI"{{ $barang->category == 'WIFI' ? 'selected' : '' }}>WiFi</option>
                          <option value="CONVERTER FO"{{ $barang->category == 'CONVERTER FO' ? 'selected' : '' }}>
                            Converter FO</option>
                          <option value="SERVER"{{ $barang->category == 'SERVER' ? 'selected' : '' }}>Server</option>
                          <option value="NAS"{{ $barang->category == 'NAS' ? 'selected' : '' }}>NAS</option>
                          <option value="CAMERA"{{ $barang->category == 'CAMERA' ? 'selected' : '' }}>Camera</option>
                          <option value="MIC"{{ $barang->category == 'MIC' ? 'selected' : '' }}>Mic</option>
                          <option value="SPEAKER"{{ $barang->category == 'SPEAKER' ? 'selected' : '' }}>Speaker</option>
                          <option value="UPS"{{ $barang->category == 'UPS' ? 'selected' : '' }}>UPS</option>
                          <option value="CCTV"{{ $barang->category == 'CCTV' ? 'selected' : '' }}>CCTV</option>
                          <option value="IP PHONE"{{ $barang->category == 'IP PHONE' ? 'selected' : '' }}>IP Phone
                          </option>
                          <option
                            value="HARDDISK EXTERNAL"{{ $barang->category == 'HARDDISK EXTERNAL' ? 'selected' : '' }}>
                            Hard Disk External</option>
                          <option value="PART PC"{{ $barang->category == 'PART PC' ? 'selected' : '' }}>Part PC</option>
                          <option value="LAPTOP"{{ $barang->category == 'LAPTOP' ? 'selected' : '' }}>Laptop</option>
                          <option value="PART SERVER"{{ $barang->category == 'PART SERVER' ? 'selected' : '' }}>Part
                            Server</option>
                          <option value="PART NETWORK"{{ $barang->category == 'PART NETWORK' ? 'selected' : '' }}>Part
                            Network</option>
                          <option value="TOOLS"{{ $barang->category == 'TOOLS' ? 'selected' : '' }}>Tools</option>
                          <option value="MR"{{ $barang->category == 'MR' ? 'selected' : '' }}>Mobile Reader</option>
                          <option value="PDB"{{ $barang->category == 'PDB' ? 'selected' : '' }}>Panel Distribution Box
                          </option>
                          <option value="CDP"{{ $barang->category == 'CDP' ? 'selected' : '' }}>Customer Display Panel
                          </option>
                          <option value="ALB"{{ $barang->category == 'ALB' ? 'selected' : '' }}>Automatic Lane Barrier
                          </option>
                          <option value="LPR"{{ $barang->category == 'LPR' ? 'selected' : '' }}>Thermal Printer
                          </option>
                          <option value="TCT"{{ $barang->category == 'TCT' ? 'selected' : '' }}>Toll Collection
                            Terminal</option>
                          <option value="OBS"{{ $barang->category == 'OBS' ? 'selected' : '' }}>Optical Beam Sensor
                          </option>
                          <option value="LTS"{{ $barang->category == 'LTS' ? 'selected' : '' }}>LTS</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="type_assets">Tipe Assets<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="type_assets" id="type_assets" class="form-control select21" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="ASET"{{ $barang->type_assets == 'ASET' ? 'selected' : '' }}>Aset</option>
                          <option value="ASET TI"{{ $barang->type_assets == 'ASET TI' ? 'selected' : '' }}>Aset TI
                          </option>
                          <option value="ASET LATOL"{{ $barang->type_assets == 'ASET LATOL' ? 'selected' : '' }}>Aset
                            Lattol
                          </option>
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
                          value="{{ old('barcode', $barang->barcode) }}"
                          @if ($assets->isEmpty()) @else readonly @endif>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="size">Ukuran</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="size" id="size"
                          value="{{ old('size', $barang->size) }}"
                          @if ($assets->isEmpty()) @else readonly @endif>
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
                          value="{{ old('brand', $barang->brand) }}"
                          @if ($assets->isEmpty()) @else readonly @endif>
                        @if ($errors->has('brand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('brand') }}</p>
                        @endif
                      </div>

                      {{-- <label class="col-md-2 label-control" for="stats">Status<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1" {{ $barang->stats == 1 ? 'selected' : '' }}>Available</option>
                          <option value="2" {{ $barang->stats == 2 ? 'selected' : '' }}>Dipakai</option>
                          <option value="3" {{ $barang->stats == 3 ? 'selected' : '' }}>Perbaikan</option>
                          <option value="4" {{ $barang->stats == 4 ? 'selected' : '' }}>Diserahkan</option>
                          <option value="5" {{ $barang->stats == 5 ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div> --}}

                      <label class="col-md-2 label-control" for="year">Tahun</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year"
                          @if ($assets->isEmpty()) data-provide="datepicker" data-date-format="yyyy" data-date-min-view-mode="2" @else @endif
                          autocomplete="off" value="{{ old('year', $barang->year) }}" readonly>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">Gambar Barang</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            Gambar</label>
                          @if ($barang->file)
                            <p class="mt-1">Latest File : {{ pathinfo($barang->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $barang->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $barang->file) }}"
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
                      <label class="col-md-2 label-control" for="description">Keterangan</label>
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description"
                          @if ($assets->isEmpty()) @else readonly @endif>{{ old('description', $barang->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    {{-- 
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Category<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select21" onchange="showDiv(this)"
                          required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PC" {{ $barang->category == 'PC' ? 'selected' : '' }}>PC</option>
                          <option value="PC AIO"{{ $barang->category == 'PC AIO' ? 'selected' : '' }}>PC AIO</option>
                          <option value="MONITOR"{{ $barang->category == 'MONITOR' ? 'selected' : '' }}>Monitor
                          </option>
                          <option value="TV"{{ $barang->category == 'TV' ? 'selected' : '' }}>TV</option>
                          <option value="PROYEKTOR"{{ $barang->category == 'PROYEKTOR' ? 'selected' : '' }}>Proyektor
                          </option>
                          <option value="SCANNER"{{ $barang->category == 'SCANNER' ? 'selected' : '' }}>Scanner
                          </option>
                          <option value="PRINTER"{{ $barang->category == 'PRINTER' ? 'selected' : '' }}>Printer
                          </option>
                          <option value="PRINTER AIO"{{ $barang->category == 'PRINTER AIO' ? 'selected' : '' }}>
                            Printer
                            AIO</option>
                          <option value="SWITCH"{{ $barang->category == 'SWITCH' ? 'selected' : '' }}>Switch</option>
                          <option value="MIKROTIK"{{ $barang->category == 'MIKROTIK' ? 'selected' : '' }}>Mikrotik
                          </option>
                          <option value="WIFI"{{ $barang->category == 'WIFI' ? 'selected' : '' }}>WiFi</option>
                          <option value="CONVERTER FO"{{ $barang->category == 'CONVERTER FO' ? 'selected' : '' }}>
                            Converter FO</option>
                          <option value="SERVER"{{ $barang->category == 'SERVER' ? 'selected' : '' }}>Server</option>
                          <option value="NAS"{{ $barang->category == 'NAS' ? 'selected' : '' }}>NAS</option>
                          <option value="CAMERA"{{ $barang->category == 'CAMERA' ? 'selected' : '' }}>Camera</option>
                          <option value="MIC"{{ $barang->category == 'MIC' ? 'selected' : '' }}>Mic</option>
                          <option value="SPEAKER"{{ $barang->category == 'SPEAKER' ? 'selected' : '' }}>Speaker
                          </option>
                          <option value="UPS"{{ $barang->category == 'UPS' ? 'selected' : '' }}>UPS</option>
                          <option value="CCTV"{{ $barang->category == 'CCTV' ? 'selected' : '' }}>CCTV</option>
                          <option value="IP PHONE"{{ $barang->category == 'IP PHONE' ? 'selected' : '' }}>IP Phone
                          </option>
                          <option
                            value="HARDDISK EXTERNAL"{{ $barang->category == 'HARDDISK EXTERNAL' ? 'selected' : '' }}>
                            Hard Disk External</option>
                          <option value="PART PC"{{ $barang->category == 'PART PC' ? 'selected' : '' }}>Part PC
                          </option>
                          <option value="LAPTOP"{{ $barang->category == 'LAPTOP' ? 'selected' : '' }}>Laptop</option>
                          <option value="PART SERVER"{{ $barang->category == 'PART SERVER' ? 'selected' : '' }}>Part
                            Server</option>
                          <option value="PART NETWORK"{{ $barang->category == 'PART NETWORK' ? 'selected' : '' }}>Part
                            Network</option>
                          <option value="TOOLS"{{ $barang->category == 'TOOLS' ? 'selected' : '' }}>Tools</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>
                    </div> --}}

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

                <hr class="rounded">
                {{-- File --}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_file({{ $barang->id }})"><i class="bx bx-file"></i>
                      Tambah File</button>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="table-responsive col-md-12">
                  <table class="table table-striped table-bordered default-table activity-table mb-4" aria-label="">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center">Nama File</th>
                        <th class="text-center">File</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($files as $file)
                      <tbody>
                        <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ pathinfo($file->file, PATHINFO_FILENAME) }}
                        </td>
                        <td class="text-center">
                          <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}"
                            class="btn btn-info btn-sm text-white ">
                            Lihat
                          </a> <a type="button" href="{{ asset('storage/' . $file->file) }}"
                            class="btn btn-warning btn-sm text-white" download>Unduh</a>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                              <form action="{{ route('backsite.barang.delete_file', $file->id ?? '') }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit"id="delete_file" class="btn"value="Delete">
                              </form>
                            </div>
                          </div>
                        </td>
                      </tbody>
                    @empty
                      <td class="text-center" colspan="6">No data available in table</td>
                    @endforelse
                  </table>
                </div>

                <div id="hidden_div" class="hardware-section">
                  @if (in_array($barang->category, ['PC', 'PC AIO', 'SERVER', 'LAPTOP', 'NAS']))
                    {{-- tambahin disini --}}

                    {{-- motherboard --}}
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                          title="Tambah file" onclick="upload_motherboard({{ $barang->id }})"><i
                            class="bx bx-file"></i>
                          Tambah Motherboard</button>
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered default-table activity-table mb-4"
                        aria-label="">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center">Merk</th>
                            <th class="text-center">description</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        @forelse ($motherboards as $motherboard)
                          <tbody>
                            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $motherboard->motherboard->name }}</td>
                            <td class="text-center">
                              {{ $motherboard->motherboard->description }}
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form
                                    action="{{ route('backsite.barang.delete_motherboard', $motherboard->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_motherboard" class="btn"value="Delete">
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tbody>
                        @empty
                          <td class="text-center" colspan="6">No data available in table</td>
                        @endforelse
                      </table>
                    </div>
                    {{-- tambahin disini --}}

                    {{-- Processor --}}
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                          title="Tambah file" onclick="upload_processor({{ $barang->id }})"><i
                            class="bx bx-file"></i>
                          Tambah Processor</button>
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered default-table activity-table mb-4"
                        aria-label="">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center">Merk</th>
                            <th class="text-center">description</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        @forelse ($processors as $processor)
                          <tbody>
                            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $processor->processor->name }}
                            </td>
                            <td class="text-center">
                              {{ $processor->processor->description }}
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form action="{{ route('backsite.barang.delete_processor', $processor->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_processor" class="btn"value="Delete">
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tbody>
                        @empty
                          <td class="text-center" colspan="6">No data available in table</td>
                        @endforelse
                      </table>
                    </div>
                    {{-- tambahin disini --}}

                    {{-- Ram --}}
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                          title="Tambah file" onclick="upload_ram({{ $barang->id }})"><i class="bx bx-file"></i>
                          Tambah Ram</button>
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered default-table activity-table mb-4"
                        aria-label="">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center">Merk/Tipe</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">description</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        @forelse ($rams as $ram)
                          <tbody>
                            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $ram->ram->name }}</td>
                            <td class="text-center">{{ $ram->ram->size }}</td>
                            <td class="text-center">
                              {{ $ram->ram->description }}
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form action="{{ route('backsite.barang.delete_ram', $ram->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_ram" class="btn"value="Delete">
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tbody>
                        @empty
                          <td class="text-center" colspan="6">No data available in table</td>
                        @endforelse
                      </table>
                    </div>
                    {{-- tambahin disini --}}

                    {{-- Hardisk --}}
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                          title="Tambah file" onclick="upload_hardisk({{ $barang->id }})"><i class="bx bx-file"></i>
                          Tambah Hardisk</button>
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered default-table activity-table mb-4"
                        aria-label="">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center">Merk/Tipe</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">description</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        @forelse ($hardisks as $hardisk)
                          <tbody>
                            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $hardisk->hardisk->name }}</td>
                            <td class="text-center">{{ $hardisk->hardisk->size }}</td>
                            <td class="text-center">
                              {{ $hardisk->hardisk->description }}
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form action="{{ route('backsite.barang.delete_hardisk', $hardisk->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_hardisk" class="btn"value="Delete">
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tbody>
                        @empty
                          <td class="text-center" colspan="6">No data available in table</td>
                        @endforelse
                      </table>
                    </div>
                    {{-- tambahin disini --}}

                  @endif
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
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

  <script type="text/javascript">
    function showDiv(select) {
      if (
        select.value == 'PC' ||
        select.value == 'PC AIO' ||
        select.value == 'LAPTOP' ||
        select.value == 'SERVER' ||
        select.value == 'NAS'
      ) {
        document.getElementById('hidden_div').style.display = "block";
      } else {
        document.getElementById('hidden_div').style.display = "none";
      }



      $(document).ready(function() {
        $('html,body').animate({
          scrollTop: $('.rounded').offset().top
        }, "slow");
      })
    }
  </script>

  <script>
    function submit_id() {
      document.getElementById("submit_id").click();
    }

    $(document).ready(function() {
      $('.select21').select2();
    });
  </script>
  <script>
    function upload_file(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.barang.form_upload_file') }}",
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

    function upload_processor(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.barang.form_processor') }}",
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

    function upload_ram(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.barang.form_ram') }}",
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

    function upload_hardisk(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.barang.form_hardisk') }}",
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

    function upload_motherboard(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.barang.form_motherboard') }}",
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
