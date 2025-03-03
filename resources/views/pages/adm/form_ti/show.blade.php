<table class="table table-bordered">
  <input type="hidden" name="id" id="id" value="{{ $form_ti->id }}">
  <tr>
    <th>Tipe Form</th>
    <td>{{ isset($form_ti->type_form) ? $form_ti->type_form : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Pengirim</th>
    <td>{{ isset($form_ti->sender) ? $form_ti->sender : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tanggal Form</th>
    <td>
      {{ isset($form_ti->date_form) ? Carbon\Carbon::parse($form_ti->date_form)->translatedFormat('l, d F Y') : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Keterangan</th>
    <td>{{ isset($form_ti->description) ? $form_ti->description : 'N/A' }}</td>
  </tr>
  <tr>
    <th>File</th>
    <td>
      @if ($form_ti->file)
        <a type="button" data-fancybox data-src="{{ asset('storage/' . $form_ti->file) }}"
          class="btn btn-info btn-sm text-white ">
          Lihat
        </a>

        <a type="button" href="{{ asset('storage/' . $form_ti->file) }}" class="btn btn-warning btn-sm text-white "
          download>Unduh</a>
        <br>

        <p class="mt-1">Latest File : {{ pathinfo($form_ti->file, PATHINFO_FILENAME) }}</p>
      @else
        <p>File not found!</p>
      @endif
    </td>
  </tr>
</table>
<table class="table table-bordered tampildata" style="word-break: break-all">
</table>
