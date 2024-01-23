<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Nama Item</th>
        <th class="text-center" style="width: 25px;">Category</th>
        <th class="text-center" style="width: 25px;">Barcode</th>
        <th class="text-center" style="width: 25px;">Action</th>
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
        <td class="text-center">
          <a href="#mymodal" data-remote="{{ route('backsite.barang.showBarcode', $file->asset->id) }}"
            data-toggle="modal" data-target="#mymodalshow" data-title="QR-Code"
            class=" btn btn-sm list-group-item-info">
            Print
          </a>
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
        <th class="text-center" style="width: 25px;" colspan="2">IP</th>
        <th class="text-center" style="width: 25px;">Akses Internet</th>
        <th class="text-center" style="width: 25px;">Gateway</th>
      </tr>
    </thead>
    @forelse ($ip_deployments as $ip)
      <tbody class="border-0">
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center" colspan="2">
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
<br>

<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;" colspan="2">Nama Aplikasi</th>
        <th class="text-center" style="width: 25px;">Versi</th>
        <th class="text-center" style="width: 25px;">Product</th>
      </tr>
    </thead>
    @forelse ($apps as $app)
      <tbody class="border-0">
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center" colspan="2">
          @if ($app->app->name_app)
            {{ $app->app->name_app }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($app->app->version)
            {{ $app->app->version }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($app->app->product)
            {{ $app->app->product }}
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
