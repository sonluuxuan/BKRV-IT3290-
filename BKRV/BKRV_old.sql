-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2018 at 10:25 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BKRV`
--

-- --------------------------------------------------------

CREATE DATABASE `BKRV`;
USE `BKRV`;
--
-- Table structure for table `District`
--

CREATE TABLE `District` (
  `id` int(11) NOT NULL,
  `quan` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `District`
--

INSERT INTO `District` (`id`, `quan`) VALUES
(1, 'Quận Đống Đa'),
(2, 'Quận Ba Đình'),
(3, 'Quận Thanh Xuân'),
(4, 'Quận Cầu Giấy'),
(5, 'Quận Long Biên'),
(6, 'Quận Nam Từ Liêm'),
(7, 'Quận Hoàn Kiếm'),
(8, 'Quận Tây Hồ'),
(9, 'Quận Hai Bà Trưng'),
(10, 'Quận Hoàng Mai'),
(11, 'Quận Hà Đông'),
(12, 'Quận Bắc Từ Liêm');

-- --------------------------------------------------------

--
-- Table structure for table `Loai_quan`
--

CREATE TABLE `Loai_quan` (
  `id` int(11) NOT NULL,
  `loai` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Loai_quan`
--

INSERT INTO `Loai_quan` (`id`, `loai`) VALUES
(1, 'Ăn vặt - Vỉa hè'),
(2, 'Cafe - Dessert'),
(3, 'Nhà hàng'),
(4, 'Bar - Pub');

-- --------------------------------------------------------

--
-- Table structure for table `Mon`
--

