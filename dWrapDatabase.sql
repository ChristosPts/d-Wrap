-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 09:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catNames` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catNames`) VALUES
(1, 'Space'),
(2, 'Sea'),
(3, 'Forest'),
(4, 'City'),
(5, 'Food'),
(6, 'Cyberpunk'),
(7, 'Winter'),
(8, 'Spring'),
(9, 'Summer'),
(10, 'Autumn'),
(11, 'Vehicles'),
(12, 'Fashion'),
(13, 'Animals'),
(14, 'Fantasy'),
(15, 'Vintage');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `imgPath` varchar(258) NOT NULL,
  `uploadDate` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `usersId`, `imgPath`, `uploadDate`, `views`, `likes`) VALUES
(123, 8, '635444650fd9b6.62825001.jpg', '2022-10-22 21:28:37', 2, 0),
(125, 8, '63544478e89ac7.16470972.jpg', '2022-10-22 21:28:56', 1, 0),
(133, 54, '6355579e7af9b0.54444931.jpg', '2022-10-23 17:02:54', 0, 0),
(140, 54, '63555915661145.99850629.jpg', '2022-10-23 17:09:09', 0, 0),
(142, 54, '63555925edd2e6.32645728.jpg', '2022-10-23 17:09:25', 0, 0),
(143, 54, '63555929b8e391.25107672.jpg', '2022-10-23 17:09:29', 1, 0),
(146, 54, '635559378af260.06601873.jpg', '2022-10-23 17:09:43', 0, 0),
(171, 54, '63555d3f4ceec4.52102921.jpg', '2022-10-23 17:26:55', 1, 0),
(177, 54, '63555e0a86b8e0.45199568.jpg', '2022-10-23 17:30:18', 0, 0),
(186, 54, '63555f64691384.13042647.jpg', '2022-10-23 17:36:04', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `img_categories`
--

CREATE TABLE `img_categories` (
  `imgCatId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img_categories`
--

INSERT INTO `img_categories` (`imgCatId`, `catId`, `imgId`) VALUES
(49, 5, 123),
(51, 5, 125),
(58, 13, 133),
(65, 15, 140),
(67, 4, 142),
(68, 4, 143),
(71, 4, 146),
(74, 14, 149),
(89, 8, 164),
(96, 9, 171),
(102, 1, 177),
(111, 7, 186);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(22) NOT NULL,
  `userId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `userId`, `imgId`) VALUES
(3, 7, 75),
(14, 7, 76),
(17, 7, 81),
(18, 7, 78),
(19, 7, 79),
(20, 7, 24),
(21, 7, 83),
(22, 8, 92),
(23, 7, 94),
(24, 46, 92),
(28, 46, 108),
(35, 7, 87),
(45, 7, 112),
(46, 7, 116),
(47, 46, 127);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpiration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpiration`) VALUES
(19, 'cristospt@hotmail.com', '2be65efedd4ef60a', '$2y$10$2kPr0tnLfh4FlEI71Nc08u2s898KNoiIO25Xq52EE4A8HXFizk0eC', '1667169173');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersUsername` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPassword` varchar(128) NOT NULL,
  `profileImg` varchar(128) NOT NULL,
  `userType` enum('Admin','User') NOT NULL DEFAULT 'User',
  `vkey` varchar(256) NOT NULL,
  `Verified` int(1) NOT NULL DEFAULT 0,
  `registerDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`);

--
-- Indexes for table `img_categories`
--
ALTER TABLE `img_categories`
  ADD PRIMARY KEY (`imgCatId`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `img_categories`
--
ALTER TABLE `img_categories`
  MODIFY `imgCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
