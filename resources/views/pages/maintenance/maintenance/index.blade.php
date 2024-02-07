@extends('layouts.app')

{{-- set title --}}
@section('title', 'Laporan Gangguan')

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
          <h3 class="content-header-title mb-0 d-inline-block">Laporan Gangguan</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Laporan Gangguan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('backsite.maintenance.create') }}" class="btn btn-success col-2 mb-1">Tambah Data Laporan
        Gangguan</a>
      <div class="card">


        {{-- table card --}}
        <div class="content-body">
          <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">List Laporan Gangguan</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                      </ul>
                    </div>
                  </div>

                  <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                      <div class="table-responsive">
                        <table id="information-table"
                          class="table table-striped table-bordered text-inputs-searching default-table">
                          <thead>
                            <tr>
                              <th style="text-align:center; width:100px;">No</th>
                              <th class="text-center">Nomor Laporan</th>
                              <th class="text-center">User PC</th>
                              <th class="text-center">Tgl Laporan</th>
                              <th class="text-center">Keterangan</th>
                              <th class="text-center">Status</th>
                              <th style="text-align:center; width:150px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot hidden>
                            <tr>
                              <th>No</th>
                              <th>Laporan Gangguan</th>
                              <th>Keterangan</th>
                              <th>Status</th>
                              <th>Action</th>
                              <th>Action</th>
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
      </div>
    </div>
  </div>
  <div class="viewmodal" style="display: none;"></div>

  <!-- END: Content-->
@endsection
@push('after-style')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
@endpush
@push('after-script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    var datatable = $('#information-table').dataTable({
      processing: true,
      serverSide: true,
      ordering: false,
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
        url: "{{ route('backsite.maintenance.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          width: '5%',
          orderable: false,
          searchable: false,
        },

        {
          data: 'report_number',
          name: 'report_number',
          width: '10%',
        },
        {
          data: 'employee_id',
          name: 'employee_id',
        },
        {
          data: 'date',
          name: 'date',
        },
        {
          data: 'description',
          name: 'description',
        },
        {
          data: 'stats',
          name: 'stats',
          width: '5%',
          render: function(data) {
            if (data === '0') {
              return '<span>N/A</span>';
            } else if (data === '1') {
              return '<span class="badge bg-info">Open</span>';
            } else if (data === '2') {
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
          className: 'no-print'
        },
      ],
      columnDefs: [{
        className: 'text-center',
        targets: '_all'
      }, ],
    });

    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
    });
  </script>
  <script>
    function update(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.maintenance.form_update_status') }}",
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

    function analysis(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url: "{{ route('backsite.maintenance.form_analysis') }}",
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

    function fixing(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
          type: "post",
          url: "{{ route('backsite.maintenance.fixing') }}",
          data: {
            id: id
          },
          dataType: "json"
        })
        .done(function(response) {
          handleSuccess(response);
        })
        .fail(function(xhr, status, error) {
          handleAjaxError(xhr.responseText);
        });
    }

    // Function to handle success response
    function handleSuccess(response) {
      // Update UI or perform other actions based on the response
      console.log(response);

      // Check if the response indicates success
      if (response.success) {
        // Display success message using SweetAlert
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: response.message
        }).then((result) => {
          // Reload the page or go back in history after the user dismisses the alert
          if (result.isConfirmed || result.isDismissed) {
            window.location.reload(); // Reload the page
            // OR
            // window.history.back(); // Go back in history
          }
        });
        // Additional logic if needed
      } else {
        // Display an error message using SweetAlert
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message
        });
        // Additional error handling logic if needed
      }
    }
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
