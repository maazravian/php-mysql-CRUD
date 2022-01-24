

--
-- Database: `assignment2`
--
CREATE DATABASE IF NOT EXISTS `assignment2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignment2`;
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminId` int(50) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `Name`, `Login`, `Password`) VALUES
(1, 'abc', 'abc', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductId` int(50) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `TypeId` int(10) NOT NULL,
  `Price` float NOT NULL,
  `Description` varchar(100) NOT NULL,
  `PicURL` varchar(100) NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  `UpdatedBy` int(50) NOT NULL,
  `IsActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `TypeId` int(10) NOT NULL,
  `TypeName` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeId`, `TypeName`) VALUES
(1, 'Electronics'),
(2, 'Furniture'),
(3, 'Grocery'),
(4, 'Cookware'),
(5, 'Clothing'),
(6, 'Others');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`), ADD UNIQUE KEY `Login` (`Login`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductId`), ADD KEY `TypeId` (`TypeId`), ADD KEY `UpdatedBy` (`UpdatedBy`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminId` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TypeId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `FKAdmin` FOREIGN KEY (`UpdatedBy`) REFERENCES `admin` (`AdminId`),
ADD CONSTRAINT `FKType` FOREIGN KEY (`TypeId`) REFERENCES `type` (`TypeId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
