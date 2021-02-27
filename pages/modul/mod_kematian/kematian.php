
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="KMTN.";
$y=substr($pel,0,4);
$query=mysql_query("select * from kematian where substr(id_kematian,1,4)='$y' order by id_kematian desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_kematian'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_kematian/aksi_kematian.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Kematian Penduduk</h3> <br> <br>
  <a href='?module=Kematian&act=pilihpenduduk'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>NIK Penduduk</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Tempat, Tanggal Meninggal</th> 
      <th>Surat Kematian</th>    
      <th>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `penduduk`
              INNER JOIN `kematian` ON `kematian`.`id_penduduk` = `penduduk`.`id_penduduk`
              ORDER BY id_kematian DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[nik]</td>
      <td>$r[nama]</td>
      <td>$r[jenis_kelamin]</td>
      <td>$r[tempat_meninggal], $r[tgl_meninggal]</td>
      <td><a href='modul/upload/surat_kematian/$r[file_surat]' target='_blank'>Lihat Surat</a></td>      
      <td width='17%'>  
        <a href='?module=Kematian&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Info</a>      
        <a href='?module=Kematian&act=editkematian&id=$r[id_kematian]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Kematian&act=hapus&id=$r[id_kematian]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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
    <h3 class='box-title'>Tambah Data Kematian</h3> <br> <br>
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
      $tampil = mysql_query("SELECT * FROM `penduduk` WHERE status_penduduk='Hidup'");
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
          <a href='?module=Kematian&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a>     
          <a href='?module=Kematian&act=tambahkematian&id=$r[id_penduduk]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Pilih</a>
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

case "tambahkematian":

  $edit = mysql_query("SELECT * FROM penduduk WHERE id_penduduk='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

echo "
<form  role='form' method='POST' action='$aksi?module=Kematian&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Kematian Penduduk</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_kematian'>ID Kematian</label>
        <input type='text' class='form-control' name='id_kematian' id='id_kematian' value='$nopel' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_kematian' id='id_kematian' value='$nopel' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='id_penduduk'>ID Penduduk</label>
        <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[nik] - $r[nama]' placeholder='Masukkan Nomor Induk Kependudukan' disabled>
        <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='tgl_meninggal'>Tanggal Meninggal</label>
        <input type='date' class='form-control' name='tgl_meninggal' id='tgl_meninggal' value='"; echo date('Y-m-d'); echo"' placeholder='Masukkan Tanggal Pengajuan' required>
      </div>
      <div class='form-group'>
      <label for='jam'>Waktu Meninggal</label>
        <input type='text' class='form-control' name='jam' id='jam' placeholder='Masukkan Waktu Meninggal (Jam)' required>
      </div>
      <div class='form-group'>
      <label for='tempat_meninggal'>Tempat Meninggal</label>
        <input type='text' class='form-control' name='tempat_meninggal' id='tempat_meninggal' placeholder='Masukkan Tempat Meninggal' required>
      </div>
      <div class='form-group'>
      <label for='dimakamkan_di'>Tempat Dimakamkan</label>
        <input type='text' class='form-control' name='dimakamkan_di' id='dimakamkan_di' placeholder='Masukkan Tempat Dimakamkan' required>
      </div>
      <div class='form-group'>
      <label for='keterangan'>Keterangan</label>
        <textarea class='form-control' name='keterangan' id='keterangan' placeholder='Masukkan Keterangan Tambahan'></textarea>
      </div>
      <div class='form-group'>
      <label for='fupload'>Surat Kematian</label>
        <input type='file' class='form-control' name='fupload' id='fupload' required>
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

</form>";

break;
  
case "editkematian":

$edit = mysql_query("SELECT * FROM `penduduk`
        INNER JOIN `kematian` ON `kematian`.`id_penduduk` = `penduduk`.`id_penduduk` WHERE id_kematian='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form  role='form' method='POST' action='$aksi?module=Kematian&act=update' enctype='multipapenduduk/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Kematian Penduduk</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_kematian'>ID Kematian</label>
        <input type='text' class='form-control' name='id_kematian' id='id_kematian' value='$r[id_kematian]' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_kematian' id='id_kematian' value='$r[id_kematian]' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='id_penduduk'>ID Penduduk</label>
        <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[nik] - $r[nama]' placeholder='Masukkan Nomor Induk Kependudukan' disabled>
        <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='tgl_meninggal'>Tanggal Meninggal</label>
        <input type='date' class='form-control' name='tgl_meninggal' id='tgl_meninggal' value='$r[tgl_meninggal]' placeholder='Masukkan Tanggal Pengajuan' required>
      </div>
      <div class='form-group'>
      <label for='jam'>Waktu Meninggal</label>
        <input type='text' class='form-control' name='jam' id='jam' value='$r[jam]' placeholder='Masukkan Waktu Meninggal (Jam)'>
      </div>
      <div class='form-group'>
      <label for='tempat_meninggal'>Tempat Meninggal</label>
        <input type='text' class='form-control' name='tempat_meninggal' value='$r[tempat_meninggal]' id='tempat_meninggal' placeholder='Masukkan Tempat Meninggal'>
      </div>
      <div class='form-group'>
      <label for='dimakamkan_di'>Tempat Dimakamkan</label>
        <input type='text' class='form-control' name='dimakamkan_di' value='$r[dimakamkan_di]' id='dimakamkan_di' placeholder='Masukkan Tempat Dimakamkan'>
      </div>
      <div class='form-group'>
      <label for='keterangan'>Keterangan</label>
        <textarea class='form-control' name='keterangan' id='keterangan'  placeholder='Masukkan Keterangan Tambahan'>$r[keterangan]</textarea>
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
          <th width='20%'>Nomor KK</th>
          <td width='1%'>:</td>
          <td>$r[no_kk]</td>
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


                
               
        
        
        