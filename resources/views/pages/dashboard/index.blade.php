@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
          <h3 class="mb-0 content-header-title d-inline-block">Dashboard</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <h3 class="mb-0 content-header-title d-inline-block">Teknologi Informasi</h3>
          </div>
        </div>
      </div>
      {{-- Card --}}
      <div class="content-body">
        <div class="row">

          <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content info ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h1>
                        {{ DB::table('attendances')->where('category', 'Sakit')->whereYear('created_at', now()->year)->count() }}
                      </h1>
                      <strong class="warning">S</strong>
                    </div>
                    <div class="media-body text-left">
                      <h1>
                        {{ DB::table('attendances')->where('category', 'Tukar Tugas')->whereYear('created_at', now()->year)->count() }}
                      </h1>
                      <strong class="info">T/T</strong>
                    </div>
                    <div class="media-body text-left">
                      <h1>
                        {{ DB::table('attendances')->where('category', 'IDT')->whereYear('created_at', now()->year)->count() }}
                      </h1>
                      <strong class="primary">IDT</strong>
                    </div>
                    <div class="media-body text-left">
                      <h1>
                        {{ DB::table('attendances')->where('category', 'IPC')->whereYear('created_at', now()->year)->count() }}
                      </h1>
                      <strong class="secondary">IPC</strong>
                    </div>
                    <div class="media-body text-left">
                      <h1>
                        {{ DB::table('attendances')->where('category', 'Absen')->whereYear('created_at', now()->year)->count() }}
                      </h1>
                      <strong class="danger"> A</strong>
                    </div>
                    <div>
                      <i class="la la-book font-large-2 float-right info"></i>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table class="table w-auto small">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Absensi</th>
                                <th scope="col">Tgl</th>
                                {{-- <th scope="col">Tgl Selesai</th> --}}
                                {{-- <th scope="col">Keterangan</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($attendances as $attendance)
                                <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $attendance->detail_user->user->name }}</td>
                                  <td>{{ $attendance->category }}</td>
                                  <td> {{ Carbon\Carbon::parse($attendance->start_date)->translatedFormat('d-m-Y') }}
                                  </td>
                                  {{-- <td>{{ $attendance->finish_date }}</td> --}}
                                  {{-- <td>{{ $attendance->description }}</td> --}}
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.attendance.index') }}" class="btn btn-block btn-sm btn-info">
                      Lihat Semua Absen</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-6 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content amber darken-4">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="amber darken-4">600</h1>
                      <strong>Jumlah Server Fisik</strong>
                    </div>
                    <div>
                      <i class="la la-server  font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-amber btn-darken-4">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12 ">
            <div class="card pull-up ">
              <div class="card-content teal">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <i class="la la-credit-card font-large-2 float-right"></i>
                      <h1 class="teal">600</h1>
                      <strong>Jumlah Laporan Kerusakan Bulan Ini</strong>
                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-teal">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up bg">
              <div class="card-content  danger">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <i class="la la-file font-large-2 float-right "></i>
                      <h1 class="danger">600</h1>
                      <strong>Jumlah Laporan kerusakan Belum Selesai</strong>
                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-danger">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up bg">
              <div class="card-content  primary">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="primary">5</h1>
                      <strong>5</strong>
                    </div>
                    <div>
                      <i class="la la-terminal font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-primary">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up bg">
              <div class="card-content info">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="info">6</h1>
                      <strong>6</strong>
                    </div>
                    <div>
                      <i class="la la-edit  font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-info">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content  warning">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="warning">7</h1>
                      <strong>7</strong>
                    </div>
                    <div>
                      <i class="la la-comment font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-warning">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content success">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="success">8</h1>
                      <strong>8</strong>
                    </div>
                    <div>
                      <i class="la la-book font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-success">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content primary">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="primary">9</h1>
                      <strong>9</strong>
                    </div>
                    <div>
                      <i class="la la-terminal font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-primary">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content info">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="info">10</h1>
                      <strong>10</strong>
                    </div>
                    <div>
                      <i class="la la-edit font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-info">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content warning">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="warning">11</h1>
                      <strong>11</strong>
                    </div>
                    <div>
                      <i class="la la-comment font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-warning">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content success">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="success">12</h1>
                      <strong>12</strong>
                    </div>
                    <div>
                      <i class="la la-book font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-3 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-success">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- END: Content-->
@endsection

@push('after-style')
  <style>
    .pull-up {
      background: linear-gradient(to top,
          white,
          rgba(214, 212, 212, 0.678));
    }
  </style>
@endpush
