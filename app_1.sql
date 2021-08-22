-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 أغسطس 2021 الساعة 11:03
-- إصدار الخادم: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_1`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `fcm_token`, `email_verified_at`, `password`, `locale`, `avatar_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@demo.com', NULL, '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', 'admin_avatars/1.jpeg', 'pXIEGEowNT', '2021-08-09 05:10:31', '2021-08-09 05:10:31');

-- --------------------------------------------------------

--
-- بنية الجدول `admin_revenues`
--

CREATE TABLE `admin_revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `revenue` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `app_data`
--

CREATE TABLE `app_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_minimum_version` int(11) NOT NULL,
  `support_payments` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `p_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_price` double DEFAULT NULL,
  `p_revenue` double DEFAULT NULL,
  `p_offer` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `title`, `image_url`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Cloth', 'category_images/cloth.png', 'The cloth category includes men’s formals, casuals, youth wear, women’s wear, sportswear, kids wear, footwear, accessories, and more...', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'Grocery', 'category_images/grocery.png', 'grocery is primarily engaged in the retail sale of all sorts of foods and dry goods, such as tea, coffee, spices, sugar, and flour, fresh fruits and vegetables.', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Food', 'category_images/food.png', 'In the Food, category describes all type of item which human eat in daily life at breakfast, lunch, and other time. In this Category also Includes an animal food.', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Cosmetics', 'category_images/cosmetic.png', 'Cosmetics are a category of health and beauty products that are used to care for the face and body, or used to accentuate or change a person\'s appearance.', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'Electronic', 'category_images/electronic.png', 'Electronics In these category sellers sell different types of machines like tv, refrigerator, oven, and some small things like headphones, mobile, device accessories.', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer` int(11) NOT NULL,
  `min_order` double NOT NULL,
  `max_discount` double NOT NULL,
  `for_only_one_time` tinyint(1) NOT NULL DEFAULT 1,
  `for_new_user` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `started_at` date NOT NULL DEFAULT '2021-08-09',
  `expired_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `offer`, `min_order`, `max_discount`, `for_only_one_time`, `for_new_user`, `is_active`, `started_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 'SAVE40', '40% off at any products with product price above $300 and get upto $800 discount', 40, 300, 800, 1, 1, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'GRUB10', 'Buy Product with above $50 and get 10% discount upto $200', 10, 50, 200, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'FLAT25', 'Flat 25% off on any Order with total amount greater than $100', 25, 100, 800, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'GET30', '30% off on any Order above $500 and win discount upto $300', 30, 500, 300, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'SALE50', '50% off at any Order above $800. Buy using code SALE50 and get upto $500 discount', 50, 800, 500, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 'GET20', 'upto 20% off at any Order above $200', 20, 200, 200, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 'SAVE10', '10% off with toal amount $50 and above on any Prduct', 10, 50, 100, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 'FLAT15', 'Get Flat 15% off on your Order $50 and above upto $100 discount', 15, 50, 100, 1, 0, 1, '2021-08-09', '2021-08-11', '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `delivery_boys`
--

CREATE TABLE `delivery_boys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT 1,
  `is_offline` tinyint(1) NOT NULL DEFAULT 0,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `rating` double NOT NULL DEFAULT 0,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `delivery_boys`
--

INSERT INTO `delivery_boys` (`id`, `name`, `email`, `email_verified_at`, `password`, `fcm_token`, `latitude`, `longitude`, `is_free`, `is_offline`, `avatar_url`, `mobile`, `mobile_verified`, `rating`, `total_rating`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Delivery Boy 1', 'delivery.boy@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 37.421104, -122.086951, 1, 0, 'delivery_boy_avatars/1.jpeg', '+918469435337', 1, 0, 0, '0Ni4QH3OSM', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'Delivery Boy 2', 'delivery.boy2@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 37.41901, -122.077957, 1, 0, 'delivery_boy_avatars/2.jpeg', '+918469435336', 1, 0, 0, '1LWv6ZUeo9', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Delivery Boy 3', 'delivery.boy3@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 37.416797, -122.082967, 1, 0, 'delivery_boy_avatars/3.jpg', '+918469435335', 1, 0, 0, 'NJDydIj1aG', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Delivery Boy 4', 'delivery.boy4@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 37.415458, -122.074953, 1, 0, 'delivery_boy_avatars/4.jpg', '+918469435334', 1, 0, 0, 'K41CYMSq8O', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'Delivery Boy 5', 'delivery.boy5@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 37.421617, -122.096288, 1, 0, 'delivery_boy_avatars/5.jpg', NULL, 0, 0, 0, '0QIz5LpjnH', '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `delivery_boy_revenues`
--

CREATE TABLE `delivery_boy_revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_boy_id` bigint(20) UNSIGNED NOT NULL,
  `products_count` int(11) NOT NULL,
  `revenue` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `delivery_boy_reviews`
--

CREATE TABLE `delivery_boy_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_boy_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `managers`
--

