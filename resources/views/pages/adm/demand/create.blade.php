@extends('layouts.app')

{{-- set title --}}
@section('title', 'Permintaan Uang')
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
                  <h4 class="card-title text-white">Tambah Permintaan Uang</h4>
                </div>
                <form class="form" action="{{ route('backsite.demand.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_demand">No Permintaan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="no_demand" id="no_demand"
                          value="{{ old('no_demand') }}">
                        @if ($errors->has('no_demand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_demand') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type_demand">Tipe Permintaan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="type_demand" id="type_demand" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="PETYCASH">Petycash</option>
                          <option value="REIMBURSE">Reimburse</option>
                        </select>
                        @if ($errors->has('type_demand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_demand') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="nominal">Nominal<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="nominal" id="nominal"
                          value="{{ old('nominal') }}">
                        @if ($errors->has('nominal'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('nominal') }}</p>
                        @endif
                      </div>


                      <label class="col-md-2 label-control" for="date_demand">Tanggal Permintaan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="date_demand" name="date_demand" class="form-control"
                          value="{{ old('date_demand') }}" autocomplete="off">
                        @if ($errors->has('date_demand'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_demand') }}</p>
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
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-section"></div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="accountability">Pertanggungjawaban</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="accountability" id="accountability"
                          value="{{ old('accountability') }}">
                        @if ($errors->has('accountability'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('accountability') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="date_pj">Tanggal PJ</label>
                      <div class="col-md-4">
                        <input type="date" id="date_pj" name="date_pj" class="form-control"
                          value="{{ old('date_pj') }}" autocomplete="off">
                        @if ($errors->has('date_pj'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_pj') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="nominal_pj">Nominal PJ</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="nominal_pj" id="nominal_pj"
                          value="{{ old('nominal_pj') }}">
                        @if ($errors->has('nominal_pj'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('nominal_pj') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file_pj">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file_pj" name="file_pj">
                          <label class="custom-file-label" for="file_pj" aria-describedby="file_pj">Pilih
                            File</label>
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        @if ($errors->has('file_pj'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file_pj') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-actions ">
                      <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Submit
                      </button>
                      <a href="{{ route('backsite.demand.index') }}" class="btn btn-success text-left ml-2">
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
