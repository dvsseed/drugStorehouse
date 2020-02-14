-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `drugstorehouse` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `drugstorehouse`;

DROP TABLE IF EXISTS `dm_drugs`;
CREATE TABLE `dm_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `stock_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_english` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_chinese` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_element` varchar(55) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_ingredient` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_amount` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_unit` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `single_compound` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_reference` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_startdate` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_expirationdate` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_manufacturer` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_form` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `remark` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `agents` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `uniform_numbers` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_orders` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `business_representatives` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile_telephone` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `purchase_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `percentage_deduction` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `orderunit_rebates` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `temporary_purchase` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `safety_stock` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `selling_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `staff_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `industry_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `DMDRUGSINDEX` (`drug_code`,`stock_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='藥品資料維護';

INSERT INTO `dm_drugs` (`id`, `barcode`, `drug_code`, `stock_code`, `drug_english`, `drug_chinese`, `drug_element`, `drug_ingredient`, `drugspec_amount`, `drugspec_unit`, `single_compound`, `drugprices_reference`, `drugprices_startdate`, `drugprices_expirationdate`, `drug_manufacturer`, `drug_form`, `remark`, `agents`, `uniform_numbers`, `phone_orders`, `business_representatives`, `mobile_telephone`, `purchase_price`, `percentage_deduction`, `orderunit_rebates`, `temporary_purchase`, `safety_stock`, `selling_price`, `staff_price`, `industry_price`) VALUES
(8,	'1',	'A001046100',	'DC',	'MAGNESIUM OXIDE TABLETS 1000S/BT',	'氧化鎂錠 1000粒/瓶',	'MAGNESIUM OXIDE',	'250MG',	'1',	'粒',	'N',	'0.13',	'860626',	'',	'安皮露製藥股份有限公司瑞芳廠',	'錠劑',	'',	'信東生技股份有限公司',	'43211700',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'');

DROP TABLE IF EXISTS `dm_inventory`;
CREATE TABLE `dm_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_date` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `barcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `stock_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_english` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_chinese` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_amount` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `box_qty` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `tablet_qty` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `total` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `tr_qty` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `safety_stock` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `DMINVENTORYINDEX` (`drug_code`,`stock_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='庫存維護';

INSERT INTO `dm_inventory` (`id`, `inventory_date`, `barcode`, `drug_code`, `stock_code`, `drug_english`, `drug_chinese`, `drugspec_amount`, `box_qty`, `tablet_qty`, `total`, `tr_qty`, `safety_stock`) VALUES
(9,	'2015-08-01',	'1',	'AC57114100 ',	'DMAC57114100027497',	'AMLODIPINE 5mg',	'',	'600',	'4',	'519',	'0',	'0',	'0');

DROP TABLE IF EXISTS `dm_retail`;
CREATE TABLE `dm_retail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `product_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `product_english` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `product_chinese` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `specification` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `spec_amount` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `spec_unit` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `product_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `product_manufacturer` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `remark` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `agents` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `uniform_numbers` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_orders` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `business_representatives` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile_telephone` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `purchase_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `percentage_deduction` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `orderunit_rebates` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `temporary_purchase` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `safety_stock` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `selling_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `staff_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `industry_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `RETAILINDEX` (`product_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='OTC零售資料';


