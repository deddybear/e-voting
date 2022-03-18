<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/view/v_voting.css')?>">
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">

	<title>Terimakasih</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">
</head>

<body oncontextmenu="return false;">
	<div id="element-to-hide"></div>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="<?= site_url('Page/welcome') ?>">
			<div class="col-3">
				<img class="img-logo" src="<?= base_url('assets/src/icons/logo-univ.png') ?>" alt="logo-web" srcset="">
				<img class="img-logo" src="<?= base_url('assets/src/icons/logo-dpm.png') ?>" alt="logo-web2" srcset="">
			</div>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<h2>Menu</h2>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">			  
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Auth/Logout') ?>">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="vote__Content container">
		<center>
			<div class="col-12">
				<h1 style="margin: 0 0 165px 0;">Kamu sudah voting! Terima kasih sudah menggunakan hak suaramu dalam PEMIRA FISIP 2020!</h1>
			</div>
		</center>
	</div>
	<footer class="sticky-footer">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<p>Copyright &copy; dpmfisipubhara <?= date("Y") ?></p>
			<p class="bababoey"><b>Script and Coded by </b><a style="text-decoration: none;" href="https://deddybear.github.io/aboutme/">Dedi Suharman</a></p>
		</div>
	</div>
</footer>
</body>
<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/index.js')?>"></script>
<script src="<?= base_url('assets/js/website_layout/console.js') ?>"></script>

</html>
