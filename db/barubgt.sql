-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2025 pada 05.49
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
(1, 'Alam', 'Keindahan Alam', '2025-01-23', 1),
(2, 'Game', 'Info Seputar Game', '2025-01-23', 1),
(3, 'Otomotif', 'Seputar Otomotif', '2025-01-23', 1),
(4, 'Bola', 'Berita Bola', '2025-01-23', 2),
(5, 'Anime', 'Film Jepang', '2025-01-23', 2),
(6, 'Meme', 'Kerandoman', '2025-01-23', 3);

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
(1, 'Persawahan', 'Keindahan alam semesta begitu memukau,, Langit nan luas begitu bercahaya,, Bintang-bintang gemerlap di angkasa,, Menyaksikan semesta dalam jarak dekapan tangan….', '2025-01-23', '1574974847-IMG-20231212-WA0103.jpg', 1, 1),
(2, 'Pegunungan', 'Korea Selatan, mengungkap bahwa kawasan pegunungan dengan keanekaragaman ekosistem yang kaya menjadi tempat penting dalam evolusi manusia.', '2025-01-23', '1808090057-image-64-2492904576.webp', 1, 1),
(3, 'Pantai Sanur', 'Pantai Sanur merupakan salah satu wisata pantai yang paling terkenal di Pulau Bali. Pantai Sanur juga dikenal sebagai pantai matahari terbit atau Sunrise Beach karena lokasinya di sebelah timur Pulau Bali.', '2025-01-23', '1476645191-sanur_3.jpg', 1, 1),
(4, '#TumaEvos', 'Turnamen terbesar Mobile Legends ditahun 2019 yaitu M1 World Championship 2019 telah resmi berakhir. Partai final yang mempertandingkan dua wakil Indonesia akhirnya dimenangi oleh Evos Esports. Melalui pertandingan dramatis tujuh round, Evos Esports menghempaskan perjuangan RRQ untuk menyabet gelar tertinggi Mobile Legends dunia.', '2025-01-23', '1794211486-evos.jpg', 2, 1),
(5, 'Mihoyo', 'Kesuksesan Genshin Impact yang mendulang pendapatan fantastis selama satu tahun terakhir eksistensinya sepertinya memberikan miHoYo lebih banyak kesempatan untuk mengeksplorasi lebih banyak opsi pengembangan', '2025-01-23', '1501320293-mihoyo-logo.webp', 2, 1),
(6, 'Ferrari F8', 'The F8 Tributo uses the same engine from the 488 Pista, L twin-turbocharged V8 engine with a power output of 530 kW; 710 hp (720 PS) at 8000 rpm and 770 N⋅m (568 lb⋅ft) of torque at 3250 rpm', '2025-01-23', '911238259-Ferrari_F8_Tributo_Genf_2019_1Y7A5665.jpg', 3, 1),
(7, 'Nissan Skyline GT-R 34', 'Nissan Skyline GT-R adalah mobil sport Jepang yang dikembangkan dari mobil Nissan Skyline. Skyline GT-R diproduksi pada tahun 1969–1973.', '2025-01-23', '594455430-Nissan_Skyline_R34_GT-R_Nür_001.jpg', 3, 1),
(8, 'Goat🦌', 'Cristiano Ronaldo dos Santos Aveiro lahir 5 Februari 1985) adalah pemain sepak bola profesional Portugal yang bermain di klub Arab Saudi Al-Nassr FC sebagai penyerang dan juga kapten tim nasional Portugal. ', '2025-01-23', '1950892598-ronaldo-cristiano-2017-real-madrid-ballon-d-or-2016-0026751808hjpg-1698686328-120749.jpg', 4, 2),
(9, 'Goat Palsu🤢🤮', 'Lionel Andrés \"Leo\" Messi Cuccitini lahir 24 Juni 1987 adalah pemain sepak bola profesional Argentina yang bermain sebagai penyerang untuk klub Major League Soccer, Inter Miami CF dan merupakan kapten timnas Argentina.', '2025-01-23', '1964301533-B130125-Cover-Profil-Lionel-Messi-scaled.jpg', 4, 2),
(10, 'Tensei Shitara Slime Datta Ken', 'Tensei Shitara Slime Datta Ken, atau That Time I Got Reincarnated as a Slime[a] juga dikenal sebagai Tensura atau Bereinkarnasi Malah Menjadi Slime, adalah seri novel ringan fantasi Jepang yang ditulis oleh Fuse, dan diilustrasikan oleh Mitz Vah. ', '2025-01-23', '1108383620-Tensura-1024x576.jpg', 5, 2),
(11, 'Bleach Thousand Year-Blood War', 'Bleach: Thousand-Year Blood War, also known as Bleach: The Blood Warfare, is a Japanese anime television series based on the Bleach manga series by Tite Kubo and a direct sequel to the Bleach anime series that ran from 2004 until 2012.', '2025-01-23', '1237239299-629921402p.jpg', 5, 2),
(12, 'dan yap', 'Esok koloh dok cikgu', '2025-01-23', '509569255-images (1).jpg', 6, 3),
(13, 'Kak Gem', 'Semakin benci kau melihat aku, akan semakin banyak gaya aku di depan kau. Paham?', '2025-01-23', '346082073-51cb963f3a006bdfb340cea524fecdc7.jpg', 6, 3),
(14, 'apa ya', 'Coba Kamu Cari Tahu', '2025-01-23', '194601493-627604d5a191a89d5856022f8822fa07.jpg', 6, 3),
(15, 'RRQ ', 'Rex Regum Qeon atau yang lebih dikenal dengan RRQ merupakan klub e-sports asal Indonesia yang menaungi 7 divisi game, yaitu Mobile Legends: Bang Bang, PUBG Mobile, Free Fire, Valorant, Pokémon Unite dan Honor Of king.', '2025-01-23', '892695639-5781010c0c14aeaea1a24cd96679ccfc.jpg', 2, 1),
(16, '?', 'Bener ga bang? nanti salah lagi', '2025-01-23', '1730560958-Foto Kuda.jpg', 6, 3),
(17, '😹', 'boleh gak? ya nggak lah kocak', '2025-01-23', '485218256-download.jpg', 6, 3),
(18, 'ytta', 'yang ytta ytta aja', '2025-01-23', '1527298561-ytta🤓.jpg', 6, 3),
(19, 'plis', 'plis kodingkan dulu le', '2025-01-23', '1621797647-kodingin dlu le.jpg', 6, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL,
  `reply_komen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`, `reply_komen`) VALUES
