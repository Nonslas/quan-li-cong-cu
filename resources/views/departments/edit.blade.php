@extends('adminlte::page')
@section('title', 'Edit department')
@section('content')

<div class="card shadow">
    <div class="card-header">
        <div class="card-title">Edit department</div>
    </div>
    <div class="card-body">
        <form id="editForm" method="POST" action="{{ route('departments.update', [$department->id]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $department->name }}">
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