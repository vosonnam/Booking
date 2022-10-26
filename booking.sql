-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 13, 2021 lúc 01:43 PM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `booking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` char(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `bookdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fbemail` char(1) NOT NULL,
  `fbsms` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`id`, `name`, `phone`, `date`, `time`, `bookdate`, `fbemail`, `fbsms`, `status`) VALUES
(1, 'Võ Sơn nam', '0923808425', '2021-07-30', '20:42', '2021-07-11 13:36:37', '1', '0', '1'),
(2, 'Võ Sơn nam', '0923808425', '2021-07-11', '16:02', '2021-07-11 13:57:01', '1', '0', '0'),
(3, 'Võ Sơn nam', '0923808425', '2021-07-28', '20:04', '2021-07-11 13:59:09', '1', '0', '1'),
(4, 'Võ Sơn nam', '0923808425', '2021-07-30', '21:05', '2021-07-11 14:00:48', '1', '0', '1'),
(5, 'Võ Sơn nam', '0965276269', '2021-07-14', '15:01', '2021-07-12 03:01:16', '1', '1', '1'),
(6, 'Võ Sơn nam', '0965276269', '2021-07-14', '15:01', '2021-07-12 03:01:17', '0', '1', '1'),
(7, 'Võ Sơn nam', '0965276269', '2021-07-13', '16:15', '2021-07-12 03:02:50', '1', '1', '1'),
(8, 'ab', '0973417510', '2021-07-13', '16:10', '2021-07-12 03:10:27', '1', '1', '1'),
(9, 'Võ Sơn nam', '0965276269', '2021-07-13', '17:00', '2021-07-13 08:21:36', '0', '0', '1'),
(10, 'Võ Sơn nam', '0965276269', '2021-07-13', '8:30', '2021-07-13 13:17:50', '0', '0', '1'),
(11, 'Võ Sơn nam', '0965276269', '2021-07-22', '13:00', '2021-07-13 13:37:11', '0', '0', '1'),
(12, 'Võ Sơn nam', '0965276269', '2021-07-13', '12:30', '2021-07-13 13:38:05', '1', '0', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `phone`, `email`, `birthday`) VALUES
(1, 'Võ Sơn Nam', 'F', '0965276269', 'vosonnam95@gmail.com', '1111-11-11'),
(2, 'a', 'M', '0923808425', 'test@gmail.com', '9999-09-09'),
(5, 'a', 'F', '0981234567', 'test@gmail.com', '1995-06-27'),
(4, 'ab', 'M', '0973417510', 'letranhuuphuc@tlu.edu.vn', '7777-07-07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `offdate`
--

DROP TABLE IF EXISTS `offdate`;
CREATE TABLE IF NOT EXISTS `offdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromdate` varchar(255) NOT NULL,
  `todate` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `offdate`
--

INSERT INTO `offdate` (`id`, `fromdate`, `todate`, `status`) VALUES
(8, '2021-07-22 20:00:00', '2021-07-22 21:00:00', '0'),
(7, '2021-07-13 20:00:00', '2021-07-13 21:00:00', '0'),
(6, '2021-07-13 13:00:00', '2021-07-13 15:00:00', '1'),
(5, '2021-07-15 07:00:00', '2021-07-15 13:00:00', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `useemail` char(1) NOT NULL,
  `txtemail` text NOT NULL,
  `usesms` char(1) NOT NULL,
  `txtsms` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`, `useemail`, `txtemail`, `usesms`, `txtsms`) VALUES
('admin@gmail.com', 'admin@123', '1', 'Quần chip 7 màu hoa', '1', 'hoá gao hồng');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
