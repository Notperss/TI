@extends('layouts.app')

{{-- set title --}}
@section('title', 'Profile')

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

      @if ($errors->updatePassword->any())
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <ul>
            @foreach ($errors->updatePassword->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Profile</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Profile</li>
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
                      <p>Isi input <code>*</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="flex-shrink-0">
                      <a data-toggle="modal" data-target="#modal-form-edit-password-{{ auth()->user()->id }}"
                        class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>
                        Change Password</a>
                    </div>
                    @include('pages.management-access.profile.edit')



                    <form class="form " id="updateProfile"
                      action="{{ route('backsite.profile.update', Auth::user()->id) }}" method="POST"
                      enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="form-body">
                        <div class="row">
                          <!-- Profile Image Upload Section -->
                          <div class="col-md-3">
                            <div class="form-group">
                              <div class="media my-2">
                                <a href="javascript:void(0);">
                                  <img id="profile-img"
                                    src="{{ $user->icon ? asset('storage/' . $user->icon) : asset('default-user.png') }}"
                                    class="rounded mr-80" alt="profile image" width="150">
                                </a>
                              </div>
                              <div class="d-flex flex-sm-row flex-column">
                                <label class="btn btn-sm btn-primary ml-2 mb-2 mb-sm-0 cursor-pointer"
                                  for="account-upload">
                                  Upload new photo
                                </label>
                                <input type="file" id="account-upload" name="icon" hidden>
                                <a class="btn btn-sm btn-secondary text-white ml-2" id="reset-btn">Reset</a>
                              </div>
                            </div>
                          </div>

                          <!-- User Information Section -->
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="row mb-2">
                                <label class="col-md-3 col-form-label" for="name">Nama</label>
                                <div class="col-md-9">
                                  <input type="text" id="name" class="form-control"
                                    value="{{ old('name', $user->name ?? '') }}" readonly>
                                  @error('name')
                                    <p class="text-danger font-weight-bold">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="row mb-2">
                                <label class="col-md-3 col-form-label" for="email">E-mail</label>
                                <div class="col-md-9">
                                  <input type="text" id="email" class="form-control"
                                    value="{{ old('email', $user->email ?? '') }}" readonly>
                                  @error('email')
                                    <p class="text-danger font-weight-bold">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="row mb-2">
                                <label class="col-md-3 col-form-label">Role</label>
                                <div class="col-md-9">
                                  <input type="text" id="type_user_id" class="form-control"
                                    value="{{ old('type_user_id', Auth::user()->getRoleNames()->first() ?? '') }}"
                                    readonly>
                                  @error('type_user_id')
                                    <p class="text-danger font-weight-bold">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="row">
                                <label class="col-md-3 col-form-label">Job Position</label>
                                <div class="col-md-9">
                                  <span class="badge bg-success">{{ $user->job_position }}</span>
                                  @error('job_position')
                                    <p class="text-danger font-weight-bold">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="form-actions text-right">
                        <a style="width:120px;" class="btn btn-cyan" onclick="updateProfile()">
                          <i class="la la-check-square-o"></i> Submit
                        </a>
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
  {{-- @include('pages.management-access.profile.edit') --}}
  <!-- END: Content-->

  <script>
    function updatePassword() {
      if (confirm('Are you sure you want to Update Password?')) {
        document.getElementById('updatePassword').submit();
      }
    }

    function updateProfile() {
      if (confirm('Are you sure you want to Update Profile?')) {
        document.getElementById('updateProfile').submit();
      }
    }
  </script>

  <script>
    document.getElementById("account-upload").addEventListener("change", function(event) {
      var reader = new FileReader();
      reader.onload = function() {
        document.getElementById("profile-img").src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    });

    document.getElementById("reset-btn").addEventListener("click", function() {
      document.getElementById("profile-img").src = "{{ asset('storage/' . $user->icon) }}";
      document.getElementById("account-upload").value = "";
    });
  </script>

@endsection
