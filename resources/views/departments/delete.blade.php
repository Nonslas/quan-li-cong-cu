@extends('adminlte::page')
@section('title', 'Confirm delete')
@section('content')

<div class="card shadow">
	<div class="card-header">Confirm</div>
	<div class="card-body">

		<div class="mb-3">
			Delete department <strong>{{ $department->name }}</strong>?
		</div>

		<form action="{{ route('departments.destroy', [$department->id]) }}" method="POST">
			@method('DELETE')
			@csrf
			<a href="{{ route('departments.index') }}" class="btn btn-primary">Cancle</a>
			<button class="btn btn-outline-danger">Delete</button>
		</form>
		
	</div>
</div>


@endsection