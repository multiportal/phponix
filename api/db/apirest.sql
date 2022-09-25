-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2022 a las 17:45:51
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apirest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CitaId` int(11) NOT NULL,
  `PacienteId` varchar(45) DEFAULT NULL,
  `Fecha` varchar(45) DEFAULT NULL,
  `HoraInicio` varchar(45) DEFAULT NULL,
  `HoraFIn` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Motivo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CitaId`, `PacienteId`, `Fecha`, `HoraInicio`, `HoraFIn`, `Estado`, `Motivo`) VALUES
(1, '1', '2020-06-09', '08:30:00', '09:00:00', 'Confirmada', 'El paciente presenta un leve dolor de espalda'),
(2, '2', '2020-06-10', '08:30:00', '09:00:00', 'Confirmada', 'Dolor en la zona lumbar '),
(3, '3', '2020-06-18', '09:00:00', '09:30:00', 'Confirmada', 'Dolor en el cuello');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cate` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`ID`, `title`, `url`, `description`, `cate`, `user_id`, `created_at`) VALUES
(1, 'Multiportal', 'https://multiportal.webcindario.com/', 'Sitio web de Multiportal', 'web', 1, '2021-06-25 22:33:04'),
(9, 'Phponix', 'https://phponix.webcindario.com', 'Sitio Web Phponix', 'web', 2, '2022-07-08 05:26:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PacienteId` int(11) NOT NULL,
  `DNI` varchar(45) DEFAULT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `CodigoPostal` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Genero` varchar(45) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`PacienteId`, `DNI`, `Nombre`, `Direccion`, `CodigoPostal`, `Telefono`, `Genero`, `FechaNacimiento`, `Correo`) VALUES
(1, 'A000000001', 'Juan Carlos Medina', 'Calle de pruebas 1', '20001', '633281515', 'M', '1989-03-02', 'Paciente1@gmail.com'),
(2, 'B000000002', 'Daniel Rios', 'Calle de pruebas 2', '20002', '633281512', 'M', '1990-05-11', 'Paciente2@gmail.com'),
(3, 'C000000003', 'Marcela Dubon', 'Calle de pruebas 3', '20003', '633281511', 'F', '2000-07-22', 'Paciente3@gmail.com'),
(4, 'D000000004', 'Maria Mendez', 'Calle de pruebas 4', '20004', '633281516', 'F', '1980-01-01', 'Paciente4@gmail.com'),
(5, 'E000000005', 'Zamuel Valladares', 'Calle de pruebas 5', '20006', '633281519', 'M', '1985-12-15', 'Paciente5@gmail.com'),
(6, 'F000000006', 'Angel Rios', 'Calle de pruebas 6', '20005', '633281510', 'M', '1988-11-30', 'Paciente6@gmail.com'),
(8, 'F00000014', 'Arturo Velazquez', 'Calle de prueba', '76000', '4427654321', 'M', '2012-01-24', 'avelazque@gmail.com'),
(9, '233u467', 'Memo', NULL, '76080', '44276543321', 'M', '0000-00-00', 'm@m.com'),
(12, '1233u4670', 'Luis Cornejo', 'Calle norte', '76080', '44276543321', 'M', '1982-12-15', 'm@m.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signup`
--

CREATE TABLE `signup` (
  `ID` int(9) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `tema` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apaterno` varchar(100) NOT NULL,
  `amaterno` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `ext` int(4) NOT NULL,
  `fnac` date NOT NULL,
  `fb` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `ndepa` int(1) NOT NULL,
  `depa` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `mpio` varchar(100) NOT NULL,
  `edo` varchar(100) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `exp` varchar(1000) NOT NULL,
  `likes` int(6) NOT NULL,
  `filtro` varchar(50) NOT NULL,
  `zona` varchar(50) NOT NULL,
  `alta` varchar(20) NOT NULL,
  `actualizacion` varchar(100) NOT NULL,
  `page` varchar(250) NOT NULL,
  `nivel_oper` int(2) NOT NULL,
  `rol` int(2) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `intentos` varchar(2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `signup`
--

INSERT INTO `signup` (`ID`, `username`, `password`, `email`, `level`, `lastlogin`, `tema`, `nombre`, `apaterno`, `amaterno`, `foto`, `cover`, `tel`, `ext`, `fnac`, `fb`, `tw`, `puesto`, `ndepa`, `depa`, `empresa`, `adress`, `direccion`, `mpio`, `edo`, `pais`, `genero`, `exp`, `likes`, `filtro`, `zona`, `alta`, `actualizacion`, `page`, `nivel_oper`, `rol`, `codigo`, `intentos`, `status`, `activo`) VALUES
(1, 'admin', 'c64f923f7f476f0b78716079452e7bdec4b2c016', 'multiportal@outlook.com', '-1', '2021-04-08 16:34:43', 'default', 'Guillermo', 'Jimenez', 'Lopez', 'sinfoto.png', '', '4421944950', 1, '0000-00-00', '', '', 'Programador', 0, '', 'Multiportal', '', '', '', '', '', 'M', '', 0, '0', '', '', 'admin2019xadmin79', '', 0, 0, '944950', '0', 'offline', 1),
(2, 'demo', '71cc541bd1ccb6670de3f8d40f425ffb7315fe7f', 'demo@gmail.com', '-1', '0000-00-00 00:00:00', 'default', 'Demo', 'Apaterno', 'Amaterno', 'sinfoto.png', 'sincover.jpg', '4421234567', 0, '0000-00-00', '', '', 'Director', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'demo2019xdemo2017', '', 0, 0, '234567', '0', 'offline', 1),
(3, 'usuario', '3c6e6ac5382f4e804e824c0d785b275252ddacb0', 'multiportal@outlook.com', '1', '0000-00-00 00:00:00', 'default', 'Usuario', 'Apaterno', 'Amaterno', 'sinfoto.png', '', '4421234567', 0, '0000-00-00', '', '', 'Usuario', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'usuario2019xuser79x', '', 0, 0, '234567', '0', 'offline', 1),
(4, 'ventas', '1d415500d481e0c1c238189c22ea057da663c1e7', 'ventas@gmail.com', '2', '0000-00-00 00:00:00', 'default', 'Ventas', 'Apaterno', 'Amaterno', 'sinfoto.png', 'sincover.jpg', '4421234567', 0, '0000-00-00', '', '', 'Gerente', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'ventas2019xventas', '', 0, 0, '234567', '0', 'offline', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `ID` int(9) UNSIGNED NOT NULL,
  `ID_user` int(6) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Fecha` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `upload_files`
--

CREATE TABLE `upload_files` (
  `ID` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `type_file` varchar(30) NOT NULL,
  `filec` longblob NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioId` int(11) NOT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuarioId`, `Usuario`, `Password`, `Estado`) VALUES
(1, 'usuario1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(2, 'usuario2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(3, 'usuario3@gmail.com', '123456', 'Activo'),
(4, 'usuario4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(5, 'usuario5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(6, 'usuario6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(7, 'usuario7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(8, 'usuario8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(9, 'usuario9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `TokenId` int(11) NOT NULL,
  `UsuarioId` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitaId`);

--
-- Indices de la tabla `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PacienteId`);

--
-- Indices de la tabla `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `upload_files`
--
ALTER TABLE `upload_files`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioId`);

--
-- Indices de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`TokenId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `PacienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `signup`
--
ALTER TABLE `signup`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  MODIFY `TokenId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