CREATE TABLE `managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `managers`
--

INSERT INTO `managers` (`id`, `name`, `email`, `email_verified_at`, `password`, `locale`, `fcm_token`, `avatar_url`, `public_email`, `mobile`, `mobile_verified`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Manager 1', 'manager@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', NULL, 'manager_avatars/1.jpeg', NULL, '+918469435337', 1, NULL, 'nbWFslSYQ2', '2021-08-09 05:10:31', '2021-08-09 05:10:31'),
(2, 'Manager 2', 'manager2@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', NULL, 'manager_avatars/2.jpeg', NULL, '+918469435336', 1, NULL, 'oYCPeUgvCE', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Manager 3', 'manager3@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', NULL, 'manager_avatars/3.jpeg', NULL, '+918469435335', 1, NULL, 'u35tez9fVJ', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Manager 4', 'manager4@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', NULL, 'manager_avatars/4.jpeg', NULL, '+918469435334', 1, NULL, 'VD93Qj6aMs', '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'Manager 5', 'manager5@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'en', NULL, 'manager_avatars/5.jpeg', NULL, NULL, 0, NULL, '0PYa9Lxqd0', '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_09_07_122501_create_categories_table', 1),
(10, '2020_09_07_122502_create_sub_categories_table', 1),
(11, '2020_09_10_044115_create_coupons_table', 1),
(12, '2020_09_10_115517_create_admins_table', 1),
(13, '2020_09_10_143805_create_managers_table', 1),
(14, '2020_09_12_052009_create_shops_table', 1),
(15, '2020_09_12_064152_create_shop_requests_table', 1),
(16, '2020_09_15_041413_create_products_table', 1),
(17, '2020_09_15_061751_create_product_images_table', 1),
(18, '2020_09_16_060256_create_product_items_table', 1),
(19, '2020_09_16_060306_create_product_item_features_table', 1),
(20, '2020_09_18_094300_create_carts_table', 1),
(21, '2020_09_19_044336_create_user_addresses_table', 1),
(22, '2020_09_26_054730_create_order_payments_table', 1),
(23, '2020_09_28_060821_create_orders_table', 1),
(24, '2020_09_30_075821_create_favorites_table', 1),
(25, '2020_10_01_043006_create_delivery_boys_table', 1),
(26, '2020_10_03_061816_create_shop_revenues_table', 1),
(27, '2020_10_04_054547_create_delivery_boy_revenues_table', 1),
(28, '2020_10_17_040643_create_shop_coupons_table', 1),
(29, '2020_10_18_095402_create_user_coupons_table', 1),
(30, '2020_12_28_100528_create_delivery_boy_reviews_table', 1),
(31, '2020_12_28_100600_create_shop_reviews_table', 1),
(32, '2020_12_28_100609_create_product_reviews_table', 1),
(33, '2021_01_10_115716_create_admin_revenues_table', 1),
(34, '2021_01_18_031800_create_transactions_table', 1),
(35, '2021_05_19_045120_create_app_data_table', 1),
(36, '2021_05_28_092257_create_banners_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '01cm1WXdYrY6Ayu6a0uBbaekdIImQjz3Pv5Xd5mv', NULL, 'http://localhost', 1, 0, 0, '2021-08-09 05:10:23', '2021-08-09 05:10:23'),
(2, NULL, 'Laravel Password Grant Client', 'YZsTlBpz1Ar2DWHzcr6aYwibPDMNQVHHoaSCMmaf', 'users', 'http://localhost', 0, 1, 0, '2021-08-09 05:10:23', '2021-08-09 05:10:23');

-- --------------------------------------------------------

--
-- بنية الجدول `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-08-09 05:10:23', '2021-08-09 05:10:23');

-- --------------------------------------------------------

--
-- بنية الجدول `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `order_type` int(11) NOT NULL,
  `order` double NOT NULL,
  `shop_revenue` double NOT NULL,
  `admin_revenue` double NOT NULL,
  `tax` double NOT NULL,
  `delivery_fee` double NOT NULL,
  `total` double NOT NULL,
  `otp` int(11) NOT NULL,
  `coupon_discount` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_boy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `order_payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `order_payments`
--

