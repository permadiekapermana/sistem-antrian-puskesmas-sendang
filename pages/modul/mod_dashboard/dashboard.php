<?php

$poli_umum      = mysql_query("SELECT * FROM poli WHERE id_poli='POLI.000001'");
$p1             = mysql_fetch_array($poli_umum);
$poli_anak      = mysql_query("SELECT * FROM poli WHERE id_poli='POLI.000002'");
$p2             = mysql_fetch_array($poli_anak);
$poli_gigi      = mysql_query("SELECT * FROM poli WHERE id_poli='POLI.000003'");
$p3             = mysql_fetch_array($poli_gigi);

$pel="QUEU.";
$y=substr($pel,0,4);
$query=mysql_query("select * from antrian where substr(id_antrian,1,4)='$y' order by id_antrian desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_antrian'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="aksi_antrian.php";

?>
<?php
      if ($_SESSION['leveluser']!='penduduk'){
      ?>
<!-- Small boxes (Stat box) -->
      <div class="alert alert-success" role="alert">
        Selamat Datang di Puskesmas Sendang, Anda berada pada halaman Dashboard!
      </div>
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
              $nomor_antrian  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p1[id_poli]' AND tgl_berobat=$tgl_sekarang");
              $r              = mysql_fetch_array($nomor_antrian);
              $antrian_menunggu  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p1[id_poli]' AND tgl_berobat=$tgl_sekarang AND status_antrian!='Selesai'");
              $m              = mysql_fetch_array($antrian_menunggu);

              if ($r['jumlah']>0) {
                $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p1[id_poli]' ORDER BY id_antrian DESC LIMIT 1");
                $r2       = mysql_fetch_array($antrian);
                $nomor    = $r2[nomor] + 1;
              } else {    
                $nomor = 1;
              }
              ?>
              <?php
              $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p1[id_poli]' AND tgl_berobat=$tgl_sekarang ORDER BY id_antrian DESC LIMIT 1");
              $r2       = mysql_fetch_array($antrian);
              if($r2[nomor]==$p1[max_perhari]) {
                echo"
                <h3>PENUH!</h3>
                ";
              } else {
                echo"
                <h3>$p1[kode_poli]$nomor</h3>
                ";
              }
              ?>

              <p><?php echo $p1['nama_poli'] ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <div class="small-box-footer">Sisa Antrian : <?php echo"$m[jumlah]";?></div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              $nomor_antrian  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p2[id_poli]' AND tgl_berobat=$tgl_sekarang");
              $r              = mysql_fetch_array($nomor_antrian);
              $antrian_menunggu  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p2[id_poli]' AND tgl_berobat=$tgl_sekarang AND status_antrian!='Selesai'");
              $m              = mysql_fetch_array($antrian_menunggu);

              if ($r['jumlah']>0) {
                $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p2[id_poli]' ORDER BY id_antrian DESC LIMIT 1");
                $r2       = mysql_fetch_array($antrian);
                $nomor    = $r2[nomor] + 1;
              } else {    
                $nomor = 1;
              }
              ?>
              <?php
              $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p2[id_poli]' AND tgl_berobat=$tgl_sekarang ORDER BY id_antrian DESC LIMIT 1");
              $r2       = mysql_fetch_array($antrian);
              if($r2[nomor]==$p2[max_perhari]) {
                echo"
                <h3>PENUH!</h3>
                ";
              } else {
                echo"
                <h3>$p2[kode_poli]$nomor</h3>
                ";
              }
              ?>

              <p><?php echo $p2['nama_poli'] ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <div class="small-box-footer">Sisa Antrian : <?php echo"$m[jumlah]";?></div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <?php
              $nomor_antrian  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p3[id_poli]' AND tgl_berobat=$tgl_sekarang");
              $r              = mysql_fetch_array($nomor_antrian);
              $antrian_menunggu  = mysql_query("SELECT *, COUNT(id_antrian) as jumlah FROM `antrian` WHERE id_poli='$p3[id_poli]' AND tgl_berobat=$tgl_sekarang AND status_antrian!='Selesai'");
              $m              = mysql_fetch_array($antrian_menunggu);

              if ($r['jumlah']>0) {
                $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p3[id_poli]' ORDER BY id_antrian DESC LIMIT 1");
                $r2       = mysql_fetch_array($antrian);
                $nomor    = $r2[nomor] + 1;
              } else {    
                $nomor = 1;
              }
              ?>
              <?php
              $antrian  = mysql_query("SELECT * FROM `antrian` WHERE id_poli='$p3[id_poli]' AND tgl_berobat=$tgl_sekarang ORDER BY id_antrian DESC LIMIT 1");
              $r2       = mysql_fetch_array($antrian);
              if($r2[nomor]==$p3[max_perhari]) {
                echo"
                <h3>PENUH!</h3>
                ";
              } else {
                echo"
                <h3>$p3[kode_poli]$nomor</h3>
                ";
              }
              ?>

              <p><?php echo $p3['nama_poli'] ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <div class="small-box-footer">Sisa Antrian : <?php echo"$m[jumlah]";?></div>
          </div>
        </div>
<?php
}
?>