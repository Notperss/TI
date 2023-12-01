<script>
  $('#application_id').on('change', function() {
    var input_value = $(this).find(':selected').data('value');;
    $('#date_start').val(input_value);
    var input_value = $(this).find(':selected').data('value2');;
    $('#description').val(input_value);
    var input_value = $(this).find(':selected').data('value3');;
    $('#stats').val(input_value);
  });
</script>
<form class="form" action="{{ route('backsite.application-monitoring.store') }}" method="POST"
  enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <div class="form-group row">
      <label class="col-md-4 label-control" for="application_id">Nama Barang<code style="color:red;">*</code></label>
      <div class="col-md-8">
        <select name="application_id" id="application_id" class="form-control select2" style="width: 100%" required>
          <option value="" disabled selected>Choose</option>
          @foreach ($apps as $application)
            <option value="{{ $application->id }}"
              data-value="{{ Carbon\Carbon::parse($application->date_start)->translatedFormat('l, d F Y') }}"
              data-value2="{{ $application->description }}"
              data-value3="{{ $application->stats == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}">
              {{ $application->name_app }}</option>
          @endforeach
        </select>
      </div>
      @if ($errors->has('application_id'))
        <p style="font-style: bold; color: red;">
          {{ $errors->first('application_id') }}</p>
      @endif
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Tanggal</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="date_start" disabled>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Catatan</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="description" disabled>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 label-control">Status</div>
      <div class="col-md-8">
        <input type="text" class="form-control" id="stats" disabled>
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
<script>
  $(document).ready(function() {
    $('.select2').select2();
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
