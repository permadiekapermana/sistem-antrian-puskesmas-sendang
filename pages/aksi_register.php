<?php
error_reporting(0);
include "../config/koneksi.php";

$pel="DN.";
$y=substr($pel,0,2);

$query=mysql_query("select * from users where substr(id_user,1,2)='$y' order by id_user desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_user'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = $_POST['username'];
$pass     = md5($_POST['password']);
$nik = $_POST['nik'];
// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
$login=mysql_query("SELECT p.id_penduduk as id_pen, p.nik, u.username, u.id_penduduk FROM `penduduk` as p Left JOIN users as u on p.`id_penduduk`= u.id_penduduk WHERE p.nik = '$nik' and u.username is NULL");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
$login2=mysql_query("SELECT p.id_penduduk as id_pen, p.`nik`, u.username, u.id_penduduk FROM `penduduk` as p Left JOIN users as u on p.`id_penduduk`= u.id_penduduk WHERE p.nik = '$nik' and u.username is not NULL");
$ketemu2=mysql_num_rows($login2);

  session_start();

if ($ketemu > 0){
  session_start();
  

  $query=mysql_query("insert into users (username, id_penduduk, password, level,user_aktif) 
  values ('$username','$r[id_pen]','$pass','penduduk','Y')");
  

  echo"<script>alert('Anda berhasil terdaftar di Sistem!');history.go(-1);</script>";
}
else if ($ketemu2 > 0){
    
  echo"<script>alert('Anda telah terdaftar di Sistem!');history.go(-1);</script>";
    
}
else{
  echo"<script>alert('Anda tidak terdaftar di data penduduk!');history.go(-1);</script>";
}

}
?>
