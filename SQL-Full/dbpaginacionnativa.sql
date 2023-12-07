-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2021 a las 11:22:47
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpaginacionnativa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `nombre`, `imagen`) VALUES
(1, 'Avengers Infinity War', 'poster01'),
(2, 'Jurassic World', 'poster02'),
(3, 'Deadpool 2', 'poster03'),
(4, 'Solo', 'poster04'),
(5, 'Los Increibles 2', 'poster05'),
(6, 'Oceans 8', 'poster06'),
(7, 'Black Panther', 'poster07'),
(8, 'Tomb Raider', 'poster08'),
(9, 'Ready Player One', 'poster09'),
(10, 'Mission Imposible', 'poster10'),
(11, 'Pacific Rim', 'poster11'),
(12, 'Venom', 'poster12'),
(13, 'Isla de perros', 'poster13'),
(14, 'Ralph', 'poster14'),
(15, 'Mamma Mia!', 'poster15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
