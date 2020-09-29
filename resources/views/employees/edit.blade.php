@extends('adminlte::page')
@section('title', 'Edit employee')
@section('content')

<div class="card shadow">
  <div class="card-header">
    Edit employee
  </div>
  <div class="card-body">
    <form id="editForm" method="POST" action="{{ route('employees.update', [$employee->id]) }}">
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

@section('js')
<script>
  document.addEventListener("DOMContentLoaded", () => {
    $("#editForm").validate({
      rules: {
        name: "required",
        department_id: "required"
      },
      messages: {
        name: "Please enter employee name",
        department_id: "Please select a department"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    })
  })
</script>
@endsection