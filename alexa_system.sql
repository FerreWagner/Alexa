-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-01 10:42:20
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alexa`
--

-- --------------------------------------------------------

--
-- 表的结构 `alexa_system`
--

CREATE TABLE `alexa_system` (
  `id` int(11) NOT NULL,
  `is_close` tinyint(4) NOT NULL,
  `title` text NOT NULL,
  `keywords` text NOT NULL,
  `desc` text NOT NULL,
  `is_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `alexa_system`
--

INSERT INTO `alexa_system` (`id`, `is_close`, `title`, `keywords`, `desc`, `is_update`) VALUES
(1, 1, 'Alexa Ferre', '萨法1', 'About Alexa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alexa_system`
--
ALTER TABLE `alexa_system`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `alexa_system`
--
ALTER TABLE `alexa_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
