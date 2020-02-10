<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Daftar</title>
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">
	<style type="text/css">
		.capbox {
			background-color: #92D433;
			border: #B3E272 0px solid;
			border-width: 0px 12px 0px 0px;
			display: inline-block;
			*display: inline; zoom: 1; /* FOR IE7-8 */
			padding: 8px 40px 8px 8px;
			}

		.capbox-inner {
			font: bold 11px arial, sans-serif;
			color: #000000;
			background-color: #DBF3BA;
			margin: 5px auto 0px auto;
			padding: 3px;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			}

		#CaptchaDiv {
			font: bold 17px verdana, arial, sans-serif;
			font-style: italic;
			color: #000000;
			background-color: #FFFFFF;
			padding: 4px;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			}

		#CaptchaInput { margin: 1px 0px 1px 0px; width: 220px; }
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100" style="padding-top:40px;">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="Assets/images/img-01.png" alt="IMG">
					</div>
				</div>

				<form class="login100-form" id="FormLogin">
					<!-- <span class="login100-form-title">
						Daftar Akun
					</span> -->

					<div class="wrap-input100">
						<input class="input100" type="text" id="Username" placeholder="Nama Siswa" required>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" id="Password" placeholder="Password" required>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<select class="form-control" id="JenisKelamin" required>
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="date" id="TanggalLahir" required>
					</div>

					<div class="wrap-input100">
						<select class="form-control" id="IdProdi" required>
							<option value="">Minat</option>
							<?php
							foreach ($Prodi as $row) {?>
								 <option value="<?=$row['IdProdi'];?>"><?=$row['NamaProdi'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="capbox">
						<div id="CaptchaDiv"></div>
							<div class="capbox-inner">
							Input Captcha :<br>
							<input type="hidden" id="txtCaptcha">
							<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="TombolDaftar">
							Daftar
						</button>
					</div>

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
	<script>
		$("#FormLogin").submit(function(e) {
		    e.preventDefault();
		});
	</script>
	<script src="Assets/js/main.js"></script>
</body>
</html>
