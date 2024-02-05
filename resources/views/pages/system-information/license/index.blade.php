@extends('layouts.app')

{{-- set title --}}
@section('title', 'Lisensi')

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
          <h3 class="content-header-title mb-0 d-inline-block">Lisensi</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Lisensi</li>
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

              <a href="{{ route('backsite.license.create') }}" class="btn btn-success col-2 mb-2">
                Tambah Data Lisensi</a>
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
                  <h4 class="card-title">List Aplikasi</h4>
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
                  <button id="filterButton" class="btn btn btn-primary mb-1">Filter Tanggal Berakhir</button>

                  <div class="table-responsive">
                    <table class="table table-striped table-bordered text-inputs-searching default-table activity-table"
                      id="license-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Aplikasi</th>
                          <th>Jumlah Lisensi</th>
                          <th>Versi</th>
                          <th>Barcode</th>
                          <th>Tanggal Berakhir</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot hidden>
                        <th>No</th>
                        <th>Nama Aplikasi</th>
                        <th>Jumlah Lisensi</th>
                        <th>Versi</th>
                        <th>Barcode</th>
                        <th>Tanggal Berakhir</th>
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
  <div class="viewmodal" style="display: none;"></div>
  <!-- END: Content-->
@endsection
@push('after-style')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('after-script')
  <script></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    var dateFilterActive = false; // Variable to track whether date filter is active

    var table = $('#license-table').DataTable({
      processing: true,
      serverSide: true,
      ordering: false,
      lengthChange: false,
      "pageLength": 15,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'copy',
          className: "btn btn-info"
        },
        {
          extend: 'excel',
          className: "btn btn-info"
        },
        {
          extend: 'print',
          className: "btn btn-info",
          exportOptions: {
            columns: ':not(.no-print)' // Exclude elements with class 'no-print'
          }
        },
      ],
      ajax: {
        url: "{{ route('backsite.license.index') }}",
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
          data: 'name_app',
          name: 'name_app',
        },
        {
          data: 'num_of_licenses',
          name: 'num_of_licenses',
        },
        {
          data: 'version',
          name: 'version',
        },
        {
          data: 'barcode',
          name: 'barcode',
        },
        {
          data: 'date_finish',
          name: 'date_finish',
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


    function upload(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.license.form_upload') }}",
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
  </script>

  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="width:90%" role="document">
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
