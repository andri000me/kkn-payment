-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2020 at 09:11 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kkn_payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `idinfo` int(11) NOT NULL,
  `info_nama` varchar(128) NOT NULL,
  `info_isi` text NOT NULL,
  `create_at` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`idinfo`, `info_nama`, `info_isi`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'Batas Pembayaran', 'BATAS PEMBAYARAN KKN PERIODE KE 10 ADALAH 31 MARET 2020', 1580284603, 1, 0, 0),
(2, 'Konfirmasi Pembayaran', 'Anda hanya dapat melakukan konfirmasi pembayaran 1 kali, oleh sebab itu mohon lakukan dengan benar !. Jika ada kesalahan anda dapat menghubungi kami di 0988-9299-1234', 1580286489, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `idmahasiswa` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenjang` varchar(5) NOT NULL,
  `fakultas` varchar(128) NOT NULL,
  `program_studi` varchar(128) NOT NULL,
  `status_bayar` enum('Belum Bayar','Sudah Bayar') NOT NULL,
  `status` enum('Baru','Proses','Selesai') NOT NULL,
  `is_deleted` enum('false','true') DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `delete_at` int(11) NOT NULL,
  `delete_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`idmahasiswa`, `nim`, `nama_lengkap`, `jk`, `tempat_lahir`, `tanggal_lahir`, `jenjang`, `fakultas`, `program_studi`, `status_bayar`, `status`, `is_deleted`, `create_at`, `create_by`, `update_at`, `update_by`, `delete_at`, `delete_by`) VALUES
