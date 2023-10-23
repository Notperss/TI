<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $software->id }}">
    <tr>
        <th>Nama Software</th>
        <td>{{ isset($software->software_name) ? $software->software_name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kategori Software</th>
        <td>
            @if ($software->software_category == 1)
                <span>{{ 'Os' }}</span>
            @elseif($software->software_category == 2)
                <span>{{ 'Office' }}</span>
            @elseif($software->software_category == 3)
                <span>{{ 'Software Lisensi' }}</span>
            @elseif($software->software_category == 4)
                <span>{{ 'Kall' }}</span>
            @elseif($software->software_category == 5)
                <span>{{ 'Lain-lain' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Tipe Software</th>
        <td>{{ isset($software->software_type) ? $software->software_type : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Varian</th>
        <td>{{ isset($software->variant) ? $software->variant : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Serial Number</th>
        <td>{{ isset($software->serial_number) ? $software->serial_number : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jumlah Lisensi</th>
        <td>{{ isset($software->license_amount) ? $software->license_amount : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Awal Lisensi</th>
        <td>{{ isset($software->start_license) ? Carbon\Carbon::parse($software->start_license)->translatedFormat('l, d F Y') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Akhir Lisensi</th>
        <td>{{ isset($software->finish_license) ? Carbon\Carbon::parse($software->finish_license)->translatedFormat('l, d F Y') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No PP</th>
        <td>{{ isset($software->no_pp) ? $software->no_pp : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tipe Lisensi</th>
        <td>
            @if ($software->license_type == 1)
                <span>{{ 'Perpetual' }}</span>
            @elseif($software->license_type == 2)
                <span>{{ 'Subscribe' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Tahun Pembelian</th>
        <td>{{ isset($software->purchase_year) ? $software->purchase_year : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($software->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($software->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Catatan</th>
        <td>{!! isset($software->description) ? $software->description : 'N/A' !!}</td>
    </tr>
</table>
<table class="table table-bordered tampildata">
</table>

<script>
    function tampilDataFile() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let id = $('#id').val();
        $.ajax({
            type: "post",
            url: "{{ route('backsite.software.show_file') }}",
            data: {
                id: id
            },
            dataType: "json",
            beforeSend: function() {
                $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.tampildata').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilDataFile();
    });
</script>
