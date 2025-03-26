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
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Edit Inspection</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.inspection.update', $inspection) }}"
                  method="POST" enctype="multipart/form-data">
                  @method('PUT')
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
                          <label for="user_id">Inspektor <code style="color:red;">*</code></label>
                          <select id="user_id" name="user_id" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}"
                                {{ old('user_id', $inspection->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                              </option>
                            @endforeach
                          </select>
                          @error('user_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="shift">Shift <code style="color:red;">*</code></label>
                          <select id="shift" name="shift" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="1" {{ old('shift', $inspection->shift) == 1 ? 'selected' : '' }}>1
                            </option>
                            <option value="2" {{ old('shift', $inspection->shift) == 2 ? 'selected' : '' }}>2
                            </option>
                            <option value="3" {{ old('shift', $inspection->shift) == 3 ? 'selected' : '' }}>3
                            </option>
                            <option value="OFFICE" {{ old('shift', $inspection->shift) == 'OFFICE' ? 'selected' : '' }}>
                              OFFICE</option>
                          </select>
                          @error('shift')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label class="label-control" for="date_inspection">Tanggal <code
                              style="color:red;">*</code></label>
                          <input type="date" value="{{ old('date_inspection', $inspection->date_inspection) }}"
                            id="date_inspection" name="date_inspection" class="form-control" required>
                          @if ($errors->has('date_inspection'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('date_inspection') }}</p>
                          @endif
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="location_id">Lokasi Utama <code style="color:red;">*</code></label>
                          <select id="location_id" name="location_id" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($locations as $location)
                              <option value="{{ $location->id }}"
                                {{ old('location_id', $inspection->location_id) == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                              </option>
                            @endforeach
                          </select>
                          @error('location_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="sub_location_id">Sub Lokasi <code style="color:red;">*</code></label>
                          <select id="sub_location_id" name="sub_location_id" class="form-control select2" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($subLocations as $subLocation)
                              <option value="{{ $subLocation->id }}"
                                {{ old('subLocation_id', $inspection->sub_location_id) == $subLocation->id ? 'selected' : '' }}>
                                {{ $subLocation->name }}
                              </option>
                            @endforeach
                          </select>
                          @error('sub_location_id')
                            <p class="text-danger font-weight-bold">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="location_room_id">Lokasi <code style="color:red;">*</code></label>
                          <select id="location_room_id" name="location_room_id" class="form-control select2">
                            <option value="" disabled selected>Choose</option>
                            @foreach ($roomLocations as $roomLocation)
                              <option value="{{ $roomLocation->id }}"
                                {{ old('roomLocation_id', $inspection->location_room_id) == $roomLocation->id ? 'selected' : '' }}>
                                {{ $roomLocation->name }}
                              </option>
                            @endforeach
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

                          <textarea id="description" name="description" class="form-control" rows="5">{{ old('description', $inspection->description) }}</textarea>
                          @if ($errors->has('description'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('description') }}</p>
                          @endif
                        </div>
                      </div>
                    </div>

                    <hr class="rounded">
                    <hr class="rounded">

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
                                <th>Keterangan</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse($inspection->assets as $index => $asset)
                                <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{{ $asset->barcode ?? '-' }}</td>
                                  <td>{{ $asset->name ?? '-' }}</td>
                                  <td>{{ $asset->distribution_asset->first()->distribution->description ?? '-' }}</td>
                                  <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                      data-target="#assetIndicatorModal{{ $asset->id }}">
                                      Tambah Indicator Asset
                                    </button>
                                  </td>
                                  @include('pages.inspection.modal-indicator-create')

                                </tr>
                              @empty
                                <tr>
                                  <td colspan="6" class="text-center text-danger">Tidak ada asset yang diperiksa.
                                  </td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>



                    {{-- @forelse($inspection->assets as $index => $asset)
                      <section id="basic-listgroup">
                        <div class="row match-height">
                          <div class="col-lg-12 col-md-12">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title">{{ $asset->barcode ?? '-' }} | {{ $asset->name ?? '-' }} |
                                  {{ $asset->distribution_asset->first()->distribution->description ?? '-' }} </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="card-content collapse show">
                                <div class="card-body">
                                  <h3>Indikator</h3>
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Indikator</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @forelse ($asset->hardwareCategory->hardwareIndicators as $indicator)
                                        <tr>
                                          <td>
                                            {{ $indicator->name }}/
                                          </td>
                                          <td>
                                            <select name="indicators[{{ $asset->id }}][status]"
                                              class="form-control">
                                              <option value="baik">Baik</option>
                                              <option value="cukup">Cukup</option>
                                              <option value="rusak">Rusak</option>
                                            </select>
                                          </td>
                                          <td>
                                            <textarea type="text" name="indicators[{{ $asset->id }}][note]" class="form-control"
                                              placeholder="Keterangan optional"> </textarea>
                                          </td>
                                        </tr>
                                      @empty
                                        <tr>
                                          <td colspan="3" class="text-center">Tidak ada indikator</td>
                                        </tr>
                                      @endforelse
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    @empty
                      {{ 'Empty' }}
                    @endforelse --}}

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
      // function fetchAssets(params) {
      //   $('#asset-list').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
      //   $.ajax({
      //     url: '{{ route('backsite.inspection.getAssets') }}',
      //     type: 'GET',
      //     dataType: 'json',
      //     data: params,
      //     success: function(data) {
      //       $('#asset-list').empty();
      //       let assetsData = [];

      //       if (data.length > 0) {
      //         data.forEach((asset, index) => {
      //           $('#asset-list').append(`
    //         <tr data-id="${asset.id}">
    //           <td>${index + 1}</td>
    //           <td>${asset.barcode || '-'}</td>
    //           <td>${asset.name || '-'}</td>
    //           <td>${asset.sub_room || '-'}</td>
    //           <td>${asset.location_room || '-'}</td>
    //           <td>
    //             <button type="button" class="btn btn-danger btn-sm remove-asset">X</button>
    //           </td>
    //         </tr>
    //       `);
      //           assetsData.push({
      //             id: asset.id
      //           });
      //         });
      //       } else {
      //         $('#asset-list').append(
      //           '<tr><td colspan="6" class="text-center">Tidak ada asset ditemukan</td></tr>');
      //       }
      //       $('#assets-data').val(JSON.stringify(assetsData));
      //     },
      //     error: function() {
      //       alert('Gagal mengambil data asset!');
      //       resetDropdowns();
      //     }
      //   });
      // }

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
          // fetchAssets({
          //   sub_location_id: subLocationId
          // });
        }
      });

      // // Event: pilih lokasi ruangan
      // $('#location_room_id').change(function() {
      //   const locationRoomId = $(this).val();
      //   if (locationRoomId) {
      //     fetchAssets({
      //       location_room_id: locationRoomId
      //     });
      //   }
      // });

      // // Event: tombol fetch assets manual
      // $('#fetch-assets').on('click', function() {
      //   const locationId = $('#location_id').val();
      //   const subLocationId = $('#sub_location_id').val();
      //   if (!locationId) {
      //     alert('Pilih lokasi dulu!');
      //     return;
      //   }
      //   fetchAssets({
      //     location_id: locationId,
      //     sub_location_id: subLocationId
      //   });
      // });

      // Event: hapus asset dari list
      // $('#asset-list').on('click', '.remove-asset', function() {
      //   $(this).closest('tr').remove();
      //   let updatedAssets = [];
      //   $('#asset-list tr').each(function() {
      //     const assetId = $(this).data('id');
      //     if (assetId) updatedAssets.push({
      //       id: assetId
      //     });
      //   });
      //   $('#assets-data').val(JSON.stringify(updatedAssets));
      // });
    });
  </script>
@endpush
