<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";
              
                   
 echo"<div class='right_col' role='main'>
          <div class=''>  ";     
if ($_GET['module']=='Home'){
    include "mod_home/home.php";
}

elseif ($_GET[module]=='Profile'){
    include "modul/mod_users/users.php";
}

else{
  echo "<p><b>MODUL Tidak DITEMUKAN</b></p>";
}		
echo"</div>
</div>";
?>   
