<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $pp->id }}">
  <tr>
    <th>No PP</th>
    <td>{{ isset($pp->no_pp) ? $pp->no_pp : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Nama Pekerjaan</th>
    <td>{{ isset($pp->job_name) ? $pp->job_name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nilai Pekerjaan</th>
    <td>{{ isset($pp->job_value) ? $pp->job_value : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nilai RKAP</th>
    <td>{{ isset($pp->rkap) ? $pp->rkap : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal</th>
    <td>{{ isset($pp->date) ? Carbon\Carbon::parse($pp->date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tahun</th>
    <td>{{ isset($pp->year) ? $pp->year : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($pp->stats == 1)
        <span class="badge badge-success">{{ 'Aktif' }}</span>
      @elseif($pp->stats == 2)
        <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{!! isset($pp->description) ? $pp->description : 'N/A' !!}</td>
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
      url: "{{ route('backsite.pp.show_file') }}",
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
