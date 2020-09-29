@extends('adminlte::page')
@section('title', 'Edit submenu')
@section('content')

<div class="card card-primary shadow">
    <div class="card-header">
        <div class="card-title">@yield('title')</div>
    </div>
    <div class="card-body">
        <form id="addForm" method="POST" action="{{ route('menus.submenus.update', [$parentId, $submenu->id]) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('text') }}
                        {{ Form::text('text', $submenu->text, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('icon') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i id="iconPreview"></i></span>
                            </div>
                            {{ Form::text('icon', $submenu->icon, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('url') }}
                        {{ Form::text('url', $submenu->url, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('target') }}
                        {{ Form::text('target', $submenu->target, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <button class="btn btn-outline-primary">Save</button>
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $(".select2").select2({theme:'bootstrap4'});
        $("#addForm").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter supplier name"
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