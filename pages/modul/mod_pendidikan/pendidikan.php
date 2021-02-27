
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="PDIK.";
$y=substr($pel,0,4);
$query=mysql_query("select * from pendidikan where substr(id_pendidikan,1,4)='$y' order by id_pendidikan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_pendidikan'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_pendidikan/aksi_pendidikan.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Pendidikan</h3> <br> <br>
  <a href='?module=Pendidikan&act=tambahpendidikan'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Pendidikan</th>
      <th>Nama Pendidikan</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `pendidikan` ORDER BY id_pendidikan DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_pendidikan]</td>
      <td>$r[pendidikan]</td>
      <td width='12%'>        
        <a href='?module=Pendidikan&act=editpendidikan&id=$r[id_pendidikan]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Pendidikan&act=hapus&id=$r[id_pendidikan]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahpendidikan":
echo "
<form  role='form' method='POST' action='$aksi?module=Pendidikan&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Pendidikan</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_pendidikan'>ID Pendidikan</label>
        <input type='text' class='form-control' name='id_pendidikan' id='id_pendidikan' value='$nopel' placeholder='Masukkan ID Pendidikan' disabled>
        <input type='hidden' class='form-control' name='id_pendidikan' id='id_pendidikan' value='$nopel' placeholder='Masukkan ID Pendidikan'>
      </div>
      <div class='form-group'>
      <label for='pendidikan'>Nama Pendidikan</label>
        <input type='text' class='form-control' name='pendidikan' id='pendidikan' placeholder='Masukkan Nama Pendidikan' required>
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
  
case "editpendidikan":

$edit = mysql_query("SELECT * FROM pendidikan WHERE id_pendidikan='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=Pendidikan&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Pendidikan</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_pendidikan'>ID Pendidikan</label>
        <input type='text' class='form-control' name='id_pendidikan' id='id_pendidikan' value='$r[id_pendidikan]' placeholder='Masukkan ID Pendidikan' disabled>
        <input type='hidden' class='form-control' name='id_pendidikan' id='id_pendidikan' value='$r[id_pendidikan]' placeholder='Masukkan ID Pendidikan'>
      </div>
      <div class='form-group'>
      <label for='pendidikan'>Nama Pendidikan</label>
        <input type='text' class='form-control' name='pendidikan' id='pendidikan' value='$r[pendidikan]' placeholder='Masukkan Nama Pendidikan' required>
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


                
               
        
        
        