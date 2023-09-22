-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2023 pada 02.30
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasindo_syariah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_dataset`
--

CREATE TABLE `table_dataset` (
  `id` int(11) NOT NULL,
  `nama_dataset` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_keterangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_keterangan`
--

CREATE TABLE `table_keterangan` (
  `id` int(11) NOT NULL,
  `nama_keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `table_keterangan`
--

INSERT INTO `table_keterangan` (`id`, `nama_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'menunggu analisis data', '2023-08-17 15:00:04', '2023-08-17 15:00:04'),
(2, 'sedang dalam analisis', '2023-08-17 15:00:04', '2023-08-17 15:00:04'),
(3, 'selesai analisis data', '2023-08-17 15:00:04', '2023-08-17 15:00:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_role`
--

CREATE TABLE `table_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `table_role`
--

INSERT INTO `table_role` (`id`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-08-14 12:47:32', '2023-08-14 12:47:32'),
(2, 'staff', '2023-08-14 12:47:32', '2023-08-14 12:47:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_user`
--

CREATE TABLE `table_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `table_user`
--

INSERT INTO `table_user` (`id`, `nama`, `username`, `password`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$gkYtStBxPtJdBkX9t6Ii1OnNpucE.KN7ZqSx0lbE1UFyuvEHYasv2', 1, '2023-08-14 10:45:55', '2023-08-14 10:45:55'),
(2, 'Testing', 'staff', '$2y$10$BCR0mKvvd9uBf/rm2yYgj.6SBEDuYvssn0dAgza7nnUdSj2ahdz1m', 2, '2023-08-14 10:48:14', '2023-08-14 10:48:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_visual`
--

CREATE TABLE `table_visual` (
  `id` int(11) NOT NULL,
  `id_dataset` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `table_dataset`
--
ALTER TABLE `table_dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_keterangan`
--
ALTER TABLE `table_keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_role`
--
ALTER TABLE `table_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_visual`
--
ALTER TABLE `table_visual`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `table_dataset`
--
ALTER TABLE `table_dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `table_keterangan`
--
ALTER TABLE `table_keterangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `table_role`
--
ALTER TABLE `table_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `table_visual`
--
ALTER TABLE `table_visual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
