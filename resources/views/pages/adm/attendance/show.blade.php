<table class="table table-bordered">
    <tr>
        <th>Tanggal</th>
        <td>{{ isset($attendance->tanggal) ? $attendance->tanggal : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Hadir</th>
        <td>{{ isset($attendance->hadir) ? $attendance->hadir : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Absen</th>
        <td>{{ isset($attendance->absen) ? $attendance->absen : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Izin</th>
        <td>{{ isset($attendance->izin) ? $attendance->izin : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sakit</th>
        <td>{{ isset($attendance->sakit) ? $attendance->sakit : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Cuti</th>
        <td>{{ isset($attendance->cuti) ? $attendance->cuti : 'N/A' }}</td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $attendance->file) }}"
                class="blue accent-4">Show</a></td>
        </td>
    </tr>

    <tr>
        <th>Keterangan</th>
        <td>
            {{ isset($attendance->keterangan) ? $attendance->keterangan : 'N/A' }}
        </td>
    </tr>
</table>
