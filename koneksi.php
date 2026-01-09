<?php
$host = "sqlXXX.infinityfree.com"; 
$user = "if0_xxxxx";
$pass = "PASSWORD_DB";
$db   = "if0_xxxxx_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
