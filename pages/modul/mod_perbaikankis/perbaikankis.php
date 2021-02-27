<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="NKIS.";
$y=substr($pel,0,4);
$query=mysql_query("select * from kis where substr(id_kis,1,4)='$y' order by id_kis desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_kis'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$pel2="PKIS.";
$y2=substr($pel2,0,4);
$query2=mysql_query("select * from pengajuan_kis where substr(id_pengajuan,1,4)='$y2' order by id_pengajuan desc limit 0,1");
$row2=mysql_num_rows($query2);
$data2=mysql_fetch_array($query2);
if ($row2>0){
$no2=substr($data2['id_pengajuan'],-6)+1;}
else{
$no2=1;
}
$nourut2=1000000+$no2;
$nopel2=$pel2.substr($nourut2,-6);

$pel3="FIXK.";
$y3=substr($pel3,0,4);
$query3=mysql_query("select * from perbaikan_kis where substr(id_perbaikan,1,4)='$y3' order by id_perbaikan desc limit 0,1");
$row3=mysql_num_rows($query3);
$data3=mysql_fetch_array($query3);
if ($row3>0){
$no3=substr($data3['id_perbaikan'],-6)+1;}
else{
$no3=1;
}
$nourut3=1000000+$no3;
$nopel3=$pel3.substr($nourut3,-6);

$aksi="modul/mod_perbaikankis/aksi_perbaikankis.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Perbaikan Data KIS</h3> <br> <br>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID KIS</th>
      <th>Penduduk</th>
      <th>Nomor Kartu</th>
      <th>Tanggal Berlaku</th>
      <th>Tanggal Kadaluwarsa</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `kis`
                          INNER JOIN `penduduk` ON `kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                          WHERE status_kis='Berlaku' AND tgl_kadaluwarsa<NOW()
                          ORDER BY id_kis DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_kis]</td>
      <td>$r[nik] - $r[nama]</td>
      <td>$r[nomor_kartu]</td>
      <td>$r[tgl_berlaku]</td>
      <td>$r[tgl_kadaluwarsa]</td>
      <td width='16%'>        
        <a href='?module=PerbaikanKIS&act=info&id=$r[id_kis]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Lihat Detail</a>   <a href='?module=PerbaikanKIS&act=edit&id=$r[id_kis]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Ajukan</a> 
      </td>
    </tr>";
    $no++;
    }
    echo"
    </tbody>
  </table>
</div>
</div>
";

break;

case "edit":

  $edit = mysql_query("SELECT * FROM `kis`
                      INNER JOIN `penduduk` ON `kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                      WHERE id_kis='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
  
  echo"
  <form  role='form' method='POST' action='$aksi?module=PerbaikanKIS&act=update' enctype='multipapenduduk/form-data'>
  
  <div class='box'>
  <div class='box-header'>
    <h3 class='box-title'>Verifikasi Perbaikan Data KIS</h3>
  </div>
  <div class='row'>
    <div class='col-md-6'>
      <div class='box-body'>
        <div class='form-group'>
        <label for='id_kis'>ID KIS</label>
          <input type='text' class='form-control' name='id_kis' id='id_kis' value='$r[id_kis]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_kis' id='id_kis' value='$r[id_kis]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='id_pengajuan'>ID Pengajuan KIS</label>
          <input type='text' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$nopel2' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$nopel2' placeholder='Masukkan ID penduduk'>
          <input type='hidden' class='form-control' name='id_perbaikan' id='id_pengajuan' value='$nopel3' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='id_penduduk'>ID Penduduk</label>
          <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk] - $r[nama]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='askes'>ASKES</label>
          <input type='text' class='form-control' name='askes' id='askes' placeholder='Masukkan ASKES' required>
        </div>
        <div class='form-group'>
        <label for='tgl_pengajuan'>Tanggal Pengajuan</label>
          <input type='date' class='form-control' name='tgl_pengajuan' id='tgl_pengajuan' value='"; echo date('Y-m-d'); echo"' placeholder='Masukkan Tanggal Pengajuan' required>
        </div>
        
        <div class='ln_solid'></div>
        <div class='form-group'>
          <button class='btn btn-danger' type='button' onclick=self.history.back()>Cancel</button>
          <button class='btn btn-warning' type='reset'>Reset</button>
          <button type='submit' class='btn btn-success'>Submit</button>        
        </div>  
      </div>
    </div>
  </div>
  </div>
  
  </form>
  ";
  
break;

case "info":

  $edit = mysql_query("SELECT * FROM `kis`
                      INNER JOIN `penduduk` ON `kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                      WHERE id_kis='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

echo "
<div class='box'>
<div class='box-header'>
<h3 class='box-title'>Detail KIS</h3>
</div>
<div class='box-body'>

<table class='table table-striped'>
<tr>
<th width='20%'>Nomor Kartu Indonesia Sehat</th>
<td width='1%'>:</td>
<td>$r[nomor_kartu]</td>
</tr>
<th width='20%'>NIK</th>
<td width='1%'>:</td>
<td>$r[nik]</td>
</tr>
<tr>
<th>Nama Warga</th>
<td>:</td>
<td>$r[nama]</td>
</tr>
<tr>
<th>Tingkat</th>
<td>:</td>
<td>$r[tingkat]</td>
</tr>
<tr>
<th>Tanggal Berlaku</th>
<td>:</td>
<td>
$r[tgl_berlaku]
</td>
</tr>
<tr>
<th>Tanggal Kadaluwarsa</th>
<td>:</td>
<td>$r[tgl_kadaluwarsa]</td>
</tr>
</table>

</div>
</div>

";

break;

}

}       
        
?>


                
               
        
        
        