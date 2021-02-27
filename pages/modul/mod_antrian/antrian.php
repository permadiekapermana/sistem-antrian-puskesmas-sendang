
<?php
include "../config/koneksi.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_antrian/aksi_antrian.php";

switch($_GET[act]){
  // Tampil desa
  default:


echo "
<div class='box'>
<div class='box-header'>
  <h3 class='box-title'>Panggil Antrian Berjalan</h3> <br> <br>
</div>
<div class='box-body'>
"; ?>
<div class="col-md-3">
  <div class="box box-success box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Nomor Antrian Sebelumnya</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
      <?php
      $antrian_prev  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli WHERE tgl_berobat=$tgl_sekarang AND status_antrian='Selesai' ORDER BY id_antrian DESC LIMIT 1");
      $p              = mysql_fetch_array($antrian_prev);
      $jp            = mysql_num_rows($antrian_prev);
      if ($jp>0) {
      ?>
      <h1 class="text-center"><?php echo"$p[kode_poli]$p[nomor]"; ?></h1> <br>
      <?php
      } else {
      ?>
      <h1 class="text-center">Tidak ada antrian!</h1> <br>
      <?php
      }
      ?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<div class="col-md-3">
  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Dalam Antrian</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php
      $dalam_antrian  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli WHERE tgl_berobat=$tgl_sekarang AND status_antrian='Dipanggil' ORDER BY id_antrian ASC LIMIT 1");
      $da              = mysql_fetch_array($dalam_antrian);
      $jda            = mysql_num_rows($dalam_antrian);
      if ($jda>0) {
      ?>
      <h1 class="text-center"><?php echo"$da[kode_poli]$da[nomor]"; ?></h1> <br>
      <?php
      } else {
      ?>
      <h1 class="text-center">Tidak ada antrian!</h1> <br>
      <?php
      }
      ?>
      <?php
      if ($jda==0) {
      ?>
      <button href="#" class="btn btn-warning btn-sm mt-3" disabled>Panggil</button>      
      <a href="#" class="btn btn-info btn-sm mt-3" disabled>Tunda</a>
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=selesai&id_antrian=$da[id_antrian]";?>" class="btn btn-success btn-sm mt-3" disabled>Selesai</a>
      <?php
      } else {
      ?>
      <a href="#" class="btn btn-warning btn-sm mt-3">Panggil</a>      
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=tunda&id_antrian=$da[id_antrian]";?>" class="btn btn-info btn-sm mt-3">Tunda</a>
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=selesai&id_antrian=$da[id_antrian]";?>" class="btn btn-success btn-sm mt-3">Selesai</a>
      <?php
      }
      ?>       
    </div>
    
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<div class="col-md-3">
  <div class="box box-warning box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Nomor Antrian Selanjutnya</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php
      $antrian_next  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli WHERE tgl_berobat=$tgl_sekarang AND status_antrian='Dalam Antrian' ORDER BY id_antrian ASC LIMIT 1");
      $an              = mysql_fetch_array($antrian_next);
      $jan            = mysql_num_rows($antrian_next);
      if ($jan>0) {
      ?>
      <h1 class="text-center"><?php echo"$an[kode_poli]$an[nomor]"; ?></h1> <br>
      <?php
      } else {
      ?>
      <h1 class="text-center">Tidak ada antrian!</h1> <br>
      <?php
      }
      ?>
      <?php
      $dalam_antrian  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli WHERE tgl_berobat=$tgl_sekarang AND status_antrian='Dipanggil' ORDER BY id_antrian ASC LIMIT 1");
      $da              = mysql_fetch_array($dalam_antrian);
      $jda            = mysql_num_rows($dalam_antrian);
      if ($jda>0 || $jan==0) {
      ?>
      <button href="#" class="btn btn-primary btn-sm mt-3 disabled">Proses</button>
      <?php
      } else {
      ?>
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=next&id_antrian=$an[id_antrian]";?>" class="btn btn-primary btn-sm mt-3">Proses</a>
      <?php
      }
      ?>      
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<div class="col-md-3">
  <div class="box box-danger box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Antrian Tertunda</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php
      $antrian_tunda  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli WHERE tgl_berobat=$tgl_sekarang AND status_antrian='Tunda' ORDER BY id_antrian ASC LIMIT 1");
      $at              = mysql_fetch_array($antrian_tunda);
      $jat            = mysql_num_rows($antrian_tunda);
      if ($jat>0) {
      ?>
      <h1 class="text-center"><?php echo"$at[kode_poli]$at[nomor]"; ?></h1> <br>
      <?php
      } else {
      ?>
      <h1 class="text-center">Tidak ada antrian!</h1> <br>
      <?php
      }
      ?>
      <?php
      if ($jat==0) {
      ?>
      <a href="#" class="btn btn-warning btn-sm mt-3" disabled>Panggil</a>      
      <a href="#" class="btn btn-primary btn-sm mt-3" disabled>Selesai</a>
      <a href="#" class="btn btn-danger btn-sm mt-3" disabled>Pasien Pergi</a>
      <?php
      } else {
      ?>
      <a href="#" class="btn btn-warning btn-sm mt-3">Panggil</a>      
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=selesai&id_antrian=$at[id_antrian]";?>" class="btn btn-primary btn-sm mt-3">Selesai</a>
      <a href="<?php echo"$aksi?module=PanggilAntrian&act=pergi&id_antrian=$at[id_antrian]";?>" class="btn btn-danger btn-sm mt-3">Pasien Pergi</a>
      <?php
      }
      ?>       
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

<?php
echo"
</div>
</div>
";

break;

}

}       
        
?>


                
               
        
        
        