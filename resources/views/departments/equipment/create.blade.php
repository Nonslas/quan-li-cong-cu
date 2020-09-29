@extends('layouts.default')
@section('title', 'Add equipment')
@section('content')

<div class="card shadow">
	<div class="card-header">
		Add equipment
	</div>
	<div class="card-body">
		<form method="POST" action="{{ route('departments.equipment.store', ['department' => $department->id]) }}">
			@csrf
			<div class="form-group">
				<label for="equipment">Equipment</label>
				<select name="equipment_id" id="equipment" class="form-control">
					@foreach ($equipments as $equipment)
						<option value="{{ $equipment->id }}">{{ "$equipment->code - $equipment->name" }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Amount</label>
				<input type="text" class="form-control" name="amount" required>
			</div>

			<button class="btn btn-primary">Add</button>
		</form>
	</div>
</div>

@endsection