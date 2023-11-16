<script>
  updateList = function() {
    var input = document.getElementById('file');
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
      children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<ul>' + children + '</ul>';
  }
</script>
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File PP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" action="{{ route('backsite.bill.store_bill') }}" method="POST"
        enctype="multipart/form-data">

        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="bill_to">Tagihan Ke <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="text" id="bill_to" name="bill_to" class="form-control" value="{{ old('bill_to') }}"
                required>
              @if ($errors->has('bill_to'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('bill_to') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="date">Tanggal<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}"
                required>
              @if ($errors->has('date'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('date') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="bill_value">Nilai Tagihan<code
                style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="text" id="bill_value" name="bill_value" class="form-control"
                value="{{ old('bill_value') }}" required>
              @if ($errors->has('bill_value'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('bill_value') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="description">Keterangan<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
              @if ($errors->has('description'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('description') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">File
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file[]" onchange="updateList()"
                  required>
                <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                  File</label>
              </div>
              @if ($errors->has('file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('file') }}</p>
              @endif
            </div>
            <p class="col-md-4">Selected File :</p>
            <div id="fileList" style="word-break: break-all"></div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{ url()->previous() }}" style="width:120px;" class="btn btn-warning mr-5" href>
            <i class="la la-close"></i> Cancel
          </a>

          <button type="submit" style="width:120px;" class="btn btn-cyan"
            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
            <i class="la la-check-square-o"></i> Upload
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
