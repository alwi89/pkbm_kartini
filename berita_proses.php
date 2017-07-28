<?php
session_start();
require_once("koneksi.php");
if(!isset($_POST['aksi'])){
	$id_berita = urldecode($_GET['id']);
	$kategori = $_GET['k'];
	$a = query("delete from berita where id_berita='$id_berita'");
	if($a){
		setcookie("berhasil", "berhasil menghapus berita", time()+2);
	}else{
		setcookie("gagal", "gagal menghapus berita", time()+2);
	}
	header("location:index.php?h=$kategori");
}else if($_POST['aksi']=='tambah'){
	$judul = escape($_POST['judul']);
	$sumber = escape($_POST['sumber']);
	$kategori = escape($_POST['kategori']);
	$isi = $_POST['isi'];
	$gambar = str_replace(" ", "_", $_FILES['cover']['name']);
	$source = $_FILES['cover']['tmp_name'];
	$dest = "berita/$gambar";
	if(strlen($gambar)!=0){
		$a = query("insert into berita(judul, isi, cover, id_admin, kategori, sumber) values('$judul', '$isi', '$gambar', '$_SESSION[adm]', '$kategori', '$sumber')");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("insert into berita(judul, isi, id_admin, kategori, sumber) values('$judul', '$isi', '$_SESSION[adm]', '$kategori', '$sumber')");
	}
	if($a){
		setcookie("berhasil", "berhasil menambah berita", time()+2);
	}else{
		setcookie("gagal", "gagal menambah berita, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=$kategori");
}else if($_POST['aksi']=='edit'){
	$kode_lama = escape($_POST['kode_lama']);
	$judul = escape($_POST['judul']);
	$sumber = escape($_POST['sumber']);
	$kategori = escape($_POST['kategori']);
	$isi = $_POST['isi'];
	$gambar = str_replace(" ", "_", $_FILES['cover']['name']);
	$source = $_FILES['cover']['tmp_name'];
	$dest = "berita/$gambar";
	if(strlen($gambar)!=0){
		$a = query("update berita set judul='$judul', isi='$isi', id_admin='$_SESSION[adm]', cover='$gambar', kategori='$kategori', sumber='$sumber' where id_berita='$kode_lama'");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("update berita set judul='$judul', isi='$isi', id_admin='$_SESSION[adm]', kategori='$kategori', sumber='$sumber' where id_berita='$kode_lama'");
	}
	if($a){
		setcookie("berhasil", "berhasil mengedit berita", time()+2);
	}else{
		setcookie("gagal", "gagal mengedit berita, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=$kategori");
}
?>