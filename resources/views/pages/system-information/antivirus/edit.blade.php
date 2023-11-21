@extends('layouts.app')

{{-- set title --}}
@section('title', 'Antivirus')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Edit Data Antivirus</h4>
                </div>
                <form class="form" action="{{ route('backsite.antivirus.update', $antivirus->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_antivirus">Nama Antivirus<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_antivirus" name="name_antivirus"
                          value="{{ old('name_antivirus', $antivirus->name_antivirus) }}" required>
                        @if ($errors->has('name_antivirus'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_antivirus') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="year">Tahun<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                          data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off"
                          value="{{ old('year', $antivirus->year) }}" readonly required>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="num_of_licenses">Jumlah Lisensi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="num_of_licenses" name="num_of_licenses"
                          value="{{ old('num_of_licenses', $antivirus->num_of_licenses) }}" required>
                        @if ($errors->has('num_of_licenses'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('num_of_licenses') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_start">Tanggal Mulai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="{{ old('date_start', $antivirus->date_start) }}" required>

                        @if ($errors->has('date_start'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_start') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_finish">Tanggal Berakhir<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_finish" name="date_finish"
                          value="{{ old('date_finish', $antivirus->date_finish) }}" required>

                        @if ($errors->has('date_finish'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_finish') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description', $antivirus->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">stats<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control">
                          <option value="" disabled selected> Choose</option>
                          <option value="AKTIF"{{ $antivirus->stats == 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                          <option value="TIDAK AKTIF"{{ $antivirus->stats == 'TIDAK AKTIF' ? 'selected' : '' }}>Tidak
                            Aktif</option>
                        </select>
                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>


                  <div class="form-actions" hidden>
                    <button type="submit" id="submit_id" name="action" value="submit" style="width:120px;"
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.antivirus.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>


                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_file({{ $antivirus->id }})"><i class="bx bx-file"></i>
                      Tambah File</button>
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
                </div>
                <div class="table-responsive col-md-12">
                  <table class="table table-striped table-bordered default-table activity-table mb-4" aria-label="">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">File</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($files as $file)
                      <tbody>
                        <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $file->note }}</td>
                        <td class="text-center">{{ Carbon\Carbon::parse($file->date)->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="text-center">
                          <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}"
                            class="btn btn-info btn-sm text-white ">
                            Lihat
                          </a> <a type="button" href="{{ asset('storage/' . $file->file) }}"
                            class="btn btn-warning btn-sm text-white" download>Unduh</a>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                              <form action="{{ route('backsite.antivirus.delete_file', $file->id ?? '') }}"
                                method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit"id="delete_file" class="btn"value="Delete">
                              </form>
                            </div>
                          </div>
                        </td>
                      </tbody>
                    @empty
                      <td class="text-center" colspan="6">No data available in table</td>
                    @endforelse
                  </table>
                </div>

                <div class="form-actions mb-1">
                  <button type="submit" name="action" value="submit" style="width:120px;"
                    class="btn btn-cyan float-right mr-2" onclick="submit_id()">
                    <i class="la la-check-square-o"></i> Submit
                  </button>
                  <a href="{{ route('backsite.antivirus.index') }}" class="btn btn-success text-left ml-2">
                    <i class="la la-arrow-left"></i> Kembali</a>
                </div>
              </div>
            </div>
          </div>
      </div>
      </section>
    </div>
  </div>
  </div>
  <div class="viewmodal" style="display: none;"></div>

@endsection
@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

  <script>
    function submit_id() {
      document.getElementById("submit_id").click();
    }
  </script>
  <script>
    function upload_file(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.antivirus.form_upload') }}",
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

  <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script>
@endpush
