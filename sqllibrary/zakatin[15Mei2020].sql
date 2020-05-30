-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 06:45 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zakatin`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `idUser` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `levelUser` varchar(5) NOT NULL,
  `penghasilan` int(150) NOT NULL DEFAULT '0',
  `statusKelengkapan` tinyint(1) NOT NULL DEFAULT '0',
  `joinAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`idUser`, `username`, `password`, `namaLengkap`, `nik`, `telepon`, `alamat`, `pekerjaan`, `levelUser`, `penghasilan`, `statusKelengkapan`, `joinAt`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3', 'Administrator', '', '6285264397615', 'Pekanbaru, Riau.', 'Dosen Politeknik Caltex Riau', '2', 0, 1, '2019-11-13 01:38:36'),
(7, 'eka', '30f8c0977f6a002e44285623ecf60635', 'Sri Eka Riyani H', '', '62885264397615', 'Teluk Kuantan, Kuantan Singingi', 'IT Developer', '1', 0, 1, '2019-11-13 18:51:26'),
(8, 'ridho', '926a161c6419512d711089538c80ac70', 'Ridho Hawali', '145906852200002', '6285264397615', 'Kuantan Singingi', 'IT Developer', '1', 0, 1, '2019-11-17 12:55:04'),
(9, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Haratop', '', '6285315142534', 'Purna MTQ, Pekanbaru', 'Mahasiswa', '1', 0, 1, '2019-12-11 13:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `tagihanzakat`
--

CREATE TABLE `tagihanzakat` (
  `idTagihan` int(240) NOT NULL,
  `idUser` int(50) NOT NULL,
  `idZakat` int(50) NOT NULL,
  `pictureTagihan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihanzakat`
--

INSERT INTO `tagihanzakat` (`idTagihan`, `idUser`, `idZakat`, `pictureTagihan`) VALUES
(3, 8, 11, 'assets/img/tagihanpicture/sm21.jpg'),
(4, 8, 21, 'assets/img/tagihanpicture/sm1.jpg'),
(5, 8, 12, 'assets/img/tagihanpicture/no-img.jpg'),
(6, 7, 7, 'assets/img/tagihanpicture/loveyourparents.jpg'),
(7, 7, 6, 'assets/img/tagihanpicture/sm22.jpg'),
(8, 9, 14, 'assets/img/tagihanpicture/TURKI-tulip1.jpg'),
(9, 7, 31, 'assets/img/tagihanpicture/aywun-a1-806_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `zakat`
--

CREATE TABLE `zakat` (
  `idZakat` int(40) NOT NULL,
  `idAkun` int(30) NOT NULL,
  `jenisZakat` varchar(100) NOT NULL,
  `daftarKeluarga` text NOT NULL,
  `nominalZakat` varchar(250) NOT NULL,
  `beratPerhiasan` varchar(100) NOT NULL DEFAULT '0',
  `jenisPerhiasan` varchar(100) NOT NULL,
  `tglBerzakat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusZakat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zakat`
--

INSERT INTO `zakat` (`idZakat`, `idAkun`, `jenisZakat`, `daftarKeluarga`, `nominalZakat`, `beratPerhiasan`, `jenisPerhiasan`, `tglBerzakat`, `statusZakat`) VALUES
(6, 7, 'Zakat maadin atau rikaz _ rikaz', '', '209040', '13.4', '', '2019-11-13 14:34:21', 'Berhasil'),
(7, 7, 'Zakat penghasilan atau pendapatan', '', '187500', '0', '', '2019-12-13 14:23:46', 'Berhasil'),
(8, 9, 'Zakat fitrah', '', '35000', '0', '', '2019-12-11 14:40:14', 'Belum Bayar'),
(9, 9, 'Zakat emas dan perak', '', '337500', '2.25', '', '2019-12-11 15:20:49', 'Belum Bayar'),
(10, 9, 'Zakat fitrah', '', '42000', '0', '', '2019-12-11 15:22:19', 'Belum Bayar'),
(11, 8, 'Zakat perniagaan', '', '56250', '2.25', '', '2019-12-11 16:47:51', 'Berhasil'),
(12, 8, 'Zakat ternak', '', '2 ekor unta betina, umur 2 tahun lebih', '0', '', '2019-12-11 16:50:06', 'Berhasil'),
(13, 9, 'Zakat emas dan perak', '', '101250', '2.25', 'emas', '2019-12-11 17:31:19', 'Belum Bayar'),
(14, 9, 'Zakat maadin atau rikaz _ maadin', '', '3375000', '22.5', '', '2020-01-16 13:16:08', 'Berhasil'),
(21, 8, 'Zakat penghasilan atau pendapatan', '', '225000', '0', '', '2019-11-13 01:00:46', 'Berhasil'),
(27, 7, 'Zakat perniagaan', '', '6250000', '10.05', '', '2020-01-11 18:23:23', 'Belum Bayar'),
(28, 8, 'Zakat perniagaan', '', '2500000', '4.02', '', '2020-02-12 09:21:12', 'Belum Bayar'),
(30, 7, 'Zakat perniagaan', '', '575000', '9.20', '', '2020-02-12 14:35:37', 'Berhasil'),
(31, 7, 'Zakat ternak', '', '2 ekor anak sapi betina/jantan, umur 1 tahun lebih', '0', '', '2020-03-10 14:02:00', 'Menunggu Konfirmasi'),
(32, 7, 'Zakat fitrah', 'Ridho,Wawan,', '75000', '0', '', '2020-03-11 14:42:06', 'Belum Bayar'),
(33, 8, 'Zakat fitrah', 'Eka,Riyani,Sri,', '108750', '0', '', '2020-04-01 12:16:32', 'Belum Bayar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `tagihanzakat`
--
ALTER TABLE `tagihanzakat`
  ADD PRIMARY KEY (`idTagihan`);

--
-- Indexes for table `zakat`
--
ALTER TABLE `zakat`
  ADD PRIMARY KEY (`idZakat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tagihanzakat`
--
ALTER TABLE `tagihanzakat`
  MODIFY `idTagihan` int(240) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zakat`
--
ALTER TABLE `zakat`
  MODIFY `idZakat` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
