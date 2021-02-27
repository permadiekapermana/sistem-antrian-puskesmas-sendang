<!DOCTYPE html>
<html>
<head>
	<title>Nomor Antrian</title>
</head>
<body>

	<center>
        
        <img src="../../pages/images/logo_puskesmas.png" width="10%" alt="">
		<h2>PUSKESMAS SENDANG</h2>
        <?php 
            include '../../config/koneksi.php';
            $nomor_antrian  = mysql_query("SELECT * FROM `antrian` INNER JOIN poli ON antrian.id_poli=poli.id_poli ORDER BY id_antrian DESC LIMIT 1");
            $r              = mysql_fetch_array($nomor_antrian);
        echo"
        <h2><b>PENDAFTARAN</b></h2> <br>
        <font size='250'><b>$r[kode_poli]$r[nomor]</b></font>
        ";
	    ?>
        
        

	</center>

	

	<script>
		window.print();
	</script>

</body>
</html>