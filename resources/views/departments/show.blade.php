@extends('adminlte::page')
@section('title', 'Department detail')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('employees.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Create employee</a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Department detail</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
      </thead>
      <tbody>
        @foreach ($department->employees as $employee)
        <tr>
          <td>{{ $employee->id }}</td>
          <td>{{ $employee->name }}</td>
          <td>{{ $employee->department->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection