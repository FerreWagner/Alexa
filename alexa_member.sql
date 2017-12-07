-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-12-07 09:33:13
-- 服务器版本： 5.6.34
-- PHP Version: 7.0.19

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
-- 表的结构 `alexa_member`
--

CREATE TABLE `alexa_member` (
  `id` int(11) NOT NULL,
  `nickname` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `figureurl` varchar(255) DEFAULT NULL,
  `figureurl_1` varchar(255) DEFAULT NULL,
  `figureurl_2` varchar(255) DEFAULT NULL,
  `figureurl_qq_1` varchar(255) DEFAULT NULL,
  `figureurl_qq_2` varchar(255) DEFAULT NULL,
  `is_yellow_vip` tinyint(4) DEFAULT NULL,
  `vip` tinyint(4) DEFAULT NULL,
  `yellow_vip_level` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `is_yellow_year_vip` tinyint(4) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `openid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `alexa_member`
--

INSERT INTO `alexa_member` (`id`, `nickname`, `gender`, `province`, `city`, `year`, `figureurl`, `figureurl_1`, `figureurl_2`, `figureurl_qq_1`, `figureurl_qq_2`, `is_yellow_vip`, `vip`, `yellow_vip_level`, `level`, `is_yellow_year_vip`, `time`, `ip`, `openid`) VALUES
(1, '1', '1', '1', '1', 1, '1', '1', '1', '1', '1', 1, 1, 1, 1, 1, 1, '1', '1'),
(2, '谁动了我的奶酪', '男', '', '', 2013, 'http://qzapp.qlogo.cn/qzapp/101436267/D1BF741A92528A25C5793B790FF7FB20/30', 'http://qzapp.qlogo.cn/qzapp/101436267/D1BF741A92528A25C5793B790FF7FB20/50', 'http://qzapp.qlogo.cn/qzapp/101436267/D1BF741A92528A25C5793B790FF7FB20/100', 'http://q.qlogo.cn/qqapp/101436267/D1BF741A92528A25C5793B790FF7FB20/40', 'http://q.qlogo.cn/qqapp/101436267/D1BF741A92528A25C5793B790FF7FB20/100', 0, 0, 0, 0, 0, 1512634538, '218.89.234.145', 'D1BF741A92528A25C5793B790FF7FB20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alexa_member`
--
ALTER TABLE `alexa_member`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `alexa_member`
--
ALTER TABLE `alexa_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
