
<?php
include "../config/koneksi.php";

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

<h3><b>VISI</b></h3>
<p><b>“MENJADI PUSKESMAS YANG MAMPU MEMBERIKAN PELAYANAN PRIMA DAN BERORIENTASI PADA KESELAMATAN PELANGGAN”</b></p>
<h3><b>MISI</b></h3>
<ol>
  <li>MEMBERIKAN PELAYANAN YANG BERMUTU BAGI MASYARAKAT</li>
  <li>MENJAMIN KESELAMATAN DAN MENINGKATKAN PROFESIONALISME PETUGAS</li>
  <li>MENGEMBANGKAN KERJA SAMA DENGAN UNSUR-UNSUR TERKAIT DI BIDANG KESEHATAN</li>
</ol>

</div>
<?php
echo"
</div>
</div>
";

break;

}
        
?>