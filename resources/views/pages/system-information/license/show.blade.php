<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $license->id }}">
  <tr>
    <th>Nama Aplikasi</th>
    <td>{{ isset($license->name_app) ? $license->name_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tipe Aplikasi</th>
    <td>{{ isset($license->type_app) ? $license->type_app : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Product</th>
    <td>{{ isset($license->product) ? $license->product : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nama Produsen</th>
    <td>{{ isset($license->name_vendor) ? $license->name_vendor : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Versi</th>
    <td>{{ isset($license->version) ? $license->version : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Mulai</th>
    <td>
      {{ isset($license->date_start) ? Carbon\Carbon::parse($license->date_start)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Selesai</th>
    <td>
      {{ isset($license->date_finish) ? Carbon\Carbon::parse($license->date_finish)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>PP</th>
    <td>{{ isset($license->pp) ? $license->pp : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Barcode</th>
    <td>{{ isset($license->barcode) ? $license->barcode : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Jumlah Lisensi</th>
    <td>{{ isset($license->num_of_licenses) ? $license->num_of_licenses : 'N/A' }}</td>
  </tr>
  {{-- <tr>
    <th>Tipe Surat</th>
    <td>
      @if ($license->stats == '')
        <span>N/A</span>';
      @elseif ($license->stats == 'TIDAK AKTIF')
        <h5><span class="badge bg-danger">Tidak Aktif</span></h5>
      @elseif ($license->stats == 'AKTIF')
        <h5><span class="badge bg-info">Aktif</span></h5>
      @else
        <h5><span> - </span></h5>
      @endif
    </td> --}}
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
      url: "{{ route('backsite.license.show_file') }}",
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
