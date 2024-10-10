-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 10, 2024 at 02:49 AM
-- Server version: 5.7.33
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skrining`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_skrinings`
--

CREATE TABLE `detail_skrinings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skrining_id` bigint(20) UNSIGNED NOT NULL,
  `penyakit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_skrinings`
--

INSERT INTO `detail_skrinings` (`id`, `skrining_id`, `penyakit_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022-06-24 02:17:13', '2022-06-24 02:17:13');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `unit_id`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'A', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(2, 1, 'B', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(3, 2, 'A', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(4, 2, 'B', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(5, 3, 'A', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(6, 3, 'B', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(7, 3, 'c', '2022-06-24 02:42:28', '2022-06-24 02:43:08', '2022-06-24 02:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2022-06-24 01:37:37', '2022-06-24 01:37:37', NULL),
(2, 'Siswa', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(3, 'Guru', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(4, 'Satgas', '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(5, 'Litbang', '2022-06-24 01:37:39', '2022-06-24 01:37:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level_menus`
--

CREATE TABLE `level_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level_menus`
--

INSERT INTO `level_menus` (`id`, `level_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 1, 17, NULL, NULL),
(18, 1, 18, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 22, NULL, NULL),
(23, 1, 23, NULL, NULL),
(24, 1, 24, NULL, NULL),
(25, 1, 25, NULL, NULL),
(26, 1, 26, NULL, NULL),
(27, 1, 27, NULL, NULL),
(28, 1, 28, NULL, NULL),
(29, 1, 29, NULL, NULL),
(30, 1, 30, NULL, NULL),
(31, 1, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksi_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `nama_menu`, `aksi_menu`, `created_at`, `updated_at`) VALUES
(1, 'Level', 'Lihat', NULL, NULL),
(2, 'Level', 'Tambah', NULL, NULL),
(3, 'Level', 'Ubah', NULL, NULL),
(4, 'Level', 'Hapus', NULL, NULL),
(5, 'Staff', 'Lihat', NULL, NULL),
(6, 'Staff', 'Tambah', NULL, NULL),
(7, 'Staff', 'Ubah', NULL, NULL),
(8, 'Staff', 'Hapus', NULL, NULL),
(9, 'Siswa', 'Lihat', NULL, NULL),
(10, 'Siswa', 'Tambah', NULL, NULL),
(11, 'Siswa', 'Ubah', NULL, NULL),
(12, 'Siswa', 'Hapus', NULL, NULL),
(13, 'Kelas', 'Lihat', NULL, NULL),
(14, 'Kelas', 'Tambah', NULL, NULL),
(15, 'Kelas', 'Ubah', NULL, NULL),
(16, 'Kelas', 'Hapus', NULL, NULL),
(17, 'Unit', 'Lihat', NULL, NULL),
(18, 'Unit', 'Tambah', NULL, NULL),
(19, 'Unit', 'Ubah', NULL, NULL),
(20, 'Unit', 'Hapus', NULL, NULL),
(21, 'Penyakit', 'Lihat', NULL, NULL),
(22, 'Penyakit', 'Tambah', NULL, NULL),
(23, 'Penyakit', 'Ubah', NULL, NULL),
(24, 'Penyakit', 'Hapus', NULL, NULL),
(25, 'Skrining', 'Lihat', NULL, NULL),
(26, 'Skrining', 'Tambah', NULL, NULL),
(27, 'Skrining', 'Ubah', NULL, NULL),
(28, 'Skrining', 'Hapus', NULL, NULL),
(29, 'Pengaturan', 'Lihat', NULL, NULL),
(30, 'Pengaturan', 'Ubah', NULL, NULL),
(31, 'Laporan', 'Lihat', NULL, NULL);

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_08_13_033514_create_levels_table', 1),
(5, '2021_08_13_033527_create_menus_table', 1),
(6, '2021_08_13_033536_create_level_menus_table', 1),
(7, '2021_08_14_033512_create_units_table', 1),
(8, '2021_08_14_033513_create_kelas_table', 1),
(9, '2022_05_09_034634_create_staff_table', 1),
(10, '2022_05_09_043344_create_siswas_table', 1),
(11, '2022_05_22_111701_create_penyakits_table', 1),
(12, '2022_05_22_115151_create_pengaturans_table', 1),
(13, '2022_06_05_142059_create_skrinings_table', 1),
(14, '2022_06_05_144125_create_detail_skrinings_table', 1),
(15, '2022_06_11_144826_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturans`
--

CREATE TABLE `pengaturans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pengaturan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturans`
--

INSERT INTO `pengaturans` (`id`, `nama_pengaturan`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Berapa Point Yang Menentukan Siswa Sakit (tidak perlu ke sekolah) ?', '100', NULL, NULL),
(2, 'Pengisian Data Skrining Setiap Hari Apa ? (Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday)', 'Friday', NULL, NULL),
(3, 'Pengisian data skrining dimulai dari jam ?', '05:00-17:00', NULL, '2022-06-24 02:11:01'),
(4, 'Setelah mengisi data skrining, tidak dapat mengisi data kembali hingga ... jam berikutnya ?', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penyakits`
--

CREATE TABLE `penyakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakits`
--

INSERT INTO `penyakits` (`id`, `nama_penyakit`, `point`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apakah anda mengalami demam dalam seminggu terakhir ?', 20, NULL, NULL, NULL),
(2, 'Apakah anda mengalami flu dalam seminggu terakhir ?', 20, NULL, NULL, NULL),
(3, 'Apakah anda tidak dapat mencium bau dalam seminggu terakhir ?', 30, NULL, NULL, NULL),
(4, 'Apakah anda mengalami gejala sesak nafas ?', 30, NULL, NULL, NULL),
(5, 'Apakah akhir-akhir ini anda sering merasa cepat kelelahan ?', 10, NULL, NULL, NULL),
(6, 'Apakah seminggu terakhir ini anda merasakan gejala batuk dan pilek ?', 25, NULL, NULL, NULL),
(7, 'Apakah anda mengalami diare akhir akhir ini ?', 15, NULL, NULL, NULL),
(8, 'Dalam beberapa hari terakhir, apakah anda kehilangan nafsu makan ?', 15, NULL, NULL, NULL),
(9, 'Apakah beberapa hari terakhir ini anda merasa kurang sehat?', 20, NULL, NULL, NULL),
(10, 'Apakah Dalam Seminggu Terakhir Anda Mengalami Gejala Flu?', 20, NULL, NULL, NULL);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('pria','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_induk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `level_id`, `kelas_id`, `nama`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `nomor_induk`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'siswa', '2022-10-22', 'pria', '6283153596240', '435', '$2y$10$59Atva9PisY2JNo3Lqo1d.DFzLKuTdgTUoPPsJpA/3nZjqsEjauiS', NULL, '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(2, 2, 3, 'Mona Kautzer', '2015-01-28 07:22:16', 'pria', '458-409-9364', '454', '$2y$10$PrAGABLlTV3/vqVOqQG8nuVVoVmHLhQQ4Zk4uEYg12Oxz6WpoOcRW', 'xkKBpB7m41', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(3, 2, 5, 'Rebecca Pfannerstill', '1986-09-30 04:34:50', 'pria', '+1.843.626.4270', '449', '$2y$10$KJoAbzPl5SAtXV1vnbrBC.RHf.ojPYYQBZjZvY5k7s1mzvM/Qcjwi', '59GaxVaSfu', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(4, 2, 3, 'Celine Botsford', '2021-05-16 19:03:32', 'pria', '1-346-382-4803', '461', '$2y$10$xsockBflnViI3Z80PuVFl.qGgYxX9.obR6Zb6102M.oEuI/3gUF4.', 'sYzozILthi', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(5, 2, 4, 'Dr. Reba Nader', '2008-05-20 21:30:59', 'perempuan', '+1.352.938.9433', '480', '$2y$10$6zsoQWEYH8MyVdstlB4OJuDZ3A7VeUgCSO0XqVCxrRz3mquAHK3Vm', 'pXCG6oRmKu', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(6, 2, 1, 'Letha Will', '1974-05-29 11:22:58', 'pria', '+1 (423) 995-2932', '453', '$2y$10$7/oUN9WN4eYcDH1Vwbc2Ce9FNXP3yyqvhzRiX6HZV5GITZA2mhC5.', 'kq9figqE7k', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(7, 2, 3, 'Miss Oma Kub Sr.', '1982-03-22 05:45:42', 'pria', '(408) 255-9510', '450', '$2y$10$CAD8aN7YoC4P6vI.UPBRiuU18hBA8J7qqDkgU6uLhlb4B3qYZIf/2', 'akbanktdDx', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(8, 2, 1, 'Mrs. Eulah Von', '2016-05-01 09:17:22', 'perempuan', '1-412-780-2515', '496', '$2y$10$UFxBTHhKiOy97d/koodUsuDLFOiVacHrWUcF3g9ga20suPwKoQsi6', 'OMjWIkJsNg', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(9, 2, 3, 'Amira Corkery', '1999-10-18 14:11:59', 'pria', '+1-646-222-1580', '452', '$2y$10$8iEMoV2x.vBD6DVaD2S.eOTetmKr7eGXcP5wM31mwamTZzCAxtutO', 'trlRNGst8G', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(10, 2, 6, 'Ms. Irma Lesch', '1990-03-25 11:17:23', 'perempuan', '+17693226092', '446', '$2y$10$DMFYG7oBZHni4oQSbUHfjeILbpxCjn1GNlGHWvYYFZEcKrriOHJtC', 'lFQ7VR8FHn', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(11, 2, 3, 'Dr. Dan Langosh', '1997-10-30 21:54:36', 'perempuan', '423.743.5914', '477', '$2y$10$YidWBzy9j54QBf/kbbzzUeL/BlqUjqDn3m1W5syC9aGvvLhiEGEfG', 'hSvfkcPlhQ', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(12, 2, 2, 'Dr. Pablo Mayert MD', '2011-07-08 08:27:48', 'perempuan', '283.653.3744', '475', '$2y$10$wQVmStsASLUyFnj5vmlB8e.savlqe3VLSipn0tC.WZMHk/vG8LxP6', 'HMjin0lZak', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(13, 2, 5, 'Baby Will', '1977-12-14 01:47:38', 'pria', '+1-364-388-9513', '500', '$2y$10$vLfmuVQPr9KSrqw.xaqHJOF3TIaYrmDbeVm770p8QoRdBHKBdyBLK', '3qohtVnteQ', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(14, 2, 4, 'Anais Bernier', '1994-08-23 07:27:00', 'pria', '+1-520-345-7810', '473', '$2y$10$GnYtijD73mi3NBL0iTocnuFudJ8RwUlHnHqruUpSjgUkv2czlLWFa', '7YJIMNrJsT', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(15, 2, 5, 'Camilla Berge II', '1975-10-08 05:47:05', 'perempuan', '+1-838-337-8425', '437', '$2y$10$5Km0yxmbC1h2k/wU/gusUOQR8VowyM0Im34eSO.SnAkTTR6NHkrty', 'T82mrtJnJb', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(16, 2, 1, 'Alec Conn', '1982-11-22 13:58:27', 'pria', '+12816443365', '484', '$2y$10$JQuNTi4tYbTXKxytXhZo1uJQTLtTJTLpoBadJnU6G/vojkztYhU4e', 'lfS23rLyGO', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(17, 2, 2, 'Rafael Halvorson PhD', '1977-10-03 04:31:06', 'perempuan', '+1.757.989.4001', '485', '$2y$10$4uy/ZtcGI4MQ0W5wFaDLD..XUAq5SCgGRxXRf2.8epBiOflndWM2i', '0miapIc3cs', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(18, 2, 2, 'Mrs. Amina Littel MD', '2003-08-29 23:29:57', 'perempuan', '+1-731-781-0039', '469', '$2y$10$qXN3xc1Nye1MkFu5qeNFX.pBiJnHH3VQobjzS1Ui5q4IE0U27Vc7W', 'WcwKAXp8K6', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(19, 2, 2, 'Kole Jast', '2020-04-11 16:52:21', 'pria', '+1-940-294-5950', '483', '$2y$10$MVtsacw5aqYs0Gj156Xw..XYHYUClC4Yeprla3lBVLZ4SU4atOZCi', 'LutBl8Kms9', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(20, 2, 5, 'Prof. Liam Satterfield DDS', '2000-03-22 17:51:50', 'pria', '+1.413.670.6948', '466', '$2y$10$.AXCvIw6cC7RyXFAg592rebOaZwMZyxU21PfMCnA0ndbYoRFss.Hi', 'YmYaMf3gAv', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(21, 2, 1, 'Alyson Batz', '2019-12-16 15:41:02', 'pria', '+1-254-579-4141', '436', '$2y$10$vKTfN0h/D7Itsq55UrbWSeqkuXAqfd2rEoa.pBSCljvvD4T/bvfNm', 'w2nTOOUHFQ', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(22, 2, 2, 'Mr. Toney Rohan', '1997-08-30 07:34:03', 'pria', '+1 (585) 901-2348', '472', '$2y$10$rRixaw1FtKX5xNdUqeFEQumuif827hv6CS767MoSrWIn6/0DX/uba', '4hJXtdcIRs', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL),
(23, 2, 3, 'Loyce Walker', '2021-04-24 08:33:23', 'perempuan', '+1-283-926-7431', '474', '$2y$10$gStgFj4qlbTg.alZ9OXKB./x5rkswHzoBtoMCgnZVXytt6n4DFkY.', '8NuaSQiC3W', '2022-06-24 01:37:42', '2022-06-24 01:37:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skrinings`
--

CREATE TABLE `skrinings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_pengisian` datetime NOT NULL,
  `status_kesehatan_keluarga` enum('sehat','pandemi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('sehat','sakit','karantina','positif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `masuk_sekolah` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `swab_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skrinings`
--

INSERT INTO `skrinings` (`id`, `staff_id`, `siswa_id`, `tgl_pengisian`, `status_kesehatan_keluarga`, `status`, `masuk_sekolah`, `swab_file`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, '2022-06-24 10:11:00', 'pandemi', 'karantina', '0', NULL, NULL, '2022-06-24 02:12:07', '2022-06-24 02:12:07', NULL),
(2, NULL, 11, '2022-06-24 10:16:00', 'sehat', 'sehat', '1', NULL, NULL, '2022-06-24 02:17:13', '2022-06-24 02:17:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `level_id`, `kelas_id`, `unit_id`, `nama`, `no_hp`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, 'Admin', '6283153596240', 'admin', '$2y$10$BxYwg3hQmajOX7ZFxDiiZuUhF3.IXR8CnFW/UkM8kg/C22perwaW2', NULL, '2022-06-24 01:37:38', '2022-06-24 01:37:38', NULL),
(2, 3, 1, NULL, 'Guru SD A', '6283153596240', 'guru1', '$2y$10$FNeYCI2WKUhZKZ/NSaSljuqLjwDLgfNu4lGuYjXqsbZPQDe.9w9.G', NULL, NULL, NULL, NULL),
(3, 3, 2, NULL, 'Guru SD B', '6283153596240', 'guru2', '$2y$10$NWbhabTtzHm/fpHXxvpfZuDG4G8mhZnTrXbkr2/0b.yGFBbnszooO', NULL, NULL, NULL, NULL),
(4, 3, 3, NULL, 'Guru SMP A', '6283353596240', 'guru3', '$2y$10$Qw/ogC338HxHhA2yi5niWeuu9b517OvQ0rCdvJrL552eWLcZcgKlm', NULL, NULL, NULL, NULL),
(5, 3, 4, NULL, 'Guru SMP B', '6483153596440', 'guru4', '$2y$10$75xTBf5DZg4QsuBM.rQ6p./YahKHtj8x6Cik8IccQ35Vgez1gQ1uO', NULL, NULL, NULL, NULL),
(6, 3, 5, NULL, 'Guru SMA A', '6283553596240', 'guru5', '$2y$10$t/ZEd29PBFw9Scx8LgGFWe9Dy/YFJRiMLmavS4HdvPofLcZWdfbFe', NULL, NULL, NULL, NULL),
(7, 3, 6, NULL, 'Guru SMA B', '6683153596640', 'guru6', '$2y$10$5DXECmkjjo1TLNUTonuSZOQqqPY03VqsvwKS0lsSWrxVBDI8RHtpa', NULL, NULL, NULL, NULL),
(8, 4, NULL, 1, 'Satgas SD', '6283153596240', 'satgas1', '$2y$10$KnLfLMkCUBCmPH2jmsy7OuFlt1qI8RZzBFz8T6GhvEKombrIPqeUW', NULL, NULL, NULL, NULL),
(9, 4, NULL, 2, 'Satgas SMP', '6283153596240', 'satgas2', '$2y$10$jQBQEljsdjHnyjD3JFAIlu82qaOwlNlcQ.F5C7piE4PHPcQtc4zwa', NULL, NULL, NULL, NULL),
(10, 4, NULL, 3, 'Satgas SMA', '6283353596240', 'satgas3', '$2y$10$En/EzDObFNQ8buqyGTvkl.nISU0mzy1rrF.tUU4hsybGisdOlJG6q', NULL, NULL, NULL, NULL),
(11, 4, NULL, 1, 'satgas', '628628628123141', 'satgas', '$2y$10$ATzx0hFr8S1SQSz65Lr2L.qVRbAOPpoIWi.5Gk0CBVaUZmXqeDkwS', NULL, '2022-07-28 04:15:00', '2022-07-28 04:15:47', NULL),
(12, 4, NULL, 1, 'tes', '628123123123123', 'tes', '$2y$10$ikC5OA/5ov8fUANnrLZVt.FIbTdxqfoBp4E0.17w6wBLZmnyXjHm2', NULL, '2022-07-28 04:16:07', '2022-07-28 04:16:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SD', NULL, NULL, NULL),
(2, 'SMP', NULL, NULL, NULL),
(3, 'SMA', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_skrinings`
--
ALTER TABLE `detail_skrinings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_skrinings_skrining_id_foreign` (`skrining_id`),
  ADD KEY `detail_skrinings_penyakit_id_foreign` (`penyakit_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_menus`
--
ALTER TABLE `level_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_menus_level_id_index` (`level_id`),
  ADD KEY `level_menus_menu_id_index` (`menu_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengaturans`
--
ALTER TABLE `pengaturans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakits`
--
ALTER TABLE `penyakits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nomor_induk_unique` (`nomor_induk`),
  ADD KEY `siswas_level_id_foreign` (`level_id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `skrinings`
--
ALTER TABLE `skrinings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skrinings_staff_id_foreign` (`staff_id`),
  ADD KEY `skrinings_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_username_unique` (`username`),
  ADD KEY `staff_level_id_foreign` (`level_id`),
  ADD KEY `staff_kelas_id_foreign` (`kelas_id`),
  ADD KEY `staff_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_skrinings`
--
ALTER TABLE `detail_skrinings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level_menus`
--
ALTER TABLE `level_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaturans`
--
ALTER TABLE `pengaturans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyakits`
--
ALTER TABLE `penyakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `skrinings`
--
ALTER TABLE `skrinings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_skrinings`
--
ALTER TABLE `detail_skrinings`
  ADD CONSTRAINT `detail_skrinings_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakits` (`id`),
  ADD CONSTRAINT `detail_skrinings_skrining_id_foreign` FOREIGN KEY (`skrining_id`) REFERENCES `skrinings` (`id`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `level_menus`
--
ALTER TABLE `level_menus`
  ADD CONSTRAINT `level_menus_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `level_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `siswas_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Constraints for table `skrinings`
--
ALTER TABLE `skrinings`
  ADD CONSTRAINT `skrinings_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`),
  ADD CONSTRAINT `skrinings_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `staff_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `staff_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
