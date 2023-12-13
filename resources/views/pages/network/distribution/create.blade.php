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
                      <div class="col-md-4">
                        <button type="button" name="add" id="add" class="btn btn-success addRow mb-1">Tambah
                          data asset</button>
                      </div>
                      <table id="table" class=" table col-md-12">
                        <thead>
                          <tr>
                            <th>Asset</th>
                            <th>Category</th>
                            <th>Barcode</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- <td>
                          <tr style="display: none">
                              <select name="inputs[0][asset_id]" class="form-control asset select2" style="width: 100%">
                                <option value="" disabled selected>Choose</option>
                                @foreach ($barang as $goods)
                                  <option value="{{ $goods->id }}" data-value="{{ $goods->category }}"
                                    data-value2="{{ $goods->barcode }}">
                                    {{ $goods->name }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td><input type="text" class="form-control category" disabled></td>
                            <td><input type="text" class="form-control barcode" disabled></td>
                            <td><button type="button" name="add" id="add"
                                class="btn btn-success addRow">Add</button></td>
                          </tr> --}}
                        </tbody>
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

  {{-- <script>
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
  </script> --}}

  {{-- <script>
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
              <option value="{{ $goods->id }}" data-value="{{ $goods->category }}" data-value2="{{ $goods->barcode }}" data-name="{{ $goods->name }}">{{ $goods->name }}</option>
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
        // Get the values from the selected option
        var selectedOption = $(this).find(':selected');
        var categoryValue = selectedOption.data('value') || '';
        var barcodeValue = selectedOption.data('value2') || '';
        var nameValue = selectedOption.data('name') || '';

        // Check if the name value is unique among existing rows
        var isUnique = isNameValueUnique(nameValue, this);

        if (isUnique) {
          // Update corresponding input fields based on the selected option
          $(this).closest('tr').find('.category').val(categoryValue);
          $(this).closest('tr').find('.barcode').val(barcodeValue);

          // Disable the selected option for both parent and child
          disableOptionWithName(nameValue, this);
        } else {
          // Reset the select or take other actions for validation error
          $(this).val('').trigger('change');
          alert('Name value must be unique. Please choose a valid option.');
        }
      });

      $(document).on('click', '.remove-table-row', function() {
        // Enable the disabled options before removing the row
        var removedName = $(this).closest('tr').find('.select21 :selected').data('name') || '';
        enableOptionWithName(removedName);

        // Remove the entire row when the "Remove" button is clicked
        $(this).closest('tr').remove();
      });

      // Function to check if the name value is unique among existing rows
      function isNameValueUnique(nameValue, currentSelect) {
        var isUnique = true;

        $('.select21').not(currentSelect).each(function() {
          var existingName = $(this).find(':selected').data('name') || '';

          if (nameValue === existingName) {
            isUnique = false;
            return false; // Exit the loop early if a match is found
          }
        });

        return isUnique;
      }

      // Function to disable options with a specific name value
      function disableOptionWithName(nameValue, currentSelect) {
        $('.select21').not(currentSelect).each(function() {
          $(this).find(`option[data-name="${nameValue}"]`).prop('disabled', true);
        });
      }

      // Function to enable options with a specific name value
      function enableOptionWithName(nameValue) {
        $('.select21').each(function() {
          $(this).find(`option[data-name="${nameValue}"]`).prop('disabled', false);
        });
      }
    });
  </script> --}}

  <script>
    $(document).ready(function() {
      // Initialize Select2 for existing elements with class select21
      $('.select21').select2();

      // Set to store selected names
      var selectedNames = new Set();

      $('#add').click(function() {
        // Increment index for unique IDs
        var i = $('.select21').length + 0;

        // Append a new row
        $('#table').append(`
      <tr>
        <td>
          <select name="inputs[${i}][asset_id]" class="form-control select2 select21">
            <option value="" disabled selected>Choose</option>
            @foreach ($barang as $goods)
              <option value="{{ $goods->id }}" data-value="{{ $goods->category }}" data-value2="{{ $goods->barcode }}" data-name="{{ $goods->name }}">{{ $goods->name }}</option>
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
        // Get the values from the selected option
        var selectedOption = $(this).find(':selected');
        var categoryValue = selectedOption.data('value') || '';
        var barcodeValue = selectedOption.data('value2') || '';
        var nameValue = selectedOption.data('name') || '';

        // Check if the name value is unique among selected names
        if (!selectedNames.has(nameValue)) {
          // Update corresponding input fields based on the selected option
          var $row = $(this).closest('tr');
          $row.find('.category').val(categoryValue);
          $row.find('.barcode').val(barcodeValue);

          // Disable the selected option for both parent and child
          disableOptionWithName(nameValue, this);

          // Add the name to the set of selected names
          selectedNames.add(nameValue);
        } else {
          // Reset the select or take other actions for validation error
          $(this).val('').trigger('change');
          alert('Name value must be unique. Please choose a valid option.');
        }
      });

      $(document).on('click', '.remove-table-row', function() {
        // Enable the disabled options before removing the row
        var removedName = $(this).closest('tr').find('.select21 :selected').data('name') || '';
        enableOptionWithName(removedName);

        // Remove the name from the set of selected names
        selectedNames.delete(removedName);

        // Remove the entire row when the "Remove" button is clicked
        $(this).closest('tr').remove();
      });

      // Function to disable options with a specific name value
      function disableOptionWithName(nameValue, currentSelect) {
        $('.select21').not(currentSelect).each(function() {
          $(this).find(`option[data-name="${nameValue}"]`).prop('disabled', true);
        });
      }

      // Function to enable options with a specific name value
      function enableOptionWithName(nameValue) {
        $('.select21').each(function() {
          $(this).find(`option[data-name="${nameValue}"]`).prop('disabled', false);
        });
      }
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
