-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 03:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionexus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_des` varchar(500) NOT NULL,
  `item_price` varchar(100) NOT NULL,
  `item_qty` varchar(100) NOT NULL,
  `item_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`id`, `item_name`, `item_des`, `item_price`, `item_qty`, `item_pic`) VALUES
(3, 'T Shirt', 'Branded Good Quality', '85', '6', 'Item 01.jpg'),
(4, 'Blue Skirt', 'Good Quality Blue Skirt', '45', '8', 'WhatsApp Image 2025-11-14 at 10.29.31 PM.jpeg'),
(5, 'White Shoes', 'Good Quality White Shoes', '120', '6', 'WhatsApp Image 2025-11-14 at 10.36.07 PM.jpeg'),
(6, 'Branded Shoes', 'Good Quality Branded Shoes', '220', '7', 'WhatsApp Image 2025-11-14 at 10.36.08 PM.jpeg'),
(7, 'Shorts', 'Good Quality ladies Shorts', '85', '6', 'WhatsApp Image 2025-11-14 at 10.31.59 PM.jpeg'),
(8, 'White Tops', 'Good Quality ladies Tops', '45', '5', 'WhatsApp Image 2025-11-14 at 10.32.00 PM.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(0, 'Test User', 'user@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'user'),
(0, 'Test Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages_tbl`
--

CREATE TABLE `user_messages_tbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_messages_tbl`
--

INSERT INTO `user_messages_tbl` (`id`, `full_name`, `contact_no`, `email`, `message`) VALUES
(7, 'Sam', 452158741, 'sam@gmail.com', 'Any refund options? '),
(8, 'John', 452158741, 'john@gmail.com', 'Can I pay cash on delivery'),
(9, 'John', 452158741, 'john@gmail.com', 'Can I pay cash on delivery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_messages_tbl`
--
ALTER TABLE `user_messages_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_messages_tbl`
--
ALTER TABLE `user_messages_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
