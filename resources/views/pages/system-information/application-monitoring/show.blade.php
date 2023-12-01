<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $app->id }}">
  <tr>
    <th>Nama Aplikasi</th>
    <td>{{ isset($app->app_monitoring->name_app) ? $app->app_monitoring->name_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>User</th>
    <td>{{ isset($app->app_monitoring->user) ? $app->app_monitoring->user : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Pembuat</th>
    <td>{{ isset($app->app_monitoring->creator) ? $app->app_monitoring->creator : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ isset($app->app_monitoring->date_start) ? Carbon\Carbon::parse($app->app_monitoring->date_start)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ isset($app->app_monitoring->date_finish) ? Carbon\Carbon::parse($app->app_monitoring->date_finish)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Path Aplikasi</th>
    <td>{{ isset($app->app_monitoring->path_app) ? $app->app_monitoring->path_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Database</th>
    <td>{{ isset($app->app_monitoring->path_database) ? $app->app_monitoring->path_database : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path File/Dokumen</th>
    <td>{{ isset($app->app_monitoring->path_file) ? $app->app_monitoring->path_file : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($app->app_monitoring->description) ? $app->app_monitoring->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($app->app_monitoring->stats == '')
        <span>N/A</span>';
      @elseif ($app->app_monitoring->stats == '2')
        <h5><span class="badge bg-danger">Tidak Aktif</span></h5>
      @elseif ($app->app_monitoring->stats == '1')
        <h5><span class="badge bg-info">Aktif</span></h5>
      @else
        <h5><span> - </span></h5>
      @endif
    </td>
  </tr>
</table>
<table class="table table-bordered tampildata" style="word-break: break-all">
</table>

{{-- <script>
  function tampilDataFile() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let id = $('#id').val();
    $.ajax({
      type: "post",
      url: "{{ route('backsite.app.show_file') }}",
      data: {
        id: id
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampildata').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  $(document).ready(function() {
    tampilDataFile();
  });
</script> --}}
