-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2026 a las 22:17:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlprocesos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_15_160419_create_roles_table', 1),
(5, '2026_04_15_160420_create_tbl_cdc_table', 1),
(6, '2026_04_15_160420_create_tbl_users_table', 1),
(7, '2026_04_15_160421_create_tbl_adn_table', 1),
(8, '2026_04_15_160421_create_tbl_sitios_table', 1),
(9, '2026_04_15_160423_create_tbl_orm_table', 1),
(10, '2026_04_15_203717_create_tbl_categorias_table', 1),
(11, '2026_04_15_203717_create_tbl_ciudades_table', 1),
(12, '2026_04_15_203718_create_tbl_bodegas_table', 1),
(13, '2026_04_15_203718_create_tbl_productos_table', 1),
(14, '2026_04_15_203719_create_tbl_bodega_producto_table', 1),
(15, '2026_04_15_203721_create_tbl_det_orm_table', 1),
(16, '2026_04_20_142351_create_tbl_convenio', 1),
(17, '2026_04_20_142443_create_tbl_forma_pago', 1),
(18, '2026_04_20_142446_create_tbl_proveedores', 1),
(19, '2026_04_20_142447_create_tbl_oc', 1),
(20, '2026_07_01_204525_tbl_movimientos_bodega', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_adn`
--

CREATE TABLE `tbl_adn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_adn`
--

INSERT INTO `tbl_adn` (`id`, `descripcion`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Administración y Finanzas', 'Interno', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'Logística y Transporte', 'Interno', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'Recursos Humanos', 'Externo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'Administración y Finanzas', 'Interno', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Recursos Humanos', 'Interno', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Operaciones Mineras', 'Interno', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'Administración y Finanzas', 'Mixto', '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(8, 'Tecnología de la Información', 'Externo', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(9, 'Logística y Transporte', 'Interno', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(10, 'Administración y Finanzas', 'Externo', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(11, 'Recursos Humanos', 'Externo', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(12, 'Administración y Finanzas', 'Interno', '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(13, 'Mantenimiento Industrial', 'Mixto', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(14, 'Recursos Humanos', 'Mixto', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(15, 'Administración y Finanzas', 'Externo', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(16, 'Administración y Finanzas', 'Interno', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(17, 'Administración y Finanzas', 'Externo', '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(18, 'Mantenimiento Industrial', 'Externo', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(19, 'Operaciones Mineras', 'Externo', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(20, 'Operaciones Mineras', 'Interno', '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(21, 'Administración y Finanzas', 'Mixto', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(22, 'Mantenimiento Industrial', 'Externo', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(23, 'Administración y Finanzas', 'Externo', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(24, 'Tecnología de la Información', 'Interno', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(25, 'Administración y Finanzas', 'Mixto', '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(26, 'Mantenimiento Industrial', 'Interno', '2026-07-04 00:17:03', '2026-07-04 00:17:03'),
(27, 'Mantenimiento Industrial', 'Externo', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(28, 'Mantenimiento Industrial', 'Externo', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(29, 'Tecnología de la Información', 'Mixto', '2026-07-04 00:17:05', '2026-07-04 00:17:05'),
(30, 'Mantenimiento Industrial', 'Interno', '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(31, 'Operaciones Mineras', 'Externo', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(32, 'Operaciones Mineras', 'Mixto', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(33, 'Logística y Transporte', 'Externo', '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(34, 'Operaciones Mineras', 'Externo', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(35, 'Administración y Finanzas', 'Externo', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(36, 'Logística y Transporte', 'Externo', '2026-07-04 00:17:10', '2026-07-04 00:17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bodegas`
--

CREATE TABLE `tbl_bodegas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitio` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_bodegas`
--

INSERT INTO `tbl_bodegas` (`id`, `sitio`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bodega Principal ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 1, 'Bodega Secundaria ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 2, 'Bodega Principal ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 2, 'Bodega Secundaria ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 3, 'Bodega Principal ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 3, 'Bodega Secundaria ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 4, 'Bodega Principal ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 4, 'Bodega Secundaria ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 5, 'Bodega Principal ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 5, 'Bodega Secundaria ', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 3, 'Quigley Group Bodega', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 5, 'Fritsch and Sons Bodega', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 3, 'Morar, Muller and Monahan Bodega', '2026-07-04 00:16:50', '2026-07-04 00:16:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bodega_producto`
--

CREATE TABLE `tbl_bodega_producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bodega` bigint(20) UNSIGNED NOT NULL,
  `producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_bodega_producto`
--

INSERT INTO `tbl_bodega_producto` (`id`, `bodega`, `producto`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 242, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 1, 3, 208, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 1, 5, 926, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 1, 6, 331, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 1, 8, 386, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 1, 9, 419, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 1, 11, 561, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 1, 12, 518, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 1, 16, 286, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 1, 18, 450, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 2, 3, 925, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 2, 6, 768, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 2, 7, 441, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(14, 2, 10, 544, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(15, 2, 12, 300, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(16, 2, 13, 854, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(17, 2, 14, 817, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(18, 2, 15, 409, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(19, 2, 16, 436, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(20, 2, 17, 755, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(21, 2, 18, 84, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(22, 2, 19, 875, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(23, 2, 20, 449, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(24, 3, 1, 498, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(25, 3, 2, 269, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(26, 3, 3, 435, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(27, 3, 4, 820, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(28, 3, 5, 354, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(29, 3, 6, 238, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(30, 3, 8, 397, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(31, 3, 9, 556, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(32, 3, 13, 833, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(33, 3, 14, 51, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(34, 3, 15, 413, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(35, 3, 16, 194, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(36, 3, 18, 818, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(37, 3, 20, 110, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(38, 4, 1, 929, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(39, 4, 4, 204, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(40, 4, 5, 555, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(41, 4, 6, 283, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(42, 4, 7, 545, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(43, 4, 10, 260, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(44, 4, 12, 606, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(45, 4, 15, 205, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(46, 4, 17, 700, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(47, 4, 18, 83, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(48, 4, 20, 816, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(49, 5, 1, 385, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(50, 5, 3, 275, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(51, 5, 5, 462, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(52, 5, 8, 102, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(53, 5, 9, 61, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(54, 5, 10, 414, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(55, 5, 11, 255, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(56, 5, 12, 732, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(57, 5, 14, 63, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(58, 5, 15, 420, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(59, 5, 17, 703, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(60, 6, 1, 895, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(61, 6, 3, 165, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(62, 6, 6, 600, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(63, 6, 7, 243, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(64, 6, 8, 15, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(65, 6, 9, 927, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(66, 6, 11, 848, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(67, 6, 14, 993, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(68, 6, 16, 780, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(69, 6, 20, 948, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(70, 7, 2, 734, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(71, 7, 4, 17, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(72, 7, 6, 730, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(73, 7, 7, 707, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(74, 7, 10, 856, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(75, 7, 11, 99, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(76, 7, 13, 874, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(77, 7, 14, 6, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(78, 7, 15, 557, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(79, 7, 17, 942, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(80, 7, 18, 375, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(81, 8, 1, 954, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(82, 8, 3, 43, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(83, 8, 5, 220, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(84, 8, 6, 214, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(85, 8, 7, 355, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(86, 8, 8, 581, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(87, 8, 9, 80, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(88, 8, 10, 619, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(89, 8, 15, 259, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(90, 8, 16, 732, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(91, 8, 17, 845, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(92, 8, 19, 98, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(93, 8, 20, 548, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(94, 9, 1, 698, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(95, 9, 2, 626, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(96, 9, 3, 355, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(97, 9, 4, 759, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(98, 9, 6, 14, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(99, 9, 9, 248, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(100, 9, 10, 98, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(101, 9, 11, 55, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(102, 9, 15, 153, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(103, 9, 16, 302, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(104, 9, 17, 862, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(105, 9, 19, 91, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(106, 9, 20, 276, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(107, 10, 1, 350, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(108, 10, 2, 666, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(109, 10, 3, 760, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(110, 10, 4, 487, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(111, 10, 5, 287, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(112, 10, 6, 57, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(113, 10, 7, 436, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(114, 10, 8, 336, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(115, 10, 12, 994, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(116, 10, 15, 656, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(117, 10, 16, 111, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(118, 10, 17, 713, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(119, 10, 19, 974, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(120, 10, 20, 913, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(121, 11, 3, 378, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(122, 11, 4, 658, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(123, 11, 5, 341, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(124, 11, 9, 944, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(125, 11, 10, 268, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(126, 11, 13, 848, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(127, 11, 14, 82, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(128, 11, 15, 268, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(129, 11, 17, 910, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(130, 11, 18, 206, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(131, 11, 19, 226, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(132, 12, 1, 379, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(133, 12, 2, 224, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(134, 12, 3, 661, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(135, 12, 4, 383, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(136, 12, 5, 951, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(137, 12, 6, 546, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(138, 12, 7, 960, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(139, 12, 9, 588, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(140, 12, 10, 660, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(141, 12, 11, 244, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(142, 12, 12, 147, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(143, 12, 15, 158, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(144, 12, 16, 817, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(145, 12, 18, 427, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(146, 13, 1, 473, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(147, 13, 2, 199, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(148, 13, 3, 305, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(149, 13, 4, 562, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(150, 13, 6, 257, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(151, 13, 7, 451, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(152, 13, 8, 73, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(153, 13, 9, 214, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(154, 13, 10, 915, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(155, 13, 11, 509, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(156, 13, 12, 32, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(157, 13, 13, 703, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(158, 13, 14, 157, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(159, 13, 17, 459, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(160, 13, 20, 626, '2026-07-04 00:16:50', '2026-07-04 00:16:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Insumos Mineros', 'Materiales para minería', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'Herramientas Industriales', 'Herramientas para uso industrial', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'Equipos de Seguridad', 'EPP y equipos de protección', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'Materiales de Construcción', 'Materiales para construcción', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Equipos Eléctricos', 'Componentes y equipos eléctricos', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Lubricantes y Combustibles', 'Lubricantes y combustibles', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'Servicios Técnicos', 'Servicios especializados', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 'Oficina y Administración', 'Insumos de oficina', '2026-07-04 00:16:50', '2026-07-04 00:16:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cdc`
--

CREATE TABLE `tbl_cdc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cdc` varchar(20) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `banco` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_cdc`
--

INSERT INTO `tbl_cdc` (`id`, `cdc`, `descripcion`, `banco`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'MN-5270', 'Doloribus quia ea sed.', 'BCI', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'IJ-3823', 'Expedita sit vero.', 'Itaú', 'Operacional', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'EF-8601', 'Voluptate autem voluptatem.', 'BCI', 'Comercial', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'CD-1342', 'Id necessitatibus quod saepe.', 'Estado', 'Operacional', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'WX-1889', 'Accusantium enim voluptatem.', 'Santander', 'Administrativo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'ST-1802', 'Animi blanditiis modi.', 'Itaú', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'QR-1201', 'Nisi consequatur mollitia perferendis.', 'Banco de Chile', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 'IJ-6191', 'Molestiae incidunt ducimus.', 'Estado', 'Operacional', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 'CD-5912', 'Recusandae maiores tenetur perferendis.', 'BCI', 'Administrativo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 'WX-6124', 'Et eaque minus impedit.', 'Banco de Chile', 'Administrativo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 'ST-8265', 'Voluptas sequi nisi consequatur.', 'BCI', 'Comercial', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 'YZ-4810', 'Laborum quod quia.', 'Itaú', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 'WX-3248', 'Cumque fuga non officiis.', 'BCI', 'Operacional', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(14, 'KL-5365', 'Voluptatem illo nesciunt.', 'Banco de Chile', 'Administrativo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(15, 'ST-3911', 'Fugiat vitae id.', 'Santander', 'Administrativo', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(16, 'GH-830', 'Quia alias incidunt dolore ut.', 'Estado', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(17, 'WX-9711', 'Voluptatem expedita.', 'Estado', 'Logístico', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(18, 'OP-1280', 'Voluptas maiores commodi quasi.', 'Banco de Chile', 'Comercial', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(19, 'WX-1924', 'Dolores laudantium id.', 'BCI', 'Operacional', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(20, 'WX-3614', 'Quaerat quia dicta nostrum.', 'Itaú', 'Comercial', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(21, 'QR-3169', 'Nemo eius et.', 'Estado', 'Operacional', '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(22, 'UV-3666', 'Ullam eos possimus.', 'BCI', 'Comercial', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(23, 'AB-2602', 'Harum eveniet.', 'Santander', 'Comercial', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(24, 'QR-5436', 'Odio nihil molestiae omnis.', 'Santander', 'Operacional', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(25, 'AB-6379', 'Alias vitae at laborum.', 'Banco de Chile', 'Operacional', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(26, 'QR-661', 'Vel eum distinctio maiores.', 'BCI', 'Administrativo', '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(27, 'ST-7520', 'Fugiat quo quasi.', 'Estado', 'Logístico', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(28, 'KL-4540', 'Est quia reiciendis.', 'Estado', 'Comercial', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(29, 'YZ-3310', 'Exercitationem optio iure et itaque.', 'Santander', 'Operacional', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(30, 'GH-9350', 'Praesentium delectus cupiditate.', 'Estado', 'Comercial', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(31, 'KL-3023', 'Eius corporis minus.', 'Estado', 'Administrativo', '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(32, 'CD-5706', 'Ea doloremque.', 'Santander', 'Administrativo', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(33, 'YZ-7149', 'Atque quod ut.', 'Santander', 'Comercial', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(34, 'AB-4427', 'Est quam rem et ipsa.', 'Santander', 'Comercial', '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(35, 'OP-9326', 'Magnam explicabo quos.', 'Estado', 'Logístico', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(36, 'AJ-4656', 'Cum aut modi.', 'Estado', 'Logístico', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(37, 'GH-3437', 'Praesentium recusandae veniam officiis.', 'Estado', 'Administrativo', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(38, 'AJ-5633', 'Magni deserunt cum reprehenderit numquam.', 'Santander', 'Operacional', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(39, 'ST-9302', 'Ex qui sequi omnis.', 'Itaú', 'Comercial', '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(40, 'YZ-2627', 'Deserunt consequuntur velit deleniti.', 'Estado', 'Administrativo', '2026-07-04 00:17:03', '2026-07-04 00:17:03'),
(41, 'CD-1654', 'Quidem explicabo consequuntur.', 'Estado', 'Logístico', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(42, 'GH-9710', 'Non magni.', 'Estado', 'Operacional', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(43, 'EF-8446', 'Delectus maiores repudiandae recusandae.', 'Estado', 'Logístico', '2026-07-04 00:17:05', '2026-07-04 00:17:05'),
(44, 'ST-8740', 'Aliquid delectus voluptate iusto.', 'Banco de Chile', 'Logístico', '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(45, 'QR-4025', 'Quos blanditiis eum quibusdam error.', 'Estado', 'Operacional', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(46, 'AB-305', 'Nam vel.', 'Estado', 'Administrativo', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(47, 'ST-1934', 'Provident quis consectetur.', 'Banco de Chile', 'Operacional', '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(48, 'QR-9708', 'Repellat placeat voluptatem.', 'Banco de Chile', 'Administrativo', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(49, 'YZ-4491', 'Qui possimus aliquam non.', 'Santander', 'Logístico', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(50, 'GH-8168', 'Libero et adipisci.', 'Banco de Chile', 'Comercial', '2026-07-04 00:17:10', '2026-07-04 00:17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ciudades`
--

CREATE TABLE `tbl_ciudades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_ciudades`
--

INSERT INTO `tbl_ciudades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Santiago', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'Valparaíso', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'Concepción', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'La Serena', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Antofagasta', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Temuco', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'Rancagua', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 'Talca', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 'Arica', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 'Iquique', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 'Puerto Montt', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 'Calama', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 'Copiapó', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(14, 'Quillota', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(15, 'Los Ángeles', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(16, 'East Alejandraside', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(17, 'South Leoniemouth', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(18, 'East Olliechester', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(19, 'North Melvin', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(20, 'Port Camronmouth', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(21, 'Port Mabel', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(22, 'Traceside', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(23, 'East Quintonport', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(24, 'South Berneice', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(25, 'New Ricardo', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(26, 'Lake Nayeliview', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(27, 'West Roelchester', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(28, 'Port Phyllis', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(29, 'North Lexus', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(30, 'Batzstad', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(31, 'Stephanieborough', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(32, 'Wallaceberg', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(33, 'Lehnerbury', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(34, 'Dachmouth', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(35, 'East Toreyfort', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(36, 'South Lesly', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(37, 'Chanelview', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(38, 'Larsonborough', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(39, 'Chelseyborough', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(40, 'Zulaufburgh', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(41, 'Paucekmouth', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(42, 'Kohlerville', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(43, 'East Brennonchester', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(44, 'Jensentown', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(45, 'East Destini', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(46, 'Reginaldburgh', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(47, 'Port Marquiseborough', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(48, 'West Mikel', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(49, 'Feltonport', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(50, 'Lake Abner', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(51, 'North Travis', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(52, 'West Hayleefort', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(53, 'D\'Amoreville', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(54, 'Candiceberg', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(55, 'Port Mauricioside', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(56, 'Louvenialand', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(57, 'Wymanbury', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(58, 'New Tara', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(59, 'Anaside', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(60, 'North Laurenburgh', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(61, 'East Marilieside', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(62, 'New Gustaveborough', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(63, 'North Destin', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(64, 'Wendelltown', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(65, 'North Emerald', '2026-07-04 00:17:11', '2026-07-04 00:17:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_convenio`
--

CREATE TABLE `tbl_convenio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `convenio` varchar(255) NOT NULL,
  `dia` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_convenio`
--

INSERT INTO `tbl_convenio` (`id`, `convenio`, `dia`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Convenio Marco Ley 19.886', '30 días', 1, '2026-07-04 00:14:30', '2026-07-04 00:14:30'),
(2, 'Convenio Específico Ministerio', '45 días', 1, '2026-07-04 00:14:30', '2026-07-04 00:14:30'),
(3, 'Convenio Colaboración Público-Privada', '60 días', 1, '2026-07-04 00:14:30', '2026-07-04 00:14:30'),
(4, 'Convenio Simple', '15 días', 1, '2026-07-04 00:14:30', '2026-07-04 00:14:30'),
(5, 'Convenio Urgencia', '7 días', 0, '2026-07-04 00:14:30', '2026-07-04 00:14:30'),
(6, 'Convenio Marco Ley 19.886', '30 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(7, 'Convenio Específico Ministerio', '45 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(8, 'Convenio Colaboración Público-Privada', '60 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(9, 'Convenio Simple', '15 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(10, 'Convenio Urgencia', '7 días', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(11, 'Will LLC Ltda', '60 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(12, 'Goyette-Fisher Ltda', '15 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(13, 'Funk-Wilkinson SRL', '30 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(14, 'Harber-Hoeger Ltda', 'Lunes', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(15, 'Schultz, Von and Fadel Ltda', 'Jueves', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(16, 'Wolf-Bernier SA', 'Lunes', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(17, 'Larkin, Simonis and Blanda SA', '30 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(18, 'Beatty Group SA', 'Viernes', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(19, 'Ruecker-Monahan Ltda', 'Martes', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(20, 'McCullough Ltd Ltda', '15 días', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_det_orm`
--

CREATE TABLE `tbl_det_orm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orm` varchar(15) NOT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `producto` bigint(20) UNSIGNED NOT NULL,
  `procesado` tinyint(1) NOT NULL DEFAULT 0,
  `bodega` tinyint(1) NOT NULL DEFAULT 0,
  `ciudad` bigint(20) UNSIGNED DEFAULT NULL,
  `f_estimada` date DEFAULT NULL,
  `f_recepcion` date DEFAULT NULL,
  `recepcion` enum('parcial','total','S/REC') NOT NULL DEFAULT 'S/REC',
  `cantidad_recepcion` decimal(12,2) NOT NULL DEFAULT 0.00,
  `costo` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_det_orm`
--

INSERT INTO `tbl_det_orm` (`id`, `orm`, `cantidad`, `detalle`, `producto`, `procesado`, `bodega`, `ciudad`, `f_estimada`, `f_recepcion`, `recepcion`, `cantidad_recepcion`, `costo`, `created_at`, `updated_at`) VALUES
(1, 'ORM5-2026', 2.00, 'Reprehenderit est at aliquam.', 21, 1, 0, 16, '1979-06-21', '2012-02-25', 'parcial', 2.00, 92512.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(2, 'ORM25-2026', 4.00, 'Et quis sit corporis hic ex.', 22, 0, 0, 17, '1998-04-28', '2005-02-25', 'parcial', 8.00, 69164.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(3, 'ORM28-2026', 10.00, 'Quos alias officia ad aut ut.', 23, 0, 0, 18, '2001-06-22', '2026-04-21', 'total', 7.00, 177966.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(4, 'ORM29-2026', 1.00, 'Harum illo aut ut et.', 24, 1, 0, 19, '1975-03-20', '1983-09-08', 'total', 5.00, 143990.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(5, 'ORM13-2026', 8.00, 'Voluptas adipisci optio enim.', 25, 1, 0, 20, '1977-09-08', '2009-08-03', 'S/REC', 7.00, 181803.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(6, 'ORM10-2026', 5.00, 'Et aut repellat quisquam.', 26, 1, 0, 21, '1986-01-14', '1988-07-13', 'total', 10.00, 160240.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(7, 'ORM20-2026', 5.00, 'At rerum nemo dolor.', 27, 1, 0, 22, '1984-02-20', '1987-08-15', 'S/REC', 10.00, 105301.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(8, 'ORM2-2026', 5.00, 'Et omnis neque mollitia.', 28, 1, 0, 23, '2010-06-15', '2008-09-08', 'S/REC', 6.00, 151717.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(9, 'ORM25-2026', 8.00, 'Qui nobis labore eum earum.', 29, 0, 0, 24, '1997-06-17', '1982-08-24', 'total', 10.00, 65862.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(10, 'ORM13-2026', 1.00, 'Aut dolorum quas dolor.', 30, 1, 0, 25, '2014-11-14', '1984-05-02', 'S/REC', 1.00, 147707.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(11, 'ORM21-2026', 7.00, 'Adipisci tempora ullam et.', 31, 0, 0, 26, '1984-09-07', '1982-05-15', 'total', 10.00, 127520.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(12, 'ORM2-2026', 5.00, 'Distinctio sit qui et id.', 32, 0, 0, 27, '2004-10-04', '1974-12-09', 'total', 3.00, 98631.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(13, 'ORM13-2026', 2.00, 'Hic iusto id libero et et.', 33, 0, 0, 28, '1985-05-27', '1975-08-08', 'parcial', 8.00, 161477.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(14, 'ORM14-2026', 10.00, 'Enim et et culpa rerum quos.', 34, 1, 0, 29, '1986-03-14', '1993-01-30', 'S/REC', 9.00, 29930.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(15, 'ORM16-2026', 2.00, 'Qui minus eos esse.', 35, 0, 0, 30, '1975-12-14', '2020-08-25', 'total', 10.00, 110379.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(16, 'ORM22-2026', 10.00, 'Quo alias voluptas eum est.', 36, 1, 0, 31, '1990-11-17', '1995-08-02', 'S/REC', 2.00, 98044.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(17, 'ORM4-2026', 7.00, 'Ut nihil fugit beatae.', 37, 1, 0, 32, '1982-11-23', '1995-02-08', 'total', 9.00, 171627.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(18, 'ORM15-2026', 7.00, 'Facilis illo vel commodi vel.', 38, 1, 0, 33, '2007-07-21', '1990-08-15', 'S/REC', 3.00, 80599.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(19, 'ORM12-2026', 5.00, 'Sint qui odit quos neque.', 39, 1, 0, 34, '2025-09-01', '1994-08-10', 'total', 6.00, 41038.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(20, 'ORM23-2026', 2.00, 'Impedit quis sed provident.', 40, 1, 0, 35, '1985-06-26', '1999-11-30', 'total', 5.00, 194840.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(21, 'ORM11-2026', 10.00, 'Qui sunt ullam incidunt ut.', 41, 1, 0, 36, '2006-04-10', '1993-06-21', 'total', 7.00, 104474.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(22, 'ORM16-2026', 2.00, 'Reiciendis est ea culpa quod.', 42, 1, 0, 37, '1993-02-10', '2003-12-30', 'total', 9.00, 65762.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(23, 'ORM23-2026', 6.00, 'Dolorem voluptas cum alias.', 43, 1, 0, 38, '1991-06-13', '1997-02-05', 'parcial', 10.00, 91548.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(24, 'ORM8-2026', 1.00, 'Qui nesciunt quo tempore sed.', 44, 1, 0, 39, '1992-02-08', '1981-01-26', 'total', 5.00, 24470.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(25, 'ORM21-2026', 4.00, 'Sed eius est quo molestias.', 45, 1, 0, 40, '2012-05-12', '2017-07-07', 'total', 6.00, 64085.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(26, 'ORM11-2026', 8.00, 'Ut dolor odio facere ad.', 46, 1, 0, 41, '2020-02-05', '1985-04-27', 'parcial', 5.00, 76311.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(27, 'ORM24-2026', 4.00, 'Sit quis non nam.', 47, 1, 0, 42, '1986-04-15', '2005-10-11', 'total', 2.00, 34241.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(28, 'ORM1-2026', 7.00, 'Est odit esse nihil.', 48, 1, 0, 43, '1979-04-07', '1984-01-18', 'S/REC', 4.00, 40478.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(29, 'ORM26-2026', 5.00, 'Iure quia omnis rem.', 49, 0, 0, 44, '1990-12-26', '2015-05-15', 'parcial', 6.00, 165480.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(30, 'ORM2-2026', 2.00, 'Facere qui sed in autem qui.', 50, 1, 0, 45, '2016-09-17', '2022-05-01', 'S/REC', 7.00, 2608.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(31, 'ORM11-2026', 3.00, 'Ut corporis sed alias.', 51, 1, 0, 46, '1979-10-11', '2009-04-29', 'parcial', 4.00, 154942.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(32, 'ORM28-2026', 10.00, 'Dolorem ut neque dolor nihil.', 52, 0, 0, 47, '1993-01-10', '1980-12-06', 'S/REC', 1.00, 166620.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(33, 'ORM27-2026', 2.00, 'Et ab ut enim ea est.', 53, 0, 0, 48, '2012-01-27', '2015-07-27', 'S/REC', 10.00, 120798.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(34, 'ORM1-2026', 5.00, 'Nam pariatur enim vel in in.', 54, 1, 0, 49, '2020-06-01', '1973-09-06', 'S/REC', 7.00, 89552.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(35, 'ORM21-2026', 9.00, 'Ratione ut et itaque et.', 55, 1, 0, 50, '1996-12-15', '1972-07-12', 'total', 9.00, 176772.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(36, 'ORM12-2026', 3.00, 'At itaque beatae amet sit.', 56, 1, 0, 51, '2024-06-05', '2021-10-04', 'S/REC', 10.00, 28559.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(37, 'ORM3-2026', 8.00, 'Rem sed occaecati eum aut.', 57, 0, 0, 52, '2005-08-20', '1978-02-11', 'S/REC', 1.00, 35739.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(38, 'ORM17-2026', 6.00, 'Quis autem eum soluta et id.', 58, 1, 0, 53, '1997-08-13', '2015-05-23', 'parcial', 8.00, 157677.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(39, 'ORM25-2026', 10.00, 'Velit at nulla perferendis.', 59, 1, 0, 54, '2019-08-05', '2009-12-24', 'S/REC', 9.00, 19243.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(40, 'ORM21-2026', 5.00, 'Nostrum eligendi aut magni.', 60, 1, 0, 55, '1996-11-28', '1972-10-30', 'S/REC', 6.00, 73688.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(41, 'ORM22-2026', 7.00, 'Sint vel rerum voluptates.', 61, 1, 0, 56, '1979-02-11', '2024-06-20', 'total', 3.00, 81312.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(42, 'ORM15-2026', 10.00, 'Aut ut saepe amet quis.', 62, 1, 0, 57, '2017-06-02', '2008-03-02', 'total', 6.00, 124736.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(43, 'ORM13-2026', 7.00, 'Excepturi et optio ut cumque.', 63, 1, 0, 58, '1979-04-03', '1972-01-05', 'total', 3.00, 84233.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(44, 'ORM4-2026', 2.00, 'Provident sed quam quam.', 64, 1, 0, 59, '2013-10-06', '1993-12-27', 'parcial', 6.00, 151173.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(45, 'ORM21-2026', 9.00, 'Velit sed doloribus ut.', 65, 1, 0, 60, '2013-04-18', '2005-04-08', 'parcial', 10.00, 31028.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(46, 'ORM7-2026', 8.00, 'Enim nobis aut ratione animi.', 66, 1, 0, 61, '1988-06-01', '1986-03-07', 'parcial', 7.00, 118046.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(47, 'ORM7-2026', 8.00, 'In unde minus aut sed.', 67, 0, 0, 62, '1983-08-17', '1979-02-07', 'total', 9.00, 134555.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(48, 'ORM17-2026', 8.00, 'Dolore nemo eos modi qui.', 68, 1, 0, 63, '1984-12-23', '2013-12-03', 'total', 9.00, 11676.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(49, 'ORM4-2026', 5.00, 'Et culpa porro nesciunt.', 69, 1, 0, 64, '1984-02-08', '2015-07-26', 'parcial', 6.00, 89821.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(50, 'ORM10-2026', 5.00, 'Cum saepe at animi error.', 70, 1, 0, 65, '1995-02-17', '1979-02-06', 'S/REC', 7.00, 96242.00, '2026-07-04 00:17:11', '2026-07-04 00:17:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_forma_pago`
--

CREATE TABLE `tbl_forma_pago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `autopago` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_forma_pago`
--

INSERT INTO `tbl_forma_pago` (`id`, `descripcion`, `status`, `autopago`, `created_at`, `updated_at`) VALUES
(1, 'Contado', 1, 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(2, 'Crédito 30 días', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(3, 'Crédito 60 días', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(4, 'Tarjeta de Crédito', 1, 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(5, 'Transferencia Electrónica', 1, 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(6, 'Cheque al día', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(7, 'Cheque diferido', 0, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(8, 'Pago en especie', 0, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(9, 'Cheque', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(10, 'Transferencia', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(11, 'Transferencia', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(12, 'Tarjeta de Crédito', 1, 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(13, 'Crédito 30 días', 1, 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_movimientos_bodega`
--

CREATE TABLE `tbl_movimientos_bodega` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bodega_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('ingreso','egreso','traspaso_salida','traspaso_entrada') NOT NULL,
  `cantidad` float NOT NULL,
  `stock_anterior` float NOT NULL,
  `stock_nuevo` float NOT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `documento_path` varchar(255) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bodega_origen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bodega_destino_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_movimientos_bodega`
--

INSERT INTO `tbl_movimientos_bodega` (`id`, `bodega_id`, `producto_id`, `tipo`, `cantidad`, `stock_anterior`, `stock_nuevo`, `documento`, `documento_path`, `observacion`, `usuario_id`, `bodega_origen_id`, `bodega_destino_id`, `created_at`, `updated_at`) VALUES
(1, 8, 10, 'egreso', 95.6, 357.22, 261.62, 'DOC-9767-dc', NULL, 'Nulla odit id quisquam incidunt est quam.', 2, NULL, NULL, '2026-01-17 18:04:51', '2026-04-25 09:46:41'),
(2, 9, 40, 'ingreso', 29.7, 49.22, 78.92, 'DOC-0526-la', NULL, 'Praesentium aut et distinctio iste eos unde.', 49, NULL, NULL, '2026-06-28 03:06:18', '2026-01-18 12:49:50'),
(3, 1, 24, 'egreso', 75.46, 72.83, 0, NULL, NULL, NULL, 19, NULL, NULL, '2026-06-25 02:13:53', '2026-02-19 15:03:07'),
(4, 6, 55, 'ingreso', 38.1, 78.32, 116.42, 'DOC-4920-au', NULL, NULL, 64, NULL, NULL, '2026-02-07 19:53:17', '2026-04-26 00:17:44'),
(5, 9, 27, 'traspaso_entrada', 51.54, 176.83, 228.37, NULL, NULL, NULL, 4, 8, 9, '2026-05-14 17:41:59', '2026-05-12 22:23:43'),
(6, 12, 58, 'egreso', 16.53, 358.01, 341.48, 'DOC-0397-me', NULL, NULL, 33, NULL, NULL, '2026-02-17 00:13:12', '2026-04-30 17:57:52'),
(7, 6, 17, 'ingreso', 76.99, 72.72, 149.71, 'DOC-2635-tp', NULL, NULL, 57, NULL, NULL, '2026-06-18 08:36:07', '2026-03-07 10:27:57'),
(8, 10, 42, 'traspaso_entrada', 94.78, 62.46, 157.24, 'DOC-1118-vf', NULL, NULL, 19, 8, 10, '2026-02-28 03:28:03', '2026-06-20 04:08:49'),
(9, 13, 67, 'ingreso', 81.27, 117.04, 198.31, 'DOC-3593-wc', NULL, 'Aut rerum sit et distinctio sapiente enim.', 11, NULL, NULL, '2026-06-27 23:19:48', '2026-02-09 00:00:25'),
(10, 8, 40, 'traspaso_salida', 78.14, 255.65, 177.51, 'DOC-4770-kn', NULL, NULL, 26, 8, 7, '2026-05-07 11:11:40', '2026-02-13 06:58:53'),
(11, 11, 59, 'traspaso_salida', 53.87, 174.47, 120.6, NULL, NULL, NULL, 12, 11, 4, '2026-06-16 13:57:31', '2026-01-14 00:19:16'),
(12, 8, 42, 'traspaso_entrada', 7.38, 199.08, 206.46, 'DOC-7202-hj', NULL, 'Esse dolore qui sed.', 47, 9, 8, '2026-02-13 23:43:17', '2026-03-10 12:45:10'),
(13, 3, 21, 'traspaso_salida', 70.96, 58.07, 0, 'DOC-0422-uw', NULL, 'Et eius et ut sapiente numquam hic.', 71, 3, 5, '2026-07-02 15:39:24', '2026-01-08 17:59:19'),
(14, 1, 14, 'traspaso_entrada', 16.42, 323.12, 339.54, NULL, NULL, NULL, 69, 10, 1, '2026-01-24 20:18:09', '2026-04-13 08:50:01'),
(15, 4, 43, 'egreso', 60.11, 480.47, 420.36, 'DOC-9565-jp', NULL, NULL, 28, NULL, NULL, '2026-02-24 08:50:10', '2026-05-23 13:45:45'),
(16, 10, 20, 'traspaso_salida', 4.04, 426.01, 421.97, 'DOC-3776-oy', NULL, 'Tempora ex possimus enim.', 25, 10, 13, '2026-06-09 07:33:47', '2026-03-20 20:16:15'),
(17, 12, 38, 'traspaso_entrada', 9.62, 413.33, 422.95, NULL, NULL, 'Doloremque quasi adipisci voluptas minima dolorem minus.', 12, 2, 12, '2026-04-01 01:26:11', '2026-07-03 09:39:02'),
(18, 1, 20, 'traspaso_salida', 95.65, 276.88, 181.23, 'DOC-1851-jp', NULL, 'Dolor excepturi vel dolores placeat voluptas aut.', 48, 1, 9, '2026-04-14 00:01:12', '2026-01-29 09:55:53'),
(19, 9, 38, 'ingreso', 50.44, 3.37, 53.81, 'DOC-2253-cy', NULL, 'Odio rerum aut aut et vitae.', 46, NULL, NULL, '2026-01-09 19:00:24', '2026-07-02 14:16:34'),
(20, 1, 39, 'egreso', 23.36, 199.8, 176.44, NULL, NULL, NULL, 23, NULL, NULL, '2026-04-06 11:29:45', '2026-01-16 12:18:50'),
(21, 11, 9, 'egreso', 34.07, 347.13, 313.06, 'DOC-6565-he', NULL, NULL, 30, NULL, NULL, '2026-02-11 13:23:14', '2026-02-06 11:41:00'),
(22, 1, 13, 'traspaso_entrada', 49.66, 81.63, 131.29, NULL, NULL, NULL, 55, 9, 1, '2026-03-05 19:38:27', '2026-02-10 18:15:59'),
(23, 1, 6, 'ingreso', 58.76, 188.67, 247.43, NULL, NULL, NULL, 54, NULL, NULL, '2026-05-29 01:47:54', '2026-02-03 09:31:49'),
(24, 12, 9, 'traspaso_entrada', 60.29, 124.06, 184.35, 'DOC-5537-ff', NULL, 'Id aperiam deleniti dolor accusamus.', 49, 9, 12, '2026-02-27 09:46:21', '2026-01-11 22:51:13'),
(25, 11, 22, 'egreso', 49.86, 289.78, 239.92, NULL, NULL, NULL, 11, NULL, NULL, '2026-06-19 12:39:24', '2026-03-15 03:22:09'),
(26, 10, 29, 'ingreso', 87.43, 310.88, 398.31, 'DOC-8584-mg', NULL, NULL, 5, NULL, NULL, '2026-03-27 15:01:46', '2026-06-29 20:16:59'),
(27, 12, 3, 'traspaso_salida', 42.64, 19.61, 0, NULL, NULL, NULL, 47, 12, 13, '2026-02-27 01:22:11', '2026-01-23 10:30:50'),
(28, 4, 47, 'ingreso', 24.32, 410.91, 435.23, 'DOC-4054-az', NULL, NULL, 42, NULL, NULL, '2026-05-03 23:06:26', '2026-01-29 10:19:20'),
(29, 5, 37, 'traspaso_entrada', 24.86, 76.67, 101.53, NULL, NULL, 'Quae consequatur perspiciatis itaque non consequatur.', 53, 3, 5, '2026-02-23 03:23:00', '2026-06-16 00:29:16'),
(30, 12, 51, 'traspaso_salida', 76.19, 114.65, 38.46, NULL, NULL, NULL, 39, 12, 13, '2026-06-14 12:16:24', '2026-01-05 03:22:22'),
(31, 2, 12, 'traspaso_entrada', 49.21, 181.22, 230.43, 'DOC-9833-oy', NULL, NULL, 57, 6, 2, '2026-05-22 18:08:01', '2026-06-29 19:22:54'),
(32, 13, 4, 'ingreso', 68.47, 417.13, 485.6, 'DOC-4898-on', NULL, NULL, 70, NULL, NULL, '2026-06-08 07:05:20', '2026-03-24 17:43:58'),
(33, 8, 68, 'traspaso_entrada', 99.92, 464.25, 564.17, 'DOC-8205-gl', NULL, NULL, 14, 9, 8, '2026-04-10 22:06:29', '2026-06-20 19:06:08'),
(34, 9, 30, 'egreso', 98.62, 228.7, 130.08, NULL, NULL, 'Debitis earum et minima a.', 10, NULL, NULL, '2026-06-29 21:32:34', '2026-07-03 03:36:12'),
(35, 3, 52, 'ingreso', 39.96, 91.74, 131.7, NULL, NULL, 'Omnis placeat ipsa et.', 25, NULL, NULL, '2026-03-21 11:08:41', '2026-06-09 07:51:48'),
(36, 1, 48, 'egreso', 24.74, 210.23, 185.49, 'DOC-4598-qr', NULL, NULL, 50, NULL, NULL, '2026-03-14 09:19:50', '2026-05-10 03:44:53'),
(37, 6, 29, 'traspaso_entrada', 83.01, 57.97, 140.98, 'DOC-3550-jh', NULL, NULL, 55, 9, 6, '2026-05-30 09:20:18', '2026-03-27 17:57:32'),
(38, 9, 7, 'traspaso_entrada', 84.44, 200.62, 285.06, NULL, NULL, NULL, 45, 6, 9, '2026-03-19 08:24:43', '2026-04-11 06:16:27'),
(39, 2, 12, 'ingreso', 85.79, 111.75, 197.54, 'DOC-6939-tj', NULL, NULL, 62, NULL, NULL, '2026-01-09 09:05:59', '2026-03-09 07:29:42'),
(40, 7, 31, 'traspaso_salida', 23.18, 176.93, 153.75, 'DOC-4483-ks', NULL, 'Fugiat autem modi cum sed quasi autem.', 51, 7, 2, '2026-05-10 05:58:02', '2026-05-19 09:08:47'),
(41, 2, 56, 'egreso', 80.49, 366.52, 286.03, NULL, NULL, 'Ut quis a aspernatur excepturi a.', 40, NULL, NULL, '2026-06-07 12:41:47', '2026-05-23 15:47:56'),
(42, 8, 62, 'traspaso_entrada', 68.24, 154.77, 223.01, 'DOC-5342-gu', NULL, 'Iusto impedit quaerat ut accusamus.', 9, 9, 8, '2026-05-13 23:31:43', '2026-01-24 11:37:52'),
(43, 1, 17, 'traspaso_entrada', 43.54, 179.21, 222.75, 'DOC-1961-ha', NULL, 'Recusandae nam temporibus dolor eligendi.', 8, 11, 1, '2026-01-24 23:48:13', '2026-05-04 09:59:30'),
(44, 2, 31, 'ingreso', 84.17, 211.7, 295.87, 'DOC-9514-jk', NULL, NULL, 61, NULL, NULL, '2026-03-31 11:03:13', '2026-04-18 16:05:47'),
(45, 7, 36, 'egreso', 89.61, 75.65, 0, 'DOC-0862-df', NULL, NULL, 45, NULL, NULL, '2026-04-02 07:13:16', '2026-06-07 19:11:54'),
(46, 12, 70, 'ingreso', 7.72, 425.3, 433.02, 'DOC-2161-lk', NULL, 'Perspiciatis cupiditate possimus officia quae blanditiis.', 33, NULL, NULL, '2026-01-23 02:08:02', '2026-01-13 09:39:24'),
(47, 3, 2, 'egreso', 70.51, 65.75, 0, 'DOC-2915-jw', NULL, NULL, 26, NULL, NULL, '2026-06-29 22:17:38', '2026-03-21 17:37:43'),
(48, 10, 3, 'traspaso_entrada', 50.02, 168.64, 218.66, NULL, NULL, 'Alias ut sapiente in.', 55, 6, 10, '2026-04-03 17:14:29', '2026-05-16 07:18:45'),
(49, 2, 48, 'ingreso', 63.2, 300.63, 363.83, NULL, NULL, NULL, 71, NULL, NULL, '2026-03-31 00:07:32', '2026-03-20 14:16:42'),
(50, 11, 40, 'traspaso_entrada', 37.79, 16.47, 54.26, 'DOC-1007-vl', NULL, 'Ipsam et quibusdam voluptatem et et rem.', 24, 3, 11, '2026-02-22 07:35:02', '2026-05-27 07:55:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_oc`
--

CREATE TABLE `tbl_oc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oc` varchar(50) NOT NULL,
  `proveedor` bigint(20) UNSIGNED NOT NULL,
  `forma_pago` bigint(20) UNSIGNED NOT NULL,
  `convenio` bigint(20) UNSIGNED NOT NULL,
  `plazo_entrega` int(11) NOT NULL,
  `det_orm` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`det_orm`)),
  `orm` varchar(15) NOT NULL,
  `monto_parcial` decimal(15,2) NOT NULL DEFAULT 0.00,
  `monto_iva` decimal(15,2) NOT NULL DEFAULT 0.00,
  `monto_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `presupuesto` decimal(15,2) DEFAULT NULL,
  `factura` varchar(100) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `descuentos` decimal(15,2) NOT NULL DEFAULT 0.00,
  `impuestos` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cuotas` int(11) NOT NULL DEFAULT 1,
  `terceros` tinyint(1) NOT NULL DEFAULT 0,
  `path_factura` varchar(500) DEFAULT NULL,
  `path_pago` varchar(500) DEFAULT NULL,
  `autorizaciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`autorizaciones`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_oc`
--

INSERT INTO `tbl_oc` (`id`, `oc`, `proveedor`, `forma_pago`, `convenio`, `plazo_entrega`, `det_orm`, `orm`, `monto_parcial`, `monto_iva`, `monto_total`, `presupuesto`, `factura`, `observacion`, `descuentos`, `impuestos`, `status`, `cuotas`, `terceros`, `path_factura`, `path_pago`, `autorizaciones`, `created_at`, `updated_at`) VALUES
(1, 'OC0001-2026', 9, 2, 12, 62, '\"40\"', 'ORM15-2026', 86187.72, 16375.67, 102563.39, 131074.58, 'FAC-02700373', 'Minus et et voluptatem quo vitae est eligendi voluptas. Dolorem est et aut aut est. Aut expedita sapiente voluptates laborum quibusdam nam quia.', 0.00, 0.00, 0, 9, 1, 'http://rosenbaum.com/a-odio-dolores-adipisci-blanditiis', 'http://stoltenberg.com/at-ut-ullam-unde-assumenda-dignissimos-est-minima.html', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(2, 'OC0002-2026', 16, 12, 6, 44, '\"8\"', 'ORM9-2026', 63324.04, 12031.57, 75355.61, 196224.21, 'FAC-76683717', 'Laborum suscipit est est adipisci. Saepe enim quia minima perspiciatis sed. Consequatur voluptatem occaecati sunt.', 3712.32, 4784.79, 1, 2, 0, NULL, 'http://skiles.com/voluptas-at-nesciunt-expedita-quod-quae-magni-laudantium', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(3, 'OC0003-2026', 28, 2, 11, 45, '\"23\"', 'ORM20-2026', 37693.34, 7161.73, 44855.07, NULL, NULL, NULL, 0.00, 1251.73, 0, 4, 0, 'http://www.larson.com/aliquid-iure-assumenda-sunt-consequuntur-amet-dolor.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(4, 'OC0004-2026', 10, 7, 1, 87, '\"4\"', 'ORM14-2026', 86526.05, 16439.95, 102966.00, NULL, NULL, 'Sed et voluptatem occaecati molestias. Tenetur illo dolorum odit ut eligendi sed exercitationem. Dignissimos aut et libero illum alias libero. Sed repellat et rerum. Unde quo ipsum minima voluptates.', 0.00, -778.47, 1, 3, 1, 'http://bernhard.net/', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(5, 'OC0005-2026', 4, 11, 16, 82, '\"20\"', 'ORM10-2026', 51074.66, 9704.19, 60778.85, 21074.79, 'FAC-69078954', 'Quia dolores recusandae ex totam fugiat. Molestiae enim debitis voluptates est amet. Alias quis similique minima et eligendi sequi sint nam. Quod reiciendis dolores vel nihil.', 0.00, -431.33, 1, 1, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(6, 'OC0006-2026', 8, 6, 17, 33, '\"1\"', 'ORM18-2026', 92217.63, 17521.35, 109738.98, NULL, 'FAC-96010830', NULL, 0.00, -256.41, 1, 2, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(7, 'OC0007-2026', 7, 4, 10, 82, '\"39\"', 'ORM6-2026', 99286.26, 18864.39, 118150.65, 97093.09, NULL, NULL, 0.00, -138.78, 1, 5, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(8, 'OC0008-2026', 25, 3, 9, 55, '\"46\"', 'ORM23-2026', 76645.25, 14562.60, 91207.85, 157502.20, 'FAC-01523960', 'Aperiam vel consequatur fuga sed. Qui natus corporis aperiam rerum quis. Dolorem et voluptas adipisci. Et quaerat maxime quas id. Soluta aut voluptate earum.', 0.00, -682.60, 1, 11, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(9, 'OC0009-2026', 23, 5, 19, 65, '\"6\"', 'ORM13-2026', 12105.32, 2300.01, 14405.33, 18823.68, NULL, 'Dolorem est quis ducimus libero necessitatibus sint eos. Dolores qui sunt dolore repellendus amet doloremque voluptas. Fuga omnis nesciunt et enim distinctio ut. Accusantium explicabo ut non ut.', 2012.36, -477.69, 1, 5, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(10, 'OC0010-2026', 18, 12, 16, 10, '\"29\"', 'ORM8-2026', 10829.60, 2057.62, 12887.22, 30661.25, 'FAC-06097411', 'Ut est id incidunt nam. Eveniet qui sed tempore ab sunt. Blanditiis et quis totam sequi cum adipisci deleniti.', 3366.01, 4935.44, 1, 5, 0, 'http://terry.com/eos-cumque-deleniti-tempore', 'http://aufderhar.org/unde-eaque-sit-debitis', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(11, 'OC0011-2026', 32, 3, 5, 22, '\"23\"', 'ORM11-2026', 33594.87, 6383.03, 39977.90, 196868.88, 'FAC-93053365', NULL, 0.00, 364.33, 1, 12, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(12, 'OC0012-2026', 16, 11, 11, 75, '\"6\"', 'ORM17-2026', 38676.87, 7348.61, 46025.48, NULL, NULL, NULL, 0.00, 3501.92, 1, 11, 0, 'http://www.tillman.com/tenetur-blanditiis-aut-explicabo-porro-sunt-et', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(13, 'OC0013-2026', 11, 13, 1, 86, '\"37\"', 'ORM24-2026', 27213.87, 5170.64, 32384.51, NULL, NULL, NULL, 0.00, 0.00, 1, 1, 0, NULL, 'http://emmerich.com/sed-saepe-illum-qui', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(14, 'OC0014-2026', 24, 7, 10, 31, '\"3\"', 'ORM22-2026', 19025.35, 3614.82, 22640.17, 191261.30, NULL, 'Voluptas voluptas ea omnis odio animi ducimus. Unde perspiciatis quo dolore dolorem blanditiis quo.', 1963.83, 0.00, 1, 5, 1, 'http://www.connelly.com/', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(15, 'OC0015-2026', 23, 4, 1, 3, '\"17\"', 'ORM16-2026', 53386.50, 10143.44, 63529.94, 168858.35, NULL, NULL, 0.00, -396.62, 0, 11, 0, 'http://www.gottlieb.com/porro-repellendus-aut-voluptas-tempore-rerum-non-est', 'http://lowe.com/dignissimos-libero-atque-illo-sit-error-minus', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(16, 'OC0016-2026', 19, 9, 15, 82, '\"44\"', 'ORM3-2026', 56707.90, 10774.50, 67482.40, 130705.24, 'FAC-16182699', 'Aliquam alias corporis consectetur illo voluptatum adipisci. Amet et sit id sit. Dolorem possimus aperiam ut ipsam odio.', 0.00, 162.04, 0, 3, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(17, 'OC0017-2026', 31, 2, 20, 29, '\"41\"', 'ORM26-2026', 84151.73, 15988.83, 100140.56, NULL, 'FAC-64155827', NULL, 0.00, 2260.38, 1, 9, 0, 'https://www.hagenes.com/nam-illo-consectetur-animi', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(18, 'OC0018-2026', 29, 9, 2, 62, '\"21\"', 'ORM13-2026', 29206.05, 5549.15, 34755.20, NULL, NULL, 'Incidunt non repellendus distinctio dolor. Et ratione autem vel rerum aut debitis deserunt. Doloremque id consequatur voluptatum. Qui incidunt dolorum amet architecto iusto excepturi.', 0.00, -742.14, 0, 9, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(19, 'OC0019-2026', 9, 10, 8, 24, '\"5\"', 'ORM19-2026', 37908.57, 7202.63, 45111.20, 16214.63, NULL, 'Aut adipisci libero esse adipisci eligendi vel. Non nihil commodi culpa quia eligendi. Eaque quae adipisci soluta autem nihil adipisci voluptatibus. Explicabo aut qui possimus repudiandae.', 2168.36, 0.00, 1, 10, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(20, 'OC0020-2026', 18, 5, 17, 89, '\"45\"', 'ORM6-2026', 25945.00, 4929.55, 30874.55, NULL, NULL, NULL, 0.00, 4667.80, 1, 8, 0, 'http://www.kirlin.com/provident-nulla-voluptate-odio-autem-qui-hic-enim.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(21, 'OC0021-2026', 1, 11, 7, 46, '\"16\"', 'ORM26-2026', 69197.49, 13147.52, 82345.01, NULL, NULL, NULL, 0.00, 3351.20, 1, 4, 0, 'http://www.satterfield.com/aliquam-quis-quo-temporibus-quia-nihil-labore', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(22, 'OC0022-2026', 11, 3, 7, 59, '\"9\"', 'ORM3-2026', 34059.76, 6471.35, 40531.11, NULL, 'FAC-02626942', NULL, 0.00, 335.14, 0, 8, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(23, 'OC0023-2026', 22, 12, 14, 51, '\"20\"', 'ORM11-2026', 69888.06, 13278.73, 83166.79, 79639.16, NULL, 'Iure eos molestias iste accusantium dolore. Libero suscipit quod et sit quia. Quis non sequi qui nulla voluptatem nulla. Laboriosam quia omnis cupiditate in repellat officiis.', 437.81, 4382.09, 1, 3, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(24, 'OC0024-2026', 18, 3, 3, 32, '\"27\"', 'ORM10-2026', 57624.70, 10948.69, 68573.39, 66233.75, 'FAC-82562317', NULL, 2052.82, 4793.23, 1, 5, 1, 'http://www.veum.com/quasi-ratione-quia-eius-minima-sed-saepe-ducimus', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(25, 'OC0025-2026', 1, 9, 5, 18, '\"2\"', 'ORM27-2026', 44637.36, 8481.10, 53118.46, NULL, 'FAC-84708451', NULL, 0.00, 3030.72, 1, 3, 0, NULL, 'http://wiegand.net/est-sint-consequatur-quod-distinctio-magni-dolorem.html', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(26, 'OC0026-2026', 32, 1, 16, 56, '\"30\"', 'ORM29-2026', 35179.66, 6684.14, 41863.80, 137296.63, 'FAC-57234480', 'Accusamus consequatur at illum nesciunt repudiandae. Quia veniam ducimus voluptas recusandae iste. Quisquam facere enim qui dolorem tempora quaerat. Sunt odit harum omnis eum blanditiis laboriosam.', 0.00, 1858.61, 0, 10, 0, NULL, 'http://www.hauck.com/et-quas-omnis-eos-vitae', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(27, 'OC0027-2026', 1, 6, 1, 51, '\"9\"', 'ORM26-2026', 25902.88, 4921.55, 30824.43, 169894.73, 'FAC-03633510', 'Et est illum rerum ut laboriosam ex. Quam fuga repellat iure. Autem molestiae incidunt incidunt facere.', 0.00, -549.11, 1, 3, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(28, 'OC0028-2026', 28, 5, 8, 79, '\"47\"', 'ORM19-2026', 2557.69, 485.96, 3043.65, NULL, 'FAC-40984531', NULL, 705.34, 0.00, 0, 7, 1, 'http://ryan.com/quos-iste-est-inventore-aliquid-aut', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(29, 'OC0029-2026', 12, 11, 6, 81, '\"27\"', 'ORM30-2026', 93196.63, 17707.36, 110903.99, NULL, NULL, NULL, 0.00, 0.00, 1, 2, 0, NULL, 'http://www.blick.com/est-asperiores-ea-illum-est-est-voluptatem-quia', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(30, 'OC0030-2026', 12, 4, 4, 46, '\"23\"', 'ORM13-2026', 51560.97, 9796.58, 61357.55, 194971.79, NULL, NULL, 0.00, 0.00, 0, 4, 0, NULL, 'http://www.dicki.biz/modi-nostrum-quo-sunt-enim-omnis', '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(31, 'OC0031-2026', 5, 7, 13, 74, '\"23\"', 'ORM19-2026', 36060.35, 6851.47, 42911.82, NULL, NULL, 'Ut est magnam velit minus laborum dolore. Placeat autem laborum modi eos. Voluptatem eaque ullam inventore aut. Nisi temporibus ab quo sunt rerum quasi. Sunt voluptatibus similique tempore aut.', 0.00, 1226.20, 1, 8, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(32, 'OC0032-2026', 10, 3, 10, 19, '\"6\"', 'ORM20-2026', 7198.64, 1367.74, 8566.38, 162787.71, 'FAC-53901010', 'Et autem maxime sint quos enim quas occaecati. Qui dolor illo blanditiis unde est. Reprehenderit autem enim nihil quia aperiam.', 0.00, 3166.30, 1, 3, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(33, 'OC0033-2026', 30, 7, 11, 82, '\"23\"', 'ORM27-2026', 25687.95, 4880.71, 30568.66, 18485.42, 'FAC-89516185', NULL, 1776.48, 4363.75, 1, 7, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(34, 'OC0034-2026', 4, 2, 2, 36, '\"16\"', 'ORM29-2026', 14384.31, 2733.02, 17117.33, 154594.37, 'FAC-99214584', NULL, 0.00, 378.51, 1, 12, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(35, 'OC0035-2026', 15, 10, 13, 9, '\"40\"', 'ORM24-2026', 25309.99, 4808.90, 30118.89, 37972.82, 'FAC-96530637', NULL, 2840.53, 0.00, 0, 9, 0, 'https://jaskolski.biz/itaque-repellat-ut-consequuntur-similique-culpa.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(36, 'OC0036-2026', 7, 13, 20, 87, '\"24\"', 'ORM9-2026', 4472.08, 849.70, 5321.78, 17700.78, 'FAC-54812517', NULL, 0.00, 0.00, 0, 5, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(37, 'OC0037-2026', 6, 8, 4, 40, '\"1\"', 'ORM1-2026', 74744.47, 14201.45, 88945.92, 83465.32, 'FAC-08268790', NULL, 0.00, 3311.12, 1, 5, 1, NULL, 'http://www.berge.com/', '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(38, 'OC0038-2026', 2, 3, 13, 84, '\"31\"', 'ORM10-2026', 68858.26, 13083.07, 81941.33, 98552.29, 'FAC-15234854', NULL, 2957.98, -716.91, 1, 4, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(39, 'OC0039-2026', 23, 2, 12, 78, '\"34\"', 'ORM19-2026', 9746.02, 1851.74, 11597.76, NULL, NULL, NULL, 4120.85, 3344.02, 1, 4, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(40, 'OC0040-2026', 22, 2, 7, 4, '\"11\"', 'ORM26-2026', 70233.01, 13344.27, 83577.28, NULL, 'FAC-48958674', 'In ut repellat voluptates. Aut voluptatem odit voluptatem eos quia voluptatem consequatur sit. Et maxime autem officia est accusantium alias. Aut consequatur id inventore numquam at magnam.', 0.00, 0.00, 1, 5, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(41, 'OC0041-2026', 27, 11, 7, 40, '\"49\"', 'ORM22-2026', 38375.67, 7291.38, 45667.05, 28387.02, 'FAC-69886936', 'Aperiam et laboriosam neque qui hic. Exercitationem ullam reiciendis dolore velit qui. Amet et et nulla eius deserunt debitis corporis. Animi dolorem molestiae molestiae vel voluptas.', 1133.55, 3391.55, 1, 12, 0, 'http://www.rolfson.net/', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(42, 'OC0042-2026', 21, 6, 10, 40, '\"39\"', 'ORM20-2026', 20811.37, 3954.16, 24765.53, NULL, 'FAC-95812705', NULL, 0.00, 0.00, 1, 8, 0, 'http://doyle.biz/dignissimos-consequatur-aut-perferendis-libero.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(43, 'OC0043-2026', 6, 1, 20, 86, '\"26\"', 'ORM18-2026', 95098.30, 18068.68, 113166.98, 16982.06, 'FAC-26378981', NULL, 4711.51, 318.12, 1, 12, 0, NULL, 'http://ferry.biz/at-et-eos-dolorem-quidem', '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(44, 'OC0044-2026', 26, 10, 14, 21, '\"35\"', 'ORM15-2026', 41312.76, 7849.42, 49162.18, 192234.30, 'FAC-99745852', 'Culpa nobis doloribus cumque debitis eligendi. Occaecati harum ut porro maxime et itaque ut. Ipsum ut adipisci velit nesciunt delectus. Aliquam vel nulla in non quae.', 1863.05, -520.58, 0, 5, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(45, 'OC0045-2026', 11, 13, 1, 60, '\"9\"', 'ORM7-2026', 51376.01, 9761.44, 61137.45, 107422.90, 'FAC-36301672', NULL, 2776.37, 3535.55, 0, 6, 0, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(46, 'OC0046-2026', 28, 5, 1, 52, '\"17\"', 'ORM17-2026', 48730.64, 9258.82, 57989.46, 144167.94, NULL, 'Veritatis eius nulla ullam voluptatem nemo eius. Consectetur nemo maxime molestiae sit. Placeat non nulla quaerat quaerat et suscipit. Necessitatibus amet dignissimos qui et omnis.', 0.00, 0.00, 1, 10, 1, NULL, 'http://www.schuppe.com/atque-est-consequatur-dolor-quibusdam-ut-culpa-libero', '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(47, 'OC0047-2026', 13, 2, 12, 78, '\"21\"', 'ORM27-2026', 33619.26, 6387.66, 40006.92, NULL, NULL, 'Ut eligendi voluptatem molestiae temporibus. Suscipit quis distinctio illum. Tenetur nisi necessitatibus repudiandae ad. Quia atque odio vero nihil dolor.', 0.00, 1289.32, 1, 1, 0, 'https://steuber.com/eveniet-neque-dolorum-voluptas-ipsam-tempore-neque-impedit.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(48, 'OC0048-2026', 2, 3, 12, 13, '\"27\"', 'ORM30-2026', 9953.57, 1891.18, 11844.75, 8456.39, NULL, NULL, 2159.86, 2837.24, 1, 8, 0, NULL, 'http://www.quitzon.biz/', '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(49, 'OC0049-2026', 28, 4, 20, 69, '\"45\"', 'ORM8-2026', 97573.97, 18539.05, 116113.02, NULL, NULL, 'Quam dolores deserunt et et asperiores beatae ducimus. Molestias sint quo tempore beatae error ratione non quis. Non officiis autem aut temporibus.', 1986.48, -928.35, 1, 2, 1, NULL, NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12'),
(50, 'OC0050-2026', 11, 3, 8, 49, '\"23\"', 'ORM11-2026', 41627.13, 7909.15, 49536.28, 198643.94, 'FAC-20698232', 'Adipisci sed id dolore rerum. Vel maiores suscipit sed veritatis odit temporibus aliquam. Qui sequi veritatis sunt facilis temporibus dicta delectus.', 2737.73, 0.00, 1, 10, 0, 'http://www.watsica.com/nobis-officia-fugiat-recusandae-facere-ut-non-nihil.html', NULL, '\"[0,0,0]\"', '2026-07-04 00:17:12', '2026-07-04 00:17:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_orm`
--

CREATE TABLE `tbl_orm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orm` varchar(15) NOT NULL,
  `responsable` bigint(20) UNSIGNED NOT NULL,
  `comprador` bigint(20) UNSIGNED DEFAULT NULL,
  `cdc` bigint(20) UNSIGNED NOT NULL,
  `adn` bigint(20) UNSIGNED NOT NULL,
  `sitio` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `terceros` tinyint(1) NOT NULL DEFAULT 0,
  `tipo` enum('Administrativa','OTI','Faena','Mantenimiento') DEFAULT NULL,
  `prioridad` enum('sin prioridad','normal','emergencia') NOT NULL DEFAULT 'sin prioridad',
  `descripcion` varchar(255) DEFAULT NULL,
  `patente` varchar(20) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `obs_costos` text DEFAULT NULL,
  `obs_orm` text DEFAULT NULL,
  `obs_bodega` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_orm`
--

INSERT INTO `tbl_orm` (`id`, `orm`, `responsable`, `comprador`, `cdc`, `adn`, `sitio`, `status`, `terceros`, `tipo`, `prioridad`, `descripcion`, `patente`, `archivo`, `obs_costos`, `obs_orm`, `obs_bodega`, `created_at`, `updated_at`) VALUES
(1, 'ORM1-2026', 13, 14, 21, 7, 6, 0, 1, 'OTI', 'sin prioridad', 'Est deserunt ex et sequi.', NULL, NULL, NULL, 'Aut officia corrupti quisquam voluptatem fugit. Maxime sequi sit saepe error sit et voluptas. Ut tenetur qui et reiciendis rerum sit quo. Earum nesciunt qui explicabo consequatur veritatis amet.', 'Quam vel qui aut et.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(2, 'ORM2-2026', 15, 16, 22, 8, 7, 1, 1, 'OTI', 'sin prioridad', 'Impedit minus aliquid natus qui.', NULL, NULL, NULL, 'Sit sunt quidem qui optio perspiciatis maiores odit. Saepe impedit occaecati fugiat laudantium perferendis. Quam et commodi omnis id voluptas. At veritatis sed voluptatem unde consequatur nihil quam.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(3, 'ORM3-2026', 17, 18, 23, 9, 8, 1, 0, 'OTI', 'sin prioridad', 'Ut animi esse in earum eum.', 'SS-CW-23', NULL, NULL, 'Incidunt et excepturi et esse accusamus. Sint qui tempore dolorem. Qui eveniet facere adipisci doloribus corrupti ratione dolores.', 'Odit magni aut consequatur magnam sint cumque commodi.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(4, 'ORM4-2026', 19, 20, 24, 10, 9, 1, 0, 'Mantenimiento', 'normal', 'Sequi sed nisi odio ipsum et.', 'OG-SS-48', NULL, NULL, 'Quia fugiat nihil impedit labore qui. Libero et cumque nihil quasi quidem. Quisquam illum accusantium labore.', 'Repudiandae libero iure dolorum quo harum sit.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(5, 'ORM5-2026', 21, 22, 25, 11, 10, 1, 0, 'Mantenimiento', 'emergencia', 'Occaecati similique quos itaque quas.', 'DP-RQ-88', NULL, 'Veniam vel dolorem quia non consequatur quidem aut facere.', 'Voluptatibus inventore veritatis ratione officia et beatae aut consequatur. Dolores exercitationem fugiat non quia alias. Et rerum eligendi non perspiciatis quis nam.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(6, 'ORM6-2026', 23, 24, 26, 12, 11, 1, 0, 'OTI', 'sin prioridad', 'Et amet dolores natus molestiae.', NULL, NULL, NULL, NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(7, 'ORM7-2026', 25, 26, 27, 13, 12, 0, 0, 'Faena', 'sin prioridad', 'Veniam aperiam voluptate ut facilis.', NULL, NULL, NULL, 'Sint fugiat qui adipisci aliquam ut reiciendis repellat. Fuga non aliquid eligendi aut molestias. Quis sit enim ipsum earum consectetur corporis dolor. Eaque voluptatum nihil dolorem aut et vel.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(8, 'ORM8-2026', 27, 28, 28, 14, 13, 0, 1, 'Administrativa', 'sin prioridad', 'Voluptatem laudantium autem ab vel.', NULL, NULL, NULL, 'Id labore voluptatem aspernatur mollitia perferendis. Qui maxime atque deleniti reiciendis voluptas delectus ipsa. Quis accusantium maiores expedita eum ab dolore. Soluta quaerat voluptas suscipit est itaque voluptas.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(9, 'ORM9-2026', 29, 30, 29, 15, 14, 1, 0, 'Faena', 'normal', 'Voluptates consequatur quod rerum.', NULL, 'C:\\Users\\Informática\\AppData\\Local\\Temp\\fakDC2E.tmp', NULL, NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(10, 'ORM10-2026', 31, 32, 30, 16, 15, 0, 0, 'Faena', 'sin prioridad', 'Natus aut quia provident modi quaerat.', NULL, NULL, NULL, NULL, 'Eaque quas ad quo corporis assumenda et.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(11, 'ORM11-2026', 33, 34, 31, 17, 16, 1, 0, 'Faena', 'emergencia', 'Aut sed tenetur et praesentium enim.', NULL, NULL, 'Molestias molestias deleniti inventore maxime est ab adipisci vitae.', NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(12, 'ORM12-2026', 35, 36, 32, 18, 17, 1, 1, 'Faena', 'sin prioridad', 'Alias quidem ipsa voluptas et nostrum.', 'PU-XA-13', NULL, 'Dolore nihil labore cum eum totam.', 'Esse cumque qui iste eaque. Impedit modi sed perspiciatis sapiente sint veritatis. Aut aut officiis non voluptatem autem totam est labore. Est qui ut corrupti rerum tenetur.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(13, 'ORM13-2026', 37, 38, 33, 19, 18, 1, 0, 'Faena', 'emergencia', 'Nihil et modi voluptatum blanditiis.', NULL, NULL, 'Iusto consequatur reprehenderit voluptatem architecto quia.', 'Blanditiis consequatur sunt doloribus consequatur tempore sed. Ratione est omnis odit cumque. Excepturi adipisci ipsam minima excepturi.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(14, 'ORM14-2026', 39, 40, 34, 20, 19, 1, 0, 'Mantenimiento', 'emergencia', 'Et ea est occaecati quia vitae.', NULL, NULL, 'Veritatis nihil illum earum.', 'Id enim maxime sequi quo a alias corrupti doloribus. Esse voluptate beatae nobis ullam eveniet id. Omnis officiis quo nobis ut.', 'Enim sunt dicta vero provident est repudiandae quae.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(15, 'ORM15-2026', 41, 42, 35, 21, 20, 1, 0, 'OTI', 'emergencia', 'Consequatur omnis hic quis provident.', NULL, NULL, 'Facilis perferendis accusamus aspernatur.', 'Quaerat corporis non voluptas ut. Quis rerum omnis et officiis rerum ad. Quis et soluta perspiciatis non at vel sed. A dolorem soluta natus id recusandae error non.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(16, 'ORM16-2026', 43, 44, 36, 22, 21, 0, 0, 'Faena', 'sin prioridad', 'Et qui quam non.', NULL, 'C:\\Users\\Informática\\AppData\\Local\\Temp\\fakED27.tmp', 'Et amet dignissimos excepturi voluptas vel sint quos.', NULL, 'Nisi assumenda sapiente facilis alias ea omnis asperiores.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(17, 'ORM17-2026', 45, 46, 37, 23, 22, 1, 0, 'Faena', 'sin prioridad', 'Aut aliquid voluptatem officiis aut.', NULL, 'C:\\Users\\Informática\\AppData\\Local\\Temp\\fakEFA9.tmp', NULL, 'Dolorum est voluptatem sint deserunt. Illo assumenda aliquid aperiam exercitationem quam quo et.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(18, 'ORM18-2026', 47, 48, 38, 24, 23, 1, 1, 'Faena', 'sin prioridad', 'Nisi dolor sed aut autem autem.', 'NX-DN-59', NULL, NULL, 'Tenetur repellat voluptatem in sint quaerat deleniti incidunt accusamus. Sit et perspiciatis a. Nostrum expedita doloribus tempore pariatur facilis voluptas. Accusamus illum ipsa quia voluptas qui modi error.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(19, 'ORM19-2026', 49, 50, 39, 25, 24, 1, 0, 'OTI', 'sin prioridad', 'Illo ipsum id cupiditate.', NULL, NULL, NULL, 'Omnis tempora facilis fugit. Ut hic sit quia tempore repudiandae consequuntur libero. Facilis et voluptas officiis.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(20, 'ORM20-2026', 51, 52, 40, 26, 25, 1, 0, 'Mantenimiento', 'sin prioridad', 'Iure ut quo eius sint nulla.', NULL, NULL, 'Consequatur dolores voluptate incidunt.', 'Dolores aut vitae molestiae id et rerum voluptate. Consequuntur sint atque omnis eius adipisci atque nihil. Placeat laborum officia ut. Optio iure voluptatum dolore.', 'Omnis quasi hic sed minus optio repellendus.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(21, 'ORM21-2026', 53, 54, 41, 27, 26, 1, 0, 'Faena', 'normal', 'Explicabo ipsam et eos pariatur error.', 'XI-GM-00', NULL, 'Sit harum hic sed.', 'Aut temporibus illum aut voluptatem voluptate et. Nesciunt autem ex fugit temporibus. Dolorum vel minima consequatur possimus earum eum.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(22, 'ORM22-2026', 55, 56, 42, 28, 27, 1, 0, 'Administrativa', 'sin prioridad', 'Rem ratione sit odio nihil.', NULL, NULL, 'Qui esse ullam in facilis at.', 'Explicabo unde laboriosam rerum et qui et. Nihil aut nemo incidunt voluptatem pariatur. Aut aliquid non enim quis quia ipsum debitis voluptate.', 'Labore quam tempore cumque eos tempore.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(23, 'ORM23-2026', 57, 58, 43, 29, 28, 0, 0, 'OTI', 'emergencia', 'Consequuntur quia aut et.', NULL, NULL, 'Qui iure earum placeat nostrum quam.', NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(24, 'ORM24-2026', 59, 60, 44, 30, 29, 0, 0, 'Administrativa', 'emergencia', 'Ipsam ducimus numquam dolorem illum.', NULL, NULL, NULL, 'Itaque nulla corrupti enim nemo eum accusamus. Vel quam doloremque necessitatibus. Sed fuga voluptatem quibusdam voluptas totam incidunt sit. Velit sunt quod dolores et rerum ex.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(25, 'ORM25-2026', 61, 62, 45, 31, 30, 1, 0, 'Faena', 'sin prioridad', 'Facilis quam nulla suscipit sunt earum.', NULL, NULL, NULL, 'Deleniti possimus atque totam tenetur enim quia et. Eos eos quam delectus iusto. Minima libero vel asperiores ut delectus aut laudantium. Fugit incidunt provident doloribus error accusamus.', NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(26, 'ORM26-2026', 63, 64, 46, 32, 31, 0, 0, 'Administrativa', 'sin prioridad', 'Rerum est provident animi aut.', NULL, NULL, 'Hic rerum et praesentium aut.', NULL, 'Aperiam deleniti voluptatem repellendus qui.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(27, 'ORM27-2026', 65, 66, 47, 33, 32, 1, 0, 'OTI', 'sin prioridad', 'Quis tempora mollitia quaerat.', 'OW-RL-27', NULL, NULL, NULL, 'Quis dolorum sit ut est id.', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(28, 'ORM28-2026', 67, 68, 48, 34, 33, 0, 0, 'Administrativa', 'emergencia', 'Ratione qui mollitia consequatur nihil.', NULL, NULL, 'Nostrum earum libero sint placeat est et.', NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(29, 'ORM29-2026', 69, 70, 49, 35, 34, 1, 0, 'Mantenimiento', 'emergencia', 'Repellendus nobis debitis rerum velit.', NULL, NULL, 'Ipsam rerum laborum pariatur pariatur sit ullam.', NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(30, 'ORM30-2026', 71, 72, 50, 36, 35, 1, 1, 'OTI', 'sin prioridad', 'Et explicabo dolorem quas consequatur.', NULL, NULL, NULL, NULL, NULL, '2026-07-04 00:17:10', '2026-07-04 00:17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `unidad` varchar(20) NOT NULL,
  `categoria` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id`, `nombre`, `unidad`, `categoria`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pintura látex', 'UND', 4, 0, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'Cinta transportadora Alta resistencia', 'UND', 1, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'Lubricante industrial', 'UND', 6, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'Chaleco reflectante Plus', 'UND', 3, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Solvente industrial Plus', 'UND', 6, 0, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Extintor PQS', 'UND', 3, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'Certificación equipos', 'UND', 7, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 'Pizarra acrílica Plus', 'UND', 8, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 'Aceite hidráulico ISO 46', 'LTS', 6, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 'Gata hidráulica 1/2\"', 'UND', 2, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 'Colector', 'UND', 1, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 'Queroseno 1/2\"', 'UND', 6, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 'Gasolina 93 5/8\"', 'UND', 6, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(14, 'Muestreo de fluidos', 'UND', 7, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(15, 'Cerámica piso Reforzado', 'UND', 4, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(16, 'Cal viva', 'TON', 1, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(17, 'Grava', 'UND', 4, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(18, 'Chaleco reflectante 150mm', 'UND', 3, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(19, 'Aceite de motor 15W40 Alta resistencia 1/2\"', 'UND', 6, 0, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(20, 'Calibración instrumentos', 'UND', 7, 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(21, 'Soldadora inverter', 'UND', 2, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(22, 'Inspección técnica', 'UND', 7, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(23, 'Balasto electrónico 200mm', 'UND', 5, 0, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(24, 'Refrigerante Industrial', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(25, 'Forros de Molino Grado alimenticio 100mm', 'UND', 1, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(26, 'Tóner impresora', 'UND', 8, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(27, 'Hierro corrugado', 'UND', 4, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(28, 'Grasa litio 3/4\"', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(29, 'Bloques de hormigón', 'UND', 4, 0, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(30, 'Medidor de energía', 'UND', 5, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(31, 'Gasolina 93 Grado alimenticio', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(32, 'Reactivos de flotación Antiácido', 'UND', 1, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(33, 'Petróleo crudo Pro', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(34, 'Yeso', 'UND', 4, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(35, 'Cinta transportadora', 'UND', 1, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(36, 'Tubo fluorescente', 'UND', 5, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(37, 'Biodiésel Grado alimenticio 1/2\"', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(38, 'Inspección técnica Pro', 'UND', 7, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(39, 'Vigas de acero', 'UND', 4, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(40, 'Lima rotativa', 'UND', 2, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(41, 'Solvente industrial Reforzado', 'UND', 6, 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(42, 'Queroseno Plus 5/8\"', 'UND', 6, 0, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(43, 'Lentes de seguridad Grado alimenticio 1\"', 'UND', 3, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(44, 'Generador eléctrico 100mm', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(45, 'Forros de Molino', 'UND', 1, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(46, 'Carpetas oficio Premium', 'UND', 8, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(47, 'Arnés de seguridad', 'UND', 3, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(48, 'Cepillo eléctrico Alta resistencia', 'UND', 2, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(49, 'Cerámica piso 1/2\"', 'UND', 4, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(50, 'Queroseno Eco 1/2\"', 'UND', 6, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(51, 'Carpetas oficio 2\"', 'UND', 8, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(52, 'Polipasto eléctrico Standard', 'UND', 2, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(53, 'Guantes de nitrilo', 'UND', 3, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(54, 'Lámpara LED', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(55, 'Tapones auditivos', 'UND', 3, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(56, 'Cinta transportadora Plus', 'UND', 1, 0, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(57, 'Cerámica muro Alta resistencia 5/8\"', 'UND', 4, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(58, 'Celdas de flotación Reforzado', 'UND', 1, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(59, 'Transformador', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(60, 'Combustible diésel', 'UND', 6, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(61, 'Gata hidráulica', 'UND', 2, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(62, 'Cal hidratada Premium', 'UND', 1, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(63, 'Cerámica muro', 'UND', 4, 0, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(64, 'Lima rotativa', 'UND', 2, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(65, 'Tubo fluorescente', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(66, 'Grapadora industrial 150mm', 'UND', 8, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(67, 'Interruptor termomagnético 3/4\"', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(68, 'Aislante térmico', 'UND', 4, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(69, 'Tubo fluorescente', 'UND', 5, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11'),
(70, 'Andamio industrial', 'UND', 2, 1, '2026-07-04 00:17:11', '2026-07-04 00:17:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rut` varchar(20) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`id`, `rut`, `razon_social`, `status`, `created_at`, `updated_at`) VALUES
(1, '760000001', 'Empresa de Servicios Tecnológicos SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(2, '765432101', 'Construcciones y Montajes Ltda', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(3, '769876543', 'Suministros Industriales SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(4, '765432109', 'Servicios de Alimentación SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(5, '760123456', 'Limpieza y Mantenimiento Ltda', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(6, '777777777', 'Distribuidora Eléctrica Metropolitana', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(7, '788888888', 'Papelería y Útiles de Oficina SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(8, '799999999', 'Transportes y Logística Rápida Ltda', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(9, '498588220', 'Price Group SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(10, '235981076', 'Sanford, Douglas and Emmerich SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(11, '496344375', 'Kutch, Roberts and Kuhlman SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(12, '235583054', 'Keebler-Wuckert Ltda', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(13, '269848162', 'Wisoky Inc Ltda', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(14, '482037461', 'Schmeler-Armstrong SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(15, '79135186', 'Okuneva, Hagenes and Flatley Ltda', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(16, '141227823', 'Pacocha, Rau and Conn SRL', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(17, '374865196', 'Boyle, Reichert and Kunde SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(18, '23748486K', 'Mosciski LLC SRL', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(19, '28877143K', 'Champlin-Walter SRL', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(20, '390842813', 'Barrows PLC SA', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(21, '274814055', 'Klein, Cormier and Bashirian SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(22, '196308989', 'Considine-Huel SRL', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(23, '424535265', 'Lynch-Smith SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(24, '60622825', 'Goodwin, Oberbrunner and Ernser SRL', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(25, '112722734', 'Schmeler and Sons SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(26, '262408639', 'Smith LLC SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(27, '274105437', 'Farrell, Bailey and West SA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(28, '62358157', 'Abernathy Inc SpA', 1, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(29, '256251787', 'Jerde, Denesik and Corkery SpA', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(30, '354047810', 'Feest, Gusikowski and Parker SpA', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(31, '38490940K', 'Volkman-Harvey Ltda', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(32, '350712844', 'Hirthe, Emard and Hermann SRL', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(33, '36167254', 'Bashirian Group SpA', 0, '2026-07-04 00:16:46', '2026-07-04 00:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `guard_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `nombre`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin', '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(2, 'Comprador', 'comprador', '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(3, 'Solicitante', 'solicitante', '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(4, 'Jefe de Bodega', 'jefe_bodega', '2026-07-04 00:16:46', '2026-07-04 00:16:46'),
(5, 'Perfil básico', 'perfil_basico', '2026-07-04 00:16:46', '2026-07-04 00:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sitios`
--

CREATE TABLE `tbl_sitios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_sitios`
--

INSERT INTO `tbl_sitios` (`id`, `descripcion`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Puerto de Embarque', 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(2, 'Puerto de Embarque', 0, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(3, 'Oficina Central', 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'Planta Norte', 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Puerto de Embarque', 1, '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Centro de Distribución', 1, '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(7, 'Planta Norte', 0, '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(8, 'Planta Sur', 1, '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(9, 'Planta Norte', 1, '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(10, 'Centro de Distribución', 1, '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(11, 'Planta Sur', 1, '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(12, 'Oficina Central', 1, '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(13, 'Puerto de Embarque', 1, '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(14, 'Mina El Tesoro', 1, '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(15, 'Centro de Distribución', 1, '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(16, 'Planta Sur', 1, '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(17, 'Centro de Distribución', 1, '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(18, 'Centro de Distribución', 0, '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(19, 'Puerto de Embarque', 1, '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(20, 'Mina El Tesoro', 1, '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(21, 'Planta Norte', 1, '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(22, 'Planta Norte', 1, '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(23, 'Oficina Central', 1, '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(24, 'Mina El Tesoro', 1, '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(25, 'Centro de Distribución', 1, '2026-07-04 00:17:03', '2026-07-04 00:17:03'),
(26, 'Oficina Central', 1, '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(27, 'Planta Norte', 1, '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(28, 'Oficina Central', 1, '2026-07-04 00:17:05', '2026-07-04 00:17:05'),
(29, 'Puerto de Embarque', 1, '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(30, 'Oficina Central', 1, '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(31, 'Mina El Tesoro', 1, '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(32, 'Planta Norte', 1, '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(33, 'Planta Sur', 1, '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(34, 'Oficina Central', 1, '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(35, 'Oficina Central', 1, '2026-07-04 00:17:10', '2026-07-04 00:17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `rol` bigint(20) UNSIGNED NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `status`, `rol`, `foto_perfil`, `firma`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'rmejiam.dev@gmail.com', '$2y$12$A1zpbQRj3nMEBIZg./mrbeZTUIlsucVZp5nIkxZVerUbxRBQlfbRm', 1, 1, NULL, NULL, NULL, '2026-07-04 00:16:47', '2026-07-04 00:16:47'),
(2, 'Sin asignar', 'comprador@sistema.com', '$2y$12$9COFQqCbZMHJEynm423wwukD6gRW7XSZCVyXyWzjC1Th5Haxx0V0C', 1, 2, NULL, NULL, NULL, '2026-07-04 00:16:47', '2026-07-04 00:16:47'),
(3, 'Ken Crooks', 'ruben.goldner@example.net', '$2y$12$8JciAjioppN2IiMSkxa.u.yWUCYnjVQbVaQOHIpjXh/Jm8TropARO', 1, 2, NULL, NULL, 'ee6d8562-6767-39f3-a862-299f193540dd', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(4, 'Hilma Wehner', 'aschmitt@example.org', '$2y$12$.zK74GSOdfThVlvWDV34ae8uldCQCNvRBfgRfwyh3Q5dKPRz9hCDq', 0, 4, NULL, NULL, 'c77e514a-999e-3167-a02a-d5f78db2f160', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(5, 'Octavia Beier', 'cschowalter@example.org', '$2y$12$e8PtW2VX8D2csRDP.twwluxfQfC386q0U5sNsbBVd2X.m9eGxEWd6', 1, 2, NULL, NULL, '6fa68528-9742-38c0-a250-429adad2618e', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(6, 'Isadore Windler', 'greyson25@example.com', '$2y$12$Lf64VJT30cFIydnirXcA0OXqpnKgMBE47QMRrT10EXfLVEqWp2mJi', 1, 1, NULL, NULL, 'fca6fa90-b8b3-3e86-b223-91e041bc293e', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(7, 'Dr. Keira Murazik', 'gutkowski.nestor@example.org', '$2y$12$V.Q2NbQrR2TNMv3Tcvul9elw9JzZOrhzy7qMJuWWPOutDNiLniPu2', 1, 4, NULL, NULL, 'a544c936-8f85-3f59-a43a-b516d6529dc2', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(8, 'Mrs. Vita Grady Sr.', 'mariane70@example.org', '$2y$12$zTYp/MpnqXjpg4L07BrVA.yIvcvOJSofereJYpJq6D.WArKGdAvay', 0, 4, NULL, NULL, '1cb5e47b-8607-360b-84b9-f4616e9e85cf', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(9, 'Syble McKenzie', 'davonte.torp@example.com', '$2y$12$aQqd08AzpcRX9mYlW8mtcelSE3xkHGgletz7KB7fOSoqcg5GpJS3.', 0, 5, NULL, NULL, 'c2831f49-ce38-3826-8568-53573b386507', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(10, 'Elody Schulist', 'shawn66@example.net', '$2y$12$.yt.ZmzGX0Vl4vMEYFfqEeERzJZjzKlEJdcMdatxXWRQhQvWZBy0G', 1, 1, NULL, NULL, '7cedad14-7d11-3e58-ad90-ff41ebd3df06', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(11, 'Mr. Cleve Feest', 'rhiannon96@example.org', '$2y$12$1Yo0YkYBXQkSkx/TeO4Mh.5hNbqz2spCDnkUo8UE.8.WeGAg1x646', 1, 4, NULL, NULL, '81d3e28a-9f62-3960-ba5c-0553bbebcc0e', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(12, 'Oda Brekke', 'lang.eliane@example.net', '$2y$12$9NDTaiKJ1hCBo4HW39M4g.oSQrLbwDXqv21/L1rliSWAEPcGP/KNi', 1, 2, NULL, NULL, '9bd7ecb6-bd7f-3896-9c9f-4c264e056035', '2026-07-04 00:16:50', '2026-07-04 00:16:50'),
(13, 'Jaime Hilpert', 'jan30@example.net', '$2y$12$SAg39gmRGqyfTGQIs5Zz1eCi4dlusSCOwuYFqSNpdfSI6xRyud1C6', 1, 4, NULL, NULL, 'caf7a7b0-64ca-3554-b006-cb28eeedd992', '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(14, 'Bell Towne', 'rodriguez.luigi@example.com', '$2y$12$OcokLRzd9/ocwgrajCbY.exNfy3AsdS6KRRb4uJUVmmzJerSS9dba', 1, 1, NULL, NULL, '01deb7a8-b5c6-3d35-afa5-9cbc633c3900', '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(15, 'Alfonso Abbott', 'kiarra.boyle@example.net', '$2y$12$9jcBeMi2mqfkOUVovck0SOtnIA6yMc1nhDofz8APbgIKfbGvG8Rvm', 0, 3, NULL, NULL, '3e6f0db5-e64a-3cd5-8b6e-5435f52e4892', '2026-07-04 00:16:51', '2026-07-04 00:16:51'),
(16, 'Vinnie Flatley', 'kiarra.roberts@example.net', '$2y$12$f3pDi6nEVQrrIOdPQ9YxYOu4tHNX6rAxIev0zMij8gnuWa.FIv4A.', 1, 4, NULL, NULL, '8c1673ac-45ca-38f4-98eb-21cdf7c6d500', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(17, 'Nadia Heaney', 'yoshiko.bashirian@example.com', '$2y$12$m6pC.qhJP9lgKMOWs8nE4u8tSoR06gWqb.V5GfyjVo2Wo0dgJJAm6', 0, 1, NULL, NULL, 'e6c618ab-0ad1-3394-971f-0f0997a0ff99', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(18, 'Miss Hettie Cummings Sr.', 'corwin.alvah@example.org', '$2y$12$JC6LlUXcNLMo0.Yv8DxZXe3/SKAQ6lB4zJ1DH0xXWlAMuWDMT4dcO', 1, 1, NULL, NULL, '3e015f6f-7f1d-3085-8cb2-33f0e0c00564', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(19, 'Demario Lubowitz V', 'parisian.maryse@example.org', '$2y$12$X7mDpxIVdH8sZZeZyupfq.eLD00sMzk357K/9WjjhIjLPi6/aKE9e', 1, 4, NULL, NULL, 'a77dacc5-f608-34d6-a834-607703a3f225', '2026-07-04 00:16:52', '2026-07-04 00:16:52'),
(20, 'Prof. Domingo Frami', 'nhamill@example.net', '$2y$12$RLLuUmdXG5hZSkAaCCeS3e.OpN3UCjok.MfrQbq.zC0Pk9M3x5KXG', 1, 5, NULL, NULL, '29069199-58fd-334a-b8db-cef64cf5d56f', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(21, 'Elda Shields V', 'joshua77@example.net', '$2y$12$K32c15zp4H3SxGLbWaIec.fSHqg1o92S82LGNR5aQaTQHXzzNAMwy', 1, 3, NULL, NULL, '8c15918f-d3b0-36f8-a8b8-b699f3ca1c39', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(22, 'Lavon Padberg', 'homenick.kolby@example.net', '$2y$12$25xMtuST6be.52VFehc8U.dpY26kc.Z5bSrHfXO.hlRy1hW5lXsA6', 1, 4, NULL, NULL, '7e911fcf-1bad-36af-873b-fb920adea6c7', '2026-07-04 00:16:53', '2026-07-04 00:16:53'),
(23, 'Wilfrid Steuber', 'mueller.ryan@example.org', '$2y$12$HhBuS9LYD0DoaMxyOdxtVODxAPQAxfVz0d47LrnJG.vGT6Ie7VUPK', 1, 1, NULL, NULL, '794cd834-3b53-3245-aefb-3f3fd7734e95', '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(24, 'Dr. Christopher Herman Sr.', 'ybaumbach@example.net', '$2y$12$ioUbWB3x0Vc6LkUPQHSSyell0bw3iAHQlcUuBXSRxVf84awhQTcPK', 1, 5, NULL, NULL, 'f79b5cc3-8483-353a-b377-b751f12e1522', '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(25, 'Miss Aurelie Thiel', 'cbailey@example.net', '$2y$12$eWL5l5d56tThYUNq/EX.2uqZLbUw9qCi0t9PP2vp/0iq3mNPseN7O', 1, 4, NULL, NULL, '0b07555d-4648-3b11-9459-737f1a9bf943', '2026-07-04 00:16:54', '2026-07-04 00:16:54'),
(26, 'Mr. Pietro Fadel III', 'dawson.huels@example.org', '$2y$12$p8LJbfrf6Fk53qyWA20pVeSlfh3RBxL40l4TbireWfpismqkP0Ugi', 1, 4, NULL, NULL, '96661a86-9e79-34b6-9e71-9d8e0e2fb1e2', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(27, 'Mr. Trace Stiedemann', 'aileen29@example.net', '$2y$12$nXcvmvNsa5lyjUyduxtjbegqfOCcpEmMRlTcVcPpdlt3Wq81UAISe', 1, 2, NULL, NULL, '943791d4-51d9-3b0b-aedd-8058aab95590', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(28, 'Amalia Green', 'adams.tate@example.org', '$2y$12$uwzCYWLwwHIab0kRDOgFvu6ColiXvXlc1WAsyo5LShIZ4R71VMEJK', 1, 5, NULL, NULL, 'f677e965-a355-3e07-b3ef-1a9beb447911', '2026-07-04 00:16:55', '2026-07-04 00:16:55'),
(29, 'Miss Marielle O\'Reilly', 'priscilla90@example.net', '$2y$12$Re1k1auCewY6dXNiqtQV7e934XZLbQOXPeXYosXS2kzgwkdEH7Dhy', 1, 1, NULL, NULL, '98821857-55b9-370b-8c9a-a9bfa5fcad55', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(30, 'Dr. Estelle Blick III', 'brianne71@example.org', '$2y$12$ysgo7XByAreOFzwfP/tmvO6575p6AW3eDR/5fhHleX8wriTkKNiCy', 1, 4, NULL, NULL, 'cadd17f9-cd1f-34ff-a228-cfbba991d63f', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(31, 'Susan Erdman', 'denesik.norberto@example.org', '$2y$12$ptl/SHO80qwqfFVIxFsdM.K8I65YDKV/AiGzSFSEFjvHPCAN7D73S', 1, 4, NULL, NULL, '18b0e259-f981-3058-b5d8-96107e8b0294', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(32, 'Miss Kyla Metz Jr.', 'armand.mertz@example.org', '$2y$12$Z6mtDYL5YbYuJaAdpxti4.rawOYKOAHc2uuCEc8pyMFrhfNYmKYiC', 1, 4, NULL, NULL, 'd253146c-5673-3b57-ad0a-b4868cae4893', '2026-07-04 00:16:56', '2026-07-04 00:16:56'),
(33, 'Nona Muller V', 'jedidiah.nienow@example.com', '$2y$12$EZUSsjHy6rU5lNz9sGDxn.bYYHLTlrStyy.aQCt.K9VAa/Vl7Fubq', 1, 1, NULL, NULL, '3f24f0bc-36a9-33a9-a926-dd3c7fb5fdcf', '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(34, 'Miss Vergie Hudson', 'magali97@example.com', '$2y$12$dmZ6mYz5hTwRwVW0UEuTLe4wfnqqI88hKnWsqPNPgf1GlXbzFXWRS', 1, 2, NULL, NULL, '40656072-c51b-3520-a94f-9eae5592de51', '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(35, 'Fredrick Price', 'purdy.ruthe@example.net', '$2y$12$vv.L30d01OVbkkFori0useqDCIQMC610lkpgMAwVNOcHTiG8xqKWm', 1, 2, NULL, NULL, '87a4e8e0-6aa2-32ba-aa01-f23651966c77', '2026-07-04 00:16:57', '2026-07-04 00:16:57'),
(36, 'Coy Pacocha', 'curt11@example.com', '$2y$12$cTkc.5rz75LrYchbCFMKvOUAvtYCmroPho.eSLHK8r2SVi0L4RyYy', 1, 1, NULL, NULL, 'c4790110-c02f-3bfc-9f18-c2ffe1ae4ba9', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(37, 'Wanda Mayert IV', 'blanda.florencio@example.net', '$2y$12$VS4TIQpnxY2eLdODWhv4LO.9Lu0gsqDfv9roqRHe17.jbg2TmdlRW', 1, 5, NULL, NULL, '99d296d7-f6ff-340f-9bd6-4988ff5bddbf', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(38, 'Dr. Lyla Rodriguez', 'jschroeder@example.org', '$2y$12$DVHO.f2K.A9wnTEffI1x2eH3G8IqibVmlEKuHk79NftCqnGsKkMYO', 1, 5, NULL, NULL, '65ff7e23-b2ab-3292-83b5-210012a90f14', '2026-07-04 00:16:58', '2026-07-04 00:16:58'),
(39, 'Dr. Anita O\'Connell DVM', 'brandon.weimann@example.org', '$2y$12$7D8lOiZxs.eVlB8cKlUdy.kwPbjOOLER2H7R.Mc/7Nv1mXu9A/ZYS', 1, 2, NULL, NULL, '19967e82-4566-3bc3-9acb-f908069c4087', '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(40, 'Gracie Denesik Jr.', 'hillary.mcclure@example.com', '$2y$12$.apD6dp95txyywiJEWKz9u5/X2lEJiSlAZtiLxaKx434NbRTnn0v.', 1, 3, NULL, NULL, '45fd3274-c77b-3b89-82c2-f3afce007fb4', '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(41, 'Royal Hyatt', 'alexane.sporer@example.com', '$2y$12$0MWHHGOuN8q.CEYnhZmTuedEkTnD.oEUfw/.Dx/xy672mxP3Zloh6', 1, 1, NULL, NULL, 'a419ecfe-8022-37c4-9c11-a14b4d08d4b6', '2026-07-04 00:16:59', '2026-07-04 00:16:59'),
(42, 'Dr. Roselyn Sporer', 'hermann77@example.net', '$2y$12$zmvYWh0bFpUwiOrDXRUHE.4oWKv2t0HJAJKyH4V1sefLXfQsdXXEK', 1, 1, NULL, NULL, '6eee9aeb-63cb-391f-be39-1b10c0b10455', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(43, 'Dr. Guiseppe Kuvalis', 'rosie.hills@example.com', '$2y$12$/kQ/SEWcqSRsd9rs96Y1Fe8C5OfMolLwU/thcHqRMz.RuFWS7kPcu', 0, 4, NULL, NULL, '5074fa56-e859-3b90-88e1-637ae1154e1a', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(44, 'Lester Mohr', 'mterry@example.com', '$2y$12$/3OkMz.wghAGEvb9Ioih8O2oEKRMTfUxt/QljUQiREQybmHqRpwLy', 1, 5, NULL, NULL, '7e6f03c5-5e1a-33e7-987f-f139e9ba1834', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(45, 'Prof. Madge Reynolds MD', 'bdeckow@example.org', '$2y$12$o.xa2uupIfijgejAR38N9eGTw6tCKhrl0BGS1g1giAo1LVrkir14y', 1, 2, NULL, NULL, '4be77d6a-30bc-314a-94a4-c03bbe481c20', '2026-07-04 00:17:00', '2026-07-04 00:17:00'),
(46, 'Nikko Kling', 'raphaelle52@example.org', '$2y$12$h7rZuUzZGWSn5HAJ493ARuCrKKPeCIy.PzwcsAOeZ3I.UDet.pysC', 0, 1, NULL, NULL, '5e24da48-d3f3-31e7-97b9-fc82008b95fa', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(47, 'Antonetta Deckow II', 'maverick.shields@example.com', '$2y$12$PEbZRJ0yPQnCKIhdOqabEOh/OjkBYZwKN3NO963CNAV/KV0ZO8lwW', 1, 1, NULL, NULL, '65ab6b59-2bca-32fa-a019-19b6b3deb674', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(48, 'Jose King PhD', 'bhickle@example.com', '$2y$12$Kl.nKI19FMYP/I2uZ1d7t..eHCL2HF8D0HcojpmOrgfYF256QUW9i', 0, 5, NULL, NULL, 'eb40baff-2a6e-3584-ac6c-a2f2445dd686', '2026-07-04 00:17:01', '2026-07-04 00:17:01'),
(49, 'Mr. Jarvis Glover Sr.', 'greg.renner@example.org', '$2y$12$PrKgbik3qdUpbY0LNVV0V.PZR5.hdWqzrQN0yw.LTBAJcELLbfcqi', 0, 3, NULL, NULL, '9385ae67-8c88-3a13-85e1-dd02af93e776', '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(50, 'Celine Daugherty', 'roy95@example.com', '$2y$12$zuy39XOwS0RS9dtzY0RGT.EtFhzxFNP9QiVTIv6si1B9hH0J61sqS', 1, 1, NULL, NULL, '748b8a20-0178-307f-8e61-b6e3cfe5fc08', '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(51, 'Emmy Kertzmann', 'onie47@example.org', '$2y$12$NJ6VlX6MozpDwqSmzU8DyeuoZJz5hBZS4TBI1E91thcXBBCNw3t2u', 1, 4, NULL, NULL, '4e9fe864-f523-3253-bf82-cf1b7cfee086', '2026-07-04 00:17:02', '2026-07-04 00:17:02'),
(52, 'Florencio Ledner', 'phessel@example.com', '$2y$12$7sqDduAcOhq26sxg8YT1Au52MjAW2v0tiGvvrucCJMN2miwr8BVvW', 0, 4, NULL, NULL, '71ddcd7c-764a-34af-853c-ba3f708b39e9', '2026-07-04 00:17:03', '2026-07-04 00:17:03'),
(53, 'Malachi Stehr', 'iward@example.org', '$2y$12$/kTXAeNr83l4N7QBqG7rt.n.CRgVkhjbCKvrYDm3NrylEIoQYl.ce', 1, 4, NULL, NULL, '6f2bf55f-c353-354e-b680-7c408cdc7fb0', '2026-07-04 00:17:03', '2026-07-04 00:17:03'),
(54, 'Leda Koss', 'jeffrey40@example.net', '$2y$12$j.GEQ9Ln4nYbyj5//SZhjO0clLam/dUcJlH60LfP4TUOg55RGs4jC', 1, 2, NULL, NULL, '5f384eff-b924-30f3-8c65-0c372176c4ac', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(55, 'Mr. Johnson Green', 'domingo20@example.com', '$2y$12$d527xjoSnbgyfULrOqY5QO3HSWVHlfUOEM0afYYxkAMDC1DstNmq.', 1, 5, NULL, NULL, 'fdb845f7-289b-3999-a67c-0b8f33d156fd', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(56, 'Christy Crist', 'tillman.alek@example.net', '$2y$12$7toL/SbAClFAWkMDnf1qvu0kuzbtc40jpI5Ldi.jhYvRcG5MJb.76', 0, 4, NULL, NULL, 'e2bb751d-cfc6-3b6b-aea1-6c4dd87de126', '2026-07-04 00:17:04', '2026-07-04 00:17:04'),
(57, 'Daisy Schulist', 'kirlin.laurence@example.org', '$2y$12$05qDCAK9HSLcQUMeiYFG2OKRr8b47j1e.5XVkksSXJs7848zxbxdq', 1, 3, NULL, NULL, '12cee5bf-0131-3498-bc6c-cd2294f26b01', '2026-07-04 00:17:05', '2026-07-04 00:17:05'),
(58, 'Furman Weissnat', 'tierra40@example.com', '$2y$12$hmwgyIGItVX1qmsRd5SV4ORzU/trLP5wDaRkyg/sprMIzfHQsa6UG', 1, 5, NULL, NULL, '44334ea0-e503-37cc-9f4c-40cc970d879f', '2026-07-04 00:17:05', '2026-07-04 00:17:05'),
(59, 'Katelin Sauer', 'pjast@example.com', '$2y$12$tW0YTNtno94eCIMoLAGRzeoFAFlFRUhOiuA0aDTS7B9A8Bl5Ody/q', 0, 4, NULL, NULL, '7ba71b53-c092-3d03-8458-468bf4520aaf', '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(60, 'Augustine Pagac V', 'iva70@example.net', '$2y$12$IRoFMpmzp4iaX2oe8MHizu3OkDq8nJXg6UR6g/Cp5FrCqAB9GnTQG', 1, 4, NULL, NULL, '7664917d-d821-302c-a129-cac8f470dd28', '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(61, 'Princess Reilly', 'ryan31@example.org', '$2y$12$/M3WSVpJadpgTCmPNZTRh.kxO7ecJMbGrQqw/.I2aNCAEF2ZXTA6i', 1, 5, NULL, NULL, 'd3ca04ab-7a57-36eb-9527-8d362e147454', '2026-07-04 00:17:06', '2026-07-04 00:17:06'),
(62, 'Lonny Hoeger', 'marta.vandervort@example.org', '$2y$12$J6qtAId07BM89D9yIImbQu5oaXlyL1MDwYlAOVwHtvvfoIdjmbSty', 0, 5, NULL, NULL, '2dbfbc20-d760-3ff0-8fb5-a32f9e0a4a2b', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(63, 'Alaina Osinski', 'sarina03@example.org', '$2y$12$4RzakEnVC.LYubBI6iUGSeYHRcFuCZxjKrs28AdsyDKsZuBdhC.Ha', 1, 4, NULL, NULL, '4e2d12ae-827e-346e-a749-c99eb6687707', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(64, 'Dr. Willow Heller IV', 'lacey42@example.org', '$2y$12$SVXf5HqdcutaOJtuqFnWou.bwTllK6LC1yFsY3A2pRtL046o86ObS', 1, 4, NULL, NULL, 'e7f25bd2-453e-3e7f-b41f-100c0f2a9191', '2026-07-04 00:17:07', '2026-07-04 00:17:07'),
(65, 'Mabel White', 'anibal75@example.com', '$2y$12$.qobbLv88nurP4JIPHjfoOUhAfmTcI54J4G5TzJqOPxdoOhZH9w02', 1, 2, NULL, NULL, '3de3fcd1-3ac4-3e25-a0aa-a5c2dd29c7d3', '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(66, 'Halle Tromp Sr.', 'luigi.gutmann@example.net', '$2y$12$UVROFaputhotyeCMSqPqJOF6B9Gkj673qPiqUFd2NwGcMa7J0W182', 1, 1, NULL, NULL, '15617100-9749-3263-ab0d-ae38811536bf', '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(67, 'Cora Hansen', 'gabriella68@example.org', '$2y$12$oYsqzw3jxufN5YpTtDEpWOXcaZnGF/QlaOeGxy/rhlzSiszHdh70W', 1, 2, NULL, NULL, 'ed97d38e-57e4-3b05-96eb-5b555a155d66', '2026-07-04 00:17:08', '2026-07-04 00:17:08'),
(68, 'Estelle Von I', 'kenya.towne@example.com', '$2y$12$Q3LVYq8fbQBkNyE2cbu8Cu9HFihW4tSJI.l3SdQtBCPWyK4R04mpS', 1, 1, NULL, NULL, 'ef373eac-3550-39a4-9168-6779e02db426', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(69, 'Bennie Hodkiewicz', 'romaguera.lesly@example.com', '$2y$12$fLhvc9Hg9h4HedtftG3cj.OQRD1iK9LuEPT//5MOBA4UhRISYWhAC', 0, 1, NULL, NULL, '5e3275c0-2067-318a-8f7d-a5c1413643dc', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(70, 'Torey Schuppe I', 'oquitzon@example.net', '$2y$12$U2QHgbCwT71N44/hOkmDueHnARqETptcwIzh7JZ3h/wQC.xrzqvRe', 1, 4, NULL, NULL, '081272b6-10ac-352d-ae1a-50afce9f3362', '2026-07-04 00:17:09', '2026-07-04 00:17:09'),
(71, 'Prof. Ole Gulgowski', 'elisha82@example.org', '$2y$12$tl7Ux16HD3InW1/x0rugt.Ls6Sz3uX4VzhhTUm6Tq3LSrL4sLX1gK', 1, 1, NULL, NULL, '8470a76e-f08c-3cc4-9442-760d5ff1620f', '2026-07-04 00:17:10', '2026-07-04 00:17:10'),
(72, 'Mr. Jocelyn Rutherford', 'turner.sipes@example.com', '$2y$12$YJnFJhdZKa1iPgoJ9nFBt.XoIfMS94.kIO7Nu6ujFe4VarpBLmQ1O', 1, 1, NULL, NULL, '49cbf0af-671a-307d-aa6c-f934a0d8b10b', '2026-07-04 00:17:10', '2026-07-04 00:17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tbl_adn`
--
ALTER TABLE `tbl_adn`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_bodegas`
--
ALTER TABLE `tbl_bodegas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_bodegas_sitio_foreign` (`sitio`);

--
-- Indices de la tabla `tbl_bodega_producto`
--
ALTER TABLE `tbl_bodega_producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_bodega_producto_bodega_producto_unique` (`bodega`,`producto`),
  ADD KEY `tbl_bodega_producto_producto_foreign` (`producto`);

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cdc`
--
ALTER TABLE `tbl_cdc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_ciudades`
--
ALTER TABLE `tbl_ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_convenio`
--
ALTER TABLE `tbl_convenio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_det_orm`
--
ALTER TABLE `tbl_det_orm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_det_orm_orm_foreign` (`orm`),
  ADD KEY `tbl_det_orm_producto_foreign` (`producto`),
  ADD KEY `tbl_det_orm_ciudad_foreign` (`ciudad`);

--
-- Indices de la tabla `tbl_forma_pago`
--
ALTER TABLE `tbl_forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_movimientos_bodega`
--
ALTER TABLE `tbl_movimientos_bodega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_movimientos_bodega_producto_id_foreign` (`producto_id`),
  ADD KEY `tbl_movimientos_bodega_usuario_id_foreign` (`usuario_id`),
  ADD KEY `tbl_movimientos_bodega_bodega_origen_id_foreign` (`bodega_origen_id`),
  ADD KEY `tbl_movimientos_bodega_bodega_destino_id_foreign` (`bodega_destino_id`),
  ADD KEY `tbl_movimientos_bodega_bodega_id_producto_id_index` (`bodega_id`,`producto_id`),
  ADD KEY `tbl_movimientos_bodega_tipo_index` (`tipo`),
  ADD KEY `tbl_movimientos_bodega_created_at_index` (`created_at`);

--
-- Indices de la tabla `tbl_oc`
--
ALTER TABLE `tbl_oc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_oc_oc_index` (`oc`),
  ADD KEY `tbl_oc_proveedor_foreign` (`proveedor`),
  ADD KEY `tbl_oc_forma_pago_foreign` (`forma_pago`),
  ADD KEY `tbl_oc_convenio_foreign` (`convenio`),
  ADD KEY `tbl_oc_orm_foreign` (`orm`);

--
-- Indices de la tabla `tbl_orm`
--
ALTER TABLE `tbl_orm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_orm_orm_unique` (`orm`),
  ADD KEY `tbl_orm_responsable_foreign` (`responsable`),
  ADD KEY `tbl_orm_comprador_foreign` (`comprador`),
  ADD KEY `tbl_orm_cdc_foreign` (`cdc`),
  ADD KEY `tbl_orm_adn_foreign` (`adn`),
  ADD KEY `tbl_orm_sitio_foreign` (`sitio`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_productos_categoria_foreign` (`categoria`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_proveedores_rut_unique` (`rut`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_sitios`
--
ALTER TABLE `tbl_sitios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_users_email_unique` (`email`),
  ADD KEY `tbl_users_rol_foreign` (`rol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_adn`
--
ALTER TABLE `tbl_adn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbl_bodegas`
--
ALTER TABLE `tbl_bodegas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_bodega_producto`
--
ALTER TABLE `tbl_bodega_producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_cdc`
--
ALTER TABLE `tbl_cdc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `tbl_ciudades`
--
ALTER TABLE `tbl_ciudades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tbl_convenio`
--
ALTER TABLE `tbl_convenio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_det_orm`
--
ALTER TABLE `tbl_det_orm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `tbl_forma_pago`
--
ALTER TABLE `tbl_forma_pago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_movimientos_bodega`
--
ALTER TABLE `tbl_movimientos_bodega`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `tbl_oc`
--
ALTER TABLE `tbl_oc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `tbl_orm`
--
ALTER TABLE `tbl_orm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_sitios`
--
ALTER TABLE `tbl_sitios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_bodegas`
--
ALTER TABLE `tbl_bodegas`
  ADD CONSTRAINT `tbl_bodegas_sitio_foreign` FOREIGN KEY (`sitio`) REFERENCES `tbl_sitios` (`id`);

--
-- Filtros para la tabla `tbl_bodega_producto`
--
ALTER TABLE `tbl_bodega_producto`
  ADD CONSTRAINT `tbl_bodega_producto_bodega_foreign` FOREIGN KEY (`bodega`) REFERENCES `tbl_bodegas` (`id`),
  ADD CONSTRAINT `tbl_bodega_producto_producto_foreign` FOREIGN KEY (`producto`) REFERENCES `tbl_productos` (`id`);

--
-- Filtros para la tabla `tbl_det_orm`
--
ALTER TABLE `tbl_det_orm`
  ADD CONSTRAINT `tbl_det_orm_ciudad_foreign` FOREIGN KEY (`ciudad`) REFERENCES `tbl_ciudades` (`id`),
  ADD CONSTRAINT `tbl_det_orm_orm_foreign` FOREIGN KEY (`orm`) REFERENCES `tbl_orm` (`orm`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_det_orm_producto_foreign` FOREIGN KEY (`producto`) REFERENCES `tbl_productos` (`id`);

--
-- Filtros para la tabla `tbl_movimientos_bodega`
--
ALTER TABLE `tbl_movimientos_bodega`
  ADD CONSTRAINT `tbl_movimientos_bodega_bodega_destino_id_foreign` FOREIGN KEY (`bodega_destino_id`) REFERENCES `tbl_bodegas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_movimientos_bodega_bodega_id_foreign` FOREIGN KEY (`bodega_id`) REFERENCES `tbl_bodegas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_movimientos_bodega_bodega_origen_id_foreign` FOREIGN KEY (`bodega_origen_id`) REFERENCES `tbl_bodegas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_movimientos_bodega_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `tbl_productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_movimientos_bodega_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `tbl_oc`
--
ALTER TABLE `tbl_oc`
  ADD CONSTRAINT `tbl_oc_convenio_foreign` FOREIGN KEY (`convenio`) REFERENCES `tbl_convenio` (`id`),
  ADD CONSTRAINT `tbl_oc_forma_pago_foreign` FOREIGN KEY (`forma_pago`) REFERENCES `tbl_forma_pago` (`id`),
  ADD CONSTRAINT `tbl_oc_orm_foreign` FOREIGN KEY (`orm`) REFERENCES `tbl_orm` (`orm`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_oc_proveedor_foreign` FOREIGN KEY (`proveedor`) REFERENCES `tbl_proveedores` (`id`);

--
-- Filtros para la tabla `tbl_orm`
--
ALTER TABLE `tbl_orm`
  ADD CONSTRAINT `tbl_orm_adn_foreign` FOREIGN KEY (`adn`) REFERENCES `tbl_adn` (`id`),
  ADD CONSTRAINT `tbl_orm_cdc_foreign` FOREIGN KEY (`cdc`) REFERENCES `tbl_cdc` (`id`),
  ADD CONSTRAINT `tbl_orm_comprador_foreign` FOREIGN KEY (`comprador`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_orm_responsable_foreign` FOREIGN KEY (`responsable`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_orm_sitio_foreign` FOREIGN KEY (`sitio`) REFERENCES `tbl_sitios` (`id`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_categoria_foreign` FOREIGN KEY (`categoria`) REFERENCES `tbl_categorias` (`id`);

--
-- Filtros para la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `tbl_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
