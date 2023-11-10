<table class="table table-bordered">
  <tr>
    <th>Tanggal Diterima</th>
    <td>
      {{ $atk->date ? Carbon\Carbon::parse($atk->date)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($atk->description) ? $atk->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Pemakaian</th>
    <td style="word-break: break-all">{{ isset($atk->usage) ? $atk->usage : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($atk->file)
      <td> <a data-fancybox data-src="{{ asset('storage/' . $atk->file) }}" class="badge bg-blue text-white">
          Lihat
        </a>
        <br>
        File Name : {{ pathinfo($atk->file, PATHINFO_FILENAME) }}
      </td>
    @else
      <td> No File!</td>
    @endif
    </td>
    </td>
  </tr>
</table>
