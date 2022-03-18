<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Custom fonts for this template -->
	<link href="<?= base_url('assets/css/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/datatables.min.css') ?>">

	<!-- Custom styles for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/css/loader.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/view/panitia/v_data_mhs.css') ?>">
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">

	<title>Panel Data Voting</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">
</head>

<body id="page-top" oncontextmenu="return false">
    <!-- Loadder -->
    <div id="loader-wrapper">
	    <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
	<div id="wrapper">
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Panitia/Dashboard') ?>">
				<div class="sidebar-brand-text mx-3">Dashboard Panitia</div>
			</a>
			<hr class="sidebar-divider my-0">
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
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Addons
			</div>
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
						<a class="collapse-item" href="<?= site_url('Panitia/Change') ?>">Ganti Password</a>
						<a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout Akun</a>
					</div>
				</div>
			</li>
			<hr class="sidebar-divider">
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>
		<!-- End of Sidebar -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
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
								<span
									class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('name') ?></span>

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
					<h1 class="h3 mb-2 text-gray-800">Panel Data Suara Mahasiswa</h1>
					<p class="mb-4">
						Panel ini untuk mengkontrol semua Data Suara dari mahasiswa maupun Panitia, dan jika ada data
						voting yang tidak valid Anda bisa
						Menekan Tombol "Hapus Data Vote"
					</p>
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Data Suara Mahasiswa Valid</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
										    <th>No</th>
											<th>Nim</th>
											<th>Jurusan</th>
											<th>Email</th>
											<th>Status Voting</th>
											<th>Kandidat yang dipilih</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="show_data">

									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Data Suara Mahasiswa Tidak Valid</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTidakValid" width="100%" cellspacing="0">
									<thead>
										<tr>
										    <th>No</th>
											<th>Nim</th>
											<th>Jurusan</th>
											<th>Email</th>
											<th>Status Voting</th>
											<th>Kandidat yang dipilih</th>
										</tr>
									</thead>
									<tbody id="tableTidakValid">

									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Belum Menggunakan Suara</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataBelumVote" width="100%" cellspacing="0">
									<thead>
										<tr>
										    <th>No</th>
											<th>Nim</th>
											<th>Jurusan</th>
											<th>Email</th>
											<th>Status Voting</th>
											<th>Kandidat yang dipilih</th>
										</tr>
									</thead>
									<tbody id="tableBelumVote">

									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div>
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<p>Copyright &copy; dpmfisipubhara <?= date("Y") ?></p>
							<p class="bababoey"><b>Script and Coded by </b><a class="link-about"
									style="text-decoration: none;" href="https://deddybear.github.io/aboutme/">Dedi
									Suharman</a></p>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
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

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/index.js')?>"></script>
	<script src="<?= base_url('assets/js/website_layout/console.js') ?>"></script>
	<script>
		var url = "<?= site_url() ?>"
		var base_url = "<?= base_url() ?>"

	</script>
	<script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
	<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/ajax/ajax_data_voting.js')?>"></script>
</body>

</html>
