-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 10:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `review`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idu` int(11) NOT NULL,
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idu`, `user`, `name`, `password`) VALUES
(1, '1', 'Away Winter', '1');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `idm` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(3) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `recom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `linkweb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contry` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`idm`, `name`, `score`, `status`, `type`, `comment`, `recom`, `linkweb`, `contry`) VALUES
(1, 'Kyokai no Kanata', 5, 'กำลังดู', 'anime', 'สาวแว่นๆ', 'good', '-', 'Japan'),
(2, 'Love letter', 3, 'ดูแล้ว', 'movie', 'จดหมาย', 'normal', '-', 'Japan'),
(3, 'Sky Of Love', 4, 'ดูแล้ว', 'movie', 'พระเอกตาย', 'good', '-', 'Japan'),
(4, 'I Give My First Love To You', 3, 'ดูแล้ว', 'movie', 'กูจำไม่ได้', 'normal', '-', 'Japan'),
(5, 'Your name', 5, 'ดูแล้ว', 'anime', 'หนุก', 'fucking good', '-', 'Japan'),
(6, 'Tomorrow I Will Date With Yesterday’s You', 5, 'ดูแล้ว', 'movie', 'โคตรดีสลับเวลา', 'fucking good', '-', 'Japan'),
(7, 'Koe Koi', 3, 'ดูแล้ว', 'series', 'หัวถุง', 'normal', '-', 'Japan'),
(8, 'Heroine shikaku', 4, 'ดูแล้ว', 'series', 'กูจำไม่ได้', 'good', '-', 'Japan'),
(9, 'Wolf Girl and Black Prince', 3, 'ดูแล้ว', 'series', 'แย่งผญ.', 'good', '-', 'Japan'),
(10, 'Close Range Love', 4, 'ดูแล้ว', 'series', 'มักอาจาร', 'good', '-', 'Japan'),
(11, 'Orange', 4, 'ดูแล้ว', 'series', '-', 'good', '-', 'Japan'),
(12, 'Strobe Edge', 5, 'ดูแล้ว', 'series', 'กูจำไม่ได้', 'good', '-', 'Japan'),
(13, 'Flying Colors', 5, 'ดูแล้ว', 'movie', 'ซิ่ง', 'good', '-', 'Japan'),
(14, 'Chihayafuru Kami no Ku 1', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(15, 'Chihayafuru Shimo no Ku 2', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(16, 'Good Morning Call', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(17, 'Kanojo wa Uso o Aishisugiteru / The Liar and His L', 5, 'ดูแล้ว', 'series', 'ชอบ', 'fucking good', '-', 'Japan'),
(18, 'L-DK 2014', 4, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(19, 'Heroine Shikaku', 4, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(20, 'Commuting to School Series : Commuter Tram', 4, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(21, 'Your Lie In April', 5, 'ดูแล้ว', 'movie', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(22, 'Kimi Ni Todoke', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(23, 'THE CROWS ZERO 1', 5, 'ดูแล้ว', 'movie', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(24, 'Ao Haru Ride (Blue Spring Ride)', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(25, 'Isshukan Furenzu/One Week Friends', 5, 'ดูแล้ว', 'movie', 'หนุก', 'fucking good', '-', 'Japan'),
(26, 'Koe no Katachi', 5, 'ดูแล้ว', 'anime', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(27, 'The 8-Year Engagement', 5, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(28, 'Tonight , At Romance Theater', 5, 'ดูแล้ว', 'movie', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(29, 'Sachiiro no One Room ', 5, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(30, '3 Nen A Kumi', 5, 'ดูแล้ว', 'series', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(31, 'Kyou no Kira-kun', 5, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(32, 'A Love So Beautiful(China)', 5, 'ดูแล้ว', 'series', 'หนุกมาก', 'fucking good', '-', 'Korea'),
(33, 'Tsuugaku densha', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(34, 'Tsuugaku tochu', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(35, 'Okitegami Kyoko no Biboroku', 5, 'ดูแล้ว', 'series', 'นสงเอกน่ารัก', 'fucking good', '-', 'Japan'),
(36, 'Just Because!', 5, 'ดูแล้ว', 'anime', 'หนุกมาก', 'good', '-', 'Japan'),
(37, 'Kangoku Gakuen (Prison School)', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(38, 'All Esper Dayo! SP', 2, 'ดูแล้ว', 'series', 'ไปตาย', 'bad', '-', 'Japan'),
(39, 'Kimi no Suizo wo Tabetai', 5, 'ดูแล้ว', 'movie', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(40, 'Kimi no Suizo wo Tabetai', 5, 'ดูแล้ว', 'anime', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(41, 'ReLIFE Gets', 5, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(42, 'Erased', 5, 'ดูแล้ว', 'series', 'หนุก', 'fucking good', '-', 'Japan'),
(43, 'Tonari no Kaibutsu-kun', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(44, 'Sakamichi no Apollon', 4, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(45, 'Kakugo wa iika, Soko no Joshi', 4, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(46, 'Her Love Boils Bathwater', 4, 'ดูแล้ว', 'movie', 'หนุก', 'good', '-', 'Japan'),
(47, 'Let\'s go JETS', 3, 'ดูแล้ว', 'movie', 'หนุก', 'normal', '-', 'Japan'),
(48, 'Million Yen Women', 5, 'ดูแล้ว', 'series', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(49, 'Switched', 5, 'ดูแล้ว', 'series', 'หนุก', 'good', '-', 'Japan'),
(50, 'Kakegurui', 5, 'ดูแล้ว', 'series', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(51, 'Kakegurui', 5, 'ดูแล้ว', 'anime', 'หนุกมาก', 'fucking good', '-', 'Japan'),
(52, 'Kakegurui', 5, 'กำลังดู', 'Manga', 'หนุกมาก', 'fucking good', '-', 'Japan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idu`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`idm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
