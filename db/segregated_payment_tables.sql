-- =============================================
-- Segregated Payment Tables Migration
-- Version: 2.0
-- Date: 2026-02-05
-- =============================================
-- This script drops the old unified payment tables
-- and creates new segregated tables for equipment
-- and workforce payments with global commission.
-- =============================================

-- =============================================
-- STEP 1: Drop Old Tables
-- =============================================

DROP TABLE IF EXISTS `item_commissions`;
DROP TABLE IF EXISTS `payouts`;
DROP TABLE IF EXISTS `commissions`;
DROP TABLE IF EXISTS `payments`;

-- =============================================
-- STEP 2: Create System Settings Table
-- =============================================

CREATE TABLE IF NOT EXISTS `system_settings` (
  `settingID` int(11) NOT NULL AUTO_INCREMENT,
  `settingKey` varchar(100) NOT NULL,
  `settingValue` text NOT NULL,
  `settingType` enum('string','number','boolean','json') NOT NULL DEFAULT 'string',
  `description` text DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`settingID`),
  UNIQUE KEY `unique_setting_key` (`settingKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert default commission rate
INSERT INTO `system_settings` (`settingKey`, `settingValue`, `settingType`, `description`) 
VALUES ('marketplace_commission_percent', '5.00', 'number', 'Global commission percentage for all marketplace transactions')
ON DUPLICATE KEY UPDATE settingValue = settingValue;

-- =============================================
-- STEP 3: Create Equipment Payment Tables
-- =============================================

CREATE TABLE `equipment_payments` (
  `equipmentPaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL COMMENT 'FK to shopitem',
  `equipmentID` int(11) NOT NULL COMMENT 'FK to equipment',
  `buyerUserID` int(11) NOT NULL COMMENT 'FK to users',
  `sellerCompanyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  
  -- Stripe Integration
  `stripeSessionID` varchar(255) DEFAULT NULL,
  `stripePaymentIntentID` varchar(255) DEFAULT NULL,
  
  -- Payment Details
  `grossAmount` decimal(10,2) NOT NULL COMMENT 'Total amount paid by customer',
  `commissionPercent` decimal(5,2) NOT NULL COMMENT 'Commission % at time of payment',
  `commissionAmount` decimal(10,2) NOT NULL COMMENT 'Calculated commission',
  `netAmount` decimal(10,2) NOT NULL COMMENT 'Amount to company after commission',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  
  -- Equipment-Specific
  `quantity` int(11) NOT NULL DEFAULT 1,
  `saleType` enum('rental','purchase') NOT NULL,
  `rentalStartDate` date DEFAULT NULL,
  `rentalEndDate` date DEFAULT NULL,
  `rentalType` enum('daily','weekly','monthly','yearly') DEFAULT NULL,
  
  -- Status
  `paymentStatus` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `paymentMetadata` text DEFAULT NULL COMMENT 'JSON metadata',
  
  -- Timestamps
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  PRIMARY KEY (`equipmentPaymentID`),
  UNIQUE KEY `unique_stripe_session` (`stripeSessionID`),
  KEY `idx_buyer` (`buyerUserID`),
  KEY `idx_seller` (`sellerCompanyID`),
  KEY `idx_item` (`itemID`),
  KEY `idx_equipment` (`equipmentID`),
  KEY `idx_payment_status` (`paymentStatus`),
  KEY `idx_created` (`createdAt`),
  
  CONSTRAINT `fk_equip_pay_buyer` FOREIGN KEY (`buyerUserID`) REFERENCES `users` (`userID`),
  CONSTRAINT `fk_equip_pay_seller` FOREIGN KEY (`sellerCompanyID`) REFERENCES `companydetail` (`companyID`),
  CONSTRAINT `fk_equip_pay_item` FOREIGN KEY (`itemID`) REFERENCES `shopitem` (`itemID`),
  CONSTRAINT `fk_equip_pay_equipment` FOREIGN KEY (`equipmentID`) REFERENCES `equipment` (`equipmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `equipment_payouts` (
  `equipmentPayoutID` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentPaymentID` int(11) NOT NULL COMMENT 'FK to equipment_payments',
  `companyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  
  -- Payout Details
  `payoutAmount` decimal(10,2) NOT NULL COMMENT 'Net amount to be paid out',
  `payoutStatus` enum('pending','approved','released','rejected') NOT NULL DEFAULT 'pending',
  
  -- Approval Tracking
  `approvedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `approvedAt` timestamp NULL DEFAULT NULL,
  `payoutNotes` text DEFAULT NULL,
  
  -- Timestamps
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  PRIMARY KEY (`equipmentPayoutID`),
  UNIQUE KEY `unique_payment_payout` (`equipmentPaymentID`),
  KEY `idx_company` (`companyID`),
  KEY `idx_status` (`payoutStatus`),
  
  CONSTRAINT `fk_equip_payout_payment` FOREIGN KEY (`equipmentPaymentID`) REFERENCES `equipment_payments` (`equipmentPaymentID`) ON DELETE CASCADE,
  CONSTRAINT `fk_equip_payout_company` FOREIGN KEY (`companyID`) REFERENCES `companydetail` (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =============================================
-- STEP 4: Create Workforce Payment Tables
-- =============================================

CREATE TABLE `workforce_payments` (
  `workforcePaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL COMMENT 'FK to shopitem',
  `workforceID` int(11) NOT NULL COMMENT 'FK to workforce',
  `buyerUserID` int(11) NOT NULL COMMENT 'FK to users',
  `sellerCompanyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  
  -- Stripe Integration
  `stripeSessionID` varchar(255) DEFAULT NULL,
  `stripePaymentIntentID` varchar(255) DEFAULT NULL,
  
  -- Payment Details
  `grossAmount` decimal(10,2) NOT NULL COMMENT 'Total amount paid by customer',
  `commissionPercent` decimal(5,2) NOT NULL COMMENT 'Commission % at time of payment',
  `commissionAmount` decimal(10,2) NOT NULL COMMENT 'Calculated commission',
  `netAmount` decimal(10,2) NOT NULL COMMENT 'Amount to company after commission',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  
  -- Workforce-Specific (always rental, quantity always 1)
  `rentalStartDate` date NOT NULL,
  `rentalEndDate` date NOT NULL,
  `rentalType` enum('daily','weekly','monthly','yearly') NOT NULL,
  
  -- Status
  `paymentStatus` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `paymentMetadata` text DEFAULT NULL COMMENT 'JSON metadata',
  
  -- Timestamps
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  PRIMARY KEY (`workforcePaymentID`),
  UNIQUE KEY `unique_stripe_session` (`stripeSessionID`),
  KEY `idx_buyer` (`buyerUserID`),
  KEY `idx_seller` (`sellerCompanyID`),
  KEY `idx_item` (`itemID`),
  KEY `idx_workforce` (`workforceID`),
  KEY `idx_payment_status` (`paymentStatus`),
  KEY `idx_created` (`createdAt`),
  
  CONSTRAINT `fk_work_pay_buyer` FOREIGN KEY (`buyerUserID`) REFERENCES `users` (`userID`),
  CONSTRAINT `fk_work_pay_seller` FOREIGN KEY (`sellerCompanyID`) REFERENCES `companydetail` (`companyID`),
  CONSTRAINT `fk_work_pay_item` FOREIGN KEY (`itemID`) REFERENCES `shopitem` (`itemID`),
  CONSTRAINT `fk_work_pay_workforce` FOREIGN KEY (`workforceID`) REFERENCES `workforce` (`workforceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `workforce_payouts` (
  `workforcePayoutID` int(11) NOT NULL AUTO_INCREMENT,
  `workforcePaymentID` int(11) NOT NULL COMMENT 'FK to workforce_payments',
  `companyID` int(11) NOT NULL COMMENT 'FK to companydetail',
  
  -- Payout Details
  `payoutAmount` decimal(10,2) NOT NULL COMMENT 'Net amount to be paid out',
  `payoutStatus` enum('pending','approved','released','rejected') NOT NULL DEFAULT 'pending',
  
  -- Approval Tracking
  `approvedBy` int(11) DEFAULT NULL COMMENT 'SuperAdmin userID',
  `approvedAt` timestamp NULL DEFAULT NULL,
  `payoutNotes` text DEFAULT NULL,
  
  -- Timestamps
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  PRIMARY KEY (`workforcePayoutID`),
  UNIQUE KEY `unique_payment_payout` (`workforcePaymentID`),
  KEY `idx_company` (`companyID`),
  KEY `idx_status` (`payoutStatus`),
  
  CONSTRAINT `fk_work_payout_payment` FOREIGN KEY (`workforcePaymentID`) REFERENCES `workforce_payments` (`workforcePaymentID`) ON DELETE CASCADE,
  CONSTRAINT `fk_work_payout_company` FOREIGN KEY (`companyID`) REFERENCES `companydetail` (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =============================================
-- STEP 5: Remove commission column from shopitem
-- (No longer needed since commission is global)
-- =============================================

ALTER TABLE `shopitem` DROP COLUMN IF EXISTS `commissionPercent`;

-- =============================================
-- Migration Complete
-- =============================================
