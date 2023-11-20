@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aplikasi')
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
                  <h4 class="card-title text-white">Edit Data Aplikasi</h4>
                </div>
                <form class="form" action="{{ route('backsite.application.update', $app->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name_app">Nama Aplikasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="name_app" name="name_app"
                          value="{{ old('name_app', $app->name_app) }}" required>
                        </select>
                        @if ($errors->has('name_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_app') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_app">Path Aplikasi<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_app" name="path_app"
                          value="{{ old('path_app', $app->path_app) }}" required>
                        </select>
                        @if ($errors->has('path_app'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_app') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="user_id">User<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="user_id" name="user_id"
                          value="{{ old('user_id', $app->user_id) }}" readonly>
                        </select>
                        @if ($errors->has('user_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('user_id') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_database">Path Database<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_database" name="path_database"
                          value="{{ old('path_database', $app->path_database) }}" required>
                        </select>
                        @if ($errors->has('path_database'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_database') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="creator">Pembuat<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="creator" name="creator"
                          value="{{ old('creator', $app->creator) }}" required>
                        </select>
                        @if ($errors->has('creator'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('creator') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="path_file">Path File/Dokumen<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="path_file" name="path_file"
                          value="{{ old('path_file', $app->path_file) }}" required>
                        </select>
                        @if ($errors->has('path_file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('path_file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_start">Tanggal Mulai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="{{ old('date_start', $app->date_start) }}" required>
                        </select>
                        @if ($errors->has('date_start'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_start') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="date_finish">Tanggal Selesai<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date_finish" name="date_finish"
                          value="{{ old('date_finish', $app->date_finish) }}" required>
                        </select>
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
                        <textarea rows="5" class="form-control mb-3" id="description" name="description" required>{{ old('description', $app->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-actions hidden">
                    <button type="submit" id="submit_id" name="action" value="submit" style="width:120px;"
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.application.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1"
                      title="Tambah Catatan" onclick="upload_note({{ $app->id }})"><i class="bx bx-file"></i>
                      Tambah Catatan</button>
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
                        <th class="text-center">Catatan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">File</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($notes as $note)
                      <tbody>
                        <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $note->note }}</td>
                        <td class="text-center">{{ Carbon\Carbon::parse($note->date)->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="text-center">
                          <a type="button" data-fancybox data-src="{{ asset('storage/' . $note->file) }}"
                            class="btn btn-info btn-sm text-white ">
                            Lihat
                          </a> <a type="button" href="{{ asset('storage/' . $note->file) }}"
                            class="btn btn-warning btn-sm text-white" download>Unduh</a>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                              <form action="{{ route('backsite.application.delete_file_note', $note->id ?? '') }}"
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
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_file({{ $app->id }})"><i class="bx bx-file"></i>
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
                        <td class="text-center">{{ $file->description }}</td>
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
                              <form action="{{ route('backsite.application.delete_file', $file->id ?? '') }}"
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
                  <a href="{{ route('backsite.application.index') }}" class="btn btn-success text-left ml-2">
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

@push('after-script')
  <script>
    function submit_id() {
      document.getElementById("submit_id").click();
    }
  </script>
  <script>
    function upload_note(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.application.form_upload_note') }}",
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

    function upload_file(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.application.form_upload_file') }}",
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
