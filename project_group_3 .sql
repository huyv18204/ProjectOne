-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 01:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_group_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(2, 'IPHONE 15 SERIES'),
(3, 'IPHONE 14 SERIES'),
(4, 'IPHONE 13 SERIES'),
(5, 'IPHONE 12 SERIES'),
(6, 'IPHONE 11 SERIES'),
(7, 'PHỤ KIỆN'),
(8, 'IPHONE X/XS');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date_comment` varchar(30) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_user`, `id_product`, `date_comment`, `content`) VALUES
(8, 19, 12, '11:41:14am 2023/12/01', 'Đấm nhau không em?'),
(10, 23, 28, '02:06:43am 2023/12/04', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `date_order` varchar(55) NOT NULL,
  `pay` tinyint(4) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `total_money` int(11) NOT NULL,
  `name_user` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `note` text DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `code_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `date_order`, `pay`, `status`, `total_money`, `name_user`, `email`, `phone`, `address`, `note`, `id_user`, `code_order`) VALUES
(97, '30/11/2023', 1, 4, 13900000, 'Vũ Quốc Huy', 'vqh8124@gmail.com', '0985906005', 'Hà Nam', '', 19, 1701368785),
(103, '04/12/2023', 0, 4, 78280000, 'Vũ Quốc Huy', 'vqh8124@gmail.com', '0985906005', 'Hà Nam', '', 19, 2949),
(104, '05/12/2023', 0, 4, 36900000, 'Vũ Quốc Huy', 'vqh8124@gmail.com', '0985906005', 'Hà Nam', '', 19, 2232);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_detail` int(11) NOT NULL,
  `code_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_detail`, `code_order`, `id_product`, `price`, `quantity`) VALUES
