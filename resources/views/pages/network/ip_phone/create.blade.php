@extends('layouts.app')

{{-- set title --}}
@section('title', 'IP Phone')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data IP Phone</h4>
                </div>
                <form class="form" action="{{ route('backsite.ip_phone.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="distributionAsset_id">Barcode<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="distributionAsset_id" id="distribution_id" class="form-control" required>
                          <option value="" selected disabled>Choose</option>
                          {{-- @foreach ($distributionAsset as $asset)
                            @if ($asset->asset->category === 'IP PHONE')
                              <option value="{{ $asset->id }}"
                                data-location="{{ $asset->distribution->location_room->name }}"
                                data-distribution-id="{{ $asset->distribution_id }}">
                                {{ $asset->asset->barcode ?? '' }}</option>
                            @endif
                          @endforeach --}}
                          @foreach ($distributionAsset as $asset)
                            @if ($asset->asset && $asset->asset->category === 'IP PHONE' && $asset->distribution)
                              <option value="{{ $asset->id }}"
                                data-location="{{ $asset->distribution->location_room->name }}"
                                data-distribution-id="{{ $asset->distribution_id }}">
                                {{ $asset->asset->barcode ?? '' }}
                              </option>
                            @endif
                          @endforeach

                        </select>
                        @if ($errors->has('distributionAsset_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('distributionAsset_id') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="caller">Caller ID<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="caller" id="caller" class="form-control" value="{{ old('caller') }}" required>
                        @if ($errors->has('caller'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('caller') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="location">Lokasi<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="" id="location" class="form-control" value="{{ old('location') }}" readonly
                          required>
                        @if ($errors->has('location'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type">Tipe<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input name="type" id="type" class="form-control" value="{{ old('type') }}" required>
                        @if ($errors->has('type'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="ip">IP
                        <code style="color:red;">*</code></code></label>
                      <div class="col-md-4">
                        <select name="ip" id="ip" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                        </select>
                        @if ($errors->has('ip'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('ip') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="installation_date">Tanggal Pasang<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" id="installation_date" name="installation_date" class="form-control"
                          value="{{ old('installation_date') }}" autocomplete="off" required>
                        @if ($errors->has('installation_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('installation_date') }}</p>
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
                          <option value="2">TIdak Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description') }}</textarea>
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
                    <a href="{{ route('backsite.ip_phone.index') }}" class="btn btn-success text-left ml-2">
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // Add an event listener to the barcode select element
    $('#distribution_id').change(function() {
      // Get the selected option
      var selectedOption = $(this).find(':selected');

      // Get the caller ID from the data attribute
      var locationData = selectedOption.data('location');
      var ipData = selectedOption.data('ip');

      // Update the value of the caller input field
      $('#location').val(locationData);
      $('#ip').val(ipData);
    });
  });
</script>

@push('after-script')
  {{-- <script>
    $(document).ready(function() {
      $('#distribution_id').change(function() {
        var distributionId = $(this).val();
        if (distributionId) {
          $.ajax({
            url: '{{ route('backsite.getIp') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              distribution_id: distributionId
            },
            success: function(data) {
              $('#ip').empty();
              $('#ip').append('<option value="" selected disabled>Choose</option>');
              $.each(data, function(key, value) {
                $('#ip').append('<option value="' + value.ip + '">' + value.ip +
                  '</option>');
              });
            }
          });
        } else {
          $('#ip').empty();
          $('#ip').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });
  </script> --}}

  <script>
    $(document).ready(function() {
      $('#distribution_id').change(function() {
        var distributionId = $(this).val();
        var distributionDataId = $(this).find(':selected').data('distribution-id');
        if (distributionId) {
          $.ajax({
            url: '{{ route('backsite.getIp') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              distribution_data_id: distributionDataId
            },
            success: function(data) {
              $('#ip').empty();
              $('#ip').append('<option value="" selected disabled>Choose</option>');
              $.each(data, function(key, value) {
                $('#ip').append('<option value="' + value.ip + '">' + value.ip +
                  '</option>');
              });
            }
          });
        } else {
          $('#ip').empty();
          $('#ip').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });
  </script>
@endpush
