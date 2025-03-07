@extends('layouts.app')

{{-- set title --}}
@section('title', 'Category Hardware')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header bg-success text-white my-1">
                  <h4 class="card-title text-white">Tambah Category Hardware</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.hardware-category.store') }}" method="POST"
                  enctype="multipart/form-data">

                  @csrf

                  <div class="form-body">
                    <div class="form-section">
                      <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>
                    <div class="form-group row col-10">
                      <label class="col-md-3 label-control" for="name">Nama Kategori <code
                          style="color:red;">*</code></label>
                      <div class="col-md-9 mx-auto">
                        <input type="text" id="name" name="name" class="form-control" placeholder=""
                          value="{{ old('name') }}" autocomplete="off" autofocus required>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-10">
                      <label class="col-md-3 label-control" for="has_indicator">Ada Indikator <code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select id="has_indicator" name="has_indicator" class="form-control select2" required>
                          <option value="" disabled selected>Choose</option>
                          <option value="1">YA</option>
                          <option value="0">TIDAK</option>
                        </select>
                        @if ($errors->has('has_indicator'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('has_indicator') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row col-10" id="has_testing_group" style="display: none;">
                      <label class="col-md-3 label-control" for="has_testing">Ada Testing <code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select id="has_testing" name="has_testing" class="form-control select2">
                          <option value="" disabled selected>Choose</option>
                          <option value="1">YA</option>
                          <option value="0">TIDAK</option>
                        </select>
                        @if ($errors->has('has_testing'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('has_testing') }}</p>
                        @endif
                      </div>
                    </div>

                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>

                    <a href="{{ route('backsite.hardware-category.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
              </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>


@endsection
@push('after-script')
  <script>
    $(document).ready(function() {
      let hasIndicator = $("#has_indicator");
      let hasTest = $("#has_testing");
      let hasTestGroup = hasTest.closest(".form-group");

      function toggleHasTest() {
        if (hasIndicator.val() === "1") {
          hasTestGroup.show();
        } else {
          hasTestGroup.hide();
          hasTest.val("").trigger("change"); // Reset pilihan ke default
        }
      }

      // Event listener ketika has_indicator berubah
      hasIndicator.change(function() {
        toggleHasTest();
      });

      // Jalankan saat halaman dimuat untuk menangani nilai yang sudah dipilih sebelumnya
      toggleHasTest();
    });
  </script>
@endpush
