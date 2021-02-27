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
if ($module=='PerbaikanKIS' AND $act=='update'){    

  $id_kis         = $_POST['id_kis'];
  $id_penduduk    = $_POST['id_penduduk'];
  $id_perbaikan   = $_POST['id_perbaikan'];
  $id_pengajuan   = $_POST['id_pengajuan'];
  $askes          = $_POST['askes'];
  $tgl_pengajuan  = $_POST['tgl_pengajuan'];
  $status         = 'Pending';
  $petugas        = $_SESSION[namauser];
  $status_kis     = 'Kadaluwarsa';
  
  
  $query=mysql_query("INSERT INTO pengajuan_kis (id_pengajuan, id_penduduk, askes, tgl_pengajuan, status, petugas) VALUES ('$id_pengajuan', '$id_penduduk', '$askes', '$tgl_pengajuan', '$status', '$petugas')");
  $query=mysql_query("INSERT INTO perbaikan_kis (id_perbaikan, id_kis, id_pengajuan) VALUES ('$id_perbaikan', '$id_kis', '$id_pengajuan')");    
  $query=mysql_query("UPDATE kis SET status_kis='$status_kis' WHERE id_kis='$id_kis'"); 
  header('location:../../media.php?module='.$module);

}

}

?>
