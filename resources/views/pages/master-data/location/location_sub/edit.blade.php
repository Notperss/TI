@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Sub Lokasi')

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
          <h3 class="content-header-title mb-0 d-inline-block">Edit Sub Lokasi</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Sub Lokasi</li>
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
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <div class="card-text">
                      <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <form class="form form-horizontal"
                      action="{{ route('backsite.location_sub.update', [$location_sub->id]) }}" method="POST"
                      enctype="multipart/form-data">

                      @method('PUT')
                      @csrf

                      <div class="form-body">

                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="location_id">Lokasi Utama
                            <code style="color:red;">*</code></label>
                          <div class="col-md-9">
                            <select name="location_id" id="location_id" class="form-control select2" required>
                              <option value=""selected disabled>Choose</option>
                              @foreach ($location as $loc)
                                <option
                                  value="{{ $loc->id }}"{{ $loc->id == $location_sub->location_id ? 'selected' : '' }}>
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
                          <label class="col-md-2 label-control" for="name">Sub Lokasi
                            <code style="color:red;">*</code></code></label>
                          <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control"
                              placeholder="Sub Lokasi" value="{{ old('name', $location_sub->name) }}" autocomplete="off"
                              required>
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
                              <option value="1"{{ $location_sub->stats == 1 ? 'selected' : '' }}>
                                Aktif</option>
                              <option value="2"{{ $location_sub->stats == 2 ? 'selected' : '' }}>
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
                            <textarea rows="5" class="form-control summernote" id="description" name="description">{{ old('description', $location_sub->description) }}</textarea>
                            @if ($errors->has('description'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('description') }}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="form-actions text-right">
                    <a href="{{ route('backsite.location_sub.index') }}" style="width:120px;"
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
