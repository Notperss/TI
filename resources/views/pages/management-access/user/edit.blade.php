@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - User')

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
          <h3 class="content-header-title mb-0 d-inline-block">Edit User</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">User</li>
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
                    <form class="form form-horizontal" action="{{ route('backsite.user.update', [$user->id]) }}"
                      method="POST" enctype="multipart/form-data">

                      @method('PUT')
                      @csrf

                      <div class="form-body">
                        <div class="form-section">
                          <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit.
                          </p>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="nik">NIK <code
                              style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <input type="text" id="nik" name="nik" class="form-control"
                              value="{{ old('nik', isset($user->detail_user->nik) ? $user->detail_user->nik : '') }}"
                              autocomplete="off" required>

                            @if ($errors->has('nik'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('nik') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="name">Name <code
                              style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <input type="text" id="name" name="name" class="form-control"
                              value="{{ old('name', isset($user->name) ? $user->name : '') }}" autocomplete="off"
                              required>

                            @if ($errors->has('name'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="email">E-mail <code
                              style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <input type="email" id="email" name="email" class="form-control"
                              value="{{ old('email', isset($user->email) ? $user->email : '') }}" autocomplete="off"
                              required>
                            @if ($errors->has('email'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('email') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="name">
                            Ganti Password
                          </label>
                          <div class="col-md-9 mx-auto">
                            <input type="password" id="password" name="password" class="form-control"
                              placeholder="Kosongkan jika password tidak diganti" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('password') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control">Type User <code style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <select name="type_user_id" id="type_user_id" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>Choose Type User
                              </option>
                              <option value="0">N/A</option>
                              @foreach ($type_user as $key => $type_user_item)
                                <option value="{{ $type_user_item->id }}"
                                  {{ $type_user_item->id == $user->detail_user->type_user_id ? 'selected' : '' }}>
                                  {{ $type_user_item->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('type_user_id'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('type_user_id') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="hasil">Job Position
                            <code style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <select name="job_position" id="job_position" class="form-control select2" required>
                              <option value="{{ '' }}" disabled selected>
                                Choose Job Position
                              </option>
                              <option value="0">N/A</option>
                              <option value="1" {{ $user->detail_user->job_position == 1 ? 'selected' : '' }}>
                                Manajer</option>
                              <option value="2" {{ $user->detail_user->job_position == 2 ? 'selected' : '' }}>
                                Kepala Departemen</option>
                              <option value="3" {{ $user->detail_user->job_position == 3 ? 'selected' : '' }}>
                                Administrasi</option>
                              <option value="4" {{ $user->detail_user->job_position == 4 ? 'selected' : '' }}>
                                Hardware & Jaringan</option>
                              <option value="5" {{ $user->detail_user->job_position == 5 ? 'selected' : '' }}>
                                Peralatan Tol</option>
                              <option value="6" {{ $user->detail_user->job_position == 6 ? 'selected' : '' }}>
                                Sistem Informasi</option>
                              <option value="7" {{ $user->detail_user->job_position == 7 ? 'selected' : '' }}>
                                Senior Officer</option>
                            </select>

                            @if ($errors->has('job_position'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('job_position') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="status">Status
                            <code style="color:red;">*</code></label>
                          <div class="col-md-9 mx-auto">
                            <select name="status" id="status" class="form-control select2">
                              <option value="{{ '' }}" disabled selected>
                                Choose Stats
                              </option>
                              <option value="1" {{ $user->detail_user->status == 1 ? 'selected' : '' }}>
                                Aktif</option>
                              <option value="2" {{ $user->detail_user->status == 2 ? 'selected' : '' }}>
                                Tidak Aktif</option>
                            </select>

                            @if ($errors->has('status'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('status') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="icon">
                            Ganti Icon
                          </label>
                          <div class="col-md-4 mx-left">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="icon" name="icon"
                                onchange="previewImage()">
                              <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                                Icon</label>
                            </div>

                            <p class="text-muted"><small class="text-danger">Hanya dapat
                                mengunggah 1 Icon</small></p>
                            @if ($errors->has('icon'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('icon') }}</p>
                            @endif
                          </div>
                          @if ($user->detail_user->icon)
                            <img src="{{ asset('storage/' . $user->detail_user->icon) }}"
                              class="img-preview img-fluid " width="150" height="150">
                          @else
                            <img class="img-preview img-fluid " width="150" height="150" style="display:none">
                          @endif
                        </div>

                      </div>

                      <div class="form-actions text-right">
                        <a href="{{ route('backsite.user.index') }}" style="width:120px;"
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
@push('after-script')
  <script>
    function previewImage() {
      const file = document.querySelector('#icon');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(file.files[0]);

      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
  </script>
@endpush
