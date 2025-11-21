-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2025 at 04:43 PM
-- Server version: 8.0.37
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lkxmbkjs_vcf_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Myusers`
--

CREATE TABLE `Myusers` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `dofreg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp` int DEFAULT '0',
  `vcf_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Myusers`
--

INSERT INTO `Myusers` (`username`, `password`, `email`, `dofreg`, `otp`, `vcf_file`) VALUES
('bunnyrajender55', '$2y$10$lNoRq0TzOzGhbZR9nbz3KOkWKNPY74.z9uff91acOEG2BKDKqlx4y', 'bunnyrajender55@gmail.com', '2025-02-01 14:15:09', 0, 'Contacts123_bunnyrajender55_gmail.com.vcf'),
('bunnyrajender77', '$2y$10$b9uF1al2R9O0o6l199ncH.oQi7xJW.spXnpJeu2roEMKdvMIuseT6', 'bunnyrajender77@gmail.com', '2025-02-01 15:14:54', 0, 'Contacts-2025-02-01_bunnyrajender77_gmail.com.vcf'),
('ChidimillaSupraja04', '$2y$10$ORJXi4SSGt/gI3LBrySvkeAuZXUmnhOwZyt6NtyQbDrvsvdL5AGbS', 'chidimillasupraja@gmail.com', '2024-10-24 10:26:19', 0, 'contacts_chidimillasupraja_gmail.com.vcf'),
('Pavan55', '$2y$10$tDs2IG1XlpS9hAWSXCm47.B1iG3DI2S.mqQXXbVPBhAJlO8tEr7xO', 'dontharavenipavan123@gmail.com', '2024-10-20 08:10:43', 186418, 'vcards_20241020_080900_dontharavenipavan123_gmail.com.vcf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Myusers`
--
ALTER TABLE `Myusers`
  ADD PRIMARY KEY (`username`,`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
