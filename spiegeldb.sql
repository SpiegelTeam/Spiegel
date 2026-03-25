-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 06:14 PM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(7) NOT NULL,
  `main` set('Casual','Formal','Streetwear','Y2K','Indie','Kawaii','Baddie','Visco','80s & 90s','Vintage') NOT NULL,
  `sub` set('Academia','Coquette','Soft Boy','Soft Girl','Wednesday','Korean','Art hoe') NOT NULL,
  `alt` set('Grunge','E-Girl','Goth','Pastel','Edgy') NOT NULL,
  `core` set('Sanriocore','Cottagecore','Kidcore','Goblincore','Fairycore','Angelcore','Grandmacore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `price` int(7) NOT NULL,
  `stock` int(7) DEFAULT NULL,
  `category_id` int(7) NOT NULL,
  `gender` enum('masculine','feminine','unisex') NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reflections`
--

CREATE TABLE `reflections` (
  `reflection_id` int(9) NOT NULL,
  `user_id` int(7) NOT NULL,
  `item_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `pword`, `address`, `create_date`, `role`) VALUES
(11, 'Alya', 'malonzocml517@gmail.com', 'spiegeldb', '123 blah blah street', '2026-03-25 15:27:45', 'admin'),
(15, 'Thetalya', 'cloud.malonzo@ciit.edu.ph', 'SpiegelDB', '123 blah', '2026-03-25 15:29:34', 'user'),
(17, 'John', 'John@doe.com', 'JohnDoe', '123 John St', '2026-03-25 15:31:44', 'user'),
(21, 'adasd', 'asdasda@ad', 'asdasda', 'asasda', '2026-03-25 15:36:06', 'user'),
(24, 'sdasdsad', 'adasdadas@asd', 'asdas', 'asdasd', '2026-03-25 15:39:54', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
  ADD KEY `pro_cat_fk` (`category_id`);

--
-- Indexes for table `reflections`
--
ALTER TABLE `reflections`
  ADD PRIMARY KEY (`reflection_id`),
  ADD KEY `ref_user_id_fk` (`user_id`),
  ADD KEY `ref_item_fk` (`item_id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `pro_cat_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `reflections`
--
ALTER TABLE `reflections`
  ADD CONSTRAINT `ref_item_fk` FOREIGN KEY (`item_id`) REFERENCES `products` (`item_id`),
  ADD CONSTRAINT `ref_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
