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
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h4 class="card-title text-white">Tambah Data PC User </h4>
                </div>

                <div class="card-body card-dashboard">

                  <ul class="nav nav-pills nav-pill-bordered justify-content-center">
                    <li class="nav-item">
                      <a class="nav-link active" id="base-user" data-toggle="pill" href="#user"
                        aria-expanded="true">User</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="base-divisi" data-toggle="pill" href="#divisi" aria-expanded="false">
                        Divisi
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="user" aria-expanded="true"
                      aria-labelledby="base-user">
                      <form class="form form-horizontal" action="{{ route('backsite.employee.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                          <div class="form-section">
                            <p>Isi input <code>required (*)</code>, Sebelum menekan tombol submit. </p>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="nip">NIK <code
                                style="color:red;">*</code></label>
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
                                placeholder="example John Doe or Jane" value="{{ old('job_position') }}"
                                autocomplete="off" required>

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
                                  <option value="{{ $division_item->id }}" data-value="{{ $division_item->name }}">
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

                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="type_user">Tipe User
                              <code style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input type="text" id="type_user" name="type_user" class="form-control"
                                value='1'>
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
                    <div class="tab-pane fade" id="divisi" aria-labelledby="base-divisi">
                      {{-- @include('pages.master-data.employee.division') --}}
                      <form class="form form-horizontal" action="{{ route('backsite.employee.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                          <div class="form-section">
                            <p>Isi input <code>required (*)</code>, Sebelum menekan tombol submit. </p>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="nip">NIK <code
                                style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input type="text" id="nip_div" name="nip" class="form-control"
                                placeholder="example John Doe or Jane" value="{{ old('nip') }}" autocomplete="off"
                                required>

                              @if ($errors->has('nip'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('nip') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="name">Nama <code
                                style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input type="text" id="name_div" name="name" class="form-control"
                                placeholder="example John Doe or Jane" value="{{ old('name') }}" autocomplete="off"
                                required>

                              @if ($errors->has('name'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('name') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="job_position">Jabatan <code
                                style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input type="text" id="job_position" name="job_position" class="form-control"
                                placeholder="example John Doe or Jane" value="-" autocomplete="off" required>

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
                              <select name="division_id" id="division_id" class="form-control select2"
                                onchange="myFunction(this);" required>
                                <option value="{{ '' }}" disabled selected>
                                  Choose
                                </option>
                                @foreach ($division as $key => $division_item)
                                  <option value="{{ $division_item->id }}" data-value="{{ $division_item->name }}">
                                    {{ $division_item->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('division_id'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('division_id') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="department_id">Departemen
                              <code style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input name="department_id" id="department" class="form-control" value="0"
                                required>

                              @if ($errors->has('department_id'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('department_id') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="section_id">Seksi
                              <code style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input name="section_id" id="section" class="form-control" value="0" required>

                              @if ($errors->has('section_id'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('section_id') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="company">Perusahaan <code
                                style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input type="text" id="company" name="company" class="form-control"
                                placeholder="example John Doe or Jane" value="-" autocomplete="off" required>

                              @if ($errors->has('company'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('company') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="type_user">Tipe User
                              <code style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input name="type_user" id="type_user" class="form-control" value="2" required>
                              @if ($errors->has('type_user'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('type_user') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row" hidden>
                            <label class="col-md-3 label-control" for="status">Status <code
                                style="color:red;">*</code></label>
                            <div class="col-md-9 mx-auto">
                              <input name="status" id="status" class="form-control" value="1">
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

    function myFunction(selectElement) {
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      var dataValue = selectedOption.getAttribute('data-value');

      document.getElementById("name_div").value = dataValue;
      document.getElementById("nip_div").value = dataValue;
    }
  </script>
  {{-- 
  <script>
    function updateJobPosition() {
      // Get the selected division_id value
      var selectedDivisionId = document.getElementById('divisi_division_id').value;

      // Simulate fetching job_position based on division_id (replace with your actual logic)
      var jobPosition = fetchJobPosition(selectedDivisionId);

      // Update the job_position input field with the retrieved value
      document.getElementById('divisi_nip').value = jobPosition;
      document.getElementById('divisi_name').value = jobPosition;
      document.getElementById('divisi_job_position').value = jobPosition;
      document.getElementById('divisi_company').value = jobPosition;

    }
  </script> --}}
  {{-- 
  <script>
    $(document).ready(function() {
      // When the division dropdown changes
      $('#division_id_division').change(function() {
        // Get the selected option's data-value attribute
        var divisionName = $('option:selected', this).data('value');

        // Set the value of the input text field to the division name
        $('#name_division').val(divisionName);
      });
    });
  </script> --}}
@endpush
