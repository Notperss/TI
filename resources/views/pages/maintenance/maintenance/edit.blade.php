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
                  <h4 class="card-title text-white">Edit Laporan Gangguan</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.maintenance.update', $maintenance->id) }}"
                  method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf

                  <div class="form-body">
                    <input name="stats" class="form-control" value="1" hidden>
                    <div class="form-section">
                      <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>

                    <div class="form-group row col-11">
                      <label class="col-md-2 label-control" for="report_number">Nomor Laporan <code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" id="report_number" name="report_number" class="form-control" placeholder=""
                          value="{{ old('report_number', $maintenance->report_number) }}" autocomplete="off" autofocus
                          readonly>
                        @if ($errors->has('report_number'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('report_number') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="type_malfunction">Tipe Gangguan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4 ">
                        <select type="text" id="type_malfunction" name="type_malfunction" class="form-control"
                          required>
                          <option value="" selected disabled>Choose</option>
                          <option value="HARDWARE"{{ $maintenance->type_malfunction == 'HARDWARE' ? 'selected' : '' }}>
                            Hardware</option>
                          <option value="SOFTWARE"{{ $maintenance->type_malfunction == 'SOFTWARE' ? 'selected' : '' }}>
                            Software</option>
                          <option value="JARINGAN"{{ $maintenance->type_malfunction == 'JARINGAN' ? 'selected' : '' }}>
                            Jaringan</option>
                          <option value="LAIN-LAIN"{{ $maintenance->type_malfunction == 'LAIN-LAIN' ? 'selected' : '' }}>
                            Lain-lain</option>
                        </select>
                        @if ($errors->has('type_malfunction'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_malfunction') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-11">
                      <label class="col-md-2 label-control" for="reporter">Yang menerima<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4 ">
                        <select type="text" id="reporter" name="reporter" class="form-control select2"
                          style="width: 100%" required>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($users as $user)
                            <option value="{{ $user->name }}"
                              {{ $user->name == $maintenance->reporter ? 'selected' : '' }}>
                              {{ $user->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('reporter'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('reporter') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control second-part" for="barcode">Asset User<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4 second-part">
                        <select type="text" id="barcode" name="barcode" class="form-control select2" required>
                          <option value="" selected disabled>Choose</option>
                          @foreach ($barang as $asset)
                            <option value="{{ $asset->barcode }}"
                              data-value="{{ $asset->name }}"{{ $asset->barcode == $maintenance->barcode ? 'selected' : '' }}>
                              {{ $asset->barcode }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('barcode'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('barcode') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-11">
                      <label class="col-md-2 label-control" for="employee_id">Pelapor<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select type="text" id="employee_id" name="employee_id" class="form-control select2"
                          style="width: 100%" required>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                              {{ $employee->id == $maintenance->employee_id ? 'selected' : '' }}>{{ $employee->name }}
                            </option>
                          @endforeach
                        </select>
                        @if ($errors->has('employee_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('employee_id') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="file">Nama Asset</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="nama_asset" name="file" readonly>
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-11">
                      <label class="col-md-2 label-control" for="date">Tanggal Laporan <code
                          style="color:red;">*</code></label>
                      <div class="col-md-4 ">
                        <input type="datetime-local" id="date" name="date" class="form-control" placeholder=""
                          value="{{ old('date', $maintenance->date) }}" autocomplete="off" autofocus required>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>

                      {{-- <label class="col-md-2 label-control" for="file">user</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="nama_asset" name="file" readonly>
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div> --}}
                      {{-- </div>

                    <div class="form-group row col-11"> --}}
                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                          @if ($maintenance->file)
                            <p class="mt-1">Latest File : {{ pathinfo($maintenance->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $maintenance->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $maintenance->file) }}"
                              class="btn btn-warning btn-sm" download>
                              Unduh
                            </a>
                          @else
                            <p class="mt-1">Latest File : File not found!</p>
                          @endif
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        {{-- <img class="img-preview img-fluid mb-1 col-md-6"> --}}
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-11">
                      <label class="col-md-2 label-control" for="description">Keterangan <code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ $maintenance->description }}</textarea>
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

                    <a href="{{ route('backsite.maintenance.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>

                <hr class="rounded">
                {{-- File --}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                      title="Tambah Status" onclick="status({{ $maintenance->id }})"><i class="bx bx-file"></i>
                      Tambah Status</button>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered default-table mb-4" aria-label="">
                    <thead class="bg-info">
                      <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center">Status Laporan</th>
                        <th class="text-center">Yang Menangani</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">File</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-blue bg-lighten-3">
                      @forelse ($statusReport as $status)
                        <tr>
                          <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                          <td class="text-center">
                            @if ($status->report_status == 1)
                              <p>Open</p>
                            @elseif($status->report_status == 2)
                              <p>Penanganan</p>
                            @elseif($status->report_status == 3)
                              <p>Penanganan Lanjutan</p>
                            @elseif($status->report_status == 4)
                              <p>Form LK</p>
                            @elseif($status->report_status == 5)
                              <p>Perbaikan Vendor</p>
                            @elseif($status->report_status == 6)
                              <p>Menyerahkan Barang ke Vendor</p>
                            @elseif($status->report_status == 7)
                              <p>Menerima Barang dari Vendor</p>
                            @elseif($status->report_status == 8)
                              <p>BA</p>
                            @elseif($status->report_status == 9)
                              <p>Selesai</p>
                            @elseif($status->report_status == 10)
                              <p>Tidak Selesai - Rusak</p>
                            @else
                              <!-- Handle other options if needed -->
                            @endif
                          </td>
                          <td class="text-center">{{ $status->user->name }}</td>
                          <td class="text-center">{{ $status->date }}</td>
                          <td class="text-center">{{ $status->description }}</td>
                          <td class="text-center">
                            <a data-fancybox data-src="{{ asset('storage/' . $status->file) }}"
                              class="btn btn-info btn-sm text-white btn-block">
                              Lihat
                            </a>
                            <a href="{{ asset('storage/' . $status->file) }}"
                              class="btn btn-warning btn-sm text-white btn-block" download>
                              Unduh
                            </a>
                          </td>

                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <form action="{{ route('backsite.maintenance.delete_status', $status->id ?? '') }}"
                                  method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="submit"id="delete_file" class="dropdown-item"value="Delete">
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <td class="text-center" colspan="7">No data available in table</td>
                      @endforelse
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="viewmodal" style="display: none;"></div>
@endsection
@push('after-script')
  {{-- <script>
    $(document).ready(function() {
      // Initially check the value and show/hide the second part accordingly
      checkTypeMalfunction();

      // Listen for changes in the "Tipe Gangguan" dropdown
      $('#type_malfunction').change(function() {
        // Show/hide the second part based on the selected value
        checkTypeMalfunction();
      });
    });

    function checkTypeMalfunction() {
      // Check if the value from the database is "HARDWARE"
      if ($('#type_malfunction').val() === 'HARDWARE') {
        // Show the second part of the form
        $('.second-part').show();
      } else {
        // Hide the second part of the form
        $('.second-part').hide();
      }
    }
  </script>
  
  <script>
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
    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
    });
  </script> --}}

  <script>
    $(document).ready(function() {
      // Set initial value on page load
      var initialSelectedValue = $('#barcode :selected').data('value');
      $('#nama_asset').val(initialSelectedValue);

      // Handle change event
      $('#barcode').on('change', function() {
        var input_value = $(this).find(':selected').data('value');
        $('#nama_asset').val(input_value);
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script>

  <script>
    function status(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.maintenance.form_update_status') }}",
        data: {
          id: id
        },
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#upload').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }

    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
    });
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa spin"></i>
        </div>
      </div>
    </div>
  </div>
@endpush
