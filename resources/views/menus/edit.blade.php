@extends('adminlte::page')
@section('title', 'Edit menu')
@section('content')

<div class="card card-primary shadow">
    <div class="card-header">
        <div class="card-title">
            Edit menu
        </div>
    </div>
    <div class="card-body">
        <form id="addForm" method="POST" action="{{ route('menus.update', $menu->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('text') }}
                        {{ Form::text('text', $menu->text, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('icon') }}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i id="iconPreview"></i></span>
                            </div>
                            {{ Form::text('icon', $menu->icon, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('url') }}
                        {{ Form::text('url', $menu->url, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('target') }}
                        {{ Form::text('target', $menu->target, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <select name="permissions[]" class="select2" multiple style="width: 100%">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ in_array($permission->id, $selected) ? 'selected' : '' }}>{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-outline-primary">Save</button>
        </form>
    </div>
</div>

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between">
        <h2 class="card-title">Submenus</h2>
        <a href="{{ route('menus.submenus.create', [$menu->id]) }}" class="btn btn-primary btn-sm">Add</a>
    </div>
</div>
<div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>#</th>
        <th>Text</th>
        <th>Url</th>
        <th>Target</th>
        <th>Status</th>
        <th>Order</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($menu->submenus as $key => $submenu)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td><i class="{{ $submenu->icon }}"></i> {{ $submenu->text }}</td>
            <td>{{ $submenu->url }}</td>
            <td>{{ $submenu->target }}</td>
            <td>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input switch-status" id="switch{{$submenu->id}}" {{ $submenu->status ? 'checked' : ''}} data-id={{ $submenu->id }}>
                        <label class="custom-control-label" for="switch{{$submenu->id}}"></label>
                    </div>
                </div>
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.submenus.order.up', [$menu->id, $submenu->id]) }}"><i class="fas fa-angle-up"></i></a>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.submenus.order.down', [$menu->id, $submenu->id]) }}"><i class="fas fa-angle-down"></i></a>
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.submenus.edit', [$menu->id, $submenu->id]) }}">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-danger delete-btn" data-parentId="{{ $menu->id }}" data-id="{{ $submenu->id }}" data-name="{{ $submenu->text }}" >
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
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

        Array.from(document.querySelectorAll('.switch-status')).forEach(element => {
            element.onchange = event => {
                const id = parseInt(element.dataset.id)
                const status = element.checked
                fetch(`{{route('menus.submenus.toggle', [$menu->id])}}`, {
                    method: 'PUT',
                    body: JSON.stringify({id, status}),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'content-type': 'application/json'
                    }
                })
            }
        })

        Array.from(document.querySelectorAll('.delete-btn')).forEach(element => {
            element.onclick = e => {
                const {id, parentid, name} = element.dataset;
                if (confirm(`Delete menu ${name}?`)) {
                    fetch(`/menus/${parentid}/submenus/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => {
                        window.location.reload()
                    })
                }
            }
        })

    })
</script>
@endsection