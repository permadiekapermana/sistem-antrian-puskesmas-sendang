
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
  <h3 class='box-title'>Verifikasi Data Penduduk</h3> <br> <br>
  <a href='?module=VerifPenduduk&act=pilihpenduduk'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Verifikasi</th>
      <th>NIK Penduduk</th>
      <th>Nama</th>
      <th>Tanggal Perbaikan</th>
      <th>Status Perbaikan</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `penduduk_update` WHERE status_perbaikan!='Valid' ORDER BY id_update DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_update]</td>
      <td>$r[nik]</td>
      <td>$r[nama]</td>
      <td>$r[tgl_perbaikan]</td>
      <td>$r[status_perbaikan]</td>
      <td width='17%'>";
      if ($r[status_perbaikan]=='Pending')   {                         
      echo"                 
        <a href='?module=VerifPenduduk&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a> 
        <a href='#' class='btn btn-default btn-xs' disabled><i class='fa fa-check'></i> Butuh Verifikasi</a>";
      }
      elseif ($r[status_perbaikan]=='Ditolak')    {
      echo"
        <a href='?module=VerifPenduduk&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a>
        <a href='#' data-toggle='modal' data-target='#keteranganModal' value='$r[id_update]' class='btn btn-danger btn-xs'><i class='fa fa-warning'></i> Alasan</a>
        <a href='?module=VerifPenduduk&act=editverif&id=$r[id_update]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <div class='modal fade' id='keteranganModal' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Keterangan Verifikasi Ditolak</h5>
              <button type='button' class='close' data-dismiss='modal'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
              $r[keterangan]
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";      
      }
      echo"          
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
  <h3 class='box-title'>Tambah Data Verifikasi Penduduk</h3> <br> <br>
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
    $tampil = mysql_query("SELECT * FROM `penduduk` WHERE status_penduduk='Hidup' ORDER BY id_penduduk DESC");

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
        <a href='?module=VerifPenduduk&act=infopenduduk&id=$r[id_penduduk]' class='btn btn-info btn-xs'><i class='fa fa-info'></i> Info</a>     
        <a href='?module=VerifPenduduk&act=tambahverif&id=$r[id_penduduk]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Pilih</a>
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
  
case "tambahverif":

