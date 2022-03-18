<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet"> 
	

	<!-- CSS -->	
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/view/v_welcome.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl/owl.carousel.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl/owl.theme.default.min.css') ?>">

    <!-- ICONS -->
	<title>Selamat Datang di sistem E-voting</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">
</head>

<body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;">
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="<?= base_url('Page/welcome') ?>">
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
				<li class="nav-item active">
					<a class="nav-link" href="<?= site_url('Page/welcome') ?>">Tutorial Voting<span
							class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/kandidat') ?>">Calon Kandidat</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/voting')?>">Voting</a>
				</li>
				<?php if($this->session->userdata('id_role') == "1" ) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Panitia/Dashboard') ?>">Dashboard</a>
				</li>
				<?php } ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Auth/Logout') ?>">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div id="content__">

		<div class="greetings">
			<h1><b>SELAMAT DATANG</b></h1>
			<h2>Mahasiswa FISIP</h2>
			<h3><b>UNIVERSITAS BHAYANGKARA SURABAYA</b></h3>
		</div>
		<div class="welcome-container">
			<div class="container-sm col-md-9">
				<div class="hitung col-12">
					<h2>Sisa Waktu Voting</h2>
					<div class="col-12" id="countdown"></div>
				</div>
			</div>
		</div>

		<div class="how-container" id="how-container">
			<div class="container-sm col-md-8">
				<h1>Cara Melakukan E-voting</h1>
				<h5>Geser untuk melihat selanjutnya</h5>
				<div class="owl-carousel owl-theme owl-loaded">
					<div class="owl-stage-outer">
						<div class="owl-stage">
							<div class="owl-item">
								<img src="<?= base_url('assets/src/img/tutorial/1.png') ?>" alt="...">
								<br>
								<h5>Pilih Voting untuk memulai voting anda bisa lihat pada bagian atas halaman web</h5>
							</div>
							<div class="owl-item">
								<img src="<?= base_url('assets/src/img/tutorial/2.png') ?>" alt="...">
								<br>
								<h5>Jika anda memakai mobile web anda bisa tekan menu berada di pojok atas kanan lalu
									akan muncul menu lalu pilih voting</h5>
							</div>
							<div class="owl-item">
								<img src="<?= base_url('assets/src/img/tutorial/3.png') ?>" alt="...">
								<br>
								<h5>Untuk memilih para calon kandidat anda harus me-click lingkaran putih yang tersedia
									di atas nomer paslon jika sudah click vote</h5>
							</div>
							<div class="owl-item">
								<img src="<?= base_url('assets/src/img/tutorial/4.png') ?>" alt="...">
								<br>
								<h5>Untuk memilih para calon kandidat pada web mobile anda harus menekan lingkaran putih
									yang tersedia di atas nomer paslon, jika sudah tekan vote</h5>
							</div>
							<div class="owl-item">
								<img src="<?= base_url('assets/src/img/tutorial/5.png') ?>" alt="...">
								<br>
								<h5>Anda bisa melihat para visi dan misi para kandidat dengan memilih opsi Calon
									Kandidat
									pada atas halaman web atau dalam menu untuk web mobile</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="sticky-footer">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
					<p>Copyright &copy; dpmfisipubhara <?= date("Y") ?></p>
					<p class="bababoey"><b>Script and Coded by </b><a style="text-decoration: none;"
							href="https://deddybear.github.io/aboutme/">Dedi Suharman</a></p>
				</div>
			</div>
		</footer>
</body>
<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ;?>"></script>
<script src="<?= base_url('assets/js/index.js') ?>"></script>
<script src="<?= base_url('assets/js/website_layout/countdownVoting.js') ?>"></script>
<script src="<?= base_url('assets/js/owl/owl.carousel.js') ?>"></script>
<script src="<?= base_url('assets/js/website_layout/console.js') ?>"></script>

</html>
