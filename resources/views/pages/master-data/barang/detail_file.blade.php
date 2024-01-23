<div class="table-responsive">
  <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
    <thead>
      <tr>
        <th class="text-center" style="width: 5px;">No</th>
        <th class="text-center" style="width: 25px;">Nama File</th>
        <th class="text-center" style="width: 30px;">File</th>
        <th style="text-align:center; width:10px;">Action</th>
      </tr>
    </thead>
    @forelse ($datafile as $file)
      <tbody>
      <tbody>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          @if ($file->file)
            {{ pathinfo($file->file, PATHINFO_FILENAME) }}
          @else
            <p style="color:red;">N/A</p>
          @endif
        </td>
        <td class="text-center">
          @if ($file->file)
            <a data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="badge bg-sm bg-info text-white">
              Lihat
            </a>
            <a type="button" href="{{ asset('storage/' . $file->file) }}" class="badge bg-sm bg-warning"
              download>Unduh</a>
          @else
            <p style="color:red;">File is Empty!</p>
          @endif
        </td>
        <td class="text-center">
          <div class="btn-group mr-1 mb-1">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Action</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
              {{-- <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
              <form action="{{ route('backsite.license.delete_file', $file->id) }}" method="POST"
                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn"value="Delete">
              </form>
            </div>
          </div>
        </td>
      </tbody>
    @empty
      <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
    @endforelse
  </table>
  @if (in_array($barang->category, ['PC', 'PC AIO', 'LAPTOP', 'SERVER', 'NAS']))

    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 5px;">No</th>
          <th class="text-center" style="width: 25px;">Nama Motherboard</th>
          <th class="text-center" style="width: 30px;">Keterangan</th>
          <th style="text-align:center; width:10px;">Action</th>
        </tr>
      </thead>
      @forelse ($motherboard as $file)
        <tbody>
        <tbody>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center">
            @if ($file->motherboard->name)
              {{ $file->motherboard->name }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>
          <td class="text-center">
            @if ($file->motherboard->description)
              {{ $file->motherboard->description }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>

          <td class="text-center">
            <div class="btn-group mr-1 mb-1">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Action</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                {{-- <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
                <form action="{{ route('backsite.license.delete_file', $file->id) }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn"value="Delete">
                </form>
              </div>
            </div>
          </td>
        </tbody>
      @empty
        <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
      @endforelse
    </table>

    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table" id="pp-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 5px;">No</th>
          <th class="text-center" style="width: 25px;">Nama Prosesor</th>
          <th class="text-center" style="width: 30px;">Keterangan</th>
          <th style="text-align:center; width:10px;">Action</th>
        </tr>
      </thead>
      @forelse ($processor as $file)
        <tbody>
        <tbody>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center">
            @if ($file->processor->name)
              {{ $file->processor->name }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>
          <td class="text-center">
            @if ($file->processor->description)
              {{ $file->processor->description }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>

          <td class="text-center">
            <div class="btn-group mr-1 mb-1">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Action</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                {{-- <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
                <form action="{{ route('backsite.license.delete_file', $file->id) }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn"value="Delete">
                </form>
              </div>
            </div>
          </td>
        </tbody>
      @empty
        <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
      @endforelse
    </table>

    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
      id="pp-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 5px;">No</th>
          <th class="text-center" style="width: 25px;">Nama Hardisk</th>
          <th class="text-center" style="width: 30px;">Keterangan</th>
          <th style="text-align:center; width:10px;">Action</th>
        </tr>
      </thead>
      @forelse ($hardisk as $file)
        <tbody>
        <tbody>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center">
            @if ($file->hardisk->name)
              {{ $file->hardisk->name }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>
          <td class="text-center">
            @if ($file->hardisk->description)
              {{ $file->hardisk->description }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>

          <td class="text-center">
            <div class="btn-group mr-1 mb-1">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Action</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                {{-- <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
                <form action="{{ route('backsite.license.delete_file', $file->id) }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn"value="Delete">
                </form>
              </div>
            </div>
          </td>
        </tbody>
      @empty
        <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
      @endforelse
    </table>

    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
      id="pp-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 5px;">No</th>
          <th class="text-center" style="width: 25px;">Nama Ram</th>
          <th class="text-center" style="width: 30px;">Keterangan</th>
          <th style="text-align:center; width:10px;">Action</th>
        </tr>
      </thead>
      @forelse ($ram as $file)
        <tbody>
        <tbody>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center">
            @if ($file->ram->name)
              {{ $file->ram->name }} => {{ $file->ram->size }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>
          <td class="text-center">
            @if ($file->ram->description)
              {{ $file->ram->description }}
            @else
              <p style="color:red;">N/A</p>
            @endif
          </td>

          <td class="text-center">
            <div class="btn-group mr-1 mb-1">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Action</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                {{-- <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap ">
                Show
              </a>
              <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                download>Download</a>
              <a class="dropdown-item" href="{{ route('backsite.pp.edit', encrypt($file->id)) }}">
                Edit
              </a> --}}
                <form action="{{ route('backsite.license.delete_file', $file->id) }}" method="POST"
                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn"value="Delete">
                </form>
              </div>
            </div>
          </td>
        </tbody>
      @empty
        <td class="text-center" colspan="4" style="color:red;">No data available in table</td>
      @endforelse
    </table>
  @endif

</div>
