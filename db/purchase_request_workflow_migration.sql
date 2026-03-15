-- =====================================================
-- DATABASE MIGRATION: Purchase Request Approval Workflow
-- =====================================================
-- This adds approval tracking columns to equipment_payments table
-- to support the new purchase request approval workflow

-- Add approval-related columns to equipment_payments table
ALTER TABLE `equipment_payments`
ADD COLUMN `approvalStatus` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending' COMMENT 'Purchase request approval status' AFTER `paymentStatus`,
ADD COLUMN `approvedBy` INT(11) NULL DEFAULT NULL COMMENT 'Company admin userID who approved/rejected' AFTER `approvalStatus`,
ADD COLUMN `approvedAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When approval decision was made' AFTER `approvedBy`,
ADD COLUMN `approvalNotes` TEXT NULL DEFAULT NULL COMMENT 'Reason for rejection or approval notes' AFTER `approvedAt`;

-- Add index for faster approval status queries
ALTER TABLE `equipment_payments`
ADD INDEX `idx_approval_status` (`approvalStatus`),
ADD INDEX `idx_seller_approval` (`sellerCompanyID`, `approvalStatus`);

-- Add foreign key for approved by (optional, for referential integrity)
ALTER TABLE `equipment_payments`
ADD CONSTRAINT `fk_approved_by_user` 
FOREIGN KEY (`approvedBy`) REFERENCES `users` (`userID`) 
ON DELETE SET NULL ON UPDATE CASCADE;

-- =====================================================
-- WORKFLOW NOTES:
-- =====================================================
-- 1. When user creates purchase request:
--    - approvalStatus = 'pending'
--    - paymentStatus = 'pending'
--    - Chat opens immediately
--
-- 2. Company admin reviews and accepts:
--    - approvalStatus = 'approved'
--    - approvedBy = admin userID
--    - approvedAt = CURRENT_TIMESTAMP
--    - Payment proceeds
--
-- 3. Company admin rejects:
--    - approvalStatus = 'rejected'
--    - approvedBy = admin userID
--    - approvedAt = CURRENT_TIMESTAMP
--    - approvalNotes = rejection reason
--    - Payment blocked
--    - Chat remains available
--
-- 4. After successful payment (for approved orders):
--    - paymentStatus = 'completed'
--    - approvalStatus remains 'approved'
-- =====================================================
