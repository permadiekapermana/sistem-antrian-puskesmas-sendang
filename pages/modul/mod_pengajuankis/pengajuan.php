<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="PKIS.";
$y=substr($pel,0,4);
$query=mysql_query("select * from pengajuan_kis where substr(id_pengajuan,1,4)='$y' order by id_pengajuan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_pengajuan'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_pengajuankis/aksi_pengajuan.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Pengajuan KIS</h3> <br> <br>
  <a href='?module=PengajuanKIS&act=pilihpenduduk'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
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
      <th>Status Pengajuan</th>";
      
      if ($_SESSION['leveluser']!='penduduk'){        
      echo"
      <th>Action</th>";
    }
    echo"
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `pengajuan_kis`
                          INNER JOIN `penduduk` ON `pengajuan_kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                          WHERE status='Pending' ORDER BY id_pengajuan DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_pengajuan]</td>
      <td>$r[nik]</td>
      <td>$r[nama]</td>
      <td>$r[tgl_pengajuan]</td>
      <td>$r[status]</td>";
      
      if ($_SESSION['leveluser']!='penduduk'){        
      echo"
      <td width='15%'>
        <a href='?module=PengajuanKIS&act=confirm&id=$r[id_pengajuan]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Konfirmasi Pengajuan</a>
      </td>";
    }
    echo"
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
  <h3 class='box-title'>Tambah Data Pengajuan KIS</h3> <br> <br>
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
    if ($_SESSION['leveluser']!='penduduk'){
    $tampil = mysql_query("SELECT * FROM `penduduk` WHERE status_penduduk='Hidup' AND id_penduduk NOT IN (SELECT id_penduduk  FROM pengajuan_kis WHERE status='Pending')");
    }
    elseif ($_SESSION['leveluser']=='penduduk'){
      $tampil = mysql_query("SELECT * FROM `penduduk` WHERE id_penduduk='$_SESSION[id_penduduk]' ");
    }

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
        <a href='?module=PengajuanKIS&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a>     
        <a href='?module=PengajuanKIS&act=tambahpengajuan&id=$r[id_penduduk]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Pilih</a>
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
  
case "tambahpengajuan":

$edit = mysql_query("SELECT * FROM penduduk WHERE id_penduduk='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form  role='form' method='POST' action='$aksi?module=PengajuanKIS&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Pengajuan KIS</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_pengajuan'>ID Pengajuan KIS</label>
        <input type='text' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$nopel' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$nopel' placeholder='Masukkan ID penduduk'>
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
      <div class='form-group'>
      <label for='fupload'>Scan Kartu Keluarga</label>
        <input type='file' class='form-control' name='fupload' id='fupload' required>
      </div>
      <div class='form-group'>
      <label for='fupload2'>Scan Pajak Bumi Bangunan (PBB)</label>
        <input type='file' class='form-control' name='fupload2' id='fupload2' >
      </div>
      <div class='form-group'>
      <label for='fupload3'>Scan Kartu Tanda Penduduk (KTP)</label>
        <input type='file' class='form-control' name='fupload3' id='fupload3' >
      </div>
      <div class='form-group'>
      <label for='fupload4'>Scan Struk Pembayaran Listrik</label>
        <input type='file' class='form-control' name='fupload4' id='fupload4' >
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

case "confirm":

  $edit = mysql_query("SELECT * FROM pengajuan_kis
                      INNER JOIN `penduduk` ON `pengajuan_kis`.`id_penduduk` = `penduduk`.`id_penduduk`
                      WHERE id_pengajuan='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
  
  echo"
  <form  role='form' method='POST' action='$aksi?module=PengajuanKIS&act=confirm' enctype='multipapenduduk/form-data'>
  
  <div class='box'>
  <div class='box-header'>
    <h3 class='box-title'>Konfirmasi Data Pengajuan KIS</h3>
  </div>
  <div class='row'>
    <div class='col-md-6'>
      <div class='box-body'>
        <div class='form-group'>
        <label for='id_pengajuan'>ID Pengajuan</label>
          <input type='text' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$r[id_pengajuan]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_pengajuan' id='id_pengajuan' value='$r[id_pengajuan]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='id_penduduk'>ID Penduduk</label>
          <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk] - $r[nama]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='tgl_pengajuan'>Tanggal Pengajuan KIS</label>
          <input type='date' class='form-control' name='tgl_pengajuan' id='tgl_pengajuan' value='$r[tgl_pengajuan]' placeholder='Masukkan Nomor Induk Kependudukan' disabled>
        </div>
        <div class='form-group'>
        <label for='tgl_konfirmasi'>Tanggal Konfirmasi KIS</label>
          <input type='date' class='form-control' name='tgl_konfirmasi' id='tgl_konfirmasi' value='"; echo date('Y-m-d'); echo"'>
        </div>
        <div class='form-group'>
        <label for='petugas'>Nama Petugas</label> <br>
        <label for='petugas'>$r[petugas]</label>
        </div>
        <div class='form-group'>
        <label for='validator'>Dikonfirmasi Oleh</label> <br>
          <input type='text' class='form-control' name='validator' id='validator' value='$_SESSION[namauser]' placeholder='Masukkan Nomor Induk Kependudukan' disabled>
          <input type='hidden' class='form-control' name='validator' id='validator' value='$_SESSION[namauser]' placeholder='Masukkan Nomor Induk Kependudukan'>
        </div>
        <div class='form-group'>
        <label for='tgl_konfirmasi'>Persyaratan</label> <br>
          <a href='modul/upload/kk/$r[file_kk]' target='_blank' class='btn btn-light'>Kartu Keluarga</a> 
          <a href='modul/upload/pbb/$r[file_pbb]' target='_blank' class='btn btn-light'>Pajak Bumi Bangunan</a> 
          <a href='modul/upload/ktp/$r[file_ktp]' target='_blank' class='btn btn-light'>Kartu Tanda Penduduk (KTP)</a>
          <a href='modul/upload/struk_listrik/$r[file_listrik]' target='_blank' class='btn btn-light'>Struk Pembayaran Listrik</a>
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
}

}       
        
?>


                
               
        
        
        