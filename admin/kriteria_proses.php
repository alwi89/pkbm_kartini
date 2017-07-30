<?php
session_start();
require_once("koneksi.php");
if(!isset($_POST['aksi'])){
	$id_kriteria = urldecode($_GET['id']);
	$a = query("delete from kriteria where id_kriteria='$id_kriteria'");
	if($a){
		setcookie("berhasil", "berhasil menghapus kriteria", time()+2);
	}else{
		setcookie("gagal", "gagal menghapus kriteria", time()+2);
	}
	header("location:index.php?h=kriteria");
}else if($_POST['aksi']=='tambah'){
	$kategori = escape($_POST['kategori']);
	$kata_kunci = escape($_POST['katakunci']);
	$a = query("insert into kriteria(kategori, kata_kunci) values('$kategori', '$kata_kunci')");
	if($a){
		setcookie("berhasil", "berhasil menambah kriteria", time()+2);
	}else{
		setcookie("gagal", "gagal menambah kriteria, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=kriteria");
}else if($_POST['aksi']=='edit'){
	$kode_lama = escape($_POST['kode_lama']);
	$kategori = escape($_POST['kategori']);
	$kata_kunci = escape($_POST['katakunci']);
	$a = query("update kriteria set kategori='$kategori', kata_kunci='$kata_kunci' where id_kriteria='$kode_lama'");
	if($a){
		setcookie("berhasil", "berhasil mengedit kriteria", time()+2);
	}else{
		setcookie("gagal", "gagal mengedit kriteria, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=kriteria");
}
?>