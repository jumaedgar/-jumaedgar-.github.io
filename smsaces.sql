-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2019 at 08:47 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsaces`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `cont_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `cont_name` varchar(255) NOT NULL,
  `cont_num` varchar(100) NOT NULL,
  `cont_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`cont_id`, `username`, `cont_name`, `cont_num`, `cont_group`) VALUES
(23, '0706669233', 'Eddie', '706669233', 'school'),
(24, '0706669233', 'Collins', '724604362', 'home'),
(28, '0706669233', 'Joseph', '721757189', 'home'),
(30, '0706669233', 'Freddy', '725755865', 'home'),
(32, '0706669233', 'Cliff', '754125478', 'home'),
(33, '0706669233', 'Sharon', '705214563', 'home'),
(35, '0706669233', 'Githinji', '725636985', 'work');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) UNSIGNED NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `quiz_id`, `option`, `count`) VALUES
(1, 1, 'yes ', 0),
(2, 1, 'No', 0),
(6, 2, 'Less than 30 minutes', 0),
(7, 2, 'From 30 minutes to 1 hour', 0),
(8, 2, 'From 1 to 2 hours', 0),
(9, 2, 'From 2 to 3 hours', 0),
(10, 2, 'More than 3 hours', 0),
(11, 3, 'Camera', 0),
(12, 3, 'Internet Browsing/applications', 0),
(13, 3, 'Gaming', 0),
(14, 3, 'Text messaging', 0),
(16, 4, 'Galaxy series', 0),
(17, 4, 'Note series', 0),
(18, 4, 'Duo series', 0),
(19, 4, 'Ace series', 0),
(20, 5, 'yes ', 0),
(21, 5, 'No', 0),
(25, 6, 'personal', 0),
(26, 6, 'work', 0),
(27, 6, 'both', 0),
(30, 7, 'yes ', 0),
(31, 7, 'No', 0),
(35, 8, 'less than 500mbs', 0),
(36, 8, '500mbs to 2000mbs', 0),
(37, 8, '2000mbs to 3500mbs', 0),
(38, 8, '3500mbs to 5000mbs', 0),
(39, 8, 'more than 5000mbs', 0),
(40, 9, 'Less than 5', 0),
(41, 9, '5- 10 messages', 0),
(42, 9, '	11 â€“ 15 messages 	16 â€“ 20 messages 	21 â€“ 25 messages 	Over 25 messages', 0),
(45, 10, '1', 0),
(46, 10, '2', 0),
(47, 10, '3', 0),
(48, 10, '4', 0),
(49, 10, 'more than 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) UNSIGNED NOT NULL,
  `surv_id` int(11) NOT NULL,
  `quiz` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `surv_id`, `quiz`) VALUES
(1, 1, 'Do you own a mobile phone?'),
(2, 1, 'How much time do you spend on your mobile phone on average in a day (calls only)?'),
(3, 1, 'Which of these is your favourite feature?'),
(4, 2, 'Which samsung brand do you like?'),
(5, 3, 'Do you have a smartphone?'),
(6, 3, 'Do you use our smartphone for work or personal use?'),
(7, 3, 'Do you use social media on your smartphone?'),
(8, 3, 'How much data per month do you use on your smartphone?'),
(9, 3, 'Approximately how many messages (Imessage, SMS etc.) do you send on a daily basis (excluding work related messages)?'),
(10, 3, 'Approximately how many calls do you make on an average day (excluding work calls)?');

-- --------------------------------------------------------

--
-- Table structure for table `recepients`
--

CREATE TABLE `recepients` (
  `resp_id` int(11) UNSIGNED NOT NULL,
  `surv_id` varchar(100) NOT NULL,
  `recepient` varchar(255) NOT NULL,
  `resp_num` varchar(100) NOT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recepients`
--

INSERT INTO `recepients` (`resp_id`, `surv_id`, `recepient`, `resp_num`, `level`) VALUES
(1, '1', 'Eddie', '706669233', '0'),
(2, '1', 'Eddie', '706669233', '0'),
(3, '1', 'Eddie', '706669233', '0'),
(4, '1', 'Eddie', '706669233', '0'),
(5, '1', 'Eddie', '706669233', '0'),
(6, '2', 'Eddie', '706669233', '0'),
(7, '2', 'Eddie', '706669233', '0'),
(8, '3', 'Eddie', '706669233', '0'),
(9, '3', 'Collins', '724604362', '0'),
(10, '3', 'Joseph', '721757189', '0'),
(11, '3', 'Eddie', '706669233', '0'),
(12, '3', 'Collins', '724604362', '0'),
(13, '3', 'Joseph', '721757189', '0'),
(14, '3', 'Eddie', '706669233', '0'),
(15, '3', 'Collins', '724604362', '0'),
(16, '3', 'Joseph', '721757189', '0'),
(17, '3', 'Eddie', '706669233', '0'),
(18, '3', 'Collins', '724604362', '0'),
(19, '3', 'Joseph', '721757189', '0');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `surv_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `Surv_topic` varchar(255) NOT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`surv_id`, `username`, `Surv_topic`, `Status`) VALUES
(1, '0706669233', 'MOBILE PHONE USAGE', 'active'),
(2, '0706669233', 'Samsung Brand', 'active'),
(3, '0706669233', 'SMARTPHONE SURVEY', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_num` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `p_num`, `password`, `reg_date`) VALUES
(1, 'samsung', '0706669233', '25f9e794323b453885f5181f1b624d0b', '2019-03-21 22:07:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`cont_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `recepients`
--
ALTER TABLE `recepients`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`surv_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `cont_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recepients`
--
ALTER TABLE `recepients`
  MODIFY `resp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `surv_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
