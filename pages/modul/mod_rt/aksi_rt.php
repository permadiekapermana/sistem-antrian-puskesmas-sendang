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
if ($module=='RT' AND $act=='input'){

$id_rt     = $_POST['id_rt'];
$id_rw     = $_POST['id_rw'];
$rt        = $_POST['rt'];

$query=mysql_query("INSERT INTO rt (id_rt, id_rw, rt) VALUES ('$id_rt', '$id_rw', '$rt')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='RT' AND $act=='update'){    

$id_rt     = $_POST['id_rt'];
$id_rw     = $_POST['id_rw'];
$rt        = $_POST['rt'];
  
$query=mysql_query("UPDATE rt SET id_rw='$id_rw', rt='$rt' WHERE id_rt='$id_rt'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='RT' AND $act=='hapus'){

mysql_query("DELETE FROM rt WHERE id_rt='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
