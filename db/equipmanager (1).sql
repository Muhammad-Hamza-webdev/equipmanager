-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 08, 2026 at 11:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equipmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `companydetail`
--

CREATE TABLE `companydetail` (
  `companyID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companydetail`
--

INSERT INTO `companydetail` (`companyID`, `userID`, `companyName`) VALUES
(1, 1, 'admin'),
(2, 2, 'Company 2'),
(3, 9, 'test'),
(4, 10, 'test'),
(5, 13, 'Test Company ');

-- --------------------------------------------------------

--
-- Table structure for table `equipcat`
--

CREATE TABLE `equipcat` (
  `equipCatID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `catName` varchar(200) NOT NULL,
  `catDesc` varchar(1000) NOT NULL,
  `catStatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipcat`
--

INSERT INTO `equipcat` (`equipCatID`, `companyID`, `catName`, `catDesc`, `catStatus`) VALUES
(11, 1, 'category1', 'aaaaaaa', 1),
(12, 1, 'cat 2sad', 'sdsd', 1),
(13, 1, 'test cat', 'aaaaa', 1),
(14, 1, 'Fainall test cat', 'test desc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipmentID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `equipName` varchar(200) NOT NULL,
  `equipCatID` int(11) NOT NULL,
  `equipImg` varchar(500) NOT NULL,
  `equipTotalQuantity` int(11) NOT NULL,
  `equipInUseQuantity` int(11) NOT NULL DEFAULT 0,
  `equipDesc` varchar(1000) NOT NULL,
  `equipStatus` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=inuse\r\n2=free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipmentID`, `companyID`, `equipName`, `equipCatID`, `equipImg`, `equipTotalQuantity`, `equipInUseQuantity`, `equipDesc`, `equipStatus`) VALUES
(4, 1, 'equip q', 12, 'bfe3d3b08e1ba3b51e1151299ccfb512.png', 13, 0, 'dd', 2),
(5, 1, 'equip q', 11, '3696c2e21a947e5fddd118cfc6b2bcd5.png', 12, 3, 'asda', 2),
(6, 1, 'Test Equipmr', 13, 'be70a14ffb476ada12462f6313759584.png', 12, 2, 'asfsdf', 2),
(7, 1, 'test qq', 12, 'f770faf201ed5e660ffc9245cef81022.png', 12, 0, 'ass', 2),
(8, 1, 'Fainal TEst eqiputment', 14, '06fbe67318b5019e1821348167a4fdb7.png', 23, 0, 'asadasdas', 2),
(9, 1, 'tes ff', 13, 'e5eb7a815f812b07c5af10a7b9100f32.png', 123, 0, 'asf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_payments`
--

CREATE TABLE `equipment_payments` (
  `equipmentPaymentID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL COMMENT 'FK to shopitem',
  `equipmentID` int(11) NOT NULL COMMENT 'FK to equipment',
  `buyerUserID` int(11) NOT NULL COMMENT 'FK to users',
  `sellerCompanyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  `stripeSessionID` varchar(255) DEFAULT NULL,
  `stripePaymentIntentID` varchar(255) DEFAULT NULL,
  `grossAmount` decimal(10,2) NOT NULL COMMENT 'Total amount paid by customer',
  `commissionPercent` decimal(5,2) NOT NULL COMMENT 'Commission % at time of payment',
  `commissionAmount` decimal(10,2) NOT NULL COMMENT 'Calculated commission',
  `netAmount` decimal(10,2) NOT NULL COMMENT 'Amount to company after commission',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `saleType` enum('rental','purchase') NOT NULL,
  `rentalStartDate` date DEFAULT NULL,
  `rentalEndDate` date DEFAULT NULL,
  `rentalType` enum('daily','weekly','monthly','yearly') DEFAULT NULL,
  `paymentStatus` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `paymentMetadata` text DEFAULT NULL COMMENT 'JSON metadata',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_payments`
--

INSERT INTO `equipment_payments` (`equipmentPaymentID`, `itemID`, `equipmentID`, `buyerUserID`, `sellerCompanyID`, `stripeSessionID`, `stripePaymentIntentID`, `grossAmount`, `commissionPercent`, `commissionAmount`, `netAmount`, `currency`, `quantity`, `saleType`, `rentalStartDate`, `rentalEndDate`, `rentalType`, `paymentStatus`, `paymentMetadata`, `createdAt`, `updatedAt`) VALUES
(2, 0, 1, 5, 2, NULL, NULL, 50000.00, 5.00, 2500.00, 47500.00, 'USD', 1, 'purchase', NULL, NULL, NULL, 'pending', '{\"delivery_method\":\"pickup\",\"delivery_location\":\"Shop Address\"}', '2026-02-06 18:02:49', '2026-02-06 18:02:49'),
(3, 0, 2, 6, 2, NULL, NULL, 25000.00, 5.00, 1250.00, 23750.00, 'USD', 1, 'rental', '0000-00-00', '2026-02-11', 'daily', 'pending', '{\"delivery_method\":\"delivery\",\"delivery_location\":\"Customer Address\"}', '2026-02-06 18:02:51', '2026-02-06 18:02:51'),
(4, 0, 1, 5, 2, NULL, '0', 50000.00, 5.00, 2500.00, 47500.00, 'USD', 1, 'purchase', NULL, NULL, NULL, 'pending', '{\"delivery_method\":\"pickup\",\"delivery_location\":\"Shop Address\"}', '2026-02-06 18:04:50', '2026-02-06 18:04:50'),
(5, 0, 2, 6, 2, NULL, '0', 25000.00, 5.00, 1250.00, 23750.00, 'USD', 1, 'rental', '0000-00-00', '2026-02-11', 'daily', 'pending', '{\"delivery_method\":\"delivery\",\"delivery_location\":\"Customer Address\"}', '2026-02-06 18:04:51', '2026-02-06 18:04:51'),
(6, 0, 1, 5, 2, NULL, '0', 50000.00, 5.00, 2500.00, 47500.00, 'USD', 1, 'purchase', NULL, NULL, NULL, 'pending', '{\"delivery_method\":\"pickup\",\"delivery_location\":\"Shop Address\"}', '2026-02-06 18:05:27', '2026-02-06 18:05:27'),
(7, 0, 2, 6, 2, NULL, '0', 25000.00, 5.00, 1250.00, 23750.00, 'USD', 1, 'rental', '0000-00-00', '2026-02-11', 'daily', 'pending', '{\"delivery_method\":\"delivery\",\"delivery_location\":\"Customer Address\"}', '2026-02-06 18:05:28', '2026-02-06 18:05:28'),
(13, 4, 5, 14, 1, NULL, 'pi_3SyUR3RvTgzTht4w0CPrmbZr', 40.00, 4.50, 1.80, 38.20, 'USD', 2, 'purchase', NULL, NULL, 'daily', 'pending', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 09:37:45', '2026-02-08 09:37:45'),
(14, 4, 5, 14, 1, NULL, 'pi_3SyUUlRvTgzTht4w1s9br79y', 40.00, 4.50, 1.80, 38.20, 'USD', 2, 'purchase', NULL, NULL, 'daily', 'pending', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 09:41:35', '2026-02-08 09:41:35'),
(15, 4, 5, 14, 1, NULL, 'pi_3SyUYWRvTgzTht4w0QYPuVtP', 40.00, 4.50, 1.80, 38.20, 'USD', 2, 'purchase', NULL, NULL, 'daily', 'pending', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 09:45:30', '2026-02-08 09:45:30'),
(16, 4, 5, 14, 1, NULL, 'pi_3SyUaTRvTgzTht4w1Y7tifoq', 40.00, 4.50, 1.80, 38.20, 'USD', 2, 'purchase', NULL, NULL, 'daily', '', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 09:47:30', '2026-02-08 09:49:09'),
(17, 4, 5, 14, 1, NULL, 'pi_3SyUgARvTgzTht4w0tyAg1OV', 40.00, 4.50, 1.80, 38.20, 'USD', 2, 'purchase', NULL, NULL, 'daily', '', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 09:53:23', '2026-02-08 09:53:26'),
(18, 4, 5, 14, 1, NULL, 'pi_3SyUnGRvTgzTht4w0K4lxu8W', 20.00, 4.50, 0.90, 19.10, 'USD', 1, 'purchase', NULL, NULL, 'daily', '', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-08 10:00:43', '2026-02-08 10:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_payouts`
--

CREATE TABLE `equipment_payouts` (
  `equipmentPayoutID` int(11) NOT NULL,
  `equipmentPaymentID` int(11) NOT NULL COMMENT 'FK to equipment_payments',
  `companyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  `payoutAmount` decimal(10,2) NOT NULL COMMENT 'Net amount to be paid out',
  `payoutStatus` enum('pending','approved','released','rejected') NOT NULL DEFAULT 'pending',
  `approvedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `approvedAt` timestamp NULL DEFAULT NULL,
  `payoutNotes` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectcategory`
--

CREATE TABLE `projectcategory` (
  `pCatID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `pCatName` varchar(200) NOT NULL,
  `pCatDesc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectcategory`
--

INSERT INTO `projectcategory` (`pCatID`, `companyID`, `pCatName`, `pCatDesc`) VALUES
(3, 1, 'Manufacturing Building', 'manufactureing'),
(4, 1, 'Plubing', 'fixing pips');

-- --------------------------------------------------------

--
-- Table structure for table `projectequipmentassign`
--

CREATE TABLE `projectequipmentassign` (
  `assignID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `workforceID` int(11) NOT NULL,
  `equipmentID` int(11) NOT NULL,
  `assignedQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectequipmentlink`
--

CREATE TABLE `projectequipmentlink` (
  `projectequipmentLinkID` int(11) NOT NULL,
  `equipmentID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `equipmentQTY` int(11) NOT NULL COMMENT 'totall quantity of equipment assigned to that project',
  `TotalAssignQTY` int(11) NOT NULL DEFAULT 0 COMMENT 'totall quantity assigned to workforce\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectequipmentlink`
--

INSERT INTO `projectequipmentlink` (`projectequipmentLinkID`, `equipmentID`, `ProjectID`, `equipmentQTY`, `TotalAssignQTY`) VALUES
(5, 6, 2, 2, 0),
(6, 5, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `pCatID` int(11) NOT NULL COMMENT '0=marketplace listing',
  `itemID` int(11) DEFAULT NULL COMMENT 'shop listing ID',
  `pName` varchar(200) NOT NULL,
  `pLocation` varchar(500) NOT NULL,
  `pStartDate` date DEFAULT NULL,
  `pEndDate` date DEFAULT NULL,
  `pDesc` varchar(500) NOT NULL,
  `pImg1` varchar(200) DEFAULT NULL,
  `pImg2` varchar(200) DEFAULT NULL,
  `pImg3` varchar(200) DEFAULT NULL,
  `pImg4` varchar(200) DEFAULT NULL,
  `pImg5` varchar(200) DEFAULT NULL,
  `pImg6` varchar(200) DEFAULT NULL,
  `pImg7` varchar(200) DEFAULT NULL,
  `pImg8` varchar(200) DEFAULT NULL,
  `pImg9` varchar(200) DEFAULT NULL,
  `pImg10` varchar(200) DEFAULT NULL,
  `pStatus` tinyint(1) NOT NULL COMMENT '1=draft\r\n2=in process\r\n3=Delyed\r\n4=Completed',
  `pDraftStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '2=step 2\r\n3= step 3',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `companyID`, `pCatID`, `itemID`, `pName`, `pLocation`, `pStartDate`, `pEndDate`, `pDesc`, `pImg1`, `pImg2`, `pImg3`, `pImg4`, `pImg5`, `pImg6`, `pImg7`, `pImg8`, `pImg9`, `pImg10`, `pStatus`, `pDraftStatus`, `createdAt`) VALUES
(1, 1, 0, 1, 'Website Marketplace Listing', 'asdasd', '2026-01-01', '2026-01-07', 'Workforce Listing on website Marketplace', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2025-12-29 18:01:06'),
(2, 1, 0, 2, 'Website Marketplace Listing', 'fasf', '2026-01-02', '2026-01-07', 'Equipment Listing on website Marketplace', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2025-12-29 18:02:21'),
(3, 1, 0, 4, 'Website Marketplace Listing', 'test address', '2026-01-08', '2026-01-15', 'Equipment Listing on website Marketplace', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-01-08 18:28:33'),
(4, 1, 4, NULL, 'lahore plubbing', 'lahore', '2026-01-09', '2026-01-13', 'asfas', '695ff92ce3f32_1767897388.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2026-01-08 18:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `projectworkforcelink`
--

CREATE TABLE `projectworkforcelink` (
  `projectWorkforceLinkID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `workforceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectworkforcelink`
--

INSERT INTO `projectworkforcelink` (`projectWorkforceLinkID`, `ProjectID`, `workforceID`) VALUES
(1, 1, 1),
(2, 0, 5),
(3, 0, 4),
(4, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `shopequipments`
--

CREATE TABLE `shopequipments` (
  `shopEqpID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `equipmentID` int(11) NOT NULL,
  `web_catID` int(11) NOT NULL,
  `equipQty` int(11) NOT NULL,
  `eqpBrandModel` varchar(500) NOT NULL,
  `eqpSpecs` varchar(1500) NOT NULL,
  `eqpCondition` varchar(1500) NOT NULL,
  `eqpLocCity` varchar(100) NOT NULL,
  `eqpAdd` varchar(1500) DEFAULT NULL,
  `eqpRentalType` tinyint(1) DEFAULT NULL COMMENT '1=perday 2=per week 3=permonth 4=yearly',
  `eqpPrice` varchar(100) NOT NULL,
  `eqpAvailableStart` date NOT NULL,
  `eqpAvailableEnd` date NOT NULL,
  `eqpimg1` varchar(300) DEFAULT NULL,
  `eqpimg2` varchar(300) DEFAULT NULL,
  `eqpimg3` varchar(300) DEFAULT NULL,
  `eqpimg4` varchar(300) DEFAULT NULL,
  `eqpimg5` varchar(300) DEFAULT NULL,
  `eqpimg6` varchar(300) DEFAULT NULL,
  `eqpimg7` varchar(300) DEFAULT NULL,
  `eqpimg8` varchar(300) DEFAULT NULL,
  `eqpimg9` varchar(300) DEFAULT NULL,
  `eqpimg10` varchar(300) DEFAULT NULL,
  `eqpDeliveryOpt` tinyint(1) NOT NULL COMMENT '1=can be dilvered 2= pickup only ',
  `eqpRules` varchar(2000) DEFAULT NULL COMMENT '(damage, return, etc.)',
  `noteForRenter` varchar(2000) DEFAULT NULL,
  `addRequirments` varchar(2000) DEFAULT NULL COMMENT 'for renter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopequipments`
--

INSERT INTO `shopequipments` (`shopEqpID`, `itemID`, `equipmentID`, `web_catID`, `equipQty`, `eqpBrandModel`, `eqpSpecs`, `eqpCondition`, `eqpLocCity`, `eqpAdd`, `eqpRentalType`, `eqpPrice`, `eqpAvailableStart`, `eqpAvailableEnd`, `eqpimg1`, `eqpimg2`, `eqpimg3`, `eqpimg4`, `eqpimg5`, `eqpimg6`, `eqpimg7`, `eqpimg8`, `eqpimg9`, `eqpimg10`, `eqpDeliveryOpt`, `eqpRules`, `noteForRenter`, `addRequirments`) VALUES
(1, 2, 6, 6, 2, 'dfh', 'hdfgh', '2', 'As', 'fasf', 1, '4', '2026-01-02', '2026-01-07', '2_1_1767031337.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, ' gsdg', 'sdgs', 'dgsd'),
(2, 3, 4, 9, 3, 'gsdg', 'sdgsdg | asfasf', '3', 'Dusseldorf', 'sdgsd', NULL, '34', '2026-01-19', '2026-01-22', '3_1_1767031373.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ddddd', NULL, NULL),
(3, 4, 5, 9, 0, 'awf', 'ffff', '1', 'Lahore', 'test address', 1, '20', '2026-01-08', '2026-01-15', '4_1_1767896876.jpeg', '4_2_1767896876.jpg', '4_3_1767896876.png', '4_4_1767896876.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, ' asfas', 'asfas', 'afsfas');

-- --------------------------------------------------------

--
-- Table structure for table `shopitem`
--

CREATE TABLE `shopitem` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  `pageID` int(11) DEFAULT NULL,
  `itemType` tinyint(1) NOT NULL COMMENT '1=equipment 2=workforce',
  `saleType` tinyint(1) NOT NULL COMMENT '1=sale 0=rental',
  `itemStatus` tinyint(1) NOT NULL COMMENT '1=approved, 2=pending approval 3=rejected 0=drafted',
  `liveStatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=live 0=not live'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`itemID`, `userID`, `companyID`, `pageID`, `itemType`, `saleType`, `itemStatus`, `liveStatus`) VALUES
(1, 1, 1, NULL, 2, 0, 1, 1),
(2, 1, 1, NULL, 1, 0, 0, 0),
(3, 1, 1, NULL, 1, 1, 2, 1),
(4, 1, 1, NULL, 1, 1, 1, 1),
(5, 1, 1, NULL, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopworkforce`
--

CREATE TABLE `shopworkforce` (
  `shopWorkforceID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `workforceID` int(11) NOT NULL,
  `web_catID` int(11) NOT NULL,
  `workforceCV` varchar(100) NOT NULL,
  `workforceCertif` varchar(100) DEFAULT NULL,
  `workforceCity` varchar(500) NOT NULL,
  `WorkforceAdd` varchar(1200) DEFAULT NULL,
  `workforceRentalType` tinyint(1) NOT NULL COMMENT '1=perday 2=per week 3=permonth 4=yearly	',
  `workforcePrice` int(11) NOT NULL,
  `workforceAvailableStart` date NOT NULL,
  `workforceAvailableEnd` date NOT NULL,
  `workforceDeliveryOpt` tinyint(1) NOT NULL COMMENT '1=can be dilvered 2= pickup only',
  `workforceRules` varchar(2000) DEFAULT NULL COMMENT '(damage, return, etc.)',
  `workforcenoteForRenter` varchar(2000) DEFAULT NULL,
  `workforceaddRequirments` varchar(2000) DEFAULT NULL COMMENT 'for renter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopworkforce`
--

INSERT INTO `shopworkforce` (`shopWorkforceID`, `itemID`, `workforceID`, `web_catID`, `workforceCV`, `workforceCertif`, `workforceCity`, `WorkforceAdd`, `workforceRentalType`, `workforcePrice`, `workforceAvailableStart`, `workforceAvailableEnd`, `workforceDeliveryOpt`, `workforceRules`, `workforcenoteForRenter`, `workforceaddRequirments`) VALUES
(1, 1, 1, 7, '1_cv_1767031261.pdf', '1_cert_1767031261.png', 'As', 'asdasd', 1, 324, '2026-01-01', '2026-01-07', 1, ' afsf', 'fasf', 'asfas'),
(2, 5, 1, 7, '5_cv_1769432470.png', NULL, 'Lahore', '', 2, 5, '2026-02-24', '2026-02-28', 2, 'fsdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skillID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `skillName` varchar(200) NOT NULL,
  `skillDesc` varchar(1200) NOT NULL,
  `skillStatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skillID`, `companyID`, `skillName`, `skillDesc`, `skillStatus`) VALUES
(2, 1, 'Plumber', 'Intermediate Plumberr', 1),
(6, 1, 'Genral Workerr', '5 year of experiecne', 1),
(11, 1, 'Test skill 2', 'tst descriptionssss', 1),
(17, 1, 'Genral Worker', 'asdasd', 1),
(18, 1, 'testtttttttttt', 'asdfas', 1),
(19, 1, 'Genral Workerrrrrrrrrrrr', 'asfdad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supportticketchat`
--

CREATE TABLE `supportticketchat` (
  `chatID` int(11) NOT NULL,
  `supportTicketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `chatText` varchar(2500) NOT NULL,
  `chatTimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supportticketchat`
--

INSERT INTO `supportticketchat` (`chatID`, `supportTicketID`, `userID`, `chatText`, `chatTimeStamp`) VALUES
(1, 1, 1, 'tesdt ticket', '2025-12-01 13:56:40'),
(2, 2, 1, 'hiasdfasf', '2025-12-01 13:59:44'),
(3, 3, 1, 'website not working', '2025-12-01 14:00:52'),
(4, 1, 1, 'update?', '2025-12-02 18:08:08'),
(5, 1, 1, 'hii', '2025-12-02 18:19:43'),
(6, 1, 1, 'yo?', '2025-12-02 18:23:29'),
(7, 1, 1, 'o paiii', '2025-12-02 18:26:37'),
(8, 2, 1, 'hello', '2025-12-02 18:26:45'),
(9, 1, 1, 'hellosss', '2025-12-02 18:55:15'),
(10, 2, 1, 'o paii kidan ', '2025-12-02 18:55:26'),
(11, 1, 10, 'Yo', '2025-12-04 12:37:17'),
(12, 1, 10, 'GG', '2025-12-04 12:37:54'),
(13, 1, 10, 'im on it', '2025-12-04 12:46:42'),
(14, 1, 1, 'OPk waiting', '2025-12-04 12:50:06'),
(15, 1, 10, 'ok it is done', '2025-12-04 13:05:26'),
(16, 1, 1, 'ok thanks', '2025-12-04 13:05:35'),
(17, 2, 10, 'Hi Let me check ', '2025-12-05 09:58:35'),
(18, 2, 1, 'ok fast', '2025-12-05 09:59:27'),
(19, 1, 1, 'hi', '2025-12-07 11:48:39'),
(20, 1, 10, 'Yooo', '2025-12-07 11:48:56'),
(21, 1, 10, 'ad', '2025-12-15 10:25:23'),
(22, 1, 10, 'Hi I done tha', '2025-12-15 10:40:10'),
(23, 1, 1, 'a', '2025-12-15 10:40:18'),
(24, 1, 10, 'dasd', '2025-12-15 10:44:36'),
(25, 1, 1, 'asdas', '2025-12-15 10:48:19'),
(26, 4, 1, 'asdasd', '2025-12-15 17:11:31'),
(27, 2, 10, 'Hi', '2025-12-18 15:57:15'),
(28, 2, 1, 'Hi', '2025-12-18 15:57:30'),
(29, 4, 1, 'heelo', '2025-12-27 21:49:52'),
(30, 5, 1, 'check please', '2026-01-20 17:25:37'),
(31, 5, 10, 'Checking', '2026-01-20 17:27:47'),
(32, 5, 10, 'it done', '2026-01-20 17:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `supporttickets`
--

CREATE TABLE `supporttickets` (
  `supportTicketID` int(11) NOT NULL,
  `supportTicketsCatID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `supportSubject` varchar(500) NOT NULL,
  `supportMessage` varchar(2500) NOT NULL,
  `supportTicketTimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `supportTicketStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=response needed from admin 2= responses waiting from company 3=completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supporttickets`
--

INSERT INTO `supporttickets` (`supportTicketID`, `supportTicketsCatID`, `userID`, `supportSubject`, `supportMessage`, `supportTicketTimeStamp`, `supportTicketStatus`) VALUES
(1, 1, 1, 'Em is not working', 'tesdt ticket', '2025-12-01 13:56:40', 3),
(2, 2, 1, 'paymetn wont get through', 'hiasdfasf', '2025-12-01 13:59:44', 3),
(3, 3, 1, 'websiute down', 'website not working', '2025-12-01 14:00:52', 3),
(4, 1, 1, 'Em is not working', 'asdasd', '2025-12-15 17:11:31', 1),
(5, 3, 1, 'Order not placing', 'check please', '2026-01-20 17:25:37', 3);

-- --------------------------------------------------------

--
-- Table structure for table `supportticketscat`
--

CREATE TABLE `supportticketscat` (
  `supportTicketsCatID` int(11) NOT NULL,
  `supportCat` varchar(500) NOT NULL,
  `supportCatStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active 0=non active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supportticketscat`
--

INSERT INTO `supportticketscat` (`supportTicketsCatID`, `supportCat`, `supportCatStatus`) VALUES
(1, 'EM Tracking', 1),
(2, 'Payments', 1),
(3, 'Websites', 1),
(4, 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `settingID` int(11) NOT NULL,
  `settingKey` varchar(100) NOT NULL,
  `settingValue` text NOT NULL,
  `settingType` enum('string','number','boolean','json') NOT NULL DEFAULT 'string',
  `description` text DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`settingID`, `settingKey`, `settingValue`, `settingType`, `description`, `updatedBy`, `updatedAt`) VALUES
(1, 'marketplace_commission_percent', '4.50', 'number', 'Global commission percentage for all marketplace transactions', 10, '2026-02-08 07:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `authID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `authCode` varchar(20) NOT NULL,
  `authTocken` varchar(500) NOT NULL,
  `authStatus` tinyint(1) NOT NULL COMMENT '1=approved\r\n0=No Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`authID`, `userID`, `authCode`, `authTocken`, `authStatus`) VALUES
(1, 1, '4538', 'fRq59I2k', 1),
(2, 2, '3546', 'QljYHLTE', 1),
(4, 4, '9679', 'TkpN8fVj', 0),
(5, 5, '2637', 'DKdqycs5', 0),
(6, 6, '3167', 'e0np3Zds', 0),
(7, 7, '9373', 'LeBAoft5', 0),
(8, 8, '1993', 'cSvTpojm', 0),
(9, 9, '7211', 'ce2TEAtI', 1),
(10, 10, '6205', 'comWG3f5', 0),
(11, 11, '1616', 'ZRPNJeV6', 0),
(12, 12, '4815', 'tXaB0Ry7', 0),
(13, 13, '3701', 'cq2PjIaL', 0),
(14, 14, '5769', 'GlVpmPOf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usercompanyworkforcelink`
--

CREATE TABLE `usercompanyworkforcelink` (
  `userCompanyWorkforceLinkID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `workforceID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercompanyworkforcelink`
--

INSERT INTO `usercompanyworkforcelink` (`userCompanyWorkforceLinkID`, `companyID`, `workforceID`, `userID`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 5),
(3, 1, 3, 6),
(4, 1, 4, 7),
(5, 1, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userPass` varchar(500) DEFAULT NULL,
  `userType` tinyint(1) NOT NULL COMMENT '1=SuperAdmin\r\n2=Company admin\r\n3=Company manager\r\n4=company employee\r\n5=General User',
  `userStatus` tinyint(1) NOT NULL COMMENT '1=active\r\n2=pending Auth\r\n0=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPhone`, `userEmail`, `userPass`, `userType`, `userStatus`) VALUES
(1, 'Company Admin', '03186205466', 'revotahir@gmail.com', '9f0a4484b933134d03e1c35ae9fb90b6', 2, 1),
(2, 'Company Admin', '030000022', '6xperts@gmail.com', '9f0a4484b933134d03e1c35ae9fb90b6', 2, 1),
(4, 'Person 1', '1232', 'creative.sol8264@gmail.com', NULL, 4, 2),
(5, 'person 3', '3423', 'revotahir@gmail.com', NULL, 4, 2),
(6, 'person 99', '2342', 'revotahir@gmail.com', NULL, 4, 2),
(7, 'person 994', '3443', 'creative.sol8264@gmail.c', NULL, 4, 2),
(8, 'per 5', '32323', 'per@gmail.com', NULL, 4, 2),
(9, 'tahir', '0300222112', 'fastimigration01@gmail.com', '86e916352d024f292f6ff0ae210acdfe', 2, 1),
(10, 'test', '03000000000', 'lumixedgeseo@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 1, 1),
(11, 'ali', '123456', 'muhammadali@gmail.com', 'fa377a1337126da4e11ee722242c7ba9', 4, 2),
(12, 'Muhammad Ali ', '123456', 'muhammadalizahid0621@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 4, 2),
(13, 'company123', '03326876256', 'muhammadalizahid@gmail.com', '4297f44b13955235245b2497399d7a93', 2, 2),
(14, 'Muhammad Ali ', '123456', 'muhammadalizahid01@gmail.com', 'fa377a1337126da4e11ee722242c7ba9', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_blogs`
--

CREATE TABLE `web_blogs` (
  `web_blogID` int(11) NOT NULL,
  `pageID` int(11) NOT NULL,
  `web_blogImg` varchar(300) NOT NULL,
  `blogCatID` int(11) NOT NULL,
  `web_blogDate` varchar(30) NOT NULL,
  `web_blogTitle` varchar(300) NOT NULL,
  `web_blogDesp` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_blogs`
--

INSERT INTO `web_blogs` (`web_blogID`, `pageID`, `web_blogImg`, `blogCatID`, `web_blogDate`, `web_blogTitle`, `web_blogDesp`) VALUES
(6, 9, '5d3941770f26300df2d786ea848e6689.png', 1, '2025-11-26', 'asdfasaa', '<p>sfafsfa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `web_blog_cat`
--

CREATE TABLE `web_blog_cat` (
  `blogCatID` int(11) NOT NULL,
  `pageID` int(11) NOT NULL,
  `blogCat` varchar(200) NOT NULL,
  `blogCatDesc` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_blog_cat`
--

INSERT INTO `web_blog_cat` (`blogCatID`, `pageID`, `blogCat`, `blogCatDesc`) VALUES
(1, 4, 'Plumbin Hack', 'aassdfasdfa'),
(3, 7, 'Willa Flowerss', 'Excepturi vitae recu');

-- --------------------------------------------------------

--
-- Table structure for table `web_cat`
--

CREATE TABLE `web_cat` (
  `web_catID` int(11) NOT NULL,
  `pageID` int(11) NOT NULL,
  `web_catIcon` varchar(300) NOT NULL,
  `web_catName` varchar(30) NOT NULL,
  `web_catDesp` varchar(2000) NOT NULL,
  `web_cat_type` tinyint(1) NOT NULL COMMENT '1=equipment 2=workforce'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_cat`
--

INSERT INTO `web_cat` (`web_catID`, `pageID`, `web_catIcon`, `web_catName`, `web_catDesp`, `web_cat_type`) VALUES
(5, 10, '4c73c3db9d7cf2def6a9ccb016448623.svg', 'Skilled Technicians', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 2),
(6, 11, '6738c55b20339448317ae52272836e40.svg', 'Construction Equipment', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 1),
(7, 12, '42e12c7b2a66a5ed293f173de9a7e6bd.svg', 'Electrical Installers', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 2),
(8, 13, 'de0544ccbc4a8be3835c5ea351b7dacb.svg', 'Skilled Technicians', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 2),
(9, 14, '3a745a47fe1543fecde65d9a9f2b4295.svg', 'Plumbing Equipment', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_company`
--

CREATE TABLE `web_company` (
  `web_companyID` int(11) NOT NULL,
  `web_companyIcon` varchar(300) NOT NULL,
  `web_companyStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 1=Active and 0=Deactive '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_company`
--

INSERT INTO `web_company` (`web_companyID`, `web_companyIcon`, `web_companyStatus`) VALUES
(2, '03eb1f186896c190736ab06dfbf582df.svg', 1),
(3, 'ad9358d1abcc07bb9603eaf3849cd088.svg', 1),
(4, '45b1d18d044bba9163625fb0077c6d46.svg', 1),
(5, '08ac83eb73a3c43f9a27d37b79c463f4.svg', 1),
(6, '8eefe305b601673edf4b9860d5da423a.svg', 1),
(7, 'b73c7825e2f30a2c1b4e33996519486f.svg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_contact_form`
--

CREATE TABLE `web_contact_form` (
  `contactID` int(11) NOT NULL,
  `contactName` varchar(200) NOT NULL,
  `contactEmail` varchar(200) NOT NULL,
  `contactSubject` varchar(500) NOT NULL,
  `contactMsg` varchar(1200) NOT NULL,
  `contactDate` datetime NOT NULL DEFAULT current_timestamp(),
  `contactStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=new 2=reponded'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `web_contact_form`
--

INSERT INTO `web_contact_form` (`contactID`, `contactName`, `contactEmail`, `contactSubject`, `contactMsg`, `contactDate`, `contactStatus`) VALUES
(1, 'Tahir Iqbal', 'revotahir@gmail.com', 'asdf', 'asdfas', '2026-01-27 19:20:38', 2),
(2, 'Kip and Tricks', 'revotahir@gmail.com', 'asdas', 'aaaa', '2026-01-27 22:54:32', 1),
(3, 'Tobias', 'test@tobias.com', 'EM Tracking', 'I want to buy.....', '2026-02-02 20:41:22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `web_pages`
--

CREATE TABLE `web_pages` (
  `pageID` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `pageType` tinyint(1) NOT NULL COMMENT '1= Utality, 2= catory or product list 3= product detail\r\n4= blog list 5= blog detail',
  `pageStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active 0= 404'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_pages`
--

INSERT INTO `web_pages` (`pageID`, `slug`, `pageType`, `pageStatus`) VALUES
(3, 'plubmber', 2, 1),
(4, 'plumbin-hack', 4, 1),
(7, 'willa-flowers', 4, 1),
(9, 'asdfas', 5, 1),
(10, 'skilled-technicians', 2, 1),
(11, 'construction-equipment', 2, 1),
(12, 'electrical-installers', 2, 1),
(13, 'skilled-technicians', 2, 0),
(14, 'construction-equipment', 2, 1),
(15, '', 1, 1),
(16, 'about-us', 1, 1),
(17, 'contact-us', 1, 1),
(18, 'how-it-works', 1, 1),
(19, 'features', 1, 1),
(20, 'marketplace', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_page_meta`
--

CREATE TABLE `web_page_meta` (
  `metaID` int(11) NOT NULL,
  `pageID` int(11) NOT NULL,
  `metaTittle` varchar(500) DEFAULT NULL,
  `metaKeywords` varchar(500) DEFAULT NULL,
  `metaDesc` varchar(2500) DEFAULT NULL,
  `h1` varchar(500) DEFAULT NULL,
  `h2` varchar(500) DEFAULT NULL,
  `p1` varchar(2500) DEFAULT NULL,
  `p2` varchar(2500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_page_meta`
--

INSERT INTO `web_page_meta` (`metaID`, `pageID`, `metaTittle`, `metaKeywords`, `metaDesc`, `h1`, `h2`, `p1`, `p2`) VALUES
(2, 3, 'Plubmber | equipmanager.dk ', 'a,b,c,d,ff', 'aaa', 'h111 ', 'h222 ', 'hd111 ', 'hd222 '),
(3, 4, 'Plumbin Hack | equipmanager.dk', 'asdfas,asda,as', 'test descritpion', 'he', 'hr', 'pe', 'ps'),
(6, 7, 'Quia modi eos possim', 'Quidem dolore eu ill', 'Duis ea obcaecati quuuuuuu', 'Accusantium consequa', 'Ad voluptatem Molli', 'Irure iusto nemo rep', 'Excepteur excepturi '),
(8, 9, 'asdfas | equipmanager.dk', 'asfa,rdgdf,dfgdf', 'asfasaaaaaa', NULL, NULL, NULL, NULL),
(9, 10, 'Skilled Technicians | equipmanager.dk', 'test,sdfas,asdas', 'test', '', '', '', ''),
(10, 11, 'Construction Equipment | equipmanager.dk', '', '', '', '', '', ''),
(11, 12, 'Electrical Installers | equipmanager.dk', '', '', '', '', '', ''),
(12, 13, 'Skilled Technicians | equipmanager.dk', '', '', '', '', '', ''),
(13, 14, 'Construction Equipment | equipmanager.dk', '', '', '', '', '', ''),
(14, 15, 'Home | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL),
(15, 16, 'About Us | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL),
(16, 17, 'Contact Us | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL),
(17, 18, 'How it Works | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL),
(18, 19, 'Features | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL),
(19, 20, 'Marketplace | equipmanager.dk', 'test', 'test dewsc', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_setting`
--

CREATE TABLE `web_setting` (
  `settingID` tinyint(1) NOT NULL,
  `websiteStatus` tinyint(1) DEFAULT 1 COMMENT '1= live 2 = coming soon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_setting`
--

INSERT INTO `web_setting` (`settingID`, `websiteStatus`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_success`
--

CREATE TABLE `web_success` (
  `web_successID` int(11) NOT NULL,
  `web_successIcon` varchar(300) NOT NULL,
  `web_successName` varchar(30) NOT NULL,
  `web_successDes` varchar(2000) NOT NULL,
  `web_successStatus` tinyint(1) NOT NULL COMMENT '1=Active and 0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_success`
--

INSERT INTO `web_success` (`web_successID`, `web_successIcon`, `web_successName`, `web_successDes`, `web_successStatus`) VALUES
(2, 'dce9cb23e16eb506b6d8b6822a7b699b.svg', 'Listed Tools', '200+', 1),
(3, 'cacc5055d99e0ee14f4dd3595feafaa4.svg', 'Active Companies', '10+', 1),
(4, '62f8e33eb5c5987fa0246445ea267c22.svg', 'Workforce Members', '500+', 1),
(5, 'b9e0a6c02889efbbf8a08d62b278092d.svg', 'Average Rating', '4.9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_testimonial`
--

CREATE TABLE `web_testimonial` (
  `web_testimonialID` int(11) NOT NULL,
  `web_testimonialRating` varchar(10) NOT NULL,
  `web_testimonialDesp` varchar(500) NOT NULL,
  `web_testimonialImg` varchar(300) NOT NULL,
  `web_testimonialName` varchar(30) NOT NULL,
  `web_testimonialLocation` varchar(30) NOT NULL,
  `web_testimonialStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active and 0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_testimonial`
--

INSERT INTO `web_testimonial` (`web_testimonialID`, `web_testimonialRating`, `web_testimonialDesp`, `web_testimonialImg`, `web_testimonialName`, `web_testimonialLocation`, `web_testimonialStatus`) VALUES
(2, '5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.', 'c34f957ab271b9013f68715da336ad18.png', 'Alex', 'USA', 1),
(3, '5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.', 'ecab3c296b41f1c7b62637131cc6a00a.png', 'Sam', 'California', 1),
(4, '5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.', 'ecab3c296b41f1c7b62637131cc6a00a.png', 'Anthony', 'Germany', 1),
(5, '5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.', 'ecab3c296b41f1c7b62637131cc6a00a.png', 'Parteek', 'UAE', 1),
(6, '5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.', 'ecab3c296b41f1c7b62637131cc6a00a.png', 'Alex', 'Dubai', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workforce`
--

CREATE TABLE `workforce` (
  `workforceID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `personName` varchar(150) NOT NULL,
  `personPhone` varchar(20) NOT NULL,
  `personEmail` varchar(150) NOT NULL,
  `personImg` varchar(500) DEFAULT NULL,
  `personAddInfo` varchar(1200) NOT NULL,
  `personStatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Free 2= inuse '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workforce`
--

INSERT INTO `workforce` (`workforceID`, `companyID`, `personName`, `personPhone`, `personEmail`, `personImg`, `personAddInfo`, `personStatus`) VALUES
(1, 1, 'Asad', '1232', 'creative.sol8264@gmail.com', '2774e66d6df7a50c7d8f40938c6d8ae7.png', 'sdfsdfsd', 2),
(2, 1, 'Atif', '3423', 'revotahir@gmail.com', 'images.png', 'sdfsd', 1),
(3, 1, 'Tayyab', '2342', 'revotahir@gmail.c', 'images.png', 'sfdh', 2),
(4, 1, 'JB', '3443', 'creative.sol8264@gmail.c', '3625e21ed7b48855b4c5a9d4b1768401.png', 'gjg', 2),
(5, 1, 'Faisal', '32323', 'per@gmail.com', 'images.png', 'sdfsd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `workforceskilllink`
--

CREATE TABLE `workforceskilllink` (
  `workforceSkillLinkID` int(11) NOT NULL,
  `skillID` int(11) NOT NULL,
  `workforceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workforceskilllink`
--

INSERT INTO `workforceskilllink` (`workforceSkillLinkID`, `skillID`, `workforceID`) VALUES
(4, 6, 2),
(5, 2, 2),
(20, 11, 3),
(21, 17, 4),
(22, 19, 1),
(23, 18, 1),
(24, 17, 1),
(25, 11, 1),
(26, 6, 1),
(27, 19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `workforce_payments`
--

CREATE TABLE `workforce_payments` (
  `workforcePaymentID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL COMMENT 'FK to shopitem',
  `workforceID` int(11) NOT NULL COMMENT 'FK to workforce',
  `buyerUserID` int(11) NOT NULL COMMENT 'FK to users',
  `sellerCompanyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  `stripeSessionID` varchar(255) DEFAULT NULL,
  `stripePaymentIntentID` varchar(255) DEFAULT NULL,
  `grossAmount` decimal(10,2) NOT NULL COMMENT 'Total amount paid by customer',
  `commissionPercent` decimal(5,2) NOT NULL COMMENT 'Commission % at time of payment',
  `commissionAmount` decimal(10,2) NOT NULL COMMENT 'Calculated commission',
  `netAmount` decimal(10,2) NOT NULL COMMENT 'Amount to company after commission',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `rentalStartDate` date NOT NULL,
  `rentalEndDate` date NOT NULL,
  `rentalType` enum('daily','weekly','monthly','yearly') NOT NULL,
  `paymentStatus` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `paymentMetadata` text DEFAULT NULL COMMENT 'JSON metadata',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workforce_payments`
--

INSERT INTO `workforce_payments` (`workforcePaymentID`, `itemID`, `workforceID`, `buyerUserID`, `sellerCompanyID`, `stripeSessionID`, `stripePaymentIntentID`, `grossAmount`, `commissionPercent`, `commissionAmount`, `netAmount`, `currency`, `rentalStartDate`, `rentalEndDate`, `rentalType`, `paymentStatus`, `paymentMetadata`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, 11, 1, NULL, 'pi_3Sy8DERvTgzTht4w0iJ5ATas', 648.00, 5.00, 32.40, 615.60, 'USD', '2026-01-01', '2026-01-03', 'daily', 'pending', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-07 09:54:01', '2026-02-07 09:54:01'),
(2, 1, 1, 11, 1, NULL, 'pi_3Sy8LKRvTgzTht4w04K0kg6m', 1944.00, 5.00, 97.20, 1846.80, 'USD', '2026-01-01', '2026-01-07', 'daily', 'pending', '{\"delivery_method\":1,\"customer_email\":\"muhammadalizahid0621@gmail.com\",\"customer_phone\":\"+923326876256\",\"delivery_name\":\"\",\"delivery_street\":\"\",\"delivery_city\":\"\",\"delivery_postal\":\"\",\"delivery_country\":\"\",\"delivery_notes\":\"\"}', '2026-02-07 10:02:23', '2026-02-07 10:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `workforce_payouts`
--

CREATE TABLE `workforce_payouts` (
  `workforcePayoutID` int(11) NOT NULL,
  `workforcePaymentID` int(11) NOT NULL COMMENT 'FK to workforce_payments',
  `companyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  `payoutAmount` decimal(10,2) NOT NULL COMMENT 'Net amount to be paid out',
  `payoutStatus` enum('pending','approved','released','rejected') NOT NULL DEFAULT 'pending',
  `approvedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `approvedAt` timestamp NULL DEFAULT NULL,
  `payoutNotes` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companydetail`
--
ALTER TABLE `companydetail`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `equipcat`
--
ALTER TABLE `equipcat`
  ADD PRIMARY KEY (`equipCatID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipmentID`);

--
-- Indexes for table `equipment_payments`
--
ALTER TABLE `equipment_payments`
  ADD PRIMARY KEY (`equipmentPaymentID`),
  ADD UNIQUE KEY `unique_stripe_session` (`stripeSessionID`),
  ADD KEY `idx_buyer` (`buyerUserID`),
  ADD KEY `idx_seller` (`sellerCompanyID`),
  ADD KEY `idx_item` (`itemID`),
  ADD KEY `idx_equipment` (`equipmentID`),
  ADD KEY `idx_payment_status` (`paymentStatus`),
  ADD KEY `idx_created` (`createdAt`);

--
-- Indexes for table `equipment_payouts`
--
ALTER TABLE `equipment_payouts`
  ADD PRIMARY KEY (`equipmentPayoutID`),
  ADD UNIQUE KEY `unique_payment_payout` (`equipmentPaymentID`),
  ADD KEY `idx_company` (`companyID`),
  ADD KEY `idx_status` (`payoutStatus`);

--
-- Indexes for table `projectcategory`
--
ALTER TABLE `projectcategory`
  ADD PRIMARY KEY (`pCatID`);

--
-- Indexes for table `projectequipmentassign`
--
ALTER TABLE `projectequipmentassign`
  ADD PRIMARY KEY (`assignID`);

--
-- Indexes for table `projectequipmentlink`
--
ALTER TABLE `projectequipmentlink`
  ADD PRIMARY KEY (`projectequipmentLinkID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Indexes for table `projectworkforcelink`
--
ALTER TABLE `projectworkforcelink`
  ADD PRIMARY KEY (`projectWorkforceLinkID`);

--
-- Indexes for table `shopequipments`
--
ALTER TABLE `shopequipments`
  ADD PRIMARY KEY (`shopEqpID`);

--
-- Indexes for table `shopitem`
--
ALTER TABLE `shopitem`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `shopworkforce`
--
ALTER TABLE `shopworkforce`
  ADD PRIMARY KEY (`shopWorkforceID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skillID`);

--
-- Indexes for table `supportticketchat`
--
ALTER TABLE `supportticketchat`
  ADD PRIMARY KEY (`chatID`);

--
-- Indexes for table `supporttickets`
--
ALTER TABLE `supporttickets`
  ADD PRIMARY KEY (`supportTicketID`);

--
-- Indexes for table `supportticketscat`
--
ALTER TABLE `supportticketscat`
  ADD PRIMARY KEY (`supportTicketsCatID`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`settingID`),
  ADD UNIQUE KEY `unique_setting_key` (`settingKey`);

--
-- Indexes for table `userauth`
--
ALTER TABLE `userauth`
  ADD PRIMARY KEY (`authID`);

--
-- Indexes for table `usercompanyworkforcelink`
--
ALTER TABLE `usercompanyworkforcelink`
  ADD PRIMARY KEY (`userCompanyWorkforceLinkID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `web_blogs`
--
ALTER TABLE `web_blogs`
  ADD PRIMARY KEY (`web_blogID`);

--
-- Indexes for table `web_blog_cat`
--
ALTER TABLE `web_blog_cat`
  ADD PRIMARY KEY (`blogCatID`);

--
-- Indexes for table `web_cat`
--
ALTER TABLE `web_cat`
  ADD PRIMARY KEY (`web_catID`);

--
-- Indexes for table `web_company`
--
ALTER TABLE `web_company`
  ADD PRIMARY KEY (`web_companyID`);

--
-- Indexes for table `web_contact_form`
--
ALTER TABLE `web_contact_form`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `web_pages`
--
ALTER TABLE `web_pages`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexes for table `web_page_meta`
--
ALTER TABLE `web_page_meta`
  ADD PRIMARY KEY (`metaID`);

--
-- Indexes for table `web_setting`
--
ALTER TABLE `web_setting`
  ADD PRIMARY KEY (`settingID`);

--
-- Indexes for table `web_success`
--
ALTER TABLE `web_success`
  ADD PRIMARY KEY (`web_successID`);

--
-- Indexes for table `web_testimonial`
--
ALTER TABLE `web_testimonial`
  ADD PRIMARY KEY (`web_testimonialID`);

--
-- Indexes for table `workforce`
--
ALTER TABLE `workforce`
  ADD PRIMARY KEY (`workforceID`);

--
-- Indexes for table `workforceskilllink`
--
ALTER TABLE `workforceskilllink`
  ADD PRIMARY KEY (`workforceSkillLinkID`);

--
-- Indexes for table `workforce_payments`
--
ALTER TABLE `workforce_payments`
  ADD PRIMARY KEY (`workforcePaymentID`),
  ADD UNIQUE KEY `unique_stripe_session` (`stripeSessionID`),
  ADD KEY `idx_buyer` (`buyerUserID`),
  ADD KEY `idx_seller` (`sellerCompanyID`),
  ADD KEY `idx_item` (`itemID`),
  ADD KEY `idx_workforce` (`workforceID`),
  ADD KEY `idx_payment_status` (`paymentStatus`),
  ADD KEY `idx_created` (`createdAt`);

--
-- Indexes for table `workforce_payouts`
--
ALTER TABLE `workforce_payouts`
  ADD PRIMARY KEY (`workforcePayoutID`),
  ADD UNIQUE KEY `unique_payment_payout` (`workforcePaymentID`),
  ADD KEY `idx_company` (`companyID`),
  ADD KEY `idx_status` (`payoutStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companydetail`
--
ALTER TABLE `companydetail`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipcat`
--
ALTER TABLE `equipcat`
  MODIFY `equipCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipment_payments`
--
ALTER TABLE `equipment_payments`
  MODIFY `equipmentPaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `equipment_payouts`
--
ALTER TABLE `equipment_payouts`
  MODIFY `equipmentPayoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projectcategory`
--
ALTER TABLE `projectcategory`
  MODIFY `pCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projectequipmentassign`
--
ALTER TABLE `projectequipmentassign`
  MODIFY `assignID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectequipmentlink`
--
ALTER TABLE `projectequipmentlink`
  MODIFY `projectequipmentLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projectworkforcelink`
--
ALTER TABLE `projectworkforcelink`
  MODIFY `projectWorkforceLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shopequipments`
--
ALTER TABLE `shopequipments`
  MODIFY `shopEqpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shopitem`
--
ALTER TABLE `shopitem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopworkforce`
--
ALTER TABLE `shopworkforce`
  MODIFY `shopWorkforceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supportticketchat`
--
ALTER TABLE `supportticketchat`
  MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `supporttickets`
--
ALTER TABLE `supporttickets`
  MODIFY `supportTicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supportticketscat`
--
ALTER TABLE `supportticketscat`
  MODIFY `supportTicketsCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `settingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userauth`
--
ALTER TABLE `userauth`
  MODIFY `authID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usercompanyworkforcelink`
--
ALTER TABLE `usercompanyworkforcelink`
  MODIFY `userCompanyWorkforceLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `web_blogs`
--
ALTER TABLE `web_blogs`
  MODIFY `web_blogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `web_blog_cat`
--
ALTER TABLE `web_blog_cat`
  MODIFY `blogCatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_cat`
--
ALTER TABLE `web_cat`
  MODIFY `web_catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `web_company`
--
ALTER TABLE `web_company`
  MODIFY `web_companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `web_contact_form`
--
ALTER TABLE `web_contact_form`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_pages`
--
ALTER TABLE `web_pages`
  MODIFY `pageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `web_page_meta`
--
ALTER TABLE `web_page_meta`
  MODIFY `metaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `settingID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_success`
--
ALTER TABLE `web_success`
  MODIFY `web_successID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `web_testimonial`
--
ALTER TABLE `web_testimonial`
  MODIFY `web_testimonialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workforce`
--
ALTER TABLE `workforce`
  MODIFY `workforceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workforceskilllink`
--
ALTER TABLE `workforceskilllink`
  MODIFY `workforceSkillLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `workforce_payments`
--
ALTER TABLE `workforce_payments`
  MODIFY `workforcePaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workforce_payouts`
--
ALTER TABLE `workforce_payouts`
  MODIFY `workforcePayoutID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_payments`
--
ALTER TABLE `equipment_payments`
  ADD CONSTRAINT `fk_equip_pay_buyer` FOREIGN KEY (`buyerUserID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `fk_equip_pay_equipment` FOREIGN KEY (`equipmentID`) REFERENCES `equipment` (`equipmentID`),
  ADD CONSTRAINT `fk_equip_pay_item` FOREIGN KEY (`itemID`) REFERENCES `shopitem` (`itemID`),
  ADD CONSTRAINT `fk_equip_pay_seller` FOREIGN KEY (`sellerCompanyID`) REFERENCES `companydetail` (`companyID`);

--
-- Constraints for table `equipment_payouts`
--
ALTER TABLE `equipment_payouts`
  ADD CONSTRAINT `fk_equip_payout_company` FOREIGN KEY (`companyID`) REFERENCES `companydetail` (`companyID`),
  ADD CONSTRAINT `fk_equip_payout_payment` FOREIGN KEY (`equipmentPaymentID`) REFERENCES `equipment_payments` (`equipmentPaymentID`) ON DELETE CASCADE;

--
-- Constraints for table `workforce_payments`
--
ALTER TABLE `workforce_payments`
  ADD CONSTRAINT `fk_work_pay_buyer` FOREIGN KEY (`buyerUserID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `fk_work_pay_item` FOREIGN KEY (`itemID`) REFERENCES `shopitem` (`itemID`),
  ADD CONSTRAINT `fk_work_pay_seller` FOREIGN KEY (`sellerCompanyID`) REFERENCES `companydetail` (`companyID`),
  ADD CONSTRAINT `fk_work_pay_workforce` FOREIGN KEY (`workforceID`) REFERENCES `workforce` (`workforceID`);

--
-- Constraints for table `workforce_payouts`
--
ALTER TABLE `workforce_payouts`
  ADD CONSTRAINT `fk_work_payout_company` FOREIGN KEY (`companyID`) REFERENCES `companydetail` (`companyID`),
  ADD CONSTRAINT `fk_work_payout_payment` FOREIGN KEY (`workforcePaymentID`) REFERENCES `workforce_payments` (`workforcePaymentID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