(95, 1701368785, 10, 13900000, 1),
(101, 2949, 26, 3780000, 2),
(102, 2949, 11, 74500000, 5),
(103, 2232, 10, 13900000, 1),
(104, 2232, 28, 23000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(55) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT 0,
  `img_product` varchar(255) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `chip` varchar(55) DEFAULT NULL,
  `ram` varchar(55) DEFAULT NULL,
  `screen` varchar(55) DEFAULT NULL,
  `camera` varchar(55) DEFAULT NULL,
  `camera_selfie` varchar(55) DEFAULT NULL,
  `origin` varchar(55) DEFAULT NULL,
  `total_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `price`, `discount`, `img_product`, `id_category`, `chip`, `ram`, `screen`, `camera`, `camera_selfie`, `origin`, `total_quantity`) VALUES
(1, 'iPhone 11', 11990000, 10790000, '61MG3m5FhIL._AC_SL1500_.jpg', 6, 'Apple A13 Bionic', '4 GB', '6.1 inch, IPS LCD, Liquid Retina HD', '12.0 MP', '12.0 MP + 12.0 MP', 'Trung Quốc', 11),
(6, 'iPhone 11 Pro', 1289000, 1099000, '51CyT9UjNpL._AC_SY879_.jpg', 6, 'Apple A13 Bionic', '4 GB', '6.1 inch, IPS LCD, Liquid Retina HD', '12.0 MP', '12.0 MP + 12.0 MP + 12.0 MP', 'Trung Quốc', 3),
(7, 'iPhone 11 ProMax', 13899000, 11999000, '81LmL94PUvS._AC_SX679_.jpg', 6, 'Apple A13 Bionic', '4GB', 'Super Retina XDR OLED, HDR, Dolby Vision', '12MP', '12MP + 12MP +12MP', 'Mỹ', 1),
(9, 'iPhone 12', 15920000, 11980000, 'iphone12.jpg', 5, 'Apple A14 Bionic', '4 GB', '1080 x 2340 pixel, tỷ lệ 19,5: 9', '12 MP, f / 2.2, 23mm (rộng), 1 / 3.6', '12 MP, f / 1.6, 26mm (rộng), 1.4µm', 'Việt Nam', 0),
(10, 'iPhone 12 Pro', 13900000, 12900000, 'iphone 12pro.jpg', 5, 'Apple A14 Bionic', '5 GB', 'Super Retina XDR OLED, HDR10', '12 MP, f / 2.2, 23mm (rộng), 1 / 3.6', '12 MP, f / 1.6, 26mm (rộng), 1.4µm', 'Việt Nam', -1),
(11, 'iPhone 12 ProMax', 14900000, 10999999, 'iphone 12pro.jpg', 5, 'Apple A14 Bionic', '5 GB', 'Super Retina XDR OLED, HDR10, Dolby Vision', '12 MP, f / 2.2, 23mm (rộng), 1 / 3.6', '12 MP, f / 2.4, 120˚, 13mm (siêu rộng)', 'Mỹ', -2),
(12, 'iPhone 12 mini', 13920000, 10999000, '51CyT9UjNpL._AC_SY879_.jpg', 5, 'Apple A13 Bionic', '4 GB', 'Super Retina XDR OLED, HDR10', '12.0 MP', '12.0 MP + 12.0 MP + 12.0 MP', 'Trung Quốc', 2),
(14, 'Cáp sạc 240W USB-C', 968000, 899000, 'Group 2.png', 7, '', '', '', '', '', '', 10),
(15, 'Tai nghe Apple AirPods 2', 2690000, 1999000, 'Group 5.png', 7, '', '', '', '', '', '', 20),
(16, 'Cáp Type C - Lightning Apple', 490000, 399000, 'Group 4.png', 7, '', '', '', '', '', '', 5),
(17, 'Cáp Golf USB-A to Lightning ', 80000, 50000, 'Group 1.png', 7, '', '', '', '', '', '', 4),
(18, 'Cáp Devia Gracious', 121000, 99000, 'Group 3.png', 7, '', '', '', '', '', '', 5),
(21, 'iPhone 13', 15000000, 12900000, 'iphone 13.png', 4, 'Apple A15', '4 GB', '6.1 inches, OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Việt Nam', 3),
(22, 'iPhone 13 Pro', 16000000, 14900000, '2_61_8_2_1_1_1_2_1_1 1.png', 4, 'Apple A15', '4 GB', '6.1 inches, OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Việt Nam', 2),
(23, 'iPhone 13 ProMax', 16900000, 14900000, '3_51_1_2_2_1_1_2_1_1 1.png', 4, 'Apple A15', '6 GB', 'Super Retina XDR OLED', '12MP, ƒ/2.2', 'Camera góc rộng: 12MP, ƒ/1.5', 'Mỹ', 3),
(24, 'iPhone 14', 19000000, 18900000, 'iphone-14_1 1.png', 3, 'Apple A15 Bionic 6 nhân', '6 GB', 'OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Mỹ', 2),
(25, 'iPhone 14 Pro', 1990000, 1850000, 'iphone-14-pro_2__4 1.png', 3, 'Apple A16 Bionic 6 nh', '6 GB', 'Super Retina XDR OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Mỹ', 2),
(26, 'iPhone 14 Plus', 1890000, 1770000, 'iphone-14-plus_1_ 1.png', 3, 'Apple A15 Bionic', '6 GB', 'Super Retina XDR OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Việt Nam', 0),
(27, 'iPhone 14 ProMax', 20000000, 18900000, 'iphone-14-pro-max-256gb 1.png', 3, 'Apple A16 Bionic 6-core', '6 GB', 'Super Retina XDR OLED', 'Camera selfie: 12 MP', 'Camera góc rộng: 12MP, f/1.6', 'Mỹ', 3),
(28, 'iPhone 15', 23000000, 21500000, 'vn_iphone_15_black_pdp_image_position-1a_black_color_1_4 1.png', 2, 'Apple A16 Bionic', '6 GB', 'Super Retina XDR OLED', '12MP, f/2.2', 'Camera góc rộng: 12MP, f/1.6', 'Việt Nam', 2),
(29, 'iPhone 15 Pro', 24000000, 19000000, 'iphone-15-pro-max_3 1.png', 2, 'A17 Pro', '8 GB', 'Super Retina XDR OLED', '12MP, f/2.2', 'Camera chính: 48MP, 24 mm, ƒ/1.78,', 'Việt Nam', 4),
(30, 'iPhone 15 Plus', 23500000, 19000000, 'iphone-15-plus_1__1 1.png', 2, 'Apple A16 Bionic', '6 GB', 'Super Retina XDR OLED', 'Camera selfie: 12 MP', 'Camera chính: 48MP, 24 mm, ƒ/1.78,', 'Việt Nam', 3),
(31, 'iPhone 15 ProMax', 26500000, 24900000, 'iphone-15-pro-max_3 1.png', 2, 'A17 Pro', '8 GB', 'Super Retina XDR OLED', 'Camera selfie: 12 MP', 'Camera chính: 48MP, 24 mm, ƒ/1.78,', 'Mỹ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(55) DEFAULT NULL,
  `img_user` varchar(255) DEFAULT NULL,
  `account` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `img_user`, `account`, `password`, `email`, `phone`, `address`, `role`) VALUES
(19, 'Admin', 'cach-dang-anh-dai-dien-khong-bi-cat-tren-facebook_101500485.jpeg', 'admin', 'pass', 'vqh8124@gmail.com', '0985906005', 'Hà Nam', 1),
(23, 'Vũ Quốc Huy', 'facebook-avatar-main.png', 'vqh8124', '123', 'vqh8124@gmail.com', '0985906005', 'TT Đồng Văn ', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
