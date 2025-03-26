<div class="modal fade" id="assetIndicatorModal{{ $asset->id }}" tabindex="-1"
  aria-labelledby="assetIndicatorModalLabel{{ $asset->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assetIndicatorModalLabel{{ $asset->id }}">Tambah Indicator Asset -
          {{ $asset->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Form Input Indicator -->
      <form id="indicatorForm" action="{{ route('backsite.inspection.indicator.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <input type="hidden" name="asset_id" value="{{ $asset->id }}">
          @foreach ($asset->hardwareCategory->hardwareIndicators as $indicator)
            <input type="hidden" name="indicator[{{ $indicator->id }}][name]" value="{{ $asset->id }}">
          @endforeach

          {{-- @foreach ($asset->hardwareCategory->hardwareIndicators as $indicator)
            <div class="row">
              <div class="form-group col-md-4">
                <label for="indicator_name">Indikator</label>
                <input type="text" name="indicator[{{ $indicator->id }}][name]" value="{{ $indicator->name }}">
              </div>

              <div class="form-group col-md-4">
                <label for="status">Kondisi</label>
                <select name="indicator[{{ $indicator->id }}][status]">
                  <option value="" disabled selected>Pilih</option>
                  <option value="baik">Baik</option>
                  <option value="rusak">Rusak</option>
                  <option value="nihil">Nihil</option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="description">Keterangan</label>
                <textarea name="indicator[{{ $indicator->id }}][description]" rows="3"></textarea>
              </div>
            </div>
          @endforeach --}}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
        </div>
      </form>

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
