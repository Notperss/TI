@extends('layouts.app')

{{-- set title --}}
@section('title', 'Laporan Gangguan')
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
                  <h4 class="card-title text-white">Tambah Laporan Gangguan</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.maintenance.store') }}" method="POST"
                  enctype="multipart/form-data">

                  @csrf

                  <div class="form-body">
                    <input name="stats" class="form-control" value="1" hidden>
                    <div class="form-section">
                      <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>
                    @php
                      $latestReport = DB::table('maintenances')->latest()->first();
                      $nextNumber = $latestReport ? $latestReport->id + 1 : 1;
                    @endphp
                    <div class="col-md-6">

                      <div class="form-group row col-12">
                        <label class="col-md-4 label-control" for="report_number">Nomor Laporan <code
                            style="color:red;">*</code></label>
                        <div class="col-md-8">
                          <input type="text" id="report_number" name="report_number" class="form-control"
                            placeholder="" value="Lap-0{{ $nextNumber }}" autocomplete="off" readonly>
                          @if ($errors->has('report_number'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('report_number') }}</p>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row col-12">
                        <label class="col-md-4 label-control" for="reporter">Pelapor</label>
                        <div class="col-md-8">
                          <select type="text" id="reporter" name="reporter" class="form-control" style="width: 100%">
                            <option value="" disabled selected>Choose</option>
                            @foreach ($employees as $employee)
                              <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('reporter'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('reporter') }}</p>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row col-12">
                        <label class="col-md-4 label-control" for="user_id">yang Menerima<code
                            style="color:red;">*</code></label>
                        <div class="col-md-8">
                          <select type="text" id="user_id" name="user_id" class="form-control select2"
                            style="width: 100%" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}"
                                {{ $user->id == auth()->user()->name ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('user_id'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('user_id') }}</p>
                          @endif
                        </div>
                      </div>


                      <div class="form-group row col-12">
                        <label class="col-md-4 label-control" for="date">Tanggal Laporan <code
                            style="color:red;">*</code></label>
                        <div class="col-md-8">
                          <input type="datetime-local" id="date" name="date" class="form-control" placeholder=""
                            value="{{ old('date') }}" autocomplete="off" autofocus required>
                          @if ($errors->has('date'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('date') }}</p>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row col-12">
                        <label class="col-md-4 label-control" for="description">Keterangan <code
                            style="color:red;">*</code></label>
                        <div class="col-md-8">
                          <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                          @if ($errors->has('description'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('description') }}</p>
                          @endif
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>

                    <a href="{{ route('backsite.maintenance.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
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
      $('#reporter').select2({
        tags: true, // Memungkinkan input manual
        tokenSeparators: [','], // Bisa dipisah dengan koma
        placeholder: "Choose or type new",
        allowClear: true
      });
    });
  </script>

  {{-- <script>
    $(document).ready(function() {
      $('#employee_id').change(function() {
        var assetId = $(this).val();
        if (assetId) {
          $.ajax({
            url: '{{ route('backsite.getAsset') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              asset_id: assetId
            },
            success: function(data) {
              $('#goods_id').empty();
              $('#goods_id').append('<option value="" selected disabled>Choose</option>');

              $.each(data, function(_, item) {
                var assetBarcodes = item.asset_barcode.split(', ');
                var assetIds = item.asset_ids.split(', ');

                // Add options for each asset barcode and its corresponding ID within the same <select>
                $.each(assetBarcodes, function(index, barcode) {
                  var optionText = barcode + ' (' + assetIds[index] + ')';
                  $('#goods_id').append('<option value="' + assetIds[index] + '">' + optionText +
                    '</option>');
                });

                console.log('Asset Barcodes:', assetBarcodes);
                console.log('Asset IDs:', assetIds);
              });

              console.log(data);
            }




          });
        } else {
          $('#goods_id').empty();
          $('#goods_id').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });
  </script> --}}
@endpush
