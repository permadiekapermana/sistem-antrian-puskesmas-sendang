<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";
              
                   
 echo"<div class='right_col' role='main'>
          <div class=''>  ";     
if ($_GET['module']=='Dashboard'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='operator'){
    include "modul/mod_dashboard/dashboard.php";
  }
}
// Modul Users
elseif ($_GET[module]=='Users'){
   if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_users/users.php";
  }
}
elseif ($_GET[module]=='Poli'){
  if ($_SESSION['leveluser']=='admin'){
   include "modul/mod_poli/poli.php";
 }
}
elseif ($_GET[module]=='PanggilAntrian'){
  if ($_SESSION['leveluser']=='operator'){
   include "modul/mod_antrian/antrian.php";
 }
}
elseif ($_GET[module]=='Laporan'){
  if ($_SESSION['leveluser']=='admin'){
   include "modul/mod_laporan/laporan.php";
 }
}
elseif ($_GET[module]=='profile'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='operator'){
    include "modul/mod_profile/profile.php";
  }
}
// Modul Password
elseif ($_GET[module]=='password'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='operator'){
    include "modul/mod_password/password.php";
  }
}

else{
  echo "<p><b>MODUL Tidak DITEMUKAN</b></p>";
}		
echo"</div>
</div>";
?>   
