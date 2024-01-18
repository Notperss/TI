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
                      <label class="col-md-2 label-control" for="location_id">Lokasi
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select id="location_id" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                          @foreach ($location_id as $loc)
                            <option value="{{ $loc->id }}"
                              {{ $loc->id == $distribution->location_room->sub_location->location->id ? 'selected' : '' }}>
                              {{ $loc->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('location_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location_id') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="user_id">User<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select class="form-control select2" name="user_id" id="user_id" required>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($user as $key => $user_item)
                            <option value="{{ $user_item->id }}"
                              {{ $user_item->id == $distribution->user_id ? 'selected' : '' }}>
                              {{ $user_item->name }}</option>
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
                      <label class="col-md-2 label-control" for="sub_location_id">Sub Lokasi
                        <code style="color:red;">*</code></code></label>
                      <div class="col-md-4">
                        <select id="sub_location_id" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                          @foreach ($sub_location as $loc)
                            <option value="{{ $loc->id }}"
                              {{ $loc->id == $distribution->location_room->sub_location->id ? 'selected' : '' }}>
                              {{ $loc->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('sub_location_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('sub_location_id') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="division">Divisi <code
                          style="color:red;">*</code></label>
                      <div class="col-md-4 ">
                        <select name="division" id="division" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($division as $key => $division_item)
                            <option value="{{ $division_item->name }}"
                              {{ $division_item->name == $distribution->division ? 'selected' : '' }}>
                              {{ $division_item->name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('division'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('division') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="name">Ruangan
                        <code style="color:red;">*</code></code></label>
                      <div class="col-md-4">
                        <select name="location_room_id" id="location_room_id" class="form-control select2" required>
                          <option value=""selected disabled>Choose</option>
                          @foreach ($location_room as $loc)
                            <option value="{{ $loc->id }}"
                              {{ $loc->id == $distribution->location_room->id ? 'selected' : '' }}>
                              {{ $loc->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>

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
                            @if ($errors->has('name_file'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('name_file') }}</p>
                            @endif
                        </div>
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
                        @if ($errors->has('name_file'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name_file') }}</p>
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
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_file({{ $distribution->id }})"><i class="bx bx-file"></i>
                      Tambah data asset</button>
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
                      <tbody class="border-0">
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
                            @if ($asset->stats == 1)
                              <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <form action="{{ route('backsite.distribution.delete_file', $asset->id ?? '') }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="delete_asset" class="btn"value="Delete">
                                  </form>

                                  <form action="{{ route('backsite.distribution.return', encrypt($asset->id ?? '')) }}"
                                    method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit"id="update_asset" class="btn"value="Dikembalikan">
                                  </form>
                                </div>
                              </div>
                            @else
                              <span>Dikembalikan : {{ $asset->updated_at->format('d-M-Y') }}</span>
                            @endif
                          </td>
                        @endif
                      </tbody>
                    @empty
                      <td class="text-center" colspan="6">No data available in table</td>
                    @endforelse
                  </table>
                </div>

                <hr class="rounded">
                {{-- File --}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_ip({{ $distribution->id }})"><i class="bx bx-file"></i>
                      Tambah data IP</button>
                  </div>
                </div>
                <div class="table-responsive col-md-12">
                  <table class="table table-striped table-bordered default-table activity-table mb-4" aria-label="">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">Akses Internet</th>
                        <th class="text-center">Gateway</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($ip_deployment as $ip)
                      <tbody class="border-0">
                        @if ($ip->distribution_id)
                          <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                          <td class="text-center">{{ $ip->ip ?? '' }}</td>
                          <td class="text-center">
                            {{ $ip->internet_access == 1 ? 'Ada Internet' : 'Tidak Ada Internet' }}</td>
                          <td class="text-center">{{ $ip->gateway ?? '' }}</td>

                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <form action="{{ route('backsite.distribution.delete_ip', $ip->id ?? '') }}"
                                  method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="submit"id="delete_ip" class="btn"value="Delete">
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


                <hr class="rounded">
                {{-- File --}}
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-1 my-1" title="Tambah file"
                      onclick="upload_app({{ $distribution->id }})"><i class="bx bx-file"></i>
                      Tambah data Aplikasi</button>
                  </div>
                </div>
                <div class="table-responsive col-md-12">
                  <table class="table table-striped table-bordered default-table activity-table mb-4" aria-label="">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-center">Nama Aplikasi</th>
                        <th class="text-center">Versi</th>
                        <th class="text-center">Product</th>
                        <th style="text-align:center; width:10px;">Action</th>
                      </tr>
                    </thead>
                    @forelse ($apps as $app)
                      <tbody class="border-0">
                        @if ($app->distribution_id)
                          <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                          <td class="text-center">{{ $app->app->name_app ?? '' }}</td>
                          <td class="text-center">{{ $app->app->version ?? '' }}</td>
                          <td class="text-center">{{ $app->app->product ?? '' }}</td>

                          <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <form action="{{ route('backsite.distribution.delete_app', $app->id ?? '') }}"
                                  method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="submit"id="delete_app" class="btn"value="Delete">
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
      document.geentElemtById("submit_id").click();
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

    function upload_ip(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.distribution.form_ip') }}",
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

    function upload_app(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.distribution.form_app') }}",
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
      $('#location_id').change(function() {
        var locationId = $(this).val();
        if (locationId) {
          $.ajax({
            url: '{{ route('backsite.getSubLocations') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              location_id: locationId
            },
            success: function(data) {
              $('#sub_location_id').empty();
              $('#sub_location_id').append('<option value="" selected disabled>Choose</option>');
              $.each(data, function(key, value) {
                $('#sub_location_id').append('<option value="' + value.id + '">' + value.name +
                  '</option>');
              });
            }
          });
        } else {
          $('#sub_location_id').empty();
          $('#sub_location_id').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });

    $(document).ready(function() {
      $('#sub_location_id').change(function() {
        var sub_locationId = $(this).val();
        if (sub_locationId) {
          $.ajax({
            url: '{{ route('backsite.getLocationRooms') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              sub_location_id: sub_locationId
            },
            success: function(data) {
              $('#location_room_id').empty();
              $('#location_room_id').append('<option value="" selected disabled>Choose</option>');
              $.each(data, function(key, value) {
                $('#location_room_id').append('<option value="' + value.id + '">' + value.name +
                  '</option>');
              });
            }
          });
        } else {
          $('#location_room_id').empty();
          $('#location_room_id').append('<option value="" selected disabled>Choose</option>');
        }
      });
    });
  </script>



  <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script>
@endpush
