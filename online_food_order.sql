-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2022 lúc 02:10 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `online_food_order`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `adminId` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`adminId`, `fullname`, `username`, `password`) VALUES
(10, 'Dinh Thi Tra My', 'tramy', '12345'),
(16, 'my', 'admin', '11111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `foodId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category` varchar(50) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category`, `image`) VALUES
('Cake', '1377cd2499c869dbf87c72fa79964327.jpg'),
('Drink', 'lemonn.jpg'),
('Food', 'pizzzaa.jpg'),
('Fruit', 'fruit22.jpg'),
('Viet Nam Food', 'phovn.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `foodId` int(10) UNSIGNED NOT NULL,
  `foodName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantityInStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`foodId`, `foodName`, `category`, `description`, `price`, `image`, `quantityInStock`) VALUES
(10, 'Pho', 'Viet Nam Food', 'Pho - Traditional Viet Nam Food', 3, 'phovn.jpg', 98),
(11, 'Lemon Drink', 'Drink', '', 2, 'lemonn.jpg', 48),
(14, 'Hambuger', 'Food', '', 3, 'da6e04b3f15fa353b6ecaf1eea1a444f.jpg', 30),
(15, 'Banh Mi', 'Viet Nam Food', '', 1, '8814e50a9b964dcc340a2266bdcb371c.jpg', 65),
(16, 'Orange Cake', 'Cake', '', 2, 'cake.jpg', 122),
(17, 'Salad', 'Fruit', '', 4, 'c4d5ccf7f9a720805be0c85fbaa3e8c5.jpg', 35),
(18, 'Milk Tea', 'Drink', '', 2, '1ee2f5e7d515fcc1ca6e2fe23bcde03a.jpg', 64),
(19, 'Coconut Cake', 'Cake', '', 4, 'cocake.jpg', 135),
(20, 'Salad Fruit', 'Fruit', '', 5, 'fruitt.jpg', 55),
(21, 'Sushi', 'Cake', '', 9, 'shuuushii.jpg', 54);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderId` int(10) NOT NULL,
  `foodId` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `priceEach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`orderId`, `foodId`, `quantity`, `priceEach`) VALUES
(31, 11, 7, 2),
(31, 19, 1, 4),
(32, 10, 1, 3),
(32, 14, 3, 3),
(32, 18, 1, 2),
(33, 10, 1, 3),
(33, 11, 1, 2),
(33, 14, 1, 3),
(34, 16, 1, 2),
(34, 20, 1, 5),
(35, 11, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderId` int(10) NOT NULL,
  `orderDate` date NOT NULL,
  `shippedDate` date DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderId`, `orderDate`, `shippedDate`, `status`, `userId`) VALUES
(31, '2022-11-19', '2022-11-19', 'Deliveried', 5),
(32, '2022-11-19', NULL, 'Ordered', 5),
(33, '2022-11-19', NULL, 'On Delivery', 4),
(34, '2022-11-19', NULL, 'Cancelled', 4),
(35, '2022-11-21', NULL, 'Ordered', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userId` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` char(10) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `fullname`, `username`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Anna ni', 'anna', 'anna@gmail.com', 'anna', '900123456', '123 Cau Giay'),
(3, 'Uzumaki Naruto', 'naruto', 'naruto@gmail.com', 'naruto', '0363738399', 'Lang La'),
(4, 'Dinh Thi Tra My', 'tramy', 'my@gmail.com', 'tramy', '0359276235', 'Phu Dien, Bac Tu Liem, Ha Noi'),
(5, 'abc', 'abc123', 'abc@gmail.com', 'abc123', '0363738399', '123 hanoi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`foodId`,`userId`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category`);

--
-- Chỉ mục cho bảng `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodId`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderId`,`foodId`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `food`
--
ALTER TABLE `food`
  MODIFY `foodId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
