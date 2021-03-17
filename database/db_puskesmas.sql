-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 08:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` varchar(11) NOT NULL,
  `id_poli` varchar(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_berobat` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status_antrian` varchar(20) NOT NULL,
  `nomor` int(10) NOT NULL,
  `username` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_poli`, `nama`, `tgl_berobat`, `jam_mulai`, `jam_selesai`, `status_antrian`, `nomor`, `username`) VALUES
('QUEU.000001', 'POLI.000001', '', '2021-03-06', '13:20:05', '16:05:45', 'Selesai', 1, 'adit'),
('QUEU.000002', 'POLI.000002', '', '2021-03-06', '16:00:37', '16:05:33', 'Selesai', 1, 'adit'),
('QUEU.000003', 'POLI.000002', '', '2021-03-06', '16:05:08', '16:08:25', 'Selesai', 2, 'adit'),
('QUEU.000004', 'POLI.000003', '', '2021-03-06', '16:19:30', NULL, 'Dipanggil', 1, NULL),
('QUEU.000005', 'POLI.000001', '', '2021-03-14', '18:47:12', '18:53:08', 'Selesai', 1, 'adit'),
('QUEU.000006', 'POLI.000003', '', '2021-03-14', '18:53:03', '19:00:56', 'Selesai', 1, 'adit'),
('QUEU.000007', 'POLI.000002', '', '2021-03-14', '19:01:00', NULL, 'Dipanggil', 1, NULL),
('QUEU.000008', 'POLI.000001', NULL, '2021-03-17', '14:07:49', NULL, 'Dalam Antrian', 1, NULL),
('QUEU.000009', 'POLI.000001', NULL, '2021-03-17', '14:13:04', NULL, 'Dalam Antrian', 2, NULL),
('QUEU.000010', 'POLI.000001', NULL, '2021-03-17', '14:24:26', NULL, 'Dalam Antrian', 3, NULL),
('QUEU.000011', 'POLI.000001', NULL, '2021-03-17', '14:25:19', NULL, 'Dalam Antrian', 4, NULL),
('QUEU.000012', 'POLI.000001', NULL, '2021-03-17', '14:27:08', NULL, 'Dalam Antrian', 5, NULL),
('QUEU.000013', 'POLI.000001', 'adit', '2021-03-17', '14:28:25', NULL, 'Dalam Antrian', 6, NULL),
('QUEU.000014', 'POLI.000001', 'pep', '2021-03-17', '14:29:44', NULL, 'Dalam Antrian', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id_audio` varchar(11) NOT NULL,
  `no_antrian` varchar(10) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`id_audio`, `no_antrian`, `file`) VALUES
('AUDI.000001', 'A1', '6nomor antrian a1 silahkan menuju poli umum.mp3'),
('AUDI.000002', 'A2', '38nomor antrian a2 silahkan menuju poli umum.mp3'),
('AUDI.000003', 'A3', '70nomor antrian a3 silahkan menuju poli umum.mp3'),
('AUDI.000004', 'A4', '74nomor antrian a4 silahkan menuju poli umum.mp3'),
('AUDI.000005', 'A5', '33nomor antrian a5 silahkan menuju poli umum.mp3'),
('AUDI.000006', 'A6', '86nomor antrian a6 silahkan menuju poli umum.mp3'),
('AUDI.000007', 'A7', '90nomor antrian a7 silahkan menuju poli umum.mp3'),
('AUDI.000008', 'A8', '22nomor antrian a8 silahkan menuju poli umum.mp3'),
('AUDI.000009', 'A9', '92nomor antrian a9 silahkan menuju poli umum.mp3'),
('AUDI.000010', 'A10', '71nomor antrian a10 silahkan menuju poli umum.mp3'),
('AUDI.000011', 'A11', '9nomor antrian a11 silahkan menuju poli umum.mp3'),
('AUDI.000012', 'A12', '3nomor antrian a dua belas silahkan menuju poli umum.mp3'),
('AUDI.000013', 'A13', '89nomor antrian a tiga belas silahkan menuju poli umum.mp3'),
('AUDI.000014', 'A14', '69nomor antrian a empat belas silahkan menuju poli umum.mp3'),
('AUDI.000015', 'A15', '93nomor antrian a lima belas silahkan menuju poli umum.mp3'),
('AUDI.000016', 'A16', '97nomor antrian a enam belas silahkan menuju poli umum.mp3'),
('AUDI.000017', 'A17', '23nomor antrian a tujuh belas silahkan menuju poli umum.mp3'),
('AUDI.000018', 'A18', '4nomor antrian a delapan belas silahkan menuju poli umum.mp3'),
('AUDI.000019', 'A19', '94nomor antrian a sembilan belas silahkan menuju poli umum.mp3'),
('AUDI.000020', 'A20', '88nomor antrian a dua puluh silahkan menuju poli umum.mp3'),
('AUDI.000021', 'B1', '41nomor antrian b satu silahkan menuju poli gigi.mp3'),
('AUDI.000022', 'B2', '49nomor antrian b dua silahkan menuju poli gigi.mp3'),
('AUDI.000023', 'B3', '51nomor antrian b tiga silahkan menuju poli gigi.mp3'),
('AUDI.000024', 'B4', '71nomor antrian b empat silahkan menuju poli gigi.mp3'),
('AUDI.000025', 'B5', '81nomor antrian b lima silahkan menuju poli gigi.mp3'),
('AUDI.000026', 'B6', '31nomor antrian b enam silahkan menuju poli gigi.mp3'),
('AUDI.000027', 'B7', '91nomor antrian b tujuh silahkan menuju poli gigi.mp3'),
('AUDI.000028', 'B8', '20nomor antrian b delapan silahkan menuju poli gigi.mp3'),
('AUDI.000029', 'B9', '96nomor antrian b sembilan silahkan menuju poli gigi.mp3'),
('AUDI.000030', 'B10', '40nomor antrian b sepuluh silahkan menuju poli gigi.mp3'),
('AUDI.000031', 'B11', '86nomor antrian b sebelas silahkan menuju poli gigi.mp3'),
('AUDI.000032', 'B12', '92nomor antrian b dua belas silahkan menuju poli gigi.mp3'),
('AUDI.000033', 'B13', '93nomor antrian b tiga belas silahkan menuju poli gigi.mp3'),
('AUDI.000034', 'B14', '11nomor antrian b empat belas silahkan menuju poli gigi.mp3'),
('AUDI.000035', 'B15', '28nomor antrian b lima belas silahkan menuju poli gigi.mp3'),
('AUDI.000036', 'B16', '47nomor antrian b enam belas silahkan menuju poli gigi.mp3'),
('AUDI.000037', 'B17', '50nomor antrian b tujuh belas silahkan menuju poli gigi.mp3'),
('AUDI.000038', 'B18', '74nomor antrian b delapan belas silahkan menuju poli gigi.mp3'),
('AUDI.000039', 'B19', '36nomor antrian b sembilan belas silahkan menuju poli gigi.mp3'),
('AUDI.000040', 'B20', '63nomor antrian b dua puluh silahkan menuju poli gigi.mp3'),
('AUDI.000041', 'C1', '52nomor antrian c satu silahkan menuju poli anak.mp3'),
('AUDI.000042', 'C2', '47nomor antrian c dua silahkan menuju poli anak.mp3'),
('AUDI.000043', 'C3', '20nomor antrian c tiga silahkan menuju poli anak.mp3'),
('AUDI.000044', 'C4', '78nomor antrian c empat silahkan menuju poli anak.mp3'),
('AUDI.000045', 'C5', '82nomor antrian c lima silahkan menuju poli anak.mp3'),
('AUDI.000046', 'C6', '46nomor antrian c enam silahkan menuju poli anak.mp3'),
('AUDI.000047', 'C7', '85nomor antrian c tujuh silahkan menuju poli anak.mp3'),
('AUDI.000048', 'C8', '94nomor antrian c enam silahkan menuju poli anak.mp3'),
('AUDI.000049', 'C9', '34nomor antrian c sembilan silahkan menuju poli anak.mp3'),
('AUDI.000050', 'C10', '94nomor antrian c sepuluh silahkan menuju poli anak.mp3'),
('AUDI.000051', 'C11', '71nomor antrian c sebelas silahkan menuju poli anak.mp3'),
('AUDI.000052', 'C12', '8nomor antrian c dua belas silahkan menuju poli anak.mp3'),
('AUDI.000053', 'C13', '80nomor antrian c tigas belas silahkan menuju poli anak.mp3'),
('AUDI.000054', 'C14', '19nomor antrian c empat belas silahkan menuju poli anak.mp3'),
('AUDI.000055', 'C15', '89nomor antrian c lima belas silahkan menuju poli anak.mp3'),
('AUDI.000056', 'C16', '31nomor antrian c enam belas silahkan menuju poli anak.mp3'),
('AUDI.000057', 'C17', '10nomor antrian c tujuh belas silahkan menuju poli anak.mp3'),
('AUDI.000058', 'C18', '69nomor antrian c delapan belas silahkan menuju poli anak.mp3'),
('AUDI.000059', 'C19', '94nomor antrian c sembilan belas silahkan menuju poli anak.mp3'),
('AUDI.000060', 'C20', '18nomor antrian c dua puluh silahkan menuju poli anak.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id_poli` varchar(11) NOT NULL,
  `kode_poli` varchar(10) NOT NULL,
  `nama_poli` varchar(30) NOT NULL,
  `max_perhari` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `kode_poli`, `nama_poli`, `max_perhari`) VALUES
('POLI.000001', 'A', 'Poli Umum', 20),
('POLI.000002', 'B', 'Poli Gigi', 20),
('POLI.000003', 'C', 'Poli Anak', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `level` varchar(15) NOT NULL,
  `user_aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `user_aktif`) VALUES
('adit', '486b6c6b267bc61677367eb6b6458764', 'Adityo Gustaman', 'adit@gmail.com', '089999999999', 'operator', 'Y'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Puskesmas', 'adminpuskesmas@gmail.com', '08981187272', 'admin', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_poli` (`id_poli`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id_audio`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`),
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
