<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // When the division dropdown changes
    $('#division_id').change(function() {
      // Get the selected option's data-value attribute
      var divisionName = $('option:selected', this).data('value');

      // Set the value of the input text field to the division name
      $('#name').val(divisionName);
      $('#job_position').val(divisionName);
      $('#nip').val(divisionName);
    });
  });
</script>

<div class="card-body card-dashboard">
  <form class="form form-horizontal" action="{{ route('backsite.employee.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-body">
      <div class="form-section">
        <p>Isi input <code>required (*)</code>, Sebelum menekan tombol submit. </p>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="nip">NIK <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input type="text" id="nip" name="nip" class="form-control"
            placeholder="example John Doe or Jane" autocomplete="off">

          @if ($errors->has('nip'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('nip') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="name">Nama <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input type="text" id="name" name="name" class="form-control"
            placeholder="example John Doe or Jane" autocomplete="off">

          @if ($errors->has('name'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('name') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="job_position">Jabatan <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input type="text" id="job_position" name="job_position" class="form-control" value="-"
            placeholder="example John Doe or Jane" autocomplete="off">

          @if ($errors->has('job_position'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('job_position') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="division_id">Divisi <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <select name="division_id" id="division_id" class="form-control select2">
            <option value="{{ '' }}" disabled selected>
              Choose
            </option>
            @foreach ($division as $key => $division_item)
              <option value="{{ $division_item->id }}" data-value="{{ $division_item->name }}">
                {{ $division_item->name }}</option>
            @endforeach
          </select>

          @if ($errors->has('division_id'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('division_id') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="department_id">Departemen
          <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input name="department_id" id="department_id" class="form-control" value="0">
          @if ($errors->has('department_id'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('department_id') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="section_id">Seksi
          <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input name="section_id" id="section_id" class="form-control" value="0">
          @if ($errors->has('section_id'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('section_id') }}</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 label-control" for="company">Perusahaan <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input type="text" id="company" name="company" class="form-control"
            placeholder="example John Doe or Jane" value="-" autocomplete="off">

          @if ($errors->has('company'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('company') }}</p>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 label-control" for="type_user">Tipe User
          <code style="color:red;">*</code></label>
        <div class="col-md-9 mx-auto">
          <input type="text" id="type_user" name="type_user" class="form-control" value='2'>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 label-control" for="status">Status <code style="color:red;">*</code></label>

        <div class="col-md-9 mx-auto">
          <select name="status" id="status" class="form-control select2">
            <option value="{{ '' }}" disabled selected>
              Choose
            </option>
            <option value="1">Aktif</option>
            <option value="2">Tidak Aktif</option>
          </select>

          @if ($errors->has('status'))
            <p style="font-style: bold; color: red;">
              {{ $errors->first('status') }}</p>
          @endif
        </div>
      </div>

    </div>
    <div class="form-actions text-right">
      <button type="submit" style="width:120px;" class="btn btn-cyan"
        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
        <i class="la la-check-square-o"></i> Submit
      </button>
    </div>
  </form>
</div>
{{-- 
<script>
  $(document).ready(function() {
    // When the division dropdown changes
    $('#division_id').change(function() {
      // Get the selected option's data-value attribute
      var divisionName = $('option:selected', this).data('value');

      // Set the value of the input text field to the division name
      $('#name').val(divisionName);
    });
  });
</script> --}}
