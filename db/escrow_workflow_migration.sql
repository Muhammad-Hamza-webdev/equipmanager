-- =====================================================
-- DATABASE MIGRATION: Complete Escrow Sales Workflow
-- =====================================================
-- Implements full escrow-based purchase flow with buyer protection
-- Replaces the simple approval workflow with multi-stage tracking

-- Step 1: Drop old approval columns if they exist (from previous attempt)
ALTER TABLE `equipment_payments`
DROP COLUMN IF EXISTS `approvalStatus`,
DROP COLUMN IF EXISTS `approvedBy`,
DROP COLUMN IF EXISTS `approvedAt`,
DROP COLUMN IF EXISTS `approvalNotes`;

-- Step 2: Add complete workflow tracking columns
ALTER TABLE `equipment_payments`
ADD COLUMN `orderStatus` ENUM(
    'requested',      -- Buyer sent purchase request
    'approved',       -- Seller approved the request
    'rejected',       -- Seller rejected the request
    'payment_pending',-- Approval given, awaiting payment
    'payment_secured',-- Payment received, held in escrow
    'shipped',        -- Seller marked as shipped
    'delivered',      -- Buyer confirmed receipt
    'completed',      -- Funds released to seller
    'cancelled',      -- Order cancelled
    'refunded'        -- Payment refunded to buyer
) NOT NULL DEFAULT 'requested' COMMENT 'Current order status in escrow workflow' AFTER `paymentStatus`,

ADD COLUMN `approvedBy` INT(11) NULL DEFAULT NULL COMMENT 'Admin userID who approved/rejected request' AFTER `orderStatus`,
ADD COLUMN `approvedAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When seller approved/rejected' AFTER `approvedBy`,
ADD COLUMN `rejectionReason` TEXT NULL DEFAULT NULL COMMENT 'Why seller rejected the request' AFTER `approvedAt`,

ADD COLUMN `shippedBy` INT(11) NULL DEFAULT NULL COMMENT 'Admin userID who marked as shipped' AFTER `rejectionReason`,
ADD COLUMN `shippedAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When marked as shipped' AFTER `shippedBy`,
ADD COLUMN `trackingNumber` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Shipping tracking number' AFTER `shippedAt`,
ADD COLUMN `shippingNotes` TEXT NULL DEFAULT NULL COMMENT 'Seller shipping notes' AFTER `trackingNumber`,

ADD COLUMN `deliveredBy` INT(11) NULL DEFAULT NULL COMMENT 'Buyer userID who confirmed receipt' AFTER `shippingNotes`,
ADD COLUMN `deliveredAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When buyer confirmed receipt' AFTER `deliveredBy`,

ADD COLUMN `fundsReleasedAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When funds transferred to seller' AFTER `deliveredAt`,
ADD COLUMN `completedAt` TIMESTAMP NULL DEFAULT NULL COMMENT 'When transaction fully completed' AFTER `fundsReleasedAt`,

ADD COLUMN `checkoutToken` VARCHAR(64) NULL DEFAULT NULL COMMENT 'Unique token for checkout link' AFTER `completedAt`,
ADD COLUMN `checkoutTokenExpiry` TIMESTAMP NULL DEFAULT NULL COMMENT 'When checkout link expires' AFTER `checkoutToken`;

-- Step 3: Add indexes for performance
ALTER TABLE `equipment_payments`
ADD INDEX `idx_order_status` (`orderStatus`),
ADD INDEX `idx_seller_status` (`sellerCompanyID`, `orderStatus`),
ADD INDEX `idx_buyer_status` (`buyerUserID`, `orderStatus`),
ADD INDEX `idx_checkout_token` (`checkoutToken`);

-- Step 4: Add foreign key constraints
ALTER TABLE `equipment_payments`
ADD CONSTRAINT `fk_approved_by_user` 
    FOREIGN KEY (`approvedBy`) REFERENCES `users` (`userID`) 
    ON DELETE SET NULL ON UPDATE CASCADE,
    
ADD CONSTRAINT `fk_shipped_by_user` 
    FOREIGN KEY (`shippedBy`) REFERENCES `users` (`userID`) 
    ON DELETE SET NULL ON UPDATE CASCADE,
    
