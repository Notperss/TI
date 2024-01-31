<div style="display: flex;">
  <table class="table table-bordered" style="width: 50%;">
    <input type="hidden" name="id" id="id" value="{{ $barang->id }}">
    <tr>
      <th>Barcode</th>
      <td>{{ isset($barang->barcode) ? $barang->barcode : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Nama Barang</th>
      <td>{{ isset($barang->name) ? $barang->name : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Kategori</th>
      <td>{{ isset($barang->category) ? $barang->category : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Merk</th>
      <td>{{ isset($barang->brand) ? $barang->brand : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Tahun</th>
      <td>{{ isset($barang->year) ? $barang->year : 'N/A' }}</td>
    </tr>
    <tr>
      <th>SKU</th>
      <td>{{ isset($barang->sku) ? $barang->sku : 'N/A' }}</td>
    </tr>
    <tr>
      @php
        $employeeNames = [];
        $distributionAssets = $barang->distribution_asset;

        foreach ($distributionAssets as $distributionAsset) {
            $distribution = $distributionAsset->distribution;

            if ($distribution && ($employee = $distribution->employee)) {
                $employeeNames[] = $employee->name;
            }
        }

        // Concatenate employee names with a separator (e.g., comma)
        $employeeName = $employeeNames ? end($employeeNames) : 'N/A';

      @endphp
      <th>User</th>
      <td>{{ $employeeName }}</td>
    </tr>
  </table>

  <table class="table table-bordered" style="width: 50%;">
    <tr>
      <th>Tipe Asset</th>
      <td>{{ isset($barang->type_assets) ? $barang->type_assets : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Ukuran</th>
      <td>{{ isset($barang->size) ? $barang->size : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>
        @if ($barang->stats == '')
          <span>N/A</span>';
        @elseif ($barang->stats == '5')
          <h5><span class="badge bg-secondary">Rusak</span></h5>
        @elseif ($barang->stats == '4')
          <h5><span class="badge bg-primary">Diserahkan</span></h5>
        @elseif ($barang->stats == '3')
          <h5><span class="badge bg-warning">Perbaikan</span></h5>
        @elseif ($barang->stats == '2')
          <h5><span class="badge bg-danger">Dipakai</span></h5>
        @elseif ($barang->stats == '1')
          <h5><span class="badge bg-info">Available</span></h5>
        @else
          <h5><span> - </span></h5>
        @endif
      </td>
    </tr>
    <tr>
      <th>Keterangan</th>
      <td>{{ isset($barang->description) ? $barang->description : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Gambar</th>
      @if ($barang->file)
        <td>
          <img src="{{ asset('storage/' . $barang->file) }}" class="block mb-1" style="width: 35%" alt="">
          <a type="button" data-fancybox data-src="{{ asset('storage/' . $barang->file) }}"
            class="btn btn-info btn-sm text-white">
            Lihat
          </a>
          <a type="button" href="{{ asset('storage/' . $barang->file) }}" class="btn btn-warning btn-sm text-white"
            download>
            Unduh
          </a>
          <br>
          <p class="mt-1">Latest File : {{ pathinfo($barang->file, PATHINFO_FILENAME) }}</p>
        @else
        <td> N/A</td>
      @endif
      </td>
      </td>
    </tr>
    <tr>
      @php
        $location_roomNames = [];
        $distributionAssets = $barang->distribution_asset;

        foreach ($distributionAssets as $distributionAsset) {
            $distribution = $distributionAsset->distribution;

            if ($distribution && ($location_room = $distribution->location_room)) {
                $location_roomNames[] = $location_room->name;
            }
        }

        // Concatenate location_room names with a separator (e.g., comma)
        $location_roomName = $location_roomNames ? end($location_roomNames) : 'N/A';

      @endphp
      <th> Lokasi</th>
      <td>{{ $location_roomName }}</td>
    </tr>
  </table>
</div>

<table class="table table-bordered tampildata my-1" style="word-break: break-all">
</table>

<script>
  function tampilDataFile() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let id = $('#id').val();
    $.ajax({
      type: "post",
      url: "{{ route('backsite.barang.show_file') }}",
      data: {
        id: id
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampildata').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  $(document).ready(function() {
    tampilDataFile();
  });
</script>
