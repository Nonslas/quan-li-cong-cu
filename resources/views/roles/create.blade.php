@extends('adminlte::page')
@section('title', 'Create role')
@section('content')

<div class="card card-primary shadow">
	<div class="card-header">
		<div class="card-title">@yield('title')</div>
	</div>
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('roles.store') }}">
			@csrf

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name">
			</div>

			<div class="form-group">
				<label for="permissions">Permissions</label>
				<select name="permissions[]" multiple style="width: 100%">
					@foreach ($permissions as $permission)
					<option value="{{ $permission->name }}">{{ $permission->name }}</option>
					@endforeach
				</select>
			</div>

			<button class="btn btn-primary">Save</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", () => {
		$("select").select2({theme: 'bootstrap4'})

		$("#addForm").validate({
			rules: {
				name: "required"
			},
			messages: {
				name: "Please enter role name"
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