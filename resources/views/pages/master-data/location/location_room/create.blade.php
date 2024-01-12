@extends('layouts.app')

{{-- set title --}}
@section('title', 'Lokasi')
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
                  <h4 class="card-title text-white">Tambah Lokasi</h4>
                </div>


                <form class="form form-horizontal" action="{{ route('backsite.location_room.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input Required <code>(*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="location_id">Lokasi Utama
                        <code style="color:red;">*</code></label>
                      <div class="col-md-9">
                        <select name="location_id" id="location_id" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                          @foreach ($location_id as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
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
                        </select>
                        @if ($errors->has('sub_location_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sub_location_id') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Lokasi
                        <code style="color:red;">*</code></code></label>
                      <div class="col-md-9">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Lokasi"
                          value="{{ old('name') }}" autocomplete="off" required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan</label>
                      <div class="col-md-7">
                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.location_room.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
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
    $(document).ready(function() {
      $('#location_id').change(function() {
        var locationId = $(this).val();
        if (locationId) {
          $.ajax({
            url: '{{ route('backsite.getSubLocations') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              location_id: locationId
            },
            success: function(data) {
              $('#sub_location_id').empty();
              $('#sub_location_id').append('<option value="" selected disabled>Choose</option>');
              $.each(data, function(key, value) {
                $('#sub_location_id').append('<option value="' + value.id + '">' + value.name +
                  '</option>');
              });
            }
          });
        } else {
          $('#sub_location_id').empty();
          $('#sub_location_id').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });
  </script>
@endpush
