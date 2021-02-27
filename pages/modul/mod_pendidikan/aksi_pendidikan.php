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
if ($module=='Pendidikan' AND $act=='input'){

$id_pendidikan     = $_POST['id_pendidikan'];
$pendidikan        = $_POST['pendidikan'];

$query=mysql_query("INSERT INTO pendidikan (id_pendidikan, pendidikan) VALUES ('$id_pendidikan', '$pendidikan')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='Pendidikan' AND $act=='update'){    

$id_pendidikan     = $_POST['id_pendidikan'];
$pendidikan        = $_POST['pendidikan'];
  
$query=mysql_query("UPDATE pendidikan SET pendidikan='$pendidikan' WHERE id_pendidikan='$id_pendidikan'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Pendidikan' AND $act=='hapus'){

mysql_query("DELETE FROM pendidikan WHERE id_pendidikan='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
