-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2015 a las 12:19:51
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_pr02_intranet`
--
CREATE DATABASE IF NOT EXISTS `bd_pr02_intranet` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `bd_pr02_intranet`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_material`
--

CREATE TABLE IF NOT EXISTS `tbl_material` (
  `id_material` int(11) NOT NULL,
  `id_tipo_material` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_bin,
  `disponible` tinyint(1) DEFAULT NULL,
  `incidencia` tinyint(1) DEFAULT NULL,
  `descripcion_incidencia` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_material`
--

INSERT INTO `tbl_material` (`id_material`, `id_tipo_material`, `descripcion`, `disponible`, `incidencia`, `descripcion_incidencia`) VALUES
(1, 1, 'Sala Reuniones 01', 0, 0, NULL),
(2, 1, 'Sala Reuniones 02', 0, 0, NULL),
(3, 1, 'Despacho 01', 0, 0, NULL),
(4, 1, 'Despacho 02', 0, 0, NULL),
(5, 1, 'Aula Informática 01', 0, 0, NULL),
(6, 1, 'Aula Informática 02', 0, 0, NULL),
(7, 1, 'Aula Teoría 01', 0, 0, NULL),
(8, 1, 'Aula Teoría 02', 0, 0, NULL),
(9, 1, 'Aula Teoría 03', 0, 0, NULL),
(10, 1, 'Aula Teoría 04', 0, 0, NULL),
(11, 2, 'Ordenador Portátil Dell', 0, 0, NULL),
(12, 2, 'Ordenador Portátil Apple', 0, 0, NULL),
(13, 2, 'Ordenador Portátil Acer', 0, 0, NULL),
(14, 2, 'Ordenador Portátil Asus', 0, 0, NULL),
(15, 2, 'Ordenador Portátil Lenovo', 0, 0, NULL),
(16, 2, 'Proyector Acer', 0, 0, NULL),
(17, 2, 'Proyector Benq', 0, 0, NULL),
(18, 2, 'Proyector Epson', 0, 0, NULL),
(19, 2, 'Proyector Optoma', 0, 0, NULL),
(20, 2, 'Proyector Lg', 0, 0, NULL),
(21, 2, 'Móvil Bq Aquaris', 0, 0, NULL),
(22, 2, 'Móvil Doogee Voyager', 0, 0, NULL),
(23, 2, 'Móvil Apple Iphone', 0, 0, NULL),
(24, 2, 'Móvil Hisense', 0, 0, NULL),
(25, 2, 'Móvil Samsung Galaxy', 0, 0, NULL),
(26, 0, 'Carro de portátil 01', 0, 0, NULL),
(27, 0, 'Carro de portátil 02', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reservas`
--

CREATE TABLE IF NOT EXISTS `tbl_reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `hora_entrada` date DEFAULT NULL,
  `hora_salida` date DEFAULT NULL,
  `id_material` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_reservas`
--

INSERT INTO `tbl_reservas` (`id_reserva`, `id_usuario`, `hora_entrada`, `hora_salida`, `id_material`) VALUES
(22, 5, '2015-11-05', '2015-11-05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_material`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_material` (
  `id_tipo_material` int(11) NOT NULL,
  `tipo` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_material`
--

INSERT INTO `tbl_tipo_material` (`id_tipo_material`, `tipo`) VALUES
(1, 'sala'),
(2, 'material');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `email`, `password`) VALUES
(1, '1010.joan23@fje.edu', '1234'),
(2, '2020.joan23@fje.edu', '1234'),
(3, '3030.joan23@fje.edu', '1234'),
(4, '4040.joan23@fje.edu', '1234'),
(5, '5050.joan23@fje.edu', '1234'),
(6, '6060.joan23@fje.edu', '1234'),
(7, '7070.joan23@fje.edu', '1234'),
(8, '8080.joan23@fje.edu', '1234'),
(9, '9090.joan23@fje.edu', '1234'),
(10, '1111.joan23@fje.edu', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `tbl_reservas`
--
ALTER TABLE `tbl_reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `tbl_tipo_material`
--
ALTER TABLE `tbl_tipo_material`
  ADD PRIMARY KEY (`id_tipo_material`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `tbl_reservas`
--
ALTER TABLE `tbl_reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_material`
--
ALTER TABLE `tbl_tipo_material`
  MODIFY `id_tipo_material` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
