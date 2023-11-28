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
                <form class="form" action="{{ route('backsite.barang.update', $barang->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Nama Barang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name"
                          value="{{ old('name', $barang->name) }}" required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="sku">SKU<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="sku" id="sku"
                          value="{{ old('sku', $barang->sku) }}" required>
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
                      <label class="col-md-2 label-control" for="type_assets">Tipe Assets</label>
                      <div class="col-md-4">
                        <select name="type_assets" id="type_assets" class="form-control select2" required>
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
                          value="{{ old('barcode', $barang->barcode) }}" required>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="size">Ukuran</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="size" id="size"
                          value="{{ old('size', $barang->size) }}" required>
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
                          value="{{ old('brand', $barang->brand) }}" required>
                        @if ($errors->has('brand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('brand') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="stats">Status</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="stats" id="stats"
                          value="{{ old('stats', $barang->stats) }}" required>
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
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description', $barang->description) }}</textarea>
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

              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-script')
  <script>
    function submit_id() {
      document.getElementById("submit_id").click();
    }
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
  </script>

  <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script>
@endpush
