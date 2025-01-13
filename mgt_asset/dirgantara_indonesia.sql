-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 01:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dirgantara_indonesia`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_employe`
--

CREATE TABLE `detail_employe` (
  `id_detail_employe` int(11) NOT NULL,
  `employe_nik` int(20) NOT NULL,
  `employe_name` varchar(100) NOT NULL,
  `c_org` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_type_kategori` int(11) NOT NULL,
  `processor` varchar(50) NOT NULL,
  `storage_capacity` int(20) NOT NULL,
  `memory_capacity` int(20) NOT NULL,
  `vga_capacity` int(20) NOT NULL,
  `nomor_it` varchar(20) NOT NULL,
  `nomor_aset` varchar(20) NOT NULL,
  `serial_number` varchar(20) NOT NULL,
  `storage_type` varchar(50) NOT NULL,
  `memory_type` varchar(50) NOT NULL,
  `vga_type` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `operation_system` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `os_licence` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `aplikasi_lainnya` varchar(50) NOT NULL,
  `status_pengalihan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_employe`
--

INSERT INTO `detail_employe` (`id_detail_employe`, `employe_nik`, `employe_name`, `c_org`, `lokasi`, `id_kategori`, `id_type_kategori`, `processor`, `storage_capacity`, `memory_capacity`, `vga_capacity`, `nomor_it`, `nomor_aset`, `serial_number`, `storage_type`, `memory_type`, `vga_type`, `keterangan`, `operation_system`, `office`, `os_licence`, `os`, `aplikasi_lainnya`, `status_pengalihan`) VALUES
(39, 130013, 'Edi Prasetyo', 'IT0000', 'IT LT.Dasar', 7, 42, '17', 1000, 16384, 1024, 'IT-00001', '1270003472', '-', '21', '23', '25', '-', '38', '35', '46', '47', '-', 0),
(41, 140105, 'Fani Permana Putra', 'IT0000', 'IT LT.Dasar', 1, 39, '44', 1000, 1000, 1000, 'IT-00002', '1270003471', '-', '21', '23', '25', '-', '38', '35', '47', '47', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Laptop'),
(6, 'Processor'),
(7, 'PC Desktop'),
(8, 'AIO PC'),
(9, 'Storage Type'),
(10, 'Memory Type'),
(11, 'VGA Type'),
(12, 'Operation System'),
(13, 'Office'),
(14, 'License');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(2, 'ALL'),
(3, 'KDV'),
(4, 'KDP'),
(5, 'KBD'),
(7, 'STF');

-- --------------------------------------------------------

--
-- Table structure for table `master_employee`
--

CREATE TABLE `master_employee` (
  `id_pengguna` int(11) NOT NULL,
  `employe_nik` int(11) NOT NULL,
  `employe_name` varchar(50) NOT NULL,
  `c_org` varchar(50) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_employee`
--

INSERT INTO `master_employee` (`id_pengguna`, `employe_nik`, `employe_name`, `c_org`, `id_level`) VALUES
(27, 140105, 'Fani Permana Putra', 'IT0000', 7),
(28, 130013, 'Edi Prasetyo', 'IT0000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `id_org` int(11) NOT NULL,
  `c_org` varchar(50) NOT NULL,
  `c_org_parent` varchar(50) NOT NULL,
  `n_org` varchar(100) NOT NULL,
  `e_org` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`id_org`, `c_org`, `c_org_parent`, `n_org`, `e_org`) VALUES
(3, 'HD0000', 'DU0000', 'DIVISI PENGEMBANGAN SUMBER DAYA MANUSIA', 'DIVISI PENGEMBANGAN SUMBER DAYA MANUSIA'),
(4, 'HD0100', 'HD0000', 'BIDANG MANAGEMENT PENGETAHUAN', 'BIDANG MANAGEMENT PENGETAHUAN'),
(10, 'IT0000', 'IT1000', 'MANAJEMENT ASSET DAN TATA KELOLA', 'MANAJEMENT ASSET ');

-- --------------------------------------------------------

--
-- Table structure for table `type_kategori`
--

CREATE TABLE `type_kategori` (
  `id_type_kategori` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_kategori`
--

INSERT INTO `type_kategori` (`id_type_kategori`, `id_kategori`, `nama_type`) VALUES
(9, 1, 'Asus'),
(17, 6, 'intel core i5'),
(21, 9, 'Hard Disk Drives'),
(23, 10, 'Mask Rom'),
(25, 11, 'VRAM'),
(31, 7, 'Samsung'),
(32, 12, 'Asus'),
(33, 13, 'Asus'),
(34, 14, 'HP'),
(35, 13, 'oppo'),
(36, 12, 'vivo'),
(37, 14, 'Asus'),
(38, 12, 'Windows 11'),
(39, 1, 'Dell'),
(42, 7, 'HP PRODESK 400 G1 SFF'),
(43, 7, 'HP PRODESK 400 G2 MT'),
(44, 6, 'Intel core i5 - 4570 @3.20GHz'),
(45, 6, ' Intel Core I7-4770, 3,40GHz'),
(46, 14, 'GENUINE'),
(47, 14, 'NOT GENUINE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_employe`
--
ALTER TABLE `detail_employe`
  ADD PRIMARY KEY (`id_detail_employe`),
  ADD KEY `nomor_it` (`nomor_it`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `master_employee`
--
ALTER TABLE `master_employee`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `employe_nik` (`employe_nik`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`id_org`);

--
-- Indexes for table `type_kategori`
--
ALTER TABLE `type_kategori`
  ADD PRIMARY KEY (`id_type_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_employe`
--
ALTER TABLE `detail_employe`
  MODIFY `id_detail_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_employee`
--
ALTER TABLE `master_employee`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type_kategori`
--
ALTER TABLE `type_kategori`
  MODIFY `id_type_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
