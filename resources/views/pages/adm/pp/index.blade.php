@extends('layouts.app')

{{-- set title --}}
@section('title', 'PR')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- error --}}
      @if ($errors->any())
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
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
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">PR</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">PR</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      {{-- add card --}}
      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">

              <a href="{{ route('backsite.pp.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Data PR</a>
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
                  <h4 class="card-title">List PR</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-body card-dashboard">

                  <div class="col col-5 mb-1">
                    <div id="daterange-container" class="float-end" style="display: none;">
                      <div id="daterange"
                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                        <i class="la la-calendar"></i>&nbsp;
                        <span></span>
                        <i class="la la-caret-down"></i>
                      </div>
                    </div>
                  </div>
                  <button id="filterButton" class="btn btn btn-primary mb-1">Filter Tanggal</button>


                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
                      id="pp-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th
                            style="display: {{ in_array(Auth::user()->detail_user->job_position, [1, 3]) || Auth::user()->detail_user->nik == 'M0203002' ? '' : 'none' }}">
                            User</th>
                          <th>No PR</th>
                          <th>Tahun</th>
                          <th>Pekerjaan</th>
                          <th>Nominal PP</th>
                          <th>Tanggal</th>
                          <th>Dokumentasi Status</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot hidden>
                        <th>no</th>
                        <th style="display: none">No PP</th>
                        <th>No PP</th>
                        <th>Tahun</th>
                        <th>Pekerjaan</th>
                        <th>tanggal</th>
                        <th>Nominal</th>
                        <th>Status</th>
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
  <div class="viewmodal" style="display: none;"></div>
  <!-- END: Content-->
@endsection
@push('after-style')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('after-script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    var dateFilterActive = false; // Variable to track whether date filter is active

    var table = $('#pp-table').DataTable({
      processing: true,
      serverSide: true,
      ordering: false,
      lengthChange: false,
      dom: 'Bfrtip',
      lengthMenu: [10, 25, 50, 75, 100, 250],
      buttons: [{
          extend: 'copy',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'excel',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'print',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
        {
          extend: 'pageLength',
          className: "btn btn-info",
        },
      ],
      ajax: {
        url: "{{ route('backsite.pp.index') }}",
        data: function(data) {
          if (dateFilterActive) {
            data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
          }
        }
      },

      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          width: '3%',
        },
        {
          name: 'username',
          data: 'username',
          visible: false,

        },
        {
          data: 'no_pp',
          name: 'no_pp',
        },
        {
          data: 'year',
          name: 'year',
        },
        {
          data: 'job_name',
          name: 'job_name',
        },
        {
          data: 'job_value',
          name: 'job_value',
          render: function(data) {
            return 'Rp. ' + data + ' ';
          }
        },
        {
          data: 'date',
          name: 'date',
        },
        {
          data: 'dokumentasiStats',
          name: 'dokumentasiStats',
        },
        {
          data: 'stats',
          name: 'stats',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === '2') {
              return '<span class="badge bg-success">Open</span>';
            } else if (data === '1') {
              return '<span class="badge bg-danger">Closed</span>';
            } else {
              return '-';
            }
          }
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          width: '15%',
          className: 'no-print' // Add this class to exclude the column from printing

        },
      ],
      createdRow: function(row, data, dataIndex) {
        if (data.detail_user && data.detail_user.job_position === 1) {
          table.column('username:name').visible(true);
        }
      },
      columnDefs: [{
        className: 'text-center',
        targets: '_all'
      }, ],
    });

    // Add a filter button
    $('#filterButton').on('click', function() {
      // Toggle the date filter status
      dateFilterActive = !dateFilterActive;

      // Show/hide the date range picker container based on the filter status
      $('#daterange-container').toggle(dateFilterActive);

      if (dateFilterActive) {
        // Initialize date range picker if the filter is active
        var start_date = moment().subtract(1, 'M');
        var end_date = moment().add(1, 'day');

        $('#daterange').daterangepicker({
          startDate: start_date,
          endDate: end_date
        }, function(new_start_date, new_end_date) {
          // Update the displayed date range
          updateDateRange(new_start_date, new_end_date);

          // Redraw the table if needed
          if (new_start_date && new_end_date) {
            table.draw();
          } else {
            // If no date is selected, display all data
            table.clear().draw();
          }
        });

        // Update the displayed date range
        updateDateRange(start_date, end_date);
      } else {
        // If the filter is not active, clear the date range picker and display all data
        $('#daterange').data('daterangepicker').remove();
        table.clear().draw();
      }
    });

    function updateDateRange(start_date, end_date) {
      if (start_date && end_date) {
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
      } else {
        $('#daterange span').html('All Data');
      }
    }


    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
    });

    // $('.default-table').DataTable({
    //     "order": [],
    //     "paging": true,
    //     "lengthMenu": [
    //         [5, 10, 25, 50, 100, -1],
    //         [5, 10, 25, 50, 100, "All"]
    //     ],
    //     "pageLength": 10
    // });

    // fancybox
    Fancybox.bind('[data-fancybox="gallery"]', {
      infinite: false
    });

    // test caseman
    // function link() {
    //     let windowPopUp = window.open('http://google.com', "Test Page", "width=800,height=800");

    //     windowPopUp.focus();
    // }

    function upload(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.pp.form_upload') }}",
        data: {
          id: id
        },
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#upload').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }

    function add_status(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.pp.form_status') }}",
        data: {
          id: id
        },
        dataType: "json",
        success: function(response) {
          $('.viewmodal').html(response.data).show();
          $('#upload').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }

    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa spin"></i>
        </div>
      </div>
    </div>
  </div>
@endpush
