@extends('layouts.app')
@section('title', 'Users')
@section('content')

  {{-- @section('breadcrumb')
  <x-breadcrumb title="User Management" page="Access Management" active="User Management" route="{{ route('user.index') }}" />
@endsection --}}
  <!-- Content -->
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
      <div class="content-body">

        <section class="section">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center ">
                <h4 class="fw-normal mb-0 text-body">Users</h4>
                @can('user.store')
                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                    data-target="#modal-form-add-user">
                    <i class="bi bi-plus-lg"></i>
                    Add
                  </button>
                @endcan

              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap mx-2">
                <table class="table table-bordered " id="table1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NIK</th>
                      <th>User</th>
                      <th>Job Position</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th class="text-center">Icon</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->job_position }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @foreach ($user->roles as $role)
                            <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                          @endforeach
                        </td>

                        <td>
                          @if (!blank($user->email_verified_at))
                            <span class="badge bg-primary me-1">Active</span>
                          @else
                            <span class="badge bg-danger me-1">Inactive</span>
                          @endif
                        </td>
                        <td class="text-center">
                          @if ($user->icon)
                            <img src="{{ asset('storage/' . $user->icon) }}" alt="Icon User" width="50px">
                          @else
                            No Image
                          @endif
                        </td>
                        <td>
                          <div class="demo-inline-spacing">
                            @can('user.update')
                              <a data-toggle="modal" data-target="#modal-form-edit-user-{{ $user->id }}"
                                class="btn btn-sm btn-secondary text-white">
                                Edit
                              </a>
                              @include('management-access.user.modal-edit')
                            @endcan

                            @can('user.destroy')
                              <a onclick="deleteUser('{{ $user->id }}')" title="Delete"
                                class="btn btn-sm btn-danger text-white">
                                Hapus
                              </a>
                              <form id="deleteForm_{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
                                method="POST">
                                @method('DELETE')
                                @csrf
                              </form>
                            @endcan
                          </div>

                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr hidden>
                      <th>No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Type User</th>
                      <th>Job Position</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>
  </div>
  <!-- / Content -->

  <!--/ Basic Bootstrap Table -->
  @include('management-access.user.modal-create')
  <script>
    function deleteUser(userId) {
      if (confirm('Are you sure you want to delete this User?')) {
        document.getElementById('deleteForm_' + userId).submit();
      }
    }
  </script>

@endsection

@push('after-script')
  <script>
    $('#table1').DataTable({
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
