-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 02:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

CREATE TABLE `gyms` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`id`, `name`, `address`, `city`, `created_on`) VALUES
(1, '300', 'Karadjordjeva 101', 'Smederevo', '2024-07-29 12:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `created_on` datetime NOT NULL,
  `paid_on` datetime NOT NULL,
  `valid_until` datetime NOT NULL,
  `item_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `created_on`, `paid_on`, `valid_until`, `item_id`, `client_id`, `trainer_id`) VALUES
(1, '2024-08-08 13:13:03', '2024-08-08 13:13:03', '2024-08-08 13:13:03', 2, 1, 2),
(2, '2024-08-08 13:13:03', '2024-08-08 13:13:03', '2024-08-08 13:13:03', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `name`, `price`) VALUES
(1, 'Jednokratni trening', '2000.00'),
(2, 'Meesecni plan', '7000.00');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `neck` float NOT NULL,
  `chest` float NOT NULL,
  `gluteus` float NOT NULL,
  `quadriceps` float NOT NULL,
  `lower_leg` float NOT NULL,
  `waist` float NOT NULL,
  `biceps` float NOT NULL,
  `measured_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `trainer_id`, `client_id`, `height`, `weight`, `neck`, `chest`, `gluteus`, `quadriceps`, `lower_leg`, `waist`, `biceps`, `measured_at`) VALUES
(1, 2, 1, 180, 80, 25, 80, 70, 60, 50, 80, 80, '2024-08-04'),
(2, 2, 1, 200, 70, 25, 80, 70, 90, 50, 80, 80, '2024-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `is_group` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `trainer_id`, `gym_id`, `is_group`, `date`, `time`, `created_at`) VALUES
(1, 2, 1, 0, '2024-08-15', '10:00:00', '2024-08-05 14:28:38'),
(2, 2, 1, 1, '2024-08-15', '12:00:00', '2024-08-05 14:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `training_clients`
--

CREATE TABLE `training_clients` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `deadline` int(5) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `is_trainer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `location`, `deadline`, `created_on`, `is_trainer`) VALUES
(1, 'Arsen', 'Leontjevic', 'arsen.leontijevic@gmail.com', '$2y$10$uNzZxumQ6cUJY80jRzd5w.lDO.v75ol0aJMN.22F3e6T6MDmootpC', '0666666666', 'Beograd', 12, '2024-07-22 14:11:53', 0),
(2, 'Nikola', 'Bojovic', 'nikola.bojovic9@gmail.com', '$2a$12$v8fodRFbyZIqRfn5dETBdesmq15ZgEr2uKArvMFBl2kcOhcNuxXqS', '0666666667', 'Smederevo', 10, '2024-07-23 14:56:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usr_tokens`
--

CREATE TABLE `usr_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usr_tokens`
--

INSERT INTO `usr_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(8, 'c71f23d805f535e95c3be8aa15e30aaa', '$2y$10$BVzdqN6KnhFyOyiRCZY9teDWbFP4LWbqXfEqjp.GBC20WeiVyBKtS', 1, '2024-09-07 12:43:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`) USING BTREE,
  ADD KEY `gym_id` (`gym_id`);

--
-- Indexes for table `training_clients`
--
ALTER TABLE `training_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_tokens`
--
ALTER TABLE `usr_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_clients`
--
ALTER TABLE `training_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usr_tokens`
--
ALTER TABLE `usr_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `invoice_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `measurements_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_3` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_ibfk_4` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_clients`
--
ALTER TABLE `training_clients`
  ADD CONSTRAINT `training_clients_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_clients_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usr_tokens`
--
ALTER TABLE `usr_tokens`
  ADD CONSTRAINT `usr_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
