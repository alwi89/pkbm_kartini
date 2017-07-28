<?php
session_start();
require_once("koneksi.php");
if(!isset($_POST['aksi'])){
	$id_galeri = urldecode($_GET['id']);
	$a = query("delete from galeri where id_galeri='$id_galeri'");
	if($a){
		setcookie("berhasil", "berhasil menghapus galeri", time()+2);
	}else{
		setcookie("gagal", "gagal menghapus galeri", time()+2);
	}
	header("location:index.php?h=galeri");
}else if($_POST['aksi']=='tambah'){
	$judul = escape($_POST['judul']);
	$gambar = str_replace(" ", "_", $_FILES['gambar']['name']);
	$source = $_FILES['gambar']['tmp_name'];
	$dest = "galeri/$gambar";
	if(strlen($gambar)!=0){
		$a = query("insert into galeri(judul, gambar, id_admin) values('$judul', '$gambar', '$_SESSION[adm]')");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("insert into galeri(judul, id_admin) values('$judul', '$_SESSION[adm]')");
	}
	if($a){
		setcookie("berhasil", "berhasil menambah galeri", time()+2);
	}else{
		setcookie("gagal", "gagal menambah galeri, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=galeri");
}else if($_POST['aksi']=='edit'){
	$kode_lama = escape($_POST['kode_lama']);
	$judul = escape($_POST['judul']);
	$gambar = str_replace(" ", "_", $_FILES['gambar']['name']);
	$source = $_FILES['gambar']['tmp_name'];
	$dest = "galeri/$gambar";
	if(strlen($gambar)!=0){
		$a = query("update galeri set judul='$judul', id_admin='$_SESSION[adm]', gambar='$gambar' where id_galeri='$kode_lama'");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("update galeri set judul='$judul', id_admin='$_SESSION[adm]' where id_galeri='$kode_lama'");
	}
	if($a){
		setcookie("berhasil", "berhasil mengedit galeri", time()+2);
	}else{
		setcookie("gagal", "gagal mengedit galeri, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=galeri");
}
?>