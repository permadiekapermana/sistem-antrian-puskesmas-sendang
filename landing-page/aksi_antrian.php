<?php
error_reporting(0);
session_start();

include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Input users
if ($module=='Home' AND $act=='input'){

$id_antrian       = $_GET['id_antrian'];
$id_poli          = $_GET['id_poli'];
$status           = 'Dalam Antrian';

$nomor_antrian  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$id_poli' AND tgl_berobat=$tgl_sekarang");
$r              = mysql_fetch_array($nomor_antrian);

if ($r['jumlah']>0) {
  $antrian  = mysql_query("SELECT * FROM `antrian`  WHERE id_poli='$id_poli' ORDER BY id_antrian DESC LIMIT 1");
  $r2       = mysql_fetch_array($antrian);
  $nomor    = $r2[nomor] + 1;
} else {    
  $nomor = 1;
}

$query=mysql_query("INSERT INTO antrian (id_antrian, id_poli, tgl_berobat, jam_mulai, status_antrian, nomor) VALUES ('$id_antrian', '$id_poli', '$tgl_sekarang', '$jam_sekarang', '$status', '$nomor')");
header('location:../landing-page/mod_home/cetak.php');

  
}

?>
