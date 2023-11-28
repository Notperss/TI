<table class="table table-bordered">
  <tr>
    <th>Type</th>
    <td>{{ isset($cctv->type) ? $cctv->type : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Merk</th>
    <td>{{ isset($cctv->brand) ? $cctv->brand : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Lokasi</th>
    <td>{{ isset($cctv->location) ? $cctv->location : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Maintainer</th>
    <td>{{ isset($cctv->maintainer) ? $cctv->maintainer : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Barcode</th>
    <td>{{ isset($cctv->barcode) ? $cctv->barcode : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Category</th>
    <td>{{ isset($cctv->category) ? $cctv->category : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>{{ isset($cctv->stats) ? $cctv->stats : 'N/A' }}</td>
  </tr>
  <tr>
    <th>IP</th>
    <td>{{ isset($cctv->ip) ? $cctv->ip : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Link</th>
    <td>{{ isset($cctv->link) ? $cctv->link : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Username</th>
    <td>{{ isset($cctv->username_cctv) ? $cctv->username_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Password</th>
    <td>{{ isset($cctv->password_cctv) ? $cctv->password_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Lon & Lat</th>
    <td>{{ isset($cctv->lon_lat) ? $cctv->lon_lat : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Type Cctv</th>
    <td>{{ isset($cctv->type_cctv) ? $cctv->type_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Pasang</th>
    <td>
      {{ $cctv->installation_date ? Carbon\Carbon::parse($cctv->installation_date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">{{ isset($cctv->description) ? $cctv->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($cctv->file)
      <td>
        <a type="button" data-fancybox data-src="{{ asset('storage/' . $cctv->file) }}"
          class="btn btn-info btn-sm text-white">
          Lihat
        </a>
        <a type="button" href="{{ asset('storage/' . $cctv->file) }}" class="btn btn-warning btn-sm" download>
          Unduh
        </a>
        <p class="mt-1">Latest File : {{ pathinfo($cctv->file, PATHINFO_FILENAME) }}</p>
      @else
      <td> No File!</td>
    @endif
    </td>
    </td>
  </tr>
</table>
