<!DOCTYPE html>
<html class="loading" lang="id" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
	<meta name="author" content="Putti Roofspace"> 
	<title>Putti Roofspace</title>
	<link rel="apple-touch-icon" href="<?= base_url();?>themes/app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url();?>themes/app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
		rel="stylesheet">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/vendors.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/bordered-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/semi-dark-layout.css">

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/css/plugins/forms/form-validation.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/pages/authentication.css">
	<!-- END: Page CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
	data-menu="vertical-menu-modern" data-col="blank-page">
	<!-- BEGIN: Content-->
	<div class="app-content content ">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body">
				<div class="auth-wrapper auth-cover">
					<div class="auth-inner row m-0">
						<!-- /Brand logo--> 
						<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
							<div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              				<img style="width:80px" class="align-items-center mb-1"	src="<?= base_url();?>images/app/logo-black.png" alt="Images" />
								<h2 class="card-title fw-bold mb-1">Putti Roofspace</h2>
								
					<?= $this->session->userdata('message'); ?>
								<form class="auth-login-form mt-2" action="<?= base_url('auth/verify');?>" method="POST">
									<div class="mb-1">
										<label class="form-label" for="login-username">Username</label>
										<input class="form-control" id="login-username" type="text" name="username" placeholder="username"
											aria-describedby="login-email" autofocus="" tabindex="1" />
									</div>
									<div class="mb-1">
										<div class="d-flex justify-content-between">
											<label class="form-label" for="login-password">Password</label>
										</div>
										<div class="input-group input-group-merge form-password-toggle">
											<input class="form-control form-control-merge" id="login-password" type="password"
												name="password" placeholder="············" aria-describedby="login-password"
												tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
										</div>
									</div>
									<button class="btn btn-primary w-100" tabindex="4">Masuk</button>
								</form>
							</div>
						</div>
						<!-- Left Text-->
						<div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
							<div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
									src="<?= base_url();?>images/app/login-bg.png" alt="Images" /></div>
						</div>
						<!-- /Left Text-->
						<!-- Login-->
						<!-- /Login-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content-->


	<!-- BEGIN: Vendor JS-->
	<script src="<?= base_url();?>themes/app-assets/vendors/js/vendors.min.js"></script>
	<!-- BEGIN Vendor JS-->

	<!-- BEGIN: Page Vendor JS-->
	<script src="<?= base_url();?>themes/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- BEGIN: Theme JS-->
	<script src="<?= base_url();?>themes/app-assets/js/core/app-menu.js"></script>
	<script src="<?= base_url();?>themes/app-assets/js/core/app.js"></script>
	<!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	<script src="<?= base_url();?>themes/app-assets/js/scripts/pages/auth-login.js"></script>
	<!-- END: Page JS-->

	<script>
		$(window).on('load', function () {
			if (feather) {
				feather.replace({
					width: 14,
					height: 14
				});
			}
		})

	</script>
</body>
<!-- END: Body-->

</html>
