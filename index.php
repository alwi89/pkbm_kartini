<?php
session_start();
require_once("admin/koneksi.php");
?>
<html>
	<head>
		<title>pkbm kartini</title>
		<link rel="stylesheet" type="text/css" href="admin/bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="admin/style.css">
		<link rel="icon" href="images/logo.png">
		<script type="text/javascript" src="admin/jquery/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="admin/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="admin/bootstrap-3.3.7-dist/plugins/validator/dist/css/bootstrapValidator.min.css">
		<link rel="stylesheet" type="text/css" href="admin/bootstrap-3.3.7-dist/plugins/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="admin/bootstrap-3.3.7-dist/plugins/datepicker/datepicker3.css">
		<script type="text/javascript" src="admin/bootstrap-3.3.7-dist/plugins/validator/dist/js/bootstrapValidator.min.js"></script>
		<script type="text/javascript" src="admin/bootstrap-3.3.7-dist/plugins/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="admin/bootstrap-3.3.7-dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="admin/bootstrap-3.3.7-dist/plugins/datepicker/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="admin/jquery/jquery.easyPaginate-master/lib/jquery.easyPaginate.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-custom navbar-fixed-top">
		    <a class="navbar-brand brand-custom" href="#">
		    	<img src="admin/images/logo.png" width="40" height="40" class="logo-brand">
		    	&nbsp; PKBM Kartini
		    </a>		    
		    <ul class="nav navbar-nav navbar-kiri">
		    	<li><a href="?h=home"> HOME</a></li>
		    	<li><a href="?h=pendidikan"> PENDIDIKAN</a></li>
		    	<li><a href="?h=olahraga"> OLAHRAGA</a></li>
		    	<li><a href="?h=kebudayaan"> KEBUDAYAAN</a></li>
		    	<li><a href="?h=iptek"> IPTEK</a></li>
		    	<li><a href="?h=about"> ABOUT</a></li>
		    </ul>
		</nav>
		<div class="container container-custom">
			<div class="row">
				<div class="panel-konten left">
					<?php
					if(!isset($_GET['h'])){
						require_once("home.php");
					}else{
						require_once("$_GET[h].php");
					}
					?>
				</div>
				<div class="panel-menu">
					<div class="menu-area">
						<div class="judul-menu">NAVIGATION</div>
						<a href="?h=home"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Home</div></a>
						<a href="?h=favorit"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Favorit</div></a>
						<a href="?h=terbaru"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Terbaru</div></a>
					</div>
				</div>
			</div>
			<div class="row footer">
				&copy;2017 PKBM Kartini
			</div>
		</div>
	</body>
</html>