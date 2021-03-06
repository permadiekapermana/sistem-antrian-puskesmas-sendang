<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="AUDI.";
$y=substr($pel,0,4);
$query=mysql_query("select * from audio where substr(id_audio,1,4)='$y' order by id_audio desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_audio'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_audio/aksi_audio.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Audio Pemanggilan Antrian</h3> <br> <br>
  <a href='?module=Audio&act=tambahaudio'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Audio</th>
      <th>Nomor Antrian</th>
      <th>Sound</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `audio`
              ORDER BY id_audio DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_audio]</td>
      <td>$r[no_antrian]</td>
      <td><a onclick=\"play()\" class='btn btn-primary btn-xs'><i class='fa fa-play'></i> Play</a> </td>
      <audio id='audio' src='modul/upload/audio/$r[file]'></audio>
      <td width='17%'>        
        <a href='?module=Audio&act=editaudio&id=$r[id_audio]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Audio&act=hapus&id=$r[id_audio]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahaudio":
echo "
<form  role='form' method='POST' action='$aksi?module=Audio&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Audio</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_audio'>ID Audio</label>
        <input type='text' class='form-control' name='id_audio' id='id_audio' value='$nopel' placeholder='Masukkan ID audio' disabled>
        <input type='hidden' class='form-control' name='id_audio' id='id_audio' value='$nopel' placeholder='Masukkan ID audio'>
      </div>
      <div class='form-group'>
      <label for='no_antrian'>Nomor Antrian</label>
        <input type='text' class='form-control' name='no_antrian' id='no_antrian' placeholder='Masukkan Nomor Antrian' required>
      </div>
      <div class='form-group'>
      <label for='fupload'>File Audio</label>
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
  
case "editaudio":

$edit = mysql_query("SELECT * FROM `audio`
        WHERE id_audio='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form  role='form' method='POST' action='$aksi?module=Audio&act=update' enctype='multipapenduduk/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Audio Pemanggilan Antrian</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_audio'>ID Audio</label>
        <input type='text' class='form-control' name='id_audio' id='id_audio' value='$r[id_audio]' placeholder='Masukkan ID audio' disabled>
        <input type='hidden' class='form-control' name='id_audio' id='id_audio' value='$r[id_audio]' placeholder='Masukkan ID audio'>
      </div>
      <div class='form-group'>
      <label for='no_antrian'>Nomor Antrian</label>
        <input type='text' class='form-control' name='no_antrian' id='no_antrian' value='$r[no_antrian]' placeholder='Masukkan Nomor Antrian' required>
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
}

}       
        
?>


                
               
        
        
        