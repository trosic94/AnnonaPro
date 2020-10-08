-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 08, 2020 at 08:08 AM
-- Server version: 10.2.14-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annonapro_com_102020`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_category`
--

DROP TABLE IF EXISTS `attributes_category`;
CREATE TABLE IF NOT EXISTS `attributes_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`) USING BTREE,
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_product`
--

DROP TABLE IF EXISTS `attributes_product`;
CREATE TABLE IF NOT EXISTS `attributes_product` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `attribute_value_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_p_id` (`attribute_id`),
  KEY `product_p_id` (`product_id`),
  KEY `attribute_value_id` (`attribute_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_values`
--

DROP TABLE IF EXISTS `attributes_values`;
CREATE TABLE IF NOT EXISTS `attributes_values` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `status` int(10) NOT NULL,
  `label` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_order` int(10) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_v_id` (`attribute_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `title`, `description`, `color`, `text_color`, `image`, `created_at`, `updated_at`) VALUES
(6, '25', '25 poena', '#000000', '#000000', NULL, '2020-09-22 09:19:57', '2020-09-22 09:19:57'),
(7, '50', '50 poena', '#000000', '#000000', NULL, '2020-09-22 09:20:10', '2020-09-22 09:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `badges_products`
--

DROP TABLE IF EXISTS `badges_products`;
CREATE TABLE IF NOT EXISTS `badges_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `badge_id` (`badge_id`),
  KEY `product_id_bdg_fk` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `position_id_ban_fk` (`position_id`),
  KEY `client_id_ban_fk` (`client_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `url`, `target`, `image`, `start_date`, `end_date`, `description`, `position_id`, `client_id`, `created_at`, `updated_at`) VALUES
