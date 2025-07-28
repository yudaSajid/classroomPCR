-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 09:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `reasons` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `text`, `is_correct`, `reasons`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gubernur', 1, 'Memang ini', NULL, '2024-07-05 00:37:09', '2024-07-05 00:37:09'),
(2, 1, 'WPeka', 0, 'd', NULL, '2024-07-05 00:37:09', '2024-07-05 00:37:09'),
(3, 2, 'sssad', 1, 'Nisi earum necessita', NULL, '2024-07-05 01:42:35', '2024-07-05 01:42:35'),
(4, 2, 'Et minima quam quia ', 0, 'Nisi earum necessita', NULL, '2024-07-05 01:42:35', '2024-07-05 01:42:35'),
(5, 4, 'aa', 1, 'aa', NULL, '2024-08-21 09:12:42', '2024-08-21 09:13:17'),
(6, 4, 'vv', 0, NULL, NULL, '2024-08-21 09:12:42', '2024-08-21 09:13:17'),
(7, 3, '11', 1, 'dd', NULL, '2024-08-21 09:13:23', '2024-08-21 09:13:23'),
(8, 3, '22', 0, NULL, NULL, '2024-08-21 09:13:23', '2024-08-21 09:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deadline` int(11) DEFAULT NULL,
  `chapter_id` char(26) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `deadline`, `chapter_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
('9c707cab-baf2-4af3-967e-2b788ba76525', 'Terlalu', '<p>Debitis ea iusto a d.</p>', 3, '01j179ebpmmgw9d5zcz869ark3', NULL, '2024-07-03 22:03:38', '2024-07-19 08:22:24'),
('9c70c468-3c16-4aa3-9c2c-1a8a68d30456', 'Qui adipisicing optio molestiae aut', '<p>Quidem dolorem illo .</p>', 54, '01j179ebpmmgw9d5zcz869ark3', NULL, '2024-07-04 01:24:14', '2024-07-23 07:13:08'),
('9cf16f7b-f53d-4c5d-9782-8f7bd49884f3', 'Tugas Laporan', '<p>Gaspoll</p>', 3, '01j210pa9ajx4ya4r5ryt60mv2', NULL, '2024-09-06 07:28:34', '2024-09-06 07:28:34'),
('9cf17a94-86cf-4605-8d4a-eeb049f3ca94', 'despacito', '<p>sing</p>', 2, '01j179ebpmmgw9d5zcz869ark3', NULL, '2024-09-06 07:59:36', '2024-09-06 07:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `name`, `color`, `description`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Zahir Head', '#9c2525', '<p>Dolorem sunt minima .</p>', '01J176ZG90Z25CPK3ZW2XJY7QM.jpg', '2024-06-25 01:10:39', '2024-06-25 01:07:45', '2024-06-25 01:10:39'),
(2, 'Nathaniel Hobbs', '#2e1818', '<p>Animi, officia esse.</p>', '01J17754D3EDV0WDXNY38H8VRG.jpg', NULL, '2024-06-25 01:10:49', '2024-06-25 01:10:49'),
(3, 'Driscoll Atkinson', '#a67373', '<p>Culpa, ex incididunt.</p>', '01J20X0DGVH2RAC7HB4QA84W7H.png', NULL, '2024-07-05 00:33:44', '2024-07-05 00:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1731052845),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1731052845;', 1731052845),
('4c37f2719625ad5f265ecd52a4a279a681949373', 'i:1;', 1725953621),
('4c37f2719625ad5f265ecd52a4a279a681949373:timer', 'i:1725953621;', 1725953621),
('4f06905c6cc788279fe8eae7db9345f6e254d18d', 'i:1;', 1725954085),
('4f06905c6cc788279fe8eae7db9345f6e254d18d:timer', 'i:1725954085;', 1725954085),
('602a157b29e14a71087b2add8f8664bead707dcf', 'i:1;', 1725950754),
('602a157b29e14a71087b2add8f8664bead707dcf:timer', 'i:1725950754;', 1725950754),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1731395091),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1731395091;', 1731395091),
('ab2ee9dd84edb905ea73a61e7777ad2c926b3158', 'i:1;', 1731048858),
('ab2ee9dd84edb905ea73a61e7777ad2c926b3158:timer', 'i:1731048858;', 1731048858),
('cfda02f4132e65fc65ed36a64a082d100670870b', 'i:1;', 1725605310),
('cfda02f4132e65fc65ed36a64a082d100670870b:timer', 'i:1725605310;', 1725605310),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:247:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"view_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:14:\"view_any_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"create_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"update_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"restore_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:17:\"restore_any_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:15:\"replicate_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:13:\"reorder_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"delete_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:16:\"delete_any_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:18:\"force_delete_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:22:\"force_delete_any_badge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:12:\"view_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:16:\"view_any_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"create_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:14:\"update_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"restore_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:19:\"restore_any_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:17:\"replicate_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:15:\"reorder_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"delete_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:18:\"delete_any_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:20:\"force_delete_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:24:\"force_delete_any_chapter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"view_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:18:\"view_any_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:16:\"create_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:16:\"update_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:17:\"restore_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:21:\"restore_any_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:19:\"replicate_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:17:\"reorder_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:16:\"delete_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:20:\"delete_any_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:22:\"force_delete_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:26:\"force_delete_any_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:11:\"view_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:15:\"view_any_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:13:\"create_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:13:\"update_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:14:\"restore_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:18:\"restore_any_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:16:\"replicate_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:14:\"reorder_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:13:\"delete_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:17:\"delete_any_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:19:\"force_delete_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:23:\"force_delete_any_course\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:15:\"view_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:19:\"view_any_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:17:\"create_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:17:\"update_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:18:\"restore_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:22:\"restore_any_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:20:\"replicate_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:18:\"reorder_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:17:\"delete_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:21:\"delete_any_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:23:\"force_delete_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:27:\"force_delete_any_department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:13:\"view_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:17:\"view_any_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:15:\"create_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:15:\"update_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:16:\"restore_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:20:\"restore_any_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:18:\"replicate_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:16:\"reorder_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:15:\"delete_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:19:\"delete_any_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:21:\"force_delete_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:25:\"force_delete_any_material\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:10:\"view_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:14:\"view_any_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:12:\"create_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:12:\"update_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:13:\"restore_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:17:\"restore_any_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:15:\"replicate_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:13:\"reorder_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:12:\"delete_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:16:\"delete_any_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:18:\"force_delete_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:22:\"force_delete_any_medal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:11:\"view_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:15:\"view_any_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:13:\"create_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:13:\"update_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:14:\"restore_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:18:\"restore_any_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:16:\"replicate_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:14:\"reorder_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:13:\"delete_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:17:\"delete_any_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:19:\"force_delete_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:23:\"force_delete_any_period\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:13:\"view_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:17:\"view_any_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:15:\"create_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:15:\"update_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:16:\"restore_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:20:\"restore_any_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:18:\"replicate_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:16:\"reorder_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:15:\"delete_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:19:\"delete_any_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:21:\"force_delete_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:25:\"force_delete_any_question\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:126;a:4:{s:1:\"a\";i:127;s:1:\"b\";s:9:\"view_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:127;a:4:{s:1:\"a\";i:128;s:1:\"b\";s:13:\"view_any_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:128;a:4:{s:1:\"a\";i:129;s:1:\"b\";s:11:\"create_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:129;a:4:{s:1:\"a\";i:130;s:1:\"b\";s:11:\"update_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:130;a:4:{s:1:\"a\";i:131;s:1:\"b\";s:12:\"restore_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:131;a:4:{s:1:\"a\";i:132;s:1:\"b\";s:16:\"restore_any_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:132;a:4:{s:1:\"a\";i:133;s:1:\"b\";s:14:\"replicate_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:133;a:4:{s:1:\"a\";i:134;s:1:\"b\";s:12:\"reorder_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:134;a:4:{s:1:\"a\";i:135;s:1:\"b\";s:11:\"delete_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:135;a:4:{s:1:\"a\";i:136;s:1:\"b\";s:15:\"delete_any_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:136;a:4:{s:1:\"a\";i:137;s:1:\"b\";s:17:\"force_delete_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:137;a:4:{s:1:\"a\";i:138;s:1:\"b\";s:21:\"force_delete_any_quiz\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:138;a:4:{s:1:\"a\";i:139;s:1:\"b\";s:13:\"view_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:139;a:4:{s:1:\"a\";i:140;s:1:\"b\";s:17:\"view_any_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:140;a:4:{s:1:\"a\";i:141;s:1:\"b\";s:15:\"create_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:141;a:4:{s:1:\"a\";i:142;s:1:\"b\";s:15:\"update_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:142;a:4:{s:1:\"a\";i:143;s:1:\"b\";s:16:\"restore_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:143;a:4:{s:1:\"a\";i:144;s:1:\"b\";s:20:\"restore_any_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:144;a:4:{s:1:\"a\";i:145;s:1:\"b\";s:18:\"replicate_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:145;a:4:{s:1:\"a\";i:146;s:1:\"b\";s:16:\"reorder_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:146;a:4:{s:1:\"a\";i:147;s:1:\"b\";s:15:\"delete_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:147;a:4:{s:1:\"a\";i:148;s:1:\"b\";s:19:\"delete_any_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:148;a:4:{s:1:\"a\";i:149;s:1:\"b\";s:21:\"force_delete_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:149;a:4:{s:1:\"a\";i:150;s:1:\"b\";s:25:\"force_delete_any_semester\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:150;a:4:{s:1:\"a\";i:151;s:1:\"b\";s:11:\"view_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:151;a:4:{s:1:\"a\";i:152;s:1:\"b\";s:15:\"view_any_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:152;a:4:{s:1:\"a\";i:153;s:1:\"b\";s:13:\"create_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:153;a:4:{s:1:\"a\";i:154;s:1:\"b\";s:13:\"update_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:154;a:4:{s:1:\"a\";i:155;s:1:\"b\";s:14:\"restore_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:155;a:4:{s:1:\"a\";i:156;s:1:\"b\";s:18:\"restore_any_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:156;a:4:{s:1:\"a\";i:157;s:1:\"b\";s:16:\"replicate_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:157;a:4:{s:1:\"a\";i:158;s:1:\"b\";s:14:\"reorder_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:158;a:4:{s:1:\"a\";i:159;s:1:\"b\";s:13:\"delete_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:159;a:4:{s:1:\"a\";i:160;s:1:\"b\";s:17:\"delete_any_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:160;a:4:{s:1:\"a\";i:161;s:1:\"b\";s:19:\"force_delete_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:161;a:4:{s:1:\"a\";i:162;s:1:\"b\";s:23:\"force_delete_any_ticket\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:162;a:4:{s:1:\"a\";i:163;s:1:\"b\";s:20:\"view_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:163;a:4:{s:1:\"a\";i:164;s:1:\"b\";s:24:\"view_any_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:164;a:4:{s:1:\"a\";i:165;s:1:\"b\";s:22:\"create_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:165;a:4:{s:1:\"a\";i:166;s:1:\"b\";s:22:\"update_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:166;a:4:{s:1:\"a\";i:167;s:1:\"b\";s:23:\"restore_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:167;a:4:{s:1:\"a\";i:168;s:1:\"b\";s:27:\"restore_any_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:168;a:4:{s:1:\"a\";i:169;s:1:\"b\";s:25:\"replicate_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:169;a:4:{s:1:\"a\";i:170;s:1:\"b\";s:23:\"reorder_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:170;a:4:{s:1:\"a\";i:171;s:1:\"b\";s:22:\"delete_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:171;a:4:{s:1:\"a\";i:172;s:1:\"b\";s:26:\"delete_any_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:172;a:4:{s:1:\"a\";i:173;s:1:\"b\";s:28:\"force_delete_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:173;a:4:{s:1:\"a\";i:174;s:1:\"b\";s:32:\"force_delete_any_user::education\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:174;a:4:{s:1:\"a\";i:175;s:1:\"b\";s:22:\"view_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:175;a:4:{s:1:\"a\";i:176;s:1:\"b\";s:26:\"view_any_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:176;a:4:{s:1:\"a\";i:177;s:1:\"b\";s:24:\"create_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:177;a:4:{s:1:\"a\";i:178;s:1:\"b\";s:24:\"update_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:178;a:4:{s:1:\"a\";i:179;s:1:\"b\";s:25:\"restore_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:179;a:4:{s:1:\"a\";i:180;s:1:\"b\";s:29:\"restore_any_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:180;a:4:{s:1:\"a\";i:181;s:1:\"b\";s:27:\"replicate_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:181;a:4:{s:1:\"a\";i:182;s:1:\"b\";s:25:\"reorder_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:182;a:4:{s:1:\"a\";i:183;s:1:\"b\";s:24:\"delete_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:183;a:4:{s:1:\"a\";i:184;s:1:\"b\";s:28:\"delete_any_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:184;a:4:{s:1:\"a\";i:185;s:1:\"b\";s:30:\"force_delete_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:185;a:4:{s:1:\"a\";i:186;s:1:\"b\";s:34:\"force_delete_any_user::information\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:186;a:4:{s:1:\"a\";i:187;s:1:\"b\";s:15:\"view_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:187;a:4:{s:1:\"a\";i:188;s:1:\"b\";s:19:\"view_any_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:188;a:4:{s:1:\"a\";i:189;s:1:\"b\";s:17:\"create_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:189;a:4:{s:1:\"a\";i:190;s:1:\"b\";s:17:\"update_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:190;a:4:{s:1:\"a\";i:191;s:1:\"b\";s:18:\"restore_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:191;a:4:{s:1:\"a\";i:192;s:1:\"b\";s:22:\"restore_any_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:192;a:4:{s:1:\"a\";i:193;s:1:\"b\";s:20:\"replicate_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:193;a:4:{s:1:\"a\";i:194;s:1:\"b\";s:18:\"reorder_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:194;a:4:{s:1:\"a\";i:195;s:1:\"b\";s:17:\"delete_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:195;a:4:{s:1:\"a\";i:196;s:1:\"b\";s:21:\"delete_any_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:196;a:4:{s:1:\"a\";i:197;s:1:\"b\";s:23:\"force_delete_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:197;a:4:{s:1:\"a\";i:198;s:1:\"b\";s:27:\"force_delete_any_assignment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:198;a:4:{s:1:\"a\";i:199;s:1:\"b\";s:10:\"view_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:199;a:4:{s:1:\"a\";i:200;s:1:\"b\";s:14:\"view_any_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:200;a:4:{s:1:\"a\";i:201;s:1:\"b\";s:12:\"create_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:201;a:4:{s:1:\"a\";i:202;s:1:\"b\";s:12:\"update_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:202;a:4:{s:1:\"a\";i:203;s:1:\"b\";s:13:\"restore_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:203;a:4:{s:1:\"a\";i:204;s:1:\"b\";s:17:\"restore_any_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:204;a:4:{s:1:\"a\";i:205;s:1:\"b\";s:15:\"replicate_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:205;a:4:{s:1:\"a\";i:206;s:1:\"b\";s:13:\"reorder_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:206;a:4:{s:1:\"a\";i:207;s:1:\"b\";s:12:\"delete_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:207;a:4:{s:1:\"a\";i:208;s:1:\"b\";s:16:\"delete_any_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:208;a:4:{s:1:\"a\";i:209;s:1:\"b\";s:18:\"force_delete_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:209;a:4:{s:1:\"a\";i:210;s:1:\"b\";s:22:\"force_delete_any_point\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:210;a:4:{s:1:\"a\";i:211;s:1:\"b\";s:19:\"view_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:211;a:4:{s:1:\"a\";i:212;s:1:\"b\";s:23:\"view_any_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:212;a:4:{s:1:\"a\";i:213;s:1:\"b\";s:21:\"create_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:213;a:4:{s:1:\"a\";i:214;s:1:\"b\";s:21:\"update_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:214;a:4:{s:1:\"a\";i:215;s:1:\"b\";s:22:\"restore_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:215;a:4:{s:1:\"a\";i:216;s:1:\"b\";s:26:\"restore_any_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:216;a:4:{s:1:\"a\";i:217;s:1:\"b\";s:24:\"replicate_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:217;a:4:{s:1:\"a\";i:218;s:1:\"b\";s:22:\"reorder_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:218;a:4:{s:1:\"a\";i:219;s:1:\"b\";s:21:\"delete_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:219;a:4:{s:1:\"a\";i:220;s:1:\"b\";s:25:\"delete_any_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:220;a:4:{s:1:\"a\";i:221;s:1:\"b\";s:27:\"force_delete_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:221;a:4:{s:1:\"a\";i:222;s:1:\"b\";s:31:\"force_delete_any_point::setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:222;a:4:{s:1:\"a\";i:223;s:1:\"b\";s:20:\"widget_StatsOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:223;a:4:{s:1:\"a\";i:224;s:1:\"b\";s:12:\"view_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:224;a:4:{s:1:\"a\";i:225;s:1:\"b\";s:16:\"view_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:225;a:4:{s:1:\"a\";i:226;s:1:\"b\";s:14:\"create_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:226;a:4:{s:1:\"a\";i:227;s:1:\"b\";s:14:\"update_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:227;a:4:{s:1:\"a\";i:228;s:1:\"b\";s:15:\"restore_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:228;a:4:{s:1:\"a\";i:229;s:1:\"b\";s:19:\"restore_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:229;a:4:{s:1:\"a\";i:230;s:1:\"b\";s:17:\"replicate_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:230;a:4:{s:1:\"a\";i:231;s:1:\"b\";s:15:\"reorder_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:231;a:4:{s:1:\"a\";i:232;s:1:\"b\";s:14:\"delete_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:232;a:4:{s:1:\"a\";i:233;s:1:\"b\";s:18:\"delete_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:233;a:4:{s:1:\"a\";i:234;s:1:\"b\";s:20:\"force_delete_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:234;a:4:{s:1:\"a\";i:235;s:1:\"b\";s:24:\"force_delete_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:235;a:4:{s:1:\"a\";i:236;s:1:\"b\";s:9:\"view_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:236;a:4:{s:1:\"a\";i:237;s:1:\"b\";s:13:\"view_any_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:237;a:4:{s:1:\"a\";i:238;s:1:\"b\";s:11:\"create_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:238;a:4:{s:1:\"a\";i:239;s:1:\"b\";s:11:\"update_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:239;a:4:{s:1:\"a\";i:240;s:1:\"b\";s:12:\"restore_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:240;a:4:{s:1:\"a\";i:241;s:1:\"b\";s:16:\"restore_any_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:241;a:4:{s:1:\"a\";i:242;s:1:\"b\";s:14:\"replicate_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:242;a:4:{s:1:\"a\";i:243;s:1:\"b\";s:12:\"reorder_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:243;a:4:{s:1:\"a\";i:244;s:1:\"b\";s:11:\"delete_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:244;a:4:{s:1:\"a\";i:245;s:1:\"b\";s:15:\"delete_any_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:245;a:4:{s:1:\"a\";i:246;s:1:\"b\";s:17:\"force_delete_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:246;a:4:{s:1:\"a\";i:247;s:1:\"b\";s:21:\"force_delete_any_task\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"teacher_user\";s:1:\"c\";s:3:\"web\";}}}', 1731481431);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` char(26) NOT NULL,
  `course_id` char(36) NOT NULL,
  `challenge_name` varchar(255) NOT NULL,
  `challenge_description` text NOT NULL,
  `challenge_slug` varchar(255) NOT NULL,
  `challenge_publish` tinyint(1) NOT NULL DEFAULT 0,
  `challenge_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `course_id`, `challenge_name`, `challenge_description`, `challenge_slug`, `challenge_publish`, `challenge_photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
('01j28jmnqd5qhxhrc3sw3f9zjb', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', 'Robert', '<p>dada</p>', 'robert', 1, '01J28JMNQ136749NZVTTGCGWT4.jpg', '2024-07-08 00:06:29', '2024-07-08 00:06:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` char(26) NOT NULL,
  `chapter_number` int(11) NOT NULL,
  `titles` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `course_id` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter_number`, `titles`, `description`, `course_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
('01j179ebpmmgw9d5zcz869ark3', 16, 'Introduction', '<p>Ullam enim consectet.</p>', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', NULL, '2024-06-25 01:50:49', '2024-07-19 10:42:21'),
('01j17ejx4ndcq2q8dsqhnmxnk8', 2, 'Intro 2', '<p>dada</p>', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', '2024-07-19 10:42:11', '2024-06-25 03:20:40', '2024-07-19 10:42:11'),
('01j210pa9ajx4ya4r5ryt60mv2', 4, 'Pengenalan RPL', '<p>dd</p>', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', NULL, '2024-07-05 01:38:07', '2024-07-19 10:42:41'),
('01jc5cg5xgrqtahhcteadtygbq', 1, 'Teori Dasar', '<p>Program Studi Independen Skilvul #Tech4Impact terdiri atas pembelajaran individu dan capstone project yang dilakukan dalam tim multidisiplin. Kurikulum pembelajaran studi independen Skilvul #Tech4Impact&nbsp;</p>', '9d7035a9-62e2-4580-9a7f-92790613cc0a', NULL, '2024-11-08 07:58:25', '2024-11-08 07:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` char(26) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `class_description` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_alphabet` varchar(255) DEFAULT NULL,
  `enrollment_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_name`, `program_id`, `class_code`, `class_description`, `deleted_at`, `created_at`, `updated_at`, `class_alphabet`, `enrollment_year`) VALUES
('01j1q21mxeea9zmy6d1e5y5c8q', '14 TI A', 1, 'UKPE08', '<p>Velit velit voluptat.</p>', NULL, '2024-07-01 04:49:23', '2024-07-01 04:49:23', 'A', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `classroom_course`
--

CREATE TABLE `classroom_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` char(26) NOT NULL,
  `course_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom_course`
--

INSERT INTO `classroom_course` (`id`, `classroom_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`, `is_active`) VALUES
(5, '01j1q21mxeea9zmy6d1e5y5c8q', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', '2024-07-01 04:49:23', '2024-07-08 01:56:04', NULL, 1),
(6, '01j1q21mxeea9zmy6d1e5y5c8q', '9ceda04b-335b-4f07-88d2-e290fc41cb7c', '2024-09-04 10:02:00', '2024-09-04 10:02:00', NULL, 1),
(7, '01j1q21mxeea9zmy6d1e5y5c8q', '9d7035a9-62e2-4580-9a7f-92790613cc0a', '2024-11-08 08:02:02', '2024-11-08 08:02:02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_users`
--

CREATE TABLE `classroom_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` char(26) NOT NULL,
  `user_id` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom_users`
--

INSERT INTO `classroom_users` (`id`, `classroom_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(27, '01j1q21mxeea9zmy6d1e5y5c8q', '9c5e84c3-cd06-4309-8a45-bf82108e5e41', NULL, '2024-07-08 02:39:06', '2024-07-08 02:39:06'),
(28, '01j1q21mxeea9zmy6d1e5y5c8q', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', NULL, '2024-07-08 02:42:01', '2024-07-08 02:42:01'),
(29, '01j1q21mxeea9zmy6d1e5y5c8q', '9cf0f873-7e1d-4441-a016-798fec863bef', NULL, '2024-09-06 01:58:08', '2024-09-06 01:58:08'),
(30, '01j1q21mxeea9zmy6d1e5y5c8q', '9cf0f889-a795-4d13-a51e-9489e981a980', NULL, '2024-09-06 01:58:08', '2024-09-06 01:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` char(36) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_slug` varchar(255) NOT NULL,
  `course_publish` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `course_photo` varchar(255) NOT NULL DEFAULT 'images/course.png',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_slug`, `course_publish`, `course_description`, `course_photo`, `deleted_at`, `created_at`, `updated_at`) VALUES
('9c5eaf01-19b3-4f7d-ab17-4739d070ff43', 'Rekayasa Perangkat Lunak', 'rekayasa-perangkat-lunak', '1', '<p>Di kelas ini, kita akan membahas dasar-dasar penggunaan database dan pengembangan web dinamis dengan PHP. Dengan memahami keduanya, kita dapat membuat aplikasi web yang interaktif dan dinamis yang mampu menyimpan, mengambil, dan memanipulasi data secara efisien.<br>Apa Yang Akan Kita Pelajari?</p><ol><li>Pengenalan Database:<ul><li>Konsep dasar database dan manfaatnya dalam pengembangan web.</li><li>Jenis-jenis database dan perbandingannya.</li></ul></li><li>MySQL dan PHPMyAdmin:<ul><li>Instalasi dan konfigurasi MySQL.</li><li>Penggunaan PHPMyAdmin untuk administrasi database.</li></ul></li><li>Bahasa SQL:<ul><li>Pemahaman dasar bahasa SQL untuk melakukan manipulasi data seperti SELECT, INSERT, UPDATE, dan DELETE.</li></ul></li><li>Koneksi Database dengan PHP:<ul><li>Membuat koneksi antara PHP dan database MySQL.</li><li>Eksekusi query SQL melalui PHP.</li></ul></li><li>Penggunaan PHP dalam Pengembangan Web:<ul><li>Integrasi PHP dengan HTML untuk membuat halaman web dinamis.</li><li>Penggunaan PHP untuk pemrosesan formulir dan validasi data.</li><li>Dengan mempelajari dasar-dasar database dan PHP, Anda akan memiliki pondasi yang kuat untuk mengembangkan aplikasi web yang dinamis dan responsif sesuai kebutuhan Anda.</li></ul></li></ol><p><br><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;iqbal_narutos.jpg&quot;,&quot;filesize&quot;:18073,&quot;height&quot;:201,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/KutVNStqC62Ul6no4zf3HsxZaaCZNuUr0p7Y48pk.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/KutVNStqC62Ul6no4zf3HsxZaaCZNuUr0p7Y48pk.jpg&quot;,&quot;width&quot;:233}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/KutVNStqC62Ul6no4zf3HsxZaaCZNuUr0p7Y48pk.jpg\"><img src=\"http://127.0.0.1:8000/storage/KutVNStqC62Ul6no4zf3HsxZaaCZNuUr0p7Y48pk.jpg\" width=\"233\" height=\"201\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">iqbal_narutos.jpg</span> <span class=\"attachment__size\">17.65 KB</span></figcaption></a></figure><br><br><br><br><br><br><br><br></p>', '01J305PV78DFT066477TBDE13V.jpg', NULL, '2024-06-25 01:39:29', '2024-07-23 07:25:05'),
('9ceda04b-335b-4f07-88d2-e290fc41cb7c', 'Pemrograman Web', 'pemrograman-web', '1', '<h3>Develop Your Skills</h3><p>Penguasaan front end (user interface) dan back end (business logic) pada saat membangun website adalah hal utama bagi seorang Full Stack Web Developer. Bahkan, akan lebih baik jika didukung oleh skill UI/UX Design dan System Administration agar keseluruhan sistem web dapat berjalan dengan baik.</p><p>Di kelas ini, mentor kami akan menjelaskan UX design, UI design, dan pengembangan web menggunakan Bootstrap dan Laravel secara terperinci. Kelas ini cocok bagi Anda yang sedang bingung menentukan spesialisasi karir di bidang teknologi. Banyak ilmu yang bisa didapatkan dan bisa menjadi bekal untuk menjadi developer yang handal. Kelas ini menggunakan tools Laravel 6 dan PHP ≥ 7.2.</p><p>Setelah menyelesaikan kelas ini, Anda dapat lebih fokus memilih bidang sesuai dengan minat dan kemampuan. Segera daftar dan kami tunggu di kelas!</p><p><br></p>', '01J6Y7Q809HKTFNGWR46Z8DEC7.png', NULL, '2024-09-04 10:01:44', '2024-09-04 10:01:44'),
('9d7035a9-62e2-4580-9a7f-92790613cc0a', 'AKJK', 'akjk', '1', '<p>Voluptates sunt, sun.</p>', '01JC5CDM2G5EW0AWY5CAT7ZW7V.jpg', NULL, '2024-11-08 07:57:01', '2024-11-08 07:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `course_completion_rewards`
--

CREATE TABLE `course_completion_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `course_id` char(36) NOT NULL,
  `points_earned` int(11) NOT NULL,
  `completion_date` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `course_id` char(36) NOT NULL,
  `rating` decimal(5,2) NOT NULL,
  `comment` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

CREATE TABLE `course_teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` char(36) NOT NULL,
  `teacher_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_teacher`
--

INSERT INTO `course_teacher` (`id`, `course_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, '9d7035a9-62e2-4580-9a7f-92790613cc0a', '9c5e84c3-cd06-4309-8a45-bf82108e5e41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Jurusan Teknologi Informatika', 'jurusan-teknologi-informatika', NULL, '2024-06-25 00:25:55', '2024-06-25 00:25:55');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'profile-13', '01JC594FD1GWTCEQ2DA999D3D7.jpg', 'profile', NULL, '2024-11-08 06:59:36', '2024-11-08 06:59:36'),
(2, 'gif-112', '01JC59FKKSNTD4GE69HZ1ADNJE.png', 'GIF', NULL, '2024-11-08 07:05:41', '2024-11-08 07:05:41');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` char(26) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_type` text NOT NULL,
  `material_link` text DEFAULT NULL,
  `pdf_link` varchar(255) DEFAULT NULL,
  `material_text` text DEFAULT NULL,
  `chapter_id` char(26) NOT NULL,
  `order_number` int(11) NOT NULL,
  `duration` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_code` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material_name`, `material_type`, `material_link`, `pdf_link`, `material_text`, `chapter_id`, `order_number`, `duration`, `deleted_at`, `created_at`, `updated_at`, `is_code`) VALUES
('01j34y5p83j19bm49fn78qjhf2', 'Baru mau ngajar', 'youtube', 'https://www.youtube.com/watch?v=TRitofy2_Uw', 'Absensi Mentor 11 Juni - 10 Juli 2024.pdf', '<p>dada</p>', '01j179ebpmmgw9d5zcz869ark3', 1, '00:01:00', NULL, '2024-07-19 07:26:45', '2024-07-23 03:11:53', 1),
('01j35180a5fgtqjm5m9j396enc', 'Miftah', 'youtube', 'https://www.youtube.com/watch?v=ynVhnWu4sBw', 'Absensi Mentor 11 Juni - 10 Juli 2024.pdf', '<p>s</p>', '01j179ebpmmgw9d5zcz869ark3', 2, '00:01:00', NULL, '2024-07-19 08:20:27', '2024-07-23 06:47:45', 1),
('01j359dk5x1vf3g52nmgz5zx34', 'Use Case', 'youtube', 'https://www.youtube.com/watch?v=G4nNBckyZQU', NULL, '<p><strong><em>Contoh Use Case Diagram Lengkap dengan Penjelasannya</em></strong></p><p>Hallo, Apa kabar teman-teman? Sudah sewindu rasanya kita tidak bertemu ya hehe. Semoga rekan-rekan dalam keadaan sehat selalu. Aamiin.</p><p>Baik, pada kesempatan kali ini kita akan membahas tentang contoh <strong>Use Case Diagram</strong> lengkap dengan penjelasannya. Sebelumnya, kita juga telah membahas mengenai UML. Kamu dapat membacanya pada artikel <a href=\"https://www.dicoding.com/blog/apa-itu-uml/\">Apa itu UML? Beserta Pengertian dan Contohnya</a>. Penting untukmu membaca artikel tersebut karena masih berkaitan erat dengan use case diagran.&nbsp;</p><p>Use Case diagram cocok dipelajari bagi kamu yang ingin berkarir di bidang digital. Sebelum membuat aplikasi, tentu kamu mesti membuat permodelan terlebih dahulu. Programmer yang handal tentunya handal juga dalam pemodelan sistem yang akan dibuat. Mari simak dan baca sampai selesai. Nggak akan lebih dari 1 jam <em>kok </em>hehe.</p><p>&nbsp;</p><h2>Seberapa Pentingkah Use Case Diagram?</h2><p>Beberapa di antara teman-teman mungkin bertanya mengenai seberapa pentingkah use case diagram dibuat. Dalam pembuatan UML, use case diagram adalah komponen utama yang tidak boleh terlewatkan. Dengan begitu, kamu dapat menyimpulkan bahwa use case diagram merupakan suatu yang penting dalam pembuatan UML.</p>', '01j210pa9ajx4ya4r5ryt60mv2', 1, '00:01:00', NULL, '2024-07-19 10:43:18', '2024-08-23 09:15:00', 1),
('01j3f5s0aadcxh034x60rfshww', 'Egy Datang', 'pdf', NULL, 'Absensi Mentor 11 Juni - 10 Juli 2024.pdf', '<p>aa</p>', '01j210pa9ajx4ya4r5ryt60mv2', 2, '00:01:00', NULL, '2024-07-23 06:52:02', '2024-08-23 09:15:30', 1),
('01j6ejyw9xk5nn8zw3v469s9ca', 'Tcahul', 'youtube', 'https://www.youtube.com/watch?v=XrMqAZML1ac&t=34s', NULL, '<p>dd</p>', '01j179ebpmmgw9d5zcz869ark3', 3, '00:01:00', NULL, '2024-08-29 08:10:17', '2024-08-29 08:10:17', 0),
('01j6ejzm3y9zf6ckf8da2r8y9w', 'Iqbala', 'youtube', 'https://www.youtube.com/watch?v=17tZ2ANfT5s', NULL, '<p>a</p>', '01j179ebpmmgw9d5zcz869ark3', 4, '00:01:00', NULL, '2024-08-29 08:10:42', '2024-08-29 08:10:42', 0),
('01jc5ckhf3n8x456vn05c36jd8', 'Iqbala', 'pdf', NULL, 'Soal Sertifikasi Hari Kedua - Mobile Apps Development.pdf', '<p>test</p>', '01jc5cg5xgrqtahhcteadtygbq', 1, '00:03:00', NULL, '2024-11-08 08:00:15', '2024-11-08 08:00:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medals`
--

CREATE TABLE `medals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `medal_image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medals`
--

INSERT INTO `medals` (`id`, `name`, `color`, `description`, `medal_image`, `deleted_at`, `created_at`, `updated_at`, `points`) VALUES
(1, 'Golden', '#d9b014', '<p>Maxime dolor fugiat .</p>', '01J3F5D73G99SWE3YZYPWVRCXZ.webp', NULL, '2024-06-25 01:21:22', '2024-07-23 06:45:36', 750),
(2, 'Silver', '#d8d9cb', '<p>a</p>', '01J28WFZV6GEZ6G1BWJX9Z1RY1.jpg', NULL, '2024-07-08 02:58:41', '2024-07-08 02:58:41', 250),
(3, 'Platinum', '#d4b4b4', '<p>ada</p>', '01J28WH9MQQPJ9YFSPTZSDRZS2.jpg', NULL, '2024-07-08 02:59:24', '2024-07-08 02:59:24', 500);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_06_21_231539_change_model_id_to_varchar_in_model_has_roles_table', 1),
(6, '2024_06_21_163911_create_permission_tables', 2),
(7, '2024_06_24_081553_create_departments_table', 3),
(8, '2024_06_24_081643_create_programs_table', 3),
(9, '2024_06_24_081813_create_user_information_table', 3),
(10, '2024_06_24_081909_create_periods_table', 3),
(11, '2024_06_24_081950_create_semesters_table', 3),
(12, '2024_06_24_082822_create_courses_table', 3),
(13, '2024_06_24_082911_create_chapters_table', 3),
(14, '2024_06_24_083035_create_materials_table', 3),
(15, '2024_06_24_083152_create_assignments_table', 3),
(16, '2024_06_24_085233_create_classrooms_table', 3),
(17, '2024_06_24_090026_create_classroom_users_table', 3),
(18, '2024_06_24_090418_create_classroom_courses_table', 4),
(19, '2024_06_24_091211_create_course_completion_rewards_table', 4),
(20, '2024_06_24_091240_create_medals_table', 4),
(21, '2024_06_24_091308_create_user_medals_table', 4),
(22, '2024_06_24_091350_create_review_chapters_table', 4),
(23, '2024_06_24_091501_create_badges_table', 4),
(24, '2024_06_24_091517_create_user_badges_table', 4),
(25, '2024_06_24_091840_create_user_assignment_statuses_table', 4),
(26, '2024_06_24_092501_create_quizzes_table', 4),
(27, '2024_06_24_092544_create_questions_table', 4),
(28, '2024_06_24_092630_create_quiz_attempts_table', 4),
(29, '2024_06_24_092658_create_answers_table', 4),
(30, '2024_06_24_092729_create_user_answers_table', 4),
(31, '2024_06_24_093118_create_tickets_table', 4),
(32, '2024_06_24_093153_create_ticket_has_comments_table', 4),
(33, '2024_06_24_101505_create_user_education_table', 5),
(34, '2024_06_24_092502_create_quizzes_table', 6),
(35, '2024_06_24_092503_create_quizzes_table', 7),
(36, '2024_06_24_092504_create_quizzes_table', 8),
(37, '2024_06_24_092659_create_answers_table', 9),
(38, '2024_06_24_101506_create_user_education_table', 10),
(39, '2024_07_04_160106_create_points_table', 11),
(40, '2024_07_05_015552_create_point_settings_table', 11),
(41, '2024_06_24_083038_create_materials_table', 12),
(42, '2024_07_04_160107_create_points_table', 12),
(43, '2024_07_07_144058_add_soft_deletes_and_is_active_to_classroom_course_table', 12),
(44, '2024_07_07_152332_add_points_to_medals_table', 12),
(45, '2024_07_08_013639_create_projects_table', 12),
(46, '2024_07_08_020257_create_challenges_table', 12),
(47, '2024_07_08_031056_create_tasks_table', 12),
(48, '2024_07_13_071104_create_user_material_statuses_table', 13),
(49, '2024_07_19_024230_add_pdf_link_to_materials_table', 13),
(50, '2024_07_23_063236_add_is_code_to_materials_table', 14),
(51, '2024_09_02_121816_create_course_reviews_table', 15),
(52, '2024_09_06_171731_add_link_to_user_assignment_statuses_table', 16),
(53, '2024_09_09_105628_create_project_submissions_table', 17),
(54, '2024_09_10_161954_change_completed_at_to_status_in_user_assignment_statuses_table', 18),
(55, '2024_09_10_163240_add_status_and_notes_to_user_assignment_statuses_table', 19),
(56, '2024_09_10_232628_create_images_table', 20),
(57, '2024_09_11_003947_add_avatar_to_users_table', 20),
(58, '2024_09_15_084418_create_course_teacher_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', '1'),
(3, 'App\\Models\\User', '9c5c9af6-89b9-459e-9908-5c5d026e2bff'),
(3, 'App\\Models\\User', '9cf0f873-7e1d-4441-a016-798fec863bef'),
(3, 'App\\Models\\User', '9cf0f889-a795-4d13-a51e-9489e981a980'),
(4, 'App\\Models\\User', '9c5e84c3-cd06-4309-8a45-bf82108e5e41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period_name` varchar(255) NOT NULL,
  `period_start` datetime NOT NULL,
  `period_end` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `period_name`, `period_start`, `period_end`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2024', '2024-01-01 00:00:00', '2024-12-31 00:00:00', NULL, '2024-07-01 00:31:50', '2024-07-02 03:20:15'),
(2, '2024 - End', '2024-07-02 00:00:00', '2024-07-18 00:00:00', NULL, '2024-07-02 03:04:54', '2024-07-02 03:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(2, 'view_any_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(3, 'create_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(4, 'update_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(5, 'delete_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(6, 'delete_any_role', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(7, 'view_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(8, 'view_any_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(9, 'create_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(10, 'update_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(11, 'restore_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(12, 'restore_any_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(13, 'replicate_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(14, 'reorder_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(15, 'delete_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(16, 'delete_any_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(17, 'force_delete_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(18, 'force_delete_any_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(19, 'view_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(20, 'view_any_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(21, 'create_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(22, 'update_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(23, 'restore_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(24, 'restore_any_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(25, 'replicate_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(26, 'reorder_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(27, 'delete_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(28, 'delete_any_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(29, 'force_delete_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(30, 'force_delete_any_badge', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(31, 'view_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(32, 'view_any_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(33, 'create_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(34, 'update_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(35, 'restore_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(36, 'restore_any_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(37, 'replicate_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(38, 'reorder_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(39, 'delete_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(40, 'delete_any_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(41, 'force_delete_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(42, 'force_delete_any_chapter', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(43, 'view_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(44, 'view_any_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(45, 'create_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(46, 'update_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(47, 'restore_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(48, 'restore_any_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(49, 'replicate_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(50, 'reorder_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(51, 'delete_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(52, 'delete_any_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(53, 'force_delete_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(54, 'force_delete_any_classroom', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(55, 'view_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(56, 'view_any_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(57, 'create_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(58, 'update_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(59, 'restore_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(60, 'restore_any_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(61, 'replicate_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(62, 'reorder_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(63, 'delete_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(64, 'delete_any_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(65, 'force_delete_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(66, 'force_delete_any_course', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(67, 'view_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(68, 'view_any_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(69, 'create_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(70, 'update_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(71, 'restore_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(72, 'restore_any_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(73, 'replicate_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(74, 'reorder_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(75, 'delete_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(76, 'delete_any_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(77, 'force_delete_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(78, 'force_delete_any_department', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(79, 'view_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(80, 'view_any_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(81, 'create_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(82, 'update_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(83, 'restore_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(84, 'restore_any_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(85, 'replicate_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(86, 'reorder_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(87, 'delete_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(88, 'delete_any_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(89, 'force_delete_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(90, 'force_delete_any_material', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(91, 'view_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(92, 'view_any_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(93, 'create_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(94, 'update_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(95, 'restore_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(96, 'restore_any_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(97, 'replicate_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(98, 'reorder_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(99, 'delete_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(100, 'delete_any_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(101, 'force_delete_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(102, 'force_delete_any_medal', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(103, 'view_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(104, 'view_any_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(105, 'create_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(106, 'update_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(107, 'restore_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(108, 'restore_any_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(109, 'replicate_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(110, 'reorder_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(111, 'delete_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(112, 'delete_any_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(113, 'force_delete_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(114, 'force_delete_any_period', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(115, 'view_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(116, 'view_any_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(117, 'create_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(118, 'update_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(119, 'restore_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(120, 'restore_any_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(121, 'replicate_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(122, 'reorder_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(123, 'delete_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(124, 'delete_any_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(125, 'force_delete_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(126, 'force_delete_any_question', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(127, 'view_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(128, 'view_any_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(129, 'create_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(130, 'update_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(131, 'restore_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(132, 'restore_any_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(133, 'replicate_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(134, 'reorder_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(135, 'delete_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(136, 'delete_any_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(137, 'force_delete_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(138, 'force_delete_any_quiz', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(139, 'view_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(140, 'view_any_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(141, 'create_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(142, 'update_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(143, 'restore_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(144, 'restore_any_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(145, 'replicate_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(146, 'reorder_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(147, 'delete_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(148, 'delete_any_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(149, 'force_delete_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(150, 'force_delete_any_semester', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(151, 'view_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(152, 'view_any_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(153, 'create_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(154, 'update_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(155, 'restore_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(156, 'restore_any_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(157, 'replicate_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(158, 'reorder_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(159, 'delete_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(160, 'delete_any_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(161, 'force_delete_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(162, 'force_delete_any_ticket', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(163, 'view_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(164, 'view_any_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(165, 'create_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(166, 'update_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(167, 'restore_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(168, 'restore_any_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(169, 'replicate_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(170, 'reorder_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(171, 'delete_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(172, 'delete_any_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(173, 'force_delete_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(174, 'force_delete_any_user::education', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(175, 'view_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(176, 'view_any_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(177, 'create_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(178, 'update_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(179, 'restore_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(180, 'restore_any_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(181, 'replicate_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(182, 'reorder_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(183, 'delete_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(184, 'delete_any_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(185, 'force_delete_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(186, 'force_delete_any_user::information', 'web', '2024-07-01 04:03:34', '2024-07-01 04:03:34'),
(187, 'view_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(188, 'view_any_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(189, 'create_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(190, 'update_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(191, 'restore_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(192, 'restore_any_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(193, 'replicate_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(194, 'reorder_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(195, 'delete_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(196, 'delete_any_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(197, 'force_delete_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(198, 'force_delete_any_assignment', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(199, 'view_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(200, 'view_any_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(201, 'create_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(202, 'update_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(203, 'restore_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(204, 'restore_any_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(205, 'replicate_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(206, 'reorder_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(207, 'delete_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(208, 'delete_any_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(209, 'force_delete_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(210, 'force_delete_any_point', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(211, 'view_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(212, 'view_any_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(213, 'create_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(214, 'update_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(215, 'restore_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(216, 'restore_any_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(217, 'replicate_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(218, 'reorder_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(219, 'delete_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(220, 'delete_any_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(221, 'force_delete_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(222, 'force_delete_any_point::setting', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(223, 'widget_StatsOverview', 'web', '2024-07-05 01:54:17', '2024-07-05 01:54:17'),
(224, 'view_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(225, 'view_any_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(226, 'create_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(227, 'update_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(228, 'restore_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(229, 'restore_any_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(230, 'replicate_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(231, 'reorder_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(232, 'delete_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(233, 'delete_any_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(234, 'force_delete_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(235, 'force_delete_any_project', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(236, 'view_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(237, 'view_any_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(238, 'create_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(239, 'update_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(240, 'restore_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(241, 'restore_any_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(242, 'replicate_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(243, 'reorder_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(244, 'delete_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(245, 'delete_any_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(246, 'force_delete_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30'),
(247, 'force_delete_any_task', 'web', '2024-07-08 01:50:30', '2024-07-08 01:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `points` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quiz_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `user_id`, `points`, `reason`, `created_at`, `updated_at`, `quiz_id`, `course_id`) VALUES
(1, '9cf0f873-7e1d-4441-a016-798fec863bef', 150, 'Rajin', '2024-09-06 02:11:37', '2024-09-06 02:11:46', NULL, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43'),
(2, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 20000, 'Rajin', '2024-09-06 02:12:22', '2024-09-06 02:47:10', NULL, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43'),
(3, '9cf0f889-a795-4d13-a51e-9489e981a980', 50, 'Rajin', '2024-09-06 02:12:37', '2024-09-06 02:12:37', NULL, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43'),
(4, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 5000, 'Rajin', '2024-09-06 03:04:22', '2024-09-06 03:04:22', NULL, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43'),
(5, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 20, 'First attempt with score 100', '2024-11-08 07:14:25', '2024-11-08 07:14:25', 2, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43'),
(6, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 5, 'Score below or equal to 80 on quiz', '2024-11-08 07:51:59', '2024-11-08 07:51:59', 1, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43');

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

CREATE TABLE `point_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_slug` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program_name`, `program_slug`, `department_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 'teknik-informatika', 1, NULL, '2024-06-25 00:45:37', '2024-06-25 00:45:37'),
(2, 'Sistem Informasi', 'sistem-informasi', 1, NULL, '2024-06-25 00:49:00', '2024-06-25 00:49:00'),
(3, 'Teknik Rekayasa Komputer', 'teknik-rekayasa-komputer', 1, NULL, '2024-09-04 10:03:29', '2024-09-04 10:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` char(26) NOT NULL,
  `course_id` char(36) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_slug` varchar(255) NOT NULL,
  `project_publish` tinyint(1) NOT NULL DEFAULT 0,
  `project_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `course_id`, `project_name`, `project_description`, `project_slug`, `project_publish`, `project_photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
('01j7ddm0b1zq0vg94cxe08rpk1', '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', 'Tugas Akhir', '<p>aaa</p>', 'tugas-akhir', 1, '01J7DDM0ANTXCHE1ZKD7XFD63P.png', '2024-09-10 07:33:25', '2024-09-10 07:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_submission`
--

CREATE TABLE `project_submission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `project_id` char(26) NOT NULL,
  `submission_link` varchar(255) NOT NULL,
  `submission_notes` text DEFAULT NULL,
  `submission_score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `question_image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `question_image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Siapa anak ini?', '01J20X6NE8SYYD5ANMR90NWA8S.jpg', NULL, '2024-06-28 04:18:10', '2024-07-05 00:37:09'),
(2, 2, 'Laboriosam reprehenderit cumque aute quasi enim sint est et laudantium et vel adipisicing', '01J210WT66TE1KDCQZNWA7ZDTX.png', NULL, '2024-07-05 01:41:40', '2024-07-05 01:42:35'),
(3, 1, 'Tes Soal', '01J5SZXRXMVGNW40R0CSJQXY26.svg', NULL, '2024-08-21 08:12:49', '2024-08-21 08:12:49'),
(4, 1, 'soal ke 3 ', '01J5SZYBCZTHYWQH2PP3Q890N2.png', NULL, '2024-08-21 08:13:08', '2024-08-21 08:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` char(36) NOT NULL,
  `chapter_id` char(26) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `chapter_id`, `title`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', '01j179ebpmmgw9d5zcz869ark3', 'Guess Who', '<p>dad</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;ini-harapan-masyarakat-untuk-gubernur-dan-wakil-gubernur-riau-yang-baru.jpg&quot;,&quot;filesize&quot;:64389,&quot;height&quot;:640,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/DQcCY6hgLhj5FfxP8QZqGrWpdxbuzYTdqCFcjX3p.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/DQcCY6hgLhj5FfxP8QZqGrWpdxbuzYTdqCFcjX3p.jpg&quot;,&quot;width&quot;:640}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/DQcCY6hgLhj5FfxP8QZqGrWpdxbuzYTdqCFcjX3p.jpg\"><img src=\"http://127.0.0.1:8000/storage/DQcCY6hgLhj5FfxP8QZqGrWpdxbuzYTdqCFcjX3p.jpg\" width=\"640\" height=\"640\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">ini-harapan-masyarakat-untuk-gubernur-dan-wakil-gubernur-riau-yang-baru.jpg</span> <span class=\"attachment__size\">62.88 KB</span></figcaption></a></figure></p>', NULL, '2024-06-25 04:37:01', '2024-07-23 08:34:28'),
(2, '9c5eaf01-19b3-4f7d-ab17-4739d070ff43', '01j210pa9ajx4ya4r5ryt60mv2', 'RPL Dasar', NULL, NULL, '2024-07-05 01:41:20', '2024-07-23 08:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `quiz_id`, `started_at`, `completed_at`, `score`, `created_at`, `updated_at`) VALUES
(48, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 2, NULL, '2024-11-08 07:15:25', 100, '2024-11-08 07:14:25', '2024-11-08 07:14:25'),
(49, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 1, NULL, '2024-11-08 07:51:59', 33, '2024-11-08 07:51:55', '2024-11-08 07:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `review_chapters`
--

CREATE TABLE `review_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `chapter_id` char(36) NOT NULL,
  `rating` decimal(5,2) NOT NULL,
  `comment` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(2, 'panel_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(3, 'student_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51'),
(4, 'teacher_user', 'web', '2024-06-23 23:34:51', '2024-06-23 23:34:51');

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
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 4),
(8, 1),
(8, 4),
(9, 1),
(9, 4),
(10, 1),
(10, 4),
(11, 1),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(14, 1),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 4),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(20, 4),
(21, 1),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(26, 4),
(27, 1),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 4),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(33, 1),
(33, 4),
(34, 1),
(34, 4),
(35, 1),
(35, 4),
(36, 1),
(36, 4),
(37, 1),
(37, 4),
(38, 1),
(38, 4),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 1),
(46, 4),
(47, 1),
(47, 4),
(48, 1),
(48, 4),
(49, 1),
(49, 4),
(50, 1),
(50, 4),
(51, 1),
(51, 4),
(52, 1),
(52, 4),
(53, 1),
(53, 4),
(54, 1),
(54, 4),
(55, 1),
(55, 4),
(56, 1),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 4),
(61, 1),
(61, 4),
(62, 1),
(62, 4),
(63, 1),
(63, 4),
(64, 1),
(64, 4),
(65, 1),
(65, 4),
(66, 1),
(66, 4),
(67, 1),
(67, 4),
(68, 1),
(68, 4),
(69, 1),
(69, 4),
(70, 1),
(70, 4),
(71, 1),
(71, 4),
(72, 1),
(72, 4),
(73, 1),
(73, 4),
(74, 1),
(74, 4),
(75, 1),
(75, 4),
(76, 1),
(76, 4),
(77, 1),
(77, 4),
(78, 1),
(78, 4),
(79, 1),
(79, 4),
(80, 1),
(80, 4),
(81, 1),
(81, 4),
(82, 1),
(82, 4),
(83, 1),
(83, 4),
(84, 1),
(84, 4),
(85, 1),
(85, 4),
(86, 1),
(86, 4),
(87, 1),
(87, 4),
(88, 1),
(88, 4),
(89, 1),
(89, 4),
(90, 1),
(90, 4),
(91, 1),
(91, 4),
(92, 1),
(92, 4),
(93, 1),
(93, 4),
(94, 1),
(94, 4),
(95, 1),
(95, 4),
(96, 1),
(96, 4),
(97, 1),
(97, 4),
(98, 1),
(98, 4),
(99, 1),
(99, 4),
(100, 1),
(100, 4),
(101, 1),
(101, 4),
(102, 1),
(102, 4),
(103, 1),
(103, 4),
(104, 1),
(104, 4),
(105, 1),
(105, 4),
(106, 1),
(106, 4),
(107, 1),
(107, 4),
(108, 1),
(108, 4),
(109, 1),
(109, 4),
(110, 1),
(110, 4),
(111, 1),
(111, 4),
(112, 1),
(112, 4),
(113, 1),
(113, 4),
(114, 1),
(114, 4),
(115, 1),
(115, 4),
(116, 1),
(116, 4),
(117, 1),
(117, 4),
(118, 1),
(118, 4),
(119, 1),
(119, 4),
(120, 1),
(120, 4),
(121, 1),
(121, 4),
(122, 1),
(122, 4),
(123, 1),
(123, 4),
(124, 1),
(124, 4),
(125, 1),
(125, 4),
(126, 1),
(126, 4),
(127, 1),
(127, 4),
(128, 1),
(128, 4),
(129, 1),
(129, 4),
(130, 1),
(130, 4),
(131, 1),
(131, 4),
(132, 1),
(132, 4),
(133, 1),
(133, 4),
(134, 1),
(134, 4),
(135, 1),
(135, 4),
(136, 1),
(136, 4),
(137, 1),
(137, 4),
(138, 1),
(138, 4),
(139, 1),
(139, 4),
(140, 1),
(140, 4),
(141, 1),
(141, 4),
(142, 1),
(142, 4),
(143, 1),
(143, 4),
(144, 1),
(144, 4),
(145, 1),
(145, 4),
(146, 1),
(146, 4),
(147, 1),
(147, 4),
(148, 1),
(148, 4),
(149, 1),
(149, 4),
(150, 1),
(150, 4),
(151, 1),
(151, 4),
(152, 1),
(152, 4),
(153, 1),
(153, 4),
(154, 1),
(154, 4),
(155, 1),
(155, 4),
(156, 1),
(156, 4),
(157, 1),
(157, 4),
(158, 1),
(158, 4),
(159, 1),
(159, 4),
(160, 1),
(160, 4),
(161, 1),
(161, 4),
(162, 1),
(162, 4),
(163, 1),
(163, 4),
(164, 1),
(164, 4),
(165, 1),
(165, 4),
(166, 1),
(166, 4),
(167, 1),
(167, 4),
(168, 1),
(168, 4),
(169, 1),
(169, 4),
(170, 1),
(170, 4),
(171, 1),
(171, 4),
(172, 1),
(172, 4),
(173, 1),
(173, 4),
(174, 1),
(174, 4),
(175, 1),
(175, 4),
(176, 1),
(176, 4),
(177, 1),
(177, 4),
(178, 1),
(178, 4),
(179, 1),
(179, 4),
(180, 1),
(180, 4),
(181, 1),
(181, 4),
(182, 1),
(182, 4),
(183, 1),
(183, 4),
(184, 1),
(184, 4),
(185, 1),
(185, 4),
(186, 1),
(186, 4),
(187, 4),
(188, 4),
(189, 4),
(190, 4),
(191, 4),
(192, 4),
(193, 4),
(194, 4),
(195, 4),
(196, 4),
(197, 4),
(198, 4),
(199, 4),
(200, 4),
(201, 4),
(202, 4),
(203, 4),
(204, 4),
(205, 4),
(206, 4),
(207, 4),
(208, 4),
(209, 4),
(210, 4),
(211, 4),
(212, 4),
(213, 4),
(214, 4),
(215, 4),
(216, 4),
(217, 4),
(218, 4),
(219, 4),
(220, 4),
(221, 4),
(222, 4),
(223, 4),
(224, 4),
(225, 4),
(226, 4),
(227, 4),
(228, 4),
(229, 4),
(230, 4),
(231, 4),
(232, 4),
(233, 4),
(234, 4),
(235, 4),
(236, 4),
(237, 4),
(238, 4),
(239, 4),
(240, 4),
(241, 4),
(242, 4),
(243, 4),
(244, 4),
(245, 4),
(246, 4),
(247, 4);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `semester_description` varchar(255) DEFAULT NULL,
  `semester_start` datetime NOT NULL,
  `semester_end` datetime NOT NULL,
  `period_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `semester_description`, `semester_start`, `semester_end`, `period_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Semester 1', '<p>Dolorem rem fugiat o.</p>', '2024-01-02 00:00:00', '2024-06-01 00:00:00', 1, NULL, '2024-07-01 00:32:44', '2024-07-02 03:10:28'),
(2, 'aaa', '<p>aa</p>', '2024-07-03 00:00:00', '2024-07-12 00:00:00', 2, '2024-07-02 03:09:18', '2024-07-02 03:09:11', '2024-07-02 03:09:18'),
(3, 'Semester 2', '<p>s</p>', '2024-06-02 00:00:00', '2024-12-31 00:00:00', 1, NULL, '2024-07-02 03:20:07', '2024-07-02 03:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ExXw1kVqO9NjJMnHPaVgasmVfDUvEHSJXsKmktv6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFd4UXMxWExaRnN0OTRUSTFyb05IRTZacnpRSHdlMFg5dnpRTG5OayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1731398819),
('jiLoCgVghiCnG54LEcbh4sbIPvN5Ohse62Dh31o0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDlxSmtoc3JCalNBcXlkdmR2TXRoOThMT25JRmQ0N1lNZ3lVN05jdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1731398819),
('Z5kySDme5KyKO5kUV4IWTre1FMRQAQIMBj9D0SA4', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM3FnYjhySWxvb0FId0FxSUNMeWVRZlNOM0FCWmExSnYzZ2tLYk9tcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6IjljNWM5YWY2LTg5YjktNDU5ZS05OTA4LTVjNWQwMjZlMmJmZiI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRxMk5qUDBwbk4ucm1BanoxLkVsVG1PY1NFcDlCRDFYVExaT0NabFovcmlxcUNaaFQ5eEc1NiI7fQ==', 1731398760);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` char(26) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `task_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` text NOT NULL DEFAULT 'open',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Help', '<p>aaa</p>', 'open', NULL, '2024-06-30 23:53:06', '2024-07-07 23:58:07', '9c5c9af6-89b9-459e-9908-5c5d026e2bff');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_has_comments`
--

CREATE TABLE `ticket_has_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_has_comments`
--

INSERT INTO `ticket_has_comments` (`id`, `comment`, `ticket_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Coba kamu reload lagi', 1, '1', '2024-07-05 00:32:16', '2024-07-05 00:32:16'),
(2, 'udah coba belum?', 1, '1', '2024-07-05 00:32:25', '2024-07-05 00:32:25'),
(3, 'kok gk kamu coba', 1, '1', '2024-07-05 00:32:30', '2024-07-05 00:32:30'),
(4, 'dadad', 1, '1', '2024-07-05 00:57:36', '2024-07-05 00:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `isActive`, `avatar`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', 'Iqbal Cruise', 'admin@iqbal.com', NULL, '$2y$12$qDL2HXr7YtwFKWZic4FbEuUb4C7t6QHz5xXyrX8irRb60TcZwIQ/y', 1, NULL, 'MuJpadcDFLIW64ay0RaQQr3voiCX05WnADdvrZk0wrs4ePHmPwtPmaY9F93N', NULL, '2024-06-23 23:33:09', '2024-06-23 23:33:09'),
('9c5c9af6-89b9-459e-9908-5c5d026e2bff', 'Student 1', 'student1@iqbal.com', NULL, '$2y$12$q2NjP0pnN.rmAjz1.ElTmOcSEp9BD1XTLZOCZlZ/riqqCZhT9xG56', 1, NULL, NULL, NULL, '2024-06-24 00:51:47', '2024-07-08 01:53:20'),
('9c5e84c3-cd06-4309-8a45-bf82108e5e41', 'Teacher 1', 'teacher@iqbal.com', NULL, '$2y$12$p0NldiDzeBihi7IXWVsB6eP26dfhXd/v2fHTNPJH08pqpo5EDHjhm', 1, NULL, NULL, NULL, '2024-06-24 23:41:22', '2024-06-24 23:41:22'),
('9cf0f873-7e1d-4441-a016-798fec863bef', 'Student-2', 'student2@iqbal.com', NULL, '$2y$12$a7Oh34TeQETvn8qtpvLOYeQBik6RTrDa7zNM4OsHOLoIB/vxB4iTa', 1, NULL, NULL, NULL, '2024-09-06 01:55:44', '2024-09-06 01:55:44'),
('9cf0f889-a795-4d13-a51e-9489e981a980', 'Student-3', 'student3@iqbal.com', NULL, '$2y$12$rF8L.sbchXxpk/4Hkw.tou0wdeDZuSmVKAtonSneGs3qVCSpTCroq', 1, NULL, NULL, NULL, '2024-09-06 01:55:58', '2024-09-06 01:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attempt_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `attempt_id`, `question_id`, `answer_id`, `is_correct`, `created_at`, `updated_at`) VALUES
(73, 48, 2, 3, 1, '2024-11-08 07:14:25', '2024-11-08 07:14:25'),
(74, 49, 1, 2, 0, '2024-11-08 07:51:55', '2024-11-08 07:51:55'),
(75, 49, 3, 8, 0, '2024-11-08 07:51:57', '2024-11-08 07:51:57'),
(76, 49, 4, 5, 1, '2024-11-08 07:51:59', '2024-11-08 07:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_assignment_statuses`
--

CREATE TABLE `user_assignment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `score` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_assignment_statuses`
--

INSERT INTO `user_assignment_statuses` (`id`, `assignment_id`, `user_id`, `status`, `notes`, `is_completed`, `score`, `deleted_at`, `created_at`, `updated_at`, `link`) VALUES
(6, '9cf16f7b-f53d-4c5d-9782-8f7bd49884f3', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', NULL, NULL, 0, NULL, NULL, '2024-09-10 09:07:47', '2024-09-10 09:07:47', 'https://www.youtube.com/@lacodeprogramming7319');

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `badge_id` bigint(20) UNSIGNED NOT NULL,
  `awarded_date` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_badges`
--

INSERT INTO `user_badges` (`id`, `user_id`, `badge_id`, `awarded_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 2, '2024-07-17 00:00:00', NULL, '2024-07-02 03:38:11', '2024-07-02 03:38:11'),
(2, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 2, '2024-07-04 00:00:00', NULL, '2024-07-02 03:38:35', '2024-07-02 03:38:35'),
(3, '9c5e84c3-cd06-4309-8a45-bf82108e5e41', 2, '2024-07-05 00:00:00', NULL, '2024-07-05 01:43:55', '2024-07-05 01:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE `user_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `student_id_number` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_year` varchar(255) NOT NULL,
  `class_alphabet` varchar(255) DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_education`
--

INSERT INTO `user_education` (`id`, `user_id`, `student_id_number`, `department_id`, `program_id`, `enrollment_year`, `class_alphabet`, `semester_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '1455301035', 1, 1, '2014', 'A', 1, NULL, '2024-07-01 03:34:25', '2024-07-08 01:56:38'),
(2, '9c5e84c3-cd06-4309-8a45-bf82108e5e41', '975', 1, 1, '2014', 'A', 1, NULL, '2024-07-01 04:47:09', '2024-07-01 04:52:50'),
(3, '9cf0f889-a795-4d13-a51e-9489e981a980', '226', 1, 1, '2014', 'A', 1, NULL, '2024-09-06 01:57:30', '2024-09-06 01:57:30'),
(4, '9cf0f873-7e1d-4441-a016-798fec863bef', '1651891891', 1, 1, '2014', 'A', 1, NULL, '2024-09-06 01:57:45', '2024-09-06 01:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `current_address` varchar(255) NOT NULL,
  `hometown_address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `user_id` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `phone_number`, `gender`, `birth_date`, `birth_place`, `current_address`, `hometown_address`, `province`, `city`, `postal_code`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '081261151717', 'Male', '1996-07-30', 'Pekanbaru', 'Rumbai', 'Pekanbaru', 'Riau', 'Pekanbaru', '28292', '1', NULL, '2024-06-30 23:23:34', '2024-06-30 23:23:34'),
(2, '8888888888', 'Male', '2024-09-06', 'Wakatobi', 'PCR', 'Wakatobi', 'Sulawesi Tenggara', 'Wakatobi', '97532', '9cf0f873-7e1d-4441-a016-798fec863bef', NULL, '2024-09-06 07:02:21', '2024-09-06 07:02:21'),
(3, '081234567091', 'Female', '2024-09-06', 'Bumi', 'Jalan Umban Sari', 'Jalan Umban Sari', 'Riau', 'Pekanbaru', '28133', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', NULL, '2024-09-06 07:02:56', '2024-09-06 07:02:56'),
(5, '1111111', 'Male', '2024-09-06', 'Wakatobi', 'PCR', 'Rumbai', 'Riau', 'Rumbai', '28721', '9cf0f873-7e1d-4441-a016-798fec863bef', NULL, '2024-09-06 07:03:35', '2024-09-06 07:03:35'),
(6, '081234567091', 'Female', '2024-09-03', 'Bumi', 'Jalan', 'Jalan', 'Riau', 'Pekanbaru', '28133', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', NULL, '2024-09-06 07:03:47', '2024-09-06 07:03:47'),
(7, '081234567099', 'Male', '2024-09-07', 'Bumi', 'Jaalan', 'Jaalan', 'Riau', 'Pekanbaru', '28133', '9c5c9af6-89b9-459e-9908-5c5d026e2bff', NULL, '2024-09-06 07:04:16', '2024-09-06 07:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_material_statuses`
--

CREATE TABLE `user_material_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `material_id` char(26) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_material_statuses`
--

INSERT INTO `user_material_statuses` (`id`, `user_id`, `material_id`, `is_completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(60, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '01j359dk5x1vf3g52nmgz5zx34', 1, '2024-08-22 10:34:07', '2024-08-22 10:34:07', '2024-08-22 10:34:07'),
(61, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '01j3f5s0aadcxh034x60rfshww', 1, '2024-08-22 10:35:09', '2024-08-22 10:34:09', '2024-08-22 10:35:37'),
(65, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '01j34y5p83j19bm49fn78qjhf2', 1, '2024-08-29 07:56:59', '2024-08-29 07:55:59', '2024-08-29 07:59:00'),
(83, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '01j35180a5fgtqjm5m9j396enc', 1, '2024-08-30 08:57:39', '2024-08-30 08:56:39', '2024-08-30 09:03:14'),
(84, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', '01j6ejyw9xk5nn8zw3v469s9ca', 0, '2024-08-30 09:04:14', '2024-08-30 09:03:14', '2024-08-30 09:03:14'),
(85, '9cf0f873-7e1d-4441-a016-798fec863bef', '01j359dk5x1vf3g52nmgz5zx34', 1, '2024-09-06 06:59:06', '2024-09-06 06:59:06', '2024-09-06 06:59:06'),
(86, '9cf0f873-7e1d-4441-a016-798fec863bef', '01j3f5s0aadcxh034x60rfshww', 1, '2024-09-06 07:00:06', '2024-09-06 06:59:06', '2024-09-06 08:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_medals`
--

CREATE TABLE `user_medals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` char(36) NOT NULL,
  `medal_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_medals`
--

INSERT INTO `user_medals` (`id`, `user_id`, `medal_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '9c5c9af6-89b9-459e-9908-5c5d026e2bff', 1, NULL, '2024-07-02 03:45:04', '2024-07-02 03:45:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `challenges_challenge_slug_unique` (`challenge_slug`),
  ADD KEY `challenges_course_id_foreign` (`course_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_course_id_foreign` (`course_id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classrooms_class_code_unique` (`class_code`),
  ADD KEY `classrooms_program_id_foreign` (`program_id`);

--
-- Indexes for table `classroom_course`
--
ALTER TABLE `classroom_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_course_classroom_id_foreign` (`classroom_id`),
  ADD KEY `classroom_course_course_id_foreign` (`course_id`);

--
-- Indexes for table `classroom_users`
--
ALTER TABLE `classroom_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_users_classroom_id_foreign` (`classroom_id`),
  ADD KEY `classroom_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_completion_rewards`
--
ALTER TABLE `course_completion_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_completion_rewards_user_id_foreign` (`user_id`),
  ADD KEY `course_completion_rewards_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_reviews_user_id_foreign` (`user_id`),
  ADD KEY `course_reviews_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_teacher_course_id_foreign` (`course_id`),
  ADD KEY `course_teacher_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `medals`
--
ALTER TABLE `medals`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_user_id_foreign` (`user_id`),
  ADD KEY `points_quiz_id_foreign` (`quiz_id`),
  ADD KEY `points_course_id_foreign` (`course_id`);

--
-- Indexes for table `point_settings`
--
ALTER TABLE `point_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_department_id_foreign` (`department_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_project_slug_unique` (`project_slug`),
  ADD KEY `projects_course_id_foreign` (`course_id`);

--
-- Indexes for table `project_submission`
--
ALTER TABLE `project_submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_submission_user_id_foreign` (`user_id`),
  ADD KEY `project_submission_project_id_foreign` (`project_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_course_id_foreign` (`course_id`),
  ADD KEY `quizzes_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempts_user_id_foreign` (`user_id`),
  ADD KEY `quiz_attempts_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `review_chapters`
--
ALTER TABLE `review_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_chapters_user_id_foreign` (`user_id`),
  ADD KEY `review_chapters_chapter_id_foreign` (`chapter_id`);

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
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesters_period_id_foreign` (`period_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_challenge_id_foreign` (`challenge_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_has_comments`
--
ALTER TABLE `ticket_has_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_has_comments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_has_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_attempt_id_foreign` (`attempt_id`),
  ADD KEY `user_answers_question_id_foreign` (`question_id`),
  ADD KEY `user_answers_answer_id_foreign` (`answer_id`);

--
-- Indexes for table `user_assignment_statuses`
--
ALTER TABLE `user_assignment_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_assignment_statuses_assignment_id_foreign` (`assignment_id`),
  ADD KEY `user_assignment_statuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_badges_user_id_foreign` (`user_id`),
  ADD KEY `user_badges_badge_id_foreign` (`badge_id`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_education_user_id_foreign` (`user_id`),
  ADD KEY `user_education_department_id_foreign` (`department_id`),
  ADD KEY `user_education_program_id_foreign` (`program_id`),
  ADD KEY `user_education_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_information_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_material_statuses`
--
ALTER TABLE `user_material_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_material_statuses_user_id_foreign` (`user_id`),
  ADD KEY `user_material_statuses_material_id_foreign` (`material_id`);

--
-- Indexes for table `user_medals`
--
ALTER TABLE `user_medals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_medals_user_id_foreign` (`user_id`),
  ADD KEY `user_medals_medal_id_foreign` (`medal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classroom_course`
--
ALTER TABLE `classroom_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classroom_users`
--
ALTER TABLE `classroom_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `course_completion_rewards`
--
ALTER TABLE `course_completion_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_teacher`
--
ALTER TABLE `course_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medals`
--
ALTER TABLE `medals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `point_settings`
--
ALTER TABLE `point_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_submission`
--
ALTER TABLE `project_submission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `review_chapters`
--
ALTER TABLE `review_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_has_comments`
--
ALTER TABLE `ticket_has_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_assignment_statuses`
--
ALTER TABLE `user_assignment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_education`
--
ALTER TABLE `user_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_material_statuses`
--
ALTER TABLE `user_material_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user_medals`
--
ALTER TABLE `user_medals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `challenges_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classroom_course`
--
ALTER TABLE `classroom_course`
  ADD CONSTRAINT `classroom_course_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classroom_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classroom_users`
--
ALTER TABLE `classroom_users`
  ADD CONSTRAINT `classroom_users_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classroom_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_completion_rewards`
--
ALTER TABLE `course_completion_rewards`
  ADD CONSTRAINT `course_completion_rewards_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_completion_rewards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD CONSTRAINT `course_teacher_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `points_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_submission`
--
ALTER TABLE `project_submission`
  ADD CONSTRAINT `project_submission_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_submission_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_chapters`
--
ALTER TABLE `review_chapters`
  ADD CONSTRAINT `review_chapters_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_chapters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_challenge_id_foreign` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_has_comments`
--
ALTER TABLE `ticket_has_comments`
  ADD CONSTRAINT `ticket_has_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_has_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_attempt_id_foreign` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_assignment_statuses`
--
ALTER TABLE `user_assignment_statuses`
  ADD CONSTRAINT `user_assignment_statuses_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_assignment_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_badges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_education`
--
ALTER TABLE `user_education`
  ADD CONSTRAINT `user_education_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_education_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `user_information_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_material_statuses`
--
ALTER TABLE `user_material_statuses`
  ADD CONSTRAINT `user_material_statuses_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_material_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_medals`
--
ALTER TABLE `user_medals`
  ADD CONSTRAINT `user_medals_medal_id_foreign` FOREIGN KEY (`medal_id`) REFERENCES `medals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_medals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
