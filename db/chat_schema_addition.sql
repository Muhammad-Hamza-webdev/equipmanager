--These tables have been added inside the database to support the new order chat feature.

CREATE TABLE order_chats (
  chatID INT AUTO_INCREMENT PRIMARY KEY,
  equipmentPaymentID INT NOT NULL COMMENT 'FK to equipment_payments',
  buyerUserID INT NOT NULL COMMENT 'FK to users',
  sellerCompanyID INT NOT NULL COMMENT 'FK to companydetail',
  chatStatus ENUM('open','locked') NOT NULL DEFAULT 'open',
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  lockedAt TIMESTAMP NULL,

  UNIQUE KEY uniq_order_chat (equipmentPaymentID)
);


CREATE TABLE order_chat_messages (
  messageID INT AUTO_INCREMENT PRIMARY KEY,
  chatID INT NOT NULL COMMENT 'FK to order_chats',
  senderUserID INT NOT NULL COMMENT 'FK to users',
  messageText VARCHAR(2500) NOT NULL,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  INDEX idx_chat_time (chatID, createdAt)
);
