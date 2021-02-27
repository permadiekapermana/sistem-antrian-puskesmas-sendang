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
if ($module=='VerifPenduduk' AND $act=='input'){

$id_update      = $_POST['id_update'];
$id_penduduk    = $_POST['id_penduduk'];
$nik            = $_POST['nik'];
$no_kk          = $_POST['no_kk'];
$nama           = $_POST['nama'];
$tmp_lahir      = $_POST['tmp_lahir'];
$tgl_lahir      = $_POST['tgl_lahir'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$gol_darah      = $_POST['gol_darah'];
$id_agama       = $_POST['id_agama'];
$id_pekerjaan   = $_POST['id_pekerjaan'];
$id_pendidikan  = $_POST['id_pendidikan'];
$id_rt          = $_POST['id_rt'];
$status_nikah   = $_POST['status_nikah'];
$status_tinggal = $_POST['status_tinggal'];
$status_verif   = 'Pending';
$puskesos       = $_SESSION[namauser];


$query=mysql_query("INSERT INTO penduduk_update (id_update, id_penduduk, nik, no_kk, nama, tgl_lahir, tmp_lahir, jenis_kelamin, gol_darah, id_agama, id_pekerjaan, id_pendidikan, id_rt, status_nikah, status_tinggal, tgl_perbaikan, status_perbaikan, puskesos) VALUES ('$id_update', '$id_penduduk', '$nik', '$no_kk', '$nama', '$tgl_lahir', '$tmp_lahir', '$jenis_kelamin', '$gol_darah', '$id_agama', '$id_pekerjaan', '$id_pendidikan', '$id_rt', '$status_nikah', '$status_tinggal', '$tgl_sekarang', '$status_verif', '$puskesos')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='VerifPenduduk' AND $act=='update'){    

  $id_update      = $_POST['id_update'];
  $id_penduduk    = $_POST['id_penduduk'];
  $nik            = $_POST['nik'];
  $no_kk          = $_POST['no_kk'];
  $nama           = $_POST['nama'];
  $tmp_lahir      = $_POST['tmp_lahir'];
  $tgl_lahir      = $_POST['tgl_lahir'];
  $jenis_kelamin  = $_POST['jenis_kelamin'];
  $gol_darah      = $_POST['gol_darah'];
  $id_agama       = $_POST['id_agama'];
  $id_pekerjaan   = $_POST['id_pekerjaan'];
  $id_pendidikan  = $_POST['id_pendidikan'];
  $id_rt          = $_POST['id_rt'];
  $status_nikah   = $_POST['status_nikah'];
  $status_tinggal = $_POST['status_tinggal'];
  $status_verif   = 'Pending';
  $puskesos       = $_SESSION[namauser];
  
$query=mysql_query("UPDATE penduduk_update SET nik='$nik', no_kk='$no_kk', nama='$nama', tgl_lahir='$tgl_lahir', tmp_lahir='$tmp_lahir', jenis_kelamin='$jenis_kelamin', gol_darah='$gol_darah', id_agama='$id_agama', id_pekerjaan='$id_pekerjaan', id_pendidikan='$id_pendidikan', id_rt='$id_rt', status_nikah='$status_nikah', status_tinggal='$status_tinggal', tgl_perbaikan='$tgl_sekarang', status_perbaikan='$status_verif', keterangan='' WHERE id_update='$id_update'"); 							 
header('location:../../media.php?module='.$module);

}

}

?>
