@extends('adminlte::page')
@section('title', 'Suppliers')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  <a href="{{ route('suppliers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create supplier</a>
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
				@foreach ($suppliers as $supplier)
				<tr>
					<td>{{ $supplier->id }}</td>
					<td>{{ $supplier->name }}</td>
					<td>
						<a class="btn btn-outline-primary" href="{{ route('suppliers.edit', [$supplier->id]) }}">Edit</a>
						<button class="btn btn-outline-danger" onclick="confirmDelete({{ $supplier->id }})" >Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	const confirmDelete = id => {
		if (confirm(`Delete supplier ${id}?`)) {
			fetch(`/suppliers/${id}`, {
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