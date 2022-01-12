-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2022 at 05:55 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumdis`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

DROP TABLE IF EXISTS `identitas`;
CREATE TABLE IF NOT EXISTS `identitas` (
  `kode` varchar(6) NOT NULL DEFAULT '0',
  `instansi` varchar(255) NOT NULL,
  `tahun` float DEFAULT NULL,
  `pimpinan` varchar(28) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kdpos` varchar(7) DEFAULT NULL,
  `tlp` varchar(15) DEFAULT NULL,
  `fax` varchar(35) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` longtext,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`kode`, `instansi`, `tahun`, `pimpinan`, `alamat`, `kdpos`, `tlp`, `fax`, `website`, `email`, `logo`) VALUES
('K00001', 'TNI ANGKATAN LAUT', 1945, 'Yudo Margono', 'Komplek Militer Cilangkap, Cilangkap, Cipayung, Kota Jakarta Timur', '13870', '0218723308', '0218710628', 'https://www.tnial.mil.id/', 'rampapraditya@gmail.com', './assets/img/abd1cd075a9eee465639fbbd229de2d5.png');

-- --------------------------------------------------------

--
-- Table structure for table `korps`
--

DROP TABLE IF EXISTS `korps`;
CREATE TABLE IF NOT EXISTS `korps` (
  `idkorps` varchar(6) NOT NULL,
  `nama_korps` varchar(45) NOT NULL,
  PRIMARY KEY (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korps`
--

INSERT INTO `korps` (`idkorps`, `nama_korps`) VALUES
('K00001', 'Laut (P)'),
('K00002', 'Laut (T)'),
('K00003', 'Laut (E)'),
('K00004', 'Laut (S)'),
('K00005', 'Laut (PM)'),
('K00006', 'Laut (K)'),
('K00007', 'Laut (KH)'),
('K00008', 'Marinir'),
('K00009', 'Bah'),
('K00010', 'Nav'),
('K00011', 'Kom'),
('K00012', 'Tlg'),
('K00013', 'Ekl'),
('K00014', 'Eko'),
('K00015', 'Mer'),
('K00016', 'Amo'),
('K00017', 'Rdl'),
('K00018', 'SAA'),
('K00019', 'SBA'),
('K00020', 'TRB'),
('K00021', 'Esa'),
('K00022', 'ETK'),
('K00023', 'PDK'),
('K00024', 'Jas'),
('K00025', 'Mus'),
('K00026', 'TTG'),
('K00027', 'Ttu'),
('K00028', 'Keu'),
('K00029', 'Mes'),
('K00030', 'Lis'),
('K00031', 'TKU'),
('K00032', 'MPU'),
('K00033', 'LPU'),
('K00034', 'Ang'),
('K00036', 'POM'),
('K00037', 'EDE'),
('K00038', 'Lek'),
('K00039', 'Pas'),
('K00040', 'PNS'),
('K00042', 'Tek'),
('K00043', 'Bek'),
('K00044', 'Adm');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

