-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2023 at 11:12 AM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softghor_bio-tec-corporation`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_to_account_transections`
--

CREATE TABLE `account_to_account_transections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `actual_payments`
--

CREATE TABLE `actual_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_payment` tinyint(1) DEFAULT 0,
  `payment_type` enum('receive','pay') NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `previous_due` decimal(14,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(12,2) NOT NULL,
  `due` decimal(14,2) NOT NULL DEFAULT 0.00,
  `date` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `opening_balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `opening_balance`, `default`, `created_at`, `updated_at`) VALUES
(1, 'CASH', 0.00, 1, '2023-08-17 12:15:04', '2023-08-17 12:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', 'Apple Brand Description', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(2, 'Microsoft', 'microsoft', 'Microsoft Brand Description', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(3, 'Nokia', 'nokia', 'Nokia Brand Description', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(4, 'Samsung', 'samsung', 'Sumsang Brand Description', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(5, 'Sony', 'sony', 'Sony Brand Description', '2023-08-17 12:15:07', '2023-08-17 12:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(2, 'House', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(3, 'Fashion', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(4, 'Hardware', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(5, 'Document', '2023-08-17 12:15:07', '2023-08-17 12:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_member_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `address` text DEFAULT NULL,
  `opening_receivable` decimal(12,2) DEFAULT NULL,
  `opening_payable` decimal(12,2) DEFAULT NULL,
  `wallet_balance` decimal(14,2) NOT NULL DEFAULT 0.00,
  `total_receivable` decimal(20,2) NOT NULL DEFAULT 0.00,
  `total_payable` decimal(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `sales_member_id`, `name`, `email`, `phone`, `address`, `opening_receivable`, `opening_payable`, `wallet_balance`, `total_receivable`, `total_payable`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sakib Rabby', 'sakib@gmail.com', '0184578745', 'Address', NULL, NULL, 0.00, 0.00, 0.00, '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(2, 1, 'Md Juwel Khan', 'juwel@gmail.com', '01845784545', 'Address', NULL, NULL, 0.00, 0.00, 0.00, '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(3, 1, 'Md Sumon', 'sumon@gmail.com', '01847898745', 'Address', NULL, NULL, 0.00, 0.00, 0.00, '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(4, 1, 'Mahmudul Hasan', 'mahmud@gmail.com', '0198784545', 'Address', NULL, NULL, 0.00, 0.00, 0.00, '2023-08-17 12:15:07', '2023-08-17 12:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `main_unit_qty` int(11) DEFAULT NULL,
  `sub_unit_qty` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `expense_date` date NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(191) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(144, '2014_10_12_000000_create_users_table', 1),
(145, '2014_10_12_100000_create_password_resets_table', 1),
(146, '2019_08_19_000000_create_failed_jobs_table', 1),
(147, '2020_01_26_115557_create_brands_table', 1),
(148, '2020_01_26_130703_create_images_table', 1),
(149, '2020_01_27_135457_create_categories_table', 1),
(150, '2020_01_28_054132_create_customers_table', 1),
(151, '2020_01_28_054624_create_profiles_table', 1),
(152, '2020_01_28_124130_create_products_table', 1),
(153, '2020_01_30_113323_create_pos_table', 1),
(154, '2020_01_30_113507_create_pos_items_table', 1),
(155, '2020_02_05_123521_create_payments_table', 1),
(156, '2020_02_23_092605_create_purchase_items_table', 1),
(157, '2020_02_26_072300_create_expense_categories_table', 1),
(158, '2020_02_26_072433_create_expenses_table', 1),
(159, '2020_03_03_080917_create_pos_settings_table', 1),
(160, '2020_06_08_121437_create_payment_methods_table', 1),
(161, '2020_08_31_191835_create_actual_payments_table', 1),
(162, '2021_02_19_102408_create_stocks_table', 1),
(163, '2021_02_19_140820_create_damages_table', 1),
(164, '2021_02_19_143344_create_order_returns_table', 1),
(165, '2021_02_19_143453_create_return_items_table', 1),
(166, '2022_05_18_160627_create_transactions_table', 1),
(167, '2022_06_18_023911_create_bank_accounts_table', 1),
(168, '2022_06_18_024357_create_account_to_account_transections_table', 1),
(169, '2022_06_18_031505_create_owners_table', 1),
(170, '2022_06_18_142016_create_units_table', 1),
(171, '2022_11_16_202243_create_permission_tables', 1),
(172, '2023_07_13_002908_create_sales_members_table', 1),
(173, '2023_07_13_003144_create_sales_designations_table', 1),
(174, '2023_07_13_005502_create_warehouses_table', 1),
(175, '2023_07_15_121841_create_stock_transfers_table', 1),
(176, '2023_07_16_004827_create_sales_targets_table', 1),
(177, '2023_07_16_004853_create_sales_commissions_table', 1),
(178, '2023_07_16_005017_create_sales_target_items_table', 1),
(179, '2023_08_05_122941_create_sales_areas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_returns`
--

CREATE TABLE `order_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pos_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `return_product_value` decimal(12,2) NOT NULL,
  `calculated_discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `actual_payment_id` int(11) NOT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `wallet_payment` tinyint(1) DEFAULT 0,
  `payment_date` date DEFAULT NULL,
  `payment_type` enum('receive','pay') NOT NULL,
  `paymentable_id` int(10) UNSIGNED NOT NULL,
  `paymentable_type` varchar(191) NOT NULL,
  `pay_amount` decimal(12,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hand Cash', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(2, 'Bank', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(3, 'Rocket', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(4, 'Bkash', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(5, 'Cash On Delivery', '2023-08-17 12:15:04', '2023-08-17 12:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `feature` varchar(191) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `feature`, `order`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list-owner', 'owner', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(2, 'create-owner', 'owner', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(3, 'edit-owner', 'owner', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(4, 'delete-owner', 'owner', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(5, 'list-bank_account', 'bank_account', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(6, 'create-bank_account', 'bank_account', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(7, 'show-bank_account', 'bank_account', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(8, 'list-warehouse', 'warehouse', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(9, 'create-warehouse', 'warehouse', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(10, 'edit-warehouse', 'warehouse', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(11, 'delete-warehouse', 'warehouse', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(12, 'list-brand', 'brand', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(13, 'create-brand', 'brand', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(14, 'edit-brand', 'brand', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(15, 'delete-brand', 'brand', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(16, 'list-category', 'category', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(17, 'create-category', 'category', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(18, 'edit-category', 'category', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(19, 'delete-category', 'category', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(20, 'list-product', 'product', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(21, 'create-product', 'product', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(22, 'edit-product', 'product', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(23, 'delete-product', 'product', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(24, 'list-pos', 'pos', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(25, 'create-pos', 'pos', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(26, 'show-pos', 'pos', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(27, 'edit-pos', 'pos', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(28, 'delete-pos', 'pos', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(29, 'list-return', 'return', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(30, 'create-return', 'return', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(31, 'delete-return', 'return', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(32, 'list-customer', 'customer', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(33, 'create-customer', 'customer', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(34, 'edit-customer', 'customer', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(35, 'delete-customer', 'customer', 0, 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(36, 'list-expense_category', 'expense_category', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(37, 'create-expense_category', 'expense_category', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(38, 'edit-expense_category', 'expense_category', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(39, 'delete-expense_category', 'expense_category', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(40, 'list-expense', 'expense', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(41, 'create-expense', 'expense', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(42, 'edit-expense', 'expense', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(43, 'delete-expense', 'expense', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(44, 'list-payment', 'payment', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(45, 'create-payment', 'payment', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(46, 'delete-payment', 'payment', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(47, 'list-damage', 'damage', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(48, 'create-damage', 'damage', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(49, 'delete-damage', 'damage', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(50, 'list-role', 'role', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(51, 'create-role', 'role', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(52, 'edit-role', 'role', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(53, 'delete-role', 'role', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(54, 'list-user', 'user', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(55, 'create-user', 'user', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(56, 'edit-user', 'user', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(57, 'delete-user', 'user', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(58, 'list-sales-designation', 'sales-designation', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(59, 'create-sales-designation', 'sales-designation', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(60, 'edit-sales-designation', 'sales-designation', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(61, 'delete-sales-designation', 'sales-designation', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(62, 'list-sales-area', 'sales-area', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(63, 'create-sales-area', 'sales-area', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(64, 'edit-sales-area', 'sales-area', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(65, 'delete-sales-area', 'sales-area', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(66, 'show-sales-area', 'sales-area', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(67, 'list-sales-member', 'sales-member', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(68, 'create-sales-member', 'sales-member', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(69, 'edit-sales-member', 'sales-member', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(70, 'delete-sales-member', 'sales-member', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(71, 'list-sales-target', 'sales-target', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(72, 'create-sales-target', 'sales-target', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(73, 'show-sales-target', 'sales-target', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(74, 'edit-sales-target', 'sales-target', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(75, 'delete-sales-target', 'sales-target', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(76, 'bank_account-add_money', 'bank_account', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(77, 'bank_account-withdraw_money', 'bank_account', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(78, 'bank_account-transfer', 'bank_account', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(79, 'bank_account-history', 'bank_account', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(80, 'product-sell_history', 'product', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(81, 'product-add_category', 'product', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(82, 'product-add_brand', 'product', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(83, 'product-barcode', 'product', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(84, 'pos-add_payment', 'pos', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(85, 'pos-add_customer', 'pos', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(86, 'pos_receipt', 'pos', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(87, 'chalan_receipt', 'pos', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(88, 'customer-wallet_payment', 'customer', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(89, 'customer-report', 'customer', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(90, 'stock', 'stock', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(91, 'payment_receipt', 'payment', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(92, 'promotional_sms', 'promotional_sms', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(93, 'target_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(94, 'target_summary', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(95, 'today_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(96, 'current_month_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(97, 'summary_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(98, 'daily_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(99, 'customer_due_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(100, 'supplier_due_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(101, 'low_stock_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(102, 'top_customer_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(103, 'top_product_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(104, 'top_product_all_time_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(105, 'purchase_report', 'report', 0, 'web', '2023-08-17 12:15:05', '2023-08-17 12:15:05'),
(106, 'customer_ledger', 'report', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(107, 'supplier_ledger', 'report', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(108, 'profit_loss_report', 'report', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(109, 'setting', 'misc', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(110, 'backup', 'misc', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(111, 'permissions', 'role', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(112, 'profile', 'profile', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(113, 'change_password', 'profile', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(114, 'dashboard', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(115, 'today_sold', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(116, 'today_sold-purchase_cost', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(117, 'today_expense', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(118, 'today_profit', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(119, 'current_month_sold', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(120, 'current_month_purchased', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(121, 'current_month_expense', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(122, 'current_month_returned', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(123, 'current_month_profit', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(124, 'total_sold', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(125, 'total_purchased', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(126, 'total_expense', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(127, 'total_returned', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(128, 'total_profit', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(129, 'total_receivable', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(130, 'total_payable', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(131, 'stock-purchase_value', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(132, 'stock-sell_value', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(133, 'total_customer', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(134, 'total_invoices', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06'),
(135, 'total_products', 'dashboard', 0, 'web', '2023-08-17 12:15:06', '2023-08-17 12:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `sale_date` date DEFAULT NULL,
  `sale_by` int(11) DEFAULT NULL,
  `sales_member_id` int(11) DEFAULT NULL,
  `pos_number` varchar(191) DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` varchar(191) DEFAULT NULL,
  `actual_discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `receivable` decimal(12,2) DEFAULT NULL,
  `paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `returned` decimal(12,2) NOT NULL DEFAULT 0.00,
  `final_receivable` decimal(12,2) NOT NULL DEFAULT 0.00,
  `due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_items`
--

CREATE TABLE `pos_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pos_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `main_unit_qty` int(11) DEFAULT NULL,
  `sub_unit_qty` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_settings`
--

CREATE TABLE `pos_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `header_text` varchar(191) DEFAULT NULL,
  `footer_text` varchar(191) DEFAULT NULL,
  `invoice_type` enum('a4','a4-2','a4-3','pos','pos-2','pos-3') NOT NULL,
  `invoice_logo_type` enum('Logo','Name','Both') NOT NULL DEFAULT 'Logo',
  `barcode_type` enum('single','a4') NOT NULL,
  `low_stock` int(11) NOT NULL DEFAULT 10,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_settings`
--

INSERT INTO `pos_settings` (`id`, `company`, `logo`, `address`, `email`, `phone`, `header_text`, `footer_text`, `invoice_type`, `invoice_logo_type`, `barcode_type`, `low_stock`, `dark_mode`, `created_at`, `updated_at`) VALUES
(1, 'Softghor.Com', 'dashboard/images/Final-Logo03.png', 'Holding: 53 (1st floor), Road: 04 Block: G,Banasree , Dhaka 1219. ', 'info@softghor.com', '01779724380', 'This is Header Text', 'This is Footer Text', 'a4', 'Logo', 'single', 10, 0, '2023-08-17 12:15:07', '2023-08-17 12:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `cost` decimal(8,2) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `main_unit_id` int(11) NOT NULL,
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `category_id`, `brand_id`, `cost`, `price`, `details`, `image`, `main_unit_id`, `sub_unit_id`, `created_at`, `updated_at`) VALUES
(12, 'velkin Shampoo 100ml', '67890', 6, NULL, 680.00, 680.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:16:31', '2023-08-13 04:16:31'),
(13, 'Acnovel Soap 75gm', '67891', 7, NULL, 495.00, 495.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:18:37', '2023-08-13 04:18:37'),
(14, 'Kiton Soap 50gm', '67892', 7, NULL, 452.00, 452.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:19:24', '2023-08-13 04:19:24'),
(15, 'Biotar Soap 75gm', '67893', 7, NULL, 550.00, 550.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:28:48', '2023-08-13 04:28:48'),
(16, 'Silkin-P Soap 75gm', '67894', 7, NULL, 475.00, 475.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:29:53', '2023-08-13 04:29:53'),
(19, 'Prickly Heat Soap 75gm', '67895', 7, NULL, 475.00, 475.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:34:46', '2023-08-13 04:34:46'),
(20, 'Wetee Soap 75gm', '67896', 7, NULL, 475.00, 475.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:37:39', '2023-08-13 04:37:39'),
(21, 'Bistar Shampoo 100ml', '67897', 6, NULL, 690.00, 690.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:38:38', '2023-08-13 04:38:38'),
(22, 'Biovera Lotion 100gm', '67898', 8, NULL, 780.00, 780.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:40:10', '2023-08-13 04:40:10'),
(23, 'Biogel 30gm', '67899', 9, NULL, 710.00, 710.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:42:34', '2023-08-13 04:42:34'),
(24, 'Biozia Face Wash 60gm', '67900', 10, NULL, 690.00, 690.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:43:34', '2023-08-13 04:43:34'),
(25, 'Bktin Shampoo 100ml', '67901', 6, NULL, 705.00, 705.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:46:18', '2023-08-13 04:56:20'),
(26, 'Blozic Soap 75gm', '67902', 7, NULL, 500.00, 500.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:51:37', '2023-08-13 04:51:37'),
(27, 'Velkin Shampoo 200ml', '67903', 6, NULL, 985.00, 985.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:52:18', '2023-08-13 04:52:18'),
(28, 'Biozia Sunscreen Lotion 30gm', '67904', 8, NULL, 980.00, 980.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:53:20', '2023-08-13 04:53:20'),
(29, 'Biocrack Cream 50gm', '67905', 11, NULL, 860.00, 860.00, NULL, 'dashboard/images/not-available.png', 1, NULL, '2023-08-13 04:54:54', '2023-08-13 04:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `user_id` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `avatar`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'dashboard/img/avatar/1.jpg', '1', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(2, 'dashboard/img/avatar/1.jpg', '2', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(3, 'dashboard/img/avatar/1.jpg', '3', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(4, 'dashboard/img/avatar/1.jpg', '4', '2023-08-17 15:29:33', '2023-08-17 15:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `main_unit_qty` int(11) DEFAULT NULL,
  `sub_unit_qty` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_return_id` int(11) NOT NULL,
  `pos_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `main_unit_qty` int(11) DEFAULT NULL,
  `sub_unit_qty` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(2, 'test_admin', 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(3, 'operator', 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(4, 'WarehouseAdmin', 'web', '2023-08-17 12:15:04', '2023-08-17 12:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(75, 1),
(75, 2),
(76, 1),
(76, 2),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(79, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(84, 3),
(85, 1),
(85, 2),
(85, 3),
(86, 1),
(86, 2),
(86, 3),
(87, 1),
(87, 2),
(87, 3),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(95, 1),
(95, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(105, 2),
(106, 1),
(106, 2),
(107, 1),
(107, 2),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(111, 1),
(111, 2),
(112, 1),
(112, 2),
(112, 3),
(113, 1),
(113, 2),
(113, 3),
(114, 1),
(114, 2),
(115, 1),
(115, 2),
(116, 1),
(116, 2),
(117, 1),
(117, 2),
(118, 1),
(118, 2),
(119, 1),
(119, 2),
(120, 1),
(120, 2),
(121, 1),
(121, 2),
(122, 1),
(122, 2),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(125, 1),
(125, 2),
(126, 1),
(126, 2),
(127, 1),
(127, 2),
(128, 1),
(128, 2),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(134, 2),
(135, 1),
(135, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_areas`
--

CREATE TABLE `sales_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_areas`
--

INSERT INTO `sales_areas` (`id`, `name`, `warehouse_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mitford', 2, 1, '2023-08-14 03:40:36', '2023-08-14 03:40:36'),
(2, 'Bhairab', 2, 1, '2023-08-14 03:41:05', '2023-08-14 03:41:05'),
(3, 'Matuail', 2, 1, '2023-08-14 03:41:25', '2023-08-14 03:41:25'),
(4, 'Mugda', 2, 1, '2023-08-14 03:41:35', '2023-08-14 03:41:35'),
(5, 'Munshigonj', 2, 1, '2023-08-14 03:41:55', '2023-08-14 03:41:55'),
(6, 'Dhaka Medical College Hospital (DMCH)', 2, 1, '2023-08-14 03:42:52', '2023-08-14 03:42:52'),
(7, 'Dhanmondi', 2, 1, '2023-08-14 03:43:18', '2023-08-14 03:43:18'),
(8, 'Narayanganj', 2, 1, '2023-08-14 03:43:40', '2023-08-14 03:43:40'),
(9, 'Dohar', 2, 1, '2023-08-14 03:43:52', '2023-08-14 03:43:52'),
(10, 'Nimtola', 2, 1, '2023-08-14 03:44:08', '2023-08-14 03:44:08'),
(11, 'Vulta', 2, 1, '2023-08-14 03:44:35', '2023-08-14 03:44:35'),
(12, 'Voberchar', 2, 1, '2023-08-14 03:45:42', '2023-08-14 03:46:26'),
(13, 'Homna', 2, 1, '2023-08-14 03:47:18', '2023-08-14 03:47:18'),
(14, 'Bajitpur', 2, 1, '2023-08-14 03:48:56', '2023-08-14 03:48:56'),
(15, 'Malibag', 2, 1, '2023-08-14 03:51:38', '2023-08-14 03:51:38'),
(16, 'BSMMU', 2, 1, '2023-08-14 03:52:25', '2023-08-14 03:52:25'),
(17, 'Uttara-1', 3, 1, '2023-08-14 03:54:58', '2023-08-14 03:54:58'),
(18, 'Uttara-2', 3, 1, '2023-08-14 03:55:10', '2023-08-14 03:55:10'),
(19, 'Gulshan', 3, 1, '2023-08-14 03:55:28', '2023-08-14 03:55:28'),
(20, 'Banani', 3, 1, '2023-08-14 03:55:42', '2023-08-14 03:55:42'),
(21, 'Gazipur', 3, 1, '2023-08-14 03:55:54', '2023-08-14 03:55:54'),
(22, 'Mawna', 3, 1, '2023-08-14 03:56:06', '2023-08-14 03:56:06'),
(23, 'Tongi', 3, 1, '2023-08-14 03:56:19', '2023-08-14 03:56:19'),
(24, 'Mirpur-1', 3, 1, '2023-08-14 03:56:56', '2023-08-14 03:56:56'),
(25, 'Mirpur-2', 3, 1, '2023-08-14 03:57:09', '2023-08-14 03:57:09'),
(26, 'Mohammadpur-1', 3, 1, '2023-08-14 03:57:45', '2023-08-14 03:57:45'),
(27, 'Mohammadpur-2', 3, 1, '2023-08-14 03:57:57', '2023-08-14 03:57:57'),
(28, 'Narsingdi', 4, 1, '2023-08-14 03:59:18', '2023-08-14 03:59:18'),
(29, 'Raipura', 4, 1, '2023-08-14 03:59:57', '2023-08-14 04:05:39'),
(30, 'B.Baria', 4, 1, '2023-08-14 04:00:21', '2023-08-14 04:00:21'),
(31, 'Kishoreganj', 4, 1, '2023-08-14 04:00:52', '2023-08-14 04:00:52'),
(32, 'Sylhet-1', 4, 1, '2023-08-14 04:01:10', '2023-08-14 04:01:10'),
(33, 'Sylhet-2', 4, 1, '2023-08-14 04:01:24', '2023-08-14 04:01:24'),
(34, 'Sunamganj', 4, 1, '2023-08-14 04:01:53', '2023-08-14 04:01:53'),
(35, 'Moulovibazar', 4, 1, '2023-08-14 04:02:27', '2023-08-14 04:02:27'),
(36, 'Cumilla-1', 4, 1, '2023-08-14 04:02:41', '2023-08-14 04:02:41'),
(37, 'Cumilla-2', 4, 1, '2023-08-14 04:02:51', '2023-08-14 04:02:51'),
(38, 'Chauddogram', 4, 1, '2023-08-14 04:03:24', '2023-08-14 04:03:24'),
(39, 'Laksham', 4, 1, '2023-08-14 04:03:40', '2023-08-14 04:03:40'),
(40, 'Feni', 4, 1, '2023-08-14 04:03:56', '2023-08-14 04:03:56'),
(41, 'Chatkhil', 4, 1, '2023-08-14 04:04:10', '2023-08-14 04:04:10'),
(42, 'Maijdee', 4, 1, '2023-08-14 04:04:20', '2023-08-14 04:04:20'),
(43, 'Raipur', 4, 1, '2023-08-14 04:05:54', '2023-08-14 04:05:54'),
(44, 'Chandpur', 4, 1, '2023-08-14 04:06:13', '2023-08-14 04:06:13'),
(45, 'Motlob', 4, 1, '2023-08-14 04:06:26', '2023-08-14 04:06:26'),
(46, 'Hajiganj', 4, 1, '2023-08-14 04:06:49', '2023-08-14 04:06:49'),
(47, 'Laxmipur', 4, 1, '2023-08-14 04:07:02', '2023-08-14 04:07:02'),
(48, 'Rangpur-1', 4, 1, '2023-08-14 04:07:32', '2023-08-14 04:07:32'),
(49, 'Rangpur-2', 4, 1, '2023-08-14 04:07:45', '2023-08-14 04:07:45'),
(50, 'Gaibandha', 4, 1, '2023-08-14 04:07:59', '2023-08-14 04:07:59'),
(51, 'Thakurgaon', 4, 1, '2023-08-14 04:08:17', '2023-08-14 04:08:17'),
(52, 'Dinajpur', 4, 1, '2023-08-14 04:08:29', '2023-08-14 04:08:29'),
(53, 'Rajshahi-1', 4, 1, '2023-08-14 04:08:48', '2023-08-14 04:08:48'),
(54, 'Rajshahi-2', 4, 1, '2023-08-14 04:09:14', '2023-08-14 04:09:14'),
(55, 'Bogura', 4, 1, '2023-08-14 04:09:23', '2023-08-14 04:09:23'),
(56, 'Pabna-1', 4, 1, '2023-08-14 04:09:41', '2023-08-14 04:09:41'),
(57, 'Sirajganj', 4, 1, '2023-08-14 04:10:17', '2023-08-14 04:10:17'),
(58, 'Ishwardi', 4, 1, '2023-08-14 04:10:33', '2023-08-14 04:10:33'),
(59, 'Bahaddarhat', 4, 1, '2023-08-14 04:14:03', '2023-08-14 04:14:03'),
(60, 'Agrabad', 4, 1, '2023-08-14 04:14:26', '2023-08-14 04:14:26'),
(61, 'Sitakundu', 4, 1, '2023-08-14 04:14:41', '2023-08-14 04:14:41'),
(62, 'Mirersorai', 4, 1, '2023-08-14 04:14:56', '2023-08-14 04:14:56'),
(63, 'Muradpur', 4, 1, '2023-08-14 04:15:06', '2023-08-14 04:15:06'),
(64, 'Andarkilla', 4, 1, '2023-08-14 04:15:19', '2023-08-14 04:15:19'),
(65, 'CMCH-CTG', 4, 1, '2023-08-14 04:15:40', '2023-08-14 04:15:40'),
(66, 'Hathazari', 4, 1, '2023-08-14 04:15:55', '2023-08-14 04:15:55'),
(67, 'Rangamati', 4, 1, '2023-08-14 04:16:06', '2023-08-14 04:16:06'),
(68, 'Keranirhat', 4, 1, '2023-08-14 04:16:42', '2023-08-14 04:16:42'),
(69, 'Cox Bazar', 4, 1, '2023-08-14 04:17:04', '2023-08-14 04:17:04'),
(70, 'Chakaria', 4, 1, '2023-08-14 04:17:16', '2023-08-14 04:17:16'),
(71, 'Teknaf', 4, 1, '2023-08-14 04:17:25', '2023-08-14 04:17:25'),
(72, 'Jashore', 4, 1, '2023-08-14 04:17:50', '2023-08-14 04:17:50'),
(73, 'Satkhira', 4, 1, '2023-08-14 04:18:10', '2023-08-14 04:18:10'),
(74, 'Jhinaidah', 4, 1, '2023-08-14 04:18:26', '2023-08-14 04:18:26'),
(75, 'Kustia', 4, 1, '2023-08-14 04:18:36', '2023-08-14 04:18:36'),
(76, 'Bagerhat', 4, 1, '2023-08-14 04:18:46', '2023-08-14 04:18:46'),
(77, 'Faridpur', 4, 1, '2023-08-14 04:19:29', '2023-08-14 04:19:29'),
(78, 'Gopalganj', 4, 1, '2023-08-14 04:19:41', '2023-08-14 04:19:41'),
(79, 'Madaripur', 4, 1, '2023-08-14 04:19:54', '2023-08-14 04:19:54'),
(80, 'Shariatpur', 4, 1, '2023-08-14 04:20:07', '2023-08-14 04:20:07'),
(81, 'Barishal', 4, 1, '2023-08-14 04:20:17', '2023-08-14 04:20:17'),
(82, 'Patuakhali', 4, 1, '2023-08-14 04:20:29', '2023-08-14 04:20:29'),
(83, 'Bhola', 4, 1, '2023-08-14 04:20:38', '2023-08-14 04:20:38'),
(84, 'Charfeshion', 4, 1, '2023-08-14 04:20:53', '2023-08-14 04:20:53'),
(85, 'Tangail', 3, 1, '2023-08-14 04:21:24', '2023-08-14 04:23:26'),
(86, 'Savar', 3, 1, '2023-08-14 04:21:33', '2023-08-14 04:26:41'),
(87, 'Jamgara', 3, 1, '2023-08-14 04:21:48', '2023-08-14 04:27:06'),
(88, 'Manikganj', 3, 1, '2023-08-14 04:22:16', '2023-08-14 04:26:58'),
(89, 'Maymensingh', 3, 1, '2023-08-14 04:22:44', '2023-08-14 04:26:49'),
(90, 'Jamalpur', 3, 1, '2023-08-14 04:22:57', '2023-08-14 04:24:03'),
(91, 'Valuka', 3, 1, '2023-08-14 04:23:07', '2023-08-14 04:23:37'),
(92, 'BANGLADESH', 1, 1, '2023-08-17 15:13:21', '2023-08-17 15:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `sales_commissions`
--

CREATE TABLE `sales_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_member_id` int(11) NOT NULL,
  `sales_target_id` int(11) NOT NULL,
  `sale_amount` decimal(12,2) NOT NULL,
  `percentage` decimal(3,2) NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `commission_month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_designations`
--

CREATE TABLE `sales_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 0,
  `commission_percentage` decimal(2,1) NOT NULL DEFAULT 0.0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_designations`
--

INSERT INTO `sales_designations` (`id`, `name`, `is_default`, `level`, `commission_percentage`, `created_at`, `updated_at`) VALUES
(1, 'MPO', 1, 1, 2.0, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(2, 'TM', 0, 2, 1.0, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(3, 'JR. RSM', 0, 3, 0.5, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(4, 'RSM', 0, 4, 0.1, '2023-08-17 12:15:04', '2023-08-17 15:15:59'),
(5, 'ASM', 0, 5, 0.1, '2023-08-17 12:15:04', '2023-08-17 15:16:23'),
(6, 'NSM', 0, 6, 0.1, '2023-08-17 12:15:04', '2023-08-17 15:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `sales_members`
--

CREATE TABLE `sales_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_designation_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `supirior_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `sales_area_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_members`
--

INSERT INTO `sales_members` (`id`, `sales_designation_id`, `name`, `mobile`, `address`, `supirior_id`, `warehouse_id`, `sales_area_id`, `created_at`, `updated_at`) VALUES
(6, 6, 'NSM', '01', NULL, NULL, 4, 28, '2023-08-17 15:13:55', '2023-08-19 03:25:23'),
(7, 5, 'ASM', '01', NULL, 6, 4, 28, '2023-08-17 15:14:14', '2023-08-19 03:33:28'),
(8, 4, 'RSM', '01', NULL, 7, 4, 28, '2023-08-17 15:14:36', '2023-08-19 03:33:54'),
(10, 3, 'J.RSM', '01', NULL, 8, 4, 28, '2023-08-17 15:17:17', '2023-08-19 03:34:26'),
(11, 2, 'TM', '01', NULL, 10, 4, 28, '2023-08-17 15:17:33', '2023-08-19 03:35:44'),
(12, 1, 'MPO', '01', NULL, 11, 4, 28, '2023-08-17 15:17:55', '2023-08-19 03:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `sales_targets`
--

CREATE TABLE `sales_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_member_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `twelve_month_date` date DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_targets`
--

INSERT INTO `sales_targets` (`id`, `sales_member_id`, `start_date`, `twelve_month_date`, `processed`, `created_at`, `updated_at`) VALUES
(1, 12, '2023-08-17', '2024-08-17', 0, '2023-08-17 15:18:13', '2023-08-17 15:18:13'),
(2, 12, '2023-03-01', '2024-03-01', 0, '2023-08-17 15:18:28', '2023-08-17 15:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `sales_target_items`
--

CREATE TABLE `sales_target_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_target_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `twelve_month_quantity` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_target_items`
--

INSERT INTO `sales_target_items` (`id`, `sales_target_id`, `product_id`, `twelve_month_quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 12, 1200, '2023-08-17 15:18:42', '2023-08-17 15:18:42'),
(2, 2, 13, 1200, '2023-08-17 15:18:51', '2023-08-17 15:18:51'),
(3, 2, 14, 1200, '2023-08-17 15:19:00', '2023-08-17 15:19:00'),
(4, 2, 15, 1200, '2023-08-17 15:19:11', '2023-08-17 15:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockable_type` varchar(191) NOT NULL,
  `stockable_id` int(11) NOT NULL,
  `purchase_id` bigint(20) NOT NULL,
  `purchase_item_id` bigint(20) NOT NULL,
  `stock_id` bigint(20) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `out` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_warehouse` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `main_unit_qty` int(11) DEFAULT NULL,
  `sub_unit_qty` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_transfers`
--

INSERT INTO `stock_transfers` (`id`, `to_warehouse`, `product_id`, `main_unit_qty`, `sub_unit_qty`, `qty`, `date`, `note`, `created_at`, `updated_at`) VALUES
(1, 4, 12, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33'),
(2, 4, 13, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33'),
(3, 4, 14, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33'),
(4, 4, 15, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33'),
(5, 4, 16, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33'),
(6, 4, 19, 100, 0, 100, '2023-08-17', NULL, '2023-08-17 15:26:33', '2023-08-17 15:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transactable_type` varchar(191) NOT NULL,
  `transactable_id` bigint(20) UNSIGNED NOT NULL,
  `debit` decimal(12,2) DEFAULT NULL,
  `credit` decimal(12,2) DEFAULT NULL,
  `balance` decimal(14,2) NOT NULL,
  `particulars` varchar(191) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `related_to_unit_id` int(11) DEFAULT NULL,
  `related_sign` varchar(191) DEFAULT NULL,
  `related_by` int(11) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `related_to_unit_id`, `related_sign`, `related_by`, `default`, `created_at`, `updated_at`) VALUES
(1, 'pc', NULL, NULL, NULL, 1, '2023-08-17 12:15:04', '2023-08-17 12:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `email_verified_at`, `password`, `warehouse_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@softghor.com', NULL, '$2y$10$g4Me06hfTavbVA2/yMZYy.v9Ln7J4eT5cj2O.iLdEvHg1GYhFWTee', NULL, '1KTy7XkfmMSHRdbwzfAzuDV9QeX5dJi08PEAJ77JqDCCR9WGOfZZu711TB1C', '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(2, 'Test', 'User', 'test@softghor.com', NULL, '$2y$10$G9VCM8o79LN/4.j3ktaR4u322S1qkGxpvgtzN3GBSbfWSVN/xsXJm', NULL, NULL, '2023-08-17 12:15:07', '2023-08-17 12:15:07'),
(3, 'Operator', 'Operator', 'operator@softghor.com', NULL, '$2y$10$G93MsDUQfI4I5frEz1sJs.7EwEmAf8kiAz0sABIqn1nNgCJU6/5ae', 4, NULL, '2023-08-17 12:15:07', '2023-08-17 15:27:31'),
(4, 'Rakibul', 'Islam', 'rakib@softghor.com', NULL, '$2y$10$IDCqL6h9qCY6AlnpWo.cP.x2ILhErZUB03mJeIruU0F/2kwJghh9a', 4, NULL, '2023-08-17 15:29:33', '2023-08-17 15:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Main Warehouse', 1, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(2, 'Jatrabari', 0, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(3, 'Uttara Office', 0, '2023-08-17 12:15:04', '2023-08-17 12:15:04'),
(4, 'Out Of Dhaka', 0, '2023-08-17 12:15:04', '2023-08-17 12:15:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_to_account_transections`
--
ALTER TABLE `account_to_account_transections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actual_payments`
--
ALTER TABLE `actual_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_items`
--
ALTER TABLE `pos_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_settings`
--
ALTER TABLE `pos_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales_areas`
--
ALTER TABLE `sales_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_commissions`
--
ALTER TABLE `sales_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_designations`
--
ALTER TABLE `sales_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_members`
--
ALTER TABLE `sales_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_targets`
--
ALTER TABLE `sales_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_target_items`
--
ALTER TABLE `sales_target_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_to_account_transections`
--
ALTER TABLE `account_to_account_transections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `actual_payments`
--
ALTER TABLE `actual_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `order_returns`
--
ALTER TABLE `order_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_items`
--
ALTER TABLE `pos_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_settings`
--
ALTER TABLE `pos_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_areas`
--
ALTER TABLE `sales_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `sales_commissions`
--
ALTER TABLE `sales_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_designations`
--
ALTER TABLE `sales_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_members`
--
ALTER TABLE `sales_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales_targets`
--
ALTER TABLE `sales_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_target_items`
--
ALTER TABLE `sales_target_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
