<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- Meta -->
	<meta name="description" content="" />
	<meta name="author" />

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Philsaga - Laboratory Information and Management System</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{env('APP_URL')}}/assets/img/favicon.png" />

	<!-- vendor css -->
	<link href="{{env('APP_URL')}}/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href="{{env('APP_URL')}}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

	<!-- DashForge CSS -->
	<link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/dashforge.css">
	<link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/dashforge.auth.css">
	<link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/skin.deepblue.css">
	<!-- vue JS -->
	<link rel="stylesheet" href="{{env('APP_URL')}}/assets/primeicons-master/primeicons.css" />

	@yield('pagecss')
</head>

<body>


	<div id="app"  class="position-relative overflow-auto ht-100v">
		@yield('content')
	</div>



	<script src="{{ asset('/js/app.js') }}"></script>

	<script src="{{env('APP_URL')}}/lib/jquery/jquery.min.js"></script>
	<script src="{{env('APP_URL')}}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="{{env('APP_URL')}}/lib/feather-icons/feather.min.js"></script>
	<script src="{{env('APP_URL')}}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script src="assets/js/dashforge.js"></script>
	@yield('pagejs')
</body>

</html>