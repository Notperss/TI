@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pemijaman Fasilitas')
@section('content')
  <div class="app-content content" id="pp">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data Pemijaman Fasilitas</h4>
                </div>
                <form class="form" action="{{ route('backsite.lendingfacility.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="borrower">Peminjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="borrower" name="borrower"
                          value="{{ old('borrower') }}" required>
                        </select>
                        @if ($errors->has('borrower'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('borrower') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="date_lend">Tanggal Pinjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_lend" name="date_lend"
                          value="{{ old('date_lend') }}" required>
                        </select>
                        @if ($errors->has('date_lend'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_lend') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="description" name="description"
                          value="{{ old('description') }}" required>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-2 my-2" title="Tambah Item"
                          onclick=""><i class="bx bx-file"></i>
                          Tambah Item</button>
                      </div>
                      <div class="table-responsive col-md-12">
                        <table class="table table-striped table-bordered default-table activity-table mb-4"
                          aria-label="">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 5%;">No</th>
                              <th class="text-center">Nama item</th>
                              <th class="text-center">Category</th>
                              <th class="text-center">Barcode</th>
                              <th class="text-center">Gambar</th>
                              <th style="text-align:center; width:10px;">Action</th>
                            </tr>
                          </thead>
                          {{-- @forelse ($bills as $bill) --}}
                          <tbody>
                            <td class="text-center" style="width: 5%;"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"> <a type="button" data-fancybox data-src=""
                                class="btn btn-info btn-sm text-white ">
                                Show
                              </a></td>
                            <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <a class="btn text-nowrap" href="">
                                    Edit
                                  </a>
                                  <a type="button" href="" class="btn text-nowrap" download>Download File</a>
                                  <button type="button" class="btn text-nowrap" onclick="thisFileDelete()">
                                    Delete
                                  </button>
                                </div>
                              </div>
                            </td>
                          </tbody>
                          {{-- @empty --}}
                          {{-- @endforelse --}}
                        </table>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="date_return" class="col-md-2 label-control">Tanggal Kembali</label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_return" name="date_return"
                          value="{{ old('date_return') }}" required>
                        </select>
                        @if ($errors->has('date_return'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_return') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="note">Catatan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control mb-3" id="note" name="note" required>{{ old('note') }}</textarea>
                        @if ($errors->has('note'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('note') }}</p>
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
                    <a href="{{ route('backsite.lendingfacility.index') }}" class="btn btn-success text-left ml-2">
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

@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    updateList = function() {
      var input = document.getElementById('file');
      var output = document.getElementById('fileList');
      var children = "";
      for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
      }
      output.innerHTML = '<ul>' + children + '</ul>';
    }
  </script>
@endpush
