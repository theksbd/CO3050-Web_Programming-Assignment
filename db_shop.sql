-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 12, 2023 lúc 04:22 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `account` varchar(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `account`, `productid`, `date`, `content`, `status`) VALUES
(4, 'hoang', 1, '2021-09-22 04:32:30', 'hoang hi hi', 1),
(5, 'hoang', 2, '2021-09-22 04:37:20', 'id 2', 1),
(6, 'hoang', 2, '2021-09-22 04:38:08', 'id 2', 1),
(7, 'hoang', 2, '2021-09-22 04:38:34', 'id 2', 1),
(8, 'hoang', 2, '2021-09-22 04:38:47', 'id 2', 1),
(16, 'hoang', 4, '2021-09-22 04:57:01', 'hoang id 4 hehe', 1),
(17, 'hoang', 4, '2021-09-22 04:57:06', 'hoang id 4 hehe', 1),
(18, 'hoang', 1, '2021-09-22 17:05:00', 'áo đẹp\r\n', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_products`
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
-- Đang đổ dữ liệu cho bảng `db_products`
--

INSERT INTO `db_products` (`id`, `name`, `price`, `image`, `description`, `status`) VALUES
(1, 'Black Jacket', 1500000, '/image/sp21.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(2, 'Red Hat', 300000, '/image/sp7.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(3, 'White Dress', 500000, '/image/sp17.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(4, 'White Dress European', 700000, '/image/sp19.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(5, 'Black Sneaker', 3500000, '/image/sp13.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(7, 'Navy Shirt', 1200000, '/image/sp25.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(8, 'Red White Sneaker', 2200000, '/image/sp15.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1),
(9, 'áo 90', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/180214102-3943330505775101-2014329877114860811-n.jpg?v=1620398886910', 'áo cũng đẹp sơ sơ á', 1),
(10, 'áo 99', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/181898751-3943301429111342-2670157589394121455-n.jpg?v=1620398319473', 'áo cũng đẹp mà các bạn', 1),
(11, 'quần 5', 50000, 'https://bizweb.dktcdn.net/thumb/compact/100/331/067/products/209545657-4115395605235256-5992744048089991617-n.jpg?v=1625567925127', 'áo này khá đẹp', 1),
(12, 'áo 15', 20000, 'https://bizweb.dktcdn.net/100/331/067/products/250949203-4478030235638456-7244273953912380726-n.jpg?v=1635960300873', 'áo này khá đẹp', 1),
(13, 'quần 5', 50000, 'https://bizweb.dktcdn.net/100/331/067/products/252433334-4478029962305150-9026316968754235820-n.jpg?v=1635960714023', 'áo đẹp', 1),
(14, 'áo 20', 20000, 'https://bizweb.dktcdn.net/100/331/067/products/192039013-4016118338496317-2234295430712059352-n.jpg?v=1622452157717', 'áo xinh', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `NAME` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SDT` varchar(15) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ACCOUNT` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `PASS` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `db_user`
--

INSERT INTO `db_user` (`NAME`, `EMAIL`, `SDT`, `ACCOUNT`, `PASS`) VALUES
('DO THIEN HOANG', 'theksbd@gmail.com', '0966446008', 'hoang', '5b4c7ffba7c5ea409d1195001fbbf899'),
('Hoang Clone', 'hoang123@gmail.com', '090192123', 'hoang1', '202cb962ac59075b964b07152d234b70'),
('Hoang 12345', 'hoang12@gmail.com', '0901920436', 'hoang12345', '81dc9bdb52d04dc20036dbd8313ed055'),
('Hoang 123456', 'hoang1@gmail.com', '0901920436', 'hoang123456', '81dc9bdb52d04dc20036dbd8313ed055'),
('Hoang 2', 'hoang1234@gmail.com', '1234', 'hoang2', '202cb962ac59075b964b07152d234b70'),
('Hoang', 'hoang@gmail.com', '0901920436', 'hoangabc', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_products`
--
ALTER TABLE `db_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`ACCOUNT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `db_products`
--
ALTER TABLE `db_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
