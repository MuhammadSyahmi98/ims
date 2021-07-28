-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2021 at 06:35 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(32) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(16, 'Nestle'),
(17, 'Munchy'),
(18, 'Nature Spring'),
(19, 'Dutch Lady');

-- --------------------------------------------------------

--
-- Table structure for table `group_detail`
--

CREATE TABLE `group_detail` (
  `group_id` int(32) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_level` int(32) NOT NULL,
  `group_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_detail`
--

INSERT INTO `group_detail` (`group_id`, `group_name`, `group_level`, `group_status`) VALUES
(18, 'User', 2, 'active'),
(20, 'Special', 3, 'active'),
(21, 'Admin', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(32) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `buy_price` int(255) NOT NULL,
  `sell_price` int(255) NOT NULL,
  `categorie_id` int(32) NOT NULL,
  `product_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_detail`, `buy_price`, `sell_price`, `categorie_id`, `product_quantity`) VALUES
(13, 'Mineral Water', '', 1, 3, 18, 6),
(14, 'Oat', '', 3, 6, 17, 15),
(16, 'Pure Farm-Chocolate', '', 4, 8, 16, 144),
(17, 'Choki-Choki', '30 per pack', 123, 124, 16, 0),
(18, 'Short Sleve', '', 123, 124, 18, 64),
(19, 'Oppo A3S', 'Green Color', 234, 341, 17, 205),
(20, 'One Piece', '', 76, 97, 18, 21),
(21, 'Phone', '50 gram per item', 2, 234, 16, 64),
(22, 'Milo 20g', '20 gram per pack', 23, 35, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(32) NOT NULL,
  `buy_price1` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `total_quantity` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `date` date NOT NULL,
  `UserId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `buy_price1`, `total_price`, `total_quantity`, `product_id`, `date`, `UserId`) VALUES
(70, 23, 35, 6, 22, '2019-12-11', 22),
(71, 123, 124, 4, 17, '2019-12-11', 22),
(72, 4, 8, 30, 16, '2019-12-11', 22),
(73, 123, 124, 40, 18, '2019-12-11', 22),
(74, 1, 3, 45, 13, '2019-12-11', 13),
(75, 4, 8, 45, 16, '2019-12-11', 13),
(76, 1, 3, 23, 13, '2019-12-11', 13),
(77, 23, 35, 15, 22, '2019-12-11', 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(32) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `name`, `level`) VALUES
(13, 'user', 'user', 'User', 2),
(23, 'special', 'special', 'Special', 3),
(24, 'admin', 'admin', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_detail`
--
ALTER TABLE `group_detail`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_level` (`group_level`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `UNIQUE` (`product_name`),
  ADD KEY `FK_products` (`categorie_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `SK` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `name` (`username`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `group_detail`
--
ALTER TABLE `group_detail`
  MODIFY `group_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`level`) REFERENCES `group_detail` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
