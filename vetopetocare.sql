-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2020 at 05:51 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vetopetocare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', NULL, '$2y$10$XMkx0GpvuuijLtyWrBQ/Zu4X0br7CYu120L/xl8OKs3Rtw6tFHzJq', 1, '2020-09-03 08:54:10', '2020-09-03 08:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `business_hours`
--

CREATE TABLE `business_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `weekDay` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_hours`
--

INSERT INTO `business_hours` (`id`, `weekDay`, `start_time`, `end_time`, `item_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'السبت', '10ص', '8ص', 1, 3, '2020-09-07 21:48:57', '2020-09-07 21:48:57'),
(2, 'السبت', '1م', '2م', 2, 1, '2020-09-09 02:39:44', '2020-09-09 02:39:44'),
(3, 'السبت', '1ص', '12ص', 3, 4, '2020-09-11 18:33:54', '2020-09-11 18:33:54'),
(4, 'السبت', '2ص', '2ص', 4, 1, '2020-09-14 22:34:30', '2020-09-14 22:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userid`, `postid`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'تمام', '2020-09-08 17:04:21', '2020-09-08 17:04:21'),
(2, 12, 3, 'very good', '2020-10-02 23:14:48', '2020-10-02 23:14:48'),
(3, 12, 3, 'comment from api', '2020-10-02 23:24:41', '2020-10-02 23:24:41'),
(4, 12, 4, 'very good', '2020-10-02 23:25:06', '2020-10-02 23:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `country_state_city`
--

CREATE TABLE `country_state_city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country_state_city`
--

INSERT INTO `country_state_city` (`id`, `country`, `state`, `city`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'مصر', 'القاهرة', 'حدائق القبة', 1, 0, '2020-09-03 08:59:37', '2020-09-03 08:59:37'),
(2, 'مصر', 'القاهرة', 'شبرا', 1, 0, '2020-09-03 08:59:59', '2020-09-03 08:59:59'),
(3, 'مصر', 'القاهرة', 'غمرة', 1, 0, '2020-09-03 09:00:27', '2020-09-03 09:00:27'),
(4, 'مصر', 'الجيزة', 'الدقى', 1, 0, '2020-09-03 09:00:48', '2020-09-03 09:00:48'),
(5, 'مصر', 'الجيزة', 'حدائق الحيوان', 1, 0, '2020-09-03 09:01:12', '2020-09-03 09:01:12');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `landline_phone` varchar(255) NOT NULL,
  `yes_or_no` varchar(255) DEFAULT NULL,
  `yes_or_no_two` varchar(255) DEFAULT NULL,
  `home_detection_rate` varchar(255) DEFAULT NULL,
  `regular_check_up_price` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `price_of_the_delivery_service` varchar(255) DEFAULT NULL,
  `offers_services` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `name`, `filename`, `address`, `phone`, `landline_phone`, `yes_or_no`, `yes_or_no_two`, `home_detection_rate`, `regular_check_up_price`, `doctor_name`, `price_of_the_delivery_service`, `offers_services`, `views`, `type`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'harmony vet clinic', '[\"images\\/license\\/8BgveepzJwAKYVd32dUM4atujT8AbdyehYoAEBGy.jpeg\"]', '83 شارع محمد فريد المتفرع من فريد سميكة', '01288019733', '0224846912', 'لا', NULL, NULL, '100', 'سناء', NULL, 'عيادة ممتازة', 6, 2, 3, 1, '2020-09-07 21:48:57', '2020-10-02 22:09:10'),
