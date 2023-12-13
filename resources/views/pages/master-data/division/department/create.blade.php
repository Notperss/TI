@extends('layouts.app')

{{-- set title --}}
@section('title', 'Departemen')
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
                  <h4 class="card-title text-white">Tambah Departemen</h4>
                </div>

                <form class="form form-horizontal" action="{{ route('backsite.department.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body">
                    <div class="form-section">
                      <p> Isi input <code>required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="division_id">Divisi <code
                          style="color:red;">*</code></label>
                      <div class="col-md-9 mx-auto">
                        <select name="division_id" id="division_id" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($division as $key => $division_item)
                            <option value="{{ $division_item->id }}">
                              {{ $division_item->name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('division_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('division_id') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="name">Departemen <code
                          style="color:red;">*</code></label>
                      <div class="col-md-9 mx-auto">
                        <input type="text" id="name" name="name" class="form-control"
                          placeholder="example John Doe or Jane" value="{{ old('name') }}" autocomplete="off" required>

                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-actions text-right">
                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
