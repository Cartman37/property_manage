-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-08 20:23:25
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `propertymanagement`
--
CREATE DATABASE IF NOT EXISTS propertymanagement;
use propertymanagement;
-- --------------------------------------------------------

--
-- 表的结构 `appointment`
--
DROP TABLE IF EXISTS appointment;
CREATE TABLE `appointment` (
  `apptId` int(11) NOT NULL,
  `apptDate` datetime NOT NULL,
  `Client_clientId` int(11) NOT NULL,
  `User_userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `appointment`
--

INSERT INTO `appointment` (`apptId`, `apptDate`, `Client_clientId`, `User_userId`) VALUES
(2, '2019-04-20 17:00:00', 2, 1),
(3, '2019-07-12 12:30:00', 4, 1),
(4, '2019-05-25 12:45:00', 3, 1),
(5, '2019-12-12 12:30:00', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `client`
--
DROP TABLE IF EXISTS client;
CREATE TABLE `client` (
  `clientId` int(11) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `clientAddress1` varchar(200) NOT NULL,
  `clientAddress2` varchar(200) NOT NULL,
  `clientCity` varchar(50) NOT NULL,
  `clientProv` varchar(50) NOT NULL,
  `clientPostal` varchar(50) NOT NULL,
  `clientPhone1` varchar(200) NOT NULL,
  `clientPhone2` varchar(200) NOT NULL,
  `clientEmail` varchar(200) NOT NULL,
  `clientDetails` varchar(300) NOT NULL,
  `clientIdentification` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `client`
--

INSERT INTO `client` (`clientId`, `clientName`, `clientAddress1`, `clientAddress2`, `clientCity`, `clientProv`, `clientPostal`, `clientPhone1`, `clientPhone2`, `clientEmail`, `clientDetails`, `clientIdentification`) VALUES
(1, 'Bilbo Baggins', '1 Shire St', '', 'Waterloo', 'ON', 'N2Z5L5', '163-251-7342', '732-346-6236', 'bilbob@hotmail.com', '', ''),
(2, 'Jason Bourne', '200 Old Carriage Drive', 'apt.200', 'Kitchener', 'ON', 'N2P0C7', '236-777-6717', '778-859-7527', 'jbourne@gmail.com', '', ''),
(3, 'Donald Trump', '20 Elder St', '', 'Waterloo', 'ON', 'N2T9C2', '425-125-6352', '', 'donald@trump.com', '', ''),
(4, 'Jim Carrey', '512 Mask Dr', '', 'Kitchener', 'ON', 'N5Z5A9', '691-613-1241', '', 'jcarrey@gmail.com', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `item`
--
DROP TABLE IF EXISTS item;
CREATE TABLE `item` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemDescription` varchar(300) NOT NULL,
  `itemStandard` int(11) NOT NULL,
  `itemType_typeId` int(11) NOT NULL,
  `itemManufacturer_manuId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`itemId`, `itemName`, `itemDescription`, `itemStandard`, `itemType_typeId`, `itemManufacturer_manuId`) VALUES
(5, 'Prato Anthracite', '', 1, 1, 1),
(6, 'Cinq White', '', 1, 1, 1),
(7, 'Charcoal', '', 1, 11, 3),
(8, 'Greywood', '', 1, 7, 4),
(9, 'Bianco Sardo', '', 1, 9, 8),
(10, '116 - Nickel Brushed Handle', '', 1, 4, 6),
(11, 'Mancini', 'Melamine', 1, 3, 6),
(12, 'Arctic - White', '', 1, 3, 6);

-- --------------------------------------------------------

--
-- 表的结构 `itemmanufacturer`
--
DROP TABLE IF EXISTS itemmanufacturer;
CREATE TABLE `itemmanufacturer` (
  `manuId` int(11) NOT NULL,
  `manuName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `itemmanufacturer`
--

INSERT INTO `itemmanufacturer` (`manuId`, `manuName`) VALUES
(1, 'Ceramic Decor'),
(2, 'GENTEK'),
(3, 'GAF'),
(4, 'Meridian'),
(5, 'Sherwin Williams'),
(6, 'Raywal'),
(7, 'Kaycan'),
(8, 'Graniteworx'),
(9, 'Forterra');

-- --------------------------------------------------------

--
-- 表的结构 `itemtopackage`
--
DROP TABLE IF EXISTS itemtopackage;
CREATE TABLE `itemtopackage` (
  `id` int(11) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `packageId` int(11) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `itemtopackage`
--

INSERT INTO `itemtopackage` (`id`, `itemName`, `packageId`, `location`) VALUES
(15, 'Cinq White', 1, 'Kitchen Floor'),
(16, 'Prato Anthracite', 1, 'Bathroom1 Floor'),
(17, 'Greywood', 1, 'Brick'),
(18, 'Mancini', 1, 'Bathroom1 Cabinets'),
(19, 'Arctic - White', 1, 'Kitchen Cabinets'),
(20, 'Bianco Sardo', 1, 'Kitchen Countertop');

-- --------------------------------------------------------

--
-- 表的结构 `itemtype`
--
DROP TABLE IF EXISTS itemtype;
CREATE TABLE `itemtype` (
  `typeId` int(11) NOT NULL,
  `typeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `itemtype`
--

INSERT INTO `itemtype` (`typeId`, `typeName`) VALUES
(1, 'Ceramic Tile'),
(2, 'Laminate Countertop'),
(3, 'Cabinets'),
(4, 'Hardware'),
(5, 'Carpet'),
(6, 'Stone'),
(7, 'Brick'),
(8, 'Laminate Flooring'),
(9, 'Granite'),
(10, 'Siding'),
(11, 'Shingles'),
(12, 'Paint'),
(13, 'Hardwood');

-- --------------------------------------------------------

--
-- 表的结构 `package`
--
DROP TABLE IF EXISTS package;
CREATE TABLE `package` (
  `packageId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `package`
--

INSERT INTO `package` (`packageId`, `propertyId`) VALUES
(1, 18),
(2, 16),
(4, 14);

-- --------------------------------------------------------

--
-- 表的结构 `property`
--
DROP TABLE IF EXISTS property;
CREATE TABLE `property` (
  `propertyId` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `lotNum` varchar(20) NOT NULL,
  `lotSize` varchar(50) NOT NULL,
  `closingDate` date NOT NULL,
  `lotModel` varchar(100) NOT NULL,
  `sub` varchar(100) NOT NULL,
  `block` varchar(20) NOT NULL,
  `clientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `property`
--

INSERT INTO `property` (`propertyId`, `status`, `lotNum`, `lotSize`, `closingDate`, `lotModel`, `sub`, `block`, `clientId`) VALUES
(2, 'firm_offer', '17', '32', '2019-08-22', 'Bridgeport', 'HWK', 'G', 4),
(12, 'available', '18', '32', '2019-04-19', 'Bridgeport', 'HWK', 'F', 0),
(14, 'pack_unselected', '2', '23', '2019-04-18', 'Bridgeport', 'HWK', 'F', 3),
(16, 'pack_selected', '22', '32', '2019-04-01', 'Brookside', 'HRC', 'F', 1),
(18, 'pack_selected', '12', '32', '2019-04-17', 'Brookside', 'HWK', 'G', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--
DROP TABLE IF EXISTS user;
CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userPhone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userId`, `userName`, `userPass`, `userEmail`, `userPhone`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@test.com', '234-234-2345'),
(2, 'ncolpron', 'de5b2ff702835895828c0da75d1c55d9', 'nathancolours@freure.com', '226-791-1390');

--
-- 转储表的索引
--

--
-- 表的索引 `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apptId`);

--
-- 表的索引 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientId`);

--
-- 表的索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemId`);

--
-- 表的索引 `itemmanufacturer`
--
ALTER TABLE `itemmanufacturer`
  ADD PRIMARY KEY (`manuId`);

--
-- 表的索引 `itemtopackage`
--
ALTER TABLE `itemtopackage`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`typeId`);

--
-- 表的索引 `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageId`);

--
-- 表的索引 `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`propertyId`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `client`
--
ALTER TABLE `client`
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `itemmanufacturer`
--
ALTER TABLE `itemmanufacturer`
  MODIFY `manuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `itemtopackage`
--
ALTER TABLE `itemtopackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `itemtype`
--
ALTER TABLE `itemtype`
  MODIFY `typeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `package`
--
ALTER TABLE `package`
  MODIFY `packageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `property`
--
ALTER TABLE `property`
  MODIFY `propertyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
