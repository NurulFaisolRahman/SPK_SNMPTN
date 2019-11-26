-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2019 at 01:42 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `Akun`
--

CREATE TABLE `Akun` (
  `Id` int(2) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Akun`
--

INSERT INTO `Akun` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `DataSiswa`
--

CREATE TABLE `DataSiswa` (
  `NomorPendaftaran` varchar(50) NOT NULL,
  `NPSNSekolah` varchar(50) NOT NULL,
  `Minat` int(2) NOT NULL,
  `NilaiKeterampilan` varchar(30) DEFAULT NULL,
  `RangkingKelas` varchar(30) DEFAULT NULL,
  `Absensi` varchar(30) DEFAULT NULL,
  `Matematika` varchar(30) DEFAULT NULL,
  `Fisika` varchar(30) DEFAULT NULL,
  `Kimia` varchar(30) DEFAULT NULL,
  `Biologi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DataSiswa`
--

INSERT INTO `DataSiswa` (`NomorPendaftaran`, `NPSNSekolah`, `Minat`, `NilaiKeterampilan`, `RangkingKelas`, `Absensi`, `Matematika`, `Fisika`, `Kimia`, `Biologi`) VALUES
('1', '1', 6, '1', '1', '1', '2', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `Kriteria`
--

CREATE TABLE `Kriteria` (
  `IdKriteria` int(2) NOT NULL,
  `NamaKriteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Kriteria`
--

INSERT INTO `Kriteria` (`IdKriteria`, `NamaKriteria`) VALUES
(27, 'NilaiAkademik'),
(28, 'NilaiKeterampilan'),
(29, 'RangkingKelas'),
(30, 'Absensi');

-- --------------------------------------------------------

--
-- Table structure for table `Prodi`
--

CREATE TABLE `Prodi` (
  `IdProdi` int(2) NOT NULL,
  `NamaProdi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Prodi`
--

INSERT INTO `Prodi` (`IdProdi`, `NamaProdi`) VALUES
(6, 'Teknik Informatika'),
(7, 'Teknik Industri');

-- --------------------------------------------------------

--
-- Table structure for table `SubKriteria`
--

CREATE TABLE `SubKriteria` (
  `IdKriteria` int(2) NOT NULL,
  `IdSubKriteria` int(2) NOT NULL,
  `NamaSubKriteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SubKriteria`
--

INSERT INTO `SubKriteria` (`IdKriteria`, `IdSubKriteria`, `NamaSubKriteria`) VALUES
(27, 31, 'Matematika'),
(27, 32, 'Fisika'),
(27, 33, 'Kimia'),
(27, 34, 'Biologi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Akun`
--
ALTER TABLE `Akun`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Kriteria`
--
ALTER TABLE `Kriteria`
  ADD PRIMARY KEY (`IdKriteria`);

--
-- Indexes for table `Prodi`
--
ALTER TABLE `Prodi`
  ADD PRIMARY KEY (`IdProdi`);

--
-- Indexes for table `SubKriteria`
--
ALTER TABLE `SubKriteria`
  ADD PRIMARY KEY (`IdSubKriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Akun`
--
ALTER TABLE `Akun`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Kriteria`
--
ALTER TABLE `Kriteria`
  MODIFY `IdKriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Prodi`
--
ALTER TABLE `Prodi`
  MODIFY `IdProdi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `SubKriteria`
--
ALTER TABLE `SubKriteria`
  MODIFY `IdSubKriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
