@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Ruangan')

@section('content')
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- error --}}
      @if ($errors->any())
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Edit Ruangan</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Ruangan</li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      {{-- forms --}}
      <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal"
                      action="{{ route('backsite.location_room.update', [$location_room->id]) }}" method="POST"
                      enctype="multipart/form-data">

                      @method('PUT')
                      @csrf
                      <div class="form-body container">
                        <div class="form-section">
                          <p>Isi input Required <code>(*)</code>, Sebelum menekan tombol
                            submit. </p>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="location_id">Lokasi
                            <code style="color:red;">*</code></label>
                          <div class="col-md-9">
                            <select name="location_id" id="location_id" class="form-control select2" required>
                              <option value=""selected disabled>Choose</option>
                              @foreach ($location as $loc)
                                <option
                                  value="{{ $loc->id }}"{{ $loc->id == $location_room->location_id ? 'selected' : '' }}>
                                  {{ $loc->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('location_id'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('location_id') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="sub_location_id">Sub Lokasi
                            <code style="color:red;">*</code></code></label>
                          <div class="col-md-9">
                            <select name="sub_location_id" id="sub_location_id" class="form-control select2" required>
                              <option value=""selected disabled>Choose</option>
                              @foreach ($sub_location as $loc)
                                <option
                                  value="{{ $loc->id }}"{{ $loc->id == $location_room->sub_location_id ? 'selected' : '' }}>
                                  {{ $loc->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('sub_location_id'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('sub_location_id') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="name">Ruangan
                            <code style="color:red;">*</code></code></label>
                          <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ruangan"
                              value="{{ old('name', $location_room->name) }}" autocomplete="off" required>
                            @if ($errors->has('name'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="stats">Status<code
                              style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <select name="stats" id="stats" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose
                              </option>
                              <option value="1"{{ $location_room->stats == 1 ? 'selected' : '' }}>
                                Aktif</option>
                              <option value="2"{{ $location_room->stats == 2 ? 'selected' : '' }}>
                                Tidak Aktif</option>
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
                            <textarea rows="5" class="form-control summernote" id="description" name="description">{{ old('description', $location_room->description) }}</textarea>
                            @if ($errors->has('description'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('description') }}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-actions text-right">
                        <a href="{{ route('backsite.location_room.index') }}" style="width:120px;"
                          class="btn bg-blue-grey text-white mr-1"
                          onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                          <i class="ft-x"></i> Cancel
                        </a>
                        <button type="submit" style="width:120px;" class="btn btn-cyan"
                          onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                          <i class="la la-check-square-o"></i> Submit
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    </div>
  </div>
  <!-- END: Content-->

@endsection
