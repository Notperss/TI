@extends('layouts.app')
@section('title', 'Roles')
@section('content')

  {{-- @section('breadcrumb')
  <x-breadcrumb title="Roles Management" page="Roles & Permissions" active="Roles Management"
    route="{{ route('role.index') }}" />
@endsection --}}
  <!-- Content -->

  {{-- <div class="container-xxl flex-grow-1 container-p-y">

    <p class="mb-6">A role provided access to predefined menus and features so that depending on assigned role an
      administrator can have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-6">

      @foreach ($roles as $role)
        <div class="col-xl-4 col-lg-6 col-md-6 my-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-normal mb-0 text-body">Total {{ $role->users->count() }} users</h6>
                @can('role.destroy')
                  <a onclick="showSweetAlert('{{ $role->id }}')" class="justify-content-end" title="delete role">
                    <i class="bi bi-x"></i>
                  </a>
                @endcan
              </div>
              <form id="deleteForm_{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST">
                @method('DELETE')
                @csrf
              </form>

              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h5 class="mb-1">{{ $role->name }}</h5>
                  @can('role.update')
                    <a href="javascript:;" data-toggle="modal" data-target="#editRoleModal-{{ $role->id }}"
                      class="role-edit-modal"><span>Edit Role</span></a>
                    @include('management-access.role.modal-edit')
                  @endcan
                </div>
                <a href="javascript:void(0);"><i class="bx bx-copy bx-md text-muted"></i></a>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      @can('role.store')
        <div class="col-xl-4 col-lg-6 col-md-6 my-3">
          <div class="card h-70">
            <div class="row h-100">
              <div class="col-sm-5">
                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
                  <img src="{{ asset('img/man-with-laptop-light.png') }}" class="img-fluid" alt="img" width="120">
                </div>
              </div>
              <div class="col-sm-7">
                <div class="card-body text-sm-end text-center ps-sm-0">
                  <button data-target="#addRoleModal" data-toggle="modal"
                    class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New Role</button>
                  <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endcan

      <section class="section">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="fw-normal mb-0 text-body card-title">User</h4>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive text-nowrap mx-2">
              <table class="table" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @foreach ($user->roles as $role)
                          <span class="badge bg-info me-1">{{ $role->name }}</span>
                        @endforeach
                      </td>
                      <td>
                        @if (!blank($user->email_verified_at))
                          <span class="badge bg-primary me-1">Active</span>
                        @else
                          <span class="badge bg-danger me-1">Inactive</span>
                        @endif
                      </td>
                      <td>
                        <div class="demo-inline-spacing">
                          @can('user.update')
                            <a data-toggle="modal" data-target="#modal-form-edit-user-{{ $user->id }}"
                              class="btn btn-sm btn-secondary text-white">
                              <i data-feather="edit"></i>
                            </a>
                            @include('management-access.user.modal-edit')
                          @endcan

                          @can('user.destroy')
                            <a onclick="showSweetAlert('{{ $user->id }}')" title="Delete"
                              class="btn btn-sm btn-danger text-white">
                              <i data-feather="trash"></i>
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
              </table>
            </div>
          </div>
        </div>
      </section>

    </div>
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    @include('management-access.role.modal-create')
    <!--/ Add Role Modal -->

  </div>
  <!-- / Content -->

  <script>
    function showSweetAlert(getId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // If the user clicks "Yes, delete it!", submit the corresponding form
          document.getElementById('deleteForm_' + getId).submit();
        }
      });
    }
  </script>

@endsection --}}


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

      {{-- table card --}}
      <div class="content-body">
        <section id="table-home">
          <!-- Zero configuration table -->
          <div class="row">
            @foreach ($roles as $role)
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h6 class="fw-normal mb-0 text-body">Total {{ $role->users->count() }} users</h6>
                      @can('role.destroy')
                      @endcan
                      <a href="javascript:void(0);" onclick="deleteRole({{ $role->id }})" class="justify-content-end"
                        title="Delete Role">
                        x
                      </a>
                    </div>
                    <form id="deleteForm_{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}"
                      method="POST">
                      @method('DELETE')
                      @csrf
                    </form>

                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h5 class="mb-1">{{ $role->name }}</h5>
                        @can('role.update')
                        @endcan
                        <a href="javascript:;" data-toggle="modal" data-target="#editRoleModal-{{ $role->id }}"
                          class="role-edit-modal"><span>Edit Role</span></a>
                        @include('management-access.role.modal-edit')
                      </div>
                      <a href="javascript:void(0);"><i class="bx bx-copy bx-md text-muted"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            @can('role.store')
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-70">
                  <div class="row h-100">
                    <div class="col-sm-5">
                      <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
                        <img src="{{ asset('img/man-with-laptop-light.png') }}" class="img-fluid" alt="img"
                          width="120">
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-target="#addRoleModal" data-toggle="modal"
                          class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New Role</button>
                        <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endcan
          </div>

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


        </section>
      </div>

    </div>
  </div>

  @include('management-access.role.modal-create')
  <!-- END: Content-->
  <script>
    function deleteRole(roleId) {
      if (confirm('Are you sure you want to delete this role?')) {
        document.getElementById('deleteForm_' + roleId).submit();
      }
    }

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
