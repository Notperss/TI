<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" action="{{ route('backsite.barang.upload_hardisk') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">Hardisk
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <select name="hardisk_id" id="hardisk_id" class="form-control select2" style="width: 100%">
                  <option value="" selected disabled>Choose</option>
                  @foreach ($hardisks as $hardisk)
                    <option value="{{ $hardisk->id }}" data-value="{{ $hardisk->size }}"
                      data-value1="{{ $hardisk->description }}">{{ $hardisk->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              @if ($errors->has('file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('file') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">Ukuran
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="text" class="form-control" id="ukuran" readonly>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="keterangan">Keterangan
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <textarea type="text" class="form-control" id="keterangan" readonly></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{ url()->previous() }}" style="width:120px;" class="btn btn-warning mr-5" href>
            <i class="la la-close"></i> Cancel
          </a>

          <button type="submit" style="width:120px;" class="btn btn-cyan"
            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
            <i class="la la-check-square-o"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script>
  $('#hardisk_id').on('change', function() {
    var input_value = $(this).find(':selected').data('value');
    $('#ukuran').val(input_value);
    var input_value = $(this).find(':selected').data('value1');
    $('#keterangan').val(input_value);
  });
</script>
