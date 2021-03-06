@extends('adminlte::page')
@section('title', 'Create menu')
@section('content')

<div class="card card-primary shadow">
	<div class="card-header">
		<div class="card-title">
			Create menu
		</div>
	</div>
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('menus.store') }}">
			@csrf

			<div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('text') }}
                        {{ Form::text('text', '', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('icon') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i id="iconPreview"></i></span>
                            </div>
                            {{ Form::text('icon', 'far fa-circle', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('url') }}
                        {{ Form::text('url', '', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('target') }}
                        {{ Form::text('target', '', ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
				<label>Parent menu</label>
				<select name="parent_id" class="form-control" style="width: 100%">
					<option></option>
					@foreach ($menus as $menu)
					<option value="{{ $menu->id }}">{{ $menu->text }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Permissions</label>
				<select name="permissions[]" class="select2" multiple style="width: 100%">
					@foreach ($permissions as $permission)
					<option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
    	$(".select2").select2();
        $("#addForm").validate({
            rules: {
                text: "required",
                url: "required",
            },
            messages: {
                text: "Please enter submenu text",
                url: "Please enter url",
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

        const previewIcon = () => iconPreview.className = icon.value
        previewIcon()
        icon.onkeyup = previewIcon
        icon.onchange = previewIcon
    })
</script>
@endsection