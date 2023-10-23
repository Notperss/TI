<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ isset($cctv->name) ? $cctv->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>KM</th>
        <td>{{ isset($cctv->km) ? $cctv->km : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Latitude</th>
        <td>{{ isset($cctv->latitude) ? $cctv->latitude : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Longitude</th>
        <td>{{ isset($cctv->longitude) ? $cctv->longitude : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Link CCTV</th>
        <td><a href="{{ $cctv->link_cctv }}" target="_blank">Klik link ini untuk melihat cctv</a></td>
    </tr>
    <tr>
        <th>Logo</th>
        <td><img src="{{ asset('storage/' . $cctv->logo) }}" alt="Logo CCTV" width="50px"></td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($cctv->description) ? $cctv->description : 'N/A' !!}</td>
    </tr>
</table>
