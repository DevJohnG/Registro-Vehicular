-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2024 a las 05:53:38
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
-- Base de datos: `gestion_automoviles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automoviles`
--

CREATE TABLE `automoviles` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int(11) NOT NULL,
  `color` varchar(30) NOT NULL,
  `placa` varchar(30) NOT NULL,
  `num_motor` varchar(30) NOT NULL,
  `num_chasis` varchar(30) NOT NULL,
  `tipo_auto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `automoviles`
--

INSERT INTO `automoviles` (`id`, `marca`, `modelo`, `anio`, `color`, `placa`, `num_motor`, `num_chasis`, `tipo_auto`) VALUES
(2, 'Nissan', 'Versa', 2024, 'Blanco', 'ED1234', '1KD-FTV', 'MR0FZ29G7GJ123456', 'Sedan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `automoviles`
--
ALTER TABLE `automoviles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `automoviles`
--
ALTER TABLE `automoviles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
