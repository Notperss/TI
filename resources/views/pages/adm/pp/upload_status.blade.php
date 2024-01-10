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
      <form class="form" action="{{ route('backsite.pp.add_status') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="type_status">Tipe Status<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <select name="type_status" id="type_status" class="form-control select2" style="width: 100%" required>
                <option value="{{ '' }}" disabled selected>
                  Choose
                </option>
                <option value="1">Kirim Dokumen PP ke Divisi SIMA</option>
                <option value="2">Ambil Dokumen PP dari Divisi SIMA</option>
                <option value="3">Kirim Dokumen ke Divisi Teknik</option>
                <option value="4">Undangan aawijing</option>
                <option value="5">Undangan Rapat Negosiasi</option>
                <option value="6">Penginformasian Pemenang OP/KONTRAK</option>
                <option value="7">Mulai Pekerjaan (SPMK)</option>
                <option value="8">Akhir Pekerjaan (BA)</option>
                <option value="9">Penerimaan Barang</option>
                <option value="10">Tagihan</option>
                <option value="11">Dikembalikan ke User</option>
                <option value="12">Dibatalkan (Closed)</option>
                <option value="13">Pembuatan</option>
              </select>

              @if ($errors->has('type_status'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('type_status') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 label-control" for="date">Tanggal<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"
                required>
              </select>
              @if ($errors->has('date'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('date') }}</p>
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
          {{-- <div class="form-group row">
            <label class="col-md-4 label-control" for="file">File
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file[]" onchange="updateList()">
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
          </div> --}}
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
      width: 800px;
      margin: 30px auto;
    }
  }
</style>
