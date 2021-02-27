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

if ($module=='Poli' AND $act=='input'){

$id_poli     = $_POST['id_poli'];
$kode_poli        = $_POST['kode_poli'];
$nama_poli        = $_POST['nama_poli'];
$max_perhari        = $_POST['max_perhari'];

$query=mysql_query("INSERT INTO poli (id_poli, kode_poli, nama_poli, max_perhari) VALUES ('$id_poli', '$kode_poli', '$nama_poli', '$max_perhari')");   
header('location:../../media.php?module='.$module);
  
}

elseif ($module=='Poli' AND $act=='update'){    

$id_poli     = $_POST['id_poli'];
$kode_poli        = $_POST['kode_poli'];
$nama_poli        = $_POST['nama_poli'];
$max_perhari        = $_POST['max_perhari'];
  
$query=mysql_query("UPDATE poli SET kode_poli='$kode_poli', nama_poli='$nama_poli', max_perhari='$max_perhari' WHERE id_poli='$id_poli'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Poli' AND $act=='hapus'){

mysql_query("DELETE FROM poli WHERE id_poli='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
