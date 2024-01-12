@extends('layouts.app')

{{-- set title --}}
@section('title', 'Sub Lokasi')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header bg-success text-white">
                  <h4 class="card-title text-white">Tambah Data</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.location_sub.store') }}" method="POST"
                  enctype="multipart/form-data">

                  @csrf

                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input Required <code>(*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="location_id">Lokasi Utama
                        <code style="color:red;">*</code></label>
                      <div class="col-md-9">
                        <select name="location_id" id="location_id" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                          @foreach ($location as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('location_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location_id') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Sub Lokasi
                        <code style="color:red;">*</code></code></label>
                      <div class="col-md-9">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Sub Lokasi"
                          value="{{ old('name') }}" autocomplete="off" required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
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
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-actions text-left ml-2">
                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
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
