
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="POLI.";
$y=substr($pel,0,4);
$query=mysql_query("select * from poli where substr(id_poli,1,4)='$y' order by id_poli desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_poli'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_poli/aksi_poli.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Poli</h3> <br> <br>
  <a href='?module=Poli&act=tambahpoli'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID Poli</th>
      <th>Kode Poli</th>
      <th>Nama Poli</th>
      <th>Max per Hari</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `poli` ORDER BY id_poli DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_poli]</td>
      <td>$r[kode_poli]</td>
      <td>$r[nama_poli]</td>
      <td>$r[max_perhari]</td>
      <td width='12%'>        
        <a href='?module=Poli&act=editpoli&id=$r[id_poli]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=Poli&act=hapus&id=$r[id_poli]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahpoli":
echo "
<form  role='form' method='POST' action='$aksi?module=Poli&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Poli</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_poli'>ID Poli</label>
        <input type='text' class='form-control' name='id_poli' id='id_poli' value='$nopel' placeholder='Masukkan ID Poli' disabled>
        <input type='hidden' class='form-control' name='id_poli' id='id_poli' value='$nopel' placeholder='Masukkan ID Poli'>
      </div>
      <div class='form-group'>
      <label for='kode_poli'>Kode Poli</label>
        <input type='text' class='form-control' name='kode_poli' id='kode_poli' placeholder='Masukkan Kode Poli' required>
      </div>
      <div class='form-group'>
      <label for='nama_poli'>Nama Poli</label>
        <input type='text' class='form-control' name='nama_poli' id='nama_poli' placeholder='Masukkan Nama Poli' required>
      </div>
      <div class='form-group'>
      <label for='max_perhari'>Maximal Jumlah Pelayanan (per-Hari)</label>
        <input type='text' class='form-control' name='max_perhari' id='max_perhari' placeholder='Masukkan Maximal Jumlah Pelayanan (per-Hari)' required>
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
  
case "editpoli":

$edit = mysql_query("SELECT * FROM poli WHERE id_poli='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=Poli&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Poli</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_poli'>ID Poli</label>
        <input type='text' class='form-control' name='id_poli' id='id_poli' value='$r[id_poli]' placeholder='Masukkan ID Agama' disabled>
        <input type='hidden' class='form-control' name='id_poli' id='id_poli' value='$r[id_poli]' placeholder='Masukkan ID Agama'>
      </div>
      <div class='form-group'>
      <label for='kode_poli'>Kode Poli</label>
        <input type='text' class='form-control' name='kode_poli' id='kode_poli' value='$r[kode_poli]' placeholder='Masukkan Kode Poli' required>
      </div>
      <div class='form-group'>
      <label for='nama_poli'>Nama Poli</label>
        <input type='text' class='form-control' name='nama_poli' id='nama_poli' value='$r[nama_poli]' placeholder='Masukkan nama Poli' required>
      </div>
      <div class='form-group'>
      <label for='max_perhari'>Maximal Jumlah Pelayanan (per-Hari)</label>
        <input type='text' class='form-control' name='max_perhari' id='max_perhari' value='$r[max_perhari]' placeholder='Masukkan Maximal Jumlah Pelayanan (per-Hari)' required>
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


                
               
        
        
        