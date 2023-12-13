<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $distribution->id }}">
  <tr>
    <th>Ruangan</th>
    <td>{{ isset($distribution->location_room->name) ? $distribution->location_room->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>User</th>
    <td>{{ isset($distribution->detail_user->user->name) ? $distribution->detail_user->user->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal</th>
    <td>
      {{ isset($distribution->date) ? Carbon\Carbon::parse($distribution->date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($distribution->description) ? $distribution->description : 'N/A' }}</td>
  </tr>
</table>
<table class="table table-bordered tampildata" style="word-break: break-all">
</table>

<script>
  function tampilDataFile() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let id = $('#id').val();
    $.ajax({
      type: "post",
      url: "{{ route('backsite.distribution.show_file') }}",
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
</script>
