<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Nama Item</th>
        <th class="text-center" style="width: 25px;">Category</th>
        <th class="text-center" style="width: 25px;">Barcode</th>
      </tr>
    </thead>
    @forelse ($datafile as $file)
      <tbody class="border-0">
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->asset->name)
            {{ $file->asset->name }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->asset->category)
            {{ $file->asset->category }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->asset->barcode)
            {{ $file->asset->barcode }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
      </tbody>
    @empty
      <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
    @endforelse
  </table>
</div>
<br>

<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">IP</th>
        <th class="text-center" style="width: 25px;">Akses Internet</th>
        <th class="text-center" style="width: 25px;">Gateway</th>
      </tr>
    </thead>
    @forelse ($ip_deployments as $ip)
      <tbody class="border-0">
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($ip->ip)
            {{ $ip->ip }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($ip->internet_access)
            {{ $ip->internet_access == 1 ? 'Ada Internet' : 'Tidak ada Internet' }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($ip->gateway)
            {{ $ip->gateway }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
      </tbody>
    @empty
      <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
    @endforelse
  </table>
</div>
