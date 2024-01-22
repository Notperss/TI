<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Tipe File</th>
        <th class="text-center" style="width: 30px;">Nama File</th>
        <th class="text-center" style="width: 30px;">Keterangan</th>
        <th style="text-align:center; width:10px;">Action</th>
      </tr>
    </thead>
    @forelse ($datafile as $file)
      <tbody>
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->type_file == 1)
            KAK
          @elseif ($file->type_file == 2)
            Engineering Estimate
          @elseif ($file->type_file == 3)
            Form PP
          @elseif ($file->type_file == 4)
            Form Cashmen
          @elseif ($file->type_file == 5)
            Memo PL
          @elseif ($file->type_file == 6)
            Memo
          @elseif ($file->type_file == 7)
            Penawaran
          @elseif ($file->type_file == 8)
            Risalah Rapat
          @elseif ($file->type_file == 9)
            OP (Offering Price)
          @elseif ($file->type_file == 10)
            Kontrak
          @elseif ($file->type_file == 11)
            Addendum
          @elseif ($file->type_file == 12)
            BA Terima Barang
          @elseif ($file->type_file == 13)
            Lain-lain (Others)
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->name_file)
            {{ $file->name_file }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->description_file)
            {{ $file->description_file }}
          @else
            <p style="color:red;">N/A</p>
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
              <form action="{{ route('backsite.pp.hapus_file', $file->id) }}" method="POST"
                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn" value="Delete">
              </form>
            </div>
          </div>
        </td>
      </tbody>
    @empty
      <td class="text-center" colspan="5" style="color:red;">No data available in table</td>
    @endforelse
  </table>
</div>
