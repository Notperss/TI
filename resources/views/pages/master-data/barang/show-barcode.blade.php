<div class="container" id='DivIdToPrint'>
  <div class="row justify-content-center">
    {{-- {{ $qr }} --}}
    <div class="col-md-12 text-left">

      <table class="table table-bordered ">
        <tr>
          <th rowspan="5" class="text-center" style="margin-bottom: -10%">{{ $qr }}</th>
        </tr>
        <tr>
          <td class="" style="font-size: 150%"> {{ isset($barang->barcode) ? $barang->barcode : 'N/A' }}</td>
        </tr>
        <tr>
          <td class="" style="font-size: 150%"> {{ isset($barang->name) ? $barang->name : 'N/A' }}</td>
        </tr>
        <tr>
          <td class="" style="font-size: 150%"> {{ isset($barang->category) ? $barang->category : 'N/A' }}
          </td>
        </tr>
        <tr>
          {{-- <th>Tahun</th> --}}
          <td class="" style="font-size: 150%"> {{ isset($barang->year) ? $barang->year : 'N/A' }}</td>
        </tr>
      </table>

    </div>
  </div>
</div>
<div class="row justify-content-center">
  <button class="btn btn-info text-center" value='Print' onclick='printDiv();'>Print</button>
</div>
<script>
  function printDiv() {

    var divToPrint = document.getElementById('DivIdToPrint');

    var newWin = window.open('', 'Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

    newWin.document.close();

    setTimeout(function() {
      newWin.close();
    }, 10);

  }
</script>
