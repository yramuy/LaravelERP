-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 03:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin-erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `long_text` text NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_number` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date NOT NULL,
  `position` int(11) NOT NULL,
  `profile_pic` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_number`, `employee_id`, `first_name`, `last_name`, `email`, `mobile_number`, `gender`, `dob`, `position`, `profile_pic`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 1001, 'ramu', 'y', 'ramuy77290@gmail.com', '9876543210', 'male', '1989-08-16', 1, 'profile_pics/SBPNNg8BLpO2pIpBVgccEdP8VtQXBLih0ylUnduF.jpg', 1, '2024-09-27 05:08:18', '2024-09-27 05:08:18'),
(3, 1003, 'Keerthana', 'Y', 'ramuy77290@gmail.com', '9876543210', 'female', '2024-09-20', 1, '', 1, '2024-09-27 05:25:00', '2024-09-27 05:25:00'),
(4, 1003, 'Sc', 'Y', 'ramuy77290@gmail.com', '9876543211', 'female', '2024-08-29', 1, '', 1, '2024-09-27 05:40:23', '2024-09-27 05:40:23'),
(5, 1003, 'Keerthana', 'Y', 'ramuy77290@gmail.com', '9876543211', 'male', '2024-09-06', 1, '', 1, '2024-09-27 05:40:55', '2024-09-27 05:40:55'),
(9, 123, 'Raj', 'Y', 'raj@gmail.com', '1234567890', 'male', '2024-08-29', 3, 'portrait-young-indian-top-manager-t-shirt-tie-crossed-arms-smiling-white-isolated-wall__1_-removebg-preview.png', 1, '2024-09-27 07:45:48', '2024-09-27 07:45:48'),
(11, 1003, 'Ramu', 'Y', 'ramuy77290@gmail.com', '9876543210', 'male', '2017-02-01', 1, 'balaji_resume.pdf', 1, '2024-10-15 02:06:36', '2024-10-15 02:06:36'),
(12, 1004, 'Mounish', 'G', 'mounishg@gmail.com', '999999999999', 'male', '2024-10-16', 2, '1513.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `level` tinyint(4) DEFAULT NULL,
  `order_hint` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_title`, `screen_id`, `parent_id`, `level`, `order_hint`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 1, 0, 1, 100, '/', 'fa-home', 1, NULL, NULL),
(2, 'Users', 2, 0, 1, 100, '', 'fa-users', 1, NULL, NULL),
(3, 'Add User', 3, 2, 2, 100, '/adduser', 'fa-user-plus', 1, NULL, NULL),
(4, 'User List', 4, 2, 2, 200, '/users', 'fa-users', 1, NULL, NULL),
(5, 'Employee', 6, 0, 1, 100, '', 'fa-user-circle', 1, NULL, NULL),
(8, 'Add Employee', 7, 5, 2, 100, '/add-employee', 'fa-user-plus', 1, NULL, NULL),
(9, 'Employee List', 8, 5, 2, 200, '/employees', 'fa-users', 1, NULL, NULL),
(10, 'Leave', 9, 0, 1, 100, '', 'fa-calendar-week\r\n', 1, NULL, NULL),
(11, 'Apply Leave', 10, 10, 2, 100, '/apply-leave', 'fa-holly-berry', 1, NULL, NULL),
(12, 'Leave List', 11, 10, 2, 200, '/leaves', 'fa-apple-alt', 1, NULL, NULL),
(14, 'Requisitions', 13, 0, 1, NULL, NULL, ' fa-unlock-alt', 1, NULL, NULL),
(15, 'Request PPE', 14, 14, 2, NULL, '/request-ppe', 'fa-ticket-alt', 1, NULL, NULL),
(16, 'Request Pass', 15, 14, 2, NULL, '/request-pass', 'fa-passport', 1, NULL, NULL),
(17, 'Book Vehicle', 16, 14, 2, NULL, '/book-vehicle', 'fa-car-alt', 1, NULL, NULL),
(18, 'Notifications', 17, 0, 1, NULL, NULL, 'fa-cog', 1, NULL, NULL),
(19, 'Disciplinary Notification', 17, 18, 2, NULL, '/disciplinary-notification', 'fa-users-cog', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_03_102233_create_email_verification_table', 1),
(6, '2024_06_04_123733_create_abouts_table', 1),
(7, '2024_06_05_110828_create_skills_table', 1),
(8, '2024_06_05_111350_add_profile_id_to_skills_table', 1),
(9, '2024_06_13_073749_create_services_table', 1),
(10, '2024_06_17_095430_add_role_to_users_table', 1),
(11, '2024_06_21_070628_create_blogs_table', 1),
(12, '2024_07_25_123641_create_roles_table', 1),
(13, '2024_07_25_123718_create_permissions_table', 1),
(14, '2024_07_25_123832_create_role_permissions_table', 1),
(15, '2024_07_25_123934_create_menu_items_table', 1),
(16, '2024_07_26_051346_add_is_active_to_menu_items_table', 1),
(17, '2024_07_26_061925_add_create_permissions_to_role_permissions_table', 1),
(18, '2024_09_17_050559_create_screen_table', 2),
(19, '2024_09_17_050853_create_user_role_screen_table', 2),
(20, '2024_09_17_051329_create_menu_item_table', 3),
(22, '2024_09_24_085206_create_employee_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'ESS', NULL, NULL),
(3, 'HR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `can_read` int(11) NOT NULL DEFAULT 0,
  `can_create` int(11) NOT NULL DEFAULT 0,
  `can_update` int(11) NOT NULL DEFAULT 0,
  `can_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE `screen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`id`, `screen_name`, `created_at`, `updated_at`) VALUES
(1, 'Home', NULL, NULL),
(2, 'Users', NULL, NULL),
(3, 'Add User', NULL, NULL),
(4, 'Users', NULL, NULL),
(6, 'Employee', NULL, NULL),
(7, 'Add Employee', NULL, NULL),
(8, 'Employees', NULL, NULL),
(9, 'Leave', NULL, NULL),
(10, 'Apply Leave', NULL, NULL),
(11, 'Leaves', NULL, NULL),
(13, 'Requisitions', NULL, NULL),
(14, 'Request PPE', NULL, NULL),
(15, 'Request Visitor Pass', NULL, NULL),
(16, 'Book Vehicle', NULL, NULL),
(17, 'Disciplinary Notification', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `is_verified`, `email`, `username`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin123', 0, 'ramuy77290@gmail.com', 'admin', 1, NULL, '$2y$10$EESYAtL1752qOY7HYcua5ehOItW9QheOCFzDECnsZ3cKTtDGkNrUO', NULL, NULL, NULL),
(2, 'Prasad', 0, 'prasad@gmail.com', 'prasad', 2, NULL, '$2y$10$EESYAtL1752qOY7HYcua5ehOItW9QheOCFzDECnsZ3cKTtDGkNrUO', NULL, NULL, NULL),
(3, 'Prasad', 0, 'david@gmail.com', 'david', 3, NULL, '$2y$10$EESYAtL1752qOY7HYcua5ehOItW9QheOCFzDECnsZ3cKTtDGkNrUO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_screen`
--

CREATE TABLE `user_role_screen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `can_read` tinyint(4) NOT NULL DEFAULT 0,
  `can_create` tinyint(4) NOT NULL DEFAULT 0,
  `can_update` tinyint(4) NOT NULL DEFAULT 0,
  `can_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role_screen`
--

INSERT INTO `user_role_screen` (`id`, `user_role_id`, `screen_id`, `can_read`, `can_create`, `can_update`, `can_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 0, 0, NULL, NULL),
(2, 2, 1, 1, 0, 0, 0, NULL, NULL),
(3, 3, 1, 1, 0, 0, 0, NULL, NULL),
(4, 1, 2, 1, 0, 0, 0, NULL, NULL),
(6, 1, 3, 1, 1, 1, 1, NULL, NULL),
(7, 1, 4, 1, 1, 1, 1, NULL, NULL),
(8, 1, 6, 1, 0, 0, 0, NULL, NULL),
(9, 1, 7, 1, 1, 1, 1, NULL, NULL),
(10, 1, 8, 1, 1, 1, 1, NULL, NULL),
(11, 1, 9, 1, 0, 0, 0, NULL, NULL),
(12, 2, 9, 1, 0, 0, 0, NULL, NULL),
(13, 3, 9, 1, 0, 0, 0, NULL, NULL),
(14, 2, 10, 1, 1, 1, 1, NULL, NULL),
(15, 3, 10, 1, 1, 1, 1, NULL, NULL),
(16, 2, 11, 1, 1, 1, 1, NULL, NULL),
(17, 3, 11, 1, 1, 1, 0, NULL, NULL),
(18, 1, 11, 1, 1, 1, 1, NULL, NULL),
(19, 1, 13, 1, 0, 0, 0, NULL, NULL),
(20, 2, 13, 1, 0, 0, 0, NULL, NULL),
(21, 3, 13, 1, 0, 0, 0, NULL, NULL),
(22, 1, 14, 1, 1, 1, 1, NULL, NULL),
(23, 2, 14, 1, 1, 1, 1, NULL, NULL),
(24, 3, 14, 1, 1, 1, 1, NULL, NULL),
(25, 1, 15, 1, 1, 1, 1, NULL, NULL),
(26, 2, 15, 1, 1, 1, 0, NULL, NULL),
(27, 3, 15, 1, 1, 1, 1, NULL, NULL),
(28, 1, 16, 1, 1, 0, 0, NULL, NULL),
(29, 1, 17, 1, 0, 0, 0, NULL, NULL),
(30, 2, 17, 1, 1, 1, 1, NULL, NULL),
(31, 3, 17, 1, 1, 1, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_verifications_email_index` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_role_screen`
--
ALTER TABLE `user_role_screen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screen`
--
ALTER TABLE `screen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role_screen`
--
ALTER TABLE `user_role_screen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
