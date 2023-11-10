<table class="table table-bordered">
  <tr>
    <th>No Permintaan</th>
    <td>{{ isset($demand->no_demand) ? $demand->no_demand : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tipe Permintaan</th>
    <td>
      @if ($demand->type_demand == '')
        <span>N/A</span>';
      @elseif ($demand->type_demand == 'PETYCASH')
        <h5><span class="badge bg-primary">Petycash</span></h5>
      @elseif ($demand->type_demand == 'REIMBURSE')
        <h5><span class="badge bg-info">Reimburse</span></h5>
      @else
      @endif
    </td>
  </tr>
  <tr>
    <th>Tanggal Permintaan</th>
    <td>
      {{ $demand->date_demand ? Carbon\Carbon::parse($demand->date_demand)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Nominal</th>
    <td>{{ isset($demand->nominal) ? $demand->nominal : 'N/A' }}</td>
  </tr>
  <tr>
    <th>keterangan</th>
    <td style="word-break: break-all">{{ isset($demand->description) ? $demand->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($demand->file)
      <td> <a type="button" data-fancybox data-src="{{ asset('storage/' . $demand->file) }}"
          class="btn btn-primary btn-sm text-white">
          Lihat
        </a>
        <a type="button" href="{{ asset('storage/' . $demand->file) }}" class="btn btn-warning btn-sm" download>
          Unduh
        </a>
        <br>
        File Name: {{ pathinfo($demand->file, PATHINFO_FILENAME) }}
      </td>
    @else
      <td> No File!</td>
    @endif
    </td>
  </tr>
  <tr>
    <th>Penanggung Jawab</th>
    <td>{{ isset($demand->accountability) ? $demand->accountability : 'N/A' }}</td>

  </tr>
  <tr>
    <th>Tanggal PJ</th>
    <td>
      {{ $demand->date_pj ? Carbon\Carbon::parse($demand->date_pj)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Nominal PJ</th>
    <td> {{ isset($demand->nominal_pj) ? $demand->nominal_pj : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    @if ($demand->file_pj)
      <td> <a type="button" data-fancybox data-src="{{ asset('storage/' . $demand->file_pj) }}"
          class="btn btn-primary btn-sm text-white">
          Lihat
        </a>
        <a type="button" href="{{ asset('storage/' . $demand->file_pj) }}" class="btn btn-warning btn-sm" download>
          Unduh
        </a>
        <br>
        File Name : {{ pathinfo($demand->file_pj, PATHINFO_FILENAME) }}
      </td>
    @else
      <td> No File!</td>
    @endif
    </td>
  </tr>
</table>
