<div class="container" style="overflow-wrap: break-word">
    <div class="row mt-2">
        <div class="col-sm-3">
            <strong> Program Kerja</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            @if ($jobdesk->jobdesk == 1)
                <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
            @elseif($jobdesk->jobdesk == 2)
                <span class="badge badge-warning">{{ 'Hardware' }}</span>
            @elseif($jobdesk->jobdesk == 3)
                <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
            @elseif($jobdesk->jobdesk == 4)
                <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
            @elseif($jobdesk->jobdesk == 5)
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
            {{ isset($jobdesk->year) ? $jobdesk->year : 'N/A' }}
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
            {{ isset($jobdesk->general) ? $jobdesk->general : 'N/A' }}
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
            {{ isset($jobdesk->technical) ? $jobdesk->technical : 'N/A' }}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-3">
            <strong> Jenis</strong>
        </div>
        <div class="">
            :
        </div>
        <div class="col-sm-5">
            @if ($jobdesk->status == 1)
                <span class="badge badge-success">{{ 'Rutin' }}</span>
            @elseif($jobdesk->status == 2)
                <span class="badge badge-danger">{{ 'Target' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
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
            @if ($jobdesk->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($jobdesk->status == 2)
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
            {!! isset($jobdesk->description) ? $jobdesk->description : 'N/A' !!}
        </div>
    </div>

</div>
