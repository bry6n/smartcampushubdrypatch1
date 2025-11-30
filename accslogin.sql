 -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 10:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accslogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `record_requests`
--

CREATE TABLE `record_requests` (
  `request_id` char(36) NOT NULL DEFAULT uuid(),
  `user_id` varchar(50) NOT NULL,
  `record_type_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `record_types`
--

CREATE TABLE `record_types` (
  `id` int(11) NOT NULL,
  `record_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record_types`
--

INSERT INTO `record_types` (`id`, `record_name`) VALUES
(1, 'Change of Program/Major'),
(2, 'Dropping of Subjects'),
(3, 'Re-admission of Returning Student'),
(4, 'Simultaneous/Overload'),
(5, 'Requesting of Certificate of Enrollment');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
('jdoe', 1, 'john', 'doe', 'jdoe@email.com', 'password', '2025-11-25 16:13:39'),
('S941067', 2, 'jane', 'doe', 'jane_doe@email.com', '$2y$10$BENJnPoEWmDiVu9giEPrieDeVxpxdl7hpqA5VGJ6vgGAfJLXWSoY6', '2025-11-25 16:34:25'),
('S147386', 3, 'Juan', 'Dela Cruz', 'j_delacruz@email.com', '$2y$10$6iTjSMfocE4nHzsuDXCGNOyEbS9Liidu1OQqEfMKZ2/zGVzGAx3NW', '2025-11-26 03:17:07'),
('S346250', 4, 'jane', 'doe', 'jane_doe@email.com', '$2y$10$oey.8IUfvcKO5BgT7YeHeedNV6ekuzW8kIpDgDH33CHAEigeOKkga', '2025-11-26 03:20:43'),
('S358206', 5, 'Juan', 'Luna', 'jluna@email.com', '$2y$10$SB/00gidYSDiPLLCqWsp1uvV/yLFUb5Hf9Sy.a36CDh4Stuh9V/y.', '2025-11-26 09:03:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `record_requests`
--
ALTER TABLE `record_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `record_type_id` (`record_type_id`);

--
-- Indexes for table `record_types`
--
ALTER TABLE `record_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record_types`
--
ALTER TABLE `record_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `record_requests`
--
ALTER TABLE `record_requests`
  ADD CONSTRAINT `record_requests_ibfk_2` FOREIGN KEY (`record_type_id`) REFERENCES `record_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
