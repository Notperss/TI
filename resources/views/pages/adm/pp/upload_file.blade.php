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

<div class="modal fade" id="upload" tabindex="-1" style="z-index: 1051;" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      <form class="form" action="{{ route('backsite.pp.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="type_file">Tipe File<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <select name="type_file" id="type_file" class="form-control select2" style="width: 100%" required>
                <option value="{{ '' }}" disabled selected>
                  Choose
                </option>
                <option value="1">KAK</option>
                <option value="2">Engineering Estimate</option>
                <option value="3">Form PP</option>
                <option value="4">Form Cashmen</option>
                <option value="5">Memo PL</option>
                <option value="6">Memo</option>
                <option value="7">Penawaran</option>
                <option value="8">Risalah Rapat</option>
                <option value="9">OP (Offering Price)</option>
                <option value="10">Kontrak</option>
                <option value="11">Addendum</option>
                <option value="12">BA Terima Barang</option>
                <option value="13">Lain-lain (Others)</option>
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
