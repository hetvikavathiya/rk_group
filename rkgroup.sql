-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 12:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rkgroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `name`) VALUES
(1, 'Acc for buy gold and gold loan'),
(2, 'Acc for tour Umrah international'),
(3, 'Acc for savings'),
(4, 'Acc for marriage'),
(5, 'Acc for buy a bike'),
(6, 'Acc for buy a car'),
(7, 'Acc for buy durable products'),
(8, 'Acc for buy Furniture'),
(9, 'Acc for home renovations');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `user_type` varchar(15) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `middle_name`, `last_name`, `mobile`, `password`, `address`, `city`, `user_type`, `permission`, `status`, `created_at`, `updated_at`) VALUES
(1, 'C.E.O - REHAN KHAN', 'middle_name', 'last name', '9924963026', '8cb2237d0679ca88db6464eac60da96345513964', '', '', 'Admin', NULL, '1', '2022-11-05 11:44:43', '2023-10-30 11:58:15'),
(10, 'insiya', 'aliasger ', 'ghantiwala', '9712120953', 'cb8ff4a4a698df37d1d7436cd37d3c4b5733cdf6', 'A 403 GOLDEN 9 NEAR SAI BABA SOCIETY BIBI TALAV VATVA ', 'AHMEDABAD', 'Manager', 'Account Opening,Credit-Debit,Manage Customer', '0', '2022-12-06 10:48:34', '2023-10-23 18:03:47'),
(11, 'Ayan', 'Y', 'Khan', '9104344114', '0d45b274010e6fe87617178bc6b47fb336313660', 'ayanp6699@gmail.com', 'Ahmedabad', 'Manager', 'Manage Customer', '1', '2023-10-24 15:56:48', NULL),
(12, 'testing1', 'test', 'test', '9925701806', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'no', 'xyz', 'Staff', 'Credit-Debit', '1', '2023-10-26 10:30:24', '2023-10-30 15:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(24, 'fruits', '2023-10-31 15:18:40'),
(25, 'vegetable', '2023-10-31 15:18:46'),
(29, 'grains', '2023-11-01 16:46:07'),
(32, 'electronics', '2023-11-07 14:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `number`, `address`, `created_at`) VALUES
(1, 'rkgroupfinannce@gmail.com', '1234567867', '123,sardarmall,thakkarnager,ahemdabad,363550.', 111049);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `balance` decimal(15,2) NOT NULL,
  `aadhar_card` text NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `status` text NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `alternate_mobile_no` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` text NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `photo` text NOT NULL,
  `signature` text NOT NULL,
  `frontside_document` text NOT NULL,
  `backside_document` text NOT NULL,
  `document_type` text NOT NULL,
  `account_open_date` text DEFAULT NULL,
  `account_status` varchar(255) NOT NULL DEFAULT '0',
  `acc_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `balance`, `aadhar_card`, `first_name`, `middle_name`, `last_name`, `status`, `mobile`, `alternate_mobile_no`, `password`, `address`, `email`, `city`, `photo`, `signature`, `frontside_document`, `backside_document`, `document_type`, `account_open_date`, `account_status`, `acc_type_id`, `created_at`, `updated_at`) VALUES
(1, 2100.48, '923004758158', 'Aamir', 'Rashid ', 'Patel', 'Approved', '7383141940', '7383141940', '1f332f9c853fbb7ba637516bc832a87d10d2c901', '27 kutubnagar gali n 1 saiydavadi vatava', 'aamirpatel9170@gmail.com', 'Ahmedabad ', '20231024101305b03new.jpeg', '20231024101305f19new.jpeg', '20231024101305ed3new.jpeg', '20231024101305b60new.jpeg', 'Aadhaar Card', '2023-10-24', '1', 0, '2023-10-24 01:55:57', '0000-00-00 00:00:00'),
(2, 2000.44, '300110765534', 'Zahir husain', 'Husain miya ', 'Malek', 'Approved', '9998800155', '9157869955', '8b637c06f82727e3e7ac96a4f936a9274ef433d0', '75,Mustaq soc.Nr.golden cinema', 'zahirhusain9098@gmail.com', 'Ahmedabad', '20231024112645e2dnew.jpeg', '2023102411264563enew.jpeg', '20231024112645882new.jpeg', '202310241126458d9new.jpeg', 'Aadhaar Card', '2023-10-24', '1', 0, '2023-10-24 16:17:23', '0000-00-00 00:00:00'),
(3, 2000.44, '905957049975', 'Sultankhan', 'I', 'Pathan', 'Approved', '9998661952', '7984935203', '8cb2237d0679ca88db6464eac60da96345513964', '869widows home vatva 382440', 'sultankhan12546@gmail.com', 'Ahmedabad ', '202310240603104cenew.jpg', '202310240603102c7new.mp4', '20231024060310618new.jpg', '20231024060310b6cnew.jpg', 'Aadhaar Card', '2023-10-24', '1', 0, '2023-10-24 23:33:10', '0000-00-00 00:00:00'),
(4, 500.09, '300319535985', 'Siraj khan pathan', '7862877067', 'Siraj', 'Approved', '7862877067', '7862877067', '8cb2237d0679ca88db6464eac60da96345513964', 'Ahmedabad vatva golden cinema ke piche Nur Nagar', 'rk9005958@gmail.com', 'Ahmedabad', '202310251113023ccnew.jpeg', '20231025111302fcenew.jpeg', '20231025111302d7enew.jpeg', '2023102511130278bnew.jpeg', 'Aadhaar Card', '2023-10-25', '1', 0, '2023-10-25 00:45:23', '0000-00-00 00:00:00'),
(5, 0.00, '317722822615', 'Pathan', 'Saddamkhan', 'Zaheerkhan', 'Approved', '9712603255', '9712603235', '8cb2237d0679ca88db6464eac60da96345513964', '36,green chowk vatva', 'psaddamkhanz@gmail.com', 'Ahemdabad ', '20231025022653205new.jpeg', '202310250226539b8new.jpeg', '20231025022653358new.jpeg', '20231025022653765new.jpeg', 'Aadhaar Card', '2023-10-25', '1', 0, '2023-10-25 19:50:55', '0000-00-00 00:00:00'),
(6, 0.00, '990900766101', 'Shabbir', 'Nurudinbhai ', 'RANGWALA', 'Approved', '6353098430', '6353098430', '8cb2237d0679ca88db6464eac60da96345513964', '206-C 2ND/F .TAJ RESIDENCY, OPP. SAIBABA SOCIETY VATVA', 'sohelrangwala303@gmail.com', 'Ahmedabad', '', '', '20231026054215f0dnew.jpg', '', 'Aadhaar Card', NULL, '0', 0, '2023-10-26 23:12:15', '0000-00-00 00:00:00'),
(15, 0.00, '246778995634', 'raghav', 'sureshbhai', 'kavathiya', 'Approved', '8780529550', '9727693344', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'sardarmall,thakkarnager', 'pkav12@gmail.com', 'surat', '202311200926553da.jpg', '20231120092655749.jpg', '20231120092655f4c.jpg', '20231120092655d3f.jpg', 'Pan Card', NULL, '0', 6, '2023-11-20 13:56:55', '2023-11-20 14:12:14'),
(16, 0.00, '523456721215', 'hetu', '', 'kavathiya', 'Pending', '8975625436', '8765456273', '453e784fe5889658bb0f48c7584a7a97f72c2a71', 'deav', 'pkav12@gmail.com', 'rajkot', '202311200935119a9.jpg', '20231120093511629.jpg', '2023112009351196c.jpg', '20231120093511835.jpg', 'Pan Card', NULL, '0', 8, '2023-11-20 14:05:11', '0000-00-00 00:00:00'),
(17, 0.00, '123245236745', 'raj', 'sureshbhai', 'kavathiya', 'Approved', '9662122635', '8739671658', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'deav', 'pkav12@gmail.com', 'vadodara', '', '', '20231120094100110.jpg', '', 'Driving Licence', NULL, '0', 7, '2023-11-20 14:11:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `image`, `name`, `feedback`, `company_name`, `created_at`) VALUES
(1, '20231120110745fdf.jpg', 'hetvi', '  this is a first feedback                             ', 'ceo-it company', '2023-11-20 15:37:45'),
(2, '20231120111934faf.jpg', 'hetvi12', '     this is second feedback                           ', 'manager - office', '2023-11-20 15:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `inquiry` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `mobile_no`, `inquiry`, `created_at`) VALUES
(1, 'poonam', '9974089992', 'inquiry 1', '2023-11-20 14:51:40'),
(2, 'rensi', '9974089992', 'inquiry 2\r\n', '2023-11-20 15:04:46'),
(3, 'hetvi12', '9974089992', 'dfghjkl', '2023-11-20 15:11:26'),
(4, 'hetvi1', '9974089992', '123456dsdfgh', '2023-11-20 15:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `unique_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `aadhar_card` varchar(12) NOT NULL,
  `name_2` varchar(100) NOT NULL,
  `mobile_2` varchar(10) NOT NULL,
  `aadhar_card_2` varchar(12) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `loan_interest` decimal(15,2) NOT NULL,
  `fixed_charge` decimal(15,2) NOT NULL,
  `payable_amount` decimal(15,2) NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `customer_id`, `unique_id`, `name`, `mobile`, `aadhar_card`, `name_2`, `mobile_2`, `aadhar_card_2`, `loan_type_id`, `loan_amount`, `loan_interest`, `fixed_charge`, `payable_amount`, `s_date`, `e_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 15, 'RKGROUP22441', 'rensi', '9974089992', '264412121212', 'rensi', '1111111111', '122323232323', 5, 12000.00, 1.00, 100.00, 12199.62, '2023-02-12', '2023-12-12', 1, '2023-11-20 16:38:09', '2023-11-20 16:38:09'),
(2, 17, 'RKGROUP22442', 'hetvi', '1111111111', '264412121215', 'rensi', '3333333333', '123456789887', 5, 15000.00, 2.00, 200.00, 15500.82, '2023-12-12', '2024-12-12', 1, '2023-11-20 16:41:19', '2023-11-20 16:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `loan_emi_details`
--

CREATE TABLE `loan_emi_details` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `installment_date` date NOT NULL,
  `installment_amount` decimal(15,2) NOT NULL,
  `payable_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `late_fee_charge` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_date` text DEFAULT NULL,
  `payment_proof` text NOT NULL,
  `remark` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_emi_details`
--

INSERT INTO `loan_emi_details` (`id`, `loan_id`, `user_id`, `status`, `installment_date`, `installment_amount`, `payable_amount`, `late_fee_charge`, `payment_mode`, `payment_date`, `payment_proof`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Pending', '2023-12-12', 12199.62, 0.00, 0.00, NULL, NULL, '', '', '2023-11-20 16:38:09', NULL),
(2, 2, 1, 'Pending', '2024-12-12', 15000.82, 0.00, 0.00, NULL, NULL, '', '', '2023-11-20 16:41:19', NULL),
(3, 2, 1, 'Pending', '2024-12-12', 500.00, 0.00, 0.00, NULL, NULL, '', '', '2023-11-20 16:41:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `name`) VALUES
(1, 'Gold loan'),
(2, 'Umrah tour loan international'),
(3, 'Bike loan'),
(4, 'Car loan'),
(5, 'Home loan'),
(6, 'Personal loan'),
(7, 'Home renovation loan'),
(8, 'Pay day loan'),
(9, 'Cash loan'),
(10, 'Consumer durable loans'),
(11, 'Furniture loans'),
(12, 'Other loan');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `mode`, `created_at`, `updated_at`) VALUES
(1, 'UPI', '2022-11-19 15:18:35', NULL),
(2, 'ACCOUNT TRANSFER\r\n', '2022-11-19 15:18:35', NULL),
(3, 'CHEQUE', '2022-11-19 15:18:56', NULL),
(4, 'CASH', '2022-11-19 15:18:56', NULL),
(5, 'OTHER', '2022-11-19 15:19:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `discription` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `image`, `discription`, `created_at`) VALUES
(5, 24, 'hetvi', '20231031105255c11.jpg', 'sdff', 2147483647),
(6, 24, 'asd', '20231101094511c27.jpg', 'wsdc', 2147483647),
(7, 25, 'wedrf', '20231110091134637.jpg', '                                ', 2147483647),
(8, 24, 'ds', '2023110109470984e.jpg', 'sdc', 2147483647),
(11, 25, 'qwed', '20231110091125cb6.jpg', '                                ', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `late_fee_percentage` decimal(15,2) NOT NULL COMMENT 'per day',
  `open_account_charge` decimal(15,2) NOT NULL,
  `yearly_interest_credit` decimal(15,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `late_fee_percentage`, `open_account_charge`, `yearly_interest_credit`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1.25, 2000.00, 2.00, 1, '2022-11-18 12:14:47', '2023-10-24 16:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `title`, `priority`, `created_at`) VALUES
(25, '20231110090823568.jpg', 'elecronics', '1', 2147483647),
(27, '20231110090807726.jpg', 'Furniture Design', '2', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `image`, `name`, `designation`, `created_at`) VALUES
(5, '20231101082301d13.jpg', 'rensi', 'manager', '2023-11-01 12:53:01'),
(6, '20231101101413a38.jpg', 'hetvi', 'manager', '2023-11-01 12:53:10'),
(7, '20231101082335569.jpg', 'raghav', 'sales manager 2', '2023-11-01 12:53:35'),
(10, '20231107120317bca.jpg', 'prit', 'sales manager', '2023-11-07 16:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `txn_type`
--

CREATE TABLE `txn_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `txn_type`
--

INSERT INTO `txn_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ACCOUNT OPENING', '0000-00-00 00:00:00', NULL),
(2, 'AMOUNT DEPOSIT', '0000-00-00 00:00:00', NULL),
(3, 'AMOUNT WITHDRAWAL', '0000-00-00 00:00:00', NULL),
(4, 'CREDIT INTEREST', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `type` varchar(1) NOT NULL COMMENT 'C=credit,D=debit',
  `amount` decimal(15,2) NOT NULL,
  `balance` decimal(15,2) DEFAULT NULL,
  `txn_id` int(11) DEFAULT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_proof` text DEFAULT NULL,
  `w_date` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `customer_id`, `type`, `amount`, `balance`, `txn_id`, `payment_mode`, `payment_proof`, `w_date`, `remark`, `created_at`) VALUES
(1, 1, 'C', 2000.00, 2000.00, 1, '4', NULL, '2023-10-24', 'saving', '2023-10-24 10:20:23'),
(2, 1, 'C', 2000.00, 4000.00, 1, '4', NULL, '2023-10-24', 'saving', '2023-10-24 10:20:52'),
(3, 1, 'D', 2000.00, 2000.00, 3, '4', NULL, '2023-10-24', 'cash', '2023-10-24 10:21:28'),
(4, 1, 'C', 100.00, 2100.00, 2, '4', NULL, '2023-10-24', 'saving', '2023-10-24 10:38:48'),
(5, 1, 'C', 100.00, 2200.00, 2, '4', NULL, '2023-10-24', 'saving', '2023-10-24 10:38:55'),
(6, 1, 'D', 100.00, 2100.00, 3, '4', NULL, '2023-10-24', 'cash', '2023-10-24 10:39:21'),
(7, 2, 'C', 2000.00, 2000.00, 1, '4', NULL, '2023-10-24', 'cash', '2023-10-24 11:27:23'),
(8, 3, 'C', 2000.00, 2000.00, 1, '4', NULL, '2023-10-24', 'Saved ', '2023-10-24 18:18:08'),
(9, 1, 'C', 0.12, 2100.12, 4, '', NULL, '2023-10-24', '', '2023-10-24 19:30:02'),
(10, 2, 'C', 0.11, 2000.11, 4, '', NULL, '2023-10-24', '', '2023-10-24 19:30:02'),
(11, 3, 'C', 0.11, 2000.11, 4, '', NULL, '2023-10-24', '', '2023-10-24 19:30:02'),
(12, 4, 'C', 500.00, 500.00, 1, '4', NULL, '2023-10-25', 'Cash', '2023-10-25 11:13:25'),
(13, 5, 'C', 3000.00, 3000.00, 1, '2', NULL, '2023-10-25', 'Bank transfer ', '2023-10-25 14:28:56'),
(14, 1, 'C', 0.12, 2100.24, 4, '', NULL, '2023-10-25', '', '2023-10-25 19:30:02'),
(15, 2, 'C', 0.11, 2000.22, 4, '', NULL, '2023-10-25', '', '2023-10-25 19:30:02'),
(16, 3, 'C', 0.11, 2000.22, 4, '', NULL, '2023-10-25', '', '2023-10-25 19:30:02'),
(17, 4, 'C', 0.03, 500.03, 4, '', NULL, '2023-10-25', '', '2023-10-25 19:30:02'),
(18, 5, 'C', 0.16, 3000.16, 4, '', NULL, '2023-10-25', '', '2023-10-25 19:30:02'),
(19, 5, 'D', 3000.16, 0.00, 3, '4', NULL, '2023-10-26', 'cash', '2023-10-26 11:12:20'),
(20, 1, 'C', 0.12, 2100.36, 4, '', NULL, '2023-10-26', '', '2023-10-26 19:30:02'),
(21, 2, 'C', 0.11, 2000.33, 4, '', NULL, '2023-10-26', '', '2023-10-26 19:30:02'),
(22, 3, 'C', 0.11, 2000.33, 4, '', NULL, '2023-10-26', '', '2023-10-26 19:30:02'),
(23, 4, 'C', 0.03, 500.06, 4, '', NULL, '2023-10-26', '', '2023-10-26 19:30:02'),
(24, 5, 'C', 0.00, 0.00, 4, '', NULL, '2023-10-26', '', '2023-10-26 19:30:02'),
(25, 1, 'C', 0.12, 2100.48, 4, '', NULL, '2023-10-27', '', '2023-10-27 19:30:01'),
(26, 2, 'C', 0.11, 2000.44, 4, '', NULL, '2023-10-27', '', '2023-10-27 19:30:01'),
(27, 3, 'C', 0.11, 2000.44, 4, '', NULL, '2023-10-27', '', '2023-10-27 19:30:02'),
(28, 4, 'C', 0.03, 500.09, 4, '', NULL, '2023-10-27', '', '2023-10-27 19:30:02'),
(29, 5, 'C', 0.00, 0.00, 4, '', NULL, '2023-10-27', '', '2023-10-27 19:30:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_emi_details`
--
ALTER TABLE `loan_emi_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `txn_type`
--
ALTER TABLE `txn_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `w_date` (`w_date`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_emi_details`
--
ALTER TABLE `loan_emi_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `txn_type`
--
ALTER TABLE `txn_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
