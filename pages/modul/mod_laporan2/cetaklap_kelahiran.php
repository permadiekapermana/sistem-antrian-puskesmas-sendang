<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "rupiah.php";
define('FPDF_FONTPATH','font/');
require('fpdf_protection.php');
$dari=$_POST[dari];	
$sampai=$_POST[sampai];


	$query= "SELECT * FROM `penduduk`
	INNER JOIN `kelahiran` ON `kelahiran`.`id_penduduk` = `penduduk`.`id_penduduk` ORDER BY id_kelahiran DESC";
	
if (!empty($query))
	  {
	  
	  $baca= mysql_query($query);
	

	$pdf=new FPDF('L','cm','Legal');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(1,3,1);
	$pdf->SetAutoPageBreak(true,3);
	$pdf->SetFont('Arial','B',14);
	$pdf->Image("images/logo-desa.jpg",4,1,3,'L');
	$pdf->SetFont('Arial','B',16);
	$pdf->Ln();
	$pdf->Cell(0,.6,'PEMERINTAH KABUPATEN CIREBON',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(0,.6,'KECAMATAN TENGAH TANI',0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',14);	
	$pdf->Cell(0,.6,'Jln. Raya Kemlaka Sampang No. 22 Kemlaka Gede .',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.6,'Kecamatan Tengah Tani Kabupaten Cirebon 45174 .',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.6,' Telp. 0231-8293218 .',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.2,'____________________________________________________________________________________________________________________',0,0,'C');
	$pdf->Ln();
		$pdf->Cell(0,.2,'____________________________________________________________________________________________________________________',0,0,'C');
	$x=$pdf->GetY();
	$pdf->SetY($x+1);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,1,'Laporan Data Perbaikan Penduduk',0,0,'C');
	$pdf->SetFont('Arial','',14);
	$pdf->Ln();


		if (mysql_num_rows ($baca)>0){
	$x=$pdf->GetY();
	$pdf->SetY($x+1);

	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(2.2,1,'Kode buku',1,0,'C');
	$pdf->Cell(2,1,'No.',1,0,'C');
	$pdf->Cell(5,1,'NIK Penduduk',1,0,'C');
	$pdf->Cell(8,1,'Nama Penduduk',1,0,'C');
	$pdf->Cell(4,1,'Tempat, Tanggal Lahir',1,0,'C');
	$pdf->Cell(4,1,'Jenis Kelamin',1,0,'C');



	$pdf->Ln();
	
	
	
while ($hasil=mysql_fetch_array($baca))
{
	$no++;

	
	
	 $pdf->SetFont('Arial','',12);
	//$pdf->Cell(2.2,1,$hasil[kode_buku],1,0,'C');
	$pdf->Cell(2,1,$no.'.',1,0,'C');
	$pdf->Cell(5,1,$hasil['nik'],1,0,'L');
	$pdf->Cell(8,1,$hasil['nama'],1,0,'L');
	$pdf->Cell(4,1,$hasil['tmp_lahir'],1,0,'C');
	$pdf->Cell(4,1,$hasil['jenis_kelamin'],1,0,'C');

	$pdf->Ln();
	
	}
	
	$x=$pdf->GetY();
	$pdf->SetY($x+2);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Mengetahui,',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Petugas Desa ',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,'Desa Kemlaka Gede ',0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(15,0.5,'');
	$pdf->Cell(0,0.5,$_SESSION[namalengkap],0,0,'C');
	$pdf->Ln();
	
	}
	$pdf->Output();
	}}
?>