(1, 4, 1, '#TumaEvos', '2025-01-23', NULL),
(2, 4, 2, '#TumaEvos', '2025-01-23', NULL),
(3, 7, 2, 'Keren Banget', '2025-01-23', NULL),
(4, 6, 2, 'Mevvah', '2025-01-23', NULL),
(5, 8, 2, 'Siuuuuuuuuuuuuuu', '2025-01-23', NULL),
(6, 9, 2, 'pepsi', '2025-01-23', NULL),
(7, 12, 3, 'dan yap😈😈', '2025-01-23', NULL),
(8, 13, 3, 'PAHAM', '2025-01-23', NULL),
(9, 12, 5, '😈😈😈', '2025-01-23', NULL),
(10, 17, 3, 'yang ytta ytta aja', '2025-01-23', NULL),
(11, 18, 3, '🤓☝', '2025-01-23', NULL),
(12, 6, 3, 'berapa ya harganya', '2025-01-23', NULL),
(13, 13, 3, 'genre kak gem apa kak', '2025-01-23', NULL),
(14, 7, 3, 'asli', '2025-01-23', 3),
(15, 16, 3, '😱', '2025-01-23', NULL),
(16, 16, 3, '🤓', '2025-01-23', 15),
(17, 12, 3, '😡😡', '2025-01-23', 9),
(18, 12, 3, '😈', '2025-01-23', 7),
(19, 12, 1, 'tengok tu hah', '2025-01-23', 7),
(20, 8, 1, '🦌', '2025-01-23', 5),
(21, 4, 1, 'rrq punya lemon', '2025-01-23', 1),
(22, 13, 1, 'kata kata kak gem', '2025-01-23', NULL),
(23, 13, 6, 'Jangan kasih kesempatan kedua bagi orang yang mendua. Paham? ', '2025-01-23', 22),
(24, 16, 1, '😂😂', '2025-01-23', 15),
(25, 13, 1, 'tergantung cuaca', '2025-01-23', 13),
(26, 13, 1, 'pencarianku harga kak gem perikat', '2025-01-23', NULL),
(27, 13, 6, 'tergantung harga pasar', '2025-01-23', 26),
(30, 4, 1, 'btr punya udil', '2025-01-23', 2),
(31, 9, 1, 'peminat nomber satu ronaldo', '2025-01-23', 6),
(32, 13, 1, 'pahamm', '2025-01-23', 8),
(33, 13, 1, 'mantap kak', '2025-01-23', 8),
(34, 2, 1, 'indah', '2025-01-23', NULL);

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
(98, 1, 1, '2025-01-23'),
(99, 2, 1, '2025-01-23'),
(100, 3, 1, '2025-01-23'),
(101, 4, 1, '2025-01-23'),
(102, 5, 1, '2025-01-23'),
(103, 6, 1, '2025-01-23'),
(104, 7, 1, '2025-01-23'),
(105, 1, 2, '2025-01-23'),
(106, 2, 2, '2025-01-23'),
(107, 3, 2, '2025-01-23'),
(108, 4, 2, '2025-01-23'),
(109, 5, 2, '2025-01-23'),
(110, 6, 2, '2025-01-23'),
(111, 7, 2, '2025-01-23'),
(112, 8, 2, '2025-01-23'),
(113, 9, 2, '2025-01-23'),
(114, 10, 2, '2025-01-23'),
(115, 11, 2, '2025-01-23'),
(116, 12, 3, '2025-01-23'),
(117, 13, 3, '2025-01-23'),
(118, 14, 3, '2025-01-23'),
(119, 15, 1, '2025-01-23'),
(120, 13, 5, '2025-01-23'),
(121, 14, 5, '2025-01-23'),
(122, 15, 5, '2025-01-23'),
(123, 12, 5, '2025-01-23'),
(124, 6, 5, '2025-01-23'),
(125, 7, 5, '2025-01-23'),
(126, 4, 5, '2025-01-23'),
(127, 8, 5, '2025-01-23'),
(128, 3, 5, '2025-01-23'),
(129, 1, 3, '2025-01-23'),
(130, 17, 3, '2025-01-23'),
(131, 18, 3, '2025-01-23'),
(132, 7, 3, '2025-01-23'),
(133, 6, 3, '2025-01-23'),
(134, 16, 3, '2025-01-23'),
(135, 13, 6, '2025-01-23'),
(136, 8, 1, '2025-01-23'),
(137, 19, 3, '2025-01-23'),
(138, 3, 3, '2025-01-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `namarole` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`roleid`, `namarole`) VALUES
(1, 'admin'),
(2, 'user');

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
  `alamat` text NOT NULL,
  `roleid` int(11) NOT NULL DEFAULT 2,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `roleid`, `status`) VALUES
(1, 'Fikri', 'e2c02f8c1b56e6b640fbb6440662f900', 'fikribr10@gmail.com', 'Fikri Bagja Ramadhan', 'jl anggaraja no 108', 2, 'approved'),
(2, 'ujang', 'ed84089fcb1b864597cf6dc504859d1d', 'ujang@gmail.com', 'ujang gerung', 'mars', 2, 'approved'),
(3, 'asep', 'f3465a353436bbab3617815f64083c84', 'asep@gmail.com', 'pa asep', 'jupiter', 2, 'approved'),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin1', 'ytta', 1, 'approved'),
(5, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@gmail.com', 'testing', 'asdasdasdasd', 2, 'approved'),
(6, 'kak gem', 'd8fcbebd33fa076017fd3490212c55eb', 'gem@gmail.com', 'kak gem', 'tiktok', 2, 'approved');

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
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `fk_role_id` (`roleid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
