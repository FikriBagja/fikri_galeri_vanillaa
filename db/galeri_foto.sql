-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2025 pada 07.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri_foto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggalbuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggalbuat`, `userid`) VALUES
(1, 'game', 'seputar gamee', '2025-01-22', 1),
(3, 'makanan', 'makanan mantap', '2025-01-15', 1),
(4, 'minuman', 'minuman mantap', '2025-01-15', 1),
(5, 'alam', 'nuansa alam', '2025-01-15', 1),
(6, 'mobil', 'seputar mobil', '2025-01-15', 2),
(7, 'Pesawat Jet', 'Jet Tempur', '2025-01-15', 2),
(8, 'Bola', 'berita bola hari ini', '2025-01-16', 3),
(9, 'anime', 'film jepang', '2025-01-16', 3),
(10, 'Negara', 'Seputar Negara', '2025-01-16', 1),
(11, 'paham', 'paham', '2025-01-16', 5),
(12, 'otomotif', 'seputar otomotif', '2025-01-22', 1),
(14, 'belum paham', 'belum paham kka', '2025-01-22', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(2, 'Kawah putih', 'Kawah Putih adalah sebuah tempat wisata di Jawa Barat yang terletak di Desa Alam Endah', '2025-01-15', '1421012051-kru5ngg0sd2lyhynyd5i.jpg', 5, 1),
(3, 'RRQ', 'rrq adalah tim paling jago di mobel legen', '2025-01-15', '636296761-702120221126160313.png', 1, 1),
(4, 'Mie Ayam', 'Mie ayam emang mantap😋😋', '2025-01-22', '382340198-1-7-1024x1024-1.jpg', 3, 1),
(5, 'minuman segar', 'segerrrrrrrrrrrrrrrrrrrrrrrrrrrr', '2025-01-22', '1278250965-minuman-matcha_11.jpeg', 4, 1),
(7, 'Raiden Shogun', 'raiden shogun adalah karakter dari game RPG, yaitu genshin impact', '2025-01-16', '1520727253-12370768481630495155.webp', 1, 1),
(8, 'Porsche 911 GT3 RS', 'Porsche 911 GT3 RS sdauisbdgauisnda sjdibasdba sdasd', '2025-01-16', '1259311729-images.jpg', 6, 2),
(9, 'General Dynamics', 'General Dynamics F-16 Fighting Falcon merupakan pesawat tempur multiperan bermesin tunggal dari Amerika Serikat ', '2025-01-16', '1511944250-f-16-fighter-jet.webp', 7, 2),
(10, 'Nissan Skyline GT-R 34', 'sdfssdfsdfsd dsf sdfds dsfdf sdfd fds fdsfsdfdsfdsf ', '2025-01-16', '446382951-640px-Nissan_Skyline_R34_GT-R_Nür_001.jpg', 6, 2),
(11, 'sosok asli goat', 'cristiano \r\nronaldooooooooooo\r\nooooooooooooooo', '2025-01-16', '627855755-images (1).jpg', 8, 3),
(12, 'goat palsu', 'pepsiiiiiiiiiiiiiiiiiiiiiiiiiiiii', '2025-01-16', '1260764458-20110419045115lionel-messi1.jpg', 8, 3),
(13, 'naruto', 'keluarga besar', '2025-01-16', '1936054238-Naruto.jpg', 9, 3),
(14, 'ASEAN', 'ASEAN disebut Perhimpunan Bangsa-Bangsa Asia Tenggara.', '2025-01-16', '289565160-sBGhd4oSx9.jpg', 10, 1),
(15, 'paham', 'paham', '2025-01-16', '520285872-kak-gem-67239f72ed64154a5811e1f2.jpeg', 11, 5),
(16, 'Lamborgini Aventadorrrrrr', 'Lamborghini Aventador adalah mobil sport bermesin tengah yang diproduksi oleh pabrikan otomotif Italia Lamborghini. ', '2025-01-22', '188831093-1200px-2012-03-07_Motorshow_Geneva_4608.jpg', 12, 1),
(18, 'Tensura', 'lorem ipsum dolor sit amettttttt', '2025-01-22', '320239815-image-42-3340026761.webp', 9, 3),
(20, 'belum paham', 'asdubasidusiubdasdyaidhsdasd paham? gak paham', '2025-01-22', '1383973313-wanita-260934-240629095755-l.jpg', 14, 5),
(21, 'yap', 'dan yap gw di ajak by one', '2025-01-22', '1077811316-yap.jpg', 10, 1),
(22, 'agus', 'fisik bisa dirubah,  materi bisa dicari, tapi orang bu ga datang dua kali, cak menyala wi', '2025-01-22', '855296972-01jeqmmr5p0qnphe57g3gvx5qa.jpg', 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`) VALUES
(1, 2, 1, 'asdasdasd', '2025-01-16'),
(2, 5, 1, 'ewrer', '2025-01-16'),
(3, 5, 1, 'bhjj', '2025-01-16'),
(13, 4, 2, 'enak tuh', '2025-01-16'),
(14, 4, 2, '😋😋😋😋😋😋😋', '2025-01-16'),
(15, 3, 2, 'raja', '2025-01-16'),
(16, 3, 2, 'bhjj', '2025-01-16'),
(17, 10, 1, 'sda', '2025-01-16'),
(18, 4, 1, 'ewrer', '2025-01-16'),
(19, 4, 1, 'raja', '2025-01-16'),
(20, 3, 1, 'aswdasdasd', '2025-01-16'),
(21, 3, 1, 'enak tuh', '2025-01-16'),
(22, 2, 1, 'asdas', '2025-01-16'),
(23, 5, 1, 'segerrr', '2025-01-16'),
(24, 4, 3, 'menggoda', '2025-01-16'),
(25, 8, 1, 'keren banget mobilnya', '2025-01-16'),
(26, 15, 5, 'paham', '2025-01-16'),
(27, 15, 3, 'paham', '2025-01-16'),
(28, 18, 3, 'seru ga kak', '2025-01-22'),
(29, 20, 1, 'kata kata kak gem', '2025-01-22'),
(30, 11, 1, 'siuuuuuuuuuuuuuuuuuuuuuuuu', '2025-01-22'),
(31, 15, 2, 'paham', '2025-01-22'),
(32, 4, 2, 'aku mw lima', '2025-01-22'),
(33, 10, 1, 'keren', '2025-01-22'),
(34, 3, 1, 'seru ga kak', '2025-01-22'),
(35, 5, 1, 'aku mw lima', '2025-01-22'),
(38, 15, 1, 'tidak perlu kata kata yang penting bukti nyata, Pahamm!!', '2025-01-22'),
(39, 21, 1, 'esok koloh tak cikgu ', '2025-01-22'),
(40, 21, 1, ' 😈  😈  😈  😈 ', '2025-01-22'),
(41, 21, 1, 'dan yap😈😈😈😈', '2025-01-22'),
(42, 21, 6, 'ada itu kurang sikma', '2025-01-22'),
(43, 22, 4, 'kok ada saya👿', '2025-01-22'),
(44, 22, 2, 'tampleng', '2025-01-22'),
(45, 9, 1, 'wow', '2025-01-22'),
(46, 20, 5, 'singkat saja, siapun orangnya, yang penting bukan orang israel, Paham?!!', '2025-01-22'),
(47, 20, 1, 'kata kata dong kak gem buat israel', '2025-01-22'),
(48, 22, 1, 'menyala wi', '2025-01-22'),
(49, 21, 7, 'dan yap', '2025-01-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(15, 5, 1, '2025-01-16'),
(18, 10, 2, '2025-01-16'),
(19, 9, 2, '2025-01-16'),
(20, 8, 2, '2025-01-16'),
(24, 3, 4, '2025-01-16'),
(26, 4, 4, '2025-01-16'),
(27, 2, 4, '2025-01-16'),
(29, 3, 3, '2025-01-16'),
(35, 9, 1, '2025-01-16'),
(36, 13, 3, '2025-01-16'),
(37, 9, 3, '2025-01-16'),
(44, 8, 1, '2025-01-16'),
(45, 14, 5, '2025-01-16'),
(46, 15, 5, '2025-01-16'),
(48, 20, 1, '2025-01-22'),
(51, 3, 1, '2025-01-22'),
(52, 4, 1, '2025-01-22'),
(56, 21, 6, '2025-01-22'),
(57, 22, 1, '2025-01-22'),
(58, 22, 4, '2025-01-22'),
(59, 22, 2, '2025-01-22'),
(60, 16, 1, '2025-01-22'),
(61, 21, 1, '2025-01-22'),
(62, 7, 1, '2025-01-22'),
(64, 21, 7, '2025-01-22'),
(65, 22, 7, '2025-01-22'),
(66, 14, 7, '2025-01-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`) VALUES
(1, 'Fikri', 'e2c02f8c1b56e6b640fbb6440662f900', 'fikribr10@gmail.com', 'Fikri Bagja Ramadhan', 'jl anggaraja no 108'),
(2, 'ujang', 'ed84089fcb1b864597cf6dc504859d1d', 'ujang@gmail.com', 'ujang gerung', 'mars'),
(3, 'asep', 'f3465a353436bbab3617815f64083c84', 'asep@gmail.com', 'pa asep', 'jupiter'),
(4, 'agus', 'd6a569626ff4cca88408e842c83b9e7e', 'agus@gmail.com', 'agus buntung', 'bali'),
(5, 'kak gem', '827ccb0eea8a706c4c34a16891f84e7b', 'paham@gmail.com', 'kak gemmmmmm', 'tiktok'),
(6, 'gues', '777209b3a0258f9cec2ed44fa5ce03a1', 'gues@gmail.com', 'gues', 'gues'),
(7, 'ya', 'd74600e380dbf727f67113fd71669d88', 'ya@gmail.com', 'ya', 'dmn');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
