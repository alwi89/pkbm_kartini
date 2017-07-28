<?php
session_start();
require_once("koneksi.php");
$id_admin = escape($_SESSION['adm']);
$username = escape($_POST['username']);
$password = escape($_POST['password']);
$a = query("update admin set username='$username', password='$password' where id_admin='$id_admin'");
if($a){
	setcookie("berhasil", "berhasil megedit akun", time()+2);
}else{
	setcookie("gagal", "gagal mengedit akun, ".mysqli_error(), time()+2);
}
header("location:index.php?h=akun");
?>