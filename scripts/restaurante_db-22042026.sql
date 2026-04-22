-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2026 a las 19:58:17
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `image`, `created_at`) VALUES
(1, 'Día de las madres', 'ven y visitados junto a mamita en este dia especial dedicado a todas las mamitas del mundo', '2026-05-10', NULL, '2026-04-16 16:53:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `furniture`
--

CREATE TABLE `furniture` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `pos_x` int(11) DEFAULT NULL,
  `pos_y` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `furniture`
--

INSERT INTO `furniture` (`id`, `nombre`, `imagen`, `pos_x`, `pos_y`, `width`, `height`) VALUES
(1, 'Mostrador', '..\\assets\\images\\mapeo_restaurante\\mostrador.png', 28, 49, 250, 250),
(2, 'acceso', '..\\assets\\images\\mapeo_restaurante\\acceso.png', 294, 175, 120, 120),
(3, 'entrada', '..\\assets\\images\\mapeo_restaurante\\entrada.png', 485, 37, 120, 1120),
(4, 'descanso', '..\\assets\\images\\mapeo_restaurante\\descanso.png', -2, 907, 540, 90),
(5, 'dj', '..\\assets\\images\\mapeo_restaurante\\dj.png', -2, 1043, 540, 90),
(6, 'planta1', '..\\assets\\images\\mapeo_restaurante\\planta1.png', -20, 360, 80, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loyalty_cards`
--

CREATE TABLE `loyalty_cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `card_number` varchar(100) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `stamps` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loyalty_cards`
--

INSERT INTO `loyalty_cards` (`id`, `user_id`, `card_number`, `qr_code`, `stamps`) VALUES
(2, 4, 'LC-3807B5B448', '../qrcodes/qr_4.png', 0),
(3, 5, 'LC-49BFABE89A', '../qrcodes/qr_5.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `num_people` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `reservation_time` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `occasion` varchar(100) DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `table_number`, `num_people`, `reservation_date`, `reservation_time`, `client_name`, `phone`, `email`, `occasion`, `special_request`, `created_at`) VALUES
(5, 20, 6, '2026-04-30 00:00:00', '05:30 PM', 'Eder Cruz Leon', '9933447624', 'pootmendezismael@gmail.com', 'cumpleaños', 'Pastel de cumpleaños', '2026-04-23 01:04:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_number` int(11) DEFAULT NULL,
  `status` enum('disponible','reservada','ocupada') DEFAULT 'disponible',
  `capacity` int(11) DEFAULT NULL,
  `pos_x` int(11) DEFAULT NULL,
  `pos_y` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `table_number`, `status`, `capacity`, `pos_x`, `pos_y`) VALUES
(1, 1, 'disponible', 4, 183, 294),
(2, 2, 'disponible', 2, 418, 294),
(3, 3, 'disponible', 6, 579, 59),
(4, 4, 'disponible', 4, 180, 420),
(5, 5, 'disponible', 5, 38, 297),
(6, 6, 'disponible', 5, 38, 547),
(7, 7, 'disponible', 5, 36, 424),
(8, 8, 'disponible', 2, 734, 51),
(9, 9, 'disponible', 4, 733, 279),
(10, 10, 'disponible', 6, 585, 679),
(11, 11, 'disponible', 2, 424, 681),
(12, 12, 'disponible', 4, 871, 166),
(13, 13, 'disponible', 6, 588, 804),
(14, 14, 'disponible', 2, 424, 536),
(15, 15, 'disponible', 4, 180, 809),
(16, 16, 'disponible', 6, 582, 532),
(17, 17, 'disponible', 5, 41, 681),
(18, 18, 'disponible', 2, 424, 807),
(19, 19, 'disponible', 4, 181, 672),
(20, 20, 'reservada', 6, 581, 287),
(21, 21, 'disponible', 5, 43, 809),
(22, 22, 'disponible', 4, 733, 163),
(23, 23, 'disponible', 2, 873, 52),
(24, 24, 'disponible', 4, 178, 542),
(25, 25, 'disponible', 6, 580, 165),
(26, 26, 'disponible', 4, 867, 281),
(27, 27, 'disponible', 4, 733, 530),
(28, 28, 'disponible', 2, 1138, 57),
(29, 29, 'disponible', 4, 732, 683),
(30, 30, 'disponible', 6, 720, 809),
(31, 31, 'disponible', 2, 1001, 54),
(32, 32, 'disponible', 4, 998, 280),
(33, 33, 'disponible', 2, 1140, 276),
(34, 35, 'disponible', 4, 997, 532),
(35, 34, 'disponible', 2, 1141, 174),
(36, 36, 'disponible', 4, 865, 531),
(37, 37, 'disponible', 4, 1003, 167),
(38, 38, 'disponible', 4, 862, 682),
(39, 39, 'disponible', 4, 1138, 681),
(40, 40, 'disponible', 4, 1138, 529),
(41, 41, 'disponible', 6, 1134, 807),
(42, 42, 'disponible', 4, 1002, 683),
(43, 43, 'disponible', 6, 997, 811),
(44, 44, 'disponible', 6, 861, 811);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `role` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `username`, `email`, `passwords`, `role`, `created_at`) VALUES
(1, 'Ismael Poot Méndez', 'IsmaelPootM', 'pootmendezismael@gmail.com', 'toJA9a5JDM', 'admin', '2026-04-21 19:57:06'),
(3, 'Eder Cruz Leon', 'Tahi22', 'naigump1234@gmail.com', '12334567', 'cliente', '2026-04-21 15:28:34'),
(5, 'Dean Don Del', 'PDean', 'phranpdean@gmail.com', '12554637', 'cliente', '2026-04-22 17:35:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `loyalty_cards`
--
ALTER TABLE `loyalty_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `furniture`
--
ALTER TABLE `furniture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `loyalty_cards`
--
ALTER TABLE `loyalty_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
