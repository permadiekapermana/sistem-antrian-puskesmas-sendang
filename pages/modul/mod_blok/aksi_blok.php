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
if ($module=='Blok' AND $act=='input'){

$id_blok     = $_POST['id_blok'];
$blok        = $_POST['blok'];

$query=mysql_query("INSERT INTO blok (id_blok, blok) VALUES ('$id_blok', '$blok')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='Blok' AND $act=='update'){    

$id_blok     = $_POST['id_blok'];
$blok        = $_POST['blok'];
  
$query=mysql_query("UPDATE blok SET blok='$blok' WHERE id_blok='$id_blok'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Blok' AND $act=='hapus'){

mysql_query("DELETE FROM blok WHERE id_blok='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
