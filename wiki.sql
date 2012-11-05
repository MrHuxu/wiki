-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 10 月 03 日 19:33
-- 服务器版本: 5.5.24
-- PHP 版本: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wiki`
--

-- --------------------------------------------------------

--
-- 表的结构 `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `chapters`
--

CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `chapters`
--

INSERT INTO `chapters` (`id`, `chapter`) VALUES
(1, 'A Tutorial Introduefion '),
(2, 'Types, Operators, and Expressions '),
(3, 'Control Flow '),
(4, 'Pointers and Arrays '),
(5, 'Structures');

-- --------------------------------------------------------

--
-- 表的结构 `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `dateposted` datetime NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `entries`
--

INSERT INTO `entries` (`id`, `chapter_id`, `dateposted`, `subject`, `body`) VALUES
(1, 1, '2012-10-03 16:09:15', 'Getting staffed ', 'Modification time test!'),
(2, 1, '2012-10-03 15:09:54', 'Symbolic constants ', ''),
(3, 1, '2012-10-03 15:10:36', 'Character arrays', ''),
(4, 1, '2012-10-03 15:11:59', 'Variable names ', ''),
(5, 2, '2012-10-03 15:12:45', 'Arithmetic operators ', ''),
(6, 2, '2012-10-03 15:13:13', 'Conditional expressions', ''),
(7, 3, '2012-10-03 15:14:36', 'Statements and blocks', ''),
(8, 3, '2012-10-03 15:15:08', 'Break and continue', ''),
(9, 3, '2012-10-03 15:15:31', 'Goto and labels ', ''),
(10, 1, '2012-10-03 15:16:52', 'Address arithmetic', ''),
(11, 4, '2012-10-03 15:17:26', 'Complicated declarations ', ''),
(12, 4, '2012-10-03 15:18:21', 'Multi-dimensional arrays ', '');

-- --------------------------------------------------------

--
-- 表的结构 `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `logins`
--

INSERT INTO `logins` (`id`, `username`, `password`) VALUES
(1, 'wind', '4869'),
(2, 'hyq', 'hyq'),
(3, 'lmt', 'lmt');

-- --------------------------------------------------------

--
-- 表的结构 `work_for`
--

CREATE TABLE IF NOT EXISTS `work_for` (
  `user_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `work_for`
--

INSERT INTO `work_for` (`user_id`, `entry_id`) VALUES
(2, 1),
(3, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
