<div class="btn-group mr-1 mb-1">
    <button type="button" class="btn btn-cyan btn-sm mr-1" title="Tambah File" onclick="upload(' {{ $id }}')"><i
            class="bx bx-file"></i></button>
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Action</button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
        <a href="#mymodal" data-remote="{{ route('backsite.act_daily.show', $id) }}" data-toggle="modal"
            data-target="#mymodal" data-title="Detail Aktivitas Harian" class="dropdown-item">
            Show
        </a>
        <a class="dropdown-item" href="{{ route('backsite.act_daily.edit', $id) }}">
            Edit
        </a>
        <form action="{{ route('backsite.act_daily.destroy', $id) }}" method="POST"
            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="dropdown-item" value="Delete">
        </form>
    </div>
