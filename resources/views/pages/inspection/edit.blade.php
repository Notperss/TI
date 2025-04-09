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

                {{-- <form class="form form-horizontal" action="{{ route('backsite.inspection.update', $inspection) }}"
                  method="POST" enctype="multipart/form-data">

                  @csrf --}}

                <div class="form-body">
                  <div class="form-section">
                    <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                      submit. </p>
                  </div>
                  <input type="hidden" name="job_position_id" value="{{ Auth::user()->job_position_id }}" hidden>
                  <input type="hidden" id="inspection_id" name="inspection_id" value="{{ $inspection->id }}" hidden>

                  <div class="row col-md-11">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="user_id">Inspektor <code style="color:red;">*</code></label>
                        <select id="user_id" name="user_id" class="form-control select2" required disabled>
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
                        <select id="shift" name="shift" class="form-control select2" required disabled>
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
                          id="date_inspection" name="date_inspection" class="form-control" required readonly>
                        @if ($errors->has('date_inspection'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_inspection') }}</p>
                        @endif
                      </div>

                      <div class="form-group">
                        <label class="label-control" for="file">Gambar Barang</label>
                        {{--  <div class="custom-file">
                          <input type="file" accept="image/*" capture="camera" class="custom-file-input" id="file"
                            name="file" disabled>
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih Gambar</label>
                          <p class="text-muted"><small class="text-danger">Hanya dapat
                              mengunggah 1 file</small></p> --}}

                        @if ($inspection->file_path)
                          <p class="mt-1">Latest File : {{ pathinfo($inspection->file_path, PATHINFO_FILENAME) }}</p>
                          <a type="button" data-fancybox data-src="{{ asset('storage/' . $inspection->file_path) }}"
                            class="btn btn-info btn-sm text-white ">
                            Lihat
                          </a>
                          <a type="button" href="{{ asset('storage/' . $inspection->file_path) }}"
                            class="btn btn-warning btn-sm" download>
                            Unduh
                          </a>
                        @else
                          <p class="mt-1">Latest File : File not found!</p>
                        @endif
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                        {{-- </div> --}}
                      </div>

                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="location_id">Lokasi Utama <code style="color:red;">*</code></label>
                        <select id="location_id" name="location_id" class="form-control select2" required disabled>
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
                        <select id="sub_location_id" name="sub_location_id" class="form-control select2" required
                          disabled>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($subLocations as $subLocation)
                            <option value="{{ $subLocation->id }}"
                              {{ old('sub_location_id', $inspection->sub_location_id) == $subLocation->id ? 'selected' : '' }}>
                              {{ $subLocation->name }}
                            </option>
                          @endforeach
                        </select>
                        @error('sub_location_id')
                          <p class="text-danger font-weight-bold">{{ $message }}</p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="location_room_id">Lokasi </label>
                        {{-- <select id="location_room_id" name="location_room_id" class="form-control select2"
                          @if ($inspection->location_room_id) disabled @endif> --}}
                        <select id="location_room_id" name="location_room_id" class="form-control select2" disabled>
                          <option value="" disabled selected></option>
                          @foreach ($roomLocations as $roomLocation)
                            <option value="{{ $roomLocation->id }}"
                              {{ old('location_room_id', $inspection->location_room_id) == $roomLocation->id ? 'selected' : '' }}>
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

                        <textarea id="description" name="description" class="form-control" rows="5" readonly>{{ old('description', $inspection->description) }}</textarea>
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
                              <th></th>
                              <th>Aksi</th>
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
                  <a href="{{ route('backsite.inspection.index') }}" style="width:120px;"
                    class="btn btn-cyan float-right mr-2"
                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                    <i class="la la-check-square-o"></i> Selesai
                  </a>

                </div>
              </div>
              {{-- </form> --}}
            </div>
          </div>
      </div>

    </div>
  </div>

  @include('pages.inspection.modal-indicator-create')
  @include('pages.inspection.modal-testing-create')
  @include('pages.inspection.modal-upload-image')


@endsection

@push('after-script')
  {{-- <script>
    $(document).ready(function() {
      const subLocationDropdown = $('#sub_location_id');
      const roomLocationDropdown = $('#location_room_id');

      // Cek apakah dropdown sudah punya nilai dari old() atau $inspection
      const initialSubLocation = subLocationDropdown.val();
      const initialRoomLocation = roomLocationDropdown.val();

      if (initialSubLocation || initialRoomLocation) {
        fetchAssets(initialSubLocation, initialRoomLocation);
      }

      // Event listener untuk kedua dropdown
      subLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      roomLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
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
                <td>
                  <button type="button" class="btn btn-danger btn-sm remove-asset">X</button>
                </td>
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
  </script> --}}

  <script>
    $(document).ready(function() {
      const subLocationDropdown = $('#sub_location_id');
      const roomLocationDropdown = $('#location_room_id');

      // Cek apakah dropdown sudah punya nilai dari old() atau $inspection
      const initialSubLocation = subLocationDropdown.val();
      const initialRoomLocation = roomLocationDropdown.val();

      if (initialSubLocation || initialRoomLocation) {
        fetchAssets(initialSubLocation, initialRoomLocation);
      }

      // Event listener untuk kedua dropdown
      subLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      roomLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      // Function fetch asset sesuai kombinasi subLocation dan roomLocation
      function fetchAssets(subLocationId, roomLocationId) {
        $('#asset-list').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');
        const inspectionIds = $('input[name="inspection_id"]').val();

        $.ajax({
          url: '{{ route('backsite.inspection.getAssets') }}',
          type: 'GET',
          dataType: 'json',
          data: {
            sub_location_id: subLocationId,
            location_room_id: roomLocationId,
            inspection_id: inspectionIds,
          },
          success: function(data) {
            $('#asset-list').empty();

            if (data.length > 0) {
              const storagePath = @json(asset('storage'));

              data.forEach((asset, index) => {
                let fileButtons = asset.file_path ?
                  `
        <a data-fancybox data-src="${storagePath}/${asset.file_path}" class="btn btn-success text-white btn-sm">Lihat File</a>
        <a href="javascript:void(0)" class="btn btn-info btn-sm text-white btn-file" data-id="${asset.id}">Upload Gambar</a>
      ` :
                  `
        <a href="javascript:void(0)" class="btn btn-info btn-sm text-white btn-file" data-id="${asset.id}">Upload Gambar</a>
      `;

                $('#asset-list').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${asset.barcode || '-'}</td>
                                <td>${asset.name || '-'}</td>
                                <td>${asset.description || '-'}</td>
                                <td> ${fileButtons}</td>
                                <td>
                                  <a href="javascript:void(0)" class="btn btn-primary btn-sm text-white btn-indicator" data-id="${asset.id}">Check</a>
                                  <a href="javascript:void(0)" class="btn btn-secondary btn-sm text-white btn-testing" data-id="${asset.id}">Testing</a>
                                  </td>
                            </tr>
                        `);
              });

              // Buka modal & isi data
              $(document).on("click", ".btn-file", function() {
                const assetId = $(this).data("id");
                const assetName = $(this).data("name");

                $("#fileModalLabel").text(`Upload File Gambar untuk ${assetName}`);
                $("#modalAssetId").val(assetId);

                $("#fileModal").modal("show");
              });


              // Hapus Semua Data Testing
              $(".btn-delete-all-indicator").click(function() {
                const assetId = $("#indicatorAssetId").val();
                const inspectionId = $('input[name="inspection_id"]').val();

                if (confirm("Yakin mau hapus semua data indicator?")) {
                  $.ajax({
                    url: "{{ route('backsite.inspection.indicator.delete') }}",
                    type: "DELETE",
                    data: {
                      asset_id: assetId,
                      inspection_id: inspectionId,
                      _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                      alert(response.message);
                      // $("#indicatorInputBody").html(
                      //   '<tr><td colspan="4" class="text-center text-danger">Semua data dihapus</td></tr>'
                      // );
                      $("#resultList").html(
                        '<div class="text-danger text-center">Belum ada hasil yang diinput</div>'
                      );
                    },
                    error: function() {
                      alert("Gagal menghapus data.");
                    },
                  });
                }
              });

              $(".btn-indicator").click(function() {
                const assetId = $(this).data("id");
                const inspectionId = $('input[name="inspection_id"]').val();
                $("#indicatorAssetId").val(assetId);
                // Reset indikator list dan tampilkan spinner
                $("#indicatorList").html(
                  '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );

                // Ambil data indikator dari server
                $.get("{{ route('backsite.asset.getIndicators') }}", {
                    asset_id: assetId,
                    inspection_id: inspectionId,

                  })
                  .done(function(data) {
                    let tableContent = `
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50%">Nama Indikator</th>
                            <th style="width:20%">Status <code>*</code></th>
                            <th style="width:30%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="indicatorTableBody">
            `;

                    let allIndicatorsFilled = true; // Cek status indikator

                    if (data.length > 0) {
                      data.forEach(indicator => {
                        const isFilled = indicator.status;

                        tableContent += `
                        <tr>
                            <td><strong>${indicator.name}</strong></td>
                            <td hidden>
                                <input type="hidden" name="indicators[${indicator.id}][indicator_name]" value="${indicator.name}">
                            </td>
                            <td>
                                <select class="form-select" name="indicators[${indicator.id}][status]" required ${isFilled ? 'disabled' : ''}>
                                    <option value="" disabled ${indicator.status ? '' : 'selected'}>Pilih</option>
                                    <option value="Baik" ${indicator.status === 'Baik' ? 'selected' : ''}>Baik</option>
                                    <option value="Rusak" ${indicator.status === 'Rusak' ? 'selected' : ''}>Rusak</option>
                                    <option value="Perlu Perbaikan" ${indicator.status === 'Perlu Perbaikan' ? 'selected' : ''}>Perlu Perbaikan</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" name="indicators[${indicator.id}][description]" ${isFilled ? 'readonly' : ''}>${indicator.description || ''}</textarea>
                            </td>
                        </tr>`;

                        if (!isFilled) {
                          allIndicatorsFilled = false;
                        }
                      });
                    } else {
                      tableContent +=
                        '<tr><td colspan="3" class="text-danger text-center">Tidak ada indikator tersedia</td></tr>';
                      allIndicatorsFilled = false;
                    }

                    tableContent += '</tbody></table>';
                    $("#indicatorList").html(tableContent);

                    // Sembunyikan tombol submit jika semua indikator sudah terisi
                    if (allIndicatorsFilled) {
                      $(".btn-save-indicator").hide();
                    } else {
                      $(".btn-save-indicator").show();
                    }
                  })
                  .fail(function() {
                    $("#indicatorList").html(
                      '<div class="text-danger text-center">Gagal memuat data indikator.</div>');
                  });

                // Tampilkan modal
                $("#indicatorModal").modal("show");
              });

              // Hapus Semua Data Testing
              $(".btn-delete-all-testing").click(function() {
                const assetId = $("#testingAssetId").val();
                const inspectionId = $('input[name="inspection_id"]').val();

                if (confirm("Yakin mau hapus semua data testing?")) {
                  $.ajax({
                    url: "{{ route('backsite.inspection.testing.delete') }}",
                    type: "DELETE",
                    data: {
                      asset_id: assetId,
                      inspection_id: inspectionId,
                      _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                      alert(response.message);
                      // $("#testingInputBody").html(
                      //   '<tr><td colspan="4" class="text-center text-danger">Semua data dihapus</td></tr>'
                      // );
                      $("#resultList").html(
                        '<div class="text-danger text-center">Belum ada hasil yang diinput</div>'
                      );
                    },
                    error: function() {
                      alert("Gagal menghapus data.");
                    },
                  });
                }
              });

              $(".btn-testing").click(function() {
                const assetId = $(this).data("id");
                const inspectionId = $('input[name="inspection_id"]').val();
                $("#testingAssetId").val(assetId);

                // Tampilkan spinner saat loading data
                $("#testingList").html(
                  '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );

                // Ambil data dari backend
                $.get("{{ route('backsite.asset.getTestings') }}", {
                    asset_id: assetId,
                    inspection_id: inspectionId,
                  })
                  .done(function(data) {
                    // console.log(data.testings);
                    // console.log(data.inspectionTestingData);
                    let inputForm = `
        <h5 class="text-center mb-3">Input Hasil Tes</h5>
        <table class="table table-bordered mb-1">
          <thead class="text-center">
            <tr>
              <th style="width:40%">Nama Test</th>
              <th style="width:20%">Hasil <code>*</code></th>
              <th style="width:30%">Keterangan</th>
            </tr>
          </thead>
          <tbody id="testingInputBody">
      `;

                    let resultList = `
        <table class="table table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th>Test Ke-</th>
              <th>Nama Test</th>
              <th>Hasil</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
      `;


                    // Cek apakah data ada
                    if (data.testings.length > 0) {
                      data.testings.forEach((testing) => {
                        const inspectionData = data.inspectionTestingData.find((item) => item.id ===
                          testing.id);

                        // Form input hasil (dari testings)
                        inputForm += `
                      <tr>
                        <td><strong>${testing.name}</strong></td>
                        <td hidden>
                          <input type="hidden" name="testings[${testing.id}][testing_name]" value="${testing.name}">
                        </td>
                        <td>
                          <input type="text" class="form-control" name="testings[${testing.id}][result]" placeholder="Masukkan hasil..." required>
                        </td>
                        <td>
                          <textarea class="form-control" name="testings[${testing.id}][description]" placeholder="Keterangan..."></textarea>
                        </td>
                      </tr>`;
                      });

                      inputForm += "</tbody></table>";

                      // Result list (dari inspectionTestingData)
                      data.inspectionTestingData.forEach((inspection) => {
                        const resultStatus = inspection.result ?
                          `<span>${inspection.result}</span>` :
                          '<span class="text-danger">Belum diisi</span>';

                        resultList += `
                        <tr>
                          <td class="text-center"><strong>${inspection.number ?? 1}</strong></td>
                          <td><strong>${inspection.testingName}</strong></td>
                          <td class="text-center">${resultStatus}</td>
                          <td>${inspection.description || '-'}</td>
                        </tr>`;
                      });

                      resultList += "</tbody></table>";
                    } else {
                      inputForm =
                        '<div class="text-danger text-center">Tidak ada indikator tersedia</div>';
                      resultList =
                        '<div class="text-danger text-center">Belum ada hasil yang diinput</div>';
                    }

                    // Masukkan hasil ke modal
                    $("#testingList").html(inputForm);
                    $("#resultList").html(resultList);
                    $(".btn-save-testing").show();
                  })
                  .fail(function() {
                    $("#testingList").html(
                      '<div class="text-danger text-center">Gagal memuat data indikator.</div>'
                    );
                  });

                // Tampilkan modal
                $("#testingModal").modal("show");
              });

            } else {
              $('#asset-list').append(
                '<tr> < td colspan = "5" class = "text-center text-warning" > Tidak ada asset ditemukan < /td> < / tr > '
              );
            }
          },
          error: function() {
            $('#asset-list').html(
              '<tr> <\td colspan = "5" class="text-center text-danger" > Gagal mengambil data asset! </td> </tr > '
            );
          }
        });
      }

    });
  </script>//#

  {{-- <script>
    $(document).ready(function() {
      const subLocationDropdown = $("#sub_location_id");
      const roomLocationDropdown = $("#location_room_id");

      const inspectionId = $('input[name="inspection_id"]').val(); // Ambil inspection_id dari form/input hidden

      if (subLocationDropdown.val() || roomLocationDropdown.val()) {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      }

      subLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      roomLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      // Ambil data asset sesuai lokasi
      function fetchAssets(subLocationId, roomLocationId) {
        $("#asset-list").html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');

        $.ajax({
          url: "{{ route('backsite.inspection.getAssets') }}",
          type: "GET",
          dataType: "json",
          data: {
            sub_location_id: subLocationId,
            location_room_id: roomLocationId,
          },
          success: function(data) {
            $("#asset-list").empty();

            if (data.length > 0) {
              data.forEach((asset, index) => {
                $("#asset-list").append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${asset.barcode || "-"}</td>
                                <td>${asset.name || "-"}</td>
                                <td>${asset.description || "-"}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm text-white btn-indicator" data-id="${asset.id}">Check</a>
                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm text-white btn-testing" data-id="${asset.id}">Testing</a>
                                </td>
                            </tr>
                        `);
              });
            } else {
              $("#asset-list").append(
                '<tr><td colspan="5" class="text-center text-warning">Tidak ada asset ditemukan</td></tr>'
              );
            }
          },
          error: function() {
            $("#asset-list").html(
              '<tr><td colspan="5" class="text-center text-danger">Gagal mengambil data asset!</td></tr>');
          },
        });
      }

      // Modal Check Indicator
      $(document).on("click", ".btn-indicator", function() {
        const assetId = $(this).data("id");

        $.ajax({
          url: "{{ route('backsite.asset.getIndicators') }}",
          type: "GET",
          dataType: "json",
          data: {
            asset_id: assetId,
            inspection_id: inspectionId,
          },
          success: function(data) {
            $("#indicator-list").empty();

            if (data.length > 0) {
              data.forEach((indicator) => {
                $("#indicator-list").append(`
                            <tr>
                                <td>${indicator.name}</td>
                                <td>${indicator.status ?? "Belum Dicek"}</td>
                                <td>${indicator.description}</td>
                            </tr>
                        `);
              });

              $("#modalIndicator").modal("show");
            } else {
              alert("Tidak ada indikator untuk asset ini.");
            }
          },
          error: function() {
            alert("Gagal mengambil data indikator.");
          },
        });
      });
    });
  </script> --}}

  {{-- <script>
    $(document).ready(function() {
      const subLocationDropdown = $('#sub_location_id');
      const roomLocationDropdown = $('#location_room_id');

      // Cek apakah dropdown sudah punya nilai dari old() atau $inspection
      const initialSubLocation = subLocationDropdown.val();
      const initialRoomLocation = roomLocationDropdown.val();

      if (initialSubLocation || initialRoomLocation) {
        fetchAssets(initialSubLocation, initialRoomLocation);
      }

      // Event listener untuk dropdown
      subLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      roomLocationDropdown.change(function() {
        fetchAssets(subLocationDropdown.val(), roomLocationDropdown.val());
      });

      // Function fetch asset sesuai subLocation & roomLocation
      function fetchAssets(subLocationId, roomLocationId) {
        $('#asset-list').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');

        $.ajax({
          url: '{{ route('backsite.inspection.getAssets') }}',
          type: 'GET',
          dataType: 'json',
          data: {
            sub_location_id: subLocationId,
            location_room_id: roomLocationId
          },
          success: function(data) {
            $('#asset-list').empty();

            if (data.length > 0) {
              data.forEach((asset, index) => {
                $('#asset-list').append(`
              <tr>
                <td>${index + 1}</td>
                <td>${asset.barcode || '-'}</td>
                <td>${asset.name || '-'}</td>
                <td>${asset.description || '-'}</td>
                <td>
                  <a href="javascript:void(0)" class="btn btn-primary btn-sm text-white btn-indicator" data-id="${asset.id}">Check</a>
                  <a href="javascript:void(0)" class="btn btn-secondary btn-sm text-white btn-testing" data-id="${asset.id}">Testing</a>
                </td>
              </tr>
            `);
              });

              // Event Indicator Button
              $('.btn-indicator').click(function() {
                const assetId = $(this).data('id');
                $('#indicatorAssetId').val(assetId);
                $('#indicatorList').html(
                  '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );

                $.get(`{{ route('backsite.asset.getIndicators') }}?asset_id=${assetId}`)
                  .done(function(data) {
                    let tableContent = `
                  <table class="table table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th style="width:50%">Nama Indikator</th>
                        <th style="width:20%">Status</th>
                        <th style="width:30%">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody id="indicatorTableBody">
                `;

                    if (data.length > 0) {
                      data.forEach(indicator => {
                        tableContent += `
                      <tr>
                        <td><strong>${indicator.name}</strong></td>
                        <td>
                          <select class="form-select" name="indicators[${indicator.id}][status]">
                            <option value="Baik" ${indicator.status === 'Baik' ? 'selected' : ''}>Baik</option>
                            <option value="Rusak" ${indicator.status === 'Rusak' ? 'selected' : ''}>Rusak</option>
                            <option value="Perlu Perbaikan" ${indicator.status === 'Perlu Perbaikan' ? 'selected' : ''}>Perlu Perbaikan</option>
                          </select>
                        </td>
                        <td>
                          <textarea class="form-control" name="indicators[${indicator.id}][description]">${indicator.description || ''}</textarea>
                        </td>
                      </tr>`;
                      });
                    } else {
                      tableContent +=
                        '<tr><td colspan="3" class="text-danger text-center">Tidak ada indikator tersedia</td></tr>';
                    }

                    tableContent += '</tbody></table>';
                    $('#indicatorList').html(tableContent);
                  })
                  .fail(function() {
                    $('#indicatorList').html(
                      '<div class="text-danger text-center">Gagal memuat data indikator.</div>');
                  });

                $('#indicatorModal').modal('show');
              });

              // Event Testing Button
              $('.btn-testing').click(function() {
                const assetId = $(this).data('id');
                $('#testingAssetId').val(assetId);
                $('#testingModal').modal('show');
              });
            } else {
              $('#asset-list').append(
                '<tr><td colspan="5" class="text-center text-warning">Tidak ada asset ditemukan</td></tr>');
            }
          },
          error: function() {
            $('#asset-list').html(
              '<tr><td colspan="5" class="text-center text-danger">Gagal mengambil data asset!</td></tr>');
          }
        });
      }

      // Reset modal indikator saat ditutup
      $('#indicatorModal').on('hidden.bs.modal', function() {
        $('#indicatorList').html('');
      });

      // Form submit indikator dengan validasi
      $('#indicatorForm').submit(function(e) {
        e.preventDefault(); // Pastikan preventDefault() jalan

        let isValid = true;

        $('textarea[name^="indicators"]').each(function() {
          if ($(this).val().trim() === '') {
            isValid = false;
            $(this).addClass('is-invalid');
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        if (!isValid) {
          alert('Pastikan semua keterangan indikator diisi!');
          return;
        }

        const formData = $(this).serialize();

        $.ajax({
          url: '{{ route('backsite.inspection.indicator.store') }}',
          type: 'POST',
          data: formData,
          success: function() {
            alert('Indicator dan status berhasil disimpan!');
            $('#indicatorModal').modal('hide');
          },
          error: function(xhr) {
            console.error(xhr);
            alert("Gagal menyimpan data: " + (xhr.responseJSON?.message || 'Terjadi kesalahan.'));
          }
        });
      });

    });
  </script> --}}
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
