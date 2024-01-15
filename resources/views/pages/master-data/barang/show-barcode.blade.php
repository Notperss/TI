<div class="container">
  <div class="row justify-content-center">
    {{ $qr }}
    <div class="col-md-6 text-center">
      <table class="table table-bordered text-center">
        <tr>
          <th>No Barcode</th>
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
          <th>Tahun</th>
          <td>{{ isset($barang->year) ? $barang->year : 'N/A' }}</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row justify-content-center">
    <button class="btn btn-info text-center" onclick="window.print()">Print</button>
  </div>
</div>
