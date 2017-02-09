-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 06:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `multivendor`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `slug`, `status`) VALUES
(1, 'Electronics', 'electronics-1', 1),
(2, 'Health & Beauty', 'health-beauty-1', 1),
(9, 'Kids', 'kids', 0),
(10, 'Clothing & Shoes', 'clothing-shoes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `imageName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `productID` int(11) NOT NULL,
  PRIMARY KEY (`imageID`),
  KEY `productID` (`productID`),
  KEY `productID_2` (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageID`, `imageName`, `productID`) VALUES
(37, 'dell.jpg', 5),
(38, 'dell_laptop.jpg', 5),
(39, 'Men_clothing1.jpg', 6),
(40, 'Men_clothing2.jpg', 6),
(42, 'Men_clothing3.jpg', 6),
(43, 'Boy_stayle2.jpg', 7),
(44, 'Boy_Stayle3.jpg', 7),
(45, 'Boy_Stayle4.jpg', 7),
(46, 'Men1.jpg', 8),
(47, 'Untitled-1.jpg', 8),
(48, 'skirt.jpg', 9),
(49, 'blouse.jpg', 10),
(50, 'w-shirt.jpg', 11),
(51, 'w-shirt2.jpg', 11),
(52, 'spor.jpg', 12),
(53, 'spor2.jpg', 12),
(54, 'candy_yum_yum.jpg', 13),
(55, 'mac-candy-yum-yum.jpg', 13),
(56, 'yana2.jpg', 14),
(57, 'yana3.jpg', 14),
(58, 'canon.JPG', 15);

-- --------------------------------------------------------

--
-- Table structure for table `optiontype`
--

CREATE TABLE IF NOT EXISTS `optiontype` (
  `optionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `optionTypeName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shopID` int(11) NOT NULL,
  PRIMARY KEY (`optionTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `optiontype`
--

INSERT INTO `optiontype` (`optionTypeID`, `optionTypeName`, `shopID`) VALUES
(1, 'Color', 1),
(15, 'Size', 2),
(16, 'Color', 2),
(17, 'Material', 2),
(18, 'Material', 4),
(19, 'Size', 1);

-- --------------------------------------------------------

--
-- Table structure for table `optionvalue`
--

CREATE TABLE IF NOT EXISTS `optionvalue` (
  `optionValueID` int(11) NOT NULL AUTO_INCREMENT,
  `optionValueName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `optionTypeID` int(11) NOT NULL,
  PRIMARY KEY (`optionValueID`),
  KEY `optionTypeID` (`optionTypeID`),
  KEY `optionTypeID_2` (`optionTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- Dumping data for table `optionvalue`
--

INSERT INTO `optionvalue` (`optionValueID`, `optionValueName`, `optionTypeID`) VALUES
(1, 'Red', 1),
(2, 'Blue', 1),
(36, 'Smal', 15),
(37, 'Medium', 15),
(38, 'Large', 15),
(39, 'Extra large', 15),
(41, 'Yellow', 16),
(42, 'Red', 16),
(43, 'Blue ocean', 16),
(44, 'Cotton', 17),
(45, 'Cotton 90%', 17),
(46, 'Cotton', 18),
(47, 'White', 1),
(48, 'M', 19),
(49, 'L', 19),
(50, 'XL', 19),
(51, 'Black', 1),
(52, 'Green', 1);

-- --------------------------------------------------------

--
-- Table structure for table `optionvaluevariant`
--

CREATE TABLE IF NOT EXISTS `optionvaluevariant` (
  `optionValueVariantID` int(11) NOT NULL AUTO_INCREMENT,
  `optionValueID` int(11) NOT NULL,
  `variantID` int(11) NOT NULL,
  PRIMARY KEY (`optionValueVariantID`),
  KEY `variantID` (`variantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `optionvaluevariant`
--

INSERT INTO `optionvaluevariant` (`optionValueVariantID`, `optionValueID`, `variantID`) VALUES
(35, 1, 29),
(36, 48, 29),
(37, 47, 30),
(38, 48, 30),
(39, 52, 31),
(40, 48, 31),
(41, 51, 33),
(42, 2, 34),
(43, 2, 37),
(44, 52, 38);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderID` int(11) DEFAULT NULL,
  `variantID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  KEY `orderID` (`orderID`),
  KEY `orderID_2` (`orderID`),
  KEY `orderID_3` (`orderID`),
  KEY `orderID_4` (`orderID`),
  KEY `variantID` (`variantID`),
  KEY `variantID_2` (`variantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderID`, `variantID`, `qty`) VALUES
(1, 28, 1),
(3, 28, 1),
(19, 28, 1),
(21, 34, 1),
(21, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `shopID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `status` tinyint(11) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `shopID`, `userID`, `orderDate`, `status`) VALUES
(1, 3, 6, '2016-04-15', 0),
(3, 3, 6, '2016-04-25', 0),
(19, 3, 6, '2016-05-26', 0),
(21, 1, 6, '2016-06-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productTitle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subCategoryID` int(11) NOT NULL,
  `productView` int(11) NOT NULL,
  `shopID` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`productID`),
  KEY `shopID` (`shopID`),
  KEY `shopID_2` (`shopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productTitle`, `description`, `slug`, `subCategoryID`, `productView`, `shopID`, `status`) VALUES
(5, 'dell', 'Good product Dell', 'dell', 1, 19, 3, 1),
(6, 'Men''s clothing', 'Size available: M, L, XL.\r\nColor available: Red, Green, White.', 'mens-clothing-2', 25, 18, 1, 1),
(7, 'Men''s shoes', 'Avaialable color: red, blue, green', 'mens-shoes', 26, 7, 1, 1),
(8, 'Men''s clothing', 'Available color: Blue, Black', 'mens-clothing', 25, 11, 1, 1),
(9, 'Skirt', 'Available size 30, 31, 32', 'skirt', 28, 3, 1, 1),
(10, 'Blouse', 'Availble size: L, XL', 'blouse', 28, 4, 1, 1),
(11, 'Women''s shirt', 'Avalaible color : Blue, Red', 'womens-shirt', 25, 8, 1, 1),
(12, 'Sport shoe', 'Available color: Red, Blue', 'sport-shoe', 26, 5, 1, 1),
(13, 'MAC Candy Yum Yum', 'cool pink for your lip. It''s original lipstick. \r\nSpecial price wholesale.', 'mac-candy-yum-yum', 31, 6, 2, 1),
(14, 'Eau de Toilette for Men', 'A resolutely masculine fragrance born from the sea, the sun, the \r\nearth, and the breeze of a Mediterranean island. Transparent, aromatic, \r\nand woody in nature Aqua Di Gio Pour Homme is a contemporary expression \r\nof masculinity, in an aura of marine notes, fruits, herbs, and woods. \r\n Giorgio Armani Acqua Di Gio Pour Homme is an Allure Best of Beauty Award Winner. \r\n Notes: \r\nMarine Notes, Mandarin, Bergamot, Neroli, Persimmon, Rosemary, Nasturtium, Jasmine, Amber, Patchouli, Cistus.\r\n\r\nStyle:', 'eau-de-toilette-for-men', 31, 7, 2, 1),
(15, 'Cannon', 'About PowerShot SX60 HS\r\n\r\nOverview\r\nZoom Like Never Before\r\nCraters on the moon, wildlife from afar, your child''s face on a crowded school stage… the PowerShot SX60 HS camera gives you the reach to capture it all.', 'cannon', 21, 17, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `shopID` int(11) NOT NULL AUTO_INCREMENT,
  `shopName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`shopID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shopID`, `shopName`, `slug`, `logo`, `banner`, `lat`, `lng`, `userID`) VALUES
(1, 'Nana Fashion', 'nana-fashion', 'images_(1).png', '', 20.9987, 105.837, 2),
(2, 'Dyny Beauty ', 'dyny-beauty', 'images_(2).png', 'music-notes-header-16199182.jpg', 21.0023, 105.846, 3),
(3, 'Van thanh electronic', 'van-thanh-electronic', '', '', 0, 0, 4),
(4, 'Vesna Saloon', 'vesna-saloon', '', '', 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sliderimage`
--

CREATE TABLE IF NOT EXISTS `sliderimage` (
  `sliderID` int(11) NOT NULL AUTO_INCREMENT,
  `imageName` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sliderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sliderimage`
--

INSERT INTO `sliderimage` (`sliderID`, `imageName`, `status`) VALUES
(9, 'slide1-img.jpg', 0),
(12, 'a1.jpg', 1),
(13, 'a2.jpg', 1),
(14, 'a3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `subCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `subCategoryName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categoryID` int(11) NOT NULL,
  PRIMARY KEY (`subCategoryID`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subCategoryID`, `subCategoryName`, `slug`, `categoryID`) VALUES
(1, 'Laptop', 'laptop', 1),
(2, 'Desktop', 'desktop', 1),
(3, 'Bath & Body', 'bath-body', 2),
(4, 'Supplement Nutrition', 'supplement-nutrition', 2),
(19, 'Baby Accessories', 'baby-accessories', 9),
(20, 'Baby Wear', 'baby-wear', 9),
(21, 'Camera', 'camera', 1),
(22, 'Mobile Phone', 'mobile-phone', 1),
(23, 'TV and Video', 'tv-and-video', 1),
(25, 'Men''s clothing', 'mens-clothing', 10),
(26, 'Men''s shoes', 'mens-shoes', 10),
(27, 'Men''s accessories', 'mens-accessories', 10),
(28, 'Women''s clothing', 'womens-clothing', 10),
(29, 'Women''s shoes', 'womens-shoes', 10),
(30, 'Women''s accessories', 'womens-accessories', 10),
(31, 'Make up', 'make-up', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `userGroupID` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `password`, `phone`, `firstname`, `lastname`, `address`, `userGroupID`, `status`) VALUES
(1, 'yoemrattana9@gmail.com', '21218cca77804d2ba1922c33e0151105', '999', 'admin9', 'admin9', 'admin9', 1, 1),
(2, 'yoemrattana168@gmail.com', '52c69e3a57331081823331c4e69d3f2e', '099', 'Rady', 'Chan', 'PP,Cambodia', 2, 1),
(3, 'yoemrattana@gmail.com', '21218cca77804d2ba1922c33e0151105', '999', 'Dana', 'Do', 'Siem Reap, Cambodia', 2, 1),
(4, 'rattanayoem@hotmail.com', '52c69e3a57331081823331c4e69d3f2e', '999', 'Mike', 'Mouse', 'PP', 2, 1),
(6, 'kaka@gmail.com', '52c69e3a57331081823331c4e69d3f2e', '99', 'Kaka', 'Donita', 'BB, Cambodia', 3, 1),
(7, 'rattana_yoem@hotmail.com', '52c69e3a57331081823331c4e69d3f2e', '99', 'Data9', 'Nata', 'Cambodia', 3, 1),
(8, 'veasna@gmail.com', '52c69e3a57331081823331c4e69d3f2e', '09999999', 'Yim', 'Veasna', 'Siem Reap, Cambodia', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE IF NOT EXISTS `variant` (
  `variantID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(9) NOT NULL,
  PRIMARY KEY (`variantID`),
  KEY `productID` (`productID`),
  KEY `productID_2` (`productID`),
  KEY `productID_3` (`productID`),
  KEY `productID_4` (`productID`),
  KEY `productID_5` (`productID`),
  KEY `productID_6` (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`variantID`, `productID`, `qty`, `price`) VALUES
(28, 5, 8, 540),
(29, 6, 0, 6),
(30, 6, 7, 7),
(31, 6, 10, 8),
(32, 7, 8, 3),
(33, 8, 6, 5),
(34, 8, 8, 5),
(35, 9, 10, 9),
(36, 10, 11, 11),
(37, 11, 14, 20),
(38, 11, 9, 21),
(39, 12, 11, 13),
(40, 13, 23, 8),
(41, 14, 8, 8),
(42, 15, 0, 326);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlistID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`wishlistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `productID`, `userID`) VALUES
(4, 6, 1),
(5, 5, 6),
(6, 15, 6),
(7, 5, 6),
(8, 5, 6),
(9, 10, 6),
(10, 6, 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `optionvalue`
--
ALTER TABLE `optionvalue`
  ADD CONSTRAINT `optionvalue_ibfk_1` FOREIGN KEY (`optionTypeID`) REFERENCES `optiontype` (`optionTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `optionvaluevariant`
--
ALTER TABLE `optionvaluevariant`
  ADD CONSTRAINT `optionvaluevariant_ibfk_1` FOREIGN KEY (`variantID`) REFERENCES `variant` (`variantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`variantID`) REFERENCES `variant` (`variantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`shopID`) REFERENCES `shop` (`shopID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
