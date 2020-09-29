@extends('adminlte::page')
@section('title', 'Create type')
@section('content')

<div class="card shadow">
	<div class="card-header">
		Create type
	</div>
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('types.store') }}">
			@csrf
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name">
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
                name: "required"
            },
            messages: {
                name: "Please enter name"
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