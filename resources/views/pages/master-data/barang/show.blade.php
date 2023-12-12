<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $barang->id }}">
  <tr>
    <th>Nama Barang</th>
    <td>{{ isset($barang->name) ? $barang->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Barcode</th>
    <td>{{ isset($barang->barcode) ? $barang->barcode : 'N/A' }}</td>
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
    <th>File</th>
    @if ($barang->file)
      <td> <a type="button" data-fancybox data-src="{{ asset('storage/' . $barang->file) }}"
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
      <td> No File!</td>
    @endif
    </td>
    </td>
  </tr>
</table>

<table class="table table-bordered tampildata" style="word-break: break-all">
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