ADD CONSTRAINT `fk_delivered_by_user` 
    FOREIGN KEY (`deliveredBy`) REFERENCES `users` (`userID`) 
    ON DELETE SET NULL ON UPDATE CASCADE;

-- =====================================================
-- ESCROW WORKFLOW DOCUMENTATION
-- =====================================================
-- 
-- STEP 1: BUYER SENDS REQUEST
-- --------------------------
-- - Buyer clicks "Send Purchase Request" on equipment detail page
-- - System creates equipment_payments record:
--   * orderStatus = 'requested'
--   * paymentStatus = 'pending'
--   * No Stripe payment intent created yet
-- - Chat opens immediately between buyer and seller
-- - Buyer receives confirmation toastr message
-- 
-- STEP 2: SELLER REVIEWS & APPROVES/REJECTS
-- ------------------------------------------
-- - Seller sees request in company-orders dashboard
-- - Seller can:
--   a) APPROVE:
--      * orderStatus = 'approved' → 'payment_pending'
--      * approvedBy = seller admin userID
--      * approvedAt = CURRENT_TIMESTAMP
--      * Generate unique checkoutToken (SHA256)
--      * Set checkoutTokenExpiry = NOW() + 7 days
--      * Send checkout link via automated chat message
--   
--   b) REJECT:
--      * orderStatus = 'rejected'
--      * rejectionReason = seller's notes
--      * Chat remains open, no checkout link
-- 
-- STEP 3: BUYER COMPLETES PAYMENT (ESCROW)
-- -----------------------------------------
-- - Buyer clicks checkout link from chat
-- - System verifies:
--   * checkoutToken is valid
--   * checkoutTokenExpiry not passed
--   * orderStatus = 'payment_pending'
-- - Buyer completes Stripe payment
-- - Money held by EquipManager (NOT transferred to seller yet)
-- - System updates:
--   * orderStatus = 'payment_secured'
--   * paymentStatus = 'completed'
-- - Seller notified via chat: "Payment received, please ship"
-- 
-- STEP 4: SELLER SHIPS PRODUCT
-- -----------------------------
-- - Seller goes to order details
-- - Clicks "Mark as Shipped" button
-- - Enters tracking number (optional)
-- - System updates:
--   * orderStatus = 'shipped'
--   * shippedBy = seller admin userID
--   * shippedAt = CURRENT_TIMESTAMP
--   * trackingNumber = entered value
-- - Buyer notified via chat: "Your order has been shipped"
-- 
-- STEP 5: BUYER CONFIRMS RECEIPT
-- -------------------------------
-- - Buyer checks order in "My Orders" dashboard
-- - Sees "Confirm Receipt" button (only if orderStatus = 'shipped')
-- - Clicks button to confirm delivery
-- - System updates:
--   * orderStatus = 'delivered'
--   * deliveredBy = buyer userID
--   * deliveredAt = CURRENT_TIMESTAMP
-- - Triggers automatic fund release
-- 
-- STEP 6: FUNDS RELEASED TO SELLER
-- ---------------------------------
-- - System automatically processes fund release
-- - Stripe transfer to seller's connected account
-- - System updates:
--   * orderStatus = 'completed'
--   * fundsReleasedAt = CURRENT_TIMESTAMP
--   * completedAt = CURRENT_TIMESTAMP
-- - Transaction complete
-- - Both parties notified
-- 
-- CANCELLATION & REFUNDS:
-- -----------------------
-- - Before payment: Either party can cancel (orderStatus = 'cancelled')
-- - After payment, before shipping: Buyer can request cancellation
--   * Requires seller approval
--   * Full refund if approved
-- - After shipping: Return/refund handled through support tickets
-- - Disputed orders: Admin intervention required
-- 
-- AUTOMATIC DELIVERY CONFIRMATION:
-- --------------------------------
-- - If buyer doesn't confirm receipt within 3 days of shipment
-- - System automatically marks as delivered
-- - Funds released to seller
-- - Protects sellers from non-responsive buyers
-- 
-- =====================================================
