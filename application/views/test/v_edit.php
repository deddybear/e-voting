<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/view/v_edit.css') ?>">
	<title>Document</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="">Ini Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/welcome') ?>">Home <span
							class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/kandidat') ?>">Kandidat</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/voting')?>">Voting</a>
				</li>
			</ul>
			<ul class="menukiri navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="icons" src="<?= base_url('assets/src/icons/avatar.png'); ?>" alt="">
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" style="background-color: black ; color :white"
							href="<?= site_url('Home/edit_password') ?>">Edit Password</a>
						<a class="dropdown-item" href="<?= site_url('Page/Logout') ?>">Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<div id="content_">
		<div class="container-sm col-md-6" id="container__Change">
			<div>
				<h3>Ubah Password</h3>
				<form action="" method="post">
					<div class="form-group row">
						<label for="old" class="col-sm-3 col-form-label">Password Lama</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="" id="old">
						</div>
					</div>
					<div class="form-group row">
						<label for="old" class="col-sm-3 col-form-label">Password Baru</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="" id="old">
						</div>
					</div>
					<div class="form-group row">
						<label for="old" class="col-sm-3 col-form-label">Konfrimasi Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="" id="old">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<button class="btn btn-primary" type="submit">Ubah</button>
						</div>
						<div class="col-md-2">
							<a class="btn btn-danger" href="<?= site_url('Home/welcome') ?>">Kembali</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ;?>"></script>

</html>
