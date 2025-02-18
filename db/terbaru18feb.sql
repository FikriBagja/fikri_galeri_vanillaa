-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2025 pada 12.20
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
(7, 'Meme', 'meme fresh', '2025-01-30', 8),
(8, 'kata kata', 'sini kak gem kasih paham', '2025-02-05', 6),
(10, 'test', 'lorem asdyauyd ahusd ahsud as', '2025-02-18', 1),
(11, 'coba coba', 'testing\r\n', '2025-02-18', 1),
(12, 'coba lagi', 'coba lagi', '2025-02-18', 1);

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
(23, 'Mazda RX-7', 'Kerennya Modifikasi Mazda RX7 LBWK Arief Muhammad yang Jadi Mirip Supercar', '2025-01-30', '742228638-f976d7f7bbb74fbfb53424cc950b68c4.jpg', 3, 1),
(24, 'fajar setboi', 'Fakta hari ini😔😔', '2025-02-05', '556462166-da416d4e35d347ee1500f5ac4d1893bc.jpg', 6, 3),
(25, 'kak gem', 'yang mau dikasih kata kata komen aja yach nanti kaka kasih kata kata buat klean', '2025-02-05', '1890635553-profil-kak-gem-tiktoker-asal-tanjung-balai-yang-sedang-naik-daun-dengan-jargon-paham-125832.webp', 8, 6),
(30, 'Porsche 911 GT3 RS', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam corporis deserunt doloribus labore voluptatem, accusantium enim nostrum tempora debitis inventore, quae voluptatum nemo alias odio ducimus perspiciatis magnam modi dolore.', '2025-02-05', '1768255110-cf2ae66d752ef62f54725e6369145410.jpg', 3, 1),
(31, 'PAHAM?!', 'Bilang sama si pukima itu kalau tidak tahu tentang kehidupanku nggak usah lebar kali muncungnya, paham?!', '2025-02-05', '1519108614-kak gem 🥰.jpg', 8, 6),
(32, 'PSHT', 'serlok tak parani', '2025-02-05', '308239668-versi hd cuyyy 🔥🔥🔥.jpg', 6, 3),
(33, 'tebak negara', 'watduhelllll omagaaaaaaaaa teknologi baru cuyyyyyy😱😱😱😱😱😱', '2025-02-05', '297269294-berotak aru.jpg', 6, 3),
(34, 'Sukuna ', 'pandai mewing Namun Bodoh Untuk sigma, Terkadang Manusia Terlalu skibidi Dalam sigma. Umur Hanyalah angka, mewing Diatas Segalanya', '2025-02-05', '2089804891-Subuxa.jpg', 6, 3),
(35, 'Megumi', 'si beliau ketika mau mati bilekjj😹😹😹', '2025-02-05', '95446119-F6s580BaUAAfUlN.jpg', 5, 2),
(36, 'akmal', '☝️☝️☝️☝️☝️☝️☝️☝️☝️☝️☝️☝️\r\n', '2025-02-05', '1376047275-☝️.jpg', 6, 3),
(37, 'test', 'testing', '2025-02-17', '1077778299-Screenshot (2).png', 2, 1),
(38, 'coba', 'coba testing ya', '2025-02-18', '551654835-images.jfif', 12, 1);

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
(25, 4, 3, 'halau', '2025-01-30', NULL),
(26, 16, 1, 'tengok tu', '2025-01-30', NULL),
(27, 7, 3, 'ijo apa itu bang', '2025-01-30', NULL),
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
(40, 14, 2, 'malas🧢', '2025-01-30', NULL),
(41, 23, 2, 'keren abieszzzz', '2025-02-05', NULL),
(42, 19, 1, 'info doksli', '2025-02-05', NULL),
(44, 22, 6, 'saatnya pamer', '2025-02-05', NULL),
(45, 13, 6, 'Jangan mencintai orang yang tidak pernah mencintaimu, kau hanya membuang-buang waktu. Lebih baik kau mencintai orang yang mempunyai kepastian kepadamu. Paham? ', '2025-02-05', NULL),
(46, 24, 3, '😔😔', '2025-02-05', NULL),
(47, 24, 1, '😔😔😔😔😔😔', '2025-02-05', 46),
(48, 24, 2, '😔😔😔😔😔😔😔😔😔😔😔😔', '2025-02-05', 46),
(49, 24, 6, 'Tetap bekerja keras untuk sesuatu yang bisa kamu nikmati. Nikmati makanan yang nantinya akan kamu beli dan nikmati situasi dan pemandangannya. Jangan pikirkan omongan orang karena omongan orang bisa membuat rusak mentalmu dan kau tidak berhak divonis oleh seseorang atas dirimu karena kau berhak hidup di atas dirimu sendiri bukan di atas kehendak orang lain. Paham?', '2025-02-05', NULL),
(50, 24, 3, 'PAHAMMMMM', '2025-02-05', 49),
(51, 25, 1, 'kak gem kak gem, minta kata katanya dong', '2025-02-05', NULL),
(52, 25, 6, 'Lebih baik bersedih dengan orang yang tepat daripada berbahagia dengan orang yang salah. Paham?', '2025-02-05', 51),
(53, 25, 2, 'kak gem kak gem, kata kata buat orang jomblo', '2025-02-05', NULL),
(54, 25, 6, 'Terserah Tuhan mau kasih jodoh orang mana, asal jangan orang Israel. Paham?! ', '2025-02-05', 53),
(55, 25, 3, 'kak gem kak gem, kata kata buat orang yang jatuh cinta', '2025-02-05', NULL),
(56, 25, 6, 'kamu boleh mencintai orang selama apapun itu, tapi ingat jangan pernah menghalangi dia untuk mencintai pilihannya, paham?!', '2025-02-05', 55),
(58, 31, 9, 'PAHAM!', '2025-02-05', NULL),
(59, 17, 9, 'astagfirullah', '2025-02-05', NULL),
(60, 30, 9, 'keren bener bang, berapaan ya', '2025-02-05', NULL),
(61, 33, 1, 'omagaaaa😱😱😱', '2025-02-05', NULL),
(62, 23, 3, 'badaszz🔥🔥🔥', '2025-02-05', NULL),
(63, 34, 2, '🤫🤫🤫🤫🤫🤫🤫', '2025-02-05', NULL),
(64, 33, 2, 'ini beneran apa borongan??', '2025-02-05', NULL),
(65, 35, 3, '😹😹😹😹😹😹', '2025-02-05', NULL),
(69, 3, 1, 'test', '2025-02-18', NULL),
(70, 36, 1, 'asdasdas', '2025-02-18', NULL),
(71, 38, 3, 'apa', '2025-02-18', NULL);

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
(15, 20, 3, '2025-01-30'),
(16, 13, 3, '2025-01-30'),
(17, 22, 3, '2025-01-30'),
(18, 9, 3, '2025-01-30'),
(19, 20, 2, '2025-01-30'),
(21, 16, 1, '2025-01-30'),
(22, 7, 8, '2025-01-30'),
(24, 21, 3, '2025-01-30'),
(25, 8, 3, '2025-01-30'),
(26, 6, 3, '2025-01-30'),
(27, 15, 2, '2025-01-30'),
(28, 13, 1, '2025-01-30'),
(29, 15, 3, '2025-02-05'),
(30, 23, 2, '2025-02-05'),
(31, 6, 6, '2025-02-05'),
(32, 14, 2, '2025-02-05'),
(33, 24, 3, '2025-02-05'),
(34, 24, 1, '2025-02-05'),
(35, 24, 2, '2025-02-05'),
(36, 1, 3, '2025-02-05'),
(37, 10, 3, '2025-02-05'),
(38, 19, 3, '2025-02-05'),
(39, 16, 3, '2025-02-05'),
(40, 2, 3, '2025-02-05'),
(41, 18, 3, '2025-02-05'),
(42, 17, 3, '2025-02-05'),
(43, 23, 3, '2025-02-05'),
(44, 25, 1, '2025-02-05'),
(45, 25, 2, '2025-02-05'),
(46, 25, 6, '2025-02-05'),
(47, 30, 1, '2025-02-05'),
(48, 25, 9, '2025-02-05'),
(49, 31, 9, '2025-02-05'),
(50, 30, 9, '2025-02-05'),
(51, 31, 6, '2025-02-05'),
(52, 24, 6, '2025-02-05'),
(53, 32, 3, '2025-02-05'),
(54, 33, 3, '2025-02-05'),
(55, 32, 1, '2025-02-05'),
(56, 4, 1, '2025-02-05'),
(57, 34, 3, '2025-02-05'),
(58, 35, 2, '2025-02-05'),
(59, 33, 2, '2025-02-05'),
(60, 35, 3, '2025-02-05'),
(61, 36, 3, '2025-02-05'),
(62, 17, 1, '2025-02-17'),
(63, 31, 1, '2025-02-17'),
(65, 21, 1, '2025-02-18'),
(66, 37, 1, '2025-02-18'),
(67, 38, 3, '2025-02-18');

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
(7, 8, 1, 'mengomentari foto Anda : fiesta chicken nugget', '2025-01-30 07:43:48', 0, 20),
(8, 2, 1, 'mengomentari foto Anda : suuuuuu', '2025-01-30 07:43:59', 0, 8),
(11, 8, 3, 'menyukai foto Anda.', '2025-01-30 07:44:45', 0, 21),
(12, 2, 3, 'menyukai foto Anda.', '2025-01-30 07:45:03', 0, 8),
(27, 8, 6, 'mengomentari foto Anda : saatnya pamer', '2025-02-05 00:55:33', 0, 22),
(36, 2, 3, 'menyukai foto Anda.', '2025-02-05 01:45:04', 0, 10),
(39, 6, 1, 'mengomentari foto Anda : kak gem kak gem, minta kata katanya dong', '2025-02-05 01:52:47', 0, 25),
(40, 6, 1, 'menyukai foto Anda.', '2025-02-05 01:52:49', 0, 25),
(41, 6, 2, 'menyukai foto Anda.', '2025-02-05 01:54:41', 0, 25),
(42, 6, 2, 'mengomentari foto Anda : kak gem kak gem, kata kata buat orang jomblo', '2025-02-05 01:55:36', 0, 25),
(43, 6, 3, 'mengomentari foto Anda : kak gem kak gem, kata kata buat orang yang jatuh cinta', '2025-02-05 01:58:19', 0, 25),
(44, 6, 9, 'menyukai foto Anda.', '2025-02-05 03:49:19', 0, 25),
(45, 6, 9, 'menyukai foto Anda.', '2025-02-05 03:49:25', 0, 31),
(46, 6, 9, 'mengomentari foto Anda : PAHAM!', '2025-02-05 03:49:37', 0, 31),
(57, 2, 3, 'menyukai foto Anda.', '2025-02-05 04:19:01', 0, 35),
(58, 2, 3, 'mengomentari foto Anda : 😹😹😹😹😹😹', '2025-02-05 04:19:11', 0, 35),
(61, 6, 1, 'menyukai foto Anda.', '2025-02-17 12:37:31', 0, 31),
(62, 8, 1, 'menyukai foto Anda.', '2025-02-18 00:44:10', 0, 21),
(64, 1, 3, 'menyukai foto Anda.', '2025-02-18 11:14:48', 1, 38),
(65, 1, 3, 'mengomentari foto Anda : apa', '2025-02-18 11:14:54', 1, 38);

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
(8, 'gilang', '6d8f8a1a4837f099459ec46a72660f30', 'gilang@gmail.com', 'gilang headset', 'pluto', 2, 'approved'),
(9, 'yanto', '827ccb0eea8a706c4c34a16891f84e7b', 'yanto@gmail.com', 'Yanto Serepet', 'digidaw', 2, 'approved'),
(10, 'percobaan1', '28c376610511e0de8232021cb672a5d5', 'percobaan1@gmail.com', 'percobaan1', 'jl anjay mabar', 2, 'approved'),
(11, 'percobaan2', 'c18ea5b1d8c46eb03f17cc10d857eef1', 'percobaan2@gmail.com', 'percobaan2', 'ytta ytta', 2, 'rejected'),
(12, 'percobaan3', '3a586584a31d1e71105c4582b2aa7f86', 'percobaan3@gmail.com', 'percobaan3', 'asjbhas dah sdbahs dha', 2, 'pending');

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
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