DROP TABLE IF EXISTS `drug_agents`;
CREATE TABLE `drug_agents` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `agents` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `uniform_numbers` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_method` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `term_receivables` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `percentage_deduction` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `payee_account` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `beneficiary_bank` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `branch_categories` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `beneficiary_account` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `fee_burden` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `payee_uninumbers` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `accounts_notification` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `e_mail` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `fax_number` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_number` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_orders` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIFORMUNIQUE` (`uniform_numbers`) USING BTREE,
  KEY `AGINDEX` (`agents`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='藥品代理商';

INSERT INTO `drug_agents` (`id`, `agents`, `uniform_numbers`, `payment_method`, `term_receivables`, `percentage_deduction`, `payee_account`, `beneficiary_bank`, `branch_categories`, `beneficiary_account`, `fee_burden`, `payee_uninumbers`, `accounts_notification`, `e_mail`, `fax_number`, `phone_number`, `phone_orders`) VALUES
(1,	'全華藥品股份有限公司',	'97094067',	'現金',	'下貨收現',	'無',	'',	'',	'',	'',	'',	'',	'不通知',	'',	'',	'',	'');

DROP TABLE IF EXISTS `healthcare_drugs`;
CREATE TABLE `healthcare_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_mark` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `oral_tablet` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `single_compound` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `stock_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_reference` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_startdate` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_expirationdate` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_english` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_amount` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_unit` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_element` varchar(55) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_ingredient` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `content_unit` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_form` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_classification` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_manufacturer` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `atc_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `HDRUGSINDEX` (`drug_code`,`stock_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='健保用藥品項';

INSERT INTO `healthcare_drugs` (`id`, `new_mark`, `oral_tablet`, `single_compound`, `drug_code`, `stock_code`, `drugprices_reference`, `drugprices_startdate`, `drugprices_expirationdate`, `drug_english`, `drugspec_amount`, `drugspec_unit`, `drug_element`, `drug_ingredient`, `content_unit`, `drug_form`, `drug_classification`, `drug_manufacturer`, `atc_code`) VALUES
(3,	'',	'',	'N',	'A003941421',	'DMA003941421000003',	'12.7',	'981001',	'9991231',	'NARPINA EYE DROPS',	'5',	'ML',	'NAPHAZOLINE NITRATE',	'0.03',	'MG/ML',	'點眼液劑',	'523200',	'綠洲化學工業有限公司',	'S01GA01');

DROP TABLE IF EXISTS `invoice_info`;
CREATE TABLE `invoice_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `invoice_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `stock_code` varchar(25) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_english` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_chinese` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_amount` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `drugspec_unit` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `drugprices_reference` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `drug_manufacturer` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `agents` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `quantity` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `grant_amount` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `total` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `purchase` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `invoice_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `invoice_amount` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `discount_amount` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `business_tax` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `discount_afteramount` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `unit_price` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `price_difference` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `purchase_price` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `percentage_deduction` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `expiration_date` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `lot_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_date` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `paid_afterdeduction` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `before3months_consumption` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `business_representatives` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile_telephone` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_orders` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `storage_location` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `return_1F` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `INVOICEINDEX` (`drug_code`,`stock_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='發票資訊';

INSERT INTO `invoice_info` (`id`, `purchase_date`, `invoice_date`, `drug_code`, `stock_code`, `drug_english`, `drug_chinese`, `drugspec_amount`, `drugspec_unit`, `drugprices_reference`, `drug_manufacturer`, `agents`, `quantity`, `grant_amount`, `total`, `purchase`, `invoice_number`, `invoice_amount`, `discount_amount`, `business_tax`, `discount_afteramount`, `unit_price`, `price_difference`, `purchase_price`, `percentage_deduction`, `expiration_date`, `lot_number`, `payment_date`, `paid_afterdeduction`, `before3months_consumption`, `business_representatives`, `mobile_telephone`, `phone_orders`, `storage_location`, `return_1F`) VALUES
(6,	'2015-08-04',	'2015-08-04',	'AC124581G0',	'DMAC124581G0031676',	'EURODIN TABLETS 2MG(鋁箔/膠箔)',	'',	'100',	'盒',	'2',	'',	'裕利股份有限公司',	'25',	'',	'',	'',	'QW35119573',	'5000',	'',	'',	'',	'',	'',	'',	'',	'2019-04-09',	'D058',	'',	'',	'',	'',	'',	'',	'',	'');

DROP TABLE IF EXISTS `medical_materials`;
CREATE TABLE `medical_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `medical_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `medical_english` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `medical_chinese` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `specification` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `spec_amount` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `spec_unit` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `medical_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `medical_manufacturer` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `remark` varchar(120) COLLATE utf8_unicode_ci DEFAULT '',
  `agents` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `uniform_numbers` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `phone_orders` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `business_representatives` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile_telephone` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `purchase_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `percentage_deduction` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `orderunit_rebates` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `temporary_purchase` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `safety_stock` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `selling_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `staff_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `industry_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `MATERIALSINDEX` (`medical_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='醫材資料';


DROP TABLE IF EXISTS `sales_sa395`;
CREATE TABLE `sales_sa395` (
  `sale_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `seqno` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `item_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `tr_date` varchar(23) COLLATE utf8_unicode_ci DEFAULT '',
  `un_price` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `tr_qty` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `mea` varchar(4) COLLATE utf8_unicode_ci DEFAULT '',
  `dis_per` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `dis_mon` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `un_cost` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `get_point` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `bonus` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `sub_pmon` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `stock_old` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `cost_old` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `updid` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `updtime` varchar(23) COLLATE utf8_unicode_ci DEFAULT '',
  `ubc1` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `ubc2` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `ubn1` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `ubn2` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `ubd1` varchar(8) COLLATE utf8_unicode_ci DEFAULT '',
  `ubd2` varchar(8) COLLATE utf8_unicode_ci DEFAULT '',
  `cmp_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT '',
  `inv_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `new_uprice` varchar(14) COLLATE utf8_unicode_ci DEFAULT '',
  `sp_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `sp_seqno` varchar(4) COLLATE utf8_unicode_ci DEFAULT '',
  `csq_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `up_dis` varchar(1) COLLATE utf8_unicode_ci DEFAULT '',
  `eos_cost` varchar(14) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='銷貨銷退明細檔';

INSERT INTO `sales_sa395` (`sale_id`, `seqno`, `item_id`, `tr_date`, `un_price`, `tr_qty`, `mea`, `dis_per`, `dis_mon`, `un_cost`, `get_point`, `bonus`, `sub_pmon`, `stock_old`, `cost_old`, `updid`, `updtime`, `ubc1`, `ubc2`, `ubn1`, `ubn2`, `ubd1`, `ubd2`, `cmp_code`, `inv_id`, `new_uprice`, `sp_no`, `sp_seqno`, `csq_id`, `up_dis`, `eos_cost`) VALUES
('T01011507070001',	'1',	'TSS01000011R-2',	'2015-07-07 07:45:45.921',	'900.000',	'1.000',	'盒',	'100.0',	'0.000',	'0.000',	'0.000',	'0.000',	'0.000',	'-21327.000',	'499.999',	'AA',	'2015-07-07 07:45:48.406',	'Y',	'',	'900.000',	'0.000',	'',	'',	'01',	'',	'900.000',	'',	'',	'',	'0',	'499.999');


DROP TABLE IF EXISTS `sys_apps`;
CREATE TABLE `sys_apps` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `installed` char(1) COLLATE utf8_unicode_ci DEFAULT '',
  `show_tabs` char(1) COLLATE utf8_unicode_ci DEFAULT '',
  `tab_names` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `table_names` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `sys_header_links`;
CREATE TABLE `sys_header_links` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sequence` tinyint(2) DEFAULT NULL,
  `hint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_header_links` (`id`, `title`, `url`, `target`, `sequence`, `hint`) VALUES
(1,	'首頁',	'javascript:gohome()',	'_self',	1,	'首頁'),
(2,	'登出',	'javascript:logout()',	'_self',	9,	'登出'),
(3,	'入庫管理',	'javascript:gowarehousing()',	'_self',	1,	'入庫管理'),
(4,	'銷貨管理',	'javascript:goselling()',	'_self',	1,	'銷貨管理'),
(5,	'統計資料',	'javascript:logout()',	'_self',	1,	'統計資料'),
(6,	'結帳作業',	'javascript:logout()',	'_self',	1,	'結帳作業'),
(7,	'盤點作業',	'javascript:goinventorying()',	'_self',	1,	'盤點作業'),
(8,	'權限管理',	'javascript:gousers()',	'_self',	1,	'權限管理');

DROP TABLE IF EXISTS `sys_nav_blocks`;
CREATE TABLE `sys_nav_blocks` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sequence` tinyint(1) DEFAULT NULL,
  `display` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_nav_blocks` (`id`, `title`, `sequence`, `display`) VALUES
(1,	'主功能',	1,	'Y');

DROP TABLE IF EXISTS `sys_nav_links`;
CREATE TABLE `sys_nav_links` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sequence` tinyint(1) DEFAULT NULL,
  `block_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_nav_links` (`id`, `title`, `url`, `target`, `sequence`, `block_id`, `hint`) VALUES
(1,	'首頁',	'javascript:gohome()',	'_self',	1,	'1',	'首頁'),
(2,	'登出',	'javascript:logout()',	'_self',	9,	'1',	'登出'),
(3,	'入庫管理',	'javascript:gowarehousing()',	'_self',	1,	'1',	'入庫管理'),
(4,	'銷貨管理',	'javascript:goselling()',	'_self',	1,	'1',	'銷貨管理'),
(5,	'統計資料',	'javascript:logout()',	'_self',	1,	'1',	'統計資料'),
(6,	'結帳作業',	'javascript:logout()',	'_self',	1,	'1',	'結帳作業'),
(7,	'盤點作業',	'javascript:goinventorying()',	'_self',	1,	'1',	'盤點作業'),
(8,	'權限管理',	'javascript:gousers()',	'_self',	1,	'1',	'權限管理');

DROP TABLE IF EXISTS `sys_settings`;
CREATE TABLE `sys_settings` (
  `sys_theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_policy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_password_length` tinyint(4) DEFAULT NULL,
  `password_type` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_settings` (`sys_theme`, `site_title`, `system_state`, `auth_policy`, `min_password_length`, `password_type`) VALUES
('default',	'庫存管理系統--CMS',	'active',	'normal',	3,	0);

DROP TABLE IF EXISTS `sys_tabs`;
CREATE TABLE `sys_tabs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `tab_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_href` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_level` tinyint(4) DEFAULT NULL,
  `tab_tip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_order` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_tabs` (`id`, `tab_name`, `tab_label`, `tab_link`, `tab_href`, `tab_level`, `tab_tip`, `tab_order`) VALUES
(1,	'home',	'首頁',	'home.php?tab=logout',	NULL,	1,	'首頁',	1),
(2,	'news',	'新聞',	'home.php?tab=news',	NULL,	1,	'新聞',	2),
(3,	'board',	'留言',	'home.php?tab=board',	NULL,	1,	'留言',	3),
(4,	'file',	'檔案',	'home.php?tab=file',	NULL,	1,	'檔案',	3),
(5,	'admin',	'管理',	'home.php?tab=admin',	'sysusers.html',	9,	'管理',	99),
(6,	'warehousing',	'藥品代理商',	'home.php?tab=warehousing',	'drugagents.html',	1,	'藥品代理商',	1),
(7,	'warehousing',	'健保藥品資料',	'home.php?tab=warehousing',	'healthcaredrugs.html',	0,	'健保藥品資料',	2),
(8,	'warehousing',	'醫材資料',	'home.php?tab=warehousing',	'medicalmaterials.html',	1,	'醫材資料',	4),
(9,	'warehousing',	'零售資料',	'home.php?tab=warehousing',	'dmretail.html',	1,	'零售資料',	5),
(10,	'warehousing',	'藥品資料維護',	'home.php?tab=warehousing',	'dmdrugs.html',	1,	'藥品資料維護',	3),
(11,	'warehousing',	'簡介',	'home.php?tab=warehousing',	'warehousingsynopsis.html',	1,	'簡介',	0),
(12,	'warehousing',	'發票資訊',	'home.php?tab=warehousing',	'invoiceinfo.html',	1,	'發票資訊',	6),
(13,	'selling',	'簡介',	'home.php?tab=selling',	'sellingsynopsis.html',	1,	'簡介',	0),
(14,	'selling',	'藥局POS銷售資料',	'home.php?tab=selling',	'posselling.html',	1,	'藥局POS銷售資料',	1),
(15,	'inventorying',	'簡介',	'home.php?tab=inventorying',	'inventoryingsynopsis.html',	1,	'簡介',	0),
(16,	'inventorying',	'庫存',	'home.php?tab=inventorying',	'inventorying.html',	1,	'庫存',	1);

DROP TABLE IF EXISTS `sys_themes`;
CREATE TABLE `sys_themes` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_themes` (`id`, `theme`) VALUES
(1,	'default'),
(2,	'gray'),
(3,	'black'),
(4,	'bootstrap'),
(5,	'metro'),
(6,	'metro-blue'),
(7,	'metro-gray'),
(8,	'metro-green'),
(9,	'metro-orange'),
(10,	'metro-red'),
(11,	'ui-cupertino'),
(12,	'ui-dark-hive'),
(13,	'ui-pepper-grinder'),
(14,	'ui-sunny');

DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE `sys_users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maillist` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_sms` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT 0,
  `last_login` datetime NOT NULL,
  `login_fail_count` tinyint(4) NOT NULL DEFAULT 0,
  `last_3_passwords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locked` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_users` (`id`, `account`, `password`, `suname`, `theme`, `email`, `maillist`, `level`, `mobile_phone`, `send_sms`, `login_count`, `last_login`, `login_fail_count`, `last_3_passwords`, `locked`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'admin',	'default',	NULL,	'Y',	9,	NULL,	'N',	740,	'2020-02-14 06:55:27',	0,	NULL,	'N'),
(2,	'test',	'098f6bcd4621d373cade4e832627b4f6',	'test',	'metro',	NULL,	'Y',	1,	NULL,	'N',	11,	'2020-02-14 00:52:30',	0,	NULL,	'N');

DROP TABLE IF EXISTS `sys_visitors`;
CREATE TABLE `sys_visitors` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `visit_time` datetime NOT NULL,
  `remote_addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_port` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `tmpsa395`;
CREATE TABLE `tmpsa395` (
  `sale_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seqno` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tr_date` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  `un_price` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tr_qty` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mea` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dis_per` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dis_mon` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `un_cost` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `get_point` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bonus` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_pmon` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock_old` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_old` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updid` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updtime` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubc1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubc2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubn1` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubn2` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubd1` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubd2` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmp_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_uprice` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_seqno` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `csq_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `up_dis` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eos_cost` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tmpsa395` (`sale_id`, `seqno`, `item_id`, `tr_date`, `un_price`, `tr_qty`, `mea`, `dis_per`, `dis_mon`, `un_cost`, `get_point`, `bonus`, `sub_pmon`, `stock_old`, `cost_old`, `updid`, `updtime`, `ubc1`, `ubc2`, `ubn1`, `ubn2`, `ubd1`, `ubd2`, `cmp_code`, `inv_id`, `new_uprice`, `sp_no`, `sp_seqno`, `csq_id`, `up_dis`, `eos_cost`) VALUES
('T01011507070006',	'1',	'K000760209',	'2015-07-07 08:09:50.718',	'271.000',	'-1.000',	'瓶',	'0.00',	'0.000',	'0.000',	'0.000',	'0.000',	'0.000',	'44.000',	'271.000',	'AA',	'2015-07-07 08:09:52.359',	'Y',	'',	'271.000',	'0.000',	'',	'',	'01',	'',	'0.000',	'',	'',	'',	'0',	'271.000');

-- 2020-02-14 01:30:05
