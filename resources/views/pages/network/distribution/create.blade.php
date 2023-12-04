@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aset Deployment')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="card-header bg-success">
                  <h4 class="card-title text-white">Tambah Aset Deployment</h4>
                </div>
                <form class="form" action="{{ route('backsite.distribution.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-body container">
                    <div class="form-section">
                      <p>Isi input <code>Required (*)</code>, Sebelum menekan tombol submit. </p>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="lcoation_room_id">Ruangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="location_room_id" id="location_room_id" class="form-control select2">
                          <option value="" selected disabled>Choose</option>
                          @foreach ($location_room as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('name'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('name') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="user_id">User<code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select class="form-control select2" name="user_id" id="user_id" required>
                          <option value="" disabled selected>Choose</option>
                          @foreach ($user as $key => $user_item)
                            <option value="{{ $user_item->id }}">
                              {{ $user_item->user->name }}</option>
                          @endforeach
                          </option>
                        </select>
                        @if ($errors->has('user_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('user_id') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="date">Tanggal<code
                          style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="date" class="form-control" name="date" id="date"
                          value="{{ old('date') }}" required>
                        @if ($errors->has('date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('date') }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="file">File</label>
                      <div class="col-md-4">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file">
                          <label class="custom-file-label" for="file" aria-describedby="file">Pilih
                            @if ($errors->has('name_file'))
                              <p style="font-style: bold; color: red;">
                                {{ $errors->first('name_file') }}</p>
                            @endif
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Keterangan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-9">
                        <textarea rows="5" class="form-control summernote" id="description" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('description') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-2">Pilih Asset</div>
                      <table id="table" class="col-md-9">
                        <tr>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Barcode</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                          {{-- <td><input type="text" name="inputs[0]['name']" class="form-control"></td> --}}
                          <td>
                            <select name="inputs[0][asset_id]" id="asset_id" class="form-control asset select2"
                              style="width: 100%">
                              <option value="" disabled selected>Choose</option>
                              {{-- @foreach ($barang as $goods)
                                <option value="{{ $goods->id }}" data-value="{{ $goods->category }}"
                                  data-value2="{{ $goods->barcode }}">{{ $goods->name }}</option>
                              @endforeach --}}
                              @foreach ($barang as $goods)
                                <option value="{{ $goods->id }}" data-value="{{ $goods->category }}"
                                  data-value2="{{ $goods->barcode }}">
                                  {{ $goods->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td><input type="text" class="form-control" id="category" disabled></input>
                          </td>
                          <td><input type="text" class="form-control" id="barcode" disabled></input>
                          </td>
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button>
                          </td>
                        </tr>

                      </table>
                    </div>
                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>
                    <a href="{{ route('backsite.distribution.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

  <script>
    // var i = 0;
    // $('#add').click(function() {
    //   ++i;
    //   $('#table').append(
    //     '<tr><td><select name="inputs[' + i +
    //     '][asset_id]" id="asset_id_' + i +
    //     '" class="form-control select21"><option value="" disabled selected>Choose</option> @foreach ($barang as $goods)<option value="{{ $goods->id }}" data-value="{{ $goods->category }}"                                  data-value2="{{ $goods->barcode }}">{{ $goods->name }}</option>@endforeach</select></td><td><input type="text" class="form-control" id="category" disabled></input></td><td><input type="text" class="form-control" id="barcode" disabled></input></td><td><button type="button" class="btn btn-danger remove-table-row">Remove</button></td></tr>'
    //   );
    // })

    // $(document).on('change', '[id^="asset_id_"]', function() {
    //   var input_value1 = $(this).find(':selected').data('value');
    //   var input_value2 = $(this).find(':selected').data('value2');
    //   $(this).closest('tr').find('.category').val(input_value1);
    //   $(this).closest('tr').find('.barcode').val(input_value2);
    // });

    // $(document).on('click', '.remove-table-row', function() {
    //   $(this).parents('tr').remove();
    // })

    // var i = 0;

    // $('#add').click(function() {
    //   ++i;
    //   $('#table').append(
    //     '<tr><td><select name="inputs[' + i +
    //     '][asset_id]" id="asset_id_' + i +
    //     '" class="form-control select2"><option value="" disabled selected>Choose</option> @foreach ($barang as $goods)<option value="{{ $goods->id }}" data-value="{{ $goods->category }}" data-value2="{{ $goods->barcode }}">{{ $goods->name }}</option>@endforeach</select></td><td><input type="text" class="form-control category" id="category_' +
    //     i + '" disabled></input></td><td><input type="text" class="form-control barcode" id="barcode_' + i +
    //     '" disabled></input></td><td><button type="button" class="btn btn-danger remove-table-row">Remove</button></td></tr>'
    //   );
    //   $('#asset_id_' + i).select2();
    // });

    // $(document).on('change', '[id^="asset_id_"]', function() {
    //   var input_value1 = $(this).find(':selected').data('value');
    //   var input_value2 = $(this).find(':selected').data('value2');
    //   $(this).closest('tr').find('.category').val(input_value1);
    //   $(this).closest('tr').find('.barcode').val(input_value2);
    // });

    // $(document).on('click', '.remove-table-row', function() {
    //   $(this).closest('tr').remove();
    // });

    $(document).ready(function() {
      // Initialize Select2 for existing elements with class select21
      $('.select21').select2();

      $('#add').click(function() {
        // Increment index for unique IDs
        var i = $('.select21').length + 1;

        // Append a new row
        $('#table').append(`
      <tr>
        <td>
          <select name="inputs[${i}][asset_id]" class="form-control select2 select21">
            <option value="" disabled selected>Choose</option>
            @foreach ($barang as $goods)
              <option value="{{ $goods->id }}" data-value="{{ $goods->category }}" data-value2="{{ $goods->barcode }}">{{ $goods->name }}</option>
            @endforeach
          </select>
        </td>
        <td><input type="text" class="form-control category" disabled></td>
        <td><input type="text" class="form-control barcode" disabled></td>
        <td><button type="button" class="btn btn-danger remove-table-row">Remove</button></td>
      </tr>
    `);

        // Initialize Select2 for the newly added select element
        $(`.select21:last`).select2();
      });

      $(document).on('change', '.select21', function() {
        // Update corresponding input fields based on the selected option
        var selectedOption = $(this).find(':selected');
        $(this).closest('tr').find('.category').val(selectedOption.data('value') || '');
        $(this).closest('tr').find('.barcode').val(selectedOption.data('value2') || '');
      });

      $(document).on('click', '.remove-table-row', function() {
        // Remove the entire row when the "Remove" button is clicked
        $(this).closest('tr').remove();
      });
    });
  </script>
@endsection
@push('after-style')
  <link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('after-script')
  <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $('#asset_id').on('change', function() {
      var input_value = $(this).find(':selected').data('value');;
      $('#category').val(input_value);
      var input_value = $(this).find(':selected').data('value2');;
      $('#barcode').val(input_value);
    });
  </script>
@endpush
