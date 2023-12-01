@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aset Deployment')
@section('content')
  <div class="app-content content" id="app">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Aset Deployment</h4>
                </div>
                <form class="form" action="{{ route('backsite.distribution.update', $distribution->id) }}"
                  method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="lcoation_room_id">Ruangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="location_room_id" id="location_room_id" class="form-control select2">
                          <option value="" selected disabled>Choose</option>
                          @foreach ($location_room as $room)
                            <option
                              value="{{ $room->id }}"{{ $room->id == $distribution->location_room_id ? 'selected' : '' }}>
                              {{ $room->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="user_id">User<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select class="form-control select2" name="user_id" id="user_id">
                          <option value="" disabled selected>Choose</option>
                          @foreach ($user as $key => $user_item)
                            <option value="{{ $user_item->id }}"
                              {{ $user_item->id == $distribution->user_id ? 'selected' : '' }}>
                              {{ $user_item->user->name }}</option>
                          @endforeach
                          </option>
                        </select>
                        @if ($errors->has('user_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('user_id') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date">Tanggal<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" name="date" id="date"
                          value="{{ old('date', $distribution->date) }}" required>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                          @if ($distribution->file)
                            <p class="mt-1">Latest File : {{ pathinfo($distribution->file, PATHINFO_FILENAME) }}</p>
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $distribution->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $distribution->file) }}"
                              class="btn btn-warning btn-sm" download>
                              Unduh
                            </a>
                          @else
                            <p class="mt-1">Latest File : File not found!</p>
                          @endif
                        </div>
                        <p class="text-muted"><small class="text-danger">Hanya dapat
                            mengunggah 1 file</small></p>
                        @if ($errors->has('file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description', $distribution->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>


                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.distribution.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>

                <hr class="rounded">
                {{-- File --}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_file({{ $distribution->id }})"><i class="bx bx-file"></i>
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
                        <th class="text-center">Nama Asset</th>
                        <th class="text-center">Barcode</th>
                        <th class="text-center">File</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($assets as $asset)
                      <tbody>
                        @if ($asset->asset_id)
                          <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                          <td class="text-center">{{ $asset->asset->name ?? '' }}</td>
                          <td class="text-center">{{ $asset->asset->barcode ?? '' }}</td>
                          {{-- <td class="text-center">{{ pathinfo($asset->asset, PATHINFO_assetNAME) }}
                        </td> --}}
                          <td class="text-center">
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $asset->asset->file) }}"
                              class="btn btn-info btn-sm text-white ">
                              Lihat
                            </a> <a type="button" href="{{ asset('storage/' . $asset->asset->file) }}"
                              class="btn btn-warning btn-sm text-white" download>Unduh</a>
                          </td>

                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <form action="{{ route('backsite.distribution.delete_file', $asset->id ?? '') }}"
                                  method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="submit"id="delete_asset" class="btn"value="Delete">
                                </form>
                              </div>
                            </div>
                          </td>
                        @endif
                      </tbody>
                    @empty
                      <td class="text-center" colspan="6">No data available in table</td>
                    @endforelse
                  </table>
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

    $(document).ready(function() {
      $('.select21').select2();
    });
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
        url: "{{ route('backsite.distribution.form_upload') }}",
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
