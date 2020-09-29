@extends('adminlte::page')
@section('title', 'Edit employee')
@section('content')

<div class="card shadow">
  <div class="card-header">
    List employee
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('employees.update', ['employee' => $employee->id]) }}">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
      </div>

      <div class="form-group">
        <label for="department">Department</label>
        <select name="department_id" class="form-control">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
      </div>
      <button class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

@endsection