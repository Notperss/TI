@extends('layouts.app')

{{-- set title --}}
@section('title', 'Absensi')
@section('content')
  <div class="app-content content" id="pp">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Tambah Absensi</h4>
                </div>
                <form class="form" action="{{ route('backsite.pp.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_pp">No PP<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="no_pp" name="no_pp"
                          value="{{ old('no_pp') }}" required>
                        </select>
                        @if ($errors->has('no_pp'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_pp') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="date">Tanggal PP<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date" name="date"
                          value="{{ old('date') }}" required>
                        </select>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="job_name">Nama Pekerjaan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="job_name" name="job_name"
                          value="{{ old('job_name') }}" required>
                        @if ($errors->has('job_name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="rkap">Nilai RKAP<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" id="rkap" name="rkap" class="form-control"
                          value="{{ old('rkap') }}" required>
                        @if ($errors->has('rkap'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('rkap') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="year">Tahun
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                          data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off"
                          value="{{ old('year') }}" readonly required>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="job_value">Nilai Pekerjaan
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="job_value" id="job_value"
                          value="{{ old('job_value') }}" required>
                        @if ($errors->has('job_value'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_value') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>

                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
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
                            {{ $errors->first('file') }}</p>
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
                    <a href="{{ route('backsite.pp.index') }}" class="btn btn-success text-left ml-2">
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
