-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 10:46 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlcv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Id_Acc` varchar(50) NOT NULL,
  `Password_Acc` varchar(50) NOT NULL,
  `Permission_Acc` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Id_Acc`, `Password_Acc`, `Permission_Acc`) VALUES
('Forbidden', 'e10adc3949ba59abbe56e057f20f883e', 2),
('Giang', 'e10adc3949ba59abbe56e057f20f883e', 1),
('Tina', 'e10adc3949ba59abbe56e057f20f883e', 2),
('Tung', 'e10adc3949ba59abbe56e057f20f883e', 3),
('Vy', 'e10adc3949ba59abbe56e057f20f883e', 4);

-- --------------------------------------------------------

--
-- Table structure for table `colleage`
--

CREATE TABLE `colleage` (
  `Id_Col` int(11) NOT NULL,
  `Name_Col` varchar(200) NOT NULL,
  `Mail_Col` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colleage`
--

INSERT INTO `colleage` (`Id_Col`, `Name_Col`, `Mail_Col`) VALUES
(1, 'Khoa cÃ´ng nghá»‡ thÃ´ng tin vÃ  truyá»n thÃ´ng', 'ctuelcit@ctu.edu.vn'),
(2, 'Khoa nÃ´ng nghiá»‡p', 'cn@ctu.edu.vn'),
(4, 'Khoa ngoáº¡i ngá»¯', 'ngoaingu@gmail.com'),
(5, 'Khoa thá»§y sáº£n', 'thuysan@ctu.edu.vn');

-- --------------------------------------------------------

--
-- Table structure for table `indocument`
--

CREATE TABLE `indocument` (
  `Id_In` varchar(200) NOT NULL,
  `Name_In` varchar(200) DEFAULT NULL,
  `From_In` varchar(200) DEFAULT NULL,
  `To_In` varchar(200) DEFAULT NULL,
  `Content_In` varchar(500) DEFAULT NULL,
  `Signer_In` varchar(100) DEFAULT NULL,
  `Forward_In` varchar(100) DEFAULT NULL,
  `Id_Type` int(11) DEFAULT NULL,
  `Id_Off` int(11) DEFAULT NULL,
  `Id_User` int(11) DEFAULT NULL,
  `Date_In` date DEFAULT NULL,
  `Status_In` int(11) DEFAULT NULL,
  `DaedLine_In` date DEFAULT NULL,
  `taptin_In` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `indocument`
--

INSERT INTO `indocument` (`Id_In`, `Name_In`, `From_In`, `To_In`, `Content_In`, `Signer_In`, `Forward_In`, `Id_Type`, `Id_Off`, `Id_User`, `Date_In`, `Status_In`, `DaedLine_In`, `taptin_In`) VALUES
('100', 'Cong van ND001', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'chÆ°a cÃ³ gÃ¬ háº¿t', 'tui', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 2, 2, 11, '2018-10-31', 0, '2018-11-15', 'fi.pdf'),
('123', 'cÃ´ng vÄƒn 123', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'moi du le tot  nghiep', 'Nguyá»…n ThÆ°', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 1, 2, 11, '2018-09-15', 2, '2018-09-22', 'fi.pdf'),
('23', 'cÃ´ng vÄƒn 1', 'so', 'phong', 'mmmmmm', 'tui', 'PhÃ²ng Ä‘Ã o táº¡o', 1, 1, 11, '2018-11-09', 1, '2018-11-14', 'fi.pdf'),
('55550', 'cong van 5555', 'PhÃ²ng Ä‘Ã o táº¡o', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'khÃ´ng ná»™i dung', 'ngá»¥y an láº¡c', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 2, 2, 11, '2018-11-09', 0, '2018-08-30', ''),
('8', 'cÃ´ng vÄƒn 15', 'so', 'so', 'yy', 'tui55', 'Sá»Ÿ TT & TT', 1, 1, 11, '2018-11-16', 1, '2018-11-13', 'nnnnnnnnnnnnnnnnn.pdf'),
('9', 'gianghaha', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 'fdgfdgdg', 'tung', 'Sá»Ÿ giÃ¡o dá»¥c Cáº§n ThÆ¡', 1, 2, 18, '2018-09-07', 2, '2018-09-28', 'Diagram.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `Id_Off` int(11) NOT NULL,
  `Name_Off` varchar(300) DEFAULT NULL,
  `Type_Off` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`Id_Off`, `Name_Off`, `Type_Off`) VALUES
(1, 'So GD & DT', 1),
(2, 'Thong tin & TT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `opinion`
--

CREATE TABLE `opinion` (
  `Opi_Id` varchar(100) NOT NULL,
  `Opi_Content` varchar(500) DEFAULT NULL,
  `Id_In` varchar(200) DEFAULT NULL,
  `Opi_Approved` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opinion`
--

INSERT INTO `opinion` (`Opi_Id`, `Opi_Content`, `Id_In`, `Opi_Approved`) VALUES
('KD01', 'kiem duyet 01', '123', NULL),
('KD03', 'kiem duyet 3', '9', NULL),
('PD03', NULL, '55550', 'nguyen thanh tung');

-- --------------------------------------------------------

--
-- Table structure for table `outdocument`
--

CREATE TABLE `outdocument` (
  `Id_Out` int(11) NOT NULL,
  `Name_Out` varchar(200) DEFAULT NULL,
  `From_out` varchar(200) DEFAULT NULL,
  `To_Out` varchar(200) DEFAULT NULL,
  `Content_Out` varchar(500) DEFAULT NULL,
  `Signer_Out` varchar(100) DEFAULT NULL,
  `Date_Out` datetime DEFAULT NULL,
  `Deadline_Out` date DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Id_Type` int(11) DEFAULT NULL,
  `Id_Off` int(11) DEFAULT NULL,
  `Id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typedocument`
--

CREATE TABLE `typedocument` (
  `Id_Type` int(11) NOT NULL,
  `TypeName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typedocument`
--

INSERT INTO `typedocument` (`Id_Type`, `TypeName`) VALUES
(1, 'Nghi quyet'),
(2, 'Thong tu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_User` int(11) NOT NULL,
  `Name_User` varchar(200) DEFAULT NULL,
  `Position_User` varchar(100) DEFAULT NULL,
  `Birthday_User` date DEFAULT NULL,
  `Gender_User` varchar(10) DEFAULT NULL,
  `NumberPhone_User` varchar(15) DEFAULT NULL,
  `Email_Use` varchar(200) DEFAULT NULL,
  `Address_User` varchar(500) DEFAULT NULL,
  `Id_Acc` varchar(50) NOT NULL,
  `Id_Col` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Name_User`, `Position_User`, `Birthday_User`, `Gender_User`, `NumberPhone_User`, `Email_Use`, `Address_User`, `Id_Acc`, `Id_Col`) VALUES
(11, 'Nguyá»…n TrÆ°á»ng Giang', 'Chá»n quyá»n cho ngÆ°á»i dÃ¹ng', '0000-00-00', '$gioitinh', '0911607773', 'giang@gmail.com', '$diachi', 'Giang', NULL),
(18, 'VÃµ Thá»‹ Há»“ng Tháº¯m', 'LÃ£nh Ä‘áº¡o phÃ²ng KH-TH/CÃ¡n bá»™ chuyÃªn trÃ¡ch', '2018-08-28', '1', '0911608873', '   tina@gmail.com', 'VÄ©nh Long', 'Tina', NULL),
(19, 'Nguyá»…n TrÆ°á»ng Giang Giang', 'LÃ£nh Ä‘áº¡o phÃ²ng KH-TH/CÃ¡n bá»™ chuyÃªn trÃ¡ch', '2018-10-29', '0', '0911607773', 'fdg@gmail.com', 'ChÃ¢u Äá»‘c', 'Forbidden', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Id_Acc`);

--
-- Indexes for table `colleage`
--
ALTER TABLE `colleage`
  ADD PRIMARY KEY (`Id_Col`);

--
-- Indexes for table `indocument`
--
ALTER TABLE `indocument`
  ADD PRIMARY KEY (`Id_In`),
  ADD KEY `Id_Type` (`Id_Type`),
  ADD KEY `Id_Off` (`Id_Off`),
  ADD KEY `Id_User` (`Id_User`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`Id_Off`);

--
-- Indexes for table `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`Opi_Id`),
  ADD KEY `Id_In` (`Id_In`);

--
-- Indexes for table `outdocument`
--
ALTER TABLE `outdocument`
  ADD PRIMARY KEY (`Id_Out`),
  ADD KEY `Id_Type` (`Id_Type`),
  ADD KEY `Id_Off` (`Id_Off`),
  ADD KEY `Id_User` (`Id_User`);

--
-- Indexes for table `typedocument`
--
ALTER TABLE `typedocument`
  ADD PRIMARY KEY (`Id_Type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `fk_col` (`Id_Col`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colleage`
--
ALTER TABLE `colleage`
  MODIFY `Id_Col` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `Id_Off` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `outdocument`
--
ALTER TABLE `outdocument`
  MODIFY `Id_Out` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typedocument`
--
ALTER TABLE `typedocument`
  MODIFY `Id_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `indocument`
--
ALTER TABLE `indocument`
  ADD CONSTRAINT `indocument_ibfk_1` FOREIGN KEY (`Id_Type`) REFERENCES `typedocument` (`Id_Type`),
  ADD CONSTRAINT `indocument_ibfk_2` FOREIGN KEY (`Id_Off`) REFERENCES `office` (`Id_Off`),
  ADD CONSTRAINT `indocument_ibfk_4` FOREIGN KEY (`Id_User`) REFERENCES `user` (`Id_User`);

--
-- Constraints for table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`Id_In`) REFERENCES `indocument` (`Id_In`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outdocument`
--
ALTER TABLE `outdocument`
  ADD CONSTRAINT `outdocument_ibfk_1` FOREIGN KEY (`Id_Type`) REFERENCES `typedocument` (`Id_Type`),
  ADD CONSTRAINT `outdocument_ibfk_2` FOREIGN KEY (`Id_Off`) REFERENCES `office` (`Id_Off`),
  ADD CONSTRAINT `outdocument_ibfk_4` FOREIGN KEY (`Id_User`) REFERENCES `user` (`Id_User`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_col` FOREIGN KEY (`Id_Col`) REFERENCES `colleage` (`Id_Col`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
