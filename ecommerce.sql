-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 11:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(6) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('Pending','Complete','Failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `user_id`, `product_id`, `total_price`, `status`) VALUES
(2, 1, 1, 150, 'Pending'),
(3, 1, 3, 480, 'Pending'),
(4, 1, 1, 150, 'Pending'),
(5, 1, 2, 1400, 'Pending'),
(7, 2, 2, 1250, 'Pending'),
(9, 2, 1, 150, 'Pending'),
(10, 2, 1, 150, 'Pending'),
(11, 2, 1, 150, 'Pending'),
(12, 2, 1, 150, 'Pending'),
(13, 2, 1, 150, 'Pending'),
(16, 2, 1, 150, 'Pending'),
(17, 2, 1, 150, 'Pending'),
(18, 2, 1, 150, 'Pending'),
(20, 2, 1, 150, 'Pending'),
(22, 2, 1, 150, 'Pending'),
(24, 2, 2, 1400, 'Pending'),
(25, 2, 1, 300, 'Pending'),
(26, 1, 3, 960, 'Pending'),
(27, 1, 3, 960, 'Pending'),
(31, 2, 5, 1300, 'Pending'),
(36, 3, 1, 300, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `quantity`) VALUES
(1, 'Airpod Pro', 'Good Quality Airpod Pro', 'Airpod pro.jpg', 150, 24),
(2, 'Apple Macbook Pro', 'Smart and Portable Apple Mac-book Pro 32GM RAM + 650GB ROM', 'Apple macbook pro.jpg', 1250, 12),
(3, 'Iphone XS Max', 'Brand New Iphone XS Max 4GB RAM 128GB ROM Colour Black', 'Iphone XS Max.jpg', 480, 13),
(4, 'Iphone 11', 'Brand New Iphone 11 4GB RAM 128GB ROM Colour Silver', 'Iphone 11.jpg', 400, 21),
(6, 'Iphone 13', 'Brand New Iphone 13 Max 4GB RAM 328GB ROM Colour Blue', 'Iphone 13.webp', 560, 23),
(7, 'Hub Adapter', 'Good Quality Hub Adapter with multiple ports', 'Hub Adapter.jpg', 250, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Jehoshaphat', 'Omon', 'jehoshaphatomon@gmail.com', '$2y$10$J8XAq3iDDOu9C0ArqhXGH./ltY72JLr0MtFxuOltDjiDfZU4uMFTG', 'Admin'),
(2, 'Frank', 'Ebube', 'frank@gmail.com', '$2y$10$8WNq.70NvxfdOGGYvPmeGOZAnrNDnDXXgXlJtivv.CQZxpJZQEyee', 'User'),
(3, 'Joshua', 'Williams', 'joshuawilliams@gmail.com', '$2y$10$Dcpp6w91ok157z3IO2k3Ze50AKtamxVVkLkN7JLltSyiYoJGPqCRy', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
