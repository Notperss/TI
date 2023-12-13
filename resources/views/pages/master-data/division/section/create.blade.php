@extends('layouts.app')

{{-- set title --}}
@section('title', 'Seksi')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Tambah Seksi</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.section.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body">
                    <div class="form-section">
                      <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="division_id">Divisi <code
                          style="color:red;">required</code></label>
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
                        <code style="color:red;">required</code></label>
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
                      <label class="col-md-3 label-control" for="name">Seksi <code
                          style="color:red;">required</code></label>
                      <div class="col-md-9 mx-auto">
                        <input type="text" id="name" name="name" class="form-control"
                          placeholder="example John Doe or Jane" value="{{ old('name') }}" autocomplete="off" required>

                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
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
    });
  </script>
@endpush
