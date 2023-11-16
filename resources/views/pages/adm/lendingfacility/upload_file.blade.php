<script>
  $('#goods_id').on('change', function() {
    var input_value = $(this).find(':selected').data('value');;
    $('#category').val(input_value);
    var input_value = $(this).find(':selected').data('value2');;
    $('#barcode').val(input_value);
    var imgSrc = $(this).find(':selected').data('value3');
    $('#file').val(imgSrc);
    $('#img').attr('src', imgSrc);
  });
</script>

<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <form class="form" action="{{ route('backsite.lendingfacility.upload') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <label class="col-md-4 label-control" for="goods_id">Nama Barang<code style="color:red;">*</code></label>
            <div class="col-md-8">
              <select name="goods_id" id="goods_id" class="form-control select2" style="width: 100%" required>
                <option value="" disabled selected>Choose</option>
                @foreach ($barang as $goods)
                  <option value="{{ $goods->id }}" data-value="{{ $goods->category }}"
                    data-value2="{{ $goods->barcode }}" data-value3="{{ asset('storage/' . $goods->file) }}">
                    {{ $goods->name }}</option>
                @endforeach
              </select>
            </div>
            @if ($errors->has('goods_id'))
              <p style="font-style: bold; color: red;">
                {{ $errors->first('goods_id') }}</p>
            @endif
          </div>
          <div class="form-group row">
            <div class="col-md-4 label-control">Category</div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="category" disabled>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 label-control">Barcode</div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="barcode" disabled>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 label-control">File</div>
            <div class="col-md-8">
              <img id="img" alt="No Picture" style="width: 75%">
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
