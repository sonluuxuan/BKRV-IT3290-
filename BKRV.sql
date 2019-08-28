-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2018 at 12:41 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkrv`
--

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quan` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `quan`) VALUES
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
-- Table structure for table `loai_quan`
--

DROP TABLE IF EXISTS `loai_quan`;
CREATE TABLE IF NOT EXISTS `loai_quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loai` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loai_quan`
--

INSERT INTO `loai_quan` (`id`, `loai`) VALUES
(1, 'Ăn vặt - Vỉa hè'),
(2, 'Cafe - Dessert'),
(3, 'Nhà hàng'),
(4, 'Bar - Pub');

-- --------------------------------------------------------

--
-- Table structure for table `mon`
--

DROP TABLE IF EXISTS `mon`;
CREATE TABLE IF NOT EXISTS `mon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mon`
--

INSERT INTO `mon` (`id`, `ten`) VALUES
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
-- Table structure for table `quan`
--

DROP TABLE IF EXISTS `quan`;
CREATE TABLE IF NOT EXISTS `quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quan`
--

INSERT INTO `quan` (`id`, `ten`) VALUES
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
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) CHARACTER SET utf8 NOT NULL,
  `review` text CHARACTER SET utf8 NOT NULL,
  `rating` float NOT NULL,
  `time_open` time DEFAULT NULL,
  `time_close` time DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `loai_id` int(11) NOT NULL,
  `dia_chi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `loai_id` (`loai_id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `ten`, `review`, `rating`, `time_open`, `time_close`, `likes`, `user_id`, `dislikes`, `loai_id`, `dia_chi`, `district_id`) VALUES
(24, 'BÚN RIÊU BẠCH MAI', 'Vừa nãy thấy 1 bài review về bún riêu ở Bạch Mai mà không phải quán này làm e muốn review ngay cho quán tủ e hay ăn. Quán do 2 vợ chồng bác cũng có tuổi rồi ngồi bán vỉa hè đoạn ngã 3 bạch mai với Tạ quang bửu cạnh quán Vietmart 10K. E ăn tô thập cẩm có đậu rán( vàng ròn), thịt bò, ốc nhỏ ( có ốc to nhưng e ăn ốc nhỏ), chả cá, giò sụn , tóp mỡ ( ngon bá cháy). Có quẩy, rau sống ăn kèm đặc biết e thích ăn rau muống chẻ sạch giòn ăn kèm ngon kinh khủng. \nCá nhân e thấy đồ ăn ở đây mọi thứ đều tươi mới, nước dùng nóng hổi chua ngọt chuẩn vị bún riêu ai có thể ăn mắm tôm thì bảo bà sẽ cho vào. Chỉ có duy nhất điểm trừ là ông bà bán vỉa hè nên hơi chật chội khi ngồi quán cũng đông nữa. Mùa lạnh này chỉ đi chơi đêm chỉ cần 1 tô thôi cũng ấm lòng rồi. Đầy u no căng rốn mà có 40k thôi các bác ợ. Đã ăn nhiều lần nhưng vị và mọi thứ ko hề thay đổi lần nào cũng dc phục vụ tận tình và cho nhiều rau muống chẻ.\n\n', 10, '00:00:00', '20:00:00', 0, 40, 0, 3, '25 BẠCH MAI', 1),
(25, 'quán cháo Đài Loan', 'Hôm nay mình đi có việc ở Phan Đình Phùng, cách quán cháo Đài Loan chỉ mấy nhà. Cũng phải đến 3-4 năm rồi ko ăn lại ở đây, hôm nay tiện đường nên tạt vào.\n\nBước vào quán bàn chật kín, chỉ còn trống 2-3 bàn. Nhìn đông vậy cũng xác định là sẽ phải đợi lâu rồi. Mình order xong, nhìn đồng hồ là 20:30. Mình gọi 1 bát cháo sườn gan ngô, order cho mình là 1 bạn trông cũng lớn tuổi, chắc tầm ngoài 30. Ngồi được tầm 15\' mình hỏi có đồ chưa, thì bạn nhân viên ấy bảo chị đợi 1 lúc quán đang đông khách. 10\' sau hỏi lần nữa vẫn bảo đợi 1 lúc. Mình có thắc mắc là có bàn vào sau mình sao lại thấy lên đồ trước, thì bạn ấy trả lời bằng thái độ rất khó chịu \"người ta đến trước chị đấy, mới chuyển từ bàn trong ra\" rồi đi thẳng. Vài phút sau bạn ấy quay lại dọn bàn bên cạnh và bảo bếp em báo đợi 1 lúc nữa. Lúc này là 20:57 và mình đã hết kiên nhẫn rồi, mình bảo 1 lúc là bao lâu, 5\' hay 10\'? Thì bạn ấy đáp là \"bếp chỉ bảo 1 lúc nữa\". Mình quyết định không ăn nữa, và có tỏ thái độ không hài lòng về bạn nhân viên phục vụ. Bạn ấy nghe thấy và cứ thản nhiên dọn bàn lau bàn.\n\nQuán đông khách nên phục vụ chậm mình rất thông cảm, nhưng với thái độ của bạn nhân viên lớn tuổi đó thì thực sự không chấp nhận được. Bỏ tiền ra đi ăn mà cứ như mình đi ăn xin không bằng. Thái độ kiểu \"không có mày quán bố vẫn đông nhé\". Một câu chị thông cảm hoặc xin lỗi chị cũng không có, từ đầu đến cuối phục vụ khách bằng cái bản mặt hằm hằm. Thôi cạch mặt từ đây nhé!', 10, '00:00:00', '19:00:00', 0, 40, 0, 1, 'Phan Đình Phùng', 3),
(26, 'bún riêu Ngà', 'Phải nói đây là hàng bún riêu ngon nhất đối với em ở bạch mai , đêm qua buồn buồn lượn vòng hồ nên tiện đường em phi sang bạch mai ăn bún riêu luôn , 1 bát trứng lộn , thịt bò , đậu phủ ít hành khô vừa ăn vừa cảm nhận nước rất ngon  thịt bò là thịt bò bắp nhưng thái mỏng  sợi bún nhỏ , trứng ăn bình thường , nước dùng nóng hổi ăn kèm với quẩy . \nHôm qua em đến mà đông dã man thật sự , có 1 phòng cho khách chờ mua về , 1 phòng cho khách ngồi ăn và cả trên tầng 2 nữa , em thấy còn có nhiều hội diễn viên đến đây ăn lắm , nhiều bạn nữ xinh xinh nên em ngồi chờ đến lượt cũng chẳng thấy sốt ruột hehee  còn có cả dịch vụ ship tận nơi , chị chủ dễ tính nhắc nhở khách nhẹ nhàng , nhân viên thì thôi .. nhân viên ở đây nó ngoan 1 cách khó hiểu , khách gọi gì hay lấy gì đều “dạ..vâng ạ” cười tươi :x bát em ăn là 40k nếu ăn thêm giò cả ốc nhỏ thì hình như là 50k , quẩy hơi ỉu .. sẽ chỉ chung thành với hàng này và hàng bà xuân béo đối diện nhà em \n\nĐịa chỉ : cuối ngõ đình đại bạch mai , bún riêu Ngà , cứ đi đến cuối ngõ bảo bạn trông xe là ăn bún riêu là bạn í hướng dẫn tận tình lắm ', 8, '00:00:00', '20:00:00', 0, 40, 0, 1, 'cuối ngõ đình đại bạch mai', 1),
(27, 'Muối Tiêu Brunch', 'Cuối tuần rảnh rỗi thưởng thức bữa sáng muộn gộp bữa trưa ở đây cũng được đấy. Tây nó hay dùng từ Brunch nghĩa là ghép của Breakfast and Lunch.\nThoáng đãng, dịch vụ thân thiện, khá ổn cho 1 bữa ăn nhẹ nhàng lãng mạn.\nMenu đồ ăn nhẹ và bánh khá ngon, mặc dù giá 100-200K là ko cao nhưng định lượng hơi nhỏ, tính ra là.......à mà thôi, ko bàn đắt rẻ bởi mỗi ng có mức chi tiêu khác nhau, miễn mình thích là được.', 0, '00:00:00', '20:00:00', 0, 40, 1, 1, 'phố Hội Vũ', 1),
(28, 'Oanh Vân', 'Em vô hóng hớt trong hội cũng được 1 thời gian rồi. Nhưng cũng chưa đi được mấy. Nay có tâm trạng nên mạn phép lên hội chia sẻ một ăn gọi là vừa lạ mà vừa quen ạ. \nAi ở Lạng Sơn đã nghe đến món ăn Phóng Dăm và Cóong Phù chưa ạ. Vâng dưới này cóong phù chúng ta hay gọi là bánh trôi tàu đó ạ. \nQuán ăn này nằm ở ven hồ Đầm Khê. Đi từ số nhà 86 Nguyễn Viết Xuân Hà Đông Hà Nội rẽ vào hỏi khu tập thể quân khu Ba. Quán nhà chị Oanh Vân\nQuán bán bánh từ 15g chiều đến 20g tối thôi ạ. \nNói sơ qua về đ.c và thời gian bán hàng 1 tí. Giờ em đi vào chủ đề chính đây ạ. \n- Phóng Dăm là món ăn được là từ bột nếp ( bột bánh trôi ) có nhân thịt mộc nhĩ bên trong ăn cùng rau cải cúc tần, xương sườn và canh xương ạ. 1 suất có 3 viên to như là viên bánh ngỗng ý ạ. Và tương đối nhiều cải cúc. Ăn kèm có thêm món măng ớt muối do chính tay chị chủ quán muối. Màu sắc của chiếc bánh được pha trộn giữ bột và gấc nhà trồng được để tạo nên những chiếc bánh có màu sắc sinh động.\nBản thân em khi ăn thấy bánh vừa dẻo vừa dai nhân bên trong vừa miệng. Canh xương thì ngọt thanh chứ không có mì chính. Rau cũng rất là tươi. Như em thì chỉ ăn 1 bát này là no rồi. Người ăn khỏe thì cố lắm cũng chỉ hết được 2 bát. Món này mà ăn vào mùa đông thì cực kì hợp luôn vì nóng hôi hổi vừa thổi vừa ăn ạ. \n- Bánh trôi tàu thì 1 bát có đến chục viên với hơn chục viên bánh ạ. Nhân đậu xanh nghiền. Ăn kèm có nước cốt dừa, lạc dập, dừa nạo sợi cùng với nước gừng. Bác nào mà thích đồ ngọt thì không thể bỏ qua món này vào mùa đông đâu ạ. \nĐiểm em thích nhất ở quán đó là bột cũng do chị chủ tự xay. Chất tạo màu thì cực kì thiên nhiên vì làm luôn từ quả gấc trồng ngay trước nhà chị ý. Và món ăn vừa lạ vừa quen này do chị chủ là người chính gốc Lạng Sơn làm nên mùi vị cũng khác 1 chút. \nÀ quên. Buổi sáng quán còn bán cả bún phở vịt quay Lạng Sơn, thịt xá xíu và lạp xưởng nhà làm. Nchung em lê la ở quán này từ ăn sáng đến ăn chiều ý ạ. \nCác bác ở gần ở xa có đi đâu thì tạt qua thẩm định nha.', 8, '00:00:00', '20:00:00', 1, 40, 0, 4, '86 Nguyễn Viết Xuân', 11),
(29, 'Ba Toa nhà gỗ', 'Sau khi được sự giới thiệu của rất nhiều bác trong group em đã xách mông đi ăn lẩu bò Ba Toa. Để tìm được quán chuẩn thực sự là khá vất vả các bác ạ. Con đường dẫn vào quán nó như kiểu cái ngõ bún Đậu Hàng Khay vậy, dăm bảy quán lẩu bò đông nghẹt sát 2 bên, quán gốc rồi quán cũ các kiểu không biết đâu mà lần y hệt như mấy cái hàng lạc rang húng lìu trên phố bà Triệu, mọc đâu ra mà lắm bà Vân thế không biết. Rất may là mấy quán này ko chèo kéo như kiểu ở HN.\n\nSau một hồi vượt qua thử thách em tìm được quán ở đoạn cuối ngõ, nhà gỗ có cái biển đỏ kia. Cứ ngỡ là được ăn luôn nhưng không.., đến Đường Tăng lấy được kinh rồi vẫn còn kiếp nạn. Quán lúc nào cũng full bàn và luôn có rất nhiều người chờ. Em và con dở nhà em tới lúc hơn 18h chút phải đợt cỡ khoảng 30 phút mới có bàn, mà còn bị nhầm cho 2 bạn đến sau được có bàn trước may 2 bạn ấy nhường lại cho, 2 bạn mà có ở đây cho mình cảm ơn nhé ạ kiki\n\n-Không gian: Quán trong gian nhà gỗ, khá bé, hơi chật chút nhưng được cái không hề ghép bàn. + 1 điểm cho sự đáng yêu này.\n-Đồ ăn: Lẩu là lẩu bò ta, gồm thịt bò chín, nạm bò, gân và đuôi để trong nồi sẵn. Thịt bò khá ngon, mềm, gân và đuôi ăn hết sảy nhưng nên đun lâu một chút. Nước lẩu đậm đà, ngon và ngọt, đặc biệt ăn cùng rau lẩu thì cứ phải gọi là thôi rồi lượm ơi. Lẩu kiểu này ở HN mình biết có quán Bò Thanh Hà ở Lạc Trung cũng như này nhưng đắt và không ngon bằng. Nộm tai heo thì bình thường, ko có vẹo gì lắm ăn đổi vị thì tạm được\n-Phục vụ: Quán đông nhưng khi có bàn thì lên đồ rất nhanh, không phải chờ đợi lâu. Các chị phục vụ cũng khá là đáng yêu, thỉnh thoảng có hơi quên tí vì quán đông nên chấp nhận được.', 7, '00:00:00', '19:00:00', 1, 40, 0, 2, '29/1 Hoàng Diệu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_comments`
--

DROP TABLE IF EXISTS `review_comments`;
CREATE TABLE IF NOT EXISTS `review_comments` (
  `review_id` int(11) NOT NULL,
  `summary` text CHARACTER SET utf8 NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `review_id` (`review_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_comments`
--

INSERT INTO `review_comments` (`review_id`, `summary`, `comment`, `user_id`) VALUES
(29, 'quán ngon', 'cảm ơn bạn desu!', 40),
(29, 'gà ', 'gà gà gà', 40),
(29, 'gà ', 'gà gà gà', 40),
(29, 'gà', 'gà gà gà gà', 40),
(29, 'gà ', 'gà gà gà gà', 40),
(27, 'cảm ơn', 'arigatou gozaimasu', 40),
(27, 'ga', 'ga gà gá gà', 40),
(28, 'gà', ' gà gà', 40),
(24, 'gà ', 'gà tần thuốc bắc omegalul', 40),
(24, 'gà ', 'gà gà', 40),
(25, 'gà', 'gà gà gà', 40),
(28, 'gà', 'gà', 40),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41),
(28, 'par bub', 'bar pub', 41);

-- --------------------------------------------------------

--
-- Table structure for table `review_mon_gia`
--

DROP TABLE IF EXISTS `review_mon_gia`;
CREATE TABLE IF NOT EXISTS `review_mon_gia` (
  `review_id` int(11) NOT NULL,
  `ten_mon` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gia` int(11) NOT NULL,
  KEY `review_id` (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_mon_gia`
--

INSERT INTO `review_mon_gia` (`review_id`, `ten_mon`, `gia`) VALUES
(24, 'bún riêu', 20000),
(25, 'cháo sườn', 30000),
(26, 'bún', 40000),
(27, 'bánh', 200000),
(28, 'Cóong phù', 15000),
(28, 'phóng dăm', 20000),
(29, 'Lẩu bò', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `salt`, `email`, `username`) VALUES
(13, 'sxuA3cqw9vrWNn36zoFvSpafL/0wODBjNzkwYThh', '080c790a8a', 'email1@gmail.com', 'user1'),
(14, '3/IY0BIBa6D7l3DT+Tm/DEvtdb04OTk0YmEzNDE3', '8994ba3417', 'email2@gmail.com', 'user2'),
(15, 'beAJzg55R79FF8dVbUv9YQG9pG1mMTAyMzdhMWYy', 'f10237a1f2', 'email3@gmail.com', 'user3'),
(16, 'hf1yxEX6+e0GWu3cij8GEKqiHB85MzFmOWUxYjAy', '931f9e1b02', 'email4@gmail.com', 'user4'),
(17, 'QA75xYFXpYCl/PdQFs1G0ncCOqBkNzg5YzMxOWU2', 'd789c319e6', 'email5@gmail.com', 'user5'),
(18, 'A2as+1deBLAeIOct9ZyhfSENXuEzNGE4MzQ3MjFk', '34a834721d', 'email6@gmail.com', 'user6'),
(19, 'Qlh2sJmDTLiitgldsEPgQU3HL2o5YmVmMWFmZjE2', '9bef1aff16', 'email7@gmail.com', 'user7'),
(20, '6yCITk9ptpjpEZ4jKHi3yLWXbAA3YmFhZGIyZTZl', '7baadb2e6e', 'email8@gmail.com', 'user8'),
(21, 'fgdfgdf', 'hghg', 'ghghg', 'sdfs'),
(22, 'dfdefdgf', 'rgtr', 'trtr', 'jhj'),
(23, 'fugfuj', 'jhyuj', 'jh', 'hjh'),
(24, 'fgfg', 'gf', '', ''),
(25, 'fdgfg', '', 'fgfglkl', 'rwew'),
(26, 'truio', '', 'trytghd', 'nbgngs'),
(27, 'dfsdf', 'gfgf', ',k,lik', 'rweew'),
(28, 'bfhhg', 'r453re', 'hgtwew', 'xcdm'),
(29, 'sgsqe', 'gr', 'ewtuyiu', 'mngsa'),
(30, 'sgtwrre', 'trt', 'qtytru', 'erscz'),
(31, 'gsgs', 'hgfh', 'jtertfaw', 'dfghdhwer'),
(32, 'rghjeswg', 'rtwerft', 'dasgtawgasd', 'sdfgd'),
(33, 'sdghtre', 'rtwer', 'dfhgswqa', 'fhgh'),
(34, 'asgfaeehwe', 'sdfsf', 'agher', 'dfa'),
(35, 'sdhdgas', 'sfs', 'sfghdge', 'gfsdf'),
(36, 'buihu', 'gjgh', 'dtsets', 'yfy'),
(37, 'SzhhKK9l/O4wWl+n81LNrfFkSpRmOThlYmIxMGIw', 'f98ebb10b0', 'luuxuansond@gmail.com', 'sonluu'),
(38, 'tvOpAz3v9buaOH2A9aCXBSt2t/1mNGRmNGQ5ZDM5', 'f4df4d9d39', 'luuxuanson2email', 'sonluu2'),
(39, 'OqjNBzq5m2Z556d/lXg2FMPjQMc1MDNkODdhMGQ2', '503d87a0d6', 'emailsonluu', 'sonluu3'),
(40, '/YX15dQ/YG5bAsGzs7LsJZcspD41Y2ExYjI2NGUx', '5ca1b264e1', 'vuductran153@gmail.com', 'sad1503'),
(41, '4tLMexwTc5lgHQ4I2Fjvkc60C9EzNGU2NDQyZTRh', '34e6442e4a', 'vuductran1531@gmail.com', 'vuduc153'),
(42, 'MqrsLuOg+r/N2NytbQZAjYOKxoQzNDhiOTcxYTdl', '348b971a7e', 'vuductran15v3@gmail.com', 'vvv'),
(43, 'G99qAm+RGjVp0dcDp/tJz97nMAY4MmIwNTE1MDlk', '82b051509d', 'vvvv@gmail.com', 'vvvv'),
(44, 'Q6U3I9eKck5gBCbjpL6qVtTq88A3YjQ0NmEwMmZh', '7b446a02fa', '111', 'vuductran111');

-- --------------------------------------------------------

--
-- Table structure for table `user_like_dislike`
--

DROP TABLE IF EXISTS `user_like_dislike`;
CREATE TABLE IF NOT EXISTS `user_like_dislike` (
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  KEY `user_id` (`user_id`,`review_id`),
  KEY `review_id` (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_like_dislike`
--

INSERT INTO `user_like_dislike` (`user_id`, `review_id`, `type`) VALUES
(40, 28, 1),
(40, 29, 1),
(40, 27, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `districtid` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loaiquanid` FOREIGN KEY (`loai_id`) REFERENCES `loai_quan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_comments`
--
ALTER TABLE `review_comments`
  ADD CONSTRAINT `Review_comments_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_mon_gia`
--
ALTER TABLE `review_mon_gia`
  ADD CONSTRAINT `Review_mon_gia_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_like_dislike`
--
ALTER TABLE `user_like_dislike`
  ADD CONSTRAINT `User_like_dislike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `re` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;