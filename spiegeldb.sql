-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2026 at 01:51 PM
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
-- Database: `spiegeldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aesthetics`
--

CREATE TABLE `aesthetics` (
  `aesthetic_id` int(7) NOT NULL,
  `aesthetic_name` varchar(100) NOT NULL,
  `type_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aesthetics`
--

INSERT INTO `aesthetics` (`aesthetic_id`, `aesthetic_name`, `type_id`) VALUES
(1, 'Casual', 1),
(2, 'Formal', 1),
(3, 'Streetwear', 1),
(4, 'Y2K', 1),
(5, 'Indie', 1),
(6, 'Kawaii', 1),
(7, 'Baddie', 1),
(8, 'Visco', 1),
(9, '80s & 90s', 1),
(10, 'Vintage', 1),
(11, 'Academia', 2),
(12, 'Coquette', 2),
(13, 'Soft Boy', 2),
(14, 'Soft Girl', 2),
(15, 'Wednesday', 2),
(16, 'Korean', 2),
(17, 'Art Hoe', 2),
(18, 'Grunge', 3),
(19, 'E-Girl', 3),
(20, 'Goth', 3),
(21, 'Pastel', 3),
(22, 'Edgy', 3),
(23, 'Sanriocore', 4),
(24, 'Cottagecore', 4),
(25, 'Kidcore', 4),
(26, 'Goblincore', 4),
(27, 'Fairycore', 4),
(28, 'Angelcore', 4),
(29, 'Grandmacore', 4);

-- --------------------------------------------------------

--
-- Table structure for table `aesthetics_type`
--

CREATE TABLE `aesthetics_type` (
  `type_id` int(7) NOT NULL,
  `aesthetic_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aesthetics_type`
--

INSERT INTO `aesthetics_type` (`type_id`, `aesthetic_type`) VALUES
(3, 'Alt'),
(4, 'Core'),
(1, 'Main'),
(2, 'Sub');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(7) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, ''),
(2, 'The Grunge Clothing Store'),
(3, 'Kawaii Babe'),
(4, 'UniQlo');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(9) NOT NULL,
  `user_id` int(7) NOT NULL,
  `item_id` int(9) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentmethod` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `item_id` int(7) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(7) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `brand_id` int(7) NOT NULL,
  `gender` enum('masculine','feminine','unisex') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`item_id`, `product_name`, `price`, `stock`, `description`, `image`, `brand_id`, `gender`) VALUES
(8, 'Katherine Vintage Top', 600.00, 30, 'A grunge Goth vintage top. Comes in black.', 'Katherine-shirt-1.png', 2, 'feminine'),
(11, 'The Sinning Maid Dress', 4000.00, 25, 'Feel the dark elegance of the Sinning Maid Dress, perfect for those who love the gothic look with a kawaii twist. With its intricate lace details and bold cross motifs, this dress blends goth aesthetic with a hint of rebellion.\r\n\r\n', 'sinning-maid-dress-dresses-cross-dress-embroidery-goth-gothic-425_700x.png', 3, 'feminine'),
(12, 'Wide Sweat Shorts', 1000.00, 50, '- Voluminous, slightly longer boxy cut.\r\n\r\nFunction details\r\n- Fit: Loose\r\n- Pockets: With Pockets', 'usgoods_482758_sub3_3x4.png', 4, 'unisex');

-- --------------------------------------------------------

--
-- Table structure for table `product_aesthetics`
--

CREATE TABLE `product_aesthetics` (
  `id` int(7) NOT NULL,
  `product_id` int(7) DEFAULT NULL,
  `aesthetic_id` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_aesthetics`
--

INSERT INTO `product_aesthetics` (`id`, `product_id`, `aesthetic_id`) VALUES
(1, 8, 4),
(2, 8, 18),
(3, 8, 20),
(4, 11, 6),
(5, 11, 20),
(6, 11, 22),
(7, 12, 1),
(8, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(7) NOT NULL,
  `username` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pword` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `pword`, `address`, `create_date`, `role`) VALUES
(17, 'John', 'John@doe.com', 'JohnDoe', '123 John St', '2026-03-25 23:31:44', 'admin'),
(21, 'adasd', 'asdasda@ad', 'asdasda', 'asasda', '2026-03-25 23:36:06', 'user'),
(24, 'sdasdsad', 'adasdadas@asd', 'asdas', 'asdasd', '2026-03-25 23:39:54', 'user'),
(26, 'asdadas', 'test@gmail.com', 'test', 'test', '2026-03-27 11:27:52', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aesthetics`
--
ALTER TABLE `aesthetics`
  ADD PRIMARY KEY (`aesthetic_id`),
  ADD UNIQUE KEY `aesthetic_name` (`aesthetic_name`),
  ADD KEY `fk_type` (`type_id`);

--
-- Indexes for table `aesthetics_type`
--
ALTER TABLE `aesthetics_type`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `aesthetic_type` (`aesthetic_type`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `ord_item_id_fk` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `fk_brand` (`brand_id`);

--
-- Indexes for table `product_aesthetics`
--
ALTER TABLE `product_aesthetics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productid` (`product_id`),
  ADD KEY `fk_aestheticid` (`aesthetic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aesthetics`
--
ALTER TABLE `aesthetics`
  MODIFY `aesthetic_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `aesthetics_type`
--
ALTER TABLE `aesthetics_type`
  MODIFY `type_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `item_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_aesthetics`
--
ALTER TABLE `product_aesthetics`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aesthetics`
--
ALTER TABLE `aesthetics`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `aesthetics_type` (`type_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ord_item_id_fk` FOREIGN KEY (`user_id`) REFERENCES `products` (`item_id`),
  ADD CONSTRAINT `ord_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `product_aesthetics`
--
ALTER TABLE `product_aesthetics`
  ADD CONSTRAINT `fk_aestheticid` FOREIGN KEY (`aesthetic_id`) REFERENCES `aesthetics` (`aesthetic_id`),
  ADD CONSTRAINT `fk_productid` FOREIGN KEY (`product_id`) REFERENCES `products` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
