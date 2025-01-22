DROP TABLE messages;

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE php_access;

CREATE TABLE `php_access` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `navegador` varchar(20) NOT NULL,
  `os` varchar(10) NOT NULL,
  `code` varchar(6) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_access VALUES("1","admin","127.0.0.1","CHROME","WIN","944950","2021-03-20 17:22:48");



DROP TABLE php_api_version;

CREATE TABLE `php_api_version` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `vence` varchar(20) NOT NULL,
  `ultimate` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `des_ver` mediumtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO php_api_version VALUES("1","phponix2017","31/08/2019","01.2.3.5","obsoleta","");
INSERT INTO php_api_version VALUES("2","AdminLTE","31/12/2019","01.2.4.5","obsoleta","");
INSERT INTO php_api_version VALUES("3","AdminLTE CSS","30/11/2019","01.2.4.6","activa","");
INSERT INTO php_api_version VALUES("4","AdminLTE CSS2","30/11/2021","01.2.5.1","activa","");
INSERT INTO php_api_version VALUES("5","AdminLTE 7Ajax","29/05/2024","01.2.6.6","activa","");
INSERT INTO php_api_version VALUES("6","AdminLTE PHP7","01/12/2026","01.2.7.2","activa","");
INSERT INTO php_api_version VALUES("7","AdminLTE SE-X","30/11/2027","01.2.8.0","activa","");



DROP TABLE php_blog;

CREATE TABLE `php_blog` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `cate` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `fecha` varchar(21) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_blog VALUES("1","blog_FO_petrolera.jpg","Mi primer blog","Si vives con EPOC, tener una fuente de oxígeno confiable es importante para mantener...","<p>Si vives con EPOC, tener una fuente de ox&iacute;geno confiable es importante para mantener tu calidad de vida. Sin embargo, existen tantos tipos diferentes de concentradores de ox&iacute;geno en el mercado hoy en d&iacute;a, que puede ser dif&iacute;cil elegir el que mejor se adapte a sus necesidades. A medida que esta tecnolog&iacute;a contin&uacute;a avanzando, aparecen caracter&iacute;sticas m&aacute;s nuevas y opciones m&aacute;s c&oacute;modas, &iexcl;y desea aprovecharlas al m&aacute;ximo!</p>\n<p>La buena noticia es que hay m&aacute;s opciones para la terapia de ox&iacute;geno disponibles para ti; a continuaci&oacute;n, hemos recopilado informaci&oacute;n excelente sobre los dos principales concentradores de oxigeno dom&eacute;sticos de Philips Respironics:</p>\n<table>\n<tbody>\n<tr>\n<td width=\"299\"><strong>EVERFLO</strong>\n<p>&nbsp;</p>\n<p>El concentrador de ox&iacute;geno EverFlo de 5 litros es una m&aacute;quina silenciosa, liviana y compacta que es menos llamativa que muchas otras.</p>\n<p>Los usuarios pueden comprar el modelo est&aacute;ndar, o el que tiene un indicador de porcentaje de ox&iacute;geno (OPI) y usa ultrasonido para medir el flujo de ox&iacute;geno.</p>\n<p>Los controles se encuentran en el lado delantero izquierdo de la m&aacute;quina y una perilla de rodillo controla el medidor de flujo de ox&iacute;geno empotrado en el centro. Una botella de humidificador se puede conectar a la parte posterior izquierda de la m&aacute;quina con velcro. &iexcl;El tubo se conecta f&aacute;cilmente a la c&aacute;nula de metal encima del interruptor de encendido, y tambi&eacute;n se pueden almacenar tubos adicionales en el interior.</p>\n<p>&iexcl;EverFlo 5L pesa 14 kgs y entrega ox&iacute;geno a .5-5 LPM con una concentraci&oacute;n de ox&iacute;geno de hasta 95% en todas las velocidades de flujo. La m&aacute;quina mide 58 cm de profundidad.</p>\n<p>El concentrador EverFlo de 5L viene con una garant&iacute;a est&aacute;ndar de 1 a&ntilde;o.</p>\n</td>\n<td width=\"299\"><strong>MILLENNIUM</strong>\n<p>&nbsp;</p>\n<p>El concentrador de ox&iacute;geno Millenium proporciona hasta 10 LPM de ox&iacute;geno, d&aacute;ndole las especificaciones de una unidad de &ldquo;alto flujo&rdquo;.</p>\n<p>El concentrador de ox&iacute;geno est&aacute; disponible en dos modelos: el modelo est&aacute;ndar y uno dise&ntilde;ado con un indicador de porcentaje de ox&iacute;geno (OPI), una funci&oacute;n que utiliza tecnolog&iacute;a de ultrasonido para medir el flujo de ox&iacute;geno.</p>\n<p>El dise&ntilde;o rectangular blanco es fuerte y resistente, y cuatro ruedas grandes (junto con un asa insertada en la parte superior) lo hacen bastante f&aacute;cil de mover.</p>\n<p>Este concentrador tiene una v&aacute;lvula SMC de &ldquo;ciclo seguro&rdquo;, dise&ntilde;ada espec&iacute;ficamente para manejar los mayores flujos de presi&oacute;n necesarios para una m&aacute;quina de 10 LPM. Millenium tambi&eacute;n est&aacute; dise&ntilde;ado con un compresor de doble cabezal equipado para impulsar m&aacute;s aire a trav&eacute;s de los lechos de tamices de la m&aacute;quina para eliminar el nitr&oacute;geno.</p>\n<p>Philips Respironics &ldquo;Millennium&rdquo; viene con una garant&iacute;a est&aacute;ndar de un a&ntilde;o.</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Caracter&iacute;sticas y Beneficios</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Silencioso y f&aacute;cil de usar\n<p>&nbsp;</p>\n<p>Controles claros y visibles</p>\n<p>Dise&ntilde;o ergon&oacute;mico: rueda f&aacute;cilmente</p>\n<p>Peso ligero de 14 kg</p>\n<p>Medidor de flujo empotrado para proteger contra la rotura</p>\n<p>Velcro asegura la botella del humidificador en la m&aacute;quina</p>\n<p>Proporciona ox&iacute;geno a .5-5 LPM con 95% de ox&iacute;geno</p>\n<p>Alarmas de seguridad por fallas</p>\n<p>Garant&iacute;a de producto de tres a&ntilde;os</p>\n</td>\n<td width=\"299\">F&aacute;cil de usar: los controles son claros y visibles\n<p>&nbsp;</p>\n<p>Pesa 24 kg</p>\n<p>Indicador de Porcentaje de Ox&iacute;geno (OPI) se puede agregar en</p>\n<p>Proporciona ox&iacute;geno a 1-10 LPM al 96% de ox&iacute;geno</p>\n<p>Alarmas de seguridad por fallas y bajo porcentaje de ox&iacute;geno</p>\n<p>Menos partes m&oacute;viles que otros concentradores</p>\n<p>Garant&iacute;a est&aacute;ndar de un a&ntilde;o</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Pros</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Funcionamiento silencioso y sonido silencioso cuando se inicia (45 db)\n<p>&nbsp;</p>\n<p>F&aacute;cil de usar</p>\n<p>Confiable y ligero</p>\n<p>Port&aacute;til y f&aacute;cil de mover</p>\n<p>Consumo de energ&iacute;a de 350 w</p>\n<p>&nbsp;</p>\n</td>\n<td width=\"299\">Bien hecho y f&aacute;cil de configurar\n<p>&nbsp;</p>\n<p>Robusto, confiable y de bajo mantenimiento</p>\n<p>Produce hasta 10 LPM de ox&iacute;geno</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Contras</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Bip fuerte cuando se inicia\n<p>&nbsp;</p>\n<p>Baja altitud de trabajo</p>\n<p>Produce hasta 5 LPM de ox&iacute;geno</p>\n</td>\n<td width=\"299\">Demasiado ruidoso para algunos usuarios (50 db)\n<p>&nbsp;</p>\n<p>Pesa 24 kg</p>\n<p>Tiene m&aacute;s potencia de la que muchos usuarios necesitan</p>\n<p>Consumo de energ&iacute;a de 600 w</p>\n<p><strong>&nbsp;</strong></p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>La elecci&oacute;n de los dispositivos de administraci&oacute;n de ox&iacute;geno depende del requerimiento del paciente, la eficacia del dispositivo, la fiabilidad, la facilidad de aplicaci&oacute;n terap&eacute;utica y la aceptaci&oacute;n del paciente. <a href=\"http://samsung-healthcare.mx/contacto\"><span style=\"text-decoration: underline;\">Para m&aacute;s informaci&oacute;n sobre la elecci&oacute;n de su concentrador de ox&iacute;geno no dude en contactarnos.</span></a></p>","Sin Categoria","EPOC, Oxígeno","admin","2021-08-07 16:18:53","2017-01-18 14:05:23","1");



DROP TABLE php_blog_coment;

CREATE TABLE `php_blog_coment` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `id_b` int(3) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_blog_coment VALUES("1","127.0.0.1","Miguel Hernandez","mherco@hotmail.com","Mensaje de prueba de comentario.","1","2021-02-15 21:44:51","1");



DROP TABLE php_chat;

