<table class="table table-bordered">
  <tr>
    <th>Nomor Surat</th>
    <td>{{ isset($letter->no_letter) ? $letter->no_letter : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tipe Surat</th>
    <td>
      @if ($letter->type_letter == '')
        <span>N/A</span>';
      @elseif ($letter->type_letter == 'SURAT KELUAR')
        <h5><span class="badge bg-warning">Surat Keluar</span></h5>
      @elseif ($letter->type_letter == 'MEMO OUT')
        <h5><span class="badge bg-warning">Memo Out</span></h5>
      @elseif ($letter->type_letter == 'SURAT MASUK')
        <h5><span class="badge bg-primary">Surat Masuk</span></h5>
      @elseif ($letter->type_letter == 'MEMO IN')
        <h5><span class="badge bg-primary">Memo In</span></h5>
      @elseif ($letter->type_letter == 'MEMO')
        <h5><span class="badge bg-info">Memo</span></h5>
      @elseif ($letter->type_letter == 'LAIN-LAIN')
        <h5><span class="badge bg-secondary">Lain-lain</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Tanggal Surat</th>
    <td>
      {{ $letter->date_letter ? Carbon\Carbon::parse($letter->date_letter)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Kirim</th>
    <td>
      {{ $letter->date_sent ? Carbon\Carbon::parse($letter->date_sent)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Tanggal Terima</th>
    <td>
      {{ $letter->date_receipt ? Carbon\Carbon::parse($letter->date_receipt)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Penerima</th>
    <td>{{ isset($letter->recipient) ? $letter->recipient : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Pengirim</th>
    <td>{{ isset($letter->sender) ? $letter->sender : 'N/A' }}</td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">{{ isset($letter->description) ? $letter->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($letter->file)
      <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $letter->file) }}"
          class="btn btn-sm btn-blue text-white">
          Lihat
        </a>
        <br>

        <p class="mt-1">Latest File : {{ pathinfo($letter->file, PATHINFO_FILENAME) }}</p>
      @else
      <td> No File!</td>
    @endif
    </td>
    </td>
  </tr>
</table>
