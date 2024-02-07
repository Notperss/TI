<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 1px;">#</th>
        <th>Status</th>
        <th>Petugas</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        {{-- <th>File</th> --}}
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($datafile as $status)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            @if ($status->report_status == 1)
              <p>Open</p>
            @elseif($status->report_status == 2)
              <p>Penanganan</p>
            @elseif($status->report_status == 3)
              <p>Penanganan Lanjutan</p>
            @elseif($status->report_status == 4)
              <p>Form LK</p>
            @elseif($status->report_status == 5)
              <p>Perbaikan Vendor</p>
            @elseif($status->report_status == 6)
              <p>Menyerahkan Barang ke Vendor</p>
            @elseif($status->report_status == 7)
              <p>Menerima Barang dari Vendor</p>
            @elseif($status->report_status == 8)
              <p>BA</p>
            @elseif($status->report_status == 9)
              <p>Selesai</p>
            @elseif($status->report_status == 10)
              <p>Tidak Selesai - Rusak</p>
            @else
              <!-- Handle other options if needed -->
            @endif
          </td>
          <td>{{ $status->user->name }}</td>
          <td>{{ $status->date }}</td>
          <td>{{ $status->description }}</td>
          {{-- <td>
            <a type="button" data-fancybox data-src="{{ asset('storage/' . $status->file) }}"
              class="btn btn-info btn-sm text-white ">
              Lihat
            </a> <a type="button" href="{{ asset('storage/' . $status->file) }}" class="btn btn-warning btn-sm text-white"
              download>Unduh</a>
          </td> --}}
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Action</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                @if ($status->file)
                  <a type="button" data-fancybox data-src="{{ asset('storage/' . $status->file) }}"
                    class="dropdown-item">
                    Lihat File
                  </a> <a type="button" href="{{ asset('storage/' . $status->file) }}" class="dropdown-item"
                    download>Unduh File</a>
                @endif
                <form action="{{ route('backsite.maintenance.delete_status', $status->id ?? '') }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit"id="delete_file" class="dropdown-item"value="Delete">
                </form>

              </div>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td class="text-center" colspan="7" style="color:red;">No data available in table</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
