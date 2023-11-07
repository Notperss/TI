@extends('layouts.app')

{{-- set title --}}
@section('title', 'Tagihan')
@section('content')
  <div class="app-content content" id="bill">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data Tagihan</h4>
                </div>
                <form class="form" action="{{ route('backsite.bill.store', $pp->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="no_pp">No PP</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="no_pp" name="no_pp"
                          value="{{ old('no_pp', $pp->no_pp) }}" readonly>
                        </select>
                        @if ($errors->has('no_pp'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('no_pp') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="date">Tanggal PP</label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" id="date" name="date"
                          value="{{ old('date', $pp->date) }}" readonly>
                        </select>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="job_name">Nama Pekerjaan</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="job_name" name="job_name"
                          value="{{ old('job_name', $pp->job_name) }}" readonly>
                        @if ($errors->has('job_name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_name') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="rkap">Nilai RKAP</label>
                      <div class="col-md-4">
                        <input type="text" id="rkap" name="rkap" class="form-control"
                          value="{{ old('rkap', $pp->rkap) }}" readonly>
                        @if ($errors->has('rkap'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('rkap') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="year">Tahun
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="year" id="year"
                          value="{{ old('year', $pp->year) }}" readonly>
                        @if ($errors->has('year'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('year') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="job_value">Nilai Pekerjaan
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="job_value" id="job_value"
                          value="{{ old('job_value', $pp->job_value) }}" readonly>
                        @if ($errors->has('job_value'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('job_value') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="stats">Status</label>
                      <div class="col-md-4">
                        <select name="stats" id="stats" class="form-control select2" disabled>
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
                        <select name="type_bill" id="type_bill" class="form-control select2" disabled>
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
                      <label class="col-md-2 label-control" for="description">Keterangan</label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control" id="description" name="description" readonly>{{ old('description', $pp->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('file') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label>
                        <h5 class="mr-3">Lihat File</h5>
                      </label>
                      <div class="btn-group btn-group-toggle">
                        <label for="openFileTrue" class="btn btn-outline-info btn-sm">Lihat
                          <input type="radio" class="custom-control-input" name="open_file" id="openFileTrue"
                            v-model="open_file" :value="true" />
                        </label>
                      </div>
                      <div class="btn-group btn-group-toggle">
                        <label for="openFileFalse" class="btn btn-outline-info btn-sm">Tutup
                          <input type="radio" class="custom-control-input" name="open_file" id="openFileFalse"
                            v-model="open_file" :value="false" checked />
                        </label>
                      </div>
                    </div>
                    <div class="form-group" v-if="open_file">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-bordered text-inputs-searching default-table activity-table"
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
                          @forelse ($datafile as $file)
                            <tbody>
                              <td hidden>{{ $file->id }}</td>
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
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a type="button" data-fancybox data-src="{{ asset('storage/' . $file->file) }}"
                                      class="btn text-nowrap ">
                                      Show
                                    </a>
                                    <a type="button" href="{{ asset('storage/' . $file->file) }}"
                                      class="btn text-nowrap" download>Download</a>
                                  </div>
                                </div>
                              </td>
                            </tbody>
                          @empty
                            <td colspan="5" class="text-center">No data available in table</td>
                          @endforelse
                        </table>
                      </div>
                    </div>
                    <div class="form-section"></div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <button type="button" id="button_file" class="btn btn-cyan btn-md ml-2 my-2"
                          title="Tambah Tagihan" onclick="bill_form('{{ $pp->id }}')"><i class="bx bx-file"></i>
                          Tambah Tagihan</button>
                      </div>
                      <div class="table-responsive col-md-12">
                        <table class="table table-striped table-bordered default-table activity-table mb-4"
                          aria-label="">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 5%;">No</th>
                              <th class="text-center">Tagihan Ke</th>
                              <th class="text-center">Tanggal</th>
                              <th class="text-center">Nilai Tagihan</th>
                              <th class="text-center">keterangan</th>
                              <th class="text-center">File</th>
                              <th style="text-align:center; width:10px;">Action</th>
                            </tr>
                          </thead>
                          @forelse ($bills as $bill)
                            <tbody>
                              <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $bill->bill_to }}</td>
                              <td class="text-center">{{ $bill->date }}</td>
                              <td class="text-center">{{ $bill->bill_value }}</td>
                              <td class="text-center">{{ $bill->description }}</td>
                              <td class="text-center"> <a type="button" data-fancybox
                                  data-src="{{ asset('storage/' . $bill->file) }}"
                                  class="btn btn-info btn-sm text-white ">
                                  Show
                                </a></td>
                              <td class="text-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a class="btn text-nowrap" href="{{ route('backsite.bill.edit', $bill->id) }}">
                                      Edit
                                    </a>
                                    <a type="button" href="{{ asset('storage/' . $bill->file) }}"
                                      class="btn text-nowrap" download>Download File</a>
                                    <button type="button" class="btn text-nowrap" onclick="thisFileDelete()">
                                      Delete
                                    </button>
                                  </div>
                                </div>
                              </td>
                            </tbody>
                          @empty
                            <td colspan="7" class="text-center">No data available in table</td>
                          @endforelse
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions ">
                    <button type="submit" name="action" value="submit" style="width:120px;"
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Simpan
                    </button>
                    <a href="{{ route('backsite.bill.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
              </div>
            </div>
            <form action="{{ route('backsite.bill.hapus_file', $bill->id ?? '') }}" method="POST"
              onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" style="display: none;" id="delete_file" class="btn"value="Delete">
            </form>
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
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0/dist/vue.js"></script>
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    function thisFileDelete() {
      document.getElementById("delete_file").click();
    }
  </script>
  <script>
    function bill_form(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.bill.form_upload') }}",
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

    var bill = new Vue({
      el: "#bill",
      mounted() {

      },
      data() {
        return {
          open_file: false,
        }
      }
    });
  </script>

  {{-- <script>
    $(document).ready(function() {
      $('html,body').animate({
        scrollTop: document.body.scrollHeight
      }, "slow");
    })
  </script> --}}
@endpush
