@extends('layouts.app')

{{-- set title --}}
@section('title', 'Ruangan')
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
                                    <h4 class="card-title text-white">Tambah Ruangan</h4>
                                </div>


                                <form class="form form-horizontal" action="{{ route('backsite.location_room.store') }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body">
                                        <div class="form-section">
                                            <p class="ml-2">Isi input <code>Required (*)</code>, Sebelum menekan tombol
                                                submit. </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="name">Ruangan <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="example John Doe or Jane" value="{{ old('name') }}"
                                                    autocomplete="off" required>

                                                @if ($errors->has('name'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="latitude">Latitude <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="latitude" name="latitude" class="form-control"
                                                    placeholder="example -6.229121731299446" value="{{ old('latitude') }}"
                                                    autocomplete="off">

                                                @if ($errors->has('latitude'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('latitude') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="longitude">Longitude <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="longitude" name="longitude" class="form-control"
                                                    placeholder="example 106.875659" value="{{ old('longitude') }}"
                                                    autocomplete="off">

                                                @if ($errors->has('longitude'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('longitude') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    < <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>

                                        <a href="{{ route('backsite.location_room.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
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
