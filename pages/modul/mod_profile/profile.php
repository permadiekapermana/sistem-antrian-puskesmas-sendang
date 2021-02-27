
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$pel="USER.";
$y=substr($pel,0,4);
$query=mysql_query("select * from users where no='1' and substr(id_user,1,4)='$y' order by id_user desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_user'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_profile/aksi_profile.php";

  $edit = mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
  $r    = mysql_fetch_array($edit);
echo "

<form  role='form' method='POST' action='$aksi?module=Profile&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Profile User</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='username'>Username</label>
        <input type='text' class='form-control' name='username' value='$r[username]' id='username' placeholder='Masukkan Username' disabled>
        <input type='hidden' class='form-control' name='username' value='$r[username]' id='username' placeholder='Masukkan Username'>
      </div>
      <div class='form-group'>
      <label for='password'>Password</label>
        <input type='password' class='form-control' name='password' id='password' placeholder='Masukkan Password Baru (Jika Kosong Maka Password Tidak Berubah)'>
      </div>
      <div class='form-group'>
      <label for='nama_lengkap'>Nama Lengkap</label>
        <input type='text' class='form-control' name='nama_lengkap' value='$r[nama_lengkap]' id='nama_lengkap' placeholder='Masukkan Nama Lengkap' required>
      </div>
      <div class='form-group'>
      <label for='email'>E-mail</label>
        <input type='email' class='form-control' name='email' id='email' value='$r[email]' placeholder='Masukkan Email' required>
      </div>
      <div class='form-group'>
      <label for='no_telp'>Nomor Telepon</label>
        <input type='text' class='form-control' name='no_telp' id='no_telp' value='$r[no_telp]' placeholder='Masukkan Nomor Telepon' required>
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


}
      
        
?>


                
               
        
        
        