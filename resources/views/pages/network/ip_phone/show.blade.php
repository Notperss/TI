<table class="table table-bordered">
  <tr>
    <th>Caller ID</th>
    <td>{{ isset($ip_phone->caller) ? $ip_phone->caller : 'N/A' }}</td>
  </tr>

  <tr>
    <th>Lokasi</th>
    <td>{{ isset($ip_phone->location) ? $ip_phone->location : 'N/A' }}</td>
  </tr>

  <tr>
    <th>Barcode</th>
    <td>{{ isset($ip_phone->barcode) ? $ip_phone->barcode : 'N/A' }}</td>
  </tr>

  <tr>
    <th>IP</th>
    <td>{{ isset($ip_phone->ip) ? $ip_phone->ip : 'N/A' }}</td>
  </tr>

  <tr>
    <th>Type</th>
    <td>{{ isset($ip_phone->type) ? $ip_phone->type : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Pasang</th>
    <td>
      {{ $ip_phone->installation_date ? Carbon\Carbon::parse($ip_phone->installation_date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($ip_phone->stats == 1)
        <span class="badge badge-success">{{ 'Aktif' }}</span>
      @elseif($ip_phone->stats == 2)
        <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
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
