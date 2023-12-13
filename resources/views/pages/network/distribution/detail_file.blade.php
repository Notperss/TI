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
    @foreach ($datafile as $file)
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->asset->name)
            {{ $file->asset->name }}
          @else
            <p style="color:red;">Name File is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->asset->category)
            {{ $file->asset->category }}
          @else
            <p style="color:red;">Category is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->asset->barcode)
            {{ $file->asset->barcode }}
          @else
            <p style="color:red;">Barcode is Empty!</p>
          @endif
        </td>
      </tbody>
    @endforeach
  </table>
</div>
