<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>

	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
</head>

<body class="bg-gradient-primary">
	<div class="container">
		@yield('content')
	</div>
</body>

</html>