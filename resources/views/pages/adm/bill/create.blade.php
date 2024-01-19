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

                <form class="form" action="{{ route('backsite.bill.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="container">
                    <div class="row ">
                      <div class="col-md-12 ">
                        <div class="form-body">
                          <div class="form-section">
                          </div>
                          <div class="form-group row ">
                            <label class="col-md-2 label-control" for="pp_id">No PP<code
                                style="color:red;">*</code></label>
                            <div class="col-md-4">
                              <select name="pp_id" id="pp_id" class="form-control select2">
                                <option value="{{ '' }}" disabled selected>
                                  Choose
                                </option>
                                @foreach ($pp as $key => $pp_item)
                                  <option value="{{ $pp_item->id }}">
                                    {{ $pp_item->no_pp }}</option>
                                @endforeach
                              </select>
                            </div>
                            @if ($errors->has('bill_to'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('bill_to') }}</p>
                            @endif

                            <label class="col-md-2 label-control" for="date">Tanggal<code
                                style="color:red;">*</code></label>
                            <div class="col-md-4">
                              <input type="date" id="date" name="date" class="form-control"
                                value="{{ old('date') }}" required>
                              @if ($errors->has('date'))
                                <p style="font-style: bold; color: red;">
                                  {{ $errors->first('date') }}</p>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="bill_to">Tagihan Ke <code
                              style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <input type="text" id="bill_to" name="bill_to" class="form-control"
                              value="{{ old('bill_to') }}" required>
                            @if ($errors->has('bill_to'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('bill_to') }}</p>
                            @endif
                          </div>

                          <label class="col-md-2 label-control" for="bill_value">Nilai Tagihan
                            <code style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                              </div>
                              <input type="text" class="form-control numberformat" name="bill_value" id="bill_value"
                                value="{{ old('bill_value') }}" required>
                            </div>
                            @if ($errors->has('bill_value'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('bill_value') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="file">File
                            <code style="color:red;">*</code></label>
                          <div class="col-md-4">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="file" name="file" required>
                              <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                                File</label>
                            </div>
                            @if ($errors->has('file'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('file') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2 label-control" for="description">Keterangan<code
                              style="color:red;">*</code></label>
                          <div class="col-md-10">
                            <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('description') }}</p>
                            @endif
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
                    </div>
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
