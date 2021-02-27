
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="PKRJ.";
$y=substr($pel,0,4);
$query=mysql_query("select * from pekerjaan where substr(id_pekerjaan,1,4)='$y' order by id_pekerjaan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_pekerjaan'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_pekerjaan/aksi_pekerjaan.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Pekerjaan</h3> <br> <br>
  <a href='?module=Pekerjaan&act=tambahpekerjaan'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Pekerjaan</th>
      <th>Nama Pekerjaan</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `pekerjaan` ORDER BY id_pekerjaan DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_pekerjaan]</td>
      <td>$r[pekerjaan]</td>
      <td width='12%'>        
        <a href='?module=Pekerjaan&act=editpekerjaan&id=$r[id_pekerjaan]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Pekerjaan&act=hapus&id=$r[id_pekerjaan]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahpekerjaan":
echo "
<form  role='form' method='POST' action='$aksi?module=Pekerjaan&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Pekerjaan</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_pekerjaan'>ID Pekerjaan</label>
        <input type='text' class='form-control' name='id_pekerjaan' id='id_pekerjaan' value='$nopel' placeholder='Masukkan ID Pekerjaan' disabled>
        <input type='hidden' class='form-control' name='id_pekerjaan' id='id_pekerjaan' value='$nopel' placeholder='Masukkan ID Pekerjaan'>
      </div>
      <div class='form-group'>
      <label for='pekerjaan'>Nama pekerjaan</label>
        <input type='text' class='form-control' name='pekerjaan' id='pekerjaan' placeholder='Masukkan Nama Pekerjaan' required>
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
  
case "editpekerjaan":

$edit = mysql_query("SELECT * FROM pekerjaan WHERE id_pekerjaan='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=Pekerjaan&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Pekerjaan</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_pekerjaan'>ID Pekerjaan</label>
        <input type='text' class='form-control' name='id_pekerjaan' id='id_pekerjaan' value='$r[id_pekerjaan]' placeholder='Masukkan ID Pekerjaan' disabled>
        <input type='hidden' class='form-control' name='id_pekerjaan' id='id_pekerjaan' value='$r[id_pekerjaan]' placeholder='Masukkan ID Pekerjaan'>
      </div>
      <div class='form-group'>
      <label for='pekerjaan'>Nama Pekerjaan</label>
        <input type='text' class='form-control' name='pekerjaan' id='pekerjaan' value='$r[pekerjaan]' placeholder='Masukkan Nama Pekerjaan' required>
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


                
               
        
        
        