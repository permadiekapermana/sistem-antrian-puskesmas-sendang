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

$aksi="modul/mod_kis/aksi_kis.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data KIS</h3> <br> <br>
  <a href='?module=KIS&act=pilihpenduduk'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
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
                          WHERE tgl_kadaluwarsa>NOW()
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
      <td width='14%'>        
        <a href='?module=KIS&act=info&id=$r[id_kis]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Lihat Detail</a>            <a href='?module=KIS&act=edit&id=$r[id_kis]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a> 
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

case "pilihpenduduk":
echo"

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data KIS</h3> <br> <br>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>NIK Penduduk</th>
      <th>Nama</th>
      <th>Tempat, Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>";

    $tgl_now = date('Y-m-d');
    $tampil = mysql_query("SELECT * FROM `penduduk` WHERE status_penduduk='Hidup' AND id_penduduk NOT IN (SELECT id_penduduk FROM kis WHERE status_kis='Berlaku')");
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[nik]</td>
      <td>$r[nama]</td>
      <td>$r[tmp_lahir], $r[tgl_lahir]</td>
      <td>$r[jenis_kelamin]</td>
      <td width='11%'>  
        <a href='?module=KIS&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a>     
        <a href='?module=KIS&act=tambahkis&id=$r[id_penduduk]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Pilih</a>
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
  
case "tambahkis":

$edit = mysql_query("SELECT * FROM penduduk WHERE id_penduduk='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form  role='form' method='POST' action='$aksi?module=KIS&act=input' enctype='multipapenduduk/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data KIS</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_kis'>ID KIS</label>
        <input type='text' class='form-control' name='id_kis' id='id_kis' value='$nopel' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_kis' id='id_kis' value='$nopel' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='id_penduduk'>ID Penduduk</label>
        <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk] - $r[nama]' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='nomor_kartu'>Nomor Kartu</label>
        <input type='text' class='form-control' name='nomor_kartu' id='nomor_kartu' placeholder='Masukkan Nomor Kartu' required>
      </div>
      <div class='form-group'>
      <label for='tingkat'>Tingkat</label>
        <input type='text' class='form-control' name='tingkat' id='tingkat' placeholder='Masukkan Tingkat' required>
      </div>
      <div class='form-group'>
      <label for='tgl_berlaku'>Tanggal Berlaku</label>
        <input type='date' class='form-control' name='tgl_berlaku' id='tgl_berlaku' value='"; echo date('Y-m-d'); echo"' placeholder='Masukkan Tanggal Pengajuan' required>
      </div>
      <div class='form-group'>
      <label for='tgl_kadaluwarsa'>Tanggal Kadaluwarsa</label>
        <input type='date' class='form-control' name='tgl_kadaluwarsa' id='tgl_kadaluwarsa' placeholder='Masukkan Tanggal Pengajuan' required>
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

case "edit":

  $edit = mysql_query("SELECT * FROM `kis`
                      INNER JOIN `penduduk` ON `kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                      WHERE id_kis='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
  
  echo"
  <form  role='form' method='POST' action='$aksi?module=KIS&act=update' enctype='multipapenduduk/form-data'>
  
  <div class='box'>
  <div class='box-header'>
    <h3 class='box-title'>Edit Data KIS</h3>
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
        <label for='id_penduduk'>ID Penduduk</label>
          <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk] - $r[nama]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='nomor_kartu'>Nomor Kartu</label>
          <input type='text' class='form-control' name='nomor_kartu' id='nomor_kartu' value='$r[nomor_kartu]' placeholder='Masukkan Nomor Kartu' required>
        </div>
        <div class='form-group'>
        <label for='tingkat'>Tingkat</label>
          <input type='text' class='form-control' name='tingkat' id='tingkat' value='$r[tingkat]' placeholder='Masukkan Tingkat' required>
        </div>
        <div class='form-group'>
        <label for='tgl_berlaku'>Tanggal Berlaku</label>
          <input type='date' class='form-control' name='tgl_berlaku' id='tgl_berlaku' value='$r[tgl_berlaku]' placeholder='Masukkan Tanggal Pengajuan' required>
        </div>
        <div class='form-group'>
        <label for='tgl_kadaluwarsa'>Tanggal Kadaluwarsa</label>
          <input type='date' class='form-control' name='tgl_kadaluwarsa' value='$r[tgl_kadaluwarsa]' id='tgl_kadaluwarsa' placeholder='Masukkan Tanggal Pengajuan' required>
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

case "infopenduduk":

  $edit = mysql_query("SELECT * FROM `penduduk`
  INNER JOIN `rt` ON `penduduk`.`id_rt` = `rt`.`id_rt`
  INNER JOIN `rw` ON `rt`.`id_rw` = `rw`.`id_rw`
  INNER JOIN `blok` ON `rw`.`id_blok` = `blok`.`id_blok`
  INNER JOIN `agama` ON `penduduk`.`id_agama` = `agama`.`id_agama`
  INNER JOIN `pendidikan` ON `penduduk`.`id_pendidikan` =
    `pendidikan`.`id_pendidikan`
  INNER JOIN `pekerjaan` ON `penduduk`.`id_pekerjaan` =
    `pekerjaan`.`id_pekerjaan`
  WHERE id_penduduk='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo "
<div class='box'>
<div class='box-header'>
<h3 class='box-title'>Detail Penduduk</h3>
</div>
<div class='box-body'>

<h3>A. Data Pribadi</h3>
<table class='table table-striped'>
<tr>
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
<th>Tempat Lahir</th>
<td>:</td>
<td>$r[tmp_lahir]</td>
</tr>
<tr>
<th>Tanggal Lahir</th>
<td>:</td>
<td>
$r[tgl_lahir]
</td>
</tr>
<tr>
<th>Jenis Kelamin</th>
<td>:</td>
<td>$r[jenis_kelamin]</td>
</tr>
</table>

<h3>B. Data Alamat</h3>
<table class='table table-striped'>
<tr>
<th width='20%'>Alamat</th>
<td width='1%'>:</td>
<td>Desa Kemlaka Gede Blok $r[blok] RT $r[rt] / RW $r[rw] Kecamatan Tengahtani</td>
</tr>
<tr>
<th>Blok</th>
<td>:</td>
<td>$r[blok]</td>
</tr>
<tr>
<th>RT</th>
<td>:</td>
<td>$r[rt]</td>
</tr>
<tr>
<th>RW</th>
<td>:</td>
<td>$r[rw]</td>
</tr>      
</table>

<h3>C. Data Lain-lain</h3>
<table class='table table-striped'>
<tr>
<th width='20%'>Golongan Darah</th>
<td width='1%'>:</td>
<td>$r[gol_darah]</td>
</tr>
<tr>
<th>Agama</th>
<td>:</td>
<td>$r[agama]</td>
</tr>
<tr>
<th>Pendidikan</th>
<td>:</td>
<td>$r[pendidikan]</td>
</tr>
<tr>
<th>Pekerjaan</th>
<td>:</td>
<td>$r[pekerjaan]</td>
</tr>
<tr>
<th>Status Nikah</th>
<td>:</td>
<td>$r[status_nikah]</td>
</tr>
<tr>
<th>Status Tinggal</th>
<td>:</td>
<td>$r[status_tinggal]</td>
</tr>
</table>

</div>
</div>

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


                
               
        
        
        