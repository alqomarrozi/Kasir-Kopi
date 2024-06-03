<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
	<meta name="description"
		content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
	<meta name="keywords"
		content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
	<meta name="author" content="PIXINVENT">
	<title>
		<?php echo 'Putti Roofspace' .": ". ucfirst($this->uri->segment(1)) ." - ". ucfirst($this->uri->segment(2)) ?>
	</title>
	<link rel="apple-touch-icon" href="<?= base_url();?>themes/app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url();?>themes/app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
		rel="stylesheet">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/charts/apexcharts.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/extensions/toastr.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/semi-dark-layout.css">
	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/css/core/menu/menu-types/vertical-menu.css">
	<!-- END: Page CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
	data-menu="vertical-menu-modern" data-col="">

	<?= $_header;?>

	<?= $_sidebar;?>

	    <?= $_content;?>

		<div class="sidenav-overlay"></div>
		<div class="drag-target"></div>

		<!-- BEGIN: Footer-->
		<footer class="footer footer-static footer-light">
			<p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">Copyright &copy; 2022
					Putti Roofspace<span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
			</p>
		</footer>

		<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
		<!-- END: Footer-->

		<!-- BEGIN: Vendor JS-->
		<script src="<?= base_url();?>themes/app-assets/vendors/js/vendors.min.js"></script>
		<!-- BEGIN Vendor JS-->

		<!-- BEGIN: Page Vendor JS-->
		<script src="<?= base_url();?>themes/app-assets/vendors/js/charts/apexcharts.min.js"></script>
		<script src="<?= base_url();?>themes/app-assets/vendors/js/extensions/toastr.min.js"></script>
		<!-- END: Page Vendor JS-->

		<!-- BEGIN: Theme JS-->
		<script src="<?= base_url();?>themes/app-assets/js/core/app-menu.min.js"></script>
		<script src="<?= base_url();?>themes/app-assets/js/core/app.min.js"></script>
		<script src="<?= base_url();?>themes/app-assets/js/scripts/customizer.min.js"></script>
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
