@extends('layouts.app')

{{-- set title --}}
@section('title', 'Data User')
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
                  <h4 class="card-title text-white">Tambah Data PC User </h4>
                </div>

                <div class="card-body card-dashboard">

                  <form class="form form-horizontal" action="{{ route('backsite.employee.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                      <div class="form-section">
                        <p>Isi input <code>required (*)</code>, Sebelum menekan tombol submit. </p>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="nip">NIK <code style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <input type="text" id="nip" name="nip" class="form-control"
                            placeholder="example John Doe or Jane" value="{{ old('nip') }}" autocomplete="off"
                            required>

                          @if ($errors->has('nip'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('nip') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="name">Nama <code
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
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="job_position">Jabatan <code
                            style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <input type="text" id="job_position" name="job_position" class="form-control"
                            placeholder="example John Doe or Jane" value="{{ old('job_position') }}" autocomplete="off"
                            required>

                          @if ($errors->has('job_position'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('job_position') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="division_id">Divisi <code
                            style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <select name="division_id" id="division_id" class="form-control select2" required>
                            <option value="{{ '' }}" disabled selected>
                              Choose
                            </option>
                            @foreach ($division as $key => $division_item)
                              <option value="{{ $division_item->id }}">
                                {{ $division_item->name }}</option>
                            @endforeach
                          </select>

                          @if ($errors->has('division_id'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('division_id') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="department_id">Departemen
                          <code style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <select name="department_id" id="department_id" class="form-control select2" required>
                            <option value="{{ '' }}" disabled selected>
                              Choose
                            </option>
                          </select>

                          @if ($errors->has('department_id'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('department_id') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="section_id">Seksi
                          <code style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <select name="section_id" id="section_id" class="form-control select2" required>
                            <option value="{{ '' }}" disabled selected>
                              Choose
                            </option>
                          </select>

                          @if ($errors->has('section_id'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('section_id') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="company">Perusahaan <code
                            style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <input type="text" id="company" name="company" class="form-control"
                            placeholder="example John Doe or Jane" value="{{ old('company') }}" autocomplete="off"
                            required>

                          @if ($errors->has('company'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('company') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="type_user">Tipe User
                          <code style="color:red;">*</code></label>
                        <div class="col-md-9 mx-auto">
                          <select name="type_user" id="type_user" class="form-control select2" required>
                            <option value="{{ '' }}" disabled selected>
                              Choose
                            </option>
                            <option value="1">User</option>
                            <option value="2">Divisi</option>
                          </select>

                          @if ($errors->has('type_user'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('type_user') }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="status">Status <code
                            style="color:red;">*</code></label>

                        <div class="col-md-9 mx-auto">
                          <select name="status" id="status" class="form-control select2">
                            <option value="{{ '' }}" disabled selected>
                              Choose
                            </option>
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
                          </select>

                          @if ($errors->has('status'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('status') }}</p>
                          @endif
                        </div>
                      </div>

                    </div>
                    <div class="form-actions text-right">
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
        </section>
      </div>
    </div>
  </div>

@endsection
@push('after-script')
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $('#division_id').on('change', function() {
        var idDivision = this.value;
        $("#department_id").html('');
        $.ajax({
          url: "{{ route('backsite.section.get_department') }}",
          type: "POST",
          data: {
            division_id: idDivision,
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(result) {
            $('#department_id').html(
              '<option value=""> Choose </option>');
            $.each(result.department, function(key, value) {
              $("#department_id").append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      });
      $('#department_id').on('change', function() {
        var idDepartment = this.value;
        $("#section_id").html('');
        $.ajax({
          url: "{{ route('backsite.section.get_section') }}",
          type: "POST",
          data: {
            department_id: idDepartment,
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(result) {
            $('#section_id').html(
              '<option value=""> Choose </option>');
            $.each(result.section, function(key, value) {
              $("#section_id").append('<option value="' + value
                .id + '">' + value.name + '</option>');
            });
          }
        });
      });
    });
  </script>
@endpush
