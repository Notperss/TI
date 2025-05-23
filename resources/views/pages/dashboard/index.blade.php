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
          {{-- Jumlah Absensi --}}
          <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <div class="card pull-up ">
              <div class="card-content info ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h1>
                        <strong class="info">Absensi</strong>
                      </h1>
                    </div>

                    <div class="media-body text-right">
                      <div class="attendance-info">
                        <h5>
                          {{ DB::table('attendances')->where('category', 'Sakit')->whereYear('created_at', now()->year)->count() }}
                        </h5>
                        <strong class="warning">S</strong>
                      </div>

                      <div class="attendance-info">
                        <h5>
                          {{ DB::table('attendances')->where('category', 'Tukar Tugas')->whereYear('created_at', now()->year)->count() }}
                        </h5>
                        <strong class="info">T/T</strong>
                      </div>

                      <div class="attendance-info">
                        <h5>
                          {{ DB::table('attendances')->where('category', 'IDT')->whereYear('created_at', now()->year)->count() }}
                        </h5>
                        <strong class="primary">IDT</strong>
                      </div>

                      <div class="attendance-info">
                        <h5>
                          {{ DB::table('attendances')->where('category', 'IPC')->whereYear('created_at', now()->year)->count() }}
                        </h5>
                        <strong class="secondary">IPC</strong>
                      </div>

                      <div class="attendance-info">
                        <h5>
                          {{ DB::table('attendances')->where('category', 'Absen')->whereYear('created_at', now()->year)->count() }}
                        </h5>
                        <strong class="danger">A</strong>
                      </div>
                    </div>

                    <div>
                      <i class="la la-book font-large-2 float-right info"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 mx-auto">
                      <div class="table-responsive">
                        <table class="table w-100 small">
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
                                <td>{{ $attendance->user->name }}</td>
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
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.attendance.index') }}" class="btn btn-block btn-sm btn-info">
                      Lihat Semua Absen</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- jumlah Asset --}}
          <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <div class="card pull-up ">
              <div class="card-content warning ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h1>
                        <strong class="warning">Asset TI</strong>
                      </h1>
                    </div>
                    <div>
                      <i class="la la-desktop font-large-2 float-right warning"></i>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">

                      <div class="col-6">
                        <ul class="list-group">
                          <li class="list-group-item bg-grey">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where(function ($query) {
                                      $query->where('category', 'PC')->orWhere('category', 'PC AIO');
                                  })->count() }}
                            </span>
                            PC/AIO
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'LAPTOP')->count() }}
                            </span>
                            Laptop
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'SERVER')->count() }}
                            </span>
                            Server
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'HARDDISK EXTERNAL')->count() }}
                            </span>
                            Hardisk External
                          </li>
                        </ul>
                      </div>

                      <div class="col-6">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'PRINTER')->count() }}
                            </span>
                            Printer
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'CCTV')->count() }}
                            </span>
                            CCTV
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where(function ($query) {
                                      $query->where('category', 'WIFI')->orWhere('category', 'ROUTER');
                                  })->count() }}
                            </span>
                            Wifi Router
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('goods')->where('category', 'SWITCH')->count() }}
                            </span>
                            Switch
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.barang.index') }}" class="btn btn-block btn-sm btn-warning">
                      Lihat Semua Asset</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Laporan Gangguan --}}
          <div class="col-xl-6 col-lg-12 col-md-12 col-12">
            <div class="card pull-up ">
              <div class="card-content primary ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h2>
                        <strong class="primary">Laporan Gangguan dalam penanganan</strong>
                      </h2>
                    </div>

                    <div>
                      <i class="la la-gears font-large-2 float-right primary"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 mx-auto">
                      <div class="table-responsive">
                        <table class="table w-100 small">
                          <thead>
                            <tr>
                              {{-- <th scope="col">No</th> --}}
                              <th scope="col">Pelapor</th>
                              <th scope="col">Tgl Laporan</th>
                              <th scope="col">Keterangan</th>
                              <th scope="col">Penerima</th>
                              {{-- <th scope="col">Tgl Selesai</th> --}}
                              {{-- <th scope="col">Keterangan</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($maintenances as $maintenance)
                              <tr>
                                {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                <td>
                                  @if ($maintenance->employee)
                                    {{ $maintenance->employee->name }}
                                  @else
                                    N/A
                                  @endif
                                </td>
                                <td> {{ Carbon\Carbon::parse($maintenance->date)->translatedFormat('d-m-Y') }}
                                <td>{{ $maintenance->description }}</td>
                                <td>{{ $maintenance->reporter }}</td>
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
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.maintenance.index') }}" class="btn btn-block btn-sm btn-primary">
                      Lihat Semua Laporan Gangguan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- jumlah Kategori Asset --}}
          <div class="col-xl-3 col-lg-6 col-md-6 col-6">
            <div class="card pull-up ">
              <div class="card-content warning ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h4>
                        <strong class="warning">Kategori Gangguan</strong>
                      </h4>
                    </div>

                  </div>
                  <div class="container">
                    <div class="row">

                      <div class="col-12">
                        <ul class="list-group">
                          <li class="list-group-item bg-grey">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('maintenances')->where('type_malfunction', 'HARDWARE')->count() }}
                            </span>
                            Hardware
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('maintenances')->where('type_malfunction', 'SOFTWARE')->count() }}
                            </span>
                            Software
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('maintenances')->where('type_malfunction', 'JARINGAN')->count() }}
                            </span>
                            Jaringan
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('maintenances')->where('type_malfunction', 'LATTOL')->count() }}
                            </span>
                            Lattol
                          </li>
                          <li class="list-group-item">
                            <span class="badge badge-pill bg-warning float-right font-medium-1">
                              {{ DB::table('maintenances')->where('type_malfunction', 'LAIN-LAIN')->count() }}
                            </span>
                            Lain-lain
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.maintenance.index') }}" class="btn btn-block btn-sm btn-warning">
                      Lihat Semua Laporan Gangguan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- top 5 --}}
          <div class="col-xl-3 col-lg-6 col-md-6 col-6">
            <div class="card pull-up ">
              <div class="card-content primary ">
                <div class="card-body">
                  <div class="media d-flex mb-1">
                    <div class="media-body text-left">
                      <h5>
                        <strong class="primary">Paling Sering Gangguan</strong>
                      </h5>
                    </div>
                  </div>

                  {{-- <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center">
                      <thead>
                        <tr>
                          <th class="sort text-center">Asset</th>
                          <th class="sort text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach ($totalMalfunctions as $item)
                          <tr>
                            <td>{{ $item->asset->name ?? '' }}</td>
                            <td>
                              {{ $item->goods_id? DB::table('maintenances')->where('goods_id', $item->goods_id)->count(): '' }}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div> --}}


                  <div class="col-12">
                    <ul class="list-group">
                      @foreach ($totalMalfunctions as $totalMalfunction)
                        @php
                          $employeeNames = [];

                          $asset = $totalMalfunction->asset;

                          // Check if $distributionAssets is not null and not empty
                          if (
                              $asset &&
                              ($distributionAssets = $asset->distribution_asset) &&
                              !empty($distributionAssets)
                          ) {
                              foreach ($distributionAssets as $distributionAsset) {
                                  $distribution = $distributionAsset->distribution;

                                  if ($distribution && ($employee = $distribution->employee)) {
                                      $employeeNames[] = $employee->name;
                                  }
                              }
                          }
                          // Use the ternary operator to set $employeeName to the last employee's name or 'N/A'
$employeeName = $employeeNames ? end($employeeNames) : 'N/A';
                        @endphp
                        <li class="list-group-item">
                          <span class="badge badge-pill bg-primary float-right font-medium-1">
                            {{ $totalMalfunction->goods_id ? DB::table('maintenances')->where('goods_id', $totalMalfunction->goods_id)->count() : '' }}
                          </span>
                          <h6>{{ $totalMalfunction->asset->name ?? '' }}
                            <p class="font-small-2">
                              ({{ $totalMalfunction->asset->barcode ?? '' }})
                              {{-- ({{ $totalMalfunction->asset->id }}) --}}
                              <br>
                              ({{ $employeeName }})
                            </p>
                          </h6>
                        </li>
                      @endforeach
                    </ul>
                  </div>

                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="{{ route('backsite.maintenance.index') }}" class="btn btn-block btn-sm btn-primary">
                      Lihat Semua Laporan Gangguan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="container">
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
          </div> --}}

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

    .media-body .attendance-info {
      display: inline-block;
      margin-right: 20px;
      /* Adjust the margin as needed */
    }
  </style>
@endpush
