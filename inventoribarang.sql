-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventoribarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id_keluar` int(11) NOT NULL,
  `kode_keluar` varchar(100) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `tanggal_keluar` date NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('dipinjam','selesai','ditolak') DEFAULT 'dipinjam',
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`id_keluar`, `kode_keluar`, `id_barang`, `jumlah`, `harga`, `total`, `tanggal_keluar`, `id_user`, `keterangan`, `status`, `id_pelanggan`) VALUES
(151, 'TRK-20250607-002', 97, 2, 2.00, 4.00, '2025-06-07', 27, '', 'selesai', 14);

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_masuk` int(11) NOT NULL,
  `kode_masuk` varchar(100) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `tanggal_masuk` date NOT NULL DEFAULT current_timestamp(),
  `id_supplier` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id_masuk`, `kode_masuk`, `id_barang`, `jumlah`, `harga`, `total`, `tanggal_masuk`, `id_supplier`, `keterangan`, `id_user`) VALUES
(296, 'TRM-20250607-001', 97, 12, 40000.00, 480000.00, '2025-06-07', 4, '', 27),
(297, 'TRM-20250607-001', 107, 4, 24000.00, 96000.00, '2025-06-07', 4, '', 27),
(305, 'TRM-20250607-002', 99, 4, 44.00, 176.00, '2025-06-08', 3, '', 27);

-- --------------------------------------------------------

--
-- Table structure for table `databarang`
--

CREATE TABLE `databarang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`id_barang`, `nama_barang`, `id_jenis`, `id_satuan`, `stok`, `tanggal_ditambahkan`, `id_supplier`) VALUES
(97, 'Alkohol', 15, 163, 12, '2025-05-15 12:35:34', 3),
(98, 'RWH', 15, 163, 0, '2025-05-15 12:36:30', 4),
(99, 'Spargum', 15, 163, 4, '2025-05-15 12:58:41', 3),
(100, 'Plat Cleanser', 15, 163, 0, '2025-05-15 13:00:53', 3),
(101, 'Spray Powder', 15, 163, 0, '2025-05-15 13:01:52', 4),
(102, 'ABC', 15, 163, 0, '2025-05-15 13:02:10', 4),
(103, 'Spontek', 15, 163, 0, '2025-05-15 13:02:19', 4),
(104, 'Tinta Yellow', 15, 163, 0, '2025-05-15 13:03:41', 4),
(105, 'Tinta Magenta', 15, 163, 0, '2025-05-15 13:06:55', 3),
(106, 'Tinta Black', 15, 163, 0, '2025-05-15 13:07:19', 3),
(107, 'Tinta Cyan', 15, 163, 6, '2025-05-15 13:07:28', 4),
(108, 'TC 700 White', 15, 163, 0, '2025-05-15 13:07:45', 3),
(110, 'TC 3005 Reflek Blue', 15, 163, 0, '2025-05-15 13:08:30', 3),
(111, 'TC 6409 Silver', 15, 163, 0, '2025-05-15 13:08:43', 4),
(112, 'Vanish', 15, 163, 0, '2025-05-15 13:08:56', 3),
(113, 'Blanket', 15, 163, 0, '2025-05-15 13:09:07', 3),
(114, 'Founten', 15, 163, 0, '2025-05-15 13:09:18', 3),
(115, 'Developer', 14, 163, 0, '2025-05-15 13:10:12', 3),
(116, 'Plat 52', 14, 163, 0, '2025-05-15 13:10:29', 3),
(117, 'Plat 74', 14, 163, 0, '2025-05-15 13:10:38', 4),
(118, 'Plat GTO', 14, 163, 0, '2025-05-15 13:10:56', 4),
(119, 'Plat Gestener', 14, 163, 0, '2025-05-15 13:11:11', 3),
(120, 'Plat MO', 14, 163, 0, '2025-05-15 13:11:20', 3),
(121, 'Plat  Toko', 14, 163, 0, '2025-05-15 13:11:37', 3),
(122, 'Plat 66', 14, 163, 0, '2025-05-15 13:11:54', 3),
(123, 'Gum', 14, 163, 0, '2025-05-15 13:12:06', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`id_jenis`, `nama_jenis`, `deskripsi`) VALUES
(14, 'CTP', NULL),
(15, 'CETAK', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telepon`, `alamat`) VALUES
(5, '2', '0', '2'),
(6, 'ss', '', 's'),
(9, 's', '', 's'),
(11, 'w', '', 'w'),
(13, 'w', '', 'w'),
(14, 'ebi', '', 's');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(163, 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `telepon`, `email`, `tanggal_dibuat`) VALUES
(3, 'PT. Artha Gemilang', 'd', '08810246666686757', 'rayandika10@gmail.com', '2025-05-01 20:20:59'),
(4, 'PT. Ngalor Ngidul', 'JL. Rawa Simprug 9 No.33', '0881024686757', 'wkwkk@gmail.com', '2025-05-24 06:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','users') NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `nama_lengkap`) VALUES
(27, 'rayandika', '$2y$10$x1hpey3vPseBVSaeQP6Qz.k2WoNGb69hr/RLUc1pLGA8qoXqEuISa', 'admin', 'WILI'),
(44, 'ebi', 'ebi', 'users', 'ebi'),
(45, 'tt', 't', 'users', 'tt'),
(48, 'rayan', 'rayan', 'admin', 'rayan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`) USING BTREE;

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`) USING BTREE,
  ADD KEY `id_supplier` (`id_supplier`) USING BTREE,
  ADD KEY `fk_barangmasuk_user` (`id_user`);

--
-- Indexes for table `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_supplier` (`id_supplier`) USING BTREE;

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `databarang`
--
ALTER TABLE `databarang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD CONSTRAINT `barangkeluar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `barangkeluar_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `databarang` (`id_barang`),
  ADD CONSTRAINT `fk_barangkeluar_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barangmasuk_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `databarang` (`id_barang`),
  ADD CONSTRAINT `fk_barangmasuk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `databarang`
--
ALTER TABLE `databarang`
  ADD CONSTRAINT `databarang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenisbarang` (`id_jenis`),
  ADD CONSTRAINT `databarang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`),
  ADD CONSTRAINT `fk_databarang_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
