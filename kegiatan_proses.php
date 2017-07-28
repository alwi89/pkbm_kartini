<?php
session_start();
require_once("koneksi.php");
if(!isset($_POST['aksi'])){
	$id_kegiatan = urldecode($_GET['id']);
	$a = query("delete from kegiatan where id_kegiatan='$id_kegiatan'");
	if($a){
		setcookie("berhasil", "berhasil menghapus kegiatan", time()+2);
	}else{
		setcookie("gagal", "gagal menghapus kegiatan", time()+2);
	}
	header("location:index.php?h=kegiatan");
}else if($_POST['aksi']=='tambah'){
	$nama = escape($_POST['nama']);
	$tgl_kegiatans = explode("/", escape($_POST['tgl_kegiatan']));
	$tgl_kegiatan = $tgl_kegiatans[2].'-'.$tgl_kegiatans[1].'-'.$tgl_kegiatans[0];
	$gambar = str_replace(" ", "_", $_FILES['gambar']['name']);
	$source = $_FILES['gambar']['tmp_name'];
	$dest = "kegiatan/$gambar";
	if(strlen($gambar)!=0){
		$a = query("insert into kegiatan(nama_kegiatan, tgl_kegiatan, gambar, id_admin) values('$nama', '$tgl_kegiatan', '$gambar', '$_SESSION[adm]')");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("insert into kegiatan(nama_kegiatan, tgl_kegiatan, id_admin) values('$nama', '$tgl_kegiatan', '$_SESSION[adm]')");
	}
	if($a){
		setcookie("berhasil", "berhasil menambah kegiatan", time()+2);
	}else{
		setcookie("gagal", "gagal menambah kegiatan, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=kegiatan");
}else if($_POST['aksi']=='edit'){
	$kode_lama = escape($_POST['kode_lama']);
	$nama = escape($_POST['nama']);
	$tgl_kegiatans = explode("/", escape($_POST['tgl_kegiatan']));
	$tgl_kegiatan = $tgl_kegiatans[2].'-'.$tgl_kegiatans[1].'-'.$tgl_kegiatans[0];
	$gambar = str_replace(" ", "_", $_FILES['gambar']['name']);
	$source = $_FILES['gambar']['tmp_name'];
	$dest = "kegiatan/$gambar";
	if(strlen($gambar)!=0){
		$a = query("update kegiatan set nama_kegiatan='$nama', tgl_kegiatan='$tgl_kegiatan', id_admin='$_SESSION[adm]', gambar='$gambar' where id_kegiatan='$kode_lama'");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("update kegiatan set nama_kegiatan='$nama', tgl_kegiatan='$tgl_kegiatan', id_admin='$_SESSION[adm]' where id_kegiatan='$kode_lama'");
	}
	if($a){
		setcookie("berhasil", "berhasil mengedit kegiatan", time()+2);
	}else{
		setcookie("gagal", "gagal mengedit kegiatan, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=kegiatan");
}
?>