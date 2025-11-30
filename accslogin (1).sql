-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2025 at 06:51 AM
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
-- Database: `accslogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id`, `admin_username`, `action`, `details`, `created_at`) VALUES
(1, 'admin', 'Added Record Type', 'Type: Shifting of Programs', '2025-11-28 02:21:39'),
(2, 'admin', 'Updated Request Status', 'Request ID 1 set to Approved', '2025-11-28 02:25:45'),
(3, 'admin', 'Updated Request Status', 'Request ID 1 set to Approved', '2025-11-28 02:27:15'),
(4, 'admin', 'Updated Request Status', 'Request ID 1 set to Approved', '2025-11-28 02:27:59'),
(5, 'admin', 'Updated Request Status', 'Request ID 1 set to Rejected', '2025-11-28 02:28:02'),
(6, 'admin', 'Updated Request Status', 'Request ID 1 set to Approved', '2025-11-28 02:28:06'),
(7, 'admin', 'Added Record Type', 'Type: Affidavit of Loss', '2025-11-28 02:29:06'),
(8, 'admin', 'Updated Request Status', 'Request ID 2 set to Approved', '2025-11-28 02:29:59'),
(9, 'admin', 'Added Program', 'Program: Bachelor of Science in Information Systems', '2025-11-28 02:48:43'),
(10, 'admin', 'Added Program', 'Program: Bachelor of Science In Accountancy', '2025-11-28 03:09:08'),
(11, 'admin', 'Enrolled Student', 'User ID 11 in Program ID 1', '2025-11-28 03:09:19'),
(12, 'admin', 'Updated Request Status', 'Request ID 10 set to Approved', '2025-11-28 13:43:00'),
(13, 'admin', 'Updated Request Status', 'Request ID 9 set to Pending', '2025-11-28 13:43:00'),
(14, 'admin', 'Updated Request Status', 'Request ID 9 set to Pending', '2025-11-28 13:43:01'),
(15, 'admin', 'Updated Request Status', 'Request ID 7 set to Pending', '2025-11-28 13:43:01'),
(16, 'admin', 'Updated Request Status', 'Request ID 10 set to Rejected', '2025-11-28 13:53:39'),
(17, 'admin', 'Updated Request Status', 'Request ID 137 set to Approved', '2025-11-28 14:02:18'),
(18, 'admin', 'Updated Request Status', 'Request ID 137 set to Approved', '2025-11-28 14:03:10'),
(19, 'admin', 'Changed Program', 'User ID 11 moved to Program ID 1', '2025-11-28 14:07:29'),
(20, 'admin', 'Changed Program', 'User ID 12 moved to Program ID 2', '2025-11-28 14:07:37'),
(21, 'admin', 'Changed Program', 'User ID 12 moved to Program ID 2', '2025-11-28 14:10:27'),
(22, 'admin', 'Changed Program', 'User ID 12 moved to Program ID 2', '2025-11-28 14:14:05'),
(23, 'admin', 'Enrolled Student', 'User ID 12 in Program ID 3', '2025-11-28 14:17:24'),
(24, 'admin', 'Enrolled Student', 'User ID 11 enrolled in Program ID 4', '2025-11-28 14:19:34'),
(25, 'admin', 'Enrolled Student', 'User ID 11 enrolled in Program ID 6', '2025-11-28 14:19:44'),
(26, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:21:26'),
(27, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:21:30'),
(28, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:21:58'),
(29, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:22:42'),
(30, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:23:02'),
(31, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:25:27'),
(32, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 6', '2025-11-28 14:25:35'),
(33, 'admin', 'Removed Student', 'Enrollment ID 3 removed', '2025-11-28 14:25:50'),
(34, 'admin', 'Removed Student', 'Enrollment ID 1 removed', '2025-11-28 14:25:51'),
(35, 'admin', 'Changed Program', 'User ID 11 switched to Program ID 1', '2025-11-28 14:26:10'),
(36, 'admin', 'Updated Request Status', 'Request ID 138 set to Approved', '2025-11-28 14:33:13'),
(37, 'admin', 'Updated Request Status', 'Request ID 139 set to Released', '2025-11-28 14:33:42'),
(38, 'admin', 'Enrolled Student', 'User ID 13 in Program ID 1', '2025-11-28 14:34:03'),
(39, 'admin', 'Added Record Type', 'Type: Baranggay Clearance', '2025-11-28 14:34:34'),
(40, 'admin', 'Added Program', 'Program: Bachelor of Science in Multimedia Arts', '2025-11-28 14:35:08'),
(41, 'admin', 'Updated Request Status', 'Request ID 141 set to Rejected', '2025-11-28 14:35:36'),
(42, 'admin', 'Enroll Student', 'User ID 12 in Program ID 1', '2025-11-28 15:13:17'),
(43, 'admin', 'Enroll Student', 'User ID 14 in Subject ID 3', '2025-11-28 15:16:55'),
(44, 'admin', 'Enroll Student', 'User ID 14 in Subject ID 5', '2025-11-28 15:17:00'),
(45, 'admin', 'Enroll Student', 'User ID 17 in Subject ID 3', '2025-11-28 15:35:39'),
(46, 'admin', 'Enroll Student', 'User ID 15 in Subject ID 3', '2025-11-28 15:35:42'),
(47, 'admin', 'Enroll Student', 'User ID 17 in Subject ID 1', '2025-11-28 15:35:50'),
(48, 'admin', 'Add Subject', '123 - Theology 3 by Mr. Babiano', '2025-11-28 16:10:48'),
(49, 'admin', 'Enroll Student', 'User ID 13 in Subject ID 6', '2025-11-28 16:11:09'),
(50, 'admin', 'Enroll Student', 'User ID 15 in Subject ID 6', '2025-11-28 16:11:39'),
(51, 'admin', 'Enroll Student', 'User ID 16 in Subject ID 6', '2025-11-28 16:11:42'),
(52, 'admin', 'Enroll Student', 'User ID 17 in Subject ID 6', '2025-11-28 16:11:46'),
(53, 'admin', 'Enroll Student', 'User ID 18 in Subject ID 1', '2025-11-28 16:39:01'),
(54, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 7', '2025-11-28 16:39:24'),
(55, 'admin', 'Add Subject', 'CP2 - Computer Programming 2 by Mr. Lee', '2025-11-28 16:39:54'),
(56, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 5', '2025-11-29 03:58:32'),
(57, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 5', '2025-11-29 04:00:30'),
(58, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 6', '2025-11-29 04:00:47'),
(59, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 4', '2025-11-29 04:04:54'),
(60, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 4', '2025-11-29 04:37:10'),
(61, 'admin', 'Enrolled Student', 'User ID 19 in Program ID 2', '2025-11-29 04:37:26'),
(62, 'admin', 'Add Subject', 'MNS - Magic & Sorcery  by Mr. Mephisto', '2025-11-29 04:38:29'),
(63, 'admin', 'Enroll Student', 'User ID 19 in Subject ID 3', '2025-11-29 04:41:53'),
(64, 'admin', 'Enroll Student', 'User ID 19 in Subject ID 8', '2025-11-29 05:02:05'),
(65, 'admin', 'Enroll Student', 'User ID 19 in Subject ID 6', '2025-11-29 05:04:03'),
(66, 'admin', 'Enroll Student', 'User ID 12 in Subject ID 8', '2025-11-29 05:06:40'),
(67, 'admin', 'Add Subject', 'SWR - Science with Mr Fantastic by Dr. Reed Richards', '2025-11-29 05:07:27'),
(68, 'admin', 'Enroll Student', 'User ID 19 in Subject ID 9', '2025-11-29 05:07:41'),
(69, 'admin', 'Updated Request Status', 'Request ID 144 set to Approved', '2025-11-29 05:09:03'),
(70, 'admin', 'Enroll Student', 'User ID 19 in Subject ID 10', '2025-11-29 13:27:46'),
(71, 'admin', 'Enroll Student', 'User ID 18 in Subject ID 3', '2025-11-29 14:29:11'),
(72, 'admin', 'Enroll Student', 'User ID 18 in Subject ID 9', '2025-11-29 14:29:29'),
(73, 'admin', 'Changed Program', 'User ID 20 switched to Program ID 7', '2025-11-30 03:42:44'),
(74, 'admin', 'Changed Program', 'User ID 19 switched to Program ID 5', '2025-11-30 03:44:05'),
(75, 'admin', 'Changed Program', 'User ID 18 switched to Program ID 6', '2025-11-30 03:44:10'),
(76, 'admin', 'Enroll Student', 'User ID 20 in Subject ID 8', '2025-11-30 03:46:09'),
(77, 'admin', 'Enroll Student', 'User ID 20 in Subject ID 10', '2025-11-30 03:46:14'),
(78, 'admin', 'Enroll Student', 'User ID 20 in Subject ID 9', '2025-11-30 03:46:25'),
(79, 'admin', 'Updated Request Status', 'Request ID 145 set to Approved', '2025-11-30 04:08:29'),
(80, 'admin', 'Changed Program', 'User ID 20 switched to Program ID 6', '2025-11-30 04:15:04'),
(81, 'admin', 'Changed Program', 'User ID 20 switched to Program ID 6', '2025-11-30 04:16:59'),
(82, 'admin', 'Updated Request Status', 'Request ID 146 changed to Approved', '2025-11-30 04:19:56'),
(83, 'admin', 'Updated Request Status', 'Request ID 146 changed to Approved', '2025-11-30 04:20:00'),
(84, 'admin', 'Updated Request Status', 'Request ID 146 changed to Approved', '2025-11-30 04:21:45'),
(85, 'admin', 'Enroll Student', 'User ID 20 in Subject ID 11', '2025-11-30 04:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `facilitator_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `facilitator_name`) VALUES
(8, 'MNS', 'Magic & Sorcery ', 'Mr. Mephisto'),
(9, 'SWR', 'Science with Mr Fantastic', 'Dr. Reed Richards'),
(10, 'SS', 'Sorcery Supreme Lab', 'Stephen Strange'),
(11, 'TIWS', 'Tech Integration with Stark', 'Tony Stark');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `user_id`, `subject_id`) VALUES
(25, 19, 8),
(28, 19, 9),
(29, 19, 10),
(31, 18, 9),
(32, 20, 8),
(33, 20, 10),
(34, 20, 9),
(35, 20, 11);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments_backup`
--

CREATE TABLE `enrollments_backup` (
  `enrollment_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments_backup`
--

INSERT INTO `enrollments_backup` (`enrollment_id`, `user_id`, `program_id`, `subject_id`) VALUES
(2, 12, 3, 0),
(4, 11, 1, 0),
(5, 13, 1, 0),
(6, 12, 1, 0),
(7, 14, 3, 0),
(8, 14, 5, 0),
(9, 17, 3, 0),
(10, 15, 3, 0),
(11, 17, 1, 0),
(12, 13, 6, 0),
(13, 15, 6, 0),
(14, 16, 6, 0),
(15, 17, 6, 0),
(16, 18, 4, 0),
(17, 19, 2, 0),
(19, 19, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 20, 'You have been enrolled in \"Bachelor of Science In Accountancy\".', 1, '2025-11-30 12:16:59'),
(2, 20, 'Your request #146 has been updated to \"Approved\".', 0, '2025-11-30 12:19:56'),
(3, 20, 'Your request #146 has been updated to \"Approved\".', 0, '2025-11-30 12:20:00'),
(4, 20, 'Your request #146 has been updated to \"Approved\".', 0, '2025-11-30 12:21:45'),
(5, 20, 'Your request #146 has been updated to \'Approved\'.', 0, '2025-11-30 12:23:46'),
(6, 20, 'Your request #146 has been updated to \'Approved\'.', 0, '2025-11-30 12:23:47'),
(7, 20, 'Your request #146 has been updated to \'Approved\'.', 0, '2025-11-30 12:23:47'),
(8, 20, 'You have been enrolled in a new program.', 0, '2025-11-30 12:28:45'),
(9, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:30:04'),
(10, 20, 'Your record request #145 has been Approved.', 0, '2025-11-30 12:30:06'),
(11, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:30:09'),
(12, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:30:18'),
(13, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:31:02'),
(14, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:32:20'),
(15, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:34:26'),
(16, 20, 'Your record request #146 has been Rejected.', 0, '2025-11-30 12:34:41'),
(17, 20, 'Your record request #146 status has been updated to Rejected', 0, '2025-11-30 12:37:15'),
(18, 20, 'Your record request #146 status has been updated to Rejected', 0, '2025-11-30 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `program_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program_name`) VALUES
(5, 'Bachelor of Science in Information Systems'),
(6, 'Bachelor of Science In Accountancy'),
(7, 'Bachelor of Science in Multimedia Arts');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `professor_name`, `rating`, `comment`, `created_at`) VALUES
(1, 19, 'Mr. Mephisto', 5, NULL, '2025-11-29 13:12:34'),
(2, 19, 'Mr. Babiano', 5, NULL, '2025-11-29 13:12:35'),
(3, 19, 'Dr. Reed Richards', 5, NULL, '2025-11-29 13:12:35'),
(4, 19, 'Stephen Strange', 5, NULL, '2025-11-29 13:28:07'),
(5, 20, 'Dr. Reed Richards', 4, NULL, '2025-11-30 03:46:38'),
(6, 20, 'Mr. Mephisto', 3, NULL, '2025-11-30 03:46:37'),
(7, 20, 'Stephen Strange', 2, NULL, '2025-11-30 03:46:36'),
(11, 20, 'Tony Stark', 1, NULL, '2025-11-30 04:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `record_requests`
--

CREATE TABLE `record_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `record_type_id` int(11) NOT NULL,
  `current_program_id` int(11) DEFAULT NULL,
  `new_program_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record_requests`
--

INSERT INTO `record_requests` (`request_id`, `user_id`, `record_type_id`, `current_program_id`, `new_program_id`, `status`, `date_requested`) VALUES
(137, '12', 1, 3, 2, 'Approved', '2025-11-28 14:02:04'),
(138, '13', 2, 3, NULL, 'Approved', '2025-11-28 14:32:41'),
(139, '13', 1, 3, 1, 'Released', '2025-11-28 14:33:31'),
(140, '13', 7, 3, NULL, 'Pending', '2025-11-28 14:34:40'),
(141, '13', 1, 3, 7, 'Rejected', '2025-11-28 14:35:21'),
(142, '18', 2, 2, NULL, 'Pending', '2025-11-29 04:22:38'),
(143, '18', 3, 2, NULL, 'Pending', '2025-11-29 04:22:41'),
(144, '19', 3, 1, NULL, 'Approved', '2025-11-29 05:08:47'),
(145, '20', 2, 5, NULL, 'Released', '2025-11-30 03:50:53'),
(146, '20', 2, 5, NULL, 'Rejected', '2025-11-30 04:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `record_types`
--

CREATE TABLE `record_types` (
  `id` int(11) NOT NULL,
  `record_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record_types`
--

INSERT INTO `record_types` (`id`, `record_name`) VALUES
(1, 'Shifting of Program'),
(2, 'Good Moral'),
(3, 'Form 137'),
(4, 'Enrollment Certificate'),
(7, 'Baranggay Clearance');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `current_program_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `program_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `id`, `current_program_id`, `first_name`, `last_name`, `email`, `password`, `program_id`, `created_at`, `profile_pic`) VALUES
('S627913', 18, 6, 'Kang ', 'The Conqueror', 'kangtheconqueror@gmail.com', '$2y$10$0VjhrUhdzXTZJ0UCsf.mwOuUaNY736KCAgwswzhGbsOZCaR.2UlIe', 2, '2025-11-28 16:37:46', 'uploads/S627913_1764390120.jpg'),
('S207369', 19, 5, 'Victor', 'Von Doom', 'drdooom@gmail.com', '$2y$10$drBVp33tKCZPO32Rot439OmZwqG1KMFLF0HHXP.EnqAZAXVfDv5HG', 1, '2025-11-29 04:29:59', 'uploads/S207369_1764390650.jpg'),
('S728495', 20, 6, 'Johnny', 'Storm', 'johnnystorm@gmail.com', '$2y$10$snya3nsxgTIGKp/Xl7.vg.oOUmZmmYNc2stEi28sPfvAh2hmc6T4S', 5, '2025-11-30 03:28:34', 'uploads/S728495_1764475076.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_subject` (`subject_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ux_user_prof` (`user_id`,`professor_name`);

--
-- Indexes for table `record_requests`
--
ALTER TABLE `record_requests`
  ADD PRIMARY KEY (`request_id`),
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `email_3` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `record_requests`
--
ALTER TABLE `record_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `record_types`
--
ALTER TABLE `record_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject` FOREIGN KEY (`subject_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `record_requests`
--
ALTER TABLE `record_requests`
  ADD CONSTRAINT `record_requests_ibfk_1` FOREIGN KEY (`record_type_id`) REFERENCES `record_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
