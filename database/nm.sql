-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 03:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '12345678', 'Indomie Bakar', 30000, 50000, 135, 'dus', 100, 'BRG-001.jpg'),
('BRG-002', '12345679', 'Kopi Kapal Air', 20000, 40000, 120, 'dus', 100, 'BRG-002.jpg'),
('BRG-003', '12345671', 'Kecap Uasin', 3000, 5000, 100, 'botol', 100, 'BRG-003.jpg'),
('BRG-004', '12345672', 'Kopi Tubruk Mobil', 5000, 10000, 110, 'buah', 100, 'BRG-004.jpg'),
('BRG-005', '12345673', 'Larutan Cap Tangan 3', 4000, 7000, 110, 'kaleng', 100, 'BRG-005.jpg'),
('BRG-006', '12345674', 'Sarden Ayam', 5000, 15000, 150, 'kaleng', 100, 'BRG-006.jpg'),
('BRG-007', '12345675', 'Sarimi Isi 2 Setengah', 3000, 7000, 90, 'buah', 100, 'BRG-007.jpg'),
('BRG-008', '12345676', 'Sirup Jeruk Bali', 15000, 20000, 80, 'botol', 100, 'BRG-008.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(7, '', '', '', ''),
(8, 'Edo Gaming', '0843634563554', 'Kakean Utang', 'Jalan Gedang Gondal Gandul GG.Gaming'),
(9, 'Dimas Ukin Anjay', '089999875456', '                            Dimas Ukin', '                            Jalan Bol Lancar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_detail`
--

CREATE TABLE `tbl_jual_detail` (
  `id` int(11) NOT NULL,
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jual_detail`
--

INSERT INTO `tbl_jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(17, 'PJ0001', '2024-02-19', '12345679', 'Kopi Kapal Air', 20, 40000, 800000),
(18, 'PJ0001', '2024-02-19', '12345678', 'Indomie Bakar', 10, 50000, 500000),
(19, 'PJ0002', '2024-02-19', '12345671', 'Kecap Uasin', 40, 5000, 200000),
(20, 'PJ0002', '2024-02-19', '12345675', 'Sarimi Isi 2 Setengah', 10, 7000, 70000),
(21, 'PJ0003', '2024-02-14', '12345673', 'Larutan Cap Tangan 3', 10, 7000, 70000),
(22, 'PJ0003', '2024-02-14', '12345674', 'Sarden Ayam', 50, 15000, 750000),
(23, 'PJ0004', '2024-02-19', '12345671', 'Kecap Uasin', 10, 5000, 50000),
(24, 'PJ0004', '2024-02-19', '12345673', 'Larutan Cap Tangan 3', 5, 7000, 35000),
(25, 'PJ0005', '2024-02-20', '12345678', 'Indomie Bakar', 10, 50000, 500000),
(26, 'PJ0005', '2024-02-20', '12345671', 'Kecap Uasin', 5, 5000, 25000),
(27, 'PJ0005', '2024-02-20', '12345679', 'Kopi Kapal Air', 2, 40000, 80000),
(28, 'PJ0006', '2024-02-07', '12345671', 'Kecap Uasin', 25, 5000, 125000),
(29, 'PJ0007', '2024-02-22', '12345671', 'Kecap Uasin', 10, 5000, 50000),
(30, 'PJ0007', '2024-02-22', '12345672', 'Kopi Tubruk Mobil', 5, 10000, 50000),
(31, 'PJ0007', '2024-02-22', '12345673', 'Larutan Cap Tangan 3', 7, 7000, 49000),
(32, 'PJ0008', '2024-02-22', '12345671', 'Kecap Uasin', 10, 5000, 50000),
(33, 'PJ0009', '2024-02-23', '123456788', 'Bimoli ', 20, 20000, 400000),
(34, 'PJ0009', '2024-02-23', '12345671', 'Kecap Uasin', 10, 5000, 50000),
(35, 'PJ0010', '2024-02-23', '12345671', 'Kecap Uasin', 10, 5000, 50000),
(40, 'PJ0011', '2024-02-27', '12345672', 'Kopi Tubruk Mobil', 10, 10000, 100000),
(41, 'PJ0011', '2024-02-27', '12345673', 'Larutan Cap Tangan 3', 8, 7000, 56000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `customer` varchar(256) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `customer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2024-02-19', '', 1300000, '', 1500000, 200000),
('PJ0002', '2024-02-19', '', 270000, 'Edo haram', 300000, 30000),
('PJ0003', '2024-02-14', 'Edo Gaming', 820000, '', 900000, 80000),
('PJ0004', '2024-02-19', '', 85000, '', 100000, 15000),
('PJ0005', '2024-02-20', 'Edo Gaming', 605000, 'Edo Haram', 650000, 45000),
('PJ0006', '2024-02-07', '', 125000, '', 150000, 25000),
('PJ0007', '2024-02-22', '', 149000, '', 200000, 51000),
('PJ0008', '2024-02-22', '', 50000, '', 50000, 0),
('PJ0009', '2024-02-23', '', 450000, 'Dimas Ukin', 500000, 50000),
('PJ0010', '2024-02-23', '', 50000, '', 70000, 20000),
('PJ0011', '2024-02-27', '', 156000, '', 200000, 44000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok`
--

CREATE TABLE `tbl_stok` (
  `no_stok` varchar(20) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tgl_stok` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stok`
--

INSERT INTO `tbl_stok` (`no_stok`, `user`, `tgl_stok`) VALUES
('TS0001', 'Bang Eka', '2024-02-19'),
('TS0002', 'Bang Eka', '2024-02-20'),
('TS0003', 'Bang Eko', '2024-02-20'),
('TS0004', 'Bang Eka', '2024-02-22'),
('TS0005', 'Bang Eka', '2024-02-23'),
('TS0006', 'Bang Eka', '2024-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok_detail`
--

CREATE TABLE `tbl_stok_detail` (
  `id` int(11) NOT NULL,
  `no_stok` varchar(20) NOT NULL,
  `tgl_stok` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stok_detail`
--

INSERT INTO `tbl_stok_detail` (`id`, `no_stok`, `tgl_stok`, `kode_brg`, `nama_brg`, `satuan`, `qty`) VALUES
(32, 'TS0001', '2024-02-19', 'BRG-001', 'Indomie Bakar', 'dus', 150),
(33, 'TS0001', '2024-02-19', 'BRG-002', 'Kopi Kapal Air', 'dus', 120),
(34, 'TS0001', '2024-02-19', 'BRG-003', 'Kecap Uasin', 'botol', 130),
(35, 'TS0001', '2024-02-19', 'BRG-004', 'Kopi Tubruk Mobil', 'buah', 100),
(36, 'TS0001', '2024-02-19', 'BRG-005', 'Larutan Cap Tangan 3', 'kaleng', 90),
(37, 'TS0001', '2024-02-19', 'BRG-006', 'Sarden Ayam', 'kaleng', 200),
(38, 'TS0001', '2024-02-19', 'BRG-007', 'Sarimi Isi 2 Setengah', 'buah', 100),
(39, 'TS0001', '2024-02-19', 'BRG-008', 'Sirup Jeruk Bali', 'botol', 80),
(41, 'TS0002', '2024-02-20', 'BRG-001', 'Indomie Bakar', 'dus', 1),
(42, 'TS0003', '2024-02-20', 'BRG-002', 'Kopi Kapal Air', 'dus', 23),
(43, 'TS0003', '2024-02-20', 'BRG-003', 'Kecap Uasin', 'botol', 50),
(44, 'TS0004', '2024-02-22', 'BRG-003', 'Kecap Uasin', 'botol', 40),
(45, 'TS0005', '2024-02-23', 'BRG-009', 'Bimoli ', 'botol', 120),
(46, 'TS0006', '2024-02-27', 'BRG-004', 'Kopi Tubruk Mobil', 'buah', 30),
(47, 'TS0006', '2024-02-27', 'BRG-005', 'Larutan Cap Tangan 3', 'kaleng', 50),
(48, 'TS0006', '2024-02-27', 'BRG-001', 'Indomie Bakar', 'dus', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1-administrator\r\n2-kasir',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(11, 'eka', 'Bang Eka', '$2y$10$fGnAWcO/2IT1l3a7wZuzPOQEdT6tqIl2CxZOsqwdLbcb3GcvgAzKu', 'Jalan Sana Sini', 1, '880-eko.png'),
(13, 'eko', 'Bang Eko', '$2y$10$aMXGw8H7KD7slrMGaTpubuS/g.muNeolsTfPaWsy.UtmN4tYBRjdG', 'Jalan Duren Guede Cik', 2, 'user.png'),
(14, 'oke', 'Bang Oke', '$2y$10$jDXRAiImp7eCHt00OnIWV.htSZGAcMYE3fqhJYJMSsdcP.TOho3gy', 'Jalan Buntu', 2, '177-Crocodile Logo.jpg'),
(15, 'age', 'age', '$2y$10$Gu6HHTnEaCce4Rf3fV5BjOulF4XYaOwrEDmfATIoJzcr4JthRPzbK', 'Jalan Kucing Evos Rawrr', 1, '240-Ryuki Survive.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indexes for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  ADD PRIMARY KEY (`no_stok`);

--
-- Indexes for table `tbl_stok_detail`
--
ALTER TABLE `tbl_stok_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_stok_detail`
--
ALTER TABLE `tbl_stok_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
