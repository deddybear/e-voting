<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?= $title ?></title>
		<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">

		<!-- Custom fonts for this template-->
		<link href="<?= base_url('assets/css/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
		<link
			href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
			rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?= base_url('assets/css/view/v_login.css') ?>">
	</head>

	<body>

		<div class="container">

			<!-- Outer Row -->
			<div class="row justify-content-center">

				<div class="col-xl-10 col-lg-12 col-md-9">

					<div class="card o-hidden border-0 shadow-lg my-5">
						<?= $this->session->flashdata('notif') ?>
						<div class="box__con card-body p-15">
							<!-- Nested Row within Card Body -->
							<div class="row container-login">
								<div class="col-lg-6 ">
									<img class="login__img col-12" src="<?= base_url('assets/src/img/login-page.jpg') ?>" alt="" srcset="">
								</div>
								<div class="col-lg-6">
									<div class="p-12">
										<div class="text-center">
											<h1 class="h3 text-gray-900 mb-4"><b><?= $welcome ?></b>
											<br><small class="col-12">Hai Fisipers!, Saatnya memilih</small>
											</h1>
										</div>
										<form class="user" method="POST" action="<?= site_url('Auth/Login') ?>">
											<div class="form-group">
												<input type="text" name="nim" class="form-control form-control-user" id="exampleInputEmail"
													aria-describedby="nimHelp" placeholder="Masukkan NIM Anda" value="<?= set_value('nim') ?>">
													<?= form_error('nim','<small class="text-danger pl-3">', '</small>') ?>
											</div>
											<div class="form-group">
												<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
													placeholder="Password Anda">
													<?= form_error('password','<small class="text-danger pl-3">', '</small>') ?>
											</div>
											<button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>

		<!-- Bootstrap core JavaScript-->
		<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

		<!-- Core plugin JavaScript-->
		<script src="<?= base_url('assets/js/jquery-easing/jquery.easing.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/website_layout/console.js') ?>"></script>

		<!-- Custom scripts for all pages-->
		<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

	</body>

	</html>
