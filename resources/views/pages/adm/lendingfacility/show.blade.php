<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $lendingfacility->id }}">
  <tr>
    <th>Peminjam</th>
    <td>{{ isset($lendingfacility->borrower) ? $lendingfacility->borrower : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Pinjam</th>
    <td>
      {{ isset($lendingfacility->date_lend) ? Carbon\Carbon::parse($lendingfacility->date_lend)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Kembali</th>
    <td>
      {{ isset($lendingfacility->date_return) ? Carbon\Carbon::parse($lendingfacility->date_return)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($lendingfacility->description) ? $lendingfacility->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Catatan</th>
    <td>{!! isset($lendingfacility->note) ? $lendingfacility->note : 'N/A' !!}</td>
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
      url: "{{ route('backsite.lendingfacility.show_file') }}",
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
