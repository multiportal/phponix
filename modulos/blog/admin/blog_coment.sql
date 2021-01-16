-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-02-2018 a las 23:49:49
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `samsungh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sam_blog_coment`
--

CREATE TABLE `sam_blog_coment` (
  `ID` int(6) UNSIGNED NOT NULL,
  `ip` varchar(18) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `id_b` int(3) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sam_blog_coment`
--

INSERT INTO `sam_blog_coment` (`ID`, `ip`, `nombre`, `email`, `comentario`, `id_b`, `fecha`, `visible`) VALUES
(1, '127.0.0.1', 'Arturo L&oacute;pez', 'alopez@gmail.com', 'Comentario de prueba.', 1, '2018-02-09 23:43:50', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sam_blog_coment`
--
ALTER TABLE `sam_blog_coment`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sam_blog_coment`
--
ALTER TABLE `sam_blog_coment`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
