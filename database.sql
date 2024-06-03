-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Apr 2023 pada 14.39
-- Versi server: 10.5.19-MariaDB-cll-lve
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database name: `kasir-kopi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` bigint(11) NOT NULL,
  `kode_bahan` varchar(8) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `bahan_kat_id` int(11) NOT NULL,
  `minimum_stock` int(11) NOT NULL,
  `harga_bahan` int(11) NOT NULL,
  `stok_bahan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `kode_bahan`, `nama_bahan`, `bahan_kat_id`, `minimum_stock`, `harga_bahan`, `stok_bahan`, `created_at`, `updated_at`) VALUES
(3, '00003', 'FRESH MILK', 5, 2000, 30, 21140, NULL, NULL),
(4, '00004', 'ESPRESSO', 1, 2000, 30, -150, NULL, NULL),
(5, '00005', 'SUSU KENTAL MANIS', 5, 1000, 27, 1700, NULL, NULL),
(6, '00006', 'GULA AREN', 1, 2000, 40, 6320, NULL, NULL),
(7, '00007', 'CREAMER', 5, 2000, 69, 3215, NULL, NULL),
(8, '00008', 'GULA CAIR', 5, 1000, 30, 1081, NULL, NULL),
(9, '00009', 'VANILLA SYRUP', 5, 1000, 150, 2450, NULL, NULL),
(10, '00010', 'CARAMEL SYRUP', 5, 1000, 150, 5157, NULL, NULL),
(11, '00011', 'HAZELNUT SYRUP', 5, 1000, 150, 4245, NULL, NULL),
(12, '00012', 'STRAWBERRY SYRUP', 5, 1000, 150, 3315, NULL, NULL),
(13, '00013', 'LYCHEE SYRUP', 5, 1000, 173, 3557, NULL, NULL),
(14, '00014', 'MATCHA', 2, 1000, 250, 2920, NULL, NULL),
(15, '00015', 'TARO', 2, 1000, 250, 590, NULL, NULL),
(16, '00016', 'KETAN HITAM', 2, 1000, 250, 2479, NULL, NULL),
(17, '00017', 'KLEPON', 2, 1000, 250, 2620, NULL, NULL),
(18, '00018', 'COKLAT', 5, 1000, 250, 1370, NULL, NULL),
(22, '00022', 'ZODA', 3, 1000, 20, 14300, NULL, NULL),
(23, '00023', 'TROPICAL BLUE SYRUP', 3, 1000, 150, 2395, NULL, NULL),
(24, '00024', 'ABC SYRUP JERUK FLORIDA', 3, 500, 500, 885, NULL, NULL),
(25, '00025', 'FRAPPE', 5, 1000, 250, 1500, NULL, NULL),
(26, '00026', 'COLD BREW', 1, 1080, 140, 3445, NULL, NULL),
(28, '00028', 'DIVERSITY BLEND I 70:30', 1, 1000, 130, 1666, NULL, NULL),
(29, '00029', 'Coklat SBM', 5, 1000, 70, 1780, NULL, NULL),
(30, '00030', 'Coklat Tulip Bordeaux', 5, 500, 150, 740, NULL, NULL),
(31, '00031', 'WHIPPING CREAM VIVO', 5, 500, 66, 1100, NULL, NULL),
(32, '00032', 'BANANA SYRUP', 5, 500, 150, 3698, NULL, NULL),
(34, '00033', 'BAILEYS SYRUP', 5, 500, 180, 785, NULL, NULL),
(35, '00034', 'V60 HOUSEBLEND ARABIKA', 1, 500, 160, 353, NULL, NULL),
(36, '00035', 'VIETNAMESE DRIP HOUSEBLEND', 1, 500, 103, 925, NULL, NULL),
(37, '00036', 'TIRAMISU SYRUP', 5, 500, 146, 710, NULL, NULL),
(38, '00037', 'COKLAT LIQUID', 5, 500, 120, 740, NULL, NULL),
(39, '00038', 'TARO LIQUID', 5, 500, 120, 700, NULL, NULL),
(40, '00039', 'KLEPON LIQUID', 5, 500, 120, 570, NULL, NULL),
(41, '00040', 'MATCHA LIQUID', 5, 500, 120, 770, NULL, NULL),
(42, '00041', 'KETAN HITAM LIQUID', 5, 500, 120, 490, NULL, NULL),
(43, '00042', 'STOCK KOPI SUSU', 1, 1800, 34, 2520, NULL, NULL),
(44, '00043', 'STOCK DIVERSITY BLEND 1', 1, 1000, 130, 500, NULL, NULL),
(45, '00044', 'STOCK KOPI GULA AREN', 1, 1000, 24, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_kategori`
--

