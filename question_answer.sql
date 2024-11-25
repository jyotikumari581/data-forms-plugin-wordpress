-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 12:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_all_questions`
--

CREATE TABLE `wp_all_questions` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `question_name` varchar(255) NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `question_answer` varchar(255) NOT NULL,
  `forms` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_answers`
--

CREATE TABLE `wp_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wp_questionare`
--

CREATE TABLE `wp_questionare` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `submit_btn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_all_questions`
--
ALTER TABLE `wp_all_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_answers`
--
ALTER TABLE `wp_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_questionare`
--
ALTER TABLE `wp_questionare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_author_email` (`form_name`(10));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_all_questions`
--
ALTER TABLE `wp_all_questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_answers`
--
ALTER TABLE `wp_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_questionare`
--
ALTER TABLE `wp_questionare`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
