<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?= $page_title; ?> | RK GROUP</title>
	<!-- loader-->
	<link href="<?= base_url(); ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?= base_url(); ?>assets/js/pace.min.js"></script>
	<!--favicon-->
	<link rel="icon" href="<?= base_url(); ?>assets/images/logo-icon.png" type="image/x-icon">
	<!-- SweetAlert2 -->
	<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.css" integrity="sha512-gAU9FxrcktP/m5fRrn5P4FmIutdMP/kpVKsPerqffFy9gKQkR4cxrcrK3PtgTAgFiiN7b5+fwRbpCcO1F5cPew==" crossorigin="anonymous" referrerpolicy="no-referrer" media />
	<!-- Vector CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!--<link href="<?= base_url(); ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>-->
	<!-- simplebar CSS-->
	<link href="<?= base_url(); ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<!-- Bootstrap core CSS-->
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- animate CSS-->
	<link href="<?= base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
	<!-- Icons CSS-->
	<link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
	<!-- Sidebar CSS-->

	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<link href="<?= base_url(); ?>assets/css/sidebar-menu.css" rel="stylesheet" />
	<!-- Custom Style-->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/app-style.css" rel="stylesheet" />
	<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	.dropdown-content {
		display: none;
	}

	.link-hover1:hover .dropdown-content {
		display: block;
		list-style: none;
		padding: 12px;
	}

	.dropdown-content a {}

	.brand-logo {
		height: 135px;
	}

	.logo-icon {
		padding-top: 5px;
		width: 200px;
	}
</style>

