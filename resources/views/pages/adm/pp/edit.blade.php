@extends('layouts.app')

{{-- set title --}}
@section('title', 'PP')
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
                  <h4 class="card-title text-white">Edit Data PP</h4>
                </div>
                <form class="form" action="{{ route('backsite.pp.update', $pp->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_pp">No PP<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="no_pp" name="no_pp"
                          value="{{ old('no_pp', $pp->no_pp) }}" required>
                        </select>
                        @if ($errors->has('no_pp'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_pp') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="date">Tanggal PP<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date" name="date"
                          value="{{ old('date', $pp->date) }}" required>
                        </select>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="job_name">Nama Pekerjaan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="job_name" name="job_name"
                          value="{{ old('job_name', $pp->job_name) }}" required>
                        @if ($errors->has('job_name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="rkap">Nilai RKAP<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" id="rkap" name="rkap" class="form-control"
                          value="{{ old('rkap', $pp->rkap) }}" required>
                        @if ($errors->has('rkap'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('rkap') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="year">Tahun
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year" data-provide="datepicker"
                          data-date-format="yyyy" data-date-min-view-mode="2" autocomplete="off"
                          value="{{ old('year', $pp->year) }}" readonly required>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="job_value">Nilai Pekerjaan
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="job_value" id="job_value"
                          value="{{ old('job_value', $pp->job_value) }}" required>
                        @if ($errors->has('job_value'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_value') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1"{{ $pp->stats == 1 ? 'selected' : '' }}>Aktif</option>
                          <option value="2"{{ $pp->stats == 2 ? 'selected' : '' }}>Tidak Aktif
                          </option>
                        </select>

                        @if ($errors->has('stats'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('stats') }}</p>
                        @endif
                      </div>
                      <label for="type_bill" class="col-md-2 label-control">Tipe Tagihan</label>
                      <div class="col-md-4">
                        <select name="type_bill" id="type_bill" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="LUMPSUM"{{ $pp->type_bill == 'LUMPSUM' ? 'selected' : '' }}>
                            Lumpsum
                          </option>
                          <option value="RUTIN"{{ $pp->type_bill == 'RUTIN' ? 'selected' : '' }}>Rutin
                          </option>
                        </select>
                        @if ($errors->has('type_bill'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('type_bill') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description', $pp->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-actions ">
                      <button type="submit" name="action" value="submit" style="display:none;"
                        class="btn btn-cyan float-right mr-2"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Simpan
                      </button>
                    </div>
                </form>
                <div class="form-group row">
                  <div class="col-md-4">
                    <button type="button" id="button_file" class="btn btn-cyan btn-md ml-2 my-2" title="Tambah File"
                      onclick="upload('{{ $pp->id }}')"><i class="bx bx-file"></i>
                      Tambah File</button>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
                      aria-label="">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 5%;">No</th>
                          <th class="text-center">Tipe File</th>
                          <th class="text-center">Nama File</th>
                          <th class="text-center">Keterangan</th>
                          <th style="text-align:center; width:10px;">Action</th>
                        </tr>
                      </thead>
                      @foreach ($datafile as $file)
                        <tbody>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td class="text-center">
                            @if ($file->type_file)
                              {{ $file->type_file }}
                            @else
                              <p style="color:red;">Type File is Empty!</p>
                            @endif
                          </td>
                          <td class="text-center">
                            @if ($file->name_file)
                              {{ $file->name_file }}
                            @else
                              <p style="color:red;">Name File is Empty!</p>
                            @endif
                          </td>
                          <td class="text-center">
                            @if ($file->description_file)
                              {{ $file->description_file }}
                            @else
                              <p style="color:red;">Description is Empty!</p>
                            @endif
                          </td>
                          <td class="text-center">
                            <div class="btn-group mr-1 mb-1">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}"
                                  class="btn text-nowrap ">
                                  Show
                                </a>
                                <a type="button" href="{{ asset('storage/' . $file->file) }}" class="btn text-nowrap"
                                  download>Download</a>
                                <form action="{{ route('backsite.pp.hapus_file', $file->id ?? '') }}" method="POST"
                                  onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="submit" id="delete_file" class="btn"value="Delete">
                                </form>
                              </div>
                            </div>
                          </td>
                        </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
                <div class="form-actions ">
                  <button type="submit" name="action" value="submit" style="width:120px;"
                    class="btn btn-cyan float-right mr-2"
                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                    <i class="la la-check-square-o"></i> Simpan
                  </button>
                  <a href="{{ route('backsite.pp.index') }}" class="btn btn-success text-left ml-2">
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
    function thisFileUpload() {
      document.getElementById("delete_file").click();
    }
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
        url: "{{ route('backsite.pp.form_upload') }}",
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
