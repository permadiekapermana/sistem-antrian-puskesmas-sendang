
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="PVER.";
$y=substr($pel,0,4);
$query=mysql_query("select * from penduduk_update where substr(id_update,1,4)='$y' order by id_update desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_update'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_verpenduduk/aksi_verpenduduk.php";

switch($_GET[act]){
  // Tampil desa
  default:

  
echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Pengajuan KIS</h3> <br> <br>
  <form class='form-horizontal' action='modul/mod_laporan/cetaklap_kis.php' target='_blank' method='post'>
                    
  <fieldset>
    <div class='control-group'>
      <div class='controls'>
        <div class='input-prepend input-group'>
          <input type='date' style='width: 200px' name='dari'  class='form-control' title='Dari tanggal' required/>
          <input type='date' style='width: 200px' name='sampai'  class='form-control' title='Sampai tanggal' required/>
          <button class='btn btn-primary' type='submit'><i class='fa fa-print'></i> Cetak</button>
        </div>
      </div>
    </div>
  </fieldset>
</form>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Pengajuan</th>
      <th>NIK Penduduk</th>
      <th>Nama</th>
      <th>Tanggal Pengajuan</th>
      <th>Status Pengajuan</th>
    </tr>
    </thead>
    <tbody>";
    if ($_SESSION['leveluser']!='penduduk'){
    $tampil = mysql_query("SELECT * FROM `pengajuan_kis`
                          INNER JOIN `penduduk` ON `pengajuan_kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                          WHERE status='Selesai' ORDER BY id_pengajuan DESC");
    }
    elseif ($_SESSION['leveluser']=='penduduk'){
      $tampil = mysql_query("SELECT * FROM `pengajuan_kis`
                          INNER JOIN `penduduk` ON `pengajuan_kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                          WHERE status='Selesai' AND penduduk.id_penduduk='$_SESSION[id_penduduk]' ORDER BY id_pengajuan DESC");
    }

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_pengajuan]</td>
      <td>$r[nik]</td>
      <td>$r[nama]</td>
      <td>$r[tgl_pengajuan]</td>
      <td>$r[status]</td>
    </tr>";
    $no++;
    }
    echo"
    </tbody>
  </table>
</div>
</div>
";

}

}       
        
?>


                
               
        
        
        