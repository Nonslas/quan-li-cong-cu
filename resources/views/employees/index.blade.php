@extends('adminlte::page')
@section('title', 'Employees')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('employees.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Create employee</a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
        <tr>
          <td>{{ $employee->id }}</td>
          <td>{{ $employee->name }}</td>
          <td>{{ $employee->department->name }}</td>
          <td>
            <a class="btn btn-primary" href="/employees/{{ $employee->id }}/edit">Edit</a>
            <a class="btn btn-danger" href="/employees/{{ $employee->id }}/delete">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection