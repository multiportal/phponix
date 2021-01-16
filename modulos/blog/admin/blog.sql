-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-02-2018 a las 23:41:43
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
-- Estructura de tabla para la tabla `sam_blog`
--

CREATE TABLE `sam_blog` (
  `ID` int(9) UNSIGNED NOT NULL,
  `cover` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `tag` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `fecha` varchar(21) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sam_blog`
--

INSERT INTO `sam_blog` (`ID`, `cover`, `titulo`, `descripcion`, `contenido`, `tag`, `autor`, `fmod`, `fecha`, `visible`) VALUES
(1, 'RGBLo.jpg', ' ¿Qué concentrador de oxígeno escoger? Aquí un artículo sobre... ', 'Si vives con EPOC, tener una fuente de oxígeno confiable es importante para mantener...', '<p>Si vives con EPOC, tener una fuente de ox&iacute;geno confiable es importante para mantener tu calidad de vida. Sin embargo, existen tantos tipos diferentes de concentradores de ox&iacute;geno en el mercado hoy en d&iacute;a, que puede ser dif&iacute;cil elegir el que mejor se adapte a sus necesidades. A medida que esta tecnolog&iacute;a contin&uacute;a avanzando, aparecen caracter&iacute;sticas m&aacute;s nuevas y opciones m&aacute;s c&oacute;modas, &iexcl;y desea aprovecharlas al m&aacute;ximo!</p>\r\n<p>La buena noticia es que hay m&aacute;s opciones para la terapia de ox&iacute;geno disponibles para ti; a continuaci&oacute;n, hemos recopilado informaci&oacute;n excelente sobre los dos principales concentradores de oxigeno dom&eacute;sticos de Philips Respironics:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width=\"299\"><strong>EVERFLO</strong>\r\n<p>&nbsp;</p>\r\n<p>El concentrador de ox&iacute;geno EverFlo de 5 litros es una m&aacute;quina silenciosa, liviana y compacta que es menos llamativa que muchas otras.</p>\r\n<p>Los usuarios pueden comprar el modelo est&aacute;ndar, o el que tiene un indicador de porcentaje de ox&iacute;geno (OPI) y usa ultrasonido para medir el flujo de ox&iacute;geno.</p>\r\n<p>Los controles se encuentran en el lado delantero izquierdo de la m&aacute;quina y una perilla de rodillo controla el medidor de flujo de ox&iacute;geno empotrado en el centro. Una botella de humidificador se puede conectar a la parte posterior izquierda de la m&aacute;quina con velcro. &iexcl;El tubo se conecta f&aacute;cilmente a la c&aacute;nula de metal encima del interruptor de encendido, y tambi&eacute;n se pueden almacenar tubos adicionales en el interior.</p>\r\n<p>&iexcl;EverFlo 5L pesa 14 kgs y entrega ox&iacute;geno a .5-5 LPM con una concentraci&oacute;n de ox&iacute;geno de hasta 95% en todas las velocidades de flujo. La m&aacute;quina mide 58 cm de profundidad.</p>\r\n<p>El concentrador EverFlo de 5L viene con una garant&iacute;a est&aacute;ndar de 1 a&ntilde;o.</p>\r\n</td>\r\n<td width=\"299\"><strong>MILLENNIUM</strong>\r\n<p>&nbsp;</p>\r\n<p>El concentrador de ox&iacute;geno Millenium proporciona hasta 10 LPM de ox&iacute;geno, d&aacute;ndole las especificaciones de una unidad de &ldquo;alto flujo&rdquo;.</p>\r\n<p>El concentrador de ox&iacute;geno est&aacute; disponible en dos modelos: el modelo est&aacute;ndar y uno dise&ntilde;ado con un indicador de porcentaje de ox&iacute;geno (OPI), una funci&oacute;n que utiliza tecnolog&iacute;a de ultrasonido para medir el flujo de ox&iacute;geno.</p>\r\n<p>El dise&ntilde;o rectangular blanco es fuerte y resistente, y cuatro ruedas grandes (junto con un asa insertada en la parte superior) lo hacen bastante f&aacute;cil de mover.</p>\r\n<p>Este concentrador tiene una v&aacute;lvula SMC de &ldquo;ciclo seguro&rdquo;, dise&ntilde;ada espec&iacute;ficamente para manejar los mayores flujos de presi&oacute;n necesarios para una m&aacute;quina de 10 LPM. Millenium tambi&eacute;n est&aacute; dise&ntilde;ado con un compresor de doble cabezal equipado para impulsar m&aacute;s aire a trav&eacute;s de los lechos de tamices de la m&aacute;quina para eliminar el nitr&oacute;geno.</p>\r\n<p>Philips Respironics &ldquo;Millennium&rdquo; viene con una garant&iacute;a est&aacute;ndar de un a&ntilde;o.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\" width=\"599\"><strong>Caracter&iacute;sticas y Beneficios</strong></td>\r\n</tr>\r\n<tr>\r\n<td width=\"299\">Silencioso y f&aacute;cil de usar\r\n<p>&nbsp;</p>\r\n<p>Controles claros y visibles</p>\r\n<p>Dise&ntilde;o ergon&oacute;mico: rueda f&aacute;cilmente</p>\r\n<p>Peso ligero de 14 kg</p>\r\n<p>Medidor de flujo empotrado para proteger contra la rotura</p>\r\n<p>Velcro asegura la botella del humidificador en la m&aacute;quina</p>\r\n<p>Proporciona ox&iacute;geno a .5-5 LPM con 95% de ox&iacute;geno</p>\r\n<p>Alarmas de seguridad por fallas</p>\r\n<p>Garant&iacute;a de producto de tres a&ntilde;os</p>\r\n</td>\r\n<td width=\"299\">F&aacute;cil de usar: los controles son claros y visibles\r\n<p>&nbsp;</p>\r\n<p>Pesa 24 kg</p>\r\n<p>Indicador de Porcentaje de Ox&iacute;geno (OPI) se puede agregar en</p>\r\n<p>Proporciona ox&iacute;geno a 1-10 LPM al 96% de ox&iacute;geno</p>\r\n<p>Alarmas de seguridad por fallas y bajo porcentaje de ox&iacute;geno</p>\r\n<p>Menos partes m&oacute;viles que otros concentradores</p>\r\n<p>Garant&iacute;a est&aacute;ndar de un a&ntilde;o</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\" width=\"599\"><strong>Pros</strong></td>\r\n</tr>\r\n<tr>\r\n<td width=\"299\">Funcionamiento silencioso y sonido silencioso cuando se inicia (45 db)\r\n<p>&nbsp;</p>\r\n<p>F&aacute;cil de usar</p>\r\n<p>Confiable y ligero</p>\r\n<p>Port&aacute;til y f&aacute;cil de mover</p>\r\n<p>Consumo de energ&iacute;a de 350 w</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td width=\"299\">Bien hecho y f&aacute;cil de configurar\r\n<p>&nbsp;</p>\r\n<p>Robusto, confiable y de bajo mantenimiento</p>\r\n<p>Produce hasta 10 LPM de ox&iacute;geno</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\" width=\"599\"><strong>Contras</strong></td>\r\n</tr>\r\n<tr>\r\n<td width=\"299\">Bip fuerte cuando se inicia\r\n<p>&nbsp;</p>\r\n<p>Baja altitud de trabajo</p>\r\n<p>Produce hasta 5 LPM de ox&iacute;geno</p>\r\n</td>\r\n<td width=\"299\">Demasiado ruidoso para algunos usuarios (50 db)\r\n<p>&nbsp;</p>\r\n<p>Pesa 24 kg</p>\r\n<p>Tiene m&aacute;s potencia de la que muchos usuarios necesitan</p>\r\n<p>Consumo de energ&iacute;a de 600 w</p>\r\n<p><strong>&nbsp;</strong></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>La elecci&oacute;n de los dispositivos de administraci&oacute;n de ox&iacute;geno depende del requerimiento del paciente, la eficacia del dispositivo, la fiabilidad, la facilidad de aplicaci&oacute;n terap&eacute;utica y la aceptaci&oacute;n del paciente. <a href=\"http://samsung-healthcare.mx/contacto\"><span style=\"text-decoration: underline;\">Para m&aacute;s informaci&oacute;n sobre la elecci&oacute;n de su concentrador de ox&iacute;geno no dude en contactarnos.</span></a></p>', 'EPOC, Oxígeno', 'admin', '2018-02-08 14:05:54', '2017-01-18 14:05:23', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sam_blog`
--
ALTER TABLE `sam_blog`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sam_blog`
--
ALTER TABLE `sam_blog`
  MODIFY `ID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
