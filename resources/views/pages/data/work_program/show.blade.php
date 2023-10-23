{{-- <div class="container">

    <div class="col-md-4">

        <table class="table table-bordered">
            <tr>
                <th>Program Kerja</th>
                <td>
                    @if ($work_program->work_program == 1)
                        <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
                    @elseif($work_program->work_program == 2)
                        <span class="badge badge-warning">{{ 'Hardware' }}</span>
                    @elseif($work_program->work_program == 3)
                        <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
                    @elseif($work_program->work_program == 4)
                        <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
                    @elseif($work_program->work_program == 5)
                        <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
                    @else
                        <span>{{ 'N/A' }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tahun</th>
                <td>{{ isset($work_program->year) ? $work_program->year : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Umum</th>
                <td>{{ isset($work_program->general) ? $work_program->general : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Teknis</th>
                <td>{{ isset($work_program->technical) ? $work_program->technical : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Progress</th>
                <td>{{ isset($work_program->progress) ? $work_program->progress : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if ($work_program->status == 1)
                        <span class="badge badge-success">{{ 'Aktif' }}</span>
                    @elseif($work_program->status == 2)
                        <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                    @else
                        <span>{{ 'N/A' }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{!! isset($work_program->description) ? $work_program->description : 'N/A' !!}
                </td>
            </tr>
        </table>

    </div>

</div> --}}
<div class="container" style="overflow-wrap: break-word">
    <div class="row mt-2">
        <div class="col-sm-3">
            <strong> Program Kerja</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            @if ($work_program->work_program == 1)
                <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
            @elseif($work_program->work_program == 2)
                <span class="badge badge-warning">{{ 'Hardware' }}</span>
            @elseif($work_program->work_program == 3)
                <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
            @elseif($work_program->work_program == 4)
                <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
            @elseif($work_program->work_program == 5)
                <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong>Tahun</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            {{ isset($work_program->year) ? $work_program->year : 'N/A' }}
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-sm-3">
            <strong>Umum</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-md-8">
            {{ isset($work_program->general) ? $work_program->general : 'N/A' }}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong>Teknis</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-8">
            {{ isset($work_program->technical) ? $work_program->technical : 'N/A' }}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong> Progress</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            {{ isset($work_program->progress) ? $work_program->progress : 'N/A' }}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong>Status</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            @if ($work_program->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($work_program->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong>Keterangan</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-8">
            {!! isset($work_program->description) ? $work_program->description : 'N/A' !!}
        </div>
    </div>

</div>