CREATE TABLE `order_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` int(11) NOT NULL,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `rating` double NOT NULL DEFAULT 0,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  `offer` int(11) NOT NULL DEFAULT 0,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `active`, `rating`, `total_rating`, `offer`, `shop_id`, `sub_category_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'T-shirt Pink', '<ul><li>Care Instructions: Dry Clean Only</li><li>Fit Type: Regular Fit</li><li>Material: Embroidery || Colour: Pink || 100% Cotton (180 GSM, Bio-Washed, Combed, and Pre-Shrunk).</li><li>Awesome, Stylish &amp; Iconic T-shirt for Men. Latest and Trendy designs. Comfortable for all-day use with a soft feel.</li><li> Product Care Guidelines: Wash in normal water, use mild detergent, dry in shade, and turn inside out before drying tumble dry low, do not bleach.</li></ul>', 1, 0, 0, 20, 1, 1, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'T-shirt Blue pattern', '<ul><li>Care Instructions: Machine Wash</li><li>Fit Type: Regular Fit</li><li>Type: Half Sleeve. Fit Type: Regular Fit. It features a comfy fit, incredible appearance, and eye-catching scenario</li><li>Colour and fabric: multi-colored soft and comfy pique fabric which is unique mingle of 100% Micro Polyester Dry Fit. its Dry Fit fabric is ultra-soft, breathable, and lightweight</li><li>This Regular Fit Round Neck t-shirt is ideal for all seasons and accurate to wear anywhere such as in the workplace, classroom, tennis or basketball court</li><li>Care guide: Fully Machine or Hand Wash and Wash in Hot/Coldwater as you wish</li></ul>', 1, 0, 0, 0, 1, 1, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Relaxed Jeans Jacket', '<ul><li>Care Instructions: machine wash</li><li>Fit Type: Slim Fit</li><li>Style: A stylish denim jacket that has a waist length. It features two pockets on the chest area.</li><li>Closure: Fits true to size. It\'s a slim fit jacket. This jacket has a button at the front and on the sleeves.</li><li>wash care: Wash this jacket with a mild detergent, tumble dry, or dry in shade. Do not bleach. Treat with fabric conditioners to maintain freshness.</li><li>Fabric and Styling: Denim made from twill cotton yarn. This jacket will go well with jeans in a lighter shade and a flannel shirt or a t-shirt.</li></ul><div><br></div>', 1, 0, 0, 15, 1, 1, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Quaker Oats', '<ul><li>This is a Vegetarian product.</li><li>Get great savings and a great taste with Quaker oats mega saver pack and get 500g free with a 1.5kg pack of Quaker oats</li><li>Quaker oats are made from 100 percent whole grain oats, which is a natural source of carbohydrates, protein, and dietary fiber</li><li>Garnish your wholesome bowl of oats with your favourite fruits and nuts to make it more delicious</li><li>Helps reduce the risk of high blood pressure and cholesterol</li><li>Helps maintain weight</li></ul>', 1, 0, 0, 10, 2, 2, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'Almonds Chocolate', '<ul><li>Weight: 200 grams</li><li>Shelf life: 9 months</li><li>Hand-sorted cocoa beans used; Customized to perfection</li><li>Package contents: Roasted 2 almond chocolate bar</li><li>Storage Instructions: Keep in a cool and dry place</li><li>Speciality: Roasted almond in chocolates bar</li></ul>', 1, 0, 0, 0, 2, 2, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 'Honey', '<ul><li>One tablespoon of honey with warm water daily morning will help you in managing weight and reducing one size in 90days (clinically tested)</li><li>Honey is rich in antioxidants and hence will help in strengthening your immunity</li><li>Daily use of Dabur Honey with warm water in morning is proved to be good for heart health</li><li>It is a rich souce of nutrition for you and your family</li><li>It when mixed with ginger and other household ingredients is a great remedy for cough &amp; cold</li><li>Daily intake of Honey will help boost your energy and keep you active,Product cap color may vary</li></ul>', 1, 0, 0, 25, 2, 2, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 'Peanut Butter', '<ul><li>Unsweetened | Made With Only Roasted Peanuts (100%) | No Added Sugar | No Added Salt | No Hydrogenated Oils | 100% Non-GMO | Gluten-Free | Vegan</li><li>25% Protein Per Serving Of 32 G| Rich Source Of Fibre | No Trans Fat | No Cholesterol</li><li>Good Source Of Vitamins E, B3 &amp; B6 | Rich In Minerals: Iron, Magnesium, Phosphorous, And Potassium</li><li>Oil Separation Is Natural Process, Stir Well Before Use Together With The Confidence Of Knowing Your Peanut Contains No Stabilizers Or Fillers.</li></ul>', 1, 0, 0, 0, 3, 3, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 'Dry Dog Food', '<ul><li>Complete and balanced food with the goodness of Egg for adult dogs</li><li>Contains 22% crude protein, 10% crude fat, and 5% crude Fibre</li><li>Provides strong muscles, bones &amp; teeth, and healthier &amp; shinier coat</li><li>Also promotes Digestive Health and supports Natural Defences</li><li>Ideal for Pugs, Beagle to Labrador, Golden Retriever &amp; German shepherd</li></ul>', 1, 0, 0, 10, 3, 3, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(9, 'Herble Tea', '<ul><li>Traditional Recipe&nbsp; – Uses the natural ayurvedic ingredients to boost immunity in both men and women</li><li>AMLA - GILOY – TULSI – ASHWAGANDHA – Combines the most potent naturals ingredients with NO Preservatives and NO Added Sugar.</li><li>Delicious Herbal Tea - The most soothing hot beverage to boost your immunity. Mild earthy flavor (not bitter) will be a hit with your friends a family.</li><li>How To Prepare – 1. Bring Water to Boil then wait for 30 seconds, 2. Add a Tea Spoon or Immunity Tea Leaves to water and let it steep for 3-4 minutes, 3. Filter water through the leaves and drink it hot.</li></ul>', 1, 0, 0, 10, 3, 3, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(10, 'Eyeshadow Palette', '<ul><li>The excellent and immediate payoff with a single stroke &amp; Easily blendable eyeshadow kit.</li><li>Double coating eyeshadow makeup technology used to optimize the impact</li><li>This eyeshadow palette is meant for both, wet and dry use &amp; Foil formulas are also talc-free</li><li>Best eyeshadow palette which is free from parabens, oils, mineral oils, D5 and nano-ingredients</li><li>There might be minor colour variation between the actual product and image shown on screen due to lighting on the photography.</li></ul>', 1, 0, 0, 5, 4, 4, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(11, 'Matte Lipstick', '<ul><li>Superstay Matte Ink Liquid Lipstick leaves your lips with a flawless matte finish that will last for up to 16 hours</li><li>The lipstick features a unique arrow applicator for a more precise liquid lipstick application</li><li>Intensely Pigmented formula Long-Lasting and doesn\'t dry out lips</li><li>It is available in over 25+ super-saturated shades</li></ul>', 1, 0, 0, 0, 4, 4, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(12, 'Vanilla Fair Cream', '<ul><li>The skin would look fair and beautifully white.</li><li>Makes the skin smooth and gentle and gives a younger look.</li><li>Lightens and whitens the skin.</li><li>Regenerate skin cells.</li><li>Protects from inflammation and irritation happens to the skin.</li></ul>', 1, 0, 0, 10, 4, 4, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(13, 'Fully-Automatic Washing Machine', '<ul><li>Fully-automatic front-loading washing machine; 8.5 kg</li><li>14 wash programs; Spin Speed Options (RPM): 1400; Power Supply220-240V, Single Phase, 50 HZ; Water Supply0.3 Bar to 10 Bar; Temperature Options: Mild</li><li>Warranty: 4 years of comprehensive warranty</li><li>Aqua Energie: Water is energized by this built-in device, the filter treatment dissolves detergent better to give clothes a softer wash</li><li>9 swirl wave</li><li>Door glass shower</li></ul>', 1, 0, 0, 30, 5, 5, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(14, 'Wireless Headphone', '<ul><li>Superior listening experience with Pure Bass sound</li><li>Wireless Bluetooth Streaming</li><li>11 hours of playtime under optimum audio settings</li><li>Call and music controls on earcup</li><li>Flat-foldable, lightweight, and comfortable</li><li>1 year manufacturer’s warranty</li></ul>', 1, 0, 0, 0, 5, 5, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(15, 'Microwave Oven', '<ul><li>28L: Suitable for large families</li><li>Convection: Can be used for baking along with grilling, reheating, defrosting, and cooking</li><li>Slimfry technology: Enjoy healthier fried food without the deep fryer. Turntable Size: 318 mm</li><li>Warranty: 1 Year on Product &amp; 5 Years on Magnetron &amp; 10 years on Ceramic Cavity</li><li>Control: Touch Key Pad (Membrane) is sensitive to touch and easy to clean</li><li>Child Lock: Ensures complete safety especially for homes with small children</li></ul>', 1, 0, 0, 20, 5, 5, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `product_images`
--

INSERT INTO `product_images` (`id`, `url`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'product_images/1.png', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'product_images/2.png', 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'product_images/3.png', 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'product_images/4.png', 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'product_images/5.png', 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 'product_images/6.png', 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 'product_images/7.png', 7, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 'product_images/8.png', 8, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(9, 'product_images/9.png', 9, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(10, 'product_images/10.png', 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(11, 'product_images/11.png', 11, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(12, 'product_images/12.png', 12, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(13, 'product_images/13.png', 13, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(14, 'product_images/14.png', 14, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(15, 'product_images/15.png', 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `product_items`
--

CREATE TABLE `product_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `product_items`
--

