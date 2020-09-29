@extends('adminlte::page')
@section('content')

<div class="d-flex justify-content-between mb-2">
	<h3 class="m-0">Users</h3>
	<a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-sm text-white-50"></i> Create user</a>
</div>

<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Users</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Roles</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@foreach ($user->roles as $role)
						<span class="badge badge-success">{{ $role->name }}</span>
						@endforeach
					</td>
					<td>
						<a class="btn btn-outline-primary" href="/users/{{ $user->id }}/edit">Edit</a>
						<button class="btn btn-outline-danger" onclick="confirmDelete({{$user->id}})" >Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	const confirmDelete = userId => {
		console.log(userId);
		if (confirm(`Delete user ${userId}?`)) {
			fetch(`/users/${userId}`, {
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