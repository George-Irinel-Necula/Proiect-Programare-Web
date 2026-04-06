-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 05:17 PM
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
-- Database: `elixirul_tineretii`
--

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

CREATE TABLE `featured_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `rating` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`id`, `product_name`, `photo`, `rating`) VALUES
(2, 'Ruj lichid mat L\'Oreal Paris Rouge Signature 104 I Rebel\r\n                Aubergine', 'https://s13emagst.akamaized.net/products/32486/32485503/images/res_d47f98e338339276191b5af1b379c15d.jpg?width=720&height=720&hash=F73B29ABE0874998AB7E0E6C9ECACC36', 4.9),
(3, 'Ruj mat L\'Oréal Rouge Signature - 142', 'https://s13emagst.akamaized.net/products/84539/84538532/images/res_946306bc8d70ed18492619af95a11d0f.jpg?width=720&height=720&hash=5F3B05ECF63117240DEAF3697AFA19AD', 4.7),
(4, 'Ruj Ultra Mat, Ideal Lilac, Avon', 'https://s13emagst.akamaized.net/products/88006/88005427/images/res_ab5e3f54ec0855a701e114458cea7e88.jpg?width=720&height=720&hash=D9B9676384CC538C9E79F65124F5DEBE', 4.8),
(5, 'Ruj lichid mat, rezistent la transfer L\'Oreal Paris Infaillible Matte Resistance', 'https://s13emagst.akamaized.net/products/8945/8944471/images/res_4963013a79849082f31fc3d99ee8afc2.jpg?width=720&height=720&hash=D4CAF4F03D29F4A7D7A2AB5DE4816DFDa', 4.9);

-- --------------------------------------------------------

--
-- Table structure for table `giveaway`
--

CREATE TABLE `giveaway` (
  `id` int(11) NOT NULL,
  `family_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `photo`, `rating`, `price`) VALUES
(2, 'Ruj lichid mat L\'Oreal Paris Rouge Signature 104 I Rebel\n                Aubergine', 'https://s13emagst.akamaized.net/products/32486/32485503/images/res_d47f98e338339276191b5af1b379c15d.jpg?width=720&height=720&hash=F73B29ABE0874998AB7E0E6C9ECACC36', 4.9, 20.00),
(3, 'Ruj mat L\'Oréal Rouge Signature - 142', 'https://s13emagst.akamaized.net/products/84539/84538532/images/res_946306bc8d70ed18492619af95a11d0f.jpg?width=720&height=720&hash=5F3B05ECF63117240DEAF3697AFA19AD', 4.7, 30.00),
(4, 'Ruj Ultra Mat, Ideal Lilac, Avon', 'https://s13emagst.akamaized.net/products/88006/88005427/images/res_ab5e3f54ec0855a701e114458cea7e88.jpg?width=720&height=720&hash=D9B9676384CC538C9E79F65124F5DEBE', 4.8, 40.00),
(5, 'Ruj lichid mat, rezistent la transfer L\'Oreal Paris Infaillible Matte Resistance', 'https://s13emagst.akamaized.net/products/8945/8944471/images/res_4963013a79849082f31fc3d99ee8afc2.jpg?width=720&height=720&hash=D4CAF4F03D29F4A7D7A2AB5DE4816DFDa', 4.9, 50.00),
(6, 'Ruj rezistent la transfer Max Factor Lipfinity, Angelic', 'https://s13emagst.akamaized.net/products/428/427443/images/res_70d904053d1458f338a5c09577dd3dda.jpg?width=720&height=720&hash=94ECC438DE991639EBB1A8FFE2639C91', 4.5, 48.00),
(7, 'Ruj lichid mat rezistent la transfer Maybelline New York Superstay Matte 20 Pioneer, 5 ml', 'https://s13emagst.akamaized.net/products/8945/8944470/images/res_a50dfa587e534ab2313b06e8f578d0e8.jpg?width=720&height=720&hash=A231784056B8948D878F046917996127', 4.3, 44.00),
(8, 'Ruj lichid rezistent cu stralucire de vinil Maybelline NY SuperStay Vinyl Ink 155 Upbeat , 4.2 ml', 'https://s13emagst.akamaized.net/products/70384/70383301/images/res_83dc48082a751db899ed025cf230fcc3.jpg?width=720&height=720&hash=A010AE34D4F0E49DA61639B35F303B9F', 4.7, 41.00),
(9, 'Ruj mat Catrice Blur-Real Matte Lipstick 040 - Muted Romance 3 g.', 'https://s13emagst.akamaized.net/products/114408/114407176/images/res_4519c3b15974f066df64b8d7101e358e.jpg?width=720&height=720&hash=158FD92E4DBABE3DC1AE2B430BF7A57E', 4.2, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_created`) VALUES
(15, 'TestAccount', 'test@gmail.com', '$2y$10$zZC/W.pjLVIYMI3YEIN9Kek4WcIkCtGwUYG7yaDYPrt3A/MvLh4n.', '2025-11-09 06:11:02'),
(16, 'test5', 'test3@gmail.com', '$2y$10$F8fMfFl.Q4jb2PYcIlwO0.M6aM/W4kjXJb5.1b5JgCJcEUK/B8BK.', '2025-11-09 06:38:57'),
(17, 'testf', 'testf@gmail.com', '$2y$10$PhZa1sEN9mGb5PjyK4/0h.iywXrjDr3ArghtGV0QdxqJAD/J/LNnK', '2025-11-09 06:50:08'),
(19, 'test3', 'test10@gmail.com', '$2y$10$PLDAz1JqnrW1PQujgCzfwefQWqu4O7PQ33Df0kDpPcE.NIriCg9D.', '2025-11-09 06:52:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `featured_products`
--
ALTER TABLE `featured_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giveaway`
--
ALTER TABLE `giveaway`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN_KEY` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `featured_products`
--
ALTER TABLE `featured_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `giveaway`
--
ALTER TABLE `giveaway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giveaway`
--
ALTER TABLE `giveaway`
  ADD CONSTRAINT `FOREIGN_KEY` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
