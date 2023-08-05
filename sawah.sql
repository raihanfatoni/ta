-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 05:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sawah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`) VALUES
(10001, 'admin@gmail.com', '$2y$10$YfETYRa0XP1DBBsZ0FMhCO1Y.WBxwUurcdY59Ly9Xh/0fYTgXi2X.'),
(11001, 'admin1@gmail.com', '$2y$10$fFVpcq2wp67htP.Q1iVcDu/V5DKSiNxsdJoDpFQdyRi6hA0ELRMTS'),
(12001, 'admin2@gmail.com', '$2y$10$3Y95GdFLaje808VdOq.XbevoWzJLu2li44S.jpKL1Bw6//roGDIWy'),
(13001, 'admin3@gmail.com', '$2y$10$.Mek5GHU6buPexjn4Wktq.j/gFZodmly3ZMllH3ygnIpzRL1X5Osm'),
(13003, 'rajarisqullah@gmail.com', '$2y$10$h50RpcyPd/gQwfEveLf03.3ssJR/.jvzwp4NiCBGxlrqNacA5RlZK'),
(13004, 'raihanfatoni23@gmail.com', '$2y$10$sVJSUCgCpn.I2avo1qVctuZxmcA0Z3.ctscJ9Yl3.fbXHHni.cPFe');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_master_data` int(11) UNSIGNED NOT NULL,
  `kode_wilayah` varchar(7) NOT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `id_master_data`, `kode_wilayah`, `nilai`) VALUES
(1, 3, '11', 5870),
(2, 3, '12', 15311),
(3, 3, '13', 5758),
(4, 3, '14', 7899),
(5, 3, '15', 3927),
(6, 3, '16', 9000),
(7, 3, '17', 2151),
(8, 3, '18', 8825),
(9, 3, '19', 1658),
(10, 3, '21', 2502),
(11, 3, '31', 11034),
(12, 3, '32', 52786),
(13, 3, '33', 35959),
(14, 3, '34', 4065),
(15, 3, '35', 40646),
(16, 3, '36', 14249),
(17, 3, '51', 4586),
(18, 3, '52', 5376),
(19, 3, '53', 5971),
(20, 3, '61', 5433),
(21, 3, '62', 3031),
(22, 3, '63', 4578),
(23, 3, '64', 5041),
(24, 3, '65', 0),
(25, 3, '71', 2624),
(26, 3, '72', 3300),
(27, 3, '73', 9266),
(28, 3, '74', 3003),
(29, 3, '75', 1300),
(30, 3, '76', 1528),
(31, 3, '81', 1973),
(32, 3, '82', 1391),
(33, 3, '91', 1092),
(34, 3, '94', 3702),
(35, 4, '11', 819),
(36, 4, '12', 1282),
(37, 4, '13', 348),
(38, 4, '14', 491),
(39, 4, '15', 274),
(40, 4, '16', 1074),
(41, 4, '17', 302),
(42, 4, '18', 1064),
(43, 4, '19', 68),
(44, 4, '21', 128),
(45, 4, '31', 366),
(46, 4, '32', 3399),
(47, 4, '33', 3743),
(48, 4, '34', 448),
(49, 4, '35', 4112),
(50, 4, '36', 654),
(51, 4, '51', 164),
(52, 4, '52', 736),
(53, 4, '53', 1146),
(54, 4, '61', 378),
(55, 4, '62', 135),
(56, 4, '63', 192),
(57, 4, '64', 220),
(58, 4, '65', 49),
(59, 4, '71', 192),
(60, 4, '72', 410),
(61, 4, '73', 768),
(62, 4, '74', 303),
(63, 4, '75', 186),
(64, 4, '76', 151),
(65, 4, '81', 318),
(66, 4, '82', 85),
(67, 4, '91', 212),
(68, 4, '94', 926);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `luas` int(30) DEFAULT NULL,
  `jumlahtanah` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama`, `luas`, `jumlahtanah`) VALUES
(1001, 'Conggeang', 10697, 2),
(1002, 'Sumedang Utara', 3040, 8),
(1003, 'Sumedang Selatan', 9251, 21);

-- --------------------------------------------------------

--
-- Table structure for table `kode_wilayah`
--

CREATE TABLE `kode_wilayah` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_wilayah` varchar(7) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kode_wilayah`
--

INSERT INTO `kode_wilayah` (`id`, `kode_wilayah`, `nama_wilayah`) VALUES
(1, '11', 'ACEH'),
(2, '12', 'SUMATERA UTARA'),
(3, '13', 'SUMATERA BARAT'),
(4, '14', 'RIAU'),
(5, '15', 'JAMBI'),
(6, '16', 'SUMATERA SELATAN'),
(7, '17', 'BENGKULU'),
(8, '18', 'LAMPUNG'),
(9, '19', 'KEPULAUAN BANGKA BELITUNG'),
(10, '21', 'KEPULAUAN RIAU'),
(11, '31', 'DKI JAKARTA'),
(12, '32', 'JAWA BARAT'),
(13, '33', 'JAWA TENGAH'),
(14, '34', 'DI YOGYAKARTA'),
(15, '35', 'JAWA TIMUR'),
(16, '36', 'BANTEN'),
(17, '51', 'BALI'),
(18, '52', 'NUSA TENGGARA BARAT'),
(19, '53', 'NUSA TENGGARA TIMUR'),
(20, '61', 'KALIMANTAN BARAT'),
(21, '62', 'KALIMANTAN TENGAH'),
(22, '63', 'KALIMANTAN SELATAN'),
(23, '64', 'KALIMANTAN TIMUR'),
(24, '65', 'KALIMANTAN UTARA'),
(25, '71', 'SULAWESI UTARA'),
(26, '72', 'SULAWESI TENGAH'),
(27, '73', 'SULAWESI SELATAN'),
(28, '74', 'SULAWESI TENGGARA'),
(29, '75', 'GORONTALO'),
(30, '76', 'SULAWESI BARAT'),
(31, '81', 'MALUKU'),
(32, '82', 'MALUKU UTARA'),
(33, '91', 'PAPUA BARAT'),
(34, '94', 'PAPUA');

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE `master_data` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `nama`) VALUES
(1, 'Jumlah Penduduk Provinsi Indonesia, 2020'),
(2, 'Jumlah Penduduk Provinsi Indonesia, 2020'),
(3, 'Jumlah Penduduk Provinsi Indonesia, 2020'),
(4, 'Jumlah Penduduk Miskin, 2019');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-02-05-075106', 'App\\Database\\Migrations\\MasterData', 'default', 'App', 1675583543, 1),
(2, '2023-02-05-075115', 'App\\Database\\Migrations\\KodeWilayah', 'default', 'App', 1675583543, 1),
(3, '2023-02-05-075129', 'App\\Database\\Migrations\\Data', 'default', 'App', 1675583543, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nadzir`
--

