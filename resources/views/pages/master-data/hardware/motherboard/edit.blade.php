@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Motherboard')

@section('content')
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- error --}}
      @if ($errors->any())
        <div class="mb-2 alert bg-danger alert-dismissible" role="alert">
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
        <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
          <h3 class="mb-0 content-header-title d-inline-block">Edit Motherboard</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Motherboard</li>
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
                    <ul class="mb-0 list-inline">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal"
                      action="{{ route('backsite.motherboard.update', [$motherboard->id]) }}" method="POST"
                      enctype="multipart/form-data">

                      @method('PUT')
                      @csrf

                      <div class="form-body">
                        <div class="form-section">
                          <p>Isi input <code>Requried (*)</code>, Sebelum menekan tombol submit.
                          </p>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="name">Merk <code
                              style="color:red;">*</code></label>
                          <div class="mx-auto col-md-9">
                            <input type="text" id="name" name="name" class="form-control"
                              value="{{ old('name', isset($motherboard->name) ? $motherboard->name : '') }}"
                              autocomplete="off" required>

                            @if ($errors->has('name'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="status">Status<code
                              style="color:red;">*</code></label>
                          <div class="mx-auto col-md-9">
                            <select name="status" id="status" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose
                              </option>
                              <option value="1" {{ $motherboard->status == 1 ? 'selected' : '' }}>Aktif
                              </option>
                              <option value="2" {{ $motherboard->status == 2 ? 'selected' : '' }}>Tidak
                                Aktif</option>
                            </select>

                            @if ($errors->has('status'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('status') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="description">Keterangan<code
                              style="color:red;"></code></label>
                          <div class="mx-auto col-md-9">
                            <textarea rows="5" class="form-control" id="description" name="description">{{ isset($motherboard->description) ? $motherboard->description : '' }}</textarea>
                          </div>
                        </div>

                      </div>

                      <div class="text-right form-actions">
                        <a href="{{ route('backsite.motherboard.index') }}" style="width:120px;"
                          class="mr-1 text-white btn bg-blue-grey"
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
