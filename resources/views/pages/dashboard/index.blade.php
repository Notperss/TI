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

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
            <div class="card pull-up ">
              <div class="card-content info ">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h1 class="info">5</h1>
                      <strong>Jumlah PC</strong>
                    </div>
                    <div>
                      <i class="la la-tv font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="mt-1 mb-0 box-shadow-2">
                    <a href="#" class="btn btn-block btn-sm btn-info">
                      See More ..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-2 col-lg-3 col-md-6 col-12">
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

{{-- @push('after-style')
    <style>
        :root {
            --darkgreen: #005361;
            --white: #fff;
            /* #005361 */
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .tabs-to-dropdown .nav-wrapper {
            padding: 15px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.12);
            font-size: 17px;
        }

        .tabs-to-dropdown .nav-wrapper a {
            color: var(--darkgreen);
        }

        .tabs-to-dropdown .nav-pills .nav-link.active {
            background-color: var(--darkgreen);
        }

        .tabs-to-dropdown .nav-pills li:not(:last-child) {
            margin-right: 30px;
        }

        .tabs-to-dropdown .tab-content .container-fluid {
            max-width: 1250px;
            padding-top: 70px;
            padding-bottom: 70px;
        }

        .tabs-to-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0px 5px 14px rgba(0, 0, 0, 0.08);
        }

        .tabs-to-dropdown .dropdown-item {
            padding: 14px 28px;
        }

        .tabs-to-dropdown .dropdown-item:active {
            color: var(--white);
        }

        @media (min-width: 1280px) {
            .tabs-to-dropdown .nav-wrapper {
                padding: 15px 30px;
            }
        }
    </style>
@endpush

@push('after-script')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDwM2yJ9-rWbyfu-ldmVc8icCuePd0q8M&callback=initMap"></script>
    <script>
        function initMap() {
            // map option cctv
            let map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(-6.175392, 106.827153),
                zoom: 12,
                mapTypeControl: false,
                styles: [{
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }]
            });

            // get data cctv
            let markers = JSON.parse({!! json_encode($cctv) !!});

            $.each(markers, function(i, item) {
                let marker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.latitude, item.longitude),
                    map: map,
                    label: {
                        text: item.name,
                        color: "#000",
                        fontSize: "14px",
                        fontWeight: "bold"
                    },
                    animation: google.maps.Animation.BOUNCE,
                });

                // check for custom icon
                if (item.logo) {
                    // set icon image
                    let url = "http://172.16.55.65/TI/storage/"
                    marker.setIcon(url + item.logo);
                }

                // check content
                if (item.link_cctv) {
                    /*Google Map Marker Click Function*/
                    google.maps.event.addListener(marker, 'click', (function(marker) {
                        return function() {
                            $('#iframe').attr({
                                src: item.link_cctv,
                                width: "100%",
                                height: "450px",
                            });
                            $('#name').html(item.name);
                            $('#km').html(item.km);
                            $('#latitude').html(item.latitude);
                            $('#longitude').html(item.longitude);
                            $('#link').text('Klik disini');
                            $('#link').attr({
                                href: item.link_cctv,
                                target: "_blank",
                                class: "btn btn-sm btn-success"
                            });
                            $('#myModal').modal('show');
                        }
                    })(marker));
                    // close iframe video
                    $('#myModal').on('hidden.bs.modal', function(e) {
                        jQuery('#myModal iframe').removeAttr("src", jQuery("#myModal iframe")
                            .removeAttr("src"));
                    });
                }
            });

            // map option daily
            let daily = new google.maps.Map(document.getElementById('daily'), {
                center: new google.maps.LatLng(-6.175392, 106.827153),
                zoom: 12,
                mapTypeControl: false,
                styles: [{
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }]
            });

            // get data daily
            let activitys = JSON.parse({!! json_encode($daily_activity) !!});

            $.each(activitys, function(i, row) {
                let activity = new google.maps.Marker({
                    position: new google.maps.LatLng(row.latitude, row.longitude),
                    map: daily,
                    label: {
                        text: row.executor,
                        color: "#000",
                        fontSize: "14px",
                        fontWeight: "bold"
                    },
                    animation: google.maps.Animation.BOUNCE,
                });

                // check for custom icon
                if (row.icon) {
                    // set icon image
                    let link = "http://172.16.55.65/TI/storage/"
                    activity.setIcon(link + row.icon);
                }

                // check content
                if (row.executor) {
                    /*Google Map Marker Click Function*/
                    google.maps.event.addListener(activity, 'click', (function(activity) {
                        return function() {
                            $('#executor').html(row.executor);
                            $('#users_id').html(row.users_id);
                            $('#start_date').html(row.start_date);
                            $('#work_category_id').html(row.work_category_id);
                            $('#work_type_id').html(row.work_type_id);
                            $('#activity').html(row.activity);
                            $('#location_room_id').html(row.location_room_id);
                            $('#finish_date').html(row.finish_date);
                            $('#description').html(row.description);
                            $('#status').html(row.status == 1 ? 'Aktif' : 'Tidak Aktif');
                            $('#dailyModal').modal('show');
                        }
                    })(activity));
                }
            });

            // cctv
            const trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);
            // daily_activity
            const trafficDaily = new google.maps.TrafficLayer();
            trafficDaily.setMap(daily);
        }
    </script>
@endpush --}}
@push('after-style')
  <style>
    .pull-up {
      background: linear-gradient(to top,
          white,
          rgba(214, 212, 212, 0.678));
    }
  </style>
@endpush
