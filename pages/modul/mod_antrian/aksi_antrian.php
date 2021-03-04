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
if ($module=='PanggilAntrian' AND $act=='next'){

$id_antrian     = $_GET['id_antrian'];

$query=mysql_query("UPDATE antrian SET status_antrian='Dipanggil' WHERE id_antrian='$id_antrian'");   
header('location:../../media.php?module='.$module);
  
}

// Update perangkatdesa
elseif ($module=='PanggilAntrian' AND $act=='selesai'){    

$id_antrian     = $_GET['id_antrian'];
$operator       = $_SESSION[namauser];

$query=mysql_query("UPDATE antrian SET status_antrian='Selesai', jam_selesai='$jam_sekarang', username='$operator' WHERE id_antrian='$id_antrian'");   
header('location:../../media.php?module='.$module);

}

elseif ($module=='PanggilAntrian' AND $act=='pergi'){    

$id_antrian     = $_GET['id_antrian'];
$operator       = $_SESSION[namauser];

$query=mysql_query("UPDATE antrian SET status_antrian='Selesai', username='$operator' WHERE id_antrian='$id_antrian'");   
header('location:../../media.php?module='.$module);

}

elseif ($module=='PanggilAntrian' AND $act=='tunda'){    

$id_antrian     = $_GET['id_antrian'];

$query=mysql_query("UPDATE antrian SET status_antrian='Tunda' WHERE id_antrian='$id_antrian'");   
header('location:../../media.php?module='.$module);

}

elseif ($module=='Agama' AND $act=='hapus'){

mysql_query("DELETE FROM agama WHERE id_agama='$_GET[id]'");
header('location:../../media.php?module='.$module);

}

}

?>
