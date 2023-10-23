<div class="content-body">
    <section id="add-home">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <a data-action="collapse">
                            <h4 class="card-title text-white">Tambah Data</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </a>
                    </div>

                    <div class="card-content collapse hide">
                        <div class="card-body card-dashboard">

                            <form class="form" action="{{ route('backsite.device_additional.store') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="form-body">
                                    <div class="form-section">
                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                        </p>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="additional_device_id">Perangkat
                                            Tambahan
                                            <code style="color:red;">required</code></label>
                                        <div class="col-md-4">
                                            <select name="additional_device_id" id="additional_device_id"
                                                class="form-control select2" required>
                                                <option value="{{ '' }}" disabled selected>
                                                    Choose
                                                </option>
                                                @foreach ($additional as $additional => $additional_item)
                                                    <option value="{{ $additional_item->id }}">
                                                        {{ $additional_item->name }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('additional_device_id'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('additional_device_id') }}</p>
                                            @endif
                                        </div>
                                        <label class="col-md-2 label-control" for="no_non_asset">No Non Asset
                                            <code style="color:red;">required</code></label>
                                        <div class="col-md-4">
                                            <input type="text" id="no_non_asset" name="no_non_asset"
                                                class="form-control" value="{{ 'TI' . '-' . $kd }}" required>

                                            @if ($errors->has('no_non_asset'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('no_non_asset') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="file">File
                                            <code style="color:red;">optional</code></label>
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
                                                style="color:red;">optional</code></label>
                                        <div class="col-md-10">
                                            <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
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
    </section>
</div>

{{-- table card --}}
<div class="content-body">
    <section id="table-home">
        <!-- Zero configuration table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Perangkat Tambahan</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="mb-0 list-inline">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-inputs-searching default-table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width:50px;">No</th>
                                            <th style="text-align:center;">No Non Asset</th>
                                            <th style="text-align:center;">Perangkat Tambahan</th>
                                            <th style="text-align:center;">File</th>
                                            <th style="text-align:center;">Keterangan</th>
                                            <th style="text-align:center; width:100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($device_additional as $key => $device_additional_item)
                                            <tr data-entry-id="{{ $device_additional_item->id }}">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center"> <span
                                                        class="badge badge-success">{{ $device_additional_item->no_non_asset }}</span>
                                                </td>
                                                <td class="text-center">
                                                    {{ $device_additional_item->additional_device->name }}
                                                </td>
                                                <td class="text-center">
                                                    <a data-fancybox="gallery"
                                                        data-src="{{ asset('storage/' . $device_additional_item->file) }}"
                                                        class="blue accent-4 dropdown-item">Show</a>
                                                </td>
                                                <td class="text-center">{!! $device_additional_item->description !!}</td>
                                                <td class="text-center">
                                                    <div class="mb-1 mr-1 btn-group">
                                                        <button type="button"
                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('backsite.device_additional.edit', encrypt($device_additional_item->id)) }}">
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('backsite.device_additional.destroy', encrypt($device_additional_item->id)) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="submit" class="dropdown-item"
                                                                    value="Delete">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{-- not found --}}
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>No Non Asset</th>
                                            <th>Perangkat Tambahan</th>
                                            <th>File</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
