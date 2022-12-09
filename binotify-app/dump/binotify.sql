-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2022 at 04:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(10) UNSIGNED NOT NULL,
  `album_title` varchar(64) NOT NULL,
  `album_artist` varchar(128) NOT NULL,
  `total_duration` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `tanggal_terbit` date NOT NULL DEFAULT current_timestamp(),
  `genre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_title`, `album_artist`, `total_duration`, `image_path`, `tanggal_terbit`, `genre`) VALUES
(1, 'Terbaik Terbaik', 'Dewa 19', 12, 'public\\assets\\image\\album_terbaik_terbaik.jpg', '2017-10-11', 'Pop'),
(2, 'The 2000\'s Greatest', 'Dewa 19', 7, 'public\\assets\\image\\album_the_2000_greatest.jpg', '2022-10-27', 'Pop'),
(3, 'Tubes di Surga', 'Pengabdi Tubes', 2, 'public/assets/image/122527362_160868095689225_8691869624869363627_n.jpg', '2014-07-22', 'Tubes'),
(5, 'Everlasting Hits', 'Chrisye', 0, 'public\\assets\\image\\album_everlasting_hits.jpg', '2018-10-09', 'Klasik'),
(6, 'Hari yang Cerah', 'Noah', -4, 'public\\assets\\image\\album_hari_yang_cerah.jpg', '2013-05-14', 'Melayu'),
(7, 'Kereta Kencan', 'HiVi', 0, 'public\\assets\\image\\album_kereta_kencan.jpg', '2022-10-09', 'Pop'),
(8, 'Lyodra', 'Lyodra', 0, 'public\\assets\\image\\album_lyodra.jpg', '2022-10-02', 'Pop'),
(9, 'Satu Hati Sejuta Cinta', 'Armada', 6, 'public\\assets\\image\\album_satu_hati_sejuta_cinta.jpg', '2015-01-28', 'Melayu'),
(11, 'Seperti Seharusnya', 'Noah', 0, 'public\\assets\\image\\album_seperti_seharusnya.jpg', '2009-11-13', 'Jazz'),
(12, 'Taman Langit', 'Noah', 0, 'public\\assets\\image\\album_taman_langit.jpg', '2006-08-09', 'Melayu'),
(229, 'dika dan diki', 'diki dan dika', 0, 'public/assets/image/129396135_10224935183831512_2782851776686510274_n.png', '2022-09-29', 'koding');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `song_id` int(10) UNSIGNED NOT NULL,
  `song_title` varchar(64) NOT NULL,
  `song_artist` varchar(128) DEFAULT NULL,
  `release_date` date NOT NULL DEFAULT current_timestamp(),
  `genre` varchar(64) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `audio_path` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `album_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_title`, `song_artist`, `release_date`, `genre`, `duration`, `audio_path`, `image_path`, `album_id`) VALUES
