@extends('layouts.app')

{{-- set title --}}
@section('title', 'Antivirus')
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
                  <h4 class="card-title text-white">Tambah Data Antivirus</h4>
                </div>
                <form class="form" action="{{ route('backsite.antivirus.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_antivirus">Nama Antivirus<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_antivirus" name="name_antivirus"
                          value="{{ old('name_antivirus') }}" required>
                        @if ($errors->has('name_antivirus'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_antivirus') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="year">Tahun<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                          data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off"
                          value="{{ old('year') }}" readonly required>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="num_of_licenses">Jumlah Lisensi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="num_of_licenses" name="num_of_licenses"
                          value="{{ old('num_of_licenses') }}" required>
                        @if ($errors->has('num_of_licenses'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('num_of_licenses') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_start">Tanggal Mulai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="{{ old('date_start') }}" required>

                        @if ($errors->has('date_start'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_start') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_finish">Tanggal Berakhir<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_finish" name="date_finish"
                          value="{{ old('date_finish') }}" required>

                        @if ($errors->has('date_finish'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_finish') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">stats<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control">
                          <option value="" disabled selected> Choose</option>
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
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
                    <a href="{{ route('backsite.antivirus.index') }}" class="btn btn-success text-left ml-2">
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
@endpush
