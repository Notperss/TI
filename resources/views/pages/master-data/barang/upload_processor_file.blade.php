<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" action="{{ route('backsite.barang.upload_processor') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">Processor
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <select name="processor_id" id="processor_id" class="form-control select2" style="width: 100%">
                  <option value="" selected disabled>Choose</option>
                  @foreach ($processors as $processor)
                    <option value="{{ $processor->id }}" data-value="{{ $processor->name }}">
                      {{ $processor->description }}</option>
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
            <label class="col-md-4 label-control" for="merk">Merk
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="text" class="form-control" id="merk" readonly>
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
  $('#processor_id').on('change', function() {
    var input_value = $(this).find(':selected').data('value');;
    $('#merk').val(input_value);
  });
</script>
