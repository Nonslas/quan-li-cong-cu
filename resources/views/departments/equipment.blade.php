@extends('adminlte::page')
@section('title', 'Equipment')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('departments.equipment.create', ['department' => $department->id]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add equipment</a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Equipment list of {{ $department->name }}</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Supplier</th>
        <th>Employee</th>
        <th>Assign at</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach ($department->equipment as $equipment)
        <tr>
          <td>{{ $equipment->code }}</td>
          <td>{{ $equipment->name }}</td>
          <td>{{ $equipment->price }}</td>
          <td>{{ $equipment->amount }}</td>
          <td>{{ $equipment->supplier->name }}</td>
          <td>{{ $equipment->employee->name }}</td>
          <td>{{ $equipment->assign_at }}</td>
          <td>
            <a class="btn btn-outline-primary" href="{{ route('departments.equipment.edit', ['department' => $department->id, 'equipment' => $equipment->id]) }}">Edit</a>
            <a class="btn btn-outline-danger" href="{{ route('departments.equipment.delete', ['department' => $department->id, 'equipment' => $equipment->id]) }}">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection