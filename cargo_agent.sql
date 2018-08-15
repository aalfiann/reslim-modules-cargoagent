SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for agent_config
-- ----------------------------
DROP TABLE IF EXISTS `agent_config`;
CREATE TABLE `agent_config` (
  `KeyID` varchar(50) NOT NULL,
  `Config` text,
  `Description` varchar(255) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Created_by` varchar(50) DEFAULT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`KeyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for agent_log_data
-- ----------------------------
DROP TABLE IF EXISTS `agent_log_data`;
CREATE TABLE `agent_log_data` (
  `ItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CodeID` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_sys` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ItemID`),
  KEY `StatusID` (`StatusID`),
  KEY `CodeID` (`CodeID`) USING BTREE,
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for agent_transaction_waybill
-- ----------------------------
DROP TABLE IF EXISTS `agent_transaction_waybill`;
CREATE TABLE `agent_transaction_waybill` (
  `Waybill` varchar(20) NOT NULL,
  `CustomerID` varchar(20) DEFAULT NULL,
  `Consignor_name` varchar(50) NOT NULL,
  `Consignor_alias` varchar(50) DEFAULT NULL,
  `Consignor_address` varchar(255) NOT NULL,
  `Consignor_phone` varchar(15) NOT NULL,
  `Consignor_fax` varchar(15) DEFAULT NULL,
  `Consignor_email` varchar(50) DEFAULT NULL,
  `ReferenceID` varchar(20) DEFAULT NULL,
  `Consignee_name` varchar(50) NOT NULL,
  `Consignee_attention` varchar(50) DEFAULT NULL,
  `Consignee_address` varchar(255) NOT NULL,
  `Consignee_phone` varchar(15) NOT NULL,
  `Consignee_fax` varchar(15) DEFAULT NULL,
  `Mode` varchar(50) NOT NULL,
  `Instruction` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Goods_data` varchar(1000) NOT NULL,
  `Goods_koli` decimal(5,0) NOT NULL,
  `Goods_value` decimal(10,0) NOT NULL,
  `Weight` decimal(7,2) NOT NULL,
  `Weight_real` decimal(7,2) NOT NULL,
  `Origin` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `Estimation` varchar(7) NOT NULL,
  `Insurance_rate` decimal(7,2) NOT NULL,
  `Shipping_cost` decimal(10,0) NOT NULL,
  `Shipping_insurance` decimal(10,0) NOT NULL,
  `Shipping_packing` decimal(10,0) NOT NULL,
  `Shipping_forward` decimal(10,0) NOT NULL,
  `Shipping_handling` decimal(10,0) NOT NULL,
  `Shipping_surcharge` decimal(10,0) NOT NULL,
  `Shipping_admin` decimal(10,0) NOT NULL,
  `Shipping_discount` decimal(10,0) NOT NULL,
  `Shipping_cost_total` decimal(10,0) NOT NULL,
  `Payment` varchar(50) NOT NULL,
  `Signature` varchar(50) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Created_by` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_sys` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Company_logo` varchar(255) DEFAULT NULL,
  `Company_name` varchar(50) DEFAULT NULL,
  `Company_address` varchar(255) DEFAULT NULL,
  `Company_phone` varchar(15) DEFAULT NULL,
  `Company_fax` varchar(15) DEFAULT NULL,
  `Company_email` varchar(50) DEFAULT NULL,
  `Company_TIN` varchar(50) DEFAULT NULL,
  `Recipient` varchar(50) DEFAULT NULL,
  `Relation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Waybill`),
  KEY `Waybill` (`Waybill`),
  KEY `CustomerID` (`CustomerID`),
  KEY `Consignor_name` (`Consignor_name`),
  KEY `Consignor_phone` (`Consignor_phone`),
  KEY `ReferenceID` (`ReferenceID`),
  KEY `Consignee_name` (`Consignee_name`),
  KEY `Consignee_phone` (`Consignee_phone`),
  KEY `Destination` (`Destination`),
  KEY `StatusID` (`StatusID`),
  KEY `Created_at` (`Created_at`),
  KEY `Created_by` (`Created_by`),
  KEY `Mode` (`Mode`),
  KEY `Payment` (`Payment`),
  KEY `Signature` (`Signature`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO core_status (StatusID, Status)
SELECT * FROM (SELECT '53', 'return') AS tmp
WHERE NOT EXISTS (
    SELECT StatusID,Status FROM core_status WHERE StatusID ='53'
) LIMIT 1;
SET FOREIGN_KEY_CHECKS=1;