DROP TABLE IF EXISTS `pangkat`;
CREATE TABLE IF NOT EXISTS `pangkat` (
  `idpangkat` varchar(6) NOT NULL,
  `nama_pangkat` varchar(45) NOT NULL,
  PRIMARY KEY (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`idpangkat`, `nama_pangkat`) VALUES
('P00001', 'ADMINISTRATOR'),
('P00005', 'Laksma TNI'),
('P00010', 'Kolonel'),
('P00011', 'Letkol'),
('P00012', 'Mayor'),
('P00013', 'Kapten'),
('P00014', 'Lettu'),
('P00016', 'Peltu'),
('P00017', 'Pelda'),
('P00018', 'Serma'),
('P00019', 'Serka'),
('P00020', 'Sertu'),
('P00031', 'Penata Tk I III/d'),
('P00033', 'Penata III/C');

-- --------------------------------------------------------

--
-- Table structure for table `personil`
--

DROP TABLE IF EXISTS `personil`;
CREATE TABLE IF NOT EXISTS `personil` (
  `idpersonil` varchar(6) NOT NULL,
  `nrp` varchar(45) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `idpangkat` varchar(6) NOT NULL,
  `idkorps` varchar(6) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`idpersonil`),
  KEY `FK_personil_pangkat` (`idpangkat`),
  KEY `FK_personil_korps` (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personil`
--

INSERT INTO `personil` (`idpersonil`, `nrp`, `nama`, `idpangkat`, `idkorps`, `status`) VALUES
('P00001', '111', 'Rampa Praditya', 'P00011', 'K00001', 'AKTIF'),
('P00002', '222', 'Dinda', 'P00018', 'K00008', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `personil_keluarga`
--

DROP TABLE IF EXISTS `personil_keluarga`;
CREATE TABLE IF NOT EXISTS `personil_keluarga` (
  `idpers_kel` varchar(8) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jkel` varchar(12) DEFAULT NULL,
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `hubungan` varchar(45) DEFAULT NULL,
  `idpersonil` varchar(6) NOT NULL,
  PRIMARY KEY (`idpers_kel`),
  KEY `FK_personil_keluarga_pers` (`idpersonil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personil_keluarga`
--

INSERT INTO `personil_keluarga` (`idpers_kel`, `nama`, `jkel`, `tmp_lahir`, `tgl_lahir`, `hubungan`, `idpersonil`) VALUES
('K0000001', 'Atika', 'Perempuan', 'Lamongan', '1990-12-31', 'ISTRI', 'P00001'),
('K0000002', 'Ratika', 'Perempuan', 'Surabaya', '2021-12-01', 'ANAK', 'P00001');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` varchar(2) NOT NULL,
  `nama_role` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `nama_role`) VALUES
('R1', 'ADMIN'),
('R2', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_dinas`
--

DROP TABLE IF EXISTS `rumah_dinas`;
CREATE TABLE IF NOT EXISTS `rumah_dinas` (
  `idrumah_dinas` varchar(6) NOT NULL,
  `nama_rumdis` varchar(45) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lon` varchar(100) DEFAULT NULL,
  `idpersonil` varchar(6) NOT NULL,
  PRIMARY KEY (`idrumah_dinas`),
  KEY `idpersonil` (`idpersonil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_dinas`
--

INSERT INTO `rumah_dinas` (`idrumah_dinas`, `nama_rumdis`, `alamat`, `foto`, `lat`, `lon`, `idpersonil`) VALUES
('R00001', 'Rumah Utama', 'Graha Gunung Anyar Tambak Barat', './assets/img/dae94dbdfdc62e56135f90ff6cce6014.jpeg', '-7.885147283424331', '112.62901840153437', 'U00002'),
('R00002', 'Rumah Dinda', 'jl. pakis tirtosari surabaya', NULL, '-7.068185318145826', '111.73591892264102', 'U00003');

-- --------------------------------------------------------

--
-- Table structure for table `sip`
--

DROP TABLE IF EXISTS `sip`;
CREATE TABLE IF NOT EXISTS `sip` (
  `idsip` varchar(6) NOT NULL,
  `idpersonil` varchar(6) NOT NULL,
  `idrumah_dinas` varchar(6) NOT NULL,
  `no_sip` varchar(150) NOT NULL,
  `berkas` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idsip`),
  KEY `FK_sip_personil` (`idpersonil`),
  KEY `FK_sip_rumah_dinas` (`idrumah_dinas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sip`
--

INSERT INTO `sip` (`idsip`, `idpersonil`, `idrumah_dinas`, `no_sip`, `berkas`) VALUES
('S00001', 'P00001', 'R00001', 'SIP0001', './assets/file/965f361f4f7b95c49dd52c50ca06e377.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `userslogin`
--

DROP TABLE IF EXISTS `userslogin`;
CREATE TABLE IF NOT EXISTS `userslogin` (
  `iduserslogin` varchar(6) NOT NULL,
  `nrp` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `idrole` varchar(2) NOT NULL,
  PRIMARY KEY (`iduserslogin`),
  KEY `FK_userslogin_role` (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userslogin`
--

INSERT INTO `userslogin` (`iduserslogin`, `nrp`, `pass`, `nama`, `foto`, `idrole`) VALUES
('U00001', 'ADMIN', 'aGtq', 'ADMINISTRATOR', '', 'R1'),
('U00002', '111', 'aGtq', 'Rampa Praditya', './assets/img/3f627fb11cbc3b6e0050208ad95cad41.PNG', 'R2'),
('U00003', '222', 'aGtq', 'Dinda', './assets/img/c1292bc7dcd9a04325f6f8750bfcf72a.jpg', 'R2'),
('U00004', '333', 'aGtq', 'Atika', './assets/img/7d82164b1e635bbac9a0b4167d978bc2.PNG', 'R2');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personil`
--
ALTER TABLE `personil`
  ADD CONSTRAINT `FK_personil_korps` FOREIGN KEY (`idkorps`) REFERENCES `korps` (`idkorps`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_personil_pangkat` FOREIGN KEY (`idpangkat`) REFERENCES `pangkat` (`idpangkat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personil_keluarga`
--
ALTER TABLE `personil_keluarga`
  ADD CONSTRAINT `FK_personil_keluarga_pers` FOREIGN KEY (`idpersonil`) REFERENCES `personil` (`idpersonil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sip`
--
ALTER TABLE `sip`
  ADD CONSTRAINT `FK_sip_personil` FOREIGN KEY (`idpersonil`) REFERENCES `personil` (`idpersonil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sip_rumah_dinas` FOREIGN KEY (`idrumah_dinas`) REFERENCES `rumah_dinas` (`idrumah_dinas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userslogin`
--
ALTER TABLE `userslogin`
  ADD CONSTRAINT `FK_userslogin_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
