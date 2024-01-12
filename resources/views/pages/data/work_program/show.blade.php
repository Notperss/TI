<div class="container">


  <table class="table table-bordered" style="word-break: break-all">
    <input type="hidden" name="id" id="id" value="{{ $work_program->id }}">

    <tr>
      <th>Program Kerja</th>
      <td>
        @if ($work_program->work_program == 1)
          <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
        @elseif($work_program->work_program == 2)
          <span class="badge badge-warning">{{ 'Hardware' }}</span>
        @elseif($work_program->work_program == 3)
          <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
        @elseif($work_program->work_program == 4)
          <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
        @elseif($work_program->work_program == 5)
          <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
        @else
          <span>{{ 'N/A' }}</span>
        @endif
      </td>
    </tr>
    <tr>
      <th>Tahun</th>
      <td>{{ isset($work_program->year) ? $work_program->year : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Umum</th>
      <td>{{ isset($work_program->general) ? $work_program->general : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Teknis</th>
      <td>{{ isset($work_program->technical) ? $work_program->technical : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Progress</th>
      <td>{{ isset($work_program->progress) ? $work_program->progress : 'N/A' }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>
        @if ($work_program->status == 1)
          <span class="badge badge-success">{{ 'Aktif' }}</span>
        @elseif($work_program->status == 2)
          <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
        @else
          <span>{{ 'N/A' }}</span>
        @endif
      </td>
    </tr>
    <tr>
      <th>Keterangan</th>
      <td>{!! isset($work_program->description) ? $work_program->description : 'N/A' !!}
      </td>
    </tr>
  </table>
</div>
{{-- <div class="container" style="overflow-wrap: break-word">

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong> Program Kerja</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-5">
      @if ($work_program->work_program == 1)
        <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
      @elseif($work_program->work_program == 2)
        <span class="badge badge-warning">{{ 'Hardware' }}</span>
      @elseif($work_program->work_program == 3)
        <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
      @elseif($work_program->work_program == 4)
        <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
      @elseif($work_program->work_program == 5)
        <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong>Tahun</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-5">
      {{ isset($work_program->year) ? $work_program->year : 'N/A' }}
    </div>
  </div>


  <div class="row mt-2">
    <div class="col-sm-3">
      <strong>Umum</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-md-8">
      {{ isset($work_program->general) ? $work_program->general : 'N/A' }}
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong>Teknis</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-8">
      {{ isset($work_program->technical) ? $work_program->technical : 'N/A' }}
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong> Progress</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-5">
      {{ isset($work_program->progress) ? $work_program->progress : 'N/A' }}
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong>Status</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-5">
      @if ($work_program->status == 1)
        <span class="badge badge-success">{{ 'Aktif' }}</span>
      @elseif($work_program->status == 2)
        <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-sm-3">
      <strong>Keterangan</strong>
    </div>
    <div class="">
      :
    </div>
    <div class="col-sm-8">
      {!! isset($work_program->description) ? $work_program->description : 'N/A' !!}
    </div>
  </div>
</div> --}}

<div class="form-group row">
  <div class="col-md-4">
    <button type="button" id="button_file" class="btn btn-cyan btn-sm ml-1 mt-1" title="Tambah file"
      onclick="upload({{ $work_program->id }})"><i class="bx bx-file"></i>
      Tambah Status</button>
  </div>
</div>

<table class="table table-bordered tampildata mt-1" style="word-break: break-all">
</table>

<script>
  function tampilDataFile() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let id = $('#id').val();
    $.ajax({
      type: "post",
      url: "{{ route('backsite.work_program.show_file') }}",
      data: {
        id: id
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampildata').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  $(document).ready(function() {
    tampilDataFile();
  });
</script>
<script>
  function upload(id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "post",
      url: "{{ route('backsite.work_program.form_upload') }}",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        $('.viewmodal').html(response.data).show();
        $('#upload').modal('show');
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }
</script>
