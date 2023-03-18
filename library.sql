-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2023 at 08:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `emprunts`
--

CREATE TABLE `emprunts` (
  `id_emprunt` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime DEFAULT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_gerant_valide` int(11) DEFAULT NULL,
  `id_gerant_retour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprunts`
--

INSERT INTO `emprunts` (`id_emprunt`, `date_emprunt`, `date_retour`, `id_reservation`, `id_gerant_valide`, `id_gerant_retour`) VALUES
(56, '2023-03-17 17:51:27', '2023-03-17 17:52:25', 465, 1, 2),
(57, '2023-03-17 17:51:35', '2023-03-17 17:52:29', 467, 1, 2),
(58, '2023-03-17 17:52:21', NULL, 466, 2, NULL),
(59, '2023-03-18 15:07:26', NULL, 468, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gerant`
--

CREATE TABLE `gerant` (
  `id_gerant` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password_system` varchar(350) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerant`
--

INSERT INTO `gerant` (`id_gerant`, `first_name`, `last_name`, `email`, `password_system`, `password`) VALUES
(1, 'Soufiane', 'Boukhar', 'soufiane@gmail.com', '$2y$10$fr2mxYCz57.368oIJj9Yg.hwZ8w/xVRe4ttuw3MK3W35HO59tcj7q', '$2y$10$pUmqYpmMwiAbwcaaMEkEoOTRojn/gZR0GQkbts9MtcDzQ8aWPXT2K'),
(2, 'Anas', 'Alami', 'anas@gmail.com', '$2y$10$fr2mxYCz57.368oIJj9Yg.hwZ8w/xVRe4ttuw3MK3W35HO59tcj7q', '$2y$10$pUmqYpmMwiAbwcaaMEkEoOTRojn/gZR0GQkbts9MtcDzQ8aWPXT2K');

-- --------------------------------------------------------

--
-- Table structure for table `gestion`
--

CREATE TABLE `gestion` (
  `id_gestion` int(11) NOT NULL,
  `id_ouvrage` int(11) NOT NULL,
  `id_gerant` int(11) NOT NULL,
  `type_operation` varchar(50) NOT NULL,
  `date_operation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gestion`
--

INSERT INTO `gestion` (`id_gestion`, `id_ouvrage`, `id_gerant`, `type_operation`, `date_operation`) VALUES
(2, 13, 1, 'Addition', '2023-03-05'),
(3, 21, 1, 'Addition', '2023-03-05'),
(4, 31, 2, 'Addition', '2023-03-05'),
(5, 48, 2, 'Addition', '2023-03-05'),
(6, 59, 2, 'Addition', '2023-03-05'),
(7, 68, 1, 'Addition', '2023-03-05'),
(8, 74, 1, 'Addition', '2023-03-05'),
(9, 84, 1, 'Addition', '2023-03-05'),
(10, 95, 1, 'Addition', '2023-03-05'),
(11, 110, 1, 'Addition', '2023-03-05'),
(12, 119, 1, 'Addition', '2023-03-05'),
(13, 15, 1, 'Edit', '2023-03-05'),
(14, 133, 2, 'Addition', '2023-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `type_membre` varchar(30) NOT NULL,
  `ID_card` varchar(13) NOT NULL,
  `date_inscription` date NOT NULL,
  `banned` int(11) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_membre`, `first_name`, `last_name`, `username`, `email`, `phone`, `type_membre`, `ID_card`, `date_inscription`, `banned`, `password`) VALUES
(1, 'Karim', 'Boukhar', 'karim.bkh', 'karim@gmail.com', '0697059355', 'STUDENT', 'KB15214', '2023-03-05', 4, '$2y$10$3kE2TgOmjE6d8fUbriIhk.JpXPu5LXLddXAvJpxp23kM7dJzNmQIe'),
(2, 'Younes', 'Yazid', 'younes.bkh', 'youness@gmail.com', '0697059355', 'EMPLOYER', 'GK12541', '2023-03-05', 0, '$2y$10$Ul.vw0spFZUpDRxmFXo.uuKwWd0UNzIqQhpofB0wKobXeAfHxkGkO');

-- --------------------------------------------------------

--
-- Table structure for table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `id_ouvrage` int(11) NOT NULL,
  `name_ouvrage` varchar(50) NOT NULL,
  `state_ouvrage` varchar(50) NOT NULL,
  `date_achat` date NOT NULL,
  `date_edition` date NOT NULL,
  `type_ouvrage` varchar(50) NOT NULL,
  `pages_ouvrage` int(11) NOT NULL,
  `image_main` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ouvrage`
--

INSERT INTO `ouvrage` (`id_ouvrage`, `name_ouvrage`, `state_ouvrage`, `date_achat`, `date_edition`, `type_ouvrage`, `pages_ouvrage`, `image_main`) VALUES
(13, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(14, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(15, 'Antigone', 'MEDUIM', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(16, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(17, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(18, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(19, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(20, 'Antigone', 'EXCELLENT', '2023-03-04', '1946-03-24', 'NOVEL', 128, 'images/antigone.jpg'),
(21, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(22, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(23, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(24, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(25, 'Benedict Cumberbatch', 'MEDUIM', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(26, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(27, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(28, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(29, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(30, 'Benedict Cumberbatch', 'EXCELLENT', '2023-03-05', '2017-04-02', 'CD', 0, 'images/benedict.jpg'),
(31, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(32, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(33, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(34, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(35, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(36, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(37, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(38, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(39, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(40, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(41, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(42, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(43, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(44, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(45, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(46, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(47, 'The New Yorker', 'EXCELLENT', '2023-03-04', '2014-03-13', 'MAGAZINE', 87, 'images/yorker.jpg'),
(48, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(49, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(50, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(51, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(52, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(53, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(54, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(55, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(56, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(57, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(58, 'Mythos', 'EXCELLENT', '2023-03-01', '2023-03-06', 'CD', 0, 'images/Mythos.jpg'),
(59, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(60, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(61, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(62, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(63, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(64, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(65, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(66, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(67, 'The Secret', 'EXCELLENT', '2023-03-03', '2018-11-07', 'CD', 0, 'images/Secret.jpg'),
(68, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(69, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(70, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(71, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(72, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(73, 'Fifty Shades of Grey', 'EXCELLENT', '2023-03-02', '2019-01-24', 'CD', 0, 'images/Fifty.jpg'),
(74, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(75, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(76, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(77, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(78, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(79, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(80, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(81, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(82, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(83, 'Homestead', 'EXCELLENT', '2023-03-01', '2021-11-08', 'BOOK', 92, 'images/Homestead.webp'),
(84, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(85, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(86, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(87, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(88, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(89, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(90, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(91, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(92, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(93, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(94, 'The Peach Seed', 'MEDUIM', '2023-03-05', '2020-07-24', 'BOOK', 192, 'images/Peach.webp'),
(95, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(96, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(97, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(98, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(99, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(100, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(101, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(102, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(103, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(104, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(105, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(106, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(107, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(108, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(109, 'Panpocalypse', 'EXCELLENT', '2023-03-04', '2020-09-12', 'BOOK', 78, 'images/Panpocalypse.webp'),
(110, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(111, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(112, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(113, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(114, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(115, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(116, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(117, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(118, 'People', 'EXCELLENT', '2023-03-01', '2017-10-08', 'MAGAZINE', 102, 'images/people.jpg'),
(119, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(120, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(121, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(122, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(123, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(124, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(125, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(126, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(127, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(128, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(129, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(130, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(131, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(132, 'Born to Run', 'EXCELLENT', '2023-03-02', '2014-02-03', 'CD', 0, 'images/Born.jpg'),
(133, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(134, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(135, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(136, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(137, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(138, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(139, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(140, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(141, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(142, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(143, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(144, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg'),
(145, 'The Jane Austen', 'EXCELLENT', '2023-03-03', '2016-12-04', 'BOOK', 134, 'images/Austen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `state_reservation` varchar(200) NOT NULL,
  `date_reservation` datetime NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_ouvrage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `state_reservation`, `date_reservation`, `id_membre`, `id_ouvrage`) VALUES
(465, 'The reservation has been returned successfully', '2023-03-17 17:50:12', 2, 21),
(466, 'The reservation has been confirmed', '2023-03-17 17:50:14', 2, 84),
(467, 'The reservation has been returned successfully', '2023-03-17 17:50:18', 2, 95),
(468, 'The reservation has been confirmed', '2023-03-18 15:06:32', 2, 31),
(469, 'Being Processed', '2023-03-18 15:06:35', 2, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_gerant_valide` (`id_gerant_valide`),
  ADD KEY `id_gerant_retour` (`id_gerant_retour`),
  ADD KEY `idx_id_emp` (`id_emprunt`);

--
-- Indexes for table `gerant`
--
ALTER TABLE `gerant`
  ADD PRIMARY KEY (`id_gerant`),
  ADD KEY `idx_id_ger` (`id_gerant`);

--
-- Indexes for table `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`id_gestion`),
  ADD KEY `id_ouvrage` (`id_ouvrage`),
  ADD KEY `id_gerant` (`id_gerant`),
  ADD KEY `idx_id_ges` (`id_gestion`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD KEY `idx_id_mem` (`id_membre`);

--
-- Indexes for table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`id_ouvrage`),
  ADD KEY `idx_id_ouv` (`id_ouvrage`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_ouvrage` (`id_ouvrage`),
  ADD KEY `idx_id_res` (`id_reservation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `id_ouvrage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`id_gerant_valide`) REFERENCES `gerant` (`id_gerant`),
  ADD CONSTRAINT `emprunts_ibfk_3` FOREIGN KEY (`id_gerant_retour`) REFERENCES `gerant` (`id_gerant`);

--
-- Constraints for table `gestion`
--
ALTER TABLE `gestion`
  ADD CONSTRAINT `gestion_ibfk_1` FOREIGN KEY (`id_ouvrage`) REFERENCES `ouvrage` (`id_ouvrage`),
  ADD CONSTRAINT `gestion_ibfk_2` FOREIGN KEY (`id_gerant`) REFERENCES `gerant` (`id_gerant`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_ouvrage`) REFERENCES `ouvrage` (`id_ouvrage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
