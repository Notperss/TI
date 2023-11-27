<table class="table table-bordered">
  <tr>
    <th>Type</th>
    <td>{{ isset($ip_phone->type) ? $ip_phone->type : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Merk</th>
    <td>{{ isset($ip_phone->brand) ? $ip_phone->brand : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Lokasi</th>
    <td>{{ isset($ip_phone->location) ? $ip_phone->location : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Maintainer</th>
    <td>{{ isset($ip_phone->maintainer) ? $ip_phone->maintainer : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Barcode</th>
    <td>{{ isset($ip_phone->barcode) ? $ip_phone->barcode : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Category</th>
    <td>{{ isset($ip_phone->category) ? $ip_phone->category : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>{{ isset($ip_phone->stats) ? $ip_phone->stats : 'N/A' }}</td>
  </tr>
  <tr>
    <th>IP</th>
    <td>{{ isset($ip_phone->ip) ? $ip_phone->ip : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Link</th>
    <td>{{ isset($ip_phone->link) ? $ip_phone->link : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Username</th>
    <td>{{ isset($ip_phone->username_cctv) ? $ip_phone->username_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Password</th>
    <td>{{ isset($ip_phone->password_cctv) ? $ip_phone->password_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Lon & Lat</th>
    <td>{{ isset($ip_phone->lon_lat) ? $ip_phone->lon_lat : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Type Cctv</th>
    <td>{{ isset($ip_phone->type_cctv) ? $ip_phone->type_cctv : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Pasang</th>
    <td>
      {{ $ip_phone->installation_date ? Carbon\Carbon::parse($ip_phone->installation_date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">{{ isset($ip_phone->description) ? $ip_phone->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($ip_phone->file)
      <td>
        <a type="button" data-fancybox data-src="{{ asset('storage/' . $ip_phone->file) }}"
          class="btn btn-info btn-sm text-white">
          Lihat
        </a>
        <a type="button" href="{{ asset('storage/' . $ip_phone->file) }}" class="btn btn-warning btn-sm" download>
          Unduh
        </a>
        <p class="mt-1">Latest File : {{ pathinfo($ip_phone->file, PATHINFO_FILENAME) }}</p>
      @else
      <td> No File!</td>
    @endif
    </td>
    </td>
  </tr>
</table>
