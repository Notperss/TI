<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $actdaily->id }}">
  <tr>
    <th>Pelaksana</th>
    <td>{{ isset($actdaily->detail_user->user->name) ? $actdaily->detail_user->user->name : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Pendamping</th>
    <td>{{ isset($actdaily->users->name) ? $actdaily->users->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ isset($actdaily->start_date) ? Carbon\Carbon::parse($actdaily->start_date)->translatedFormat('l, d F Y H:i') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Jenis Pekerjaan</th>
    <td>{{ isset($actdaily->work_type->job_type) ? $actdaily->work_type->job_type : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Kegiatan</th>
    <td>{!! isset($actdaily->activity) ? $actdaily->activity : 'N/A' !!}</td>
  </tr>
  <tr>
    <th>Lokasi</th>
    <td>{{ isset($actdaily->location_room->name) ? $actdaily->location_room->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ isset($actdaily->finish_date) ? Carbon\Carbon::parse($actdaily->finish_date)->translatedFormat('l, d F Y H:i') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Catatan</th>
    <td>{!! isset($actdaily->description) ? $actdaily->description : 'N/A' !!}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($actdaily->status == 2)
        <span class="badge badge-success">{{ 'Approve' }}</span>
      @elseif($actdaily->status == 1)
        <span class="badge badge-danger">{{ 'Belum DiApprove' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </td>
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
      url: "{{ route('backsite.act_daily.show_file') }}",
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
