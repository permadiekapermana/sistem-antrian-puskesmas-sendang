
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

switch($_GET[act]){
  default:

  
echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Riwayat Antrian Berobat</h3> <br> <br>
  <form class='form-horizontal' action='modul/mod_laporan/cetak.php' target='_blank' method='post'>
                    
  <fieldset>
    <div class='control-group'>
      <div class='controls'>
        <div class='input-prepend input-group'>
          <a href='modul/mod_laporan/cetak.php' target='_blank' class='btn btn-primary'><i class='fa fa-print'></i> Cetak</a>
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
      <th>ID Antrian</th>
      <th>Nama Pasien</th>
      <th>Tanggal Berobat</th>
      <th>Nomor Antrian</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>      
      <th>Status Antrian</th> 
      <th>Diproses Oleh</th> 
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `antrian`
              INNER JOIN `poli` ON `antrian`.`id_poli` = `poli`.`id_poli`
              ORDER BY id_antrian DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_antrian]</td>
      <td>$r[nama]</td>
      <td>$r[tgl_berobat]</td>
      <td>$r[kode_poli]$r[nomor]</td>
      <td>$r[jam_mulai]</td>
      <td>$r[jam_selesai]</td>
      <td>$r[status_antrian]</td> 
      <td>$r[username]</td> 
    </tr>";
    $no++;
    }
    echo"
    </tbody>
  </table>
</div>
</div>";

}

}       
        
?>