<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Assets/images/img-01.png" alt="IMG">
				</div>
		
				<form class="login100-form">
					<br>

					<div class="wrap-input100">
						<input class="input100" type="text" id="Username" placeholder="Username">
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" id="Password" placeholder="Password">
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="TombolLogin">
							Login
						</button>
					</div>
					<br>
					<a href="http://localhost/SPK_SNMPTN/Daftar" class="text-warning"><b>&emsp;Daftar Akun?</b></a>
				</form>
			</div>
		</div>
	</div>

	<script src="Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="Assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="Assets/js/main.js"></script>
</body>
</html>
