-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 09:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_intent`
--

CREATE TABLE `tb_intent` (
  `id` int(100) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_intent`
--

INSERT INTO `tb_intent` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'kategori', '2024-05-15 12:56:20', '2024-05-15 12:56:20'),
(2, 'pattern', '2024-05-15 12:56:20', '2024-05-15 12:56:20'),
(3, 'response', '2024-05-15 12:56:20', '2024-05-15 12:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_type` int(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `id_type`, `kategori`, `created_at`, `updated_at`) VALUES
(3, 1, 'salam', '2024-05-20 09:23:55', '2024-05-20 09:23:55'),
(4, 1, 'bayar modul praktikum', '2024-05-20 09:23:55', '2024-05-20 09:23:55'),
(5, 1, 'bank', '2024-06-06 14:45:13', '2024-06-15 01:46:57'),
(7, 1, 'aktivasi', '2024-06-06 15:10:11', '2024-06-06 15:10:11'),
(8, 1, 'respon admin', '2024-06-06 15:39:57', '2024-06-06 15:39:57'),
(10, 1, 'bayar di bank kampus 4 UAD', '2024-06-10 14:45:51', '2024-06-10 14:45:51'),
(12, 1, 'bayar transfer ATM/Mbanking', '2024-06-10 14:51:12', '2024-06-10 14:51:12'),
(13, 1, 'sapaan', '2024-06-12 20:55:33', '2024-06-12 20:55:33'),
(14, 1, 'selamat tinggal', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(15, 1, 'lupa digit nim', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(16, 1, 'pin', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(17, 1, 'lupa akun reglab', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(18, 1, 'prosedur pendaftaran', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(19, 1, 'pesan error', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(20, 1, 'daftar praktikum', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(21, 1, 'kendala pendaftaran praktikum\r\n\r\n', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(22, 1, 'kendala pendaftaran akun', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(23, 1, 'perbaiki mata praktikum', '2024-06-12 22:46:48', '2024-06-12 22:46:48'),
(24, 1, 'kartu kuning', '2024-06-12 23:05:52', '2024-06-12 23:05:52'),
(26, 1, 'pinjam lab', '2024-06-12 23:05:52', '2024-06-12 23:05:52'),
(27, 1, 'pinjam alat\r\n', '2024-06-12 23:05:52', '2024-06-12 23:05:52'),
(28, 1, 'pinjam ruangan', '2024-06-12 23:05:52', '2024-06-12 23:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pattern`
--

CREATE TABLE `tb_pattern` (
  `id_pattern` int(100) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pattern` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pattern`
--

INSERT INTO `tb_pattern` (`id_pattern`, `id_type`, `id_kategori`, `pattern`, `created_at`, `updated_at`) VALUES
(11, 2, 3, 'assalamualaikum', '2024-05-20 10:36:04', '2024-05-20 10:36:04'),
(12, 2, 3, 'salam', '2024-05-20 10:36:04', '2024-05-20 10:36:04'),
(14, 2, 4, 'cara bayar', '2024-05-20 10:38:18', '2024-05-20 10:38:18'),
(15, 2, 4, 'pilih bayar', '2024-05-20 10:38:18', '2024-05-20 10:38:18'),
(18, 2, 7, 'aktivasi', '2024-06-06 15:15:24', '2024-06-12 16:12:22'),
(21, 2, 8, 'respon', '2024-06-06 15:46:06', '2024-06-06 15:46:06'),
(24, 2, 12, 'transfer antar bank', '2024-06-10 14:54:53', '2024-06-10 14:54:53'),
(32, 1, 7, 'aktivasi praktikum', '2024-06-12 16:19:12', '2024-06-12 16:19:12'),
(35, 1, 13, 'hallo', '2024-06-12 21:00:31', '2024-06-12 21:00:31'),
(36, 1, 13, 'selamat pagi', '2024-06-12 21:01:49', '2024-06-12 21:01:49'),
(37, 1, 13, 'selamat malam', '2024-06-12 21:02:05', '2024-06-12 21:02:05'),
(40, 1, 12, 'transfer', '2024-06-12 21:12:12', '2024-06-12 21:12:12'),
(41, 1, 13, 'selamat sore', '2024-06-12 21:12:32', '2024-06-12 21:12:32'),
(42, 1, 10, 'bayar bank kampus', '2024-06-12 21:13:04', '2024-06-12 21:13:04'),
(45, 1, 13, 'hai', '2024-06-12 21:44:11', '2024-06-12 21:44:11'),
(46, 1, 13, 'halo', '2024-06-12 21:44:48', '2024-06-12 21:44:48'),
(49, 2, 4, 'bayar praktikum', '2024-06-12 22:12:37', '2024-06-12 22:12:37'),
(52, 2, 12, 'cara transfer', '2024-06-12 22:15:15', '2024-06-12 22:15:15'),
(53, 2, 12, 'mbanking', '2024-06-12 22:15:15', '2024-06-12 22:15:15'),
(54, 2, 12, 'atm', '2024-06-12 22:15:15', '2024-06-12 22:15:15'),
(73, 2, 14, 'bye', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(74, 2, 14, 'selamat tinggal\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(75, 2, 14, 'oke', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(77, 2, 15, 'lupa serta nim\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(78, 2, 15, 'tidak serta nim', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(79, 2, 15, 'tidak masuk nim', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(80, 2, 16, 'kode pin\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(81, 2, 16, 'apa kode pin', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(82, 2, 16, 'mana kode pin', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(83, 2, 17, 'akun lupa\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(84, 2, 17, 'lupa akun', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(85, 2, 17, 'lupa password', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(87, 2, 18, 'prosedur', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(89, 2, 19, 'error\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(90, 2, 19, 'alert error', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(91, 2, 20, 'daftar praktikum\r\n', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(92, 2, 20, 'daftar', '2024-06-12 23:00:58', '2024-06-12 23:00:58'),
(93, 2, 21, 'susah daftar praktikum\r\n', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(94, 2, 21, 'sulit daftar praktikum', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(95, 2, 22, 'tidak bisa daftar akun\r\n', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(96, 2, 22, 'susah daftar akun', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(97, 2, 23, 'salah ambil praktikum\r\n', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(98, 2, 23, 'salah praktikum', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(99, 2, 23, 'kurang praktikum', '2024-06-12 23:03:27', '2024-06-12 23:03:27'),
(100, 2, 24, 'apa kartu kuning\r\n', '2024-06-12 23:07:16', '2024-06-12 23:07:16'),
(102, 2, 26, 'pinjam alat\r\n', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(103, 2, 26, 'pinjam ruangan', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(104, 2, 27, 'pinjam alat laboratorium\r\n', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(105, 2, 27, 'pinjam alat lab', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(106, 2, 28, 'pinjam ruang lab\r\n', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(107, 2, 28, 'pinjam lab', '2024-06-12 23:10:26', '2024-06-12 23:10:26'),
(109, 2, 5, 'bank', '2024-06-15 02:10:53', '2024-06-15 02:10:53'),
(110, 2, 8, 'admin', '2024-06-15 02:11:28', '2024-06-15 02:11:28'),
(111, 2, 24, 'kartu kuning', '2024-06-15 02:13:38', '2024-06-15 02:13:38'),
(112, 2, 18, 'alur daftar', '2024-06-15 02:16:13', '2024-06-15 02:16:13'),
(113, 2, 14, 'terima  kasih', '2024-06-15 02:29:05', '2024-06-15 02:29:05'),
(119, 2, 5, 'bank bni', '2024-06-15 03:04:08', '2024-06-15 03:04:08'),
(120, 2, 18, 'daftar', '2024-06-15 03:04:59', '2024-06-15 03:04:59'),
(123, 2, 10, 'bayar kampus', '2024-06-15 17:29:34', '2024-06-15 17:29:34'),
(124, 2, 3, 'assalamualaikum warrahmatullahi wa barakatuh', '2024-06-15 18:59:26', '2024-06-15 18:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id` int(100) NOT NULL,
  `pertanyaan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`) VALUES
(1, 'hiIIi'),
(2, 'ByEee'),
(3, 'caRA peMbayaran?');

-- --------------------------------------------------------

--
-- Table structure for table `tb_response`
--

CREATE TABLE `tb_response` (
  `id_response` int(100) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `response` varchar(10000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_response`
--

INSERT INTO `tb_response` (`id_response`, `id_type`, `id_kategori`, `response`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 'waalaikumsalam warrahmatullahi wabarakatuh,\r\n\r\nada yang bisa dibantu?\r\n\r\n', '2024-05-20 10:36:29', '2024-05-20 10:36:29'),
(4, 3, 4, 'halo sobat tif pembayaran dapaat di lakukan dengan dengan beberapa cara                                                            1. pembayaran di Bank kampus 4 UAD                                                                           2. pembayaran selain bank BNI atau Bank lain                ', '2024-05-20 10:38:41', '2024-05-20 10:38:41'),
(5, 3, 5, 'sobat TIF bisa melakukan pembayaran di bank dapat dilakukan dengan Uang cash sertakan no rekening laboratorium Informatika UAD  dengan tujuan BNI Syariah No. Rek: 0903394828 an Lisna Zahrotun.                              \r\nHarus menuliskan 3 Digit terakhir NIM kalian pada Nominal pembayaran pendaftaran praktikum.                             pada pembayaran dengan bank lain sama serti cara di atas dengan catatan akan terkena biaya admin\r\n', '2024-06-06 14:46:48', '2024-06-06 14:46:48'),
(6, 3, 7, 'untuk aktivasi sobat TIF dapat mengisi form aktivasi praktikum http://bit.ly/Aktivasi-Praktikum', '2024-06-06 15:15:52', '2024-06-06 15:15:52'),
(7, 3, 8, 'Akan di respon admin dalam waktu 2x24 jam. (Hari libur admin libur)', '2024-06-09 01:31:02', '2024-06-09 01:31:02'),
(9, 3, 10, 'bisa banget…. dengan catatan jika menggunakan selain Bank BNI maka sobat TIF akan terkena biaya admin  pada pembeyaran di bank kampus UAD Uang cash sertakan no rekening laboratorium Informatika UAD  dengan tujuan BNI Syariah No. Rek: 0903394828 an Lisna Zahrotun. Harus menuliskan 3 Digit terakhir NIM kalian pada Nominal pembayaran pendaftaran praktikum.', '2024-06-10 14:52:31', '2024-06-10 14:52:31'),
(11, 3, 12, 'bisa saja sobat TIF jika menggunakan ATM/Mbanking BNI dapat langsung transfer ke sesama bank BNI. tetapi jika dengan ATM/Mabanking lain menggunakan transfer antar bank dan akan di kenakan biaya admin    dengan tujuan BNI Syariah No. Rek: 0903394828 an Lisna Zahrotun. jangan lupa untuk mencantumkan 3 digit nim terakhir pada nominall pembayaran yaa', '2024-06-10 14:55:13', '2024-06-10 14:55:13'),
(12, 3, 13, 'Halo, selamat datang, perkenalkan saya chatbot layanan web lab TIF, ada yang bisa saya bantu?', '2024-06-12 20:57:38', '2024-06-12 20:57:38'),
(14, 3, 14, 'Selamat tinggal! Jika Anda memiliki pertanyaan lain di masa depan, jangan ragu untuk bertanya. Semoga harimu menyenangkan!', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(15, 3, 15, 'Tetap melakukan Aktivasi Praktikum di link bawah ini bit.ly/Aktivasi-Praktikum', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(16, 3, 16, 'PIN yg diberikan sesaat setelah selesai melakukan pendaftaran berguna sebagai secondary data ya sobat TIF\r\n', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(17, 3, 17, 'Sobat TIF silahkan isi form di https://s.uad.id/praktikum-tif-2020-1 (Sesudah direset admin, Username dan password menggunakan NIM)', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(18, 3, 18, 'Berikut prosedur pendaftaran praktikum: 1. Pendaftaran praktikum  2. Pembayaran modul praktikum   3. Aktivasi praktikum  4. Pemilihan slot praktikum             Informasi lebih lengkap ada di highlight FAQ reglab UAD  http://reglab.tif.uad.ac.id/\r\n\r\n', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(19, 3, 19, 'Mengenai Hal tersebut. Kami memang sedang membatasi akses untuk login ke akun tif dikarenakan mekanisme pemilihan slot berdasarkan angkatan. kami blokir sementara akses untuk login ke akun TIF\r\n', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(20, 3, 20, 'pendaftaran, nama lengkap diisi menggunakan huruf kapital semua://s.uad.id/praktikum-tif-2020-2\r\n', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(21, 3, 21, 'berikut beberapa kendala  1. kendala pendaftaran praktikum  2. kendala pendaftaran akun', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(22, 3, 22, 'berikut form pengaduan kendala pendaftaran akun https://s.uad.id/praktikum-tif-2020-2', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(23, 3, 21, 'berikut  form pengaduan kendala pendaftaran praktikum https://s.uad.id/praktikum-tif-2020-1', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(24, 3, 23, 'Sobat TIF jika ada kurang atau salah ambil mata praktikum silahkan isi form di https://s.uad.id/praktikum-ti-2020-1 (Pilihan praktikum akan direset ulang, silahkan memilih kembali)', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(25, 3, 24, 'Kartu kuning itu kartu tanda terima berkas registrasi mahasiswa UAD', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(26, 3, 26, 'peminjaman laboratorium  1. peminjaman alat laboratorium   2. peminjaman ruang laboratorium', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(27, 3, 27, 'peminjaman alat laboratorium dapat mengisi form doc peminjaman   https://tif.uad.ac.id/wp-content/uploads/Form-Peminjaman-Alat-Laboratorium-1.docx', '2024-06-12 23:18:40', '2024-06-12 23:18:40'),
(28, 3, 28, '\r\n\r\n\r\npeminjaman ruang laboratorium dapat mengisi form doc peminjaman  https://tif.uad.ac.id/wp-content/uploads/Form-Peminjaman-Ruang-Laboratorium.docx  Pinjam lab untuk 1x pertemuan, bisa menemui menghubungi nomor: 0823-2685-4493   Pinjam lab untuk kegiatan lain? seperti ormawa dll silahkan buat surat pinjam resmi ditujukan ke kaprodi', '2024-06-12 23:18:40', '2024-06-12 23:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(18, 'admin', '$2y$10$/KCzeLX4Qf7xxKtp9EePhO4vsWFrwauZ40vt5stcJv1urMfssEffm', 'fau@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_intent`
--
ALTER TABLE `tb_intent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `tb_pattern`
--
ALTER TABLE `tb_pattern`
  ADD PRIMARY KEY (`id_pattern`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_response`
--
ALTER TABLE `tb_response`
  ADD PRIMARY KEY (`id_response`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_intent`
--
ALTER TABLE `tb_intent`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_pattern`
--
ALTER TABLE `tb_pattern`
  MODIFY `id_pattern` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_response`
--
ALTER TABLE `tb_response`
  MODIFY `id_response` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD CONSTRAINT `tb_kategori_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_intent` (`id`);

--
-- Constraints for table `tb_pattern`
--
ALTER TABLE `tb_pattern`
  ADD CONSTRAINT `tb_pattern_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_intent` (`id`),
  ADD CONSTRAINT `tb_pattern_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`);

--
-- Constraints for table `tb_response`
--
ALTER TABLE `tb_response`
  ADD CONSTRAINT `tb_response_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_intent` (`id`),
  ADD CONSTRAINT `tb_response_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
