@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pemijaman Fasilitas')
@section('content')
  <div class="app-content content" id="pp">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Data Pemijaman Fasilitas</h4>
                </div>
                <form class="form" action="{{ route('backsite.lendingfacility.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="borrower">Peminjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" id="borrower" name="borrower"
                          value="{{ old('borrower') }}" required>
                        </select>
                        @if ($errors->has('borrower'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('borrower') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date_lend">Tanggal Pinjam<code
                          style="color:red;">*</code></label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_lend" name="date_lend"
                          value="{{ old('date_lend') }}" required>
                        </select>
                        @if ($errors->has('date_lend'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_lend') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="date_return" class="col-md-2 label-control">Tanggal Kembali</label>
                      <div class="col-md-5">
                        <input type="date" class="form-control" id="date_return" name="date_return"
                          value="{{ old('date_return') }}">
                        </select>
                        @if ($errors->has('date_return'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date_return') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="description" name="description"
                          value="{{ old('description') }}" required>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="note">Catatan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control mb-3" id="note" name="note" required>{{ old('note') }}</textarea>
                        @if ($errors->has('note'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('note') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-actions ">
                    <button type="submit" name="action" value="submit" style="width:120px;"
                      class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.lendingfacility.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
      </section>
    </div>
  </div>
  </div>

@endsection