INSERT INTO `product_items` (`id`, `product_id`, `price`, `quantity`, `revenue`, `created_at`, `updated_at`) VALUES
(1, 1, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 2, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 3, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 4, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 5, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 6, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 7, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 8, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(9, 9, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(10, 10, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(11, 11, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(12, 12, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(13, 13, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(14, 14, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(15, 15, 100, 10, 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(16, 1, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(17, 2, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(18, 3, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(19, 4, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(20, 5, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(21, 6, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(22, 7, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(23, 8, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(24, 9, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(25, 10, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(26, 11, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(27, 12, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(28, 13, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(29, 14, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(30, 15, 80, 8, 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `product_item_features`
--

CREATE TABLE `product_item_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `product_item_features`
--

INSERT INTO `product_item_features` (`id`, `feature`, `value`, `product_item_id`, `created_at`, `updated_at`) VALUES
(1, 'Color', '#ff0000', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'Size', 'XL', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Gram', '101', 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Color', '#ff0000', 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'Size', 'XL', 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 'Gram', '241', 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 'Color', '#ff0000', 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 'Size', 'XL', 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(9, 'Gram', '501', 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(10, 'Color', '#ff0000', 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(11, 'Size', 'XL', 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(12, 'Gram', '161', 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(13, 'Color', '#ff0000', 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(14, 'Size', 'XL', 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(15, 'Gram', '159', 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(16, 'Color', '#ff0000', 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(17, 'Size', 'XL', 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(18, 'Gram', '247', 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(19, 'Color', '#ff0000', 7, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(20, 'Size', 'XL', 7, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(21, 'Gram', '685', 7, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(22, 'Color', '#ff0000', 8, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(23, 'Size', 'XL', 8, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(24, 'Gram', '541', 8, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(25, 'Color', '#ff0000', 9, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(26, 'Size', 'XL', 9, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(27, 'Gram', '371', 9, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(28, 'Color', '#ff0000', 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(29, 'Size', 'XL', 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(30, 'Gram', '620', 10, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(31, 'Color', '#ff0000', 11, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(32, 'Size', 'XL', 11, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(33, 'Gram', '184', 11, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(34, 'Color', '#ff0000', 12, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(35, 'Size', 'XL', 12, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(36, 'Gram', '387', 12, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(37, 'Color', '#ff0000', 13, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(38, 'Size', 'XL', 13, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(39, 'Gram', '634', 13, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(40, 'Color', '#ff0000', 14, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(41, 'Size', 'XL', 14, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(42, 'Gram', '647', 14, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(43, 'Color', '#ff0000', 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(44, 'Size', 'XL', 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(45, 'Gram', '229', 15, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(46, 'Color', '#3300ff', 16, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(47, 'Size', 'L', 16, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(48, 'Gram', '960', 16, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(49, 'Color', '#3300ff', 17, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(50, 'Size', 'L', 17, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(51, 'Gram', '464', 17, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(52, 'Color', '#3300ff', 18, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(53, 'Size', 'L', 18, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(54, 'Gram', '733', 18, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(55, 'Color', '#3300ff', 19, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(56, 'Size', 'L', 19, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(57, 'Gram', '945', 19, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(58, 'Color', '#3300ff', 20, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(59, 'Size', 'L', 20, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(60, 'Gram', '982', 20, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(61, 'Color', '#3300ff', 21, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(62, 'Size', 'L', 21, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(63, 'Gram', '638', 21, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(64, 'Color', '#3300ff', 22, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(65, 'Size', 'L', 22, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(66, 'Gram', '864', 22, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(67, 'Color', '#3300ff', 23, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(68, 'Size', 'L', 23, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(69, 'Gram', '617', 23, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(70, 'Color', '#3300ff', 24, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(71, 'Size', 'L', 24, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(72, 'Gram', '896', 24, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(73, 'Color', '#3300ff', 25, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(74, 'Size', 'L', 25, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(75, 'Gram', '593', 25, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(76, 'Color', '#3300ff', 26, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(77, 'Size', 'L', 26, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(78, 'Gram', '623', 26, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(79, 'Color', '#3300ff', 27, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(80, 'Size', 'L', 27, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(81, 'Gram', '630', 27, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(82, 'Color', '#3300ff', 28, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(83, 'Size', 'L', 28, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(84, 'Gram', '812', 28, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(85, 'Color', '#3300ff', 29, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(86, 'Size', 'L', 29, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(87, 'Gram', '584', 29, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(88, 'Color', '#3300ff', 30, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(89, 'Size', 'L', 30, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(90, 'Gram', '496', 30, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `delivery_range` int(11) NOT NULL,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  `default_tax` int(11) NOT NULL DEFAULT 0,
  `admin_commission` int(11) NOT NULL DEFAULT 0,
  `available_for_delivery` tinyint(1) NOT NULL DEFAULT 0,
  `open` tinyint(1) NOT NULL DEFAULT 0,
  `minimum_delivery_charge` double NOT NULL DEFAULT 0,
  `delivery_cost_multiplier` double NOT NULL DEFAULT 0,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `shops`
--

INSERT INTO `shops` (`id`, `name`, `description`, `email`, `mobile`, `latitude`, `longitude`, `address`, `image_url`, `rating`, `delivery_range`, `total_rating`, `default_tax`, `admin_commission`, `available_for_delivery`, `open`, `minimum_delivery_charge`, `delivery_cost_multiplier`, `manager_id`, `created_at`, `updated_at`) VALUES
(1, 'Fashion Factory', '<p>Fashion Factory is committed to providing each customer with the highest standard of customer service.</p><ul><li>Monday - Sunday( 9am - 10pm )</li></ul>', 'shop@demo.com', '789654123', 37.4235492, -122.0924447, 'Garcia Ave, Mountain View', 'shop_images/1.jpg', 0, 99999999, 0, 10, 15, 1, 1, 9, 3, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'The Corner Store', '<p>The Corner Store only sells quality products. You\'ll find brand-name groceries and produce at up to 40-70% off conventional retail prices.</p><ul><li>Monday - Saturday ( 7:00am - 9:00pm )</li><li>Sunday ( 7:00am - 1:00pm )</li></ul><p>&nbsp; The Corner Store&nbsp;providing fresh grocery delivery on the same day</p><p><br></p>', 'shop2@demo.com', '147852369', 37.4258241, -122.0810562, 'Bill Graham Pkwy, Mountain View', 'shop_images/2.jpg', 0, 99999999, 0, 15, 15, 1, 1, 9, 3, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Healthy Treats', '<div>The Fastest Growing Food Chain with so many outlets across the mountain view. Purity is our Priority!</div><ul><li>Monday - Sunday ( 10:00am - 11:30pm )</li></ul><div>we provide Home made delicacies food. we also take Corporate lunch orders and Party/Event Orders.</div><p><br></p>', 'shop3@demo.com', '369589147', 37.4219616, -122.067714, 'Lomax Ln, Google Bay', 'shop_images/3.jpg', 0, 99999999, 0, 15, 15, 1, 1, 9, 3, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'Blossom Beauty', '<div>Dive into the world of Blossom Beauty that\'s high on style &amp; higher on performance. We provide High-quality Cosmetics at the lowest price with 100% Satisfaction.&nbsp;</div><ul><li>Monday - Saturday ( 5:00am - 8:00pm)</li><li>Sunday ( Closed )</li></ul>', 'shop4@demo.com', '1596284536', 37.423493, -122.077813, '454 N Shoreline Blvd, Mountain View', 'shop_images/4.jpg', 0, 99999999, 0, 20, 15, 1, 1, 9, 3, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'E-Store', '<div><div>We Deal With All Electrical Equipment And services. Get all Electrical Equipment at the best price.</div></div><ul><li>Monday - Saturday ( 8:00am - 8:00pm )</li></ul><p>Multi-brand electrical products &amp; hardware at a very competitive price. We Have a good collection of common electrical and hardware items</p>', 'shop5@demo.com', '8564251689', 37.417635, -122.077707, 'Google Building, Mountain View', 'shop_images/5.jpg', 0, 99999999, 0, 8, 15, 1, 1, 9, 3, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `shop_coupons`
--

CREATE TABLE `shop_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `shop_coupons`
--

INSERT INTO `shop_coupons` (`id`, `shop_id`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 1, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 1, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 1, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 2, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(6, 2, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(7, 2, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(8, 3, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(9, 3, 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(10, 4, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(11, 4, 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(12, 5, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(13, 5, 6, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(14, 5, 7, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(15, 5, 8, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `shop_requests`
--

CREATE TABLE `shop_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `shop_revenues`
--

CREATE TABLE `shop_revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `products_count` int(11) NOT NULL,
  `revenue` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `shop_reviews`
--

CREATE TABLE `shop_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `title`, `description`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'T-Shirts', NULL, 1, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, 'Oils', NULL, 2, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, 'Fruit', NULL, 3, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, 'makeup', NULL, 4, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, 'television', NULL, 5, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_payment_id` bigint(20) UNSIGNED NOT NULL,
  `captured` tinyint(1) NOT NULL DEFAULT 0,
  `refunded` tinyint(1) NOT NULL DEFAULT 0,
  `success` tinyint(1) NOT NULL DEFAULT 1,
  `admin_revenue` double NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_boy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_to_shop` double NOT NULL DEFAULT 0,
  `admin_to_delivery_boy` double NOT NULL DEFAULT 0,
  `shop_to_admin` double NOT NULL DEFAULT 0,
  `delivery_boy_to_admin` double NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `mobile_verified`, `fcm_token`, `locale`, `avatar_url`, `blocked`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User 1', 'user@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+918469435337', 1, NULL, 'en', 'user_avatars/1.jpeg', 0, 'dfakgfNgFs', '2021-08-09 05:10:31', '2021-08-09 05:10:31'),
(2, 'User 2', 'user2@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+918469435336', 1, NULL, 'en', 'user_avatars/2.jpeg', 0, '2sq16PtRk3', '2021-08-09 05:10:31', '2021-08-09 05:10:31'),
(3, 'User 3', 'user3@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+918469435335', 1, NULL, 'en', 'user_avatars/3.jpeg', 0, '4aR8JVRnN4', '2021-08-09 05:10:31', '2021-08-09 05:10:31'),
(4, 'User 4', 'user4@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+918469435334', 1, NULL, 'en', 'user_avatars/4.jpeg', 0, 'z6Nu6UMLyw', '2021-08-09 05:10:31', '2021-08-09 05:10:31'),
(5, 'User 5', 'user5@demo.com', '2021-08-09 05:10:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 0, NULL, 'en', 'user_avatars/5.jpeg', 0, 'AyzKcdJEEZ', '2021-08-09 05:10:31', '2021-08-09 05:10:31');

-- --------------------------------------------------------

--
-- بنية الجدول `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `pincode` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `type` int(11) NOT NULL DEFAULT 2,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `longitude`, `latitude`, `address`, `address2`, `city`, `default`, `pincode`, `active`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '-122.0708620', '37.4218855', 'A to Z Tree Nursery', NULL, 'Google Bay', 0, 456789, 1, 2, 1, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(2, '-122.0804247', '37.4203822', 'UPS Drop box', NULL, 'Charleston', 0, 369852, 1, 2, 2, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(3, '-122.0894410', '37.4225616', 'Alza Vollyball Court', NULL, 'Googleplex', 0, 147852, 1, 2, 3, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(4, '-122.1013350', '37.4223300', 'San Antonio Rd', NULL, ' Palo Alto', 0, 452033, 1, 2, 4, '2021-08-09 05:10:32', '2021-08-09 05:10:32'),
(5, '-122.0926750', '37.4161310', 'Rengstorff Ave', NULL, 'Mountain View', 0, 240431, 1, 2, 5, '2021-08-09 05:10:32', '2021-08-09 05:10:32');

-- --------------------------------------------------------

--
-- بنية الجدول `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_revenues`
--
ALTER TABLE `admin_revenues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_revenues_order_id_unique` (`order_id`),
  ADD KEY `admin_revenues_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `app_data`
--
ALTER TABLE `app_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_product_item_id_foreign` (`product_item_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_title_unique` (`title`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_boys_email_unique` (`email`);

--
-- Indexes for table `delivery_boy_revenues`
--
ALTER TABLE `delivery_boy_revenues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_boy_revenues_order_id_unique` (`order_id`),
  ADD KEY `delivery_boy_revenues_delivery_boy_id_foreign` (`delivery_boy_id`),
  ADD KEY `delivery_boy_revenues_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `delivery_boy_reviews`
--
ALTER TABLE `delivery_boy_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_boy_reviews_order_id_unique` (`order_id`),
  ADD KEY `delivery_boy_reviews_user_id_foreign` (`user_id`),
  ADD KEY `delivery_boy_reviews_delivery_boy_id_foreign` (`delivery_boy_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `managers_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_order_payment_id_foreign` (`order_payment_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`),
  ADD KEY `orders_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_item_features`
--
ALTER TABLE `product_item_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_item_features_product_item_id_foreign` (`product_item_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_reviews_order_id_product_item_id_unique` (`order_id`,`product_item_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_product_item_id_foreign` (`product_item_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shops_email_unique` (`email`),
  ADD UNIQUE KEY `shops_mobile_unique` (`mobile`),
  ADD KEY `shops_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `shop_coupons`
--
ALTER TABLE `shop_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_coupons_shop_id_coupon_id_unique` (`shop_id`,`coupon_id`),
  ADD KEY `shop_coupons_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `shop_requests`
--
ALTER TABLE `shop_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_requests_shop_id_manager_id_unique` (`shop_id`,`manager_id`),
  ADD UNIQUE KEY `shop_requests_manager_id_unique` (`manager_id`);

--
-- Indexes for table `shop_revenues`
--
ALTER TABLE `shop_revenues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_revenues_order_id_unique` (`order_id`),
  ADD KEY `shop_revenues_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shop_reviews`
--
ALTER TABLE `shop_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_reviews_user_id_shop_id_unique` (`user_id`,`shop_id`),
  ADD KEY `shop_reviews_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_title_unique` (`title`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_order_payment_id_foreign` (`order_payment_id`),
  ADD KEY `transactions_shop_id_foreign` (`shop_id`),
  ADD KEY `transactions_delivery_boy_id_foreign` (`delivery_boy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_coupons_user_id_foreign` (`user_id`),
  ADD KEY `user_coupons_coupon_id_foreign` (`coupon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_revenues`
--
ALTER TABLE `admin_revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_data`
--
ALTER TABLE `app_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_boy_revenues`
--
ALTER TABLE `delivery_boy_revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_boy_reviews`
--
ALTER TABLE `delivery_boy_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_item_features`
--
ALTER TABLE `product_item_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_coupons`
--
ALTER TABLE `shop_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_requests`
--
ALTER TABLE `shop_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_revenues`
--
ALTER TABLE `shop_revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_reviews`
--
ALTER TABLE `shop_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `admin_revenues`
--
ALTER TABLE `admin_revenues`
  ADD CONSTRAINT `admin_revenues_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `admin_revenues_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`),
  ADD CONSTRAINT `carts_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `delivery_boy_revenues`
--
ALTER TABLE `delivery_boy_revenues`
  ADD CONSTRAINT `delivery_boy_revenues_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`),
  ADD CONSTRAINT `delivery_boy_revenues_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `delivery_boy_revenues_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `delivery_boy_reviews`
--
ALTER TABLE `delivery_boy_reviews`
  ADD CONSTRAINT `delivery_boy_reviews_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`),
  ADD CONSTRAINT `delivery_boy_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `delivery_boy_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `user_addresses` (`id`),
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `orders_order_payment_id_foreign` FOREIGN KEY (`order_payment_id`) REFERENCES `order_payments` (`id`),
  ADD CONSTRAINT `orders_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- القيود للجدول `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- القيود للجدول `product_items`
--
ALTER TABLE `product_items`
  ADD CONSTRAINT `product_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- القيود للجدول `product_item_features`
--
ALTER TABLE `product_item_features`
  ADD CONSTRAINT `product_item_features_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`);

--
-- القيود للجدول `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_product_item_id_foreign` FOREIGN KEY (`product_item_id`) REFERENCES `product_items` (`id`),
  ADD CONSTRAINT `product_reviews_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`id`);

--
-- القيود للجدول `shop_coupons`
--
ALTER TABLE `shop_coupons`
  ADD CONSTRAINT `shop_coupons_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `shop_coupons_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `shop_requests`
--
ALTER TABLE `shop_requests`
  ADD CONSTRAINT `shop_requests_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`id`),
  ADD CONSTRAINT `shop_requests_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `shop_revenues`
--
ALTER TABLE `shop_revenues`
  ADD CONSTRAINT `shop_revenues_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `shop_revenues_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `shop_reviews`
--
ALTER TABLE `shop_reviews`
  ADD CONSTRAINT `shop_reviews_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `shop_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- القيود للجدول `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_delivery_boy_id_foreign` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boys` (`id`),
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `transactions_order_payment_id_foreign` FOREIGN KEY (`order_payment_id`) REFERENCES `order_payments` (`id`),
  ADD CONSTRAINT `transactions_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- القيود للجدول `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD CONSTRAINT `user_coupons_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `user_coupons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
