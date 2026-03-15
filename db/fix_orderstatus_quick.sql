-- Quick fix to add orderStatus column if it doesn't exist
-- Run this in phpMyAdmin (http://localhost/phpmyadmin)

-- First, check if approvalStatus exists and drop it
SET @exist := (SELECT COUNT(*) 
               FROM information_schema.COLUMNS 
               WHERE TABLE_SCHEMA = 'equipmanager' 
               AND TABLE_NAME = 'equipment_payments' 
               AND COLUMN_NAME = 'approvalStatus');
SET @sqlstmt := IF(@exist > 0, 'ALTER TABLE equipment_payments DROP COLUMN approvalStatus', 'SELECT "approvalStatus does not exist"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

-- Now add orderStatus if it doesn't exist
SET @exist := (SELECT COUNT(*) 
               FROM information_schema.COLUMNS 
               WHERE TABLE_SCHEMA = 'equipmanager' 
               AND TABLE_NAME = 'equipment_payments' 
               AND COLUMN_NAME = 'orderStatus');
SET @sqlstmt := IF(@exist = 0, 
    'ALTER TABLE equipment_payments ADD COLUMN orderStatus ENUM("requested","approved","rejected","payment_pending","payment_secured","shipped","delivered","completed","cancelled","refunded") NOT NULL DEFAULT "requested" COMMENT "Current order status in escrow workflow" AFTER paymentStatus',
    'SELECT "orderStatus already exists"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

-- Add other escrow columns if they don't exist
SET @exist := (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'equipmanager' AND TABLE_NAME = 'equipment_payments' AND COLUMN_NAME = 'checkoutToken');
SET @sqlstmt := IF(@exist = 0, 
    'ALTER TABLE equipment_payments ADD COLUMN checkoutToken VARCHAR(64) NULL DEFAULT NULL COMMENT "Unique token for checkout link", ADD COLUMN checkoutTokenExpiry TIMESTAMP NULL DEFAULT NULL COMMENT "When checkout link expires"',
    'SELECT "checkoutToken already exists"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

-- Add rejection reason if it doesn't exist
SET @exist := (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'equipmanager' AND TABLE_NAME = 'equipment_payments' AND COLUMN_NAME = 'rejectionReason');
SET @sqlstmt := IF(@exist = 0, 
    'ALTER TABLE equipment_payments ADD COLUMN rejectionReason TEXT NULL DEFAULT NULL COMMENT "Why seller rejected the request" AFTER approvedAt',
    'SELECT "rejectionReason already exists"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

-- Add shipping columns if they don't exist
SET @exist := (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'equipmanager' AND TABLE_NAME = 'equipment_payments' AND COLUMN_NAME = 'trackingNumber');
SET @sqlstmt := IF(@exist = 0, 
    'ALTER TABLE equipment_payments ADD COLUMN shippedBy INT(11) NULL DEFAULT NULL COMMENT "Admin userID who marked as shipped", ADD COLUMN shippedAt TIMESTAMP NULL DEFAULT NULL COMMENT "When marked as shipped", ADD COLUMN trackingNumber VARCHAR(255) NULL DEFAULT NULL COMMENT "Shipping tracking number", ADD COLUMN shippingNotes TEXT NULL DEFAULT NULL COMMENT "Seller shipping notes"',
    'SELECT "trackingNumber already exists"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

-- Add delivery columns if they don't exist
SET @exist := (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'equipmanager' AND TABLE_NAME = 'equipment_payments' AND COLUMN_NAME = 'deliveredBy');
SET @sqlstmt := IF(@exist = 0, 
    'ALTER TABLE equipment_payments ADD COLUMN deliveredBy INT(11) NULL DEFAULT NULL COMMENT "Buyer userID who confirmed receipt", ADD COLUMN deliveredAt TIMESTAMP NULL DEFAULT NULL COMMENT "When buyer confirmed receipt", ADD COLUMN fundsReleasedAt TIMESTAMP NULL DEFAULT NULL COMMENT "When funds transferred to seller", ADD COLUMN completedAt TIMESTAMP NULL DEFAULT NULL COMMENT "When transaction fully completed"',
    'SELECT "deliveredBy already exists"');
PREPARE stmt FROM @sqlstmt;
EXECUTE stmt;

SELECT 'Migration completed successfully!' as Status;
