@extends('layouts.app')

{{-- set title --}}
@section('title', 'Lokasi Utama')
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
                  <h4 class="card-title text-white">Tambah Lokasi Utama </h4>
                </div>

                <div class="card-body card-dashboard">

                  <form class="form form-horizontal" action="{{ route('backsite.location.store') }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="form-body container">
                      <div class="form-section">
                        <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="name">Lokasi Utama <code
                            style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <input type="text" id="name" name="name" class="form-control"
                            placeholder="example John Doe or Jane" value="{{ old('name') }}" autocomplete="off"
                            required>

                          @if ($errors->has('name'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('name') }}</p>
                          @endif
                        </div>
                      </div>

                    </div>

                    <div class="form-actions ">
                      <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Submit
                      </button>

                      <a href="{{ route('backsite.location.index') }}" class="btn btn-success text-left ml-2">
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
