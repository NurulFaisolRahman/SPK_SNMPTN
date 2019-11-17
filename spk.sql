-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2019 at 04:28 PM
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
  `IND` varchar(30) DEFAULT NULL,
  `ING` varchar(30) DEFAULT NULL,
  `MAT` varchar(30) DEFAULT NULL,
  `Prestasi` varchar(30) DEFAULT NULL,
  `Akreditasi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DataSiswa`
--

INSERT INTO `DataSiswa` (`NomorPendaftaran`, `NPSNSekolah`, `Minat`, `IND`, `ING`, `MAT`, `Prestasi`, `Akreditasi`) VALUES
('V180k6c3a18W7oaiP9XH7', 'H2sLaa0ttCzDC-_YyMusZ', 6, '85', '84', '86', NULL, NULL),
('a6kjpVtY61jk5h3SLOtw2', 'uO_WhwyuecayvKVVMAYts', 6, '88', '90', '87', NULL, NULL),
('KIT8LwxO_Hn2DUv0lbh1m', 'mQfzfULtYmD29Ybz5Vt-2', 6, '85', '85', '89', NULL, NULL);

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
(21, 'MataPelajaran'),
(25, 'Akreditasi'),
(26, 'Prestasi');

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
(21, 16, 'IND'),
(21, 17, 'ING'),
(21, 18, 'MAT');

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
  MODIFY `IdKriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Prodi`
--
ALTER TABLE `Prodi`
  MODIFY `IdProdi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `SubKriteria`
--
ALTER TABLE `SubKriteria`
  MODIFY `IdSubKriteria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
