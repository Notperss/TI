@extends('layouts.app')

{{-- set title --}}
@section('title', 'Peminjaman')
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
                  <h4 class="card-title text-white">Edit Data Peminjaman</h4>
                </div>
                <form class="form" action="{{ route('backsite.lendingfacility.update', $lendingfacility->id) }}"
                  method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="borrower">Peminjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" id="borrower" name="borrower"
                          value="{{ old('borrower', $lendingfacility->borrower) }}" required>
                        </select>
                        @if ($errors->has('borrower'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('borrower') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_lend">Tanggal Pinjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_lend" name="date_lend"
                          value="{{ old('date_lend', $lendingfacility->date_lend) }}" required>
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
                          value="{{ old('description', $lendingfacility->description) }}" required>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <button type="submit" name="action" value="submit" style="display:none;"
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                </form>

                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-2 my-2" title="Tambah Item"
                      onclick="upload({{ $lendingfacility->id }})"><i class="bx bx-file"></i>
                      Tambah Item</button>
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
                  <div class="table-responsive col-md-12">
                    <table class="table table-striped table-bordered default-table activity-table mb-4" aria-label="">
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
                      @forelse ($lending_goods as $lends)
                        <tbody>
                          <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                          <td class="text-center">{{ $lends->barang->name }}</td>
                          <td class="text-center">{{ $lends->barang->category }}</td>
                          <td class="text-center">{{ $lends->barang->barcode }}</td>
                          <td class="text-center">
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $lends->barang->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a> <a type="button" href="{{ asset('storage/' . $lends->barang->file) }}"
                              class="btn btn-warning btn-sm text-white" download>Unduh</a>
                          </td>
                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <form action="{{ route('backsite.lendingfacility.hapus_file', $lends->id ?? '') }}"
                                  method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
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
                    <div class="form-group row">
                      <label for="date_return" class="col-md-2 label-control">Tanggal Kembali</label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_return" name="date_return"
                          value="{{ old('date_return', $lendingfacility->date_return) }}">
                        </select>
                        @if ($errors->has('date_return'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_return') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="note">Catatan</label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control mb-3" id="note" name="note">{{ old('note', $lendingfacility->note) }}</textarea>
                        @if ($errors->has('note'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('note') }}</p>
                        @endif
                      </div>
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
  <script>
    function thisFileDelete() {
      document.getElementById("delete_file").click();
    }
  </script>
  <script>
    function upload(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.lendingfacility.form_upload') }}",
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
