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
if ($module=='RW' AND $act=='input'){

$id_rw     = $_POST['id_rw'];
$id_blok   = $_POST['id_blok'];
$rw        = $_POST['rw'];

$query=mysql_query("INSERT INTO rw (id_rw, id_blok, rw) VALUES ('$id_rw', '$id_blok', '$rw')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='RW' AND $act=='update'){    

$id_rw     = $_POST['id_rw'];
$id_blok   = $_POST['id_blok'];
$rw        = $_POST['rw'];
  
$query=mysql_query("UPDATE rw SET id_blok='$id_blok', rw='$rw' WHERE id_rw='$id_rw'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='RW' AND $act=='hapus'){

mysql_query("DELETE FROM rw WHERE id_rw='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
