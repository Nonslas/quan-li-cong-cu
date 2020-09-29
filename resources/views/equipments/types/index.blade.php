@extends('adminlte::page')
@section('title', 'Equipment types')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('types.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Create type</a>
</div>

<div class="card">
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
				@foreach ($types as $type)
				<tr>
					<td>{{ $type->id }}</td>
					<td>{{ $type->name }}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{ route('types.edit', [$type->id]) }}">Edit</a>
						<button class="btn btn-outline-danger" onclick="confirmDelete({{ $type->id }})" >Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	const confirmDelete = id => {
		if (confirm(`Delete type ${id}?`)) {
			fetch(`/types/${id}`, {
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