$edit = mysql_query("SELECT * FROM penduduk WHERE id_penduduk='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form  role='form' method='POST' action='$aksi?module=VerifPenduduk&act=input' enctype='multipapenduduk/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Verifikasi Penduduk</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_update'>ID Verifikasi</label>
        <input type='text' class='form-control' name='id_update' id='id_update' value='$nopel' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_update' id='id_update' value='$nopel' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='id_penduduk'>ID Penduduk</label>
        <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk' disabled>
        <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
      </div>
      <div class='form-group'>
      <label for='nik'>Nomor Induk Kependudukan</label>
        <input type='text' class='form-control' name='nik' id='nik' value='$r[nik]' placeholder='Masukkan Nomor Induk Kependudukan' required>
      </div>
      <div class='form-group'>
      <label for='no_kk'>Nomor Kartu Keluarga</label>
        <input type='text' class='form-control' name='no_kk' id='no_kk' value='$r[no_kk]' placeholder='Masukkan Nomor Kartu Keluarga (Boleh Kosong)'>
      </div>
      <div class='form-group'>
      <label for='nik'>Nama</label>
        <input type='text' class='form-control' name='nama' id='nama' value='$r[nama]' placeholder='Masukkan Nama' required>
      </div>
      <div class='form-group'>
      <label for='tmp_lahir'>Tempat Lahir</label>
        <input type='text' class='form-control' name='tmp_lahir' id='tmp_lahir' value='$r[tmp_lahir]' placeholder='Masukkan Tempat Lahir' required>
      </div>
      <div class='form-group'>
      <label for='tgl_lahir'>Tanggal Lahir</label>
        <input type='date' class='form-control' name='tgl_lahir' id='tgl_lahir' value='$r[tgl_lahir]' placeholder='Masukkan Tanggal Lahir' required>
      </div>
      <div class='form-group'>
      <label for='jenis_kelamin'>Jenis Kelamin</label> <br>";
        if ($r[jenis_kelamin]=='Laki-Laki')   {                         
        echo"                 
          <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Laki-Laki' checked='' required /> Laki-Laki
          <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Perempuan' /> Perempuan";
        }
        elseif ($r[jenis_kelamin]=='Perempuan')    {
        echo"
          <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Laki-Laki'  required /> Laki-Laki
          <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Perempuan' checked='' /> Perempuan";      
        }
        echo"
      </div>
      <div class='form-group'>
      <label for='gol_darah'>Golongan Darah</label> <br>";
        if ($r[gol_darah]=='A')   {                         
        echo"                 
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A' checked='' required /> A
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B' /> B
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' /> AB
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O";
        }
        elseif ($r[gol_darah]=='B')    {
        echo"
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B' checked='' /> B
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' /> AB
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O"; 
        }
        elseif ($r[gol_darah]=='AB')    {
        echo"
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B'  /> B
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' checked='' /> AB
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O"; 
        }
        elseif ($r[gol_darah]=='O')    {
        echo"
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B'  /> B
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB'  /> AB
          <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' checked='' /> O"; 
        } 
        echo"
      </div>
      <div class='form-group'>
      <label for='id_agama'>Agama</label>
        <select name='id_agama' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM agama ORDER BY id_agama");
        if ($r[id_agama]==0){
        echo "<option value='' selected>-- Pilih Agama --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_agama]==$w[id_agama]){
          echo "<option value=$w[id_agama] selected>$w[agama]</option>";
        }
        else{
          echo "<option value=$w[id_agama]>$w[agama]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='id_pekerjaan'>Pekerjaan</label>
        <select name='id_pekerjaan' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM pekerjaan ORDER BY id_pekerjaan");
        if ($r[id_pekerjaan]==0){
        echo "<option value='' selected>-- Pilih Pekerjaan --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_pekerjaan]==$w[id_pekerjaan]){
          echo "<option value=$w[id_pekerjaan] selected>$w[pekerjaan]</option>";
        }
        else{
          echo "<option value=$w[id_pekerjaan]>$w[pekerjaan]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='id_pendidikan'>Pendidikan</label>
        <select name='id_pendidikan' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM pendidikan ORDER BY id_pendidikan");
        if ($r[id_pendidikan]==0){
        echo "<option value='' selected>-- Pilih Pendidikan --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_pendidikan]==$w[id_pendidikan]){
          echo "<option value=$w[id_pendidikan] selected>$w[pendidikan]</option>";
        }
        else{
          echo "<option value=$w[id_pendidikan]>$w[pendidikan]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='id_rt'>Nomor RT</label>
        <select name='id_rt' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM rt, rw, blok ORDER BY id_rt");
        if ($r[id_rt]==0){
        echo "<option value='' selected>-- Pilih Nomor RT --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_rt]==$w[id_rt]){
          echo "<option value=$w[id_rt] selected>Blok $w[blok] RT $w[rt] / RW $w[rw]</option>";
        }
        else{
          echo "<option value=$w[id_rt]>Blok $w[blok] RT $w[rt] / RW $w[rw]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='status_nikah'>Status Nikah</label> <br>";
        if ($r[status_nikah]=='Belum Menikah')   {                         
        echo"                 
          <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Belum Menikah' checked='' required /> Belum Menikah
          <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Menikah' /> Menikah";
        }
        elseif ($r[status_nikah]=='Menikah')    {
        echo"
          <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Belum Menikah'  required /> Belum Menikah
          <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Menikah' checked='' /> Menikah";     
        }
        echo"
      </div>
      <div class='form-group'>
      <label for='status_tinggal'>Status Tinggal</label> <br>";
        if ($r[status_tinggal]=='Tetap')   {                         
        echo"                 
          <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Tetap' checked='' required /> Tetap
          <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Kontrak' /> Kontrak";
        }
        elseif ($r[status_tinggal]=='Kontrak')    {
        echo"
          <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Tetap'  required /> Tetap
          <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Kontrak' checked='' /> Kontrak";     
        }
        echo"
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

case "editverif":

  $edit = mysql_query("SELECT * FROM penduduk_update WHERE id_update='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
  
  echo"
  <form  role='form' method='POST' action='$aksi?module=VerifPenduduk&act=update' enctype='multipapenduduk/form-data'>
  
  <div class='box'>
  <div class='box-header'>
    <h3 class='box-title'>Edit Data Verifikasi Penduduk</h3>
  </div>
  <div class='row'>
    <div class='col-md-6'>
      <div class='box-body'>
        <div class='form-group'>
        <label for='id_update'>ID Verifikasi</label>
          <input type='text' class='form-control' name='id_update' id='id_update' value='$r[id_update]' placeholder='Masukkan ID penduduk' disabled>
          <input type='text' class='form-control' name='id_update' id='id_update' value='$r[id_update]' placeholder='Masukkan ID penduduk'>
        </div>
        <div class='form-group'>
        <label for='id_penduduk'>ID Penduduk</label>
          <input type='text' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk' disabled>
          <input type='hidden' class='form-control' name='id_penduduk' id='id_penduduk' value='$r[id_penduduk]' placeholder='Masukkan ID penduduk'>
        <div class='form-group'>
        <label for='nik'>Nomor Induk Kependudukan</label>
          <input type='text' class='form-control' name='nik' id='nik' value='$r[nik]' placeholder='Masukkan Nomor Induk Kependudukan' required>
        </div>
        <div class='form-group'>
        <label for='no_kk'>Nomor Kartu Keluarga</label>
          <input type='text' class='form-control' name='no_kk' id='no_kk' value='$r[no_kk]' placeholder='Masukkan Nomor Kartu Keluarga (Boleh Kosong)'>
        </div>
        <div class='form-group'>
        <label for='nik'>Nama</label>
          <input type='text' class='form-control' name='nama' id='nama' value='$r[nama]' placeholder='Masukkan Nama' required>
        </div>
        <div class='form-group'>
        <label for='tmp_lahir'>Tempat Lahir</label>
          <input type='text' class='form-control' name='tmp_lahir' id='tmp_lahir' value='$r[tmp_lahir]' placeholder='Masukkan Tempat Lahir' required>
        </div>
        <div class='form-group'>
        <label for='tgl_lahir'>Tanggal Lahir</label>
          <input type='date' class='form-control' name='tgl_lahir' id='tgl_lahir' value='$r[tgl_lahir]' placeholder='Masukkan Tanggal Lahir' required>
        </div>
        <div class='form-group'>
        <label for='jenis_kelamin'>Jenis Kelamin</label> <br>";
          if ($r[jenis_kelamin]=='Laki-Laki')   {                         
          echo"                 
            <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Laki-Laki' checked='' required /> Laki-Laki
            <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Perempuan' /> Perempuan";
          }
          elseif ($r[jenis_kelamin]=='Perempuan')    {
          echo"
            <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Laki-Laki'  required /> Laki-Laki
            <input type='radio' class='flat' name='jenis_kelamin' id='jeni_kelamin' value='Perempuan' checked='' /> Perempuan";      
          }
          echo"
        </div>
        <div class='form-group'>
        <label for='gol_darah'>Golongan Darah</label> <br>";
          if ($r[gol_darah]=='A')   {                         
          echo"                 
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A' checked='' required /> A
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B' /> B
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' /> AB
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O";
          }
          elseif ($r[gol_darah]=='B')    {
          echo"
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B' checked='' /> B
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' /> AB
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O"; 
          }
          elseif ($r[gol_darah]=='AB')    {
          echo"
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B'  /> B
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB' checked='' /> AB
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' /> O"; 
          }
          elseif ($r[gol_darah]=='O')    {
          echo"
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='A'  required /> A
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='B'  /> B
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='AB'  /> AB
            <input type='radio' class='flat' name='gol_darah' id='gol_darah' value='O' checked='' /> O"; 
          } 
          echo"
        </div>
        <div class='form-group'>
        <label for='id_agama'>Agama</label>
          <select name='id_agama' class='form-control col-md-7 col-xs-12' required>";              
          $tampil=mysql_query("SELECT * FROM agama ORDER BY id_agama");
          if ($r[id_agama]==0){
          echo "<option value='' selected>-- Pilih Agama --</option>";
          }   
  
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_agama]==$w[id_agama]){
            echo "<option value=$w[id_agama] selected>$w[agama]</option>";
          }
          else{
            echo "<option value=$w[id_agama]>$w[agama]</option>";
          }
          }
          echo "</select>
        </div>
        <div class='form-group'>
        <label for='id_pekerjaan'>Pekerjaan</label>
          <select name='id_pekerjaan' class='form-control col-md-7 col-xs-12' required>";              
          $tampil=mysql_query("SELECT * FROM pekerjaan ORDER BY id_pekerjaan");
          if ($r[id_pekerjaan]==0){
          echo "<option value='' selected>-- Pilih Pekerjaan --</option>";
          }   
  
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_pekerjaan]==$w[id_pekerjaan]){
            echo "<option value=$w[id_pekerjaan] selected>$w[pekerjaan]</option>";
          }
          else{
            echo "<option value=$w[id_pekerjaan]>$w[pekerjaan]</option>";
          }
          }
          echo "</select>
        </div>
        <div class='form-group'>
        <label for='id_pendidikan'>Pendidikan</label>
          <select name='id_pendidikan' class='form-control col-md-7 col-xs-12' required>";              
          $tampil=mysql_query("SELECT * FROM pendidikan ORDER BY id_pendidikan");
          if ($r[id_pendidikan]==0){
          echo "<option value='' selected>-- Pilih Pendidikan --</option>";
          }   
  
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_pendidikan]==$w[id_pendidikan]){
            echo "<option value=$w[id_pendidikan] selected>$w[pendidikan]</option>";
          }
          else{
            echo "<option value=$w[id_pendidikan]>$w[pendidikan]</option>";
          }
          }
          echo "</select>
        </div>
        <div class='form-group'>
        <label for='id_rt'>Nomor RT</label>
          <select name='id_rt' class='form-control col-md-7 col-xs-12' required>";              
          $tampil=mysql_query("SELECT * FROM rt, rw, blok ORDER BY id_rt");
          if ($r[id_rt]==0){
          echo "<option value='' selected>-- Pilih Nomor RT --</option>";
          }   
  
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_rt]==$w[id_rt]){
            echo "<option value=$w[id_rt] selected>Blok $w[blok] RT $w[rt] / RW $w[rw]</option>";
          }
          else{
            echo "<option value=$w[id_rt]>Blok $w[blok] RT $w[rt] / RW $w[rw]</option>";
          }
          }
          echo "</select>
        </div>
        <div class='form-group'>
        <label for='status_nikah'>Status Nikah</label> <br>";
          if ($r[status_nikah]=='Belum Menikah')   {                         
          echo"                 
            <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Belum Menikah' checked='' required /> Belum Menikah
            <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Menikah' /> Menikah";
          }
          elseif ($r[status_nikah]=='Menikah')    {
          echo"
            <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Belum Menikah'  required /> Belum Menikah
            <input type='radio' class='flat' name='status_nikah' id='status_nikah' value='Menikah' checked='' /> Menikah";     
          }
          echo"
        </div>
        <div class='form-group'>
        <label for='status_tinggal'>Status Tinggal</label> <br>";
          if ($r[status_tinggal]=='Tetap')   {                         
          echo"                 
            <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Tetap' checked='' required /> Tetap
            <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Kontrak' /> Kontrak";
          }
          elseif ($r[status_tinggal]=='Kontrak')    {
          echo"
            <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Tetap'  required /> Tetap
            <input type='radio' class='flat' name='status_tinggal' id='status_tinggal' value='Kontrak' checked='' /> Kontrak";     
          }
          echo"
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


                
               
        
        
        