-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 10:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icle`
--

-- --------------------------------------------------------

--
-- Table structure for table `ausers`
--

CREATE TABLE `ausers` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ausers`
--

INSERT INTO `ausers` (`id`, `username`, `email`, `password`) VALUES
(0, 'abc123', 'arpitkhanna260@gmail.com', 'e99a18c428cb38d5f260853678922e03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_title`) VALUES
(1, 'Console\'s'),
(2, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `o_id` int(11) NOT NULL,
  `o_amount` float NOT NULL,
  `o_transaction` varchar(255) NOT NULL,
  `o_status` varchar(255) NOT NULL,
  `o_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(255) NOT NULL,
  `p_category_id` int(11) NOT NULL,
  `p_price` float NOT NULL,
  `p_quantity` int(11) NOT NULL,
  `p_description` text NOT NULL,
  `desc` text NOT NULL,
  `p_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_title`, `p_category_id`, `p_price`, `p_quantity`, `p_description`, `desc`, `p_image`) VALUES
(1, 'XBOX One S', 1, 300, 20, 'The Good The Xbox One S is a slick looking game console that\'s 40 percent smaller than the original and ditches the infamously gigantic power brick. ', 'XBox One S 1TB', 'img1.png'),
(2, 'XBOX One X', 1, 449, 15, 'The world\'s most powerful console\r\n\r\nWith 40% more power than any other console, experience immersive true 4K gaming. Games play better on Xbox One X.\r\n', 'All games look and play great on Xbox One X. But select titles are optimized to take advantage of the world’s most powerful console. These games are Xbox One X Enhanced.', 'img2.jpg'),
(3, 'PS4 PlayStation', 1, 440, 16, 'INCREDIBLE GAMES. ENDLESS ENTERTAINMENT.\r\nIntroducing the PlayStation 4.\r\nExclusive games take you on incredible journeys, from critically acclaimed indies to award-winning AAA hits.', 'The biggest names of the gaming world come alive on PS4™, from the superstars of FIFA 19, to the much anticipated Red Dead Redemption 2.', 'img4.png'),
(4, 'STADIA', 1, 129, 29, 'Night Blue Stadia Controller.\r\n\r\nChromecast Ultra.\r\n\r\n3 months Stadia Pro.\r\n\r\nDestiny 2 : The Collection.\r\n\r\nStadia Buddy Pass.\r\n\r\n', 'There’s no longer any need to spend on the latest hardware. With Stadia, you get up to 4K1 60 FPS1 gameplay on TVs2 without the hassle of time?consuming game downloads or in?game updates. ', 'img3.png'),
(5, 'Days Gone ', 2, 55, 6, 'Days Gone is a 2019 action-adventure survival horror video game developed by SIE Bend Studio and published by Sony Interactive Entertainment for the PlayStation 4.', 'Buy Days Gone, an open world action game for the PS4 console from the official PlayStation website. ', 'daysgone.jpg'),
(6, 'Zuma\'s Revenge', 2, 29, 9, 'Zuma\'s Revenge! is a tile-matching puzzle video game developed and published by PopCap Games. ', 'Mild Cartoon Violence.', 'zuma.jpg'),
(7, 'Zelda', 2, 30, 10, 'Zelda Nintendo Switch Game', 'Nintendo Switch Game', 'zelda.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'abc123', '$2y$10$/Dr.CwnYI7OZP1kXlTxycuT6bAGLjuRun35vNIBcTNh01TxKpL6yu', '2020-03-14 18:24:36'),
(3, 'abc', '$2y$10$T3o/cFIfWE/h2xQL8JR3ZOkiRf/TkVO84lKhZksXpM0rKGkcbzxpK', '2020-03-14 20:37:11'),
(4, 'arpitk', '$2y$10$21FfxGH.ISl7nKgXKcArN.MON6JJjYAzUF0DseE0Ie176zgfGAEMa', '2020-04-22 21:25:42'),
(5, 'arpitk1', '$2y$10$wGA71MWF/TaQRatEbbBgFOsBh/l2/TY9ir/.UefJFROuah/a1R1Y6', '2020-04-22 21:30:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
