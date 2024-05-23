-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 12:34 PM
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
-- Database: `interview_coaching`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'PIO', '$2y$10$EFXLDh48WRiOdRLSv9FzZuOCbQBmWIqabKHaCT/o3UpMPAhqge7jy', 'pio@gmail.com', '2024-05-15 12:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `goals` text DEFAULT NULL,
  `interests` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `user_id`, `occupation`, `goals`, `interests`) VALUES
(1, 9, 'receptioniost', 'i want to improve my interaction with manager and customers', 'read book'),
(2, 10, 'receptioniost', 'dghfv', 'fjhhhg');

-- --------------------------------------------------------

--
-- Table structure for table `client_profile`
--

CREATE TABLE `client_profile` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_profile`
--

INSERT INTO `client_profile` (`client_id`, `user_id`, `full_name`, `date_of_birth`, `address`, `phone_number`, `photo_path`) VALUES
(10, 10, 'PIO ', '2024-05-19', 'muhanga', '0785885111', '????\0JFIF\0,,\0\0??\0?Exif\0\0II*\0\0\0\0\0\0`\0\0\02\0\0\0\Z\0\0\0\0?\0\0\0\0\0\0\0?\0\0\0\0\0\0\0Coronavirus quarantine. Kids stay at home, Distance learning online education. Social isolation.,\0\0\0\0\0,\0\0\0\0\0???http://ns.adobe.com/xap/1.0/\0<?xpacket begin=\"﻿\" id=\"W5M0Mp');

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coach_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coach_id`, `user_id`, `specialization`, `bio`, `rating`, `availability`) VALUES
(2, 8, 'social interactions', 'lecture at UR huye', 5.00, 'every day afternoon');

-- --------------------------------------------------------

--
-- Table structure for table `coach_profile`
--

CREATE TABLE `coach_profile` (
  `coach_id` int(11) NOT NULL,
  `coach_name` varchar(100) NOT NULL,
  `coach_email` varchar(100) NOT NULL,
  `coach_bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach_profile`
--

INSERT INTO `coach_profile` (`coach_id`, `coach_name`, `coach_email`, `coach_bio`) VALUES
(1, 'kayihura pio', 'kayihurapio@gmail.com', 'coach of interview'),
(2, 'kayihura pio', 'kayihurapio@gmail.com', 'coach of interview'),
(3, 'kayihura pio', 'kayihurapio@gmail.com', 'coach of interview'),
(4, 'kayihura pio', 'kayihurapio@gmail.com', 'coach of interview'),
(5, 'kayihura pio', 'jeanpaul@gmail.com', 'zxcftgbhjnjhvgvhb');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `question`, `answer`) VALUES
(1, 'What is your greatest strength?', 'My greatest strength is my ability to communicate effectively and work well in teams.'),
(2, 'Where do you see yourself in five years?', 'In five years, I hope to have advanced in my career and taken on more leadership responsibilities.'),
(3, 'What is your greatest strength?', 'My greatest strength is my ability to communicate effectively and work well in teams.'),
(4, 'Where do you see yourself in five years?', 'In five years, I hope to have advanced in my career and taken on more leadership responsibilities.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `feedback_text` text DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `session_id`, `client_id`, `feedback_text`, `rating`) VALUES
(3, NULL, 10, 'sdfghnj', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `mockinterview`
--

CREATE TABLE `mockinterview` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `interview_date` date NOT NULL,
  `interview_type` varchar(50) NOT NULL,
  `interview_duration` int(11) NOT NULL,
  `interviewer_names` varchar(255) DEFAULT NULL,
  `resume_review` text DEFAULT NULL,
  `technical_questions` text DEFAULT NULL,
  `behavioral_questions` text DEFAULT NULL,
  `situational_questions` text DEFAULT NULL,
  `skills_assessment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mockinterview`
--

INSERT INTO `mockinterview` (`id`, `candidate_name`, `position`, `interview_date`, `interview_type`, `interview_duration`, `interviewer_names`, `resume_review`, `technical_questions`, `behavioral_questions`, `situational_questions`, `skills_assessment`) VALUES
(1, 'pio', 'client', '2024-05-22', 'Video', 30, 'kayihura', 'szdxfcgvhbjn', '\\wzxdcgvhbjn', '\\wzxfcgvhb', 'zexrcgvhbjn', 'zxcgvhbjn');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender_role` enum('client','coach') NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_role`, `sender_name`, `message`, `created_at`, `sender_email`) VALUES
(19, 'coach', 'PIO', 'hello', '2024-05-19 11:47:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `amount`, `payment_date`, `payment_method`, `payment_code`) VALUES
(45, 10, 123445.00, '2024-05-16', 'Mobile Money', '241769'),
(46, 9, 1000.00, '2024-05-17', 'Credit Card', '241769');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `coach_id`, `client_id`, `date`, `duration`, `notes`) VALUES
(1, 8, 9, '2024-05-16', 30, 'google meet'),
(2, 8, 10, '2024-05-16', 60, 'zoom ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role_name`, `date_created`) VALUES
(8, 'Kayihura', '1234', 'kayihurapio@gmail.com', 'coach', '2024-05-15 14:06:22'),
(9, 'jeanpaul', '123', 'jeanpaul@gmail.com', 'client', '2024-05-15 14:09:12'),
(10, 'PIO', '12345', 'pio@gmail.com', 'client', '2024-05-16 09:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `coach_profile`
--
ALTER TABLE `coach_profile`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD KEY `id` (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `mockinterview`
--
ALTER TABLE `mockinterview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_profile`
--
ALTER TABLE `client_profile`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coach_profile`
--
ALTER TABLE `coach_profile`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mockinterview`
--
ALTER TABLE `mockinterview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
