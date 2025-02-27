<!-- Modals add menu -->
<div id="modal-form-add-user" class="modal fade modal-form-user" tabindex="-1" aria-labelledby="modal-form-add-user-label"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="modal-form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-add-user-label">Add User</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <label for="nik" class="form-label">Nik</label>
            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
              placeholder="User Nik" name="nik">
            @error('nik')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{--  --}}
          </div>

          <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
              placeholder="User Name" name="name">
            @error('name')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{--  --}}
          </div>

          <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
              placeholder="Email" name="email">
            @error('email')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{-- <x-form.validation.error name="email" /> --}}
          </div>
          {{-- 
          <div class="mb-1">
            <label for="company_id" class="form-label">Perusahaan</label>
            <select class="form-control choices" id="company_id" placeholder="Guard Name" name="company_id">
              <option value="" selected disabled>Choose</option>
              @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
            </select>
            @error('company_id')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
          </div> --}}

          {{-- <div class="mb-1">
            <label for="division" class="form-label">Divisi</label>
            <select class="form-control" id="division" style="width:100%" placeholder="Guard Name" name="division_id">
              <option value="" selected disabled>Choose</option>
              {{-- @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
              @endforeach
            </select>
            <x-form.validation.error name="division" />
          </div> --}}

          <div class="mb-1">
            <label class="label-control" for="hasil">Job Position
              <code style="color:red;">*</code></label>

            <select name="job_position" id="job_position" class="form-control select2" required>
              <option value="" disabled selected>
                Choose
              </option>

              <option value="Manager"{{ old('job_position') == 'Manager' ? 'selected' : '' }}>
                Manager </option>
              <option value="Assistant Manager"{{ old('job_position') == 'Assistant Manager' ? 'selected' : '' }}>
                Assistant Manager </option>
              <option value="Administrasi"{{ old('job_position') == 'Administrasi' ? 'selected' : '' }}>
                Administrasi </option>
              <option value="Hardware dan Jaringan"
                {{ old('job_position') == 'Hardware dan Jaringan' ? 'selected' : '' }}>
                Hardware dan Jaringan</option>
              <option value="Peralatan Tol" {{ old('job_position') == 'Peralatan Tol' ? 'selected' : '' }}>
                Peralatan Tol </option>
              <option value="Sistem Informasi"{{ old('job_position') == 'Sistem Informasi' ? 'selected' : '' }}>
                Sistem Informasi </option>
              <option value="Senior Officer"{{ old('job_position') == 'Senior Officer' ? 'selected' : '' }}>
                Senior Officer </option>
            </select>

            @if ($errors->has('job_position'))
              <p style="font-style: bold; color: red;">
                {{ $errors->first('job_position') }}</p>
            @endif
          </div>

          <div class="mb-1">
            <label for="role" class="form-label">Role Name</label>
            <select class="form-control choices @error('role') is-invalid @enderror" id="role" name="role">
              <option value=""disabled selected>Choose</option>
              @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
              @endforeach
            </select>
            @error('role')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{-- <x-form.validation.error name="role" /> --}}
          </div>

          <div class="mb-1">
            <label class="label-control" for="icon">Upload Icon
            </label>

            <div class="custom-file">
              <input type="file" class="custom-file-input" accept=".jpg,.png,.jpeg" id="icon" name="icon">
              <label class="custom-file-label" for="file" aria-describedby="file">
                Pilih Icon</label>
            </div>
            <p class="text-muted"><small class="text-danger">Hanya dapat
                mengunggah 1 Icon</small></p>
            @if ($errors->has('icon'))
              <p style="font-style: bold; color: red;">
                {{ $errors->first('icon') }}</p>
            @endif

            <img class="img-previews img-fluid " width="150" height="150" style="display:none">
          </div>

          <div class="mb-1">
            <label for="verified" class="form-label">Verified</label>
            <div class="form-check form-switch form-switch-right form-switch-md">
              <input class="form-check-input code-switcher" type="checkbox" id="tables-small-showcode" name="verified"
                value="1">
            </div>
            {{-- <x-form.validation.error name="verified" /> --}}
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ">Save</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
