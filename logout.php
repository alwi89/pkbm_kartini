<?php
session_start();
unset($_SESSION['adm']);
header("location:login.php");
?>