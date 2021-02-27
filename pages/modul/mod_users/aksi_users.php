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

// Input users
if ($module=='Users' AND $act=='input'){

$username     = $_POST['username'];
$password     = md5($_POST['password']);
$nama_lengkap = $_POST['nama_lengkap'];
$no_telp      = $_POST['no_telp'];
$email        = $_POST['email'];
$level        = $_POST['level'];
$user_aktif   = 'Y';

$query=mysql_query("INSERT INTO users (username, password, nama_lengkap, email, no_telp, level, user_aktif) VALUES ('$username', '$password',  '$nama_lengkap', '$email', '$no_telp', '$level', '$user_aktif')");
header('location:../../media.php?module='.$module);

  
}

// Update perangkatdesa
elseif ($module=='Users' AND $act=='update'){

  if (empty($_POST[password]) ){

  $username     = $_POST['username'];
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $level        = $_POST['level'];
  $user_aktif   = $_POST['user_aktif'];
  
  $query=mysql_query("UPDATE users SET nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp', level='$level', user_aktif='$user_aktif' WHERE username='$username'");

  }
  else {

  $username     = $_POST['username'];
  $password     = md5($_POST['password']);
  $nama_lengkap = $_POST['nama_lengkap'];
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];
  $level        = $_POST['level'];
  $user_aktif   = $_POST['user_aktif'];
  
  $query=mysql_query("UPDATE users SET password='$password', nama_lengkap = '$nama_lengkap', email = '$email', no_telp ='$no_telp', level='$level', user_aktif='$user_aktif' WHERE username='$username'");

  }							 
  header('location:../../media.php?module='.$module);
    }

}

?>
