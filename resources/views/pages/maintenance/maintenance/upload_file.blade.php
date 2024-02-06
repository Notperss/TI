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
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form" action="{{ route('backsite.maintenance.add_status') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">

          <div class="form-group row">
            <label class="col-md-4 label-control" for="users_id">yang Menerima<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <select type="text" id="users_id" name="users_id" class="form-control select2" style="width: 100%"
                required>
                <option value="" disabled selected>Choose</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}" {{ $user->id == auth()->id() ? 'selected' : '' }}>
                    {{ $user->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('users_id'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('users_id') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 label-control" for="report_status">Status Gangguan</label>
            <div class="col-md-8 mx-auto">
              <select type="text" id="report_status" name="report_status" class="form-control select2"
                style="width: 100%">
                <option value="" selected disabled>Choose</option>
                <option value="1">Open</option>
                <option value="2">Penanganan</option>
                <option value="3">Penanganan Lanjutan</option>
                <option value="4">Form LK</option>
                <option value="5">Perbaikan Vendor</option>
                <option value="6">Menyerahkan Barang ke Vendor</option>
                <option value="7">Menerima Barang dari Vendor</option>
                <option value="8">BA</option>
                <option value="9">Selesai</option>
                <option value="10">Tidak Selesai - Rusak</option>
              </select>
              @if ($errors->has('report_status'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('report_status') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 label-control" for="date">Tanggal<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="date" id="date" name="date" class="form-control" placeholder=""
                value="{{ old('date') }}" autocomplete="off" autofocus required>
              @if ($errors->has('date'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('date') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row ">
            <label class="col-md-4 label-control" for="description">Keterangan <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
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
            <i class="la la-check-square-o"></i> Simpan
          </button>
        </div>
      </form>


    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
{{-- 1 = Open
                2 = Penanganan
                3 = Penanganan Lanjutan
                4 = Form LK
                5 = Perbaikan Vendor
                6 = Menyerahkan Barang ke Vendor
                7 = Menerima Barang dari Vendor
                8 = BA
                9 = Selesai
                10 = Tidak Selesai - Rusak --}}
