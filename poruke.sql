-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 02:17 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poruke`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(240) NOT NULL,
  `date_published` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=312 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `content`, `date_published`) VALUES
(21, 2, 'Edit proba/ Radi link za edit ako se izbrisao procenat/ Valjda sada radi ako se izbrisao razmak u view-u od linka za message na liniji 11.\n\n****RADI****', 1489500522),
(234, 1, 'sdad', 1489662063),
(238, 1, 'ORM PRORADIO!?', 1489668099),
(239, 1, 'sssssss', 1489668591),
(240, 2, 'DQWEQEQEQE', 1489668927),
(241, 1, 'ddd', 1489669705),
(242, 1, 'aa', 1489670253),
(247, 1, 'Jolanda', 1489672878),
(250, 1, 'Proradio ORM delete/edit', 1489672947),
(251, 1, 'a', 1489735753),
(258, 1, 'adsdd', 1489737718),
(264, 1, 'sdf', 1489739447),
(265, 1, 'asd', 1489740378),
(268, 1, 'asddddddasdasd', 1489742281),
(269, 2, 'Jeah\nasd', 1489743218),
(276, 1, 'asd', 1489757688),
(277, 1, 'asd', 1489758129),
(279, 3, 'zxczxcc', 1490181006),
(280, 3, 'zxczxcc', 1490181042),
(281, 3, 'zxczxcc', 1490181046),
(282, 3, '123', 1490181070),
(283, 3, '123', 1490181087),
(284, 3, 'asd', 1490181116),
(287, 5, 'Dadadadadada radis a?\n', 1490181686),
(297, 5, 'sdalkdjalskjdalkjd', 1490182976),
(300, 6, 'zxczcccc', 1490183314),
(301, 6, 'dd123123', 1490183364),
(302, 5, 'zcxzc', 1490183488),
(303, 5, 'zcxzc', 1490183488),
(305, 13, 'Da da radis!\n', 1490185787),
(306, 0, 'zxczxczxczxzcccc', 0),
(307, 0, 'cccccc', 0),
(308, 0, 'zzzz', 0),
(309, 0, 'zxczxczxczxzc', 0),
(310, 0, '305', 0),
(311, 0, '305', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(5, 1),
(6, 1),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(24) NOT NULL,
  `last_active` int(10) unsigned NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_active` (`last_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(5, 'jedan@gmail.com', 'jedan', 'a825d3aa46f2070a974bf8329478804c405c3c1a', 8, 1490185297),
(6, 'bogdan@gmail.com', 'bogdan', 'a825d3aa46f2070a974bf8329478804c405c3c1a', 2, 1490183183),
(12, 'asd@gmail.com', 'Bokis', 'a825d3aa46f2070a974bf8329478804c405c3c1a', 1, 1490185640),
(13, '123@gmail.com', '123', 'a825d3aa46f2070a974bf8329478804c405c3c1a', 2, 1490188571);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
