-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2023 pada 14.42
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_album`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agensi`
--

CREATE TABLE `agensi` (
  `id_agensi` int(11) NOT NULL,
  `nama_agensi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agensi`
--

INSERT INTO `agensi` (`id_agensi`, `nama_agensi`) VALUES
(1, 'HYBE'),
(5, 'SM'),
(9, 'YG'),
(16, 'JYP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `id_grup` int(11) NOT NULL,
  `id_agensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`id_album`, `judul`, `harga`, `cover`, `id_grup`, `id_agensi`) VALUES
(5, 'Blue Hour + signatures', 345000, 'Blue Hour With Signatures.jpg', 3, 1),
(6, 'Butter', 530900, 'Butter.jpg', 1, 1),
(7, 'Kill This Love', 369456, 'KILL THIS LOVE.jpg', 4, 9),
(9, 'Teen, Age', 275000, 'Teen, Age.jpeg', 6, 1),
(12, 'New Jeans', 315000, 'New Jeans.jpeg', 8, 1),
(13, 'Love Shot', 299999, 'love Shot.jpeg', 7, 5),
(14, 'Power', 292000, 'Power.jpeg', 7, 5),
(15, 'Signal', 312999, 'Signal.jpeg', 13, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`) VALUES
(1, 'BTS'),
(3, 'TXT'),
(4, 'BLACKPINK'),
(6, 'SEVENTEEN'),
(7, 'EXO'),
(8, 'NEW JEANS'),
(13, 'TWICE');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agensi`
--
ALTER TABLE `agensi`
  ADD PRIMARY KEY (`id_agensi`);

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_grup` (`id_grup`),
  ADD KEY `id_agensi` (`id_agensi`);

--
-- Indeks untuk tabel `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agensi`
--
ALTER TABLE `agensi`
  MODIFY `id_agensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`) ON UPDATE CASCADE,
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`id_agensi`) REFERENCES `agensi` (`id_agensi`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