(3, 'عيادة', '[\"images\\/license\\/fFS5hCMZSEqRPZe3YQLH3zq4HR6onv4hW1CCFdBO.png\"]', 'عيادة', '01270754985', '25479547', 'لا', NULL, NULL, '155', 'محمد', NULL, 'عيادة جيد', 1, 2, 4, 0, '2020-09-11 18:33:54', '2020-09-12 07:34:58'),
(4, 'صيدلية بولا', '[\"images\\/license\\/MMFJrYyczITGLHQHDMlMzSllRZDCgNGaOzsPvrYn.jpeg\"]', '67A, Ahmed Basiouny', '01288019733', '0224846912', NULL, 'لا', NULL, NULL, NULL, NULL, 'نلانانال', 1, 3, 1, 0, '2020-09-14 22:34:30', '2020-10-31 16:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_06_25_112009_create_jobs_table', 1),
(6, '2020_07_13_110553_create_selldogs_table', 1),
(7, '2020_08_11_160406_create_guides_table', 1),
(8, '2020_08_16_132330_create_refusals_table', 1),
(9, '2020_08_18_113045_create_slides_table', 1),
(10, '2020_08_19_112300_create_ratings_table', 1),
(11, '2020_08_19_145411_create_comments_table', 1),
(12, '2020_08_19_145556_create_posts_table', 1),
(13, '2020_08_20_093505_create_country_state_cities_table', 1),
(14, '2020_08_24_190355_create_testimonials_table', 1),
(15, '2020_08_27_125206_create_viewers_table', 1),
(16, '2020_08_28_130525_create_send_sms_phones_table', 1),
(18, '2020_08_31_144422_create_business_hours_table', 1),
(19, '2020_09_03_155223_create_wishlists_table', 2),
(20, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(21, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(22, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(23, '2016_06_01_000004_create_oauth_clients_table', 3),
(24, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(25, '2020_08_30_154026_create_requests_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0e46a8506350a57de5480eb08bd51d08b4141ee5e89b09ec77e02346a63465181459db8aad114d1f', 12, 1, 'MyApp', '[]', 0, '2020-09-29 21:32:13', '2020-09-29 21:32:13', '2021-09-29 14:32:13'),
('10701640ef556f1589ebd03ca45f905ff3ddd364d3ac6b335fd738876a6b93c56556dafb69808b04', 12, 1, 'MyApp', '[]', 0, '2020-10-02 21:32:33', '2020-10-02 21:32:33', '2021-10-02 14:32:33'),
('12f4627bd3f39c9bb2dd7bc19f9f18240973c2b3323cca6c3bbc18c693a7b4dbb0f4d82baab69d4b', 15, 1, 'MyApp', '[]', 0, '2020-10-31 19:33:27', '2020-10-31 19:33:27', '2021-10-31 12:33:27'),
('14eb2927d2abfec67f2bed0fe7193f4d11584634a350dcac07f466b0f5eabf78447225c18756414d', 12, 1, 'MyApp', '[]', 0, '2020-10-04 00:32:42', '2020-10-04 00:32:42', '2021-10-03 17:32:42'),
('18b17a125e39c5459b37f0119894214e7132012b27da84262464d25ac3f129ccb0044ac2ffa88937', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:24:09', '2020-09-06 10:24:09', '2021-09-06 12:24:09'),
('1f008f8ef8c088e3f6c81519caeb4747d6806f7145be137812b44032a08851db76d165db430919be', 13, 1, 'MyApp', '[]', 0, '2020-09-29 18:02:01', '2020-09-29 18:02:01', '2021-09-29 11:02:01'),
('24000d48d71e67fc0d387c5a79ec663c500f4abeccbc917dec6ad212338a2bfa0a41605185494187', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:21:43', '2020-09-28 19:21:43', '2021-09-28 12:21:43'),
('2da34172bc1795852122d3627b511455bceb80fa816883aeb35fed130c3460449b4ac38172b3f559', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:30:39', '2020-09-28 19:30:39', '2021-09-28 12:30:39'),
('2dded0c9fac2c7fb42c2fa7d21c1d40320c1f8388023a20192ab9d9bad74afb515eec76545743fbc', 4, 1, 'MyApp', '[]', 0, '2020-09-28 18:09:36', '2020-09-28 18:09:36', '2021-09-28 11:09:36'),
('2f87540c4a59f28c466a7de181e0791ebaf245c59d0d5d33b52dfed6008aa4594562521651faa077', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:22:37', '2020-09-06 10:22:37', '2021-09-06 12:22:37'),
('344a9255638e8b0baa612390e823ace89331424c6f6b5bc057c10516a081a4907bf7bea9382cb7dc', 1, 1, 'MyApp', '[]', 0, '2020-09-06 11:26:48', '2020-09-06 11:26:48', '2021-09-06 13:26:48'),
('3b5bacf83d0556089bf3ef09121b9af03689fa7359a7e10d560c2b52c41fe58d851085d78571c077', 4, 1, 'MyApp', '[]', 0, '2020-09-28 18:09:24', '2020-09-28 18:09:24', '2021-09-28 11:09:24'),
('3c73a279155b4a4a3aa8d093cacd0912c2a3c4f606cdb5fa6a67e475942214bf353bb1189e463deb', 1, 1, 'MyApp', '[]', 0, '2020-09-06 11:08:51', '2020-09-06 11:08:51', '2021-09-06 13:08:51'),
('43bbafda4006422e7c769907cd16a58424973fe28e588c7316e20cd736de97e89ced70e8464a5a50', 1, 1, 'MyApp', '[]', 0, '2020-09-06 11:56:54', '2020-09-06 11:56:54', '2021-09-06 13:56:54'),
('480c5af659ad791a2a8996e8dc72662b9bbbeb17df45f88010f0654b89b14a3af534737e06c09892', 15, 1, 'MyApp', '[]', 0, '2020-10-31 19:28:22', '2020-10-31 19:28:22', '2021-10-31 12:28:22'),
('4904222bf7d10dbae3ef59bb7f1d9108ca10f0bc0a5731d32614b374934e59e97d9563ebfe097379', 17, 1, 'MyApp', '[]', 0, '2020-10-31 18:30:01', '2020-10-31 18:30:01', '2021-10-31 11:30:01'),
('4a2bc931305d1d3ebfd1710e3dddd13a90a692df259ee2092c30805fbc82898cf504d944979fb5bb', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:34:59', '2020-09-06 10:34:59', '2021-09-06 12:34:59'),
('4b4b229f32b77b1013e21c14070b3c9bf2c79e33f8a3ad73511edeb51f77b6a448139f5e1ed1c5a7', 12, 1, 'MyApp', '[]', 0, '2020-10-02 21:31:39', '2020-10-02 21:31:39', '2021-10-02 14:31:39'),
('5342b6ecd8564520bb9ed9c76bfc487d072656727eaed45742fe520ada450c9b6859a178cea558d1', 23, 1, 'MyApp', '[]', 0, '2020-10-31 19:34:04', '2020-10-31 19:34:04', '2021-10-31 12:34:04'),
('542e04504d456464df85f213c3de59f69f33b59934d0db0df7e8cd0c0ec765676fd41ce84e5ac6af', 11, 1, 'MyApp', '[]', 0, '2020-09-28 23:19:01', '2020-09-28 23:19:01', '2021-09-28 16:19:01'),
('5ac96ddd4f40e4e0b0e547265a25883708940a858c4faf21e96985a5dbd7387a5f5964f9f0c538be', 14, 1, 'MyApp', '[]', 0, '2020-10-06 16:13:44', '2020-10-06 16:13:44', '2021-10-06 09:13:44'),
('5c4ff5d0fb208d2fac19210ae38077ffef126b2ebf68de97833ba3fad9901fe3ac2c49ec1991f664', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:51:01', '2020-09-28 21:51:01', '2021-09-28 14:51:01'),
('650ec8655ca596e71292b78a992eb7edc03096ec9cfd39d9275d7ba2ebfa9bba0e80ea5f2f5ceac6', 12, 1, 'MyApp', '[]', 0, '2020-10-02 21:32:26', '2020-10-02 21:32:26', '2021-10-02 14:32:26'),
('69c3cb024c057835ba02b05b4b4da03cd33833de215130f72868f318342d6ad42bf829836ca8e44c', 12, 1, 'MyApp', '[]', 0, '2020-09-29 19:14:41', '2020-09-29 19:14:41', '2021-09-29 12:14:41'),
('6ad9f83c6ae3f8d861339ecd79af113afb3686a76174b1bcc0a047d09b851996573f1ac653deec5a', 1, 1, 'MyApp', '[]', 0, '2020-09-06 11:01:59', '2020-09-06 11:01:59', '2021-09-06 13:01:59'),
('6d6195a01adcfb6bc24492974c0e5b02b16b7c7d609a8cb99e3f60ab139d297389d67603d921885c', 12, 1, 'MyApp', '[]', 0, '2020-09-28 23:19:57', '2020-09-28 23:19:57', '2021-09-28 16:19:57'),
('6fef88c21b102fb3cc678b6165ad38a4ccc5487dc3aefe2086a74cedd7a002af7a7c9c469d6d2f96', 12, 1, 'MyApp', '[]', 0, '2020-10-02 21:32:42', '2020-10-02 21:32:42', '2021-10-02 14:32:42'),
('76d6e39e8c8a758cf32cc54a7f19b3318b1688fef44fb4e52f0914b292ec1e08389219e34d04fb40', 23, 1, 'MyApp', '[]', 0, '2020-10-31 18:33:07', '2020-10-31 18:33:07', '2021-10-31 11:33:07'),
('772a1112d38372ca4b8eea376157d1eb767e62fae3a781b9fab39a5e5bd5d0db91981f349c7a1607', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:57:19', '2020-09-06 10:57:19', '2021-09-06 12:57:19'),
('7881b34b95b58945706f517f3ebbdaa079c66d268b02763e35f85b9529adc07f0b473a9b3c558b64', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:18:29', '2020-09-28 19:18:29', '2021-09-28 12:18:29'),
('7e1f32e7b7071eb0d64825a52790286cde7d4e6a351f090f84763c75d53f22331c5ebafba40c9732', 23, 1, 'MyApp', '[]', 0, '2020-10-31 19:04:32', '2020-10-31 19:04:32', '2021-10-31 12:04:32'),
('86cc5e5be5c5e930e7bfdfcda5ea3c88827e76df64b8ad02e5bfb38b6e0f0d8b3302b1950f1ae1d1', 12, 1, 'MyApp', '[]', 0, '2020-09-29 18:32:32', '2020-09-29 18:32:32', '2021-09-29 11:32:32'),
('9345697c68dc25bfae5c5d8da78d62c7051e761bd0d6196101301f123e61890c8ab61d39f56181a2', 14, 1, 'MyApp', '[]', 0, '2020-10-06 16:14:38', '2020-10-06 16:14:38', '2021-10-06 09:14:38'),
('94e826e7a07c5446751b565e16f073bf4bcd41fe90bdb6cc0641347e60f620cfb853870714c7f239', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:54:36', '2020-09-28 21:54:36', '2021-09-28 14:54:36'),
('9cfd445738a6ca745d08936069c3a7a8f5a8e5469283c6b1172d9b1d930bae87215e3b8c4829dea0', 14, 1, 'MyApp', '[]', 0, '2020-10-06 16:13:15', '2020-10-06 16:13:15', '2021-10-06 09:13:15'),
('a03f0f7850210503912521adb1cbded71bc6a850f00d1945191352988ef44e2e5017d60136ae5a01', 12, 1, 'MyApp', '[]', 0, '2020-10-04 00:28:48', '2020-10-04 00:28:48', '2021-10-03 17:28:48'),
('a0703f603d6d30b7e8421617f1833751f98571baf564499d461d923857eb0a6a36c01112403b7274', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:36:34', '2020-09-28 21:36:34', '2021-09-28 14:36:34'),
('a54581e2e6aea963fa30102654c6a2524213ae819cc9bb66e8301435f34ea0c5a50374af3a363903', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:17:24', '2020-09-28 19:17:24', '2021-09-28 12:17:24'),
('aae255bdd21e1b3fe907ebd27324099d56fa03814f74b671899c3b9052e13c9a73d00716b06514f0', 1, 1, 'MyApp', '[]', 0, '2020-09-06 11:22:17', '2020-09-06 11:22:17', '2021-09-06 13:22:17'),
('bac5a244ba79b4b3145fc76e13cb11287285fbfde6843cef5d56a8e6d9aaa8c193a375cc38b83f2e', 12, 1, 'MyApp', '[]', 0, '2020-09-29 18:42:41', '2020-09-29 18:42:41', '2021-09-29 11:42:41'),
('c294580357017a6375cfb7121e0aa37a0cb29b2a9ba82d7d81d5e7b327a7fa80bc2efa61df65b75d', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:27:48', '2020-09-06 10:27:48', '2021-09-06 12:27:48'),
('c3321c1e0450288bdf8576add0a72834e8fafc4745111260380a471ca938cb04629a402cebf87119', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:37:26', '2020-09-28 21:37:26', '2021-09-28 14:37:26'),
('c751a08108953686caaf3091cacbdb40ae640280ca9a7dc35676c67964874699520d64055a9fcbd8', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:36:34', '2020-09-28 21:36:34', '2021-09-28 14:36:34'),
('cef46f6bbe669fdcb5d3da6f734fad587311e6f4c79a81545aa6087d9ca32e2e2b999645b255f4bf', 12, 1, 'MyApp', '[]', 0, '2020-10-07 02:19:42', '2020-10-07 02:19:42', '2021-10-06 19:19:42'),
('d3867924e3d3c863b179fd47c0adf96d893a0062481aeef5dd2c2d535717dff9ab2c9e7e98739cbf', 12, 1, 'MyApp', '[]', 0, '2020-10-04 00:30:59', '2020-10-04 00:30:59', '2021-10-03 17:30:59'),
('d941a4022476539f489962904853065eda5b96374b3e0662716818fa9453b7b4771f97c7aa3e0908', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:16:10', '2020-09-28 19:16:10', '2021-09-28 12:16:10'),
('dccd5c425d2993658072650d15a10fc11cb100a26662ea744094e96207e122587293db773f51c63d', 4, 1, 'MyApp', '[]', 0, '2020-09-28 20:35:36', '2020-09-28 20:35:36', '2021-09-28 13:35:36'),
('e1f19e4bcddb596163527b6a6e56341e5951753ae0628434211571393e3600b41087e8453dadef0e', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:29:01', '2020-09-28 19:29:01', '2021-09-28 12:29:01'),
('eff2bf957c6ebdd3001a990ed66ff8e4857796de763131bf7f4ec6e400f2fc4383cb3797bc9c4db6', 1, 1, 'MyApp', '[]', 0, '2020-09-06 10:28:23', '2020-09-06 10:28:23', '2021-09-06 12:28:23'),
('f5b11c543f065b1dcb7110d4ef26607f95b31bcb1d018e2946262fd432a80b067dafac6bb7bd4bf9', 4, 1, 'MyApp', '[]', 0, '2020-09-28 21:50:11', '2020-09-28 21:50:11', '2021-09-28 14:50:11'),
('f80f69c6254ce75d7fb4535b9917e97debf1584cc9d42cc2e6750ea39dafc510ff3b213d433103b5', 12, 1, 'MyApp', '[]', 0, '2020-10-04 00:29:54', '2020-10-04 00:29:54', '2021-10-03 17:29:54'),
('fbc105c4865e9dc23e937556e88d664972527e5fcf0f9a9ede83e547635f9e7c5c6f0816e0008895', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:13:42', '2020-09-28 19:13:42', '2021-09-28 12:13:42'),
('fe1e6fbe201c5a5cac833421005a516f98319bf7d2619489be93c110f98af7f633d2d4ffb76503d8', 12, 1, 'MyApp', '[]', 0, '2020-10-02 21:42:21', '2020-10-02 21:42:21', '2021-10-02 14:42:21'),
('fecd01aa43c66c0f890cef030077561f3554f68fc8d17bd303fb75af704cf99bfd9cf6d807ea8662', 4, 1, 'MyApp', '[]', 0, '2020-09-28 19:17:00', '2020-09-28 19:17:00', '2021-09-28 12:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '6zXqQsdJLnnb1N5sajgPRAIxACq64PGwAPAfXO7v', NULL, 'http://localhost', 1, 0, 0, '2020-09-06 09:58:06', '2020-09-06 09:58:06'),
(2, NULL, 'Laravel Password Grant Client', 'EHYXQbSkXWuoZLdWr5muHfQW74mYzJKugWL6wZ0Q', 'users', 'http://localhost', 0, 1, 0, '2020-09-06 09:58:06', '2020-09-06 09:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-09-06 09:58:06', '2020-09-06 09:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sales@elnourtech.com', '$2y$10$PbEkcOnj/iWjAlRu3rHcT.Ccg..YF0UoNZBWd81ZYhqYO1L.njUHq', '2020-10-06 16:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `typee` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userid`, `itemid`, `typee`, `post`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'guides', 'ممتز', '2020-09-08 16:48:26', '2020-09-08 16:48:26'),
(2, 1, 4, 'dogs', 'جيد', '2020-09-08 17:02:30', '2020-09-08 17:02:30'),
(3, 12, 15, 'dogs', 'good', '2020-10-02 23:08:58', '2020-10-02 23:08:58'),
(4, 12, 15, 'dogs', 'from api', '2020-10-02 23:20:32', '2020-10-02 23:20:32'),
(5, 24, 18, 'dogs', 'جيد', '2020-10-31 20:07:53', '2020-10-31 20:07:53'),
(6, 1, 18, 'dogs', 'جيد جادا', '2020-10-31 20:10:35', '2020-10-31 20:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(255) NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `created_at`, `updated_at`, `rating`, `rateable_type`, `rateable_id`, `user_id`) VALUES
(1, '2020-09-03 15:14:54', '2020-09-03 15:14:54', 4, 'App\\Selldogs', 6, 1),
(2, '2020-09-07 22:55:16', '2020-09-07 22:55:16', 3, 'App\\guide', 1, 1),
(3, '2020-09-08 16:52:54', '2020-09-08 16:52:54', 4, 'App\\Selldogs', 3, 1),
(4, '2020-09-14 14:26:21', '2020-09-14 14:26:21', 3, 'App\\Selldogs', 7, 9),
(5, '2020-10-02 22:37:46', '2020-10-02 22:37:46', 1, 'App\\Selldogs', 15, 12),
(6, '2020-10-02 23:37:34', '2020-10-02 23:37:34', 2, 'App\\guide', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `refusals`
--

CREATE TABLE `refusals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `with_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `one` varchar(255) NOT NULL,
  `two` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `refusals`
--

INSERT INTO `refusals` (`id`, `with_id`, `user_id`, `one`, `two`, `details`, `created_at`, `updated_at`) VALUES
(2, 14, 4, 'طوق كلب', 'مستلزمات', 'تالف', '2020-09-11 17:56:43', '2020-09-11 17:56:43'),
(3, 8, 4, 'تحويل حسابك ألى محل تجارى', '2020-09-12 09:13:43', 'عدم اكتمال البيانات', '2020-09-12 07:26:24', '2020-09-12 07:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `requests_users`
--

CREATE TABLE `requests_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `disclosure_price` varchar(255) DEFAULT NULL,
  `about_you` text,
  `license` varchar(255) DEFAULT NULL,
  `pharmacy_license` varchar(255) DEFAULT NULL,
  `image_of_the_guild_capricorn` varchar(255) DEFAULT NULL,
  `Personal_identification_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `selldogs`
--

CREATE TABLE `selldogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text,
  `color` varchar(255) DEFAULT NULL,
  `strain` varchar(255) DEFAULT NULL,
  `n_strain` varchar(255) DEFAULT NULL,
  `pecial_marque` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `filename` text NOT NULL,
  `notes` text,
  `views` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `selldogs`
--

INSERT INTO `selldogs` (`id`, `type`, `purpose`, `address`, `description`, `color`, `strain`, `n_strain`, `pecial_marque`, `price`, `currency`, `license`, `sex`, `filename`, `notes`, `views`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'كلاب', 'بيع', '67A, Ahmed Basiouny', 'كلاب', 'بنى', 'بيكنواه', 'بيور', 'لا يوجد', '1500 جنية مصرى', 'سنة', 'لا يوجد', 'ذكر', '[\"images\\/license\\/bjiE1lkBF7SSLceLqXfMnJWgoy7UiSsZHGkeXwRl.jpeg\",\"images\\/license\\/la9ECkJOISXBRN7h2ZFr4elwY2nwXwOax6NgVsf8.jpeg\",\"images\\/license\\/2ST7kdreaHspxaPGl93RLF9WRx2lrCOnJiCTonzH.jpeg\"]', '', 1, 1, 0, '2020-09-03 09:59:32', '2020-09-03 18:22:29'),
(2, 'كلاب', 'بيع', 'حلوان', 'بشرط حسن الرعايه و اطمن عليه كل فتره', 'ابيض', 'جيرفون', 'فرنساوى', 'لا يوجد', '400 جنية', 'سنة', 'لا يوجد', 'ذكر', '[\"images\\/license\\/Oc0kVSHM3ELMdLz4rtaQ2dAh1B5gF75bPxIQehqC.jpeg\",\"images\\/license\\/uGUWo8DjFruql5dKMzql9WH9wU9GzDzbxVeWbYnX.jpeg\"]', '', 1, 1, 0, '2020-09-03 10:23:03', '2020-10-31 20:10:08'),
(3, 'قطط', 'تبنى', 'مدينة نصر', 'للتبنى', 'مشمشى', 'شرازى', 'نقى', 'لا يوجد', 'لا يوجد', '4 شهور', 'لا يوجد', 'ذكر', '[\"images\\/license\\/PModEvEOlRVp7D3uoaXWu30dUj8ookrKxjILM9Pr.jpeg\"]', '', 1, 1, 0, '2020-09-03 10:36:08', '2020-09-03 18:22:39'),
(4, 'كلاب', 'تبنى', 'كوبرى القبة', 'جولدن', 'اصفر', 'جولدن', 'جبد', 'مدرب', 'لا يوجد', 'سنة', 'لا يوجد', 'ذكر', '[\"images\\/license\\/Qq9PkVrL8o9yIh3exOwX7NNEyN8QnGzC31dOtsra.jpeg\"]', '', 1, 1, 0, '2020-09-03 10:40:01', '2020-09-03 15:31:02'),
(5, 'كلاب', 'مفقود', 'الاسكندرية', 'شديده الخوف غير وادوده', 'ابيض', 'شيرازى', 'بيور', 'لا يوجد', 'شيرازى', 'سنة', 'لا يوجد', 'أنثى', '[\"images\\/license\\/w0cXe95WjYm1PdZq8pbHfmQjJdRNYZxbKBxAqbyL.jpeg\"]', '', 1, 1, 0, '2020-09-03 10:56:30', '2020-09-03 18:26:20'),
(6, 'كلاب', 'مفقود', 'حدائق القبة', 'صغير لونة ابيض فى بنى فاتح', 'ابيض فى بنى فاتح', 'جاك راسل', 'مية فى المية', 'خط ابيض من اول راسة لى اخرة', 'لا يوجد', 'سنتين و نص', 'لا يوجد', 'ذكر', '[\"images\\/license\\/HgJ0GnxHCSReTC5xgDZvlmOgkr3ZRkCUjmttflkn.jpeg\",\"images\\/license\\/dwnOxaWJ66hFBrs0Fu2UdHBPD9MJIKiiGEGteInw.jpeg\",\"images\\/license\\/ZMea2YCaf60CxHpALXKC1ER6AYKC0JPgMU0jeg1V.jpeg\"]', '', 1, 1, 0, '2020-09-03 11:00:26', '2020-09-03 15:07:18'),
(7, 'كلاب', 'تزاوج', 'مصر و السودان', 'ذكر جيرمن', 'اسود', 'جيرمن', 'ورك لاين', 'ميديم هير', 'لا يوجد', 'سنة', 'لا يوجد', 'ذكر', '[\"images\\/license\\/5nCLLH1NyVLLUjr9g5f2EpqsF1o8KHwkSlIScxp7.jpeg\",\"images\\/license\\/RACjzmkFNgPVQzuMuciTfBdZhNcdXK9H9QwYLvl5.jpeg\"]', '', 3, 1, 0, '2020-09-03 11:07:41', '2020-09-14 14:25:51'),
(8, 'كلاب', 'تزاوج', 'ميدان الحدائق', 'بيتبول', 'بنى مخطط', 'بيتبول بولى', 'بيتبول', 'فهد', 'لا يوجد', 'سنة', 'لا يوجد', 'ذكر', '[\"images\\/license\\/W5IhUbbhTW3ZVqOSNgJpxoO8MGVUsdloyBxOIHwT.jpeg\",\"images\\/license\\/bSR53jlvI6RrDUR2Uo4XxCzeF5GomltpOcyN5eks.jpeg\"]', '', 2, 1, 0, '2020-09-03 11:20:19', '2020-10-17 04:41:08'),
(9, 'كلاب', 'بيع', 'عنوان الكلب', 'جيد', 'ابيض', 'برويي', 'بورى اصلى', 'ابيض اوي', '150 جنية', '2', '46546546', 'أنثى', '[\"images\\/license\\/JwzqWZrOzRFRVgx53WxU81elxUY0in0ktlfvpdQ2.jpeg\"]', NULL, 1, 0, 1, '2020-09-10 20:38:01', '2020-10-31 16:41:22'),
(10, 'قطط', 'تبنى', 'عنوان القطة', 'قطة قطة', 'ابيض جيد', 'قطة بيضة', 'بيشة جدا', 'جيد', '50 جنية', '5', '465654', 'أنثى', '[\"images\\/license\\/ZyVVczC11W7LMX4j6r3ssKftY8gexR0HzuThJalO.jpeg\"]', 'جيد جدا مش متعبة', 2, 0, 1, '2020-09-10 20:39:41', '2020-10-02 21:44:47'),
(11, 'كلاب', 'بيع', 'عنوان الكلب', 'جيد', 'ابيض', 'ابيض جدا كلب', 'ابيض جدا جدا', 'ابيض', '250', '200 جنية', '45467654', 'ذكر', '[\"images\\/license\\/OC0gHFMe0hEhjdZan6LJpxmCxb4ojf1pizfNZy14.jpeg\"]', 'جيد', 2, 1, 0, '2020-09-10 20:45:08', '2020-09-14 14:26:39'),
(12, NULL, 'مستلزمات', 'طوق كلب', NULL, NULL, NULL, NULL, NULL, '150 جنية', NULL, NULL, NULL, '[\"images\\/license\\/yzcfFZI1alPluyH6gKmIjadjAV1APeIBiQ90bMTY.jpeg\"]', 'جيد جدا', 1, 1, 1, '2020-09-11 06:40:44', '2020-09-11 06:43:32'),
(13, NULL, 'مستلزمات', 'طوق كلبة', NULL, NULL, NULL, NULL, NULL, '200', NULL, NULL, NULL, '[\"images\\/license\\/l9e0jSYNKvIpR2U6ptRk5hwTSj58phCMVkD4svbe.jpeg\"]', 'ممتزة', 5, 1, 0, '2020-09-11 08:49:53', '2020-10-02 22:01:15'),
(15, 'كلاب', 'بيع', 'كلب جولدن', 'كلب جولدن', 'جولد', 'جولد اصلي', 'جولد اصلي', 'جولد فاتح', '5000 جنية', '5', '434546546', 'ذكر', '[\"images\\/license\\/F3SSPDAgmXgLO2VLLFEHmRuhcHMiOBM5AvM1CmDS.png\"]', NULL, 5, 1, 4, '2020-09-11 18:15:44', '2020-10-21 23:51:15'),
(16, NULL, 'مستلزمات', 'طوق كلب', NULL, NULL, NULL, NULL, NULL, '500', NULL, NULL, NULL, '[\"images\\/license\\/pI5jAWLQyxi0bc8gSEgOgypGk7u4RV3Y8iOultay.png\"]', 'جيد', 0, 0, 4, '2020-09-11 18:16:27', '2020-09-11 18:16:27'),
(18, NULL, 'مستلزمات', 'مشط كلاب', NULL, NULL, NULL, NULL, NULL, '100', NULL, NULL, NULL, '[\"images\\/license\\/3uDUL7wieWkb4Dl9hscOoVUk1Z0YQc7MJycTUsxI.jpeg\"]', 'ممتزة', 3, 1, 4, '2020-09-11 18:17:59', '2020-10-31 20:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `send_sms_phones`
--

CREATE TABLE `send_sms_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `mass` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `send_sms_phones`
--

INSERT INTO `send_sms_phones` (`id`, `item_id`, `user_id`, `item_type`, `mass`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 'clinic', 'ReservationUser from api', '2020-10-02 23:53:33', '2020-10-02 23:53:33'),
(2, 1, 12, 'clinic', 'from pc', '2020-10-02 23:54:38', '2020-10-02 23:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `headr` varchar(255) NOT NULL,
  `paragraph` varchar(255) NOT NULL,
  `button_name` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `filename`, `headr`, `paragraph`, `button_name`, `button_url`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'images/license/zAC96JWEFtX5GDCNzwwa8MT2fwnZhwNmLAtLDfhv.jpeg', 'علاج الكلاب', 'يمكن تربية الكلاب بشكل أفضل في المنزل من خلال المحافظة على صحتها، عبر عرضها على طبيب بيطري، حيث يستوجب عرض الكلاب وخاصةً الجراء على الطبيب البيطري', NULL, NULL, 1, 0, '2020-09-03 10:26:01', '2020-09-08 20:58:25'),
(2, 'images/license/qc5e4c6pxZlDQWCp23w5HK9WPWSEaDaiVUJWFIFo.jpeg', 'حيوانات أليفة منزليّة', 'وهي الحيوانات التي يتم الاحتفاظ بها داخل المنزل ومنها، القطط، والكلاب، وبعض أنواع الطّيور ومنها الكناري، والببغاء، والقيق، والعقعق، وغيرها.', NULL, NULL, 1, 0, '2020-09-03 10:27:30', '2020-09-08 20:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `paragraph`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ليه الناس فاكره ان الحيوانات الاليفه معندهومش بنكرياس؟ اقوال متضاربه جداً في الموضوع ده و لكن كان من اهمهم ان الحيوانات ممنوع عنها السكريات كلها و الفاكهه و لكن بحذر شديد ومش كلها فالناس ربطت المنع بعدم وجود بنكرياس يفرز الانسولين الي بالتالي يتحكم في الblood glucose concentration.', 1, 0, '2020-09-03 10:29:54', '2020-09-03 10:29:54'),
(2, 'تُعتبر الكلاب إحدى أفضل الحيوانات مهارةً وإخلاصاً في حماية الأشخاص والمُقتنيات الخاصّة، كما أنّها إحدى أقوى سُبُل الحراسة، فوجوده يُشعر صاحبه بالأمان والطمأنينّة.', 1, 0, '2020-09-03 10:30:14', '2020-09-03 10:30:14'),
(3, 'يستطيع الإنسان خلال تربيته للكلاب بتقوية حسّ المسؤوليّة عندهُ، حيث إنّ حسّ المسؤولية لا يمكن بلوغه إلا عند تطبيقه، ولا يُمكن تعلّمه بالقراءة دون المُمارسة.', 1, 0, '2020-09-03 10:30:35', '2020-09-03 10:30:35'),
(4, 'تستطيع الكلاب تحقيق الفائدة للإنسان من خلال بعض الأعمال التي تُساعد، كقتل أو إبعاد الحيوانات والحشرات الضارّة للإنسان مثل الفئران والبقّ.', 1, 0, '2020-09-03 10:30:57', '2020-09-03 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `disclosure_price` varchar(255) DEFAULT NULL,
  `about_you` text,
  `license` varchar(255) DEFAULT NULL,
  `pharmacy_license` varchar(255) DEFAULT NULL,
  `image_of_the_guild_capricorn` varchar(255) DEFAULT NULL,
  `Personal_identification_photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `birth`, `gender`, `country`, `state`, `city`, `address`, `disclosure_price`, `about_you`, `license`, `pharmacy_license`, `image_of_the_guild_capricorn`, `Personal_identification_photo`, `phone`, `email`, `facebook_id`, `google_id`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'pola', '25-09-2020', 'ذكر', 'مصر', 'الجيزة', 'الدقى', NULL, NULL, NULL, '', 'images/license/c4PUL0eIi6YX9HTlPqmscFfdaZfUpSiwlZjYVTyz.jpeg', '', '', '01270754985', 'pola_pola270@yahoo.com', NULL, NULL, NULL, '$2y$10$S1LQzq6m3t.ArSnLDwzzou8eILhl/aMroijhohMSF5TAHJh/rdK..', 1, 'iuZW8ySpDZykLMHuW5EAVaPnGWRWqFy7tziplJehT7t8BzDIoLFWKuIyomZ5', '2020-09-03 09:03:03', '2020-10-06 17:06:46'),
(2, 2, 'doctor', '2020-09-01', 'ذكر', 'مصر', 'القاهرة', 'حدائق القبة', 'nasr city', '200', 'عيادة', 'images/license/lvGK3GCaNmkm9MRJ8tXPHFjWRZAMzRpiovitgtyz.jpeg', '', 'images/license/wnMhjfK4n6dJ3pVdi8liC7RLjeuc2Db5lDUF2YIb.jpeg', 'images/license/lTsWiUvGAVRjSKRvOmpu9nnqkjNgqylwAdBGSCQV.jpeg', '01288019733', 'doctor@doctor.com', NULL, NULL, NULL, '$2y$10$mtmarfx5XEF3VnD.KgfryeTiMBwDnKMXMLAEl7MjTN4iJIRpZoB/e', 1, NULL, '2020-09-03 11:41:48', '2020-09-07 21:46:02'),
(3, 2, 'harmony vet clinic', '20-12-2017', 'ذكر', 'مصر', 'الجيزة', 'الدقى', '83 شارع محمد فريد المتفرع من فريد سميكة', '100', 'عيادة ممتازة', 'images/license/KJs66VocBKr7I2Lftm1AQkmPadxeNXptxu5RXKWr.jpeg', '', 'images/license/fP8UFw7ulFGEMHtDzJ7pc5PIx4e1ITO0JkU2UckZ.jpeg', 'images/license/IkVMgDpP7f7rKp9NV8irRQLEOHgj0sIyX6x7TufK.jpeg', '01288019733', 'polycarpus.adel@gmail.com', NULL, NULL, NULL, '$2y$10$P5KH9URD9ujycPdRXsmj.evU8VtKQm8n94FiLLqrq.UWgPE0zsi8W', 1, NULL, '2020-09-07 21:45:44', '2020-09-07 21:58:09'),
(9, 6, 'Beau Ghinion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'kk_kk1396@yahoo.com', '3418641648178626', NULL, NULL, '', 1, NULL, '2020-09-13 19:56:25', '2020-09-13 20:31:03'),
(12, 1, 'mark', '1992-04-25', 'ذكر', 'مصر', 'القاهرة', 'حدائق القبة', 'العنوان', 'سعر الكشف', 'نبذة عنك', '', '', '', '', '0127075495', 'mark@mark.com', NULL, NULL, NULL, '$2y$10$EHchag9aSoPvsggQtQXtvuCToawc.Xh4wF7AkgGaYvAG6PjJ416Ye', 1, NULL, '2020-09-28 23:19:57', '2020-10-03 17:59:01'),
(13, 1, 'Hairy Cane', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geogatedproject320@gmail.com', '10150001693346548', NULL, NULL, '', 1, NULL, '2020-10-01 07:51:04', '2020-10-01 07:51:04'),
(15, 1, 'scroll meddia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'scroll@elnourtech.com', NULL, '109204699278731772347', NULL, '', 1, NULL, '2020-10-08 04:56:52', '2020-10-08 04:56:52'),
(16, 1, 'sales ElNour', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sales@elnourtech.com', NULL, '100818212481246003488', NULL, '', 1, NULL, '2020-10-08 04:58:50', '2020-10-08 04:58:50'),
(23, 1, 'Mark Code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gygymko@yahoo.com', '3308546565893813', NULL, NULL, '', 1, NULL, '2020-10-31 18:33:06', '2020-10-31 18:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE `viewers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `viewers`
--

INSERT INTO `viewers` (`id`, `item_id`, `user_id`, `item_type`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'dogs', '2020-09-03 14:02:36', '2020-09-03 14:02:36'),
(2, 6, 1, 'dogs', '2020-09-03 15:07:18', '2020-09-03 15:07:18'),
(3, 4, 1, 'dogs', '2020-09-03 15:31:02', '2020-09-03 15:31:02'),
(4, 1, 1, 'dogs', '2020-09-03 18:22:29', '2020-09-03 18:22:29'),
(5, 3, 1, 'dogs', '2020-09-03 18:22:39', '2020-09-03 18:22:39'),
(6, 5, 1, 'dogs', '2020-09-03 18:26:20', '2020-09-03 18:26:20'),
(7, 1, 3, 'guides', '2020-09-07 21:50:43', '2020-09-07 21:50:43'),
(8, 7, 3, 'dogs', '2020-09-07 21:55:28', '2020-09-07 21:55:28'),
(9, 1, 1, 'guides', '2020-09-07 22:00:11', '2020-09-07 22:00:11'),
(10, 7, 1, 'dogs', '2020-09-08 16:55:24', '2020-09-08 16:55:24'),
(11, 11, 1, 'dogs', '2020-09-11 06:18:58', '2020-09-11 06:18:58'),
(12, 12, 1, 'dogs', '2020-09-11 06:43:32', '2020-09-11 06:43:32'),
(13, 13, 1, 'dogs', '2020-09-11 08:51:22', '2020-09-11 08:51:22'),
(14, 10, 1, 'dogs', '2020-09-11 09:02:44', '2020-09-11 09:02:44'),
(15, 1, 4, 'guides', '2020-09-12 07:34:33', '2020-09-12 07:34:33'),
(16, 3, 4, 'guides', '2020-09-12 07:34:58', '2020-09-12 07:34:58'),
(17, 7, 9, 'dogs', '2020-09-14 14:25:51', '2020-09-14 14:25:51'),
(18, 11, 9, 'dogs', '2020-09-14 14:26:39', '2020-09-14 14:26:39'),
(19, 15, 1, 'dogs', '2020-09-17 19:49:26', '2020-09-17 19:49:26'),
(20, 15, 12, 'dogs', '2020-10-02 21:32:06', '2020-10-02 21:32:06'),
(21, 13, 12, 'dogs', '2020-10-02 21:47:28', '2020-10-02 21:47:28'),
(22, 1, 12, 'guides', '2020-10-02 21:57:59', '2020-10-02 21:57:59'),
(23, 13, 0, 'dogs', '2020-10-02 22:01:15', '2020-10-02 22:01:15'),
(24, 15, 0, 'dogs', '2020-10-02 22:01:30', '2020-10-02 22:01:30'),
(25, 1, 0, 'guides', '2020-10-02 22:06:18', '2020-10-02 22:06:18'),
(26, 1, 0, 'guides', '2020-10-02 22:09:10', '2020-10-02 22:09:10'),
(27, 8, 16, 'dogs', '2020-10-17 04:41:08', '2020-10-17 04:41:08'),
(28, 15, 17, 'dogs', '2020-10-21 23:51:15', '2020-10-21 23:51:15'),
(29, 9, 1, 'dogs', '2020-10-31 16:41:22', '2020-10-31 16:41:22'),
(30, 4, 1, 'guides', '2020-10-31 16:41:24', '2020-10-31 16:41:24'),
(31, 2, 1, 'guides', '2020-10-31 16:41:28', '2020-10-31 16:41:28'),
(32, 18, 24, 'dogs', '2020-10-31 20:07:40', '2020-10-31 20:07:40'),
(33, 18, 1, 'dogs', '2020-10-31 20:08:31', '2020-10-31 20:08:31'),
(34, 2, 1, 'dogs', '2020-10-31 20:10:08', '2020-10-31 20:10:08'),
(35, 18, 25, 'dogs', '2020-10-31 20:11:26', '2020-10-31 20:11:26'),
(36, 19, 25, 'dogs', '2020-10-31 20:12:49', '2020-10-31 20:12:49'),
(37, 5, 26, 'guides', '2020-10-31 20:37:09', '2020-10-31 20:37:09'),
(38, 20, 27, 'dogs', '2020-10-31 21:11:54', '2020-10-31 21:11:54'),
(39, 6, 27, 'guides', '2020-10-31 21:28:10', '2020-10-31 21:28:10'),
(40, 6, 1, 'guides', '2020-10-31 21:35:49', '2020-10-31 21:35:49'),
(41, 20, 1, 'dogs', '2020-10-31 21:35:54', '2020-10-31 21:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `item_id`, `user_id`, `item_type`, `created_at`, `updated_at`) VALUES
(10, 6, 1, 'dogs', '2020-09-03 15:29:23', '2020-09-03 15:29:23'),
(34, 3, 2, 'dogs', '2020-09-03 18:22:48', '2020-09-03 18:22:48'),
(36, 5, 1, 'dogs', '2020-09-04 09:42:11', '2020-09-04 09:42:11'),
(37, 15, 1, 'dogs', '2020-10-02 21:29:59', '2020-10-02 21:29:59');

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
-- Indexes for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_state_city`
--
ALTER TABLE `country_state_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  ADD KEY `ratings_rateable_id_index` (`rateable_id`),
  ADD KEY `ratings_rateable_type_index` (`rateable_type`),
  ADD KEY `ratings_user_id_foreign` (`user_id`);

--
-- Indexes for table `refusals`
--
ALTER TABLE `refusals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests_users`
--
ALTER TABLE `requests_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selldogs`
--
ALTER TABLE `selldogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_sms_phones`
--
ALTER TABLE `send_sms_phones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `viewers`
--
ALTER TABLE `viewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_hours`
--
ALTER TABLE `business_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `country_state_city`
--
ALTER TABLE `country_state_city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `refusals`
--
ALTER TABLE `refusals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests_users`
--
ALTER TABLE `requests_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `selldogs`
--
ALTER TABLE `selldogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `send_sms_phones`
--
ALTER TABLE `send_sms_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `viewers`
--
ALTER TABLE `viewers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
