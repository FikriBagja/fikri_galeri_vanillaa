-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 08.47
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
(6, 'Meme', 'Kerandoman', '2025-01-23', 3),
(7, 'Meme', 'meme fresh', '2025-01-30', 8);

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
(16, 'bener', 'Bener ga bang? nanti salah lagi', '2025-01-30', '1730560958-Foto Kuda.jpg', 6, 3),
(17, 'masnya lo lucu banget', 'boleh gak? ya nggak lah kocak', '2025-01-30', '485218256-download.jpg', 6, 3),
(18, 'ytta', 'yang ytta ytta aja', '2025-01-23', '1527298561-ytta🤓.jpg', 6, 3),
(19, 'plis', 'plis kodingkan dulu le', '2025-01-23', '1621797647-kodingin dlu le.jpg', 6, 3),
(20, 'roblox', 'geda gedi geda geda o', '2025-01-30', '783797382-Roblox Man Face Meme PNG Transparent With Clear Background ID 215364 _ TopPNG.jpg', 7, 8),
(21, 'kelas king', 'gw ketika ditanya kelas berapa', '2025-01-30', '605412298-images.jpg', 7, 8),
(22, 'sudah saatnya', 'king tlid ketika menang bilek', '2025-01-30', '835748940-images (1).jpg', 7, 8),
(23, 'Mazda RX-7', 'Kerennya Modifikasi Mazda RX7 LBWK Arief Muhammad yang Jadi Mirip Supercar', '2025-01-30', '742228638-f976d7f7bbb74fbfb53424cc950b68c4.jpg', 3, 1);

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
(1, 4, 3, 'tuma apa', '2025-01-30', NULL),
(2, 4, 2, '#tumaevos', '2025-01-30', 1),
(3, 10, 3, 'anime rapat jirlah', '2025-01-30', NULL),
(4, 5, 3, 'rekomendasi game yang seru kak', '2025-01-30', NULL),
(5, 1, 3, 'dimana itu bang', '2025-01-30', NULL),
(6, 14, 1, 'sungguh malas', '2025-01-30', NULL),
(7, 4, 7, 'tes', '2025-01-30', NULL),
(8, 11, 1, 'mantap men', '2025-01-30', NULL),
(9, 8, 1, 'sdasdasd', '2025-01-30', NULL),
(10, 22, 1, 'aseli cuy', '2025-01-30', NULL),
(11, 21, 3, 'bang lu kelas berapa sih?', '2025-01-30', NULL),
(12, 21, 8, 'kelas king', '2025-01-30', 11),
(13, 15, 8, 'tim badut', '2025-01-30', NULL),
(14, 5, 1, 'genshin impact gaskkeun', '2025-01-30', 4),
(15, 13, 1, 'kak gem kak gem, kata kata dong', '2025-01-30', NULL),
(16, 13, 6, 'Jika memilih dia adalah menjadi satu kebahagiaanmu bersama dia, tidak mengapa. Aku rela meskipun hatiku terluka. Paham?', '2025-01-30', 15),
(17, 20, 3, 'geda gedi geda geda o', '2025-01-30', NULL),
(18, 18, 3, '😹😹😹', '2025-01-30', NULL),
(19, 7, 8, 'check sound bang', '2025-01-30', NULL),
(20, 7, 1, 'enggggg stutututu', '2025-01-30', 19),
(21, 17, 8, 'boleh rek😹', '2025-01-30', NULL),
(22, 17, 1, 'yang bener kamu gilang', '2025-01-30', 21),
(23, 13, 3, 'paham kak gem !!!!!! 🤚🏿🤚🏿', '2025-01-30', 15),
(24, 12, 8, 'dan yap', '2025-01-30', NULL),
(25, 4, 3, 'halau', '2025-01-30', NULL),
(26, 16, 1, 'tengok tu', '2025-01-30', NULL),
(27, 7, 3, 'ijo apa itu bang', '2025-01-30', NULL),
(28, 12, 1, 'dan yap', '2025-01-30', NULL),
(29, 4, 3, 'test', '2025-01-30', 7),
(30, 15, 3, 'rrq punya lemon jago kagura', '2025-01-30', 13),
(31, 19, 1, 'tes', '2025-01-30', NULL),
(32, 15, 3, 'sdfdsf', '2025-01-30', NULL),
(33, 19, 1, 'qweqwe', '2025-01-30', NULL),
(34, 22, 3, 'pamer ', '2025-01-30', NULL),
(35, 20, 1, 'fiesta chicken nugget', '2025-01-30', NULL),
(36, 8, 1, 'suuuuuu', '2025-01-30', NULL),
(37, 17, 1, 'yang bener aje', '2025-01-30', NULL),
(38, 2, 3, 'info', '2025-01-30', NULL),
(39, 6, 3, 'keren', '2025-01-30', NULL),
(40, 14, 2, 'malas🧢', '2025-01-30', NULL);

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
(1, 4, 3, '2025-01-30'),
(2, 11, 3, '2025-01-30'),
(3, 5, 3, '2025-01-30'),
(5, 4, 7, '2025-01-30'),
(6, 8, 1, '2025-01-30'),
(7, 20, 8, '2025-01-30'),
(8, 22, 1, '2025-01-30'),
(9, 13, 6, '2025-01-30'),
(10, 7, 3, '2025-01-30'),
(11, 17, 8, '2025-01-30'),
(12, 3, 3, '2025-01-30'),
(14, 12, 3, '2025-01-30'),
(15, 20, 3, '2025-01-30'),
(16, 13, 3, '2025-01-30'),
(17, 22, 3, '2025-01-30'),
(18, 9, 3, '2025-01-30'),
(19, 20, 2, '2025-01-30'),
(20, 12, 8, '2025-01-30'),
(21, 16, 1, '2025-01-30'),
(22, 7, 8, '2025-01-30'),
(23, 12, 1, '2025-01-30'),
(24, 21, 3, '2025-01-30'),
(25, 8, 3, '2025-01-30'),
(26, 6, 3, '2025-01-30'),
(27, 15, 2, '2025-01-30'),
(28, 13, 1, '2025-01-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `action_userid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `fotoid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `userid`, `action_userid`, `content`, `created_at`, `is_read`, `fotoid`) VALUES
(4, 8, 3, 'mengomentari foto Anda : pamer ', '2025-01-30 07:31:44', 1, 22),
(6, 3, 1, 'menyukai foto Anda.', '2025-01-30 07:43:37', 0, 12),
(7, 8, 1, 'mengomentari foto Anda : fiesta chicken nugget', '2025-01-30 07:43:48', 0, 20),
(8, 2, 1, 'mengomentari foto Anda : suuuuuu', '2025-01-30 07:43:59', 0, 8),
(9, 3, 1, 'mengomentari foto Anda : yang bener aje', '2025-01-30 07:44:10', 0, 17),
(10, 1, 3, 'mengomentari foto Anda : info', '2025-01-30 07:44:35', 0, 2),
(11, 8, 3, 'menyukai foto Anda.', '2025-01-30 07:44:45', 0, 21),
(12, 2, 3, 'menyukai foto Anda.', '2025-01-30 07:45:03', 0, 8),
(13, 1, 3, 'mengomentari foto Anda : keren', '2025-01-30 07:45:08', 0, 6),
(14, 1, 3, 'menyukai foto Anda.', '2025-01-30 07:45:11', 0, 6),
(15, 3, 2, 'mengomentari foto Anda : malas🧢', '2025-01-30 07:45:59', 0, 14),
(16, 1, 2, 'menyukai foto Anda.', '2025-01-30 07:46:04', 0, 15),
(17, 3, 1, 'menyukai foto Anda.', '2025-01-30 07:46:33', 0, 13);

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
(6, 'kak gem', '827ccb0eea8a706c4c34a16891f84e7b', 'gem@gmail.com', 'kak gem', 'tiktok', 2, 'approved'),
(7, 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', 'fikribagjaramadhan@gmail.com', 'testing', 'dasdasd', 2, 'approved'),
(8, 'gilang', '6d8f8a1a4837f099459ec46a72660f30', 'gilang@gmail.com', 'gilang headset', 'pluto', 2, 'approved');

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
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `fotoid` (`fotoid`);

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
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Ketidakleluasaan untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
