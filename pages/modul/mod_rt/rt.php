
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="NORT.";
$y=substr($pel,0,4);
$query=mysql_query("select * from rt where substr(id_rt,1,4)='$y' order by id_rt desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_rt'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_rt/aksi_rt.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Nomor RT</h3> <br> <br>
  <a href='?module=RT&act=tambahrt'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>ID RT</th>
      <th>Nomor RW</th>
      <th>Nomor RT</th>
      <th width='12%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT
    *
  FROM
    `rt`
    INNER JOIN `rw` ON `rw`.`id_rw` = `rt`.`id_rw`
    INNER JOIN `blok` ON `blok`.`id_blok` = `rw`.`id_blok` ORDER BY rt.id_rt DESC");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td width='5%'>$no.</td>
      <td>$r[id_rt]</td>
      <td>$r[rw]</td>
      <td>$r[rt]</td>
      <td width='12%'>        
        <a href='?module=RT&act=editrt&id=$r[id_rt]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
        <a href='$aksi?module=RT&act=hapus&id=$r[id_rt]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash'></i> Delete</a>
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

case "tambahrt":
echo "
<form  role='form' method='POST' action='$aksi?module=RT&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data Nomor RT</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_rt'>ID RT</label>
        <input type='text' class='form-control' name='id_rt' id='id_rt' value='$nopel' placeholder='Masukkan ID RT' disabled>
        <input type='hidden' class='form-control' name='id_rt' id='id_rt' value='$nopel' placeholder='Masukkan ID RT'>
      </div>
      <div class='form-group'>
      <label for='id_rw'>Nomor RW</label>
        <select name='id_rw' class='form-control col-md-7 col-xs-12' required>
          <option value='' selected>-- Pilih Blok --</option>";
          $tampil=mysql_query("SELECT
          *
        FROM
          `blok`
          INNER JOIN `rw` ON `blok`.`id_blok` = `rw`.`id_blok` ORDER BY rw.id_rw");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_rw]>Blok $r[blok] -  RW $r[rw]</option>";
          }
          echo
        "</select>        
      </div> <br>
      <div class='form-group'>
      <label for='rt'>Nomor RT</label>
        <input type='text' class='form-control' name='rt' id='rt' placeholder='Masukkan Nomor RT' required>
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
  
case "editrt":

$edit = mysql_query("SELECT * FROM rt WHERE id_rt='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo"
<form role='form' method='POST' action='$aksi?module=RT&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data Nomor RT</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='id_rt'>ID RT</label>
        <input type='text' class='form-control' name='id_rt' id='id_rt' value='$r[id_rt]' placeholder='Masukkan ID RT' disabled>
        <input type='hidden' class='form-control' name='id_rt' id='id_rt' value='$r[id_rt]' placeholder='Masukkan ID RT'>
      </div>
      <div class='form-group'>
      <label for='id_rw'>Nomor RW</label>
        <select name='id_rw' class='form-control col-md-7 col-xs-12' required>";              
        $tampil=mysql_query("SELECT * FROM rw ORDER BY id_rw");
        if ($r[id_rw]==0){
        echo "<option value='' selected>-- Pilih RW --</option>";
        }   

        while($w=mysql_fetch_array($tampil)){
        if ($r[id_rw]==$w[id_rw]){
          echo "<option value=$w[id_rw] selected>$w[rw]</option>";
        }
        else{
          echo "<option value=$w[id_rw]>$w[rw]</option>";
        }
        }
        echo "</select>
      </div>
      <div class='form-group'>
      <label for='rt'>Nomor RT</label>
        <input type='text' class='form-control' name='rt' id='rt' value='$r[rt]' placeholder='Masukkan Nomor RT' required>
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


                
               
        
        
        