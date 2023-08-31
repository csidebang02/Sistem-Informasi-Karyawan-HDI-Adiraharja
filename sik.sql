-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2019 pada 03.21
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(4) NOT NULL,
  `nama_akun` varchar(20) NOT NULL,
  `nia_karyawan` varchar(15) NOT NULL,
  `kata_sandi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_akun`, `nia_karyawan`, `kata_sandi`) VALUES
(1, 'andi', '201901075001', '9e014682c94e0f2cc834bf7348bda428'),
(2, 'Ibnu Wardani', '2016103110001', '9e014682c94e0f2cc834bf7348bda428'),
(3, 'Dimas', '2016103110002', '9e014682c94e0f2cc834bf7348bda428'),
(4, 'Haryo', '2016103110003', '9e014682c94e0f2cc834bf7348bda428'),
(5, 'Haries Sukandar', '2017100920004', '9e014682c94e0f2cc834bf7348bda428'),
(6, 'Kurnia', '2017100920005', '9e014682c94e0f2cc834bf7348bda428'),
(7, 'Rivan', '2017100920007', '9e014682c94e0f2cc834bf7348bda428'),
(8, 'Sababa', '2017100920009', '9e014682c94e0f2cc834bf7348bda428'),
(9, 'Aldico', '2017101920006', '9e014682c94e0f2cc834bf7348bda428'),
(10, 'Rio', '2018050930001', '9e014682c94e0f2cc834bf7348bda428'),
(11, 'Aulia', '2018050930002', '9e014682c94e0f2cc834bf7348bda428'),
(12, 'Putu Genik', '2018050930003', '9e014682c94e0f2cc834bf7348bda428'),
(13, 'Angela Dini', '2018100130005', '9e014682c94e0f2cc834bf7348bda428'),
(14, 'Aninditya W.', '2018100130006', '9e014682c94e0f2cc834bf7348bda428'),
(15, 'Oscar Ben', '24010316120035', '9e014682c94e0f2cc834bf7348bda428'),
(16, 'Christian SIdebang', '24010316120038', '9e014682c94e0f2cc834bf7348bda428'),
(17, 'Halim ', '2016103110031', '9e014682c94e0f2cc834bf7348bda428');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_jadwal` datetime NOT NULL,
  `kegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tanggal_buat`, `tanggal_jadwal`, `kegiatan`) VALUES
(18, '2019-06-19 15:08:07', '2019-09-21 00:00:00', 'raker'),
(19, '2019-06-19 15:08:54', '2019-08-23 00:00:00', 'raker'),
(24, '2019-06-24 13:22:23', '2019-12-02 00:00:00', 'Survei'),
(27, '2019-07-04 07:08:08', '2019-07-05 00:00:00', 'Rapat'),
(28, '2019-07-04 07:08:29', '2019-07-06 00:00:00', 'Survey'),
(29, '2019-07-04 07:08:51', '2019-07-08 00:00:00', 'Presentasi survey');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(4) NOT NULL,
  `nia_karyawan` bigint(15) UNSIGNED NOT NULL,
  `nama_karyawan` char(30) NOT NULL,
  `jk_karyawan` varchar(10) NOT NULL,
  `jabatan_karyawan` varchar(50) NOT NULL,
  `tanggal_lahir_karyawan` date NOT NULL,
  `tgl_lahir_karyawan` varchar(5) NOT NULL,
  `alamat_karyawan` text NOT NULL,
  `kontak_karyawan` varchar(15) NOT NULL,
  `email_karyawan` varchar(30) NOT NULL,
  `foto_karyawan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nia_karyawan`, `nama_karyawan`, `jk_karyawan`, `jabatan_karyawan`, `tanggal_lahir_karyawan`, `tgl_lahir_karyawan`, `alamat_karyawan`, `kontak_karyawan`, `email_karyawan`, `foto_karyawan`) VALUES
(68, 2016103110001, 'Ibnu Wardani', 'laki-laki', 'President Director', '1994-11-09', '11-09', 'Jl. Palem Botol V Blok H5 No.12A, RT 02/24, Kel/Desa. Pejuang, Kec. Medan Satria, Kota Bekasi', '081316708569', 'ibnuwardanii@gmail.com', 'Ibnu.jpg'),
(69, 2016103110002, 'Dimas Judah Mozes', 'laki-laki', 'Director of Finance', '1994-10-07', '10-07', 'Jl.Talang Ujung RT 02/03 Pegangsaan, Jakarta Pusat', '08998813294', 'kalangiedimas@gmail.com', 'dimas.jpg'),
(70, 2016103110003, 'Haryo Farras Raditya', 'laki-laki', 'Director of Business Support', '1994-03-12', '03-12', 'Jl.Telaga Said Blok N12 Jatiwaringin Asri 2, RT 04/05, Desa Jatiwaringin, Kec.Pondokgede', '081236037348', 'haryofarras@gmail.com', 'haryo.jpg'),
(71, 2017100920004, 'Haries Sukandar', 'laki-laki', 'Public Relation Department', '1994-04-22', '04-22', 'Buki Taruno Permai Blok D5-7, RT 02/04, Desa Adiarsa Barat, Karawang Barat', '081210180515', 'hariesofficial@gmail.com', NULL),
(72, 2017100920005, 'Kurnia Adi Nusaputro', 'laki-laki', 'HDI Production House', '1994-12-15', '12-15', 'Klegungan RT 04/01 Genengsari Polokarto, Sukoharjo', '082134859944', 'adi.nusaputra@gmail.com', 'ID_Card_HDI__Ad'),
(73, 2017100920007, 'Rivan Framudiana', 'laki-laki', 'General Affair Department', '1994-05-09', '05-09', 'Dusun Jatinunggal RT 26/03, Desa Karangtawang, Kec.Kuningan, Jawa Barat', '087832131822', 'rivan.fram@gmail.com', 'Rivan_F..jpg'),
(74, 2017100920009, 'Muhammad Sababa Alhaq', 'laki-laki', 'Diver', '1997-09-27', '09-27', 'Jl. Rha. Arifai  Tjekyan No.1550, RT 21/05, Desa/Kel. 20 Ilir D.1, Kec. Ilir Timur 1, Kota Palembang', '081390947914', 'sababaelhaqq@gmail.com', NULL),
(75, 2017101920006, 'Aldico Satria G.', 'laki-laki', 'HDI Sports Club', '1994-08-10', '08-10', 'Perum. Bangka Pos RT 018/001, Desa/Kel. Air Itam, Kec. Bukit Intan Pangkal Pinang', '081214774765', 'aldicosatria@gmail.com', 'dico.jpg'),
(76, 2018050930001, 'Rio Adista Widodo P.', 'laki-laki', 'Project Implementation Department', '1997-08-23', '08-23', 'Jl. Bukit Merbabu No.8 Bukitsari, RT07/11, Desa/Kel. Ngesrep, Kec. Banyumanik', '081326635359', 'rioadistawidodoputra@gmail.com', NULL),
(77, 2018050930002, 'Aulia Oktaviani', 'laki-laki', 'Project Innovation Department', '1996-10-06', '10-06', 'Dusun Ngrapah, RT 04/02, Kel/Desa Ngrapah, Kec. Banyubiru, Kab. Semarang', '082241260424', 'oktawulia@gmail.com', 'Aulia_O..png'),
(78, 2018050930003, 'Putu Genik A. Pratama', 'laki-laki', 'HDI Sports Club', '1997-10-03', '10-03', '-', '085737267954', 'arthaagenik@gmail.com', NULL),
(79, 2018100130005, 'Angela Dini A.', 'laki-laki', 'Public Relation Department', '1997-07-21', '07-21', 'Jl. Peralatan Blok H-82 KPAD, RT 03/06, Kel. Cipinang Melayu, Kec. Makasar, Jakarta Timur', '082138719039', 'angeladiniat@gmail.com', NULL),
(80, 2018100130006, 'Aninditya W.', 'laki-laki', 'HDI Production House', '1996-07-10', '07-10', 'Puri Anjasmoro Blok O1/3, RT 03/08, Desa/Kel. Tawangsari, Kec.Semarang Barat', '08122860797', 'tyaanindityaa@gmail.com', NULL),
(81, 24010316120035, 'Oscar Ben', 'laki-laki', 'Mahasiswa Magang', '1999-01-07', '', 'Jl. Tlogosari Utara VI no.29B, Tembalang - Semarang - Jawa Tengah', '085358312174', 'smith.gabe59@gmail.com', 'IMG_5683.JPG'),
(87, 24010316120038, 'Christian sidebang', 'laki-laki', 'Mahasiswa Magang', '1997-12-02', '', 'Jl. Tirta sari no.128', '081358153351', 'csidebang02@gmail.com', '1556203837124-1'),
(88, 2016103110031, 'Halim Ardath', 'laki-laki', 'Office Boy', '2019-07-04', '07-04', 'tembalang', '081234588493', 'halim@gmail.com', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `target`
--

CREATE TABLE `target` (
  `id_target` int(5) NOT NULL,
  `tanggal_target` varchar(15) NOT NULL,
  `judul_target` varchar(20) NOT NULL,
  `keterangan_target` text NOT NULL,
  `id_karyawan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `target`
--

INSERT INTO `target` (`id_target`, `tanggal_target`, `judul_target`, `keterangan_target`, `id_karyawan`) VALUES
(8, '20 september 20', 'penjualan', 'harus menjual 100 produk', 46),
(9, '17 agustus 2019', 'laporan survey', 'laporan diserahkan kepada HRD', 46),
(10, '18 agustus 2019', 'target 1', 'mencapai target', 47),
(11, '12 Desember 201', 'Program', 'ndhsh', 60),
(13, '12 juli 2019', 'survey', 'melakukan survey', 65),
(15, '15 juli 2019', 'laporan survey', 'harus menyerahkan laporan survey.', 68),
(16, '20 Agustus 2019', 'mencari target proje', 'harus mendapatkan setidaknya 2 projek', 68),
(17, '20 Agustus 2019', 'survey', 'harus mendapatkan setidaknya 2 projek', 68);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `nia_karyawan` (`nia_karyawan`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id_target`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `target`
--
ALTER TABLE `target`
  MODIFY `id_target` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