CREATE TABLE `nadzir` (
  `NadzirWakaf` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tupoksi` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `sk` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nadzir`
--

INSERT INTO `nadzir` (`NadzirWakaf`, `nama`, `jabatan`, `tupoksi`, `alamat`, `sk`, `status`) VALUES
(2001, 'Ir. H. Eka Setiawan', 'Plt. Bupati Sumedang', 'Ketua Nadzir', 'Sumedang', '004/BWI/NZ/2015', 'Asing'),
(2002, 'H. Hasen, S.Ag.', 'Kep. Kantor Kementerian Agama Kab. Sumedang', 'Sekretaris', 'Sumedang', '004/BWI/NZ/2016', 'Asing'),
(2003, 'Drs. H. Adam Malik', 'Ketua MUI Kab. Sumedang', 'Bendahara', 'Sumedang', '004/BWI/NZ/2017', 'Asing'),
(2004, 'Aep Suwito, S.Ag.', 'Kep. KUA Kec. Sumedang selatan', 'Anggota', 'Sumedang', '004/BWI/NZ/2018', 'Asing'),
(2005, 'Drs. H. Ahyar', 'Kep. KUA Kec. Sumedang Utara', 'Anggota', 'Sumedang', '004/BWI/NZ/2019', 'Asing'),
(2006, 'Drs. Tatang Buyamin', 'Kepala KUA Kec. Buah Dua', 'Anggota', 'Sumedang', '004/BWI/NZ/2020', 'Asing'),
(2007, 'Rd. I. Lukman Soemadisoeria', 'Pensiunan ', 'Anggota', 'Sumedang', '004/BWI/NZ/2021', 'Keluarga'),
(2008, 'Rd. Sapei Prawiradilaga', 'Pensiunan ', 'Anggota', 'Sumedang', '004/BWI/NZ/2022', 'Keluarga'),
(2009, 'Rd. Yana Suryaman', 'Pensiunan ', 'Anggota', 'Sumedang', '004/BWI/NZ/2023', 'Keluarga');

-- --------------------------------------------------------

--
-- Table structure for table `tanah`
--

CREATE TABLE `tanah` (
  `No` int(10) NOT NULL,
  `Lokasi` varchar(100) NOT NULL,
  `Tipe` varchar(30) DEFAULT NULL,
  `LuasDahulu` varchar(25) NOT NULL,
  `LuasSekarang` varchar(25) NOT NULL,
  `LuasDalamBau` varchar(25) NOT NULL,
  `LuasDalamTumbak` varchar(25) NOT NULL,
  `LuasDalamMeterPersegi` varchar(25) NOT NULL,
  `NadzirWakaf` int(11) DEFAULT NULL,
  `KoordinatLokasi` varchar(25) NOT NULL,
  `polygon` text DEFAULT NULL,
  `marker` text DEFAULT NULL,
  `googleearth` text DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanah`
--

INSERT INTO `tanah` (`No`, `Lokasi`, `Tipe`, `LuasDahulu`, `LuasSekarang`, `LuasDalamBau`, `LuasDalamTumbak`, `LuasDalamMeterPersegi`, `NadzirWakaf`, `KoordinatLokasi`, `polygon`, `marker`, `googleearth`, `id_kecamatan`) VALUES
(231, 'Sawahlega', 'Sawah', '227332', '71631', '32', '23', '71631', 2001, 'Berubah', NULL, '{\"lat\":-6.9016370754788126,\"lng\":107.86456881113568}', 'https://earth.google.com/web/search/-6.9016812,+107.8648377/@-6.9016812,107.8648377,966.13864266a,1047.97526667d,35y,0h,45t,0r/data=ClsaMRIrGRGsBVFSmxvAIUN2OYBZ91pAKhctNi45MDE2ODEyLCAxMDcuODY0ODM3NxgCIAEiJgokCfSG1zC3mhvAEbGv9iUcthvAGfFNyjh0-FpAIQhxNMm99VpAKAI', 1003),
(232, 'Sawahlega', 'Sawah', '9800', '107831', '1', '200', '107831', 2001, 'Berubah', NULL, '{\"lat\":-6.903149533946952,\"lng\":107.86580261734613}', 'https://earth.google.com/web/search/-6.9016812,+107.8648377/@-6.9016812,107.8648377,966.13864266a,1047.97526667d,35y,0h,45t,0r/data=ClsaMRIrGRGsBVFSmxvAIUN2OYBZ91pAKhctNi45MDE2ODEyLCAxMDcuODY0ODM3NxgCIAEiJgokCfSG1zC3mhvAEbGv9iUcthvAGfFNyjh0-FpAIQhxNMm99VpAKAI', 1003),
(233, 'Tjimuntjang', 'Sawah', '24598', '11600', '3', '257', '11600', 2001, 'Berubah', NULL, '{\"lat\":-6.9094134,\"lng\":107.834653}', 'https://earth.google.com/web/search/-6.9094134,107.834653/@-6.9094134,107.834653,863.54321966a,1047.95609815d,35y,0h,45t,0r/data=ClkaLxIpGTotLkQ9oxvAIYegavRq9VpAKhUtNi45MDk0MTM0LDEwNy44MzQ2NTMYAiABIiYKJAkvpolNNLEbwBFmTbZvZ7gbwBnVHlJ5tvJaQCE7Xw3JvvFaQCgC', 1003),
(234, 'Tjimuntjang', 'Sawah', '42966', '30400', '6', '69', '30.400', 2002, 'Berubah', NULL, '{\"lat\":-6.910067341594728,\"lng\":107.82806349378421}', 'https://earth.google.com/web/search/-6.9094134,107.834653/@-6.9094134,107.834653,863.54321966a,1047.95609815d,35y,0h,45t,0r/data=ClkaLxIpGTotLkQ9oxvAIYegavRq9VpAKhUtNi45MDk0MTM0LDEwNy44MzQ2NTMYAiABIiYKJAkvpolNNLEbwBFmTbZvZ7gbwBnVHlJ5tvJaQCE7Xw3JvvFaQCgC', 1003),
(235, 'Batoeasahan', 'Sawah', '13258', '13450', '1', '447', '13450', 2002, 'Berubah', NULL, '{\"lat\":-6.915520619980064,\"lng\":107.83767719037698}', 'https://earth.google.com/web/search/-6.9094134,107.834653/@-6.9094134,107.834653,863.54321966a,1047.95609815d,35y,0h,45t,0r/data=ClkaLxIpGTotLkQ9oxvAIYegavRq9VpAKhUtNi45MDk0MTM0LDEwNy44MzQ2NTMYAiABIiYKJAkvpolNNLEbwBFmTbZvZ7gbwBnVHlJ5tvJaQCE7Xw3JvvFaQCgC', 1003),
(236, 'Batoeasahan', 'Sawah', '52850', '22040', '7', '275', '22040', 2002, 'Berubah', NULL, '{\"lat\":-6.914498140942797,\"lng\":107.83321371194045}', 'https://earth.google.com/web/search/-6.9094134,107.834653/@-6.9094134,107.834653,863.54321966a,1047.95609815d,35y,0h,45t,0r/data=ClkaLxIpGTotLkQ9oxvAIYegavRq9VpAKhUtNi45MDk0MTM0LDEwNy44MzQ2NTMYAiABIiYKJAkvpolNNLEbwBFmTbZvZ7gbwBnVHlJ5tvJaQCE7Xw3JvvFaQCgC', 1003),
(237, 'Tjiemok', 'Sawah', '5684', '5600', '-', '406', '5600', 2003, 'Berubah', NULL, '{\"lat\":-6.911260257484575,\"lng\":107.8366471750093}', 'https://earth.google.com/web/search/-6.9094134,107.834653/@-6.9094134,107.834653,863.54321966a,1047.95609815d,35y,0h,45t,0r/data=ClkaLxIpGTotLkQ9oxvAIYegavRq9VpAKhUtNi45MDk0MTM0LDEwNy44MzQ2NTMYAiABIiYKJAkvpolNNLEbwBFmTbZvZ7gbwBnVHlJ5tvJaQCE7Xw3JvvFaQCgC', 1003),
(238, 'Sawahlega', 'Sawah', '102242', '92900', '14', '303', '92900', 2003, 'Berubah', NULL, '{\"lat\":-6.8755889,\"lng\":107.9063355}', 'https://earth.google.com/web/search/-6.8755889,107.9063355/@-6.8755889,107.9063355,622.75548892a,1048.03979366d,35y,0h,45t,0r/data=CloaMBIqGWP2aGCagBvAIQvtnGYB-lpAKhYtNi44NzU1ODg5LDEwNy45MDYzMzU1GAIgASImCiQJMr02O7KFG8ARd2iTqteoG8AZ3cb8fUP3WkAh-v4lBOj0WkAoAg', 1003),
(239, 'Tenjonegara', 'Sawah', '10416', '11417', '1', '244', '11417', 2003, 'Berubah', NULL, '{\"lat\":-6.880073398595281,\"lng\":107.9022215854756}', 'https://earth.google.com/web/search/-6.8755889,107.9063355/@-6.8755889,107.9063355,622.75548892a,1048.03979366d,35y,0h,45t,0r/data=CloaMBIqGWP2aGCagBvAIQvtnGYB-lpAKhYtNi44NzU1ODg5LDEwNy45MDYzMzU1GAIgASImCiQJMr02O7KFG8ARd2iTqteoG8AZ3cb8fUP3WkAh-v4lBOj0WkAoAg', 1003),
(240, 'Karedok', 'Sawah', '35070', '38300', '5', '0.05', '38300', 2004, 'Berubah', NULL, '{\"lat\":-6.8679511,\"lng\":107.9239302}', 'https://earth.google.com/web/search/-6.8679511,107.9239302/@-6.8679511,107.9239302,499.31958232a,1048.05863628d,35y,0h,45t,0r/data=CloaMBIqGeEbVCzIeBvAIVoyIqwh-1pAKhYtNi44Njc5NTExLDEwNy45MjM5MzAyGAIgASImCiQJrKCO-wJoG8AR4sA5okaHG8AZiqo8hGv6WkAhntr2HHX4WkAoAg', 1003),
(241, 'Tjimenjan', 'Sawah', '12250', '20200', '1', '375', '20200', 2004, 'Berubah', NULL, '{\"lat\":-6.867802668770593,\"lng\":107.93106126207518}', 'https://earth.google.com/web/search/-6.8679511,107.9239302/@-6.8679511,107.9239302,499.31958232a,1048.05863628d,35y,0h,45t,0r/data=CloaMBIqGeEbVCzIeBvAIVoyIqwh-1pAKhYtNi44Njc5NTExLDEwNy45MjM5MzAyGAIgASImCiQJrKCO-wJoG8AR4sA5okaHG8AZiqo8hGv6WkAhntr2HHX4WkAoAg', 1003),
(242, 'Tenjolaja', 'Sawah', '20482', '-', '2', '463', '-', 2004, 'Berubah', NULL, '{\"lat\":-6.869166115785437,\"lng\":107.91732740979984}', 'https://earth.google.com/web/search/-6.8679511,107.9239302/@-6.8679511,107.9239302,499.31958232a,1048.05863628d,35y,0h,45t,0r/data=CloaMBIqGeEbVCzIeBvAIVoyIqwh-1pAKhYtNi44Njc5NTExLDEwNy45MjM5MzAyGAIgASImCiQJrKCO-wJoG8AR4sA5okaHG8AZiqo8hGv6WkAhntr2HHX4WkAoAg', 1003),
(243, 'Tjimenjan', 'Sawah', '420', '443', '-', '0.3', '443', 2004, 'Berubah', NULL, '{\"lat\":-6.8784568,\"lng\":107.9292034}', 'https://earth.google.com/web/search/-6.8784568,107.9292034/@-6.8784568,107.9292034,630.75245792a,1048.03271313d,35y,0h,45t,0r/data=CloaMBIqGZXL6y2KgxvAIT-ViRF4-1pAKhYtNi44Nzg0NTY4LDEwNy45MjkyMDM0GAIgASImCiQJTdcNuqdpG8AReE-z66h5G8AZuVafpCH8WkAh9Q2lsyH6WkAoAg', 1003),
(244, 'Tenjolaja', 'Sawah', '224', '565', '-', '0.16', '565', 2005, 'Berubah', NULL, '{\"lat\":-6.877517051034374,\"lng\":107.93003088163638}', 'https://earth.google.com/web/search/-6.8784568,107.9292034/@-6.8784568,107.9292034,630.75245792a,1048.03271313d,35y,0h,45t,0r/data=CloaMBIqGZXL6y2KgxvAIT-ViRF4-1pAKhYtNi44Nzg0NTY4LDEwNy45MjkyMDM0GAIgASImCiQJTdcNuqdpG8AReE-z66h5G8AZuVafpCH8WkAh9Q2lsyH6WkAoAg', 1003),
(245, 'Sawahbera', 'Sawah', '4480', '6400', '-', '320', '6400', 2005, 'Berubah', NULL, '{\"lat\":-6.8671348,\"lng\":107.8966082}', 'https://earth.google.com/web/search/-6.8671348,107.8966082/@-6.8671348,107.8966082,513.40605754a,1048.06064888d,35y,0h,45t,0r/data=CloaMBIqGd3kXC_ydxvAIdMUXAdi-VpAKhYtNi44NjcxMzQ4LDEwNy44OTY2MDgyGAIgASImCiQJ2kDUr5xwG8ARPGo_j6GTG8AZNCRDBIj7WkAhFELTtEj6WkAoAg', 1003),
(246, 'Paekantaloe', 'Sawah', '5180', '5080', '-', '370', '5080', 2005, 'Berubah', NULL, '{\"lat\":-6.865246200952405,\"lng\":107.89878860524279}', 'https://earth.google.com/web/search/-6.8671348,107.8966082/@-6.8671348,107.8966082,513.40605754a,1048.06064888d,35y,0h,45t,0r/data=CloaMBIqGd3kXC_ydxvAIdMUXAdi-VpAKhYtNi44NjcxMzQ4LDEwNy44OTY2MDgyGAIgASImCiQJ2kDUr5xwG8ARPGo_j6GTG8AZNCRDBIj7WkAhFELTtEj6WkAoAg', 1003),
(247, 'Wareng', 'Sawah', '69874', '72233', '10', '0.95', '72233', 2005, 'Berubah', NULL, '{\"lat\":-6.863030579316282,\"lng\":107.8991319397732}', 'https://earth.google.com/web/search/-6.8671348,107.8966082/@-6.8671348,107.8966082,513.40605754a,1048.06064888d,35y,0h,45t,0r/data=CloaMBIqGd3kXC_ydxvAIdMUXAdi-VpAKhYtNi44NjcxMzQ4LDEwNy44OTY2MDgyGAIgASImCiQJ2kDUr5xwG8ARPGo_j6GTG8AZNCRDBIj7WkAhFELTtEj6WkAoAg', 1003),
(248, 'Tjiketan', 'Sawah', '67648', '84450', '9', '183', '84450', 2006, 'Berubah', NULL, '{\"lat\":-6.870529558891684,\"lng\":107.90084867130761}', 'https://earth.google.com/web/search/-6.8671348,107.8966082/@-6.8671348,107.8966082,513.40605754a,1048.06064888d,35y,0h,45t,0r/data=CloaMBIqGd3kXC_ydxvAIdMUXAdi-VpAKhYtNi44NjcxMzQ4LDEwNy44OTY2MDgyGAIgASImCiQJ2kDUr5xwG8ARPGo_j6GTG8AZNCRDBIj7WkAhFELTtEj6WkAoAg', 1003),
(249, 'Paseh', 'Sawah', '104972', '103887', '14', '498', '103887', 2006, 'Berubah', NULL, '{\"lat\":-6.8481791,\"lng\":107.8932178}', 'https://earth.google.com/web/search/-6.8481791,107.8932178/@-6.8481791,107.8932178,540.5972799a,1048.1073177d,35y,0h,45t,0r/data=CloaMBIqGVSa3g-JZBvAISDN_Xoq-VpAKhYtNi44NDgxNzkxLDEwNy44OTMyMTc4GAIgASImCiQJiB0cJClkG8AR2-j6w_OCG8AZxk1lAZX5WkAhaln4oir4WkAoAg', 1002),
(250, 'Koepa', 'Sawah', '141596', '53474', '9', '117', '141596', 2006, 'Berubah', NULL, '{\"lat\":-6.8405330731207,\"lng\":107.89947556871583}', 'https://earth.google.com/web/search/-6.8481791,107.8932178/@-6.8481791,107.8932178,540.5972799a,1048.1073177d,35y,0h,45t,0r/data=CloaMBIqGVSa3g-JZBvAISDN_Xoq-VpAKhYtNi44NDgxNzkxLDEwNy44OTMyMTc4GAIgASImCiQJiB0cJClkG8AR2-j6w_OCG8AZxk1lAZX5WkAhaln4oir4WkAoAg', 1002),
(251, 'Pasirreungit', 'Darat', '178248', '167100', '24', '320', '167100', 2006, 'Berubah', NULL, '{\"lat\":-6.8755889,\"lng\":107.9063355}', 'https://earth.google.com/web/search/-6.8755889,107.9063355/@-6.8755889,107.9063355,622.75548892a,1048.03979366d,35y,0h,45t,0r/data=CloaMBIqGWP2aGCagBvAIQvtnGYB-lpAKhYtNi44NzU1ODg5LDEwNy45MDYzMzU1GAIgASImCiQJ72MvRmlYG8ARKCBo3UZ4G8AZvQjyLlb5WkAhui635PL3WkAoAg', 1003),
(252, 'Tednjonegara', 'Darat', '5906', '4450', '-', '410', '4450', 2007, 'Berubah', NULL, '{\"lat\":-6.876153652905266,\"lng\":107.90994668895665}', 'https://earth.google.com/web/search/-6.8755889,107.9063355/@-6.8755889,107.9063355,622.75548892a,1048.03979366d,35y,0h,45t,0r/data=CloaMBIqGWP2aGCagBvAIQvtnGYB-lpAKhYtNi44NzU1ODg5LDEwNy45MDYzMzU1GAIgASImCiQJ72MvRmlYG8ARKCBo3UZ4G8AZvQjyLlb5WkAhui635PL3WkAoAg', 1003),
(253, 'Goenoengpoejoeh', 'Darat', '11298', '11300', '1', '307', '11300', 2007, 'Berubah', NULL, '{\"lat\":-6.9020577968022225,\"lng\":107.86788961627369}', 'https://earth.google.com/web/search/-6.9016812,107.8648377/@-6.9016812,107.8648377,966.13864266a,1047.97526667d,35y,0h,45t,0r/data=CloaMBIqGRGsBVFSmxvAIUN2OYBZ91pAKhYtNi45MDE2ODEyLDEwNy44NjQ4Mzc3GAIgASImCiQJ4daqrU9oG8ARHW22dCSIG8AZyRYvzlr6WkAhsxTzeHr4WkAoAg', 1002),
(254, 'Babakan', 'Babakan', '9072', '7600', '1', '148', '7600', 2007, 'Berubah', NULL, '{\"lat\":-6.902292122985823,\"lng\":107.8651428428745}', 'https://earth.google.com/web/search/-6.9016812,+107.8648377/@-6.9016812,107.8648377,966.13864266a,1047.97526667d,35y,0h,45t,0r/data=ClsaMRIrGRGsBVFSmxvAIUN2OYBZ91pAKhctNi45MDE2ODEyLCAxMDcuODY0ODM3NxgCIAEiJgokCfSG1zC3mhvAEbGv9iUcthvAGfFNyjh0-FpAIQhxNMm99VpAKAI', NULL),
(255, 'Patjarakaparek', 'Darat', '18144', '-', '2', '296', '18144', 2007, 'Berubah', NULL, '', '-', NULL),
(256, 'Kandangsapi & Papanggoengan', 'Darat', '3934', '3150', '-', '281', '3150', 2008, 'Berubah', NULL, '{\"lat\":-6.8558956,\"lng\":107.9081402}', 'https://earth.google.com/web/search/-6.8558956,107.9081402/@-6.8558956,107.9081402,602.26534606a,1048.08833517d,35y,0h,45t,0r/data=CloaMBIqGUMpa-VvbBvAIbTLEvge-lpAKhYtNi44NTU4OTU2LDEwNy45MDgxNDAyGAIgASImCiQJE8_CGgB9G8ARHmJXBbWkG8AZkTRYxJz3WkAhHiIZvWb1WkAoAg', 1002),
(257, 'Lebet', 'Darat', '51156', '50800', '7', '154', '50800', 2008, 'Berubah', NULL, '{\"lat\":-6.855275919209627,\"lng\":107.90986072872681}', 'https://earth.google.com/web/search/-6.8558956,107.9081402/@-6.8558956,107.9081402,602.26534606a,1048.08833517d,35y,0h,45t,0r/data=CloaMBIqGUMpa-VvbBvAIbTLEvge-lpAKhYtNi44NTU4OTU2LDEwNy45MDgxNDAyGAIgASImCiQJE8_CGgB9G8ARHmJXBbWkG8AZkTRYxJz3WkAhHiIZvWb1WkAoAg', 1002),
(258, 'Aloen-aloen Pangadoen Kuda', 'Darat', '8036', '23550', '1', '0.74', '23550', 2008, 'Berubah', NULL, '{\"lat\":-6.7902766,\"lng\":107.980196}', 'https://earth.google.com/web/search/-6.7902766,107.980196/@-6.7902766,107.980196,712.62973204a,1048.24908067d,35y,0h,45t,0r/data=ClkaLxIpGSEt30Q-KRvAIeHqAIi7_lpAKhUtNi43OTAyNzY2LDEwNy45ODAxOTYYAiABIiYKJAkTbtLq82IbwBGmyDAayYIbwBk8iAd0W_paQCGrHe8NufhaQCgC', 1002),
(259, 'Sitoe Lembur Pandjoenan', 'Darat', '29106', '17350', '4', '0.79', '17350', 2008, 'Berubah', NULL, '{\"lat\":-6.8493177,\"lng\":107.9048717}', 'https://earth.google.com/web/search/-6.8493177,107.9048717/@-6.8493177,107.9048717,466.23192803a,1048.10451809d,35y,0h,45t,0r/data=CloaMBIqGd-nBYqzZRvAIdyk_Wrp-VpAKhYtNi44NDkzMTc3LDEwNy45MDQ4NzE3GAIgASImCiQJ4u9ZGw4PG8ARIgcgkvowG8AZglWrzRX_WkAhkcjsjhT9WkAoAg', 1002),
(260, 'Tjitamiang', 'Darat', '252', '252', '-', '0.18', '252', 2009, 'Berubah', NULL, '', '-', NULL),
(261, 'Sitoe Singaparna', 'Darat', '39788', '8850', '5', '342', '8850', 2009, 'Berubah', NULL, '{\"lat\":-6.850503750453529,\"lng\":107.91200674324497}', 'https://earth.google.com/web/search/-6.8493177,107.9048717/@-6.8493177,107.9048717,466.23192803a,1048.10451809d,35y,0h,45t,0r/data=CloaMBIqGd-nBYqzZRvAIdyk_Wrp-VpAKhYtNi44NDkzMTc3LDEwNy45MDQ4NzE3GAIgASImCiQJ4u9ZGw4PG8ARIgcgkvowG8AZglWrzRX_WkAhkcjsjhT9WkAoAg', 1003),
(262, 'Pakarangan', 'Darat', '3444', '3825', '-', '246', '3825', 2009, 'Berubah', NULL, '{\"lat\":-6.7323819,\"lng\":107.9878521}', 'https://earth.google.com/web/search/-6.7323819,107.9878521/@-6.7323819,107.9878521,358.71556749a,1048.38963029d,35y,0h,45t,0r/data=CloaMBIqGbi6UoX17RrAITyyA_g4_1pAKhYtNi43MzIzODE5LDEwNy45ODc4NTIxGAIgASImCiQJ4pBeeK5SG8ARu0W5RkRwG8AZcHQdGB_6WkAh51pLx8D4WkAoAg', 1001),
(263, 'Taloen Tjipanas', 'Darat', '38668', '39639', '5', '262', '39639', 2009, 'Berubah', NULL, '{\"lat\":-6.73212144192155,\"lng\":107.99148585478589}', 'https://earth.google.com/web/search/-6.7323819,107.9878521/@-6.7323819,107.9878521,358.71556749a,1048.38963029d,35y,0h,45t,0r/data=CloaMBIqGbi6UoX17RrAITyyA_g4_1pAKhYtNi43MzIzODE5LDEwNy45ODc4NTIxGAIgASImCiQJ4pBeeK5SG8ARu0W5RkRwG8AZcHQdGB_6WkAh51pLx8D4WkAoAg', 1001),
(264, 'Museum Prabu Geusan', 'Bangunan', '20000', '18800', '-', '-', '18800', 2009, 'Tetap', NULL, '{\"lat\":-6.861200707086056,\"lng\":107.92123474937534}', 'https://earth.google.com/web/search/-6.861200707086056,107.92123474937534/@-6.86122265,107.92069793,458.46695177a,399.90374982d,35y,-168.45235435h,44.99587896t,0r/data=CnEaRxJBCiUweDJlNjhkMTI0YmM3ZjBkNjk6MHg1NzE4MTc2ZjJlYTliMWRkKhhNdXNldW0gUHJhYnUKR2V1c2FuIFVsdW4YASABIiYKJAnt0DxEl24bwBFBkHjOYIAbwBkqV8gHFPpaQCG71fWFhPlaQA', 1003),
(1001, 'Conggeang', '-', '-', '-', '-', '-', '-', NULL, '-', '[{\"lat\":-6.653215531785978,\"lng\":107.85074016662372},{\"lat\":-6.640938888476985,\"lng\":107.84799339616863},{\"lat\":-6.62593368634339,\"lng\":107.85554701492008},{\"lat\":-6.608881766219145,\"lng\":107.8486800887824},{\"lat\":-6.601378734998389,\"lng\":107.85486032230631},{\"lat\":-6.582961721989934,\"lng\":107.84662001094108},{\"lat\":-6.578868959586222,\"lng\":107.8589804779889},{\"lat\":-6.586372331554979,\"lng\":107.87889456378817},{\"lat\":-6.5925113696920175,\"lng\":107.90361549788376},{\"lat\":-6.602060833446365,\"lng\":107.91391588709031},{\"lat\":-6.612292197331562,\"lng\":107.92558966152434},{\"lat\":-6.616384683603358,\"lng\":107.92902312459317},{\"lat\":-6.6136563631882765,\"lng\":107.93520335811708},{\"lat\":-6.624569554406884,\"lng\":107.93863682118592},{\"lat\":-6.62661575089692,\"lng\":107.94893721039242},{\"lat\":-6.635482504219763,\"lng\":107.96061098482645},{\"lat\":-6.638892751467481,\"lng\":107.97297145187426},{\"lat\":-6.653215531785978,\"lng\":107.98876538199094},{\"lat\":-6.662763820038892,\"lng\":108.01623308654165},{\"lat\":-6.663445833518998,\"lng\":108.02859355358946},{\"lat\":-6.654579584335012,\"lng\":108.0313403240445},{\"lat\":-6.647077248450034,\"lng\":108.03202701665826},{\"lat\":-6.636164555558737,\"lng\":108.03202701665826},{\"lat\":-6.640256843752292,\"lng\":108.03889394279595},{\"lat\":-6.636846605953073,\"lng\":108.04919433200244},{\"lat\":-6.650487415324716,\"lng\":108.05331448768507},{\"lat\":-6.653215531785978,\"lng\":108.05606125814013},{\"lat\":-6.653215531785978,\"lng\":108.06018141382276},{\"lat\":-6.659353738415238,\"lng\":108.06704833996044},{\"lat\":-6.664809857633848,\"lng\":108.06979511041547},{\"lat\":-6.664809857633848,\"lng\":108.07597534393938},{\"lat\":-6.670265916141051,\"lng\":108.08215557746328},{\"lat\":-6.672311922419095,\"lng\":108.08970919621474},{\"lat\":-6.681177850825961,\"lng\":108.09588942973865},{\"lat\":-6.6893616421092545,\"lng\":108.10618981894518},{\"lat\":-6.70572881322691,\"lng\":108.11580351553789},{\"lat\":-6.70572881322691,\"lng\":108.12610390474438},{\"lat\":-6.710502467982989,\"lng\":108.13983775701973},{\"lat\":-6.715276075943974,\"lng\":108.14739137577119},{\"lat\":-6.722095434648474,\"lng\":108.15357160929507},{\"lat\":-6.722095434648474,\"lng\":108.15906515020522},{\"lat\":-6.728232775694204,\"lng\":108.16318530588786},{\"lat\":-6.739825319344263,\"lng\":108.15700507236394},{\"lat\":-6.747326229328627,\"lng\":108.15151153145378},{\"lat\":-6.752099475201272,\"lng\":108.15013814622628},{\"lat\":-6.759600195011125,\"lng\":108.14876476099873},{\"lat\":-6.763009574639798,\"lng\":108.12061036383425},{\"lat\":-6.762327700638362,\"lng\":108.07185518825679},{\"lat\":-6.755508907716437,\"lng\":108.03202701665826},{\"lat\":-6.750053804161656,\"lng\":108.00661938994887},{\"lat\":-6.749371911893976,\"lng\":107.9894520746047}]', '', '-', NULL),
(1002, 'Sumedang Utara', '-', '-', '-', '-', '-', '-', NULL, '-', '[{\"lat\":-6.654026083885829,\"lng\":107.85073432548532},{\"lat\":-6.681988356684261,\"lng\":107.89124918969758},{\"lat\":-6.700401663707132,\"lng\":107.91459673856566},{\"lat\":-6.7167684641891405,\"lng\":107.93863098004752},{\"lat\":-6.729725124160288,\"lng\":107.95923175846055},{\"lat\":-6.74404524082112,\"lng\":107.98189261471487},{\"lat\":-6.74881851903577,\"lng\":107.98807284823879},{\"lat\":-6.750182304169631,\"lng\":108.00524016358297},{\"lat\":-6.754273636515147,\"lng\":108.02652763460974},{\"lat\":-6.757001172191145,\"lng\":108.04369494995395},{\"lat\":-6.761092446858331,\"lng\":108.06566911359447},{\"lat\":-6.763138071205358,\"lng\":108.09725697382775},{\"lat\":-6.763138071205358,\"lng\":108.11373759655821},{\"lat\":-6.761092446858331,\"lng\":108.13090491190236},{\"lat\":-6.759728692483208,\"lng\":108.14738553463278},{\"lat\":-6.763138071205358,\"lng\":108.15425246077044},{\"lat\":-6.759046813852755,\"lng\":108.16180607952191},{\"lat\":-6.77268420359658,\"lng\":108.16386615736322},{\"lat\":-6.785639366819611,\"lng\":108.17004639088711},{\"lat\":-6.790412233865955,\"lng\":108.16523954259075},{\"lat\":-6.799276004183609,\"lng\":108.16455284997697},{\"lat\":-6.798594181499342,\"lng\":108.15493915338422},{\"lat\":-6.812230451270288,\"lng\":108.16043269429434},{\"lat\":-6.819730234443352,\"lng\":108.16043269429434},{\"lat\":-6.834047676207711,\"lng\":108.16317946474943},{\"lat\":-6.8395018270037,\"lng\":108.1391452232676},{\"lat\":-6.842910639631365,\"lng\":108.11511098178575},{\"lat\":-6.8395018270037,\"lng\":108.08214973632491},{\"lat\":-6.832684128784307,\"lng\":108.05948888007056},{\"lat\":-6.825866333358844,\"lng\":108.04163487211261},{\"lat\":-6.819730234443352,\"lng\":108.02172078631337},{\"lat\":-6.814275858316946,\"lng\":107.99631315960397},{\"lat\":-6.813594056937421,\"lng\":107.98669946301125},{\"lat\":-6.816321256638146,\"lng\":107.96815876243954},{\"lat\":-6.827911682187433,\"lng\":107.94343782834392},{\"lat\":-6.825787696747947,\"lng\":107.93175099026912},{\"lat\":-6.824935465349709,\"lng\":107.92591410305211},{\"lat\":-6.827321709440953,\"lng\":107.91853215745412},{\"lat\":-6.830048830975323,\"lng\":107.91612873330592},{\"lat\":-6.834991699125317,\"lng\":107.9120085776233},{\"lat\":-6.83874142707794,\"lng\":107.90977682662859},{\"lat\":-6.844025084691193,\"lng\":107.90857511455448},{\"lat\":-6.848244474056799,\"lng\":107.90823078628775},{\"lat\":-6.851482787311555,\"lng\":107.91063421043592},{\"lat\":-6.855743692298277,\"lng\":107.91355265404444},{\"lat\":-6.859748908249502,\"lng\":107.91106339331952},{\"lat\":-6.858129782451603,\"lng\":107.90677156448349},{\"lat\":-6.856340215956813,\"lng\":107.90299475510776},{\"lat\":-6.8555732568301035,\"lng\":107.89492611689599},{\"lat\":-6.856340215956813,\"lng\":107.88951841256258},{\"lat\":-6.858470651498027,\"lng\":107.88479740084294},{\"lat\":-6.86324279326437,\"lng\":107.87964720623968},{\"lat\":-6.86383930753041,\"lng\":107.87690043578462},{\"lat\":-6.867418377425711,\"lng\":107.87595623344069},{\"lat\":-6.873809506686676,\"lng\":107.87260860694855},{\"lat\":-6.881052682620395,\"lng\":107.8715785680279},{\"lat\":-6.884375985192691,\"lng\":107.87320946298559},{\"lat\":-6.891022520507187,\"lng\":107.87466868478985},{\"lat\":-6.894004909918181,\"lng\":107.8744970057482},{\"lat\":-6.899628793160971,\"lng\":107.87166439871638},{\"lat\":-6.901588615568723,\"lng\":107.86908930141476},{\"lat\":-6.90259008848409,\"lng\":107.8676310076975},{\"lat\":-6.9011415279424835,\"lng\":107.86681556021863},{\"lat\":-6.901301432946297,\"lng\":107.86610791813806},{\"lat\":-6.9020683182320655,\"lng\":107.86567873525448},{\"lat\":-6.902856504592099,\"lng\":107.86572165354282},{\"lat\":-6.90326124842904,\"lng\":107.86464869633377},{\"lat\":-6.902430458073975,\"lng\":107.86389762628748},{\"lat\":-6.90128013055948,\"lng\":107.86550706210102},{\"lat\":-6.900470639151398,\"lng\":107.86539976638011},{\"lat\":-6.900044590485904,\"lng\":107.8643268091711},{\"lat\":-6.898840856887966,\"lng\":107.86316739383133},{\"lat\":-6.898798251892039,\"lng\":107.85870389184187},{\"lat\":-6.899778165828896,\"lng\":107.85634338598203},{\"lat\":-6.899011276833417,\"lng\":107.85372537039204},{\"lat\":-6.891316561189718,\"lng\":107.84519796526223},{\"lat\":-6.869501956468329,\"lng\":107.84039111696589},{\"lat\":-6.860639487293636,\"lng\":107.82940403514561},{\"lat\":-6.846322842606724,\"lng\":107.81361010502894},{\"lat\":-6.839505241737317,\"lng\":107.80536979366371},{\"lat\":-6.8217790243443925,\"lng\":107.795756097071},{\"lat\":-6.81427927323057,\"lng\":107.77996216695432},{\"lat\":-6.804733965804865,\"lng\":107.76897508513404},{\"lat\":-6.80814302596832,\"lng\":107.78133555218187},{\"lat\":-6.804733965804865,\"lng\":107.79506940445724},{\"lat\":-6.8108702566642245,\"lng\":107.79987625275359},{\"lat\":-6.80200670024662,\"lng\":107.81567018287025},{\"lat\":-6.787688302165573,\"lng\":107.8184169533253},{\"lat\":-6.784279096956598,\"lng\":107.82253710900792},{\"lat\":-6.782233562246839,\"lng\":107.83215080560065},{\"lat\":-6.774733194024063,\"lng\":107.83558426866952},{\"lat\":-6.761095862149297,\"lng\":107.83489757605574},{\"lat\":-6.752913278258795,\"lng\":107.83695765389702},{\"lat\":-6.745412454798214,\"lng\":107.83489757605574},{\"lat\":-6.737911515192581,\"lng\":107.8335241908282},{\"lat\":-6.729728539672365,\"lng\":107.83627096128328},{\"lat\":-6.719499626359972,\"lng\":107.83215080560065},{\"lat\":-6.708588548349424,\"lng\":107.83627096128328},{\"lat\":-6.697677225927232,\"lng\":107.83627096128328},{\"lat\":-6.691539499803756,\"lng\":107.83283749821443},{\"lat\":-6.686083678487513,\"lng\":107.82528387946297},{\"lat\":-6.683355744988219,\"lng\":107.82940403514561},{\"lat\":-6.676535844668767,\"lng\":107.83489757605574},{\"lat\":-6.674489856038666,\"lng\":107.83901773173834},{\"lat\":-6.662213744803825,\"lng\":107.8397044243521}]', '', '-', NULL),
(1003, 'Sumedang Selatan', '-', '-', '-', '-', '-', '-', NULL, '-', '[{\"lat\":-6.807459044848467,\"lng\":107.7697029012464},{\"lat\":-6.80661063511363,\"lng\":107.7659243309052},{\"lat\":-6.810019681947876,\"lng\":107.76283421414323},{\"lat\":-6.811724196282354,\"lng\":107.7552805953918},{\"lat\":-6.813087803388891,\"lng\":107.74978705448166},{\"lat\":-6.820246677068455,\"lng\":107.74635359141284},{\"lat\":-6.827405443769705,\"lng\":107.74498020618529},{\"lat\":-6.833882330893283,\"lng\":107.7466969377197},{\"lat\":-6.840018248284278,\"lng\":107.74360682095775},{\"lat\":-6.842745297384187,\"lng\":107.7425767820371},{\"lat\":-6.8471767189493455,\"lng\":107.74360682095775},{\"lat\":-6.849562851978126,\"lng\":107.74120339680957},{\"lat\":-6.854675953982689,\"lng\":107.74017335788893},{\"lat\":-6.861493337991369,\"lng\":107.7425767820371},{\"lat\":-6.8683106243919685,\"lng\":107.74223343573021},{\"lat\":-6.876491239096096,\"lng\":107.74463685987838},{\"lat\":-6.880922346591963,\"lng\":107.74807032294724},{\"lat\":-6.88705765792544,\"lng\":107.75047374709543},{\"lat\":-6.894556264009248,\"lng\":107.75150378601607},{\"lat\":-6.897964682099931,\"lng\":107.75665398061932},{\"lat\":-6.902736426215187,\"lng\":107.75768401953997},{\"lat\":-6.907508122220532,\"lng\":107.75802736584687},{\"lat\":-6.911938939690447,\"lng\":107.75871405846065},{\"lat\":-6.915688060492407,\"lng\":107.75768401953997},{\"lat\":-6.921482097744956,\"lng\":107.75837071215375},{\"lat\":-6.926935244304214,\"lng\":107.75802736584687},{\"lat\":-6.934774032004151,\"lng\":107.75837071215375},{\"lat\":-6.940227024785536,\"lng\":107.75734067323309},{\"lat\":-6.945339148145993,\"lng\":107.75493724908492},{\"lat\":-6.950792018487459,\"lng\":107.75356386385737},{\"lat\":-6.953518429936382,\"lng\":107.75287717124361},{\"lat\":-6.955222429057386,\"lng\":107.75871405846065},{\"lat\":-6.95249602749691,\"lng\":107.75940075107442},{\"lat\":-6.953518429936382,\"lng\":107.76249086783638},{\"lat\":-6.953177629370443,\"lng\":107.76729771613273},{\"lat\":-6.9542000303265805,\"lng\":107.76935779397407},{\"lat\":-6.957608017440387,\"lng\":107.76935779397407},{\"lat\":-6.957608017440387,\"lng\":107.77244791073599},{\"lat\":-6.956585623903084,\"lng\":107.77725475903236},{\"lat\":-6.9555632281398125,\"lng\":107.78034487579431},{\"lat\":-6.958289611895099,\"lng\":107.78309164624935},{\"lat\":-6.964083124796059,\"lng\":107.7971688448316},{\"lat\":-6.966127876974001,\"lng\":107.8249798956892},{\"lat\":-6.9715805058519935,\"lng\":107.8266966272236},{\"lat\":-6.970898930711289,\"lng\":107.8311601292131},{\"lat\":-6.965105501999357,\"lng\":107.83013009029244},{\"lat\":-6.9691949885225455,\"lng\":107.84214721103335},{\"lat\":-6.966809459052131,\"lng\":107.85210425393299},{\"lat\":-6.96715024971965,\"lng\":107.86206129683261},{\"lat\":-6.963742331899709,\"lng\":107.86858487666339},{\"lat\":-6.962038363704575,\"lng\":107.87648184172174},{\"lat\":-6.962038363704575,\"lng\":107.88197538263188},{\"lat\":-6.964083124796059,\"lng\":107.88884230876955},{\"lat\":-6.9542000303265805,\"lng\":107.89948604428295},{\"lat\":-6.95249602749691,\"lng\":107.90909974087569},{\"lat\":-6.9542000303265805,\"lng\":107.91115981871698},{\"lat\":-6.947383981934983,\"lng\":107.91596666701335},{\"lat\":-6.949428806831397,\"lng\":107.92077351530972},{\"lat\":-6.9490880032996545,\"lng\":107.92558036360612},{\"lat\":-6.9542000303265805,\"lng\":107.92867048036807},{\"lat\":-6.9555632281398125,\"lng\":107.93656744542639},{\"lat\":-6.953518429936382,\"lng\":107.94309102525713},{\"lat\":-6.958289611895099,\"lng\":107.946524488326},{\"lat\":-6.9593120017216235,\"lng\":107.95751157014628},{\"lat\":-6.958971205360199,\"lng\":107.96506518889773},{\"lat\":-6.964083124796059,\"lng\":107.97021538350099},{\"lat\":-6.969876566141461,\"lng\":107.97708230963863},{\"lat\":-6.976692287798976,\"lng\":107.98326254316254},{\"lat\":-6.982144793695045,\"lng\":107.99081616191397},{\"lat\":-6.981804013937706,\"lng\":107.99802643435855},{\"lat\":-6.981122453678474,\"lng\":108.00420666788246},{\"lat\":-6.981463233932196,\"lng\":108.01279032555453},{\"lat\":-6.981463233932196,\"lng\":108.01897055907844},{\"lat\":-6.98487102281638,\"lng\":108.02412075368173},{\"lat\":-6.987256460260841,\"lng\":108.026180831523},{\"lat\":-6.988278786868384,\"lng\":108.02961429459185},{\"lat\":-6.992368070935654,\"lng\":108.0306443335125},{\"lat\":-6.992027298630317,\"lng\":108.03648122072954},{\"lat\":-6.995094240428484,\"lng\":108.04025803010522},{\"lat\":-6.993049614800577,\"lng\":108.0471249562429},{\"lat\":-6.995775780315131,\"lng\":108.0560519602219},{\"lat\":-6.9954350104961485,\"lng\":108.0656656568146},{\"lat\":-6.987256460260841,\"lng\":108.06944246619034},{\"lat\":-6.986574907947144,\"lng\":108.07974285539687},{\"lat\":-6.994412699547087,\"lng\":108.08248962585192},{\"lat\":-7.000205765325875,\"lng\":108.08660978153455},{\"lat\":-7.000546531661946,\"lng\":108.09175997613778},{\"lat\":-7.00599875918531,\"lng\":108.09313336136532},{\"lat\":-7.015199248527749,\"lng\":108.09931359488921},{\"lat\":-7.024058807186916,\"lng\":108.10549382841312},{\"lat\":-7.029170014263422,\"lng\":108.11201740824393},{\"lat\":-7.035303388541926,\"lng\":108.11957102699539},{\"lat\":-7.0373478286325195,\"lng\":108.12540791421239},{\"lat\":-7.0400737347445075,\"lng\":108.13055810881563},{\"lat\":-7.039732997356254,\"lng\":108.13742503495332},{\"lat\":-7.028829268873606,\"lng\":108.14394861478408},{\"lat\":-7.023718058050507,\"lng\":108.14703873154603},{\"lat\":-7.020651304589216,\"lng\":108.15150223353554},{\"lat\":-7.009747128625475,\"lng\":108.15459235029749},{\"lat\":-7.004976471379822,\"lng\":108.16008589120761},{\"lat\":-6.997138857103958,\"lng\":108.16626612473152},{\"lat\":-6.990664206923328,\"lng\":108.1672961636522},{\"lat\":-6.980100111428189,\"lng\":108.16935624149347},{\"lat\":-6.968513409912556,\"lng\":108.17038628041415},{\"lat\":-6.9593120017216235,\"lng\":108.17965663070002},{\"lat\":-6.95249602749691,\"lng\":108.18446347899638},{\"lat\":-6.9490880032996545,\"lng\":108.19201709774784},{\"lat\":-6.9460207603969,\"lng\":108.19922737019236},{\"lat\":-6.942271880794633,\"lng\":108.20266083326119},{\"lat\":-6.940908644442415,\"lng\":108.20575095002314},{\"lat\":-6.936137286119219,\"lng\":108.20575095002314},{\"lat\":-6.932729143434521,\"lng\":108.21399126138836},{\"lat\":-6.931706695821758,\"lng\":108.21708137815031},{\"lat\":-6.927616883191693,\"lng\":108.21879810968471},{\"lat\":-6.923186212815079,\"lng\":108.21570799292276},{\"lat\":-6.919777976522026,\"lng\":108.21742472445722},{\"lat\":-6.91773302293486,\"lng\":108.21330456877459},{\"lat\":-6.914324747279059,\"lng\":108.21124449093331},{\"lat\":-6.911257278167253,\"lng\":108.21330456877459},{\"lat\":-6.904099772841611,\"lng\":108.2153646466159},{\"lat\":-6.9068264543093845,\"lng\":108.21124449093331},{\"lat\":-6.902736426215187,\"lng\":108.21021445201264},{\"lat\":-6.894897106921779,\"lng\":108.21227452985394},{\"lat\":-6.8897844374957815,\"lng\":108.21399126138836},{\"lat\":-6.890125283839699,\"lng\":108.2088410667851},{\"lat\":-6.892511201385721,\"lng\":108.20472091110251},{\"lat\":-6.889102744073011,\"lng\":108.19785398496482},{\"lat\":-6.882967459182347,\"lng\":108.19270379036162},{\"lat\":-6.875468669957812,\"lng\":108.19613725343041},{\"lat\":-6.871037511600639,\"lng\":108.19716729235105},{\"lat\":-6.862856803083188,\"lng\":108.19304713666845},{\"lat\":-6.864561128956315,\"lng\":108.18927032729273},{\"lat\":-6.858084658182115,\"lng\":108.18515017161016},{\"lat\":-6.856039438588509,\"lng\":108.18892698098588},{\"lat\":-6.852630719760745,\"lng\":108.18686690314455},{\"lat\":-6.855016825499869,\"lng\":108.18412013268949},{\"lat\":-6.850585476765176,\"lng\":108.17862659177935},{\"lat\":-6.846154086855391,\"lng\":108.18068666962064},{\"lat\":-6.841040893521608,\"lng\":108.17931328439312},{\"lat\":-6.836268530351293,\"lng\":108.17828324547247},{\"lat\":-6.831155231215239,\"lng\":108.17519312871052},{\"lat\":-6.832177895417071,\"lng\":108.16798285626594},{\"lat\":-6.833541444284116,\"lng\":108.16557943211777},{\"lat\":-6.83933648357632,\"lng\":108.135364957112},{\"lat\":-6.84240441709837,\"lng\":108.10927063778885},{\"lat\":-6.839677366051949,\"lng\":108.08317631846568},{\"lat\":-6.832177895417071,\"lng\":108.06051546221137},{\"lat\":-6.825700985216636,\"lng\":108.04231810794653},{\"lat\":-6.82058757314757,\"lng\":108.02412075368173},{\"lat\":-6.815474106495072,\"lng\":108.00077320481361},{\"lat\":-6.813769605488188,\"lng\":107.9860093136176},{\"lat\":-6.81615590520101,\"lng\":107.96781195935277},{\"lat\":-6.821951155038021,\"lng\":107.95476479969119},{\"lat\":-6.827746334751867,\"lng\":107.94480775679159},{\"lat\":-6.826041877412829,\"lng\":107.92867048036807},{\"lat\":-6.829791675544772,\"lng\":107.91631001332023},{\"lat\":-6.840700012019101,\"lng\":107.90944308718258},{\"lat\":-6.852971592740408,\"lng\":107.91218985763764},{\"lat\":-6.85459246205079,\"lng\":107.9132139521854},{\"lat\":-6.857448116964877,\"lng\":107.9125242873852},{\"lat\":-6.860004632525481,\"lng\":107.91072171927406},{\"lat\":-6.857788986498995,\"lng\":107.90642989043802},{\"lat\":-6.856084636389673,\"lng\":107.89930545457017},{\"lat\":-6.855785534971364,\"lng\":107.89089564143673},{\"lat\":-6.85919423123275,\"lng\":107.88368536899218},{\"lat\":-6.863966365014146,\"lng\":107.87802015492859},{\"lat\":-6.871806195201031,\"lng\":107.87338497978564},{\"lat\":-6.880838882733319,\"lng\":107.8718399214047},{\"lat\":-6.888848858114458,\"lng\":107.87407167239942},{\"lat\":-6.891299696422268,\"lng\":107.87462782807548},{\"lat\":-6.896881006608034,\"lng\":107.87308276969455},{\"lat\":-6.90041722254346,\"lng\":107.87059350896963},{\"lat\":-6.901865785301545,\"lng\":107.86883385914686},{\"lat\":-6.902377041687174,\"lng\":107.86754631049604},{\"lat\":-6.902845692888932,\"lng\":107.86630168013359},{\"lat\":-6.901780575850232,\"lng\":107.86557206923145},{\"lat\":-6.902845692888932,\"lng\":107.86552915094309},{\"lat\":-6.903133412440642,\"lng\":107.86454200710207},{\"lat\":-6.9023665288805915,\"lng\":107.86394115106502},{\"lat\":-6.90140792268322,\"lng\":107.86522869971583},{\"lat\":-6.9007901532162474,\"lng\":107.86544329115765},{\"lat\":-6.900364104838326,\"lng\":107.86525015886001},{\"lat\":-6.900065870745614,\"lng\":107.8644990888137},{\"lat\":-6.898987581134151,\"lng\":107.85930482255087},{\"lat\":-6.899328420858087,\"lng\":107.85552801317513},{\"lat\":-6.892170735152337,\"lng\":107.8455709702755},{\"lat\":-6.88160443017119,\"lng\":107.84351089243421},{\"lat\":-6.876150761369052,\"lng\":107.8417941608998},{\"lat\":-6.87137874981393,\"lng\":107.84042077567226},{\"lat\":-6.8655840999670845,\"lng\":107.8349272347621},{\"lat\":-6.8587667745172505,\"lng\":107.82737361601068},{\"lat\":-6.8533128439023985,\"lng\":107.82050668987299},{\"lat\":-6.846836220259355,\"lng\":107.81363976373532},{\"lat\":-6.840018626720822,\"lng\":107.80711618390454},{\"lat\":-6.833882709334736,\"lng\":107.80196598930128},{\"lat\":-6.82604225586044,\"lng\":107.79887587253933},{\"lat\":-6.820247055520646,\"lng\":107.7933823316292},{\"lat\":-6.8175198781578725,\"lng\":107.78651540549151},{\"lat\":-6.815133585234707,\"lng\":107.77930513304698},{\"lat\":-6.808997348901505,\"lng\":107.77243820690929},{\"lat\":-6.805247388064343,\"lng\":107.76900474384044}]', '', '-', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_id_master_data_foreign` (`id_master_data`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kode_wilayah`
--
ALTER TABLE `kode_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_data`
--
ALTER TABLE `master_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nadzir`
--
ALTER TABLE `nadzir`
  ADD PRIMARY KEY (`NadzirWakaf`);

--
-- Indexes for table `tanah`
--
ALTER TABLE `tanah`
  ADD PRIMARY KEY (`No`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `NadzirWakaf` (`NadzirWakaf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13005;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `kode_wilayah`
--
ALTER TABLE `kode_wilayah`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_id_master_data_foreign` FOREIGN KEY (`id_master_data`) REFERENCES `master_data` (`id`);

--
-- Constraints for table `tanah`
--
ALTER TABLE `tanah`
  ADD CONSTRAINT `NadzirWakaf` FOREIGN KEY (`NadzirWakaf`) REFERENCES `nadzir` (`NadzirWakaf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_kecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
