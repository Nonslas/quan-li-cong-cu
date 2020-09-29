@extends('adminlte::auth.login')
@section('content')
<div class="col-5 mx-auto mt-4">
	<div class="card shadow">
		<div class="card-body">
			<form method="POST">
				@csrf
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control">
				</div>

				<div class="form-group">
					<label for="email">Password</label>
					<input type="password" name="password" class="form-control">
				</div>

				<button class="btn btn-primary btn-block">Login</button>
			</form>
		</div>
	</div>
</div>
@endsection
