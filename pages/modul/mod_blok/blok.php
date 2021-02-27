
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="BLOK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from blok where substr(id_blok,1,4)='$y' order by id_blok desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_blok'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_blok/aksi_blok.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Blok</h3> <br> <br>
  <a href='?module=Blok&act=tambahblok'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Blok</th>
      <th>Nama Blok</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `blok` ORDER BY id_blok DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_blok]</td>
      <td>$r[blok]</td>
      <td width='12%'>        
        <a href='?module=Blok&act=editblok&id=$r[id_blok]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Blok&act=hapus&id=$r[id_blok]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahblok":
echo "
<form  role='form' method='POST' action='$aksi?module=Blok&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Blok</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_blok'>ID Blok</label>
        <input type='text' class='form-control' name='id_blok' id='id_blok' value='$nopel' placeholder='Masukkan ID Blok' disabled>
        <input type='hidden' class='form-control' name='id_blok' id='id_blok' value='$nopel' placeholder='Masukkan ID Blok'>
      </div>
      <div class='form-group'>
      <label for='blok'>Nama blok</label>
        <input type='text' class='form-control' name='blok' id='blok' placeholder='Masukkan Nama Blok' required>
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
  
case "editblok":

$edit = mysql_query("SELECT * FROM blok WHERE id_blok='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=Blok&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Blok</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_blok'>ID Blok</label>
        <input type='text' class='form-control' name='id_blok' id='id_blok' value='$r[id_blok]' placeholder='Masukkan ID Blok' disabled>
        <input type='hidden' class='form-control' name='id_blok' id='id_blok' value='$r[id_blok]' placeholder='Masukkan ID Blok'>
      </div>
      <div class='form-group'>
      <label for='blok'>Nama Blok</label>
        <input type='text' class='form-control' name='blok' id='blok' value='$r[blok]' placeholder='Masukkan Nama Blok' required>
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


                
               
        
        
        