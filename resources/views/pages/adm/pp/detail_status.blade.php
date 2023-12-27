<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Tipe Status</th>
        <th class="text-center" style="width: 30px;">Tanggal</th>
        <th class="text-center" style="width: 30px;">Keterangan</th>
        <th style="text-align:center; width:10px;">Action</th>
      </tr>
    </thead>
    @foreach ($datafile as $file)
      <tbody>
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->type_status)
            {{ $file->type_status }}
          @else
            <p style="color:red;">Type Status File is Empty!</p>
          @endif
        </td>
        <td>
          @if ($file->date)
            {{ Carbon\Carbon::parse($file->date)->translatedFormat('l, d F Y') }}
          @else
            <p style="color:red;">Date is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->description)
            {{ $file->description }}
          @else
            <p style="color:red;">Description is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          <div class="btn-group mr-1 mb-1">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Action</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
              <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              {{-- <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
              <form action="{{ route('backsite.pp.delete_status', $file->id) }}" method="POST"
                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn"value="Delete">
              </form>
            </div>
          </div>
        </td>
      </tbody>
    @endforeach
  </table>
</div>
