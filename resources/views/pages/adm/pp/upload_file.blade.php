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
      <form class="form" action="{{ route('backsite.pp.upload') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="type_file">Tipe File<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <select name="type_file" id="type_file" class="form-control select2" required>
                <option value="{{ '' }}" disabled selected>
                  Choose
                </option>
                <option value="MEMO">Memo</option>
                <option value="PENAWARAN KONTRAK">Penawaran Kontrak</option>
                <option value="ADDENDUM">Addendum</option>
                <option value="LAIN-LAIN">Lain-lain</option>
              </select>

              @if ($errors->has('type_file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('type_file') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="name_file">Nama File<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="text" id="name_file" name="name_file" class="form-control" value="{{ old('name_file') }}"
                required>
              @if ($errors->has('name_file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('name_file') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="description_file">Keterangan<code
                style="color:red;">*</code></label>
            <div class="col-md-8">
              <textarea rows="5" class="form-control" id="description_file" name="description_file" required>{{ old('description_file') }}</textarea>
              @if ($errors->has('description_file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('description_file') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">File
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file[]" multiple="multiple"
                  onchange="updateList()" required>
                <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                  File</label>
              </div>

              <p class="text-muted"><small class="text-danger">Dapat
                  mengunggah lebih dari 1 file</small></p>

              @if ($errors->has('file'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('file') }}</p>
              @endif
            </div>
            <p class="col-md-4">Selected File :</p>
            <div id="fileList" style="word-break: break-all"></div>
            {{-- <input type="file" multiple name="file" id="file"
onchange="javascript:updateList()" />

  <p>Selected files:</p>

  <div id="fileList"></div> --}}
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{ url()->previous() }}" style="width:120px;" class="btn btn-success float-left" href>
            <i class="la la-check-square-o"></i> Cancel
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
