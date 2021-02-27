
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="NORW.";
$y=substr($pel,0,4);
$query=mysql_query("select * from rw where substr(id_rw,1,4)='$y' order by id_rw desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_rw'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_rw/aksi_rw.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Nomor RW</h3> <br> <br>
  <a href='?module=RW&act=tambahrw'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID RW</th>
      <th>Nama Blok</th>
      <th>Nomor RW</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT
    *
  FROM
    `blok`
    INNER JOIN `rw` ON `blok`.`id_blok` = `rw`.`id_blok` ORDER BY rw.id_rw DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_rw]</td>
      <td>$r[blok]</td>
      <td>$r[rw]</td>
      <td width='12%'>        
        <a href='?module=RW&act=editrw&id=$r[id_rw]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=RW&act=hapus&id=$r[id_rw]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahrw":
echo "
<form  role='form' method='POST' action='$aksi?module=RW&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Nomor RW</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_rw'>ID RW</label>
        <input type='text' class='form-control' name='id_rw' id='id_rw' value='$nopel' placeholder='Masukkan ID RW' disabled>
        <input type='hidden' class='form-control' name='id_rw' id='id_rw' value='$nopel' placeholder='Masukkan ID RW'>
      </div>
      <div class='form-group'>
      <label for='id_blok'>Nama Blok</label>
        <select name='id_blok' class='form-control col-md-7 col-xs-12' required>
          <option value='' selected>-- Pilih Blok --</option>";
          $tampil=mysql_query("SELECT * FROM blok ORDER BY id_blok");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_blok]>$r[blok]</option>";
          }
          echo
        "</select>        
      </div> <br>
      <div class='form-group'>
      <label for='rw'>Nomor RW</label>
        <input type='text' class='form-control' name='rw' id='rw' placeholder='Masukkan Nomor RW' required>
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
  
case "editrw":

$edit = mysql_query("SELECT * FROM rw WHERE id_rw='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=RW&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Nomor RW</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_rw'>ID RW</label>
        <input type='text' class='form-control' name='id_rw' id='id_rw' value='$r[id_rw]' placeholder='Masukkan ID RW' disabled>
        <input type='hidden' class='form-control' name='id_rw' id='id_rw' value='$r[id_rw]' placeholder='Masukkan ID RW'>
      </div>
      <div class='form-group'>
      <label for='id_blok'>Nama Blok</label>
        <select name='id_blok' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM blok ORDER BY id_blok");
        if ($r[id_blok]==0){
        echo "<option value='' selected>-- Pilih Blok --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_blok]==$w[id_blok]){
          echo "<option value=$w[id_blok] selected>$w[blok]</option>";
        }
        else{
          echo "<option value=$w[id_blok]>$w[blok]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='rw'>Nomor RW</label>
        <input type='text' class='form-control' name='rw' id='rw' value='$r[rw]' placeholder='Masukkan Nomor RW' required>
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


                
               
        
        
        