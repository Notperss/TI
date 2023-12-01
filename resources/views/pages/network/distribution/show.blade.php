<table class="table table-bordered">
  <tr>
    <th>Nomor Surat</th>
    <td>{{ isset($barang->name) ? $barang->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tipe Surat</th>
    <td>
      @if ($barang->category == '')
        <span>N/A</span>';
      @elseif ($barang->category == 'PC')
        <h5><span>PC</span></h5>
      @elseif ($barang->category == 'PRINTER')
        <h5><span>PRINTER</span></h5>
      @elseif ($barang->category == 'KEYBOARD')
        <h5><span>KEYBOARD</span></h5>
      @elseif ($barang->category == 'MOUSE')
        <h5><span>MOUSE</span></h5>
      @elseif ($barang->category == 'MONITOR')
        <h5><span>MONITOR</span></h5>
      @elseif ($barang->category == 'LAIN-LAIN')
        <h5><span>Lain-lain</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Barcode</th>
    <td>{{ isset($barang->barcode) ? $barang->barcode : 'N/A' }}</td>
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
