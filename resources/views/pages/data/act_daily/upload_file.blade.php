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
<div class="modal fade" id="modalupload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File Aktivitas Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{ route('backsite.act_daily.upload') }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="{{ $id }}">
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="file">File
                            <code style="color:red;">required</code></label>
                        <div class="col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file[]"
                                    multiple="multiple" onchange="updateList()" required>
                                <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                                    File</label>
                            </div>

                            <p class="text-muted"><small class="text-danger">Dapat
                                    mengunggah lebih dari 1 file</small></p>

                            @if ($errors->has('file'))
                                <p style="font-style: bold; color: red;">
                                    {{ $errors->first('file') }}</p>
                            @endif
                        </div>
                        <p class="col-md-4">Selected File :</p>
                        <div id="fileList" style="word-break: break-all"></div>
                        {{-- <input type="file" multiple name="file" id="file"
onchange="javascript:updateList()" />

  <p>Selected files:</p>

  <div id="fileList"></div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
