@extends('adminlte::page')
@section('title', 'Equipment List')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <div>
    <a href="{{ route('equipments.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
    <a href="{{ route('equipments.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-create fa-sm text-white-50"></i> Create equipment</a>
  </div>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Equipment list</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>ID</th>
        <th>Code</th>
        <th>Name</th>
        <th>Employee</th>
        <th>Department</th>
        <th>Assign at</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach ($equipments as $equipment)
        <tr>
          <td>{{ $equipment->id }}</td>
          <td>{{ $equipment->code }}</td>
          <td>{{ $equipment->name }}</td>
          <td>{{ $equipment->employee->name }}</td>
          <td>{{ $equipment->department->name }}</td>
          <td>{{ $equipment->assign_at }}</td>
          <td>
            <a class="btn btn-outline-primary" href="{{route('equipments.edit', [$equipment->id])}}">Edit</a>
            <button class="btn btn-outline-danger" onclick="confirmDelete({{$equipment->id}})" >Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  const confirmDelete = id => {
    if (confirm(`Delete equipment ${id}?`)) {
      fetch(`/equipments/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }).then(res => {
        window.location.reload()
      })
    }
  }
</script>
@endsection