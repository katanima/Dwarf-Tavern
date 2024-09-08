-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 02:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partygamez`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `website`, `url`) VALUES
(1, 'szachy', 'kurnik', 'https://www.kurnik.pl/szachy/'),
(2, 'puzzle', 'jiggie', 'https://jiggie.fun/');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `name`) VALUES
(1, 'fotografia'),
(2, 'malarstwo'),
(3, 'motoryzacja'),
(4, 'szachy'),
(5, 'modelowanie 3D'),
(6, 'łowienie ryb');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `roomId` int(10) UNSIGNED DEFAULT NULL,
  `receiverId` int(10) UNSIGNED DEFAULT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `date` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `roomId`, `receiverId`, `userId`, `content`, `date`) VALUES
(4, 1, 0, 1, 'llll', '13:15:50'),
(5, 2, 0, 1, 'aha', '19:24:50'),
(11, NULL, 2, 1, 'wwwwwww', '15:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `proposedgames`
--

CREATE TABLE `proposedgames` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `gameId` int(10) UNSIGNED NOT NULL,
  `roomNumber` int(11) NOT NULL,
  `ownerId` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `usersLimit` int(11) NOT NULL,
  `strictLimit` tinyint(1) NOT NULL,
  `date` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `gameId`, `roomNumber`, `ownerId`, `name`, `description`, `password`, `usersLimit`, `strictLimit`, `date`) VALUES
(1, 1, 0, 1, 'wwwww', '', '', 4, 0, '20:06:54'),
(2, 2, 20, 1, 'aaaaa', '', '', 1, 0, '17:53:10'),
(3, 1, 2, 1, 'wwwww', '', '', 5, 0, '13:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `bio` text NOT NULL,
  `pfp` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  `createDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `nick`, `email`, `password`, `bio`, `pfp`, `role`, `createDate`) VALUES
(1, 'admin', 'adminOOO', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'idk man', 'eiki.jpg', 1, '2024-08-30'),
(2, 'bucket', 'bucket', 'bucket@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', 0, '2024-09-02'),
(5, 'jokerKebab', 'jokerKebab', 'jokerkebab@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', 0, '2024-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `usersinrooms`
--

CREATE TABLE `usersinrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `roomId` int(10) UNSIGNED NOT NULL,
  `isBanned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersinrooms`
--

INSERT INTO `usersinrooms` (`id`, `userId`, `roomId`, `isBanned`) VALUES
(7, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersinterests`
--

CREATE TABLE `usersinterests` (
  `id` int(10) UNSIGNED NOT NULL,
  `interestId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersinterests`
--

INSERT INTO `usersinterests` (`id`, `interestId`, `userId`) VALUES
(3, 1, 1),
(4, 2, 1),
(5, 3, 1),
(6, 5, 1),
(9, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `proposedgames`
--
ALTER TABLE `proposedgames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameId` (`gameId`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersinrooms`
--
ALTER TABLE `usersinrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indexes for table `usersinterests`
--
ALTER TABLE `usersinterests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interestId` (`interestId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `proposedgames`
--
ALTER TABLE `proposedgames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usersinrooms`
--
ALTER TABLE `usersinrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usersinterests`
--
ALTER TABLE `usersinterests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`);

--
-- Constraints for table `usersinrooms`
--
ALTER TABLE `usersinrooms`
  ADD CONSTRAINT `usersinrooms_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `usersinrooms_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `usersinterests`
--
ALTER TABLE `usersinterests`
  ADD CONSTRAINT `usersinterests_ibfk_1` FOREIGN KEY (`interestId`) REFERENCES `interests` (`id`),
  ADD CONSTRAINT `usersinterests_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
