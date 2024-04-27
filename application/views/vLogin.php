<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login | Maman Makau Mandiri</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="<?= base_url('asset/themekit-master/') ?>favicon.ico" type="image/x-icon" />

	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>node_modules/ionicons/dist/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>node_modules/icon-kit/dist/css/iconkit.min.css">
	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="<?= base_url('asset/themekit-master/') ?>dist/css/theme.min.css">
	<script src="<?= base_url('asset/themekit-master/') ?>src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<div class="auth-wrapper">
		<div class="container-fluid h-50">

			<div class="authentication-form mx-auto">
				<div class="logo-centered">
					<a href="<?= base_url('asset/themekit-master/') ?>index.html"><img src="<?= base_url('asset/themekit-master/') ?>src/img/brand.svg" alt=""></a>
				</div>
				<h3>Maman Makau Mandiri</h3>
				<p>Happy to see you again!</p>
				<?php
				if ($this->session->userdata('success')) {
				?>
					<div class="alert alert-success alert-dismissible" role="alert">

						<div class="alert-icon">
							<i class="zmdi zmdi-notifications-none"></i>
						</div>
						<div class="alert-message">
							<strong>Sukses!</strong> <?= $this->session->userdata('success') ?>
						</div>
					</div>
				<?php
				}
				?>
				<?php
				if ($this->session->userdata('error')) {
				?>
					<div class="alert alert-danger alert-dismissible" role="alert">

						<div class="alert-icon">
							<i class="zmdi zmdi-notifications-none"></i>
						</div>
						<div class="alert-message">
							<strong>Gagal!</strong> <?= $this->session->userdata('error') ?>
						</div>
					</div>
				<?php
				}
				?>
				<form action="<?= base_url('cLogin') ?>" method="POST">
					<?= form_error('username', '<small class="text-danger">', '</small>') ?>
					<div class="form-group">

						<input type="text" id="exampleInputUsername" name="username" class="form-control input-shadow" placeholder="Enter Username">
						<i class="ik ik-user"></i>
					</div>
					<?= form_error('password', '<small class="text-danger">', '</small>') ?>
					<div class="form-group">

						<input type="password" id="exampleInputPassword" name="password" class="form-control input-shadow" placeholder="Enter Password">
						<i class="ik ik-lock"></i>
					</div>
					<?= form_error('level', '<small class="text-danger">', '</small>') ?>
					<div class="form-group">

						<select class="form-control" name="level">
							<option value="">--Pilih Hak Akses---</option>
							<option value="1">Admin</option>
							<option value="2">Supplier</option>
							<option value="3">Owner</option>
							<option value="4">Gudang</option>
						</select>
						<i class="ik ik-users"></i>
					</div>

					<div class="sign-btn text-center">
						<button type="submit" class="btn btn-theme">Sign In</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="<?= base_url('asset/themekit-master/') ?>src/js/vendor/jquery-3.3.1.min.js"><\/script>')
	</script>
	<script src="<?= base_url('asset/themekit-master/') ?>node_modules/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('asset/themekit-master/') ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url('asset/themekit-master/') ?>node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
	<script src="<?= base_url('asset/themekit-master/') ?>node_modules/screenfull/dist/screenfull.js"></script>
	<script src="<?= base_url('asset/themekit-master/') ?>dist/js/theme.js"></script>
	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
		(function(b, o, i, l, e, r) {
			b.GoogleAnalyticsObject = l;
			b[l] || (b[l] =
				function() {
					(b[l].q = b[l].q || []).push(arguments)
				});
			b[l].l = +new Date;
			e = o.createElement(i);
			r = o.getElementsByTagName(i)[0];
			e.src = 'https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e, r)
		}(window, document, 'script', 'ga'));
		ga('create', 'UA-XXXXX-X', 'auto');
		ga('send', 'pageview');
	</script>
</body>

</html>
