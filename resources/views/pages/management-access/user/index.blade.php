@extends('layouts.app')

{{-- set title --}}
@section('title', 'User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('backsite.user.create') }}" class="btn btn-success col-2 mb-2">
                Tambah User Aplikasi</a>

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User List</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="table-responsive ">
                                            <table
                                                class="table table-striped table-bordered text-inputs-searching default-table  bg-info">
                                                <thead class="default">
                                                    <tr class="text-white">
                                                        <th style="text-align:center; width:50px;">No</th>
                                                        <th class="text-center">NIK</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">Type User</th>
                                                        <th class="text-center">Job Position</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Icon</th>
                                                        <th style="text-align:center; width:50px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($user as $key => $user_item)
                                                        <tr data-entry-id="{{ $user_item->id }}">
                                                            <td class="text-center ">{{ $loop->iteration }}</td>
                                                            <td class=" text-center h5 "> <span
                                                                    class="badge badge-info font-weight-bold">
                                                                    {{ $user_item->detail_user->nik ?? '' }}</span>
                                                            </td>
                                                            <td class="text-center">{{ $user_item->name ?? '' }}</td>
                                                            <td class="text-center">{{ $user_item->email ?? '' }}</td>
                                                            <td class="text-center">
                                                                @if ($user_item->detail_user->type_user_id == 0 ? 'selected' : '')
                                                                    <span>{{ 'N/A' }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-success mr-1 mb-1">{{ $user_item->detail_user->type_user->name ?? '' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($user_item->detail_user->job_position == 1 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-success">{{ 'Manager' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 2 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-cyan">{{ 'Kepala Departemen' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 3 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Administrasi' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 4 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-warning">{{ 'Hardware & Jaringan' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 5 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-secondary">{{ 'Peralatan Tol' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 6 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-info">{{ 'Sistem Informasi' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 7 ? 'selected' : '')
                                                                    <span
                                                                        class="badge badge-primary">{{ 'Senior Officer' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($user_item->detail_user->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($user_item->detail_user->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center"><img
                                                                    src="{{ asset('storage/' . $user_item->detail_user->icon) }}"
                                                                    alt="Icon User" width="50px">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.user.edit', encrypt($user_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.user.destroy', encrypt($user_item->id)) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <input type="hidden" name="_token"
                                                                                value="{{ csrf_token() }}">
                                                                            <input type="submit" class="dropdown-item"
                                                                                value="Delete">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{-- not found --}}
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr hidden>
                                                        <th>No</th>
                                                        <th>Nik</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Type User</th>
                                                        <th>Job Position</th>
                                                        <th>Status</th>
                                                        <th>Icon</th>
                                                        <th>Action</th>
                                                    </tr>
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
    <!-- END: Content-->

@endsection

@push('after-script')
    <script>
        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10
        });
    </script>
@endpush