CREATE TABLE `Mon` (
  `id` int(11) NOT NULL,
  `ten` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Mon`
--

INSERT INTO `Mon` (`id`, `ten`) VALUES
(1, 'bun mang'),
(2, 'chao chui'),
(3, 'pho bo bo ho'),
(4, 'chao suon hang bong'),
(5, 'banh mi sot vang'),
(6, 'bun dau met'),
(7, 'com tu chon'),
(8, 'com ga'),
(9, 'bun cha'),
(10, 'bun ca'),
(11, 'bun ngan'),
(12, 'nem ran'),
(13, 'bun chan gio'),
(14, 'bun moc'),
(15, 'com rang dua bo'),
(16, 'com rang thap cam'),
(17, 'com suon'),
(18, 'sushi'),
(19, 'ga ran'),
(20, 'tempura');

-- --------------------------------------------------------

--
-- Table structure for table `Quan`
--

CREATE TABLE `Quan` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Quan`
--

INSERT INTO `Quan` (`id`, `ten`) VALUES
(1, 'bun mang'),
(3, 'com ga ebike'),
(4, 'bun dau met nha an quoc te bach khoa'),
(5, 'nha an a15'),
(6, 'quan an 5'),
(7, 'quan an 6'),
(8, 'quan an 7'),
(9, 'quan an 8'),
(10, 'quan an 9'),
(11, 'quan an 10');

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

CREATE TABLE `Review` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 NOT NULL,
  `review` text CHARACTER SET utf8 NOT NULL,
  `rating` float NOT NULL,
  `time_open` time DEFAULT NULL,
  `time_close` time DEFAULT NULL,
  `anh` varchar(100) NOT NULL,
  `likes` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `quan` varchar(100) NOT NULL,
  `loai_id` int(11) NOT NULL,
  `dia_chi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Review`
--

INSERT INTO `Review` (`id`, `ten`, `review`, `rating`, `time_open`, `time_close`, `anh`, `likes`, `user_id`, `dislikes`, `quan`, `loai_id`, `dia_chi`, `district_id`) VALUES
(6, '', 'review 1 user 1', 0, '00:00:00', NULL, '', 101, 13, 1, '5', 2, 'dia chi quan 5', 3),
(9, 'bun dau met', 'review 2 user 2', 0, '00:00:00', '15:00:00', '', 104, 14, 4, '11', 2, 'dia chi quan 11', 8),
(11, 'com rang', 'review 2 user 3', 8.5, '00:00:00', '12:00:00', '', 106, 15, 6, '1', 2, 'dia chi quan 1', 6),
(13, 'pho ga', 'review 2 user 4', 8, '00:00:00', NULL, '', 108, 16, 8, '5', 2, 'dia chi quan 5', 3),
(15, 'mỳ vằn thắn hủ tiếu', 'review 2 user 5\r\n\r\nReview danh cho my van than hu tieu', 0, '07:30:00', '11:30:00', 'images/15', 110, 17, 10, '3', 4, 'dia chi quan 3', 4),
(17, 'gà rán', 'review cho gà rán\r\n\r\nNgon', 10, '09:30:00', '23:30:00', 'images/17', 200, 15, 17, '6', 1, 'địa chỉ quán gà rán', 3),
(18, 'bánh trôi nước', 'review cho bánh trôi nước', 0, '00:00:00', NULL, 'images/18', 1, 13, 0, '8', 1, 'địa chỉ quán bánh trôi nước', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Review_comments`
--

CREATE TABLE `Review_comments` (
  `review_id` int(11) NOT NULL,
  `summary` text CHARACTER SET utf8 NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Review_comments`
--

INSERT INTO `Review_comments` (`review_id`, `summary`, `comment`, `user_id`) VALUES
(6, '', 'comment 1 review 6', 13),
(6, '', 'comment 2 review 6', 16),
(9, '', 'comment 1 review 9', 16),
(9, '', 'comment 2 review 9', 17),
(11, '', 'comment 1 review 11', 16),
(11, '', 'comment 2 review 11', 14),
(13, '', 'comment 1 review 13', 16),
(13, '', 'comment 2 review 13', 16),
(15, '', 'comment 1 review 15', 15),
(15, '', 'comment 2 review 15', 17),
(15, 'QUÁN M? NGON NH?T', 'Review rất chính xác và thật sự là quán rất tuyệt vời', 16),
(17, 'Review chuần xác', 'Gà ngon tuyệt vòi', 13),
(17, 'Cảm ơn bạn rất nhiều!!!', 'Nhờ bạn mà mình biết được quán gà tuyệt vời này...', 14);

-- --------------------------------------------------------

--
-- Table structure for table `Review_mon_gia`
--

CREATE TABLE `Review_mon_gia` (
  `review_id` int(11) NOT NULL,
  `ten_mon` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Review_mon_gia`
--

INSERT INTO `Review_mon_gia` (`review_id`, `ten_mon`, `gia`) VALUES
(17, 'Gà Rán Cay', 50000),
(17, 'Gà Rán Mật Ong', 70000),
(15, 'Mỳ Vằn Thắn', 30000),
(15, 'Phở Gà', 30000),
(9, 'gà rán kfc', 50000),
(11, 'gà rán lotte', 50000),
(13, 'gà rán chanh', 40000),
(15, 'gà rán original', 70000),
(18, 'banh troi truyen thong', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `password`, `salt`, `email`, `username`, `profile_picture`) VALUES
(13, 'sxuA3cqw9vrWNn36zoFvSpafL/0wODBjNzkwYThh', '080c790a8a', 'email1@gmail.com', 'user1', 'profile_pics/user13'),
(14, '3/IY0BIBa6D7l3DT+Tm/DEvtdb04OTk0YmEzNDE3', '8994ba3417', 'email2@gmail.com', 'user2', 'profile_pics/user14'),
(15, 'beAJzg55R79FF8dVbUv9YQG9pG1mMTAyMzdhMWYy', 'f10237a1f2', 'email3@gmail.com', 'user3', 'profile_pics/user15'),
(16, 'hf1yxEX6+e0GWu3cij8GEKqiHB85MzFmOWUxYjAy', '931f9e1b02', 'email4@gmail.com', 'user4', ''),
(17, 'QA75xYFXpYCl/PdQFs1G0ncCOqBkNzg5YzMxOWU2', 'd789c319e6', 'email5@gmail.com', 'user5', 'profile_pics/user17'),
(18, 'A2as+1deBLAeIOct9ZyhfSENXuEzNGE4MzQ3MjFk', '34a834721d', 'email6@gmail.com', 'user6', ''),
(19, 'Qlh2sJmDTLiitgldsEPgQU3HL2o5YmVmMWFmZjE2', '9bef1aff16', 'email7@gmail.com', 'user7', ''),
(20, '6yCITk9ptpjpEZ4jKHi3yLWXbAA3YmFhZGIyZTZl', '7baadb2e6e', 'email8@gmail.com', 'user8', ''),
(21, 'fgdfgdf', 'hghg', 'ghghg', 'sdfs', ''),
(22, 'dfdefdgf', 'rgtr', 'trtr', 'jhj', ''),
(23, 'fugfuj', 'jhyuj', 'jh', 'hjh', ''),
(24, 'fgfg', 'gf', '', '', ''),
(25, 'fdgfg', '', 'fgfglkl', 'rwew', ''),
(26, 'truio', '', 'trytghd', 'nbgngs', ''),
(27, 'dfsdf', 'gfgf', ',k,lik', 'rweew', ''),
(28, 'bfhhg', 'r453re', 'hgtwew', 'xcdm', ''),
(29, 'sgsqe', 'gr', 'ewtuyiu', 'mngsa', ''),
(30, 'sgtwrre', 'trt', 'qtytru', 'erscz', ''),
(31, 'gsgs', 'hgfh', 'jtertfaw', 'dfghdhwer', ''),
(32, 'rghjeswg', 'rtwerft', 'dasgtawgasd', 'sdfgd', ''),
(33, 'sdghtre', 'rtwer', 'dfhgswqa', 'fhgh', ''),
(34, 'asgfaeehwe', 'sdfsf', 'agher', 'dfa', ''),
(35, 'sdhdgas', 'sfs', 'sfghdge', 'gfsdf', ''),
(36, 'buihu', 'gjgh', 'dtsets', 'yfy', ''),
(37, 'SzhhKK9l/O4wWl+n81LNrfFkSpRmOThlYmIxMGIw', 'f98ebb10b0', 'luuxuansond@gmail.com', 'sonluu', ''),
(38, 'tvOpAz3v9buaOH2A9aCXBSt2t/1mNGRmNGQ5ZDM5', 'f4df4d9d39', 'luuxuanson2email', 'sonluu2', ''),
(39, 'OqjNBzq5m2Z556d/lXg2FMPjQMc1MDNkODdhMGQ2', '503d87a0d6', 'emailsonluu', 'sonluu3', '');

-- --------------------------------------------------------

--
-- Table structure for table `User_like_dislike`
--

CREATE TABLE `User_like_dislike` (
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_like_dislike`
--

INSERT INTO `User_like_dislike` (`user_id`, `review_id`, `type`) VALUES
(13, 17, 1),
(14, 17, 1),
(15, 17, 1),
(16, 17, 0),
(17, 17, 1),
(18, 17, 1),
(19, 17, 1),
(20, 17, 1),
(21, 17, 1),
(22, 17, 1),
(23, 17, 1),
(24, 17, 1),
(27, 17, 1),
(28, 17, 1),
(25, 17, 1),
(26, 17, 1),
(29, 17, 1),
(30, 17, 1),
(31, 17, 1),
(32, 17, 1),
(33, 17, 1),
(34, 17, 1),
(35, 17, 1),
(36, 17, 1),
(15, 15, 1),
(15, 15, 1),
(22, 15, 1),
(27, 15, 1),
(21, 15, 1),
(30, 15, 1),
(24, 15, 1),
(26, 15, 1),
(22, 15, 1),
(19, 15, 1),
(13, 13, 1),
(14, 13, 1),
(17, 13, 1),
(18, 13, 1),
(15, 13, 1),
(16, 13, 1),
(19, 13, 1),
(20, 13, 1),
(13, 11, 1),
(14, 11, 1),
(15, 11, 1),
(16, 11, 1),
(17, 11, 1),
(18, 11, 1),
(13, 9, 1),
(14, 9, 1),
(15, 9, 1),
(16, 9, 1),
(36, 9, 1),
(36, 15, 1),
(36, 11, 1),
(19, 18, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `District`
--
ALTER TABLE `District`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Loai_quan`
--
ALTER TABLE `Loai_quan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Mon`
--
ALTER TABLE `Mon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Quan`
--
ALTER TABLE `Quan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quan_id` (`quan`),
  ADD KEY `loai_id` (`loai_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `Review_comments`
--
ALTER TABLE `Review_comments`
  ADD KEY `review_id` (`review_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Review_mon_gia`
--
ALTER TABLE `Review_mon_gia`
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `User_like_dislike`
--
ALTER TABLE `User_like_dislike`
  ADD KEY `user_id` (`user_id`,`review_id`),
  ADD KEY `review_id` (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `District`
--
ALTER TABLE `District`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Loai_quan`
--
ALTER TABLE `Loai_quan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Mon`
--
ALTER TABLE `Mon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Quan`
--
ALTER TABLE `Quan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Review`
--
ALTER TABLE `Review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `districtid` FOREIGN KEY (`district_id`) REFERENCES `District` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loaiquanid` FOREIGN KEY (`loai_id`) REFERENCES `Loai_quan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Review_comments`
--
ALTER TABLE `Review_comments`
  ADD CONSTRAINT `Review_comments_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `Review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Review_mon_gia`
--
ALTER TABLE `Review_mon_gia`
  ADD CONSTRAINT `Review_mon_gia_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `Review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_like_dislike`
--
ALTER TABLE `User_like_dislike`
  ADD CONSTRAINT `User_like_dislike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `re` FOREIGN KEY (`review_id`) REFERENCES `Review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
