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
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">
		
	<!-- Custom styles for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/css/loader.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/view/panitia/v_data_paslon.css') ?>">

	<title><?= $title ?></title>
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
					<!-- Topbar Navbar -->
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
					<?= $this->session->flashdata('notif') ?>
					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Panel Data Calon Kandidat</h1>
					<p class="mb-4">
						Panel ini membantu untuk menanmbahkan, mengedit, menghapus data para calon paslon dan juga
						bisa untuk mengupload foto para paslon dengan dengan menggunakan fiture Upload Foto Paslon
					</p>
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Data - Data Kandidat</h6>
						</div>
						<div class="card-body">
							<div class="pull-right">
								<a id="tambahdata" href="#" class="btn btn-sm btn-success" data-toggle="modal"
									data-target="#modal_form">
									<span class="fa fa-plus"></span> Tambah Data Paslon
								</a>
							</div>
							<div class="pull-right">
								<a id="uploadfoto" href="#" class="btn btn-sm btn-success" data-toggle="modal"
									data-target="#modal_upload_image">
									<span class="fa fa-plus"></span> Upload Foto Paslon
								</a>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


									<thead>
										<tr>
										    <th>No</th>
											<th>Nomer Paslon</th>
											<th>Nama Ketua</th>
											<th>Nama Wakil</th>
											<th>Foto Ketua</th>
											<th>Foto Wakil</th>
											<th>Visi</th>
											<th>Misi</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="show_data">

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--- Modal Data Paslon -->
				<div class="modal" id="modal_form" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="form-horizontal" method="post" id="form">
								<div class="form-body">
									<div class="form-group">
										<label for="nomerpaslon" class="control-label col-md-5">Nomer Paslon</label>
										<div class="col-md-12">
											<input type="hidden" name="idpaslon" id="idpaslon">
											<input type="number" min="1" class="form-control" name="nomerpaslon"
												id="nomer_paslon" placeholder="Nomer Paslon" required>
										</div>
									</div>
								</div>

								<div class="form-body">
									<div class="form-group">
										<label for="nomerpaslon" class="control-label col-md-5">Nama Ketua</label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="namaketua" id="namaketua"
												placeholder="Nama Ketua" required>
										</div>
									</div>
								</div>

								<div class="form-body">
									<div class="form-group">
										<label for="nomerpaslon" class="control-label col-md-5">Nama Wakil</label>
										<div class="col-md-12">
											<input type="text" class="form-control" name="namawakil" id="namawakil"
												placeholder="Nomer Wakil" required>
										</div>
									</div>
								</div>

								<div class="form-body">
									<div class="form-group">
										<label for="nomerpaslon" class="control-label col-md-5">Visi</label>
										<div class="col-md-12">
											<textarea class="form-control" name="visi" id="visi"
												rows="3" required></textarea>
											<small>Untuk Ganti Baris Gunakan "\n"</small>
										</div>
									</div>
								</div>

								<div class="form-body">
									<div class="form-group">
										<label for="nomerpaslon" class="control-label col-md-5">Misi</label>
										<div class="col-md-12">
											<textarea class="form-control" name="misi" id="misi"
												rows="3" required></textarea>
											<small>Untuk Ganti Baris Gunakan "\n"</small>
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="ok">Save changes</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- END MODAL DATA -->

				<!-- MODAL UPLOAD  DATA IMG -->
				<div class="modal" tabindex="-1" role="dialog" id="modal_upload_image">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Upload Image Paslon</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="form" action="<?= site_url('Panitia/uploadFotoPaslon') ?>" method="post"
									enctype="multipart/form-data">
									<div class="form-body">
										<div class="form-group">
											<label for="data_paslon">Pilih Paslon</label>
											<select class="form-control" id="data_paslon" name="id" required>
												<option value="0"> Silahkan Pilih Nomer Paslon</option>
												<?php foreach ($paslon as $key => $value) : ?>
												<option value="<?= $value->id_paslon ?>"> <?= $value->nomer_paslon ?>
													<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-body">
										<div class="form-group">
											<label for="nomerpaslon" class="control-label col-md-5">Nama Ketua</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="namaketua" id="dataketua"
													placeholder="Nama Ketua" value="" readonly required>
											</div>
										</div>
									</div>

									<div class="form-body">
										<div class="form-group">
											<label for="nomerpaslon" class="control-label col-md-5">Nama Wakil</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="namawakil" id="datawakil"
													placeholder="Nomer Wakil" value="" readonly required>
											</div>
										</div>
									</div>
                                    
                                    <div class="col-12 alert alert-danger" role="alert">
                                        <small>Sebelum Upload usahakan Resolusi/Ukuran foto disamakan semua !</small>
                                    </div>
									<div class="form-body">
										<div class="form-group">
											<div class="custom-file col-md-9">
												<input type="file" name="filefoto1" id="fotoketua"
													class="custom-file-input" required>
												<label class="custom-file-label" for="fotoketua">Foto
													Ketua</label>
												<div class="invalid-feedback">invalid custom file feedback</div>
											</div>
										</div>
									</div>

									<div class="form-body">
										<div class="form-group">
											<div class="custom-file col-md-9">
												<input type="file" name="filefoto2" id="fotowakil"
													class="custom-file-input" required>
												<label class="custom-file-label" for="fotowakil">Foto
													Wakil</label>
												<div class="invalid-feedback">invalid custom file feedback</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Upload Foto</button>
										<button type="button" class="btn btn-secondary"
											data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END MODAL UPLOAD  DATA IMG -->
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
		<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
		<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/index.js')?>"></script>

		<script>
			var url = "<?= site_url() ?>"
			var base_url = "<?= base_url() ?>"

		</script>
		<script src="<?= base_url('assets/js/ajax/ajax_paslon.js')?>"></script>
</body>

</html>
