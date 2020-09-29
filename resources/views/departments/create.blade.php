@extends('adminlte::page')
@section('title', 'Create department')
@section('content')

<div class="card card-primary shadow">
	<div class="card-header">
		<div class="card-title">Create department</div>
	</div>
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('departments.store') }}">
			@csrf
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="d-flex justify-content-between">
				<a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Cancle</a>
				<button class="btn btn-primary">Create</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#addForm").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter department name"
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