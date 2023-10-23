@extends('layouts.app')

{{-- set title --}}
@section('title', 'Sub Lokasi')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h4 class="card-title text-white">Tambah Data</h4>
                                </div>

                                <form class="form form-horizontal" action="{{ route('backsite.location_sub.store') }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body container">
                                        <div class="form-section">
                                            <p>Isi input <code>required</code>, Sebelum menekan tombol
                                                submit. </p>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="name">Sub Lokasi
                                                <code style="color:red;">required</code></label>
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

                                    </div>

                                    <div class="form-actions text-left ml-2">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
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
