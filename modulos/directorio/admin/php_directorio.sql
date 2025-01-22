-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-09-2018 a las 18:08:19
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

USE `multiportal`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `phponix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mul_directorio`
--

CREATE TABLE `mul_directorio` (
  `ID` int(6) UNSIGNED NOT NULL,
  `cover` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `url_link` varchar(300) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `des` varchar(250) NOT NULL,
  `filtro` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `fecha` varchar(22) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mul_directorio`
--

INSERT INTO `mul_directorio` (`ID`, `cover`, `nom`, `url_link`, `usuario`, `pass`, `des`, `filtro`, `user`, `fecha`) VALUES
(1, 'nodisponible.jpg', 'Google', 'http://google.com.mx', '', '', '<p>Buscador de Google</p>', 'Buscador', 'admin', '2018-09-25 15:07:08'),
(2, 'nodisponible.jpg', 'Hotmail', 'https://outlook.live.com/owa/', 'loganmemo@hotmail.com', 'karma790408', '', 'Correo', 'admin', '2018-09-27 16:32:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mul_directorio`
--
ALTER TABLE `mul_directorio`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mul_directorio`
--
ALTER TABLE `mul_directorio`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
