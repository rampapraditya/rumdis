-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2022 at 09:26 AM
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
  `l_bangunan` varchar(20) DEFAULT '0',
  `l_tanah` varchar(20) DEFAULT '0',
  `tipe` varchar(20) DEFAULT NULL,
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
('D00001', 'U00002', 'OO1', 'O5', 'JL JAYA WIJAYA I', '177', 'VIII', '2017', 'PA-3', 'MENART-2', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00003', 'U00004', 'OO1', 'O5', 'JL RAWA', '70', '', '2008', 'PA-2', 'DEN JAKA', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'tidak', ''),
('D00004', 'U00005', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '550', 'IV', '2007', 'PA-41', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00005', 'U00006', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '551', 'IV', '2002', 'PA-42', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00006', 'U00007', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '552', 'II', '2000', 'PA-43', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00007', 'U00008', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '553', 'VIII', '1989', 'PA-44', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00008', 'U00009', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '554', 'I', '1986', 'PA-45', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00009', 'U00010', 'OO1', 'O5', 'JL JAYA WIJAYA VII', '555', 'XII', '1993', 'PA-46', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', ''),
('D00010', 'U00011', 'OO1', 'O5', 'JL JAYA WIJAYA I', '116', 'V', '2020', 'PA-4', 'DENJAKA', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00011', 'U00012', 'OO1', 'O5', 'JL JAYA WIJAYA I', '412', 'XII', '2015', 'PA-5', 'PASMAR-2', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00012', 'U00013', 'OO1', 'O5', 'JL JAYA WIJAYA I', '216', 'XII', '2011', 'PA-6', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00013', 'U00014', 'OO1', 'O5', 'JL JAYA WIJAYA II', '197', 'VIII', '2017', 'PA-7', 'LANMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00014', 'U00015', 'OO1', 'O5', 'JL JAYA WIJAYA II', '227', 'VII', '2019', 'PA-8', 'PASMAR 1', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00015', 'U00016', 'OO1', 'O5', 'JL JAYA WIJAYA II', '334', 'I', '2019', 'PA-9', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00016', 'U00017', 'OO1', 'O5', 'JL JAYA WIJAYA III', '310', 'V', '2019', 'PA-11', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00017', 'U00018', 'OO1', 'O5', 'JL JAYA WIJAYA III', '381', 'VII', '2020', 'PA-12', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', 'OVER VB'),
('D00018', 'U00019', 'OO1', 'O5', 'JL JAYA WIJAYA IV', '226', 'IV', '2021', 'PA-15', 'BRIGIF-2', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', 'PERPANJANGAN'),
('D00019', 'U00020', 'OO1', 'O5', 'JL JAYA WIJAYA IV', '308', 'VI', '2017', 'PA-16', 'AAL', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00020', 'U00021', 'OO1', 'O5', 'JL JAYA WIJAYA IV', '322', 'VI', '2017', 'PA-17', 'LANTAMAL III', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00021', 'U00022', 'OO1', 'O5', 'JL JAYA WIJAYA IV', '409', 'VII', '2017', 'PA-18', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00022', 'U00023', 'OO1', 'O5', 'JL JAYA WIJAYA V', '115', 'VII', '2017', 'PA-19', 'MABESAL', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00023', 'U00024', 'OO1', 'O5', 'JL JAYA WIJAYA V', '329', 'I', '2009', 'PA-20', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00024', 'U00025', 'OO1', 'O5', 'JL JAYA WIJAYA V', '113', 'I', '2019', 'PA-22', 'KORMAR', '1972', 'PEMBANGUNAN', '128', '180', 'T.120', 'B', 'ya', ''),
('D00025', 'U00026', 'OO1', 'O5', 'JL JAYA WIJAYA VI', '530', 'IX', '2007', 'PA-23', 'KORMAR', '1972', 'PEMBANGUNAN ', '128', '180', 'T.120', 'B', 'ya', ''),
('D00026', 'U00027', 'OO1', 'O5', 'JL JAYA WIJAYA VI', '393', 'VII', '2017', 'PA-25', 'PASPAMPRES', '1972', 'PEMBANGUNAN ', '128', '180', 'T.120', 'B', 'ya', ''),
('D00027', 'U00028', 'OO1', 'O5', 'JL JAYA WIJAYA VI', '308', 'VI', '2018', 'PA-26', 'PASMAR-2', '1972', 'PEMBANGUNAN ', '128', '180', 'T.120', 'B', 'ya', ''),
('D00028', 'U00029', 'OO1', 'O5', 'JL USMAN', '557', 'II', '2020', 'RC-2', 'LANTAMAL', '1980', 'PEMBANGUNAN ', '80', '150', 'T.80', 'B', 'ya', ''),
('D00029', 'U00030', 'OO1', 'O5', 'JL USMAN', '390', 'IX', '2016', 'PA-39', 'ARMABAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00030', 'U00031', 'OO1', 'O5', 'JL USMAN', '450', 'VII', '2020', 'PA-40', 'KORMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00031', 'U00032', 'OO1', 'O5', 'JL USMAN', '529', 'IX', '2020', 'PA-27', 'KORMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', 'GANTI  NAMA DR ORANG TUA'),
('D00032', 'U00033', 'OO1', 'O5', 'JL USMAN', '480', 'IV', '2013', 'PA-28', 'LANMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00033', 'U00034', 'OO1', 'O5', 'JL USMAN', '481', 'X', '2020', 'PA-29', 'HOWITZER 1', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', 'PERPANJANGAN'),
('D00034', 'U00035', 'OO1', 'O5', 'JL USMAN', '482', 'VII', '2020', 'PA-30', 'DENJAKA', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'tidak', 'RUMDISJAB KORMAR/DANDENMA'),
('D00035', 'U00036', 'OO1', 'O5', 'JL USMAN', '483', 'VII', '2017', 'PA-31', 'MENART-2', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00036', 'U00037', 'OO1', 'O5', 'JL USMAN', '484', 'II', '2020', 'PA-32', 'KORMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00037', 'U00038', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '485', 'XI', '2005', 'PA-33', 'BRIGIF-2', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00038', 'U00039', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '486', 'VIII', '2017', 'PA-34', 'PASMAR-2', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00039', 'U00040', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '487', 'I', '2021', 'PA-35', 'LANMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', 'PERPANJANGAN'),
('D00040', 'U00041', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '488', 'VII', '2019', 'PA-36', 'KORMAR', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00041', 'U00042', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '489', 'II', '2020', 'PA-37', 'MENKAV-1', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00042', 'U00043', 'OO1', 'O5', 'JL JAYA WIJAYA IX', '490', 'VII', '2017', 'PA-38', 'DENJAKA', '1980', 'PEMBANGUNAN ', '70', '100', 'T.70', 'B', 'ya', ''),
('D00043', 'U00044', 'O11', 'O5', 'JL BELAKANG LAPBAK', '437', 'VII', '2017', 'PENPA-1', 'BANPUR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00044', 'U00045', 'O11', 'O5', 'JL BELAKANG LAPBAK', '378', 'VIII', '2018', 'PENPA-2', 'LANMAR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00045', 'U00046', 'O11', 'O5', 'JL BELAKANG LAPBAK', '434', 'VII', '2017', 'PENPA-3', 'LANMAR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00046', 'U00047', 'O11', 'O5', 'JL BELAKANG LAPBAK', '432', 'V', '2002', 'PENPA-4', 'PASMAR-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00047', 'U00048', 'O11', 'O5', 'JL BELAKANG LAPBAK', '431', 'IV', '2018', 'PENPA-5', 'PASMAR-3', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ' '),
('D00048', 'U00049', 'O11', 'O5', 'JL BELAKANG LAPBAK', '426', 'VIII', '2017', 'PENPA-6', 'ARHANUD', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00049', 'U00050', 'O11', 'O5', 'JL BELAKANG LAPBAK', '433', 'V', '2012', 'PENPA-7', 'KORMAR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00050', 'U00051', 'O11', 'O5', 'JL BELAKANG LAPBAK', '435', 'VII', '2017', 'PENPA-8', 'PASMAR-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00051', 'U00052', 'O11', 'O5', 'JL BELAKANG LAPBAK', '558', 'IX', '2018', 'PENPA-9', 'YONIF-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00052', 'U00053', 'O11', 'O5', 'JL BELAKANG LAPBAK', '389', 'I', '2018', 'PENPA-10', 'YONTAIFIB', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00053', 'U00054', 'O11', 'O5', 'JL BELAKANG LAPBAK', '437', 'II', '2020', 'PENPA-11', 'YONPROV', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00054', 'U00055', 'O11', 'O5', 'JL BELAKANG LAPBAK', '426', 'I', '2007', 'PENPA-12', 'MENART-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00055', 'U00056', 'O11', 'O5', 'JL BELAKANG LAPBAK', '388', 'XI', '2015', 'PENPA-13', 'LANMAR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00056', 'U00057', 'O11', 'O5', 'JL BELAKANG LAPBAK', '431', 'I', '2008', 'PENPA-14', 'YON-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00057', 'U00058', 'O11', 'O5', 'JL BELAKANG LAPBAK', '391', 'VI', '2020', 'PENPA-15', 'BRIGIF-2', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00058', 'U00059', 'O11', 'O5', 'JL BELAKANG LAPBAK', '432', 'X', '2012', 'PENPA-16', 'KORMAR', '1977', 'PEMBANGUNAN ', '40,31', '80', 'T.36', 'B', 'ya', ''),
('D00059', 'U00060', 'O10', 'O5', 'JL WIBAWA I', '297', 'V', '2015', 'BA 2-A', 'MENKAV-2', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00060', 'U00061', 'O10', 'O5', 'JL WIBAWA I', '348', 'XI', '2019', 'BA 3-A', 'YONARH-1', '1982', 'PEMBANGUNAN', '50', '90', 'T.48', 'B', 'ya', ''),
('D00061', 'U00062', 'O10', 'O5', 'JL WIBAWA I', '298', 'VII', '2017', 'BA 4-A', 'MENKAV', '1982', 'PEMBANGUNAN', '50', '90', 'T.48', 'B', 'ya', ''),
('D00062', 'U00063', 'O10', 'O5', 'JL WIBAWA I', '385', 'VIII', '2020', 'BA-5A', 'KORMAR', '1982', 'PEMBANGUNAN', '50', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00063', 'U00064', 'O10', 'O5', 'JL WIBAWA I', '299', 'II', '2009', 'BA-6A', 'MABESAL', '1982', 'PEMBANGUNAN', '50', '90', 'T.48', 'B', 'ya', ''),
('D00064', 'U00065', 'O10', 'O5', 'JL WIBAWA I', '386', 'VIII', '2012', 'BA 7-A', 'KORMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00065', 'U00066', 'O10', 'O5', 'JL WIBAWA I', '387', 'XII', '2015', 'BA 8-A', 'MENBANPUR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00066', 'U00067', 'O10', 'O5', 'JL WIBAWA I', '300', 'I', '2018', 'BA 9-A', 'KORMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00067', 'U00068', 'O10', 'O5', 'JL WIBAWA I', '302', 'VII', '2020', 'BA 10-A', 'YONMAR II', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANG'),
('D00068', 'U00069', 'O10', 'O5', 'JL WIBAWA I', '388', 'VI', '2011', 'BA 11-A', 'KORMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00069', 'U00070', 'O10', 'O5', 'JL WIBAWA I', '312', 'XII', '2010', 'BA 12-A', 'MENKAV', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00070', 'U00071', 'O10', 'O5', 'JL WIBAWA I', '317', 'I', '2016', 'BA 13-A', 'KORMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00071', 'U00072', 'O10', 'O5', 'JL WIBAWA I', '406', 'III', '2021', 'BA 14-A', 'PASMAR-3', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00072', 'U00073', 'O10', 'O5', 'JL WIBAWA I', '332', 'II', '2012', 'BA 23 A', 'BRIGIF 2', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'tidak', ''),
('D00073', 'U00074', 'O10', 'O5', 'JL WIBAWA I', '425', 'VIII', '2017', 'BA 16-A', 'LANMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00074', 'U00075', 'O10', 'O5', 'JL WIBAWA I', '430', 'IV', '2009', 'BA 17-A', 'PASMAR -2', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00075', 'U00076', 'O10', 'O5', 'JL WIBAWA I', '328', 'VIII', '2020', 'BA 18-A', 'YONIF-4', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANGAN'),
('D00076', 'U00077', 'O10', 'O5', 'JL WIBAWA I', '397', 'V', '2012', 'BA 19-A', 'PASMAR -2', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00077', 'U00078', 'O10', 'O5', 'JL WIBAWA I', '329', 'VI', '2013', 'BA 20-A', 'PASMAR-2', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00078', 'U00079', 'O10', 'O5', 'JL WIBAWA I', '343', 'VII', '2016', 'BA 21-A', 'PASMAR-2', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00079', 'U00080', 'O10', 'O5', 'JL WIBAWA I', '330', 'III', '2018', 'BA 22-A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00080', 'U00081', 'O10', 'O5', 'JL WIBAWA I', '328', 'VIII', '2017', 'BA 24 A', 'BRIGIF-2', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00081', 'U00082', 'O10', 'O5', 'JL WIBAWA I', '327', 'IV', '2002', 'BA 25 A', 'LAMPUNG', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00082', 'U00083', 'O10', 'O5', 'JL WIBAWA I', '225', 'VI', '2012', 'BA 26 A', 'DEN JAKA', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00083', 'U00084', 'O10', 'O5', 'JL WIBAWA I', '333', 'III', '2008', 'BA 27 A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00084', 'U00085', 'O10', 'O5', 'JL WIBAWA IV', '454', 'V', '2012', 'BA 28 A', 'LANMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00085', 'U00086', 'O10', 'O5', 'JL WIBAWA IV', '445', 'V', '2021', 'BA 29 A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANGAN'),
('D00086', 'U00087', 'O10', 'O5', 'JL WIBAWA IV', '452', 'VI', '2017', 'BA 30 A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00087', 'U00088', 'O10', 'O5', 'JL WIBAWA IV', '453', 'VII', '2020', 'BA 31 A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00088', 'U00089', 'O10', 'O5', 'JL WIBAWA IV', '451', 'VI', '2021', 'BA 32 A', 'KORMAR', '1982', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANGAN'),
('D00089', 'U00090', 'O10', 'O5', 'JL WIBAWA IV', '527', 'II', '2013', 'BA 34 A', 'YONARH-2', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00090', 'U00091', 'O10', 'O5', 'JL WIBAWA IV', '526', 'VI', '2017', 'BA 35 A', 'KORMAR', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00091', 'U00092', 'O10', 'O5', 'JL WIBAWA IV', '525', 'XII', '2007', 'BA 36 A', 'YON ANG', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00092', 'U00093', 'O10', 'O5', 'JL WIBAWA IV', '524', 'V', '2021', 'BA 37 A', 'PASPAMPRES', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00093', 'U00094', 'O10', 'O5', 'JL WIBAWA IV', '523', 'VIII', '2015', 'BA 38 A', 'PASPAMPRES', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00094', 'U00095', 'O10', 'O5', 'JL WIBAWA IV', '522', 'IX', '2012', 'BA 39 A', 'YONTANKFIB-2', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00095', 'U00096', 'O10', 'O5', 'JL WIBAWA IV', '521', 'X', '2015', 'BA 40 A', 'MABESAL', '1982', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00096', 'U00097', 'O2', 'O5', 'JL WIBAWA II', '214', 'VI', '2010', 'BA 2-B', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'tidak', ' '),
('D00097', 'U00098', 'O2', 'O5', 'JL WIBAWA II', '254', 'V', '2012', 'BA 3-B', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00098', 'U00099', 'O2', 'O5', 'JL WIBAWA II', '198', 'XI', '2019', 'BA 4-B', 'PASMAR 1', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00099', 'U00100', 'O2', 'O5', 'JL WIBAWA II', '135', 'IX', '2007', 'BA 5-B', 'YON-8', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', '            '),
('D00100', 'U00101', 'O2', 'O5', 'JL WIBAWA II', '137', 'VIII', '2017', 'BA 6-B', 'MENBANPUR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00101', 'U00102', 'O2', 'O5', 'JL WIBAWA II', '396', 'I', '1995', 'BA 7-B', 'LANMAR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00102', 'U00103', 'O2', 'O5', 'JL WIBAWA II', '139', 'IV', '2015', 'BA 10-B', 'BRIGIF-3', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00103', 'U00104', 'O2', 'O5', 'JL WIBAWA II', '220', 'VIII', '2010', 'BA 11-B', 'BRIGIF 2', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00104', 'U00105', 'O2', 'O5', 'JL WIBAWA II', '162', 'IV', '2002', 'BA 12-B', 'KORMAR', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00105', 'U00106', 'O2', 'O5', 'JL WIBAWA II', '136', 'VIII', '2017', 'BA 13-B', 'YON-8', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00106', 'U00107', 'O2', 'O5', 'JL WIBAWA II', '175', 'VI', '2017', 'BA 14-B', 'PASMAR I', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00107', 'U00108', 'O2', 'O5', 'JL WIBAWA II', '290', 'V', '2009', 'BA 15-B', 'PASMAR-2', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00108', 'U00109', 'O2', 'O5', 'JL WIBAWA II', '191', 'VI', '2015', 'BA 16-B', 'LANMAR', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00109', 'U00110', 'O2', 'O5', 'JL WIBAWA II', '289', 'V', '2012', 'BA 17-B', 'SPAMAL', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00110', 'U00111', 'O2', 'O5', 'JL WIBAWA II', '383', 'I', '2014', 'BA 18-B', 'LANAL BANTEN', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00111', 'U00112', 'O2', 'O5', 'JL WIBAWA II', '170', 'IX', '2010', 'BA 20-B', 'BRIGIF 2', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00112', 'U00113', 'O2', 'O5', 'JL WIBAWA II', '200', 'I', '2011', 'BA 21-B', 'KORMAR', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00113', 'U00114', 'O2', 'O5', 'JL WIBAWA II', '192', 'III', '2014', 'BA 22-B', 'YONRRF-2', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00114', 'U00115', 'O2', 'O5', 'JL WIBAWA II', '123', 'VI', '2021', 'BA 23-B', 'YONROKET-1', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00115', 'U00116', 'O2', 'O5', 'JL WIBAWA II', '167', 'V', '2017', 'BA 24-B', 'MABES TNI', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00116', 'U00117', 'O2', 'O5', 'JL WIBAWA II', '411', 'VIII', '2018', 'BA 25-B', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00117', 'U00118', 'O2', 'O5', 'JL WIBAWA II', '187', 'III', '2018', 'BA 26-B', 'KORMAR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00118', 'U00119', 'O2', 'O5', 'JL WIBAWA II', '263', 'VIII', '2017', 'BA 27-B', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00119', 'U00120', 'O2', 'O5', 'JL WIBAWA II', '276', 'II', '2009', 'BA 28-B', 'BANPUR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00120', 'U00121', 'O2', 'O5', 'JL WIBAWA III', '140', 'VIII', '2021', 'BA 1-C', 'YON HOW', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00121', 'U00122', 'O2', 'O5', 'JL WIBAWA III', '320', 'I', '2011', 'BA 2-C', 'MENKAV-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00122', 'U00123', 'O2', 'O5', 'JL WIBAWA III', '340', 'XII', '2019', 'BA 3-C', 'LANMAR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00123', 'U00124', 'O2', 'O5', 'JL WIBAWA III', '212', 'IV', '2002', 'BA 4-C', 'PASMAR I', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00124', 'U00125', 'O2', 'O5', 'JL WIBAWA III', '16', 'IV', '2021', 'BA 5-C', 'SESKOAL', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', 'OVER VB'),
('D00125', 'U00126', 'O2', 'O5', 'JL WIBAWA III', '218', 'V', '2012', 'BA 6-C', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00126', 'U00127', 'O2', 'O5', 'JL WIBAWA III', '410', 'I', '2011', 'BA 7-C', 'KORMAR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00127', 'U00128', 'O2', 'O5', 'JL WIBAWA III', '253', 'IX', '2021', 'BA 8-C', 'YONIF-4', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'RR', 'ya', 'OVER VB'),
('D00128', 'U00129', 'O2', 'O5', 'JL WIBAWA III', '260', 'V', '2012', 'BA 10-C', 'PASMAR-2', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00129', 'U00130', 'O2', 'O5', 'JL WIBAWA III', '176', 'IX', '2010', 'BA 12-C', 'KORMAR', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00130', 'U00131', 'O2', 'O5', 'JL WIBAWA III', '138', 'I', '2018', 'BA 13-C', 'MENART', '1972', 'PEMBANGUNAN', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00131', 'U00132', 'O2', 'O5', 'JL WIBAWA III', '133', 'VI', '2017', 'BA 14-C', 'PASMAR-1', '1972', 'PEMBANGUNAN ', '84', '150', 'BA. LAMA', 'B', 'ya', ''),
('D00132', 'U00133', 'O11', 'O5', 'JL BELAKANG LAPBAK', '536', 'XI', '2021', 'BA 2-D', 'DEN JAKA', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00133', 'U00134', 'O11', 'O5', 'JL BELAKANG LAPBAK', '538', 'V', '2021', 'BA 3-D', 'YONANGMOR 1', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00134', 'U00135', 'O11', 'O5', 'JL BELAKANG LAPBAK', '539', 'VII', '2017', 'BA 4-D', 'TAIFIB 1', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', 'OVER VB'),
('D00135', 'U00136', 'O11', 'O5', 'JL BELAKANG LAPBAK', '541', 'VII', '2009', 'BA 5-D', 'BRIGIF-2', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00136', 'U00137', 'O11', 'O5', 'JL BELAKANG LAPBAK', '542', 'II', '2020', 'BA 7-D', 'LANMAR JKT', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00137', 'U00138', 'O11', 'O5', 'JL BELAKANG LAPBAK', '543', 'III', '2020', 'BA 8-D', 'LANMAR JKT', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00138', 'U00139', 'O11', 'O5', 'JL BELAKANG LAPBAK', '544', 'VI', '2017', 'BA 9-D', 'BEK PAL', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00139', 'U00140', 'O11', 'O5', 'JL BELAKANG LAPBAK', '545', 'II', '2009', 'BA 10-D', 'MENKAV', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00140', 'U00141', 'O11', 'O5', 'JL BELAKANG LAPBAK', '546', '', '2007', 'BA 11-D', 'YON -6', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00141', 'U00142', 'O11', 'O5', 'JL BELAKANG LAPBAK', '547', 'III', '2020', 'BA 12-D', 'PASMAR-1', '1984', 'PEMBANGUNAN ', '50,84', '90', 'T.48', 'B', 'ya', ''),
('D00142', 'U00143', 'O11', 'O5', 'JL BELAKANG LAPBAK', '548', 'XI', '2021', 'BA 13-D', 'MABES TNI', '1984', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANGAN'),
('D00143', 'U00144', 'O11', 'O5', 'JL BELAKANG LAPBAK', '549', 'IX', '2020', 'BA 14-D', 'KORMAR', '1984', 'PEMBANGUNAN', '50,84', '90', 'T.48', 'B', 'ya', 'PERPANJANGAN'),
('D00144', 'U00145', 'OO3', 'O5', 'JL SEROJA I', '144', 'VII', '2018', 'A-8', 'LANMAR', '1972', 'PEMBANGUNAN', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00145', 'U00146', 'OO3', 'O5', 'JL SEROJA I', '354', 'XI', '2020', 'A-10', 'MENBANPUR 1', '1972', 'PEMBANGUNAN', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00146', 'U00147', 'OO3', 'O5', 'JL SEROJA I', '77', 'III', '2020', 'A-15', 'MABESAL', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00147', 'U00148', 'OO3', 'O5', 'JL SEROJA I', '183', 'III', '2011', 'A-19', 'YONKOMLEK-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00148', 'U00149', 'OO3', 'O5', 'JL SEROJA I', '182', 'VI', '2020', 'A-23', 'DENJAKA', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00149', 'U00150', 'OO3', 'O5', 'JL SEROJA II', '242', 'VIII', '2020', 'B-2', 'YONMARLAN-III', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00150', 'U00151', 'OO3', 'O5', 'JL SEROJA II', '411', 'IX', '2020', 'B-7', 'YON ARH', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00151', 'U00152', 'OO3', 'O5', 'JL SEROJA II', '425', 'X', '2021', 'B-8', 'RSMC', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00152', 'U00153', 'OO3', 'O5', 'JL SEROJA II', '285', 'V', '2019', 'B-19', 'KORMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00153', 'U00154', 'OO3', 'O5', 'JL SEROJA II', '402', 'II', '2020', 'C-1', 'MENKAV-1 MAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00154', 'U00155', 'OO3', 'O5', 'JL SEROJA II', '407', 'VII', '2021', 'C-2', 'LANMAR SOR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00155', 'U00156', 'OO3', 'O5', 'JL SEROJA II', '428', 'VIII', '2019', 'C-3', 'MENKAV 1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00156', 'U00157', 'OO3', 'O5', 'JL SEROJA II', '430', 'II', '2019', 'C-4', 'YONTAIFIB-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00157', 'U00158', 'OO3', 'O5', 'JL SEROJA II', '417', 'VI', '2020', 'C-6', 'LANMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00158', 'U00159', 'OO3', 'O5', 'JL SEROJA II', '423', 'IX', '2015', 'C-7', 'TAIFIB', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00159', 'U00160', 'OO3', 'O5', 'JL SEROJA II', '422', 'VIII', '2021', 'C-9', 'MABESAL', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00160', 'U00161', 'OO3', 'O5', 'JL SEROJA II', '408', 'IX', '2013', 'C-10', 'YONKOMLEK-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00161', 'U00162', 'OO3', 'O5', 'JL SEROJA II', '319', 'V', '2019', 'C-13', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00162', 'U00163', 'OO3', 'O5', 'JL SEROJA II', '255', 'VI', '2020', 'C-15', 'DENJAKA', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00163', 'U00164', 'OO3', 'O5', 'JL SEROJA II', '152', 'IV', '2002', 'C-19', 'YON-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00164', 'U00165', 'OO3', 'O5', 'JL SEROJA II', '189', 'IV', '2019', 'C-20', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00165', 'U00166', 'OO9', 'O5', 'JL MEMED', '173', 'VII', '2020', 'D-5', 'KORMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00166', 'U00167', 'OO9', 'O5', 'JL MEMED', '404', 'VI', '2019', 'D-6', 'KORMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00167', 'U00168', 'OO9', 'O5', 'JL MEMED', '211', 'V', '2019', 'D-8', 'YONMARLAN-III', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00168', 'U00169', 'OO9', 'O5', 'JL MEMED', '52', 'VII', '2020', 'D-10', 'YONTANKFIB-1', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00169', 'U00170', 'OO9', 'O5', 'JL MEMED', '220', 'VII', '2020', 'D-11', 'LANMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00170', 'U00171', 'OO9', 'O5', 'JL MEMED', '203', 'VII', '2020', 'D-12', 'YONPOM-1 MAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00171', 'U00172', 'OO9', 'O5', 'JL MEMED', '202', 'VIII', '2018', 'D-13', 'BRIGIF 1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00172', 'U00173', 'OO9', 'O5', 'JL MEMED', '165', 'VIII', '2015', 'D-14', 'RSMC', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00173', 'U00174', 'OO9', 'O5', 'JL MEMED', '155', 'VII', '2020', 'D-19', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00174', 'U00175', 'OO9', 'O5', 'JL MEMED', '276', 'V', '2019', 'D-20', 'BRIGIF-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00175', 'U00176', 'OO9', 'O5', 'JL MEMED', '403', 'V', '2019', 'E-1', 'LANMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00176', 'U00177', 'OO9', 'O5', 'JL MEMED', '416', 'VII', '2020', 'E-2', 'YONANGMOR-1', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00177', 'U00178', 'OO9', 'O5', 'JL MEMED', '301', 'V', '2002', 'E-5', 'KORMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00178', 'U00179', 'OO9', 'O5', 'JL MEMED', '398', 'XII', '2020', 'E-7', 'YON-6', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', 'OVER VB'),
('D00179', 'U00180', 'OO9', 'O5', 'JL MEMED', '234', 'VII', '2020', 'E-8', 'RUMKIT', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00180', 'U00181', 'OO9', 'O5', 'JL MEMED', '304', 'VII', '2020', 'E-9', 'MENKAV-1', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'B', 'ya', ''),
('D00181', 'U00182', 'OO9', 'O5', 'JL MEMED', '164', 'IX', '2012', 'E-15', 'PASMAR-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00182', 'U00183', 'OO9', 'O5', 'JL MEMED', '260', 'V', '2019', 'E-16', 'PASMAR-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00183', 'U00184', 'OO9', 'O5', 'JL SEROJA III', '582', 'I', '2021', 'F-2', 'YONIF 3', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', 'OVER VB'),
('D00184', 'U00185', 'OO9', 'O5', 'JL SEROJA III', '514', 'X', '2021', 'F-4', 'RSMC', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', 'PERPANJANGAN'),
('D00185', 'U00186', 'OO9', 'O5', 'JL SEROJA III', '506', 'VII', '2020', 'F-5', 'YONBEKPAL-1', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00186', 'U00187', 'OO9', 'O5', 'JL SEROJA III', '437', 'XII', '2019', 'F-7', 'KORMAR', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00187', 'U00188', 'OO9', 'O5', 'JL SEROJA III', '442', 'VII', '2017', 'F-8', 'YONIF-4', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00188', 'U00189', 'OO9', 'O5', 'JL SEROJA III', '433', 'VIII', '2015', 'F-10', 'RUMKIT', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00189', 'U00190', 'OO9', 'O5', 'JL SEROJA III', '446', 'VII', '2020', 'F-11', 'MABES TNI', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00190', 'U00191', 'OO9', 'O5', 'JL SEROJA III', '449', 'V', '2012', 'F-13', 'PASMAR-2', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00191', 'U00192', 'OO9', 'O5', 'JL SEROJA III', '439', 'VII', '2020', 'F-14', 'PASMAR-1', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00192', 'U00193', 'OO9', 'O5', 'JL SEROJA III', '448', 'V', '2019', 'F-15', 'BRIGIF-1', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00193', 'U00194', 'OO9', 'O5', 'JL SEROJA III', '438', 'VII', '2020', 'F-16', 'YONTAIFIB-1', '1977', 'PEMBANGUNAN ', '49,20', '70', 'T. 38', 'B', 'ya', ''),
('D00194', 'U00195', 'OO9', 'O5', 'JL SEROJA III', '155', 'VII', '2020', 'F-17', 'DENINTEL', '1977', 'PEMBANGUNAN ', '65,28', '70', 'T. 38', 'B', 'ya', ''),
('D00195', 'U00196', 'OO9', 'O5', 'JL SEROJA III', '142', 'VIII', '2020', 'F-19', 'YON-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00196', 'U00197', 'OO9', 'O5', 'JL SEROJA III', '511', 'X', '2018', 'G-1', 'KORMAR', '1972', 'PEMBANGUNAN ', '49,98', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00197', 'U00198', 'OO6', 'O5', 'JL SEROJA III', '496', 'XII', '2018', 'G-2', 'YON KAPA', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', ''),
('D00198', 'U00199', 'OO6', 'O5', 'JL SEROJA III', '509', 'VIII', '2018', 'G-3', 'BRIGIF 1', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', ''),
('D00199', 'U00200', 'OO6', 'O5', 'JL SEROJA III', '495', 'V', '2018', 'G-4', 'BRIGIF-1', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', ''),
('D00200', 'U00201', 'OO6', 'O5', 'JL SEROJA III', '504', 'IX', '2020', 'G-8', 'YON-6', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00201', 'U00202', 'OO6', 'O5', 'JL SEROJA III', '445', 'IX', '2020', 'G-9', 'RUMKIT', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00202', 'U00203', 'OO6', 'O5', 'JL SEROJA III', '444', 'IX', '2020', 'G-10', 'YON-6', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00203', 'U00204', 'OO6', 'O5', 'JL SEROJA III', '441', 'IX', '2020', 'G-15', 'KORMAR', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00204', 'U00205', 'OO6', 'O5', 'JL SEROJA III', '447', 'IX', '2020', 'G-16', 'KORMAR', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00205', 'U00206', 'OO6', 'O5', 'JL SEROJA III', '64', 'IX', '2020', 'G-17', 'KORMAR', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00206', 'U00207', 'OO6', 'O5', 'JL SEROJA III', '132', 'IX', '2020', 'G-20', 'MEN ART-1', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00207', 'U00208', 'OO6', 'O5', 'JL SEROJA IV', '61', 'IX', '2020', 'H-4', 'YON ZENI', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00208', 'U00209', 'OO6', 'O5', 'JL SEROJA IV', '108', 'V', '2019', 'H-8', 'YON-6', '1977', 'PEMBANGUNAN ', '49,98', '70', 'T. 39', 'B', 'ya', ''),
('D00209', 'U00210', 'OO6', 'O5', 'JL SEROJA IV', '126', 'IX', '2020', 'H-9', 'PASMAR-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00210', 'U00211', 'OO6', 'O5', 'JL SEROJA IV', '09', 'IX', '2020', 'H-11', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00211', 'U00212', 'OO6', 'O5', 'JL SEROJA IV', '63', 'IX', '2020', 'H-12', 'YONIF-6', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00212', 'U00213', 'OO6', 'O5', 'JL SEROJA IV', '338', 'IX', '2020', 'H-13', 'PASMAR-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00213', 'U00214', 'OO6', 'O5', 'JL SEROJA IV', '90', 'VIII', '2020', 'H-15', 'YON - 2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00214', 'U00215', 'OO6', 'O5', 'JL SEROJA IV', '102', 'VII', '2017', 'H-16', 'PASMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00215', 'U00216', 'OO6', 'O5', 'JL SEROJA IV', '134', 'IX', '2020', 'H-19', 'YON-6', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00216', 'U00217', 'OO6', 'O5', 'JL SEROJA IV', '78', 'IX', '2020', 'H-22', 'YONIF-6', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00217', 'U00218', 'OO6', 'O5', 'JL SEROJA IV', '103', 'IX', '2020', 'H-24', 'YON ZENI', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00218', 'U00219', 'OO7', 'O5', 'JL SEROJA IV', '37', 'II', '2009', 'I-2', 'YON-6', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00219', 'U00220', 'OO7', 'O5', 'JL SEROJA IV', '403', 'VIII', '2020', 'I-3', 'LANMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANG'),
('D00220', 'U00221', 'OO7', 'O5', 'JL SEROJA IV', 'O8', '', '2017', 'I-5', 'YONROKET-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00221', 'U00222', 'OO7', 'O5', 'JL SEROJA IV', '416', 'II', '2009', 'I-9', 'PASMAR II', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00222', 'U00223', 'OO7', 'O5', 'JL SEROJA IV', '98', 'V', '2018', 'I-23', 'BANPUR 2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00223', 'U00224', 'OO7', 'O5', 'JL BAKTI', '55', 'VIII', '2020', 'Y-5', 'KORMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00224', 'U00225', 'OO7', 'O5', 'JL BAKTI', '172', 'VII', '2017', 'Y-6', 'LANMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00225', 'U00226', 'OO7', 'O5', 'JL BAKTI', '235', 'I', '2019', 'Y-8', 'MABES TNI', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00226', 'U00227', 'OO7', 'O5', 'JL BAKTI', '101', 'II', '2013', 'Y-14', 'PASMAR II', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00227', 'U00228', 'OO7', 'O5', 'JL BAKTI', '15', 'IX', '2020', 'Y-15', 'KORMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00228', 'U00229', 'OO7', 'O5', 'JL BAKTI', '69', 'VII', '2020', 'Y-16', 'PASMAR II', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00229', 'U00230', 'OO7', 'O5', 'JL BAKTI', '34', 'X', '2020', 'Y-18', 'KORMAR', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00230', 'U00231', 'OO7', 'O5', 'JL BAKTI', '236', 'VII', '2020', 'Y-19', 'MABESAL', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00231', 'U00232', 'OO7', 'O5', 'JL BAKTI', '284', 'IV', '2012', 'Y-24', 'PASMAR II', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00232', 'U00233', 'OO8', 'O5', 'JL YOS SUDARSO', '347', 'VIII', '2020', 'K-9', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN'),
('D00233', 'U00234', 'OO8', 'O5', 'JL YOS SUDARSO', '211', 'VIII', '2019', 'K-11', 'YON-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00234', 'U00235', 'OO8', 'O5', 'JL YOS SUDARSO', '337', 'V', '2017', 'K-12', 'DENJAKA', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN JANGAN DI ACC -KARENA DI HUNI ORANG TUA'),
('D00235', 'U00236', 'OO8', 'O5', 'JL YOS SUDARSO', '29', 'IX', '2020', 'K-14', 'YON-4', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00236', 'U00237', 'OO8', 'O5', 'JL GANG MEMED', '370', 'VII', '2017', 'L-9', 'YON TAIFIB-2', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00237', 'U00238', 'OO8', 'O5', 'JL GANG MEMED', '211', 'VII', '2019', 'L-10', 'DENJAKA', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00238', 'U00239', 'OO8', 'O5', 'JL GANG MEMED', '367', 'VII', '2017', 'L-14', 'PASMAR II', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00239', 'U00240', 'OO8', 'O5', 'JL GANG MEMED', '369', 'XII', '2020', 'L-16', 'YONHOW-1', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', 'PERPANJANGAN'),
('D00240', 'U00241', 'OO8', 'O5', 'JL GANG MEMED', '356', 'VII', '2020', 'L-17', 'KORMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', 'PERPANJANGAN'),
('D00241', 'U00242', 'OO8', 'O5', 'JL GANG MEMED', '501', 'IV', '2012', 'L-18', 'BRIGIF-2', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00242', 'U00243', 'OO8', 'O5', 'JL GANG MEMED', '507', 'II', '2012', 'L-19', 'LANMAR', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00243', 'U00244', 'OO8', 'O5', 'JL GANG MEMED', '494', 'IX', '2013', 'L-20', 'BRIGIF-2', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00244', 'U00245', 'OO8', 'O5', 'JL GANG MEMED', '515', 'VIII', '2017', 'L-23', 'PASMAR II', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', ''),
('D00245', 'U00246', 'OO8', 'O5', 'JL GANG MEMED', '238', 'VIII', '2021', 'M-6', 'MEN ART-1', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', 'PERPANJANGAN'),
('D00246', 'U00247', 'OO8', 'O5', 'JL GANG MEMED', '372', 'VII', '2020', 'N-1', 'KIMA BRIG', '1977', 'PEMBANGUNAN ', '47,74', '70', 'T. 45', 'RR', 'ya', 'PERPANJANGAN'),
('D00247', 'U00248', 'OO4', 'O5', 'JL SEROJA V', '222', 'XI', '2011', 'O-3', 'PASMAR-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00248', 'U00249', 'OO4', 'O5', 'JL SEROJA V', '346', 'XII', '2021', 'O-4', 'BRIGIF-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'OVER VB'),
('D00249', 'U00250', 'OO4', 'O5', 'JL SEROJA V', '280', 'VI', '2020', 'O-5', 'YONHOW-1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00250', 'U00251', 'OO5', 'O5', 'JL SEROJA V', '132', 'IX', '2019', 'O-10', 'YONTANKFIB 1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00251', 'U00252', 'OO5', 'O5', 'JL SEROJA V', '277', 'VII', '2017', 'O-22', 'PASMAR II', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00252', 'U00253', 'OO5', 'O5', 'JL SEROJA VI', '291', 'V', '2018', 'P-17', 'BRIGIF 1', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', ''),
('D00253', 'U00254', 'OO4', 'O5', 'JL SEROJA VI', '273', 'VIII', '2021', 'Q-2', 'MABESAL', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN SIP'),
('D00254', 'U00255', 'OO4', 'O5', 'JL SEROJA VI', '171', 'I', '2021', 'Q-5', 'YON-2', '1972', 'PEMBANGUNAN ', '65,28', '90', 'TA. LAMA', 'B', 'ya', 'PERPANJANGAN SIP'),
('D00255', 'U00256', 'O14', 'O5', 'JL MEMED I', '467', 'VII', '2020', 'R-3', 'YON ROKET', '1977', 'PEMBANGUNAN ', '48,90', '70', 'T. 39', 'B', 'ya', 'PERPANJANGAN'),
('D00256', 'U00257', 'O14', 'O5', 'JL MEMED I', '459', 'IX', '2015', 'R-18', 'BANPUR', '1977', 'PEMBANGUNAN ', '48,90', '70', 'T. 39', 'B', 'ya', ''),
('D00257', 'U00258', 'O15', 'O5', 'JL SEB KOLAM RENANG', '564', '', '', 'S.05', 'YON 6 MAR', '2001', 'PEMBANGUNAN', '45,6', '78', 'T.36', 'B', 'ya', ''),
('D00258', 'U00259', 'O15', 'O5', 'JL SEB KOLAM RENANG', '567', '', '', 'S.08', 'MENBANPUR-2', '2001', 'PEMBANGUNAN', '45,6', '78', 'T.36', 'B', 'ya', ''),
('D00259', 'U00260', 'O15', 'O5', 'JL SEB KOLAM RENANG', '568', '', '', 'S.09', 'MENBANPUR-2', '2001', 'PEMBANGUNAN', '45,6', '78', 'T.36', 'B', 'ya', ''),
('D00260', 'U00261', 'O15', 'O5', 'JL SEB KOLAM RENANG', '574', '', '', 'S.15', 'YON 4 MAR', '2001', 'PEMBANGUNAN', '45,6', '78', 'T.36', 'B', 'ya', ''),
('D00261', 'U00262', 'O15', 'O5', 'JL SEB KOLAM RENANG', '579', '', '', 'S.20', 'YONTAIFIB-2', '2001', 'PEMBANGUNAN', '45,6', '78', 'T.36', 'B', 'ya', ''),
('D00262', 'U00263', 'OO1', 'O5', 'JL PAUS III', '71', '', '2008', 'B1', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00263', 'U00264', 'OO1', 'O5', 'JL PAUS III', '68', '', '2008', 'B2', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00264', 'U00265', 'OO1', 'O5', 'JL PAUS III', '74', '', '2008', 'B3', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00265', 'U00266', 'OO1', 'O5', 'JL PAUS III', '67', '', '2008', 'B4', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00266', 'U00267', 'OO1', 'O5', 'JL PAUS III', '13', '', '2007', 'B5', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T. 45', 'B', 'ya', ''),
('D00267', 'U00268', 'OO1', 'O5', 'JL PAUS II', '14', '', '2007', 'B6', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T. 45', 'B', 'ya', ''),
('D00268', 'U00269', 'OO1', 'O5', 'JL PAUS II', '15', '', '2007', 'B7', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T. 45', 'B', 'ya', ''),
('D00269', 'U00270', 'OO1', 'O5', 'JL PAUS III', '16', '', '2007', 'B8', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '70', '100', 'T. 36', 'B', 'ya', ''),
('D00270', 'U00271', 'OO1', 'O5', 'JL PAUS III', '72', '', '2008', 'C1', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00271', 'U00272', 'OO1', 'O5', 'JL PAUS III', '20', '', '2007', 'C4', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00272', 'U00273', 'OO1', 'O5', 'JL PAUS III', '21', '', '2007', 'C5', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00273', 'U00274', 'OO1', 'O5', 'JL PAUS III', '27', '', '2007', 'C11', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00274', 'U00275', 'OO1', 'O5', 'JL PAUS III', '28', '', '2007', 'C12', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00275', 'U00276', 'OO1', 'O5', 'JL PAUS III', '29', '', '2007', 'C13', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00276', 'U00277', 'OO1', 'O5', 'JL PAUS III', '33', '', '2007', 'C17', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00277', 'U00278', 'OO1', 'O5', 'JL PAUS III', '46', '', '2007', 'C30', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00278', 'U00279', 'OO1', 'O5', 'JL PAUS III', '41', '', '2007', 'C31', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00279', 'U00280', 'OO1', 'O5', 'JL PAUS III', '51', '', '2007', 'C35', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00280', 'U00281', 'OO1', 'O5', 'JL PAUS III', '52', '', '2007', 'C36', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00281', 'U00282', 'OO1', 'O5', 'JL PAUS III', '53', '', '2007', 'C37', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00282', 'U00283', 'OO1', 'O5', 'JL PAUS III', '54', '', '2007', 'C38', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00283', 'U00284', 'OO1', 'O5', 'JL PAUS III', '57', '', '2007', 'C41', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00284', 'U00285', 'OO1', 'O5', 'JL PAUS III', '60', '', '2007', 'C44', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00285', 'U00286', 'OO1', 'O5', 'JL PAUS III', '62', '', '2007', 'C46', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00286', 'U00287', 'OO1', 'O5', 'JL PAUS III', '64', '', '2007', 'C48', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00287', 'U00288', 'OO1', 'O5', 'JL PAUS III', '67', '', '2007', 'C51', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00288', 'U00289', 'OO1', 'O5', 'JL PAUS III', '68', '', '2007', 'C52', 'DEN JAKA', '1991', 'PEMBANGUNAN ', '47,74', '70', 'T. 36', 'B', 'ya', ''),
('D00289', 'U00290', 'O13', 'O5', 'JL PAUS', '04', 'II', '2015', 'C 58', 'DEN JAKA', '2014', 'PEMBANGUNAN ', '36', '49', 'T. 36', 'B', 'ya', ''),
('D00290', 'U00291', 'O13', 'O5', 'JL PAUS', '06', 'II', '2015', 'C60', 'DEN JAKA', '2014', 'PEMBANGUNAN ', '36', '49', 'T. 36', 'B', 'ya', ''),
('D00291', 'U00292', 'O13', 'O5', 'JL PAUS', '07', 'II', '2015', 'C61', 'DEN JAKA', '2014', 'PEMBANGUNAN ', '36', '49', 'T. 36', 'B', 'ya', ''),
('D00292', 'U00293', 'O11', 'O5', 'JL BELAKANG LAPBAK', '377', 'VII', '2017', 'BT-2', 'RSMC', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', ''),
('D00293', 'U00294', 'O11', 'O5', 'JL BELAKANG LAPBAK', '376', 'IX', '2013', 'BT-4', 'MENART-2', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', ''),
('D00294', 'U00295', 'O11', 'O5', 'JL BELAKANG LAPBAK', '379', 'VIII', '2017', 'BT-5', 'BRIGIF-2 MAR', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', ''),
('D00295', 'U00296', 'O11', 'O5', 'JL BELAKANG LAPBAK', '424', 'VII', '2020', 'BT-14', 'HOWITZER', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', 'PERPANJANGAN'),
('D00296', 'U00297', 'O11', 'O5', 'JL BELAKANG LAPBAK', '387', 'VII', '2017', 'BT-15', 'YONPOM-2', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', ''),
('D00297', 'U00298', 'O11', 'O5', 'JL BELAKANG LAPBAK', '393', 'VII', '2017', 'BT-16', 'BRIGIF-1', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', ''),
('D00298', 'U00299', 'O11', 'O5', 'JL BELAKANG LAPBAK', '397', 'VII', '2017', 'BT-20', 'MEN ART', '1977', 'PEMBANGUNAN ', '36', '60', 'BEDENG', 'RR', 'ya', '');

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
('K00005', 'RUMDIS SATUAN T. 36 ( SEBELAH KOLAM RENANG )', '-7.35209140', '112.64637060'),
('K00006', 'RUMDIS SATUAN T. 36 ( BEL. LAP. TEMBAK )', '-6.74371380', '107.18811035'),
('K00007', 'RUMDIS SATUAN DENJAKA', '-6.80167138', '107.23342896');

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
('K00008', 'Mar'),
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
('S00001', 'U00016', 'SIP1', './assets/file/9a66de94c40efd1e39fdac80ce1ca7f8.pdf');

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
('U00004', '14450/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00005', '16651/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00006', '15539/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00007', '17052/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00008', '18016/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00009', '17220/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00010', '17031/P', 'aGtq', 'RUMDISJAB DEN JAKA', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00011', '17755/P', 'aGtq', 'ARIS WIDIATMOKO', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00012', '11988/P', 'aGtq', 'AGUSTIAWARMAN', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00013', '16166/P', 'aGtq', 'FARICK', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00014', '12715/P', 'aGtq', 'BAMBANG SUDIANTO   ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00015', '18292/P', 'aGtq', 'DIAN MAYESTIKA', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00016', '10427/P', 'aGtq', 'BUDIARSO                       ', './assets/img/9ce299222c0e41195dda1cca2549f702.png', 'R2', 'P00010', 'K00008', 'K00002'),
('U00017', '16154/P', 'aGtq', 'M. ISARISNAWAN', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00018', '17231/P', 'aGtq', 'RISMANTO MANURUNG', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00019', '14492/P', 'aGtq', 'NIOKO BUDI LEGOWO', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00020', '11999/P', 'aGtq', 'DAVID CANDRA VIASCO', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00021', '12229/P', 'aGtq', 'ABD RAHMAN S.PD., M.SI', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00022', '12712/P', 'aGtq', 'ROMI HUTAGAUL          ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00023', '15550/P', 'aGtq', 'VEVIA YUDHI KURNIAWAN', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00024', '10149/P', 'aGtq', 'ELFIAN RAKAWIRA', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00025', '11880/P', 'aGtq', 'RAJA ERJAN H.S. GIRSANG ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00026', '12724/P', 'aGtq', 'IRFAN S.A. NASUTION', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00027', '14482/P', 'aGtq', 'BAMBANG DILLIANTO', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00028', '10787/P', 'aGtq', 'SUGIANTO, S.Sos', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00029', '13547/P', 'aGtq', 'DASRIL S.Ag                    ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00030', '8711/P/', 'aGtq', 'EDI SUTARDI                   ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00031', '9323/P', 'aGtq', 'SUHARTONO              ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00032', '16146/P', 'aGtq', 'FRENKI HARFIAN K', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00033', '9658/P', 'aGtq', 'SISWOTO                         ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00034', '14503/P', 'aGtq', 'SEBASTIAN SETYA LAKSANA', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00035', '19293/P', 'aGtq', 'HARYONO', '', 'R2', 'P00013', 'K00008', 'K00002'),
('U00036', '9647/P', 'aGtq', 'NOVARIN GUNAWAN                  ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00037', '11460/P', 'aGtq', 'FREDDY JH  PARDOSI', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00038', '12750/P', 'aGtq', 'ANDI SULTAN             ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00039', '12749/P', 'aGtq', 'AGUS TARUNA        ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00040', '11986/P', 'aGtq', 'MARSONO, S.A.P.', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00041', '11468/P', 'aGtq', 'AKHIYAR MEIDERI  ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00042', '12719/P', 'aGtq', 'ACHMAD SOCHFAN', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00043', '11991/P', 'aGtq', 'BAMBANG WAHYUONO  ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00044', '15021/P', 'aGtq', 'RIYADI', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00045', '15037/P', 'aGtq', 'DODIK EKO SUSANTO', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00046', '11983/P', 'aGtq', 'SUDIN KABAN               ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00047', '12240/P', 'aGtq', 'SUCI  PURNOMO         ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00048', '15038/P', 'aGtq', 'DONI IVAN', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00049', '15559/P', 'aGtq', 'KADAR BUDIYONO        ', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00050', '8554/P', 'aGtq', 'HARHAR SUCHARYANA ', '', 'R2', 'P00010', 'K00008', 'K00002'),
('U00051', '12003//P', 'aGtq', 'ENDUN SUGIARTO        ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00052', '20782/P', 'aGtq', 'PRAMARCHTA WIRATAMA', '', 'R2', 'P00014', 'K00008', 'K00002'),
('U00053', '13927/P', 'aGtq', 'SAMSON SITOHANG', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00054', '12972/P', 'aGtq', 'PRIO YUDONO,SH', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00055', '15058/P', 'aGtq', 'RUDI HARTONO              ', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00056', '15050/P', 'aGtq', 'FARIED SAFRI AHMAD', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00057', '13934/P', 'aGtq', 'AYUB WIBOWO', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00058', '18290/P', 'aGtq', 'DAVE M.H. LOMBOAN', '', 'R2', 'P00012', 'K00008', 'K00002'),
('U00059', '14457/P', 'aGtq', 'DIAN SURYANSYAH', '', 'R2', 'P00011', 'K00008', 'K00002'),
('U00060', '14485/P', 'aGtq', 'ANDY SURYANTO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00061', '18820/P', 'aGtq', 'TUNGGAL PUTRANTO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00062', '11478/P', 'aGtq', 'RUDY SUMANTRI', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00063', '18303/P', 'aGtq', 'ARISTOYUDA', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00064', '13925/P', 'aGtq', 'ARH  ANGGORO JATI     ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00065', '10788/P', 'aGtq', 'I. MADE SUKADA        ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00066', '14466/P', 'aGtq', 'I  STEPANUS  GINTING', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00067', '10796/P', 'aGtq', 'AHMAD FAJAR                 ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00068', '15569/P', 'aGtq', 'BUDI CAHYONO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00069', '10416/P', 'aGtq', 'AGUS DWI LAKSONO       ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00070', '9322/P', 'aGtq', 'I WAYAN ARI WIJAYA', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00071', '14461/P', 'aGtq', 'ENCEP WAHYU GUMELAR', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00072', '15047/P', 'aGtq', 'SAPTO PUTRO PAMUNGKAS', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00073', '10795/P', 'aGtq', 'UMAR FAROEK                  ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00074', '14474/P', 'aGtq', 'ARGO SETYONO', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00075', '10147/P', 'aGtq', 'NADIR', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00076', '20087/P', 'aGtq', 'JEFFRI FITRIANSYAH', '', 'R2', 'P00013', 'K00008', 'K00003'),
('U00077', '10794/P', 'aGtq', 'B. HADI SUSENO               ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00078', '13943/P', 'aGtq', 'SARAGIH', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00079', '12725/P', 'aGtq', '', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00080', '10145/P', 'aGtq', 'Y. RUDI SULISTIYANTO   ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00081', '17229/P', 'aGtq', 'AMIN SURYALAGA', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00082', '9333/P', 'aGtq', 'EDY SETIAWAN                  ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00083', '12721/P', 'aGtq', 'NANANG SAEFULLOH', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00084', '11977/P', 'aGtq', 'ADHI SUKO RAHARJO                   ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00085', '12970/P', 'aGtq', 'SIDDIQ, SE', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00086', '14446/P', 'aGtq', 'ISNA MUHSIN ABDILAH', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00087', '16123/P', 'aGtq', 'PARISON RENALDO SIREGAR', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00088', '17752/P', 'aGtq', 'IMRAN YUSUF', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00089', '14475/P', 'aGtq', 'DWI ARIYANTO WIBOWO', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00090', '12735/P', 'aGtq', 'ILI DASILI', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00091', '11479/P', 'aGtq', 'HENDRA SETIAWAN', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00092', '13431/P', 'aGtq', 'ZULKIPLY PANE', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00093', '20118/P', 'aGtq', 'YOGA HANAFIAH, S.S.T.Han', '', 'R2', 'P00013', 'K00008', 'K00003'),
('U00094', '10807/P', 'aGtq', 'AGUNG TRISNANTO       ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00095', '14488/P', 'aGtq', 'WISNU SYOGO', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00096', '10422/P', 'aGtq', 'ALI BAHAR SARAGIH', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00097', '10800/P', 'aGtq', 'JASMIN PURBA', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00098', '12238/P', 'aGtq', 'I.KETUT KARSIKA           ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00099', '14574/P', 'aGtq', 'ERIANDI ,Spd                                 ', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00100', '11993/P', 'aGtq', 'M. REZA SUUD                ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00101', '13941/P', 'aGtq', 'SUNARDI, SE, MM.', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00102', '9338/P', 'aGtq', 'ACHMAD SYAHRONI        ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00103', '16647/P', 'aGtq', 'HENCE KRISTIAN FS', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00104', '13952/P', 'aGtq', 'IMRON SAFEI ', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00105', '8977/P', 'aGtq', 'PRASODJO SUMARTO      ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00106', '14481/P', 'aGtq', 'IRWANTO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00107', '10143/P', 'aGtq', 'HERRY DJUHAERY                    ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00108', '10150/P', 'aGtq', 'ARIS MUDIAN                    ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00109', '11471/P', 'aGtq', 'GATOT MARDIYONO', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00110', '13955/P', 'aGtq', 'HERU GUNAWAN             ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00111', '13537/P', 'aGtq', 'AMRUL ANDRIANSYAH', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00112', '17250/P', 'aGtq', 'INDRA FAUZI UMAR', '', 'R2', 'P00013', 'K00008', 'K00003'),
('U00113', '8963/P', 'aGtq', 'M. SULCHAN', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00114', '15556/P', 'aGtq', 'IMAM GHAZALI', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00115', '16165/P', 'aGtq', 'SRI HERLAMBANG', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00116', '15563/P', 'aGtq', 'SAIFUDIN', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00117', '10805/P', 'aGtq', 'ARIS SETIAWAN', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00118', '11458/P', 'aGtq', ' SUWANDI, S.A.P.', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00119', '15554/P', 'aGtq', 'ERIS TRI YULIANTO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00120', '13532/P', 'aGtq', 'IMANDA ST', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00121', '15567/P', 'aGtq', 'KI AGUS FAUZAN  ASN', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00122', '9328/P', 'aGtq', 'CECEP RUHYAT', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00123', '15525/P', 'aGtq', 'SUMARLIN', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00124', '9330/P', 'aGtq', 'ABDUL RAHMAN              ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00125', '13949/P', 'aGtq', 'RUDIANTO, M.Tr.Hanla., M.M.', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00126', '10799/P', 'aGtq', 'PANGESTU W.                 ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00127', '12718/P', 'aGtq', 'IRDIANSYAH  NAWIR  A', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00128', '21490/P', 'aGtq', 'AGUNG PRIANTORO, S.T.Han', '', 'R2', 'P00014', 'K00008', 'K00003'),
('U00129', '11980/P', 'aGtq', 'WAHYUDI SAPUTRA', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00130', '12966/P', 'aGtq', 'EDY .HH. PANJAITAN .SH  ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00131', '12974/P', 'aGtq', 'EDIAL TASMAN', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00132', '10797/P', 'aGtq', 'ANDI RAHMAT M.', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00133', '20446/P', 'aGtq', 'ROBERTUS PANGGAH DANI', '', 'R2', 'P00013', 'K00008', 'K00003'),
('U00134', '18809/P', 'aGtq', 'DONNY ERFIANTO', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00135', '16131/P', 'aGtq', 'MOHAMMAD ABDILAH, M.Tr.Opsla', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00136', '16493/P', 'aGtq', 'PA.NELSON NGGADAS    ', '', 'R2', 'P00013', 'K00008', 'K00003'),
('U00137', '18285/P', 'aGtq', 'FEBRY HENDRO KAPOH', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00138', '14571/P', 'aGtq', 'PATRIOT TUNGGUL A, S.T.', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00139', '13972/P', 'aGtq', 'WISNU WICAKSONO ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00140', '15034/P', 'aGtq', 'BAMBANG HERAWAN', '', 'R2', 'P00012', 'K00008', 'K00003'),
('U00141', '13406/P', 'aGtq', 'KRISTIYONO                         ', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00142', '12005/P', 'aGtq', 'ARINTO BENY SARANA                           ', '', 'R2', 'P00010', 'K00008', 'K00003'),
('U00143', '15024/P', 'aGtq', 'TEGUH PAMUJI', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00144', '15043/P', 'aGtq', 'WARTONO', '', 'R2', 'P00011', 'K00008', 'K00003'),
('U00145', '60583', 'aGtq', 'SURATMAN                        ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00146', '115101', 'aGtq', 'RICARDO SIRAIT', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00147', '19433/P', 'aGtq', 'NASIKUN', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00148', '16996/P', 'aGtq', 'SLAMET RIYADI', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00149', '91065', 'aGtq', 'SUNOKO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00150', '75825', 'aGtq', 'HENDI PRAMADI', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00151', '98694', 'aGtq', 'BENHUR SINURAT', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00152', '91823', 'aGtq', 'TEDY EFENDY                ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00153', '65548', 'aGtq', 'BAMBANG SUPARITNO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00154', '100687', 'aGtq', 'USNAJI', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00155', '90226', 'aGtq', 'ABDUL CHOSIM', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00156', '102816', 'aGtq', 'M.YULIAR KRISTANTO', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00157', '106725', 'aGtq', 'WAHYU TRI HARMOKO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00158', '16511/P', 'aGtq', 'DEDE RODIANA', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00159', '16481/P', 'aGtq', 'KUNTOYONO', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00160', '17494/P', 'aGtq', 'DADIYO', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00161', '98641', 'aGtq', 'PUJI PURNOMO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00162', '118497', 'aGtq', 'HAMDAN EFENDI HARAHAP', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00163', '88888', 'aGtq', 'DEWA PUTU  A.', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00164', '10009/P', 'aGtq', 'IBNU TRI ATMAJI', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00165', '108227', 'aGtq', 'DWI PRIAMBODO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00166', '94302', 'aGtq', 'AGUS NUGROHO            ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00167', '119475', 'aGtq', 'ELLI SUSANTO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00168', '75845', 'aGtq', 'RAHMAT', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00169', '66728', 'aGtq', 'SLAWI                              ', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00170', '104887', 'aGtq', 'SAPRONI', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00171', '80110', 'aGtq', 'HELMI HERMANSYAH', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00172', '12145/P', 'aGtq', 'AGUS SUPRIYADI', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00173', '15886/P', 'aGtq', 'CATUR RUBIATIN                         ', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00174', '86935', 'aGtq', 'JOKO SUSILO                     ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00175', '71663', 'aGtq', 'DWI ARIANTO                    ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00176', '14257/P', 'aGtq', 'J.B SONDAKH ', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00177', '17531/P', 'aGtq', 'HENDI ROCHENDI                    ', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00178', '76500', 'aGtq', 'TONI WINARTO                   ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00179', '120295', 'aGtq', 'HERU IRWAN', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00180', '65252', 'aGtq', 'ARTONO                             ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00181', '78591', 'aGtq', 'SAMURI', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00182', '18551/P', 'aGtq', 'YAHYA RUDI SIREGAR    ', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00183', '84806', 'aGtq', 'SUNARNA                         ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00184', '112706', 'aGtq', 'ARIF WICAKSONO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00185', '66709', 'aGtq', 'WARSONO                          ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00186', '89515', 'aGtq', 'SUJATMIKO', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00187', '112680', 'aGtq', 'HERLI SANTOSO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00188', '100619', 'aGtq', 'HADI SUYITNO', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00189', '69943', 'aGtq', 'SULISTIYONO                      ', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00190', '18052/P', 'aGtq', 'RUDIYANTO                          ', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00191', '19095/P', 'aGtq', 'EKO HADI SAPUTRO            ', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00192', '17544/P', 'aGtq', 'ARISTAKUS ANDRIANUS UNU                      ', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00193', '76610', 'aGtq', 'SURATNO                             ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00194', '93419', 'aGtq', 'JONI L.S', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00195', '108216', 'aGtq', 'AGUS SETIAWAN', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00196', '102787', 'aGtq', 'SUHAEDI KURDIYANDI', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00197', '73288', 'aGtq', 'DIRMAN                             ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00198', '84092', 'aGtq', 'SAFRIZAL, SE.', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00199', '100692', 'aGtq', 'ZAINUL ARIFIN', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00200', '102783', 'aGtq', 'SETIYA', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00201', '106761', 'aGtq', 'ACHMAD KAMALUDIN', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00202', '86908', 'aGtq', 'SUPENO                           ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00203', '100622', 'aGtq', 'HAIRIL ANWAR', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00204', '77203', 'aGtq', 'EDY SUTRISNO', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00205', '91207', 'aGtq', 'HASIHOLAN NAIPOSPOS', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00206', '112712', 'aGtq', 'NANANG SETIAWAN', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00207', '76639', 'aGtq', 'IWAN BHARATA              ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00208', '115102', 'aGtq', 'ARGO SENO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00209', '89402', 'aGtq', 'DIDI MULYADI', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00210', '86955', 'aGtq', 'M.ILYAS                          ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00211', '64670', 'aGtq', 'AGUS SETIAWAN                           ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00212', '72764', 'aGtq', 'KAYUBI                            ', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00213', '76567', 'aGtq', 'YOSEP NANANG.W         ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00214', '19060/P', 'aGtq', 'WAHYUDI', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00215', '104830', 'aGtq', 'AMAD FAUZI', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00216', '20282/P', 'aGtq', 'WELLDY NASUTION', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00217', '94337', 'aGtq', 'SUSANTO', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00218', '84094', 'aGtq', 'HASKANI', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00219', '89424', 'aGtq', 'NELSON MARBUN        ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00220', '63472', 'aGtq', 'ISMAIL                           ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00221', '115090', 'aGtq', 'BUKRODI', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00222', '16497/P', 'aGtq', 'MUGNI ALEX                   ', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00223', '104928', 'aGtq', 'ABIMAYU RS.', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00224', '104838', 'aGtq', 'BAMBANG SUSILO', '', 'R2', 'P00018', 'K00008', 'K00004'),
('U00225', '76677', 'aGtq', 'EDDY HARJIANTO', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00226', '104871', 'aGtq', 'NONO DARSONO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00227', ' ', 'aGtq', 'FAJAR AGUNG NUGROHO', '', 'R2', 'P00019', 'K00027', 'K00004'),
('U00228', '118520', 'aGtq', 'RAMA WIJAYA', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00229', '81275', 'aGtq', 'RASIDIN', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00230', '108212', 'aGtq', 'EKO MUDO PRAKOSO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00231', '77201', 'aGtq', 'ABDUL HAKIM                                  ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00232', '76577', 'aGtq', 'HERI SUGIRI                                  ', '', 'R2', 'P00017', 'K00008', 'K00004'),
('U00233', '83309', 'aGtq', 'JULI ARI HARTONO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00234', '82603', 'aGtq', 'FARID KURNIAWAN                              ', '', 'R2', 'P00016', 'K00008', 'K00004'),
('U00235', '18800/P', 'aGtq', 'DONNY PRASETYO', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00236', '120265', 'aGtq', 'DARYONO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00237', '19840/P', 'aGtq', 'JEMI LEONARD', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00238', '93756', 'aGtq', 'PRAMUJOKO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00239', '15891/P', 'aGtq', 'MAHFUDIN                                     ', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00240', '22209/P', 'aGtq', 'MOHAMAD FAKHRURI', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00241', '16486/P', 'aGtq', 'SUKIRNO', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00242', '15881/P', 'aGtq', 'DA HERRY SUDARYANTO', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00243', '65634', 'aGtq', 'I. KETUT KARTIKA                             ', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00244', '106676', 'aGtq', 'WANTO', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00245', '15336/P', 'aGtq', 'AGUS MULYANA', '', 'R2', 'P00013', 'K00008', 'K00004'),
('U00246', '16985/P', 'aGtq', 'KUSNADI                                      ', '', 'R2', 'P00012', 'K00008', 'K00004'),
('U00247', '83405', 'aGtq', 'ILYAS                                        ', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00248', '98613', 'aGtq', 'P. WIRA AGUNG', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00249', '121871', 'aGtq', 'IRWAN SUKMANA', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00250', '21344/P', 'aGtq', 'DAMAN HURI', '', 'R2', 'P00014', 'K00008', 'K00004'),
('U00251', '118561', 'aGtq', 'RENDY ARIF SETIAWAN', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00252', '104884', 'aGtq', 'HERISON', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00253', '79220', 'aGtq', 'EMAN SUHERMAN', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00254', '81382', 'aGtq', 'WAHYUDI HARJANA', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00255', '81863', 'aGtq', 'TRI INDARWANTO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00256', '78288', 'aGtq', 'SUYOTO', '', 'R2', 'P00019', 'K00008', 'K00004'),
('U00257', '81126', 'aGtq', 'SAYUTI', '', 'R2', 'P00020', 'K00008', 'K00004'),
('U00258', '71031', 'aGtq', 'DIDIT ISWANTO', '', 'R2', 'P00018', 'K00008', 'K00005'),
('U00259', '82605', 'aGtq', 'DENY', '', 'R2', 'P00020', 'K00008', 'K00005'),
('U00260', '74329', 'aGtq', 'DIDI RIYADI', '', 'R2', 'P00019', 'K00008', 'K00005'),
('U00261', '80148', 'aGtq', 'ENJANG', '', 'R2', 'P00018', 'K00008', 'K00005'),
('U00262', '101969', 'aGtq', 'WINARSO', '', 'R2', 'P00020', 'K00008', 'K00005'),
('U00263', '16880/P', 'aGtq', 'TAQWIM', '', 'R2', 'P00013', 'K00002', 'K00007'),
('U00264', '17481/P', 'aGtq', 'SURADI', '', 'R2', 'P00013', 'K00008', 'K00007'),
('U00265', '17189/P', 'aGtq', 'WAHYU PRIHANTORO', '', 'R2', 'P00013', 'K00003', 'K00007'),
('U00266', '16936//P', 'aGtq', 'NUR HAMSAH', '', 'R2', 'P00013', 'K00003', 'K00007'),
('U00267', '16130/P', 'aGtq', 'R. BUTAR BUTAR', '', 'R2', 'P00012', 'K00008', 'K00007'),
('U00268', '19665/P', 'aGtq', 'INDRA MAULANA', '', 'R2', 'P00014', 'K00008', 'K00007'),
('U00269', '19091/P', 'aGtq', 'PARSO', '', 'R2', 'P00014', 'K00008', 'K00007'),
('U00270', '17442/P', 'aGtq', 'SUDIANTO', '', 'R2', 'P00013', 'K00003', 'K00007'),
('U00271', '20453/P', 'aGtq', 'dr. BENNY R.P.', '', 'R2', 'P00014', 'K00006', 'K00007'),
('U00272', '56361', 'aGtq', 'A. JAYA', '', 'R2', 'P00017', 'K00008', 'K00007'),
('U00273', '75257', 'aGtq', 'DADANG S.', '', 'R2', 'P00020', 'K00018', 'K00007'),
('U00274', '69939', 'aGtq', 'HARYONO', '', 'R2', 'P00018', 'K00008', 'K00007'),
('U00275', '18286/P', 'aGtq', 'SURYA AFANDI N.', '', 'R2', 'P00013', 'K00008', 'K00007'),
('U00276', '60577', 'aGtq', 'M. DIMYATI', '', 'R2', 'P00017', 'K00008', 'K00007'),
('U00277', '19864/P', 'aGtq', 'INDRA P', '', 'R2', 'P00014', 'K00008', 'K00007'),
('U00278', '75869', 'aGtq', 'BUSRO', '', 'R2', 'P00019', 'K00008', 'K00007'),
('U00279', '74349', 'aGtq', 'PASKALIS HK', '', 'R2', 'P00020', 'K00010', 'K00007'),
('U00280', '75552', 'aGtq', 'MUNANDAR', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00281', '75883', 'aGtq', 'MUALIM IRSANI', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00282', '66303', 'aGtq', 'HARI K', '', 'R2', 'P00017', 'K00008', 'K00007'),
('U00283', '75868', 'aGtq', 'SUNARTO', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00284', '19874/P', 'aGtq', 'A. A PUTU P', '', 'R2', 'P00014', 'K00008', 'K00007'),
('U00285', '72551', 'aGtq', 'RIYANTO PANE', '', 'R2', 'P00019', 'K00008', 'K00007'),
('U00286', '75824', 'aGtq', 'ASEP MULYADI', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00287', '100579', 'aGtq', 'ANDI SUBAGYO', '', 'R2', 'P00019', 'K00008', 'K00007'),
('U00288', '100580', 'aGtq', 'ANJAR JUR S.', '', 'R2', 'P00019', 'K00008', 'K00007'),
('U00289', '82832', 'aGtq', 'TARHAN', '', 'R2', 'P00020', 'K00010', 'K00007'),
('U00290', '108183', 'aGtq', 'ILYAS HASAN', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00291', '110290', 'aGtq', 'BENNY MUSES S.', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00292', '110314', 'aGtq', 'RAHMAD', '', 'R2', 'P00020', 'K00008', 'K00007'),
('U00293', '17514/P', 'aGtq', 'IRWAN SUNANDAR', '', 'R2', 'P00013', 'K00008', 'K00006'),
('U00294', '66142', 'aGtq', 'UDI  MASHUDI', '', 'R2', 'P00019', 'K00008', 'K00006'),
('U00295', '98673', 'aGtq', 'RUSWANTO', '', 'R2', 'P00019', 'K00008', 'K00006'),
('U00296', '19873/P', 'aGtq', 'SUDIHATI', '', 'R2', 'P00014', 'K00008', 'K00006'),
('U00297', '19872/P', 'aGtq', 'WIDODO', '', 'R2', 'P00014', 'K00008', 'K00006'),
('U00298', '69108', 'aGtq', 'ROSADI', '', 'R2', 'P00016', 'K00008', 'K00006'),
('U00299', '71014', 'aGtq', 'WIJIYANTO', '', 'R2', 'P00018', 'K00008', 'K00006');

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
