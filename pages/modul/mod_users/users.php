
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

$aksi="modul/mod_users/aksi_users.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Data Users</h3> <br> <br>
  <a href='?module=Users&act=tambahusers'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
</div>
<div class='box-body'>
  <table id='example1' class='table table-bordered table-striped'>
    <thead>
    <tr>
      <th>No.</th>
      <th>Username</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Level Akses</th>
      <th>Status User</th>
      <th width='5%'>Action</th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT * FROM `users`");

    $no = 1;
    while($r=mysql_fetch_array($tampil)){
    echo"
    <tr>
      <td>$no.</td>
      <td>$r[username]</td>
      <td>$r[nama_lengkap]</td>
      <td>$r[email]</td>
      <td>$r[level]</td>
      <td>";
        if ($r[user_aktif]=='Y')   {                         
        echo"                 
          Aktif";
        }
        elseif ($r[user_aktif]=='N')    {
        echo"
          Tidak Aktif";        
        }
        echo"
      </td>
      <td width='5%'>
        <a href='?module=Users&act=editusers&id=$r[username]' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Edit</a>
      </td>
    ";
    $no++;
    }
    echo"
    </tr>
    </tbody>
  </table>
</div>
</div>
";
	  
break;

case "tambahusers":
echo "
<form  role='form' method='POST' action='$aksi?module=Users&act=input' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Tambah Data User</h3>
</div>
<div class='row'>
  <div class='col-md-6'>
    <div class='box-body'>
      <div class='form-group'>
      <label for='username'>Username</label>
        <input type='text' class='form-control' name='username' id='username' placeholder='Masukkan Username' required>
      </div>
      <div class='form-group'>
      <label for='password'>Password</label>
        <input type='password' class='form-control' name='password' id='password' placeholder='Masukkan Password' required>
      </div>
      <div class='form-group'>
      <label for='nama_lengkap'>Nama Lengkap</label>
        <input type='text' class='form-control' name='nama_lengkap' id='nama_lengkap' placeholder='Masukkan Nama Lengkap' required>
      </div>
      <div class='form-group'>
      <label for='email'>E-mail</label>
        <input type='email' class='form-control' name='email' id='email' placeholder='Masukkan Email' required>
      </div>
      <div class='form-group'>
      <label for='no_telp'>Nomor Telepon</label>
        <input type='text' class='form-control' name='no_telp' id='no_telp' placeholder='Masukkan Nomor Telepon' required>
      </div>
      <div class='form-group'>
      <label for='id_level'>Level</label> <br>                   
          <input type='radio' class='flat' name='level' id='level' value='admin' checked='' required /> Admin
          <input type='radio' class='flat' name='level' id='level' value='operator' /> Operator
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

case "editusers":
  $edit = mysql_query("SELECT * FROM users WHERE username='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
echo "

<form  role='form' method='POST' action='$aksi?module=Users&act=update' enctype='multipart/form-data'>

<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Edit Data User</h3>
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
      <div class='form-group'>
      <label for='level'>Level</label> <br>";
        if ($r[level]=='admin')   {                         
        echo"                 
          <input type='radio' class='flat' name='level' id='level' value='admin' checked='' required /> Admin
          <input type='radio' class='flat' name='level' id='level' value='operator' /> Operator";
        }
        elseif ($r[level]=='operator')    {
          echo"
            <input type='radio' class='flat' name='level' id='level' value='admin' required /> Admin
            <input type='radio' class='flat' name='level' id='level' value='operator' checked='' /> Operator"; 
        }
        echo"
      </div>
      <div class='form-group'>
      <label for='user_aktif'>User Aktif</label> <br>";
        if ($r[user_aktif]=='Y')   {                         
        echo"                 
          <input type='radio' class='flat' name='user_aktif' id='level' value='Y' checked='' required /> Aktif
          <input type='radio' class='flat' name='user_aktif' id='level' value='N' /> Tidak Aktif";
        }
        elseif ($r[user_aktif]=='N')    {
        echo"
        <input type='radio' class='flat' name='user_aktif' id='level' value='Y'  required /> Aktif
        <input type='radio' class='flat' name='user_aktif' id='level' value='N' checked='' /> Tidak Aktif";        
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

}

}       
        
?>


                
               
        
        
        