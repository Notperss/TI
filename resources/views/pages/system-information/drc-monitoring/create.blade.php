<form class="form" action="{{ route('backsite.drc-monitoring.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <div class="form-group row">
      <label class="col-md-4 label-control" for="drc_id">Nama Barang<code style="color:red;">*</code></label>
      <div class="col-md-8">
        <select name="drc_id" id="drc_id" class="form-control select2" style="width: 100%" required>
          <option value="" disabled selected>Choose</option>
          @foreach ($drcs as $drc)
            <option value="{{ $drc->id }}" data-value="{{ $drc->category }}" data-value4="{{ $drc->description }}"
              data-value3="{{ $drc->created_at }}" data-value2="{{ $drc->backup_time }}">
              {{ $drc->name }}</option>
          @endforeach
        </select>
      </div>
      @if ($errors->has('drc_id'))
        <p style="font-style: bold; color: red;">
          {{ $errors->first('drc_id') }}</p>
      @endif
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Category</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="category" disabled>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Jam Backup</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="backup_time" disabled>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Tanggal</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="created_at" disabled>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Catatan</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="description" disabled>
      </div>
    </div>
  </div>
  <div class="modal-footer ">
    <a href="{{ url()->previous() }}" style="width:120px;" class="btn btn-warning mr-5" href>
      <i class="la la-close"></i> Cancel
    </a>
    <button type="submit" id="submit" style="width:120px;" class="btn btn-cyan"
      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
      <i class="la la-check-square-o"></i> Simpan
    </button>
  </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });

  $('#drc_id').on('change', function() {
    var input_value = $(this).find(':selected').data('value');;
    $('#category').val(input_value);
    var input_value = $(this).find(':selected').data('value2');;
    $('#backup_time').val(input_value);
    var input_value = $(this).find(':selected').data('value3');;
    $('#created_at').val(input_value);
    var input_value = $(this).find(':selected').data('value4');;
    $('#description').val(input_value);
  });
</script>
<style>
  @media (min-width: 768px) {

    .modal {
      text-align: center;
      padding: 0 !important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
      width: 600px;
      margin: 30px auto;
    }
  }
</style>
