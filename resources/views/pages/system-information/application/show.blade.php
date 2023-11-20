<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $app->id }}">
  <tr>
    <th>Nama Aplikasi</th>
    <td>{{ isset($app->name_app) ? $app->name_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>User</th>
    <td>{{ isset($app->user_id) ? $app->user_id : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Pembuat</th>
    <td>{{ isset($app->creator) ? $app->creator : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ isset($app->date_start) ? Carbon\Carbon::parse($app->date_start)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ isset($app->date_finish) ? Carbon\Carbon::parse($app->date_finish)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Path Aplikasi</th>
    <td>{{ isset($app->path_app) ? $app->path_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path Database</th>
    <td>{{ isset($app->path_database) ? $app->path_database : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Path File/Dokumen</th>
    <td>{{ isset($app->path_file) ? $app->path_file : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($app->description) ? $app->description : 'N/A' }}</td>
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
