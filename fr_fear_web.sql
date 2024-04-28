-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 11:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

 -- data base name freedomfear

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fr_fear_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forget_passwords`
--

CREATE TABLE `forget_passwords` (
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--



CREATE TABLE `users` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`firstname` VARCHAR(15) NOT NULL COLLATE 'utf8_general_ci',
	`lastname` VARCHAR(15) NOT NULL COLLATE 'utf8_general_ci',
	`age` INT(2) NOT NULL,
	`country` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`username` VARCHAR(15) NOT NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(45) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(40) NOT NULL COLLATE 'utf8_general_ci',
	`active` INT(11) NOT NULL DEFAULT '0',
	`macAddresses` VARCHAR(500) NOT NULL COLLATE 'utf8_general_ci',
	`banned` INT(1) NOT NULL DEFAULT '0',
	`ip` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
    `licensee` TEXT NOT NULL,
    `privilege` INT(11) NOT NULL,
    `auth` TINYBLOB NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 COLLATE='utf8_general_ci';






CREATE TABLE `activate` (
	`userid` INT(11) NOT NULL,
	`serial` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`userid`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `admins` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;





--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
