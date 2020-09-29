@extends('adminlte::page')
@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Permissions
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{ route('permissions.edit', [$permission->id]) }}">Edit</a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete({{$permission->id}})" >Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">Add permission</div>
            <div class="card-body">
                <form id="addForm" action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    const confirmDelete = id => {
        if (confirm(`Delete permission ${id}?`)) {
            fetch(`/permissions/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(res => {
                window.location.reload()
            })
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        $("#addForm").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter permission name"
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