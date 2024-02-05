@extends('layouts.app')

{{-- set title --}}
@section('title', 'Cctv')
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
                  <h4 class="card-title text-white">Tambah Data Cctv</h4>
                </div>

                <a href="#mymodalCCTV" data-remote="{{ route('backsite.showAll') }}" data-toggle="modal"
                  data-target="#mymodalCCTV" data-title="Data CCTV" class="btn btn-primary btn-min-width col-3 ml-1 my-1">
                  Lihat Semua Data CCTV
                </a>

                <form class="form" action="{{ route('backsite.cctv.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="type">Type<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="type" id="type" class="form-control" required>
                        @if ($errors->has('type'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="ip">IP<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="ip" id="ip" class="form-control" required>
                        @if ($errors->has('ip'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('ip') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="brand">Merk<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="brand" id="brand" class="form-control" required>
                        @if ($errors->has('brand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('brand') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="link">Link<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="link" id="link" class="form-control" required>
                        @if ($errors->has('link'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('link') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="location">Lokasi<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="location" id="location" class="form-control" required>
                        @if ($errors->has('location'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="username_cctv">Username<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="username_cctv" id="username_cctv" class="form-control" required>
                        @if ($errors->has('username_cctv'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('username_cctv') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="maintainer">Maintainer<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="maintainer" id="maintainer" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="SWAKELOLA">Swakelola</option>
                          <option value="VENDOR">Vendor</option>
                        </select>
                        @if ($errors->has('maintainer'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('maintainer') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="password_cctv">Password<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="password_cctv" id="password_cctv" class="form-control" required>
                        @if ($errors->has('password_cctv'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('password_cctv') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="type_loc">Tipe Lokasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="type_loc" id="type_loc" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="JALUR">JALUR</option>
                          <option value="JALUR GERBANG">JALUR GERBANG</option>
                          <option value="GERBANG">GERBANG</option>
                          <option value="GARDU">GARDU</option>
                        </select>
                        @if ($errors->has('type_loc'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_loc') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="lon_lat">Lon & Lat</label>
                      <div class="col-md-4">
                        <input name="lon_lat" id="lon_lat" class="form-control">
                        @if ($errors->has('lon_lat'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('lon_lat') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="category">Kategori<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="category" id="category" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="GARDU">Gardu</option>
                          <option value="GERBANG">Gerbang</option>
                          <option value="LAJUR">Lajur</option>
                          <option value="MAINROAD">Mainroad</option>
                          <option value="LAIN-LAIN">Lain-lain</option>
                        </select>
                        @if ($errors->has('category'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('category') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="installation_date">Tanggal Pasang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="installation_date" name="installation_date" class="form-control"
                          value="{{ old('installation_date') }}" autocomplete="off">
                        @if ($errors->has('installation_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('installation_date') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2">
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

                      <label class="col-md-2 label-control" for="type_cctv">Type CCTV<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="type_cctv" id="type_cctv" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PTZ">PTZ</option>
                          <option value="FIXED">Fixed</option>
                        </select>
                        @if ($errors->has('type_cctv'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_cctv') }}</p>
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
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
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
                      <a href="{{ route('backsite.cctv.index') }}" class="btn btn-success text-left ml-2">
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

@push('after-script')
  <script>
    jQuery(document).ready(function($) {
      $('#mymodalCCTV').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

    });

    $('.default-table').DataTable({
      "order": [],
      "paging": true,
      "lengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "pageLength": 10
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  <div class="modal fade" id="mymodalCCTV" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa spin"></i>
        </div>
      </div>
    </div>
  </div>
@endpush
@push('after-script')
  <script>
    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

    });
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa spin"></i>
        </div>
      </div>
    </div>
  </div>
@endpush
