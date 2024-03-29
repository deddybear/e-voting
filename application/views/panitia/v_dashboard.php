<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Panitia</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">

	<link href="<?= base_url('assets/css/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">
	<link href="<?= base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/loader.min.css') ?>">
</head>

<body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;">
    <!-- Loadder -->
    <div id="loader-wrapper">
	    <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
		<!-- Page Wrapper -->
		<div id="wrapper">

			<!-- Sidebar -->
			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

				<!-- Sidebar - Brand -->
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Panitia/Dashboard') ?>">
					<div class="sidebar-brand-text mx-3">Dashboard Panitia</div>
				</a>

				<!-- Divider -->
				<hr class="sidebar-divider my-0">

				<!-- Nav Item - Dashboard -->
				<li class="nav-item active">
					<a class="nav-link" href="<?= site_url('Panitia/Dashboard') ?>">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span></a>
				</li>
                <li class="nav-item active">
					<a class="nav-link" href="<?= site_url('Page/welcome') ?>">
						<i class="fas fa-house-user"></i>
						<span>Pergi ke Homepage</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Addons
				</div>

				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
						aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-wrench"></i>
						<span>Utilities</span>
					</a>
					<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
						data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Custom Utilities:</h6>
							<a class="collapse-item" href="<?= site_url('Panitia/Mahasiswa') ?>">Panel Data Mahasiswa</a>
							<a class="collapse-item" href="<?= site_url('Panitia/Paslon') ?>">Panel Data Calon Kandidat</a>
							<a class="collapse-item" href="<?= site_url('Panitia/Voting')?>">Panel Data Suara</a>
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
						aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-cog"></i>
						<span>Pengaturan Akun</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Pengaturan Akun:</h6>
							<a class="collapse-item" href="<?= site_url('Panitia/Change') ?>" >Ganti Password</a>
							<a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout Akun</a>
						</div>
					</div>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Sidebar Toggler (Sidebar) -->
				<div class="text-center d-none d-md-inline">
					<button class="rounded-circle border-0" id="sidebarToggle"></button>
				</div>

			</ul>
			<!-- End of Sidebar -->
			
			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
						<!-- Sidebar Toggle (Topbar) -->
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
						<ul class="navbar-nav ml-auto">
							<div class="topbar-divider d-none d-sm-block"></div>
							<!-- Nav Item - User Information -->
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('name') ?></span>
									
								</a>
								<!-- Dropdown - User Information -->
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
									aria-labelledby="userDropdown">
									<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Selamat Datang <?= $this->session->userdata('name') ?>
								</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Logout
									</a>
								</div>
							</li>
						</ul>
					</nav>
					<!-- End of Topbar -->

					<!-- Begin Page Content -->
					<div class="container-fluid">

						<!-- Page Heading -->
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Dashboard Panitia</h1>
						</div>

						<!-- Content Row Looping -->
						<div class="row">

						</div>

						<!-- Content Row -->

						<div class="row">

							<!-- Area Chart -->
							<div class="col-xl-8 col-lg-7">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Hasil Suara (Bar)</h6>

									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-area">
											<canvas id="myBarChart"></canvas>
										</div>
									</div>
								</div>
							</div>

							<!-- Pie Chart -->
							<div class="col-xl-4 col-lg-5">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Hasil Suara (Chart)</h6>

									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-pie pt-4 pb-2">
											<canvas id="myPieChart"></canvas>
										</div>
										<div class="mt-4 text-center small" id="namapaslon">
											
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Content Row -->
						<div class="row">

							<!-- Content Column -->
							<div class="col-lg-12 mb-4">

								<!-- Project Card Example -->
								<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary">Data Suara Mahasiswa & Panitia</h6>
									</div>
									<div class="card-body">
										<h4 class="small font-weight-bold">Belom Memakai Hak Suara<span
												class="float-right" id="text-progress-belum"></span></h4>
										<div class="progress mb-4">
											<div class="progress-bar bg-danger" id="progress-belum" role="progressbar" 
												aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<h4 class="small font-weight-bold">Sudah Memakai Hak Suara<span
												class="float-right" id="text-progress-sudah"></span></h4>
										<div class="progress mb-4">
											<div class="progress-bar bg-success" role="progressbar" id="progress-sudah" 
												aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<h4 class="small font-weight-bold">Hak Suara Ditolak<span
												class="float-right" id="text-progress-ditolak"></span></h4>
										<div class="progress mb-4">
											<div class="progress-bar bg-warning" role="progressbar" id="progress-ditolak" 
												aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- End of Main Content -->

				<!-- Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<p>Copyright &copy; dpmfisipubhara <?= date("Y") ?></p>
							<p class="bababoey"><b>Script and Coded by </b><a class="link-about" style="text-decoration: none;" href="https://deddybear.github.io/aboutme/">Dedi Suharman</a></p>
						</div>
					</div>
				</footer>
				<!-- End of Footer -->

			</div>
			<!-- End of Content Wrapper -->

		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<!-- Logout Modal-->
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="<?= site_url('Auth/Logout') ?>">Logout</a>
					</div>
				</div>
			</div>
		</div>

</body>
		<script>
			var url = "<?= site_url() ?>"
			var base_url = "<?= base_url() ?>"
		</script>
		<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
		<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/chart.js/Chart.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>
		<script src="<?= base_url('assets/js/ajax/ajax_hak_suara.js') ?>"></script>
		<script src="<?= base_url('assets/js/index.js')?>"></script>


</html>
