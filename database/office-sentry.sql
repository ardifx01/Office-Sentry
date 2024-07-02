-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Jul 04, 2024 at 02:17 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office-sentry`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ismail Saleh', NULL, NULL),
(2, 'Suhartoyo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `building_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lantai 1', NULL, NULL),
(2, 1, 'Lantai 2', NULL, NULL),
(3, 1, 'Lantai 3', NULL, NULL),
(4, 1, 'Lantai 4', NULL, NULL),
(5, 1, 'Lantai 5', NULL, NULL),
(6, 1, 'Lantai 6', NULL, NULL),
(7, 1, 'Lantai 7', NULL, NULL),
(8, 1, 'Lantai 8', NULL, NULL),
(9, 1, 'Lantai 9', NULL, NULL),
(10, 1, 'Lantai 10', NULL, NULL),
(11, 2, 'Lantai 1', NULL, NULL),
(12, 2, 'Lantai 2', NULL, NULL),
(13, 2, 'Lantai 3', NULL, NULL),
(14, 2, 'Lantai 4', NULL, NULL),
(15, 2, 'Lantai 5', NULL, NULL),
(16, 2, 'Lantai 6', NULL, NULL),
(17, 2, 'Lantai 7', NULL, NULL),
(18, 2, 'Lantai 8', NULL, NULL),
(19, 2, 'Lantai 9', NULL, NULL),
(20, 2, 'Lantai 10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `izin_keluars`
--

CREATE TABLE `izin_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` time NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `status` enum('Sudah Kembali','Belum Kembali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Kembali',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_26_025028_create_permission_tables', 1),
(6, '2024_01_26_090546_create_office_boys_table', 1),
(7, '2024_01_27_132240_add_details_to_office_boys_table', 1),
(8, '2024_01_30_013234_create_office_boy_monitorings_table', 1),
(9, '2024_01_30_020728_create_buildings_table', 1),
(10, '2024_01_30_020802_create_floors_table', 1),
(11, '2024_01_30_020822_create_rooms_table', 1),
(12, '2024_01_31_023157_add_buildings_floors_rooms_to_office_boy_monitorings_table', 1),
(13, '2024_01_31_040730_create_shifts_table', 1),
(14, '2024_01_31_042045_add_shift_to_office_boy_monitorings_table', 1),
(15, '2024_02_01_034927_create_office_boy_reports_table', 1),
(16, '2024_02_01_051629_update_office_boy_monitorings_foreign_key', 1),
(17, '2024_02_01_110817_add_proof_photo_to_office_boy_monitorings_table', 1),
(18, '2024_02_02_123626_add_password_to_office_boys_table', 1),
(19, '2024_02_02_143010_add_jumlah_office_boy_to_rooms_table', 1),
(20, '2024_02_04_105958_create_trackings_table', 1),
(21, '2024_02_04_111953_add_monitoring_id_to_trackings_table', 1),
(22, '2024_02_04_121233_add_status_profile_to_office_boys_table', 1),
(23, '2024_02_05_012747_add_tracking_columns_to_office_boy_monitorings_table', 1),
(24, '2024_02_05_040840_add_foto_profil_to_office_boys_table', 1),
(25, '2024_02_07_005341_add_catatan_tugas_and_catatan_ob_to_office_boy_monitorings_table', 1),
(26, '2024_05_18_140343_create_izin_keluars_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_boys`
--

CREATE TABLE `office_boys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status` enum('Aktif','Mangkir','Drop Out','Sakit','Cuti') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Melengkapi',
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_boy_monitorings`
--

CREATE TABLE `office_boy_monitorings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_boy_id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('Belum Dikerjakan','Selesai Dikerjakan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proof_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_informasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_ob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dirut_umum', 'web', '2024-05-22 06:10:38', '2024-05-22 06:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah_office_boy` int(11) NOT NULL DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `floor_id`, `name`, `created_at`, `updated_at`, `jumlah_office_boy`) VALUES
(1, 1, 'Ruangan 1', NULL, NULL, 4),
(2, 1, 'Ruangan 2', NULL, NULL, 4),
(3, 1, 'Ruangan 3', NULL, NULL, 4),
(4, 2, 'Ruangan 1', NULL, NULL, 4),
(5, 2, 'Ruangan 2', NULL, NULL, 4),
(6, 2, 'Ruangan 3', NULL, NULL, 4),
(7, 3, 'Ruangan 1', NULL, NULL, 4),
(8, 3, 'Ruangan 2', NULL, NULL, 4),
(9, 3, 'Ruangan 3', NULL, NULL, 4),
(10, 4, 'Ruangan 1', NULL, NULL, 4),
(11, 4, 'Ruangan 2', NULL, NULL, 4),
(12, 4, 'Ruangan 3', NULL, NULL, 4),
(13, 5, 'Ruangan 1', NULL, NULL, 4),
(14, 5, 'Ruangan 2', NULL, NULL, 4),
(15, 5, 'Ruangan 3', NULL, NULL, 4),
(16, 6, 'Ruangan 1', NULL, NULL, 4),
(17, 6, 'Ruangan 2', NULL, NULL, 4),
(18, 6, 'Ruangan 3', NULL, NULL, 4),
(19, 7, 'Ruangan 1', NULL, NULL, 4),
(20, 7, 'Ruangan 2', NULL, NULL, 4),
(21, 7, 'Ruangan 3', NULL, NULL, 4),
(22, 8, 'Ruangan 1', NULL, NULL, 4),
(23, 8, 'Ruangan 2', NULL, NULL, 4),
(24, 8, 'Ruangan 3', NULL, NULL, 4),
(25, 9, 'Ruangan 1', NULL, NULL, 4),
(26, 9, 'Ruangan 2', NULL, NULL, 4),
(27, 9, 'Ruangan 3', NULL, NULL, 4),
(28, 10, 'Ruangan 1', NULL, NULL, 4),
(29, 10, 'Ruangan 2', NULL, NULL, 4),
(30, 10, 'Ruangan 3', NULL, NULL, 4),
(66, 11, 'Ruangan 1', NULL, NULL, 4),
(67, 11, 'Ruangan 2', NULL, NULL, 4),
(68, 11, 'Ruangan 3', NULL, NULL, 4),
(69, 12, 'Ruangan 1', NULL, NULL, 4),
(70, 12, 'Ruangan 2', NULL, NULL, 4),
(71, 12, 'Ruangan 3', NULL, NULL, 4),
(72, 13, 'Ruangan 1', NULL, NULL, 4),
(73, 13, 'Ruangan 2', NULL, NULL, 4),
(74, 13, 'Ruangan 3', NULL, NULL, 4),
(75, 14, 'Ruangan 1', NULL, NULL, 4),
(76, 14, 'Ruangan 2', NULL, NULL, 4),
(77, 14, 'Ruangan 3', NULL, NULL, 4),
(78, 15, 'Ruangan 1', NULL, NULL, 4),
(79, 15, 'Ruangan 2', NULL, NULL, 4),
(80, 15, 'Ruangan 3', NULL, NULL, 4),
(81, 16, 'Ruangan 1', NULL, NULL, 4),
(82, 16, 'Ruangan 2', NULL, NULL, 4),
(83, 16, 'Ruangan 3', NULL, NULL, 4),
(84, 17, 'Ruangan 1', NULL, NULL, 4),
(85, 17, 'Ruangan 2', NULL, NULL, 4),
(86, 17, 'Ruangan 3', NULL, NULL, 4),
(87, 18, 'Ruangan 1', NULL, NULL, 4),
(88, 18, 'Ruangan 2', NULL, NULL, 4),
(89, 18, 'Ruangan 3', NULL, NULL, 4),
(90, 19, 'Ruangan 1', NULL, NULL, 4),
(91, 19, 'Ruangan 2', NULL, NULL, 4),
(92, 19, 'Ruangan 3', NULL, NULL, 4),
(93, 20, 'Ruangan 1', NULL, NULL, 4),
(94, 20, 'Ruangan 2', NULL, NULL, 4),
(95, 20, 'Ruangan 3', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL COMMENT 'Waktu mulai',
  `end_time` time NOT NULL COMMENT 'Waktu selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 'Shift Pagi', '06:00:00', '15:00:00', '2024-05-22 06:10:50', '2024-05-22 06:10:50'),
(2, 'Shift Siang', '11:00:00', '19:00:00', '2024-05-22 06:10:50', '2024-05-22 06:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('kabag_urdal','pengawas','office_boy') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'office_boy',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pak kabag urdal', 'kabag@gmail.com', NULL, '$2y$12$v5q1McnZfc4Y4FBrql6S5eJnA9paUzJCk.IhDipDunwN7lMnXSdsW', 'kabag_urdal', NULL, '2024-05-22 06:10:12', '2024-05-22 06:10:12'),
(2, 'Pak Pengawas', 'pengawas@gmail.com', NULL, '$2y$12$HQ/szY88Svv4lTNYVie...NU4nuDT17n.4i880lFJdJSp6hpDblXi', 'pengawas', NULL, '2024-05-22 06:10:12', '2024-05-22 06:10:12'),
(3, 'Pak Office Boy', 'officeboy@gmail.com', NULL, '$2y$12$Z3rKnn7nze4DpJ7cnS8G2uPXolp9HNVxwuhtZYpBfaS9b83JWYMMK', 'office_boy', NULL, '2024-05-22 06:10:12', '2024-05-22 06:10:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floors_building_id_foreign` (`building_id`);

--
-- Indexes for table `izin_keluars`
--
ALTER TABLE `izin_keluars`
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
-- Indexes for table `office_boys`
--
ALTER TABLE `office_boys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_boys_user_id_foreign` (`user_id`);

--
-- Indexes for table `office_boy_monitorings`
--
ALTER TABLE `office_boy_monitorings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_boy_monitorings_building_id_foreign` (`building_id`),
  ADD KEY `office_boy_monitorings_floor_id_foreign` (`floor_id`),
  ADD KEY `office_boy_monitorings_room_id_foreign` (`room_id`),
  ADD KEY `office_boy_monitorings_shift_id_foreign` (`shift_id`),
  ADD KEY `office_boy_monitorings_office_boy_id_foreign` (`office_boy_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `izin_keluars`
--
ALTER TABLE `izin_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `office_boys`
--
ALTER TABLE `office_boys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_boy_monitorings`
--
ALTER TABLE `office_boy_monitorings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `office_boys`
--
ALTER TABLE `office_boys`
  ADD CONSTRAINT `office_boys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `office_boy_monitorings`
--
ALTER TABLE `office_boy_monitorings`
  ADD CONSTRAINT `office_boy_monitorings_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `office_boy_monitorings_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `office_boy_monitorings_office_boy_id_foreign` FOREIGN KEY (`office_boy_id`) REFERENCES `office_boys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `office_boy_monitorings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `office_boy_monitorings_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
