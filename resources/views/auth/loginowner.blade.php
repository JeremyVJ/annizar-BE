<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('admin/assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('admin/assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/css/atlantis.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In To Owner</h3>
			<form action="{{ route('login') }}" method="post" class="login-form">
				@csrf
                <div class="form-group form-floating-label">
					<input id="email_or_username" name="email_or_username" type="text" class="form-control input-border-bottom" required>
					<label for="email_or_username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
		
				<div class="form-action mb-3">
					<button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
				</div>
			</form>
		</div>

	
	</div>
	<script src="{{ asset('admin/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin/assets/js/atlantis.min.js') }}"></script>
</body>
</html>