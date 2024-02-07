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
        <h5 class="modal-title" id="exampleModalLabel">Analisis Gangguan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form" action="{{ route('backsite.maintenance.update', $id) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-body">
          {{-- <input type="hidden" name="id" id="id" value="{{ $id }}"> --}}

          <div class="form-group row">
            <label class="col-md-4 label-control" for="users_id">Yang Menerima<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <input type="text" class="form-control" value="{{ $maintenance->reporter }}" readonly>
              @if ($errors->has('users_id'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('users_id') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 label-control" for="type_malfunction">Tipe Gangguan<code
                style="color:red;">*</code></label>
            <div class="col-md-8 ">
              <select type="text" id="type_malfunction" name="type_malfunction" class="form-control" required>
                <option value="" selected disabled>Choose</option>
                <option value="HARDWARE"{{ $maintenance->type_malfunction == 'HARDWARE' ? 'selected' : '' }}>
                  Hardware</option>
                <option value="SOFTWARE"{{ $maintenance->type_malfunction == 'SOFTWARE' ? 'selected' : '' }}>
                  Software</option>
                <option value="JARINGAN"{{ $maintenance->type_malfunction == 'JARINGAN' ? 'selected' : '' }}>
                  Jaringan</option>
                <option value="LAIN-LAIN"{{ $maintenance->type_malfunction == 'LAIN-LAIN' ? 'selected' : '' }}>
                  Lain-lain</option>
              </select>
              @if ($errors->has('type_malfunction'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('type_malfunction') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 label-control second-part" for="barcode">Asset User<code
                style="color:red;">*</code></label>
            <div class="col-md-8 second-part">
              <select type="text" id="barcode" name="barcode" class="form-control select2" style="width: 100%"
                required>
                <option value="" selected disabled>Choose</option>
                @foreach ($barang as $asset)
                  <option value="{{ $asset->barcode }}"
                    data-value="{{ $asset->name }}"{{ $asset->barcode == $maintenance->barcode ? 'selected' : '' }}>
                    {{ $asset->barcode }}</option>
                @endforeach
              </select>
              @if ($errors->has('barcode'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('barcode') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row ">
            <label class="col-md-4 label-control" for="asset_name">Nama Asset</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="nama_asset" name="asset_name" readonly>
              @if ($errors->has('asset_name'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('asset_name') }}</p>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 label-control" for="file">File
              <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file" onchange="updateList()">
                <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                  File</label>
                @if ($maintenance->file)
                  <p class="mt-1">Latest File : {{ pathinfo($maintenance->file, PATHINFO_FILENAME) }}</p>
                  <a type="button" data-fancybox data-src="{{ asset('storage/' . $maintenance->file) }}"
                    class="btn btn-info btn-sm text-white ">
                    Lihat
                  </a>
                  <a type="button" href="{{ asset('storage/' . $maintenance->file) }}" class="btn btn-warning btn-sm"
                    download>
                    Unduh
                  </a>
                @else
                  <p class="mt-1">Latest File : File not found!</p>
                @endif
                <div id="fileList" style="word-break: break-all"></div>
              </div>
            </div>
          </div>

          <div class="form-group row ">
            <label class="col-md-4 label-control" for="description">Keterangan <code style="color:red;">*</code></label>
            <div class="col-md-8">
              <textarea class="form-control" id="description" name="description" rows="5" required>{{ $maintenance->description }}</textarea>
              @if ($errors->has('description'))
                <p style="font-style: bold; color: red;">
                  {{ $errors->first('description') }}</p>
              @endif
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

  $(document).ready(function() {
    // Set initial value on page load
    var initialSelectedValue = $('#barcode :selected').data('value');
    $('#nama_asset').val(initialSelectedValue);

    // Handle change event
    $('#barcode').on('change', function() {
      var input_value = $(this).find(':selected').data('value');
      $('#nama_asset').val(input_value);
    });
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
