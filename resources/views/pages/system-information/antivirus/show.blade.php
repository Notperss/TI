<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $antivirus->id }}">
  <tr>
    <th>Nama Antivirus</th>
    <td>{{ isset($antivirus->name_antivirus) ? $antivirus->name_antivirus : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tahun</th>
    <td>{{ isset($antivirus->year) ? $antivirus->year : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Jumlah Lisensi</th>
    <td>{{ isset($antivirus->num_of_licenses) ? $antivirus->num_of_licenses : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ isset($antivirus->date_start) ? Carbon\Carbon::parse($antivirus->date_start)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ isset($antivirus->date_finish) ? Carbon\Carbon::parse($antivirus->date_finish)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($antivirus->description) ? $antivirus->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>
      @if ($antivirus->stats == '')
        <span>N/A</span>';
      @elseif ($antivirus->stats == '2')
        <h5><span class="badge bg-danger">Tidak Aktif</span></h5>
      @elseif ($antivirus->stats == '1')
        <h5><span class="badge bg-info">Aktif</span></h5>
      @else
        <h5><span> - </span></h5>
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
      url: "{{ route('backsite.antivirus.show_file') }}",
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
