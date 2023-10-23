<table class="table table-bordered">
    <tr>
        <th>No Asset</th>
        <td>
            <span class="badge badge-success">{{ isset($device_pc->no_asset) ? $device_pc->no_asset : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Motherboard</th>
        <td>{{ isset($device_pc->motherboard->name) ? $device_pc->motherboard->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Processor</th>
        <td>{{ isset($device_pc->processor->name) ? $device_pc->processor->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Hardisk</th>
        <td>
            @foreach (explode(',', $device_pc->hardisk_id) as $data_hardisk)
                @php
                    $spek_hardisk = DB::table('hardware_hardisk')
                        ->where('id', $data_hardisk)
                        ->get();
                @endphp
                @foreach ($spek_hardisk as $hardisk)
                    {{ $hardisk->name }} - {{ $hardisk->size }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Ram</th>
        <td>
            @foreach (explode(',', $device_pc->ram_id) as $data_ram)
                @php
                    $spek_ram = DB::table('hardware_ram')
                        ->where('id', $data_ram)
                        ->get();
                @endphp
                @foreach ($spek_ram as $ram)
                    {{ $ram->name }} - {{ $ram->size }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_pc->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>

    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_pc->description) ? $device_pc->description : 'N/A' !!}</td>
    </tr>
</table>
