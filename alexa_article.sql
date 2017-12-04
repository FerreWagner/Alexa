-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-04 17:02:43
-- 服务器版本： 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- 表的结构 `alexa_article`
--

CREATE TABLE `alexa_article` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL DEFAULT 'Ferre',
  `title` text NOT NULL,
  `cate` text NOT NULL,
  `order` int(11) NOT NULL,
  `content` text NOT NULL,
  `thumb` text NOT NULL,
  `pic` text NOT NULL,
  `desc` text NOT NULL,
  `see` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `alexa_article`
--

INSERT INTO `alexa_article` (`id`, `author`, `title`, `cate`, `order`, `content`, `thumb`, `pic`, `desc`, `see`, `keywords`, `time`) VALUES
(1, 'Ferre', 'Alexa的性格', '', 0, 'I DON\'T KNOW.', '111', '222', '333', 0, '444', '2017-12-04 15:25:59'),
(2, 'Ferre', '1', '1', 0, '1', '1', '1', '1', 0, '1', '2017-12-04 15:25:59'),
(3, 'Ferre', '2', '2', 0, '2', '2', '2', '2', 2, '2', '2017-12-04 05:25:59'),
(4, 'Ferre', '32', '1', 0, '1', '1', '1', '1', 1, '1', '2017-12-04 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alexa_article`
--
ALTER TABLE `alexa_article`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `alexa_article`
--
ALTER TABLE `alexa_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
