@extends('adminlte::page')
@section('title', 'Departments')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('departments.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Create department</a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Deparments</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach ($departments as $department)
        <tr>
          <td>{{ $department->id }}</td>
          <td>{{ $department->name }}</td>
          <td>
            <a class="btn btn-outline-primary" href="/departments/{{ $department->id }}">Employees</a>
            <a class="btn btn-outline-primary" href="/departments/{{ $department->id }}/equipment">Equipment</a>
            <a class="btn btn-outline-primary" href="/departments/{{ $department->id }}/edit">Edit</a>
            <a class="btn btn-outline-danger" href="/departments/{{ $department->id }}/delete">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection