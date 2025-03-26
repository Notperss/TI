<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileModalLabel">Upload File Gambar</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
      <div class="modal-body">
        <form id="fileUploadForm" action="{{ route('backsite.inspection.uploadFile') }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="asset_id" id="modalAssetId">
          <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
          <div class="mb-3">
            <label for="fileInput" class="form-label">Pilih File</label>
            <input type="file" name="file" class="form-control" id="fileInput" accept="image/*">
          </div>
          <a class="btn btn-primary  text-white" onclick="submitFormUpload()">Simpan</a>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function submitFormUpload() {
    // Contoh validasi sederhana
    if (confirm('Yakin mau simpan data ini?')) {
      document.getElementById('fileUploadForm').submit();
    }
  }
</script>

{{-- <script>
  $('#fileModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var assetId = button.data('asset-id');
    var modal = $(this);
    modal.find('#modalAssetId').val(assetId);
  });

  $('#fileUploadForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: '{{ route('backsite.inspection.uploadFile') }}',
      type: 'POST',
      data: formData,
      success: function(data) {
        if (data.success) {
          alert('File berhasil diupload');
          $('#fileModal').modal('hide');
        } else {
          alert('File gagal diupload');
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }); --}}
