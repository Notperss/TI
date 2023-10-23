@extends('layouts.app')

{{-- set title --}}
@section('title', 'PC')
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
                                    <h4 class="card-title text-white">Tambah PC </h4>
                                </div>
                                <div class="card-body card-dashboard">

                                    <form class="form" action="{{ route('backsite.device_pc.store') }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-body">
                                            <div class="form-section">
                                                <p>Isi input <code>Required (*) </code>, Sebelum menekan tombol submit.
                                                </p>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="motherboard_id">Motherboard
                                                    <code style="color:red;">*</code></label>
                                                <div class="col-md-4">
                                                    <select name="motherboard_id" id="motherboard_id"
                                                        class="form-control select2" required>
                                                        <option value="{{ '' }}" disabled selected>
                                                            Choose
                                                        </option>
                                                        @foreach ($motherboard as $motherboard => $motherboard_item)
                                                            <option value="{{ $motherboard_item->id }}">
                                                                {{ $motherboard_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('motherboard_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('motherboard_id') }}</p>
                                                    @endif
                                                </div>
                                                <label class="col-md-2 label-control" for="processor_id">Processor <code
                                                        style="color:red;">*</code></label>
                                                <div class="col-md-4">
                                                    <select name="processor_id" id="processor_id"
                                                        class="form-control select2" required>
                                                        <option value="{{ '' }}" disabled selected>
                                                            Choose
                                                        </option>
                                                        @foreach ($processor as $processor => $processor_item)
                                                            <option value="{{ $processor_item->id }}">
                                                                {{ $processor_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('processor_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('processor_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="ram_id">Ram <code
                                                        style="color:red;">*</code></label>
                                                <div class="col-md-4">
                                                    <label for="role">
                                                        <span
                                                            class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                        <span
                                                            class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                    </label>
                                                    <select name="ram_id[]" id="role"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple" required>
                                                        @foreach ($ram as $ram => $ram_item)
                                                            <option value="{{ $ram_item->id }}">
                                                                {{ $ram_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('ram_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('ram_id') }}</p>
                                                    @endif
                                                </div>
                                                <label class="col-md-2 label-control" for="hardisk_id">Hardisk <code
                                                        style="color:red;">*</code></label>
                                                <div class="col-md-4">
                                                    <label for="roel">
                                                        <span
                                                            class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                        <span
                                                            class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                    </label>
                                                    <select name="hardisk_id[]" id="roel"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple" required>
                                                        @foreach ($hardisk as $hardisk => $hardisk_item)
                                                            <option value="{{ $hardisk_item->id }}">
                                                                {{ $hardisk_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('hardisk_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('hardisk_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="no_asset">No
                                                    Asset
                                                    <code style="color:red;">*</code></label>
                                                <div class="col-md-4">
                                                    <input type="text" id="no_asset" name="no_asset"
                                                        class="form-control" value="{{ old('no_asset') }}"
                                                        autocomplete="off" required>

                                                    @if ($errors->has('no_asset'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('no_asset') }}</p>
                                                    @endif
                                                </div>
                                                <label class="col-md-2 label-control" for="file">File
                                                    <code style="color:red;"></code></label>
                                                <div class="col-md-4">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file"
                                                            name="file">
                                                        <label class="custom-file-label" for="file"
                                                            aria-describedby="file">Pilih
                                                            File</label>
                                                    </div>
                                                    <p class="text-muted"><small class="text-danger">Hanya dapat
                                                            mengunggah 1 file</small></p>

                                                    @if ($errors->has('file'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('file') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="description">Keterangan<code
                                                        style="color:red;"></code></label>
                                                <div class="col-md-10">
                                                    <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions ">
                                            <button type="submit" style="width:120px;"
                                                class="btn btn-cyan float-right mr-2"
                                                onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                <i class="la la-check-square-o"></i> Submit
                                            </button>

                                            <a href="{{ route('backsite.device_pc.index') }}"
                                                class="btn btn-success text-left ml-2">
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
