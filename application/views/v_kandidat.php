<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Questrial&display=swap"> 
   
   <!-- CCSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/view/panitia/v_footer.css')?>">
	<link href="<?= base_url('assets/css/view/v_kandidat.css') ?>" rel="stylesheet" >

    <!-- Icons -->
	<title>Para Calon Kandidat</title>
	<link rel="icon" href="<?= base_url('assets/src/icons/favicon.ico') ?>">
</head>

<body id="element-to-hide" oncontextmenu="return false;">
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
				<li class="nav-item ">
					<a class="nav-link" href="<?= site_url('Page/welcome') ?>">Tutorial Voting</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?= site_url('Page/kandidat') ?>">Calon Kandidat<span
							class="sr-only">(current)</span></a>
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
	<div class="kandidat__content container">
		<center>
			<h2>KANDIDAT PEMIRA FISIP 2020</h2>
			<small>Hai Fisipers! Berikut adalah para kandidat Gubernur dan Wakil Gubernur BEM - FISIP 2020.</small>
		</center>
		<div class="hublah">
			<div class="row">
				<!-- Pengulangan Looping  -->
				<?php foreach ($data as $key => $value) : 
				$text = str_replace(array("\r\n", "\r", "\n"), "<br/>", $value->misi);
				?>
				<div class="box-kandidat col-lg">
					<div class="profile">
					    <h1><?= $value->nomer_paslon ?></h1>
					    <div class="row">
						    <img class="bababoey col-6" src="<?= base_url('assets/src/img/paslon/ketua/')?><?= $value->foto_ketua ?>">
						    <img class="bababoey col-6" src="<?= base_url('assets/src/img/paslon/wakil/')?><?= $value->foto_wakil ?>" >
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
					<div class="visi row">
					    <h5 class="header__vm col-12">Visi</h5>
					    <div class="txt__visi">
    					    <p style="padding: 10px 10px;" ><?= nl2br(stripcslashes($value->visi)) ?></p>
					    </div>
					</div>
					<div class="misi row">
					    <h5 class="header__vm col-12">Misi</h5>
					    <div class="txt__misi">
					        <p style="padding: 10px 10px;" ><?= nl2br(stripcslashes($value->misi)) ?></p>    
					    </div>
				    </div>
				</div>
				<?php endforeach ?>
			</div>
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