CREATE TABLE `bahan_kategori` (
  `id_kategori` bigint(20) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `bahan_slug` varchar(255) NOT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan_kategori`
--

INSERT INTO `bahan_kategori` (`id_kategori`, `nama_kategori`, `deskripsi`, `bahan_slug`, `added_by`) VALUES
(1, 'KOPI', 'MINUMAN BERBAHAN KOPI', 'kopi', 1),
(2, 'NON KOPI', 'MINUMAN TANPA KOPI', 'non-kopi', 1),
(3, 'MOCKTAIL', 'SOFT DRINK', 'mocktail', 1),
(4, 'SNACK', 'MAKANAN RINGAN', 'snack', 1),
(5, 'ALL VARIAN', 'UNTUK SEMUA MENU', 'all-varian', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_penjualan`
--

CREATE TABLE `bahan_penjualan` (
  `id_bp` bigint(20) NOT NULL,
  `no_trf_p` varchar(255) NOT NULL,
  `bahan_id_bp` int(11) NOT NULL,
  `used_bp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`) VALUES
(1, 'MANDIRI'),
(2, 'BNI'),
(3, 'BCA'),
(4, 'BRI'),
(5, 'CIMB Niaga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_trf` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `totalpure` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL,
  `diskon` int(3) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembalian` bigint(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `tgl_trf` datetime NOT NULL DEFAULT current_timestamp(),
  `jam_trf` time NOT NULL,
  `id_pembayaran` int(2) NOT NULL,
  `no_rek` int(18) DEFAULT NULL,
  `atas_nama` varchar(35) NOT NULL,
  `id_bank` int(2) DEFAULT NULL,
  `operator` varchar(30) NOT NULL,
  `kode_register` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_trf`, `nama_pelanggan`, `totalpure`, `grand_total`, `diskon`, `bayar`, `kembalian`, `catatan`, `tgl_trf`, `jam_trf`, `id_pembayaran`, `no_rek`, `atas_nama`, `id_bank`, `operator`, `kode_register`) VALUES
(1, 'C20220323001', 'X', 64900, 64900, 0, 100000, 35100, 'Meja 01', '2022-03-23 00:00:00', '14:37:49', 1, 0, '', NULL, 'kasir', 'REG00006'),
(2, 'C20220330001', 'Lisa', 197000, 197000, 0, 197000, 0, 'Order via wa', '2022-03-30 00:00:00', '15:41:12', 1, 0, '', NULL, 'kasir', 'REG00010'),
(3, 'C20220402002', 'FREDY', 368000, 368000, 0, 368000, 0, 'ORDER CASH', '2022-04-02 00:00:00', '09:26:57', 1, 0, '', NULL, 'diversitycoffee', 'REG00011'),
(4, 'C20220402003', 'Fredy', 368000, 368000, 0, 368000, 0, 'Order via wa', '2022-04-02 00:00:00', '09:38:19', 1, 0, '', NULL, 'kasir', 'REG00012'),
(5, 'T20220419004', '5771', 28000, 28000, 0, 28000, 0, 'Pembelian lewat gofood (potongan 7.400)', '2022-04-19 00:00:00', '13:44:29', 2, 0, 'Gofood', 0, 'kasir', 'REG00014'),
(6, 'T20220419005', '6044', 85000, 85000, 0, 85000, 0, 'Pembelian lewat gofood 18 April 2022 ((potongan 18', '2022-04-19 00:00:00', '13:49:06', 2, 0, 'Gofood', 0, 'kasir', 'REG00014'),
(7, 'C20220422006', 'Grace', 168000, 168000, 0, 168000, 0, 'Pembelian lewat wa', '2022-04-22 00:00:00', '15:12:48', 1, 0, '', NULL, 'kasir', 'REG00015'),
(8, 'T20220429007', 'Gofood', 56000, 56000, 0, 56000, 0, 'Pembelian lewat gofood  tgl 25-26 April 2022', '2022-04-29 00:00:00', '14:04:29', 2, 0, '', 0, 'kasir', 'REG00016'),
(9, 'T20220429008', 'Siu', 490000, 490000, 0, 490000, 0, 'Pembelian lewat wa tgl27-4-2022', '2022-04-29 00:00:00', '14:09:55', 2, 0, '', 0, 'kasir', 'REG00016'),
(10, 'T20220520009', 'Fredy', 480000, 480000, 0, 480000, 0, 'Reuni habiha', '2022-05-20 00:00:00', '16:27:43', 2, 0, '', 0, 'kasir', 'REG00017'),
(11, 'C20220525010', 'Richard', 105000, 105000, 0, 105000, 0, 'Pembelian lewat wa', '2022-05-25 00:00:00', '15:05:41', 1, 0, '', NULL, 'kasir', 'REG00018'),
(12, 'C20220525011', 'Arif', 242000, 242000, 0, 242000, 0, 'Pembelian lewat wa', '2022-05-25 00:00:00', '15:10:37', 1, 0, '', NULL, 'kasir', 'REG00018'),
(13, 'C20220531012', 'Siu ', 160000, 160000, 0, 160000, 0, 'Pembelian lewat wa', '2022-05-31 00:00:00', '14:19:42', 1, 0, '', NULL, 'kasir', 'REG00019'),
(14, 'C20230120013', 'Alex', 28000, 28000, 0, 28000, 0, 'Opening', '2023-01-20 00:00:00', '13:27:40', 1, 0, '', NULL, 'kasir', 'REG00024'),
(15, 'C20230121014', 'Uno', 37000, 0, 100, 0, 0, 'Double ', '2023-01-21 00:00:00', '10:59:11', 1, 0, '', NULL, 'diversitycoffee', 'REG00025'),
(16, 'C20230122015', 'Mr', 30000, 30000, 0, 100000, 70000, '\r\n\r\n', '2023-01-22 00:00:00', '10:48:08', 1, 0, '', NULL, 'kasir', 'REG00026'),
(17, 'C20230122016', 'Cici', 99000, 99000, 0, 99000, 0, 'Take away', '2023-01-22 00:00:00', '15:56:58', 1, 0, '', NULL, 'kasir', 'REG00027'),
(18, 'C20230123017', 'Mr', 15000, 15000, 0, 15000, 0, 'Hot\r\n', '2023-01-23 00:00:00', '09:52:19', 1, 0, '', NULL, 'kasir', 'REG00028'),
(19, 'C20230123018', 'Teman pak Fredy ', 200000, 200000, 0, 200000, 0, 'Pagi ', '2023-01-23 00:00:00', '15:57:24', 1, 0, '', NULL, 'kasir', 'REG00029'),
(20, 'C20230123019', 'Mel', 109000, 109000, 0, 109000, 0, '', '2023-01-23 00:00:00', '18:08:55', 1, 0, '', NULL, 'kasir', 'REG00030'),
(21, 'C20230123020', 'Teman koh Freddy ', 437000, 437000, 0, 437000, 0, '', '2023-01-23 00:00:00', '19:48:55', 1, 0, '', NULL, 'kasir', 'REG00030'),
(22, 'C20230123021', 'Teman Jeany', 88000, 88000, 0, 88000, 0, 'Ship siang', '2023-01-23 00:00:00', '20:14:14', 1, 0, '', NULL, 'kasir', 'REG00030'),
(23, 'C20230123022', '', 122000, 122000, 0, 130000, 8000, '', '2023-01-23 00:00:00', '20:27:27', 1, 0, '', NULL, 'kasir', 'REG00030'),
(24, 'C20230123023', '', 53000, 53000, 0, 60000, 7000, '', '2023-01-23 00:00:00', '20:29:03', 1, 0, '', NULL, 'kasir', 'REG00030'),
(25, 'C20230123024', '', 53000, 53000, 0, 53000, 0, '', '2023-01-23 00:00:00', '20:51:53', 1, 0, '', NULL, 'kasir', 'REG00030'),
(26, 'C20230124025', 'Mr', 25001, 25001, 0, 25001, 0, 'Pagi', '2023-01-24 00:00:00', '09:06:29', 1, 0, '', NULL, 'kasir', 'REG00031'),
(27, 'C20230124026', 'Mrs ', 33000, 33000, 0, 35000, 2000, 'Pagi', '2023-01-24 00:00:00', '10:31:22', 1, 0, '', NULL, 'kasir', 'REG00031'),
(28, 'C20230124027', 'Mr', 28000, 28000, 0, 100000, 72000, 'Pagi ', '2023-01-24 00:00:00', '15:11:25', 1, 0, '', NULL, 'kasir', 'REG00033'),
(29, 'C20230125028', '', 180000, 180000, 0, 180000, 0, '', '2023-01-25 00:00:00', '13:17:15', 1, 0, '', NULL, 'kasir', 'REG00036'),
(30, 'C20230125029', '', 98000, 98000, 0, 98000, 0, '', '2023-01-25 00:00:00', '13:19:40', 1, 0, '', NULL, 'kasir', 'REG00036'),
(31, 'C20230125030', '', 154000, 154000, 0, 154000, 0, '', '2023-01-25 00:00:00', '15:45:40', 1, 0, '', NULL, 'kasir', 'REG00036'),
(32, 'C20230125031', '', 87000, 87000, 0, 87000, 0, '', '2023-01-25 00:00:00', '16:30:40', 1, 0, '', NULL, 'kasir', 'REG00036'),
(33, 'C20230126032', 'Kevin', 23000, 23000, 0, 100000, 77000, '', '2023-01-26 00:00:00', '11:23:28', 1, 0, '', NULL, 'kasir', 'REG00038'),
(34, 'C20230126033', '', 64000, 64000, 0, 64000, 0, '', '2023-01-26 00:00:00', '12:58:02', 1, 0, '', NULL, 'kasir', 'REG00038'),
(35, 'C20230126034', '', 61000, 61000, 0, 102000, 41000, '', '2023-01-26 00:00:00', '13:17:19', 1, 0, '', NULL, 'kasir', 'REG00038'),
(36, 'C20230126035', '', 64000, 64000, 0, 100000, 36000, '', '2023-01-26 00:00:00', '13:20:52', 1, 0, '', NULL, 'kasir', 'REG00038'),
(37, 'C20230126036', '', 30000, 30000, 0, 30000, 0, '', '2023-01-26 00:00:00', '13:46:49', 1, 0, '', NULL, 'kasir', 'REG00038'),
(38, 'C20230127037', 'Ke ', 44000, 44000, 0, 100000, 56000, 'Pfi', '2023-01-27 00:00:00', '09:55:00', 1, 0, '', NULL, 'kasir', 'REG00040'),
(39, 'C20230127038', 'Mr ', 25000, 25000, 0, 25000, 0, 'Pagi', '2023-01-27 00:00:00', '11:44:38', 1, 0, '', NULL, 'kasir', 'REG00040'),
(40, 'C20230127039', 'Mr', 50500, 50500, 0, 100500, 50000, 'Pagi', '2023-01-27 00:00:00', '12:04:14', 1, 0, '', NULL, 'kasir', 'REG00040'),
(41, 'C20230127040', '', 62000, 62000, 0, 102000, 40000, 'Pagi', '2023-01-27 00:00:00', '13:22:30', 1, 0, '', NULL, 'kasir', 'REG00040'),
(42, 'C20230127041', '', 1280000, 1280000, 0, 1280000, 0, '', '2023-01-27 00:00:00', '13:41:19', 1, 0, '', NULL, 'kasir', 'REG00040'),
(43, 'C20230127042', '', 28000, 28000, 0, 28000, 0, '', '2023-01-27 00:00:00', '15:08:56', 1, 0, '', NULL, 'kasir', 'REG00040'),
(44, 'C20230127043', '', 53000, 53000, 0, 100000, 47000, '', '2023-01-27 00:00:00', '15:24:18', 1, 0, '', NULL, 'kasir', 'REG00040'),
(45, 'C20230127044', 'Shhs', 68000, 68000, 0, 100000, 32000, 'Nsjsjs', '2023-01-27 00:00:00', '15:49:12', 1, 0, '', NULL, 'kasir', 'REG00040'),
(46, 'C20230127045', 'Gojek', 66000, 66000, 0, 100000, 34000, '  ', '2023-01-27 00:00:00', '16:49:14', 1, 0, '', NULL, 'diversitycoffee', 'REG00043'),
(47, 'C20230131046', 'Gojek', 29000, 29000, 0, 30000, 1000, 'test', '2023-01-31 00:00:00', '09:29:09', 1, 0, '', NULL, 'diversitycoffee', 'REG00047'),
(48, 'C20230131047', 'Gojek', 29000, 29000, 0, 30000, 1000, 'qwqqwq', '2023-01-31 00:00:00', '09:33:41', 1, 0, '', NULL, 'diversitycoffee', 'REG00047'),
(49, 'C20230131048', 'Gojek', 29000, 29000, 0, 30000, 1000, 'qwqqwq', '2023-01-31 00:00:00', '09:34:45', 1, 0, '', NULL, 'diversitycoffee', 'REG00047'),
(50, 'C20230131049', 'Gojek', 29000, 29000, 0, 29000, 0, '', '2023-01-31 00:00:00', '09:36:26', 1, 0, '', NULL, 'diversitycoffee', 'REG00047'),
(51, 'C20230131050', 'Gojek', 29000, 29000, 0, 29000, 0, '', '2023-01-31 00:00:00', '09:37:52', 1, 0, '', NULL, 'diversitycoffee', 'REG00047'),
(52, 'C20230201051', 'Test', 66000, 66000, 0, 66000, 0, 'wadaw', '2023-02-01 00:00:00', '12:18:38', 1, 0, '', NULL, 'diversitycoffee', 'REG00050'),
(53, 'C20230201052', 'Test', 33000, 33000, 0, 33000, 0, 'awdawdawdawdawdaw', '2023-02-01 00:00:00', '12:34:03', 1, 0, '', NULL, 'diversitycoffee', 'REG00051'),
(54, 'C20230201053', 'Test', 56000, 56000, 0, 56000, 0, 'www', '2023-02-01 00:00:00', '12:43:02', 1, 0, '', NULL, 'diversitycoffee', 'REG00052'),
(55, 'C20230214054', 'test', 28000, 28000, 0, 30000, 2000, 'test', '2023-02-14 00:00:00', '04:47:49', 1, 0, '', NULL, 'diversitycoffee', 'REG00052'),
(56, 'C20230214055', 'test', 23000, 23000, 0, 100000, 77000, '233232', '2023-02-14 00:00:00', '04:48:31', 1, 0, '', NULL, 'diversitycoffee', 'REG00052'),
(57, 'C20230214056', 'test', 33000, 33000, 0, 100000, 67000, 'est', '2023-02-14 00:00:00', '04:49:03', 1, 0, '', NULL, 'kasir', 'REG00052');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extras`
--

CREATE TABLE `extras` (
  `id_extras` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `kode_extras` varchar(255) NOT NULL,
  `nama_extras` varchar(255) NOT NULL,
  `harga_extras` int(11) NOT NULL,
  `created_at_extras` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `extras`
--

INSERT INTO `extras` (`id_extras`, `id_produk`, `kode_produk`, `kode_extras`, `nama_extras`, `harga_extras`, `created_at_extras`) VALUES
(1, 1, 'DC001', 'EXTRAS00001', 'EXTRA ESPRESSO-01', 6000, '2022-03-22 00:00:00'),
(2, 2, 'DC002', 'EXTRAS00002', 'EXTRA ESPRESSO-02', 6000, '2022-03-23 00:00:00'),
(3, 3, 'DC003', 'EXTRAS00003', 'EXTRA ESPRESSO-03', 6000, '2022-03-23 00:00:00'),
(4, 4, 'DC004', 'EXTRAS00004', 'EXTRA ESPRESSO-04', 6000, '2022-03-23 00:00:00'),
(5, 5, 'DC005', 'EXTRAS00005', 'EXTRA ESPRESSO-05', 6000, '2022-03-23 00:00:00'),
(6, 6, 'DC006', 'EXTRAS00006', 'EXTRA ESPRESSO-06', 6000, '2022-03-23 00:00:00'),
(7, 13, 'DC013', 'EXTRAS00007', 'EXTRA ESPRESSO-07', 6000, '2022-03-23 00:00:00'),
(8, 16, 'DC016', 'EXTRAS00008', 'EXTRA ESPRESSO-08', 6000, '2022-03-23 00:00:00'),
(9, 2, 'DC002', 'EXTRAS00009', 'EXTRA VANILLA SYRUP-01', 5000, '2022-03-23 00:00:00'),
(10, 7, 'DC007', 'EXTRAS00010', 'EXTRA VANILLA SYRUP-02', 5000, '2022-03-23 00:00:00'),
(11, 3, 'DC003', 'EXTRAS00011', 'EXTRA HAZELNUT SYRUP-01', 5000, '2022-03-23 00:00:00'),
(12, 4, 'DC004', 'EXTRAS00012', 'EXTRA CARAMEL SYRUP-01', 5000, '2022-03-23 00:00:00'),
(13, 13, 'DC013', 'EXTRAS00013', 'EXTRA VANILLA SYRUP-03', 5000, '2022-03-23 00:00:00'),
(14, 21, 'DC021', 'EXTRAS00014', 'EXTRA ESPRESSO-09', 6000, '2022-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extras_bahan`
--

CREATE TABLE `extras_bahan` (
  `id_extras_bahan` int(11) NOT NULL,
  `extras_kode` varchar(255) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `jumlah_xb` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `extras_bahan`
--

INSERT INTO `extras_bahan` (`id_extras_bahan`, `extras_kode`, `bahan_id`, `jumlah_xb`, `created_at`, `updated_at`) VALUES
(1, 'EXTRAS00001', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(2, 'EXTRAS00002', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(3, 'EXTRAS00003', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(4, 'EXTRAS00004', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(5, 'EXTRAS00005', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(6, 'EXTRAS00006', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(7, 'EXTRAS00007', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(8, 'EXTRAS00008', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(9, 'EXTRAS00009', 9, 10, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(10, 'EXTRAS00010', 9, 10, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(11, 'EXTRAS00011', 11, 10, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(12, 'EXTRAS00012', 10, 10, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(13, 'EXTRAS00013', 9, 10, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(14, 'EXTRAS00014', 4, 40, '2022-03-30 00:00:00', '2022-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extras_menu`
--

CREATE TABLE `extras_menu` (
  `id_extras_menu` bigint(20) NOT NULL,
  `id_extras` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_byr` int(11) NOT NULL,
  `metode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_byr`, `metode`) VALUES
(1, 'Cash'),
(2, 'Transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` datetime DEFAULT current_timestamp(),
  `catatan` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_by_name` varchar(50) NOT NULL,
  `kode_register` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_transaksi` int(11) NOT NULL,
  `id_dtlpen` int(5) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `produk_name` text NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `sub_total` bigint(20) NOT NULL,
  `id_extras` int(11) DEFAULT 0,
  `created_penjualan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_register` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `id_dtlpen`, `id_produk`, `produk_name`, `jumlah_stok`, `harga_produk`, `sub_total`, `id_extras`, `created_penjualan`, `kode_register`) VALUES
(1, 1, 1, 'ES COFFEE LATTE', 1, 27500, 27500, NULL, '2022-03-23 07:37:49', 'REG00006'),
(2, 1, 5, 'ES MOCCACHINNO', 1, 37400, 37400, NULL, '2022-03-23 07:37:49', 'REG00006'),
(3, 2, 21, 'ES KOPI SUSU GULA AREN 1 LITER', 2, 80000, 160000, NULL, '2022-03-30 08:41:12', 'REG00010'),
(4, 2, 11, 'ES KLEPON', 1, 37000, 37000, NULL, '2022-03-30 08:41:12', 'REG00010'),
(5, 3, 15, 'COLD BREW', 4, 28000, 112000, NULL, '2022-04-02 02:26:57', 'REG00011'),
(6, 3, 22, 'ES KOPI SUSU BOTOL 350ML', 4, 34000, 136000, NULL, '2022-04-02 02:26:57', 'REG00011'),
(7, 3, 6, 'ES KOPI GULA AREN', 4, 30000, 120000, NULL, '2022-04-02 02:26:57', 'REG00011'),
(8, 4, 15, 'COLD BREW', 4, 28000, 112000, NULL, '2022-04-02 02:38:19', 'REG00012'),
(9, 4, 22, 'ES KOPI SUSU BOTOL 350ML', 4, 34000, 136000, NULL, '2022-04-02 02:38:19', 'REG00012'),
(10, 4, 6, 'ES KOPI GULA AREN', 4, 30000, 120000, NULL, '2022-04-02 02:38:19', 'REG00012'),
(11, 5, 15, 'COLD BREW', 1, 28000, 28000, NULL, '2022-04-19 06:44:29', 'REG00014'),
(12, 6, 20, 'ES KOPI SUSU 1 LITER', 1, 85000, 85000, NULL, '2022-04-19 06:49:06', 'REG00014'),
(13, 7, 15, 'COLD BREW', 6, 28000, 168000, NULL, '2022-04-22 08:12:48', 'REG00015'),
(14, 8, 15, 'COLD BREW', 2, 28000, 56000, NULL, '2022-04-29 07:04:29', 'REG00016'),
(15, 9, 14, 'ES KOPI SUSU', 5, 34000, 170000, NULL, '2022-04-29 07:09:55', 'REG00016'),
(16, 9, 15, 'COLD BREW', 5, 28000, 140000, NULL, '2022-04-29 07:09:55', 'REG00016'),
(17, 9, 6, 'ES KOPI GULA AREN', 6, 30000, 180000, NULL, '2022-04-29 07:09:55', 'REG00016'),
(18, 10, 6, 'ES KOPI GULA AREN', 3, 30000, 90000, NULL, '2022-05-20 09:27:43', 'REG00017'),
(19, 10, 15, 'COLD BREW', 2, 28000, 56000, NULL, '2022-05-20 09:27:43', 'REG00017'),
(20, 10, 22, 'ES KOPI SUSU BOTOL 350ML', 4, 34000, 136000, NULL, '2022-05-20 09:27:43', 'REG00017'),
(21, 10, 2, 'ES VANILLA LATTE', 3, 33000, 99000, NULL, '2022-05-20 09:27:43', 'REG00017'),
(22, 10, 3, 'ES HAZELNUT LATTE', 3, 33000, 99000, NULL, '2022-05-20 09:27:43', 'REG00017'),
(23, 11, 12, 'ES COKLAT', 2, 39000, 78000, NULL, '2022-05-25 08:05:41', 'REG00018'),
(24, 11, 17, 'STRAWBERRY SQUASH', 1, 27000, 27000, NULL, '2022-05-25 08:05:41', 'REG00018'),
(25, 12, 20, 'ES KOPI SUSU 1 LITER', 1, 85000, 85000, NULL, '2022-05-25 08:10:37', 'REG00018'),
(26, 12, 21, 'ES KOPI SUSU GULA AREN 1 LITER', 1, 80000, 80000, NULL, '2022-05-25 08:10:37', 'REG00018'),
(27, 12, 23, 'ES VANILLA LATTE BOTOL 350 ML', 1, 38000, 38000, NULL, '2022-05-25 08:10:37', 'REG00018'),
(28, 12, 12, 'ES COKLAT', 1, 39000, 39000, NULL, '2022-05-25 08:10:37', 'REG00018'),
(29, 13, 21, 'ES KOPI SUSU GULA AREN 1 LITER', 2, 80000, 160000, NULL, '2022-05-31 07:19:42', 'REG00019'),
(30, 14, 1, 'ES COFFEE LATTE', 1, 28000, 28000, NULL, '2023-01-20 06:27:40', 'REG00024'),
(31, 15, 8, 'ES MATCHA', 1, 37000, 37000, NULL, '2023-01-21 03:59:11', 'REG00025'),
(32, 16, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-22 03:48:08', 'REG00026'),
(33, 17, 6, 'ES KOPI GULA AREN', 2, 30000, 60000, NULL, '2023-01-22 08:56:58', 'REG00027'),
(34, 17, 12, 'ES COKLAT', 1, 39000, 39000, NULL, '2023-01-22 08:56:58', 'REG00027'),
(35, 18, 35, 'HOT AMERICANO', 1, 15000, 15000, NULL, '2023-01-23 02:52:19', 'REG00028'),
(36, 19, 51, 'DIVERSITY BLEND - 1', 1, 200000, 200000, NULL, '2023-01-23 08:57:24', 'REG00029'),
(37, 20, 2, 'ES VANILLA LATTE', 1, 33000, 33000, NULL, '2023-01-23 11:08:55', 'REG00030'),
(38, 20, 6, 'ES KOPI GULA AREN', 2, 30000, 60000, NULL, '2023-01-23 11:08:55', 'REG00030'),
(39, 20, 35, 'HOT AMERICANO', 1, 16000, 16000, NULL, '2023-01-23 11:08:55', 'REG00030'),
(40, 21, 9, 'ES TARO', 2, 37000, 74000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(41, 21, 10, 'ES KETAN HITAM', 1, 37000, 37000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(42, 21, 12, 'ES COKLAT', 3, 39000, 117000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(43, 21, 19, 'TROPICAL BLUE SQUASH', 1, 27000, 27000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(44, 21, 31, 'HOT BAILEYS LATTE', 1, 28000, 28000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(45, 21, 32, 'ES BAILEYS LATTE', 2, 30000, 60000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(46, 21, 35, 'HOT AMERICANO', 4, 16000, 64000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(47, 21, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-23 12:48:55', 'REG00030'),
(48, 22, 8, 'ES MATCHA', 1, 37000, 37000, NULL, '2023-01-23 13:14:14', 'REG00030'),
(49, 22, 44, 'HOT MATCHA', 1, 28000, 28000, NULL, '2023-01-23 13:14:14', 'REG00030'),
(50, 22, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-23 13:14:14', 'REG00030'),
(51, 23, 2, 'ES VANILLA LATTE', 1, 33000, 33000, NULL, '2023-01-23 13:27:27', 'REG00030'),
(52, 23, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-23 13:27:27', 'REG00030'),
(53, 23, 4, 'ES CARAMEL LATTE', 1, 33000, 33000, NULL, '2023-01-23 13:27:27', 'REG00030'),
(54, 23, 3, 'ES HAZELNUT LATTE', 1, 33000, 33000, NULL, '2023-01-23 13:27:27', 'REG00030'),
(55, 24, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-23 13:29:03', 'REG00030'),
(56, 24, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-23 13:29:03', 'REG00030'),
(57, 25, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-23 13:51:53', 'REG00030'),
(58, 25, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-23 13:51:53', 'REG00030'),
(59, 26, 40, 'V60', 1, 25001, 25001, NULL, '2023-01-24 02:06:29', 'REG00031'),
(60, 27, 3, 'ES HAZELNUT LATTE', 1, 33000, 33000, NULL, '2023-01-24 03:31:22', 'REG00031'),
(61, 28, 1, 'ES COFFEE LATTE', 1, 28000, 28000, NULL, '2023-01-24 08:11:25', 'REG00033'),
(62, 29, 6, 'ES KOPI GULA AREN', 6, 30000, 180000, NULL, '2023-01-25 06:17:15', 'REG00036'),
(63, 30, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-25 06:19:40', 'REG00036'),
(64, 30, 22, 'ES KOPI SUSU BOTOL 350ML', 2, 34000, 68000, NULL, '2023-01-25 06:19:40', 'REG00036'),
(65, 31, 4, 'ES CARAMEL LATTE', 1, 33000, 33000, NULL, '2023-01-25 08:45:40', 'REG00036'),
(66, 31, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-25 08:45:40', 'REG00036'),
(67, 31, 22, 'ES KOPI SUSU BOTOL 350ML', 1, 34000, 34000, NULL, '2023-01-25 08:45:40', 'REG00036'),
(68, 31, 35, 'HOT AMERICANO', 4, 16000, 64000, NULL, '2023-01-25 08:45:40', 'REG00036'),
(69, 32, 11, 'ES KLEPON', 1, 37000, 37000, NULL, '2023-01-25 09:30:40', 'REG00036'),
(70, 32, 15, 'COLD BREW', 1, 28000, 28000, NULL, '2023-01-25 09:30:40', 'REG00036'),
(71, 32, 42, 'HOT CAPPUCCINO', 1, 22000, 22000, NULL, '2023-01-25 09:30:40', 'REG00036'),
(72, 33, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-26 04:23:28', 'REG00038'),
(73, 34, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-26 05:58:02', 'REG00038'),
(74, 34, 0, 'ES KOPI SUSU BOTOL 350ML', 1, 34000, 34000, NULL, '2023-01-26 05:58:02', 'REG00038'),
(75, 35, 0, 'TROPICAL BLUE SQUASH', 1, 27000, 27000, NULL, '2023-01-26 06:17:19', 'REG00038'),
(76, 35, 0, 'ES CARAMEL FRAPE', 1, 34000, 34000, NULL, '2023-01-26 06:17:19', 'REG00038'),
(77, 36, 1, 'ES COFFEE LATTE', 1, 28000, 28000, NULL, '2023-01-26 06:20:52', 'REG00038'),
(78, 36, 13, 'ES BLACK LATTE', 1, 36000, 36000, NULL, '2023-01-26 06:20:52', 'REG00038'),
(79, 37, 6, 'ES KOPI GULA AREN', 1, 30000, 30000, NULL, '2023-01-26 06:46:49', 'REG00038'),
(80, 38, 0, 'VIETNAM DRIVE', 1, 22000, 22000, NULL, '2023-01-27 02:55:00', 'REG00040'),
(81, 38, 0, 'Diskon COLDBREW', 1, 14000, 14000, NULL, '2023-01-27 02:55:00', 'REG00040'),
(82, 38, 0, 'Diskon Hot Americano', 1, 8000, 8000, NULL, '2023-01-27 02:55:00', 'REG00040'),
(83, 40, 0, 'Diskon ES COFFEE LATTE', 1, 14000, 14000, NULL, '2023-01-27 05:04:14', 'REG00040'),
(84, 40, 0, 'Diskon Es Americano', 1, 11500, 11500, NULL, '2023-01-27 05:04:14', 'REG00040'),
(85, 40, 0, 'V60', 1, 25000, 25000, NULL, '2023-01-27 05:04:14', 'REG00040'),
(86, 41, 0, 'V60', 1, 25000, 25000, NULL, '2023-01-27 06:22:30', 'REG00040'),
(87, 41, 0, 'ES TARO', 1, 37000, 37000, NULL, '2023-01-27 06:22:30', 'REG00040'),
(88, 42, 4, 'ES CARAMEL LATTE', 2, 33000, 66000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(89, 42, 59, 'Diskon COLDBREW', 10, 14000, 140000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(90, 42, 22, 'ES KOPI SUSU BOTOL 350ML', 16, 34000, 544000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(91, 42, 11, 'ES KLEPON', 3, 37000, 111000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(92, 42, 10, 'ES KETAN HITAM', 5, 37000, 185000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(93, 42, 12, 'ES COKLAT', 6, 39000, 234000, NULL, '2023-01-27 06:41:19', 'REG00040'),
(94, 44, 0, 'ES BAILEYS LATTE', 1, 30000, 30000, NULL, '2023-01-27 08:24:18', 'REG00040'),
(95, 44, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-01-27 08:24:18', 'REG00040'),
(96, 45, 0, 'Diskon Hot Americano', 1, 8000, 8000, NULL, '2023-01-27 08:49:12', 'REG00040'),
(97, 45, 6, 'ES KOPI GULA AREN', 2, 30000, 60000, NULL, '2023-01-27 08:49:12', 'REG00040'),
(98, 46, 3, 'ES HAZELNUT LATTE', 1, 33000, 33000, NULL, '2023-01-27 09:49:14', 'REG00043'),
(99, 46, 2, 'ES VANILLA LATTE', 1, 33000, 33000, NULL, '2023-01-27 09:49:14', 'REG00043'),
(100, 47, 1, 'ES COFFEE LATTE', 1, 29000, 29000, NULL, '2023-01-31 02:29:09', 'REG00047'),
(101, 48, 1, 'ES COFFEE LATTE', 1, 29000, 29000, NULL, '2023-01-31 02:33:41', 'REG00047'),
(102, 50, 1, 'ES COFFEE LATTE', 1, 29000, 29000, NULL, '2023-01-31 02:36:26', 'REG00047'),
(103, 51, 1, 'ES COFFEE LATTE', 1, 29000, 29000, NULL, '2023-01-31 02:37:52', 'REG00047'),
(104, 52, 3, 'ES HAZELNUT LATTE', 1, 33000, 33000, NULL, '2023-02-01 05:18:38', 'REG00050'),
(105, 52, 2, 'ES VANILLA LATTE', 1, 33000, 33000, NULL, '2023-02-01 05:18:38', 'REG00050'),
(106, 53, 2, 'ES VANILLA LATTE', 1, 33000, 33000, NULL, '2023-02-01 05:34:03', 'REG00051'),
(107, 54, 1, 'ES COFFEE LATTE', 2, 28000, 56000, NULL, '2023-02-01 05:43:02', 'REG00052'),
(108, 55, 1, 'ES COFFEE LATTE', 1, 28000, 28000, NULL, '2023-02-13 21:47:49', 'REG00052'),
(109, 56, 16, 'ES AMERICANO', 1, 23000, 23000, NULL, '2023-02-13 21:48:31', 'REG00052'),
(110, 57, 3, 'ES HAZELNUT LATTE', 1, 33000, 33000, NULL, '2023-02-13 21:49:03', 'REG00052');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint(20) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `modal_produk` int(11) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `pajak_produk` int(11) NOT NULL,
  `detail_produk` text NOT NULL,
  `created_at_produk` datetime DEFAULT current_timestamp(),
  `updated_at_produk` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_produk`, `modal_produk`, `gambar_produk`, `kategori_id`, `pajak_produk`, `detail_produk`, `created_at_produk`, `updated_at_produk`) VALUES
(1, 'DC001', 'ES COFFEE LATTE', 28000, 13519, '250d9f085b170061306d71c9f6546fb8.JPG', 1, 2750, 'MINUMAN KOPI BERBAHAN DASAR PREMIUM ESPRESSO DENGAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(2, 'DC002', 'ES VANILLA LATTE', 33000, 15078, 'e8a27e68330e070a8bd725fe7cf113fa.JPG', 1, 3300, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN VANILLA SYRUP', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(3, 'DC003', 'ES HAZELNUT LATTE', 33000, 15078, 'ee2c1089dc8c1e02df70fa39a5190d17.JPG', 1, 3300, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN HAZELNUT SYRUP', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(4, 'DC004', 'ES CARAMEL LATTE', 33000, 15078, 'dbdc299202658e515d6594b630762a4b.JPG', 1, 3300, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN CARAMEL SYRUP', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(5, 'DC005', 'ES MOCCACHINNO', 38000, 14759, '5a83f79a0f04fdedf5b21e9f5b14038f.JPG', 1, 3740, 'PREMIUM ESPRESSO DENGAN FRESHMILK DAN COKLAT', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(6, 'DC006', 'ES KOPI GULA AREN', 30000, 13035, '2dd69cf597afecff9a5c92e86eb97412.JPG', 1, 2860, 'PREMIUM ESPRESSO DENGAN GULA AREN DAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(8, 'DC008', 'ES MATCHA', 37000, 15080, '2ff206df6940f936638dbd0095c8ec00.JPG', 2, 3630, 'GREEN TEA DENGAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(9, 'DC009', 'ES TARO', 37000, 15080, '0ea454b24b4f00689cf3a84563d9d021.JPG', 2, 3630, 'TARO DENGAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(10, 'DC010', 'ES KETAN HITAM', 37000, 15080, 'dbfe07e65391d4d68cfebc2d6e07c5ce.JPG', 2, 3630, 'KETAN HITAM DENGAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(11, 'DC011', 'ES KLEPON', 37000, 15080, 'c52437d785ded384508d5da98370d83f.JPG', 2, 3630, 'KLEPON DENGAN FRESH MILK', '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(12, 'DC012', 'ES COKLAT', 39000, 16190, '4e3b8dd48b286d8f802897524552ac91.JPG', 2, 3850, 'PREMIUM COKLAT DENGAN FRESH MILK', '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(13, 'DC013', 'ES BLACK LATTE', 36000, 16000, '640de23bf42d36c2ec3e261386f892cd.JPG', 1, 3520, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN CORCOAL', '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(15, 'DC015', 'COLD BREW', 28000, 16763, 'a3b7d0e90bd008dccaa348b4c8d37da9.JPG', 1, 2750, 'COLD BREW DARI BIJI KOPI HOUSE BLEND', '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(16, 'DC016', 'ES AMERICANO', 23000, 14069, 'e69c3400bfbffcc7a6a790368913cf6b.JPG', 1, 2200, 'DENGAN PREMIUM ESPRESSO', '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(17, 'DC017', 'STRAWBERRY SQUASH', 27000, 14750, '0e7101431605d3995c0293d6b15615bb.JPG', 3, 2640, 'STRAWBERRY SYRUP DENGAN ZODA', '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(18, 'DC018', 'LYCHEE SQUASH', 27000, 14750, '4bd142cd626a417df956872905105a19.JPG', 3, 2640, 'LYCHEE SYRUP DENGAN ZODA', '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(19, 'DC019', 'TROPICAL BLUE SQUASH', 27000, 14750, '889ec5dd62494b7dec48de77c1c8b9b3.JPG', 3, 2640, 'TROPICAL BLUE SYRUP DENGAN SYRUP JERUK FLORIDA DAN ZODA', '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(20, 'DC020', 'ES KOPI SUSU 1 LITER', 85000, 35927, '165afddf0e175bdf29c3e59ca7d3f071.jpg', 1, 9240, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN CARAMEL SUGAR', '2022-03-30 00:00:00', '2022-03-30 00:00:00'),
(21, 'DC021', 'ES KOPI SUSU GULA AREN 1 LITER', 80000, 36498, 'b895718d34a04096dbb42dd7e3c8bf2f.jpg', 1, 8008, 'PREMIUM ESPRESSO DENGAN GULA AREN DAN FRESH MILK', '2022-03-30 00:00:00', '2022-03-30 00:00:00'),
(22, 'DC022', 'ES KOPI SUSU BOTOL 350ML', 34000, 12831, '320c2483e6f79bf4762626af5c645df0.jpg', 1, 3300, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN CARAMEL SUGAR', '2022-04-02 00:00:00', '2022-04-02 00:00:00'),
(23, 'DC023', 'ES VANILLA LATTE BOTOL 350 ML', 38000, 16763, '442cf06bcdde8027e1dca40dba5eef17.JPG', 1, 4180, 'PREMIUM ESPRESSO DENGAN FRESHMILK DAN VANILLA SYRUP', '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(24, 'DC024', 'ES HAZELNUT LATTE BOTOL 350 ML', 38000, 16763, '571920660495445bfb4a281b9abeb854.JPG', 1, 4180, 'PREMIUM ESPRESSO DENGAN FRESHMILK DAN HAZELNUT SYRUP', '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(25, 'DC025', 'ES CARAMEL LATTE BOTOL 350 ML', 38000, 16763, '4b3a597ebdd4f6466ef32890535637cf.JPG', 1, 4180, 'PREMIUM ESPRESSO DENGAN FRESH MILK DAN CARAMEL SYRUP', '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(26, 'DC026', 'ES SWEAT CREAM COLDBREW', 32000, 18165, 'abc0ad77f6ce90a7052fc7bdaefefc70.jpg', 1, 1650, 'COLDBREW dengan rasa vanilla creamy', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(27, 'DC027', 'ES BANANA MILK', 30000, 16950, '78420e99b13090356a179d3a7a4e9b03.jpg', 2, 154, 'Susu dengan rasa pisang yang pas', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(28, 'DC028', 'ES STRAWBERRY MILK', 28000, 15075, 'ef5a71263669fc5f23a471b010a09b1a.jpg', 2, 1540, 'Susu dengan rasa strawberry yang enak', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(29, 'DC029', 'ES FRAPPE', 32000, 19425, 'c17a42ca8f92ffc235e8ca299ee4b805.jpg', 1, 1760, 'Premium espresso dengan freshmilk dan frappe', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(30, 'DC030', 'HOT COKLAT', 35000, 23273, '9df5e956b8e9994a2a2b1337a7029c21.jpg', 2, 2100, 'Minuman rasa coklat Belgia yang mantap', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(31, 'DC031', 'HOT BAILEYS LATTE', 28000, 15075, 'e725ce5e2bfea1e8e5a36e7e98c39486.jpg', 1, 1370, 'Kopi latte dengan rasa baileys yang mantap', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(32, 'DC032', 'ES BAILEYS LATTE', 30000, 16575, '128cfa3068eb93bd42487d32a8655497.jpg', 1, 1500, 'Kopi latte dengan rasa baileys yang mantap', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(34, 'DC034', 'HOT FRAPPUCCINO', 29000, 15825, '9c323438c6d6248cd171fbb01a1dfdfd.jpeg', 1, 3190, 'FRAPPUCCINO dengan premium espresso', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(35, 'DC035', 'HOT AMERICANO', 16000, 5100, '6cbdc4cbea5bc5eed25ad2264c4d560a.jpeg', 1, 1760, 'Americano dengan premium espresso', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(36, 'DC036', 'HOT HAZELNUT LATTE', 27000, 14400, 'd293794345bf9e162257ccf4ef9a5e3e.jpeg', 1, 2970, 'Kopi latte dengan syrup hazelnut', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(37, 'DC037', 'HOT VANILLA LATTE', 27000, 14400, 'a7fdcc18abb2d343a874bdfd7d8101c5.jpeg', 1, 2970, 'Kopi latte dengan syrup vanilla', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(38, 'DC038', 'HOT CARAMEL LATTE', 27000, 14400, '2a91b7ca4ce1e80daac6ca3c14c77e7d.jpeg', 1, 2970, 'Kopi latte dengan syrup caramel', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(39, 'DC039', 'VIETNAM DRIVE', 22000, 6060, '933b386539d750bd725ba7b854df4ed8.jpeg', 1, 2420, 'Vietnam Drive dengan rasa yang creamy', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(40, 'DC040', 'V60', 25000, 7650, 'd0868edd87ffa2dbebfcc7456be75660.jpeg', 1, 2750, 'V60 ', '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(41, 'DC041', 'ESPRESSO', 15000, 4050, '02cfabfe64091b67aa1d3d91a49d6493.jpeg', 1, 1650, 'Premium Espresso dengan kopi houseblend ', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(42, 'DC042', 'HOT CAPPUCCINO', 22000, 11025, '8c93316b0d11b6752ce162f3491fa912.jpeg', 1, 2420, 'Perpaduan premium espresso dengan freshmilk', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(43, 'DC043', 'HOT COFFEE LATTE', 22000, 11025, '2db155ce69ff99380338d6072621a228.jpeg', 1, 2420, 'Perpaduan premium espresso dengan freshmilk', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(44, 'DC044', 'HOT MATCHA', 28000, 15458, 'a91f77e2fa15b88504a1a00b91ae74dd.jpg', 2, 3080, 'Green tea dengan campuran creamer dan freshmilk ', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(45, 'DC045', 'HOT CHOCOLATE', 35000, 23273, '533a45c61bc39d073c73f43b077d5e77.jpeg', 2, 3850, 'Coklat panas dengan campuran creamer dan freshmilk', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(46, 'DC046', 'ES BANANA FRAPE', 33000, 19425, '9c51a69925a5b4ea4715affa53e275ce.jpeg', 1, 3630, 'Frappuccino dengan rasa banana', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(47, 'DC047', 'ES TIRAMISU FRAPE', 33000, 19425, '08668e0e1a34bc6d50066baead961888.jpeg', 1, 3630, 'Kopi frappuccino dengan rasa tiramisu', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(48, 'DC048', 'ES CARAMEL FRAPE', 34000, 19425, 'dad99105a5536dd0b2295d511eece876.jpeg', 1, 3740, 'Frappuccino kopi dengan rasa cramel', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(49, 'DC049', 'ES HAZELNUT FRAPE', 34000, 19425, 'ce44fa0f2f1f6e8e7e21c2429d48611b.jpeg', 1, 3740, 'Frappuccino kopi dengan ras hazelnut', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(50, 'DC050', 'ES VANILLA FRAPE', 34000, 19425, 'd17cdccdca93f1c01435d3dfa599052e.jpeg', 1, 3740, 'Frappuccino kopi dengan rasa vanilla', '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(51, 'DC051', 'DIVERSITY BLEND - 1', 200000, 135000, 'ecf736846ff2f58b11a061ad2208cd7a.jpg', 1, 2200, 'ARABIKA 70% ROBUSTA 30% TERBUAT DARI BIJI KOPI PILIHAN KUALITAS PREMIUM', '2023-01-21 00:00:00', '2023-01-21 00:00:00'),
(52, 'DC052', 'DIVERSITY BLEND - 1', 110000, 67500, 'dc62faaea84146036489e941f11e8b0e.jpg', 1, 12100, 'ARABIKA 70% ROBUSTA 30% TERBUAT DARI BIJI KOPI PILIHAN KUALITAS PREMIUM', '2023-01-21 00:00:00', '2023-01-21 00:00:00'),
(53, 'DC053', 'EXTRA SHOT ESPRESSO', 6000, 1350, 'cec839bbdc69bbd9900f9260b7f08189.jpeg', 1, 660, 'Additional Extrashot', '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(54, 'DC054', 'Diskon Es Americano', 11500, 3900, '3f4335e418b4e086dcf00832236ebb43.jpg', 1, 2530, '', '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(56, 'DC055', 'Diskon Hot Americano', 8000, 3900, '63cba44be2683c85b6efebafc3e322e1.jpg', 1, 1760, '', '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(57, 'DC056', 'Diskon HOT COFFEE LATTE', 11000, 7350, '43c90ff1ec45307ab019f43197654a8a.jpg', 1, 2420, '', '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(58, 'DC057', 'Diskon ES COFFEE LATTE', 14000, 7600, '6a21ac934148698f3dccf5c144a7796a.jpg', 1, 3080, '', '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(59, 'DC058', 'Diskon COLDBREW', 14000, 15000, 'ba2a7822cbdb4511b33912388facb78c.jpg', 1, 3080, '', '2023-01-25 00:00:00', '2023-01-25 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_bahan`
--

CREATE TABLE `produk_bahan` (
  `id_produk_bahan` bigint(20) UNSIGNED NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `bahan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk_bahan`
--

INSERT INTO `produk_bahan` (`id_produk_bahan`, `kode_produk`, `bahan_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'DC001', 4, 80, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(2, 'DC001', 3, 140, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(3, 'DC002', 9, 25, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(4, 'DC002', 3, 150, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(5, 'DC002', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(6, 'DC003', 11, 25, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(7, 'DC003', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(8, 'DC003', 3, 150, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(9, 'DC004', 10, 25, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(10, 'DC004', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(11, 'DC004', 3, 150, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(14, 'DC005', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(15, 'DC006', 7, 15, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(16, 'DC006', 6, 30, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(17, 'DC006', 4, 40, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(18, 'DC006', 3, 130, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(23, 'DC008', 3, 140, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(25, 'DC009', 3, 140, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(27, 'DC010', 3, 140, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(29, 'DC011', 3, 140, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(31, 'DC012', 3, 140, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(32, 'DC013', 9, 25, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(33, 'DC013', 3, 130, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(34, 'DC013', 4, 40, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(35, 'DC013', 19, 2, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(41, 'DC016', 4, 80, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(45, 'DC011', 17, 30, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(46, 'DC010', 16, 30, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(49, 'DC009', 15, 30, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(50, 'DC008', 14, 30, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(52, 'DC017', 12, 35, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(53, 'DC017', 8, 15, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(54, 'DC017', 22, 200, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(55, 'DC018', 22, 200, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(56, 'DC018', 8, 15, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(57, 'DC018', 13, 35, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(58, 'DC019', 24, 10, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(59, 'DC019', 23, 30, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(60, 'DC019', 22, 200, '2022-03-25 00:00:00', '2022-03-25 00:00:00'),
(62, 'DC015', 26, 350, '2022-03-30 00:00:00', '2022-03-30 00:00:00'),
(72, 'DC023', 28, 18, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(73, 'DC023', 9, 25, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(74, 'DC023', 7, 5, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(75, 'DC023', 3, 150, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(76, 'DC024', 28, 18, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(77, 'DC024', 11, 25, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(78, 'DC024', 7, 5, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(79, 'DC024', 3, 150, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(80, 'DC025', 28, 18, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(81, 'DC025', 10, 25, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(82, 'DC025', 7, 5, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(83, 'DC025', 3, 150, '2022-05-20 00:00:00', '2022-05-20 00:00:00'),
(84, 'DC005', 30, 7, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(85, 'DC005', 29, 14, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(86, 'DC005', 18, 7, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(87, 'DC005', 7, 7, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(88, 'DC005', 11, 4, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(89, 'DC005', 3, 130, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(90, 'DC008', 7, 10, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(91, 'DC009', 7, 10, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(92, 'DC010', 7, 10, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(93, 'DC011', 7, 10, '2022-12-09 00:00:00', '2022-12-09 00:00:00'),
(99, 'DC026', 26, 280, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(100, 'DC026', 9, 20, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(101, 'DC026', 3, 25, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(102, 'DC025', 31, 25, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(103, 'DC027', 32, 25, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(104, 'DC027', 9, 10, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(105, 'DC027', 3, 160, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(106, 'DC028', 12, 25, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(107, 'DC028', 9, 5, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(108, 'DC028', 3, 160, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(109, 'DC029', 25, 30, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(110, 'DC029', 3, 130, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(111, 'DC029', 10, 15, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(112, 'DC029', 4, 40, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(113, 'DC030', 18, 18, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(114, 'DC030', 29, 18, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(115, 'DC030', 30, 18, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(116, 'DC030', 7, 5, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(117, 'DC030', 11, 3, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(118, 'DC030', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(119, 'DC031', 34, 15, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(120, 'DC031', 4, 40, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(121, 'DC031', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(122, 'DC032', 34, 25, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(123, 'DC032', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(124, 'DC032', 4, 40, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(128, 'DC034', 25, 20, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(129, 'DC034', 4, 40, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(130, 'DC034', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(132, 'DC036', 11, 15, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(134, 'DC036', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(135, 'DC037', 9, 15, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(137, 'DC037', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(138, 'DC038', 10, 15, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(140, 'DC038', 3, 200, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(142, 'DC039', 5, 30, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(143, 'DC039', 7, 5, '2022-12-15 00:00:00', '2022-12-15 00:00:00'),
(145, 'DC041', 4, 80, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(147, 'DC042', 3, 200, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(149, 'DC043', 3, 200, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(151, 'DC044', 14, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(152, 'DC044', 7, 5, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(153, 'DC044', 3, 200, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(154, 'DC045', 29, 18, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(155, 'DC045', 30, 18, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(156, 'DC045', 18, 18, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(157, 'DC045', 7, 5, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(158, 'DC045', 3, 200, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(159, 'DC045', 11, 3, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(160, 'DC046', 32, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(161, 'DC046', 25, 30, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(162, 'DC046', 3, 130, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(163, 'DC046', 4, 40, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(164, 'DC047', 10, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(165, 'DC047', 25, 30, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(166, 'DC047', 3, 130, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(167, 'DC047', 4, 40, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(168, 'DC048', 10, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(169, 'DC048', 4, 40, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(170, 'DC048', 3, 130, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(171, 'DC048', 25, 30, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(172, 'DC049', 25, 30, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(173, 'DC049', 11, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(174, 'DC049', 3, 130, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(175, 'DC049', 4, 40, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(176, 'DC050', 9, 15, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(177, 'DC050', 4, 40, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(178, 'DC050', 25, 30, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(179, 'DC050', 3, 130, '2023-01-17 00:00:00', '2023-01-17 00:00:00'),
(180, 'DC040', 35, 20, '2023-01-19 00:00:00', '2023-01-19 00:00:00'),
(181, 'DC039', 36, 15, '2023-01-19 00:00:00', '2023-01-19 00:00:00'),
(182, 'DC051', 28, 1000, '2023-01-21 00:00:00', '2023-01-21 00:00:00'),
(183, 'DC052', 28, 500, '2023-01-21 00:00:00', '2023-01-21 00:00:00'),
(185, 'DC012', 30, 10, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(186, 'DC012', 29, 10, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(187, 'DC012', 18, 10, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(188, 'DC012', 7, 10, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(189, 'DC012', 11, 6, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(190, 'DC053', 4, 40, '2023-01-23 00:00:00', '2023-01-23 00:00:00'),
(191, 'DC022', 43, 360, '2023-01-24 00:00:00', '2023-01-24 00:00:00'),
(192, 'DC020', 43, 1008, '2023-01-24 00:00:00', '2023-01-24 00:00:00'),
(193, 'DC021', 45, 994, '2023-01-24 00:00:00', '2023-01-24 00:00:00'),
(194, 'DC054', 4, 80, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(195, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(196, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(197, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(198, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(199, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(200, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(201, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(202, '', 0, 0, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(203, 'DC055', 28, 18, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(204, 'DC035', 28, 18, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(205, 'DC056', 3, 200, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(206, 'DC056', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(207, 'DC057', 3, 140, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(208, 'DC057', 4, 80, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(209, 'DC043', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(210, 'DC042', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(211, 'DC038', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(212, 'DC037', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(213, 'DC036', 28, 9, '2023-01-25 00:00:00', '2023-01-25 00:00:00'),
(214, 'DC058', 26, 355, '2023-01-25 00:00:00', '2023-01-25 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_extras`
--

CREATE TABLE `produk_extras` (
  `id_produk_extras` bigint(20) UNSIGNED NOT NULL,
  `extras_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk_extras`
--

INSERT INTO `produk_extras` (`id_produk_extras`, `extras_id`, `produk_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-03-22 00:00:00', '2022-03-22 00:00:00'),
(2, 2, 2, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(3, 3, 3, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(4, 4, 4, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(5, 5, 5, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(6, 6, 6, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(7, 7, 13, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(8, 8, 16, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(9, 9, 2, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(11, 11, 3, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(12, 12, 4, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(13, 13, 13, '2022-03-23 00:00:00', '2022-03-23 00:00:00'),
(14, 14, 21, '2022-03-30 00:00:00', '2022-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk_kategori`
--

INSERT INTO `produk_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'KOPI'),
(2, 'NON KOPI'),
(3, 'MOCKTAIL'),
(4, 'SNACK'),
(5, 'ALL VARIAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `cash_in_hand` int(11) NOT NULL,
  `status_shift` varchar(10) NOT NULL,
  `total_cash` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `pendapatan` int(11) DEFAULT NULL,
  `total_cash_submitted` decimal(25,2) DEFAULT NULL,
  `total_cheques_submitted` int(11) DEFAULT NULL,
  `total_cc_slips_submitted` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `transfer_opened_bills` varchar(50) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `shift_name` varchar(255) NOT NULL,
  `kode_register` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `registers`
--

INSERT INTO `registers` (`id`, `date`, `user_id`, `cash_in_hand`, `status_shift`, `total_cash`, `pengeluaran`, `pendapatan`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`, `store_id`, `shift_name`, `kode_register`) VALUES
(1, '2022-03-21 06:08:19', 1, 0, 'close', 0, 0, 0, NULL, NULL, NULL, 'T', '2022-03-21 06:08:30', NULL, 1, 1, 'diversitycoffee', 'REG00001'),
(2, '2022-03-23 03:09:32', 1, 100000, 'close', 100000, NULL, NULL, NULL, NULL, NULL, ' ', '2022-03-23 03:09:32', NULL, 1, 1, 'diversitycoffee', 'REG00002'),
(3, '2022-03-22 12:36:21', 1, 0, 'close', 0, 0, 0, NULL, NULL, NULL, 'H', '2022-03-22 12:40:28', NULL, 1, 1, 'diversitycoffee', 'REG00003'),
(4, '2022-03-22 12:52:20', 1, 0, 'close', 0, 0, 0, NULL, NULL, NULL, 'J', '2022-03-22 12:52:45', NULL, 1, 1, 'diversitycoffee', 'REG00004'),
(5, '2022-03-22 12:53:29', 1, 0, 'close', 0, 0, 0, NULL, NULL, NULL, 'Hj', '2022-03-22 12:54:15', NULL, 1, 1, 'diversitycoffee', 'REG00005'),
(6, '2022-03-26 03:10:34', 1, 0, 'close', 129800, NULL, 129800, NULL, NULL, NULL, 'w', '2022-03-26 03:10:34', NULL, 1, 1, 'diversitycoffee', 'REG00006'),
(7, '2022-03-26 03:10:44', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'ww', '2022-03-26 03:10:44', NULL, 1, 1, 'diversitycoffee', 'REG00007'),
(8, '2022-03-26 03:10:58', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'ww', '2022-03-26 03:10:58', NULL, 1, 1, 'diversitycoffee', 'REG00008'),
(9, '2022-03-26 03:11:03', 2, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'ww', '2022-03-26 03:11:03', NULL, 1, 1, 'kasir', 'REG00009'),
(10, '2022-03-30 08:20:33', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00010'),
(11, '2022-04-02 02:22:42', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00011'),
(12, '2022-04-02 02:36:19', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00012'),
(13, '2022-04-08 07:26:50', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00013'),
(14, '2022-04-19 06:40:22', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00014'),
(15, '2022-04-22 08:11:10', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00015'),
(16, '2022-04-29 07:01:35', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00016'),
(17, '2022-05-20 09:23:58', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00017'),
(18, '2022-05-25 08:04:12', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00018'),
(19, '2022-05-31 07:17:44', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00019'),
(20, '2022-06-27 07:46:41', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00020'),
(21, '2022-06-29 04:53:14', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00021'),
(22, '2023-01-03 03:34:58', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'tutup', '2023-01-03 03:34:58', NULL, 1, 1, 'diversitycoffee', 'REG00022'),
(23, '2023-01-03 03:42:36', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00023'),
(24, '2023-01-20 06:22:48', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00024'),
(25, '2023-01-21 03:57:01', 1, 1, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00025'),
(26, '2023-01-22 01:48:12', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00026'),
(27, '2023-01-22 08:55:12', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00027'),
(28, '2023-01-23 01:07:39', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00028'),
(29, '2023-01-23 07:48:54', 2, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00029'),
(30, '2023-01-23 11:07:16', 2, 200000, 'close', 4987000, 0, 4787000, NULL, NULL, NULL, '4987000', '2023-01-23 14:21:09', NULL, 2, 1, 'kasir', 'REG00030'),
(31, '2023-01-24 00:32:42', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00031'),
(32, '2023-01-24 03:43:18', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, '.', '2023-01-24 03:43:18', NULL, 1, 1, 'diversitycoffee', 'REG00032'),
(33, '2023-01-24 08:10:50', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00033'),
(34, '2023-01-24 11:23:16', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00034'),
(35, '2023-01-25 00:35:08', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00035'),
(36, '2023-01-25 05:10:19', 2, 2000000, 'close', 3253000, 0, 1253000, NULL, NULL, NULL, '3253000', '2023-01-25 13:47:30', NULL, 2, 1, 'kasir', 'REG00036'),
(37, '2023-01-26 01:38:31', 2, 200000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00037'),
(38, '2023-01-26 04:22:29', 2, 200000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00038'),
(39, '2023-01-27 01:41:14', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00039'),
(40, '2023-01-27 01:41:51', 2, 2000000, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kasir', 'REG00040'),
(41, '0000-00-00 00:00:00', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'test', '2023-02-01 05:36:32', NULL, 1, 1, 'diversitycoffee', 'REG00041'),
(42, '0000-00-00 00:00:00', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'test', '2023-02-01 05:36:42', NULL, 1, 1, 'diversitycoffee', 'REG00042'),
(43, '2023-01-27 09:43:13', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00043'),
(44, '2023-01-28 03:45:14', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00044'),
(45, '2023-01-28 07:01:49', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00045'),
(46, '2023-01-28 07:48:29', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00046'),
(47, '2023-01-31 02:28:04', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00047'),
(48, '0000-00-00 00:00:00', 1, 0, 'close', 0, NULL, NULL, NULL, NULL, NULL, 'test', '2023-02-01 05:36:25', NULL, 1, 1, 'diversitycoffee', 'REG00048'),
(49, '2023-01-31 03:03:30', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'diversitycoffee', 'REG00049'),
(50, '0000-00-00 00:00:00', 1, 0, 'close', 132000, NULL, 132000, NULL, NULL, NULL, 'w', '2023-02-01 05:36:17', NULL, 1, 1, 'diversitycoffee', 'REG00050'),
(51, '2023-02-01 05:33:53', 1, 0, 'close', 33000, 0, 33000, NULL, NULL, NULL, 'w', '2023-02-01 05:35:56', NULL, 1, 1, 'diversitycoffee', 'REG00051'),
(52, '2023-02-14 04:30:34', 1, 0, 'close', 140000, NULL, 140000, NULL, NULL, NULL, 'test', '2023-02-14 04:33:41', NULL, 1, 1, 'diversitycoffee', 'REG00052'),
(53, '2023-04-15 07:37:57', 1, 0, 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', 'REG00053');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id_stock` bigint(20) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id_stock`, `bahan_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(1, 0, 'in', '', 1, 0, '2022-03-22 00:00:00', '2022-03-22 13:25:17', 1),
(2, 1, 'in', 'MINUMAN BERBAHAN KOPI', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 13:26:44', 1),
(3, 2, 'in', 'MINUMAN BERBAHAN KOPI', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 13:29:05', 1),
(4, 0, 'in', '', 1, 0, '2022-03-22 00:00:00', '2022-03-22 13:34:37', 1),
(5, 0, 'in', '', 1, 0, '2022-03-22 00:00:00', '2022-03-22 13:35:27', 1),
(6, 3, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 13:37:24', 1),
(7, 0, 'in', '', 1, 0, '2022-03-22 00:00:00', '2022-03-22 13:45:17', 1),
(8, 4, 'in', 'MINUMAN BERBAHAN KOPI', 1, 1000, '2022-03-22 00:00:00', '2022-03-22 13:45:45', 1),
(9, 5, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:16:36', 1),
(10, 0, 'in', '', 1, 0, '2022-03-22 00:00:00', '2022-03-22 14:18:33', 1),
(11, 6, 'in', 'MINUMAN BERBAHAN KOPI', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:19:01', 1),
(12, 7, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:20:31', 1),
(13, 4, 'in', 'MINUMAN BERBAHAN KOPI', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:21:12', 1),
(14, 4, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 1000, '2022-03-22 00:00:00', '2022-03-22 14:24:04', 1),
(15, 8, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:37:32', 1),
(16, 9, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:38:04', 1),
(17, 10, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:38:33', 1),
(18, 11, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:38:55', 1),
(19, 12, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:39:18', 1),
(20, 13, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:39:39', 1),
(21, 14, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:40:31', 1),
(22, 15, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:40:52', 1),
(23, 16, 'in', 'untuk semua menu', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:41:14', 1),
(24, 17, 'in', 'UNTUK MINUMAN NON KOPI', 1, 2000, '2022-03-22 00:00:00', '2022-03-22 14:41:55', 1),
(25, 1, 'in', 'MINUMAN BERBAHAN KOPI', 1, 545000, '2022-03-25 00:00:00', '2022-03-25 13:45:38', 1),
(26, 1, 'in', 'MINUMAN BERBAHAN KOPI', 1, 5470, '2022-03-25 00:00:00', '2022-03-25 13:48:44', 1),
(27, 2, 'in', 'MINUMAN BERBAHAN KOPI', 1, 390, '2022-03-25 00:00:00', '2022-03-25 13:51:36', 1),
(28, 2, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 2000, '2022-03-25 00:00:00', '2022-03-25 13:53:34', 1),
(29, 1, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 547020, '2022-03-25 00:00:00', '2022-03-25 13:56:43', 1),
(30, 3, 'out', 'untuk semua menu', NULL, 450, '2022-03-25 00:00:00', '2022-03-25 14:01:14', 1),
(31, 7, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 1100, '2022-03-25 00:00:00', '2022-03-25 14:05:58', 1),
(32, 5, 'out', 'untuk semua menu', NULL, 520, '2022-03-25 00:00:00', '2022-03-25 14:08:05', 1),
(33, 4, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 1920, '2022-03-25 00:00:00', '2022-03-25 14:09:45', 1),
(34, 6, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 2000, '2022-03-25 00:00:00', '2022-03-25 14:10:34', 1),
(35, 8, 'out', 'UNTUK MINUMAN NON KOPI', NULL, 2000, '2022-03-25 00:00:00', '2022-03-25 14:11:45', 1),
(36, 9, 'in', 'UNTUK SEMUA MINUMAN', 1, 950, '2022-03-25 00:00:00', '2022-03-25 14:15:02', 1),
(37, 10, 'in', 'UNTUK SEMUA MINUMAN', 1, 1000, '2022-03-25 00:00:00', '2022-03-25 14:17:15', 1),
(38, 13, 'out', 'UNTUK MINUMAN NON KOPI', NULL, 2000, '2022-03-25 00:00:00', '2022-03-25 14:20:47', 1),
(39, 14, 'out', 'UNTUK MINUMAN NON KOPI', NULL, 2000, '2022-03-25 00:00:00', '2022-03-25 14:26:25', 1),
(40, 15, 'out', 'UNTUK MINUMAN NON KOPI', NULL, 1000, '2022-03-25 00:00:00', '2022-03-25 14:27:02', 1),
(41, 20, 'in', 'UNTUK MINUMAN NON KOPI', 1, 1000, '2022-03-25 00:00:00', '2022-03-25 14:33:15', 1),
(42, 18, 'in', 'UNTUK SEMUA MINUMAN', 1, 20, '2022-03-25 00:00:00', '2022-03-25 14:35:05', 1),
(43, 18, 'in', 'UNTUK SEMUA MINUMAN', 1, 5, '2022-03-25 00:00:00', '2022-03-25 14:35:48', 1),
(44, 25, 'in', 'UNTUK SEMUA MINUMAN', 1, 1000, '2022-03-25 00:00:00', '2022-03-25 14:54:10', 1),
(45, 26, 'in', 'MINUMAN BERBAHAN KOPI', 1, 1500, '2022-03-30 00:00:00', '2022-03-30 14:07:56', 1),
(46, 3, 'in', 'UNTUK SEMUA MINUMAN', 1, 7200, '2022-04-02 00:00:00', '2022-04-02 08:49:26', 1),
(47, 10, 'out', 'UNTUK SEMUA MINUMAN', NULL, 120, '2022-04-02 00:00:00', '2022-04-02 09:01:08', 1),
(48, 5, 'out', 'UNTUK SEMUA MINUMAN', NULL, 300, '2022-04-02 00:00:00', '2022-04-02 09:03:20', 1),
(49, 3, 'out', 'UNTUK SEMUA MINUMAN', NULL, 2940, '2022-04-02 00:00:00', '2022-04-02 09:03:58', 1),
(50, 4, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 960, '2022-04-02 00:00:00', '2022-04-02 09:04:47', 1),
(51, 4, 'in', 'MINUMAN BERBAHAN KOPI', 1, 2500, '2022-04-02 00:00:00', '2022-04-02 09:05:15', 1),
(52, 6, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 360, '2022-04-02 00:00:00', '2022-04-02 09:07:24', 1),
(53, 7, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 180, '2022-04-02 00:00:00', '2022-04-02 09:07:54', 1),
(54, 3, 'out', 'UNTUK SEMUA MINUMAN', NULL, 1560, '2022-04-02 00:00:00', '2022-04-02 09:08:28', 1),
(55, 4, 'out', 'MINUMAN BERBAHAN KOPI', NULL, 480, '2022-04-02 00:00:00', '2022-04-02 09:09:00', 1),
(56, 6, 'in', 'MINUMAN BERBAHAN KOPI', 1, 7800, '2022-04-02 00:00:00', '2022-04-02 09:12:49', 1),
(57, 29, 'in', 'Bahan baku untuk allvarian menu', 1, 1800, '2022-12-09 00:00:00', '2022-12-09 16:08:36', 1),
(58, 30, 'in', 'Bahan baku untuk allvarian menu', 1, 450, '2022-12-09 00:00:00', '2022-12-09 18:18:15', 1),
(59, 0, 'in', 'Larutan ketan hitam', 1, 490, '2023-01-22 00:00:00', '2023-01-22 20:56:22', 1),
(60, 0, 'in', 'Larutan ketan hitam', 1, 490, '2023-01-22 00:00:00', '2023-01-22 20:56:35', 1),
(61, 42, 'in', 'Larutan ketan hitam', 1, 490, '2023-01-22 00:00:00', '2023-01-22 20:59:01', 1),
(62, 41, 'in', 'Larutan matcha', 1, 770, '2023-01-22 00:00:00', '2023-01-22 21:02:07', 1),
(63, 40, 'in', 'Larutan klepon', 1, 570, '2023-01-22 00:00:00', '2023-01-22 21:03:20', 1),
(64, 39, 'in', 'Larutan taro', 1, 700, '2023-01-22 00:00:00', '2023-01-22 21:03:52', 1),
(65, 38, 'in', 'Larutan coklat', 1, 740, '2023-01-22 00:00:00', '2023-01-22 21:04:48', 1),
(66, 37, 'in', 'Syrup tiramisu', 1, 710, '2023-01-22 00:00:00', '2023-01-22 21:08:13', 1),
(67, 3, 'in', '', 1, 13305, '2023-01-22 00:00:00', '2023-01-22 21:10:14', 1),
(68, 4, 'in', '', 1, 1582, '2023-01-22 00:00:00', '2023-01-22 21:12:40', 1),
(69, 5, 'in', '', 1, 685, '2023-01-22 00:00:00', '2023-01-22 21:14:08', 1),
(70, 6, 'out', '', NULL, 418, '2023-01-22 00:00:00', '2023-01-22 21:15:56', 1),
(71, 7, 'in', '', 1, 456, '2023-01-22 00:00:00', '2023-01-22 21:17:04', 1),
(72, 8, 'in', '', 1, 1096, '2023-01-22 00:00:00', '2023-01-22 21:18:29', 1),
(73, 9, 'out', '', NULL, 300, '2023-01-22 00:00:00', '2023-01-22 21:20:55', 1),
(74, 10, 'in', '', 1, 1209, '2023-01-22 00:00:00', '2023-01-22 21:22:18', 1),
(75, 10, 'in', '', 1, 1209, '2023-01-22 00:00:00', '2023-01-22 21:22:19', 1),
(76, 11, 'in', '', 1, 2413, '2023-01-22 00:00:00', '2023-01-22 21:23:08', 1),
(77, 12, 'in', '', 1, 1350, '2023-01-22 00:00:00', '2023-01-22 21:23:44', 1),
(78, 13, 'in', '', 1, 3557, '2023-01-22 00:00:00', '2023-01-22 21:24:16', 1),
(79, 14, 'in', '', 1, 2980, '2023-01-22 00:00:00', '2023-01-22 21:24:57', 1),
(80, 15, 'out', '', NULL, 380, '2023-01-22 00:00:00', '2023-01-22 21:26:00', 1),
(81, 16, 'in', '', 1, 719, '2023-01-22 00:00:00', '2023-01-22 21:26:59', 1),
(82, 17, 'in', '', 1, 710, '2023-01-22 00:00:00', '2023-01-22 21:27:27', 1),
(83, 18, 'in', '', 1, 1460, '2023-01-22 00:00:00', '2023-01-22 21:28:00', 1),
(84, 22, 'in', '', 1, 2700, '2023-01-22 00:00:00', '2023-01-22 21:28:31', 1),
(85, 23, 'in', '', 1, 2425, '2023-01-22 00:00:00', '2023-01-22 21:28:56', 1),
(86, 24, 'in', '', 1, 435, '2023-01-22 00:00:00', '2023-01-22 21:29:24', 1),
(87, 25, 'in', '', 1, 500, '2023-01-22 00:00:00', '2023-01-22 21:29:52', 1),
(88, 26, 'in', '', 1, 3110, '2023-01-22 00:00:00', '2023-01-22 21:30:20', 1),
(89, 27, 'in', '', 1, 2520, '2023-01-22 00:00:00', '2023-01-22 21:32:21', 1),
(90, 28, 'in', '', 1, 1008, '2023-01-22 00:00:00', '2023-01-22 21:32:56', 1),
(91, 29, 'in', '', 1, 10, '2023-01-22 00:00:00', '2023-01-22 21:33:33', 1),
(92, 30, 'in', '', 1, 320, '2023-01-22 00:00:00', '2023-01-22 21:34:08', 1),
(93, 32, 'in', '', 1, 3698, '2023-01-22 00:00:00', '2023-01-22 21:34:30', 1),
(94, 34, 'in', '', 1, 800, '2023-01-22 00:00:00', '2023-01-22 21:35:19', 1),
(95, 35, 'in', '', 1, 373, '2023-01-22 00:00:00', '2023-01-22 21:35:44', 1),
(96, 36, 'in', '', 1, 925, '2023-01-22 00:00:00', '2023-01-22 21:36:02', 1),
(97, 39, 'in', '', 1, 1000, '2023-01-24 00:00:00', '2023-01-24 15:50:47', 1),
(98, 39, 'out', '', NULL, 1000, '2023-01-24 00:00:00', '2023-01-24 15:51:27', 1),
(99, 28, 'in', '', 1, 1176, '2023-01-24 00:00:00', '2023-01-24 16:27:42', 1),
(100, 31, 'in', '', 1, 1100, '2023-01-24 00:00:00', '2023-01-24 16:31:23', 1),
(101, 3, 'in', '', 1, 12000, '2023-01-24 00:00:00', '2023-01-24 16:32:26', 1),
(102, 7, 'in', '', 1, 2500, '2023-01-24 00:00:00', '2023-01-24 16:33:43', 1),
(103, 22, 'in', '', 1, 12000, '2023-01-24 00:00:00', '2023-01-24 16:35:36', 1),
(104, 24, 'in', '', 1, 460, '2023-01-24 00:00:00', '2023-01-24 16:48:57', 1),
(105, 43, 'in', '', 1, 3600, '2023-01-24 00:00:00', '2023-01-24 16:58:16', 1),
(106, 26, 'out', '', NULL, 360, '2023-01-24 00:00:00', '2023-01-24 17:06:01', 1),
(107, 44, 'in', '', 1, 500, '2023-01-24 00:00:00', '2023-01-24 17:19:26', 1),
(108, 28, 'out', '', NULL, 500, '2023-01-24 00:00:00', '2023-01-24 17:20:12', 1),
(109, 28, 'in', '', 1, 1000, '2023-01-24 00:00:00', '2023-01-24 17:23:46', 1),
(110, 15, 'out', '', NULL, 180, '2023-01-24 00:00:00', '2023-01-24 17:26:18', 1),
(111, 7, 'out', '', NULL, 60, '2023-01-24 00:00:00', '2023-01-24 17:26:49', 1),
(112, 3, 'out', '', NULL, 840, '2023-01-24 00:00:00', '2023-01-24 17:27:32', 1),
(113, 15, 'out', '', NULL, 180, '2023-01-24 00:00:00', '2023-01-24 17:52:41', 1),
(114, 15, 'in', '', 1, 360, '2023-01-24 00:00:00', '2023-01-24 17:53:27', 1),
(115, 16, 'out', '', NULL, 180, '2023-01-24 00:00:00', '2023-01-24 17:53:53', 1),
(116, 7, 'out', '', NULL, 15, '2023-01-24 00:00:00', '2023-01-24 17:54:56', 1),
(117, 3, 'out', '', NULL, 220, '2023-01-24 00:00:00', '2023-01-24 17:55:45', 1),
(118, 26, 'in', '', 1, 2350, '2023-01-24 00:00:00', '2023-01-24 18:00:40', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_harga_online`
--

CREATE TABLE `type_harga_online` (
  `harga_online_id` int(11) NOT NULL,
  `harga_online_nama` varchar(500) NOT NULL,
  `harga_online` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `type_harga_online`
--

INSERT INTO `type_harga_online` (`harga_online_id`, `harga_online_nama`, `harga_online`) VALUES
(1, 'Offline Customer', 0),
(2, 'Shopeefood', 2000),
(3, 'Grabfood', 1000),
(4, 'Gofood', 1500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Owner','Admin','Kasir') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Tidak Aktif','Aktif','Terblokir','') NOT NULL DEFAULT 'Tidak Aktif',
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `created_at`, `updated_at`, `status`, `photo`) VALUES
(1, 'Admin', 'admin', '123456', 'Admin', '2022-02-10 05:47:28', '2022-02-10 05:47:35', 'Aktif', 'admin.png'),
(2, 'Kasir 1', 'kasir', '$2y$10$4a3pLKsjpnhFVmJvrfs8rebov8Q113eNGjdGudAzY3ZCuE8HBnblC', 'Kasir', '2022-02-10 05:47:28', '2022-02-10 05:47:35', 'Aktif', 'admin.png'),
(5, 'Web Developer', 'developer', '$2y$10$lx0iu7wO2lMA/XckABH0ROm6rG0f5HaT5lSRgpnjAma.lMraRpaZ6', 'Admin', '2023-01-25 08:33:00', '2023-01-25 08:33:00', 'Aktif', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`),
  ADD UNIQUE KEY `kode_bahan` (`kode_bahan`);

--
-- Indeks untuk tabel `bahan_kategori`
--
ALTER TABLE `bahan_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `bahan_penjualan`
--
ALTER TABLE `bahan_penjualan`
  ADD PRIMARY KEY (`id_bp`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id_extras`),
  ADD UNIQUE KEY `kode_extras` (`kode_extras`);

--
-- Indeks untuk tabel `extras_bahan`
--
ALTER TABLE `extras_bahan`
  ADD PRIMARY KEY (`id_extras_bahan`);

--
-- Indeks untuk tabel `extras_menu`
--
ALTER TABLE `extras_menu`
  ADD PRIMARY KEY (`id_extras_menu`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_byr`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `produk_bahan`
--
ALTER TABLE `produk_bahan`
  ADD PRIMARY KEY (`id_produk_bahan`);

--
-- Indeks untuk tabel `produk_extras`
--
ALTER TABLE `produk_extras`
  ADD PRIMARY KEY (`id_produk_extras`);

--
-- Indeks untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_register` (`kode_register`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indeks untuk tabel `type_harga_online`
--
ALTER TABLE `type_harga_online`
  ADD PRIMARY KEY (`harga_online_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `bahan_kategori`
--
ALTER TABLE `bahan_kategori`
  MODIFY `id_kategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bahan_penjualan`
--
ALTER TABLE `bahan_penjualan`
  MODIFY `id_bp` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `extras`
--
ALTER TABLE `extras`
  MODIFY `id_extras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `extras_bahan`
--
ALTER TABLE `extras_bahan`
  MODIFY `id_extras_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `extras_menu`
--
ALTER TABLE `extras_menu`
  MODIFY `id_extras_menu` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_byr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `produk_bahan`
--
ALTER TABLE `produk_bahan`
  MODIFY `id_produk_bahan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT untuk tabel `produk_extras`
--
ALTER TABLE `produk_extras`
  MODIFY `id_produk_extras` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT untuk tabel `type_harga_online`
--
ALTER TABLE `type_harga_online`
  MODIFY `harga_online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
