-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2022 at 03:28 AM
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
-- Table structure for table `detiluser`
--

DROP TABLE IF EXISTS `detiluser`;
CREATE TABLE IF NOT EXISTS `detiluser` (
  `iddetiluser` varchar(6) NOT NULL,
  `iduserslogin` varchar(6) NOT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `jalan` varchar(150) DEFAULT NULL,
  `no` varchar(5) DEFAULT NULL,
  `bl` varchar(5) DEFAULT NULL,
  `th` varchar(5) DEFAULT NULL,
  `blok` varchar(10) DEFAULT NULL,
  `kesatuan` varchar(30) DEFAULT NULL,
  `th_pem_penu` varchar(4) DEFAULT NULL,
  `asal_usul` varchar(35) DEFAULT NULL,
  `l_bangunan` float DEFAULT '0',
  `l_tanah` float DEFAULT '0',
  `tipe` varchar(10) DEFAULT NULL,
  `b_rr_rb` varchar(4) DEFAULT NULL,
  `ketentuan_sewa` varchar(5) DEFAULT '0',
  `keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`iddetiluser`),
  KEY `FK_detiluser_key` (`iduserslogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detiluser`
--

INSERT INTO `detiluser` (`iddetiluser`, `iduserslogin`, `rt`, `rw`, `jalan`, `no`, `bl`, `th`, `blok`, `kesatuan`, `th_pem_penu`, `asal_usul`, `l_bangunan`, `l_tanah`, `tipe`, `b_rr_rb`, `ketentuan_sewa`, `keterangan`) VALUES
('D00001', 'U00002', 'OO1', 'O5', 'JL JAYA WIJAYA I', '177', 'VIII', '2017', 'PA-3', 'MENART-2', '1972', 'PEMBANGUNAN', 128, 180, 'T.120', 'B', 'ya', ''),
('D00002', 'U00003', '05', '01', 'Pondok Jati AE 14', '11', '02', '08', 'AE', 'TNI', '2007', 'Pembangunan', 600, 1500, '55', 'B', 'tidak', '-');

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
('K00001', 'TNI ANGKATAN LAUT', 1945, 'Yudo Margono', 'Komplek Militer Cilangkap, Cilangkap, Cipayung, Kota Jakarta Timur', '13870', '0218723308', '0218710628', 'https://www.tnial.mil.id/', 'rampapraditya@gmail.com', './assets/img/fe26482c6e591a85e6c9bc9a664f8895.png');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

DROP TABLE IF EXISTS `keluarga`;
CREATE TABLE IF NOT EXISTS `keluarga` (
  `idkeluarga` varchar(6) NOT NULL,
  `iduserslogin` varchar(6) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `jkel` varchar(45) NOT NULL,
  `tmp_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `hubungan` varchar(45) NOT NULL,
  PRIMARY KEY (`idkeluarga`),
  KEY `FK_keluarga_key` (`iduserslogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`idkeluarga`, `iduserslogin`, `nama`, `jkel`, `tmp_lahir`, `tgl_lahir`, `hubungan`) VALUES
('K00001', 'U00003', 'Atika', 'Perempuan', 'Sidoarjo', '2022-01-16', 'ISTRI');

-- --------------------------------------------------------

--
-- Table structure for table `komplek`
--

DROP TABLE IF EXISTS `komplek`;
CREATE TABLE IF NOT EXISTS `komplek` (
  `idkomplek` varchar(6) NOT NULL,
  `nama_komplek` varchar(150) NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lon` varchar(45) NOT NULL,
  PRIMARY KEY (`idkomplek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komplek`
--

INSERT INTO `komplek` (`idkomplek`, `nama_komplek`, `lat`, `lon`) VALUES
('K00001', 'Komplek Sunter', '-6.163251', '106.885772'),
('K00002', 'Komplek Cilandak (PERWIRA)', '-6.30112526873089', '106.81249544440927'),
('K00003', 'Komplek Cilandak (BINTARA)', '-6.300760', '106.812769'),
('K00004', 'Komplek Cilandak (TAMTAMA)', '-6.304796', '106.809967'),
('K00005', 'Bambe', '-7.35209140', '112.64637060');

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
-- Table structure for table `sip`
--

DROP TABLE IF EXISTS `sip`;
CREATE TABLE IF NOT EXISTS `sip` (
  `idsip` varchar(6) NOT NULL,
  `iduserslogin` varchar(6) NOT NULL,
  `no_sip` varchar(45) NOT NULL,
  `dok_sip` varchar(150) NOT NULL,
  PRIMARY KEY (`idsip`),
  KEY `FK_sip_key` (`iduserslogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sip`
--

INSERT INTO `sip` (`idsip`, `iduserslogin`, `no_sip`, `dok_sip`) VALUES
('S00001', 'U00003', 'SIP012', './assets/file/62839a525e681a9158bc4b92d57abb2b.pdf');

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
  `idpangkat` varchar(6) NOT NULL,
  `idkorps` varchar(6) NOT NULL,
  `idkomplek` varchar(6) NOT NULL,
  PRIMARY KEY (`iduserslogin`),
  KEY `FK_userslogin_role` (`idrole`),
  KEY `FK_userslogin_pangkat` (`idpangkat`),
  KEY `FK_userslogin_korps` (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userslogin`
--

INSERT INTO `userslogin` (`iduserslogin`, `nrp`, `pass`, `nama`, `foto`, `idrole`, `idpangkat`, `idkorps`, `idkomplek`) VALUES
('U00001', 'ADMIN', 'aGtq', 'ADMINISTRATOR', '', 'R1', 'P00001', 'K00001', ''),
('U00002', '15040/P', 'aGtq', 'LAODE JIMMY HR', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00003', '111', 'aGtq', 'Rampa Praditya', './assets/img/3f1b9bc7eb1af46592288464ee367259.png', 'R2', 'P00010', 'K00001', 'K00005');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detiluser`
--
ALTER TABLE `detiluser`
  ADD CONSTRAINT `FK_detiluser_key` FOREIGN KEY (`iduserslogin`) REFERENCES `userslogin` (`iduserslogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `FK_keluarga_key` FOREIGN KEY (`iduserslogin`) REFERENCES `userslogin` (`iduserslogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sip`
--
ALTER TABLE `sip`
  ADD CONSTRAINT `FK_sip_key` FOREIGN KEY (`iduserslogin`) REFERENCES `userslogin` (`iduserslogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userslogin`
--
ALTER TABLE `userslogin`
  ADD CONSTRAINT `FK_userslogin_korps` FOREIGN KEY (`idkorps`) REFERENCES `korps` (`idkorps`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userslogin_pangkat` FOREIGN KEY (`idpangkat`) REFERENCES `pangkat` (`idpangkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userslogin_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
