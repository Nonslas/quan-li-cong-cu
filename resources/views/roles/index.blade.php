@extends('adminlte::page')
@section('content')
<div class="d-flex justify-content-between mb-2">
	<h4 class="mb-0">Roles</h4>
	<a href="{{ route('roles.create') }}" class="d-none mb-0 d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-plus fa-sm text-white-50"></i> Create role</a>
</div>

<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-header d-flex justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Roles</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<th>ID</th>
						<th>Name</th>
						<th>Permissions</th>
						<th>Action</th>
					</thead>
					<tbody>
						@foreach ($roles as $role)
						<tr>
							<td>{{ $role->id }}</td>
							<td>{{ $role->name }}</td>
							<td>
								@foreach ($role->permissions as $permission)
									<span class="badge badge-success">{{ $permission->name }}</span>
								@endforeach
							</td>
							<td>
								<a class="btn btn-outline-primary" href="/roles/{{ $role->id }}/edit">Edit</a>
								<button class="btn btn-outline-danger" onclick="confirmDelete({{$role->id}})" >Delete</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	const confirmDelete = userId => {
		console.log(userId);
		if (confirm(`Delete role ${userId}?`)) {
			fetch(`/roles/${userId}`, {
				method: 'DELETE',
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			}).then(res => {
				window.location.reload()
			})
		}
	}
</script>

@endsection