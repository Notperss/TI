@extends('layouts.app')

{{-- set title --}}
@section('title', 'Surat Keluar/Masuk')
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
                  <h4 class="card-title text-white">Tambah Surat Keluar/Masuk</h4>
                </div>
                <form class="form" action="{{ route('backsite.letter.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_letter">Nomor Surat<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="no_letter" id="no_letter" required>
                        @if ($errors->has('no_letter'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_letter') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type_letter">Tipe Surat<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="type_letter" id="type_letter" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PPFTI">PPFTI</option>
                          <option value="LK">LK (Laporan Kerusakan)</option>
                          <option value="BA">BA (Berita Acara)</option>
                          <option value="SURAT MASUK">Surat Masuk</option>
                          <option value="SURAT KELUAR">Surat Keluar</option>
                          <option value="MEMO">Memo</option>
                          <option value="MEMO IN">Memo In</option>
                          <option value="MEMO OUT">Memo Out</option>
                          <option value="LAIN-LAIN">Lain-lain</option>
                        </select>
                        @if ($errors->has('type_letter'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_letter') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_letter">Tanggal Surat<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="date_letter" name="date_letter" class="form-control"
                          value="{{ old('date_letter') }}" autocomplete="off" required>
                        @if ($errors->has('date_letter'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_letter') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="sender">Pengirim</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="sender" id="sender">
                        @if ($errors->has('sender'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sender') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_receipt">Tanggal Diterima</label>
                      <div class="col-md-4">
                        <input type="date" id="date_receipt" name="date_receipt" class="form-control"
                          value="{{ old('date_receipt') }}" autocomplete="off">
                        @if ($errors->has('date_receipt'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_receipt') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="recipient">Penerima</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="recipient" id="recipient">
                        @if ($errors->has('recipient'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('recipient') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_sent">Tanggal Kirim</label>
                      <div class="col-md-4">
                        <input type="date" id="date_sent" name="date_sent" class="form-control"
                          value="{{ old('date_sent') }}" autocomplete="off">
                        @if ($errors->has('date_sent'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_sent') }}</p>
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
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required></textarea>
                        @if ($errors->has('description'))
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
                      <a href="{{ route('backsite.letter.index') }}" class="btn btn-success text-left ml-2">
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
