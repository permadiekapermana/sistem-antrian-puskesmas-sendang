<?php

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
include "excel_reader2.php";

$module=$_GET[module];
$act=$_GET[act];

// Input users
if ($module=='Penduduk' AND $act=='input'){

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

$query=mysql_query("INSERT INTO penduduk (id_penduduk, nik, no_kk, nama, tgl_lahir, tmp_lahir, jenis_kelamin, gol_darah, id_agama, id_pekerjaan, id_pendidikan, id_rt, status_nikah, status_tinggal, status_penduduk) VALUES ('$id_penduduk', '$nik', '$no_kk', '$nama', '$tgl_lahir', '$tmp_lahir', '$jenis_kelamin', '$gol_darah', '$id_agama', '$id_pekerjaan', '$id_pendidikan', '$id_rt', '$status_nikah', '$status_tinggal', '$status_penduduk')");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='Penduduk' AND $act=='update'){    

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
  
$query=mysql_query("UPDATE penduduk SET nik='$nik', no_kk='$no_kk', nama='$nama', tgl_lahir='$tgl_lahir', tmp_lahir='$tmp_lahir', jenis_kelamin='$jenis_kelamin', gol_darah='$gol_darah', id_agama='$id_agama', id_pekerjaan='$id_pekerjaan', id_pendidikan='$id_pendidikan', id_rt='$id_rt', status_nikah='$status_nikah', status_tinggal='$status_tinggal' WHERE id_penduduk='$id_penduduk'"); 							 
header('location:../../media.php?module='.$module);

}

elseif ($module=='Penduduk' AND $act=='hapus'){

mysql_query("DELETE FROM penduduk WHERE id_penduduk='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

elseif ($module=='Penduduk' AND $act=='import'){

$pel="PDDK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from penduduk where substr(id_penduduk,1,4)='$y' order by id_penduduk desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_penduduk'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

// upload file xls
$target = basename($_FILES['filependuduk']['name']) ;
move_uploaded_file($_FILES['filependuduk']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filependuduk']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filependuduk']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
  $id_penduduk    = $data->val($i, 1);
	$nik            = $data->val($i, 2);
	$no_kk          = $data->val($i, 3);
  $nama           = $data->val($i, 4);
  $tgl_lahir      = $data->val($i, 5);
  $tmp_lahir      = $data->val($i, 6);
  $jenis_kelamin  = $data->val($i, 7);
  $gol_darah      = $data->val($i, 8);
  $id_agama       = $data->val($i, 9);
  $id_pekerjaan   = $data->val($i, 10);
  $id_pendidikan  = $data->val($i, 11);
  $id_rt          = $data->val($i, 12);
  $status_nikah   = $data->val($i, 13);
  $status_tinggal = $data->val($i, 14);
  $status_penduduk= $data->val($i, 15);
 
	if($id_penduduk != "" && $nik != "" && $no_kk != "" && $nama != "" && $tgl_lahir != "" && $tmp_lahir != "" && $jenis_kelamin != "" && $gol_darah != "" && $id_agama != "" && $id_pekerjaan != "" && $id_pendidikan != "" && $id_rt != "" && $status_nikah != "" && $status_tinggal != "" && $status_penduduk != ""){
		// input data ke database (table data_pegawai)
		mysql_query("INSERT INTO penduduk (id_penduduk, nik, no_kk, nama, tgl_lahir, tmp_lahir, jenis_kelamin, gol_darah, id_agama, id_pekerjaan, id_pendidikan, id_rt, status_nikah, status_tinggal, status_penduduk) values('$id_penduduk','$nik', '$no_kk', '$nama', '$tgl_lahir', '$tmp_lahir', '$jenis_kelamin', '$gol_darah', '$id_agama', '$id_pekerjaan', '$id_pendidikan', '$id_rt', '$status_nikah', '$status_tinggal', '$status_penduduk')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filependuduk']['name']);

header('location:../../media.php?module='.$module);

}

}

?>
