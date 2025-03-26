<!-- Modal for Indicator Asset -->
<div class="modal fade" id="indicatorModal" tabindex="-1" aria-labelledby="indicatorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="indicatorModalLabel">Input Indicator Asset</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
      <div class="modal-body">
        <form id="indicatorForm" class="form form-horizontal"
          action="{{ route('backsite.inspection.indicator.store') }}" method="POST" enctype="multipart/form-data">

          @csrf

          <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
          <input type="hidden" id="indicatorAssetId" name="asset_id">
          <button type="button" class="btn btn-danger btn-delete-all-indicator mb-2">Hapus Data</button>
          <div class="table-responsive">
            <div id="indicatorList" class="mb-3">
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a class="btn btn-primary btn-save-indicator text-white" onclick="submitForm()">Simpan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function submitForm() {
    // Contoh validasi sederhana
    if (confirm('Yakin mau simpan data ini?')) {
      document.getElementById('indicatorForm').submit();
    }
  }
</script>
