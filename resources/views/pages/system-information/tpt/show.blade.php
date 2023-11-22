<table class="table table-bordered">
  <tr>
    <th>Nama Item</th>
    <td>{{ isset($drc->name) ? $drc->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Category</th>
    <td>
      @if ($drc->category == '')
        <span>N/A</span>';
      @elseif ($drc->category == 'APLIKASI')
        <h5><span>Aplikasi</spaN></h5>
      @elseif ($drc->category == 'DATABASE')
        <h5><span>Database</span></h5>
      @elseif ($drc->category == 'FILE')
        <h5><span>File</span></h5>
      @elseif ($drc->category == 'DOKUMEN')
        <h5><span>Dokumen</span></h5>
      @elseif ($drc->category == 'SOURCECODE')
        <h5><span>Source Code</span></h5>
      @elseif ($drc->category == 'VM')
        <h5><span>VM</span></h5>
      @elseif ($drc->category == 'LAIN-LAIN')
        <h5><span>Lain-lain</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Backup Frequency</th>
    <td>
      @if ($drc->backup_frequency == '')
        <span>N/A</span>';
      @elseif ($drc->backup_frequency == '6JAM')
        <h5><span>6 JAM</span></h5>
      @elseif ($drc->backup_frequency == '12JAM')
        <h5><span>12 JAM</span></h5>
      @elseif ($drc->backup_frequency == 'PERHARI')
        <h5><span>PERHARI</span></h5>
      @elseif ($drc->backup_frequency == 'PERMINGGU')
        <h5><span>PERMINGGU</span></h5>
      @elseif ($drc->backup_frequency == 'PERBULAN')
        <h5><span>PERBULAN</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Jam Backup</th>
    <td>{{ isset($drc->backup_time) ? $drc->backup_time : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Source</th>
    <td>{{ isset($drc->path_source) ? $drc->path_source : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Backup</th>
    <td>{{ isset($drc->path_backup) ? $drc->path_backup : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path DRC</th>
    <td>{{ isset($drc->path_drc) ? $drc->path_drc : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($drc->stats == '')
        <span>N/A</span>';
      @elseif ($drc->stats == 'AKTIF')
        <h5><span class="badge bg-info">Aktif</span></h5>
      @elseif ($drc->stats == 'TIDAK AKTIF')
        <h5><span class="badge bg-danger">Tidak Aktif</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">{{ isset($drc->description) ? $drc->description : 'N/A' }}</td>
  </tr>
</table>
