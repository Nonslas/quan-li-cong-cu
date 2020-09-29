@extends('adminlte::page')
@section('title', 'Menus')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('menus.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create menu</a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Menus</h6>
</div>
<div class="card-body">
    <table class="table table-bordered">
      <thead>
        <th>STT</th>
        <th>Text</th>
        <th>Url</th>
        <th>Target</th>
        <th>Permissions</th>
        <th>Status</th>
        <th>Order</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($menus as $key => $menu)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td><i class="{{ $menu->icon }}"></i> {{ $menu->text }}</td>
            <td>{{ $menu->url }}</td>
            <td>{{ $menu->target }}</td>
            <td>
                @foreach ($menu->permissions as $permission)
                <span class="badge badge-success">{{ $permission->name }}</span>
                @endforeach
            </td>
            <td>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input switch-status" id="switch{{$menu->id}}" {{ $menu->status ? 'checked' : ''}} data-id={{ $menu->id }}>
                        <label class="custom-control-label" for="switch{{$menu->id}}"></label>
                    </div>
                </div>
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.order.up', $menu->id) }}"><i class="fas fa-angle-up"></i></a>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.order.down', $menu->id) }}"><i class="fas fa-angle-down"></i></a>
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('menus.edit', $menu->id) }}">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $menu->id }}" data-name="{{ $menu->text }}" >
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>

        @if($menu->submenus->isNotEmpty())
            @foreach ($menu->submenus as $_key => $submenu)
            <tr>
                <td>{{ ($key+1).'.'.($_key+1) }}</td>
                <td style="white-space: pre">      <i class="{{ $submenu->icon }}"></i> {{ $submenu->text }}</td>
                <td>{{ $submenu->url }}</td>
                <td>{{ $submenu->target }}</td>
                <td></td>
                <td>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switch-status" id="switchSub{{$submenu->id}}" {{ $submenu->status ? 'checked' : ''}} data-id="{{ $submenu->id }}" data-parentid="{{ $menu->id }}">
                            <label class="custom-control-label" for="switchSub{{$submenu->id}}"></label>
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
                    <button class="btn btn-sm btn-danger delete-btn" data-parentId="{{ $menu->id }}" data-id="{{ $submenu->id }}" data-name="{{ $submenu->text }}" data-parentid="{{ $menu->id }}" >
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        @endif
        @endforeach
    </tbody>
</table>
</div>

@endsection

@section('js')
<script type="text/javascript">

    Array.from(document.querySelectorAll('.delete-btn')).forEach(element => {
        element.onclick = e => {
            console.log(element.dataset)
            const {id, name, parentid} = element.dataset;

            let uri = `/menus/${id}`

            if (parentid) {
                uri = `/menus/${parentid}/submenus/${id}`
            }

            if (confirm(`Delete menu ${name}?`)) {
                fetch(uri, {
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

    Array.from(document.querySelectorAll('.switch-status')).forEach(element => {
        element.onchange = event => {
            const {id, parentid} = element.dataset;
            const status = element.checked

            let url = "{{ route('menus.toggle') }}"

            if (parentid) {
                url = `/menus/${parentid}/submenus/toggle`
            }

            console.log(url)

            fetch(url, {
                method: 'PUT',
                body: JSON.stringify({id, status}),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'content-type': 'application/json'
                }
            })
        }
    })

</script>
@endsection