@extends('adminlte::page')
@section('title', 'Edit user')
@section('content')
<form id="editForm" action="/users/{{$user->id}}" method="POST">
	@method('PUT')
	@csrf
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email" value="{{$user->email}}">	
	</div>

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="{{$user->name}}">	
	</div>

	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>

	<div class="form-group">
		<select name="roles[]" class="form-control duallistbox" multiple>
			@foreach ($roles as $role)
				<option value="{{$role->name}}" {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>{{$role->name}}</option>
			@endforeach
		</select>
	</div>

	<button class="btn btn-primary">Save</button>

</form>
@endsection

@section('js')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        $(".select2").select2({theme: 'bootstrap4'})
        $(".duallistbox").bootstrapDualListbox({
            nonSelectedListLabel: "Roles available",
            selectedListLabel: "Roles selected"
        })

        $("#editForm").validate({
            rules: {
                name: "required",
                email: {
                	required: true,
                	email: true,
                },
                password: {
			        required: false,
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