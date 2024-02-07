<div style="display: flex;">
  <table class="table table-bordered" style="width: 100%;">
    <input type="hidden" name="id" id="id" value="{{ $maintenance->id }}">
    <tr>
      <th>Nomor Laporan</th>
      <td>{{ isset($maintenance->report_number) ? $maintenance->report_number : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Pelapor</th>
      <td>{{ isset($maintenance->employee->name) ? $maintenance->employee->name : 'N/A' }}</td>
    </tr>
    <tr>
      <th>User Asset</th>
      <td>
        ({{ isset($maintenance->barcode) ? $maintenance->barcode : 'N/A' }})
        {{ isset($maintenance->asset_name) ? $maintenance->asset_name : 'N/A' }}
      </td>
    </tr>
    <tr>
      <th>Tipe gangguan</th>
      <td>{{ isset($maintenance->type_malfunction) ? $maintenance->type_malfunction : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Yang Menerima</th>
      <td>{{ isset($maintenance->reporter) ? $maintenance->reporter : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Tanggal Laporan</th>
      <td>{{ isset($maintenance->date) ? $maintenance->date : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>
        @if ($maintenance->stats == '')
          <span>N/A</span>';
        @elseif ($maintenance->stats == '2')
          <h5><span class="badge bg-danger">Closed</span></h5>
        @elseif ($maintenance->stats == '1')
          <h5><span class="badge bg-info">Open</span></h5>
        @else
          <h5><span> - </span></h5>
        @endif
      </td>
    </tr>
    <tr>
      <th>Keterangan</th>
      <td>{{ isset($maintenance->description) ? $maintenance->description : 'N/A' }}</td>
    </tr>
    <tr>
      <th>File</th>
      @if ($maintenance->file)
        <td>
          <img src="{{ asset('storage/' . $maintenance->file) }}" class="block mb-1" style="width: 35%" alt="">
          <a type="button" data-fancybox data-src="{{ asset('storage/' . $maintenance->file) }}"
            class="btn btn-info btn-sm text-white">
            Lihat
          </a>
          <a type="button" href="{{ asset('storage/' . $maintenance->file) }}"
            class="btn btn-warning btn-sm text-white" download>
            Unduh
          </a>
          <br>
          <p class="mt-1">Latest File : {{ pathinfo($maintenance->file, PATHINFO_FILENAME) }}</p>
        @else
        <td> N/A</td>
      @endif
      </td>
    </tr>
  </table>
</div>

<div class="table-responsive">
  <table class="table table-bordered tampildata">
  </table>
</div>
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
      url: "{{ route('backsite.maintenance.show_status') }}",
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
