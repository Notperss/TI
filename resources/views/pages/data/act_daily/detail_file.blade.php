@forelse ($datafile as $file)
  <tr>
    <th>File</th>
    <td style="text-align:center;">
      {{ pathinfo($file->file, PATHINFO_FILENAME) }}
    </td>
    <td style="text-align:center;">
      <div class="form-group ">
        <div class="btn-group btn-group-sm" role="group">

          <a type="button" data-fancybox="gallery" data-src="{{ asset('storage/' . $file->file) }}"
            class="btn btn-info text-nowrap text-white ">Show</a>

          <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn btn-primary text-nowrap"
            download>Download</a>

          <form action="{{ route('backsite.act_daily.hapus_file', $file->id) }}" method="POST"
            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn-sm btn-danger border-transparent"
              style="border-bottom-left-radius: 0%; border-top-left-radius: 0%;" value="Delete">
          </form>
        </div>
      </div>
    </td>
  </tr>
@empty
  <tr>
    <th>File</th>
    <td style="text-align:center;">
      <span>No data available</span>
    </td>
  </tr>
@endforelse
