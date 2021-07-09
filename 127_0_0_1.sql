-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2016 at 12:09 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angularcode_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `name_p` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `folder` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dba` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=934 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name_p`, `folder`, `url`, `ip_address`, `dba`, `email`, `username`, `password`, `datetime`, `note`) VALUES
(432, 'Adidas Ice Dive Shower Gel   ', '150', '150', '', '250 ml ', 'adidas-ice-dive-shower-gel-250-ml.png', '170', '', '', '0'),
(448, 'Axe Denim Cologne Talc   ', '115', '115', '', '300 g ', '1327941212-Jan30-1147.png', '180', '', '', '0'),
(490, 'All Out Off Family Insect Repellent Lotion   ', '39', '39', '', '50 ml ', 'missingimagegr200.png', '190', '', '', '0'),
(589, 'Baba Ramdev Patanjali Gulab Jal   ', '25', '25', '', '120 ml ', 'patanjali-gulab-jal-120-ml.png', '220', '', '', '0'),
(921, 'dad', 'ada', 'dasd', NULL, '', NULL, 'admin', 'admin', '', NULL),
(922, 'dad', 'ada', 'http://tintuc.vn/the-gioi-sao/cuoc-song-it-biet-cua-yen-vy-10-nam-sau-scandal-143152', 'dada', '', NULL, 'admin', 'admin', '', NULL),
(923, 'dada', '', '', NULL, '', NULL, NULL, '', '', NULL),
(924, 'dasdas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(925, 'dasda', '', '', NULL, '', NULL, NULL, '', '', NULL),
(926, 'dadas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(927, 'dadas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(928, 'dasdas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(929, 'sadas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(930, 'dasdas', '', '', NULL, '', NULL, NULL, '', '', NULL),
(931, 'dada', '', '', NULL, '', NULL, NULL, '', '', NULL),
(932, 'dada', '', '', NULL, '', NULL, NULL, '', '', NULL),
(933, 'dadas', '', '', NULL, '', NULL, 'admin', 'admin', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_auth`
--

CREATE TABLE IF NOT EXISTS `users_auth` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_auth`
--

INSERT INTO `users_auth` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(169, 'Swadesh Behera', 'swadesh@gmail.com', '$2a$10$251b3c3d020155f7553c1ugKfEH04BD6nbCbo78AIDVOqS3GVYQ46', '2014-08-31 11:21:20'),
(170, 'Ipsita Sahoo', 'ipsita@gmail.com', '$2a$10$d84ffcf46967db4e1718buENHT7GVpcC7FfbSqCLUJDkKPg4RcgV2', '2014-08-31 11:30:58'),
(171, 'Trisha Tamanna Priyadarsini', 'trisha@gmail.com', '$2a$10$c9b32f5baa3315554bffcuWfjiXNhO1Rn4hVxMXyJHJaesNHL9U/O', '2014-08-31 11:32:03'),
(172, 'Sai Rimsha', 'rimsha@gmail.com', '$2a$10$477f7567571278c17ebdees5xCunwKISQaG8zkKhvfE5dYem5sTey', '2014-08-31 13:34:21'),
(173, 'Satwik Mohanty', 'satwik@gmail.com', '$2a$10$2b957be577db7727fed13O2QmHMd9LoEUjioYe.zkXP5lqBumI6Dy', '2014-08-31 13:36:02'),
(174, 'Tapaswini Sahoo', 'linky@gmail.com', '$2a$10$b2f3694f56fdb5b5c9ebeulMJTSx2Iv6ayQR0GUAcDsn0Jdn4c1we', '2014-08-31 13:44:54'),
(175, 'Manas Ranjan Subudhi', 'manas@gmail.com', '$2a$10$03ab40438bbddb67d4f13Odrzs6Rwr92xKEYDbOO7IXO8YvBaOmlq', '2014-08-31 13:45:08'),
(178, 'AngularCode Administrator', 'admin@angularcode.com', '$2a$10$72442f3d7ad44bcf1432cuAAZAURj9dtXhEMBQXMn9C8SpnZjmK1S', '2014-08-31 14:00:26'),
(179, 'DAO TIEN TU', 'daotientu@gmail.com', '$2a$10$50af8962940d3a5df6ca3uAYGu7xlHKCGSmiy8wbeRbHZSebBOUsW', '2016-07-13 03:32:09'),
(180, '', '', '$2a$10$fd12347197062c8a852bfuL1nyRBOCtLBoEbR0EH1Yd1qSQ4hOd7i', '2016-07-13 06:38:04'),
(181, 'qweqe', 'qewqeq', '$2a$10$ae257fdbd752d34b1fb65uZg8WD3qvKY0bS6GdfA5C9j6AX2JXTeG', '2016-07-13 06:38:07'),
(182, 'ddqw', 'eqwe', '$2a$10$58edeb8492cd048c9bcc0OM6DqKCO2uawfz8KfADSQnrP4uN8D6B.', '2016-07-13 06:38:54'),
(183, 'fdsfsd', 'fsf', '$2a$10$0470e385416860422c6b3uSFjaoqM1fDy8DLFaY/N3U2YGttnouue', '2016-07-13 06:48:22'),
(184, 'lasda', 'dada', '$2a$10$85d6fce0c7f673b804b37OThi0rHL9ZCoKtyGM7TcQsPp6w52kYJa', '2016-07-13 06:49:23'),
(185, 'dada', 'asdada', '$2a$10$9b8bfc718200e11ca0924uy2ezGdUb.MmR3mjfHqLGMKnUPGeanMK', '2016-07-13 06:51:29'),
(186, 'Adasd', 'adada', '$2a$10$facebd2787668fa808106uHYCpoF6e9df2g5unhKTb4dI1gK75c12', '2016-07-13 06:53:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_auth`
--
ALTER TABLE `users_auth`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=934;
--
-- AUTO_INCREMENT for table `users_auth`
--
ALTER TABLE `users_auth`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
