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
if ($module=='KIS' AND $act=='input'){

$id_kis         = $_POST['id_kis'];
$id_penduduk    = $_POST['id_penduduk'];
$nomor_kartu    = $_POST['nomor_kartu'];
$tingkat        = $_POST['tingkat'];
$tgl_berlaku    = $_POST['tgl_berlaku'];
$tgl_kadaluwarsa= $_POST['tgl_kadaluwarsa'];
$status_kis     = 'Berlaku';

$query=mysql_query("INSERT INTO kis (id_kis, id_penduduk, nomor_kartu, tingkat, tgl_berlaku, tgl_kadaluwarsa, status_kis) VALUES ('$id_kis', '$id_penduduk', '$nomor_kartu', '$tingkat', '$tgl_berlaku', '$tgl_kadaluwarsa', '$status_kis')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='KIS' AND $act=='update'){    

  $id_kis         = $_POST['id_kis'];
  $id_penduduk    = $_POST['id_penduduk'];
  $nomor_kartu    = $_POST['nomor_kartu'];
  $tingkat        = $_POST['tingkat'];
  $tgl_berlaku    = $_POST['tgl_berlaku'];
  $tgl_kadaluwarsa= $_POST['tgl_kadaluwarsa'];  
  
$query=mysql_query("UPDATE kis SET nomor_kartu='$nomor_kartu', tingkat='$tingkat', tgl_berlaku='$tgl_berlaku', tgl_kadaluwarsa='$tgl_kadaluwarsa' WHERE id_kis='$id_kis'"); 							 
header('location:../../media.php?module='.$module);

}

}

?>