CREATE TABLE `php_chat` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user1` int(255) NOT NULL,
  `id_user2` int(255) NOT NULL,
  `mensage` varchar(1000) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE php_clientes;

CREATE TABLE `php_clientes` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `domicilio` varchar(300) NOT NULL,
  `tel_ofi` varchar(12) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO php_clientes VALUES("1","KAREN NAVARRO","KEY AGENCIA DIGITAL","CELAYA, GTO","442 788 5025","karen.navarro@keyagenciadigital.com");
INSERT INTO php_clientes VALUES("2","RAMSES","FIBRECEN","Guanajuato No. 5-B, Col. San Francisquito","442 305 7704","fibrecen@fibrecen.com.mx");



DROP TABLE php_comp;

CREATE TABLE `php_comp` (
  `ID` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_comp VALUES("1","usuarios/login.php");



DROP TABLE php_config;

CREATE TABLE `php_config` (
  `ID` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `dominio` varchar(100) NOT NULL,
  `path_root` varchar(150) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `metas` mediumtext NOT NULL,
  `g_analytics` mediumtext NOT NULL,
  `tel` varchar(20) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `wapp` varchar(20) NOT NULL,
  `webMail` varchar(100) NOT NULL,
  `contactMail` varchar(100) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `chartset` varchar(30) NOT NULL,
  `dboard` varchar(50) NOT NULL,
  `dboard2` varchar(50) NOT NULL,
  `direc` varchar(250) NOT NULL,
  `CoR` varchar(100) NOT NULL,
  `CoE` varchar(100) NOT NULL,
  `BCC` varchar(100) NOT NULL,
  `CoP` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `gp` varchar(100) NOT NULL,
  `lk` varchar(100) NOT NULL,
  `yt` varchar(100) NOT NULL,
  `ins` varchar(100) NOT NULL,
  `wv` varchar(100) NOT NULL,
  `licencia` varchar(300) NOT NULL,
  `version` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_config VALUES("1","logo.min.png","PHP ONIX","PHP Onix - El mejor CMS para crear y administrar tu sitio web. Gestor de contenido web.","http://localhost/","MisSitios/phponixdev/","http://localhost/MisSitios/phponixdev/","cms,contenido,web,landingpage,p&aacute;gina web","PHP Onix es un CMS gestor de contenidos para tu web.","<!--Responsive Meta-->\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">\n<!-- META-TAGS generadas por http://metatags.miarroba.es -->\n<META NAME=\"DC.Language\" SCHEME=\"RFC1766\" CONTENT=\"Spanish\">\n<META NAME=\"AUTHOR\" CONTENT=\"Guillermo Jimenez\">\n<META NAME=\"REPLY-TO\" CONTENT=\"multiportal@outlook.com\">\n<LINK REV=\"made\" href=\"mailto:multiportal@outlook.com\">\n","<!--Google Analytics-->","(01)4424350334","","4424350334","multiportal@outlook.com","multiportal@outlook.com","page","utf-8","dashboard","AdminLTE","Centro, Quer&eacute;taro, Qro","multiportal@outlook.com","phponix@webcindario.com","","memojl08@gmail.com","https://facebook.com/","https://twitter.com/","","","","","","cms-px31q2hponix31q2x.admx31q2in458x31q2x.202x31q24.05.x31q212.01x31q2.2.8.x31q26x31q2","01.2.8.2");



DROP TABLE php_contacto;

CREATE TABLE `php_contacto` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
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
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_contacto VALUES("1","127.0.0.1","Miguel Hernandez","mherco@hotmail.com","phponix@webcindario.com","mherco@hotmail.com","4421944950","Contacto Web PHP ONIX","Mensaje de Bienvenida - CENTRO DE CONTACTO","Hola estimado usuario, bienvenido a su plataforma \"PHPONIX CMS\" aqui se guardara un copia de respaldo de todos sus correos de contacto y registros de su página web.\n\nCualquier duda o comentario puede ponerse en contacto a través del correo a multiportal@outlook.com o en nuestra página https://phponix.webcindario.com \n\nATTE.\nEl equipo de PHPONIX & MULTIPORTAL ","2021-02-15 15:59:26","inbox","contacto","","","0","1","1","1","1");



DROP TABLE php_contacto_forms;

CREATE TABLE `php_contacto_forms` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `seccion` varchar(100) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `bcc` varchar(200) NOT NULL,
  `CoE` varchar(100) NOT NULL,
  `CoP` varchar(100) NOT NULL,
  `usuario` varchar(300) NOT NULL,
  `url_m` varchar(500) NOT NULL,
  `fecha` varchar(22) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_contacto_forms VALUES("1","Contacto","contacto","multiportal@outlook.com","memojl08@gmail.com","phponix@webcindario.com","memojl08@gmail.com","","index.php?mod=contacto","2018-09-28 18:31:45","1");



DROP TABLE php_countries;

CREATE TABLE `php_countries` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `countryName` varchar(45) NOT NULL DEFAULT '',
  `currencyCode` char(3) DEFAULT NULL,
  `capital` varchar(30) DEFAULT NULL,
  `continentName` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

INSERT INTO php_countries VALUES("1","AD","Andorra","EUR","Andorra la Vella","Europe");
INSERT INTO php_countries VALUES("2","AE","United Arab Emirates","AED","Abu Dhabi","Asia");
INSERT INTO php_countries VALUES("3","AF","Afghanistan","AFN","Kabul","Asia");
INSERT INTO php_countries VALUES("4","AG","Antigua and Barbuda","XCD","St. John\'s","North America");
INSERT INTO php_countries VALUES("5","AI","Anguilla","XCD","The Valley","North America");
INSERT INTO php_countries VALUES("6","AL","Albania","ALL","Tirana","Europe");
INSERT INTO php_countries VALUES("7","AM","Armenia","AMD","Yerevan","Asia");
INSERT INTO php_countries VALUES("8","AO","Angola","AOA","Luanda","Africa");
INSERT INTO php_countries VALUES("9","AQ","Antarctica","","","Antarctica");
INSERT INTO php_countries VALUES("10","AR","Argentina","ARS","Buenos Aires","South America");
INSERT INTO php_countries VALUES("11","AS","American Samoa","USD","Pago Pago","Oceania");
INSERT INTO php_countries VALUES("12","AT","Austria","EUR","Vienna","Europe");
INSERT INTO php_countries VALUES("13","AU","Australia","AUD","Canberra","Oceania");
INSERT INTO php_countries VALUES("14","AW","Aruba","AWG","Oranjestad","North America");
INSERT INTO php_countries VALUES("15","AX","Åland","EUR","Mariehamn","Europe");
INSERT INTO php_countries VALUES("16","AZ","Azerbaijan","AZN","Baku","Asia");
INSERT INTO php_countries VALUES("17","BA","Bosnia and Herzegovina","BAM","Sarajevo","Europe");
INSERT INTO php_countries VALUES("18","BB","Barbados","BBD","Bridgetown","North America");
INSERT INTO php_countries VALUES("19","BD","Bangladesh","BDT","Dhaka","Asia");
INSERT INTO php_countries VALUES("20","BE","Belgium","EUR","Brussels","Europe");
INSERT INTO php_countries VALUES("21","BF","Burkina Faso","XOF","Ouagadougou","Africa");
INSERT INTO php_countries VALUES("22","BG","Bulgaria","BGN","Sofia","Europe");
INSERT INTO php_countries VALUES("23","BH","Bahrain","BHD","Manama","Asia");
INSERT INTO php_countries VALUES("24","BI","Burundi","BIF","Bujumbura","Africa");
INSERT INTO php_countries VALUES("25","BJ","Benin","XOF","Porto-Novo","Africa");
INSERT INTO php_countries VALUES("26","BL","Saint Barthélemy","EUR","Gustavia","North America");
INSERT INTO php_countries VALUES("27","BM","Bermuda","BMD","Hamilton","North America");
INSERT INTO php_countries VALUES("28","BN","Brunei","BND","Bandar Seri Begawan","Asia");
INSERT INTO php_countries VALUES("29","BO","Bolivia","BOB","Sucre","South America");
INSERT INTO php_countries VALUES("30","BQ","Bonaire","USD","","North America");
INSERT INTO php_countries VALUES("31","BR","Brazil","BRL","Brasília","South America");
INSERT INTO php_countries VALUES("32","BS","Bahamas","BSD","Nassau","North America");
INSERT INTO php_countries VALUES("33","BT","Bhutan","BTN","Thimphu","Asia");
INSERT INTO php_countries VALUES("34","BV","Bouvet Island","NOK","","Antarctica");
INSERT INTO php_countries VALUES("35","BW","Botswana","BWP","Gaborone","Africa");
INSERT INTO php_countries VALUES("36","BY","Belarus","BYR","Minsk","Europe");
INSERT INTO php_countries VALUES("37","BZ","Belize","BZD","Belmopan","North America");
INSERT INTO php_countries VALUES("38","CA","Canada","CAD","Ottawa","North America");
INSERT INTO php_countries VALUES("39","CC","Cocos [Keeling] Islands","AUD","West Island","Asia");
INSERT INTO php_countries VALUES("40","CD","Democratic Republic of the Congo","CDF","Kinshasa","Africa");
INSERT INTO php_countries VALUES("41","CF","Central African Republic","XAF","Bangui","Africa");
INSERT INTO php_countries VALUES("42","CG","Republic of the Congo","XAF","Brazzaville","Africa");
INSERT INTO php_countries VALUES("43","CH","Switzerland","CHF","Berne","Europe");
INSERT INTO php_countries VALUES("44","CI","Ivory Coast","XOF","Yamoussoukro","Africa");
INSERT INTO php_countries VALUES("45","CK","Cook Islands","NZD","Avarua","Oceania");
INSERT INTO php_countries VALUES("46","CL","Chile","CLP","Santiago","South America");
INSERT INTO php_countries VALUES("47","CM","Cameroon","XAF","Yaoundé","Africa");
INSERT INTO php_countries VALUES("48","CN","China","CNY","Beijing","Asia");
INSERT INTO php_countries VALUES("49","CO","Colombia","COP","Bogotá","South America");
INSERT INTO php_countries VALUES("50","CR","Costa Rica","CRC","San José","North America");
INSERT INTO php_countries VALUES("51","CU","Cuba","CUP","Havana","North America");
INSERT INTO php_countries VALUES("52","CV","Cape Verde","CVE","Praia","Africa");
INSERT INTO php_countries VALUES("53","CW","Curacao","ANG","Willemstad","North America");
INSERT INTO php_countries VALUES("54","CX","Christmas Island","AUD","The Settlement","Asia");
INSERT INTO php_countries VALUES("55","CY","Cyprus","EUR","Nicosia","Europe");
INSERT INTO php_countries VALUES("56","CZ","Czech Republic","CZK","Prague","Europe");
INSERT INTO php_countries VALUES("57","DE","Germany","EUR","Berlin","Europe");
INSERT INTO php_countries VALUES("58","DJ","Djibouti","DJF","Djibouti","Africa");
INSERT INTO php_countries VALUES("59","DK","Denmark","DKK","Copenhagen","Europe");
INSERT INTO php_countries VALUES("60","DM","Dominica","XCD","Roseau","North America");
INSERT INTO php_countries VALUES("61","DO","Dominican Republic","DOP","Santo Domingo","North America");
INSERT INTO php_countries VALUES("62","DZ","Algeria","DZD","Algiers","Africa");
INSERT INTO php_countries VALUES("63","EC","Ecuador","USD","Quito","South America");
INSERT INTO php_countries VALUES("64","EE","Estonia","EUR","Tallinn","Europe");
INSERT INTO php_countries VALUES("65","EG","Egypt","EGP","Cairo","Africa");
INSERT INTO php_countries VALUES("66","EH","Western Sahara","MAD","El Aaiún","Africa");
INSERT INTO php_countries VALUES("67","ER","Eritrea","ERN","Asmara","Africa");
INSERT INTO php_countries VALUES("68","ES","Spain","EUR","Madrid","Europe");
INSERT INTO php_countries VALUES("69","ET","Ethiopia","ETB","Addis Ababa","Africa");
INSERT INTO php_countries VALUES("70","FI","Finland","EUR","Helsinki","Europe");
INSERT INTO php_countries VALUES("71","FJ","Fiji","FJD","Suva","Oceania");
INSERT INTO php_countries VALUES("72","FK","Falkland Islands","FKP","Stanley","South America");
INSERT INTO php_countries VALUES("73","FM","Micronesia","USD","Palikir","Oceania");
INSERT INTO php_countries VALUES("74","FO","Faroe Islands","DKK","Tórshavn","Europe");
INSERT INTO php_countries VALUES("75","FR","France","EUR","Paris","Europe");
INSERT INTO php_countries VALUES("76","GA","Gabon","XAF","Libreville","Africa");
INSERT INTO php_countries VALUES("77","GB","United Kingdom","GBP","London","Europe");
INSERT INTO php_countries VALUES("78","GD","Grenada","XCD","St. George\'s","North America");
INSERT INTO php_countries VALUES("79","GE","Georgia","GEL","Tbilisi","Asia");
INSERT INTO php_countries VALUES("80","GF","French Guiana","EUR","Cayenne","South America");
INSERT INTO php_countries VALUES("81","GG","Guernsey","GBP","St Peter Port","Europe");
INSERT INTO php_countries VALUES("82","GH","Ghana","GHS","Accra","Africa");
INSERT INTO php_countries VALUES("83","GI","Gibraltar","GIP","Gibraltar","Europe");
INSERT INTO php_countries VALUES("84","GL","Greenland","DKK","Nuuk","North America");
INSERT INTO php_countries VALUES("85","GM","Gambia","GMD","Banjul","Africa");
INSERT INTO php_countries VALUES("86","GN","Guinea","GNF","Conakry","Africa");
INSERT INTO php_countries VALUES("87","GP","Guadeloupe","EUR","Basse-Terre","North America");
INSERT INTO php_countries VALUES("88","GQ","Equatorial Guinea","XAF","Malabo","Africa");
INSERT INTO php_countries VALUES("89","GR","Greece","EUR","Athens","Europe");
INSERT INTO php_countries VALUES("90","GS","South Georgia and the South Sandwich Islands","GBP","Grytviken","Antarctica");
INSERT INTO php_countries VALUES("91","GT","Guatemala","GTQ","Guatemala City","North America");
INSERT INTO php_countries VALUES("92","GU","Guam","USD","Hagåtña","Oceania");
INSERT INTO php_countries VALUES("93","GW","Guinea-Bissau","XOF","Bissau","Africa");
INSERT INTO php_countries VALUES("94","GY","Guyana","GYD","Georgetown","South America");
INSERT INTO php_countries VALUES("95","HK","Hong Kong","HKD","Hong Kong","Asia");
INSERT INTO php_countries VALUES("96","HM","Heard Island and McDonald Islands","AUD","","Antarctica");
INSERT INTO php_countries VALUES("97","HN","Honduras","HNL","Tegucigalpa","North America");
INSERT INTO php_countries VALUES("98","HR","Croatia","HRK","Zagreb","Europe");
INSERT INTO php_countries VALUES("99","HT","Haiti","HTG","Port-au-Prince","North America");
INSERT INTO php_countries VALUES("100","HU","Hungary","HUF","Budapest","Europe");
INSERT INTO php_countries VALUES("101","ID","Indonesia","IDR","Jakarta","Asia");
INSERT INTO php_countries VALUES("102","IE","Ireland","EUR","Dublin","Europe");
INSERT INTO php_countries VALUES("103","IL","Israel","ILS","","Asia");
INSERT INTO php_countries VALUES("104","IM","Isle of Man","GBP","Douglas","Europe");
INSERT INTO php_countries VALUES("105","IN","India","INR","New Delhi","Asia");
INSERT INTO php_countries VALUES("106","IO","British Indian Ocean Territory","USD","","Asia");
INSERT INTO php_countries VALUES("107","IQ","Iraq","IQD","Baghdad","Asia");
INSERT INTO php_countries VALUES("108","IR","Iran","IRR","Tehran","Asia");
INSERT INTO php_countries VALUES("109","IS","Iceland","ISK","Reykjavik","Europe");
INSERT INTO php_countries VALUES("110","IT","Italy","EUR","Rome","Europe");
INSERT INTO php_countries VALUES("111","JE","Jersey","GBP","Saint Helier","Europe");
INSERT INTO php_countries VALUES("112","JM","Jamaica","JMD","Kingston","North America");
INSERT INTO php_countries VALUES("113","JO","Jordan","JOD","Amman","Asia");
INSERT INTO php_countries VALUES("114","JP","Japan","JPY","Tokyo","Asia");
INSERT INTO php_countries VALUES("115","KE","Kenya","KES","Nairobi","Africa");
INSERT INTO php_countries VALUES("116","KG","Kyrgyzstan","KGS","Bishkek","Asia");
INSERT INTO php_countries VALUES("117","KH","Cambodia","KHR","Phnom Penh","Asia");
INSERT INTO php_countries VALUES("118","KI","Kiribati","AUD","Tarawa","Oceania");
INSERT INTO php_countries VALUES("119","KM","Comoros","KMF","Moroni","Africa");
INSERT INTO php_countries VALUES("120","KN","Saint Kitts and Nevis","XCD","Basseterre","North America");
INSERT INTO php_countries VALUES("121","KP","North Korea","KPW","Pyongyang","Asia");
INSERT INTO php_countries VALUES("122","KR","South Korea","KRW","Seoul","Asia");
INSERT INTO php_countries VALUES("123","KW","Kuwait","KWD","Kuwait City","Asia");
INSERT INTO php_countries VALUES("124","KY","Cayman Islands","KYD","George Town","North America");
INSERT INTO php_countries VALUES("125","KZ","Kazakhstan","KZT","Astana","Asia");
INSERT INTO php_countries VALUES("126","LA","Laos","LAK","Vientiane","Asia");
INSERT INTO php_countries VALUES("127","LB","Lebanon","LBP","Beirut","Asia");
INSERT INTO php_countries VALUES("128","LC","Saint Lucia","XCD","Castries","North America");
INSERT INTO php_countries VALUES("129","LI","Liechtenstein","CHF","Vaduz","Europe");
INSERT INTO php_countries VALUES("130","LK","Sri Lanka","LKR","Colombo","Asia");
INSERT INTO php_countries VALUES("131","LR","Liberia","LRD","Monrovia","Africa");
INSERT INTO php_countries VALUES("132","LS","Lesotho","LSL","Maseru","Africa");
INSERT INTO php_countries VALUES("133","LT","Lithuania","LTL","Vilnius","Europe");
INSERT INTO php_countries VALUES("134","LU","Luxembourg","EUR","Luxembourg","Europe");
INSERT INTO php_countries VALUES("135","LV","Latvia","EUR","Riga","Europe");
INSERT INTO php_countries VALUES("136","LY","Libya","LYD","Tripoli","Africa");
INSERT INTO php_countries VALUES("137","MA","Morocco","MAD","Rabat","Africa");
INSERT INTO php_countries VALUES("138","MC","Monaco","EUR","Monaco","Europe");
INSERT INTO php_countries VALUES("139","MD","Moldova","MDL","Chişinău","Europe");
INSERT INTO php_countries VALUES("140","ME","Montenegro","EUR","Podgorica","Europe");
INSERT INTO php_countries VALUES("141","MF","Saint Martin","EUR","Marigot","North America");
INSERT INTO php_countries VALUES("142","MG","Madagascar","MGA","Antananarivo","Africa");
INSERT INTO php_countries VALUES("143","MH","Marshall Islands","USD","Majuro","Oceania");
INSERT INTO php_countries VALUES("144","MK","Macedonia","MKD","Skopje","Europe");
INSERT INTO php_countries VALUES("145","ML","Mali","XOF","Bamako","Africa");
INSERT INTO php_countries VALUES("146","MM","Myanmar [Burma]","MMK","Nay Pyi Taw","Asia");
INSERT INTO php_countries VALUES("147","MN","Mongolia","MNT","Ulan Bator","Asia");
INSERT INTO php_countries VALUES("148","MO","Macao","MOP","Macao","Asia");
INSERT INTO php_countries VALUES("149","MP","Northern Mariana Islands","USD","Saipan","Oceania");
INSERT INTO php_countries VALUES("150","MQ","Martinique","EUR","Fort-de-France","North America");
INSERT INTO php_countries VALUES("151","MR","Mauritania","MRO","Nouakchott","Africa");
INSERT INTO php_countries VALUES("152","MS","Montserrat","XCD","Plymouth","North America");
INSERT INTO php_countries VALUES("153","MT","Malta","EUR","Valletta","Europe");
INSERT INTO php_countries VALUES("154","MU","Mauritius","MUR","Port Louis","Africa");
INSERT INTO php_countries VALUES("155","MV","Maldives","MVR","Malé","Asia");
INSERT INTO php_countries VALUES("156","MW","Malawi","MWK","Lilongwe","Africa");
INSERT INTO php_countries VALUES("157","MX","Mexico","MXN","Mexico City","North America");
INSERT INTO php_countries VALUES("158","MY","Malaysia","MYR","Kuala Lumpur","Asia");
INSERT INTO php_countries VALUES("159","MZ","Mozambique","MZN","Maputo","Africa");
INSERT INTO php_countries VALUES("160","NA","Namibia","NAD","Windhoek","Africa");
INSERT INTO php_countries VALUES("161","NC","New Caledonia","XPF","Noumea","Oceania");
INSERT INTO php_countries VALUES("162","NE","Niger","XOF","Niamey","Africa");
INSERT INTO php_countries VALUES("163","NF","Norfolk Island","AUD","Kingston","Oceania");
INSERT INTO php_countries VALUES("164","NG","Nigeria","NGN","Abuja","Africa");
INSERT INTO php_countries VALUES("165","NI","Nicaragua","NIO","Managua","North America");
INSERT INTO php_countries VALUES("166","NL","Netherlands","EUR","Amsterdam","Europe");
INSERT INTO php_countries VALUES("167","NO","Norway","NOK","Oslo","Europe");
INSERT INTO php_countries VALUES("168","NP","Nepal","NPR","Kathmandu","Asia");
INSERT INTO php_countries VALUES("169","NR","Nauru","AUD","","Oceania");
INSERT INTO php_countries VALUES("170","NU","Niue","NZD","Alofi","Oceania");
INSERT INTO php_countries VALUES("171","NZ","New Zealand","NZD","Wellington","Oceania");
INSERT INTO php_countries VALUES("172","OM","Oman","OMR","Muscat","Asia");
INSERT INTO php_countries VALUES("173","PA","Panama","PAB","Panama City","North America");
INSERT INTO php_countries VALUES("174","PE","Peru","PEN","Lima","South America");
INSERT INTO php_countries VALUES("175","PF","French Polynesia","XPF","Papeete","Oceania");
INSERT INTO php_countries VALUES("176","PG","Papua New Guinea","PGK","Port Moresby","Oceania");
INSERT INTO php_countries VALUES("177","PH","Philippines","PHP","Manila","Asia");
INSERT INTO php_countries VALUES("178","PK","Pakistan","PKR","Islamabad","Asia");
INSERT INTO php_countries VALUES("179","PL","Poland","PLN","Warsaw","Europe");
INSERT INTO php_countries VALUES("180","PM","Saint Pierre and Miquelon","EUR","Saint-Pierre","North America");
INSERT INTO php_countries VALUES("181","PN","Pitcairn Islands","NZD","Adamstown","Oceania");
INSERT INTO php_countries VALUES("182","PR","Puerto Rico","USD","San Juan","North America");
INSERT INTO php_countries VALUES("183","PS","Palestine","ILS","","Asia");
INSERT INTO php_countries VALUES("184","PT","Portugal","EUR","Lisbon","Europe");
INSERT INTO php_countries VALUES("185","PW","Palau","USD","Melekeok - Palau State Capital","Oceania");
INSERT INTO php_countries VALUES("186","PY","Paraguay","PYG","Asunción","South America");
INSERT INTO php_countries VALUES("187","QA","Qatar","QAR","Doha","Asia");
INSERT INTO php_countries VALUES("188","RE","Réunion","EUR","Saint-Denis","Africa");
INSERT INTO php_countries VALUES("189","RO","Romania","RON","Bucharest","Europe");
INSERT INTO php_countries VALUES("190","RS","Serbia","RSD","Belgrade","Europe");
INSERT INTO php_countries VALUES("191","RU","Russia","RUB","Moscow","Europe");
INSERT INTO php_countries VALUES("192","RW","Rwanda","RWF","Kigali","Africa");
INSERT INTO php_countries VALUES("193","SA","Saudi Arabia","SAR","Riyadh","Asia");
INSERT INTO php_countries VALUES("194","SB","Solomon Islands","SBD","Honiara","Oceania");
INSERT INTO php_countries VALUES("195","SC","Seychelles","SCR","Victoria","Africa");
INSERT INTO php_countries VALUES("196","SD","Sudan","SDG","Khartoum","Africa");
INSERT INTO php_countries VALUES("197","SE","Sweden","SEK","Stockholm","Europe");
INSERT INTO php_countries VALUES("198","SG","Singapore","SGD","Singapore","Asia");
INSERT INTO php_countries VALUES("199","SH","Saint Helena","SHP","Jamestown","Africa");
INSERT INTO php_countries VALUES("200","SI","Slovenia","EUR","Ljubljana","Europe");
INSERT INTO php_countries VALUES("201","SJ","Svalbard and Jan Mayen","NOK","Longyearbyen","Europe");
INSERT INTO php_countries VALUES("202","SK","Slovakia","EUR","Bratislava","Europe");
INSERT INTO php_countries VALUES("203","SL","Sierra Leone","SLL","Freetown","Africa");
INSERT INTO php_countries VALUES("204","SM","San Marino","EUR","San Marino","Europe");
INSERT INTO php_countries VALUES("205","SN","Senegal","XOF","Dakar","Africa");
INSERT INTO php_countries VALUES("206","SO","Somalia","SOS","Mogadishu","Africa");
INSERT INTO php_countries VALUES("207","SR","Suriname","SRD","Paramaribo","South America");
INSERT INTO php_countries VALUES("208","SS","South Sudan","SSP","Juba","Africa");
INSERT INTO php_countries VALUES("209","ST","São Tomé and Príncipe","STD","São Tomé","Africa");
INSERT INTO php_countries VALUES("210","SV","El Salvador","USD","San Salvador","North America");
INSERT INTO php_countries VALUES("211","SX","Sint Maarten","ANG","Philipsburg","North America");
INSERT INTO php_countries VALUES("212","SY","Syria","SYP","Damascus","Asia");
INSERT INTO php_countries VALUES("213","SZ","Swaziland","SZL","Mbabane","Africa");
INSERT INTO php_countries VALUES("214","TC","Turks and Caicos Islands","USD","Cockburn Town","North America");
INSERT INTO php_countries VALUES("215","TD","Chad","XAF","N\'Djamena","Africa");
INSERT INTO php_countries VALUES("216","TF","French Southern Territories","EUR","Port-aux-Français","Antarctica");
INSERT INTO php_countries VALUES("217","TG","Togo","XOF","Lomé","Africa");
INSERT INTO php_countries VALUES("218","TH","Thailand","THB","Bangkok","Asia");
INSERT INTO php_countries VALUES("219","TJ","Tajikistan","TJS","Dushanbe","Asia");
INSERT INTO php_countries VALUES("220","TK","Tokelau","NZD","","Oceania");
INSERT INTO php_countries VALUES("221","TL","East Timor","USD","Dili","Oceania");
INSERT INTO php_countries VALUES("222","TM","Turkmenistan","TMT","Ashgabat","Asia");
INSERT INTO php_countries VALUES("223","TN","Tunisia","TND","Tunis","Africa");
INSERT INTO php_countries VALUES("224","TO","Tonga","TOP","Nuku\'alofa","Oceania");
INSERT INTO php_countries VALUES("225","TR","Turkey","TRY","Ankara","Asia");
INSERT INTO php_countries VALUES("226","TT","Trinidad and Tobago","TTD","Port of Spain","North America");
INSERT INTO php_countries VALUES("227","TV","Tuvalu","AUD","Funafuti","Oceania");
INSERT INTO php_countries VALUES("228","TW","Taiwan","TWD","Taipei","Asia");
INSERT INTO php_countries VALUES("229","TZ","Tanzania","TZS","Dodoma","Africa");
INSERT INTO php_countries VALUES("230","UA","Ukraine","UAH","Kyiv","Europe");
INSERT INTO php_countries VALUES("231","UG","Uganda","UGX","Kampala","Africa");
INSERT INTO php_countries VALUES("232","UM","U.S. Minor Outlying Islands","USD","","Oceania");
INSERT INTO php_countries VALUES("233","US","United States","USD","Washington","North America");
INSERT INTO php_countries VALUES("234","UY","Uruguay","UYU","Montevideo","South America");
INSERT INTO php_countries VALUES("235","UZ","Uzbekistan","UZS","Tashkent","Asia");
INSERT INTO php_countries VALUES("236","VA","Vatican City","EUR","Vatican","Europe");
INSERT INTO php_countries VALUES("237","VC","Saint Vincent and the Grenadines","XCD","Kingstown","North America");
INSERT INTO php_countries VALUES("238","VE","Venezuela","VEF","Caracas","South America");
INSERT INTO php_countries VALUES("239","VG","British Virgin Islands","USD","Road Town","North America");
INSERT INTO php_countries VALUES("240","VI","U.S. Virgin Islands","USD","Charlotte Amalie","North America");
INSERT INTO php_countries VALUES("241","VN","Vietnam","VND","Hanoi","Asia");
INSERT INTO php_countries VALUES("242","VU","Vanuatu","VUV","Port Vila","Oceania");
INSERT INTO php_countries VALUES("243","WF","Wallis and Futuna","XPF","Mata-Utu","Oceania");
INSERT INTO php_countries VALUES("244","WS","Samoa","WST","Apia","Oceania");
INSERT INTO php_countries VALUES("245","XK","Kosovo","EUR","Pristina","Europe");
INSERT INTO php_countries VALUES("246","YE","Yemen","YER","Sanaa","Asia");
INSERT INTO php_countries VALUES("247","YT","Mayotte","EUR","Mamoutzou","Africa");
INSERT INTO php_countries VALUES("248","ZA","South Africa","ZAR","Pretoria","Africa");
INSERT INTO php_countries VALUES("249","ZM","Zambia","ZMW","Lusaka","Africa");
INSERT INTO php_countries VALUES("250","ZW","Zimbabwe","ZWL","Harare","Africa");



DROP TABLE php_css;

CREATE TABLE `php_css` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `tema` varchar(50) NOT NULL,
  `general` varchar(50) NOT NULL,
  `body` varchar(50) NOT NULL,
  `fuente` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  `fondo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_css2;

