<!-- Modal for Testing Asset -->
<div class="modal fade" id="testingModal" tabindex="-1" aria-labelledby="testingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="testingModalLabel">Input Testing Asset</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
      <div class="modal-body">
        <form id="testingForm" class="form form-horizontal" action="{{ route('backsite.inspection.testing.store') }}"
          method="POST" enctype="multipart/form-data">

          @csrf

          <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
          <input type="hidden" id="testingAssetId" name="asset_id">
          <div class="table-responsive">
            <div id="testingList" class="mb-2">
            </div>

          </div>

          <h5 class="text-center mt-2 mb-2">Hasil Testing Sebelumnya</h5>
          <button type="button" class="btn btn-danger btn-delete-all-testing mb-2">Hapus Data</button>
          <div id="resultList" class="table-responsive">
            <div class="text-center text-muted">Belum ada hasil tes...</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a class="btn btn-primary btn-save-testing text-white" onclick="submitFormTesting()">Simpan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function submitFormTesting() {
    // Contoh validasi sederhana
    if (confirm('Yakin mau simpan data ini?')) {
      document.getElementById('testingForm').submit();
    }
  }
</script>
