<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Nama Item</th>
      </tr>
    </thead>
    @foreach ($datafile as $file)
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->asset_id)
            {{ $file->asset_id }}
          @else
            <p style="color:red;">Name File is Empty!</p>
          @endif
        </td>
      </tbody>
    @endforeach
  </table>
</div>
