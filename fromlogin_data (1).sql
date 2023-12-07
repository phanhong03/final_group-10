-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th12 06, 2023 lúc 05:35 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fromlogin_data`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user-management`
--

CREATE TABLE `user-management` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_management`
--

CREATE TABLE `user_management` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_management`
--

INSERT INTO `user_management` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(2, 'admin2', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(3, 'loc12', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(4, 'locokne', '202cb962ac59075b964b07152d234b70', 1),
(5, 'loctrenghe', '8330cf46c7a3731ccdd888ef77266d97', 1),
(6, 'nguyenquocloc1000@gmail.com', '78c52514d5cfa44e3ab90da3e3d1db1c', 1),
(7, 'locab', '698d51a19d8a121ce581499d7b701668', 1),
(9, 'kkk', 'c6f057b86584942e415435ffb1fa93d4', 1),
(10, '000', '698d51a19d8a121ce581499d7b701668', 1),
(11, 'caiqq', '76d80224611fc919a5d54f0ff9fba446', 1),
(12, 'hello', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(13, 'oknene', '202cb962ac59075b964b07152d234b70', 1),
(14, 'NGUYỄN QUỐC CƯỜNG', '698d51a19d8a121ce581499d7b701668', 1),
(15, 'Nguyễn Quốc Lộc123', '8330cf46c7a3731ccdd888ef77266d97', 1),
(16, 'Lê Vĩnh Hùng', '73278a4a86960eeb576a8fd4c9ec6997', 1),
(17, 'Nguyễn Văn A', '202cb962ac59075b964b07152d234b70', 1),
(18, 'Nguyễn Văn B', '202cb962ac59075b964b07152d234b70', 1),
(19, 'qw', '202cb962ac59075b964b07152d234b70', 1),
(20, 'Nguyen Văn tèo', 'a0a080f42e6f13b3a2df133f073095dd', 1),
(21, 'Nguyễn Văn P', 'c8837b23ff8aaa8a2dde915473ce0991', 1),
(22, 'Nguyễn Văn TèoB', '09a676c784484d326c58bf548908b3d3', 1),
(23, 'root ', 'e10adc3949ba59abbe56e057f20f883e', 1),
(24, 'NGUYỄN QUỐC Q', 'e10adc3949ba59abbe56e057f20f883e', 1),
(27, 'NGUYỄN QUỐC LỘC', '202cb962ac59075b964b07152d234b70', 1),
(28, '', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(29, 'NGUYỄN QUỐC LỘC111', '202cb962ac59075b964b07152d234b70', 1),
(30, 'Nguyễn Văn ABC', 'eeb19625760b9c9520a7defc22ab7e12', 1),
(31, 'Nguyễn Thị A', 'e10adc3949ba59abbe56e057f20f883e', 1),
(32, 'Nguyễn Văn BC', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(33, 'Nguyễn Thị K', 'fcea920f7412b5da7be0cf42b8c93759', 1),
(34, 'Phan Văn Hải', '7efd6b8b1b6b0fc5afb47b7ca8f5ffe3', 1),
(35, 'Trần Thị Mẫn', '7efd6b8b1b6b0fc5afb47b7ca8f5ffe3', 1),
(36, 'Trương Thị Sen', '7efd6b8b1b6b0fc5afb47b7ca8f5ffe3', 1),
(37, 'Lê Văn Tuấn Tú', '7efd6b8b1b6b0fc5afb47b7ca8f5ffe3', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user-management`
--
ALTER TABLE `user-management`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user-management`
--
ALTER TABLE `user-management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_management`
--
ALTER TABLE `user_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