CREATE TABLE `php_css2` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO php_css2 VALUES("1","color-primario","#0088cc","1");
INSERT INTO php_css2 VALUES("2","color-secundario","#212529","1");
INSERT INTO php_css2 VALUES("3","body-color-bg","#ffffff","1");
INSERT INTO php_css2 VALUES("4","body-color-text","#777777","1");
INSERT INTO php_css2 VALUES("5","menu-bg","#ffffff","1");
INSERT INTO php_css2 VALUES("6","menu-size","12px","1");
INSERT INTO php_css2 VALUES("7","menu-color","#0088cc","1");
INSERT INTO php_css2 VALUES("8","footer-bg","#212529","1");
INSERT INTO php_css2 VALUES("9","footer-size","26px","1");
INSERT INTO php_css2 VALUES("10","footer-color","#777777","1");



DROP TABLE php_cursos;

CREATE TABLE `php_cursos` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `fechas` varchar(100) NOT NULL,
  `lugar` varchar(200) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `video` varchar(300) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `fecha` varchar(21) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_cursos_coment;

CREATE TABLE `php_cursos_coment` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `id_b` int(3) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_depa;

CREATE TABLE `php_depa` (
  `ID` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `list_depa` varchar(100) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO php_depa VALUES("1","Administrador","Administradores","Administrador","1","","0");
INSERT INTO php_depa VALUES("2","Edecan","Edecanes","Edecan","2","","1");
INSERT INTO php_depa VALUES("3","Modelo","Modelos","Modelo","2","","0");
INSERT INTO php_depa VALUES("4","Fotografo","Fotografos","Fotografo","2","","1");
INSERT INTO php_depa VALUES("5","Agencia","Agencias","Agencia","2","","1");
INSERT INTO php_depa VALUES("6","Escuela","Escuelas","Escuela","2","","0");



DROP TABLE php_directorio;

CREATE TABLE `php_directorio` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `url_link` varchar(300) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `des` varchar(250) NOT NULL,
  `filtro` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `fecha` varchar(22) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_empresa;

CREATE TABLE `php_empresa` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ima` varchar(100) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO php_empresa VALUES("1","VISIÓN","vision.jpg","<p>Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>","1");
INSERT INTO php_empresa VALUES("2","MISIÓN","vision.jpg","<p>2(MISI&Oacute;N)Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>","1");
INSERT INTO php_empresa VALUES("3","VALORES","vision.jpg","<p>3(VALORES)Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>","1");



DROP TABLE php_galeria;

CREATE TABLE `php_galeria` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `cate` varchar(50) NOT NULL,
  `resena` varchar(500) NOT NULL,
  `url_page` varchar(150) NOT NULL,
  `imagen1` varchar(100) NOT NULL,
  `imagen2` varchar(100) NOT NULL,
  `imagen3` varchar(100) NOT NULL,
  `imagen4` varchar(100) NOT NULL,
  `imagen5` varchar(100) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `alta` varchar(21) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `user` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_histo_backupdb;

CREATE TABLE `php_histo_backupdb` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(50) NOT NULL,
  `archivo` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_home_config;

CREATE TABLE `php_home_config` (
  `ID` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `selc` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_home_config VALUES("1","phponix backup","<!--Contenido Generado MySql-->\n<div id=\"content1\">\n<div id=\"intro\">\n<div class=\"clear\">&nbsp;</div>\n<h2>PHP Onix el mejor CMS para crear y administrar tu sitio web.</h2>\n<div class=\"clear\">&nbsp;</div>\n<p style=\"font-size: 16px;\">Con <strong>PHPOnix</strong> podras instalar y crear tu sitio web en 5 minutos ademas con herramientas para gestionar, monitoriar y posicionar tu p&aacute;gina web. <strong>PHPOnix</strong> cuenta con multiples funcionalidades desde crear un p&aacute;gina <strong>web standar</strong>, <strong>landingpage</strong>, <strong>intranet</strong>, <strong>blog</strong>, <strong>catalogo</strong>, <strong>portafolio</strong>, incluso una tienda virtual*(<strong>ecommerce</strong>) para tu negocio o servicio tu elijes la funcionalidad.</p>\n<div class=\"clear\">&nbsp;</div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>Sitio Web</h3>\n<img src=\"./modulos/Home/img/web.png\" alt=\"\" width=\"80%\" /></div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>LandingPage</h3>\n<img src=\"./modulos/Home/img/intuitivo.png\" alt=\"\" width=\"80%\" /></div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>Ecommerce</h3>\n<img src=\"./modulos/Home/img/ecommerce.png\" alt=\"\" width=\"80%\" /></div>\n</div>\n</div>\n<div id=\"content2\">\n<div id=\"beneficios\">\n<div class=\"clear\">&nbsp;</div>\n<h2>Beneficios</h2>\n<div class=\"clear\">&nbsp;</div>\n<p>&nbsp;</p>\n<div class=\"clear\">&nbsp;</div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>Multi-Dispositivos</h3>\n<img src=\"./modulos/Home/img/multidispositivo.png\" alt=\"\" width=\"80%\" /></div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>Reporte de Estadisticas</h3>\n<img src=\"./modulos/Home/img/estadisticas.png\" alt=\"\" width=\"80%\" /></div>\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\n<h3>Gestion de Contenido</h3>\n<img src=\"./modulos/Home/img/busqueda-sistema.png\" alt=\"\" width=\"80%\" /></div>\n</div>\n</div>","0","0");



DROP TABLE php_iconos;

CREATE TABLE `php_iconos` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `fa_icon` varchar(100) NOT NULL,
  `icon` mediumtext NOT NULL,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO php_iconos VALUES("1","Descarga","fa-download","<i class=\"fa fa-download\"></i>","awesome");
INSERT INTO php_iconos VALUES("2","Menu","fa-list","<i class=\"fa fa-list\"></i>","awesome");
INSERT INTO php_iconos VALUES("3","Configuracion","fa-gear","<i class=\"fa fa-gear\"></i>","awesome");
INSERT INTO php_iconos VALUES("4","Configuraciones","fa-gears","<i class=\"fa fa-gear\"></i>","awesome");
INSERT INTO php_iconos VALUES("5","Modulos","fa-cubes","<i class=\"fa fa-cubes\"></i>","awesome");
INSERT INTO php_iconos VALUES("6","Home","fa-home","<i class=\"fa fa-home\"></i>","awesome");
INSERT INTO php_iconos VALUES("7","Portafolio","fa-briefcase","<i class=\"fa fa-briefcase\"></i>","awesome");
INSERT INTO php_iconos VALUES("8","Blog","fa-comments","<i class=\"fa fa-comments\"></i>","awesome");
INSERT INTO php_iconos VALUES("9","BlockIP","fa-crosshairs","<i class=\"fa fa-crosshairs\"></i>","awesome");
INSERT INTO php_iconos VALUES("10","Estadisticas","fa-bar-chart","<i class=\"fa fa-bar-chart\"></i>","awesome");
INSERT INTO php_iconos VALUES("11","Moneda","fa-usd","<i class=\"fa fa-usd\"></i>","awesome");
INSERT INTO php_iconos VALUES("12","Dashboard","fa-dashboard","<i class=\"fa fa-dashboard\"></i>","awesome");
INSERT INTO php_iconos VALUES("13","Usuario","fa-user","<i class=\"fa fa-user\"></i>","awesome");
INSERT INTO php_iconos VALUES("14","Usuarios","fa-users","<i class=\"fa fa-users\"></i>","awesome");
INSERT INTO php_iconos VALUES("15","Global","fa-globe","<i class=\"fa fa-globe\"></i>","awesome");
INSERT INTO php_iconos VALUES("16","Ver","fa-eye","<i class=\"fa fa-eye\"></i>","awesome");
INSERT INTO php_iconos VALUES("17","Enviar","fa-send-o","<i class=\"fa fa-send-o\"></i>","awesome");
INSERT INTO php_iconos VALUES("18","Mail","fa-envelope","<i class=\"fa  fa-envelope\"></i>","awesome");
INSERT INTO php_iconos VALUES("19","Marca de Mapa","fa-map-marker","<i class=\"fa  fa-map-marker\"></i>","awesome");
INSERT INTO php_iconos VALUES("20","Formularios","fa-pencil-square-o","<i class=\"fa  fa-pencil-square-o\"></i>","awesome");
INSERT INTO php_iconos VALUES("21","Carrito","fa-shopping-cart","<i class=\"fa fa-shopping-cart\"></i>","awesome");
INSERT INTO php_iconos VALUES("22","Folder Open Blanco","fa-folder-open-o","<i class=\"fa fa-folder-open-o\"></i>","awesome");
INSERT INTO php_iconos VALUES("23","Folder Open","fa-folder-open","<i class=\"fa fa-folder-open\"></i>","awesome");
INSERT INTO php_iconos VALUES("24","Tesmoniales","fa-commenting","<i class=\"fa fa-commenting\"></i>","awesome");
INSERT INTO php_iconos VALUES("25","Clientes","fa-child","<i class=\"fa fa-child\"></i>","awesome");
INSERT INTO php_iconos VALUES("26","Mapa","fa-map","<i class=\"fa fa-map\" aria-hidden=\"true\"></i>","awesome");
INSERT INTO php_iconos VALUES("27","Sitemap","fa-sitemap","<i class=\"fa fa-sitemap\"></i>","awesome");
INSERT INTO php_iconos VALUES("28","Check Square","fa-check-square","<i class=\"fa fa-check-square\"></i>","awesome");
INSERT INTO php_iconos VALUES("29","Play","fa-caret-square-o-right","<i class=\"fa fa-caret-square-o-right\"></i>","awesome");
INSERT INTO php_iconos VALUES("30","Curso","fa-university","<i class=\"fa fa-university\"></i>","awesome");
INSERT INTO php_iconos VALUES("31","Paint-brush","fa-paint-brush","<i class=\"fa fa-paint-brush\"></i>","awesome");



DROP TABLE php_ipbann;

CREATE TABLE `php_ipbann` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(256) NOT NULL DEFAULT '',
  `bloqueo` tinyint(1) NOT NULL,
  `alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO php_ipbann VALUES("1","127.0.0.5","0","2017-10-17 05:55:47");
INSERT INTO php_ipbann VALUES("2","174.128.181.67","0","2019-11-23 04:01:09");
INSERT INTO php_ipbann VALUES("3","174.128.181.68","0","2019-11-23 04:01:56");
INSERT INTO php_ipbann VALUES("4","78.0.3904.70","0","2019-11-23 04:02:19");
INSERT INTO php_ipbann VALUES("5","189.166.7.220","0","2019-11-23 04:02:38");
INSERT INTO php_ipbann VALUES("6","165.227.41.143","0","2019-11-23 04:02:54");
INSERT INTO php_ipbann VALUES("7","159.203.34.197","0","2019-11-23 04:03:24");
INSERT INTO php_ipbann VALUES("8","167.99.177.203","0","2019-11-24 02:55:26");



DROP TABLE php_landingpage_seccion;

CREATE TABLE `php_landingpage_seccion` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `seccion` varchar(100) NOT NULL,
  `tit` varchar(150) NOT NULL,
  `conte` varchar(254) NOT NULL,
  `visible` varchar(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO php_landingpage_seccion VALUES("1","Nosotros","","","1");
INSERT INTO php_landingpage_seccion VALUES("2","Equipo","","","1");
INSERT INTO php_landingpage_seccion VALUES("3","Servicios","","","1");
INSERT INTO php_landingpage_seccion VALUES("4","Portafolio","","","1");
INSERT INTO php_landingpage_seccion VALUES("5","Clientes","","","1");
INSERT INTO php_landingpage_seccion VALUES("6","Contacto","","","1");
INSERT INTO php_landingpage_seccion VALUES("7","Testimoniales","","","1");



DROP TABLE php_map_config;

CREATE TABLE `php_map_config` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `zoom` varchar(2) NOT NULL,
  `cover` varchar(50) NOT NULL,
  `on_costo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO php_map_config VALUES("1","Querétaro","20.5931297","-100.3920483","12","g_intelmex.png","0");



DROP TABLE php_map_ubicacion;

CREATE TABLE `php_map_ubicacion` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adres` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `info` varchar(250) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `nivel` varchar(2) NOT NULL,
  `rol` varchar(2) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `lng` varchar(15) NOT NULL,
  `alta` varchar(20) NOT NULL,
  `fmod` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_map_ubicacion VALUES("1","Intelmex","Calle 1 303, Jurica, 76130 Santiago de Querétaro, Qro.","","Reparación de telefonos","0.00","4421234567","nodisponible.jpg","1","3","20.6500317","-100.4290312","2018-04-03 13:44:50","2018-04-03 13:59:06","1","1");



DROP TABLE php_menu_admin;

CREATE TABLE `php_menu_admin` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(50) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `link` mediumtext NOT NULL,
  `nivel` int(1) NOT NULL,
  `ID_menu_adm` int(2) NOT NULL,
  `ID_mod` int(2) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO php_menu_admin VALUES("1","Config. Sistema","fa-gear","index.php?mod=sys&ext=admin/index","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("2","Modulos","fa-cubes","index.php?mod=sys&ext=modulos","-1","0","0","1");
INSERT INTO php_menu_admin VALUES("3","Logs","fa-globe","index.php?mod=sys&ext=admin/index&opc=logs","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("4","Bloquear IP","fa-crosshairs","index.php?mod=sys&ext=admin/index&opc=bloquear","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("5","Temas","fa-sticky-note-o","index.php?mod=sys&ext=admin/index&opc=temas","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("6","Admin. Usuarios","fa-users","index.php?mod=usuarios&ext=admin/index","-1","0","6","0");
INSERT INTO php_menu_admin VALUES("7","Menu Admin","fa-list","index.php?mod=sys&ext=menu_admin","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("8","Iconos","fa-smile-o","index.php?mod=sys&ext=admin/index&opc=iconos","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("9","Informe de Visitas","fa-download","index.php?mod=estadisticas&ext=admin/index","1","0","12","1");
INSERT INTO php_menu_admin VALUES("10","Backup DB","fa-download","index.php?mod=sys&ext=backup","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("11","Config. Mailbox","fa-gear","index.php?mod=mailbox&ext=admin/index","1","0","14","1");
INSERT INTO php_menu_admin VALUES("12","Mensajes","fa-envelope","index.php?mod=mailbox","1","0","14","1");
INSERT INTO php_menu_admin VALUES("13","Editar","fa-home","index.php?mod=Home&ext=admin/index","1","0","5","1");
INSERT INTO php_menu_admin VALUES("14","Menu Web","fa-list","index.php?mod=Home&ext=admin/index&opc=menu_web","1","0","5","1");
INSERT INTO php_menu_admin VALUES("15","Admin productos","fa-shopping-cart","index.php?mod=productos&ext=admin/index","1","0","17","1");
INSERT INTO php_menu_admin VALUES("16","Categoria de productos","fa-folder-open","index.php?mod=productos&ext=admin/index&opc=categoria","1","0","17","1");
INSERT INTO php_menu_admin VALUES("17","Subcategoria de productos","fa-folder-open-o","index.php?mod=productos&ext=admin/index&opc=subcategoria","1","0","17","1");
INSERT INTO php_menu_admin VALUES("18","Config. Gmaps","fa-gear","index.php?mod=gmaps&ext=admin/index","1","0","18","1");
INSERT INTO php_menu_admin VALUES("19","Ubicaciones","fa-map-marker","index.php?mod=gmaps&ext=admin/index&opc=ubicaciones","1","0","18","1");
INSERT INTO php_menu_admin VALUES("20","Config. Contacto","fa-gear","index.php?mod=contacto&ext=admin/index","1","0","10","1");
INSERT INTO php_menu_admin VALUES("21","Correos de Formulario","fa-pencil-square-o","index.php?mod=contacto&ext=admin/index&opc=forms","1","0","10","1");
INSERT INTO php_menu_admin VALUES("22","Generador Sitemap","fa-sitemap","index.php?mod=sys&ext=admin/index&opc=sitemap","1","0","11","1");
INSERT INTO php_menu_admin VALUES("23","Opciones","fa-gears","index.php?mod=sys&ext=opciones","1","0","11","1");
INSERT INTO php_menu_admin VALUES("24","Licencia","fa-eye","index.php?mod=sys&ext=licencia","-1","0","11","1");
INSERT INTO php_menu_admin VALUES("25","Slider","fa-caret-square-o-right","index.php?mod=Home&ext=admin/index&opc=slider","1","0","5","1");
INSERT INTO php_menu_admin VALUES("26","Testimonios","fa-child","index.php?mod=Home&ext=admin/index&opc=testimonios","1","0","5","1");
INSERT INTO php_menu_admin VALUES("27","Tema","fa-paint-brush","index.php?mod=Home&ext=admin/index&opc=tema","1","0","5","1");
INSERT INTO php_menu_admin VALUES("28","Estilos","fa-folder-open-o","index.php?mod=Home&ext=admin/index&opc=style_var","1","0","5","1");
INSERT INTO php_menu_admin VALUES("29","Marcas","fa-folder-open","index.php?mod=productos&ext=admin/index&opc=marcas","-1","0","17","1");



DROP TABLE php_menu_web;

CREATE TABLE `php_menu_web` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `menu` varchar(50) NOT NULL,
  `url` varchar(254) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `ext` varchar(50) NOT NULL,
  `ord` varchar(2) NOT NULL,
  `subm` varchar(3) NOT NULL,
  `ima_top` varchar(100) NOT NULL,
  `tit_sec` varchar(100) NOT NULL,
  `des_sec` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO php_menu_web VALUES("1","Inicio","index.php","Home","","1","","gris.png","","","0");
INSERT INTO php_menu_web VALUES("2","Nosotros","#","nosotros","","2","","gris.png","","","0");
INSERT INTO php_menu_web VALUES("3","Descargas","descargas/","descargas","","3","","gris.png","","","0");
INSERT INTO php_menu_web VALUES("4","Blog","blog/","blog","","4","","gris.png","Blog","","1");
INSERT INTO php_menu_web VALUES("5","Contacto","contacto/","contacto","","5","","gris.png","","","1");



DROP TABLE php_mode_page;

CREATE TABLE `php_mode_page` (
  `ID` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `page_mode` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO php_mode_page VALUES("1","page");
INSERT INTO php_mode_page VALUES("2","landingpage");
INSERT INTO php_mode_page VALUES("3","extranet");
INSERT INTO php_mode_page VALUES("4","ecommerce");
INSERT INTO php_mode_page VALUES("5","CRM");



DROP TABLE php_modulos;

CREATE TABLE `php_modulos` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL DEFAULT '',
  `modulo` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL,
  `dashboard` tinyint(1) NOT NULL,
  `nivel` tinyint(4) NOT NULL DEFAULT '0',
  `home` tinyint(4) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '0',
  `sname` varchar(10) NOT NULL DEFAULT '',
  `icono` varchar(50) NOT NULL,
  `link` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO php_modulos VALUES("1","admin","admin","","0","0","0","0","1","false","","");
INSERT INTO php_modulos VALUES("2","Login","login","Administraci&oacute;n Login.","0","0","0","0","1","false","fa-users","index.php?mod=login");
INSERT INTO php_modulos VALUES("3","Logout","logout","Administraci&oacute;n Logout.","0","0","0","0","1","false","fa-users","index.php?mod=logout");
INSERT INTO php_modulos VALUES("4","Dashboard","dashboard","","1","-1","0","0","1","false","fa-dashboard","index.php?mod=dashboard");
INSERT INTO php_modulos VALUES("5","Home","Home","Administraci&oacute;n y gesti&oacute;n del Home.","0","0","1","1","1","false","fa-home","index.php?mod=Home");
INSERT INTO php_modulos VALUES("6","Usuarios","usuarios","Administación y gestión de usuarios.","0","-1","0","1","1","false","fa-users","index.php?mod=usuarios");
INSERT INTO php_modulos VALUES("7","Nosotros","nosotros","Administración del contenido del modulo de nosotros.","0","0","0","1","1","false","fa-users","index.php?mod=nosotros");
INSERT INTO php_modulos VALUES("8","Portafolio","portafolio","Administraci&oacute;n y gesti&oacute;n del portafolio.","0","0","0","1","1","false","fa-briefcase","index.php?mod=portafolio");
INSERT INTO php_modulos VALUES("9","Blog","blog","Administraci&oacute;n del contenido del modulo de blog.","0","0","0","1","1","false","fa-comments","index.php?mod=blog");
INSERT INTO php_modulos VALUES("10","Contacto","contacto","Consultas del modulo de contacto.","0","0","0","1","1","false","fa-map-marker","index.php?mod=contacto");
INSERT INTO php_modulos VALUES("11","Sistema","sys","Configuraci&oacute;n y administraci&oacute;n del sistema.","1","-1","0","1","1","false","fa-gear","index.php?mod=sys");
INSERT INTO php_modulos VALUES("12","Estadistica","estadisticas","Estadisticas de trafico. ","0","-1","0","1","1","false","fa-bar-chart","index.php?mod=estadisticas");
INSERT INTO php_modulos VALUES("13","Formularios","forms","Administracion de Formularios para la web.","1","1","0","0","0","false","fa-pencil-square-o","index.php?mod=forms");
INSERT INTO php_modulos VALUES("14","Mailbox","mailbox","Mailbox de formularios","1","1","0","1","1","false"," fa-envelope","index.php?mod=mailbox");
INSERT INTO php_modulos VALUES("15","Ecommerce","ecommerce","Administraci&oacute;n y gesti&oacute;n del modulo ecommerce.","0","1","0","0","0","false","fa-shopping-cart","index.php?mod=ecommerce");
INSERT INTO php_modulos VALUES("16","Marketing","marketing","","0","1","0","0","0","false","fa-globe","index.php?mod=marketing");
INSERT INTO php_modulos VALUES("17","Productos","productos","Administraci&oacute;n de productos","0","0","0","1","1","false","fa-shopping-cart","index.php?mod=productos");
INSERT INTO php_modulos VALUES("18","Gmaps","gmaps","Mapas de Google","0","0","0","1","1","false","fa-map","index.php?mod=gmaps");
INSERT INTO php_modulos VALUES("19","Chat","chat","Administración del modulo chat.","0","1","0","0","1","false","fa-commenting","index.php?mod=chat");
INSERT INTO php_modulos VALUES("20","Directorio","directorio","Administrador del modulo de Directorio.","0","1","0","0","0","false","fa-globe","index.php?mod=directorio");
INSERT INTO php_modulos VALUES("21","descargas","descargas","Administrador del modulo descargas","0","1","0","1","1","false","fa-download","index.php?mod=descargas");
INSERT INTO php_modulos VALUES("22","Servicios","","Administrador del modulo servicios","0","0","0","0","0","false","fa-briefcase","index.php?mod=servicios");



DROP TABLE php_noticias;

CREATE TABLE `php_noticias` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `tag` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `fecha` varchar(21) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_noticias VALUES("1","automatizacion.jpg","Tendencias en Automatización para el 2019","Comenzamos un nuevo año que continuará dándonos importantes avances en la digitalización de la industria. 2019 apunta a que sera un año importante en muchos aspectos pero quizás, sea el avance hacia l","<div class=\"itemFullText\">\n<p>Comenzamos un nuevo a&ntilde;o que continuar&aacute; d&aacute;ndonos importantes avances en la digitalizaci&oacute;n de la industria.&nbsp; 2019 apunta a que sera un a&ntilde;o importante en muchos aspectos pero quiz&aacute;s, sea&nbsp;el avance hacia la posible estandarizaci&oacute;n de las comunicaciones industriales gracias a TSN uno de los aspectos m&aacute;s importantes.</p>\n<p>Aqu&iacute; os mostramos 8&nbsp;tendencias pueden marcar el futuro de la automatizaci&oacute;n industrial en 2019</p>\n<p>&nbsp;</p>\n<h2>1 #&nbsp;Inteligencia Artificial (IA)</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_01.jpg\" alt=\"\" /></p>\n<p>La Inteligencia Articial (IA)&nbsp; siempre a estado asociada a pel&iacute;culas futuristas pero parece que el futuro ya est&aacute; aqu&iacute;. Este a&ntilde;o, la feria Hannover Messe 2018 puso su acento en la IA,&nbsp;\"La <strong>inteligencia artificial</strong>&nbsp;tiene el potencial de <strong>revolucionar las industrias de producci&oacute;n</strong>&nbsp;y energ&iacute;a\", dec&iacute;a el Dr. Jochen K&ouml;ckler, presidente de la Junta de Deutsche Messe.</p>\n<p>Durante 2018 varias empresas del mundo de la automatizaci&oacute;n han empezado a presentar soluciones basadas en IA:</p>\n<p><strong>Omron</strong>&nbsp;present&oacute; lo que afirma ser el <a href=\"/noticias/item/104315-omron-inteligencia-artificial-machine-automation-controller\" rel=\"noopener noreferrer\" target=\"_blank\">primer&nbsp;controlador de m&aacute;quina equipado con un algoritmo de inteligencia artificial (IA)</a>&nbsp;de aprendizaje autom&aacute;tico (machine-learning).&nbsp;<strong>ABB e IBM</strong>&nbsp;anunciaron su <a href=\"/plus-plus/empresas/item/104268-abb-ibm-asocian-soluciones-inteligencia-artificial\" rel=\"noopener noreferrer\" target=\"_blank\">asociaci&oacute;n en soluciones de inteligencia artificial</a>. <strong>Rockwell Automation</strong> present&oacute; el <a href=\"/noticias/item/105086-rockwell-inteligencia-artificial-ia-project-sherlock\" rel=\"noopener noreferrer\" target=\"_blank\">m&oacute;dulo de Inteligencia Artificial (IA) Project Sherlock</a>&nbsp;que utiliza el aprendizaje autom&aacute;tico para crear anal&iacute;ticas poderosas desde la infraestructura de automatizaci&oacute;n. <strong>Siemens</strong> tambi&eacute;n a incorporado Inteligencia Artificial para los controladores Simatic&nbsp;con la <a href=\"/noticias/item/106008-inteligencia-artificial-automatas-simatic-siemens\" rel=\"noopener noreferrer\" target=\"_blank\">nueva S7-1500 TM NPU</a> (unidad de procesamiento neural).</p>\n<h2>&nbsp;</h2>\n<h2>2 #&nbsp;Plataformas para OEMs</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_02.jpg\" alt=\"\" /></p>\n<p>Las plataformas de servicios Cloud &amp; Analytics para fabricantes de maquinaria (OEMs) es un sector que empieza a tomar fuerza. En infoPLC hemos abierto un nuevo canal dedicado&nbsp;a contaros las novedades referentes a los&nbsp;<a href=\"/plataformas-servicios-cloud-oem\" rel=\"noopener noreferrer\" target=\"_blank\">servicios de plataformas</a>.</p>\n<p>Estas plataformas permite implementar de una manera real la industria 4.0 y sus beneficios a los fabricantes de maquinaria ya que les&nbsp;ofrece la posibilidad monitorizar y analizar su flota de m&aacute;quinas instaladas sin tener que invertir en elevados costos de implementaci&oacute;n.&nbsp;</p>\n<p>Las plataformas permiten conectar las m&aacute;quinas a las Nube y recopilar datos de una manera muy sencilla. EL fabricante de maquinaria puede implementar mediante Dashboards interfaces que permiten la monitorizaci&oacute;n y an&aacute;lisis de los datos pudiendo ofrecer nuevos servicios a sus clientes como por ejemplo mantenimiento predictivo.&nbsp;</p>\n<p>Empresas del secrtor de la automatizaci&oacute;n han creado estos servicios. <strong>Schneider Electric</strong> present&oacute; recientemente <a href=\"/noticias/item/106026-machine-advisor-datos-fabricantes-maquinaria\" rel=\"noopener noreferrer\" target=\"_blank\">Machine Advisor</a>, <strong>Rockwell</strong> ofrece la soluci&oacute;n <a href=\"/noticias/item/105248-rockwell-factorytalk-analytics-rendimiento-maquina\" rel=\"noopener noreferrer\" target=\"_blank\">FactoryTalk Analytics for Machines cloud para OEMs</a>&nbsp;y<strong> KUKA </strong>ofrece <a href=\"/noticias/item/103816-plataforma-cloud-kuka-connect\" rel=\"noopener noreferrer\" target=\"_blank\">KUKA Connect</a>, una completa&nbsp;plataforma de monitorizaci&oacute;n y an&aacute;lisis para sus robots. la compra de <strong>B&amp;R</strong> por parte de <strong>ABB</strong> empieza a dar sus frutos, una de las pimeras soluciones realizadas en conjunto es <a href=\"/noticias/item/106095-asset-performance-monitor\" rel=\"noopener noreferrer\" target=\"_blank\">Asset Performance Monitor</a>.</p>\n<p>Pero no solo empresas del sector cl&aacute;sicas ofrecen estos servicios, nuevas empresas esta&aacute;n aprovechando el auge de la Industria 4.0 para ofrecer nuevas soluciones, por ejemplo <strong>IXON</strong> una plataforma que ofrece conexi&oacute;n remota a m&aacute;quina VPN y <a href=\"https://www.ixon.cloud/\" rel=\"noopener noreferrer\" target=\"_blank\">servicios de&nbsp;Cloud Logging y&nbsp;Cloud Notify</a>.&nbsp;<strong>MachineMetrics</strong> es una <a href=\"https://www.machinemetrics.com\" rel=\"noopener noreferrer\" target=\"_blank\">plataforma de an&aacute;lisis de fabricaci&oacute;n</a> que aumenta la productividad a trav&eacute;s de la visibilidad en tiempo real, el an&aacute;lisis profundo y las notificaciones predictivas. Seguro que nuevas empresas ajenas actualmente al sector industrial empiezan a ofrecer soluciones y plataformas enfocadas a los OEMS y clientes finales con el fin de sacar partido a los datos de sus m&aacute;quinas.</p>\n<h2>&nbsp;</h2>\n<h2>3 #&nbsp;Robotica&nbsp;sigue creciendo</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_03.jpg\" alt=\"\" /></p>\n<p>El&nbsp;desarrollo constante de las tecnolog&iacute;as rob&oacute;ticas sin duda ha ampliado las aplicaciones potenciales para robots industriales inteligentes. De este modo, hoy en d&iacute;a, los robots impulsados por software de vanguardia y sistemas de visi&oacute;n pueden programarse para realizar una serie de tareas, que se ajustan perfectamente a la demanda de fabricaci&oacute;n flexible.</p>\n<p>Durante 2018 hemos visto importantes movimientos en el sector, como uno de los pioneros de la rob&oacute;tica colaborativa <a href=\"/noticias/item/105831-rethink-robotics-cierra-empresa\" rel=\"noopener noreferrer\" target=\"_blank\">Rethink Robotics fue a la quiebra</a>, Omron continua su apuesta por la rob&oacute;tica, tras la compra de Adept se ha aliado con <a href=\"/noticias/item/106033-omron-robots-colaborativos-serie-tm-cobot\" rel=\"noopener noreferrer\" target=\"_blank\">TM para ofrecer rob&oacute;tica colaborativa</a>. A nivel nacional destaca la llegada de los robots chinos <a href=\"/plus-plus/entrevistas/item/105866-estun-robotica-al-alcance-de-todos\" rel=\"noopener noreferrer\" target=\"_blank\"><strong>ESTUN</strong> a Espa&ntilde;a</a> de la mano de Mec&aacute;nico Moderna y el anuncio de <strong>FANUC</strong> de su <a href=\"/plus-plus/empresas/item/105845-fanuc-nueva-sede-sant-cugat-barcelona\" rel=\"noopener noreferrer\" target=\"_blank\">nueva sede en&nbsp;Sant Cugat</a>.</p>\n<p>En 2019 seguir&aacute; creciendo las soluciones OPEN que permite controlar la mec&aacute;nica de los robots utilizando controladores independientes al robot. Ademas&nbsp;<strong>Microsoft</strong> ha anunciado un lanzamiento experimental del sistema operativo de c&oacute;digo abierto Robot (ROS) para Windows y&nbsp;<strong>Google</strong> planea lanzar una plataforma rob&oacute;tica en la nube</p>\n<p>Aqu&iacute; os indicamos <a href=\"/noticias/item/106085-6-tendencias-futuras-robotica-industrial\" rel=\"noopener noreferrer\" target=\"_blank\">6 tendencias futuras en la rob&oacute;tica industrial</a>.</p>\n<h2>&nbsp;</h2>\n<h2>4 #&nbsp;TSN (Time-Sensitive Networking)</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_04.jpg\" alt=\"\" /></p>\n<p>Lo pudimos comprobar en la ultima edici&oacute;n de la feria SPS IPC Drives 2018, <strong>TSN ha sido sin duda uno de los grandes protagonistas, una red abierta unificadora</strong>. Parece que por primera vez en la historia de la automatizaci&oacute;n puede verse un horizonte de estandarizaci&oacute;n en los protocolos de comunicaci&oacute;n.</p>\n<p>Existe una gran cantidad de discusiones&nbsp;en las que se creen que TSN tiene el potencial de ser una &uacute;nica red determinista unificadora compartida por todas las aplicaciones en la industria .</p>\n<p>Como TSN es una arquitectura de red compartida totalmente administrada, todo el tr&aacute;fico de red, incluidos todos los protocolos industriales&nbsp;de la planta, deber&aacute;n cumplir con el conjunto de est&aacute;ndares TSN para lograr comunicaciones deterministas y confiables.</p>\n<p>Este a&ntilde;o hemos conocido la noticia de que<a href=\"/noticias/item/105966-opc-foundation-extiende-opc-ua-incluyendo-tsn-nivel-campo\" rel=\"noopener noreferrer\" target=\"_blank\"> OPC Foundation extiende OPC UA incluyendo TSN</a> hasta el nivel de campo, esta iniciativoa ha sido secundada por&nbsp;los <a href=\"/plus-plus/tecnologia/item/106018-industria-automatizacion-une-opc-ua-incluido-tsn\" rel=\"noopener noreferrer\" target=\"_blank\">principales Players de la industria de la automatizaci&oacute;n se unen a OPC UA con TSN</a>.</p>\n<h2>&nbsp;</h2>\n<h2>5 #&nbsp;Gemelo Digital</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_05.jpg\" alt=\"\" /></p>\n<p>El concepto de \"gemelos digitales\" permite la <strong>creaci&oacute;n de una copia virtual de una m&aacute;quina o sistema</strong>. Esto se est&aacute; convirtiendo en un requisito previo en el panorama del desarrollo de productos. Adem&aacute;s, la digitalizaci&oacute;n de plantas y maquinaria garantiza una puesta en servicio eficiente, un dise&ntilde;o optimizado de la m&aacute;quina, operaciones sin problemas y un corto tiempo de cambio. Este proceso reduce la dependencia de prototipos costosos a la vez que acelera el tiempo de comercializaci&oacute;n.</p>\n<p>Adem&aacute;s, los gemelos digitales ahora est&aacute;n activos en los pisos de f&aacute;brica, analizando las eficiencias de producci&oacute;n e impulsando el mantenimiento predictivo. En el futuro, los fabricantes conocer&aacute;n todos los componentes instalados en sus productos. De este modo, les permite brindar una respuesta espec&iacute;fica a los problemas y optimizar los procesos.</p>\n<p>EMpresas del sector empiezan a ofrecer soluciones enfocadas a al \"Digital Twin\"&nbsp;<strong>Lenze</strong> usa cada vez m&aacute;s la realidad virtual y el <a href=\"/noticias/item/105864-lenze-presenta-ingenieria-gemelo-virtual\" rel=\"noopener noreferrer\" target=\"_blank\">gemelo digital</a> como una herramienta efectiva de ingenier&iacute;a y formaci&oacute;n. <a href=\"/noticias/item/105391-tia-portal-v15-1\" rel=\"noopener noreferrer\" target=\"_blank\">TIA Portal V15.1</a>&nbsp;de <strong>Siemens</strong> se centra en nuevas&nbsp;opciones de simulaci&oacute;n y puesta en marcha virtual ofreciendo un&nbsp;gemelo digital del controlador Simatic S7-1500 as&iacute; como la reciente <a href=\"/plus-plus/empresas/item/106065-siemens-aker-solutions-alianza\" rel=\"noopener noreferrer\" target=\"_blank\">alianza con Aker Solutions</a>&nbsp;que tiene el digital twin en el centro</p>\n<p>&nbsp;</p>\n<h2>6 #&nbsp;Realidad Virtual</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_06.jpg\" alt=\"\" width=\"651\" height=\"360\" /></p>\n<p>Hoy en d&iacute;a, la realidad aumentada (AR) y la realidad virtual (VR) se utilizan en varios contextos, desde las aplicaciones del consumidor hasta la fabricaci&oacute;n. Sin embargo, es en este &uacute;ltimo que AR ofrece un inmenso valor en innumerables formas, en combinaci&oacute;n con otras tecnolog&iacute;as. De hecho, las tecnolog&iacute;as VR y AR est&aacute;n revolucionando los procesos de producci&oacute;n complejos y los desarrollos de productos.</p>\n<p>En el contexto de la automatizaci&oacute;n industrial y de fabricaci&oacute;n, la VR puede ayudar a los fabricantes a simular un producto o entorno digitalmente. De este modo, permiti&eacute;ndoles interactuar y sumergirse en &eacute;l. AR ayuda a los usuarios industriales a proyectar productos digitales o informaci&oacute;n en un entorno del mundo real. Esto es m&aacute;s productivo que proyectar en un entorno simulado digitalmente como en la realidad virtual.</p>\n<h2>&nbsp;</h2>\n<h2>7 #&nbsp;Ciberseguridad</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_07.jpg\" alt=\"\" /></p>\n<p>A nuestro entender es el gran reto para el despliegue de la Industria 4.0.&nbsp;Ya existen est&aacute;ndares para la ciberseguridad industrial y en la mayor&iacute;a de las industrias, estos son voluntarios. Dicho esto, existe una tendencia mundial para la regulaci&oacute;n gubernamental. Ya hemos visto esto en las regulaciones de los sistemas de seguridad industrial. Desafortunadamente, en lugar de un esfuerzo estandarizado, existen m&uacute;ltiples iniciativas en el mundo con diferentes objetivos y, en &uacute;ltima instancia, diferentes est&aacute;ndares.</p>\n<p>El <a href=\"/plus-plus/tecnologia/item/105937-nuevo-estandar-isa-reducir-vulnerabilidades\" rel=\"noopener noreferrer\" target=\"_blank\">nuevo&nbsp;est&aacute;ndar ISA/IEC 62443-4-2-2018</a>&nbsp;de la serie SA/IEC 62443&nbsp;persigue blindar los procesos de adquisici&oacute;n e integraci&oacute;n de ordenadores, aplicaciones, equipos de red y dispositivos de control que constituyen un sistema de control.</p>\n<p>Las soluciones avanzadas de ciberseguridad industrial disponibles en la actualidad tienen un enfoque h&iacute;brido muy efectivo. Adem&aacute;s, esto incluye tanto la detecci&oacute;n de anomal&iacute;as basada en el comportamiento que ayuda a identificar posibles amenazas cibern&eacute;ticas que utilizan enfoques de ciberseguridad convencionales, como el an&aacute;lisis basado en reglas que permite a los fabricantes aprovechar una inspecci&oacute;n profunda para descubrir ciberataques de malware en la red.</p>\n<p>Pero como hemos visto en numerosas ocasiones \"los malos siempre van por delante\" y la industria deber de estar preparada e invertir en Ciberseguridad. Las empresas industriales este a&ntilde;o han seguido dando muestras de tomarse en serio la Ciberseguridad,&nbsp;<strong>Moxa y Trend Micro</strong> crean una joint venture,&nbsp; <a href=\"/plus-plus/empresas/item/105972-moxa-y-trend-micro-crean-una-joint-venture\" rel=\"noopener noreferrer\" target=\"_blank\">TXOne Networks</a> se centrar&aacute; en la construcci&oacute;n de pasarelas de seguridad.&nbsp;<strong>ForeScout y Belden</strong> se unen para <a href=\"/plus-plus/empresas/item/105951-forescout-belden-alianza-entornos-industriales\" rel=\"noopener noreferrer\" target=\"_blank\">proteger los entornos industriales</a>.&nbsp;<strong>Honeywell</strong> present&oacute; nuevos servicios de Ciberseguridad Industrial.</p>\n<p>Puedes estar al d&iacute;a de todas las noticias sobre <a href=\"/ciberseguridad-industrial\" rel=\"noopener noreferrer\" target=\"_blank\">Ciberseguridad Industrial en nuestro portal</a></p>\n<h2>&nbsp;</h2>\n<h2>8 #&nbsp;Open Source Code</h2>\n<p><img src=\"/files/imagenes/noticias/2019/106084_08.jpg\" alt=\"\" /></p>\n<p>Los ecosistemas abiertos permiten la interoperabilidad de m&uacute;ltiples proveedores en todos los niveles de la arquitectura del sistema, al tiempo que simplifican la integraci&oacute;n. Algunos ejemplos de <strong>Open Source en la Automatizaci&oacute;n Industrial</strong>.<br /><br />OPC UA es una plataforma de c&oacute;digo abierto, una arquitectura independiente orientada a servicios. <strong>OPC UA</strong> integra toda la funcionalidad de las especificaciones de OPC Classic y un n&uacute;mero creciente de otros modelos de datos de c&oacute;digo abierto, como MTConnect y FDT, en un marco extensible.</p>\n<p>El software de c&oacute;digo abierto <strong>Node-RED</strong> es un entorno de programaci&oacute;n para crear y ejecutar aplicaciones visualmente, esta tecnolog&iacute;a est&aacute; siendo utilizada por una cantidad de proveedores. Estamos viendo como mucho IoT Box o IoT Gateway lo est&aacute;n utilizando&nbsp;para subir datos de m&aacute;quinas a la nube.</p>\n<p>Algunos proveedores incluyen nombres como, por ejemplo, Opto 22, Hilscher, Harting, NEXCOM, Siemens,&nbsp;veremos como&nbsp;<strong>Node-RED cada vez est&aacute; m&aacute;s integrado en la automatizaci&oacute;n industrial.</strong></p>\n</div>","automatizacion, tendencias","admin","2019-08-22 20:57:28","2017-01-18 14:05:23","1");



DROP TABLE php_noticias_coment;

CREATE TABLE `php_noticias_coment` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `id_b` int(3) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_noticias_coment VALUES("1","127.0.0.1","Guillermo Jim&eacute;nez L&oacute;pez","mherco@hotmail.com","Mensaje de prueba para noticias","1","2018-12-21 22:14:55","1");



DROP TABLE php_notificacion;

CREATE TABLE `php_notificacion` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `ID_user2` int(11) NOT NULL,
  `nombre_envio` varchar(255) NOT NULL,
  `mensaje` mediumtext NOT NULL,
  `visto` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecha` varchar(22) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_notificacion VALUES("1","1","1","admin","Su sistema PHPONIX ha sido actualizado.","1","1","2019-06-27 23:09:38");



DROP TABLE php_opciones;

CREATE TABLE `php_opciones` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `valor` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

INSERT INTO php_opciones VALUES("1","google_analytics","","1");
INSERT INTO php_opciones VALUES("2","form_registro","","0");
INSERT INTO php_opciones VALUES("3","geo_loc_visitas","","0");
INSERT INTO php_opciones VALUES("4","slide_active","","1");
INSERT INTO php_opciones VALUES("5","API_facebook","","0");
INSERT INTO php_opciones VALUES("6","API_google_maps","","0");
INSERT INTO php_opciones VALUES("7","api_noti_chrome","","0");
INSERT INTO php_opciones VALUES("8","link_var","","0");
INSERT INTO php_opciones VALUES("9","link_productos","","0");
INSERT INTO php_opciones VALUES("10","tiny_text_des","","0");
INSERT INTO php_opciones VALUES("11","email_test","","1");
INSERT INTO php_opciones VALUES("12","skin_AdminLTE","","blue");
INSERT INTO php_opciones VALUES("13","mini_bar_AdminLTE","","0");
INSERT INTO php_opciones VALUES("14","wordpress","","0");
INSERT INTO php_opciones VALUES("15","bar_login","","0");
INSERT INTO php_opciones VALUES("16","bar_productos","","0");
INSERT INTO php_opciones VALUES("17","toogle_nombre","","0");
INSERT INTO php_opciones VALUES("18","mostrar_precio","","0");
INSERT INTO php_opciones VALUES("19","mostrar_nombre","","0");
INSERT INTO php_opciones VALUES("20","mostrar_des_corta","","0");
INSERT INTO php_opciones VALUES("21","mostrar_des","","0");
INSERT INTO php_opciones VALUES("22","mostrar_galeria","","0");
INSERT INTO php_opciones VALUES("23","b_vista_rapida","","0");
INSERT INTO php_opciones VALUES("24","b_ver_pro","","0");
INSERT INTO php_opciones VALUES("25","b_cotizar","","0");
INSERT INTO php_opciones VALUES("26","b_cart","","0");
INSERT INTO php_opciones VALUES("27","b_paypal","","0");
INSERT INTO php_opciones VALUES("28","blog_coment","","1");
INSERT INTO php_opciones VALUES("29","noticias_coment","","0");
INSERT INTO php_opciones VALUES("30","cursos_coment","","0");
INSERT INTO php_opciones VALUES("31","productos_coment","","0");
INSERT INTO php_opciones VALUES("32","all_productos","","0");
INSERT INTO php_opciones VALUES("33","e_rates","","0");
INSERT INTO php_opciones VALUES("34","footer_dir","","0");
INSERT INTO php_opciones VALUES("35","validacion_json","","0");
INSERT INTO php_opciones VALUES("36","url_var_json","","0");
INSERT INTO php_opciones VALUES("37","VUE2","","0");
INSERT INTO php_opciones VALUES("38","api_social_chat","Chat de redes sociales","0");
INSERT INTO php_opciones VALUES("39","AJAX","","0");
INSERT INTO php_opciones VALUES("40","api_icon","","1");
INSERT INTO php_opciones VALUES("41","web_style","","1");
INSERT INTO php_opciones VALUES("42","api_WPA","","0");
INSERT INTO php_opciones VALUES("43","ssl","","0");
INSERT INTO php_opciones VALUES("44","demo","","0");



DROP TABLE php_pages;

CREATE TABLE `php_pages` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `tema` varchar(50) NOT NULL,
  `ext` varchar(50) NOT NULL,
  `url` varchar(250) NOT NULL,
  `fmod` varchar(20) NOT NULL,
  `alta` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO php_pages VALUES("1","Nosotros 1","<p style=\"text-align: center;\"><span style=\"font-size: 16px;\"><strong><br /></strong></span></p>\n<p style=\"text-align: center;\"><span style=\"font-size: 16px;\"><strong>Nosotros</strong></span></p>","nosotros","","","","","","0","1");



DROP TABLE php_portafolio;

CREATE TABLE `php_portafolio` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cover` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `cate` varchar(50) CHARACTER SET latin1 NOT NULL,
  `resena` text CHARACTER SET latin1 NOT NULL,
  `url_page` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imagen1` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen2` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen3` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen4` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen5` varchar(100) CHARACTER SET latin1 NOT NULL,
  `FT` varchar(100) CHARACTER SET latin1 NOT NULL,
  `alta` varchar(21) CHARACTER SET latin1 NOT NULL,
  `fmod` varchar(21) CHARACTER SET latin1 NOT NULL,
  `user` varchar(50) CHARACTER SET latin1 NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO php_portafolio VALUES("1","","Ebook","ebook.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web para promocionar edecanes, modelos, fot&oacute;grafos, escuelas y agencias relacionadas con la imagen y belleza para eventos.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>5 secciones</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>","0.00","Web_Page","","http://ebook.webcindario.com","ebook.jpg","","","","","Mayo, 2016","2018-01-07 21:10:52","2021-05-13 17:50:23","admin","1");
INSERT INTO php_portafolio VALUES("2","","Trafisa","trafisa.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">Página web desarrollada para <strong>Trafisa</strong>&nbsp;empresa dedicada a la venta de transportadores industriales.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One page</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","One_Page","","http://trafisa.com.mx/","trafisa.jpg","","","","","Junio, 2016","2018-08-18 01:47:56","2021-02-01 05:44:27","admin","1");
INSERT INTO php_portafolio VALUES("3","","Belcon","belcon.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">Página web desarrollada para&nbsp;<strong>Belcon</strong>&nbsp;empresa dedicada a la venta de transportadores industriales.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One Page</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","One_Page","","http://belcon.com.mx/","belcon.jpg","","","","","Julio, 2016","2018-08-18 01:52:11","","admin","1");
INSERT INTO php_portafolio VALUES("4","","Decatalogo","decatalogo.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">Página web&nbsp;<strong>Decatalogo</strong>&nbsp;desarrollada para la venta de catalogos de ropa en linea.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One Page</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>","0.00","One_Page","","https://decatalogo.webcindario.com/","decatalogo.jpg","","","","","Mayo, 2017","2018-08-18 01:53:12","2021-02-02 01:54:02","admin","1");
INSERT INTO php_portafolio VALUES("5","","Key Agencia Digital","keyagenciadigital.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Key Agencia Digital</strong>&nbsp;empresa dedicada a la publicidad digital e impresa, marketing digital, desarrollo de p&aacute;ginas web y posicionamiento web.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One Web</li>\n<li><em class=\"fa fa-check-circle\"></em>3 page, contacto y landingpage</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en Wordpress y PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","One_Page","","http://keyagenciadigital.com/","keyagenciadigital.jpg","","","","","Julio, 2017","2018-08-19 19:59:44","2021-05-13 17:51:40","admin","1");
INSERT INTO php_portafolio VALUES("6","","Samsung Healthcare","samsunghealthcare.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Samsung Healthcare</strong>&nbsp;empresa i<span>mportadora, distribuidora e integradora de equipo y mobiliario m&eacute;dico y hospitalario</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>4 secciones, productos y buscador</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://samsung-healthcare.mx/","samsunghealthcare.jpg","","","","","Febrero, 2018","2018-08-19 20:05:55","2021-05-13 17:52:04","admin","1");
INSERT INTO php_portafolio VALUES("7","","HM Soldaduras Industriales","hmsoldadurasindustriales.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>HM Soldaduras Industriales</strong>&nbsp;empresa dedicada a la venta de todo el material para soldar desde soldaduras especiales, gases industriales, abrasivos s&oacute;lidos, m&aacute;quinas de soldar, consumibles y equipo de seguridad.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>6 secciones, productos y buscador</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://hmsoldadurasindustriales.com/","hmsoldadurasindustriales.jpg","","","","","Mayo, 2018","2018-08-19 20:09:03","2021-05-13 17:59:07","admin","1");
INSERT INTO php_portafolio VALUES("8","","Estpro","estpro.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web&nbsp;<span><strong>Estpro Ambiental, S.A. de C.V.</strong> empresa dedicada a</span>&nbsp;<span>Sistemas de Gesti&oacute;n Ambiental Seguridad e Higiene para la Industria</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>5 secciones</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://estproambiental.com.mx/","estpro.jpg","","","","","Julio, 2018","2018-08-19 20:13:00","2021-05-13 18:00:10","admin","1");
INSERT INTO php_portafolio VALUES("9","","Fasco Infra Sistemas","fasco.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para la Empresa <strong>Fasco Infra Sistemas</strong> dedicada a la venta de telecomunicaciones y fibra &oacute;ptica.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>5 secciones, productos</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://fascoinfrasistema.com.mx/","fasco.jpg","","","","","Septiembre, 2018","2018-08-19 20:15:29","2021-05-13 18:13:54","admin","1");
INSERT INTO php_portafolio VALUES("10","","ImprezaColor","Imprezacolor.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>ImprezaColor</strong>&nbsp;empresa dedicada a la publicidad e imprenta digital.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One Web</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","One_Page","","http://imprezacolor.mx","Imprezacolor.jpg","","","","","Marzo, 2019","2019-06-16 23:05:13","2021-05-13 18:14:28","admin","1");
INSERT INTO php_portafolio VALUES("11","","Fibrecen","Fibrecen.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Fibrecen</strong>&nbsp;empresa dedicada a la <span>venta de materiales como resinas, fibras de vidrio, gel coats, etc</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li>Buscador de productos</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li>Chat de Whatsapp</li>\n<li>API de Facebook y Youtube</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://fibrecen.com.mx","Fibrecen.jpg","","","","","Febrero, 2019","2019-06-16 23:05:13","2021-05-13 18:14:53","admin","1");
INSERT INTO php_portafolio VALUES("12","","Ceo-Tech","ceo-tech.png","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">&nbsp;P&aacute;gina web desarrollada para la Empresa Ceo Tech dedicada <span>a proyectos de automatizaci&oacute;n</span>.</div>\n</div>\n<div class=\"post-gap\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>6 secciones</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://ceo-tech.com.mx/","ceo-tech.png","","","","","Julio, 2019","2019-08-12 05:46:19","2021-05-13 18:15:23","admin","1");
INSERT INTO php_portafolio VALUES("13","","Percco","percco.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Percco</strong><span>&nbsp;una empresa que ofrece Fabricaci&oacute;n de l&iacute;neas de Pintura Electr&oacute;statica, Maquila de Pintura Electr&oacute;statica, Instalaci&oacute;n de Sistemas Contraincendios, Fabricaci&oacute;n de Naves Industriales, Transportadores Industriales as&iacute; como un Proceso de Manufactura; Soldadura, Corte y Doblez. Ofrecemos Mantenimiento y Refacciones.</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, <strong>Ajax</strong>, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","http://percco.com","percco.jpg","","","","","Marzo, 2019","2019-06-16 23:05:13","2021-05-13 18:16:05","admin","1");
INSERT INTO php_portafolio VALUES("14","","Century21 ekodesar","century21.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">&nbsp;</div>\n<p>Landingpage desarrollado para <strong>Century21 ekodesar</strong> para campa&ntilde;a promocional de residencias y terrenos.</p>\n</div>\n<div class=\"post-gap\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>LandingPage</li>\n<li><em class=\"fa fa-check-circle\"></em>Secciones con Banner, Formulario de registro, productos y pie de pagina de contacto&nbsp;</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Boton de Whatsapp</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, Javascript, Jquery, ajax y HTML5.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] y Key Agencia Digital</p>\n</li>\n</ul>","0.00","LandingPage","","http://century21ekodesar.com","century21.jpg","","","","","Octubre, 2019","2019-10-15 06:02:50","","admin","1");
INSERT INTO php_portafolio VALUES("15","","Tramites Estpro","TramitesEstpro.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">&nbsp;</div>\n<p>Landingpage desarrollado para <strong>Tramites Estpro</strong> para campa&ntilde;a promocional de tramites legales.</p>\n</div>\n<div class=\"post-gap\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>LandingPage</li>\n<li><em class=\"fa fa-check-circle\"></em>Secciones con Banner, Formulario de registro, productos y pie de pagina de contacto&nbsp;</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Boton de Whatsapp</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, Javascript, Jquery, ajax y HTML5.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] y Key Agencia Digital</p>\n</li>\n</ul>","0.00","LandingPage","","http://tramites.estproambiental.com.mx/","TramitesEstpro.jpg","","","","","Diciembre, 2019","2021-01-19 01:24:06","","admin","1");
INSERT INTO php_portafolio VALUES("16","","dgoba","Dgoba.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Goba</strong>&nbsp;empresa <span>importadora, distribuidora e integradora de equipo y mobiliario m&eacute;dico y hospitalario</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>3 secciones: Home, productos y contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CMS</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>","0.00","Web_Page","","https://www.dgoba.com/","Dgoba.jpg","","","","","Junio, 2020","2021-01-20 05:07:42","2021-05-13 18:19:17","admin","1");
INSERT INTO php_portafolio VALUES("17","","Tienda Solein","TiendaSolein.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">Página desarrollada para venta en linea de productos para la construcción.</div>\n</div>\n<div class=\"post-gap\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>Página Web Ecommerce</li>\n<li><em class=\"fa fa-check-circle\"></em>Secciones Home, productos, blog y contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsive</li>\n<li><em class=\"fa fa-check-circle\"></em>Registro de usuarios para compra en linea</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada con Wordpress y Woocommerce</li>\n<li><em class=\"fa fa-check-circle\"></em>Pagos a través de PayPal</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>Wordpress, Woocommerce, PHP, MySQL, javascript.</p>\n</li>\n<li>\n<h5>Desarrollado&nbsp; para:</h5>\n<p>Dood</p>\n</li>\n</ul>","0.00","Ecommerce","","#","TiendaSolein2.jpg","","","","","Septiembre, 2020","2021-01-20 20:46:09","2021-02-05 03:59:20","admin","1");
INSERT INTO php_portafolio VALUES("18","","Phponix-cms","phponix.dev.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\" style=\"text-align: justify;\"><strong>PHP Onix</strong><span>&nbsp;es una un CMS desarrollado en PHP y creado para la gesti&oacute;n y administraci&oacute;n de sitios web de una forma r&aacute;pida y eficaz, constituido por una serie de modulos perfectamente adaptables para los requerimientos de tu sitio web.&nbsp;<span>Con&nbsp;</span><strong>PHPOnix</strong><span>&nbsp;podras instalar y crear tu sitio web en 5 minutos ademas con herramientas para gestionar, monitoriar y posicionar tu p&aacute;gina web.&nbsp;</span><strong>PHPOnix</strong><span>&nbsp;cuenta con multiples funcionalidades desde crear un p&aacute;gina&nbsp;</span><strong>web standar</strong><span>,&nbsp;</span><strong>landingpage</strong><span>,&nbsp;</span><strong>intranet</strong><span>,&nbsp;</span><strong>blog</strong><span>,&nbsp;</span><strong>catalogo</strong><span>,&nbsp;</span><strong>portafolio</strong><span>, incluso una tienda virtual*(</span><strong>ecommerce</strong><span>) para tu negocio o servicio tu elijes la funcionalidad.</span></span></div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de Seo</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de sitemap</li>\n<li><em class=\"fa fa-check-circle\"></em>Estadisticas de visitas</li>\n<li><em class=\"fa fa-check-circle\"></em>Escalable multiposito</li>\n<li><em class=\"fa fa-check-circle\"></em>Activaci&oacute;n de WPA</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de sesion por usuario</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>HTML5, CSS, PHP, MySQL, Bootstrap, Javascript, Ajax, Jquery y Json.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>","0.00","CMS","","https://phponix.webcindario.com/","phponix.dev.jpg","","","","","Abril, 2017","2021-04-21 21:20:28","2021-04-23 22:18:35","admin","1");
INSERT INTO php_portafolio VALUES("19","","Mandragora-cms","2021-04-23 (5).jpg","<p style=\"text-align: justify;\">Mandragora-cms es la versi&oacute;n corregida y aumentada de Phponix y cuenta con m&uacute;ltiples funcionalidades desde crear un <strong>p&aacute;gina o sitio web standar</strong>, <strong>landingpage</strong>, <strong>intranet</strong>, <strong>blog</strong>, <strong>catalogo</strong>, <strong>portafolio</strong>, incluso una <strong>tienda online</strong>(<strong>Ecommerce</strong>) para tu negocio o servicio tu elijes la funcionalidad.</p>\n<div class=\"post-gap-small\" style=\"text-align: justify;\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de Seo</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de sitemap</li>\n<li><em class=\"fa fa-check-circle\"></em>Estadisticas de visitas</li>\n<li><em class=\"fa fa-check-circle\"></em>Escalable multiposito</li>\n<li><em class=\"fa fa-check-circle\"></em>Activaci&oacute;n de WPA</li>\n<li><em class=\"fa fa-check-circle\"></em>Generador de sesion por usuario</li>\n<li><em class=\"fa fa-check-circle\"></em>API Rest Full (CRUD)</li>\n<li><em class=\"fa fa-check-circle\"></em>AdminPanel <strong>Nifty</strong></li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>HTML5, CSS, PHP, MySQL, Bootstrap, <strong>Javascript</strong>, Ajax, Jquery y Json.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>","0.00","CMS","","#","2021-04-23 (1).jpg","","","","","Septiembre, 2021","2021-04-21 21:56:00","2021-04-23 22:14:44","admin","1");
INSERT INTO php_portafolio VALUES("20","","VcardApp","vcardappjs.jpg","<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\"><strong>\"Conectando negocios y profesionales\"</strong></div>\n<div class=\"post-gap-small\" style=\"text-align: justify;\">La soluci&oacute;n para llegar a m&aacute;s clientes y mantenerte en contacto con ellos. App o WPA desarrollada para crear tarjetas de presentaci&oacute;n digitales desarrollada en Javascript y Fiirebase. Ideal para profesionistas, negocios y empresas para su personal de ventas.<strong>&nbsp;</strong></div>\n<div class=\"post-gap-small\"><strong><br /></strong></div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Instalaci&oacute;n en PC Windows y Linux&nbsp;</li>\n<li><em class=\"fa fa-check-circle\"></em>Instalaci&oacute;n dispositivos moviles Android y iOS.</li>\n<li><em class=\"fa fa-check-circle\"></em>Activaci&oacute;n de WPA</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>HTML5, css, bootstrap, Javascript, Json y Firebase .</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>","0.00","PWA","","https://vcardappjs.herokuapp.com/","vcardapp2.jpg","","","","","Diciembre, 2020","2021-04-21 21:57:14","2021-05-11 23:01:10","admin","1");



DROP TABLE php_productos;

CREATE TABLE `php_productos` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `marca` varchar(150) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `moneda` varchar(10) NOT NULL,
  `unidad` varchar(10) NOT NULL,
  `peso` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `medidas` varchar(100) NOT NULL,
  `stock` int(6) NOT NULL,
  `serie` varchar(100) NOT NULL,
  `lote` varchar(100) NOT NULL,
  `ID_cate` int(6) NOT NULL,
  `ID_sub_cate` int(6) NOT NULL,
  `ID_sub_cate2` int(6) NOT NULL,
  `ID_marca` int(6) NOT NULL,
  `url_name` varchar(150) NOT NULL,
  `imagen1` varchar(100) NOT NULL,
  `imagen2` varchar(100) NOT NULL,
  `imagen3` varchar(100) NOT NULL,
  `imagen4` varchar(100) NOT NULL,
  `imagen5` varchar(100) NOT NULL,
  `cate` varchar(100) NOT NULL,
  `resena` mediumtext NOT NULL,
  `nuevo` tinyint(1) NOT NULL,
  `promo` tinyint(1) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `clasificacion` varchar(200) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `land` tinyint(1) NOT NULL,
  `file` varchar(100) NOT NULL,
  `pdf1` varchar(100) NOT NULL,
  `pdf2` varchar(100) NOT NULL,
  `pdf3` varchar(100) NOT NULL,
  `pdf4` varchar(100) NOT NULL,
  `pdf5` varchar(100) NOT NULL,
  `alta` varchar(21) NOT NULL,
  `fmod` varchar(21) NOT NULL,
  `user` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO php_productos VALUES("1","01010127","01010127","Máquina embisagradora","","nodisponible.jpg","","","","","","125215.50","MXN","PZ","","","","0","","","1","1","0","0","","nodisponible.jpg","nodisponible.jpg","","","","Maquinaria y herramientas","","0","0","","","","0","","","","","","","2019-01-14 11:49:53","2021-03-06 23:57:34","admin","1");
INSERT INTO php_productos VALUES("2","01010128","01010128","Máquina embisagradora con broca","","nodisponible.jpg","","<p>Haz crecer tu empresa con herramientas de calidad, funcionales y de manejo f&aacute;cil. Descubre todo lo que tenemos para ti</p>\n<p><br /><span>CARACTER&Iacute;STICAS</span></p>\n<table border=\"0\">\n<tbody>\n<tr>\n<td>C&oacute;digo</td>\n<td>01010128</td>\n</tr>\n<tr>\n<td>UM</td>\n<td>pz</td>\n</tr>\n<tr>\n<td>Material</td>\n<td>Acero</td>\n</tr>\n<tr>\n<td>Acabados</td>\n<td>Azul con naranja</td>\n</tr>\n<tr>\n<td>Medida</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p class=\"sbit_caract100\">Alimentaci&oacute;n el&eacute;ctrica de 127V. Ideal para bisagras FGV, SALICE y ECO, Regleta con ajuste (K) 2mm a 12mm, profundidad m&aacute;xima de perforaci&oacute;n 60mm. Descarga la ficha t&eacute;cnica para conocer m&aacute;s de esta maquina.</p>","","","","19033.00","MXN","PZ","","","","0","","","1","1","0","0","","nodisponible.jpg","","","","","Maquinaria y herramientas","Descripción Corta","0","0","","","","0","","","","","","","2019-01-16 07:54:05","2021-02-26 00:00:09","admin","1");
INSERT INTO php_productos VALUES("3","01020025","01020025","Punta phillips no.2","","nodisponible.jpg","","<p>Optimiza tus ensambles con las puntas que tenemos para ti</p>\n<p><br /><span>CARACTER&Iacute;STICAS</span></p>\n<table border=\"0\">\n<tbody>\n<tr>\n<td>C&oacute;digo</td>\n<td>01020025</td>\n</tr>\n<tr>\n<td>UM</td>\n<td>PZA</td>\n</tr>\n<tr>\n<td>Material</td>\n<td>Acero</td>\n</tr>\n<tr>\n<td>Acabados</td>\n<td>Satinado</td>\n</tr>\n<tr>\n<td>Medida</td>\n<td>51mm</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p class=\"sbit_caract100\">Punta de cruz que permite utilizarlo en la mayoria de torniller&iacute;a.</p>","","","","10.50","MXN","PZ","","","","0","","","1","2","0","0","","nodisponible.jpg","","","","","Maquinaria y herramientas","Descripción corta","0","0","","","","0","","","","","","","2019-01-16 12:55:21","2021-02-25 23:59:19","admin","1");
INSERT INTO php_productos VALUES("4","08030264","08030264","Manija de baño","","pro1.1.png","","<p><strong>Lorem Ipsum</strong><span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</span></p>","Elco","Modelo rectángular-liso satinado","","30.00","MXN","PZ","","","","0","","","10","36","0","9","","Manijas.png","","","","","Chapas y cerraduras","Descripción corta","1","0","","","","0","","","","","","","2019-02-08 09:02:06","2021-03-25 03:35:51","admin","1");
INSERT INTO php_productos VALUES("5","08030273","08030273","Manija de entrada modelo bola llave/mariposa Inox","","pro1.2.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","10","32","0","0","","pro1.2.png","","","","","Chapas y cerraduras","","1","0","","","","0","","","","","","","2019-02-08 09:11:21","2021-02-25 23:09:05","admin","1");
INSERT INTO php_productos VALUES("6","08050037","08050037","Tope magnético para puerta","","pro1.3.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","10","33","0","0","","pro1.3.png","","","","","Chapas y cerraduras","","1","0","","","","0","","","","","","","2019-02-08 09:13:35","2021-02-25 23:10:55","admin","1");
INSERT INTO php_productos VALUES("7","08080001","08080001","Corredizo colgante inos 304 p/puerta de madera L=200mm Rodamiento sencillo","","pro1.4.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","3","14","0","0","","pro1.4.png","","","","","Correderas","","1","0","","","","0","","","","","","","2019-02-08 09:16:17","2021-02-25 23:08:29","admin","1");
INSERT INTO php_productos VALUES("8","08080003","08080003","Corredizo colgante inox 304 p/puerta de cristal L=200mm Rodamiento sencillo","","pro1.5.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","3","12","0","0","","pro1.5.png","","","","","Correderas","","1","0","","","","0","","","","","","","2019-02-08 09:18:53","2021-02-25 23:07:46","admin","1");
INSERT INTO php_productos VALUES("9","12130050","12130050","Dispensador doble para baño","","pro2.1.png","","<p>Descripcion</p>","","","","1.00","MXN","PZ","","","","0","","","12","44","0","0","","pro2.1.png","","","","","Accesorios de cocina y baño","","0","1","","","","0","","","","","","","2019-02-08 12:17:14","2021-02-25 23:04:52","admin","1");
INSERT INTO php_productos VALUES("10","12130058","12130058","Dispensador de jabón para baño","","pro2.2.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","12","44","0","0","","pro2.2.png","","","","","Accesorios de cocina y baño","","0","1","","","","0","","","","","","","2019-02-08 12:31:20","2021-02-25 23:05:49","admin","1");
INSERT INTO php_productos VALUES("11","12130040","12130040","Toallero doble 616mm Latón Cromado","","pro2.3.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","12","44","0","0","","pro2.3.png","","","","","Accesorios de cocina y baño","","0","1","","","","0","","","","","","","2019-02-08 12:33:08","2021-02-25 23:06:26","admin","1");
INSERT INTO php_productos VALUES("12","12130043","12130043","Cepillero base rect. c/vaso de cristal latón cromado","","pro2.4.png","","<p>Descripcion</p>","","","","0.00","MXN","PZ","","","","0","","","12","44","0","0","","pro2.4.png","","","","","Accesorios de cocina y baño","","0","1","","","","0","","","","","","","2019-02-08 12:34:48","2021-02-25 23:07:04","admin","1");



DROP TABLE php_productos_cate;

CREATE TABLE `php_productos_cate` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `ord` varchar(2) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO php_productos_cate VALUES("1","Maquinaria y herramientas","01","nodisponible.jpg","<p>Descripci&oacute;n de categor&iacute;a</p>","1");
INSERT INTO php_productos_cate VALUES("2","Accesorios para gabinete","02","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("3","Correderas","03","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("4","Jaladeras y botones","04","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("5","Tornillos y conectores","05","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("6","Bisagras","06","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("7","Tableros y puertas","07","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("8","Arquitectura","08","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("9","Iluminación","09","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("10","Chapas y cerraduras","10","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("11","Accesorios para closet","11","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("12","Accesorios de cocina y baño","12","nodisponible.jpg","","1");
INSERT INTO php_productos_cate VALUES("13","Buzones","13","nodisponible.jpg","<p>Descripci&oacute;n</p>","1");



DROP TABLE php_productos_coti;

CREATE TABLE `php_productos_coti` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_reg` int(11) NOT NULL,
  `ID_cli` int(11) NOT NULL,
  `observaciones` mediumtext NOT NULL,
  `Total` decimal(11,2) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `fmod` varchar(20) NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_productos_coti_r;

CREATE TABLE `php_productos_coti_r` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articulo` varchar(300) NOT NULL,
  `cant` int(6) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `tot` decimal(11,2) NOT NULL,
  `ID_coti` int(11) NOT NULL,
  `ID_cli` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_productos_files;

CREATE TABLE `php_productos_files` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ID_p` int(9) NOT NULL,
  `ID_f` int(9) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_productos_marcas;

CREATE TABLE `php_productos_marcas` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO php_productos_marcas VALUES("1","nodisponible.jpg","Grass","1");
INSERT INTO php_productos_marcas VALUES("2","nodisponible.jpg","Salice","1");
INSERT INTO php_productos_marcas VALUES("3","nodisponible.jpg","Italiana Ferramenta","1");
INSERT INTO php_productos_marcas VALUES("4","nodisponible.jpg","Harn","1");
INSERT INTO php_productos_marcas VALUES("5","nodisponible.jpg","Vauth Sagel","1");
INSERT INTO php_productos_marcas VALUES("6","nodisponible.jpg","Rincomatic","1");
INSERT INTO php_productos_marcas VALUES("7","nodisponible.jpg","Vibo","1");
INSERT INTO php_productos_marcas VALUES("8","nodisponible.jpg","Flex & Lux","1");
INSERT INTO php_productos_marcas VALUES("9","elco.png","Elco","1");
INSERT INTO php_productos_marcas VALUES("10","nodisponible.jpg","Volpato","1");



DROP TABLE php_productos_sub_cate;

CREATE TABLE `php_productos_sub_cate` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(100) NOT NULL,
  `ord` varchar(2) NOT NULL,
  `ID_cate` int(6) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

INSERT INTO php_productos_sub_cate VALUES("1","Maquinaria","01","1","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("2","Herramientas","02","1","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("3","Cerraduras","01","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("4","Resbalones","02","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("5","Niveladores y colgadores","03","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("6","Topes","04","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("7","Forzadores","05","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("8","Rodajas","06","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("9","Sistemas para puertas corredizas","07","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("10","Levadizos","08","2","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("11","Especiales","01","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("12","Cerrajes","02","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("13","Futura y unica","03","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("14","Impaz","04","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("15","KV","05","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("16","Ten","06","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("17","Triomax","07","3","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("18","Tradicional","01","4","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("19","Diseño","02","4","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("20","Rústica","03","4","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("21","Clásica","04","4","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("22","Especiales","05","4","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("23","Bidimensionales","01","6","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("24","Libro","02","6","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("25","Americana","03","6","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("26","Bibeles","04","6","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("27","Especiales","05","6","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("28","Pasadores","01","8","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("29","Ganchos","02","8","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("30","Topes","03","8","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("31","Hogar","04","8","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("32","Baldwin reserve","01","10","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("33","Assa abloy","02","10","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("34","Candados","03","10","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("35","Cerrajes","04","10","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("36","Kwikset","05","10","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("37","Accesorios","01","11","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("38","Elite","02","11","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("39","Extraibles","01","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("40","Colgantes","02","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("41","Patas","03","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("42","Ménsulas","04","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("43","Perfil jaladera","05","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("44","Accesorios para baño","06","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("45","Botes","07","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("46","Vauth-sagel","08","12","nodisponible.jpg","","1");
INSERT INTO php_productos_sub_cate VALUES("47","Sistema lasy","09","12","nodisponible.jpg","","1");



DROP TABLE php_productos_sub_cate2;

CREATE TABLE `php_productos_sub_cate2` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `subcategoria2` varchar(100) NOT NULL,
  `ord` int(2) NOT NULL,
  `ID_cate` int(6) NOT NULL,
  `ID_sub_cate` int(6) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_promociones;

CREATE TABLE `php_promociones` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `cate` varchar(100) NOT NULL,
  `alta` varchar(25) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO php_promociones VALUES("1","p1.png","Promociones Bimestrales","","1");
INSERT INTO php_promociones VALUES("2","p2.png","Promociones Bimestrales","","1");
INSERT INTO php_promociones VALUES("3","p3.png","Nuevos Productos","","1");
INSERT INTO php_promociones VALUES("4","p4.png","Nuevos Productos","","1");
INSERT INTO php_promociones VALUES("5","p5.png","Nuevos Productos","","1");
INSERT INTO php_promociones VALUES("6","p6.png","Nuevos Productos","","1");



DROP TABLE php_registros;

CREATE TABLE `php_registros` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
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
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_servicios;

CREATE TABLE `php_servicios` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cover` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `cate` varchar(50) CHARACTER SET latin1 NOT NULL,
  `resena` text CHARACTER SET latin1 NOT NULL,
  `url_page` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imagen1` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen2` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen3` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen4` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagen5` varchar(100) CHARACTER SET latin1 NOT NULL,
  `FT` varchar(100) CHARACTER SET latin1 NOT NULL,
  `alta` varchar(21) CHARACTER SET latin1 NOT NULL,
  `fmod` varchar(21) CHARACTER SET latin1 NOT NULL,
  `user` varchar(50) CHARACTER SET latin1 NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO php_servicios VALUES("1","","Hornos de Curado","horno.jpg","<p><span>Fabricamos y dise&ntilde;amos Hornos Hornos Continuos de Curado tipo Batch, Hornos Infrarojos y Hornos Ultravioleta.</span></p>","0.00","Fabricación de Líneas de Pintura","","","horno.jpg","","","","","","2021-02-03 03:18:53","2021-02-05 04:25:28","admin","1");
INSERT INTO php_servicios VALUES("2","","Cabinas para pintura en Polvo","cabina.jpg","<p><span>Producimos Continuas y de Batch, as&iacute; como cabinas portatiles en diferentes tama&ntilde;os y dise&ntilde;os.</span></p>","0.00","Fabricación de Líneas de Pintura","","","","","","","","","2021-02-03 03:23:32","2021-03-30 21:07:03","admin","1");



DROP TABLE php_signup;

CREATE TABLE `php_signup` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
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
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO php_signup VALUES("1","admin","c64f923f7f476f0b78716079452e7bdec4b2c016","multiportal@outlook.com","-1","2023-05-25 09:46:03","default","Guillermo","Jimenez","Lopez","sinfoto.png","","4421944950","1","0000-00-00","","","Programador","0","","Multiportal","","","","","","M","","0","0","","","admin2019xadmin79","","0","0","944950","0","offline","1");
INSERT INTO php_signup VALUES("2","demo","71cc541bd1ccb6670de3f8d40f425ffb7315fe7f","demo@gmail.com","-1","0000-00-00 00:00:00","default","Demo","Apaterno","Amaterno","sinfoto.png","sincover.jpg","4421234567","0","0000-00-00","","","Director","0","","PHPONIX","","","","","","M","","0","0","","","demo2019xdemo2017","","0","0","234567","0","offline","1");
INSERT INTO php_signup VALUES("3","usuario","3c6e6ac5382f4e804e824c0d785b275252ddacb0","multiportal@outlook.com","1","0000-00-00 00:00:00","default","Usuario","Apaterno","Amaterno","sinfoto.png","","4421234567","0","0000-00-00","","","Usuario","0","","PHPONIX","","","","","","M","","0","0","","","usuario2019xuser79x","","0","0","234567","0","offline","1");
INSERT INTO php_signup VALUES("4","ventas","1d415500d481e0c1c238189c22ea057da663c1e7","ventas@gmail.com","2","0000-00-00 00:00:00","default","Ventas","Apaterno","Amaterno","sinfoto.png","sincover.jpg","4421234567","0","0000-00-00","","","Gerente","0","","PHPONIX","","","","","","M","","0","0","","","ventas2019xventas","","0","0","234567","0","offline","1");



DROP TABLE php_slider;

CREATE TABLE `php_slider` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ima` varchar(100) NOT NULL,
  `tit1` varchar(200) NOT NULL,
  `tit2` varchar(200) NOT NULL,
  `btn_nom` varchar(50) NOT NULL,
  `url` varchar(300) NOT NULL,
  `tema_slider` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO php_slider VALUES("1","home.jpg","Slider1","","Boton","","default","0");
INSERT INTO php_slider VALUES("2","slide-bg.jpg","bg1","","","","porto","1");



DROP TABLE php_tareas;

CREATE TABLE `php_tareas` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE php_temas;

CREATE TABLE `php_temas` (
  `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) NOT NULL,
  `subtema` varchar(100) NOT NULL,
  `selec` tinyint(1) NOT NULL,
  `nivel` varchar(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO php_temas VALUES("1","default","","0","0");
INSERT INTO php_temas VALUES("2","phponix","","0","0");
INSERT INTO php_temas VALUES("3","portophponix","","1","0");



DROP TABLE php_testimonios;

CREATE TABLE `php_testimonios` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `pro` varchar(100) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO php_testimonios VALUES("1","testimonial_person2.jpg","Ingeniera Civil","Super recomendado, la atenci&oacute;n es buenisima y te ayudan con cualquier duda","1");
INSERT INTO php_testimonios VALUES("2","testimonial_person1.jpg","Emprendedor","Su curso se me hizo f&aacute;cil y muy creativo, impartidos por excelentes maestros.","1");
INSERT INTO php_testimonios VALUES("3","testimonial_person3.jpg","Ingeniera Industrial","Super recomendado, la atenci&oacute;n es buenisima y te ayudan con cualquier duda.","1");
INSERT INTO php_testimonios VALUES("4","TESTIMONIO01.png","Emprendedor","Excelente curso introducci&oacute;n a los materiales compuestos, muchas gracias.","1");
INSERT INTO php_testimonios VALUES("5","testimonio02.png","Emprendedor","Excelente curso de Mesas Ep&oacute;xicas en Parota y Cristal Templado.  &iexcl;No dejen pasar la oportunidad de tomar este curso!","1");



DROP TABLE php_token;

CREATE TABLE `php_token` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(6) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Fecha` varchar(22) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO php_token VALUES("1","1","57ce787f3cf1a2931ed2ee96bd9a8e06cd460b94","Inactivo","2023-05-25 16:44:01");
INSERT INTO php_token VALUES("2","1","64010e9ec8dc76229a80708cc06e1e5ad8a97aa5","Activo","2023-10-14 17:13:17");



DROP TABLE php_upload_files;

CREATE TABLE `php_upload_files` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `type_file` varchar(30) NOT NULL,
  `filec` longblob NOT NULL,
  `created_at` varchar(35) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE php_vcard;

CREATE TABLE `php_vcard` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `tel_ofi` varchar(50) NOT NULL,
  `cell` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `fb` varchar(150) NOT NULL,
  `tw` varchar(150) NOT NULL,
  `lk` varchar(150) NOT NULL,
  `ins` varchar(150) NOT NULL,
  `f_create` varchar(20) NOT NULL,
  `f_update` varchar(20) NOT NULL,
  `vcard` tinyint(1) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO php_vcard VALUES("1","foto.png","rforesta","","Rodrigo Foresta","","Manager","Billnex","","","+54 9 3534 19 6770","rodrigo.foresta@thebillnex.com","https://www.thebillnex.com","","","#","https://www.instagram.com/billnex","19/08/2020 10:38","07/09/2020 19:13","1","1","admin","1");
INSERT INTO php_vcard VALUES("2","foto.png","jparra","","Juan Parra","","Manager","Billnex","","","+1(754)210-0433","juan.parra@thebillnex.com","https://www.thebillnex.com","","","#","https://www.instagram.com/billnex","22/08/2020 17:04","11/09/2020 21:03","1","1","admin","1");
INSERT INTO php_vcard VALUES("3","foto_capital.png","dmiranda","","Daniel Miranda Mejia","","Manager","Capital","","","442 104 6067","dmiranda@capitalsft.com","https://www.capitalsft.com","","","https://www.linkedin.com/company/13990038/admin/","","22/08/2020 21:28","30/08/2020 12:14","1","1","admin","1");
INSERT INTO php_vcard VALUES("4","foto_capital.png","pbetancourt","","Ponciano Betancourt","","Manager","Capital","","","442 347 0504","pbetancourt@capitalsft.com","https://www.capitalsft.com","","","https://www.linkedin.com/company/13990038/admin/","","22/08/2020 21:39","30/08/2020 13:17","1","1","usuario","1");
INSERT INTO php_vcard VALUES("5","giganteh.jpg","memojl","","Guillermo Jimenez Lopez","Desarrollo de Paginas Web y Marketing Digital","Desarrollador web","Multiportal","","","4426002842","multiportal@outlook.com","http://multiportal.com.mx","https://facebook.com/","","https://www.linkedin.com/","https://www.instagram.com/","2020-09-11 22:11:58","2020-09-11 22:17:34","1","1","admin","1");



DROP TABLE php_vcard_empresas;

CREATE TABLE `php_vcard_empresas` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `web` varchar(150) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ID_user` int(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `f_create` varchar(25) NOT NULL,
  `f_update` varchar(25) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO php_vcard_empresas VALUES("1","multiportal.jpg","Multiportal","http://multiportal.com.mx","442602842","multiportal@outlook.com","1","admin","2020-09-05","2020-09-05","1");
INSERT INTO php_vcard_empresas VALUES("2","nodisponible.jpg","Billnex","https://thebillnex.com/","4421234567","contacto@thebillnex.com","1","admin","2020-09-05","2020-09-05","1");
INSERT INTO php_vcard_empresas VALUES("3","nodisponible.jpg","Capital","https://api.capitalinvestment.mx/","4421234567","contacto@capitalinvestment.mx","1","admin","2020-09-05","2020-09-05","1");



DROP TABLE php_vcard_plan;

CREATE TABLE `php_vcard_plan` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `plan` varchar(100) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `lim_card` int(9) NOT NULL,
  `lim_emp` int(6) NOT NULL,
  `nivel` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO php_vcard_plan VALUES("1","black","3000.00","0","0","0");
INSERT INTO php_vcard_plan VALUES("2","oro","1000.00","1000","5","0");
INSERT INTO php_vcard_plan VALUES("3","plata","300.00","100","1","0");
INSERT INTO php_vcard_plan VALUES("4","bronce","0.00","1","1","0");



DROP TABLE php_visitas;

CREATE TABLE `php_visitas` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `IPv4` bigint(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `info_nave` varchar(300) NOT NULL,
  `navegador` varchar(50) NOT NULL,
  `version` varchar(100) NOT NULL,
  `os` varchar(50) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `page` varchar(500) NOT NULL,
  `refer` varchar(500) NOT NULL,
  `vhref` varchar(500) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `ext` varchar(50) NOT NULL,
  `idp` varchar(50) NOT NULL,
  `salida_pag` datetime NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO php_visitas VALUES("1","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/","http://localhost/MisSitios/","","Home","","","2023-05-25 16:43:11","2023-05-25 16:43:11","2023-05-25 08:43:11");
INSERT INTO php_visitas VALUES("2","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/admin/","http://localhost/MisSitios/phponixdev/","","Login","","","2023-05-25 16:43:22","2023-05-25 16:43:22","2023-05-25 08:43:22");
INSERT INTO php_visitas VALUES("3","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/admin/","http://localhost/MisSitios/phponixdev/admin/","","Login","","","2023-05-25 16:44:01","2023-05-25 16:44:01","2023-05-25 08:44:01");
INSERT INTO php_visitas VALUES("4","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","http://localhost/MisSitios/phponixdev/admin/","","dashboard","","","2023-05-25 16:44:04","2023-05-25 16:44:04","2023-05-25 08:44:04");
INSERT INTO php_visitas VALUES("5","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","","productos","admin/index","","2023-05-25 16:44:18","2023-05-25 16:44:18","2023-05-25 08:44:18");
INSERT INTO php_visitas VALUES("6","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=categoria","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index","","productos","admin/index","","2023-05-25 16:44:25","2023-05-25 16:44:25","2023-05-25 08:44:25");
INSERT INTO php_visitas VALUES("7","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=subcategoria","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=categoria","","productos","admin/index","","2023-05-25 16:44:30","2023-05-25 16:44:30","2023-05-25 08:44:30");
INSERT INTO php_visitas VALUES("8","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=subcategoria","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=categoria","","productos","admin/index","","2023-05-25 16:44:41","2023-05-25 16:44:41","2023-05-25 08:44:41");
INSERT INTO php_visitas VALUES("9","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=subcategoria","","sys","menu_admin","","2023-05-25 16:45:03","2023-05-25 16:45:03","2023-05-25 08:45:03");
INSERT INTO php_visitas VALUES("10","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin&action=edit&id=29","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","","sys","menu_admin","29","2023-05-25 16:45:18","2023-05-25 16:45:18","2023-05-25 08:45:18");
INSERT INTO php_visitas VALUES("11","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin&action=edit&id=29","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin&action=edit&id=29","","sys","menu_admin","29","2023-05-25 16:45:31","2023-05-25 16:45:31","2023-05-25 08:45:31");
INSERT INTO php_visitas VALUES("12","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin&action=edit&id=29","","sys","menu_admin","","2023-05-25 16:45:35","2023-05-25 16:45:35","2023-05-25 08:45:35");
INSERT INTO php_visitas VALUES("13","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=marcas","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","","productos","admin/index","","2023-05-25 16:45:40","2023-05-25 16:45:40","2023-05-25 08:45:40");
INSERT INTO php_visitas VALUES("14","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","http://localhost/MisSitios/phponixdev/index.php?mod=productos&ext=admin/index&opc=marcas","","dashboard","","","2023-05-25 16:45:48","2023-05-25 16:45:48","2023-05-25 08:45:48");
INSERT INTO php_visitas VALUES("15","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/modulos/usuarios/logout.php?id=1&co=nQhni3sT7B9awDYEwFzCsuyR1XCTGgrv9QJL60mDPbrBio1lgQR","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","","Logout","","1","2023-05-25 16:46:03","2023-05-25 16:46:03","2023-05-25 08:46:03");
INSERT INTO php_visitas VALUES("16","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36","CHROME","113.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/index.php","http://localhost/MisSitios/phponixdev/modulos/usuarios/logout.php?id=1&co=nQhni3sT7B9awDYEwFzCsuyR1XCTGgrv9QJL60mDPbrBio1lgQR","","Home","","","2023-05-25 16:46:06","2023-05-25 16:46:06","2023-05-25 08:46:06");
INSERT INTO php_visitas VALUES("17","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/","http://localhost/MisSitios/","","Home","","","2023-10-14 17:12:23","2023-10-14 17:12:23","2023-10-14 09:12:24");
INSERT INTO php_visitas VALUES("18","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/admin/","http://localhost/MisSitios/phponixdev/","","Login","","","2023-10-14 17:13:01","2023-10-14 17:13:01","2023-10-14 09:13:01");
INSERT INTO php_visitas VALUES("19","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","","http://localhost/MisSitios/phponixdev/admin/","http://localhost/MisSitios/phponixdev/admin/","","Login","","","2023-10-14 17:13:17","2023-10-14 17:13:17","2023-10-14 09:13:17");
INSERT INTO php_visitas VALUES("20","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","http://localhost/MisSitios/phponixdev/admin/","","dashboard","","","2023-10-14 17:13:20","2023-10-14 17:13:20","2023-10-14 09:13:20");
INSERT INTO php_visitas VALUES("21","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","","sys","admin/index","","2023-10-14 17:13:52","2023-10-14 17:13:52","2023-10-14 09:13:52");
INSERT INTO php_visitas VALUES("22","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=usuarios&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","","usuarios","admin/index","","2023-10-14 17:14:20","2023-10-14 17:14:20","2023-10-14 09:14:20");
INSERT INTO php_visitas VALUES("23","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","http://localhost/MisSitios/phponixdev/index.php?mod=usuarios&ext=admin/index","","dashboard","","","2023-10-14 17:14:33","2023-10-14 17:14:33","2023-10-14 09:14:33");
INSERT INTO php_visitas VALUES("24","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=blog&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=dashboard","","blog","admin/index","","2023-10-14 17:14:35","2023-10-14 17:14:35","2023-10-14 09:14:36");
INSERT INTO php_visitas VALUES("25","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos","http://localhost/MisSitios/phponixdev/index.php?mod=blog&ext=admin/index","","sys","modulos","","2023-10-14 17:14:51","2023-10-14 17:14:51","2023-10-14 09:14:51");
INSERT INTO php_visitas VALUES("26","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos&action=edit&id=11","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos","","sys","modulos","11","2023-10-14 17:15:12","2023-10-14 17:15:12","2023-10-14 09:15:12");
INSERT INTO php_visitas VALUES("27","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos&action=edit&id=11","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos&action=edit&id=11","","sys","modulos","11","2023-10-14 17:15:23","2023-10-14 17:15:23","2023-10-14 09:15:23");
INSERT INTO php_visitas VALUES("28","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos&action=edit&id=11","","sys","modulos","","2023-10-14 17:15:26","2023-10-14 17:15:26","2023-10-14 09:15:26");
INSERT INTO php_visitas VALUES("29","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=modulos","","sys","admin/index","","2023-10-14 17:15:33","2023-10-14 17:15:33","2023-10-14 09:15:33");
INSERT INTO php_visitas VALUES("30","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","","sys","admin/index","","2023-10-14 17:15:45","2023-10-14 17:15:45","2023-10-14 09:15:45");
INSERT INTO php_visitas VALUES("31","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=logs","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index","","sys","admin/index","","2023-10-14 17:15:51","2023-10-14 17:15:51","2023-10-14 09:15:51");
INSERT INTO php_visitas VALUES("32","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=bloquear","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=logs","","sys","admin/index","","2023-10-14 17:15:59","2023-10-14 17:15:59","2023-10-14 09:15:59");
INSERT INTO php_visitas VALUES("33","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=temas","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=bloquear","","sys","admin/index","","2023-10-14 17:16:03","2023-10-14 17:16:03","2023-10-14 09:16:03");
INSERT INTO php_visitas VALUES("34","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=temas","","sys","menu_admin","","2023-10-14 17:16:07","2023-10-14 17:16:07","2023-10-14 09:16:07");
INSERT INTO php_visitas VALUES("35","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","","sys","admin/index","","2023-10-14 17:16:24","2023-10-14 17:16:24","2023-10-14 09:16:24");
INSERT INTO php_visitas VALUES("36","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","","sys","menu_admin","","2023-10-14 17:16:41","2023-10-14 17:16:41","2023-10-14 09:16:41");
INSERT INTO php_visitas VALUES("37","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","","sys","admin/index","","2023-10-14 17:16:49","2023-10-14 17:16:49","2023-10-14 09:16:49");
INSERT INTO php_visitas VALUES("38","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","","sys","menu_admin","","2023-10-14 17:16:57","2023-10-14 17:16:57","2023-10-14 09:16:57");
INSERT INTO php_visitas VALUES("39","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=menu_admin","","sys","admin/index","","2023-10-14 17:17:08","2023-10-14 17:17:08","2023-10-14 09:17:08");
INSERT INTO php_visitas VALUES("40","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=backup","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=admin/index&opc=iconos","","sys","backup","","2023-10-14 17:17:12","2023-10-14 17:17:12","2023-10-14 09:17:12");
INSERT INTO php_visitas VALUES("41","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=backup&tab=1","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=backup","","sys","backup","","2023-10-14 17:17:31","2023-10-14 17:17:31","2023-10-14 09:17:31");
INSERT INTO php_visitas VALUES("42","2130706433","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36","CHROME","116.0.0.0","WIN","","admin","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=backup&tab=1","http://localhost/MisSitios/phponixdev/index.php?mod=sys&ext=backup","","sys","backup","","2023-10-14 17:21:40","2023-10-14 17:21:40","2023-10-14 09:21:40");



DROP TABLE users;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("1","217030585","Guillermo","Jimenez","memojl08@gmail.com","bc8e11429081378b7b71a202259f2195","1613960465memo1.jpg","Offline now");
INSERT INTO users VALUES("2","140361136","Miguel","Hernandez","mherco@hotmail.com","697449d8cc78d00420de47063f755ec3","1613960640FB_IMG_1554558557945.jpg","Offline now");
INSERT INTO users VALUES("3","232368606","Vanesa","Sandoval","vane@hotmail.com","2e78637beb09d02e873a63019476316f","1613961009FB_IMG_1496018315362.jpg","Offline now");



