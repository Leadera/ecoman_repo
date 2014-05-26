-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2014 at 06:43 AM
-- Server version: 5.5.37-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecoman_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `T_CLSTR`
--

CREATE TABLE IF NOT EXISTS `T_CLSTR` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `org_ind_reg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `org_ind_reg_id` (`org_ind_reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNNT`
--

CREATE TABLE IF NOT EXISTS `T_CMPNNT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone_num_1` varchar(50) DEFAULT NULL,
  `phone_num_2` varchar(50) DEFAULT NULL,
  `fax_num` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `T_CMPNY`
--

INSERT INTO `T_CMPNY` (`id`, `name`, `phone_num_1`, `phone_num_2`, `fax_num`, `address`, `description`, `email`, `postal_code`, `logo`, `active`) VALUES
(1, 'qwert', '11241', '14214', '1241241', ' vwecww', 'cwercwe', 'wcwcer', 'wcr', 'wcr', 1),
(2, 'com', '23424', '23424', '3244', '423423', '42342', '423423', '4234234', '3242', 1),
(3, 'firm', '234242', '234234', '324234', '234234', '234234', '234234', '2342', '234234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_CLSTR`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_CLSTR` (
  `cmpny_id` int(11) NOT NULL,
  `clstr_id` int(11) NOT NULL,
  PRIMARY KEY (`cmpny_id`,`clstr_id`),
  KEY `clstr_id` (`clstr_id`),
  KEY `cmpny_id` (`cmpny_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_DATA`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_DATA` (
  `cmpny_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cmpny_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_EQPMNT`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_EQPMNT` (
  `id` int(11) NOT NULL,
  `cmpny_id` int(11) DEFAULT NULL,
  `eqpmnt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `eqpmnt_id` (`eqpmnt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_EQPMNT_TYPE`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_EQPMNT_TYPE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmpny_id` int(11) NOT NULL,
  `eqpmnt_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `eqpmnt_type_id` (`eqpmnt_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_FLOW`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_FLOW` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmpny_id` int(11) DEFAULT NULL,
  `flow_id` int(11) NOT NULL,
  `qntty` decimal(10,3) DEFAULT NULL,
  `qntty_unit_id` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `cost_unit_id` int(11) DEFAULT NULL,
  `ep` decimal(10,2) DEFAULT NULL,
  `ep_unit_id` int(11) DEFAULT NULL,
  `flow_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `flow_type_id` (`flow_type_id`),
  KEY `flow_id` (`flow_id`),
  KEY `qntty_unit_id` (`qntty_unit_id`),
  KEY `cost_unit_id` (`cost_unit_id`),
  KEY `ep_unit_id` (`ep_unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_FLOW_CMPNNT`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_FLOW_CMPNNT` (
  `cmpny_flow_id` int(11) NOT NULL,
  `cmpnnt_id` int(11) NOT NULL,
  PRIMARY KEY (`cmpny_flow_id`,`cmpnnt_id`),
  KEY `cmpnnt_id` (`cmpnnt_id`),
  KEY `cmpny_flow_id` (`cmpny_flow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_FLOW_PRCSS`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_FLOW_PRCSS` (
  `cmpny_flow_id` int(11) NOT NULL,
  `cmpny_prcss_id` int(11) NOT NULL,
  PRIMARY KEY (`cmpny_flow_id`,`cmpny_prcss_id`),
  KEY `cmpny_flow_id` (`cmpny_flow_id`),
  KEY `cmpny_prcss_id` (`cmpny_prcss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_NACE_CODE`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_NACE_CODE` (
  `cmpny_id` int(11) NOT NULL,
  `nace_code_id` int(11) NOT NULL,
  PRIMARY KEY (`cmpny_id`,`nace_code_id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `nace_code_id` (`nace_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_ORG_IND_REG`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_ORG_IND_REG` (
  `org_ind_reg_id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  PRIMARY KEY (`org_ind_reg_id`,`cmpny_id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `org_ind_reg_id` (`org_ind_reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_PRCSS`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_PRCSS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmpny_id` int(11) DEFAULT NULL,
  `prcss_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `prcss_id` (`prcss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_PRCSS_EQPMNT_TYPE`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_PRCSS_EQPMNT_TYPE` (
  `cmpny_eqpmnt_type_id` int(11) NOT NULL,
  `cmpny_prcss_id` int(11) NOT NULL,
  PRIMARY KEY (`cmpny_eqpmnt_type_id`,`cmpny_prcss_id`),
  KEY `cmpny_eqpmnt_type_id` (`cmpny_eqpmnt_type_id`),
  KEY `cmpny_prcss_id` (`cmpny_prcss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_CMPNY_PRSNL`
--

CREATE TABLE IF NOT EXISTS `T_CMPNY_PRSNL` (
  `user_id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  `is_contact` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`,`cmpny_id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_CMPNY_PRSNL`
--

INSERT INTO `T_CMPNY_PRSNL` (`user_id`, `cmpny_id`, `is_contact`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `T_CNSLTNT`
--

CREATE TABLE IF NOT EXISTS `T_CNSLTNT` (
  `user_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_CNSLTNT`
--

INSERT INTO `T_CNSLTNT` (`user_id`, `description`, `active`) VALUES
(1, 'ertert', 1),
(2, 'rtet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `T_DOC`
--

CREATE TABLE IF NOT EXISTS `T_DOC` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc` varchar(40) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_EQPMNT`
--

CREATE TABLE IF NOT EXISTS `T_EQPMNT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `eqpmnt_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_EQPMNT_TYPE`
--

CREATE TABLE IF NOT EXISTS `T_EQPMNT_TYPE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_EQPMNT_TYPE_ATTRBT`
--

CREATE TABLE IF NOT EXISTS `T_EQPMNT_TYPE_ATTRBT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(50) DEFAULT NULL,
  `attribute_value` varchar(200) DEFAULT NULL,
  `eqpmnt_type_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eqpmnt_type_id` (`eqpmnt_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_FLOW`
--

CREATE TABLE IF NOT EXISTS `T_FLOW` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_FLOW_TYPE`
--

CREATE TABLE IF NOT EXISTS `T_FLOW_TYPE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_NACE_CODE`
--

CREATE TABLE IF NOT EXISTS `T_NACE_CODE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_tr` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_ORG_IND_REG`
--

CREATE TABLE IF NOT EXISTS `T_ORG_IND_REG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRCSS`
--

CREATE TABLE IF NOT EXISTS `T_PRCSS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mother_id` (`mother_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRDCT`
--

CREATE TABLE IF NOT EXISTS `T_PRDCT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmpny_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cmpny_id` (`cmpny_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ`
--

CREATE TABLE IF NOT EXISTS `T_PRJ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `T_PRJ`
--

INSERT INTO `T_PRJ` (`id`, `name`, `start_date`, `end_date`, `status_id`, `description`, `active`) VALUES
(5, 'ertert', '0000-00-00', NULL, 1, 'ertet', 0),
(6, 'werwerw', '2014-05-23', NULL, 1, 'werewr', 0),
(7, 'dfdfs', '2014-05-23', NULL, 2, 'sdfsf', 1),
(8, 'proje', '2014-05-23', NULL, 4, 'denemememe', 1),
(9, 'erwr', '2014-05-07', NULL, 2, 'wer', 1),
(10, 'rtert', '2014-05-23', NULL, 1, 'ret', 1),
(11, 'rtert', '2014-05-23', NULL, 1, 'ret', 1),
(12, 'wdd', '2014-05-23', NULL, 1, 'dw', 1),
(13, 'wdd', '2014-05-23', NULL, 1, 'dw', 1),
(14, 'fdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(15, 'dfdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(16, 'dfdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(17, 'dfdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(18, 'dfdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(19, 'dfdf', '2014-05-23', NULL, 1, 'dfdf', 1),
(20, 'dfgdf', '2014-05-23', NULL, 1, 'dfgdfg', 1),
(21, 'dfgdf', '2014-05-23', NULL, 1, 'dfgdfg', 1),
(22, 'dfdg', '2014-05-23', NULL, 1, 'dfgd', 1),
(23, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(24, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(25, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(26, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(27, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(28, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(29, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(30, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(31, 'ertr', '2014-05-23', NULL, 1, 'erer', 1),
(32, 'dfdf', '2014-05-05', NULL, 1, 'dfdf', 1),
(33, 'ertabwe', '2014-05-23', NULL, 1, 'wewe', 1),
(34, 'ertabwe', '2014-05-23', NULL, 1, 'wewe', 1),
(35, 'werwerw', '2014-05-23', NULL, 1, 'we', 1),
(36, '345', '2014-05-23', NULL, 1, '3453', 1),
(37, '345', '2014-05-23', NULL, 1, '3453', 1),
(38, 'erewr', '2014-05-23', NULL, 1, 'werw', 1),
(39, 'ertert111', '2014-05-23', NULL, 1, '1111', 1),
(40, 'fgdfg', '2014-05-23', NULL, 1, 'dfgdfg', 1),
(41, 'tyu', '2014-05-23', NULL, 1, 'erte', 1),
(42, 'tyu', '2014-05-23', NULL, 1, 'erte', 1),
(43, 'ert', '2014-05-23', NULL, 1, 'tert', 1),
(44, 'fgfg', '2014-05-23', NULL, 1, 'fgf', 1),
(45, 'fgfg', '2014-05-23', NULL, 1, 'fgf', 1),
(46, 'fgfg', '2014-05-23', NULL, 1, 'fgf', 1),
(47, 'erte', '2014-05-20', NULL, 1, 'retert', 1),
(48, 'erer', '2014-05-23', NULL, 1, 'ewewe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_ACSS_CMPNY`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_ACSS_CMPNY` (
  `cmpny_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `read_acss` tinyint(4) DEFAULT NULL,
  `write_acss` tinyint(4) DEFAULT NULL,
  `delete_acss` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`cmpny_id`,`prj_id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `prj_id` (`prj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_ACSS_USER`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_ACSS_USER` (
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `read_acss` tinyint(4) DEFAULT NULL,
  `write_acss` tinyint(4) DEFAULT NULL,
  `delete_acss` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`prj_id`),
  KEY `prj_id` (`prj_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_CMPNY`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_CMPNY` (
  `prj_id` int(11) NOT NULL,
  `cmpny_id` int(11) NOT NULL,
  PRIMARY KEY (`prj_id`,`cmpny_id`),
  KEY `cmpny_id` (`cmpny_id`),
  KEY `prj_id` (`prj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_PRJ_CMPNY`
--

INSERT INTO `T_PRJ_CMPNY` (`prj_id`, `cmpny_id`) VALUES
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(48, 2),
(41, 3),
(42, 3);

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_CNSLTNT`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_CNSLTNT` (
  `prj_id` int(11) NOT NULL,
  `cnsltnt_id` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`prj_id`,`cnsltnt_id`),
  KEY `cnsltnt_id` (`cnsltnt_id`),
  KEY `prj_id` (`prj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_PRJ_CNSLTNT`
--

INSERT INTO `T_PRJ_CNSLTNT` (`prj_id`, `cnsltnt_id`, `active`) VALUES
(45, 1, 1),
(46, 1, 1),
(46, 2, 1),
(47, 1, 1),
(48, 1, 1),
(48, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_CNTCT_PRSNL`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_CNTCT_PRSNL` (
  `prj_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`prj_id`,`usr_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_DOC`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_DOC` (
  `doc_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  PRIMARY KEY (`doc_id`,`prj_id`),
  KEY `doc_id` (`doc_id`),
  KEY `prj_id` (`prj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `T_PRJ_STATUS`
--

CREATE TABLE IF NOT EXISTS `T_PRJ_STATUS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `short_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `T_PRJ_STATUS`
--

INSERT INTO `T_PRJ_STATUS` (`id`, `name`, `name_tr`, `active`, `short_code`) VALUES
(1, 'start', 'start', 1, 'STR'),
(2, 'wrwrwer', 'qwrwr', 1, 'QWE'),
(3, 'finiwer', 'wer', 0, 'FIN'),
(4, 'fini', 'wer', 1, 'FIN');

-- --------------------------------------------------------

--
-- Table structure for table `T_ROLE`
--

CREATE TABLE IF NOT EXISTS `T_ROLE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `name_tr` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `short_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `T_ROLE`
--

INSERT INTO `T_ROLE` (`id`, `name`, `name_tr`, `active`, `short_code`) VALUES
(1, 'admin', 'admin', 1, 'ADM'),
(2, 'consultant', 'consultant', 1, 'CNS'),
(3, 'visitor', 'visitor', 1, 'VST');

-- --------------------------------------------------------

--
-- Table structure for table `T_UNIT`
--

CREATE TABLE IF NOT EXISTS `T_UNIT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `name_tr` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `T_USER`
--

CREATE TABLE IF NOT EXISTS `T_USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `psswrd` varchar(40) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone_num_1` varchar(50) DEFAULT NULL,
  `phone_num_2` varchar(50) DEFAULT NULL,
  `fax_num` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `linkedin_user` tinyint(1) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `T_USER`
--

INSERT INTO `T_USER` (`id`, `name`, `surname`, `user_name`, `psswrd`, `role_id`, `title`, `phone_num_1`, `phone_num_2`, `fax_num`, `email`, `description`, `linkedin_user`, `photo`, `active`) VALUES
(1, 'ertan', 'tolan', 'etolan', '31663bdaeeefb7ae67859c6413d58b39', 2, 'asdasdasdasdas', '123123123123', '123123123123123', '123123123123123', 'etolan.11@gmail.com', '234', NULL, 'etolan.jpg', 0),
(2, 'ertan', 'tolan', 'etolan1', '31663bdaeeefb7ae67859c6413d58b39', 2, 'wqewe', '123123123123', '123123123123123', '123123123123123', 'etolan.011@gmail.com', '', NULL, 'etolan1.jpg', 0),
(3, '12312312', 'eolasd', '123444', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'wqewe', '1123123123123123', '123123123123123', '123123123123123', 'st09112301031@etu.edu.tr', '12312312313', NULL, '123444.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `T_USER_LOG`
--

CREATE TABLE IF NOT EXISTS `T_USER_LOG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `T_CLSTR`
--
ALTER TABLE `T_CLSTR`
  ADD CONSTRAINT `FK_T_CLSTR_T_ORG_IND_REG` FOREIGN KEY (`org_ind_reg_id`) REFERENCES `T_ORG_IND_REG` (`id`);

--
-- Constraints for table `T_CMPNY_CLSTR`
--
ALTER TABLE `T_CMPNY_CLSTR`
  ADD CONSTRAINT `FK_T_CMPNY_CLSTR_T_CLSTR` FOREIGN KEY (`clstr_id`) REFERENCES `T_CLSTR` (`id`),
  ADD CONSTRAINT `FK_T_CMPNY_CLSTR_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`);

--
-- Constraints for table `T_CMPNY_DATA`
--
ALTER TABLE `T_CMPNY_DATA`
  ADD CONSTRAINT `FK_T_CMPNY_PRJ_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`);

--
-- Constraints for table `T_CMPNY_EQPMNT`
--
ALTER TABLE `T_CMPNY_EQPMNT`
  ADD CONSTRAINT `FK_T_EQPMNT_T_CMPNY_DATA` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY_DATA` (`cmpny_id`),
  ADD CONSTRAINT `FK_T_EQPMNT_T_EQPMNT_NAME` FOREIGN KEY (`eqpmnt_id`) REFERENCES `T_EQPMNT` (`id`);

--
-- Constraints for table `T_CMPNY_EQPMNT_TYPE`
--
ALTER TABLE `T_CMPNY_EQPMNT_TYPE`
  ADD CONSTRAINT `FK_T_CMPNY_EQPMNT_TYPE_T_CMPNY_DATA` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY_DATA` (`cmpny_id`),
  ADD CONSTRAINT `FK_T_CMPNY_EQPMNT_TYPE_T_EQPMNT_TYPE` FOREIGN KEY (`eqpmnt_type_id`) REFERENCES `T_EQPMNT_TYPE` (`id`);

--
-- Constraints for table `T_CMPNY_FLOW`
--
ALTER TABLE `T_CMPNY_FLOW`
  ADD CONSTRAINT `FK_T_FLOW_T_CMPNY_DATA` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY_DATA` (`cmpny_id`),
  ADD CONSTRAINT `FK_T_FLOW_T_FLOW_NAME` FOREIGN KEY (`flow_id`) REFERENCES `T_FLOW` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_T_FLOW_TYPE` FOREIGN KEY (`flow_type_id`) REFERENCES `T_FLOW_TYPE` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_T_UNIT_COST` FOREIGN KEY (`cost_unit_id`) REFERENCES `T_UNIT` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_T_UNIT_EP` FOREIGN KEY (`ep_unit_id`) REFERENCES `T_UNIT` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_T_UNIT_QNTTY` FOREIGN KEY (`qntty_unit_id`) REFERENCES `T_UNIT` (`id`);

--
-- Constraints for table `T_CMPNY_FLOW_CMPNNT`
--
ALTER TABLE `T_CMPNY_FLOW_CMPNNT`
  ADD CONSTRAINT `FK_T_FLOW_CMPNNT_NAME_T_CMPNNT_NAME` FOREIGN KEY (`cmpnnt_id`) REFERENCES `T_CMPNNT` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_CMPNNT_T_FLOW` FOREIGN KEY (`cmpny_flow_id`) REFERENCES `T_CMPNY_FLOW` (`id`);

--
-- Constraints for table `T_CMPNY_FLOW_PRCSS`
--
ALTER TABLE `T_CMPNY_FLOW_PRCSS`
  ADD CONSTRAINT `FK_T_FLOW_PRCSS_T_FLOW` FOREIGN KEY (`cmpny_flow_id`) REFERENCES `T_CMPNY_FLOW` (`id`),
  ADD CONSTRAINT `FK_T_FLOW_PRCSS_T_PRCSS` FOREIGN KEY (`cmpny_prcss_id`) REFERENCES `T_CMPNY_PRCSS` (`id`);

--
-- Constraints for table `T_CMPNY_NACE_CODE`
--
ALTER TABLE `T_CMPNY_NACE_CODE`
  ADD CONSTRAINT `FK_T_CMPNY_NACE_CODE_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`),
  ADD CONSTRAINT `FK_T_CMPNY_NACE_CODE_T_NACE_CODE` FOREIGN KEY (`nace_code_id`) REFERENCES `T_NACE_CODE` (`id`);

--
-- Constraints for table `T_CMPNY_ORG_IND_REG`
--
ALTER TABLE `T_CMPNY_ORG_IND_REG`
  ADD CONSTRAINT `FK_T_CMPNY_ORG_IND_REG_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`),
  ADD CONSTRAINT `FK_T_CMPNY_ORG_IND_REG_T_ORG_IND_REG` FOREIGN KEY (`org_ind_reg_id`) REFERENCES `T_ORG_IND_REG` (`id`);

--
-- Constraints for table `T_CMPNY_PRCSS`
--
ALTER TABLE `T_CMPNY_PRCSS`
  ADD CONSTRAINT `FK_T_PRCSS_T_CMPNY_DATA` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY_DATA` (`cmpny_id`),
  ADD CONSTRAINT `FK_T_PRCSS_T_PRCSS_NAME` FOREIGN KEY (`prcss_id`) REFERENCES `T_PRCSS` (`id`);

--
-- Constraints for table `T_CMPNY_PRCSS_EQPMNT_TYPE`
--
ALTER TABLE `T_CMPNY_PRCSS_EQPMNT_TYPE`
  ADD CONSTRAINT `FK_T_CMPNY_PRCSS_EQPMNT_TYPE_T_CMPNY_EQPMNT_TYPE` FOREIGN KEY (`cmpny_eqpmnt_type_id`) REFERENCES `T_CMPNY_EQPMNT_TYPE` (`id`),
  ADD CONSTRAINT `FK_T_CMPNY_PRCSS_EQPMNT_TYPE_T_CMPNY_PRCSS` FOREIGN KEY (`cmpny_prcss_id`) REFERENCES `T_CMPNY_PRCSS` (`id`);

--
-- Constraints for table `T_CMPNY_PRSNL`
--
ALTER TABLE `T_CMPNY_PRSNL`
  ADD CONSTRAINT `FK_T_CMPNY_PRSNL_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`),
  ADD CONSTRAINT `FK_T_CMPNY_PRSNL_T_USER` FOREIGN KEY (`user_id`) REFERENCES `T_USER` (`id`);

--
-- Constraints for table `T_CNSLTNT`
--
ALTER TABLE `T_CNSLTNT`
  ADD CONSTRAINT `FK_T_CNSLTNT_T_USER` FOREIGN KEY (`user_id`) REFERENCES `T_USER` (`id`);

--
-- Constraints for table `T_EQPMNT_TYPE_ATTRBT`
--
ALTER TABLE `T_EQPMNT_TYPE_ATTRBT`
  ADD CONSTRAINT `FK_T_EQPMNT_ATTRBT_T_EQPMNT_TYPE` FOREIGN KEY (`eqpmnt_type_id`) REFERENCES `T_EQPMNT_TYPE` (`id`);

--
-- Constraints for table `T_PRCSS`
--
ALTER TABLE `T_PRCSS`
  ADD CONSTRAINT `FK_T_PRCSS_NAME_T_PRCSS_NAME` FOREIGN KEY (`mother_id`) REFERENCES `T_PRCSS` (`id`);

--
-- Constraints for table `T_PRDCT`
--
ALTER TABLE `T_PRDCT`
  ADD CONSTRAINT `FK_T_PRDCT_T_CMPNY_DATA` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY_DATA` (`cmpny_id`);

--
-- Constraints for table `T_PRJ`
--
ALTER TABLE `T_PRJ`
  ADD CONSTRAINT `FK_T_PRJ_T_STATUS` FOREIGN KEY (`status_id`) REFERENCES `T_PRJ_STATUS` (`id`);

--
-- Constraints for table `T_PRJ_ACSS_CMPNY`
--
ALTER TABLE `T_PRJ_ACSS_CMPNY`
  ADD CONSTRAINT `FK_T_PRJ_ACSS_CMPNY_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`),
  ADD CONSTRAINT `FK_T_PRJ_ACSS_CMPNY_T_PRJ` FOREIGN KEY (`prj_id`) REFERENCES `T_PRJ` (`id`);

--
-- Constraints for table `T_PRJ_ACSS_USER`
--
ALTER TABLE `T_PRJ_ACSS_USER`
  ADD CONSTRAINT `FK_T_PRJ_ACSS_USER_T_PRJ` FOREIGN KEY (`prj_id`) REFERENCES `T_PRJ` (`id`),
  ADD CONSTRAINT `FK_T_PRJ_ACSS_USER_T_USER` FOREIGN KEY (`user_id`) REFERENCES `T_USER` (`id`);

--
-- Constraints for table `T_PRJ_CMPNY`
--
ALTER TABLE `T_PRJ_CMPNY`
  ADD CONSTRAINT `FK_T_PRJ_CMPNY_T_CMPNY` FOREIGN KEY (`cmpny_id`) REFERENCES `T_CMPNY` (`id`),
  ADD CONSTRAINT `FK_T_PRJ_CMPNY_T_PRJ` FOREIGN KEY (`prj_id`) REFERENCES `T_PRJ` (`id`);

--
-- Constraints for table `T_PRJ_CNSLTNT`
--
ALTER TABLE `T_PRJ_CNSLTNT`
  ADD CONSTRAINT `FK_T_PRJ_CNSLTNT_T_CNSLTNT` FOREIGN KEY (`cnsltnt_id`) REFERENCES `T_CNSLTNT` (`user_id`),
  ADD CONSTRAINT `FK_T_PRJ_CNSLTNT_T_PRJ` FOREIGN KEY (`prj_id`) REFERENCES `T_PRJ` (`id`);

--
-- Constraints for table `T_PRJ_CNTCT_PRSNL`
--
ALTER TABLE `T_PRJ_CNTCT_PRSNL`
  ADD CONSTRAINT `FK_T_PRJ_CNTCT_PRSNL_T_USER` FOREIGN KEY (`usr_id`) REFERENCES `T_USER` (`id`);

--
-- Constraints for table `T_PRJ_DOC`
--
ALTER TABLE `T_PRJ_DOC`
  ADD CONSTRAINT `FK_T_PRJ_DOC_T_DOC` FOREIGN KEY (`doc_id`) REFERENCES `T_DOC` (`id`),
  ADD CONSTRAINT `FK_T_PRJ_DOC_T_PRJ` FOREIGN KEY (`prj_id`) REFERENCES `T_PRJ` (`id`);

--
-- Constraints for table `T_USER`
--
ALTER TABLE `T_USER`
  ADD CONSTRAINT `FK_T_USER_T_ROLE` FOREIGN KEY (`role_id`) REFERENCES `T_ROLE` (`id`);

--
-- Constraints for table `T_USER_LOG`
--
ALTER TABLE `T_USER_LOG`
  ADD CONSTRAINT `FK_T_USER_LOG_T_USER` FOREIGN KEY (`user_id`) REFERENCES `T_USER` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
