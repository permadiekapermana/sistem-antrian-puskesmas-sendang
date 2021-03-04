-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 12:53 PM
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

INSERT INTO `antrian` (`id_antrian`, `id_poli`, `tgl_berobat`, `jam_mulai`, `jam_selesai`, `status_antrian`, `nomor`, `username`) VALUES
('QUEU.000001', 'POLI.000001', '2021-03-04', '18:48:23', '18:48:33', 'Selesai', 1, 'adit'),
('QUEU.000002', 'POLI.000002', '2021-03-04', '18:48:43', '18:48:54', 'Selesai', 1, 'adit'),
('QUEU.000003', 'POLI.000003', '2021-03-04', '18:51:45', '18:52:08', 'Selesai', 1, 'adit');

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
('AUDI.000001', 'A1', '33A1.mp3'),
('AUDI.000002', 'A2', '60A2.mp3'),
('AUDI.000003', 'A3', '77A3.mp3'),
('AUDI.000004', 'A4', '4A4.mp3'),
('AUDI.000005', 'A5', '91A5.mp3'),
('AUDI.000006', 'A6', '7A6.mp3'),
('AUDI.000007', 'A7', '52A7.mp3'),
('AUDI.000008', 'A8', '3A8.mp3'),
('AUDI.000009', 'A9', '24A9.mp3'),
('AUDI.000010', 'A10', '89A10.mp3'),
('AUDI.000011', 'A11', '76A11.mp3'),
('AUDI.000012', 'A12', '25A12.mp3'),
('AUDI.000013', 'A13', '8A13.mp3'),
('AUDI.000014', 'A14', '18A14.mp3'),
('AUDI.000015', 'A15', '71A15.mp3'),
('AUDI.000016', 'A16', '90A16.mp3'),
('AUDI.000017', 'A17', '68A17.mp3'),
('AUDI.000018', 'A18', '76A18.mp3'),
('AUDI.000019', 'A19', '63A19.mp3'),
('AUDI.000020', 'A20', '18A20.mp3'),
('AUDI.000021', 'B1', '43nomor antrian b1 silahkan menuju pendaftaran.mp3'),
('AUDI.000022', 'B2', '95nomor antrian b2 silahkan menuju pendaftaran.mp3'),
('AUDI.000023', 'B3', '63nomor antrian b3 silahkan menuju pendaftaran.mp3'),
('AUDI.000024', 'B4', '12nomor antrian b4 silahkan menuju pendaftaran.mp3'),
('AUDI.000025', 'B5', '73nomor antrian b5 silahkan menuju pendaftaran.mp3'),
('AUDI.000026', 'B6', '70nomor antrian b6 silahkan menuju pendaftaran.mp3'),
('AUDI.000027', 'B7', '12nomor antrian b7 silahkan menuju pendaftaran.mp3'),
('AUDI.000028', 'B8', '38nomor antrian b8 silahkan menuju pendaftaran.mp3'),
('AUDI.000029', 'B9', '3nomor antrian b9 silahkan menuju pendaftaran.mp3'),
('AUDI.000030', 'B10', '28nomor antrian b10 silahkan menuju pendaftaran.mp3'),
('AUDI.000031', 'B11', '83nomor antrian b11 silahkan menuju pendaftaran.mp3'),
('AUDI.000032', 'B12', '38nomor antrian b12 silahkan menuju pendaftaran.mp3'),
('AUDI.000033', 'B13', '96nomor antrian b13 silahkan menuju pendaftaran.mp3'),
('AUDI.000034', 'B14', '79nomor antrian b14 silahkan menuju pendaftaran.mp3'),
('AUDI.000035', 'B15', '77nomor antrian b15 silahkan menuju pendaftaran.mp3'),
('AUDI.000036', 'B16', '20nomor antrian b16 silahkan menuju pendaftaran.mp3'),
('AUDI.000037', 'B17', '73nomor antrian b17 silahkan menuju pendaftaran.mp3'),
('AUDI.000038', 'B18', '13nomor antrian b18 silahkan menuju pendaftaran.mp3'),
('AUDI.000039', 'B19', '87nomor antrian b19 silahkan menuju pendaftaran.mp3'),
('AUDI.000040', 'B20', '42nomor antrian b20 silahkan menuju pendaftaran.mp3'),
('AUDI.000041', 'C1', '9nomor antrian c1 silahkan menuju pendaftaran.mp3'),
('AUDI.000042', 'C2', '99nomor antrian c2 silahkan menuju pendaftaran.mp3'),
('AUDI.000043', 'C3', '40nomor antrian c3 silahkan menuju pendaftaran.mp3'),
('AUDI.000044', 'C4', '93nomor antrian c4 silahkan menuju pendaftaran.mp3'),
('AUDI.000045', 'C5', '60nomor antrian c5 silahkan menuju pendaftaran.mp3'),
('AUDI.000046', 'C6', '84nomor antrian c6 silahkan menuju pendaftaran.mp3'),
('AUDI.000047', 'C7', '46nomor antrian c7 silahkan menuju pendaftaran.mp3'),
('AUDI.000048', 'C8', '87nomor antrian c8 silahkan menuju pendaftaran.mp3'),
('AUDI.000049', 'C9', '23nomor antrian c9 silahkan menuju pendaftaran.mp3'),
('AUDI.000050', 'C10', '18nomor antrian c10 silahkan menuju pendaftaran.mp3'),
('AUDI.000051', 'C11', '48nomor antrian c11 silahkan menuju pendaftaran.mp3'),
('AUDI.000052', 'C12', '53nomor antrian c12 silahkan menuju pendaftaran.mp3'),
('AUDI.000053', 'C13', '55nomor antrian c13 silahkan menuju pendaftaran.mp3'),
('AUDI.000054', 'C14', '94nomor antrian c14 silahkan menuju pendaftaran.mp3'),
('AUDI.000055', 'C15', '63nomor antrian c15 silahkan menuju pendaftaran.mp3'),
('AUDI.000056', 'C16', '69nomor antrian c16 silahkan menuju pendaftaran.mp3'),
('AUDI.000057', 'C17', '52nomor antrian c17 silahkan menuju pendaftaran.mp3'),
('AUDI.000058', 'C18', '37nomor antrian c18 silahkan menuju pendaftaran.mp3'),
('AUDI.000059', 'C19', '29nomor antrian c19 silahkan menuju pendaftaran.mp3'),
('AUDI.000060', 'C20', '3nomor antrian c20 silahkan menuju pendaftaran.mp3');

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