(1, 'Anak Sekolah', 'Chrisye', '2022-10-27', 'Klasik', 0, 'public\\assets\\audio\\Chrisye - Anak Sekolah (Official Lyric Video).mp3', 'public\\assets\\image\\anak_sekolah.jpg', NULL),
(2, 'Apa Kabar Sayang', 'Armada', '2015-05-13', 'Pop', 6, 'public\\assets\\audio\\Armada - Apa Kabar Sayang (Official Music Video).mp3', 'public\\assets\\image\\apa_kabar_sayang.jpg', 9),
(3, 'Asal Kau Bahagia', 'Armada', '2017-10-03', 'Pop', 7, 'public\\assets\\audio\\Armada - Asal Kau Bahagia (Official Lyric Video).mp3', 'public\\assets\\image\\asal_kamu_bahagia.jpg', NULL),
(4, 'Mesin Waktu', 'Budi Doremi', '2022-10-04', 'Pop', 4, 'public\\assets\\audio\\Budi Doremi – Mesin Waktu (OST. Aku Dan Mesin Waktu).mp3', 'public\\assets\\image\\mesin_waktu.jpg', NULL),
(5, 'Cintaku', 'Chrisye', '2017-05-18', 'Klasik', 3, 'public\\assets\\audio\\Chrisye - Cintaku (Official Karaoke Video).mp3', 'public\\assets\\image\\cintaku.jpg', 1),
(6, 'Kala Cinta Menggoda', 'Chrisye', '2013-02-21', NULL, 6, 'public\\assets\\audio\\Chrisye - Kala Cinta Menggoda (Official Music Video).mp3', 'public\\assets\\image\\kala_cinta_menggoda.jpg', NULL),
(7, 'Kisah Kasih di Sekolah', 'Chrisye', '2022-07-13', NULL, 8, 'public\\assets\\audio\\Chrisye - Kisah Kasih Disekolah (Official Music Video).mp3', 'public\\assets\\image\\kisah_kasih_di_sekolah.jpg', NULL),
(8, 'Seperti yang Kau Minta', 'Chrisye', '2016-11-01', 'Klasik', 2, 'public\\assets\\audio\\Chrisye - Seperti Yang Kau Minta (Official Music Video).mp3', NULL, 3),
(9, 'Pupus', 'Dewa 19', '2022-10-27', 'Pop', 4, 'public\\assets\\audio\\Dewa - Pupus _ Official Video.mp3', 'public\\assets\\image\\pupus.jpg', 1),
(10, 'Roman Picisan', 'Dewa 19', '2019-10-09', 'Pop', 3, 'public\\assets\\audio\\Dewa - Roman Picisan _ Official Video.mp3', 'public\\assets\\image\\roman_picisan.jpg', 2),
(11, 'Dewi', 'Dewa 19', '2015-10-15', 'Pop', 5, 'public\\assets\\audio\\Dewa 19 - Dewi (Official Music Video).mp3', NULL, 1),
(12, 'Kangen', 'Dewa 19', '2013-10-11', 'Pop', 4, 'public\\assets\\audio\\Dewa 19 - Kangen _ Official Video.mp3', 'public\\assets\\image\\kangen.jpg', 2),
(13, 'Bumi dan Bulan', 'HiVi', '2016-10-07', 'Pop', 4, 'public\\assets\\audio\\HIVI! - Bumi dan Bulan (Official Music Video).mp3', 'public\\assets\\image\\bumi_dan_bulan.jpg', NULL),
(15, 'Orang ke 3', 'HiVi', '2014-07-10', 'Jazz', 4, 'public\\assets\\audio\\HIVI! - Orang ke 3 (Official Music Video).mp3', 'public\\assets\\image\\orang_ke_3.jpg', NULL),
(16, 'Pelangi', 'HiVi', '2014-05-14', 'Reggae', 5, 'public\\assets\\audio\\HIVI! - Pelangi (Official Music Video).mp3', 'public\\assets\\image\\pelangi.jpg', NULL),
(17, 'Remaja', 'HiVi', '2019-11-02', 'Pop', 5, 'public\\assets\\audio\\HIVI! - Remaja (Official Music Video).mp3', 'public\\assets\\image\\remaja.jpg', NULL),
(18, 'Satu-Satunya', 'HiVi', '2017-10-19', NULL, 3, 'public\\assets\\audio\\HIVI! - Satu-Satunya (Official Music Video).mp3', NULL, NULL),
(19, 'Siapkah Kau \'Tuk Jatuh Cinta Lagi', 'HiVi', '2017-10-12', 'Pop', 6, 'public\\assets\\audio\\HIVI! - Siapkah Kau \'tuk Jatuh Cinta Lagi (Official Music Video) - Febrian Nindyo.mp3', NULL, NULL),
(20, 'Tak Ingin Usai', 'Keisya Levronka', '2016-10-23', 'Pop', 4, 'public\\assets\\audio\\Keisya Levronka - Tak Ingin Usai (Official Music Video).mp3', NULL, NULL),
(21, 'Pesan Terakhir', 'Lyodra', '2022-09-27', 'Pop', 3, 'public\\assets\\audio\\Lyodra - Pesan Terakhir (Official Music Video).mp3', NULL, NULL),
(22, 'Sang Dewi', 'Lyodra', '2022-08-10', 'Pop', 5, 'public\\assets\\audio\\Lyodra, Andi Rianto - Sang Dewi (Official Music Video).mp3', 'public\\assets\\image\\sang_dewi.jpg', NULL),
(23, 'Kisah Sempurna', 'Mahalini', '2014-10-15', NULL, 3, 'public\\assets\\audio\\MAHALINI - KISAH SEMPURNA (OFFICIAL MUSIC VIDEO).mp3', 'public\\assets\\image\\kisah_sempurna.jpg', NULL),
(24, 'Melawan Restu', 'Mahalini', '2018-08-17', 'Reggae', 5, 'public\\assets\\audio\\MAHALINI - MELAWAN RESTU (OFFICIAL MUSIC VIDEO).mp3', 'public\\assets\\image\\melawan_restu.jpg', NULL),
(25, 'Sisa Rasa', 'Mahalini', '2022-09-02', NULL, 4, 'public\\assets\\audio\\MAHALINI - SISA RASA (OFFICIAL MUSIC VIDEO).mp3', NULL, NULL),
(26, 'Bertaut', 'Nadin Amizah', '2020-07-16', 'Tradisional', 4, 'public\\assets\\audio\\Nadin Amizah - Bertaut (Official Lyric Video).mp3', 'public\\assets\\image\\bertaut.jpg', NULL),
(27, 'Yang Terdalam', 'Noah', '2021-10-13', 'Melayu', 4, 'public\\assets\\audio\\NOAH - Yang Terdalam (Official Music Video).mp3', 'public\\assets\\image\\yang_terdalam.jpg', NULL),
(28, 'Runtuh', 'Feby Putri', '2021-11-13', 'Jazz', 3, 'public\\assets\\audio\\Runtuh - Feby Putri feat. Fiersa Besari (Official Audio).mp3', 'public\\assets\\image\\runtuh.jpg', NULL),
(29, 'Asmalibrasi', 'Soegi Bornean', '2022-07-14', 'Modern', 4, 'public\\assets\\audio\\Soegi Bornean - Asmalibrasi (Official Music Video).mp3', 'public\\assets\\image\\asmalibrasi.jpg', NULL);

