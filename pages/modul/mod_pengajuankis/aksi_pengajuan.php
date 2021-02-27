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
if ($module=='PengajuanKIS' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $lokasi_file2    = $_FILES['fupload2']['tmp_name'];
  $tipe_file2      = $_FILES['fupload2']['type'];
  $nama_file2      = $_FILES['fupload2']['name'];
  $acak2           = rand(1,99);
  $nama_file_unik2 = $acak2.$nama_file2; 

  $lokasi_file3    = $_FILES['fupload3']['tmp_name'];
  $tipe_file3      = $_FILES['fupload3']['type'];
  $nama_file3      = $_FILES['fupload3']['name'];
  $acak3           = rand(1,99);
  $nama_file_unik3 = $acak3.$nama_file3; 

  $lokasi_file4    = $_FILES['fupload4']['tmp_name'];
  $tipe_file4      = $_FILES['fupload4']['type'];
  $nama_file4      = $_FILES['fupload4']['name'];
  $acak4           = rand(1,99);
  $nama_file_unik4 = $acak4.$nama_file3; 

$id_pengajuan   = $_POST['id_pengajuan'];
$id_penduduk    = $_POST['id_penduduk'];
$askes          = $_POST['askes'];
$tgl_pengajuan  = $_POST['tgl_pengajuan'];
$status         = 'Pending';
$petugas        = $_SESSION[namauser];

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
  UploadKK($nama_file_unik);
  UploadPBB($nama_file_unik2);
  UploadKTP($nama_file_unik3);
  UploadStrukListrik($nama_file_unik4);

$query=mysql_query("INSERT INTO pengajuan_kis (id_pengajuan, id_penduduk, askes, tgl_pengajuan, status, petugas, file_kk, file_pbb, file_ktp, file_listrik) VALUES ('$id_pengajuan', '$id_penduduk', '$askes', '$tgl_pengajuan', '$status', '$petugas', '$nama_file_unik', '$nama_file_unik2', '$nama_file_unik3', '$nama_file_unik4')");   
header('location:../../media.php?module='.$module);

  }
}
  
}

// Update perangkatdesa
elseif ($module=='PengajuanKIS' AND $act=='confirm'){    

  $id_pengajuan   = $_POST['id_pengajuan'];
  $tgl_konfirmasi = $_POST['tgl_konfirmasi'];
  $status         = 'Selesai';
  $validator        = $_POST['validator'];

  if (strtotime($tgl_konfirmasi) > strtotime('now')){
    echo "<script>alert('Tanggal Konfirmasi tidak Valid, Mohon masukkan tanggal valid !');history.go(-1)</script>";
  }
  else{
  
$query=mysql_query("UPDATE pengajuan_kis SET tgl_konfirmasi='$tgl_konfirmasi', status='$status', validator='$validator' WHERE id_pengajuan='$id_pengajuan'"); 							 
header('location:../../media.php?module='.$module);

  }

}

}

?>
