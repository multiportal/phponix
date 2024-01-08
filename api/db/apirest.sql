-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2023 a las 03:42:26
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Estructura de tabla para la tabla `api_version`
--

CREATE TABLE `api_version` (
  `ID` int(9) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `vence` varchar(20) NOT NULL,
  `ultimate` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `des_ver` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `api_version`
--

INSERT INTO `api_version` (`ID`, `nom`, `vence`, `ultimate`, `status`, `des_ver`) VALUES
(1, 'apiRest', '30/11/2027', '1.2.8', 'Activa', '');

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
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `ID` int(9) UNSIGNED NOT NULL,
  `ip` varchar(25) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `para` varchar(50) NOT NULL,
  `de` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `asunto` varchar(150) NOT NULL,
  `msj` mediumtext NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cat_list` varchar(50) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `tabla` varchar(50) NOT NULL,
  `adjuntos` mediumtext NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `ID_login` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`ID`, `ip`, `nombre`, `email`, `para`, `de`, `tel`, `titulo`, `asunto`, `msj`, `fecha`, `cat_list`, `seccion`, `tabla`, `adjuntos`, `visto`, `status`, `ID_login`, `ID_user`, `visible`) VALUES
(1, '127.0.0.1', 'Miguel Hernandez', 'mherco@hotmail.com', 'phponix@webcindario.com', 'mherco@hotmail.com', '4421944950', 'Contacto Web PHP ONIX', 'Mensaje de Bienvenida - CENTRO DE CONTACTO', 'Hola estimado usuario, bienvenido a su plataforma \"PHPONIX CMS\" aqui se guardara un copia de respaldo de todos sus correos de contacto y registros de su página web.\r\n\r\nCualquier duda o comentario puede ponerse en contacto a través del correo a multiportal@outlook.com o en nuestra página https://phponix.webcindario.com \r\n\r\nATTE.\r\nEl equipo de PHPONIX & MULTIPORTAL ', '2021-02-15 21:59:26', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(2, '', 'Miguel Hernandez', 'mherco@hotmail.com', 'multiportal@outlook.com', 'mherco@hotmail.com', '', 'Contacto Web Arkon Data', 'Contacto Web', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">Arkon Data</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Miguel Hernandez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\">Intelmex</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">mherco@hotmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-05 23:56:27', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(3, '', 'Guillermo Jimenez', '', 'multiportal@outlook.com', '', '', 'Contacto Web Arkon Data', 'Contacto Web', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">Arkon Data</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\">Intelmex</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-06 00:03:39', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(4, '', 'Guillermo Jimenez', 'memotablet08@gmail.com', 'multiportal@outlook.com', 'memotablet08@gmail.com', '', 'Contacto Web Arkon Data', 'Contacto Web', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">Arkon Data</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\">Intelmex</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">memotablet08@gmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-06 00:04:06', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(5, '', 'Memo Jimenez', 'memojl08@gmail.com', 'multiportal@outlook.com', 'memojl08@gmail.com', '', 'Contacto Web Arkon Data', 'Contacto Web', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">Arkon Data</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Memo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\">Intelmex</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">memojl08@gmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-06 00:13:22', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(6, '', 'Guillermo Jimenez', 'loganmemo@hotmail.com', 'multiportal@outlook.com', 'loganmemo@hotmail.com', '', 'Contacto Multiportal', 'TEST', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">MultiportalMX</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">loganmemo@hotmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-14 01:52:27', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(7, '', 'Miguel Hernandez', 'mherco@hotmail.com', 'multiportal@outlook.com', 'mherco@hotmail.com', '', 'Contacto Multiportal', 'Test', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">MultiportalMX</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Miguel Hernandez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">mherco@hotmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">Miguel Hernandez</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-18 00:48:01', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1),
(8, '', 'Guillermo Jimenez', 'memotablet08@gmail.com', 'multiportal@outlook.com', 'memotablet08@gmail.com', '', 'Contacto Multiportal', 'Prueba', '\r\n        <html>\r\n        <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <title>Documento sin título</title>\r\n        <style type=\"text/css\">\r\n        .fuente1,.fuente2,.fuente3{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:11px;\r\n            color:#000;\r\n            text-align:left;}\r\n        .fuente2{font-size:12px; font-weight:700;}\r\n        .fuente3{font-size:13px; font-weight:bold;}\r\n        .fuente1 a{\r\n            font-family: Calibri, \"Trebuchet MS\";\r\n            font-size:12px;\r\n            color:#444;/*color de link*/\r\n            text-decoration:none;}\r\n        .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}\r\n        .bg_gris{background-color:#F5F5F5;}\r\n        .center{text-align:center;}\r\n        .right{text-align:right;}\r\n        .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}\r\n        </style>\r\n        </head>\r\n        <body>\r\n        <div>\r\n            <table class=\"fuente1\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tr>\r\n                <td colspan=\"6\" class=\"dominio\"><img src=\"https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png\" alt=\"Logo\" style=\"width:90px\" /><a target=\"_blank\" href=\"#\">www.localhost</a></td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"6\" class=\"fuente1\">Mensaje recibido desde la pagina web <b><a target=\"_blank\" href=\"#\">MultiportalMX</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1 center\" style=\"border-top:2px solid #333;\"><br /></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"fuente1\"></td>\r\n            </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Nombre:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Empresa:</td>\r\n                <td colspan=\"4\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">memotablet08@gmail.com</td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"2\" class=\"fuente2\">Correo:</td>\r\n                <td colspan=\"4\">Guillermo Jimenez</td>\r\n              </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\" align=\"right\"></td>\r\n                </tr>\r\n              <tr>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td></td>\r\n                <td colspan=\"2\"></td>\r\n              </tr>\r\n              <tr>\r\n                <td colspan=\"6\" class=\"footer\">Formulario de Contacto v.2.1</td>\r\n              </tr>  \r\n            </table>\r\n        </div>\r\n        </body></html>\r\n    ', '2023-04-18 00:51:29', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text,
  `cate` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`ID`, `title`, `url`, `description`, `cate`, `user_id`, `created_at`) VALUES
(1, 'Phponix', 'https://phphonix.webcindario.com/', 'CMS WEB', 'Web', 2, '2023-03-09 20:37:49'),
(2, 'Multiportal', 'https://multiportal.webcindario.com/', 'Página Web', 'Web', 2, '2023-03-09 23:15:45'),
(3, 'Portafolio', 'https://portafolio1.webcindario.com', 'Página web', 'Portafoio', 2, '2023-03-09 23:33:20');

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

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`ID`, `ID_user`, `Token`, `Estado`, `Fecha`) VALUES
(1, 2, '2a466394fb9cc533fe978abdeba84667786a367a', 'Activo', '2023-05-25 16:35:36'),
(2, 2, '5e7f6b1f343b40cae0f50c097b587210f99108a9', 'Activo', '2023-10-06 01:23:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `upload_files`
--

CREATE TABLE `upload_files` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `type_file` varchar(30) NOT NULL,
  `filec` longblob NOT NULL,
  `created_at` varchar(35) NOT NULL
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
-- Indices de la tabla `api_version`
--
ALTER TABLE `api_version`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitaId`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT de la tabla `api_version`
--
ALTER TABLE `api_version`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
