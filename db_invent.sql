-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2024 pada 15.53
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invent_app`
--
CREATE DATABASE IF NOT EXISTS `invent_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `invent_app`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_supplier`
--

CREATE TABLE `tabel_supplier` (
  `id_supplier` varchar(9) NOT NULL,
  `id_user` varchar(9) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_supplier`
--

INSERT INTO `tabel_supplier` (`id_supplier`, `id_user`, `nama_supplier`, `created_at`) VALUES
('sup1', 'usr2', 'Purnama Zhang', '2024-03-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `id_barang` varchar(9) NOT NULL,
  `id_user` varchar(9) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`id_barang`, `id_user`, `nama_barang`, `jumlah_barang`, `tanggal_keluar`) VALUES
('133078488', 'user_1219', 'Anis Entod', 5, '2024-04-01'),
('133100877', 'user_1219', 'Prabowo Parlay', 2, '2024-04-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_masuk`
--

CREATE TABLE `tb_barang_masuk` (
  `id_barang` varchar(9) NOT NULL,
  `id_user` varchar(9) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`id_barang`, `id_user`, `nama_barang`, `jumlah_barang`, `tanggal_masuk`) VALUES
('137000323', 'user_1219', 'Prabowo Parlay', 12, '2024-04-01'),
('185215732', 'user_1219', 'Anis Entod', 50, '2024-03-28'),
('225096915', 'user_1219', 'Bapak kau', 42, '2024-04-01'),
('789774087', 'user_1219', 'Kawan Ganjar Porn Hub', 213, '2024-03-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `role` enum('Admin','Supplier','User','') NOT NULL,
  `password` text NOT NULL,
  `created_at` date NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `email`, `no_hp`, `role`, `password`, `created_at`, `nama_lengkap`) VALUES
('user_2397', 'admin', 'admin@gmail.com', '082155553355', 'Admin', '$2y$10$lMegNvYwXiZRqu7LXiSXvej7N2HfG2cqBLe2eUtJ7UxPHRpHl/UdW', '2024-04-07', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
