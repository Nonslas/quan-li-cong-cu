@extends('layouts.default')
@section('title', 'Edit')
@section('content')

<div class="card shadow">
	<div class="card-header">
		Edit equipment
	</div>
	<div class="card-body">
		<form method="POST" action="{{ route('departments.equipment.update', ['department' => $department->id, 'equipment' => $equipmentDepartment->id]) }}">
			@csrf
			@method('PUT')
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
				<input type="text" class="form-control" name="amount" required value="{{ $equipmentDepartment->amount }}">
			</div>

			<button class="btn btn-primary">Save</button>
		</form>
	</div>
</div>

@endsection