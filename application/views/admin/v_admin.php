<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel Panitia</title>
	<link href="<?= base_url('assets/css/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/datatables.min.css') ?>">

</head>

<body>
	<div class="container-fluid">
		<?= $this->session->flashdata('notif') ?>
		<!-- Page Heading -->
		<h1 class="h3 mb-2 text-gray-800">Data Panitia</h1>
		<p class="mb-4">
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti pariatur unde, voluptatibus
			maxime quasi delectus vel ullam quibusdam repellendus cupiditate harum. Similique explicabo
			dolores corporis inventore totam. Ut, officia voluptas.
		</p>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data - Data Panitia</h6>
			</div>

			<div class="card-body">
				<div class="pull-right" style="float: right !important; margin: 1%;">
					<a id="tambahdata" href="#" class="btn btn-sm btn-success" data-toggle="modal"
						data-target="#modal_form">
						<span class="fa fa-plus"></span> Tambah Data Panitia
					</a>
				</div>
				<div class="pull-right" style="float: right !important; margin: 1%;">
					<a href="#" class="btn btn-sm btn-success" data-toggle="modal" id="tambahdata"
						data-target="#modal_email">
						<span class="fa fa-envelope"></span> Kirim Password</a>
				</div>
				<div class="pull-right" style="float: right !important; margin: 1%;">
					<a id="tambahdata" href="<?= site_url('Auth/Logout') ?>" class="btn btn-sm btn-danger">
						<span class="fa fa-sign-out-alt"></span> Logout </a>
					</a>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Nim</th>
								<th>Nama Panitia</th>
								<th>Jabatan</th>
								<th>Register Pada</th>
								<th>Create at</th>
								<th>Status Voting</th>
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

	<!-- MODAL TAMBAH -->

	<div class="modal" id="modal_form" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data Panitia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" method="post" id="form">
					<div class="form-body">
						<div class="form-group">
							<label for="nomerpaslon" class="control-label col-md-5">Nim</label>
							<div class="col-md-9">
								<input type="number" class="form-control" min="1" name="nim" id="nim_"
									placeholder="Nim Panitia" required>
							</div>
						</div>
					</div>

					<div class="form-body">
						<div class="form-group">
							<label for="nomerpaslon" class="control-label col-md-5">Email</label>
							<div class="col-md-9">
								<input type="email" class="form-control" name="email" id="email_"
									placeholder="Email Panitia" required>
							</div>
						</div>
					</div>

					<div class="form-body">
						<div class="form-group">
							<label for="nomerpaslon" class="control-label col-md-5">Nama Panitia</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nama" id="nama_"
									placeholder="Nama Panitia" required>
							</div>
						</div>
					</div>

					<div class="form-body">
						<div class="form-group">
							<label for="nomerpaslon" class="control-label col-md-5">Jabatan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="jabatan" id="jabatan_"
									placeholder="Jabatan">
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

	<!-- MODAL KIRIM E_MAIL -->
	<div class="modal" id="modal_email" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Kirim Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= site_url('Admin/sendPasswordPanitia') ?>" method="post">
					<div class="form-body">
						<div class="form-group">
							<label for="nim" class="control-label col-md-5">Pilih NIM</label>
							<div class="col-md-9">
								<select class="form-control" id="data_paslon" name="id" required>
									<option value=""> Silahkan Pilih Nim Tujuan</option>
									<?php foreach ($panitia as $key => $value) : ?>
									<option value="<?= $value->id_user ?>"> <?= $value->nim ?>
										<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="ok">Kirim Password</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
<script>
	var url = "<?= site_url() ?>"
	var base_url = "<?= base_url() ?>"

</script>
<script src="<?= base_url('assets/js/ajax/ajax_data_panitia.js') ?>"></script>

</html>
