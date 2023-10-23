@extends('layouts.app')

{{-- set title --}}
@section('title', 'Detail Lokasi')
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
                                    <h4 class="card-title text-white">Tambah Detail Lokasi</h4>
                                </div>
                                <form class="form" action="{{ route('backsite.location_detail.store') }}" method="POST"
                                    enctype="form-data">

                                    @csrf

                                    <div class="form-body container">
                                        <div class="form-section">
                                            <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="location_id">Lokasi<code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="location_id" id="location_id" class="form-control select2"
                                                    required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    @foreach ($location as $key => $location_item)
                                                        <option value="{{ $location_item->id }}">
                                                            {{ $location_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('location_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('location_id') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="latitude">Latitude<code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="latitude" name="latitude" class="form-control"
                                                    value="{{ old('latitude') }}" autocomplete="off">

                                                @if ($errors->has('latitude'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('latitude') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="location_sub_id">Sub
                                                Lokasi<code style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="location_sub_id" id="location_sub_id"
                                                    class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    @foreach ($location_sub as $key => $location_sub_item)
                                                        <option value="{{ $location_sub_item->id }}">
                                                            {{ $location_sub_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('location_sub_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('location_sub_id') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="longitude">Longitude<code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="longitude" name="longitude" class="form-control"
                                                    value="{{ old('longitude') }}" autocomplete="off">

                                                @if ($errors->has('longitude'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('longitude') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="location_room_id">Ruangan<code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="location_room_id" id="location_room_id"
                                                    class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    @foreach ($location_room as $key => $location_room_item)
                                                        <option value="{{ $location_room_item->id }}">
                                                            {{ $location_room_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('location_room_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('location_room_id') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="status">Status<code
                                                    style="color:red;">optional</code></label>
                                            <div class="col-md-4">
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak Aktif</option>
                                                </select>

                                                @if ($errors->has('status'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('status') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="keterangan">Keterangan<code
                                                    style="color:red;">optional</code></label>
                                            <div class="col-md-10">
                                                <textarea rows="5" class="form-control summernote" id="keterangan" name="keterangan"></textarea>
                                                <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                        + Enter jika ingin pindah baris</small></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>

                                        <a href="{{ route('backsite.location_detail.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


@endsection
