-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2021 at 09:22 AM
-- Server version: 5.7.23
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epignosis_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vacation_start` date NOT NULL,
  `vacation_end` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applications_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `type` enum('employee','admin') NOT NULL DEFAULT 'employee',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `salt`, `type`) VALUES
(1, 'Employee Name 1', 'Employee LastName 1', 'employee_1@mail.com', 'a7e1acda8202fa0582031beaa41f2b2fc3f30608e47f70df76f49f321061c122', '151b6e9d185252078234d353858ec73f', 'employee'),
(2, 'Employee Name 2', 'Employee LastName 2', 'employee_2@mail.com', 'ae6d8cac2dc3a340ed5bbe45b0a49157746acd8ffa5ea085ad49f19456a04feb', '5e7acde47fb708e7ab44d378f4267638', 'admin'),
(3, 'Employee Name 3', 'Employee LastName 3', 'employee_3@mail.com', 'a57fdd8c1c01824b2c6c66a3b37e25af5fc81e901269a6901f2d5820afa0d517', 'fd98c427dfc393e62dd72dd98688f352', 'employee'),
(4, 'Employee Name 4', 'Employee LastName 4', 'employee_4@mail.com', 'b92a01eeef5772ee9aeed8170981d9dfc351851599f0340fefe2b8d4a3945b8e', 'a36e17fe122889861bd25109aab50d6b', 'employee'),
(5, 'Admin Name', 'Admin LastName', 'admin@mail.com', '722fee5705cdf4fe7dd1d415f28d4691fbb04380815f98ca797570a734776150', '3987cc0924d6dc98573deba7900630a5', 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