<body class="bg-theme bg-theme1">

	<!-- Start wrapper-->
	<div id="wrapper">

		<!--Start sidebar-wrapper-->
		<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
			<div class="brand-logo">
				<a href="<?= base_url('admin/dashboard'); ?>">
					<img src="<?= base_url(); ?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon"><br>
					<h5 class="logo-text">C.E.O - Rehan Khan</h5>
				</a>
			</div>
			<ul class="sidebar-menu do-nicescrol">
				<li class="sidebar-header">MAIN NAVIGATION</li>
				<li class="<?php if ($this->uri->uri_string() == 'admin/dashboard') {
								echo 'active';
							} ?>">
					<a href="<?= base_url('admin/dashboard'); ?>">
						<i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<li class="<?php if ($this->uri->uri_string() == 'admin/manage_user' || $this->uri->uri_string() == 'admin/user_report') {
								echo 'active';
							} ?> link-hover1">
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-grid"></i> <span>Manage User</span>
					</a>
					<div class="dropdown-content">
						<a href="<?= base_url('admin/manage_user'); ?>">
							<i class="zmdi zmdi-face"></i> <span>Create User</span>
						</a><br>
						<a href="<?= base_url('admin/user_report'); ?>">
							<i class="zmdi zmdi-chart-donut text-success"></i> <span>User Report</span>
						</a>
					</div>
				</li>
				<li class="link-hover1 <?php if ($this->uri->uri_string() == 'admin/customer' || $this->uri->uri_string() == 'admin/customer_report') {
											echo 'active';
										} ?>">
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-format-list-bulleted"></i> <span>Customer</span>
					</a>
					<div class="dropdown-content">
						<a href="<?= base_url('admin/customer'); ?>">
							<i class="zmdi zmdi-face"></i> <span>Customer Register</span>
						</a><br>
						<a href="<?= base_url('admin/customer_report'); ?>">
							<i class="zmdi zmdi-chart-donut text-success"></i> <span>Customer Report</span>
						</a>
					</div>
				</li>
				<li class="link-hover1 <?php if ($this->uri->uri_string() == 'admin/account' || $this->uri->uri_string() == 'admin/credit_debit') {
											echo 'active';
										} ?>">
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-format-list-bulleted"></i> <span>Account</span>
					</a>
					<div class="dropdown-content">
						<a href="<?= base_url('admin/account'); ?>">
							<i class="zmdi zmdi-face"></i> <span>Open Account</span>
						</a><br>
						<a href="<?= base_url('admin/credit_debit'); ?>">
							<i class="zmdi zmdi-chart-donut text-success"></i> <span>Credit Debit</span>
						</a>
					</div>
				</li>

				<li class="link-hover1 <?php if ($this->uri->uri_string() == 'admin/category') {
											echo 'active';
										} ?>">
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-format-list-bulleted"></i> <span>Master</span>
					</a>
					<div class="dropdown-content">
						<a href="<?= base_url('admin/slider'); ?>">
							<i class="zmdi zmdi-collection-case-play"></i> <span>Slider</span>
						</a><br>
						<a href="<?= base_url('admin/category'); ?>">
							<i class="zmdi zmdi-view-day"></i> <span>Category</span>
						</a><br>
						<a href="<?= base_url('admin/product'); ?>">
							<i class="zmdi zmdi-mall"></i> <span>Product</span>
						</a><br>
						<a href="<?= base_url('admin/team'); ?>">
							<i class="zmdi zmdi-accounts-outline"></i> <span> Our Team</span>
						</a><br>
						<a href="<?= base_url('admin/feedback'); ?>">
							<i class="zmdi zmdi-format-align-justify"></i> <span>Feedback</span>
						</a><br>
						<a href="<?= base_url('admin/contact/edit/1'); ?>">
							<i class="zmdi zmdi-phone"></i> <span>Contact</span>
						</a><br>
					</div>
				</li>

				<li class="<?php if ($this->uri->uri_string() == 'admin/loan') {
								echo 'active';
							} ?>">
					<a href="<?= base_url('admin/loan'); ?>">
						<i class="zmdi zmdi-invert-colors"></i> <span>Loan</span>
					</a>
				</li>

				<li class="<?php if ($this->uri->uri_string() == 'admin/setting') {
								echo 'active';
							} ?>">
					<a href="<?= base_url('admin/setting'); ?>">
						<i class="fa fa-cog"></i> <span>Setting</span>
					</a>
				</li>

				<li class="<?php if ($this->uri->uri_string() == 'admin/password') {
								echo 'active';
							} ?>">
					<a href="<?= base_url('admin/password'); ?>">
						<i class="zmdi zmdi-lock"></i> <span>Change Password</span>
					</a>
				</li>
				<li>
					<a href="<?= base_url('login/logout'); ?>">
						<i class="icon-power"></i> <span>Logout</span>
					</a>
				</li>
			</ul>

		</div>
		<!--End sidebar-wrapper-->

		<!--Start topbar header-->
		<header class="topbar-nav">
			<nav class="navbar navbar-expand fixed-top">
				<ul class="navbar-nav mr-auto align-items-center">
					<li class="nav-item">
						<a class="nav-link toggle-menu" href="javascript:void();">
							<i class="icon-menu menu-icon"></i>
						</a>
					</li>
				</ul>

				<ul class="navbar-nav align-items-center right-nav-link">
					<li>
						RK GROUP FINANCE - Registration Number : GMLAHC2324000229
					</li>
					<li class="nav-item">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
							<span class="user-profile"><img src="<?= base_url(); ?>assets/images/logo-icon.png" class="img-circle" alt="user avatar"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-item user-details">
								<a href="javaScript:void();">
									<div class="media">
										<div class="avatar"><img class="align-self-start mr-3" src="<?= base_url(); ?>assets/images/logo-icon.png" alt="user avatar"></div>
										<div class="media-body">
											<h6 class="mt-2 user-title"><?= $this->session->userdata('user_name'); ?></h6>
										</div>
									</div>
								</a>
							</li>
							<li class="dropdown-divider"></li>
							<li class="dropdown-item"><i class="icon-power mr-2"></i><a href="<?= base_url('login/logout'); ?>">Logout</a> </li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<!--End topbar header-->

		<div class="clearfix"></div>

		<div class="content-wrapper">
			<div class="container-fluid">
				<?php $this->view('admin/' . $page_name); ?>

			</div>
			<!-- End container-fluid-->

		</div>
		<!--End content-wrapper-->
		<!--Start Back To Top Button-->
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<!--End Back To Top Button-->

		<!--Start footer-->
		<footer class="footer">
			<div class="container">
				<div class="text-center">
					Copyright © <?= date('Y'); ?> RK Group - Rushan Developers
				</div>
			</div>
		</footer>
		<!--End footer-->

		<!--start overlay-->
		<div class="overlay toggle-menu"></div>
		<!--end overlay-->
	</div>
	<!--End wrapper-->
	<!-- DataTables  & Plugins -->
	<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="<?= base_url(); ?>assets/sweetalert2.min.js"></script>
	<!-- simplebar js -->
	<script src="<?= base_url(); ?>assets/plugins/simplebar/js/simplebar.js"></script>
	<!-- sidebar-menu js -->
	<script src="<?= base_url(); ?>assets/js/sidebar-menu.js"></script>
	<!-- loader scripts -->
	<!--<script src="<?= base_url(); ?>assets/js/jquery.loading-indicator.js"></script>-->
	<!-- Custom scripts -->
	<script src="<?= base_url(); ?>assets/js/app-script.js"></script>
	<!-- Chart js -->

	<script src="<?= base_url(); ?>assets/plugins/Chart.js/Chart.min.js"></script>

	<!-- Index js -->
	<!--<script src="<?= base_url(); ?>assets/js/index.js"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<style>
		.colored-toast.swal2-icon-success {
			padding: 2px;
			background-color: black !important;
			color: white !important;
		}
	</style>
	<script>
		<?php if ($this->session->flashdata('flash_message') != "") { ?>
			<?php $message = $this->session->flashdata('flash_message'); ?>
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				customClass: {
					popup: 'colored-toast'
				}

			});
			Toast.fire({
				icon: "<?= $message['class']; ?>",
				title: "<?= $message['message']; ?>"
			});
		<?php   }  ?>
	</script>
</body>

</html>