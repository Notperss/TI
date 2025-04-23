<h3>Inspeksi</h3>
<table class="table table-bordered">
  <tr>
    <th>Inspektor</th>
    <td>{{ isset($inspection->inspection->user->name) ? $inspection->inspection->user->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Shift</th>
    <td>{{ isset($inspection->inspection->shift) ? $inspection->inspection->shift : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal</th>
    <td>
      {{ isset($inspection->inspection->date_inspection) ? Carbon\Carbon::parse($inspection->inspection->date_inspection)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($inspection->inspection->description) ? $inspection->inspection->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Lokasi Utama</th>
    <td>{{ isset($inspection->inspection->location->name) ? $inspection->inspection->location->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Sub Lokasi</th>
    <td>{{ isset($inspection->inspection->locationSub->name) ? $inspection->inspection->locationSub->name : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Lokasi</th>
    <td>{{ isset($inspection->inspection->locationRoom->name) ? $inspection->inspection->locationRoom->name : 'N/A' }}
    </td>
  </tr>
</table>

<h3>Asset</h3>
<table class="table table-bordered">
  <tr>
    <th>Barcode</th>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Keterangan</th>
  </tr>
  <tr>
    <td>{{ isset($inspection->asset->barcode) ? $inspection->asset->barcode : 'N/A' }}</td>
    <td>{{ isset($inspection->asset->name) ? $inspection->asset->name : 'N/A' }}</td>
    <td>{{ isset($inspection->asset->category) ? $inspection->asset->category : 'N/A' }}</td>
    <td>{{ isset($inspection->asset->description) ? $inspection->asset->description : 'N/A' }}</td>
  </tr>
</table>
