@extends('adminlte::page')
@section('title', 'Create employee')
@section('content')

<h1 class="h4 mb-3 text-gray-800">@yield('title')</h1>

<div class="card shadow">
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('employees.store') }}">
			@csrf
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name">
			</div>

			<div class="form-group">
				<label>Department</label>
				<select name="department_id" class="form-control">
					@foreach ($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
					@endforeach
				</select>
			</div>

			<button class="btn btn-primary">Create</button>
		</form>
	</div>
</div>

@endsection

@section('js')
<script>
	document.addEventListener("DOMContentLoaded", () => {
		$("#addForm").validate({
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