-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-02-2018 a las 09:50:37
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
-- Estructura de tabla para la tabla `php_productos`
--

CREATE TABLE `php_productos` (
  `ID` int(9) UNSIGNED NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `marca` varchar(150) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `moneda` varchar(10) NOT NULL,
  `unidad` varchar(10) NOT NULL,
  `stock` int(6) NOT NULL,
  `ID_cate` int(2) NOT NULL,
  `ID_sub_cate` int(2) NOT NULL,
  `ID_marca` int(2) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `url_name` varchar(150) NOT NULL,
  `imagen1` varchar(100) NOT NULL,
  `imagen2` varchar(100) NOT NULL,
  `imagen3` varchar(100) NOT NULL,
  `imagen4` varchar(100) NOT NULL,
  `imagen5` varchar(100) NOT NULL,
  `cate` varchar(50) NOT NULL,
  `resena` text NOT NULL,
  `alta` varchar(21) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `php_productos`
--

INSERT INTO `php_productos` (`ID`, `clave`, `nombre`, `cover`, `foto`, `descripcion`, `marca`, `precio`, `moneda`, `unidad`, `stock`, `ID_cate`, `ID_sub_cate`, `ID_marca`, `visible`, `url_name`, `imagen1`, `imagen2`, `imagen3`, `imagen4`, `imagen5`, `cate`, `resena`, `alta`, `fmod`, `user`) VALUES
(1, '', 'Producto', '2-compressor.jpg', '', 'Descripcion', '', '0.00', '', '', 0, 0, 0, 0, 1, '', 'be1.jpg', '', '', '', '', 'Categoria', 'Reseña', '2018-01-07 21:29:41', '', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `php_productos_cate`
--

CREATE TABLE `php_productos_cate` (
  `ID_cate` int(6) UNSIGNED NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `ord` int(2) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `php_productos_coti`
--

CREATE TABLE `php_productos_coti` (
  `ID_bills` int(9) UNSIGNED NOT NULL,
  `ID_pro` int(9) NOT NULL,
  `cant` int(6) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `ID_cate` int(9) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `fecha` varchar(21) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `php_productos_marcas`
--

CREATE TABLE `php_productos_marcas` (
  `ID_marca` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `php_productos_marcas`
--

INSERT INTO `php_productos_marcas` (`ID_marca`, `nombre`, `visible`) VALUES
(1, 'Samsung', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `php_productos_sub_cate`
--

CREATE TABLE `php_productos_sub_cate` (
  `ID_sub_cate` int(6) UNSIGNED NOT NULL,
  `subactegoria` varchar(100) NOT NULL,
  `ord` int(2) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `php_productos`
--
ALTER TABLE `php_productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `php_productos_cate`
--
ALTER TABLE `php_productos_cate`
  ADD PRIMARY KEY (`ID_cate`);

--
-- Indices de la tabla `php_productos_coti`
--
ALTER TABLE `php_productos_coti`
  ADD PRIMARY KEY (`ID_bills`);

--
-- Indices de la tabla `php_productos_marcas`
--
ALTER TABLE `php_productos_marcas`
  ADD PRIMARY KEY (`ID_marca`);

--
-- Indices de la tabla `php_productos_sub_cate`
--
ALTER TABLE `php_productos_sub_cate`
  ADD PRIMARY KEY (`ID_sub_cate`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `php_productos`
--
ALTER TABLE `php_productos`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `php_productos_cate`
--
ALTER TABLE `php_productos_cate`
  MODIFY `ID_cate` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `php_productos_coti`
--
ALTER TABLE `php_productos_coti`
  MODIFY `ID_bills` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `php_productos_marcas`
--
ALTER TABLE `php_productos_marcas`
  MODIFY `ID_marca` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `php_productos_sub_cate`
--
ALTER TABLE `php_productos_sub_cate`
  MODIFY `ID_sub_cate` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
