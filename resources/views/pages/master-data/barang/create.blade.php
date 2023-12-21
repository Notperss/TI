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
                    <input name="stats" id="stats" class="form-control" value="1" hidden>
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
                      <label class="col-md-2 label-control" for="sku">SKU</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="sku" id="sku"
                          value="{{ old('sku') }}">
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
                          <option value="VGA CARD">VGA Card</option>
                          <option value="LAPTOP">Laptop</option>
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
                      <label class="col-md-2 label-control" for="type_assets">Tipe Assets<code
                          style="color:red;">*</code></label>
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
                          value="{{ old('barcode') }}">
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="size">Ukuran</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="size" id="size"
                          value="{{ old('size') }}">
                        @if ($errors->has('size'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('size') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="brand">Merk<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="brand" id="brand"
                          value="{{ old('brand') }}" required>
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
                          <option value="1">Available</option>
                          <option value="2">Dipakai</option>
                          <option value="3">Perbaikan</option>
                          <option value="4">Diserahkan</option>
                          <option value="5">Rusak</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>
                    </div> --}}
                      <label class="col-md-2 label-control" for="year">Tahun
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year"
                          data-provide="datepicker" data-date-format="yyyy" data-date-min-view-mode="2"
                          autocomplete="off" value="{{ old('year') }}" readonly required>
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
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih Gambar</label>
                          <p class="text-muted"><small class="text-danger">Hanya dapat
                              mengunggah 1 file</small></p>
                          @if ($errors->has('name_file'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('name_file') }}</p>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan</label>
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4">
                        <input type="file" name="uploaded_file" id="add-file" hidden>
                        <label for="add-file" class="btn btn-success">Tambah
                          data file</label>
                      </div>
                      <table id="table-ip" class=" table col-md-12">
                        <thead>
                          <tr>
                            <th class="text-center">Nama File</th>
                            <th style="text-align:center; width:10px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
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
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  {{-- <script>
    $(document).ready(function() {
      let i = 0;

      $('#add-ip').click(function() {
        // Increment index for unique IDs
        i++;

        // Append a new row
        $('#table-ip tbody').append(`
      <tr>
        <td class="text-center"><input type="file" class="form-control" name="ip[${i}][file]"></td>
        <td class="text-center"><button type="button" class="btn btn-danger remove-table-row-ip">Remove</button></td>
      </tr>
    `);
      });

      $(document).on('click', '.remove-table-row-ip', function() {
        // Remove the entire row when the "Remove" button is clicked
        $(this).closest('tr').remove();
      });

      // Validate the form when submitted
      $('#dynamic-form').submit(function(event) {
        // Check if the form is valid
        if (!this.checkValidity()) {
          event.preventDefault(); // Prevent form submission if validation fails
        }

        // Enable the disabled options before submitting the form
        $('.form-control:disabled').prop('disabled', false);
      });
    });
  </script> --}}

  <script>
    document.getElementById('add-file').addEventListener('change', function(event) {
      // Get the selected file
      var fileInput = event.target;
      var file = fileInput.files[0];

      // Check if a file is selected
      if (file) {
        // Create a new row in the table
        var newRow = '<tr><td class="text-center border-0">' + file.name +
          '</td><td><button class="removeRow btn btn-danger" onclick="removeRow(this)">Remove</button></td></tr>';

        // Append the new row to the table
        document.getElementById('table-ip').insertAdjacentHTML('beforeend', newRow);

        // Optional: Clear the file input after appending
        fileInput.value = '';
      } else {
        alert('Please select a file.');
      }
    });

    function removeRow(button) {
      // Get the reference to the button's parent row
      var row = button.parentNode.parentNode;

      // Remove the entire row
      row.parentNode.removeChild(row);
    }
  </script>
@endsection
@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
