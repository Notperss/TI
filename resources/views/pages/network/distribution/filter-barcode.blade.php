<div class="row justify-content-center">
  <div id="assetsTable">
    <div class="container ml-2">
      <div class="col-12">
        <form id="filterForm">
          <div class="form-group row">
            <div class="col-md-1 label-control">Filter by:</div>
            <div class="col-md-3">
              <select name="name" id="name" class="form-control select22" style="width: 100%">
                <option value="" disabled selected>User</option>
                @foreach ($employee as $employee_item)
                  <option value="{{ $employee_item->name }}">{{ $employee_item->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <select name="category" id="category" class="form-control select22" style="width: 100%">
                <option value="" disabled selected>Category</option>
                <option value="PC">PC</option>
                <option value="PC AIO">PC AIO</option>
                <option value="MONITOR">Monitor</option>
                <option value="TV">TV</option>
                <option value="PROYEKTOR">Proyektor</option>
                <option value="SCANNER">Scanner</option>
                <option value="PRINTER">Printer</option>
                <option value="PRINTER AIO">Printer AIO</option>
                <option value="SWITCH">Switch</option>
                <option value="MIKROTIK">Mikrotik</option>
                <option value="WIFI">WiFi</option>
                <option value="CONVERTER FO">Converter FO</option>
                <option value="SERVER">Server</option>
                <option value="NAS">NAS</option>
                <option value="CAMERA">Camera</option>
                <option value="MIC">Mic</option>
                <option value="SPEAKER">Speaker</option>
                <option value="UPS">UPS</option>
                <option value="CCTV">CCTV</option>
                <option value="IP PHONE">IP Phone</option>
                <option value="HARDDISK EXTERNAL">Hard Disk External</option>
                <option value="VGA CARD">VGA Card</option>
                <option value="LAPTOP">Laptop</option>
                <option value="PART PC">Part PC</option>
                <option value="PART SERVER">Part Server</option>
                <option value="PART NETWORK">Part Network</option>
                <option value="TOOLS">Tools</option>
                <option value="MR">Mobile Reader</option>
                <option value="PDB">Panel Distribution Box</option>
                <option value="CDP">Customer Display Panel</option>
                <option value="ALB">Automatic Lane Barrier</option>
                <option value="LPR">Thermal Printer</option>
                <option value="TCT">Toll Collection Terminal</option>
                <option value="OBS">Optical Beam Sensor</option>
                <option value="LTS">LTS</option>
              </select>
            </div>

            <div class="col-md-3">
              <select name="location" id="location" class="form-control select22" style="width: 100%">
                <option value="" disabled selected>Location</option>
                @foreach ($locations as $location_item)
                  <option value="{{ $location_item->name }}">{{ $location_item->name }} =>
                    {{ $location_item->sub_location->name }} => {{ $location_item->location->name }}</option>
                @endforeach
              </select>
            </div>

            <button type="button" class="btn btn-success text-center" onclick="filterAssets()">Filter</button>
          </div>

        </form>
      </div>
    </div>

    <div class="row justify-content-center">
      <button class="btn btn-info text-center" onclick='printAllQRCodes();'>Print All</button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-11">
        <table class="table table-striped table-bordered text-inputs-searching default-table">
          <thead>
            <tr>
              <th style="text-align:center; width:20px;">No</th>
              <th class="text-center">Barcode</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">User</th>
              <th class="text-center">Location</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($assets as $item)
              {{-- @php
            $employeeNames = [];
            $distributionAssets = $item->distribution_asset;

            foreach ($distributionAssets as $distributionAsset) {
                $distribution = $distributionAsset->distribution;

                if ($distribution && ($employee = $distribution->employee)) {
                    $employeeNames[] = $employee->name;
                }
            }

            // Concatenate employee names with a separator (e.g., comma)
            $employeeName = end($employeeNames);

          @endphp
          @php
            $location_roomNames = [];
            $distributionAssets = $item->distribution_asset;

            foreach ($distributionAssets as $distributionAsset) {
                $distribution = $distributionAsset->distribution;

                if ($distribution && ($location_room = $distribution->location_room)) {
                    $location_roomNames[] = $location_room->name;
                }
            }

            // Concatenate location_room names with a separator (e.g., comma)
            $location_roomName = end($location_roomNames);

          @endphp --}}
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center h5">
                  {{ $item->asset->barcode ?? '' }}
                </td>
                <td class="text-center">
                  {{ $item->asset->category ?? '' }}
                </td>
                <td class="text-center">
                  {{-- {{ $employeeName }} --}}
                  {{ $item->distribution->employee->name ?? '' }}
                </td>
                <td class="text-center">
                  {{-- {{ $location_roomName }} --}}
                  {{ $item->distribution->location_room->name ?? '' }}
                </td>
              </tr>
              <div class="qr-code-container" hidden>
                <div style="text-align: center;">
                  {!! QrCode::size(170)->style('round')->generate(route('detailBarang', $item->id)) !!}
                  <p style="margin: 0;">{{ $item->asset->barcode ?? '' }}</p>
                  <p style="margin: 0;">{{ $item->asset->category ?? '' }}</p>
                  <p style="margin: 0;">{{ $item->asset->name ?? '' }}</p>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    // Initialize Select2
    $('.select22').select2();
  });
</script>


<script>
  function printAllQRCodes() {
    var qrCodeContainers = document.querySelectorAll('.qr-code-container');
    var newWin = window.open('', 'Print-Window');

    newWin.document.open();
    newWin.document.write('<html><body>');

    qrCodeContainers.forEach(function(container, index) {
      newWin.document.write(container.innerHTML);

      // Add a page break after each QR code, except for the last one
      if (index < qrCodeContainers.length - 1) {
        newWin.document.write('<div style="page-break-before: always;"></div>');
      }
    });

    newWin.document.write('</body></html>');
    newWin.document.close();

    setTimeout(function() {
      newWin.print();
      newWin.close();
    }, 10);
  }

  $('.default-table').DataTable({
    "order": [],
    "bDestroy": true,
    "searching": false,
    "paging": true,
    "lengthMenu": [
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "All"]
    ],
    "pageLength": 10,
  });
</script>

<script>
  function filterAssets() {
    var formData = $('#filterForm').serialize();

    $.ajax({
      url: "{{ route('backsite.distribution.filter_barcode', ['id' => $id]) }}",
      type: 'GET',
      data: formData,
      success: function(response) {
        // Update the assets table with the filtered data
        $('#assetsTable').html(response);
      },
      error: function(xhr) {
        console.error('Error:', xhr);
      }
    });
  }
</script>
