@extends('layouts.app')
@section('title', 'Menu Item')
@section('content')

@section('breadcrumb')
  <x-breadcrumb title="Menu Item Management" page="Access Management" active="Menu Item Management"
    route="{{ route('menu.index') }}" />
@endsection

<!-- Content -->
<section class="section">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-normal mb-0 text-body">Menu Item - {{ $menu->name }}</h4>

        @can('menu-item.store')
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-form-add-menu">
            <i class="bi bi-plus-lg"></i>
            Add
          </button>
        @endcan

      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap mx-2">
        <table class="table" id="table1">
          <thead>
            <tr>
              <th>Name</th>
              <th>Permission</th>
              <th>Route</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($menuItems as $menuItem)
              <tr>
                <td>{{ $menuItem->name }}</td>
                <td>{{ $menuItem->permission_name }}</td>
                <td>{{ $menuItem->route }}</td>
                <td>
                  @if ($menuItem->status)
                    <span class="badge bg-primary me-1">Show</span>
                  @else
                    <span class="badge bg-danger me-1">Hide</span>
                  @endif
                </td>
                <td>
                  <div class="demo-inline-spacing">
                    @can('menu-item.update')
                      <a data-toggle="modal" data-target="#modal-form-edit-menu-{{ $menuItem->id }}"
                        class="btn btn-sm btn-secondary text-white">
                        <i data-feather="edit"></i>
                      </a>
                      @include('management-access.menu-item.modal-edit')
                    @endcan

                    @can('menu-item.destroy')
                      <a onclick="showSweetAlert('{{ $menuItem->id }}')" title="Delete"
                        class="btn btn-sm btn-danger text-white">
                        <i data-feather="trash"></i>
                      </a>
                      <form id="deleteForm_{{ $menuItem->id }}"
                        action="{{ route('menu.item.destroy', [$menu->id, $menuItem->id]) }}" method="POST">
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
@include('management-access.menu-item.modal-create')
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
@endsection
