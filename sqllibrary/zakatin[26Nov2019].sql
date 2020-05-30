-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 06:36 PM
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

INSERT INTO `akun` (`idUser`, `username`, `password`, `namaLengkap`, `telepon`, `alamat`, `pekerjaan`, `levelUser`, `penghasilan`, `statusKelengkapan`, `joinAt`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3', 'Administrator', '085284471000', 'Pekanbaru, Riau.', 'Dosen Politeknik Caltex Riau', '2', 0, 1, '2019-11-13 01:38:36'),
(7, 'eka', '79ee82b17dfb837b1be94a6827fa395a', '', '62852643928', '', '', '0', 0, 0, '2019-11-13 18:51:26'),
(8, 'ridho', '926a161c6419512d711089538c80ac70', '', '6285264397615', '', '', '10', 0, 0, '2019-11-17 12:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `zakat`
--

CREATE TABLE `zakat` (
  `idZakat` int(40) NOT NULL,
  `idAkun` int(30) NOT NULL,
  `jenisZakat` varchar(100) NOT NULL,
  `nominalZakat` varchar(250) NOT NULL,
  `beratPerhiasan` varchar(100) NOT NULL DEFAULT '0',
  `tglBerzakat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusZakat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zakat`
--

INSERT INTO `zakat` (`idZakat`, `idAkun`, `jenisZakat`, `nominalZakat`, `beratPerhiasan`, `tglBerzakat`, `statusZakat`) VALUES
(2, 7, 'Zakat penghasilan atau pendapatan', '132500', '0', '2019-11-24 23:48:46', 'Belum Bayar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idUser`);

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
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zakat`
--
ALTER TABLE `zakat`
  MODIFY `idZakat` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
