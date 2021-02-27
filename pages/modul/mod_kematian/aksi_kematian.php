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
if ($module=='Kematian' AND $act=='input'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 

$id_penduduk      = $_POST['id_penduduk'];
$id_kematian      = $_POST['id_kematian'];
$tgl_meninggal    = $_POST['tgl_meninggal'];
$tempat_meninggal = $_POST['tempat_meninggal'];
$jam              = $_POST['jam'];
$dimakamkan_di    = $_POST['dimakamkan_di'];
$keterangan       = $_POST['keterangan'];
$status_penduduk  = 'Meninggal';

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
    UploadKematian($nama_file_unik);

$query=mysql_query("INSERT INTO kematian (id_kematian, id_penduduk, tgl_meninggal, jam, tempat_meninggal, dimakamkan_di, keterangan, file_surat) VALUES ('$id_kematian', '$id_penduduk', '$tgl_meninggal', '$jam', '$tempat_meninggal', '$dimakamkan_di', '$keterangan', '$nama_file_unik')");   
$query=mysql_query("UPDATE penduduk SET status_penduduk='$status_penduduk' WHERE id_penduduk='$id_penduduk'"); 
header('location:../../media.php?module='.$module);

  }
}
  
}


// Update perangkatdesa
elseif ($module=='Kematian' AND $act=='update'){    

  $id_penduduk      = $_POST['id_penduduk'];
  $id_kematian      = $_POST['id_kematian'];
  $tgl_meninggal    = $_POST['tgl_meninggal'];
  $tempat_meninggal = $_POST['tempat_meninggal'];
  $jam              = $_POST['jam'];
  $dimakamkan_di    = $_POST['dimakamkan_di'];
  $keterangan       = $_POST['keterangan'];
  
$query=mysql_query("UPDATE kematian SET tgl_meninggal='$tgl_meninggal', jam='$jam', tempat_meninggal='$tempat_meninggal', dimakamkan_di='$dimakamkan_di', keterangan='$keterangan' WHERE id_penduduk='$id_penduduk'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Kematian' AND $act=='hapus'){

mysql_query("DELETE FROM kematian WHERE id_kematian='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
