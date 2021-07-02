-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2021 a las 01:40:21
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laika_bakend_test`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_product` (IN `producto_id` INT)  begin
	DELETE FROM laika_bakend_test.products
WHERE id=producto_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_one_product` (IN `producto_id` INT)  begin
	SELECT 
	products.id as identificador, 
	products.name as titulo, 
	products.description as detalles,
	quantity as disponibles, 
	status as estado, 
	image as imagen,
	category_id as categoria_id,
	categories.name as des_categoria, 
	products.created_at as fechaCreacion,
	products.updated_at
	FROM laika_bakend_test.products
	inner join categories on products.category_id=categories.id
	where producto_id = products.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_productos` ()  begin       
	SELECT 
	products.id as identificador, 
	products.name as titulo, 
	products.description as detalles,
	quantity as disponibles, 
	status as estado, 
	image as imagen,
	category_id as categoria_id,
	categories.name as des_categoria, 
	products.created_at as fechaCreacion,
	products.updated_at
	FROM laika_bakend_test.products
	inner join categories on products.category_id=categories.id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_products` (IN `nombre` VARCHAR(1000), IN `description` VARCHAR(1000), IN `quantity` INT, IN `status` TINYINT, IN `image` VARCHAR(191), IN `categoria_id` VARCHAR(191))  begin
	INSERT INTO laika_bakend_test.products
		(name, description, quantity, status, image,category_id, created_at, updated_at)
	values
		(
			nombre, 
			description, 
			quantity, 
			status, 
			image, 
			categoria_id,
			now(), 
			now()
		);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_product` (IN `producto_id` INT, IN `nombre` VARCHAR(1000), IN `description` VARCHAR(1000), IN `quantity` INT, IN `status` TINYINT, IN `image` VARCHAR(191), IN `categoria_id` VARCHAR(191))  begin
	UPDATE laika_bakend_test.products
SET name=nombre, description=description, 
quantity=quantity, status=status, image=image, 
category_id=categoria_id
WHERE id=producto_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__one_product` (IN `producto_id` INT)  begin
	SELECT 
	products.id as identificador, 
	products.name as titulo, 
	products.description as detalles,
	quantity as disponibles, 
	status as estado, 
	image as imagen,
	category_id as categoria_id,
	categories.name as des_categoria, 
	products.created_at as fechaCreacion,
	products.updated_at
	FROM laika_bakend_test.products
	inner join categories on products.category_id=categories.id
	where producto_id = products.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'pariatur', 'Optio qui cupiditate magnam in molestiae ratione praesentium. Voluptas inventore omnis aliquam.', '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(2, 'earum', 'Soluta laborum repudiandae quis qui quo veritatis.', '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(3, 'suscipit', 'Et similique in omnis minima aut quam.', '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(4, 'quis', 'Non mollitia dolorum recusandae aliquid. Ut voluptas perferendis qui ut in vero et.', '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(5, 'omnis 1', 'Eos est facilis autem quod. Accusamus magnam dolorum nihil doloremque autem.', '2021-07-03 04:17:21', '2021-07-03 04:24:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_29_160851_create_categories_table', 1),
(5, '2021_06_29_160852_create_products_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `status`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'utTT', 'Eum dolore soluta similique magni repudiandae.', 15, 1, '2.png', 5, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(2, 'officia', 'Est cumque nobis consequatur vel saepe. Aut id ratione et aperiam sit nemo quia.', 27, 0, '3.png', 3, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(3, 'doloremque', 'Et quod reprehenderit id eius nostrum qui.', 14, 1, '5.png', 2, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(4, 'voluptas', 'Nihil totam ad quia omnis quos. Praesentium quas ad qui fuga mollitia nulla non et.', 8, 1, '2.png', 1, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(5, 'voluptas', 'Error distinctio similique repellat dignissimos est rem nam sit.', 19, 1, '3.png', 4, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(6, 'aliquam', 'Et occaecati quasi ea eligendi et sequi voluptatem similique.', 21, 1, '3.png', 5, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(7, 'est', 'Velit et quo nostrum modi. Non molestias aut corrupti.', 41, 1, '3.png', 4, '2021-07-03 04:17:21', '2021-07-03 04:17:21'),
(8, 'sapiente 1111', 'Non commodi voluptatum illo.', 40, 1, '2.png', 5, '2021-07-03 04:17:21', '2021-07-03 04:17:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_status_index` (`status`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
