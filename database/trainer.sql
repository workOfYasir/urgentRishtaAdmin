-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 12:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainer`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_workouts`
--

CREATE TABLE `assign_workouts` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_workouts`
--

INSERT INTO `assign_workouts` (`id`, `plan_id`, `week_id`, `client_id`, `is_delete`, `start_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, NULL, '2022-05-24', '2022-05-24 03:08:07', '2022-05-24 03:08:07'),
(2, 2, 1, 3, NULL, '2022-05-24', '2022-05-24 03:08:20', '2022-05-24 03:08:20'),
(3, 2, 1, 3, NULL, '2022-05-24', '2022-05-24 03:08:56', '2022-05-24 03:08:56'),
(4, 2, 1, 4, NULL, '2022-05-24', '2022-05-24 03:08:56', '2022-05-24 03:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `type`, `video`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'abs', 'cardio', 'google.com', 'ok', '2022-05-14 06:40:18', '2022-05-14 06:40:18'),
(2, 'shoulder', 'cardio', 'google.com', 'ok', '2022-05-14 07:03:05', '2022-05-14 07:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `setting` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `setting`, `created_at`, `updated_at`) VALUES
(1, 'test', 1, '2022-05-22 07:39:04', '2022-05-22 07:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 3, NULL, NULL),
(3, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `meal_name` varchar(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `meal_recipe` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `meal_name`, `calories`, `meal_recipe`, `notes`, `created_at`, `updated_at`) VALUES
(3, 'eggs', 1200, 'google.com', 'ok', '2022-05-19 07:28:52', '2022-05-19 07:28:52'),
(4, 'Sandwich', 1200, 'google.com', 'ok', '2022-05-19 07:29:11', '2022-05-19 07:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_07_12_145959_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 3),
(3, 'App\\User', 2),
(3, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_plans`
--

CREATE TABLE `nutrition_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition_plans`
--

INSERT INTO `nutrition_plans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Shredding', '2022-05-14 20:32:47', '2022-05-14 20:32:47'),
(2, 'abs', '2022-05-18 08:47:13', '2022-05-18 08:47:13'),
(3, 'abs', '2022-05-18 08:52:59', '2022-05-18 08:52:59'),
(4, 'abs', '2022-05-18 08:54:20', '2022-05-18 08:54:20'),
(5, 'abs', '2022-05-18 08:57:26', '2022-05-18 08:57:26'),
(6, 'abs', '2022-05-18 08:58:39', '2022-05-18 08:58:39'),
(7, 'abs', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(8, 'abs', '2022-05-19 04:46:57', '2022-05-19 04:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_plan_meals`
--

CREATE TABLE `nutrition_plan_meals` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition_plan_meals`
--

INSERT INTO `nutrition_plan_meals` (`id`, `type_id`, `meal_id`, `created_at`, `updated_at`) VALUES
(41, 22, 3, '2022-05-19 13:40:34', '2022-05-19 13:40:34'),
(42, 22, 4, '2022-05-19 13:40:34', '2022-05-19 13:40:34'),
(43, 24, 3, '2022-05-21 08:35:56', '2022-05-21 08:35:56'),
(44, 24, 4, '2022-05-21 08:35:56', '2022-05-21 08:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_plan_meal_types`
--

CREATE TABLE `nutrition_plan_meal_types` (
  `id` int(11) NOT NULL,
  `weekly_plan_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutrition_plan_meal_types`
--

INSERT INTO `nutrition_plan_meal_types` (`id`, `weekly_plan_id`, `name`, `time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Breakfast', NULL, '2022-05-14 20:34:32', '2022-05-14 20:34:32'),
(2, 2, 'Brunch', NULL, '2022-05-14 21:18:58', '2022-05-14 21:18:58'),
(4, 3, 'Snaks', '2022-05-14 07:30:13', '2022-05-18 15:34:57', '2022-05-18 15:34:57'),
(5, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-18 15:36:45', '2022-05-18 15:36:45'),
(6, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-18 15:37:21', '2022-05-18 15:37:21'),
(8, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-18 15:44:25', '2022-05-18 15:44:25'),
(9, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-18 15:44:57', '2022-05-18 15:44:57'),
(10, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:12:41', '2022-05-19 07:12:41'),
(11, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:18:20', '2022-05-19 07:18:20'),
(12, 3, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:18:39', '2022-05-19 07:18:39'),
(13, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:21:10', '2022-05-19 07:21:10'),
(14, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:25:18', '2022-05-19 07:25:18'),
(15, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:26:03', '2022-05-19 07:26:03'),
(16, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:26:18', '2022-05-19 07:26:18'),
(17, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:26:38', '2022-05-19 07:26:38'),
(18, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:26:59', '2022-05-19 07:26:59'),
(19, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:27:25', '2022-05-19 07:27:25'),
(20, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:27:35', '2022-05-19 07:27:35'),
(21, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-19 07:29:32', '2022-05-19 07:29:32'),
(22, 3, 'Update', '2022-05-14 07:30:13', '2022-05-19 07:29:58', '2022-05-19 08:46:42'),
(24, 20, 'Snaks2', '2022-05-14 07:30:13', '2022-05-21 03:35:56', '2022-05-21 03:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('009f0ed67a41d4628e5f2c517c93a50a68447edd0a44e939b3b339a6765f096d9222412ada774daa', 3, 3, 'MyApp', '[]', 0, '2022-05-22 07:20:54', '2022-05-22 07:20:54', '2023-05-22 12:20:54'),
('35a00e53e8162117a47872d57954f07857631243f2ec9068432a0aeba9a296e13e67dace6b32223b', 3, 1, 'MyApp', '[]', 0, '2022-05-14 05:09:27', '2022-05-14 05:09:27', '2023-05-14 10:09:27'),
('35e9274c516ed7583a42457b2868ad43e68d9a8b8ee47a9f3194e2ee7192d1a909f8a3e011f02709', 1, 1, 'MyApp', '[]', 0, '2022-05-14 04:53:56', '2022-05-14 04:53:56', '2023-05-14 09:53:56'),
('45626a792321a9f369fce93f599b741802ce0b0ab3102ca70bdc3d522897ea85b5a9714f10d96e53', 3, 1, 'MyApp', '[]', 0, '2022-05-14 05:09:37', '2022-05-14 05:09:37', '2023-05-14 10:09:37'),
('6dc72dbb1ddc7906f9dc4741f72f87a2c7e5216639a991ea09bcb2aa68bb5084a9a5098c4d28cb50', 3, 1, 'MyApp', '[]', 0, '2022-05-14 05:06:53', '2022-05-14 05:06:53', '2023-05-14 10:06:53'),
('941df38d62f3e7068a8a8935a0023ceef3bd6f862963e58ec8ab1c1c2dc4d3bb530602e5ffdf76a6', 3, 3, 'MyApp', '[]', 0, '2022-05-18 08:30:42', '2022-05-18 08:30:42', '2023-05-18 13:30:42'),
('ac863a380e5261f5ee81a9dc3b3a5f5aa7352b3e7c7f4e083fc5f94ca3788dad9b62dcbd7db0fc0b', 3, 3, 'MyApp', '[]', 0, '2022-05-18 08:10:59', '2022-05-18 08:10:59', '2023-05-18 13:10:59'),
('b6d161922de4484ac008daddade9dba770aee7b88a16a2531ccf8bb43141058a503fa80e8c5ff280', 3, 1, 'MyApp', '[]', 0, '2022-05-14 05:07:46', '2022-05-14 05:07:46', '2023-05-14 10:07:46'),
('ba69b8d66f3e217e9f76be9bef923ad541c90670a80ee0d9cf43bb6f88f22735846e58faf3388262', 3, 3, 'MyApp', '[]', 0, '2022-05-22 07:21:47', '2022-05-22 07:21:47', '2023-05-22 12:21:47'),
('d31a5f7dd5404742f995cae88c13fc58587ebe34bcedea0ab2b810f20b083abe48896bcacd93e2d3', 4, 1, 'MyApp', '[]', 0, '2022-05-14 05:30:03', '2022-05-14 05:30:03', '2023-05-14 10:30:03'),
('df7240ad7461b654a6972f9699d0a4393e27a93539a436619c26b96e9d3f89c4ccb3761182045153', 1, 1, 'MyApp', '[]', 0, '2022-05-14 04:57:49', '2022-05-14 04:57:49', '2023-05-14 09:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
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
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Roles-Permissions Manager Personal Access Client', 'EaND9yE8MAvW2kMy71SgJnTBm9t9YdgzcwVICzVj', NULL, 'http://localhost', 1, 0, 0, '2022-05-14 04:53:47', '2022-05-14 04:53:47'),
(2, NULL, 'Roles-Permissions Manager Password Grant Client', 'YxtDwuVLxhB23bfMEobc7UDmRZLBLeFRvMXW5iSn', 'users', 'http://localhost', 0, 1, 0, '2022-05-14 04:53:47', '2022-05-14 04:53:47'),
(3, NULL, 'Roles-Permissions Manager Personal Access Client', 'BajDBC4hkRDmuakWnW5dJvhGlMz5V0zuS76BqT4k', NULL, 'http://localhost', 1, 0, 0, '2022-05-18 07:49:55', '2022-05-18 07:49:55'),
(4, NULL, 'Roles-Permissions Manager Password Grant Client', 'nndYPcx63Piw12dgDYQJhUaHWUPATNuM2RFJmRfp', 'users', 'http://localhost', 0, 1, 0, '2022-05-18 07:49:56', '2022-05-18 07:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-14 04:53:47', '2022-05-14 04:53:47'),
(2, 3, '2022-05-18 07:49:56', '2022-05-18 07:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users_manage', 'web', '2022-05-13 06:49:02', '2022-05-13 06:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2022-05-13 06:49:02', '2022-05-13 06:49:02'),
(2, 'trainer', 'web', '2022-05-14 04:58:44', '2022-05-14 04:58:56'),
(3, 'client', 'web', '2022-05-14 04:59:04', '2022-05-14 04:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$2wLhdgsZVltIyK7OOZU49eAohC3/KODmi7E6C0lwZEyx1/gzh7zuq', NULL, NULL, '2022-05-13 06:49:02', '2022-05-13 06:49:02'),
(2, 'client', 'app', 'client@app.com', '$2y$10$nFdrm4ht9ko9A60fZUa9..n/MlgOI9o4Em2b/wHYgUuADw03HZ7k.', NULL, NULL, '2022-05-14 05:05:41', '2022-05-14 05:05:41'),
(3, 'Trainer', '2', 'trainer2@app.com', '$2y$10$kQwfNrqNAFpC6fDng04B6u49DpuHZ7KVnow9zakVEmRLhN8fWTZ8W', 12345678, NULL, '2022-05-14 05:06:18', '2022-05-22 07:21:32'),
(4, 'client', '2', 'trainer@app.com', '$2y$10$qF072qnLe0FuiAyS08mZHex98DsvY5ScuIEXXEhNBJPhX4cTwwf4W', NULL, NULL, '2022-05-14 05:30:03', '2022-05-14 05:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_nutrition_plans`
--

CREATE TABLE `weekly_nutrition_plans` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekly_nutrition_plans`
--

INSERT INTO `weekly_nutrition_plans` (`id`, `plan_id`, `week`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Sun', '2022-05-14 20:33:14', '2022-05-14 20:33:14'),
(2, 1, 1, 'monday', '2022-05-14 21:17:44', '2022-05-14 21:17:44'),
(3, 6, 1, 'Sunday', '2022-05-18 08:58:39', '2022-05-18 08:58:39'),
(4, 6, 1, 'Monday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(5, 6, 1, 'Tuesday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(6, 6, 1, 'Wednesday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(7, 6, 1, 'Thusday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(8, 6, 1, 'Friday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(9, 6, 1, 'Saturday', '2022-05-18 08:58:40', '2022-05-18 08:58:40'),
(10, 7, 1, 'Sunday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(11, 7, 1, 'Monday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(12, 7, 1, 'Tuesday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(13, 7, 1, 'Wednesday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(14, 7, 1, 'Thusday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(15, 7, 1, 'Friday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(16, 7, 1, 'Saturday', '2022-05-18 09:00:03', '2022-05-18 09:00:03'),
(17, 8, 1, 'Sunday', '2022-05-19 04:46:57', '2022-05-19 04:46:57'),
(18, 8, 1, 'Monday', '2022-05-19 04:46:57', '2022-05-19 04:46:57'),
(19, 8, 1, 'Tuesday', '2022-05-19 04:46:58', '2022-05-19 04:46:58'),
(20, 8, 1, 'Wednesday', '2022-05-19 04:46:58', '2022-05-19 04:46:58'),
(21, 8, 1, 'Thusday', '2022-05-19 04:46:58', '2022-05-19 04:46:58'),
(22, 8, 1, 'Friday', '2022-05-19 04:46:58', '2022-05-19 04:46:58'),
(23, 8, 1, 'Saturday', '2022-05-19 04:46:58', '2022-05-19 04:46:58'),
(24, 0, 0, '', '2022-05-21 11:11:26', '2022-05-21 11:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `workout_notes`
--

CREATE TABLE `workout_notes` (
  `id` int(11) NOT NULL,
  `workout_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'abs', '2022-05-21 06:37:22', '2022-05-21 06:37:22'),
(2, 'abs', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(3, 'shouder', '2022-05-21 06:38:54', '2022-05-21 06:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan_notes`
--

CREATE TABLE `workout_plan_notes` (
  `id` int(11) NOT NULL,
  `workout_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan_types`
--

CREATE TABLE `workout_plan_types` (
  `id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT 'Excersice',
  `sets` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_plan_types`
--

INSERT INTO `workout_plan_types` (`id`, `week_id`, `name`, `sets`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Excersice', NULL, NULL, NULL, NULL),
(2, 1, 'Superset', NULL, NULL, NULL, NULL),
(3, 4, 'Exercise', NULL, NULL, '2022-05-22 05:27:11', '2022-05-22 05:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan_type_excersice`
--

CREATE TABLE `workout_plan_type_excersice` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `reps` varchar(255) DEFAULT NULL,
  `rest` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_plan_type_excersice`
--

INSERT INTO `workout_plan_type_excersice` (`id`, `type_id`, `exercise_id`, `set`, `weight`, `reps`, `rest`, `updated_at`, `created_at`) VALUES
(1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 1, 20, '10', '12', '30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan_weeklies`
--

CREATE TABLE `workout_plan_weeklies` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_plan_weeklies`
--

INSERT INTO `workout_plan_weeklies` (`id`, `plan_id`, `week`, `day`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Sunday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(2, 2, 1, 'Monday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(3, 2, 1, 'Tuesday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(4, 2, 1, 'Wednesday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(5, 2, 1, 'Thusday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(6, 2, 1, 'Friday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(7, 2, 1, 'Saturday', '2022-05-21 06:38:03', '2022-05-21 06:38:03'),
(8, 3, 1, 'Sunday', '2022-05-21 06:38:54', '2022-05-21 06:38:54'),
(9, 3, 1, 'Monday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(10, 3, 1, 'Tuesday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(11, 3, 1, 'Wednesday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(12, 3, 1, 'Thusday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(13, 3, 1, 'Friday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(14, 3, 1, 'Saturday', '2022-05-21 06:38:55', '2022-05-21 06:38:55'),
(15, 2, 2, 'Sunday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(16, 2, 2, 'Monday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(17, 2, 2, 'Tuesday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(18, 2, 2, 'Wednesday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(19, 2, 2, 'Thusday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(20, 2, 2, 'Friday', '2022-05-21 06:58:47', '2022-05-21 06:58:47'),
(21, 2, 2, 'Saturday', '2022-05-21 06:58:47', '2022-05-21 06:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `workout_templates`
--

CREATE TABLE `workout_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_templates`
--

INSERT INTO `workout_templates` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'shoulder', '2022-05-14 07:30:13', '2022-05-14 07:30:13'),
(2, 'Chest', '2022-05-19 19:36:19', '2022-05-19 19:36:19'),
(3, 'Forearam', '2022-05-19 19:53:21', '2022-05-19 19:53:21'),
(4, 'Wings', '2022-05-20 02:08:41', '2022-05-20 02:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `workout_types`
--

CREATE TABLE `workout_types` (
  `id` int(11) NOT NULL,
  `workout_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT 'Excersice',
  `sets` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_types`
--

INSERT INTO `workout_types` (`id`, `workout_id`, `name`, `sets`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Excersice', NULL, NULL, NULL, NULL),
(2, 1, 'superset', NULL, NULL, NULL, NULL),
(4, 2, 'Superset', NULL, NULL, NULL, NULL),
(5, 1, 'Excersice', NULL, NULL, NULL, NULL),
(10, 3, 'Exercise', NULL, NULL, '2022-05-20 02:04:47', '2022-05-20 02:04:47'),
(11, 4, 'Exercise', 1, 'dehan say arna', '2022-05-20 02:09:21', '2022-05-21 04:44:16'),
(14, 4, 'Superset', 1, 'dehan say arna', '2022-05-21 03:32:01', '2022-05-21 04:45:31'),
(15, 4, 'Superset', NULL, NULL, '2022-05-21 03:34:30', '2022-05-21 03:34:30'),
(16, 4, 'Superset', NULL, NULL, '2022-05-21 03:37:10', '2022-05-21 03:37:10'),
(17, 4, 'Superset', NULL, NULL, '2022-05-21 03:37:31', '2022-05-21 03:37:31'),
(18, 4, 'Circuit', NULL, NULL, '2022-05-21 03:48:07', '2022-05-21 03:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `workout_type_excersice`
--

CREATE TABLE `workout_type_excersice` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `reps` varchar(255) DEFAULT NULL,
  `rest` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout_type_excersice`
--

INSERT INTO `workout_type_excersice` (`id`, `type_id`, `exercise_id`, `set`, `weight`, `reps`, `rest`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 3, '10,12,13', '5,5,5', '40', NULL, NULL),
(2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 11, 1, 20, '10', NULL, '30', NULL, NULL),
(10, 14, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 17, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 17, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 18, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 18, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 14, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 16, 2, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_workouts`
--
ALTER TABLE `assign_workouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
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
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `nutrition_plans`
--
ALTER TABLE `nutrition_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_plan_meals`
--
ALTER TABLE `nutrition_plan_meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal` (`meal_id`),
  ADD KEY `type` (`type_id`);

--
-- Indexes for table `nutrition_plan_meal_types`
--
ALTER TABLE `nutrition_plan_meal_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weekly_plan` (`weekly_plan_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_nutrition_plans`
--
ALTER TABLE `weekly_nutrition_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_notes`
--
ALTER TABLE `workout_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_plan_notes`
--
ALTER TABLE `workout_plan_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_plan_types`
--
ALTER TABLE `workout_plan_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `week_id` (`week_id`);

--
-- Indexes for table `workout_plan_type_excersice`
--
ALTER TABLE `workout_plan_type_excersice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `excersice_id` (`exercise_id`);

--
-- Indexes for table `workout_plan_weeklies`
--
ALTER TABLE `workout_plan_weeklies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_templates`
--
ALTER TABLE `workout_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_types`
--
ALTER TABLE `workout_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_type_excersice`
--
ALTER TABLE `workout_type_excersice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_workouts`
--
ALTER TABLE `assign_workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nutrition_plans`
--
ALTER TABLE `nutrition_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nutrition_plan_meals`
--
ALTER TABLE `nutrition_plan_meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `nutrition_plan_meal_types`
--
ALTER TABLE `nutrition_plan_meal_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weekly_nutrition_plans`
--
ALTER TABLE `weekly_nutrition_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `workout_notes`
--
ALTER TABLE `workout_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout_plan_notes`
--
ALTER TABLE `workout_plan_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workout_plan_types`
--
ALTER TABLE `workout_plan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout_plan_type_excersice`
--
ALTER TABLE `workout_plan_type_excersice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout_plan_weeklies`
--
ALTER TABLE `workout_plan_weeklies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `workout_templates`
--
ALTER TABLE `workout_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workout_types`
--
ALTER TABLE `workout_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `workout_type_excersice`
--
ALTER TABLE `workout_type_excersice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `nutrition_plan_meals`
--
ALTER TABLE `nutrition_plan_meals`
  ADD CONSTRAINT `meal` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type` FOREIGN KEY (`type_id`) REFERENCES `nutrition_plan_meal_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nutrition_plan_meal_types`
--
ALTER TABLE `nutrition_plan_meal_types`
  ADD CONSTRAINT `weekly_plan` FOREIGN KEY (`weekly_plan_id`) REFERENCES `weekly_nutrition_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_plan_types`
--
ALTER TABLE `workout_plan_types`
  ADD CONSTRAINT `week_id` FOREIGN KEY (`week_id`) REFERENCES `workout_plan_weeklies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_plan_type_excersice`
--
ALTER TABLE `workout_plan_type_excersice`
  ADD CONSTRAINT `excersice_id` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_type_excersice`
--
ALTER TABLE `workout_type_excersice`
  ADD CONSTRAINT `exercise_id` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `workout_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
