<table class="table table-bordered">
    <tr>
        <th>Lokasi</th>
        <td>{{ isset($location_detail->location->name) ? $location_detail->location->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sub Lokasi</th>
        <td>{{ isset($location_detail->location_sub->name) ? $location_detail->location_sub->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Ruangan</th>
        <td>{{ isset($location_detail->location_room->name) ? $location_detail->location_room->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Latitude</th>
        <td>{{ isset($location_detail->latitude) ? $location_detail->latitude : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Longitude</th>
        <td>{{ isset($location_detail->longitude) ? $location_detail->longitude : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($location_detail->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($location_detail->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{{ isset($location_detail->keterangan) ? $location_detail->keterangan : 'N/A' }}
        </td>
    </tr>
</table>
