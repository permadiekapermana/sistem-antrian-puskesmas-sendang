<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update perangkatdesa
if ($module=='Profile' AND $act=='update'){

  if (empty($_POST[password]) ){

  $username     = $_POST['username'];
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $level        = $_POST['level'];
  
  $query=mysql_query("UPDATE users SET nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp' WHERE username='$username'");

  }
  else {

  $username     = $_POST['username'];
  $password     = md5($_POST['password']);
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $level        = $_POST['level'];
  
  $query=mysql_query("UPDATE users SET password='$password', nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp' WHERE username='$username'");

  }							 
  header('location:../../media.php?module='.$module);
    }

}

?>
