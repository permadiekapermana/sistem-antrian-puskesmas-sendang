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
if ($module=='Pekerjaan' AND $act=='input'){

$id_pekerjaan     = $_POST['id_pekerjaan'];
$pekerjaan        = $_POST['pekerjaan'];

$query=mysql_query("INSERT INTO pekerjaan (id_pekerjaan, pekerjaan) VALUES ('$id_pekerjaan', '$pekerjaan')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='Pekerjaan' AND $act=='update'){    

$id_pekerjaan     = $_POST['id_pekerjaan'];
$pekerjaan        = $_POST['pekerjaan'];
  
$query=mysql_query("UPDATE pekerjaan SET pekerjaan='$pekerjaan' WHERE id_pekerjaan='$id_pekerjaan'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Pekerjaan' AND $act=='hapus'){

mysql_query("DELETE FROM pekerjaan WHERE id_pekerjaan='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
