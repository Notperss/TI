@extends('layouts.app')
@section('title', 'Permissions')
@section('content')

  {{-- @section('breadcrumb')
  <x-breadcrumb title="Permission Management" page="Roles & Permissions" active="Permission Management"
    route="{{ route('permission.index') }}" />
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
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-normal mb-0 text-body card-title">permissions list</h4>
                @can('permission.store')
                @endcan
                <button type="button" class="btn btn-primary btn-md " data-toggle="modal"
                  data-target="#modal-form-add-permission">
                  Add
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap mx-2">
                <table class="table table-bordered" id="table1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Guard Name</th>
                      <th>Assigned To</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $permission)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>
                          @foreach ($permission->roles as $role)
                            <span class="badge bg-info me-1">{{ $role->name }}</span>
                          @endforeach
                        </td>
                        <td>
                          <div class="demo-inline-spacing">

                            @can('permission.update')
                              <a data-toggle="modal" data-target="#modal-form-edit-permission-{{ $permission->id }}"
                                class="btn btn-sm btn-secondary text-white">
                                Edit
                              </a>
                              @include('management-access.permission.modal-edit')
                            @endcan

                            @can('permission.destroy')
                              <a onclick="deletePermission('{{ $permission->id }}')" title="Delete"
                                class="btn btn-sm btn-danger text-white">
                                Hapus
                              </a>
                              <form id="deleteForm_{{ $permission->id }}"
                                action="{{ route('permission.destroy', $permission->id) }}" method="POST">
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

    </div>
  </div>
  <!-- Add Role Modal -->
  @include('management-access.permission.modal-create')
  <!--/ Add Role Modal -->

  </div>
  <!-- / Content -->

  <script>
    function deletePermission(permissionId) {
      if (confirm('Are you sure you want to delete this permission?')) {
        document.getElementById('deleteForm_' + permissionId).submit();
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
