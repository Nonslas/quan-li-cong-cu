@extends('adminlte::page')
@section('title', 'Create equipment')
@section('content')

<div class="card card-primary shadow">
	<div class="card-header">
		Create equipment
	</div>
	<div class="card-body">
		<form id="addForm" method="POST" action="{{ route('equipments.store') }}">
			@csrf

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Code</label>
						<input type="text" class="form-control" name="code">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name">
					</div>
				</div>
			</div>


			<div class="form-group">
				<label>Detail</label>
				<input type="text" class="form-control" name="detail">
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Price</label>
						<input type="text" class="form-control" name="price">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" name="amount">
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Type</label>
						<select class="form-control" name="type">
							@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Supplier</label>
						<select class="form-control" name="supplier_id">
							@foreach ($suppliers as $supplier)
							<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Buy at</label>
						<input type="date" class="form-control" name="buy_at">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Assign at</label>
						<input type="date" class="form-control" name="assign_at">
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
								<option value="{{ $department->id }}">{{ $department->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Employee</label>
						<select class="form-control" name="employee_id" id="employee">
							<option></option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Status</label>
						<input type="text" class="form-control" name="status">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Guarantee</label>
						<input type="text" class="form-control" name="guarantee">
					</div>
				</div>
			</div>

			<button class="btn btn-primary">Create</button>
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
		const departmentId = parseInt(e.target.value);
		renderEmployees(employees.filter(employee => employee.department_id === departmentId))
	}

	$("#addForm").validate({
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



