@extends('layouts.app')

{{-- set title --}}
@section('title', 'Inspection')
@section('content')
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

      <div class="content-body">
        <section class="grid-with-inline-row-label" id="grid-with-inline-row-label">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Tambah Inspection</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.inspection.store') }}" method="POST"
                  enctype="multipart/form-data">

                  @csrf

                  <div class="form-body">
                    <div class="form-section">
                      <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>
                    <input type="hidden" name="job_position_id" value="{{ Auth::user()->job_position_id }}" hidden>

                    <div class="row col-md-11">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label-control" for="user_id">Inspektor <code style="color:red;">*</code></label>
                          @if (auth()->user()->hasRole('super-admin'))
                            <select id="user_id" name="user_id" class="form-control select2" required>

                              <option value="" disabled selected>Choose</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                  {{ old('user_id', auth()->user()->id) == $user->id ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          @else
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                          @endif
                          @error('user_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label class="label-control" for="shift">Shift <code style="color:red;">*</code></label>
                          <select id="shift" name="shift" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="1" {{ old('shift') == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('shift') == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('shift') == 3 ? 'selected' : '' }}>3</option>
                            <option value="OFFICE" {{ old('shift') == 'OFFICE' ? 'selected' : '' }}>OFFICE</option>
                          </select>
                          @error('shift')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label class="label-control" for="date_inspection">Tanggal <code
                              style="color:red;">*</code></label>
                          <input type="date" value="{{ old('date_inspection') }}" id="date_inspection"
                            name="date_inspection" class="form-control" required>
                          @if ($errors->has('date_inspection'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('date_inspection') }}</p>
                          @endif
                        </div>

                        <div class="form-group">
                          <label class="label-control" for="file">Gambar Barang</label>
                          <div class="custom-file">
                            <input type="file" accept="image/*" capture="camera" class="custom-file-input"
                              id="file" name="file">
                            <label class="custom-file-label" for="file" aria-describedby="file">Pilih Gambar</label>
                            <p class="text-muted"><small class="text-danger">Hanya dapat
                                mengunggah 1 file</small></p>
                            @if ($errors->has('file'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('file') }}</p>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label-control" for="location_id">Lokasi Utama <code
                              style="color:red;">*</code></label>
                          <select id="location_id" name="location_id" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($locations as $location)
                              <option value="{{ $location->id }}"
                                {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                              </option>
                            @endforeach
                          </select>
                          @error('location_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label class="label-control" for="sub_location_id">Sub Lokasi <code
                              style="color:red;">*</code></label>
                          <select id="sub_location_id" name="sub_location_id" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>

                          </select>
                          @error('sub_location_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="location_room_id">Lokasi</label>
                          <select id="location_room_id" name="location_room_id" class="form-control select2">
                            <option value="" disabled selected>Choose</option>

                          </select>
                          @error('location_room_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row col-md-11">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label-control" for="description">Keterangan</label>

                          <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                          @if ($errors->has('description'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('description') }}</p>
                          @endif
                        </div>
                      </div>
                    </div>

                    <hr class="rounded">
                    <hr class="rounded">

                    {{-- <div class="form-group row col-md-11">
                      <label class="col-md-2 label-control" for="location">Lokasi Utama<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <select id="location" class="form-control select2" required>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                              {{ old('location') == $location->id ? 'selected' : '' }}>
                              {{ $location->name }}
                            </option>
                          @endforeach
                        </select>
                        @if ($errors->has('location_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location_id') }}</p>
                        @endif
                      </div>
                    </div> --}}

                    {{-- <div class="form-group row col-md-11">
                      <label class="col-md-2 label-control" for="asset">Asset</label>
                      <div class="col-md-10">
                        <select id="asset-select" class="form-control select2">
                          <option value="" disabled selected>Pilih Asset</option>
                        </select>
                      </div>
                    </div> --}}

                    {{-- <div class="form-group col-md-11">
                      <div class="row">
                        <label class="col-lg-2 label-control" for="asset-select">Asset</label>
                        <div class="col-lg-10">
                          <div class="row">
                            <div class="col-md-12">
                              <select id="asset-select" class="form-control select2" style="width: 100%">
                                <option value="" disabled selected>Pilih Asset</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}

                    <!-- Tabel untuk menampilkan asset yang dipilih -->
                    <div class="form-group row col-md-12">
                      <div class="col-md-12 ">
                        <div class="table-responsive">
                          <table class="table table-sm table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>Sub Lokasi</th>
                                <th>Lokasi</th>
                                {{-- <th>Aksi</th> --}}
                              </tr>
                            </thead>
                            <tbody id="asset-list"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="assets" id="assets-data">
                    {{-- <div id="selected-assets"></div> --}}

                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>

                    <a href="{{ route('backsite.inspection.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
              </div>
              </form>
            </div>
          </div>
      </div>

    </div>
  </div>


@endsection

@push('after-script')
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: 'Choose',
        allowClear: true
      });

      // Fungsi reset dropdown
      function resetDropdowns() {
        $('#sub_location_id, #location_room_id').empty().append('<option value="" selected disabled>Choose</option>');
        $('#asset-list').empty();
        $('#assets-data').val('');
      }

      // Fungsi fetch assets
      function fetchAssets(params) {
        $('#asset-list').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $.ajax({
          url: '{{ route('backsite.inspection.getAssets') }}',
          type: 'GET',
          dataType: 'json',
          data: params,
          success: function(data) {
            $('#asset-list').empty();
            let assetsData = [];

            if (data.length > 0) {
              data.forEach((asset, index) => {
                $('#asset-list').append(`
              <tr data-id="${asset.id}">
                <td>${index + 1}</td>
                <td>${asset.barcode || '-'}</td>
                <td>${asset.name || '-'}</td>
                <td>${asset.sub_room || '-'}</td>
                <td>${asset.location_room || '-'}</td>
               
              </tr>
            `);
                assetsData.push({
                  id: asset.id
                });
              });
            } else {
              $('#asset-list').append(
                '<tr><td colspan="6" class="text-center">Tidak ada asset ditemukan</td></tr>');
            }
            $('#assets-data').val(JSON.stringify(assetsData));
          },
          error: function() {
            alert('Gagal mengambil data asset!');
            resetDropdowns();
          }
        });
      }

      // Event: pilih lokasi utama
      $('#location_id').change(function() {
        const locationId = $(this).val();
        resetDropdowns();
        if (locationId) {
          $.ajax({
            url: '{{ route('backsite.getSubLocations') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              location_id: locationId
            },
            success: function(data) {
              $.each(data, (key, value) => {
                $('#sub_location_id').append(`<option value="${value.id}">${value.name}</option>`);
              });
            }
          });
        }
      });

      // Event: pilih sub lokasi
      $('#sub_location_id').change(function() {
        const subLocationId = $(this).val();
        $('#location_room_id').empty().append('<option value="" selected disabled>Choose</option>');
        if (subLocationId) {
          $.ajax({
            url: '{{ route('backsite.getLocationRooms') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              sub_location_id: subLocationId
            },
            success: function(data) {
              $.each(data, (key, value) => {
                $('#location_room_id').append(`<option value="${value.id}">${value.name}</option>`);
              });
            }
          });
          fetchAssets({
            sub_location_id: subLocationId
          });
        }
      });

      // Event: pilih lokasi ruangan
      $('#location_room_id').change(function() {
        const locationRoomId = $(this).val();
        if (locationRoomId) {
          fetchAssets({
            location_room_id: locationRoomId
          });
        }
      });

      // Event: hapus asset dari list
      $('#asset-list').on('click', '.remove-asset', function() {
        $(this).closest('tr').remove();
        let updatedAssets = [];
        $('#asset-list tr').each(function() {
          const assetId = $(this).data('id');
          if (assetId) updatedAssets.push({
            id: assetId
          });
        });
        $('#assets-data').val(JSON.stringify(updatedAssets));
      });
    });
  </script>
@endpush
{{-- <script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: 'Choose',
      allowClear: true
    });

    // Event saat lokasi utama dipilih
    $('#location_id').change(function() {
      const locationId = $(this).val();
      if (locationId) {
        $.ajax({
          url: '{{ route('backsite.getSubLocations') }}',
          type: 'GET',
          dataType: 'json',
          data: {
            location_id: locationId
          },
          success: function(data) {
            $('#sub_location_id').empty().append('<option value="" selected disabled>Choose</option>');
            $.each(data, function(key, value) {
              $('#sub_location_id').append(`<option value="${value.id}">${value.name}</option>`);
            });
          }
        });
      } else {
        $('#sub_location_id').empty().append('<option value="" selected disabled>Choose</option>');
        $('#location_room_id').empty().append('<option value="" selected disabled>Choose</option>');
        $('#asset-select').empty().append('<option value="" disabled selected>Pilih Asset</option>');
        $('#asset-list').empty();
        $('#selected-assets').empty();
      }
    });

    // Event saat sub lokasi dipilih
    $('#sub_location_id').change(function() {
      const subLocationId = $(this).val();
      if (subLocationId) {
        $.ajax({
          url: '{{ route('backsite.getLocationRooms') }}',
          type: 'GET',
          dataType: 'json',
          data: {
            sub_location_id: subLocationId
          },
          success: function(data) {
            $('#location_room_id').empty().append('<option value="" selected disabled>Choose</option>');
            $.each(data, function(key, value) {
              $('#location_room_id').append(`<option value="${value.id}">${value.name}</option>`);
            });
          }
        });

        // Ambil semua asset berdasarkan sub lokasi
        fetchAssets({
          sub_location_id: subLocationId
        });
      } else {
        $('#location_room_id').empty().append('<option value="" selected disabled>Choose</option>');
        $('#asset-select').empty().append('<option value="" disabled selected>Pilih Asset</option>');
        $('#asset-list').empty();
        $('#selected-assets').empty();
      }
    });

    // Event saat lokasi ruangan dipilih
    $('#location_room_id').change(function() {
      const locationRoomId = $(this).val();
      if (locationRoomId) {
        // Ambil asset hanya untuk ruangan yang dipilih
        fetchAssets({
          location_room_id: locationRoomId
        });
      } else {
        $('#asset-select').empty().append('<option value="" disabled selected>Pilih Asset</option>');
        $('#asset-list').empty();
        $('#selected-assets').empty();
      }
    });

    // // Fungsi ambil asset dinamis berdasarkan lokasi atau ruangan
    // function fetchAssets(params) {
    //   $.ajax({
    //     url: '{{ route('backsite.inspection.getAssets') }}',
    //     type: 'GET',
    //     dataType: 'json',
    //     data: params,
    //     success: function(data) {
    //       $('#asset-list').empty();

    //       if (data.length > 0) {
    //         data.forEach((asset, index) => {
    //           $('#asset-list').append(`
    //           <tr data-id="${asset.id}">
    //             <td>${index + 1}</td>
    //             <td>${asset.barcode || '-'}</td>
    //             <td>${asset.name || '-'}</td>
    //             <td>${asset.sub_room || '-'}</td>
    //             <td>${asset.location_room || '-'}</td>
    //             <td>
    //               <button type="button" class="btn btn-danger btn-sm remove-asset">X</button>
    //             </td>
    //           </tr>
    //         `);
    //         });
    //       } else {
    //         $('#asset-list').append('<tr><td colspan="6" class="text-center">No assets found</td></tr>');
    //       }
    //     },
    //     error: function() {
    //       alert('Gagal mengambil data asset!');
    //     }
    //   });
    //   // Hapus asset dari list
    //   $('#asset-list').on('click', '.remove-asset', function() {
    //     $(this).closest('tr').remove();
    //   });
    // }

    // Trigger fetch asset
    $('#fetch-assets').on('click', function() {
      let locationId = $('#location_id').val();
      let subLocationId = $('#sub_location_id').val();

      if (!locationId) {
        alert('Pilih lokasi dulu!');
        return;
      }

      fetchAssets({
        location_id: locationId,
        sub_location_id: subLocationId
      });
    });

    // Fetch assets via AJAX
    function fetchAssets(params) {
      $.ajax({
        url: '{{ route('backsite.inspection.getAssets') }}',
        type: 'GET',
        dataType: 'json',
        data: params,
        success: function(data) {
          $('#asset-list').empty();

          if (data.length > 0) {
            let assetsData = [];

            data.forEach((asset, index) => {
              $('#asset-list').append(`
                        <tr data-id="${asset.id}">
                            <td>${index + 1}</td>
                            <td>${asset.barcode || '-'}</td>
                            <td>${asset.name || '-'}</td>
                            <td>${asset.sub_room || '-'}</td>
                            <td>${asset.location_room || '-'}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-asset">X</button>
                            </td>
                        </tr>
                    `);

              // Simpan data ke array
              assetsData.push({
                id: asset.id
              });
            });

            // Taruh data asset di input hidden
            $('#assets-data').val(JSON.stringify(assetsData));
          } else {
            $('#asset-list').append(
              '<tr><td colspan="6" class="text-center">Tidak ada asset ditemukan</td></tr>');
            $('#assets-data').val('');
          }
        },
        error: function() {
          alert('Gagal mengambil data asset!');
        }
      });
    }

    // Hapus asset dari list
    $('#asset-list').on('click', '.remove-asset', function() {
      $(this).closest('tr').remove();

      let updatedAssets = [];
      $('#asset-list tr').each(function() {
        let assetId = $(this).data('id');
        if (assetId) updatedAssets.push({
          id: assetId
        });
      });

      $('#assets-data').val(JSON.stringify(updatedAssets));
    });

  });
</script> --}}
