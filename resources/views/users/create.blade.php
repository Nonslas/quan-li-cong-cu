@extends('adminlte::page')
@section('content')

<form id="addForm" method="POST" action="{{ route('users.store') }}">
	@csrf
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>

	<div class="form-group">
		<label>Role</label>
		<select name="roles[]" class="form-control select2" multiple>
			@foreach ($roles as $role)
				<option value="{{$role->name}}">{{$role->name}}</option>
			@endforeach
		</select>
	</div>

	<button class="btn btn-primary">Create</button>
</form>

@endsection

@section('js')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        $(".select2").select2({theme: 'bootstrap4'})

        $("#addForm").validate({
            rules: {
                name: "required",
                email: {
                	required: true,
                	email: true,
                },
                password: {
			        required: true,
			        minlength: 5
			    },
            },
            messages: {
                name: "Please enter role name",
                email: {
                	required: "Please enter a email address",
                	email: "Please enter a vaild email address"
                },
                password: {
                	required: "Please provide a password",
                	minlength: "Your password must be at least 5 characters long"
                },
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