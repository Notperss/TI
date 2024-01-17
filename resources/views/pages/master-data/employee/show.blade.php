<table class="table table-bordered">
  <tr>
    <th>Nik</th>
    <td>{{ isset($employee->nip) ? $employee->nip : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Nama</th>
    <td>{{ isset($employee->name) ? $employee->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Jabatan</th>
    <td>{{ isset($employee->job_position) ? $employee->job_position : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Divisi</th>
    <td>{{ isset($employee->division->name) ? $employee->division->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Departemen</th>
    <td>{{ isset($employee->department->name) ? $employee->department->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Seksi</th>
    <td>{{ isset($employee->section->name) ? $employee->section->name : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Perusahaan</th>
    <td>{{ isset($employee->company) ? $employee->company : 'N/A' }}</td>
  </tr>
  <tr>
    <th>Tipe User</th>
    <td>
      @if ($employee->type_user == 1)
        <span class="badge badge-success">{{ 'User' }}</span>
      @elseif($employee->type_user == 2)
        <span class="badge badge-danger">{{ 'Divisi' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </td>
  <tr>
    <th>Status</th>
    <td>
      @if ($employee->status == 1)
        <span class="badge badge-success">{{ 'Aktif' }}</span>
      @elseif($employee->status == 2)
        <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
      @else
        <span>{{ 'N/A' }}</span>
      @endif
    </td>
  </tr>
</table>
