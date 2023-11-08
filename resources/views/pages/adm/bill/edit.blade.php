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
                <div class="card-header bg-success mb-3">
                  <h4 class="card-title text-white">Tambah Data Tagihan</h4>
                </div>
                <form class="form" action="{{ route('backsite.bill.update', $bill->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-body container">
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="bill_to">Tagihan Ke <code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" id="bill_to" name="bill_to" class="form-control"
                          value="{{ old('bill_to', $bill->bill_to) }}" required>
                        @if ($errors->has('bill_to'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('bill_to') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date">Tanggal<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" id="date" name="date" class="form-control"
                          value="{{ old('date', $bill->date) }}" required>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="bill_value">Nilai Tagihan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" id="bill_value" name="bill_value" class="form-control"
                          value="{{ old('bill_value', $bill->bill_value) }}" required>
                        @if ($errors->has('bill_value'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('bill_value') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description', $bill->description) }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File
                        <code style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            File</label>
                          <p class="mt-1">Latest file:</p>
                          <div id="fileList" style="word-break: break-all">
                            <ul>
                              <li> {{ $fileName }}</li>
                            </ul>
                          </div>
                          @if ($errors->has('file'))
                            <p style="font-style: bold; color: red;">
                              {{ $errors->first('file') }}</p>
                          @endif
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
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

@endsection
