<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" action="{{ route('backsite.distribution.store_ip') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="{{ $id }}">
          <div class="form-group row">
            <div class="col-md-4 label-control">IP</div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="ip" id="">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 label-control">Akses Internet</div>
            <div class="col-md-8">
              <select class="form-control select21" style="width:100%" name="internet_access" id="">
                <option value="" disabled selected>Choose</option>
                <option value="1">Ada Internet</option>
                <option value="2">Tidak ada Internet</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4 label-control">Gateway</div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="gateway" id="">
            </div>
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
    $('.select21').select2();
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
