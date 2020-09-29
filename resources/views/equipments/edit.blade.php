@extends('adminlte::page')
@section('title', 'Edit equipment')
@section('content')

<div class="card card-primary shadow">
	<div class="card-header">
		<div class="card-title">Edit equipment</div>
	</div>
	<div class="card-body">
		<form id="editForm" method="POST" action="{{ route('equipments.update', $equipment->id) }}">
			@csrf
			@method('PUT')

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Code</label>
						<input type="text" class="form-control" name="code" value="{{ $equipment->code }}">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="{{ $equipment->name }}">
					</div>
				</div>
			</div>


			<div class="form-group">
				<label>Detail</label>
				<input type="text" class="form-control" name="detail" value="{{ $equipment->detail }}">
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Price</label>
						<input type="text" class="form-control" name="price" value="{{ $equipment->price }}">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" name="amount" value="{{ $equipment->amount }}">
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Type</label>
						<select class="form-control" name="type">
							@foreach ($types as $type)
							<option value="{{ $type->id }}" {{ $type->id === $equipment->type ? 'selected' : '' }} >{{ $type->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Supplier</label>
						<select class="form-control" name="supplier_id">
							@foreach ($suppliers as $supplier)
							<option value="{{ $supplier->id }}" {{ $supplier->id === $equipment->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Buy at</label>
						<input type="date" class="form-control" name="buy_at" value="{{ $equipment->buy_at }}">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Assign at</label>
						<input type="date" class="form-control" name="assign_at" value="{{ $equipment->assign_at }}">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Department</label>
						<select class="form-control" name="department_id" id="department">
							<option></option>
							@foreach ($departments as $department)
								<option value="{{ $department->id }}" {{ $department->id === $equipment->department_id ? "selected" : "" }}>{{ $department->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Employee</label>
						<select class="form-control" name="employee_id" id="employee">
							<option></option>
							@foreach ($employees as $employee)
								@if ($employee->department_id === $equipment->department_id)
									<option value="{{$employee->id}}" {{ $employee->id === $equipment->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Status</label>
						<input type="text" class="form-control" name="status" value="{{ $equipment->status }}">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Guarantee</label>
						<input type="text" class="form-control" name="guarantee" value="{{ $equipment->guarantee }}">
					</div>
				</div>
			</div>

			<button class="btn btn-primary">Save</button>
		</form>
	</div>
</div>

@endsection

@section('js')
<script>
	const departments = @json($departments);
	const employees = @json($employees);

	const renderEmployees = employees => {
		employee.innerHTML = '';
		employees.forEach(_employee => {
			let option = document.createElement('option');
			option.value = _employee.id;
			option.text = _employee.name;
			employee.add(option);
		})
	}

	department.onchange = e => {
		const departmentId = parseInt(department.value);
		renderEmployees(employees.filter(employee => employee.department_id === departmentId))
	}

	$("#editForm").validate({
	    rules: {
	        code: "required",
	        name: "required",
	        detail: "required",
	        price: {
	        	min: 0
	        },
	        amount: {
	        	required: true,
	        	min: 1
	        },
	        buy_at: "required",
	        assign_at: "required",
	        status: "required",
	        guarantee: "required",
	        type: "required",
	        supplier_id: "required",
	        department_id: "required",
	        employee_id: "required",
	    },
	    messages: {
	        code: "Please enter code",
	        name: "Please enter equipment name"
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

</script>
@endsection
