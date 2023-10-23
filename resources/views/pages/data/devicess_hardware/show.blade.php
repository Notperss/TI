<table class="table table-bordered">
    <tr>
        <th>No Asset</th>
        <td> <span class="badge badge-success">
                {{ isset($device_hardware->asset_device) ? $device_hardware->asset_device : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Tipe Device</th>
        <td>{{ isset($device_hardware->type_device->name) ? $device_hardware->type_device->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th></th>
        <td>
            <table class="table table-bordered">
                <tr>
                    <th>Processor</th>
                    <th>Motherboard</th>
                    <th>Ram</th>
                    <th>Hardisk</th>
                </tr>
                @forelse ($device_spesification_pc as $spesification)
                    <tr>
                        <td>
                            {{ $spesification->processor->name }}
                        </td>
                        <td>
                            {{ $spesification->motherboard->name }}
                        </td>
                        <td>
                            @foreach (explode(',', $spesification->ram_id) as $data_ram)
                                @php
                                    $spek_ram = DB::table('hardware_ram')
                                        ->where('id', $data_ram)
                                        ->get();
                                @endphp
                                @foreach ($spek_ram as $ram)
                                    {{ $ram->name }} ||
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            @foreach (explode(',', $spesification->hardisk_id) as $data_hardisk)
                                @php
                                    $spek_hardisk = DB::table('hardware_hardisk')
                                        ->where('id', $data_hardisk)
                                        ->get();
                                @endphp
                                @foreach ($spek_hardisk as $hardisk)
                                    {{ $hardisk->name }} ||
                                @endforeach
                            @endforeach
                        </td>
                    </tr>
                @empty
                    {{-- not found --}}
                @endforelse
                <tr>
                    <th colspan="2">Monitor</th>
                    <th colspan="2">No Asset Monitor</th>
                </tr>
                @forelse ($device_monitor as $monitor)
                    <tr>
                        <td colspan="2">
                            {{ $monitor->monitor->name }}
                        </td>
                        <td colspan="2">
                            <span class="badge badge-success">{{ $monitor->asset_monitor }}</span>
                        </td>
                    </tr>
                @empty
                    {{-- not found --}}
                @endforelse
                <tr>
                    <th colspan="2">Perangkat Tambahan</th>
                    <th colspan="2">No Non Asset</th>
                </tr>
                @forelse ($device_additional as $additional)
                    <tr>
                        <td colspan="2">
                            {{ $additional->additional_device->category }} -
                            {{ $additional->additional_device->name }}
                        </td>
                        <td colspan="2">
                            <span class="badge badge-success">{{ $additional->asset_additional_device }}</span>
                        </td>
                    </tr>
                @empty
                    {{-- not found --}}
                @endforelse
            </table>
        </td>
    </tr>
    <tr>
        <th>File</th>
        <td>
            <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_hardware->file) }}"
                class="blue accent-4 dropdown-item">Show</a>
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_hardware->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($device_hardware->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>
            {!! $device_hardware->description !!}
        </td>
    </tr>
</table>
