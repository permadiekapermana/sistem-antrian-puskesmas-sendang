
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="POLI.";
$y=substr($pel,0,4);
$query=mysql_query("select * from poli where substr(id_poli,1,4)='$y' order by id_poli desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_poli'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_poli/aksi_poli.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
</div>
<div class='box-body'>

";?>
<div class="container-fluid">

<h3><b>A. Sejarah Singkat</b></h3>
<p>UPT Puskesmas Minggir terletak di dusun Minggir III, desa Sendangagung, Kecamatan Minggir Kabupaten Sleman. meliputi 5 (lima) desa Sendangmulyo, Sendangsari, Sendangrejo, Sendangarum dan Sendangagung. Berdiri sejak tahun 1975.</p>
<h3><b>B. Geografi dan Kependudukan</b></h3>
<h5><b>1. Geografi</b></h5>
<p>Keadaan alam wilayah kecamatan minggir meliputi lahan pertanian dan berada di dekat pegunungan menoreh Kulonprogo. pada zaman dahulu tanaman yang terkenal dan banyak di tanan di lahan persawahan adalah tanaman Mendong. namun seiring berjalanan nya waktu kini tinggal sedikit dan lebih banyak tanaman padi.</p>
<p>Kecamatan Minggir merupakan salah satu diantara 17 kecamatan yang ada di kabupaten sleman, dengan batas wilayah :</p>
<p>Sebelah Utara      : Wilayah Kecamatan Tempel</p>
<p>Sebelah Selatan    : Wilayah Kecamatan Moyudan</p>
<p>Sebelah Barat      : Wilayah kabupaten kulonprogo</p>
<p>Sebelah Timur      : Wilayah Kecamatan Seyegan, Kecamatan Godean dan Kecamatan Moyudan</p>
<h5><b>2. Keadaan Tanah dan Luas Tanah</b></h5>
<p>Keadaan tanah berjenis Grumusal yang kaya akan humus, subur dengan letak ketinggian kurang lebih 165 m diatas permukaan laut. keadaa tanah relatif datar, kemiringan 1-2 ke arah selatan. luas wilayah kecamatan Minggir : 27,27 Km persegi.</p>

</div>
<?php
echo"
</div>
</div>
";

break;

}

}       
        
?>