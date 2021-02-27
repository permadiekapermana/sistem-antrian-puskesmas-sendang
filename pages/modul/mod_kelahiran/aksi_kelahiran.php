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
if ($module=='Kelahiran' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

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
$status_penduduk= 'Hidup';

$id_kelahiran   = $_POST['id_kelahiran'];
$ayah           = $_POST['ayah'];
$ibu            = $_POST['ibu'];
$jam            = $_POST['jam'];
$lahir_di       = $_POST['lahir_di'];
$nama_bidan     = $_POST['nama_bidan'];
$keterangan     = $_POST['keterangan'];
$year = strtok($tgl_lahir, '-');

if (!empty($lokasi_file)){
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
  echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
  }
  else{
    UploadKelahiran($nama_file_unik);

if (strtotime($tgl_lahir) > strtotime('now')){
  echo "<script>alert('Tanggal Lahir tidak Valid, Mohon masukkan tanggal valid !');history.go(-2)</script>";
}
else{

mysql_query("INSERT INTO penduduk (id_penduduk, nik, no_kk, nama, tgl_lahir, tmp_lahir, jenis_kelamin, gol_darah, id_agama, id_pekerjaan, id_pendidikan, id_rt, status_nikah, status_tinggal, status_penduduk) VALUES ('$id_penduduk', '$nik', '$no_kk', '$nama', '$tgl_lahir', '$tmp_lahir', '$jenis_kelamin', '$gol_darah', '$id_agama', '$id_pekerjaan', '$id_pendidikan', '$id_rt', '$status_nikah', '$status_tinggal', '$status_penduduk')");
mysql_query("INSERT INTO kelahiran (id_kelahiran, id_penduduk, ayah, ibu, jam, lahir_di, nama_bidan, keterangan, file_kelahiran) VALUES ('$id_kelahiran', '$id_penduduk', '$ayah', '$ibu', '$jam', '$lahir_di', '$nama_bidan', '$keterangan', '$nama_file_unik')");  
header('location:../../media.php?module='.$module);

}
}

}
  
}

// Update perangkatdesa
elseif ($module=='Kelahiran' AND $act=='update'){    

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

$id_kelahiran   = $_POST['id_kelahiran'];
$ayah           = $_POST['ayah'];
$ibu            = $_POST['ibu'];
$jam            = $_POST['jam'];
$lahir_di       = $_POST['lahir_di'];
$nama_bidan     = $_POST['nama_bidan'];
$keterangan     = $_POST['keterangan'];
  
$query=mysql_query("UPDATE penduduk SET nik='$nik', no_kk='$no_kk', nama='$nama', tgl_lahir='$tgl_lahir', tmp_lahir='$tmp_lahir', jenis_kelamin='$jenis_kelamin', gol_darah='$gol_darah', id_agama='$id_agama', id_pekerjaan='$id_pekerjaan', id_pendidikan='$id_pendidikan', id_rt='$id_rt', status_nikah='$status_nikah', status_tinggal='$status_tinggal' WHERE id_penduduk='$id_penduduk'"); 	
$query=mysql_query("UPDATE kelahiran SET ayah='$ayah', ibu='$ibu', jam='$jam', lahir_di='$lahir_di', nama_bidan='$nama_bidan', keterangan='$keterangan' WHERE id_kelahiran='$id_kelahiran'"); 									 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Kelahiran' AND $act=='hapus'){

mysql_query("DELETE FROM kelahiran WHERE id_kelahiran='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