--
-- Triggers `song`
--
DELIMITER $$
CREATE TRIGGER `add_song_duration_to_album` AFTER INSERT ON `song` FOR EACH ROW UPDATE album
    SET total_duration = total_duration + new.duration
    WHERE album_id=new.album_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_album_id_in_song` BEFORE UPDATE ON `song` FOR EACH ROW UPDATE album
SET 
	total_duration = total_duration - OLD.duration
WHERE
	album_id = OLD.album_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `substract_song_duration_from_album` AFTER DELETE ON `song` FOR EACH ROW UPDATE album
    SET total_duration = total_duration - old.duration
    WHERE album_id=old.album_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `creator_id` int(10) UNSIGNED NOT NULL,
  `subscriber_id` int(10) UNSIGNED NOT NULL,
  `status` enum('PENDING','ACCEPTED','REJECTED') NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `isAdmin`) VALUES
(1, 'diky@diky.com', '3f8f6d429da85628e11f47a233860c444d67aef332a451dc08ac6ef7aeee6bcd', 'diky', 1),
(2, 'dika@dika.com', 'dda29d2a069f67bfaa0f505b7bc837c0181b39888926a126e9d707828d12b4b4', 'dika', 1),
(5, 'alifia@alifia.com', '7422cf52c9550b39b874c2509c27240a68e2ae12b6f98031d17b92f16d817765', 'alifia', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `FOREIGN_KEY_ALBUM_ID` (`album_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`creator_id`,`subscriber_id`),
  ADD KEY `subscription_FK` (`subscriber_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `FOREIGN_KEY_ALBUM_ID` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_FK` FOREIGN KEY (`subscriber_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