(2, 'Levo', '/edukacija/', '_self', '1-04092020071502-edukacija.png', '2020-06-28 13:34:00', '2022-07-14 12:23:00', 'asd asd asd asd', 4, 1, '2020-10-01 06:55:37', '0000-00-00 00:00:00'),
(4, 'Veliki za pocetnu', '/products/video-igrice/ps4-igre', '_self', '1-04092020070926-100087157_3121027647961775_689800304975151104_o@2x.png', '2020-07-01 13:38:00', '2020-09-01 22:02:00', NULL, 3, 1, '2020-09-04 03:09:27', '0000-00-00 00:00:00'),
(5, 'Brendiranje levo', 'https://www.google.com', '_blank', '1-07082020083203-last_of_us_part2---360x1080---pozadinski-baner.jpg', '2020-07-01 14:13:00', '2020-09-01 22:00:00', NULL, 1, 1, '2020-09-03 18:00:43', '0000-00-00 00:00:00'),
(6, 'Brendiranje desno', 'https://www.google.com', '_blank', '1-07082020083222-ghost_of_tsushima---360x1080---pozadinski-baner.jpg', '2020-07-01 14:14:00', '2020-09-01 22:00:00', NULL, 2, 1, '2020-09-03 18:00:19', '0000-00-00 00:00:00'),
(7, 'Desno', '/products/', '_self', '1-04092020071414-test.png', '2020-07-01 14:14:00', '2021-04-16 07:28:00', NULL, 5, 1, '2020-10-01 05:28:40', '0000-00-00 00:00:00'),
(8, 'company 1', '#', '_self', '1-04092020223333-max2_bw.png', '2020-09-04 22:33:00', '2021-12-02 22:33:00', NULL, 6, 1, '2020-09-04 18:33:33', '0000-00-00 00:00:00'),
(9, 'company 2', '#', '_self', '1-04092020223405-toskani_bw.png', '2020-09-04 22:33:00', '2021-12-10 22:33:00', NULL, 6, 1, '2020-09-04 18:34:05', '0000-00-00 00:00:00'),
(10, 'company 3', '#', '_self', '1-04092020224349-max2_bw.png', '2020-09-04 22:43:00', '2027-01-01 22:43:00', NULL, 6, 1, '2020-09-04 18:43:49', '0000-00-00 00:00:00'),
(11, 'company 4', '#', '_self', '1-04092020224437-toskani_bw.png', '2020-09-04 22:44:00', '2027-07-28 22:44:00', NULL, 6, 1, '2020-09-04 18:44:37', '0000-00-00 00:00:00'),
(12, 'company 5', '#', '_self', '1-04092020224503-max2_bw.png', '2020-09-04 22:44:00', '2026-12-03 22:44:00', NULL, 6, 1, '2020-09-04 18:45:03', '0000-00-00 00:00:00'),
(13, 'company 6', '#', '_self', '1-04092020224548-toskani_bw.png', '2020-09-04 22:45:00', '2021-11-24 22:45:00', NULL, 6, 1, '2020-09-04 18:45:48', '0000-00-00 00:00:00'),
(14, 'Prodavnica banner', '/products', '_self', '1-01102020173254-1-05092020213522-beauty-products-XLZ5PD3 (1)_web.png', '2020-09-04 21:34:00', '2030-02-27 13:27:00', 'Pocetna strana prodavnice', 7, 1, '2020-10-01 15:32:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners_clients`
--

DROP TABLE IF EXISTS `banners_clients`;
CREATE TABLE IF NOT EXISTS `banners_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners_clients`
--

INSERT INTO `banners_clients` (`id`, `name`, `phone`, `email`, `company`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Davor', '0692150512', 'davor.kikindjanin@onestopmarketing.rs', 'One Stop Marketing', 'Ako je potreban neki opis', '2020-07-31 06:15:46', '2020-07-31 06:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `banners_positions`
--

DROP TABLE IF EXISTS `banners_positions`;
CREATE TABLE IF NOT EXISTS `banners_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners_positions`
--

INSERT INTO `banners_positions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Branding Left', 'Left side site branding banner', '2020-07-31 06:01:49', '2020-07-31 06:01:49'),
(2, 'Branding Right', 'Right side site branding banner', '2020-07-31 06:01:36', '2020-07-31 06:01:36'),
(3, 'Home Wide', 'Wide banner for home page', '2020-07-31 06:01:04', '2020-07-31 06:01:04'),
(4, 'Home Row 1', 'Banner for home page on ROW 2', '2020-07-31 06:00:49', '2020-07-31 06:00:49'),
(5, 'Home Row 2', 'Banner for home page on ROW 2', '2020-07-31 06:00:38', '2020-07-31 06:00:38'),
(6, 'Home row 2 - company', NULL, '2020-09-04 18:32:40', '2020-09-04 18:32:40'),
(7, 'Prodavnica banner', 'Baner na ulasku u prodavnicu', '2020-09-05 19:34:06', '2020-09-05 19:34:06'),
(8, 'Edukacija baner', 'Edukacija baner', '2020-09-22 05:51:57', '2020-09-22 05:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `banners_track_impressions`
--

DROP TABLE IF EXISTS `banners_track_impressions`;
CREATE TABLE IF NOT EXISTS `banners_track_impressions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `impression_count` int(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `banner_id_trck_fk` (`banner_id`),
  KEY `position_id_trck_fk` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners_track_impressions`
--

INSERT INTO `banners_track_impressions` (`id`, `banner_id`, `position_id`, `impression_count`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 1, '2020-07-31 11:12:56', '2020-07-31 11:12:56'),
(3, 4, 3, 0, '2020-07-31 09:39:08', '0000-00-00 00:00:00'),
(4, 5, 1, 7, '2020-07-31 11:04:38', '2020-07-31 11:04:38'),
(5, 6, 2, 3, '2020-07-31 11:08:57', '2020-07-31 11:08:57'),
(6, 7, 5, 1, '2020-07-31 11:04:04', '2020-07-31 11:04:04'),
(7, 8, 6, 0, '2020-09-04 18:33:33', '0000-00-00 00:00:00'),
(8, 9, 6, 0, '2020-09-04 18:34:05', '0000-00-00 00:00:00'),
(9, 10, 6, 0, '2020-09-04 18:43:49', '0000-00-00 00:00:00'),
(10, 11, 6, 0, '2020-09-04 18:44:37', '0000-00-00 00:00:00'),
(11, 12, 6, 0, '2020-09-04 18:45:03', '0000-00-00 00:00:00'),
(12, 13, 6, 0, '2020-09-04 18:45:35', '0000-00-00 00:00:00'),
(13, 14, 7, 0, '2020-09-05 19:35:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `import_id` int(100) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `use_product_price` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_color` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `import_id`, `order`, `name`, `slug`, `cat_image`, `published`, `created_at`, `use_product_price`, `updated_at`, `meta_description`, `meta_keywords`, `cat_color`) VALUES
(3, NULL, NULL, 1, 'Proizvodi', 'products', '', 1, '2019-05-16 14:48:16', 0, '2020-09-04 16:51:06', 'Proizvodi', 'Proizvodi', '#f20202'),
(19, 3, NULL, 4, 'Pigmentne fleke', 'pigmentne-fleke', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:32:38', 'Pigmentne fleke', 'Pigmentne fleke', '#ffe075'),
(21, 3, NULL, 5, 'Rozacea', 'rozacea', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:34:19', 'Rozacea', 'Rozacea', '#f6adcd'),
(22, 3, NULL, 12, 'Trepavice', 'trepavice', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:48:30', 'Trepavice', 'Trepavice', '#3f9d87'),
(23, 3, NULL, 6, 'Zona oko očiju', 'zona-oko-ociju', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:42:08', 'Zona oko očiju', 'Zona oko očiju', '#97adda'),
(24, 3, NULL, 1, 'Anti aging', 'anti-aging', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:32:52', 'Anti aging', 'Anti aging', '#b0acd5'),
(25, 3, NULL, 2, 'Dehidratacija', 'dehidratacija', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:33:05', 'Dehidratacija', 'Dehidratacija', '#abe1fa'),
(26, 3, NULL, 3, 'Akne i seborea', 'akne-i-seborea', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:33:17', 'Akne i seborea', 'Akne i seborea', '#ccb1af'),
(75, 3, NULL, 13, 'Trajna šminka i jednokratni proizvodi', 'trajna-sminka-i-jednokratni-proizvodi', '', 1, '2020-09-02 12:25:21', 1, '2020-10-06 08:49:02', 'Trajna šminka i jednokratni proizvodi', 'Trajna šminka i jednokratni proizvodi', '#c7a0cb'),
(83, NULL, NULL, 1, 'Edukacija', 'edukacija', '', 1, '2020-09-23 05:16:01', 0, '2020-10-06 08:19:27', 'Edukacija', 'Edukacija', '#000000'),
(85, 83, NULL, 1, 'Linije', 'linije', '', 1, '2020-09-23 05:53:15', 0, '2020-10-06 08:50:02', 'Linije', 'Linije', '#000000'),
(86, 83, NULL, 1, 'Obuke', 'obuke', '', 1, '2020-09-23 05:53:35', 0, '2020-10-06 08:50:12', 'Obuke', 'Obuke', '#000000'),
(88, 3, NULL, 7, 'Kosa', 'kosa', NULL, 1, '2020-10-06 08:43:04', 0, '2020-10-06 08:43:24', 'Kosa', 'Kosa', '#d9b28f'),
(89, 3, NULL, 8, 'Celulit i prekomerna težina', 'celulit-i-prekomerna-tezina', NULL, 1, '2020-10-06 08:44:34', 0, '2020-10-06 08:44:41', 'Celulit i prekomerna težina', 'Celulit i prekomerna težina', '#f48473'),
(90, 3, NULL, 9, 'Slabost vezivnog tkiva', 'slabost-vezivnog-tkiva', NULL, 1, '2020-10-06 08:45:39', 0, '2020-10-06 08:45:46', 'Slabost vezivnog tkiva', 'Slabost vezivnog tkiva', '#96d5d2'),
(91, 3, NULL, 10, 'Hemijski piling', 'hemijski-piling', NULL, 1, '2020-10-06 08:46:34', 0, '2020-10-06 08:46:42', 'Hemijski piling', 'Hemijski piling', '#b6dcae'),
(92, 3, NULL, 11, 'Aparati', 'aparati', NULL, 1, '2020-10-06 08:47:38', 0, '2020-10-06 08:47:51', 'Aparati', 'Aparati', '#ffadad'),
(93, NULL, NULL, 1, 'O nama', 'onama', NULL, 1, '2020-10-08 05:45:28', 0, '2020-10-08 05:45:28', NULL, NULL, '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
CREATE TABLE IF NOT EXISTS `data_rows` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 0, 1, 1, 1, 1, '{}', 4),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 10),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 11),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 12),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(8, 1, 'avatar', 'image', 'Image', 0, 0, 1, 1, 1, 1, '{}', 14),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 16),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 0, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 17),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 18),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 0, 1, 1, 1, 1, '{}', 15),
(22, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(23, 4, 'parent_id', 'select_dropdown', 'Parent', 0, 1, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"_empty_\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(24, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(25, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(26, 4, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '{}', 2),
(31, 5, 'category_id', 'text', 'Category', 0, 1, 1, 1, 1, 0, '{}', 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '{}', 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, '{}', 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, '{}', 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, '{}', 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 4),
(48, 6, 'body', 'rich_text_box', 'Body', 0, 0, 1, 1, 1, 1, '{}', 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, '{}', 12),
(56, 4, 'published', 'checkbox', 'Published', 0, 1, 1, 1, 1, 1, '{}', 6),
(57, 4, 'meta_description', 'text_area', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 9),
(58, 4, 'meta_keywords', 'text_area', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 10),
(59, 4, 'cat_image', 'image', 'Cat Image', 0, 1, 1, 1, 1, 1, '{\"quality\":\"100%\"}', 6),
(60, 8, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(61, 8, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(62, 8, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 3),
(63, 8, 'category_id', 'select_dropdown', 'Category', 1, 0, 1, 1, 1, 1, '{}', 5),
(64, 8, 'author_id', 'text', 'Author Id', 1, 0, 0, 0, 0, 0, '{}', 7),
(66, 8, 'excerpt', 'rich_text_box', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 9),
(67, 8, 'body', 'rich_text_box', 'Body', 0, 0, 1, 1, 1, 1, '{}', 10),
(68, 8, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 11),
(69, 8, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, '{}', 12),
(70, 8, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, '{}', 13),
(71, 8, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 14),
(72, 8, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, '{}', 15),
(73, 8, 'created_at', 'date', 'Created At', 1, 0, 0, 0, 0, 0, '{}', 16),
(74, 8, 'product_belongsto_category_relationship', 'relationship', 'Category', 0, 1, 1, 1, 1, 1, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4),
(75, 8, 'product_belongsto_user_relationship', 'relationship', 'Author', 0, 0, 0, 0, 0, 0, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"author_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(76, 8, 'updated_at', 'date', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 17),
(77, 8, 'sku', 'text', 'SKU', 1, 1, 1, 1, 1, 1, '{}', 2),
(85, 11, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(86, 11, 'value', 'text', 'Dimensions', 1, 1, 1, 1, 1, 1, '{}', 2),
(87, 12, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(88, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(89, 12, 'created_at', 'timestamp', 'Created At', 1, 0, 0, 0, 0, 0, '{}', 4),
(90, 12, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 5),
(91, 11, 'created_at', 'timestamp', 'Created At', 1, 0, 0, 0, 0, 0, '{}', 5),
(92, 11, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 6),
(95, 12, 'price', 'number', 'Price (m2)', 1, 1, 1, 1, 1, 1, '{}', 3),
(96, 11, 'width', 'text', 'Width (m)', 1, 1, 1, 1, 1, 1, '{}', 3),
(97, 11, 'height', 'text', 'Height (m)', 1, 1, 1, 1, 1, 1, '{}', 4),
(98, 1, 'discount', 'text', 'Discount (%)', 0, 0, 1, 1, 1, 1, '{}', 3),
(99, 1, 'company_name', 'text', 'Name', 0, 0, 1, 1, 1, 1, '{}', 5),
(100, 1, 'company_address', 'text', 'Address', 0, 0, 1, 1, 1, 1, '{}', 6),
(101, 1, 'company_phone', 'text', 'Phone', 0, 0, 1, 1, 1, 1, '{}', 7),
(102, 1, 'company_email', 'text', 'Email', 0, 0, 1, 1, 1, 1, '{}', 8),
(103, 1, 'company_vat', 'text', 'VAT', 0, 0, 1, 1, 1, 1, '{}', 9),
(104, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(105, 13, 'user_id', 'number', 'User Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(107, 13, 'created_at', 'date', 'Created At', 1, 1, 1, 1, 1, 1, '{}', 4),
(108, 13, 'updated_at', 'date', 'Updated At', 1, 0, 1, 1, 1, 1, '{}', 6),
(110, 13, 'order_invoice', 'text', 'Invoice No.', 1, 1, 1, 1, 1, 1, '{}', 3),
(111, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 0),
(112, 14, 'order_id', 'number', 'Order Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(113, 14, 'product_id', 'number', 'Product Id', 1, 0, 1, 1, 1, 1, '{}', 4),
(114, 14, 'material_id', 'number', 'Material Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(115, 14, 'dimensions_id', 'number', 'Dimensions Id', 1, 0, 1, 1, 1, 1, '{}', 8),
(116, 14, 'kolicina', 'number', 'Quantity', 1, 1, 1, 1, 1, 1, '{}', 10),
(117, 14, 'total', 'number', 'Total', 1, 1, 1, 1, 1, 1, '{}', 11),
(118, 14, 'created_at', 'date', 'Created At', 1, 1, 1, 0, 0, 1, '{}', 13),
(119, 14, 'updated_at', 'date', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 14),
(120, 13, 'order_hasmany_order_item_relationship', 'relationship', 'Order Items', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\OrderItems\",\"table\":\"order_items\",\"type\":\"hasMany\",\"column\":\"order_id\",\"key\":\"id\",\"label\":\"description\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(122, 13, 'rabat', 'text', 'Discount', 1, 1, 1, 1, 1, 1, '{}', 5),
(124, 14, 'order_item_hasone_product_relationship', 'relationship', 'Product', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Product\",\"table\":\"products\",\"type\":\"hasOne\",\"column\":\"id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(127, 11, 'dimension_hasmany_order_item_relationship', 'relationship', 'order_items', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\OrderItems\",\"table\":\"order_items\",\"type\":\"hasMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"dimensions_id\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(128, 12, 'material_hasone_order_item_relationship', 'relationship', 'order_items', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\OrderItems\",\"table\":\"order_items\",\"type\":\"hasOne\",\"column\":\"id\",\"key\":\"id\",\"label\":\"material_id\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(129, 13, 'order_belongsto_user_relationship', 'relationship', 'Customer', 0, 1, 1, 1, 1, 1, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(130, 14, 'order_item_belongsto_order_relationship', 'relationship', 'Order', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Order\",\"table\":\"orders\",\"type\":\"belongsTo\",\"column\":\"order_id\",\"key\":\"id\",\"label\":\"order_invoice\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(132, 14, 'order_item_belongsto_material_relationship', 'relationship', 'Material', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Material\",\"table\":\"materials\",\"type\":\"belongsTo\",\"column\":\"material_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(133, 14, 'order_item_belongsto_dimension_relationship', 'relationship', 'Dimensions', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Dimension\",\"table\":\"dimensions\",\"type\":\"belongsTo\",\"column\":\"dimensions_id\",\"key\":\"id\",\"label\":\"value\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(134, 15, 'id', 'number', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(135, 15, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(136, 15, 'description', 'rich_text_box', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(137, 15, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 1, 1, 1, '{}', 5),
(138, 15, 'updated_at', 'timestamp', 'Updated At', 1, 0, 1, 1, 1, 1, '{}', 6),
(139, 16, 'id', 'number', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(140, 16, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(141, 16, 'description', 'rich_text_box', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(142, 16, 'created_at', 'text', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 4),
(143, 16, 'updated_at', 'text', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 5),
(144, 13, 'order_status', 'number', 'Order Status', 1, 0, 1, 1, 1, 1, '{}', 9),
(145, 13, 'order_belongsto_order_status_relationship', 'relationship', 'Order status', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\OrderStatus\",\"table\":\"order_status\",\"type\":\"belongsTo\",\"column\":\"order_status\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(146, 13, 'payment_method', 'number', 'Payment Method', 1, 0, 1, 1, 1, 1, '{}', 11),
(147, 13, 'order_belongsto_payment_method_relationship', 'relationship', 'Payment Method', 0, 0, 1, 1, 1, 1, '{\"model\":\"App\\\\PaymentMethod\",\"table\":\"payment_methods\",\"type\":\"belongsTo\",\"column\":\"payment_method\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(148, 13, 'total', 'number', 'Total', 1, 1, 1, 1, 1, 1, '{}', 5),
(149, 15, 'active', 'checkbox', 'Active', 1, 1, 1, 1, 1, 1, '{}', 4),
(150, 14, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 12),
(151, 4, 'use_product_price', 'checkbox', 'Da li se koristi cena proizvoda? Opcija namenjena samo kategorijama proizvoda.', 1, 0, 1, 1, 1, 1, '{}', 12),
(152, 8, 'product_price', 'text', 'Cena proizvoda', 0, 0, 1, 1, 1, 1, '{}', 14),
(153, 13, 'proforma_invoice', 'text', 'Proforma Invoice', 1, 1, 1, 1, 1, 1, '{}', 8),
(154, 13, 'merchantPaymentId', 'text', 'MerchantPaymentId', 1, 0, 1, 1, 1, 1, '{}', 9),
(155, 13, 'pgTranId', 'text', 'PgTranId', 1, 0, 1, 1, 1, 1, '{}', 10),
(156, 8, 'product_discount', 'text', 'Product Discount', 0, 0, 1, 1, 1, 1, '{}', 15),
(157, 8, 'product_vat', 'text', 'Product Vat', 0, 0, 1, 1, 1, 1, '{}', 16),
(158, 18, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(159, 18, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(160, 18, 'description', 'text', 'Description', 1, 0, 1, 1, 1, 1, '{}', 3),
(161, 18, 'type', 'select_dropdown', 'Type', 1, 1, 1, 1, 1, 1, '{}', 4),
(162, 18, 'category_id', 'select_multiple', 'Category Id', 1, 0, 1, 1, 1, 1, '{}', 5),
(163, 18, 'unit', 'text', 'Unit', 1, 1, 1, 1, 1, 1, '{}', 6),
(164, 18, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{}', 7),
(165, 18, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 8),
(166, 18, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9),
(167, 19, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(168, 19, 'attribute_id', 'text', 'Attribute Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(169, 19, 'label', 'text', 'Label', 1, 1, 1, 1, 1, 1, '{}', 3),
(170, 19, 'value', 'text', 'Value', 1, 1, 1, 1, 1, 1, '{}', 4),
(171, 19, 'price', 'text', 'Price', 1, 0, 1, 1, 1, 1, '{}', 5),
(172, 19, 'image', 'text', 'Image', 1, 0, 1, 1, 1, 1, '{}', 6),
(173, 19, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 7),
(174, 19, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(175, 19, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 3),
(176, 19, 'value_order', 'text', 'Value Order', 1, 1, 1, 1, 1, 1, '{}', 6),
(177, 18, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 8),
(182, 25, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(183, 25, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(184, 25, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 3),
(185, 25, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 4),
(186, 25, 'import_id', 'text', 'Import Id', 0, 1, 1, 1, 1, 1, '{}', 5),
(187, 25, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 1, '{}', 6),
(188, 25, 'updated_at', 'timestamp', 'Updated At', 1, 1, 1, 0, 0, 1, '{}', 7),
(190, 8, 'manufacturer_id', 'text', 'Manufacturer', 1, 1, 1, 1, 1, 1, '{}', 7),
(191, 4, 'import_id', 'text', 'Import Id', 0, 0, 1, 1, 1, 1, '{}', 3),
(192, 26, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(193, 26, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(194, 26, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(195, 26, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 5),
(196, 26, 'updated_at', 'timestamp', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 6),
(197, 27, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(198, 27, 'slider_id', 'text', 'Slider Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(199, 27, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
(200, 27, 'text', 'text', 'Text', 0, 1, 1, 1, 1, 1, '{}', 4),
(201, 27, 'url', 'text', 'Url', 0, 1, 1, 1, 1, 1, '{}', 5),
(202, 27, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{}', 6),
(203, 27, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 9),
(204, 27, 'updated_at', 'timestamp', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 10),
(205, 27, 'slide_order', 'text', 'Slide Order', 1, 1, 1, 1, 1, 1, '{}', 8),
(206, 27, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 7),
(207, 26, 'slider_status', 'checkbox', 'Slider Status', 1, 1, 1, 1, 1, 1, '{}', 4),
(208, 27, 'url_target', 'select_dropdown', 'Url Target', 1, 0, 1, 1, 1, 1, '{\"default\":\"_self\",\"options\":{\"_self\":\"Isti prozor\",\"_blank\":\"Novi prozor\"}}', 6),
(209, 28, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(210, 28, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(211, 28, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(212, 28, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 4),
(213, 28, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 5),
(214, 28, 'updated_at', 'timestamp', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 6),
(215, 8, 'import_id', 'text', 'Import Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(216, 8, 'specification', 'rich_text_box', 'Specification', 0, 0, 1, 1, 1, 1, '{}', 11),
(217, 8, 'video', 'text', 'Video', 0, 0, 1, 1, 1, 1, '{}', 12),
(218, 8, 'product_price_with_discount', 'text', 'Product Price With Discount', 0, 0, 1, 1, 1, 1, '{}', 19),
(219, 8, 'product_retail_price', 'text', 'Product Retail Price', 0, 1, 1, 1, 1, 1, '{}', 21),
(220, 8, 'warranty', 'text', 'Warranty', 1, 1, 1, 1, 1, 1, '{}', 23),
(221, 1, 'last_name', 'text', 'Last Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(222, 1, 'phone', 'text', 'Phone', 0, 0, 1, 1, 1, 1, '{}', 6),
(223, 1, 'address', 'text', 'Address', 0, 0, 1, 1, 1, 1, '{}', 7),
(224, 1, 'zip', 'text', 'Zip', 0, 0, 1, 1, 1, 1, '{}', 8),
(225, 1, 'city', 'text', 'City', 0, 0, 1, 1, 1, 1, '{}', 9),
(226, 1, 'country', 'text', 'Country', 0, 0, 1, 1, 1, 1, '{}', 10),
(227, 1, 'company_zip', 'text', 'Company Zip', 0, 0, 1, 1, 1, 1, '{}', 15),
(228, 1, 'company_city', 'text', 'Company City', 0, 0, 1, 1, 1, 1, '{}', 16),
(229, 1, 'company_country', 'text', 'Company Country', 0, 0, 1, 1, 1, 1, '{}', 17),
(230, 1, 'loy_barcode', 'text', 'Loyalty (Barcode)', 0, 1, 1, 1, 1, 1, '{}', 13),
(231, 30, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(232, 30, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(233, 30, 'description', 'text_area', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(234, 30, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 4),
(235, 30, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 5),
(236, 31, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(237, 31, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(238, 31, 'phone', 'text', 'Phone', 0, 1, 1, 1, 1, 1, '{}', 3),
(239, 31, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{}', 4),
(240, 31, 'company', 'text', 'Company', 0, 1, 1, 1, 1, 1, '{}', 5),
(241, 31, 'description', 'text_area', 'Description', 0, 0, 1, 1, 1, 1, '{}', 6),
(242, 31, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 7),
(243, 31, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 8),
(244, 32, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(245, 32, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(246, 32, 'url', 'text', 'Url', 1, 1, 1, 1, 1, 1, '{}', 5),
(247, 32, 'target', 'select_dropdown', 'Target', 1, 1, 1, 1, 1, 1, '{\"options\":{\"_blank\":\"New Tab\",\"_self\":\"Same Tab\"}}', 6),
(248, 32, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{}', 7),
(249, 32, 'start_date', 'date', 'Start Date', 1, 1, 1, 1, 1, 1, '{}', 8),
(250, 32, 'end_date', 'date', 'End Date', 1, 1, 1, 1, 1, 1, '{}', 9),
(251, 32, 'description', 'text_area', 'Description', 0, 0, 1, 1, 1, 1, '{}', 10),
(252, 32, 'position_id', 'text', 'Position', 1, 1, 1, 1, 1, 1, '{}', 3),
(253, 32, 'client_id', 'text', 'Client', 1, 1, 1, 1, 1, 1, '{}', 2),
(254, 32, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 11),
(255, 32, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 12),
(256, 33, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(257, 33, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 2),
(258, 33, 'description', 'text_area', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(259, 33, 'color', 'text', 'Background Color', 0, 1, 1, 1, 1, 1, '{}', 4),
(260, 33, 'text_color', 'color', 'Text Color', 0, 1, 1, 1, 1, 1, '{}', 5),
(261, 33, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 6),
(262, 33, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 1, '{}', 7),
(263, 33, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 8),
(264, 4, 'cat_color', 'color', 'Boja kategorije', 0, 0, 1, 1, 1, 1, '{}', 14),
(265, 8, 'image_import', 'text', 'Image Import', 0, 1, 1, 1, 1, 1, '{}', 14),
(266, 8, 'zapremina', 'text', 'Zapremina', 0, 1, 1, 1, 1, 1, '{}', 27),
(267, 35, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(268, 35, 'product_id', 'text', 'Product Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(269, 35, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{}', 3),
(270, 35, 'image_order', 'text', 'Image Order', 0, 1, 1, 1, 1, 1, '{}', 4),
(271, 35, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 5),
(272, 35, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 1, '{}', 6),
(273, 35, 'updated_at', 'timestamp', 'Updated At', 1, 0, 1, 0, 0, 1, '{}', 7),
(274, 36, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(275, 36, 'user_id', 'text', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(276, 36, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(277, 36, 'status', 'checkbox', 'Status', 1, 1, 1, 1, 1, 1, '{}', 4),
(278, 36, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, '{}', 5),
(279, 36, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
CREATE TABLE IF NOT EXISTS `data_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', '\\App\\Http\\Controllers\\Voyager\\V_UserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2019-04-16 10:11:46', '2020-07-21 06:45:47'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2019-04-16 10:11:46', '2019-04-16 10:11:46'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2019-04-16 10:11:46', '2019-04-16 10:11:46'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2019-04-16 10:11:52', '2020-10-08 05:44:59'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '\\App\\Http\\Controllers\\Voyager\\V_PostsController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2019-04-16 10:11:53', '2020-07-30 10:02:15'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '\\App\\Http\\Controllers\\Voyager\\V_PagesController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2019-04-16 10:11:54', '2020-07-30 11:21:21'),
(8, 'products', 'products', 'Product', 'Products', 'voyager-shop', 'App\\Product', 'Product', '\\App\\Http\\Controllers\\Voyager\\V_ProductController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-05-22 11:21:13', '2020-10-02 05:35:28'),
(11, 'dimensions', 'dimensions', 'Dimension', 'Dimensions', 'voyager-code', 'App\\Dimension', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-05-25 09:15:48', '2019-06-14 11:02:56'),
(12, 'materials', 'materials', 'Material', 'Materials', 'voyager-tag', 'App\\Material', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-05-25 09:16:37', '2019-06-14 11:04:05'),
(13, 'orders', 'orders', 'Order', 'Orders', 'voyager-dollar', 'App\\Order', NULL, '\\App\\Http\\Controllers\\Voyager\\V_OrderController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-05-31 13:36:31', '2020-06-15 07:57:38'),
(14, 'order_items', 'order-items', 'Order Item', 'Order Items', 'voyager-list', 'App\\OrderItems', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-06-14 10:41:24', '2019-06-20 13:02:26'),
(15, 'payment_methods', 'payment-methods', 'Payment Method', 'Payment Methods', 'voyager-credit-cards', 'App\\PaymentMethod', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-06-19 12:57:45', '2019-06-20 09:27:26'),
(16, 'order_status', 'order-status', 'Order Status', 'Order Statuses', 'voyager-truck', 'App\\OrderStatus', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-06-19 13:23:18', '2019-06-19 13:37:27'),
(18, 'attributes', 'attributes', 'Attribute', 'Attributes', 'voyager-plus', 'App\\Attributes', NULL, '\\App\\Http\\Controllers\\Voyager\\V_AttributesController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-06-16 06:24:44', '2020-06-18 09:10:41'),
(19, 'attributes_values', 'attributes-values', 'Attributes Value', 'Attributes Values', 'voyager-list-add', 'App\\AttributesValues', NULL, '\\App\\Http\\Controllers\\Voyager\\V_AttributesValuesController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-06-17 07:54:07', '2020-07-08 12:22:00'),
(25, 'manufacturer', 'manufacturer', 'Manufacturer', 'Manufacturers', 'voyager-hammer', 'App\\Manufacturer', NULL, '\\App\\Http\\Controllers\\Voyager\\V_ManufacturerController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-06-24 13:10:35', '2020-10-06 09:22:41'),
(26, 'sliders', 'sliders', 'Slider', 'Sliders', 'voyager-photos', 'App\\Sliders', NULL, '\\App\\Http\\Controllers\\Voyager\\V_SlidersController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-07-08 12:00:15', '2020-07-09 05:42:48'),
(27, 'sliders_items', 'sliders-items', 'Sliders Item', 'Sliders Items', 'voyager-photos', 'App\\SlidersItems', NULL, '\\App\\Http\\Controllers\\Voyager\\V_SlidersItemsController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-07-08 13:41:12', '2020-07-09 08:38:24'),
(28, 'special_options', 'special-options', 'Special Option', 'Special Options', 'voyager-tag', 'App\\SpecialOption', NULL, '\\App\\Http\\Controllers\\Voyager\\V_SpecialOptionController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(30, 'banners_positions', 'banners-positions', 'Banners Position', 'Banners Positions', 'voyager-dot', 'App\\BannersPosition', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-07-31 05:55:18', '2020-07-31 06:00:18'),
(31, 'banners_clients', 'banners-clients', 'Banners Client', 'Banners Clients', 'voyager-dot', 'App\\BannersClient', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-07-31 06:03:21', '2020-07-31 06:05:21'),
(32, 'banners', 'banners', 'Banner', 'Banners', 'voyager-dot', 'App\\Banner', NULL, '\\App\\Http\\Controllers\\Voyager\\V_BannerController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-07-31 06:10:15', '2020-07-31 13:38:26'),
(33, 'badges', 'badges', 'Badge', 'Badges', 'voyager-paperclip', 'App\\Badge', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(35, 'product_images', 'product-images', 'Product Image', 'Product Images', 'voyager-images', 'App\\ProductImages', NULL, '\\App\\Http\\Controllers\\Voyager\\V_ProductImagesController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-09-30 17:39:09', '2020-10-01 16:05:43'),
(36, 'newsletter_subscribers', 'newsletter-subscribers', 'Newsletter Subscriber', 'Newsletter Subscribers', NULL, 'App\\NewsletterSubscriber', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-10-02 07:05:43', '2020-10-02 07:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `dimensions`
--

DROP TABLE IF EXISTS `dimensions`;
CREATE TABLE IF NOT EXISTS `dimensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) CHARACTER SET utf8 NOT NULL,
  `width` varchar(20) CHARACTER SET utf8 NOT NULL,
  `height` varchar(20) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

DROP TABLE IF EXISTS `gallery_items`;
CREATE TABLE IF NOT EXISTS `gallery_items` (
  `id` int(11) NOT NULL DEFAULT 0,
  `gallery_id` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_order` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_id` int(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `image`, `description`, `import_id`, `created_at`, `updated_at`) VALUES
(1, 'Neki proizvođač', NULL, 'Neki proizvođač', NULL, '2020-10-06 11:23:45', '2020-10-06 11:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8 NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-04-16 10:11:47', '2019-04-16 10:11:47'),
(3, 'Glavni Meni', '2019-05-23 11:42:34', '2019-05-23 11:42:45'),
(4, 'Product Menu', '2020-07-08 09:20:52', '2020-07-08 09:20:52'),
(5, 'Online kupovina', '2020-08-01 05:13:01', '2020-08-01 05:13:01'),
(6, 'Radno vreme', '2020-10-01 05:31:09', '2020-10-01 05:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2019-04-16 10:11:47', '2019-04-16 10:11:47', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, 38, 4, '2019-04-16 10:11:47', '2020-06-16 06:25:20', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 6, '2019-04-16 10:11:47', '2020-07-31 06:14:17', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 5, '2019-04-16 10:11:47', '2020-07-31 06:14:17', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 7, '2019-04-16 10:11:47', '2020-07-31 06:14:17', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2019-04-16 10:11:47', '2019-05-22 11:23:07', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2019-04-16 10:11:47', '2019-05-22 11:23:07', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2019-04-16 10:11:48', '2019-05-22 11:23:07', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2019-04-16 10:11:48', '2019-05-22 11:23:07', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 8, '2019-04-16 10:11:48', '2020-07-31 06:14:17', 'voyager.settings.index', NULL),
(11, 1, 'Categories', '', '_self', 'voyager-categories', NULL, 38, 2, '2019-04-16 10:11:52', '2019-06-10 10:44:30', 'voyager.categories.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, 38, 1, '2019-04-16 10:11:53', '2019-06-10 10:44:30', 'voyager.posts.index', NULL),
(13, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, 38, 3, '2019-04-16 10:11:54', '2020-06-16 06:25:20', 'voyager.pages.index', NULL),
(14, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2019-04-16 10:11:56', '2019-05-22 11:23:07', 'voyager.hooks', NULL),
(16, 1, 'Products', '/SDFSDf345345--DFgghjtyut-6/products', '_self', 'voyager-shop', '#ff8000', 37, 2, '2019-05-22 11:22:57', '2020-06-16 06:25:46', NULL, ''),
(22, 3, 'Početna', '/', '_self', NULL, '#000000', NULL, 1, '2019-05-23 11:43:05', '2019-07-30 10:43:19', NULL, ''),
(23, 3, 'Prodavnica', '/products', '_self', NULL, '#000000', NULL, 3, '2019-05-23 11:43:16', '2020-09-04 14:45:42', NULL, ''),
(24, 3, 'O nama', '/o-nama', '_self', NULL, '#000000', NULL, 2, '2019-05-23 11:43:31', '2020-09-04 14:42:22', NULL, ''),
(25, 3, 'Edukacija', '/edukacija', '_self', NULL, '#000000', NULL, 4, '2019-05-23 11:43:42', '2020-09-22 05:40:27', NULL, ''),
(26, 3, 'Kontakt', '/kontakt', '_self', NULL, '#000000', NULL, 5, '2019-05-23 11:43:54', '2019-05-23 11:44:47', NULL, ''),
(34, 1, 'Dimensions', '', '_self', 'voyager-code', NULL, 37, 4, '2019-05-25 09:15:49', '2020-07-10 07:14:07', 'voyager.dimensions.index', NULL),
(35, 1, 'Materials', '', '_self', 'voyager-tag', '#000000', 37, 5, '2019-05-25 09:16:37', '2020-07-10 07:14:08', 'voyager.materials.index', 'null'),
(36, 1, 'Orders', '', '_self', 'voyager-dollar', '#dde21d', 37, 1, '2019-05-31 13:36:31', '2020-06-16 06:25:27', 'voyager.orders.index', 'null'),
(37, 1, 'Shop', '', '_self', 'voyager-shop', '#5ce036', NULL, 2, '2019-06-10 09:27:23', '2019-06-10 09:28:13', NULL, ''),
(38, 1, 'Content', '', '_self', 'voyager-documentation', '#000000', NULL, 3, '2019-06-10 10:44:03', '2019-06-10 10:44:13', NULL, ''),
(41, 1, 'Payment Methods', '', '_self', 'voyager-credit-cards', NULL, 37, 7, '2019-06-19 12:57:45', '2020-07-10 07:14:08', 'voyager.payment-methods.index', NULL),
(42, 1, 'Order Statuses', '', '_self', 'voyager-truck', '#000000', 37, 8, '2019-06-19 13:23:18', '2020-07-10 07:14:08', 'voyager.order-status.index', 'null'),
(43, 1, 'Attributes', '', '_self', 'voyager-plus', NULL, 37, 3, '2020-06-16 06:24:45', '2020-06-16 06:25:46', 'voyager.attributes.index', NULL),
(45, 1, 'Manufacturers', '', '_self', 'voyager-hammer', NULL, 37, 6, '2020-06-24 13:10:35', '2020-07-10 07:14:08', 'voyager.manufacturer.index', NULL),
(46, 4, 'Anti aging', '/products/anti-aging', '_self', NULL, '#000000', NULL, 18, '2020-07-08 09:21:42', '2020-10-02 10:13:07', NULL, ''),
(47, 4, 'Dehidratacija', '/products/dehidratacija', '_self', NULL, '#000000', NULL, 19, '2020-07-08 09:23:39', '2020-10-02 10:13:42', NULL, ''),
(48, 4, 'Akne i seborea', '/products/akne-i-seborea', '_self', NULL, '#000000', NULL, 20, '2020-07-08 09:24:53', '2020-10-02 10:14:03', NULL, ''),
(49, 4, 'Pigmentne fleke', '/products/pigmentne-fleke', '_self', NULL, '#389178', NULL, 21, '2020-07-08 09:25:28', '2020-10-02 10:14:27', NULL, ''),
(50, 4, 'Rozacea', '/products/rozacea', '_self', NULL, '#000000', NULL, 22, '2020-07-08 09:26:03', '2020-10-02 10:14:59', NULL, ''),
(51, 4, 'Zona oko očiju', '/products/zona-oko-ociju', '_self', NULL, '#000000', NULL, 23, '2020-07-08 09:27:00', '2020-10-02 10:15:21', NULL, ''),
(52, 1, 'Sliders', '', '_self', 'voyager-photos', NULL, 38, 5, '2020-07-08 12:00:15', '2020-07-08 12:19:45', 'voyager.sliders.index', NULL),
(54, 1, 'Special Options', '', '_self', 'voyager-tag', NULL, 37, 9, '2020-07-10 07:13:31', '2020-07-10 07:14:08', 'voyager.special-options.index', NULL),
(55, 1, 'Banners Positions', '', '_self', 'voyager-dot', NULL, 58, 2, '2020-07-31 05:55:19', '2020-07-31 06:13:17', 'voyager.banners-positions.index', NULL),
(56, 1, 'Banners Clients', '', '_self', NULL, NULL, 58, 3, '2020-07-31 06:03:21', '2020-07-31 06:13:22', 'voyager.banners-clients.index', NULL),
(57, 1, 'Banners', '', '_self', 'voyager-megaphone', NULL, 58, 1, '2020-07-31 06:10:15', '2020-07-31 06:13:08', 'voyager.banners.index', NULL),
(58, 1, 'Banners', '', '_self', 'voyager-megaphone', '#000000', NULL, 4, '2020-07-31 06:12:44', '2020-07-31 06:14:17', NULL, ''),
(59, 5, 'Privatnost korisnika', '/privatnost-korisnika', '_self', NULL, '#000000', NULL, 24, '2020-08-01 05:13:25', '2020-08-01 05:13:25', NULL, ''),
(60, 5, 'Pravila i uslovi korišćenja', '/pravila-i-uslovi-koriscenja', '_self', NULL, '#000000', NULL, 25, '2020-08-01 05:13:41', '2020-08-01 05:13:41', NULL, ''),
(61, 5, 'Povraćaj novca i reklamacije', '/povracaj-novca-i-reklamacije', '_self', NULL, '#000000', NULL, 26, '2020-08-01 05:13:55', '2020-08-01 05:13:55', NULL, ''),
(62, 5, 'Informacije o isporuci', '/informacije-o-isporuci', '_self', NULL, '#000000', NULL, 27, '2020-08-01 06:40:56', '2020-08-01 06:40:56', NULL, ''),
(63, 1, 'Badges', '', '_self', 'voyager-paperclip', NULL, 37, 10, '2020-08-14 11:15:05', '2020-08-14 11:18:14', 'voyager.badges.index', NULL),
(64, 1, 'Product Images', '', '_self', 'voyager-images', NULL, NULL, 9, '2020-09-30 17:39:18', '2020-10-02 07:08:40', 'voyager.product-images.index', NULL),
(65, 6, 'Pon. 9:00 — 16:00', '#', '_self', NULL, '#000000', NULL, 28, '2020-09-04 17:28:18', '2020-10-02 10:16:24', NULL, ''),
(66, 6, 'Uto. 9:00 — 16:00', '#', '_self', NULL, '#000000', NULL, 29, '2020-09-04 17:28:52', '2020-10-02 10:16:29', NULL, ''),
(67, 6, 'Sre. 9:00 — 16:00', '#', '_self', NULL, '#000000', NULL, 30, '2020-09-04 17:29:10', '2020-10-02 10:16:37', NULL, ''),
(68, 6, 'Čet. 9:00 — 16:00', '#', '_self', NULL, '#000000', NULL, 31, '2020-09-04 17:29:22', '2020-10-02 10:16:42', NULL, ''),
(69, 6, 'Pet. 9:00 — 16:00', '#', '_self', NULL, '#000000', NULL, 32, '2020-09-04 17:29:31', '2020-10-02 10:16:47', NULL, ''),
(70, 6, 'Sub. 9:00 — 14:00', '#', '_self', NULL, '#000000', NULL, 33, '2020-09-04 17:29:39', '2020-10-02 10:16:51', NULL, ''),
(72, 1, 'Newsletter Subscribers', '', '_self', 'voyager-people', '#000000', 73, 1, '2020-10-02 07:05:44', '2020-10-02 07:11:00', 'voyager.newsletter-subscribers.index', 'null'),
(73, 1, 'Newsletter', '', '_self', 'voyager-news', '#000000', NULL, 10, '2020-10-02 07:08:28', '2020-10-02 07:09:50', NULL, ''),
(74, 4, 'Trepavice', '/products/trepavice', '_self', NULL, '#000000', NULL, 34, '2020-10-02 10:15:39', '2020-10-02 10:15:39', NULL, ''),
(75, 4, 'Trajna šminka i jednokratni proizvodi', '/products/trajna-sminka-i-jednokratni-proizvodi', '_self', NULL, '#000000', NULL, 35, '2020-10-02 10:15:54', '2020-10-02 10:15:54', NULL, ''),
(76, 6, 'Ned. --Zatvoreno', '#', '_self', NULL, '#000000', NULL, 36, '2020-10-02 10:17:03', '2020-10-02 10:17:03', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2016_01_01_000000_create_pages_table', 2),
(24, '2016_01_01_000000_create_posts_table', 2),
(25, '2016_02_15_204651_create_categories_table', 2),
(26, '2017_04_11_000000_alter_post_nullable_fields_table', 2),
(27, '2020_06_15_154434_create_attributes_table', 3),
(28, '2020_06_17_093126_create_attributes_values_table', 4),
(29, '2020_06_17_113831_create_attributes_product_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) DEFAULT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `order_invoice` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `rabat` int(10) NOT NULL,
  `total` int(100) NOT NULL,
  `order_status` int(11) NOT NULL,
  `payment_method` int(10) NOT NULL,
  `comment` text CHARACTER SET utf8 DEFAULT NULL,
  `proforma_invoice` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `merchantPaymentId` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `pgTranId` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_log`
--

DROP TABLE IF EXISTS `orders_log`;
CREATE TABLE IF NOT EXISTS `orders_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` varchar(50) CHARACTER SET utf8 NOT NULL,
  `orderitems` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `material_id` int(10) DEFAULT NULL,
  `dimensions_id` int(10) DEFAULT NULL,
  `kolicina` int(10) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `total` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `order_id_fk` (`order_id`) USING BTREE,
  KEY `product_id_fk` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping`
--

DROP TABLE IF EXISTS `order_shipping`;
CREATE TABLE IF NOT EXISTS `order_shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `shp_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shp_last_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shp_email` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shp_phone` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shp_address` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shp_zip` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shp_city` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id_shp_fk` (`order_id`) USING BTREE,
  KEY `user_id_shp_fk` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Uplata na cekanju', '<p>Uplata na cekanju</p>', '2019-06-19', '2019-06-19'),
(2, 'Pošiljka poslata', '<p>Po&scaron;iljka poslata</p>', '2019-06-19', '2019-06-19'),
(3, 'Porudžbina u obradi', '<p>Porudžbina u obradi</p>', '2019-06-19', '2019-06-19'),
(4, 'Stavljeno na čekanje', '<p><span style=\"width: 164px;\">Stavljeno na čekanje</span></p>', '2019-06-19', '2019-06-19'),
(5, 'Završena porudžbina', '<p>Zavr&scaron;ena porudžbina</p>', '2019-06-19', '2019-06-19'),
(6, 'Otkazana porudžbina', '<p>Otkazana porudžbina</p>', '2019-06-19', '2019-06-19'),
(7, 'Refundirano', '<p>Refundirano</p>', '2019-06-19', '2019-06-19'),
(8, 'Neuspešna porudžbina', '<p>Neuspe&scaron;na porudžbina</p>', '2019-06-19', '2019-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Kako poručiti', 'Kako teče proces poručivanja?', '<h2>Kako teče proces poručivanja?</h2>\r\n<h3>Poručite tražene oznake u nekoliko jednostavnih koraka!</h3>\r\n<p>Sve oznake su podeljene u odgovarajuće kategorije. Klikom na kategoriju otvoriće Vam se strana sa svim oznakama koji pripadaju toj kategoriji. Daljim klikom na symbol oznake ili na ispis \"Detaljnije\" ispod traženog simbola, otvoriće Vam se strana na kojoj imate opis namene svakog materijala na kojem se ta oznaka izrađuje i na kojoj možete definisati sve parameter za naružbinu (material, dimenzije i količinu). Nakon unosa traženih podataka dobićete tačnu cenu ko&scaron;tanja i ukoliko Vam to odgovara, dovoljno je da kliknete da dugme \"Dodaj u korpu\" i sa tom oznakom ste zavr&scaron;ili. Nakon toga, otvoriće Vam se strana sa detaljima Va&scaron;e trenutne narudžbine. Ukoliko želite da pro&scaron;irite svoju narudžbinu sa jo&scaron; oznaka, kliknite na \"Nastavite kupovinu\" i ponovite process za novu oznaku, a ako ste zavr&scaron;ili, sa desne strane se prvo morate registrovati (samo prvi put), a potom se prijavljujete traženim podacima (e-mail i &scaron;ifra koju ste definisali prilikom registracije) i birate dugme \"Zavr&scaron;i kupovinu\". Kupovina se zavr&scaron;ava na ovoj strani popunjavanjem podataka firme i odabirom načina plaćanja (kartica ili po predračunu). Na kraju, klikom na \"Potvrdi porudžbinu\" zavr&scaron;avate process kupovine.</p>\r\n<p>Imajte na umu da na na&scaron;oj online prodavnici imate preko 750 standardnih oznaka koje se koriste u Republici Srbiji, ali da mi konstantno radimo na pro&scaron;irenjima i unapređenjima, prateći aktuelne propise i standard u ovoj oblasti. Ukoliko imate specifičan zahtev za oznakom koja možda ne postoji trenutno, obavezno nam se javite mailom na <a href=\"mailto:prodaja@oznake.rs\" target=\"_blank\" rel=\"noopener\">prodaja@oznake.rs</a> ili telefonom na 023 530 350 ili 060 530 3502 (svakim radnim danom 8-16h).</p>\r\n<p>&nbsp;</p>', NULL, 'kako-poruciti', 'Kako poručiti', 'Kako poručiti', 'ACTIVE', '2019-05-23 10:31:07', '2019-07-29 07:03:49'),
(3, 1, 'Informacije o isporuci', NULL, '<p>Isporuka proizvoda se vr&scaron;i isključivo na teritoriji Republike Srbije i ne može se isporučivati van granica ove zemlje. MGames se obavezuje da će proizvodi&nbsp; biti isporučeni najkasnije pet radnih dana od dana poručivanja. Svi proizvodi koje su naručeni do 12h svakog radnog dana, biće dostavljeni najkasnije u roku od dva radna dana na adresu kupca. Uobičajeno vreme isporuke je 24 časa za sve gradove i veća naselja na teritoriji Srbije.</p>\r\n<p>Do odstupanja i produženja roka za isporuku moze doći ukoliko primalac nije na adresi u prilikom poku&scaron;aja isporuke, ne javlja se na broj telefona koji je ostavio prilikom naručivanja proizvoda, lo&scaron;ih vremenskih uslova ili nepredviđenih situacija u transportu na koje Games ne može da utiče.</p>\r\n<p>Va&scaron;a obaveza je da po&scaron;iljku po prijemu proverite, i u najkraćem roku (bez odlaganja) prijavite eventualne nepravilnosti.</p>', NULL, 'informacije-o-isporuci', 'Informacije o isporuci', 'Informacije o isporuci', 'ACTIVE', '2019-05-23 10:31:38', '2020-08-01 06:39:59'),
(4, 1, 'Povraćaj novca i reklamacije', NULL, '<h2>Saobraznost proizvoda ugovoru</h2>\r\n<p>Obave&scaron;tavamo Vas da je saglasno zakonu MGames odgovoran za nesaobraznost proizvoda ugovoru koja se pojavi u roku od dve godine od dana isporuke proizvoda Vama ili trećem licu koje ste odredili kao primaoca po&scaron;iljke.</p>\r\n<p>Ako nesaobraznost nastane u roku od &scaron;est meseci od dana isporuke proizvoda pretpostavlja se da je nesaobraznost postojala u trenutku isporuke proizvoda, osim ako je to u suprotnosti sa prirodom proizvoda i prirodom određene nesaobraznosti.</p>\r\n<p>MGames je dužan da isporuči proizvode koji su saobrazni ugovoru o kupoprodaji proizvoda.</p>\r\n<p>MGames odgovara za nesaobraznosti isporučenih proizvoda ugovoru ako je ona postojala u momentu isporuke proizvoda Vama ili trećem licu koje ste odredili kao primaoca po&scaron;iljke, kao i u slučaju kad se nesaobraznost proizvoda pojavila posle isporuke, a potiče od uzroka koji je postojao pre isporuke.</p>\r\n<p>MGames je odgovoran i za nesaobraznost nastalu zbog nepravilnog pakovanja.</p>\r\n<p>Ako se nesaobraznost pojavi u roku od &scaron;est meseci od dana isporuke proizvoda, imate pravo da izaberete da li će se nesaobraznost otkloniti zamenom, odgovarajućim umanjenjem cene ili da izjavite da raskidate ugovor. Ako se nesaobraznost pojavi po isteku roka od &scaron;est meseci od dana isporuke proizvoda, imate pravo da izaberete da li će Games da otkloni nesaobraznost proizvoda opravkom ili zamenom.</p>\r\n<p>Ne možete da raskinete ugovor o kupoprodaji proizvoda ako je nesaobraznost proizvoda neznatna.</p>\r\n<p>Sve tro&scaron;kove koji su neophodni da bi se proizvodi saobrazili ugovoru, a naročito tro&scaron;kove rada, materijala, preuzimanja i isporuke, snosi MGames.</p>\r\n<h2>Proizvodi sa garancijom</h2>\r\n<p>MGames jemči da su svi proizvodi iz njegvovog asortimana originalne robne marke. MGames u garantnom roku, o svom tro&scaron;ku obezbeđuje otklanjanje kvarova i nedostataka proizvoda koji proizlaze iz nepodudarnosti stvarnih sa propisanim odnosno deklarisanim karakteristikama kvaliteta proizvoda.</p>\r\n<p>U slučaju neizvr&scaron;enja ove obaveze, MGames će izvr&scaron;iti zamenu proizvoda novim ili će Vam vratiti novac.</p>\r\n<p>Garantni rok počinje da teče danom prodaje proizvoda sa garancijom koji se unosi u garantni list i overava pečatom i potpisom ovla&scaron;ćenog prodavca. Kupac gubi pravo na garanciju ako se kvar izazove nepridržavanjem datim uputstvima za upotrebu i ako su na proizvodu vr&scaron;ene bilo kakve popravke od strane neovla&scaron;ćenih lica.</p>\r\n<p>U garanciju ne ulaze o&scaron;tećenja prouzrokovana prilikom transporta nakon preuzimanja kupljenih proizvoda, o&scaron;tećenja zbog nepravilne montaže ili održavanja, mehanička o&scaron;tećenja nastala krivicom korisnika, o&scaron;tećenja zbog varijacije napona električne mreže, udara groma i pratećih pojava.</p>\r\n<p>Kupac je dužan da prilikom preuzimanja proizvoda ustanovi kompletnost i fizičku neo&scaron;tećenost proizvoda&nbsp; koji preuzima, jer naknadne reklamacije po tom osnovu neće biti prihvaćene od strane Games-a.</p>\r\n<p>Obave&scaron;tenje o načinu i mestu prijema reklamacija i načinu postupanja po primljenim reklamacijama.</p>\r\n<p>Obave&scaron;tavamo Vas da reklamacije na proizvode kupljene preko Veb-sajta možete da izjavite u jednoj od na&scaron;ih prodavnica, elektronskim putem na email adresu: SELEZR@LIVE.COM ili preko broja telefona: 0644644919. Prilikom izjavljivanja reklamacije dužni ste da dostavite proizvode na koju se reklamacija odnosi, račun na uvid ili drugi dokaz o kupovini tih proizvoda (kopija računa, slip i sl.), kao i garantni list ukoliko je reč o proizvodima sa garancijom.</p>\r\n<p>Prilikom dostavljanja proizvoda niste dužni da dostavite ambalažu.</p>\r\n<p>Po prijemu reklamacije izdaćemo Vam pismenu potvrdu ili ćemo Vas elektronskim putem obavestiti da potvrđujemo da smo primili Va&scaron;u reklamaciju, odnosno saop&scaron;tićemo Vam broj pod kojim je onazavedena u evidenciji primljenih reklamacija.</p>\r\n<p>Najkasnije u roku od osam dana od dana prijema reklamacije, pismenim ili elektronskim putem odgovorićemo Vam na izjavljenu reklamaciju. Odgovor će sadržati odluku da li prihvatamo reklamaciju, izja&scaron;njenje o Va&scaron;em zahtevu i konkretan predlog i rok za re&scaron;avanje reklamacije koji ne može biti duži od 30 dana od dana podno&scaron;enja reklamacije.</p>', NULL, 'povracaj-novca-i-reklamacije', 'Povraćaj novca i reklamacije', 'Povraćaj novca i reklamacije', 'ACTIVE', '2019-05-23 10:32:12', '2020-08-01 05:34:23'),
(5, 1, 'Privatnost korisnika', 'U ime MGames online prodavnice obavezujemo se da ćemo čuvati privatnost svih naših kupaca. Prikupljamo samo neophodne, osnovne podatke o kupcima/korisnicima i podatke neophodne za poslovanje i informisanje korisnika u skladu sa dobrim poslovnim običajima i u cilju pružanja kvalitetne usluge. Dajemo kupcima mogućnost izbora uključujući mogućnost odluke da li žele ili ne da se izbrišu sa mailing lista koje se koriste za marketinške kampanje. Svi podaci o korisnicima/kupcima se strogo čuvaju i dostupni su samo zaposlenima kojima su ti podaci nužni za obavljanje posla. Svi zaposleni Games online prodavnice (i poslovni partneri) odgovorni su za poštovanje načela zaštite privatnosti.', '<p>U ime MGames online prodavnice obavezujemo se da ćemo čuvati privatnost svih na&scaron;ih kupaca. Prikupljamo samo neophodne, osnovne podatke o kupcima/korisnicima i podatke neophodne za poslovanje i informisanje korisnika u skladu sa dobrim poslovnim običajima i u cilju pružanja kvalitetne usluge. Dajemo kupcima mogućnost izbora uključujući mogućnost odluke da li žele ili ne da se izbri&scaron;u sa mailing lista koje se koriste za marketin&scaron;ke kampanje. Svi podaci o korisnicima/kupcima se strogo čuvaju i dostupni su samo zaposlenima kojima su ti podaci nužni za obavljanje posla. Svi zaposleni Games online prodavnice (i poslovni partneri) odgovorni su za po&scaron;tovanje načela za&scaron;tite privatnosti.</p>', NULL, 'privatnost-korisnika', 'Privatnost korisnika', 'Privatnost korisnika', 'ACTIVE', '2019-05-23 10:32:43', '2020-08-01 05:07:26'),
(6, 1, 'Pravila i uslovi korišćenja', NULL, '<h2>USLOVI KORI&Scaron;ĆENJA VEB-SAJTA I KUPOVINE PROIZVODA</h2>\r\n<p>Ovaj dokument (zajedno sa drugim dokumentima koji se ovde spominju) utvrđuje op&scaron;te uslove za kori&scaron;ćenje veb-sajta: www.games.rs (u daljem tekstu: Veb-sajt) i kupovinu proizvoda preko Veb-sajta.</p>\r\n<p>&nbsp;</p>\r\n<p>Uslove kori&scaron;ćenja Veb-sajta i kupovine preko Veb-sajta postavlja i uređuje:</p>\r\n<p>M GAMES za promet igara, konzola i prateće opreme Beograd</p>\r\n<p>KOČE KOLAROVA 24</p>\r\n<p>23 000 ZRENJANIN</p>\r\n<p>MB: 65370344</p>\r\n<p>PIB: 111379892</p>\r\n<p>&Scaron;ifra delatnosti: 4771-Trgovina na malo perifernim jedinicama i softverom u specijalizovanim prodavnicama</p>\r\n<p>Email: selezr@live.com&nbsp; (u daljem tekstu: MGames ili mi)</p>\r\n<p>Broj telefon: +381644644919</p>\r\n<p>&nbsp;</p>\r\n<p>Molimo Vas da pažljivo pročitate ove Uslove kori&scaron;ćenja Veb-sajta i kupovine proizvoda (u daljem tekstu: Uslovi kori&scaron;ćenja), pre kori&scaron;ćenja Veb-sajta. Kori&scaron;ćenjem Veb-sajta smatra se da je korisnik upoznat sa ovim Uslovima kori&scaron;čenja i da ih prihvata.</p>\r\n<p>MGames može da izmeni sadržaj ovih Uslova, asortiman proizvoda, cene proizvoda, kao i druge podatke koji se odnose na Veb-sajt, zbog čega su korisnici Veb-sajta dužni da prilikom svake posete pažljivo pregledaju sadržaj Veb-sajta. Prilikom kori&scaron;ćenja Veb-sajta ili naručivanja proizvoda preko Veb-sajta, obavezuju Vas ovi Uslovi kori&scaron;ćenja. Ako se ne slažete sa Uslovima i svrhom i načinom obrade Va&scaron;ih ličnih podataka molimo Vas da ne koristite Veb-sajt. Ako imate pitanja u vezi sa ovim Uslovima možete da nas kontaktirati na email adresu: office@games.rs ili adresu sedi&scaron;ta Games-a: Bulevar Mihaila Pupina 117, 11070 Novi Beograd, odnosno putem broja telefona:063 1048 564.</p>\r\n<h2>Odricanje od odgovornosti</h2>\r\n<p>MGames ne preuzima odgovornost za &scaron;tetu koju korisnik pretrpi usled: toga &scaron;to nije pročitao ove Uslove; nemogućnosti da se izvr&scaron;i kupovina preko Veb-sajta iz opravdanih razloga; nemogućnosti kori&scaron;ćenja Veb-sajta zbog održavanja, obezbeđenja ili bilo kog drugog tehničkog razloga, kao i usled uskraćivanja pristupa Veb-sajtu zbog nedozvoljenih načina kori&scaron;ćenja.</p>\r\n<h2>Kori&scaron;ćenje Veb-sajta</h2>\r\n<p>Podatke (uključujući i Va&scaron;e lične podatke) koje nam date obradićemo u skladu sa ovim Uslovima, Obave&scaron;tenjem o obradi podataka o ličnosti i Obave&scaron;tenjem o kolačićima. Kada koristite Veb-sajt, slažete se sa obradom Va&scaron;ih ličnih podataka u skladu sa navedenim dokumentima.</p>\r\n<p>Kori&scaron;ćenjem Veb-sajta i naručivanjem proizvoda preko Veb-sajta, prihvatate da:</p>\r\n<ul>\r\n<li>koristite Veb-sajt samo za pretragu i pravno valjane narudžbine;</li>\r\n<li>nećete upućivati lažne ili obmanjujuće narudžbine;</li>\r\n<li>navedena email adresa, adresa i/ili drugi kontakt podaci koje navodite su tačni, važeći i potpuni.</li>\r\n</ul>\r\n<p>Naručivanjem proizvoda preko Veb-sajta pristajete da Games upotrebljava Va&scaron;e lične podatke da Vas kontaktira u svrhu izvr&scaron;enja Va&scaron;e narudžbine, ukoliko je to potrebno, a u skladu sa Obave&scaron;tenjem o obradi podataka o ličnosti. Ukoliko ne navedete sve podatke koji su nam potrebni, nećete moći daizvr&scaron;ite kupovinu proizvoda. Kada vr&scaron;ite naručivanje proizvoda preko Veb-sajta, potvrđujete da imate vi&scaron;e od 18 godina i da ste sposobni za zaključenje obavezujućih ugovora.</p>\r\n<h2>KUPOVINA PROIZVODA</h2>\r\n<p>Prezentacija proizvoda na Veb-sajtu predstavlja ponudu za zaključenje ugovora o kupoprodaji proizvoda.&nbsp; Ugovor o kupoprodaji zajključujete sa Games-om kao prodavcem. Zaključenjem ugovora o kupoprodaji sa Games-om imate sva prava predviđena važećim propisima.</p>\r\n<h2>Naručivanje</h2>\r\n<p>Poručivanje je prvi korak u kupovini preko Veb-sajta. Kako biste poručili proizvode preko Veb-sajta, morate da budete registrovani korisnik. Registrovanjem ćete dobiti korisničko ime kojim ćete ubuduće pristupati Veb-sajtu prilikom poručivanja. Po&scaron;to odaberete proizvode i smestite ih u korpu, možete odabrati dva načina plaćanja:</p>\r\n<ul>\r\n<li>platnom karticom</li>\r\n<li>putem predračuna koji ćemo Vam poslati nakon Va&scaron;e porudžbine, ukoliko se odlučite za gotovinsko plaćanje</li>\r\n</ul>\r\n<p>MGames zadržava pravo da otkaže kupoprodaju ukoliko mu se učini da je do&scaron;lo do nekih nepravilnosti u procesu naplaćivanja.</p>\r\n<h2>Plaćanje</h2>\r\n<p>Sve cene su izražene u dinarima sa uračunatim PDV-om. Plaćanje se vr&scaron;i u dinarima.</p>\r\n<p>Ukoliko se odlučite za gotovisnko plaćanje putem predračuna, predračun će Vam biti poslat na ostavljenu email adresu, bez prethodnog kontaktiranja.</p>\r\n<p>MGames zadržava pravo na izmenu cena i dostupnost proizvoda bez predhodnog obave&scaron;tenja. Ipak MGames neće menjati cene nakon izvr&scaron;ene potvrde Va&scaron;e porudžbine.</p>\r\n<h2>Isporuka proizvoda</h2>\r\n<p>Isporuka proizvoda se vr&scaron;i isključivo na teritoriji Republike Srbije i ne može se isporučivati van granica ove zemlje. MGames se obavezuje da će proizvodi&nbsp; biti isporučeni najkasnije pet radnih dana od dana poručivanja. Svi proizvodi koje su naručeni do 12h svakog radnog dana, biće dostavljeni najkasnije u roku od dva radna dana na adresu kupca. Uobičajeno vreme isporuke je 24 časa za sve gradove i veća naselja na teritoriji Srbije.</p>\r\n<p>Do odstupanja i produženja roka za isporuku moze doći ukoliko primalac nije na adresi u prilikom poku&scaron;aja isporuke, ne javlja se na broj telefona koji je ostavio prilikom naručivanja proizvoda, lo&scaron;ih vremenskih uslova ili nepredviđenih situacija u transportu na koje Games ne može da utiče.</p>\r\n<p>Va&scaron;a obaveza je da po&scaron;iljku po prijemu proverite, i u najkraćem roku (bez odlaganja) prijavite eventualne nepravilnosti.</p>\r\n<h2>Pravo na odustanak od kupovine</h2>\r\n<p>U skladu sa zakonom imate pravo do odustanete od ugovora o kupoprodaji proizvoda kupljenih preko Veb-sajta bez obrazloženja u roku od 14 dana od dana kada Vam je proizvod isporučen. Ukoliko želite da odustanete od ugovora o kupoprodaji proizvoda koji je zaključen preko Veb-sajta, to možete da učinite popunjavanjem i slanjem obrasca za odustanak od ugovora koji možete naći na Veb-sajtu, a koji dobijate i uz kupljene proizvode (na poleđini računa) zajedno sa neo&scaron;tećenim i nekori&scaron;ćenim proizvodima po&scaron;tom na adresu Games-a ili odlaskom u jednu od Gamesovih prodavnica. Ukoliko na poleđini računa niste dobili obrazac za odustanak, možete ga preuzeti ovde.</p>\r\n<p>Izjava o odustajanju od ugovora proizvodi pravno dejstvo od dana kada je poslata Games-u&nbsp; i smatra se blagovremenom ako je poslata u roku od 14 dana od dana kada je proizvod dospeo u Va&scaron;u državinu, odnosno u državinu trećeg lica koje ste odredili za primaoca po&scaron;iljke.</p>\r\n<p>U slučaju da odustanete od ugovora Vi snosite tro&scaron;kove vraćanja proizvoda i dužni ste da u roku od 14 dana od dana odustajanja od ugovora vratite MGames-u kupljene proizvode</p>\r\n<p>Napominjemo da je moguće odustati od kupovine proizvoda koji su vraćeni u originalnoj amabalaži, koji nisu kori&scaron;ćeni ili o&scaron;tećeni i koji sadrže sve dodatke i propratnu dokumentaciju (garantni list, uputstva za upotrebu i slično), kao i originalni račun.</p>\r\n<p>Pravo na odustanak važi i u slučaju kupovine sofverskih proizvoda ukoliko nisu otpakovani (imaju fabrički celofan). Nemate pravo da odusutanete od kupovine softverskog proizvoda koji je otpakovan.</p>\r\n<h2>Povraćaj sredstava</h2>\r\n<p>Saobraznost proizvoda ugovoru</p>\r\n<p>Obave&scaron;tavamo Vas da je saglasno zakonu MGames odgovoran za nesaobraznost proizvoda ugovoru koja se pojavi u roku od dve godine od dana isporuke proizvoda Vama ili trećem licu koje ste odredili kao primaoca po&scaron;iljke.</p>\r\n<p>Ako nesaobraznost nastane u roku od &scaron;est meseci od dana isporuke proizvoda pretpostavlja se da je nesaobraznost postojala u trenutku isporuke proizvoda, osim ako je to u suprotnosti sa prirodom proizvoda i prirodom određene nesaobraznosti.</p>\r\n<p>MGames je dužan da isporuči proizvode koji su saobrazni ugovoru o kupoprodaji proizvoda.</p>\r\n<p>MGames odgovara za nesaobraznosti isporučenih proizvoda ugovoru ako je ona postojala u momentu isporuke proizvoda Vama ili trećem licu koje ste odredili kao primaoca po&scaron;iljke, kao i u slučaju kad se nesaobraznost proizvoda pojavila posle isporuke, a potiče od uzroka koji je postojao pre isporuke.</p>\r\n<p>MGames je odgovoran i za nesaobraznost nastalu zbog nepravilnog pakovanja.</p>\r\n<p>Ako se nesaobraznost pojavi u roku od &scaron;est meseci od dana isporuke proizvoda, imate pravo da izaberete da li će se nesaobraznost otkloniti zamenom, odgovarajućim umanjenjem cene ili da izjavite da raskidate ugovor. Ako se nesaobraznost pojavi po isteku roka od &scaron;est meseci od dana isporuke proizvoda, imate pravo da izaberete da li će Games da otkloni nesaobraznost proizvoda opravkom ili zamenom.</p>\r\n<p>Ne možete da raskinete ugovor o kupoprodaji proizvoda ako je nesaobraznost proizvoda neznatna.</p>\r\n<p>Sve tro&scaron;kove koji su neophodni da bi se proizvodi saobrazili ugovoru, a naročito tro&scaron;kove rada, materijala, preuzimanja i isporuke, snosi MGames.</p>\r\n<h2>Proizvodi sa garancijom</h2>\r\n<p>MGames jemči da su svi proizvodi iz njegvovog asortimana originalne robne marke. MGames u garantnom roku, o svom tro&scaron;ku obezbeđuje otklanjanje kvarova i nedostataka proizvoda koji proizlaze iz nepodudarnosti stvarnih sa propisanim odnosno deklarisanim karakteristikama kvaliteta proizvoda.</p>\r\n<p>U slučaju neizvr&scaron;enja ove obaveze, MGames će izvr&scaron;iti zamenu proizvoda novim ili će Vam vratiti novac.</p>\r\n<p>Garantni rok počinje da teče danom prodaje proizvoda sa garancijom koji se unosi u garantni list i overava pečatom i potpisom ovla&scaron;ćenog prodavca. Kupac gubi pravo na garanciju ako se kvar izazove nepridržavanjem datim uputstvima za upotrebu i ako su na proizvodu vr&scaron;ene bilo kakve popravke od strane neovla&scaron;ćenih lica.</p>\r\n<p>U garanciju ne ulaze o&scaron;tećenja prouzrokovana prilikom transporta nakon preuzimanja kupljenih proizvoda, o&scaron;tećenja zbog nepravilne montaže ili održavanja, mehanička o&scaron;tećenja nastala krivicom korisnika, o&scaron;tećenja zbog varijacije napona električne mreže, udara groma i pratećih pojava.</p>\r\n<p>Kupac je dužan da prilikom preuzimanja proizvoda ustanovi kompletnost i fizičku neo&scaron;tećenost proizvoda&nbsp; koji preuzima, jer naknadne reklamacije po tom osnovu neće biti prihvaćene od strane Games-a.</p>\r\n<p>Obave&scaron;tenje o načinu i mestu prijema reklamacija i načinu postupanja po primljenim reklamacijama.</p>\r\n<p>Obave&scaron;tavamo Vas da reklamacije na proizvode kupljene preko Veb-sajta možete da izjavite u jednoj od na&scaron;ih prodavnica, elektronskim putem na email adresu: SELEZR@LIVE.COM ili preko broja telefona: 0644644919. Prilikom izjavljivanja reklamacije dužni ste da dostavite proizvode na koju se reklamacija odnosi, račun na uvid ili drugi dokaz o kupovini tih proizvoda (kopija računa, slip i sl.), kao i garantni list ukoliko je reč o proizvodima sa garancijom.</p>\r\n<p>Prilikom dostavljanja proizvoda niste dužni da dostavite ambalažu.</p>\r\n<p>Po prijemu reklamacije izdaćemo Vam pismenu potvrdu ili ćemo Vas elektronskim putem obavestiti da potvrđujemo da smo primili Va&scaron;u reklamaciju, odnosno saop&scaron;tićemo Vam broj pod kojim je onazavedena u evidenciji primljenih reklamacija.</p>\r\n<p>Najkasnije u roku od osam dana od dana prijema reklamacije, pismenim ili elektronskim putem odgovorićemo Vam na izjavljenu reklamaciju. Odgovor će sadržati odluku da li prihvatamo reklamaciju, izja&scaron;njenje o Va&scaron;em zahtevu i konkretan predlog i rok za re&scaron;avanje reklamacije koji ne može biti duži od 30 dana od dana podno&scaron;enja reklamacije.</p>', NULL, 'pravila-i-uslovi-koriscenja', 'Pravila i uslovi korišćenja', 'Pravila i uslovi korišćenja', 'ACTIVE', '2019-05-23 10:33:20', '2020-08-01 05:07:46'),
(7, 1, 'O nama', NULL, '<p>\"Annona Pro d.o.o.\" je kompanija koja je osnovana 2009. godine i bavi se uvozom i prodajom određenih kozmetičkih preparata i aparata. Za na&scaron;u firmu vezuje se pojam svilenih trepavica jer smo Gold Lashes trepavice prvi uvezli na prostore Srbije.</p>\r\n<p>Na&scaron; posao je da kupcima obezbedimo vrhunski kvalitet proizvoda po pristupačnim cenama. Pratimo sve promene na svetskom trži&scaron;tu kozmetike, tako da na&scaron; prodajni asortiman stalno raste. U sklopu kompanije nalazi se i salon lepote u kojem testiramo i koristimo sve na&scaron;e proizvode i na taj način kupcima obezbeđujemo konstantnu podr&scaron;ku u vidu savetovanja.Na&scaron; stručni kadar vr&scaron;i edukaciju kozmetičarima koji žele da prate nove tehnologije.</p>\r\n<p>Ove godine slavimo 10. rođendan a povodom toga smo spremili za Vas,dragi na&scaron;i klijenti,posebne pogodnosti i popuste. Ovo je odlična prilika da Vam se zahvalimo na poverenju koje nam pružate svih ovih godina. Čekamo Vas!</p>', 'pages\\October2020\\YsV5ai3YUYv2i5TEL0j2.png', 'o-nama', 'O nama', 'O nama', 'ACTIVE', '2019-05-23 11:41:28', '2020-10-08 06:08:26'),
(8, 1, 'Pomoć', 'Ukoliko imate bilo kakvih nedoumica ili pitanja u vezi korišćenja naše prodavnice, pretrage oznaka, narudžbine, plaćanja ili možda imate zahtev za razvoj i izradom specifičnih oznaka koje niste pronašli u našoj ponudi, molimo Vas da nam se javite e-mailom na prodaja@oznake.rs ili telefonom na 023 530 350, 060 530 3502 (Radnim danima 8-16h).', '<p>Ukoliko imate bilo kakvih nedoumica ili pitanja u vezi kori&scaron;ćenja na&scaron;e prodavnice, pretrage oznaka, narudžbine, plaćanja ili možda imate zahtev za razvoj i izradom specifičnih oznaka koje niste prona&scaron;li u na&scaron;oj ponudi, molimo Vas da nam se javite e-mailom na <a href=\"mailto:prodaja@oznake.rs\" target=\"_blank\" rel=\"noopener\">prodaja@oznake.rs</a> ili telefonom na 023 530 350, 060 530 3502 (Radnim danima 8-16h).</p>\r\n<p>&nbsp;</p>\r\n<p>Hvala.&nbsp;</p>', NULL, 'pomoc', 'Pomoć', 'Pomoć', 'ACTIVE', '2019-05-23 11:41:51', '2019-07-29 07:41:02'),
(9, 1, 'Kontakt', NULL, '<p>Ukoliko želite da saznate dodatne informacije o na&scaron;oj ponudi, možete nam poslati e-mail, pozvati nas ili nas kontaktirati direktno sa ove stranice.</p>', NULL, 'kontakt', 'Kontakt', 'Kontakt', 'ACTIVE', '2019-05-23 11:42:13', '2020-10-08 07:09:24'),
(10, 1, 'Plaćanje nije uspešno', 'Plaćanje nije uspešno', '<p>Po&scaron;tovani,</p>\r\n<p>&nbsp;</p>\r\n<p>Plaćanje nije uspe&scaron;no, va&scaron; račun nije zadužen. Najče&scaron;ći uzrok je pogre&scaron;no unet broj kartice, datum isteka ili sigurnosni kod. Poku&scaron;ajte ponovo, a u slučaju uzastopnih gre&scaron;aka pozovite va&scaron;u banku.</p>\r\n<p>&nbsp;</p>\r\n<p>Hvala</p>', NULL, 'payment-error', 'Greška!', 'Greška!', 'ACTIVE', '2019-06-21 08:59:45', '2019-08-12 10:31:55'),
(11, 1, 'Uspešna porudžbina', 'Uspešna porudžbina', '<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">Po&scaron;tovana/i,</p>\r\n<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</p>\r\n<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">Va&scaron;a porudžbina je uspe&scaron;ne evidentirana.</p>\r\n<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">Na va&scaron;u e-mail adresu je poslata potvrda.</p>\r\n<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</p>\r\n<p style=\"color: #444444; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\">Hvala na poverenju.</p>', '', 'thank-you', 'Uspešna porudžbina', 'Uspešna porudžbina', 'ACTIVE', '2019-07-22 08:12:51', '2020-07-30 11:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('davor.kikindjanin@onestopmarketing.rs', '$2y$10$5MP0YmsO1DFN4gGNujssI./OwOtRq5L7SFkt1PXN5pddEi4pbeNmG', '2020-08-03 07:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `title`, `description`, `active`, `created_at`, `updated_at`) VALUES
(3, 'Pouzećem', '<p>Plaćanje prilikom preuzimanja po&scaron;iljke</p>', 1, '2020-07-23', '2020-07-23'),
(4, 'Po predračunu', '<p>Informacije potrebne za uplatu &scaron;aljemo na va&scaron;u e-mail adresu nakon potvrde porudžbine</p>', 1, '2019-06-19', '2019-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(2, 'browse_bread', NULL, '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(3, 'browse_database', NULL, '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(4, 'browse_media', NULL, '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(5, 'browse_compass', NULL, '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(6, 'browse_menus', 'menus', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(7, 'read_menus', 'menus', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(8, 'edit_menus', 'menus', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(9, 'add_menus', 'menus', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(10, 'delete_menus', 'menus', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(11, 'browse_roles', 'roles', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(12, 'read_roles', 'roles', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(13, 'edit_roles', 'roles', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(14, 'add_roles', 'roles', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(15, 'delete_roles', 'roles', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(16, 'browse_users', 'users', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(17, 'read_users', 'users', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(18, 'edit_users', 'users', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(19, 'add_users', 'users', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(20, 'delete_users', 'users', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(21, 'browse_settings', 'settings', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(22, 'read_settings', 'settings', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(23, 'edit_settings', 'settings', '2019-04-16 10:11:49', '2019-04-16 10:11:49'),
(24, 'add_settings', 'settings', '2019-04-16 10:11:49', '2019-04-16 10:11:49'),
(25, 'delete_settings', 'settings', '2019-04-16 10:11:49', '2019-04-16 10:11:49'),
(26, 'browse_categories', 'categories', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(27, 'read_categories', 'categories', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(28, 'edit_categories', 'categories', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(29, 'add_categories', 'categories', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(30, 'delete_categories', 'categories', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(31, 'browse_posts', 'posts', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(32, 'read_posts', 'posts', '2019-04-16 10:11:53', '2019-04-16 10:11:53'),
(33, 'edit_posts', 'posts', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(34, 'add_posts', 'posts', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(35, 'delete_posts', 'posts', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(36, 'browse_pages', 'pages', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(37, 'read_pages', 'pages', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(38, 'edit_pages', 'pages', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(39, 'add_pages', 'pages', '2019-04-16 10:11:54', '2019-04-16 10:11:54'),
(40, 'delete_pages', 'pages', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(41, 'browse_hooks', NULL, '2019-04-16 10:11:56', '2019-04-16 10:11:56'),
(42, 'browse_products', 'products', '2019-05-22 11:21:14', '2019-05-22 11:21:14'),
(43, 'read_products', 'products', '2019-05-22 11:21:14', '2019-05-22 11:21:14'),
(44, 'edit_products', 'products', '2019-05-22 11:21:14', '2019-05-22 11:21:14'),
(45, 'add_products', 'products', '2019-05-22 11:21:14', '2019-05-22 11:21:14'),
(46, 'delete_products', 'products', '2019-05-22 11:21:14', '2019-05-22 11:21:14'),
(52, 'browse_dimensions', 'dimensions', '2019-05-25 09:15:48', '2019-05-25 09:15:48'),
(53, 'read_dimensions', 'dimensions', '2019-05-25 09:15:48', '2019-05-25 09:15:48'),
(54, 'edit_dimensions', 'dimensions', '2019-05-25 09:15:48', '2019-05-25 09:15:48'),
(55, 'add_dimensions', 'dimensions', '2019-05-25 09:15:48', '2019-05-25 09:15:48'),
(56, 'delete_dimensions', 'dimensions', '2019-05-25 09:15:49', '2019-05-25 09:15:49'),
(57, 'browse_materials', 'materials', '2019-05-25 09:16:37', '2019-05-25 09:16:37'),
(58, 'read_materials', 'materials', '2019-05-25 09:16:37', '2019-05-25 09:16:37'),
(59, 'edit_materials', 'materials', '2019-05-25 09:16:37', '2019-05-25 09:16:37'),
(60, 'add_materials', 'materials', '2019-05-25 09:16:37', '2019-05-25 09:16:37'),
(61, 'delete_materials', 'materials', '2019-05-25 09:16:37', '2019-05-25 09:16:37'),
(62, 'browse_orders', 'orders', '2019-05-31 13:36:31', '2019-05-31 13:36:31'),
(63, 'read_orders', 'orders', '2019-05-31 13:36:31', '2019-05-31 13:36:31'),
(64, 'edit_orders', 'orders', '2019-05-31 13:36:31', '2019-05-31 13:36:31'),
(65, 'add_orders', 'orders', '2019-05-31 13:36:31', '2019-05-31 13:36:31'),
(66, 'delete_orders', 'orders', '2019-05-31 13:36:31', '2019-05-31 13:36:31'),
(67, 'browse_order_items', 'order_items', '2019-06-14 10:41:24', '2019-06-14 10:41:24'),
(68, 'read_order_items', 'order_items', '2019-06-14 10:41:24', '2019-06-14 10:41:24'),
(69, 'edit_order_items', 'order_items', '2019-06-14 10:41:24', '2019-06-14 10:41:24'),
(70, 'add_order_items', 'order_items', '2019-06-14 10:41:24', '2019-06-14 10:41:24'),
(71, 'delete_order_items', 'order_items', '2019-06-14 10:41:24', '2019-06-14 10:41:24'),
(72, 'browse_payment_methods', 'payment_methods', '2019-06-19 12:57:45', '2019-06-19 12:57:45'),
(73, 'read_payment_methods', 'payment_methods', '2019-06-19 12:57:45', '2019-06-19 12:57:45'),
(74, 'edit_payment_methods', 'payment_methods', '2019-06-19 12:57:45', '2019-06-19 12:57:45'),
(75, 'add_payment_methods', 'payment_methods', '2019-06-19 12:57:45', '2019-06-19 12:57:45'),
(76, 'delete_payment_methods', 'payment_methods', '2019-06-19 12:57:45', '2019-06-19 12:57:45'),
(77, 'browse_order_status', 'order_status', '2019-06-19 13:23:18', '2019-06-19 13:23:18'),
(78, 'read_order_status', 'order_status', '2019-06-19 13:23:18', '2019-06-19 13:23:18'),
(79, 'edit_order_status', 'order_status', '2019-06-19 13:23:18', '2019-06-19 13:23:18'),
(80, 'add_order_status', 'order_status', '2019-06-19 13:23:18', '2019-06-19 13:23:18'),
(81, 'delete_order_status', 'order_status', '2019-06-19 13:23:18', '2019-06-19 13:23:18'),
(82, 'browse_attributes', 'attributes', '2020-06-16 06:24:45', '2020-06-16 06:24:45'),
(83, 'read_attributes', 'attributes', '2020-06-16 06:24:45', '2020-06-16 06:24:45'),
(84, 'edit_attributes', 'attributes', '2020-06-16 06:24:45', '2020-06-16 06:24:45'),
(85, 'add_attributes', 'attributes', '2020-06-16 06:24:45', '2020-06-16 06:24:45'),
(86, 'delete_attributes', 'attributes', '2020-06-16 06:24:45', '2020-06-16 06:24:45'),
(87, 'browse_attributes_values', 'attributes_values', '2020-06-17 07:54:07', '2020-06-17 07:54:07'),
(88, 'read_attributes_values', 'attributes_values', '2020-06-17 07:54:07', '2020-06-17 07:54:07'),
(89, 'edit_attributes_values', 'attributes_values', '2020-06-17 07:54:07', '2020-06-17 07:54:07'),
(90, 'add_attributes_values', 'attributes_values', '2020-06-17 07:54:07', '2020-06-17 07:54:07'),
(91, 'delete_attributes_values', 'attributes_values', '2020-06-17 07:54:07', '2020-06-17 07:54:07'),
(92, 'browse_manufacturer', 'manufacturer', '2020-06-24 13:10:35', '2020-06-24 13:10:35'),
(93, 'read_manufacturer', 'manufacturer', '2020-06-24 13:10:35', '2020-06-24 13:10:35'),
(94, 'edit_manufacturer', 'manufacturer', '2020-06-24 13:10:35', '2020-06-24 13:10:35'),
(95, 'add_manufacturer', 'manufacturer', '2020-06-24 13:10:35', '2020-06-24 13:10:35'),
(96, 'delete_manufacturer', 'manufacturer', '2020-06-24 13:10:35', '2020-06-24 13:10:35'),
(97, 'browse_sliders', 'sliders', '2020-07-08 12:00:15', '2020-07-08 12:00:15'),
(98, 'read_sliders', 'sliders', '2020-07-08 12:00:15', '2020-07-08 12:00:15'),
(99, 'edit_sliders', 'sliders', '2020-07-08 12:00:15', '2020-07-08 12:00:15'),
(100, 'add_sliders', 'sliders', '2020-07-08 12:00:15', '2020-07-08 12:00:15'),
(101, 'delete_sliders', 'sliders', '2020-07-08 12:00:15', '2020-07-08 12:00:15'),
(102, 'browse_sliders_items', 'sliders_items', '2020-07-08 13:41:13', '2020-07-08 13:41:13'),
(103, 'read_sliders_items', 'sliders_items', '2020-07-08 13:41:13', '2020-07-08 13:41:13'),
(104, 'edit_sliders_items', 'sliders_items', '2020-07-08 13:41:13', '2020-07-08 13:41:13'),
(105, 'add_sliders_items', 'sliders_items', '2020-07-08 13:41:13', '2020-07-08 13:41:13'),
(106, 'delete_sliders_items', 'sliders_items', '2020-07-08 13:41:13', '2020-07-08 13:41:13'),
(107, 'browse_special_options', 'special_options', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(108, 'read_special_options', 'special_options', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(109, 'edit_special_options', 'special_options', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(110, 'add_special_options', 'special_options', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(111, 'delete_special_options', 'special_options', '2020-07-10 07:13:30', '2020-07-10 07:13:30'),
(112, 'browse_banners_positions', 'banners_positions', '2020-07-31 05:55:19', '2020-07-31 05:55:19'),
(113, 'read_banners_positions', 'banners_positions', '2020-07-31 05:55:19', '2020-07-31 05:55:19'),
(114, 'edit_banners_positions', 'banners_positions', '2020-07-31 05:55:19', '2020-07-31 05:55:19'),
(115, 'add_banners_positions', 'banners_positions', '2020-07-31 05:55:19', '2020-07-31 05:55:19'),
(116, 'delete_banners_positions', 'banners_positions', '2020-07-31 05:55:19', '2020-07-31 05:55:19'),
(117, 'browse_banners_clients', 'banners_clients', '2020-07-31 06:03:21', '2020-07-31 06:03:21'),
(118, 'read_banners_clients', 'banners_clients', '2020-07-31 06:03:21', '2020-07-31 06:03:21'),
(119, 'edit_banners_clients', 'banners_clients', '2020-07-31 06:03:21', '2020-07-31 06:03:21'),
(120, 'add_banners_clients', 'banners_clients', '2020-07-31 06:03:21', '2020-07-31 06:03:21'),
(121, 'delete_banners_clients', 'banners_clients', '2020-07-31 06:03:21', '2020-07-31 06:03:21'),
(122, 'browse_banners', 'banners', '2020-07-31 06:10:15', '2020-07-31 06:10:15'),
(123, 'read_banners', 'banners', '2020-07-31 06:10:15', '2020-07-31 06:10:15'),
(124, 'edit_banners', 'banners', '2020-07-31 06:10:15', '2020-07-31 06:10:15'),
(125, 'add_banners', 'banners', '2020-07-31 06:10:15', '2020-07-31 06:10:15'),
(126, 'delete_banners', 'banners', '2020-07-31 06:10:15', '2020-07-31 06:10:15'),
(127, 'browse_badges', 'badges', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(128, 'read_badges', 'badges', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(129, 'edit_badges', 'badges', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(130, 'add_badges', 'badges', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(131, 'delete_badges', 'badges', '2020-08-14 11:15:05', '2020-08-14 11:15:05'),
(132, 'browse_product_images', 'product_images', '2020-09-30 17:39:14', '2020-09-30 17:39:14'),
(133, 'read_product_images', 'product_images', '2020-09-30 17:39:15', '2020-09-30 17:39:15'),
(134, 'edit_product_images', 'product_images', '2020-09-30 17:39:15', '2020-09-30 17:39:15'),
(135, 'add_product_images', 'product_images', '2020-09-30 17:39:15', '2020-09-30 17:39:15'),
(136, 'delete_product_images', 'product_images', '2020-09-30 17:39:16', '2020-09-30 17:39:16'),
(137, 'browse_newsletter_subscribers', 'newsletter_subscribers', '2020-10-02 07:05:43', '2020-10-02 07:05:43'),
(138, 'read_newsletter_subscribers', 'newsletter_subscribers', '2020-10-02 07:05:43', '2020-10-02 07:05:43'),
(139, 'edit_newsletter_subscribers', 'newsletter_subscribers', '2020-10-02 07:05:43', '2020-10-02 07:05:43'),
(140, 'add_newsletter_subscribers', 'newsletter_subscribers', '2020-10-02 07:05:44', '2020-10-02 07:05:44'),
(141, 'delete_newsletter_subscribers', 'newsletter_subscribers', '2020-10-02 07:05:44', '2020-10-02 07:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(4, 3),
(5, 1),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(38, 1),
(38, 3),
(39, 1),
(39, 3),
(40, 1),
(40, 3),
(42, 1),
(42, 3),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(52, 1),
(52, 3),
(53, 1),
(53, 3),
(54, 1),
(54, 3),
(55, 1),
(55, 3),
(56, 1),
(56, 3),
(57, 1),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 3),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(63, 3),
(64, 1),
(64, 3),
(65, 1),
(65, 3),
(66, 1),
(66, 3),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(7, 1, 85, 'ANTI - Aging linija', NULL, 'Anti-aging linija', '<p>Antiaging linija obnavlja kožu i održava je zdravom zahvaljujući proizvodnji novog kolagena. Ova linija ponovo uravnotežuje volumen lica sa efektom punjenja i pomaže u smanjenju bora i finih linija.</p>\r\n<ul>\r\n<li>Anti-aging linija se sastoji od:</li>\r\n<li>Matrix Repair Crema</li>\r\n<li>Anti-aging+HA</li>\r\n<li>Anti-aging Peel-Off Maska</li>\r\n<li>TKN Anti-aging koktel</li>\r\n</ul>', 'posts\\September2020\\HCkvQc4FAfBQSyoh8jwm.png', 'anti-aging-linija', 'Anti-aging linija', 'Anti-aging linija', 'PUBLISHED', 0, '2020-09-23 05:55:57', '2020-09-26 12:38:16'),
(8, 1, 86, 'Hemijski pilin obuka', NULL, NULL, '<p>Obuka je namenjena kozmetičarima!</p>\r\n<p>Obuke su u na&scaron;em salonu u Bečeju, i odvijaju se u grupama od 1-3 polaznika! Za obuku je potreban model!</p>\r\n<p>Uz početni paket obuka je besplatna!</p>\r\n<p>Sadržaj seta:</p>\r\n<p>&bull; Toskani hydro tonik 200ml.</p>\r\n<p>&bull; Toskani energizing cleanser</p>\r\n<p>&bull; Mandelična 30%/ Salicilna 30%/ Mlečna kiselina 30% 1 kom</p>\r\n<p>&bull; Mandelična 50%/ Glikolna 50%/ Glikolna kiselina 70% 1 kom</p>\r\n<p>&bull; Anti-pollution Cream 50ml 1 kom &bull; Neutralizator 100 ml 1 kom</p>\r\n<p>&bull; Toskani Antiaging peel off maska</p>\r\n<p>&bull; Toskani Anti-pollution peel off maska</p>\r\n<p>&bull; Toskani Radiance peel off maska</p>\r\n<p>&bull; Toskani Purifying peel off maska</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #99cc00;\"><strong>Cena seta: 28 550 rsd </strong></span></p>\r\n<p>Prilikom prijave na obuku neophodno je da uplatite rezervaciju! Detaljnije pozovite na: 021/6913 489 ili 061/22 -60-610</p>', 'posts\\September2020\\sbfN7VTL4YdRmpwcbzs4.png', 'hemijski-pilin-obuka', NULL, NULL, 'PUBLISHED', 0, '2020-09-23 05:58:04', '2020-09-23 05:58:18'),
(9, 1, 85, 'Anti - polution linija', NULL, NULL, '<p>Antiaging linija obnavlja kožu i održava je zdravom zahvaljujući proizvodnji novog kolagena.</p>\r\n<p>Ova linija ponovo uravnotežuje volumen lica sa efektom punjenja i pomaže u smanjenju bora i finih linija.</p>\r\n<p>Anti-aging linija se sastoji od:</p>\r\n<p>&bull; Matrix Repair Crema</p>\r\n<p>&bull; Anti-aging+HA</p>\r\n<p>&bull; Anti-aging Peel-Off Maska</p>\r\n<p>&bull; TKN Anti-aging koktel</p>', 'posts\\September2020\\EkN2m8pb48qNm4nNEEDl.jpg', 'anti-polution-linija', NULL, NULL, 'PUBLISHED', 0, '2020-09-25 16:36:27', '2020-09-25 16:36:27'),
(10, 1, 86, 'Mezopen obuka', NULL, NULL, '<p>Antiaging linija obnavlja kožu i održava je zdravom zahvaljujući proizvodnji novog kolagena.</p>\r\n<p>Ova linija ponovo uravnotežuje volumen lica sa efektom punjenja i pomaže u smanjenju bora i finih linija.</p>\r\n<p>Anti-aging linija se sastoji od:</p>\r\n<p>&bull; Matrix Repair Crema</p>\r\n<p>&bull; Anti-aging+HA</p>\r\n<p>&bull; Anti-aging Peel-Off Maska</p>\r\n<p>&bull; TKN Anti-aging koktel</p>', 'posts\\September2020\\vUO0tnszkwj30lpPvci1.jpg', 'mezopen-obuka', NULL, NULL, 'PUBLISHED', 0, '2020-09-25 16:37:44', '2020-09-25 16:37:44'),
(11, 1, 93, 'Edukacija', 'Edukacija', NULL, '<p>Annona Pro doo od 2010. godine nudi usluge edukacije kozmetičarima koji žele da prate nove tehnologije. Edukacije shvatamo vrlo ozbiljno, maksimalno se posvećujemo svim polaznicima i zaista nesebično prenosimo znanje. Polaznici zavr&scaron;avaju obuku sa stečenim znanjem i ve&scaron;tinama koja su svakodnevno primenljiva u salonu i u potpunosti su osposobljena za dalji samostalni rad. Na&scaron;im polaznicima nakon zavr&scaron;ene edukacije obezbedili smo besplatno savetovanje i pomoć pri radu.</p>\r\n<p>O na&scaron;em uspehu govori podatak da danas ima vi&scaron;e od 250 zadovoljnih Gold Lashes profesionalaca &scaron;irom Srbije, Hrvatske, Bosne i Hercegovine i Makedonije.</p>\r\n<p>Od 2014.-te godine nudimo edukacije i iz oblasti iscrtavanja obrva o&scaron;tricama. Ova metoda spada u najnovije inovacije tetovaža i trenutno je najpopularniji estetski tretman u kozmetici.</p>\r\n<p>Program, metodu rada i udžbenike je napisao profesionalan i stručan tim majstora trajne &scaron;minke.</p>', NULL, 'edukacija', 'Edukacija', 'Edukacija', 'PUBLISHED', 0, '2020-10-08 05:48:17', '2020-10-08 06:19:00'),
(12, 1, 93, 'Kozmetičk preparati', 'Kozmetičk preparati', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris elementum turpis in quam cursus venenatis. Integer sagittis lectus ac facilisis volutpat. Fusce ex ex, pharetra a dolor eu, venenatis aliquet purus. Morbi ac ligula a sem euismod tincidunt. Vivamus sapien urna, egestas id ex vitae, rutrum facilisis felis. Nullam non risus a nunc malesuada pellentesque vel in justo. Cras fringilla, quam et convallis tempus, nisi diam auctor magna, eget mattis tortor erat sed arcu. Proin congue sagittis justo non rhoncus.</p>\r\n<p>Aliquam cursus non enim vitae scelerisque. In non erat id tortor elementum blandit. Etiam molestie semper dapibus. Vivamus vel sapien at enim feugiat egestas. Nam vitae maximus lectus. Mauris urna nunc, accumsan eu mi sit amet, pellentesque rhoncus lacus. Sed magna justo, lobortis id velit vitae, ultrices blandit ante. Integer vehicula turpis quis turpis condimentum, eu convallis eros porttitor. Nunc mattis convallis sem, in commodo quam condimentum ut. Cras et tellus vel mauris egestas viverra.</p>', NULL, 'kozmetick-preparati', 'Kozmetičk preparati', 'Kozmetičk preparati', 'PUBLISHED', 0, '2020-10-08 05:49:28', '2020-10-08 06:18:48'),
(13, 1, 93, 'Kozmetički program', 'Kozmetički program', NULL, '<p>Suspendisse porttitor, quam non egestas dictum, nunc nunc commodo mi, in maximus metus sem non arcu. Proin blandit elit dictum efficitur lacinia. Vestibulum faucibus sodales nisi tincidunt ullamcorper. Suspendisse tincidunt tellus felis, non dictum leo sollicitudin vel. Donec euismod urna sed tortor porttitor, ac tincidunt augue pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nibh quam, lacinia sed egestas ut, ullamcorper eu tortor. Phasellus eleifend felis et congue feugiat. Quisque ultrices, dui in rutrum sodales, erat enim venenatis nisl, a pharetra enim felis eget mi. Phasellus suscipit auctor cursus. Aliquam ullamcorper eleifend nunc id tempor. Sed dapibus lorem at accumsan faucibus. Nullam et nisi turpis. Quisque blandit tortor ut consectetur ornare. Nam varius mauris a libero sollicitudin facilisis. Donec vel libero in erat porta posuere.</p>\r\n<p>Nunc at mauris sed eros pellentesque tempus. Quisque vitae imperdiet turpis. Suspendisse vulputate ultrices nisl aliquam semper. Quisque nec dolor mollis, vulputate eros at, lobortis nisi. Sed lacinia et metus non pellentesque. Nunc imperdiet aliquet congue. Duis ante eros, bibendum vel eleifend a, euismod sit amet felis. Praesent ultricies justo volutpat neque scelerisque malesuada. In hac habitasse platea dictumst. Donec ac auctor orci. Nam laoreet dignissim mauris sit amet commodo. Curabitur egestas, ipsum eu feugiat laoreet, massa risus pellentesque odio, ut scelerisque ante odio ut lacus.</p>', NULL, 'kozmeticki-program', 'Kozmetički program', 'Kozmetički program', 'PUBLISHED', 0, '2020-10-08 05:50:13', '2020-10-08 06:18:38'),
(14, 1, 93, 'Nadogradnja trepavica', 'Nadogradnja trepavica', NULL, '<p>Nunc at mauris sed eros pellentesque tempus. Quisque vitae imperdiet turpis. Suspendisse vulputate ultrices nisl aliquam semper. Quisque nec dolor mollis, vulputate eros at, lobortis nisi. Sed lacinia et metus non pellentesque. Nunc imperdiet aliquet congue. Duis ante eros, bibendum vel eleifend a, euismod sit amet felis. Praesent ultricies justo volutpat neque scelerisque malesuada. In hac habitasse platea dictumst. Donec ac auctor orci. Nam laoreet dignissim mauris sit amet commodo. Curabitur egestas, ipsum eu feugiat laoreet, massa risus pellentesque odio, ut scelerisque ante odio ut lacus.</p>\r\n<p>Curabitur felis dolor, hendrerit sed leo tempus, pretium efficitur ex. Curabitur mattis sed mauris eget gravida. Mauris ut placerat odio. Vestibulum vel gravida lorem, laoreet efficitur ipsum. Donec semper metus diam, non bibendum nunc vehicula non. Etiam pellentesque sollicitudin enim et molestie. In malesuada tellus sit amet mi elementum bibendum. Proin id convallis risus, eu finibus orci. Quisque lacinia nibh mi, et tincidunt massa tincidunt ut. Integer nulla tellus, hendrerit ac vestibulum in, pharetra in libero. Etiam eu arcu est. Etiam dapibus ullamcorper sapien sed vestibulum. Curabitur fringilla ut justo vel aliquet.</p>', NULL, 'nadogradnja-trepavica', 'Nadogradnja trepavica', 'Nadogradnja trepavica', 'PUBLISHED', 0, '2020-10-08 05:50:40', '2020-10-08 06:18:30'),
(15, 1, 93, 'Trajna šminka', 'Trajna šminka', NULL, '<p>Aliquam cursus non enim vitae scelerisque. In non erat id tortor elementum blandit. Etiam molestie semper dapibus. Vivamus vel sapien at enim feugiat egestas. Nam vitae maximus lectus. Mauris urna nunc, accumsan eu mi sit amet, pellentesque rhoncus lacus. Sed magna justo, lobortis id velit vitae, ultrices blandit ante. Integer vehicula turpis quis turpis condimentum, eu convallis eros porttitor. Nunc mattis convallis sem, in commodo quam condimentum ut. Cras et tellus vel mauris egestas viverra.</p>\r\n<p>Suspendisse porttitor, quam non egestas dictum, nunc nunc commodo mi, in maximus metus sem non arcu. Proin blandit elit dictum efficitur lacinia. Vestibulum faucibus sodales nisi tincidunt ullamcorper. Suspendisse tincidunt tellus felis, non dictum leo sollicitudin vel. Donec euismod urna sed tortor porttitor, ac tincidunt augue pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nibh quam, lacinia sed egestas ut, ullamcorper eu tortor. Phasellus eleifend felis et congue feugiat. Quisque ultrices, dui in rutrum sodales, erat enim venenatis nisl, a pharetra enim felis eget mi. Phasellus suscipit auctor cursus. Aliquam ullamcorper eleifend nunc id tempor. Sed dapibus lorem at accumsan faucibus. Nullam et nisi turpis. Quisque blandit tortor ut consectetur ornare. Nam varius mauris a libero sollicitudin facilisis. Donec vel libero in erat porta posuere.</p>\r\n<p>Nunc at mauris sed eros pellentesque tempus. Quisque vitae imperdiet turpis. Suspendisse vulputate ultrices nisl aliquam semper. Quisque nec dolor mollis, vulputate eros at, lobortis nisi. Sed lacinia et metus non pellentesque. Nunc imperdiet aliquet congue. Duis ante eros, bibendum vel eleifend a, euismod sit amet felis. Praesent ultricies justo volutpat neque scelerisque malesuada. In hac habitasse platea dictumst. Donec ac auctor orci. Nam laoreet dignissim mauris sit amet commodo. Curabitur egestas, ipsum eu feugiat laoreet, massa risus pellentesque odio, ut scelerisque ante odio ut lacus.</p>', NULL, 'trajna-sminka', 'Trajna šminka', 'Trajna šminka', 'PUBLISHED', 0, '2020-10-08 05:51:04', '2020-10-08 06:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` text CHARACTER SET utf8 NOT NULL,
  `import_id` int(100) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(800) CHARACTER SET utf8 NOT NULL,
  `category_id` int(5) NOT NULL,
  `author_id` int(5) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `excerpt` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `body` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `specification` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `video` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `image_import` text CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8 NOT NULL,
  `meta_keywords` text CHARACTER SET utf8 NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `featured` smallint(6) NOT NULL DEFAULT 0,
  `product_price` int(20) DEFAULT NULL,
  `product_price_with_discount` int(100) DEFAULT NULL,
  `product_discount` int(20) DEFAULT NULL,
  `product_retail_price` int(100) DEFAULT NULL,
  `product_vat` int(20) DEFAULT NULL,
  `warranty` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `zapremina` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `import_id`, `title`, `slug`, `category_id`, `author_id`, `manufacturer_id`, `excerpt`, `body`, `specification`, `video`, `image`, `image_import`, `meta_description`, `meta_keywords`, `status`, `featured`, `product_price`, `product_price_with_discount`, `product_discount`, `product_retail_price`, `product_vat`, `warranty`, `created_at`, `updated_at`, `zapremina`) VALUES
(1, '1000', 0, 'Anti aging set', 'anti-aging-set', 24, 1, 1, '<p>Uvodni tekst ako je potreban</p>', '<p>Kompletan opis za proizvod</p>', '<p>Dodatna specifikacija</p>', NULL, '24-06102020112555-anti_aging_set.jpg', NULL, 'Anti aging set', 'Anti aging set', 1, 0, 500, NULL, NULL, NULL, NULL, 0, '2020-10-06 11:25:55', '2020-10-06 11:25:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_favourites`
--

DROP TABLE IF EXISTS `products_favourites`;
CREATE TABLE IF NOT EXISTS `products_favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id_fav_fk` (`user_id`),
  KEY `product_id_fav_fk` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_tmp`
--

DROP TABLE IF EXISTS `products_tmp`;
CREATE TABLE IF NOT EXISTS `products_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` text CHARACTER SET utf8 NOT NULL,
  `import_id` int(100) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(800) CHARACTER SET utf8 NOT NULL,
  `category_id` int(5) DEFAULT NULL,
  `author_id` int(5) NOT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `excerpt` mediumtext CHARACTER SET utf8 NOT NULL,
  `body` mediumtext CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8 NOT NULL,
  `meta_keywords` text CHARACTER SET utf8 NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `featured` smallint(6) NOT NULL DEFAULT 0,
  `product_price` int(20) DEFAULT NULL,
  `product_price_with_discount` int(100) NOT NULL,
  `product_discount` int(20) DEFAULT NULL,
  `product_retail_price` int(100) NOT NULL,
  `product_vat` int(20) DEFAULT NULL,
  `warranty` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `import_cat_id` int(100) NOT NULL,
  `import_mfc_id` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_order` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_fk_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2019-04-16 10:11:48', '2019-04-16 10:11:48'),
(2, 'user', 'Kupac', '2019-04-16 10:11:48', '2019-05-31 09:52:19'),
(3, 'Urednik', 'Urednik', '2019-05-23 03:53:39', '2019-05-23 03:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Annona Pro', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'AnnonaPro', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings\\September2020\\0YeE0QyLoJrZ3br7ATQc.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings\\June2019\\0VSjmqAVEGHp6vQ1FvKk.jpg', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'OSM Adm', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'www.annonapro.com', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', 'settings\\June2019\\8x2yg0vheXOYXSGlytRg.gif', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', 'settings\\June2019\\FK0kDExjWbLniTKMVkm2.png', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '418071945878-1bqapit2ml52db3r4cith1libu2ts6m2.apps.googleusercontent.com', '', 'text', 1, 'Admin'),
(11, 'site.facebook', 'Facebok URL', 'https://www.facebook.com/AnnonaPro', NULL, 'text', 6, 'Site'),
(12, 'site.instagram', 'Instagram URL', 'https://www.facebook.com/AnnonaPro', NULL, 'text', 7, 'Site'),
(18, 'site.valuta', 'Valuta', 'RSD', NULL, 'text', 13, 'Site'),
(21, 'site.keywords', 'Site Keywords', 'Annona', NULL, 'text', 14, 'Site'),
(22, 'site.footer_logo', 'Footer Logo', 'settings\\October2020\\pC2a9VIeQV84hYAKET3W.png', NULL, 'image', 15, 'Site'),
(23, 'admin.adm_url', 'ADM url', 'SDFSDf345345--DFgghjtyut-6', NULL, 'text', 16, 'Admin'),
(24, 'site.free_shipping', 'Free Shipping', NULL, NULL, 'rich_text_box', 17, 'Site'),
(25, 'site.login_text', 'Login Text', '<p>Pristupite va&scaron;em korisničkom profilu.</p>\r\n<p>Pregledajte porudžbine.</p>\r\n<p>Uredite svoj profil.</p>\r\n<p>&nbsp;</p>\r\n<p>Za registraciju, pratite link ispod.</p>\r\n<p><a id=\"btnRegister\" class=\"btn btn-primary rounded-pill\" href=\"/register\">Registracija</a></p>', NULL, 'rich_text_box', 18, 'Site'),
(26, 'site.change_password_email', 'Change Password - Email', '<p>Unesite e-mail adresu koju ste koristili prilikom registracije.</p>\r\n<p>Uputstvo za promenu &scaron;ifre će biti poslato na e-mail.</p>\r\n<p>&nbsp;</p>', NULL, 'rich_text_box', 19, 'Site'),
(27, 'site.shipping_method', 'Nacin isporuke', 'Ispruka je XXX XXX kurirskom službom prema važećem cenovniku.', NULL, 'text_area', 20, 'Site'),
(30, 'company.company_name', 'Naziv', 'Annona Pro d.o.o.', NULL, 'text', 21, 'Company'),
(31, 'company.company_address', 'Adresa', 'Zelena 28, 21220 Bečej', NULL, 'text', 22, 'Company'),
(32, 'company.company_postal_code', 'Postanski broj', '21200', NULL, 'text', 23, 'Company'),
(33, 'company.company_city', 'Mesto', 'Bečej', NULL, 'text', 24, 'Company'),
(34, 'company.company_country', 'Drzava', 'Republika Srbija', NULL, 'text', 25, 'Company'),
(35, 'company.company_phone', 'Telefon', '021 6913 489 ; 061/22-60-610', NULL, 'text', 26, 'Company'),
(36, 'company.company_email', 'E-mail', 'office@annonapro.com', NULL, 'text', 27, 'Company'),
(37, 'company.company_pib', 'PIB', '123456789', NULL, 'text', 28, 'Company'),
(38, 'company.company_mb', 'Maticni broj', '12345678', NULL, 'text', 29, 'Company'),
(39, 'company.company_web', 'Internet adresa', 'www.annonapro.com', NULL, 'text', 30, 'Company'),
(40, 'shop.shop_notification_email', 'Mail za notifikacije', 'webmaster@onestopmarketing.rs', NULL, 'text', 31, 'Shop'),
(41, 'shop.shop_delivery_note', 'Obavestenje za isporuku', 'Cena isporuke je prema važećem cenovniku kurirske službe PostExpress.', NULL, 'text', 32, 'Shop'),
(42, 'shop.shop_admin_mail', 'Admin mail', 'webmaster@onestopmarketing.rs', NULL, 'text', 33, 'Shop'),
(43, 'company.company_bank_account', 'Tekuci racun', '555-55533366699-27', NULL, 'text', 34, 'Company'),
(44, 'shop.shop_proformainvoice_note', 'Napomena za predracun', '<p>Napomena o poreskom oslobođenju: nema.</p>\r\n<p>U slučaju spora, nadležan je Privredni sud u Zrenjaninu.</p>', NULL, 'rich_text_box', 35, 'Shop'),
(45, 'site.google_analytics_tracking_code', 'Google Analytics Tracking Code', '<!-- Global site tag (gtag.js) - Google Analytics --> <script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-70630823-25\"></script> <script>   window.dataLayer = window.dataLayer || [];   function gtag(){dataLayer.push(arguments);}   gtag(\'js\', new Date());    gtag(\'config\', \'UA-70630823-25\'); </script>', NULL, 'text', 37, 'Site'),
(47, 'site.cookie_notice', 'Obavestenje za kolacice', '<p>Ovaj sajt koristi se kolačićima (eng.cookies) u cilju &scaron;to boljeg iskustva na&scaron;ih korisnika. Kori&scaron;ćenjem ovog sajta prihvatate kori&scaron;ćenje kolačića. Detalje o upotrebi kolačića možete pogledati na stranici <a href=\"/privatnost-korisnika\">Politika privatnosti</a>.</p>', NULL, 'rich_text_box', 36, 'Site'),
(48, 'site.site_url', 'Site URL', 'http://127.0.0.1:8000', NULL, 'text', 38, 'Site'),
(52, 'site.kontakt', 'kontakt', '<ul>\r\n<li>021 6913 489 ; 061/22-60-610</li>\r\n<li><a title=\"AnnonaPro\" href=\"mailto:office@annonapro.com\">office@annonapro.com</a></li>\r\n<li>Zelena 28, 21220 Bečej</li>\r\n</ul>', NULL, 'rich_text_box', 39, 'Site'),
(57, 'site.jezik', 'Jezik', 'rs', '{\r\n    \"default\": \"\",\r\n    \"options\": {\r\n        \"rs\": \"SRB\",\r\n        \"en\": \"ENG\"\r\n    }\r\n}', 'select_dropdown', 40, 'Site'),
(70, 'company.kontakt_text', 'Kontakt text', '<p>Ukoliko želite da saznate dodatne informacije o na&scaron;oj ponudi, možete nam poslati e-mail, pozvati nas ili nas kontaktirati direktno sa ove stranice.</p>', NULL, 'rich_text_box', 49, 'Company'),
(71, 'company.kontakt_mapa', 'Kontakt mapa url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2790.9127238777824!2d20.049322015770553!3d45.61239783156313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b33a4a0d123d1%3A0x3e4adfa55fc3a12e!2z0JfQtdC70LXQvdCwIDI4LCDQkdC10YfQtdGY!5e0!3m2!1ssr!2srs!4v1601630428970!5m2!1ssr!2srs', NULL, 'text_area', 50, 'Company'),
(73, 'site.radno_vreme', 'Radno vreme', '<p>Pon. 9:00 &mdash; 16:00</p>\r\n<p>Uto. 9:00 &mdash; 16:00</p>\r\n<p>Sre. 9:00 &mdash; 16:00</p>\r\n<p>Čet. 9:00 &mdash; 16:00</p>\r\n<p>Pet. 9:00 &mdash; 16:00</p>\r\n<p>Sub. 9:00 &mdash; 14:00</p>\r\n<p>Ned. --Zatvoreno</p>', NULL, 'rich_text_box', 51, 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_status` int(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `slider_status`, `created_at`, `updated_at`) VALUES
(1, 'Slider 11', 'Ovo je slider za pocetnu stranicu', 1, '2020-07-08 14:15:19', '2020-07-09 07:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `sliders_items`
--

DROP TABLE IF EXISTS `sliders_items`;
CREATE TABLE IF NOT EXISTS `sliders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL,
  `title` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_target` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide_order` int(100) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slider_id` (`slider_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders_items`
--

INSERT INTO `sliders_items` (`id`, `slider_id`, `title`, `text`, `url`, `url_target`, `image`, `slide_order`, `status`, `created_at`, `updated_at`) VALUES
(13, 1, 'AnnonaPro', NULL, NULL, '_self', '1-04092020071035-100087157_3121027647961775_689800304975151104_o.png', 1, 1, '0000-00-00 00:00:00', '2020-09-04 07:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `special_options`
--

DROP TABLE IF EXISTS `special_options`;
CREATE TABLE IF NOT EXISTS `special_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_options`
--

INSERT INTO `special_options` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(5, 'Home - Row 1', 'Blok na pocetnoj', NULL, '2020-07-10 09:17:57', '2020-07-10 09:17:57'),
(6, 'Home - Row 2', 'Blok na pocetnoj', NULL, '2020-07-10 09:18:13', '2020-07-10 09:18:13'),
(7, 'Novo', 'Noviteti, najsvezije', NULL, '2020-08-10 08:32:42', '2020-08-10 08:32:42'),
(8, 'Preporučeno', 'Preporučeno', NULL, '2020-09-05 12:14:44', '2020-09-05 12:14:44'),
(9, 'Outlet', 'Roba pred istek roka', NULL, '2020-10-01 08:56:30', '2020-10-01 08:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `special_options_products`
--

DROP TABLE IF EXISTS `special_options_products`;
CREATE TABLE IF NOT EXISTS `special_options_products` (
  `special_options_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  KEY `special_options_id` (`special_options_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2019-04-16 10:11:55', '2019-04-16 10:11:55'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2019-04-16 10:11:56', '2019-04-16 10:11:56'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2019-04-16 10:11:56', '2019-04-16 10:11:56'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2019-04-16 10:11:56', '2019-04-16 10:11:56'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2019-04-16 10:11:56', '2019-04-16 10:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(10) DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `loy_barcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_country` int(10) DEFAULT NULL,
  `company_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_vat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `last_name`, `discount`, `phone`, `address`, `zip`, `city`, `country`, `email`, `avatar`, `loy_barcode`, `company_name`, `company_address`, `company_zip`, `company_city`, `company_country`, `company_phone`, `company_email`, `company_vat`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'OSM', 'One Stop Marketing', 0, NULL, NULL, NULL, NULL, NULL, 'admin@admin.com', 'users\\July2020\\VDEBlkLOVOCQ3GDiHmxQ.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$xGXY.9P/Qutd6H4aWdlZ0.dEizsYfRf5lukZjXleUoRIn263u2D5K', 'OlSEkK1NHJwMt4BPuob0hztZyWYkHXZ0HrDhuoLqW6zGgsNYglEY0xWCxqnw', NULL, '2019-04-16 10:11:53', '2020-07-30 12:48:46'),
(3, 2, 'Moje', '', 50, '', NULL, NULL, NULL, NULL, 'webmaster@onestopmarketing.rs', 'users/default.png', NULL, 'Neka Moćna Kompanija', 'Na super adresi b.b., 23000 Zrenjanin, Srbija', NULL, NULL, NULL, '0692150512', 'webmaster@onestopmarketing.rs', '123456789000', '$2y$10$Yd5wYKlGiLaeiS3PRdJ7SOxnwhnLEG5CdaEiVmwJeJxzC.arLKQBK', 'd1FRR40bHFY6gK2lJjEdAc8DbOrk0AEmKNctJQwsOtQMDRbuqtbh62Yo6lYp', '{\"locale\":\"en\"}', '2019-05-27 10:30:12', '2020-07-19 08:08:02'),
(4, 2, 'DaKKa 1', 'Imam prezime', 10, '069 215051', 'Koste Trifkovica 6', '23000', 'Zrenjanin', NULL, 'davor.kikindjanin@onestopmarketing.rs', 'users\\July2020\\9LFGG8yDk91kQfmW6G7z.png', NULL, 'DaKKa1', 'Neka Tamo1', '23000', 'Zrenjanin', NULL, '069 2150512', 'davor.kikindjanin@onestopmarketing.rs', '123456789000', '$2y$10$nSkG2KPCI17g9KkZXZplpeIJ0..5aSrxVUvTjVS8gFZyvf99dPvwa', 'ODe5CUwWXu1ZYbyzVuTti5OpxR9PUJxh5aeuSnK0uxnlBhWxv1TP98UufP4K', '{\"locale\":\"en\"}', '2019-09-04 10:02:09', '2020-07-20 14:20:42'),
(10, 2, 'DaKKa2', 'Web', NULL, '654987', 'sadas dasdas', '21000', 'Novi Sad', NULL, 'davor.web.work@gmail.com', 'users/default.png', '005599', 'OSM1', 'NEka adresa', '21000', 'Novi Sad', NULL, '021 555999', 'neki@osmagencija.com', '123456789', '$2y$10$71g8/cOEP61cfNHIYQ3XhOiGrli3e4323qz.syTefeLqFy7bjfZ0y', 'VLiYDlgpLnzrJRWYvsBS2pQ6sSlsEIHp0mtTJ7n8Jbrt0tLTDwJhQqof96pn', NULL, '2020-07-20 14:28:36', '2020-08-03 07:20:29'),
(11, 1, 'MGames', 'Store', NULL, NULL, NULL, NULL, NULL, NULL, 'selezr@live.com', 'users/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$eK0tjnJCAJhHLdB9rv/a8ecRxSItsX87cElHej33F4zcpggroVRZW', 'fVQFKd87ihuPCwjgg0SMM5QX9vW5D0NoIs6mAn136KRtSwNl3CwasWuV08Rm', NULL, '2020-08-03 12:05:03', '2020-08-03 12:05:03'),
(12, 2, 'Milos', 'Trosic', NULL, NULL, 'Gornja Crnisava bb', '37240', 'Trstenik', NULL, 'milostrosic@gmail.com', 'users/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$y8wAKw8s3ZBFo5uEwzhjtOgEi60RnbdsqkdjlNosMEqOJwjqo/iPC', 'TIYVdRaCEIU3bU1fhAofUVEUKVTPxx4AZhTAH0I77Xb7SCT5fDw2ay39afic', NULL, '2020-10-02 06:59:08', '2020-10-02 06:59:08'),
(13, 2, 'Nenad', 'Stankov', 50, '0642340261', NULL, '23101', 'Zrenjanin', NULL, 'nenad.stankov@gomex.rs', 'users/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$gIMYRiGF4STV1mMQUW8Vv.BKbNGWFBuCvmoSR4fSeVI.dnxHI9jcy', 'NsgS46M1cG5LfD1KAfoHDIUPaAcBfwu5YfuD7swgMZKQhoPRXaV6afq9hzrf', NULL, '2020-10-02 11:41:04', '2020-10-02 11:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes_category`
--
ALTER TABLE `attributes_category`
  ADD CONSTRAINT `attribute_id` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attributes_product`
--
ALTER TABLE `attributes_product`
  ADD CONSTRAINT `attribute_p_id` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attribute_value_id` FOREIGN KEY (`attribute_value_id`) REFERENCES `attributes_values` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `product_p_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attributes_values`
--
ALTER TABLE `attributes_values`
  ADD CONSTRAINT `attribute_v_id` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `client_id_ban_fk` FOREIGN KEY (`client_id`) REFERENCES `banners_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_id_ban_fk` FOREIGN KEY (`position_id`) REFERENCES `banners_positions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners_track_impressions`
--
ALTER TABLE `banners_track_impressions`
  ADD CONSTRAINT `banner_id_trck_fk` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_id_trck_fk` FOREIGN KEY (`position_id`) REFERENCES `banners_positions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_shipping`
--
ALTER TABLE `order_shipping`
  ADD CONSTRAINT `order_id_shp_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_shp_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_favourites`
--
ALTER TABLE `products_favourites`
  ADD CONSTRAINT `product_id_fav_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fav_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_fk_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders_items`
--
ALTER TABLE `sliders_items`
  ADD CONSTRAINT `slider_id` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `special_options_products`
--
ALTER TABLE `special_options_products`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `special_options_id` FOREIGN KEY (`special_options_id`) REFERENCES `special_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
