-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2020 a las 02:46:52
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel_master`
--
CREATE DATABASE IF NOT EXISTS `laravel_master` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `laravel_master`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `image_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Buena foto de familia!!', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(2, 2, 1, 'Buena foto de PLAYA!!', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(3, 2, 4, 'que bueno!!', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(6, 5, 5, 'Esta muy bonito', '2019-11-27 19:30:43', '2019-11-27 19:30:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'test.jpg', 'descripción de prueba 1', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(2, 1, 'playa.jpg', 'descripción de prueba 2', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(3, 1, 'arena.jpg', 'descripción de prueba 3', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(4, 3, 'familia.jpg', 'descripción de prueba 4', '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(5, 5, '1574899571wii.jpg', 'TODO CON LAS 3B', '2019-11-25 19:57:01', '2019-11-28 00:06:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(2, 2, 4, '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(3, 3, 1, '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(4, 3, 2, '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(5, 2, 1, '2019-11-21 09:43:55', '2019-11-21 09:43:55'),
(11, 5, 2, '2019-11-27 19:25:23', '2019-11-27 19:25:23'),
(12, 5, 5, '2020-01-19 23:04:07', '2020-01-19 23:04:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `nick` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `nick`, `email`, `password`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'user', 'Víctor', 'Robles', 'victorroblesweb', 'victor@victor.com', 'pass', NULL, '2019-11-21 09:43:55', '2019-11-21 09:43:55', NULL),
(2, 'user', 'Juan', 'Lopez', 'juanlopez', 'juan@juan.com', 'pass', NULL, '2019-11-21 09:43:55', '2019-11-21 09:43:55', NULL),
(3, 'user', 'Manolo', 'Garcia', 'manologarcia', 'manolo@manolo.com', 'pass', NULL, '2019-11-21 09:43:55', '2019-11-21 09:43:55', NULL),
(4, NULL, 'admin', 'ramirez', 'eladmin', 'admin@admin.com', '$2y$10$l76LThQ/L5a.q82CVcovvuD.LAvGrTiWHor5Hu3ghA2fw85XDpMha', '1574798312Fallout.jpg', '2019-11-21 19:43:57', '2019-11-26 19:58:32', 'bhj46dRZXdkHUviaTaKCM1s62bsCDTwmg8x4JtmPN8uqzjKXwH5uS2lkbvRP'),
(5, 'user', 'Andres', 'Ramirez', 'andres28ramirez', 'andresramirez2025@gmail.com', '$2y$10$sZ4v5IonUFVDtIuhWVbyS.NUDAHvgdKnoMJOO/PfwBNMbNE7IOz5u', '1574647359bo.jpg', '2019-11-21 20:14:09', '2019-11-25 02:02:39', 'tVR7Ds0A9JgYtHSHdKHlL6j9UUcGLCbyqMG2Nh4EOrWkcjv8rH1tW9mytBWq'),
(6, 'user', 'leonardo', 'guilarte', 'lguilarte', 'leomiguel1907@gmail.com', '$2y$10$HpFZHjtf46hagDwO2o3v.OTflBVZpL3SquWOjjYzfaeNvPhOybYqC', NULL, '2020-02-23 23:17:19', '2020-02-23 23:17:19', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_images` (`image_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_users` (`user_id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_likes_users` (`user_id`),
  ADD KEY `fk_likes_images` (`image_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
