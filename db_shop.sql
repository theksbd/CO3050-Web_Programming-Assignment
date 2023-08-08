-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2021 at 02:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
drop schema if exists db_shop;
create schema db_shop;
USE db_shop;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `account` varchar(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `account`, `productid`, `date`, `content`, `status`) VALUES
(4, 'hoang', 1, '2021-09-22 04:32:30', 'hoang hi hi', 1),
(5, 'hoang', 2, '2021-09-22 04:37:20', 'id 2', 1),
(6, 'hoang', 2, '2021-09-22 04:38:08', 'id 2', 1),
(7, 'hoang', 2, '2021-09-22 04:38:34', 'id 2', 1),
(8, 'hoang', 2, '2021-09-22 04:38:47', 'id 2', 1),
(9, 'son', 1, '2021-09-22 04:49:53', 'son test part 2', 1),
(14, 'son', 1, '2021-09-22 04:55:45', 'prt4\r\n', 1),
(15, 'son', 1, '2021-09-22 04:55:51', '', 1),
(16, 'hoang', 4, '2021-09-22 04:57:01', 'hoang id 4 hehe', 1),
(17, 'hoang', 4, '2021-09-22 04:57:06', 'hoang id 4 hehe', 1),
(18, 'hoang', 1, '2021-09-22 17:05:00', 'áo đẹp\r\n', 1),
(19, 'sonvnj1@gmail.com', 1, '2021-09-24 17:06:21', 'hihi', 1),
(20, 'sonvnj1@gmail.com', 1, '2021-09-24 17:07:28', 'hihi', 1),
(21, 'sonvnj1@gmail.com', 1, '2021-09-24 17:07:31', '', 1),
(22, 'sonvnj1@gmail.com', 6, '2021-09-24 17:07:45', 'quang son thay dep', 1),
(23, 'sonvnj123345', 1, '2021-10-13 14:48:52', 'áo rất đẹp', 1),
(24, 'sonvnj123345', 1, '2021-10-13 14:49:18', 'áo rất đẹp', 1),
(25, 'sonvnj123345', 1, '2021-10-13 14:50:27', 'áo rất đẹp', 1),
(26, 'sonvnj123345', 1, '2021-10-13 14:50:35', 'áo rất đẹp', 1),
(27, 'sonvnj123345', 1, '2021-10-13 14:50:39', '\r\n', 1),
(28, 'sonvnj1233', 1, '2021-11-01 16:14:53', 'GEGEGEGEGEG', 1),
(29, 'sonvnj1233', 1, '2021-11-01 20:45:50', 'GEGEGEGEGEG', 1),
(30, 'sonvnj1233', 1, '2021-11-01 20:48:37', 'GEGEGEGEGEG', 1),
(31, 'sonvnj1233', 1, '2021-11-02 21:02:17', 'áo khá đẹp\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `db_products`
--

CREATE TABLE `db_products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_products`
--

INSERT INTO `db_products` (`id`, `name`, `price`, `image`, `description`, `status`) VALUES
(1, 'Robo Tee', 500000, '/image/ao1.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(2, 'Robotic Tee Shirt', 500000, '/image/ao2.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(3, 'Black Tee', 500000, '/image/ao3.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(4, 'Robotic Black Tee', 500000, '/image/ao4.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(5, 'Yg Tee', 500000, '/image/ao5.jpeg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(7, 'Yg Tee 234', 500000, '/image/ao6.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(8, 'Black Yg Tee', 500000, '/image/ao7.webp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(9, 'áo 90', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/180214102-3943330505775101-2014329877114860811-n.jpg?v=1620398886910', 'áo cũng đẹp sơ sơ á', 1),
(10, 'áo 99', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/181898751-3943301429111342-2670157589394121455-n.jpg?v=1620398319473', 'áo cũng đẹp mà các bạn', 1),
(11, 'quần 5', 50000, 'https://bizweb.dktcdn.net/thumb/compact/100/331/067/products/209545657-4115395605235256-5992744048089991617-n.jpg?v=1625567925127', 'áo này khá đẹp', 1),
(12, 'áo 15', 20000, 'https://bizweb.dktcdn.net/100/331/067/products/250949203-4478030235638456-7244273953912380726-n.jpg?v=1635960300873', 'áo này khá đẹp', 1),
(13, 'quần 5', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/252433334-4478029962305150-9026316968754235820-n.jpg?v=1635960714023', 'áo đẹp', 1),
(14, 'áo 20', 20000, 'https://bizweb.dktcdn.net/100/331/067/products/192039013-4016118338496317-2234295430712059352-n.jpg?v=1622452157717', 'áo xinh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `NAME` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SDT` varchar(15) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ACCOUNT` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `PASS` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`NAME`, `EMAIL`, `SDT`, `ACCOUNT`, `PASS`) VALUES
('Trần Quang Sơn', 'sonvnj1@gmail.com', '0901920436', 'sonabc', '81dc9bdb52d04dc20036dbd8313ed055'),
('son1213', 'sonvnj123123@gmail.com', '090192123', 'sonvnj1233', '202cb962ac59075b964b07152d234b70'),
('son', 'sonvnj1234@gmail.com', '1234', 'sonvnj12334', '202cb962ac59075b964b07152d234b70'),
('ab', 'sonvnj1@gmail.com', '0901920436', 'sonvnj123456', '81dc9bdb52d04dc20036dbd8313ed055'),
('ab', 'sonvnj1@gmail.com', '0901920436', 'sovnj12345', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_products`
--
ALTER TABLE `db_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`ACCOUNT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `db_products`
--
ALTER TABLE `db_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
