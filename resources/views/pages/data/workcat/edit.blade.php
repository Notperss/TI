@extends('layouts.app')

{{-- set title --}}
@section('title', 'Jenis pekerjaan')
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
                                    <h4 class="card-title text-white">Edit Jenis pekerjaan</h4>
                                </div>

                                <form class="form form-horizontal"
                                    action="{{ route('backsite.workcat.update', [$workcat->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-body">
                                        <div class="form-sectio">
                                            <p class="ml-2"> Isi input <code>Required (*)</code>, Sebelum menekan tombol
                                                submit. </p>
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="id">no_job <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="id" name="id" class="form-control"
                                                    placeholder="" value="{{ old('id', $workcat->id) }}" autocomplete="off"
                                                    readonly>
                                            </div>
                                            @if ($errors->has('id'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('id') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="job_type">job_type <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="job_type" name="job_type" class="form-control"
                                                    placeholder="" value="{{ old('job_type', $workcat->job_type) }}"
                                                    autocomplete="off" autofocus required>
                                            </div>
                                            @if ($errors->has('job_type'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('job_type') }}</p>
                                            @endif
                                        </div>


                                        <div class="form-group row col-10">
                                            <label class="col-md-3 label-control" for="description">description <code
                                                    style="color:red;">*</code></label>
                                            <div class="col-md-9 mx-auto">
                                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $workcat->description) }}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('description') }}</p>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-actions ">
                                        <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>

                                        <a href="{{ route('backsite.workcat.index') }}"
                                            class="btn btn-success text-left ml-2">
                                            <i class="la la-arrow-left"></i> Kembali</a>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>


@endsection
