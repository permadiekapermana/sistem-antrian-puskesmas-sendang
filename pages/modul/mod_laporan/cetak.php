<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Rekapitulasi Data Riwayat Berobat Pasien</title>
</head>
<body>

	<center>

		<h2>Rekapitulasi Data</h2>
		<h4>Riwayat Berobat Pasien</h4>

	</center>

	<?php 
	include '../../../config/koneksi.php';
	?>

	<table border="1" style="width: 100%">
		<tr>
            <th>No.</th>
            <th>ID Antrian</th>
            <th>Tanggal Berobat</th>
            <th>Nomor Antrian</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>      
            <th>Status Antrian</th>
		</tr>
        <?php 
        
        $sql = mysql_query("SELECT * FROM `antrian`
        INNER JOIN `poli` ON `antrian`.`id_poli` = `poli`.`id_poli`
        ORDER BY id_antrian DESC"); 
        
        $no = 1;

		while($data = mysql_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $data['id_antrian']; ?></td>
            <td><?php echo $data['tgl_berobat']; ?></td>
            <td><?php echo "$data[kode_poli]","$data[nomor]" ?></td>
            <td><?php echo $data['jam_mulai']; ?></td>
            <td><?php echo $data['jam_selesai']; ?></td>
            <td><?php echo $data['status_antrian']; ?></td>
		</tr>
        <?php 
        $no++;
		}
        ?>
	</table>

	<script>
		window.print();
	</script>

</body>
</html>