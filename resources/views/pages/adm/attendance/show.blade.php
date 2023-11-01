<table class="table table-bordered">
  <tr>
    <th>Nama</th>
    <td>{{ isset($attendance->detail_user->user->name) ? $attendance->detail_user->user->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Jenis Absensi</th>
    <td>
      @if ($attendance->category == 0)
        <span>N/A</span>';
      @elseif ($attendance->category == 1)
        <h5><span class="badge bg-danger">Absen</span></h5>
      @elseif ($attendance->category == 2)
        <h5><span class="badge bg-warning">Sakit</span></h5>
      @elseif ($attendance->category == 3)
        <h5><span class="badge bg-info">Dinas</span></h5>
      @elseif ($attendance->category == 4)
        <h5><span class="badge bg-secondary">Cuti</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ $attendance->start_date ? Carbon\Carbon::parse($attendance->start_date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ $attendance->finish_date ? Carbon\Carbon::parse($attendance->finish_date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td>{{ isset($attendance->description) ? $attendance->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $attendance->file) }}" class="blue accent-4">Show</a>
    </td>
    </td>
  </tr>
</table>
