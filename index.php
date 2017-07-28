<?php
session_start();
if(!isset($_SESSION['adm'])){
	header("location:login.php");
}
require_once("koneksi.php");
?>
<html>
	<head>
		<title>admin pkbm kartini</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" href="images/logo.png">
		<script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/plugins/validator/dist/css/bootstrapValidator.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/plugins/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/plugins/datepicker/datepicker3.css">
		<script type="text/javascript" src="bootstrap-3.3.7-dist/plugins/validator/dist/js/bootstrapValidator.min.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/plugins/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/plugins/datepicker/bootstrap-datepicker.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-custom navbar-fixed-top">
		    <a class="navbar-brand brand-custom" href="#">
		    	<img src="images/logo.png" width="40" height="40" class="logo-brand">
		    	&nbsp; Admin PKBM Kartini
		    </a>		    
		    <ul class="nav navbar-nav navbar-kiri">
		    	<li><a href="?h=home"> HOME</a></li>
		    	<li><a href="?h=pendidikan"> PENDIDIKAN</a></li>
		    	<li><a href="?h=olahraga"> OLAHRAGA</a></li>
		    	<li><a href="?h=kebudayaan"> KEBUDAYAAN</a></li>
		    	<li><a href="?h=iptek"> IPTEK</a></li>
		    	<li><a href="?h=about"> ABOUT</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="dropdown">
		      	<a href="#" class="dropdown-toggle logout" data-toggle="dropdown"> Akun</a>
		      	<div class="dropdown-menu sub-menu"  style="right: 50; left: auto;">
		      		<a href="?h=akun" class="sub-kiri btn btn-success">Edit Akun</a>
		      		<a href="logout.php" class="sub-kanan btn btn-danger">Logout</a>
		      	</div>
		      </li>
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
					<div class="biodata">
						<span class="id"><?php echo data_login()['id_admin']; ?></span><br />
						<span class="nama"><?php echo data_login()['username']; ?></span>
					</div>
					<div class="menu-area">
						<div class="judul-menu">MENU AREA <span class="glyphicon glyphicon-list"></span></div>
						<a href="?h=favorit"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Favorit</div></a>
						<a href="?h=terbaru"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Terbaru</div></a>
						<a href="?h=kegiatan"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Kegiatan</div></a>
						<a href="?h=galeri"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Galeri</div></a>
						<a href="?h=akun"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Edit Akun</div></a>
						<a href="logout.php"><div class="menu-item"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp; Logout</div></a>
					</div>
				</div>
			</div>
			<div class="row footer">
				&copy;2017 PKBM Kartini
			</div>
		</div>
	</body>
</html>
<?php
function data_login(){
	$query = query("select * from admin where id_admin='$_SESSION[adm]'");
	return mysqli_fetch_array($query);
}
?>