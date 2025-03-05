@extends('layouts.app')

{{-- set title --}}
@section('title', 'Jenis Peralatan')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Tambah Jenis Peralatan</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.type-asset.store') }}" method="POST"
                  enctype="multipart/form-data">

                  @csrf

                  <div class="form-body">
                    <div class="form-section">
                      <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row col-10">
                      <label class="col-md-3 label-control" for="name">Nama<code style="color:red;">*</code></label>
                      <div class="col-md-9 mx-auto">
                        <input type="text" id="name" name="name" class="form-control" placeholder=""
                          value="{{ old('name') }}" autocomplete="off" autofocus required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-10">
                      <label class="col-md-3 label-control" for="description">Keterangan</label>
                      <div class="col-md-9 mx-auto">
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    {{-- <div class="form-group row col-10">
                      <label class="col-md-3 label-control" for="status">Status <code
                          style="color:red;">*</code></label>
                      <div class="col-md-3">
                        <select name="status" id="status" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Pilih Status
                          </option>
                          <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                            Aktif
                          </option>
                          <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>
                            Tidak Aktif
                          </option>
                        </select>
                      </div>
                      @if ($errors->has('status'))
                        <p style="font-style: bold; color: red;">
                          {{ $errors->first('status') }}</p>
                      @endif
                    </div> --}}

                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>

                    <a href="{{ route('backsite.type-asset.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
              </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
  </div>


@endsection
