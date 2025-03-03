<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Nama Item</th>
        <th class="text-center" style="width: 30px;">Category</th>
        <th class="text-center" style="width: 30px;">Barcode</th>
        <th style="text-align:center; width:10px;">Action</th>
      </tr>
    </thead>
    @foreach ($datafile as $file)
      <tbody>
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if (isset($file->barang->name))
            {{ $file->barang->name }}
          @else
            <p style="color:red;">Name File is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          @if (isset($file->barang->category))
            {{ $file->barang->category }}
          @else
            <p style="color:red;">Category name is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          @if (isset($file->barang->barcode))
            {{ $file->barang->barcode }}
          @else
            <p style="color:red;">Barcode name is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          <div class="btn-group mr-1 mb-1">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Action</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
              @if (isset($file->barang->file))
                <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->barang->file) }}"
                  class="btn text-nowrap ">
                  Show
                </a>
                <a type="button" href="{{ asset('storage/' . $file->barang->file) }}" class="btn text-nowrap"
                  download>Download</a>
              @endif
              {{-- <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
              {{-- @if ($file->lending_facility->stats == 1)
                <form action="{{ route('backsite.pp.hapus_file', $file->id) }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn"value="Delete">
                </form>
              @endif --}}
            </div>
          </div>
        </td>
      </tbody>
    @endforeach
  </table>
</div>
