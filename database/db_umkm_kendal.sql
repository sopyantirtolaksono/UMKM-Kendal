-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2023 pada 12.35
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm_kendal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'alta', 'alta123', 'Khoirul Altakim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id_member` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Tidak Terverifikasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_member`
--

INSERT INTO `tbl_member` (`id_member`, `username`, `password`, `nama_lengkap`, `status`) VALUES
(2, 'sopyan', '1234', 'Sopyan Tirto Laksono', 'Terverifikasi'),
(3, 'Yohanes', '1234', 'Yohanes Adi Prayogo', 'Terverifikasi'),
(4, 'khamdan', '1234', 'Khamdan Khamdan', 'Tidak Terverifikasi'),
(6, 'su', '1234', 'Susi', 'Terverifikasi'),
(7, 'pakcoba', '1234', 'Pak Coba', 'Terverifikasi'),
(8, 'ali', '1234', 'Pak Ali', 'Terverifikasi'),
(9, 'test', '1234', 'Test Test', 'Terverifikasi'),
(10, 'sosron', '1234567890', 'M Yusron', 'Terverifikasi'),
(11, 'altarecord', '1234', 'ALTA RECORD', 'Terverifikasi'),
(12, 'bebekbakar', '1234', 'BEBEK BAKAR', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `gambar_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_umkm`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `gambar_produk`) VALUES
(1, 1, 1, 'Brown Roll Tiramisu', '5', 'Roti tiramisu coklat mix roll.', '5e09ea65702e5_LT5CZt8.jpg'),
(4, 1, 1, 'Pizza Planet', '50', 'Enak, Pedas, Manis', '5e09ee7037600_40_Mac_OS_X_Wallpapers_HD__2560x1600__www.HQPictures.tk-24.jpg_Mac_OS_X_39.jpg'),
(5, 3, 2, 'Chocholate Drink', '10', 'Manis, Enak, JOS.', '5e0affe1d3a4e_Mountain-Peak-Landscapes-35_www.FullHDWpp.com_.jpg'),
(8, 5, 2, 'Cobo Choco', '10', 'Manis, Legit', '5e0daf314d5d6_LT5CZt8.jpg'),
(9, 8, 1, 'Mie PEL', '15', 'Enak, Lezat, Pedas', '5e0eae43c83d4_LT5CZt8.jpg'),
(10, 7, 1, 'Nasi Padang', '10', 'Nasi, Rendang, Oseng', '5e0eb39feb89b_display-wallpaper-14.jpg'),
(11, 1, 2, 'Coco Babble Milk', '12', 'Manis, Legit', '5e0ebf1ee7304_display-wallpaper-14.jpg'),
(15, 5, 1, 'Coco Babble Milk', '12', 'Enak, Lezat, Pedas', '5e0ec41a3d262_display-wallpaper-14.jpg'),
(16, 5, 2, 'Cobo Choco', '55', 'Enak, Lezat, Pedas', '5e0ec42a999e5_display-wallpaper-14.jpg'),
(17, 5, 1, 'Cobo Choco', '11', 'Nasi, Rendang, Oseng', '5e0ec43bae03c_abstract_blue_smoke_red_371_1920x1080.jpg'),
(18, 5, 1, 'Mie PEL', '23', 'Enak, Lezat, Pedas', '5e0ec44d909d6_aU6K0E.jpg'),
(19, 3, 1, 'Coco Babble Milk', '11', 'Manis, Legit', '5e0ec5865d0eb_display-wallpaper-14.jpg'),
(20, 3, 1, 'Cobo Choco', '33', 'Enak, Lezat, Pedas', '5e0ec59624f8a_display-wallpaper-14.jpg'),
(21, 3, 1, 'Cobo Choco', '88', 'Enak, Lezat, Pedas', '5e0ec5a6ec63c_abstract_blue_smoke_red_371_1920x1080.jpg'),
(23, 10, 2, 'Gula Jawa', '12', 'Manis', '5e10344a417d0_LT5CZt8.jpg'),
(24, 16, 1, 'BEBEK GORENG', '20000', 'SHAP', '5e1411ee34c81_display-wallpaper-14.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_umkm`
--

CREATE TABLE `tbl_umkm` (
  `id_umkm` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `nama_umkm` varchar(255) NOT NULL,
  `alamat_umkm` varchar(255) NOT NULL,
  `kontak_umkm` varchar(255) NOT NULL,
  `lokasi_umkm` varchar(255) NOT NULL,
  `gambar_umkm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_umkm`
--

INSERT INTO `tbl_umkm` (`id_umkm`, `id_member`, `nama_umkm`, `alamat_umkm`, `kontak_umkm`, `lokasi_umkm`, `gambar_umkm`) VALUES
(1, 2, 'Alta Ababa', 'Tejorejo, Weleri, Kendal', '0811112221110', 'http://localhost/@umkmkendal/admin/index.php?halaman=edit_umkm&id=1', '5e0d6e1099a43_40_Mac_OS_X_Wallpapers_HD__2560x1600__www.HQPictures.tk-24.jpg_Mac_OS_X_39.jpg'),
(3, 3, 'OK Angkringan', 'Patebon,  Kendal', '0892231114445', 'http://localhost/@umkmkendal/admin/index.php?halaman=tambah_umkm', '5e0b06260e101_stone_color_apple_mac_wallpaper.jpg'),
(5, 4, 'CoboCobo Club', 'Tejorejo, Weleri, Kendal', '081233554001121', 'http://localhost/@umkmkendal/umkm.php#formNewUmkm', '5e0d646a3b003_Nd4M7W.jpg'),
(6, 6, 'Susu Suss', 'Kendal Kota, Kendal Kab', '0831126657651', 'http://localhost/@umkmkendal/admin/index.php?halaman=edit_umkm&id=1', '5e0e976e4b345_stone_color_apple_mac_wallpaper.jpg'),
(7, 6, 'Susi Nasi', 'Kendal Kota, Kendal Kab', '08383321155507', 'http://localhost/@umkmkendal/umkm.php#formNewUmkm', '5e0e99cd4e85c_Macbook-Air-HD-Wallpaper.jpg'),
(8, 7, 'Pak Coba Mie', 'Kendal Kota, Kendal Kab', '0812225567811', 'http://localhost/@umkmkendal/admin/index.php?halaman=edit_umkm&id=1', '5e0eab5dc3fdc_sfondi_full_hd_1080_169_mac_20110119_1707374991.jpg'),
(9, 8, 'Sate Ali', 'Tejorejo, Weleri, Kendal', '08122213446537', 'http://localhost/@umkmkendal/umkm.php#formNewUmkm', '5e0eb472a8197_display-wallpaper-14.jpg'),
(10, 8, 'Soto Pak Ali', 'Kendal Kota, Kendal Kab', '0892211133311', 'http://localhost/@umkmkendal/umkm.php#formNewUmkm', '5e0f002991a65_stone_color_apple_mac_wallpaper.jpg'),
(14, 9, 'Warung Test', 'Kendal Kota, Kendal Kab', '081223443312', 'http://localhost/@umkmkendal/umkm.php#formNewUmkm', '5e1083f39e946_stone_color_apple_mac_wallpaper.jpg'),
(15, 11, 'ALTA RECORD', 'Kendal Kota, Kendal Kab', '1234567890', 'https://www.google.co.id/maps/place/ALTA+RECORD/@-6.9873887,110.0932468,17z/data=!3m1!4b1!4m5!3m4!1s0x2e704280ff6f944d:0xa0b457a6d0f09fcf!8m2!3d-6.987394!4d110.0954355', '5e140fb00f17d_LT5CZt8.jpg'),
(16, 12, 'BEBEK BAKAR', 'Kendal Kota, Kendal Kab', '081325641645', 'https://www.google.co.id/maps/place/ALTA+RECORD/@-6.9873887,110.0932468,17z/data=!3m1!4b1!4m5!3m4!1s0x2e704280ff6f944d:0xa0b457a6d0f09fcf!8m2!3d-6.987394!4d110.0954355', '5e14119f41d05_Apple Mac Desktop 1080p Full HD50.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indeks untuk tabel `tbl_umkm`
--
ALTER TABLE `tbl_umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `id_member` (`id_member`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_umkm`
--
ALTER TABLE `tbl_umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tbl_umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_umkm`
--
ALTER TABLE `tbl_umkm`
  ADD CONSTRAINT `tbl_umkm_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tbl_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