(1, '201552001', 'EKA SAPUTRA', 'L', '', '0000-00-00', 'D3', 'TEKNIK', 'D3 TEKNIK KOMPUTER', 'Sudah Bayar', 'Selesai', '', 1580077606, 1, 1580291617, 1, 0, 0),
(2, '201552002', 'EKA SAPUTRA 1', 'P', '', '0000-00-00', 'S1', 'SASTRA', 'S1 SASTRA INDONESIA', 'Sudah Bayar', 'Proses', '', 1580077606, 1, 0, 0, 0, 0),
(3, '201552003', 'EKA SAPUTRA 2', 'L', '', '0000-00-00', 'S2', 'EKONOMI', 'S2 PEMBANGUNAN', 'Sudah Bayar', 'Proses', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(4, '201552004', 'EKA SAPUTRA 3', 'P', '', '0000-00-00', 'D3', 'PETERNAKAN', 'D3 PETERNAKAN', 'Belum Bayar', 'Baru', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(5, '201552005', 'EKA SAPUTRA 4', 'P', '', '0000-00-00', 'D4', 'PERTANIAN', 'D4 PERTANIAN', 'Belum Bayar', 'Baru', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(6, '201552006', 'EKA SAPUTRA 5', 'L', '', '0000-00-00', 'D2', 'KEHUTANAN', 'D2 KEHUTANAN', 'Belum Bayar', 'Baru', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(7, '201552007', 'EKA SAPUTRA 6', 'P', '', '0000-00-00', 'D1', 'KEDOKTERAN', 'D1 PERAWAT', 'Belum Bayar', 'Baru', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(8, '201552008', 'EKA SAPUTRA 7', 'L', '', '0000-00-00', 'S1', 'HUKUM', 'S1 HUKUM NEGARA', 'Sudah Bayar', 'Proses', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(9, '201552009', 'EKA SAPUTRA 8', 'L', '', '0000-00-00', 'D3', 'TEKNIK', 'D3 TEKNIK KOMPUTER', 'Sudah Bayar', 'Proses', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(10, '201552010', 'EKA SAPUTRA 9', 'P', '', '0000-00-00', 'D4', 'KEHUTANAN', 'D4 LINGKUNGAN', 'Belum Bayar', 'Baru', 'false', 1580077606, 1, 0, 0, 1580143512, 1),
(11, '201452001', 'EKA SAPUTRA', 'L', 'BINTUNI', '2020-01-28', 'S1', 'TEKNIK', 'TEKNIK KOMPUTER', 'Belum Bayar', 'Baru', 'false', 1580079339, 1, 0, 0, 1580143512, 1),
(13, '201252001', 'HELMI SAPUTRA', 'L', 'MANOKWARI', '2020-01-13', 'D3', 'TEKNIK', 'TEKNIK KOMPUTER', 'Sudah Bayar', 'Selesai', '', 1580132086, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idbayar` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `rek_id` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bukti` varchar(128) NOT NULL,
  `is_verified` enum('no','yes') NOT NULL,
  `create_at` int(11) NOT NULL,
  `create_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idbayar`, `mahasiswa_id`, `rek_id`, `total_bayar`, `bukti`, `is_verified`, `create_at`, `create_by`) VALUES
(1, 1, 1, 1000000, 'bukti-1580223913.jpg', 'yes', 1580252713, 1),
(2, 2, 2, 1000000, 'bukti-201552002-1580252656.jpg', 'yes', 1580281456, 2),
(3, 8, 1, 1000000, 'bukti-201552008-1580255432.jpg', 'yes', 1580284232, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `idrek` int(11) NOT NULL,
  `rek_bank` varchar(128) NOT NULL,
  `rek_nama` varchar(128) NOT NULL,
  `rek_nomor` varchar(50) NOT NULL,
  `create_at` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`idrek`, `rek_bank`, `rek_nama`, `rek_nomor`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'Bank Mandiri', 'UNIVERSITAS PAPUA', '12344-124124-14-42', 1580237604, 1, 0, 0),
(2, 'Bank BRI', 'UNIVERSITAS PAPUA', '124124124-124124-2424-4-4', 1580238279, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_group` varchar(100) NOT NULL,
  `setting_variable` varchar(255) DEFAULT NULL,
  `setting_value` text,
  `setting_default` text,
  `setting_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_group`, `setting_variable`, `setting_value`, `setting_default`, `setting_description`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'general', 'app_name', 'KKNPayment', 'Nokencode', 'Nama Aplikasi', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(2, 'general', 'tagline', 'Sistem Informasi Pembayaran KKN', 'Jasa Pembuatan Aplikasi dan Website', 'Tagline', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(3, 'general', 'favicon', 'favicon-1580176562.png', 'icon.png', 'Favicon', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(4, 'general', 'meta_keywords', NULL, 'kkn payment, kkn, pembayaran kkn', 'Kata Kunci Pencarian', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(5, 'general', 'meta_description', NULL, 'Aplikasi Pembayaran KKN Merupakan Aplikasi Untuk Manajemen Pembayaran KKN', 'Keterangan Website', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(6, 'general', 'file_allowed_types', 'jpg|jpeg|png|gif|bmp', 'jpg|png|gif', 'File Yang Diizinkan', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(7, 'general', 'timezone', NULL, 'Asia/Jayapura', 'Zona Waktu', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(8, 'general', 'upload_max_filesize', '2048', '2000', 'Maksimal Ukuran File (kb)', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(9, 'company_profile', 'street_address', NULL, 'Jalur 5 SP 1 Kampung Waraitama', 'Alamat Jalan', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(10, 'company_profile', 'phone', NULL, '+62 822 4857 7297', 'Telepon', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(11, 'company_profile', 'fax', NULL, '0232123456', 'Fax', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(12, 'company_profile', 'email', NULL, 'nokencode@gmail.com', 'Email', '2018-04-02 01:51:58', '2019-10-28 01:52:31', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(13, 'company_profile', 'website', NULL, 'https://nokencode.com', 'Website', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `user_fullname` varchar(128) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `user_type` enum('super_user','administrator','user') DEFAULT NULL,
  `last_loggin` int(11) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `is_block` int(1) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `delete_at` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `user_name`, `user_password`, `user_fullname`, `user_telp`, `user_type`, `last_loggin`, `ip_address`, `is_active`, `is_block`, `create_at`, `update_at`, `delete_at`, `create_by`, `update_by`, `delete_by`) VALUES
(1, 'admin', '$2y$10$h6Mas3QjJTZgIfQH5jFiYOdsXKhzP0M08oVD.DXExrn.mA8RshOJa', 'KKNPayment', '082248577297', 'super_user', 1579819716, '::1', 1, 0, 1556509343, 1580306578, NULL, 1, 1, NULL),
(7, '12345', '$2y$10$web6MQFKooLIbKPue2A0/O/.eKSzNIWsv5gCtnsp18WRumW3CtnIS', 'Eka Saputra', '082248577297', 'administrator', NULL, NULL, 1, 0, 1580293465, 1580298662, NULL, 1, 7, NULL),
(8, '123', '$2y$10$XhaGOd2wM.jiB8ixjnyzgeM4J4n3dGPrpDlNTxbg/WrsIjWLlGhM.', 'Eka Saputra', '082248577297', 'user', NULL, NULL, 1, 0, 1580293507, 1580294962, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_sessions`
--

CREATE TABLE `_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_sessions`
--

INSERT INTO `_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0ed64d1e3400e0b33a121a39224f4cc718357bc3', '::1', 1580127853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303132373833313b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('2084b14cfd385566bd34441996dfd4fdc6de219a', '::1', 1580212678, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303231323537303b),
('3020c48659b1ef00db3896bbaa3c4e97d85be9da', '::1', 1580052557, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303035323535373b),
('3f7b7339a9b4f63f1f81820dbcc05e19a2f1c7c1', '::1', 1580183642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303138333634323b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('7bf6749ecb0d109134060200ffb1a1e2cbbf1481', '::1', 1580083429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303038333138393b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('81e8377553668410584ce768fa291dc4dd2de2a3', '::1', 1580117525, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303131373530303b),
('87a54a18e6d44deb8c99e2751077d2e2f490eb4e', '::1', 1580280841, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303238303834313b),
('d8a48a04b198a15eca1df2495d986cd63bb6716b', '::1', 1580225737, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303232353733373b);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`idinfo`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`idmahasiswa`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idbayar`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`idrek`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_field` (`setting_group`,`setting_variable`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- Indexes for table `_sessions`
--
ALTER TABLE `_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_TIMESTAMP` (`timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `idinfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `idmahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idbayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `idrek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
