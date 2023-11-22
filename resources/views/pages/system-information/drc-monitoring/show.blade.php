<table class="table table-bordered">
  <tr>
    <th>Nama Item</th>
    <td>{{ isset($drc->drc_monitoring->name) ? $drc->drc_monitoring->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Category</th>
    <td>
      @if ($drc->drc_monitoring->category == '')
        <span>N/A</span>';
      @elseif ($drc->drc_monitoring->category == 'APLIKASI')
        <h5><span>Aplikasi</spaN></h5>
      @elseif ($drc->drc_monitoring->category == 'DATABASE')
        <h5><span>Database</span></h5>
      @elseif ($drc->drc_monitoring->category == 'FILE')
        <h5><span>File</span></h5>
      @elseif ($drc->drc_monitoring->category == 'DOKUMEN')
        <h5><span>Dokumen</span></h5>
      @elseif ($drc->drc_monitoring->category == 'SOURCECODE')
        <h5><span>Source Code</span></h5>
      @elseif ($drc->drc_monitoring->category == 'VM')
        <h5><span>VM</span></h5>
      @elseif ($drc->drc_monitoring->category == 'LAIN-LAIN')
        <h5><span>Lain-lain</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Backup Frequency</th>
    <td>
      @if ($drc->drc_monitoring->backup_frequency == '')
        <span>N/A</span>';
      @elseif ($drc->drc_monitoring->backup_frequency == '6JAM')
        <h5><span>6 JAM</span></h5>
      @elseif ($drc->drc_monitoring->backup_frequency == '12JAM')
        <h5><span>12 JAM</span></h5>
      @elseif ($drc->drc_monitoring->backup_frequency == 'PERHARI')
        <h5><span>PERHARI</span></h5>
      @elseif ($drc->drc_monitoring->backup_frequency == 'PERMINGGU')
        <h5><span>PERMINGGU</span></h5>
      @elseif ($drc->drc_monitoring->backup_frequency == 'PERBULAN')
        <h5><span>PERBULAN</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Jam Backup</th>
    <td>{{ isset($drc->drc_monitoring->backup_time) ? $drc->drc_monitoring->backup_time : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Source</th>
    <td>{{ isset($drc->drc_monitoring->path_source) ? $drc->drc_monitoring->path_source : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Backup</th>
    <td>{{ isset($drc->drc_monitoring->path_backup) ? $drc->drc_monitoring->path_backup : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path DRC</th>
    <td>{{ isset($drc->drc_monitoring->path_drc) ? $drc->drc_monitoring->path_drc : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($drc->drc_monitoring->stats == '')
        <span>N/A</span>';
      @elseif ($drc->drc_monitoring->stats == 'AKTIF')
        <h5><span class="badge bg-info">Aktif</span></h5>
      @elseif ($drc->drc_monitoring->stats == 'TIDAK AKTIF')
        <h5><span class="badge bg-danger">Tidak Aktif</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">
      {{ isset($drc->drc_monitoring->description) ? $drc->drc_monitoring->description : 'N/A' }}</td>
  </tr>
</table>
