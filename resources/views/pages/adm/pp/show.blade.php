<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $pp->id }}">
  <tr>
    <th>No PR</th>
    <td>{{ isset($pp->no_pp) ? $pp->no_pp : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Nama Pekerjaan</th>
    <td>{{ isset($pp->job_name) ? $pp->job_name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nilai PR</th>
    <td>Rp. {{ isset($pp->job_value) ? $pp->job_value : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nilai OP/Kontrak</th>
    <td>Rp. {{ isset($pp->contract_value) ? $pp->contract_value : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nilai RKAP</th>
    <td>Rp. {{ isset($pp->rkap) ? $pp->rkap : 'N/A' }}</td>
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
    <th>Tipe Tagihan</th>
    <td>
      @if ($pp->type_bill == 'LUMPSUM')
        <span class="badge badge-info">{{ 'Lumpsum' }}</span>
      @elseif($pp->type_bill == 'RUTIN')
        <span class="badge badge-secondary">{{ 'Rutin' }}</span>
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
<div class="col-md-4">
  <button type="button" id="button_file" class="btn btn-cyan btn-sm ml-1 my-1" title="Tambah File"
    onclick="upload('{{ $pp->id }}')"><i class="bx bx-file"></i>
    Tambah File</button>
</div>

<table class="table table-bordered tampildata" style="word-break: break-all">
</table>

<div class="col-md-4">
  <button type="button" id="button_file" class="btn btn-cyan btn-sm ml-1 my-1" title="Tambah File"
    onclick="add_status('{{ $pp->id }}')"><i class="bx bx-file"></i>
    Tambah Status</button>
</div>
<table class="table table-bordered tampilstatus" style="word-break: break-all">
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

  function tampilDataStatus() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let id = $('#id').val();
    $.ajax({
      type: "post",
      url: "{{ route('backsite.pp.show_status') }}",
      data: {
        id: id
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampilstatus').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  $(document).ready(function() {
    tampilDataStatus();
  });
</script>
