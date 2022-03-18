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
	<link rel="stylesheet" href="<?= base_url('assets/css/view/v_voting.css')?>">
	<link href="<?= base_url('assets/css/view/panitia/v_footer.css')?>" rel="stylesheet">

    <!-- ICONS -->
	<title>Voting Page</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">
</head>

<body oncontextmenu="return false;">

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
					<a class="nav-link" href="<?= site_url('Page/welcome') ?>">Tutorial Voting</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= site_url('Page/kandidat') ?>">Calon Kandidat</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?= site_url('Page/voting')?>">Voting<span
							class="sr-only">(current)</span></a>
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
	<div class="vote__Content container">
		<center>

			<h3><b>Fisipers, it's your time to choose! Yuk gunakan hak suaramu sekarang juga!</b></h3>
			<?php if (!$this->session->flashdata('notif')) {

				echo "<small>Silahkan memilih kandidat pilihanmu dibawah ini.</small>";

			} else {

				echo $this->session->flashdata('notif');

			} 
			?>
		</center>
		<div>
		<form id="myform" class="was-validated" action="<?= site_url('Auth/Voting') ?>" method="post" autocomplete="off">
			<div class="btn-center col-lg-6">
				<button id="btn-submit" class="btn btn-primary btn-lg btn-block" type="submit">Vote !</button>
			</div>
				<div class="row">
					<!-- Pengulangan Looping  -->
					<?php foreach ($data as $key => $value) : ?>
						<div class="box-kandidat col-lg">
							<div class="custom-control custom-radio">
								<input type="radio" name="paslon" class="custom-control-input" value="<?= $value->id_paslon ?>" id="<?= $value->id_paslon ?>" autocomplete="off">
							  <label class="custom-control-label" for="<?= $value->id_paslon ?>"></label>
						</div>
						<div class="row">
						    <img class="col-3 img-logo" src="<?= base_url('assets/src/icons/logo-univ.png') ?>" alt="logo-web" srcset="">
						    <h1 class="col-6"><?= $value->nomer_paslon ?></h1>
				            <img class="col-3 img-logo" src="<?= base_url('assets/src/icons/logo-dpm.png') ?>" alt="logo-web2" srcset="">
						</div>
						<div class="paslon__card">
						    <div class="row">
							    <img class="gmbPaslon col-6" src="<?= base_url('assets/src/img/paslon/ketua/')?><?= $value->foto_ketua ?>" alt="" srcset="">
							    <img class="gmbPaslon col-6" src="<?= base_url('assets/src/img/paslon/wakil/')?><?= $value->foto_wakil?>" alt="" srcset="">
						    </div>
						</div>
						<div class="row">
						    <div class="ketua col-6">
						        <h6>Calon Gubernur</h6>
							    <h4><b><?= $value->nama_ketua ?></b></h4>
							</div>
							 <div class="wakil col-6">
							     <h6>Calon Wakil Gubernur</h6>
							     <h4><b><?= $value->nama_wakil ?></b></h4>
							 </div>
						</div>
					</div>
					<?php endforeach ?>
				</div>
			</form>
		</div>
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
