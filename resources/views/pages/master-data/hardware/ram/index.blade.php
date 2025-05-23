@extends('layouts.app')

{{-- set title --}}
@section('title', 'Ram')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- error --}}
      @if ($errors->any())
        <div class="mb-2 alert bg-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
          <h3 class="mb-0 content-header-title d-inline-block">RAM</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">RAM</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <a href="{{ route('backsite.ram.create') }}" class="btn btn-success col-2 mb-1">Tambah
        Data RAM</a>

      {{-- add card
            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="text-white card-header bg-success">
                                    <a data-action="collapse">
                                        <h4 class="text-white card-title">Tambah Data</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="mb-0 list-inline">
                                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>

                                <div class="card-content collapse hide">
                                    <div class="card-body card-dashboard">

                                        <form class="form form-horizontal" action="{{ route('backsite.ram.store') }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Nama <code
                                                            style="color:red;">required</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="isi nama ram disini"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="size">Ukuran/Kapasitas
                                                        <code style="color:red;">required</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <input type="text" id="size" name="size"
                                                            class="form-control" placeholder="isi ukuran/kapasitas ram"
                                                            value="{{ old('size') }}" autocomplete="off" required>

                                                        @if ($errors->has('size'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('size') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="status">Status<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="mx-auto col-md-9">
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
                                                    <label class="col-md-3 label-control" for="description">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="mx-auto col-md-9">
                                                        <textarea rows="5" class="form-control" id="description" name="description"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-right form-actions">
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
            </div> --}}

      {{-- table card --}}
      <div class="content-body">
        <section id="table-home">
          <!-- Zero configuration table -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">List Ram</h4>
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
                            <th style="text-align:center; width:100px;">No</th>
                            <th style="text-align:center;">Merk/Tipe</th>
                            <th style="text-align:center;">Ukuran/Kapasitas</th>
                            <th style="text-align:center;">Keterangan</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center; width:150px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($ram as $key => $ram_item)
                            <tr data-entry-id="{{ $ram_item->id }}">
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $ram_item->name }}</td>
                              <td class="text-center">{{ $ram_item->size }}</td>
                              <td class="text-center">{{ $ram_item->description }}</td>
                              <td class="text-center">
                                @if ($ram_item->status == 1)
                                  <span class="badge badge-success">{{ 'Aktif' }}</span>
                                @elseif($ram_item->status == 2)
                                  <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                @else
                                  <span>{{ 'N/A' }}</span>
                                @endif
                              </td>
                              <td class="text-center">
                                <div class="mb-1 mr-1 btn-group">
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                      href="{{ route('backsite.ram.edit', encrypt($ram_item->id)) }}">
                                      Edit
                                    </a>
                                    <form action="{{ route('backsite.ram.destroy', encrypt($ram_item->id)) }}"
                                      method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="submit" class="dropdown-item" value="Delete">
                                    </form>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          @empty
                            {{-- not found --}}
                          @endforelse
                        </tbody>
                        <tfoot hidden>
                          <th>No</th>
                          <th>Name</th>
                          <th>Ukuran/Kapasitas</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                          <th>Action</th>
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

    </div>
  </div>
  <!-- END: Content-->

@endsection

@push('after-script')
  <script>
    $('.default-table').DataTable({
      "order": [],
      "paging": true,
      "lengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "pageLength": 10
    });
  </script>
@endpush
