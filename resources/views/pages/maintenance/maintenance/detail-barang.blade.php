@extends('layouts.app')

{{-- set title --}}
@section('title', 'Detail Barang')

@section('content')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      {{-- breadcumb --}}
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Detail Barang</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">{{ $barang->name }}</li>
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
              {{-- <a href="" class="btn btn-success col-2 mb-0">Tambah Data
                User PC </a> --}}
              <div class="card">
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
                  <h4 class="card-title">Detail Barang {{ $barang->name }}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      {{-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> --}}
                      <li><a id="expandLink" data-action="expand" data><i class="ft-maximize"></i></a></li>
                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    </ul>
                  </div>
                </div>

                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-bordered">
                      {{-- <input type="hidden" name="id" id="id" value="{{ $barang->id }}"> --}}
                      <tr>
                      <tr>
                        <th>Barcode</th>
                        <td>{{ isset($barang->barcode) ? $barang->barcode : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Nama Barang</th>
                        <td>{{ isset($barang->name) ? $barang->name : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Kategori</th>
                        <td>{{ isset($barang->category) ? $barang->category : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Merk</th>
                        <td>{{ isset($barang->brand) ? $barang->brand : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Tahun</th>
                        <td>{{ isset($barang->year) ? $barang->year : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>SKU</th>
                        <td>{{ isset($barang->sku) ? $barang->sku : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Tipe Asset</th>
                        <td>{{ isset($barang->type_assets) ? $barang->type_assets : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Ukuran</th>
                        <td>{{ isset($barang->size) ? $barang->size : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>
                          @if ($barang->stats == '')
                            <span>N/A</span>';
                          @elseif ($barang->stats == '5')
                            <h5><span class="badge bg-secondary">Rusak</span></h5>
                          @elseif ($barang->stats == '4')
                            <h5><span class="badge bg-primary">Diserahkan</span></h5>
                          @elseif ($barang->stats == '3')
                            <h5><span class="badge bg-warning">Perbaikan</span></h5>
                          @elseif ($barang->stats == '2')
                            <h5><span class="badge bg-danger">Dipakai</span></h5>
                          @elseif ($barang->stats == '1')
                            <h5><span class="badge bg-info">Available</span></h5>
                          @else
                            <h5><span> - </span></h5>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>Keterangan</th>
                        <td>{{ isset($barang->description) ? $barang->description : 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Gambar</th>
                        @if ($barang->file)
                          <td>
                            <img src="{{ asset('storage/' . $barang->file) }}" class="block mb-1" style="width: 75%"
                              alt="">
                            <a type="button" data-fancybox data-src="{{ asset('storage/' . $barang->file) }}"
                              class="btn btn-info btn-sm inline text-white">
                              Lihat
                            </a>
                            <a type="button" href="{{ asset('storage/' . $barang->file) }}"
                              class="btn btn-warning btn-sm text-white" download>
                              Unduh
                            </a>
                            <br>
                            <p class="mt-1">Latest File : {{ pathinfo($barang->file, PATHINFO_FILENAME) }}</p>
                          @else
                          <td> N/A</td>
                        @endif
                        </td>
                        </td>
                      </tr>
                    </table>
                    {{-- <button>oisjapjf</button> --}}
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
    // Wait for the document to be ready
    $(document).ready(function() {
      // Add a click event handler to the expandLink element
      $('#expandLink').on('click', function() {
        // Perform actions to auto-expand the page here
        // For example, you might show/hide elements, adjust styles, etc.
        // You can use additional JavaScript or jQuery code as needed
        console.log('Page is expanded!');
      });

      // Trigger the click event programmatically to auto-expand the page on load
      $('#expandLink').trigger('click');
    });
  </script>
  <script>
    jQuery(document).ready(function($) {
      $('#mymodal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);

        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

    });

    $('.default-table').DataTable({
      "order": [],
      "paging": true,
      "lengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "pageLength": 10
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
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
