<?php
function buscar_archivo1($path_file,&$val){
 $val=(file_exists($path_file))?1:0;
}

//$path_f='';$nombre_archivo='';$contenido='';
function crear_archivo1($path_f,$nombre_archivo,$contenido,&$path_file){
$path_file=$path_f.$nombre_archivo;
$archivo=fopen($path_file, "w+");
fwrite($archivo, $contenido);
fclose($archivo);
}

function generar_directorio_raiz(&$directorio_raiz) {
$directorio = (__FILE__);
$array_dir = explode ( '/', $directorio );
$directorio_raiz = '/' . $array_dir [1] . '/' . $array_dir [2];
//return $directorio_raiz;
}

/*CREAR ARCHIVO SCFG.PHP*/
function file_scfg($db_server,$db_username,$db_password,$db_database,$prefijo,$path_f,&$aviso2,&$val){
$nombre_archivo='scfg.php';
$contenido='<?php 
$h_s=\''.$_SERVER['HTTP_HOST'].'\';
if($_SERVER[\'HTTP_HOST\']==$h_s || $_SERVER[\'HTTP_HOST\']==\'www.\'.$h_s){
$db_host = "'.$db_server.'";  // Localhost
$db_base = "'.$db_database.'";  // Nombre de la Base de Datos
$db_user = "'.$db_username.'";  // Usuario de la Base de Datos
$db_pass = "'.$db_password.'";  // Password de la Base de Datos 
}else{
$db_host = "localhost"; // Localhost
$db_base = "'.$db_database.'";   // Nombre de la Base de Datos
$db_user = "root";  // Usuario de la Base de Datos
$db_pass = "";  // Password de la Base de Datos
}
$config = [
    "driver" => "mysql",
    "host" => $db_host,
    "database" => $db_base,
    "username" => $db_user,
    "password" => $db_pass,
    "port" => "3306",
    "charset" => "utf8mb4"
];
$DBprefix = "'.$prefijo.'";	// Prefijo para las tablas de la Base de datos.
/*DEFINICION DE VARIABLES PARA PHP7*/
define(\'DB_HOST\',$db_host);
define(\'DB_USER\',$db_user);
define(\'DB_PASSWORD\',$db_pass);
define(\'DB_DB\',$db_base);
?>';
crear_archivo1($path_f,$nombre_archivo,$contenido,$path_file);
buscar_archivo1($path_file,$val);
$aviso2=($val==1)?'<li class="text-success"><i class="fa fa-check"></i> Se ha creado el archivo: '.$nombre_archivo.'.</div>':'<div class="alert alert-danger" role="alert">No se ha creado el archivo: '.$nombre_archivo.'. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></li>';
}

/*CREAR ARCHIVO CONEXION.PHP*/
function file_conexion($path_f,&$aviso3){
$nombre_archivo='conexion.php';
$contenido='<?php 
include \'scfg.php\';
//COMPROBACION DE CONEXION AL SERVIDOR
$mysqli=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$mysqli){
	echo \'<div class="alert alert-danger">500 Internal Server Error: No se ha conectado al servidor MySQL. Posiblemente la p&aacute;gina no funcione correctamente.</div>\';
	include \'500.php\';//500 Internal Server Error
	exit();
}else{$select_db=@mysqli_select_db($mysqli,DB_DB);
	if(!$select_db){
		echo \'<div class="alert alert-danger">500 Internal Server Error: No se pudo establecer conexion con la base de datos. Posiblemente la p&aacute;gina no funcione correctamente.</div>\';
		include \'500.php\';//500 Internal Server Error
		exit();
	}
	$mysqli=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
}

//CONEXION
function conecta(){
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB); //conexión ala base de datos por medio de misqli poo
  if($mysqli->connect_errno > 0){ //si retorna algun error
 	return("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]"); //se muestra el error
  }else{ //si no retorna el error
 	$mysqli->query("SET NAMES \'utf8\'"); //codifica las consultas a utf-8
 	return $mysqli; //retorna la conexión a la base de datos mysql
  }
}
//$mysqli=conecta();

//CONEXION PDO
function connect(){
    try {
        $mysqli = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8mb4", DB_USER, DB_PASSWORD);
        // set the PDO error mode to exception
        $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $mysqli;
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
}
$conec=connect();
include \'lib.php\';
?>';
crear_archivo1($path_f,$nombre_archivo,$contenido,$path_file);
buscar_archivo1($path_file,$val);
$aviso3=($val==1)?'<div class="alert alert-success" role="alert">Se ha creado el archivo: '.$nombre_archivo.'.</div>':'<div class="alert alert-danger" role="alert">No se ha creado el archivo: '.$nombre_archivo.'. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></div>';
}

function crear_tablas_registros(&$crear_tablas){
global $mysqli,$DBprefix;
//TABLA: access
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."access (ID int(9) unsigned NOT NULL auto_increment,
  user varchar(50) NOT NULL,
  ip varchar(20) NOT NULL,
  navegador varchar(20) NOT NULL,
  os varchar(10) NOT NULL,
  code varchar(6) NOT NULL,
  fecha varchar(30) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."access (ID,user,ip,navegador,os,code,fecha) VALUES (1, 'admin', '127.0.0.1', 'CHROME', 'WIN', '944950', '2019-06-06 03:35:27');");

//TABLA: api_version
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."api_version (ID int(9) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  vence varchar(20) NOT NULL,
  ultimate varchar(50) NOT NULL,
  status varchar(100) NOT NULL,
  des_ver mediumtext NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (1, 'phponix2017', '31/08/2019', '01.2.3.5', 'obsoleta', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (2, 'AdminLTE', '31/12/2019', '01.2.4.5', 'obsoleta', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (3, 'AdminLTE CSS', '30/11/2019', '01.2.4.6', 'obsoleta', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (4, 'AdminLTE CSS2', '30/11/2021', '01.2.5.1', 'activa', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (5, 'AdminLTE 7Ajax', '29/05/2024', '01.2.6.6', 'activa', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (6, 'AdminLTE PHP7', '01/12/2026', '01.2.7.2', 'activa', '')");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."api_version (ID,nom,vence,ultimate,status,des_ver) VALUES (7, 'AdminLTE SE-X', '30/11/2027', '01.2.8.0', 'activa', '')");

//TABLA: blog
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."blog (ID int(9) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  descripcion varchar(200) NOT NULL,
  contenido mediumtext NOT NULL,
  cate varchar(200) NOT NULL,
  tag varchar(200) NOT NULL,
  autor varchar(100) NOT NULL,
  fmod varchar(21) NOT NULL,
  fecha varchar(21) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."blog (ID, cover, titulo, descripcion, contenido, cate, tag, autor, fmod, fecha, visible) VALUES (1, 'blog_FO_petrolera.jpg', 'Mi primer blog', 'Si vives con EPOC, tener una fuente de oxigeno confiable es importante para mantener...', '<p>Si vives con EPOC, tener una fuente de ox&iacute;geno confiable es importante para mantener tu calidad de vida. Sin embargo, existen tantos tipos diferentes de concentradores de ox&iacute;geno en el mercado hoy en d&iacute;a, que puede ser dif&iacute;cil elegir el que mejor se adapte a sus necesidades. A medida que esta tecnolog&iacute;a contin&uacute;a avanzando, aparecen caracter&iacute;sticas m&aacute;s nuevas y opciones m&aacute;s c&oacute;modas, &iexcl;y desea aprovecharlas al m&aacute;ximo!</p>\n<p>La buena noticia es que hay m&aacute;s opciones para la terapia de ox&iacute;geno disponibles para ti; a continuaci&oacute;n, hemos recopilado informaci&oacute;n excelente sobre los dos principales concentradores de oxigeno dom&eacute;sticos de Philips Respironics:</p>\n<table>\n<tbody>\n<tr>\n<td width=\"299\"><strong>EVERFLO</strong>\n<p>&nbsp;</p>\n<p>El concentrador de ox&iacute;geno EverFlo de 5 litros es una m&aacute;quina silenciosa, liviana y compacta que es menos llamativa que muchas otras.</p>\n<p>Los usuarios pueden comprar el modelo est&aacute;ndar, o el que tiene un indicador de porcentaje de ox&iacute;geno (OPI) y usa ultrasonido para medir el flujo de ox&iacute;geno.</p>\n<p>Los controles se encuentran en el lado delantero izquierdo de la m&aacute;quina y una perilla de rodillo controla el medidor de flujo de ox&iacute;geno empotrado en el centro. Una botella de humidificador se puede conectar a la parte posterior izquierda de la m&aacute;quina con velcro. &iexcl;El tubo se conecta f&aacute;cilmente a la c&aacute;nula de metal encima del interruptor de encendido, y tambi&eacute;n se pueden almacenar tubos adicionales en el interior.</p>\n<p>&iexcl;EverFlo 5L pesa 14 kgs y entrega ox&iacute;geno a .5-5 LPM con una concentraci&oacute;n de ox&iacute;geno de hasta 95% en todas las velocidades de flujo. La m&aacute;quina mide 58 cm de profundidad.</p>\n<p>El concentrador EverFlo de 5L viene con una garant&iacute;a est&aacute;ndar de 1 a&ntilde;o.</p>\n</td>\n<td width=\"299\"><strong>MILLENNIUM</strong>\n<p>&nbsp;</p>\n<p>El concentrador de ox&iacute;geno Millenium proporciona hasta 10 LPM de ox&iacute;geno, d&aacute;ndole las especificaciones de una unidad de &ldquo;alto flujo&rdquo;.</p>\n<p>El concentrador de ox&iacute;geno est&aacute; disponible en dos modelos: el modelo est&aacute;ndar y uno dise&ntilde;ado con un indicador de porcentaje de ox&iacute;geno (OPI), una funci&oacute;n que utiliza tecnolog&iacute;a de ultrasonido para medir el flujo de ox&iacute;geno.</p>\n<p>El dise&ntilde;o rectangular blanco es fuerte y resistente, y cuatro ruedas grandes (junto con un asa insertada en la parte superior) lo hacen bastante f&aacute;cil de mover.</p>\n<p>Este concentrador tiene una v&aacute;lvula SMC de &ldquo;ciclo seguro&rdquo;, dise&ntilde;ada espec&iacute;ficamente para manejar los mayores flujos de presi&oacute;n necesarios para una m&aacute;quina de 10 LPM. Millenium tambi&eacute;n est&aacute; dise&ntilde;ado con un compresor de doble cabezal equipado para impulsar m&aacute;s aire a trav&eacute;s de los lechos de tamices de la m&aacute;quina para eliminar el nitr&oacute;geno.</p>\n<p>Philips Respironics &ldquo;Millennium&rdquo; viene con una garant&iacute;a est&aacute;ndar de un a&ntilde;o.</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Caracter&iacute;sticas y Beneficios</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Silencioso y f&aacute;cil de usar\n<p>&nbsp;</p>\n<p>Controles claros y visibles</p>\n<p>Dise&ntilde;o ergon&oacute;mico: rueda f&aacute;cilmente</p>\n<p>Peso ligero de 14 kg</p>\n<p>Medidor de flujo empotrado para proteger contra la rotura</p>\n<p>Velcro asegura la botella del humidificador en la m&aacute;quina</p>\n<p>Proporciona ox&iacute;geno a .5-5 LPM con 95% de ox&iacute;geno</p>\n<p>Alarmas de seguridad por fallas</p>\n<p>Garant&iacute;a de producto de tres a&ntilde;os</p>\n</td>\n<td width=\"299\">F&aacute;cil de usar: los controles son claros y visibles\n<p>&nbsp;</p>\n<p>Pesa 24 kg</p>\n<p>Indicador de Porcentaje de Ox&iacute;geno (OPI) se puede agregar en</p>\n<p>Proporciona ox&iacute;geno a 1-10 LPM al 96% de ox&iacute;geno</p>\n<p>Alarmas de seguridad por fallas y bajo porcentaje de ox&iacute;geno</p>\n<p>Menos partes m&oacute;viles que otros concentradores</p>\n<p>Garant&iacute;a est&aacute;ndar de un a&ntilde;o</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Pros</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Funcionamiento silencioso y sonido silencioso cuando se inicia (45 db)\n<p>&nbsp;</p>\n<p>F&aacute;cil de usar</p>\n<p>Confiable y ligero</p>\n<p>Port&aacute;til y f&aacute;cil de mover</p>\n<p>Consumo de energ&iacute;a de 350 w</p>\n<p>&nbsp;</p>\n</td>\n<td width=\"299\">Bien hecho y f&aacute;cil de configurar\n<p>&nbsp;</p>\n<p>Robusto, confiable y de bajo mantenimiento</p>\n<p>Produce hasta 10 LPM de ox&iacute;geno</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\" width=\"599\"><strong>Contras</strong></td>\n</tr>\n<tr>\n<td width=\"299\">Bip fuerte cuando se inicia\n<p>&nbsp;</p>\n<p>Baja altitud de trabajo</p>\n<p>Produce hasta 5 LPM de ox&iacute;geno</p>\n</td>\n<td width=\"299\">Demasiado ruidoso para algunos usuarios (50 db)\n<p>&nbsp;</p>\n<p>Pesa 24 kg</p>\n<p>Tiene m&aacute;s potencia de la que muchos usuarios necesitan</p>\n<p>Consumo de energ&iacute;a de 600 w</p>\n<p><strong>&nbsp;</strong></p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>La elecci&oacute;n de los dispositivos de administraci&oacute;n de ox&iacute;geno depende del requerimiento del paciente, la eficacia del dispositivo, la fiabilidad, la facilidad de aplicaci&oacute;n terap&eacute;utica y la aceptaci&oacute;n del paciente. <a href=\"http://samsung-healthcare.mx/contacto\"><span style=\"text-decoration: underline;\">Para m&aacute;s informaci&oacute;n sobre la elecci&oacute;n de su concentrador de ox&iacute;geno no dude en contactarnos.</span></a></p>', 'Sin Categoria', 'EPOC, Oxígeno', 'admin', '2021-03-20 21:47:32', '2017-01-18 14:05:23', 1);");

//TABLA: blog_coment
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."blog_coment (ID int(6) unsigned NOT NULL auto_increment,
  ip varchar(18) NOT NULL,
  nombre varchar(100) NOT NULL,
  email varchar(50) NOT NULL,
  comentario varchar(500) NOT NULL,
  id_b int(3) NOT NULL,
  fecha varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."blog_coment (ID, ip, nombre, email, comentario, id_b, fecha, visible) VALUES (1, '127.0.0.1', 'Miguel Hernandez', 'mherco@hotmail.com', 'Mensaje de prueba de comentario.', 1, '2021-02-15 21:44:51', 1);");

//TABLA: clientes
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."clientes (ID int(11) unsigned NOT NULL auto_increment,
  nombre varchar(200) NOT NULL,
  empresa varchar(200) NOT NULL,
  domicilio varchar(300) NOT NULL,
  tel_ofi varchar(12) NOT NULL,
  email varchar(150) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."clientes (ID, nombre, empresa, domicilio, tel_ofi, email) VALUES (1, 'KAREN NAVARRO', 'KEY AGENCIA DIGITAL', 'CELAYA, GTO', '442 788 5025', 'karen.navarro@keyagenciadigital.com');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."clientes (ID, nombre, empresa, domicilio, tel_ofi, email) VALUES (2, 'RAMSES', 'FIBRECEN', 'Guanajuato No. 5-B, Col. San Francisquito', '442 305 7704', 'fibrecen@fibrecen.com.mx');");

//TABLA: com
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."comp (ID int(1) unsigned NOT NULL auto_increment,
  page varchar(50) default NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp (ID,page) VALUES (1,'usuarios/login.php');");

//TABLA: config
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."config (ID int(1) unsigned NOT NULL auto_increment,
  logo varchar(100) NOT NULL,
  page_name varchar(100) NOT NULL,
  title varchar(150) NOT NULL,
  dominio varchar(100) NOT NULL,
  path_root varchar(150) NOT NULL,
  page_url varchar(100) NOT NULL,
  keyword varchar(200) NOT NULL,
  description varchar(200) NOT NULL,
  metas mediumtext NOT NULL,
  g_analytics mediumtext NOT NULL,
  tel varchar(20) NOT NULL,
  phone varchar(100) NOT NULL,
  wapp varchar(20) NOT NULL,
  webMail varchar(100) NOT NULL,
  contactMail varchar(100) NOT NULL,
  mode varchar(50) NOT NULL,
  chartset varchar(30) NOT NULL,
  dboard varchar(50) NOT NULL,
  dboard2 varchar(50) NOT NULL,
  direc varchar(250) NOT NULL,
  CoR varchar(100) NOT NULL,
  CoE varchar(100) NOT NULL,
  BCC varchar(100) NOT NULL,
  CoP varchar(100) NOT NULL,
  fb varchar(100) NOT NULL,
  tw varchar(100) NOT NULL,
  gp varchar(100) NOT NULL,
  lk varchar(100) NOT NULL,
  yt varchar(100) NOT NULL,
  ins varchar(100) NOT NULL,
  wv varchar(100) NOT NULL,
  licencia varchar(300) NOT NULL,
  version varchar(50) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."config (ID, logo, page_name, title, dominio, path_root, page_url, keyword, description, metas, g_analytics, tel, phone, wapp, webMail, contactMail, mode, chartset, dboard, dboard2, direc, CoR, CoE, BCC, CoP, fb, tw, gp, lk, yt, ins, wv, licencia, version) VALUES (1, 'logo.min.png', 'PHP ONIX', 'PHP Onix - El mejor CMS para crear y administrar tu sitio web. Gestor de contenido web.', 'http://localhost/', 'MisSitios/phponixdev/', 'http://localhost/MisSitios/phponixdev/', 'cms,contenido,web,landingpage,p&aacute;gina web', 'PHP Onix es un CMS gestor de contenidos para tu web.', '<!--Responsive Meta-->\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">\r\n<!-- META-TAGS generadas por http://metatags.miarroba.es -->\r\n<META NAME=\"DC.Language\" SCHEME=\"RFC1766\" CONTENT=\"Spanish\">\r\n<META NAME=\"AUTHOR\" CONTENT=\"Guillermo Jimenez\">\r\n<META NAME=\"REPLY-TO\" CONTENT=\"multiportal@outlook.com\">\r\n<LINK REV=\"made\" href=\"mailto:multiportal@outlook.com\">\r\n', '<!--Google Analytics-->', '(01)4426002842', '', '4426002842', 'multiportal@outlook.com', 'multiportal@outlook.com', 'page', 'utf-8', 'dashboard', 'AdminLTE', 'Centro, Quer&eacute;taro, Qro', 'multiportal@outlook.com', 'phponix@webcindario.com', '', 'memojl08@gmail.com', 'https://facebook.com/', 'https://twitter.com/', '', '', '', '', '', 'cms-px31q2hponix31q2x.admx31q2in458x31q2x.202x31q24.05.x31q212.01x31q2.2.8.x31q26x31q2', '01.2.8.2')");

//TABLA: contacto
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."contacto (ID int(9) unsigned NOT NULL auto_increment,
  ip varchar(25) NOT NULL,
  nombre varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  para varchar(50) NOT NULL,
  de varchar(50) NOT NULL,
  tel varchar(20) NOT NULL,
  titulo varchar(200) NOT NULL,
  asunto varchar(150) NOT NULL,
  msj mediumtext NOT NULL,
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  cat_list varchar(50) NOT NULL,
  seccion varchar(50) NOT NULL,
  tabla varchar(50) NOT NULL,
  adjuntos mediumtext NOT NULL,
  visto tinyint(1) NOT NULL,
  status int(11) NOT NULL,
  ID_login int(11) NOT NULL,
  ID_user int(11) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ID, ip, nombre, email, para, de, tel, titulo, asunto, msj, fecha, cat_list, seccion, tabla, adjuntos, visto, status, ID_login, ID_user, visible) VALUES (1, '127.0.0.1', 'Miguel Hernandez', 'mherco@hotmail.com', 'phponix@webcindario.com', 'mherco@hotmail.com', '4421944950', 'Contacto Web PHP ONIX', 'Mensaje de Bienvenida - CENTRO DE CONTACTO', 'Hola estimado usuario, bienvenido a su plataforma \"PHPONIX CMS\" aqui se guardara un copia de respaldo de todos sus correos de contacto y registros de su página web.\r\n\r\nCualquier duda o comentario puede ponerse en contacto a través del correo a multiportal@outlook.com o en nuestra página https://phponix.webcindario.com \r\n\r\nATTE.\r\nEl equipo de PHPONIX & MULTIPORTAL ', '2021-02-15 21:59:26', 'inbox', 'contacto', '', '', 0, 1, 1, 1, 1);");

//TABLA: contacto_forms
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."contacto_forms (ID int(6) unsigned NOT NULL auto_increment,
  seccion varchar(100) NOT NULL,
  modulo varchar(100) NOT NULL,
  email varchar(300) NOT NULL,
  bcc varchar(200) NOT NULL,
  CoE varchar(100) NOT NULL,
  CoP varchar(100) NOT NULL,
  usuario varchar(300) NOT NULL,
  url_m varchar(500) NOT NULL,
  fecha varchar(22) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto_forms (ID, seccion, modulo, email, bcc, CoE, CoP, usuario, url_m, fecha, activo) VALUES (1, 'Contacto', 'contacto', 'multiportal@outlook.com', 'memojl08@gmail.com', 'phponix@webcindario.com', 'memojl08@gmail.com', '', 'index.php?mod=contacto', '2018-09-28 18:31:45', 1);");

//TABLA: countries
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."countries (ID int(6) unsigned NOT NULL auto_increment,
  countryCode char(2) NOT NULL DEFAULT '',
  countryName varchar(45) NOT NULL DEFAULT '',
  currencyCode char(3) DEFAULT NULL,
  capital varchar(30) DEFAULT NULL,
  continentName varchar(15) DEFAULT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."countries (ID, countryCode, countryName, currencyCode, capital, continentName) VALUES ();");

  //TABLA: css
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."css (ID int(9) unsigned NOT NULL auto_increment,
  tema varchar(50) NOT NULL,
  general varchar(50) NOT NULL,
  body varchar(50) NOT NULL,
  fuente varchar(100) NOT NULL,
  size varchar(10) NOT NULL,
  color varchar(20) NOT NULL,
  fondo varchar(100) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."css () VALUES ();");

//TABLA: css2
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."css2 (ID int(9) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  contenido mediumtext NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."css2 () VALUES ();");

  //TABLA: cursos
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."cursos (ID int(9) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  descripcion varchar(200) NOT NULL,
  contenido mediumtext NOT NULL,
  fechas varchar(100) NOT NULL,
  lugar varchar(200) NOT NULL,
  horario varchar(100) NOT NULL,
  video varchar(300) NOT NULL,
  tag varchar(200) NOT NULL,
  autor varchar(100) NOT NULL,
  fmod varchar(21) NOT NULL,
  fecha varchar(21) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."cursos () VALUES ();");

//TABLA: cursos_coment
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."cursos_coment (ID int(9) unsigned NOT NULL auto_increment,
  ip varchar(18) NOT NULL,
  nombre varchar(100) NOT NULL,
  email varchar(50) NOT NULL,
  comentario varchar(500) NOT NULL,
  id_b int(3) NOT NULL,
  fecha varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."cursos_coment () VALUES ();");

//TABLA: depa
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."depa (ID int(2) unsigned NOT NULL auto_increment,
  nombre varchar(100) NOT NULL,
  list_depa varchar(100) NOT NULL,
  puesto varchar(100) NOT NULL,
  nivel int(1) NOT NULL,
  icono varchar(50) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (1, 'Administrador', 'Administradores', 'Administrador', 1, '', 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (2, 'Edecan', 'Edecanes', 'Edecan', 2, '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (3, 'Modelo', 'Modelos', 'Modelo', 2, '', 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (4, 'Fotografo', 'Fotografos', 'Fotografo', 2, '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (5, 'Agencia', 'Agencias', 'Agencia', 2, '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."depa (ID, nombre, list_depa, puesto, nivel, icono, visible) VALUES (6, 'Escuela', 'Escuelas', 'Escuela', 2, '', 0);");

//TABLA: directorio
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."directorio (ID int(6) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  nom varchar(100) NOT NULL,
  url_link varchar(300) NOT NULL,
  usuario varchar(100) NOT NULL,
  pass varchar(100) NOT NULL,
  des varchar(250) NOT NULL,
  filtro varchar(100) NOT NULL,
  user varchar(100) NOT NULL,
  fecha varchar(22) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."directorio () VALUES ();");

//TABLA: empresa
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."empresa (ID int(11) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  ima varchar(100) NOT NULL,
  contenido mediumtext NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."empresa (ID, nom, ima, contenido, visible) VALUES (1, 'VISIÓN', 'vision.jpg', '<p>Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."empresa (ID, nom, ima, contenido, visible) VALUES (2, 'MISIÓN', 'vision.jpg', '<p>2(MISI&Oacute;N)Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."empresa (ID, nom, ima, contenido, visible) VALUES (3, 'VALORES', 'vision.jpg', '<p>3(VALORES)Como visi&oacute;n buscamos a mediano plazo convertimos en un semillero de grandes ingenieros, expandimos a algunas otras del pa&iacute;s y EU, as&iacute; como iniciar con el desarrollo de productos espec&iacute;ficos y convertinos en OEM en ciertos procesos en los cuales el personal clave de la compa&ntilde;ia cuenta con bastante experiencia. De la misma manera estamos trabajando en consolidar nuestra relaci&oacute;n con algunas marcas adicionales las cuales complentar&iacute;a el servicio que esta el momento hemos podido ofrecer.</p>', 1);");

//TABLA: galeria
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."galeria (ID int(6) unsigned NOT NULL auto_increment,
  clave varchar(100) NOT NULL,
  nombre varchar(100) NOT NULL,
  cover varchar(100) NOT NULL,
  descripcion mediumtext NOT NULL,
  precio decimal(6,2) NOT NULL,
  cate varchar(50) NOT NULL,
  resena varchar(500) NOT NULL,
  url_page varchar(150) NOT NULL,
  imagen1 varchar(100) NOT NULL,
  imagen2 varchar(100) NOT NULL,
  imagen3 varchar(100) NOT NULL,
  imagen4 varchar(100) NOT NULL,
  imagen5 varchar(100) NOT NULL,
  visible tinyint(1) NOT NULL,
  alta varchar(21) NOT NULL,
  fmod varchar(21) NOT NULL,
  user varchar(50) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  
//TABLA: histo_backupdb
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."histo_backupdb (ID int(9) unsigned NOT NULL auto_increment,
  fecha varchar(50) NOT NULL,
  archivo varchar(200) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

//TABLA: home_config
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."home_config (ID int(1) unsigned NOT NULL auto_increment,
  titulo varchar(200) NOT NULL,
  contenido text NOT NULL,
  selc tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."home_config (ID, titulo, contenido, selc, activo) VALUES (1, 'phponix backup', '<!--Contenido Generado MySql-->\r\n<div id=\"content1\">\r\n<div id=\"intro\">\r\n<div class=\"clear\">&nbsp;</div>\r\n<h2>PHP Onix el mejor CMS para crear y administrar tu sitio web.</h2>\r\n<div class=\"clear\">&nbsp;</div>\r\n<p style=\"font-size: 16px;\">Con <strong>PHPOnix</strong> podras instalar y crear tu sitio web en 5 minutos ademas con herramientas para gestionar, monitoriar y posicionar tu p&aacute;gina web. <strong>PHPOnix</strong> cuenta con multiples funcionalidades desde crear un p&aacute;gina <strong>web standar</strong>, <strong>landingpage</strong>, <strong>intranet</strong>, <strong>blog</strong>, <strong>catalogo</strong>, <strong>portafolio</strong>, incluso una tienda virtual*(<strong>ecommerce</strong>) para tu negocio o servicio tu elijes la funcionalidad.</p>\r\n<div class=\"clear\">&nbsp;</div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>Sitio Web</h3>\r\n<img src=\"./modulos/Home/img/web.png\" alt=\"\" width=\"80%\" /></div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>LandingPage</h3>\r\n<img src=\"./modulos/Home/img/intuitivo.png\" alt=\"\" width=\"80%\" /></div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>Ecommerce</h3>\r\n<img src=\"./modulos/Home/img/ecommerce.png\" alt=\"\" width=\"80%\" /></div>\r\n</div>\r\n</div>\r\n<div id=\"content2\">\r\n<div id=\"beneficios\">\r\n<div class=\"clear\">&nbsp;</div>\r\n<h2>Beneficios</h2>\r\n<div class=\"clear\">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<div class=\"clear\">&nbsp;</div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>Multi-Dispositivos</h3>\r\n<img src=\"./modulos/Home/img/multidispositivo.png\" alt=\"\" width=\"80%\" /></div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>Reporte de Estadisticas</h3>\r\n<img src=\"./modulos/Home/img/estadisticas.png\" alt=\"\" width=\"80%\" /></div>\r\n<div class=\"col-md-4 col-sm-6 col-xs-12\" style=\"text-align: center;\">\r\n<h3>Gestion de Contenido</h3>\r\n<img src=\"./modulos/Home/img/busqueda-sistema.png\" alt=\"\" width=\"80%\" /></div>\r\n</div>\r\n</div>', 0, 0);");

//TABLA: iconos
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."iconos (ID int(6) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  fa_icon varchar(100) NOT NULL,
  icon mediumtext NOT NULL,
  tipo varchar(100) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (1, 'Descarga', 'fa-download', '<i class=\"fa fa-download\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (2, 'Menu', 'fa-list', '<i class=\"fa fa-list\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (3, 'Configuracion', 'fa-gear', '<i class=\"fa fa-gear\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (4, 'Configuraciones', 'fa-gears', '<i class=\"fa fa-gear\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (5, 'Modulos', 'fa-cubes', '<i class=\"fa fa-cubes\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (6, 'Home', 'fa-home', '<i class=\"fa fa-home\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (7, 'Portafolio', 'fa-briefcase', '<i class=\"fa fa-briefcase\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (8, 'Blog', 'fa-comments', '<i class=\"fa fa-comments\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (9, 'BlockIP', 'fa-crosshairs', '<i class=\"fa fa-crosshairs\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (10, 'Estadisticas', 'fa-bar-chart', '<i class=\"fa fa-bar-chart\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (11, 'Moneda', 'fa-usd', '<i class=\"fa fa-usd\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (12, 'Dashboard', 'fa-dashboard', '<i class=\"fa fa-dashboard\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (13, 'Usuario', 'fa-user', '<i class=\"fa fa-user\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (14, 'Usuarios', 'fa-users', '<i class=\"fa fa-users\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (15, 'Global', 'fa-globe', '<i class=\"fa fa-globe\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (16, 'Ver', 'fa-eye', '<i class=\"fa fa-eye\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (17, 'Enviar', 'fa-send-o', '<i class=\"fa fa-send-o\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (18, 'Mail', 'fa-envelope', '<i class=\"fa  fa-envelope\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (19, 'Marca de Mapa', 'fa-map-marker', '<i class=\"fa  fa-map-marker\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (20, 'Formularios', 'fa-pencil-square-o', '<i class=\"fa  fa-pencil-square-o\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (21, 'Carrito', 'fa-shopping-cart', '<i class=\"fa fa-shopping-cart\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (22, 'Folder Open Blanco', 'fa-folder-open-o', '<i class=\"fa fa-folder-open-o\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (23, 'Folder Open', 'fa-folder-open', '<i class=\"fa fa-folder-open\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (24, 'Tesmoniales', 'fa-commenting', '<i class=\"fa fa-commenting\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (25, 'Clientes', 'fa-child', '<i class=\"fa fa-child\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (26, 'Mapa', 'fa-map', '<i class=\"fa fa-map\" aria-hidden=\"true\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (27, 'Sitemap', 'fa-sitemap', '<i class=\"fa fa-sitemap\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (28, 'Check Square', 'fa-check-square', '<i class=\"fa fa-check-square\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (29, 'Play', 'fa-caret-square-o-right', '<i class=\"fa fa-caret-square-o-right\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (30, 'Curso', 'fa-university', '<i class=\"fa fa-university\"></i>', 'awesome');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (ID, nom, fa_icon, icon, tipo) VALUES (31, 'Paint-brush', 'fa-paint-brush', '<i class=\"fa fa-paint-brush\"></i>', 'awesome');");

//TABLA: ipbann
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."ipbann (ID int(11) unsigned NOT NULL auto_increment,
  ip varchar(256) NOT NULL DEFAULT '',
  bloqueo tinyint(1) NOT NULL,
  alta timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (1, '127.0.0.5', 0, '2017-10-17 11:55:47');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (2, '174.128.181.67', 0, '2019-11-23 10:01:09');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (3, '174.128.181.68', 0, '2019-11-23 10:01:56');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (4, '78.0.3904.70', 0, '2019-11-23 10:02:19');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (5, '189.166.7.220', 0, '2019-11-23 10:02:38');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (6, '165.227.41.143', 0, '2019-11-23 10:02:54');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (7, '159.203.34.197', 0, '2019-11-23 10:03:24');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ID, ip, bloqueo, alta) VALUES (8, '167.99.177.203', 0, '2019-11-24 08:55:26');");

//TABLA: landingpage_seccion
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."landingpage_seccion (ID int(6) unsigned NOT NULL auto_increment,
  seccion varchar(100) NOT NULL,
  tit varchar(150) NOT NULL,
  conte varchar(254) NOT NULL,
  visible varchar(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (1, 'Nosotros', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (2, 'Equipo', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (3, 'Servicios', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (4, 'Portafolio', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (5, 'Clientes', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (6, 'Contacto', '', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."landingpage_seccion (ID, seccion, tit, conte, visible) VALUES (7, 'Testimoniales', '', '', '1');");

//TABLA: map_config
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."map_config (ID int(9) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  lat varchar(20) NOT NULL,
  lng varchar(20) NOT NULL,
  zoom varchar(2) NOT NULL,
  cover varchar(50) NOT NULL,
  on_costo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."map_config (ID, nom, lat, lng, zoom, cover, on_costo) VALUES (1, 'Querétaro', '20.5931297', '-100.3920483', '12', 'g_intelmex.png', 0);");

//TABLA: map_ubicacion
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."map_ubicacion (ID int(9) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  adres varchar(150) NOT NULL,
  descripcion varchar(250) NOT NULL,
  info varchar(250) NOT NULL,
  precio decimal(6,2) NOT NULL,
  tel varchar(30) NOT NULL,
  cover varchar(100) NOT NULL,
  nivel varchar(2) NOT NULL,
  rol varchar(2) NOT NULL,
  lat varchar(15) NOT NULL,
  lng varchar(15) NOT NULL,
  alta varchar(20) NOT NULL,
  fmod varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."map_ubicacion (ID, nom, adres, descripcion, info, precio, tel, cover, nivel, rol, lat, lng, alta, fmod, visible, activo) VALUES (1, 'Intelmex', 'Calle 1 303, Jurica, 76130 Santiago de Querétaro, Qro.', '', 'Reparación de telefonos', '0.00', '4421234567', 'nodisponible.jpg', '1', '3', '20.6500317', '-100.4290312', '2018-04-03 13:44:50', '2018-04-03 13:59:06', 1, 1);");

//TABLA: menu_admin
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."menu_admin (ID int(6) unsigned NOT NULL auto_increment,
  nom_menu varchar(50) NOT NULL,
  icono varchar(50) NOT NULL,
  link mediumtext NOT NULL,
  nivel int(1) NOT NULL,
  ID_menu_adm int(2) NOT NULL,
  ID_mod int(2) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (1, 'Config. Sistema', 'fa-gear', 'index.php?mod=sys&ext=admin/index', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (2, 'Modulos', 'fa-cubes', 'index.php?mod=sys&ext=modulos', -1, 0, 0, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (3, 'Logs', 'fa-globe', 'index.php?mod=sys&ext=admin/index&opc=logs', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (4, 'Bloquear IP', 'fa-crosshairs', 'index.php?mod=sys&ext=admin/index&opc=bloquear', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (5, 'Temas', 'fa-sticky-note-o', 'index.php?mod=sys&ext=admin/index&opc=temas', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (6, 'Admin. Usuarios', 'fa-users', 'index.php?mod=usuarios&ext=admin/index', -1, 0, 6, 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (7, 'Menu Admin', 'fa-list', 'index.php?mod=sys&ext=menu_admin', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (8, 'Iconos', 'fa-smile-o', 'index.php?mod=sys&ext=admin/index&opc=iconos', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (9, 'Informe de Visitas', 'fa-download', 'index.php?mod=estadisticas&ext=admin/index', 1, 0, 12, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (10, 'Backup DB', 'fa-download', 'index.php?mod=sys&ext=backup', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (11, 'Config. Mailbox', 'fa-gear', 'index.php?mod=mailbox&ext=admin/index', 1, 0, 14, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (12, 'Mensajes', 'fa-envelope', 'index.php?mod=mailbox', 1, 0, 14, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (13, 'Editar', 'fa-home', 'index.php?mod=Home&ext=admin/index', 1, 0, 5, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (14, 'Menu Web', 'fa-list', 'index.php?mod=Home&ext=admin/index&opc=menu_web', 1, 0, 5, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (15, 'Admin productos', 'fa-shopping-cart', 'index.php?mod=productos&ext=admin/index', 1, 0, 17, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (16, 'Categoria de productos', 'fa-folder-open', 'index.php?mod=productos&ext=admin/index&opc=categoria', 1, 0, 17, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (17, 'Subcategoria de productos', 'fa-folder-open-o', 'index.php?mod=productos&ext=admin/index&opc=subcategoria', 1, 0, 17, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (18, 'Config. Gmaps', 'fa-gear', 'index.php?mod=gmaps&ext=admin/index', 1, 0, 18, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (19, 'Ubicaciones', 'fa-map-marker', 'index.php?mod=gmaps&ext=admin/index&opc=ubicaciones', 1, 0, 18, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (20, 'Config. Contacto', 'fa-gear', 'index.php?mod=contacto&ext=admin/index', 1, 0, 10, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (21, 'Correos de Formulario', 'fa-pencil-square-o', 'index.php?mod=contacto&ext=admin/index&opc=forms', 1, 0, 10, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (22, 'Generador Sitemap', 'fa-sitemap', 'index.php?mod=sys&ext=admin/index&opc=sitemap', 1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (23, 'Opciones', 'fa-gears', 'index.php?mod=sys&ext=opciones', 1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (24, 'Licencia', 'fa-eye', 'index.php?mod=sys&ext=licencia', -1, 0, 11, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (25, 'Slider', 'fa-caret-square-o-right', 'index.php?mod=Home&ext=admin/index&opc=slider', 1, 0, 5, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (26, 'Testimonios', 'fa-child', 'index.php?mod=Home&ext=admin/index&opc=testimonios', 1, 0, 5, 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (ID, nom_menu, icono, link, nivel, ID_menu_adm, ID_mod, visible) VALUES (27, 'Tema', 'fa-paint-brush', 'index.php?mod=Home&ext=admin/index&opc=tema', 1, 0, 5, 1);");

//TABLA: menu_web
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."menu_web (ID int(6) unsigned NOT NULL auto_increment,
  menu varchar(50) NOT NULL,
  url varchar(254) NOT NULL,
  modulo varchar(100) NOT NULL,
  ext varchar(50) NOT NULL,
  ord varchar(2) NOT NULL,
  subm varchar(3) NOT NULL,
  ima_top varchar(100) NOT NULL,
  tit_sec varchar(100) NOT NULL,
  des_sec mediumtext NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID, menu, url, modulo, ext, ord, subm, ima_top, tit_sec, des_sec, visible) VALUES (1, 'Inicio', 'index.php', 'Home', '', '1', '', 'gris.png', '', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID, menu, url, modulo, ext, ord, subm, ima_top, tit_sec, des_sec, visible) VALUES (2, 'Nosotros', '#', 'nosotros', '', '2', '', 'gris.png', '', '', 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID, menu, url, modulo, ext, ord, subm, ima_top, tit_sec, des_sec, visible) VALUES (3, 'Descargas', 'descargas/', 'descargas', '', '3', '', 'gris.png', '', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID, menu, url, modulo, ext, ord, subm, ima_top, tit_sec, des_sec, visible) VALUES (4, 'Blog', 'blog/', 'blog', '', '4', '', 'gris.png', 'Blog', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID, menu, url, modulo, ext, ord, subm, ima_top, tit_sec, des_sec, visible) VALUES (5, 'Contacto', 'contacto/', 'contacto', '', '5', '', 'gris.png', '', '', 1);");

//TABLA: mode_page
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."mode_page (ID int(2) unsigned NOT NULL auto_increment,
  page_mode varchar(100) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."mode_page (ID,page_mode) VALUES ('1','page');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."mode_page (ID,page_mode) VALUES ('2','landindpage');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."mode_page (ID,page_mode) VALUES ('3','extranet');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."mode_page (ID,page_mode) VALUES ('4','ecommerce');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."mode_page (ID,page_mode) VALUES ('5','CRM');");

//TABLA: modulos
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."modulos (ID int(6) unsigned NOT NULL auto_increment,
  nombre varchar(25) NOT NULL DEFAULT '',
  modulo varchar(100) NOT NULL DEFAULT '',
  description varchar(250) NOT NULL,
  dashboard tinyint(1) NOT NULL,
  nivel tinyint(4) NOT NULL DEFAULT '0',
  home tinyint(4) NOT NULL DEFAULT '0',
  visible tinyint(4) NOT NULL DEFAULT '0',
  activo tinyint(4) NOT NULL DEFAULT '0',
  sname varchar(10) NOT NULL DEFAULT '',
  icono varchar(50) NOT NULL,
  link varchar(250) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (1, 'admin', 'admin', '', 0, 0, 0, 0, 1, 'false', '', '');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (2, 'Login', 'login', 'Administraci&oacute;n Login.', 0, 0, 0, 0, 1, 'false', 'fa-users', 'index.php?mod=login');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (3, 'Logout', 'logout', 'Administraci&oacute;n Logout.', 0, 0, 0, 0, 1, 'false', 'fa-users', 'index.php?mod=logout');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (4, 'Dashboard', 'dashboard', '', 1, -1, 0, 0, 1, 'false', 'fa-dashboard', 'index.php?mod=dashboard');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (5, 'Home', 'Home', 'Administración y gestión del Home.', 0, 0, 1, 1, 1, 'false', 'fa-home', 'index.php?mod=Home');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (6, 'Usuarios', 'usuarios', 'Administación y gestión de usuarios.', 0, -1, 0, 1, 1, 'false', 'fa-users', 'index.php?mod=usuarios');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (7, 'Nosotros', 'nosotros', 'Administración del contenido del modulo de nosotros.', 0, 0, 0, 1, 1, 'false', 'fa-users', 'index.php?mod=nosotros');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (8, 'Portafolio', 'portafolio', 'Administraci&oacute;n y gesti&oacute;n del portafolio.', 0, 0, 0, 0, 0, 'false', 'fa-briefcase', 'index.php?mod=portafolio');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (9, 'Blog', 'blog', 'Administraci&oacute;n del contenido del modulo de blog.', 0, 0, 0, 1, 1, 'false', 'fa-comments', 'index.php?mod=blog');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (10, 'Contacto', 'contacto', 'Consultas del modulo de contacto.', 0, 0, 0, 1, 1, 'false', 'fa-map-marker', 'index.php?mod=contacto');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (11, 'Sistema', 'sys', 'Configuraci&oacute;n y administraci&oacute;n del sistema.', 1, -1, 0, 1, 1, 'false', 'fa-gear', 'index.php?mod=sys');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (12, 'Estadistica', 'estadisticas', 'Estadisticas de trafico. ', 0, -1, 0, 1, 1, 'false', 'fa-bar-chart', 'index.php?mod=estadisticas');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (13, 'Formularios', 'forms', 'Administracion de Formularios para la web.', 1, 1, 0, 0, 0, 'false', 'fa-pencil-square-o', 'index.php?mod=forms');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (14, 'Mailbox', 'mailbox', 'Mailbox de formularios', 1, 1, 0, 1, 1, 'false', ' fa-envelope', 'index.php?mod=mailbox');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (15, 'Ecommerce', 'ecommerce', 'Administraci&oacute;n y gesti&oacute;n del modulo ecommerce.', 0, 1, 0, 0, 0, 'false', 'fa-shopping-cart', 'index.php?mod=ecommerce');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (16, 'Marketing', 'marketing', '', 0, 1, 0, 0, 0, 'false', 'fa-globe', 'index.php?mod=marketing');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (17, 'Productos', 'productos', 'Administraci&oacute;n de productos', 0, 1, 0, 0, 0, 'false', 'fa-shopping-cart', 'index.php?mod=productos');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (18, 'Gmaps', 'gmaps', 'Mapas de Google', 0, 0, 0, 0, 0, 'false', 'fa-map', 'index.php?mod=gmaps');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (19, 'Chat', 'chat', 'Administración del modulo chat.', 0, 1, 0, 0, 0, 'false', 'fa-commenting', 'index.php?mod=chat');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (20, 'Directorio', 'directorio', 'Administrador del modulo de Directorio.', 0, 1, 0, 0, 0, 'false', 'fa-globe', 'index.php?mod=directorio');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (21, 'descargas', 'descargas', 'Administrador del modulo descargas', 0, 1, 0, 0, 0, 'false', 'fa-download', 'index.php?mod=descargas');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (22, 'Servicios', 'servicios', 'Administrador del modulo servicios', 0, 0, 0, 0, 0, 'false', 'fa-briefcase', 'index.php?mod=servicios');");

//TABLA: noticias
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."noticias (ID int(6) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  descripcion varchar(200) NOT NULL,
  contenido mediumtext NOT NULL,
  tag varchar(200) NOT NULL,
  autor varchar(100) NOT NULL,
  fmod varchar(21) NOT NULL,
  fecha varchar(21) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."noticias (ID, cover, titulo, descripcion, contenido, tag, autor, fmod, fecha, visible) VALUES (1, 'automatizacion.jpg', 'Tendencias en Automatización para el 2019', 'Comenzamos un nuevo año que continuará dándonos importantes avances en la digitalización de la industria. 2019 apunta a que sera un año importante en muchos aspectos pero quizás, sea el avance hacia l', '<div class=\"itemFullText\">\r\n<p>Comenzamos un nuevo a&ntilde;o que continuar&aacute; d&aacute;ndonos importantes avances en la digitalizaci&oacute;n de la industria.&nbsp; 2019 apunta a que sera un a&ntilde;o importante en muchos aspectos pero quiz&aacute;s, sea&nbsp;el avance hacia la posible estandarizaci&oacute;n de las comunicaciones industriales gracias a TSN uno de los aspectos m&aacute;s importantes.</p>\r\n<p>Las plataformas de servicios Cloud &amp; Analytics para fabricantes de maquinaria (OEMs) es un sector que empieza a tomar fuerza. En infoPLC hemos abierto un nuevo canal dedicado&nbsp;a contaros las novedades referentes a los&nbsp;<a href=\"/plataformas-servicios-cloud-oem\" rel=\"noopener noreferrer\" target=\"_blank\">servicios de plataformas</a>.</p>\r\n<p>Estas plataformas permite implementar de una manera real la industria 4.0 y sus beneficios a los fabricantes de maquinaria ya que les&nbsp;ofrece la posibilidad monitorizar y analizar su flota de m&aacute;quinas instaladas sin tener que invertir en elevados costos de implementaci&oacute;n.&nbsp;</p>\r\n<p>Las plataformas permiten conectar las m&aacute;quinas a las Nube y recopilar datos de una manera muy sencilla. EL fabricante de maquinaria puede implementar mediante Dashboards interfaces que permiten la monitorizaci&oacute;n y an&aacute;lisis de los datos pudiendo ofrecer nuevos servicios a sus clientes como por ejemplo mantenimiento predictivo.&nbsp;</p>\r\n<p>Empresas del secrtor de la automatizaci&oacute;n han creado estos servicios. <strong>Schneider Electric</strong> present&oacute; recientemente <a href=\"/noticias/item/106026-machine-advisor-datos-fabricantes-maquinaria\" rel=\"noopener noreferrer\" target=\"_blank\">Machine Advisor</a>, <strong>Rockwell</strong> ofrece la soluci&oacute;n <a href=\"/noticias/item/105248-rockwell-factorytalk-analytics-rendimiento-maquina\" rel=\"noopener noreferrer\" target=\"_blank\">FactoryTalk Analytics for Machines cloud para OEMs</a>&nbsp;y<strong> KUKA </strong>ofrece <a href=\"/noticias/item/103816-plataforma-cloud-kuka-connect\" rel=\"noopener noreferrer\" target=\"_blank\">KUKA Connect</a>, una completa&nbsp;plataforma de monitorizaci&oacute;n y an&aacute;lisis para sus robots. la compra de <strong>B&amp;R</strong> por parte de <strong>ABB</strong> empieza a dar sus frutos, una de las pimeras soluciones realizadas en conjunto es <a href=\"/noticias/item/106095-asset-performance-monitor\" rel=\"noopener noreferrer\" target=\"_blank\">Asset Performance Monitor</a>.</p>\r\n<p>Pero no solo empresas del sector cl&aacute;sicas ofrecen estos servicios, nuevas empresas esta&aacute;n aprovechando el auge de la Industria 4.0 para ofrecer nuevas soluciones, por ejemplo <strong>IXON</strong> una plataforma que ofrece conexi&oacute;n remota a m&aacute;quina VPN y <a href=\"https://www.ixon.cloud/\" rel=\"noopener noreferrer\" target=\"_blank\">servicios de&nbsp;Cloud Logging y&nbsp;Cloud Notify</a>.&nbsp;<strong>MachineMetrics</strong> es una <a href=\"https://www.machinemetrics.com\" rel=\"noopener noreferrer\" target=\"_blank\">plataforma de an&aacute;lisis de fabricaci&oacute;n</a> que aumenta la productividad a trav&eacute;s de la visibilidad en tiempo real, el an&aacute;lisis profundo y las notificaciones predictivas. Seguro que nuevas empresas ajenas actualmente al sector industrial empiezan a ofrecer soluciones y plataformas enfocadas a los OEMS y clientes finales con el fin de sacar partido a los datos de sus m&aacute;quinas.</p>\r\n<h2>&nbsp;</h2>\r\n<h2>3 #&nbsp;Robotica&nbsp;sigue creciendo</h2>\r\n<p><img src=\"/files/imagenes/noticias/2019/106084_03.jpg\" alt=\"\" /></p>\r\n<p>El&nbsp;desarrollo constante de las tecnolog&iacute;as rob&oacute;ticas sin duda ha ampliado las aplicaciones potenciales para robots industriales inteligentes. De este modo, hoy en d&iacute;a, los robots impulsados por software de vanguardia y sistemas de visi&oacute;n pueden programarse para realizar una serie de tareas, que se ajustan perfectamente a la demanda de fabricaci&oacute;n flexible.</p>\r\n<p>Hoy en d&iacute;a, la realidad aumentada (AR) y la realidad virtual (VR) se utilizan en varios contextos, desde las aplicaciones del consumidor hasta la fabricaci&oacute;n. Sin embargo, es en este &uacute;ltimo que AR ofrece un inmenso valor en innumerables formas, en combinaci&oacute;n con otras tecnolog&iacute;as. De hecho, las tecnolog&iacute;as VR y AR est&aacute;n revolucionando los procesos de producci&oacute;n complejos y los desarrollos de productos.</p>\r\n<p>En el contexto de la automatizaci&oacute;n industrial y de fabricaci&oacute;n, la VR puede ayudar a los fabricantes a simular un producto o entorno digitalmente. De este modo, permiti&eacute;ndoles interactuar y sumergirse en &eacute;l. AR ayuda a los usuarios industriales a proyectar productos digitales o informaci&oacute;n en un entorno del mundo real. Esto es m&aacute;s productivo que proyectar en un entorno simulado digitalmente como en la realidad virtual.</p>\r\n<h2>&nbsp;</h2>\r\n<h2>7 #&nbsp;Ciberseguridad</h2>\r\n<p><img src=\"/files/imagenes/noticias/2019/106084_07.jpg\" alt=\"\" /></p>\r\n<p>A nuestro entender es el gran reto para el despliegue de la Industria 4.0.&nbsp;Ya existen est&aacute;ndares para la ciberseguridad industrial y en la mayor&iacute;a de las industrias, estos son voluntarios. Dicho esto, existe una tendencia mundial para la regulaci&oacute;n gubernamental. Ya hemos visto esto en las regulaciones de los sistemas de seguridad industrial. Desafortunadamente, en lugar de un esfuerzo estandarizado, existen m&uacute;ltiples iniciativas en el mundo con diferentes objetivos y, en &uacute;ltima instancia, diferentes est&aacute;ndares.</p>\r\n<p>El <a href=\"/plus-plus/tecnologia/item/105937-nuevo-estandar-isa-reducir-vulnerabilidades\" rel=\"noopener noreferrer\" target=\"_blank\">nuevo&nbsp;est&aacute;ndar ISA/IEC 62443-4-2-2018</a>&nbsp;de la serie SA/IEC 62443&nbsp;persigue blindar los procesos de adquisici&oacute;n e integraci&oacute;n de ordenadores, aplicaciones, equipos de red y dispositivos de control que constituyen un sistema de control.</p>\r\n<p>Las soluciones avanzadas de ciberseguridad industrial disponibles en la actualidad tienen un enfoque h&iacute;brido muy efectivo. Adem&aacute;s, esto incluye tanto la detecci&oacute;n de anomal&iacute;as basada en el comportamiento que ayuda a identificar posibles amenazas cibern&eacute;ticas que utilizan enfoques de ciberseguridad convencionales, como el an&aacute;lisis basado en reglas que permite a los fabricantes aprovechar una inspecci&oacute;n profunda para descubrir ciberataques de malware en la red.</p>\r\n<p>Pero como hemos visto en numerosas ocasiones \"los malos siempre van por delante\" y la industria deber de estar preparada e invertir en Ciberseguridad. Las empresas industriales este a&ntilde;o han seguido dando muestras de tomarse en serio la Ciberseguridad,&nbsp;<strong>Moxa y Trend Micro</strong> crean una joint venture,&nbsp; <a href=\"/plus-plus/empresas/item/105972-moxa-y-trend-micro-crean-una-joint-venture\" rel=\"noopener noreferrer\" target=\"_blank\">TXOne Networks</a> se centrar&aacute; en la construcci&oacute;n de pasarelas de seguridad.&nbsp;<strong>ForeScout y Belden</strong> se unen para <a href=\"/plus-plus/empresas/item/105951-forescout-belden-alianza-entornos-industriales\" rel=\"noopener noreferrer\" target=\"_blank\">proteger los entornos industriales</a>.&nbsp;<strong>Honeywell</strong> present&oacute; nuevos servicios de Ciberseguridad Industrial.</p>\r\n<p>Puedes estar al d&iacute;a de todas las noticias sobre <a href=\"/ciberseguridad-industrial\" rel=\"noopener noreferrer\" target=\"_blank\">Ciberseguridad Industrial en nuestro portal</a></p>\r\n<h2>&nbsp;</h2>\r\n<h2>8 #&nbsp;Open Source Code</h2>\r\n<p><img src=\"/files/imagenes/noticias/2019/106084_08.jpg\" alt=\"\" /></p>\r\n<p>Los ecosistemas abiertos permiten la interoperabilidad de m&uacute;ltiples proveedores en todos los niveles de la arquitectura del sistema, al tiempo que simplifican la integraci&oacute;n. Algunos ejemplos de <strong>Open Source en la Automatizaci&oacute;n Industrial</strong>.<br /><br />OPC UA es una plataforma de c&oacute;digo abierto, una arquitectura independiente orientada a servicios. <strong>OPC UA</strong> integra toda la funcionalidad de las especificaciones de OPC Classic y un n&uacute;mero creciente de otros modelos de datos de c&oacute;digo abierto, como MTConnect y FDT, en un marco extensible.</p>\r\n<p>El software de c&oacute;digo abierto <strong>Node-RED</strong> es un entorno de programaci&oacute;n para crear y ejecutar aplicaciones visualmente, esta tecnolog&iacute;a est&aacute; siendo utilizada por una cantidad de proveedores. Estamos viendo como mucho IoT Box o IoT Gateway lo est&aacute;n utilizando&nbsp;para subir datos de m&aacute;quinas a la nube.</p>\r\n<p>Algunos proveedores incluyen nombres como, por ejemplo, Opto 22, Hilscher, Harting, NEXCOM, Siemens,&nbsp;veremos como&nbsp;<strong>Node-RED cada vez est&aacute; m&aacute;s integrado en la automatizaci&oacute;n industrial.</strong></p>\r\n</div>', 'automatizacion, tendencias', 'admin', '2019-08-22 20:57:28', '2017-01-18 14:05:23', 1);");

//TABLA: noticias
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."noticias_coment (ID int(6) unsigned NOT NULL auto_increment,
  ip varchar(18) NOT NULL,
  nombre varchar(100) NOT NULL,
  email varchar(50) NOT NULL,
  comentario varchar(500) NOT NULL,
  id_b int(3) NOT NULL,
  fecha varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."noticias_coment (ID, ip, nombre, email, comentario, id_b, fecha, visible) VALUES (1, '127.0.0.1', 'Guillermo Jim&eacute;nez L&oacute;pez', 'mherco@hotmail.com', 'Mensaje de prueba para noticias', 1, '2018-12-21 22:14:55', 1);");

//TABLA: notificacion
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."notificacion (ID int(11) unsigned NOT NULL auto_increment,
  ID_user int(11) NOT NULL,
  ID_user2 int(11) NOT NULL,
  nombre_envio varchar(255) NOT NULL,
  mensaje mediumtext NOT NULL,
  visto tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  fecha varchar(22) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."notificacion (ID, ID_user, ID_user2, nombre_envio, mensaje, visto, activo, fecha) VALUES (1, 1, 1, 'admin', 'Su sistema PHPONIX ha sido actualizado.', 1, 1, '2021-06-27 23:09:38');");

//TABLA: opciones
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."opciones (ID int(6) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  descripcion mediumtext NOT NULL,
  valor varchar(50) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (1, 'google_analytics', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (2, 'form_registro', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (3, 'geo_loc_visitas', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (4, 'slide_active', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (5, 'API_facebook', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (6, 'API_google_maps', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (7, 'api_noti_chrome', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (8, 'link_var', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (9, 'link_productos', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (10, 'tiny_text_des', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (11, 'email_test', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (12, 'skin_AdminLTE', '', 'blue');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (13, 'mini_bar_AdminLTE', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (14, 'wordpress', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (15, 'bar_login', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (16, 'bar_productos', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (17, 'toogle_nombre', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (18, 'mostrar_precio', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (19, 'mostrar_nombre', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (20, 'mostrar_des_corta', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (21, 'mostrar_des', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (22, 'mostrar_galeria', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (23, 'b_vista_rapida', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (24, 'b_ver_pro', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (25, 'b_cotizar', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (26, 'b_cart', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (27, 'b_paypal', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (28, 'blog_coment', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (29, 'noticias_coment', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (30, 'cursos_coment', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (31, 'productos_coment', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (32, 'all_productos', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (33, 'e_rates', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (34, 'footer_dir', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (35, 'validacion_json', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (36, 'url_var_json', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (37, 'VUE2', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (38, 'api_social_chat', 'Chat de redes sociales', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (39, 'AJAX', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (40, 'api_icon', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (41, 'web_style', '', '1');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (42, 'api_WPA', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (43, 'ssl', '', '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES (44, 'demo', '', '0');");

//TABLA: pages
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."pages (ID int(6) unsigned NOT NULL auto_increment,
  titulo varchar(100) NOT NULL,
  contenido mediumtext NOT NULL,
  modulo varchar(50) NOT NULL,
  tema varchar(50) NOT NULL,
  ext varchar(50) NOT NULL,
  url varchar(250) NOT NULL,
  fmod varchar(20) NOT NULL,
  alta varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."pages (ID, titulo, contenido, modulo, tema, ext, url, fmod, alta, visible, activo) VALUES (1, 'Nosotros 1', '<p style=\"text-align: center;\"><span style=\"font-size: 16px;\"><strong><br /></strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 16px;\"><strong>Nosotros</strong></span></p>', 'nosotros', '', '', '', '', '', 0, 1);");

//TABLA: portafolio
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."portafolio (ID int(6) unsigned NOT NULL auto_increment,
  clave varchar(100) CHARACTER SET latin1 NOT NULL,
  nombre varchar(100) CHARACTER SET latin1 NOT NULL,
  cover varchar(100) CHARACTER SET latin1 NOT NULL,
  descripcion text CHARACTER SET latin1 NOT NULL,
  precio decimal(6,2) NOT NULL,
  cate varchar(50) CHARACTER SET latin1 NOT NULL,
  resena text CHARACTER SET latin1 NOT NULL,
  url_page varchar(150) CHARACTER SET latin1 NOT NULL,
  imagen1 varchar(100) CHARACTER SET latin1 NOT NULL,
  imagen2 varchar(100) CHARACTER SET latin1 NOT NULL,
  imagen3 varchar(100) CHARACTER SET latin1 NOT NULL,
  imagen4 varchar(100) CHARACTER SET latin1 NOT NULL,
  imagen5 varchar(100) CHARACTER SET latin1 NOT NULL,
  FT varchar(100) CHARACTER SET latin1 NOT NULL,
  alta varchar(21) CHARACTER SET latin1 NOT NULL,
  fmod varchar(21) CHARACTER SET latin1 NOT NULL,
  user varchar(50) CHARACTER SET latin1 NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (1, '', 'Ebook', 'ebook.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web para promocionar edecanes, modelos, fot&oacute;grafos, escuelas y agencias relacionadas con la imagen y belleza para eventos.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>5 secciones</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>', '0.00', 'Web_Page', '', 'http://ebook.webcindario.com', 'ebook.jpg', '', '', '', '', 'Mayo, 2016', '2018-01-07 21:10:52', '2021-02-09 02:34:05', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (2, '', 'Trafisa', 'trafisa.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para <strong>Trafisa</strong>&nbsp;empresa dedicada a la venta de transportadores industriales.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One page</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>', '0.00', 'One_Page', '', 'http://trafisa.com.mx/', 'trafisa.jpg', '', '', '', '', 'Junio, 2016', '2018-08-18 01:47:56', '2021-03-25 05:20:46', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (3, '', 'Belcon', 'belcon.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Belcon</strong>&nbsp;empresa dedicada a la venta de transportadores industriales.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>One Page</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'One_Page', '', 'http://belcon.com.mx/', 'belcon.jpg', '', '', '', '', 'Julio, 2016', '2018-08-18 01:52:11', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (4, '', 'Decatalogo', 'decatalogo.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web&nbsp;<strong>Decatalogo</strong>&nbsp;desarrollada para la venta de catalogos de ropa en linea.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>One Page</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:]</p>\n</li>\n</ul>', '0.00', 'One_Page', '', 'https://decatalogo.webcindario.com/', 'decatalogo.jpg', '', '', '', '', 'Mayo, 2017', '2018-08-18 01:53:12', '2021-03-30 19:04:23', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (5, '', 'Key Agencia Digital', 'keyagenciadigital.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Key Agencia Digital</strong>&nbsp;empresa dedicada a la publicidad digital e impresa, marketing digital, desarrollo de p&aacute;ginas web y posicionamiento web.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>One Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>3 page, contacto y landingpage</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en Wordpress y PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'One_Page', '', 'http://keyagenciadigital.com/', 'keyagenciadigital.jpg', '', '', '', '', 'Julio, 2017', '2018-08-19 19:59:44', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (6, '', 'Samsung Healthcare', 'samsunghealthcare.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Samsung Healthcare</strong>&nbsp;empresa i<span>mportadora, distribuidora e integradora de equipo y mobiliario m&eacute;dico y hospitalario</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>4 secciones, productos y buscador</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>', '0.00', 'Web_Page', '', 'http://samsung-healthcare.mx/', 'samsunghealthcare.jpg', '', '', '', '', 'Febrero, 2018', '2018-08-19 20:05:55', '2021-02-05 03:50:27', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (7, '', 'HM Soldaduras Industriales', 'hmsoldadurasindustriales.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>HM Soldaduras Industriales</strong>&nbsp;empresa dedicada a la venta de todo el material para soldar desde soldaduras especiales, gases industriales, abrasivos s&oacute;lidos, m&aacute;quinas de soldar, consumibles y equipo de seguridad.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>6 secciones, productos y buscador</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>', '0.00', 'Web_Page', '', 'http://hmsoldadurasindustriales.com/', 'hmsoldadurasindustriales.jpg', '', '', '', '', 'Mayo, 2018', '2018-08-19 20:09:03', '2021-02-05 03:58:46', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (8, '', 'Estpro', 'estpro.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina web&nbsp;<span><strong>Estpro Ambiental, S.A. de C.V.</strong> empresa dedicada a</span>&nbsp;<span>Sistemas de Gesti&oacute;n Ambiental Seguridad e Higiene para la Industria</span>.</div>\n<div class=\"post-gap-small\">&nbsp;</div>\n</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\n<li><em class=\"fa fa-check-circle\"></em>5 secciones</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\n</li>\n<li>\n<h5>Desarrollado por:</h5>\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\n</li>\n</ul>', '0.00', 'Web_Page', '', 'http://estproambiental.com.mx/', 'estpro.jpg', '', '', '', '', 'Julio, 2018', '2018-08-19 20:13:00', '2021-02-05 03:19:26', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (9, '', 'Fasco Infra Sistemas', 'fasco.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para la Empresa <strong>Fasco Infra Sistemas</strong> dedicada a la venta de telecomunicaciones y fibra &oacute;ptica.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>5 secciones, productos</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'Web_Page', '', 'http://fascoinfrasistema.com.mx/', 'fasco.jpg', '', '', '', '', 'Septiembre, 2018', '2018-08-19 20:15:29', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (10, '', 'ImprezaColor', 'Imprezacolor.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>ImprezaColor</strong>&nbsp;empresa dedicada a la publicidad e imprenta digital.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>One Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'One_Page', '', 'http://imprezacolor.mx', 'Imprezacolor.jpg', '', '', '', '', 'Marzo, 2019', '2019-06-16 23:05:13', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (11, '', 'Fibrecen', 'Fibrecen.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Fibrecen</strong>&nbsp;empresa dedicada a la <span>venta de materiales como resinas, fibras de vidrio, gel coats, etc</span>.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li>Buscador de productos</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li>Chat de Whatsapp</li>\r\n<li>API de Facebook y Youtube</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'Web_Page', '', 'http://fibrecen.com.mx', 'Fibrecen.jpg', '', '', '', '', 'Febrero, 2019', '2019-06-16 23:05:13', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (12, '', 'Ceo-Tech', 'ceo-tech.png', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">&nbsp;P&aacute;gina web desarrollada para la Empresa Ceo Tech dedicada <span>a proyectos de automatizaci&oacute;n</span>.</div>\r\n</div>\r\n<div class=\"post-gap\">&nbsp;</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>6 secciones</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'Web_Page', '', 'http://ceo-tech.com.mx/', 'ceo-tech.png', '', '', '', '', 'Julio, 2019', '2019-08-12 05:46:19', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (13, '', 'Percco', 'percco.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Percco</strong><span>&nbsp;una empresa que ofrece Fabricaci&oacute;n de l&iacute;neas de Pintura Electr&oacute;statica, Maquila de Pintura Electr&oacute;statica, Instalaci&oacute;n de Sistemas Contraincendios, Fabricaci&oacute;n de Naves Industriales, Transportadores Industriales as&iacute; como un Proceso de Manufactura; Soldadura, Corte y Doblez. Ofrecemos Mantenimiento y Refacciones.</span>.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, <strong>Ajax</strong>, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'Web_Page', '', 'http://percco.com', 'percco.jpg', '', '', '', '', 'Marzo, 2019', '2019-06-16 23:05:13', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (14, '', 'Century21 ekodesar', 'century21.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n<p>Landingpage desarrollado para <strong>Century21 ekodesar</strong> para campa&ntilde;a promocional de residencias y terrenos.</p>\r\n</div>\r\n<div class=\"post-gap\">&nbsp;</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>LandingPage</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Secciones con Banner, Formulario de registro, productos y pie de pagina de contacto&nbsp;</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Boton de Whatsapp</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, Javascript, Jquery, ajax y HTML5.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] y Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'LandingPage', '', 'http://century21ekodesar.com', 'century21.jpg', '', '', '', '', 'Octubre, 2019', '2019-10-15 06:02:50', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (15, '', 'Tramites Estpro', 'TramitesEstpro.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n<p>Landingpage desarrollado para <strong>Tramites Estpro</strong> para campa&ntilde;a promocional de tramites legales.</p>\r\n</div>\r\n<div class=\"post-gap\">&nbsp;</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>LandingPage</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Secciones con Banner, Formulario de registro, productos y pie de pagina de contacto&nbsp;</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Boton de Whatsapp</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, Javascript, Jquery, ajax y HTML5.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] y Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'LandingPage', '', 'http://tramites.estproambiental.com.mx/', 'TramitesEstpro.jpg', '', '', '', '', 'Diciembre, 2019', '2021-01-19 01:24:06', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (16, '', 'dgoba', 'Dgoba.jpg', '<div class=\"post-content m-t-sm\">\r\n<div class=\"post-gap-small\">P&aacute;gina web desarrollada para&nbsp;<strong>Goba</strong>&nbsp;empresa <span>importadora, distribuidora e integradora de equipo y mobiliario m&eacute;dico y hospitalario</span>.</div>\r\n<div class=\"post-gap-small\">&nbsp;</div>\r\n</div>\r\n<ul class=\"portfolio-details\">\r\n<li>\r\n<h5>Caracterisiticas</h5>\r\n<ul class=\"list list-skills icons list-unstyled list-inline\">\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web</li>\r\n<li><em class=\"fa fa-check-circle\"></em>3 secciones: Home, productos y contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Responsiva</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Formulario de contacto</li>\r\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina administrable con panel AdminLTE</li>\r\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada en PHPONIX-CRM</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<h5>Tecnologias</h5>\r\n<p>PHP, MySQL, Bootstrap, JSON, Ajax, Javascript y Jquery.</p>\r\n</li>\r\n<li>\r\n<h5>Desarrollado por:</h5>\r\n<p>[:MULTIPORTAL:] &amp; Key Agencia Digital</p>\r\n</li>\r\n</ul>', '0.00', 'Web_Page', '', 'https://www.dgoba.com/', 'Dgoba.jpg', '', '', '', '', 'Junio, 2020', '2021-01-20 05:07:42', '', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (17, '', 'Tienda Solein', 'TiendaSolein.jpg', '<div class=\"post-content m-t-sm\">\n<div class=\"post-gap-small\">P&aacute;gina desarrollada para venta en linea de productos para la construcci&oacute;n.</div>\n</div>\n<div class=\"post-gap\">&nbsp;</div>\n<ul class=\"portfolio-details\">\n<li>\n<h5>Caracterisiticas</h5>\n<ul class=\"list list-skills icons list-unstyled list-inline\">\n<li><em class=\"fa fa-check-circle\"></em>P&aacute;gina Web Ecommerce</li>\n<li><em class=\"fa fa-check-circle\"></em>Secciones Home, productos, blog y contacto</li>\n<li><em class=\"fa fa-check-circle\"></em>Responsive</li>\n<li><em class=\"fa fa-check-circle\"></em>Registro de usuarios para compra en linea</li>\n<li><em class=\"fa fa-check-circle\"></em>Desarrollada con Wordpress y Woocommerce</li>\n<li><em class=\"fa fa-check-circle\"></em>Pagos a trav&eacute;s de PayPal</li>\n</ul>\n</li>\n<li>\n<h5>Tecnologias</h5>\n<p>Wordpress, Woocommerce, PHP, MySQL, javascript.</p>\n</li>\n<li>\n<h5>Desarrollado&nbsp; para:</h5>\n<p>Dood</p>\n</li>\n</ul>', '0.00', 'Ecommerce', '', '#', 'TiendaSolein2.jpg', '', '', '', '', 'Septiembre, 2020', '2021-01-20 20:46:09', '2021-02-05 03:59:20', 'admin', 1);");

//TABLA: productos
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."productos (ID int(9) unsigned NOT NULL auto_increment,
  codigo varchar(100) NOT NULL,
  clave varchar(100) NOT NULL,
  nombre varchar(100) NOT NULL,
  titulo varchar(150) NOT NULL,
  cover varchar(100) NOT NULL,
  foto varchar(100) NOT NULL,
  descripcion mediumtext NOT NULL,
  marca varchar(150) NOT NULL,
  modelo varchar(100) NOT NULL,
  tipo varchar(100) NOT NULL,
  precio decimal(9,2) NOT NULL,
  moneda varchar(10) NOT NULL,
  unidad varchar(10) NOT NULL,
  peso varchar(50) NOT NULL,
  color varchar(50) NOT NULL,
  medidas varchar(100) NOT NULL,
  stock int(6) NOT NULL,
  serie varchar(100) NOT NULL,
  lote varchar(100) NOT NULL,
  ID_cate int(6) NOT NULL,
  ID_sub_cate int(6) NOT NULL,
  ID_sub_cate2 int(6) NOT NULL,
  ID_marca int(6) NOT NULL,
  url_name varchar(150) NOT NULL,
  imagen1 varchar(100) NOT NULL,
  imagen2 varchar(100) NOT NULL,
  imagen3 varchar(100) NOT NULL,
  imagen4 varchar(100) NOT NULL,
  imagen5 varchar(100) NOT NULL,
  cate varchar(100) NOT NULL,
  resena mediumtext NOT NULL,
  nuevo tinyint(1) NOT NULL,
  promo tinyint(1) NOT NULL,
  descuento varchar(100) NOT NULL,
  clasificacion varchar(200) NOT NULL,
  tags varchar(200) NOT NULL,
  land tinyint(1) NOT NULL,
  file varchar(100) NOT NULL,
  pdf1 varchar(100) NOT NULL,
  pdf2 varchar(100) NOT NULL,
  pdf3 varchar(100) NOT NULL,
  pdf4 varchar(100) NOT NULL,
  pdf5 varchar(100) NOT NULL,
  alta varchar(21) NOT NULL,
  fmod varchar(21) NOT NULL,
  user varchar(50) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (1, '01010127', '01010127', 'Máquina embisagradora', '', 'nodisponible.jpg', '', '', '', '', '', '125215.50', 'MXN', 'PZ', '', '', '', 0, '', '', 1, 1, 0, 0, '', 'nodisponible.jpg', 'nodisponible.jpg', '', '', '', 'Maquinaria y herramientas', '', 0, 0, '', '', '', 0, '', '', '', '', '', '', '2019-01-14 11:49:53', '2021-03-06 23:57:34', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (2, '01010128', '01010128', 'Máquina embisagradora con broca', '', 'nodisponible.jpg', '', '<p>Haz crecer tu empresa con herramientas de calidad, funcionales y de manejo f&aacute;cil. Descubre todo lo que tenemos para ti</p>\n<p><br /><span>CARACTER&Iacute;STICAS</span></p>\n<table border=\"0\">\n<tbody>\n<tr>\n<td>C&oacute;digo</td>\n<td>01010128</td>\n</tr>\n<tr>\n<td>UM</td>\n<td>pz</td>\n</tr>\n<tr>\n<td>Material</td>\n<td>Acero</td>\n</tr>\n<tr>\n<td>Acabados</td>\n<td>Azul con naranja</td>\n</tr>\n<tr>\n<td>Medida</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p class=\"sbit_caract100\">Alimentaci&oacute;n el&eacute;ctrica de 127V. Ideal para bisagras FGV, SALICE y ECO, Regleta con ajuste (K) 2mm a 12mm, profundidad m&aacute;xima de perforaci&oacute;n 60mm. Descarga la ficha t&eacute;cnica para conocer m&aacute;s de esta maquina.</p>', '', '', '', '19033.00', 'MXN', 'PZ', '', '', '', 0, '', '', 1, 1, 0, 0, '', 'nodisponible.jpg', '', '', '', '', 'Maquinaria y herramientas', 'Descripción Corta', 0, 0, '', '', '', 0, '', '', '', '', '', '', '2019-01-16 07:54:05', '2021-02-26 00:00:09', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (3, '01020025', '01020025', 'Punta phillips no.2', '', 'nodisponible.jpg', '', '<p>Optimiza tus ensambles con las puntas que tenemos para ti</p>\n<p><br /><span>CARACTER&Iacute;STICAS</span></p>\n<table border=\"0\">\n<tbody>\n<tr>\n<td>C&oacute;digo</td>\n<td>01020025</td>\n</tr>\n<tr>\n<td>UM</td>\n<td>PZA</td>\n</tr>\n<tr>\n<td>Material</td>\n<td>Acero</td>\n</tr>\n<tr>\n<td>Acabados</td>\n<td>Satinado</td>\n</tr>\n<tr>\n<td>Medida</td>\n<td>51mm</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p class=\"sbit_caract100\">Punta de cruz que permite utilizarlo en la mayoria de torniller&iacute;a.</p>', '', '', '', '10.50', 'MXN', 'PZ', '', '', '', 0, '', '', 1, 2, 0, 0, '', 'nodisponible.jpg', '', '', '', '', 'Maquinaria y herramientas', 'Descripción corta', 0, 0, '', '', '', 0, '', '', '', '', '', '', '2019-01-16 12:55:21', '2021-02-25 23:59:19', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (4, '08030264', '08030264', 'Manija de baño', '', 'pro1.1.png', '', '<p><strong>Lorem Ipsum</strong><span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</span></p>', 'Elco', 'Modelo rectángular-liso satinado', '', '30.00', 'MXN', 'PZ', '', '', '', 0, '', '', 10, 36, 0, 9, '', 'Manijas.png', '', '', '', '', 'Chapas y cerraduras', 'Descripción corta', 1, 0, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 09:02:06', '2021-03-25 03:35:51', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (5, '08030273', '08030273', 'Manija de entrada modelo bola llave/mariposa Inox', '', 'pro1.2.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 10, 32, 0, 0, '', 'pro1.2.png', '', '', '', '', 'Chapas y cerraduras', '', 1, 0, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 09:11:21', '2021-02-25 23:09:05', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (6, '08050037', '08050037', 'Tope magnético para puerta', '', 'pro1.3.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 10, 33, 0, 0, '', 'pro1.3.png', '', '', '', '', 'Chapas y cerraduras', '', 1, 0, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 09:13:35', '2021-02-25 23:10:55', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (7, '08080001', '08080001', 'Corredizo colgante inos 304 p/puerta de madera L=200mm Rodamiento sencillo', '', 'pro1.4.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 3, 14, 0, 0, '', 'pro1.4.png', '', '', '', '', 'Correderas', '', 1, 0, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 09:16:17', '2021-02-25 23:08:29', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (8, '08080003', '08080003', 'Corredizo colgante inox 304 p/puerta de cristal L=200mm Rodamiento sencillo', '', 'pro1.5.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 3, 12, 0, 0, '', 'pro1.5.png', '', '', '', '', 'Correderas', '', 1, 0, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 09:18:53', '2021-02-25 23:07:46', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (9, '12130050', '12130050', 'Dispensador doble para baño', '', 'pro2.1.png', '', '<p>Descripcion</p>', '', '', '', '1.00', 'MXN', 'PZ', '', '', '', 0, '', '', 12, 44, 0, 0, '', 'pro2.1.png', '', '', '', '', 'Accesorios de cocina y baño', '', 0, 1, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 12:17:14', '2021-02-25 23:04:52', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (10, '12130058', '12130058', 'Dispensador de jabón para baño', '', 'pro2.2.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 12, 44, 0, 0, '', 'pro2.2.png', '', '', '', '', 'Accesorios de cocina y baño', '', 0, 1, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 12:31:20', '2021-02-25 23:05:49', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (11, '12130040', '12130040', 'Toallero doble 616mm Latón Cromado', '', 'pro2.3.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 12, 44, 0, 0, '', 'pro2.3.png', '', '', '', '', 'Accesorios de cocina y baño', '', 0, 1, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 12:33:08', '2021-02-25 23:06:26', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (ID, codigo, clave, nombre, titulo, cover, foto, descripcion, marca, modelo, tipo, precio, moneda, unidad, peso, color, medidas, stock, serie, lote, ID_cate, ID_sub_cate, ID_sub_cate2, ID_marca, url_name, imagen1, imagen2, imagen3, imagen4, imagen5, cate, resena, nuevo, promo, descuento, clasificacion, tags, land, file, pdf1, pdf2, pdf3, pdf4, pdf5, alta, fmod, user, visible) VALUES (12, '12130043', '12130043', 'Cepillero base rect. c/vaso de cristal latón cromado', '', 'pro2.4.png', '', '<p>Descripcion</p>', '', '', '', '0.00', 'MXN', 'PZ', '', '', '', 0, '', '', 12, 44, 0, 0, '', 'pro2.4.png', '', '', '', '', 'Accesorios de cocina y baño', '', 0, 1, '', '', '', 0, '', '', '', '', '', '', '2019-02-08 12:34:48', '2021-02-25 23:07:04', 'admin', 1);");
   
//TABLA: promociones
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."promociones (ID int(6) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  cate varchar(100) NOT NULL,
  alta varchar(25) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (1, 'p1.png', 'Promociones Bimestrales', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (2, 'p2.png', 'Promociones Bimestrales', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (3, 'p3.png', 'Nuevos Productos', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (4, 'p4.png', 'Nuevos Productos', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (5, 'p5.png', 'Nuevos Productos', '', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."promociones (ID, nom, cate, alta, visible) VALUES (6, 'p6.png', 'Nuevos Productos', '', 1);");

//TABLA: registros
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."registros (ID int(9) unsigned NOT NULL auto_increment,
  ip varchar(25) NOT NULL,
  nombre varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  para varchar(50) NOT NULL,
  de varchar(50) NOT NULL,
  tel varchar(20) NOT NULL,
  titulo varchar(200) NOT NULL,
  asunto varchar(150) NOT NULL,
  msj mediumtext NOT NULL,
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  cat_list varchar(50) NOT NULL,
  seccion varchar(50) NOT NULL,
  tabla varchar(50) NOT NULL,
  adjuntos mediumtext NOT NULL,
  visto tinyint(1) NOT NULL,
  status int(11) NOT NULL,
  ID_login int(11) NOT NULL,
  ID_user int(11) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."registros () VALUES ();");

//TABLA: servicios
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."servicios (ID int(6) unsigned NOT NULL auto_increment,
clave varchar(100) CHARACTER SET latin1 NOT NULL,
nombre varchar(100) CHARACTER SET latin1 NOT NULL,
cover varchar(100) CHARACTER SET latin1 NOT NULL,
descripcion text CHARACTER SET latin1 NOT NULL,
precio decimal(6,2) NOT NULL,
cate varchar(50) CHARACTER SET latin1 NOT NULL,
resena text CHARACTER SET latin1 NOT NULL,
url_page varchar(150) CHARACTER SET latin1 NOT NULL,
imagen1 varchar(100) CHARACTER SET latin1 NOT NULL,
imagen2 varchar(100) CHARACTER SET latin1 NOT NULL,
imagen3 varchar(100) CHARACTER SET latin1 NOT NULL,
imagen4 varchar(100) CHARACTER SET latin1 NOT NULL,
imagen5 varchar(100) CHARACTER SET latin1 NOT NULL,
FT varchar(100) CHARACTER SET latin1 NOT NULL,
alta varchar(21) CHARACTER SET latin1 NOT NULL,
fmod varchar(21) CHARACTER SET latin1 NOT NULL,
user varchar(50) CHARACTER SET latin1 NOT NULL,
visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."servicios (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (1, '', 'Hornos de Curado', 'horno.jpg', '<p><span>Fabricamos y dise&ntilde;amos Hornos Hornos Continuos de Curado tipo Batch, Hornos Infrarojos y Hornos Ultravioleta.</span></p>', '0.00', 'Fabricación de Líneas de Pintura', '', '', 'horno.jpg', '', '', '', '', '', '2021-02-03 03:18:53', '2021-02-05 04:25:28', 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."servicios (ID, clave, nombre, cover, descripcion, precio, cate, resena, url_page, imagen1, imagen2, imagen3, imagen4, imagen5, FT, alta, fmod, user, visible) VALUES (2, '', 'Cabinas para pintura en Polvo', 'cabina.jpg', '<p><span>Producimos Continuas y de Batch, as&iacute; como cabinas portatiles en diferentes tama&ntilde;os y dise&ntilde;os.</span></p>', '0.00', 'Fabricación de Líneas de Pintura', '', '', '', '', '', '', '', '', '2021-02-03 03:23:32', '2021-03-30 21:07:03', 'admin', 1);");

//TABLA: signup
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."signup (ID int(9) unsigned NOT NULL auto_increment,
  username varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  level varchar(2) NOT NULL,
  lastlogin datetime NOT NULL,
  tema varchar(100) NOT NULL,
  nombre varchar(100) NOT NULL,
  apaterno varchar(100) NOT NULL,
  amaterno varchar(100) NOT NULL,
  foto varchar(100) NOT NULL,
  cover varchar(100) NOT NULL,
  tel varchar(100) NOT NULL,
  ext int(4) NOT NULL,
  fnac date NOT NULL,
  fb varchar(100) NOT NULL,
  tw varchar(100) NOT NULL,
  puesto varchar(100) NOT NULL,
  ndepa int(1) NOT NULL,
  depa varchar(100) NOT NULL,
  empresa varchar(100) NOT NULL,
  adress varchar(100) NOT NULL,
  direccion varchar(100) NOT NULL,
  mpio varchar(100) NOT NULL,
  edo varchar(100) NOT NULL,
  pais varchar(50) NOT NULL,
  genero varchar(20) NOT NULL,
  exp varchar(1000) NOT NULL,
  likes int(6) NOT NULL,
  filtro varchar(50) NOT NULL,
  zona varchar(50) NOT NULL,
  alta varchar(20) NOT NULL,
  actualizacion varchar(100) NOT NULL,
  page varchar(250) NOT NULL,
  nivel_oper int(2) NOT NULL,
  rol int(2) NOT NULL,
  codigo varchar(6) NOT NULL,
  intentos varchar(2) NOT NULL,
  status varchar(50) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (ID, username, password, email, level, lastlogin, tema, nombre, apaterno, amaterno, foto, cover, tel, ext, fnac, fb, tw, puesto, ndepa, depa, empresa, adress, direccion, mpio, edo, pais, genero, exp, likes, filtro, zona, alta, actualizacion, page, nivel_oper, rol, codigo, intentos, status, activo) VALUES (1, 'admin', 'c64f923f7f476f0b78716079452e7bdec4b2c016', 'multiportal@outlook.com', '-1', '2021-03-30 11:03:29', 'default', 'Guillermo', 'Jimenez', 'Lopez', 'sinfoto.png', '', '4421944950', 1, '0000-00-00', '', '', 'Programador', 0, '', 'Multiportal', '', '', '', '', '', 'M', '', 0, '0', '', '', 'admin2019xadmin79', '', 0, 0, '944950', '0', 'offline', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (ID, username, password, email, level, lastlogin, tema, nombre, apaterno, amaterno, foto, cover, tel, ext, fnac, fb, tw, puesto, ndepa, depa, empresa, adress, direccion, mpio, edo, pais, genero, exp, likes, filtro, zona, alta, actualizacion, page, nivel_oper, rol, codigo, intentos, status, activo) VALUES (2, 'demo', '71cc541bd1ccb6670de3f8d40f425ffb7315fe7f', 'demo@gmail.com', '-1', '0000-00-00 00:00:00', 'default', 'Demo', 'Apaterno', 'Amaterno', 'sinfoto.png', 'sincover.jpg', '4421234567', 0, '0000-00-00', '', '', 'Director', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'demo2019xdemo2017', '', 0, 0, '234567', '0', 'offline', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (ID, username, password, email, level, lastlogin, tema, nombre, apaterno, amaterno, foto, cover, tel, ext, fnac, fb, tw, puesto, ndepa, depa, empresa, adress, direccion, mpio, edo, pais, genero, exp, likes, filtro, zona, alta, actualizacion, page, nivel_oper, rol, codigo, intentos, status, activo) VALUES (3, 'usuario', '3c6e6ac5382f4e804e824c0d785b275252ddacb0', 'multiportal@outlook.com', '1', '0000-00-00 00:00:00', 'default', 'Usuario', 'Apaterno', 'Amaterno', 'sinfoto.png', '', '4421234567', 0, '0000-00-00', '', '', 'Usuario', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'usuario2019xuser79x', '', 0, 0, '234567', '0', 'offline', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (ID, username, password, email, level, lastlogin, tema, nombre, apaterno, amaterno, foto, cover, tel, ext, fnac, fb, tw, puesto, ndepa, depa, empresa, adress, direccion, mpio, edo, pais, genero, exp, likes, filtro, zona, alta, actualizacion, page, nivel_oper, rol, codigo, intentos, status, activo) VALUES (4, 'ventas', '1d415500d481e0c1c238189c22ea057da663c1e7', 'ventas@gmail.com', '2', '0000-00-00 00:00:00', 'default', 'Ventas', 'Apaterno', 'Amaterno', 'sinfoto.png', 'sincover.jpg', '4421234567', 0, '0000-00-00', '', '', 'Gerente', 0, '', 'PHPONIX', '', '', '', '', '', 'M', '', 0, '0', '', '', 'ventas2019xventas', '', 0, 0, '234567', '0', 'offline', 1);");

//TABLA: slider
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."slider (ID int(6) unsigned NOT NULL auto_increment,
  ima varchar(100) NOT NULL,
  tit1 varchar(200) NOT NULL,
  tit2 varchar(200) NOT NULL,
  btn_nom varchar(50) NOT NULL,
  url varchar(300) NOT NULL,
  tema_slider varchar(50) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."slider (ID, ima, tit1, tit2, btn_nom, url, tema_slider, visible) VALUES (1, 'home.jpg', 'Slider1', '', 'Boton', '', 'default', 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."slider (ID, ima, tit1, tit2, btn_nom, url, tema_slider, visible) VALUES (2, 'slide-bg.jpg', 'bg1', '', '', '', 'porto', 1);");

//TABLA: tareas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."tareas (ID int(11) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  descripcion varchar(250) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp () VALUES ();");

//TABLA: temas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."temas (ID int(3) unsigned NOT NULL auto_increment,
  tema varchar(100) NOT NULL,
  subtema varchar(100) NOT NULL,
  selec tinyint(1) NOT NULL,
  nivel varchar(2) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (ID, tema, subtema, selec, nivel) VALUES (1, 'default', '', 1, '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (ID, tema, subtema, selec, nivel) VALUES (2, 'phponix', '', 0, '0');");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (ID, tema, subtema, selec, nivel) VALUES (3, 'porto', '', 0, '0');");

//TABLA: testimonios
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."testimonios (ID int(9) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  pro varchar(100) NOT NULL,
  comentario mediumtext NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (ID, cover, pro, comentario, visible) VALUES (1, 'testimonial_person2.jpg', 'Ingeniera Civil', 'Super recomendado, la atenci&oacute;n es buenisima y te ayudan con cualquier duda', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (ID, cover, pro, comentario, visible) VALUES (2, 'testimonial_person1.jpg', 'Emprendedor', 'Su curso se me hizo f&aacute;cil y muy creativo, impartidos por excelentes maestros.', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (ID, cover, pro, comentario, visible) VALUES (3, 'testimonial_person3.jpg', 'Ingeniera Industrial', 'Super recomendado, la atenci&oacute;n es buenisima y te ayudan con cualquier duda.', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (ID, cover, pro, comentario, visible) VALUES (4, 'TESTIMONIO01.png', 'Emprendedor', 'Excelente curso introducci&oacute;n a los materiales compuestos, muchas gracias.', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (ID, cover, pro, comentario, visible) VALUES (5, 'testimonio02.png', 'Emprendedor', 'Excelente curso de Mesas Ep&oacute;xicas en Parota y Cristal Templado.  &iexcl;No dejen pasar la oportunidad de tomar este curso!', 1);");

//TABLA: token
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."token (ID int(9) unsigned NOT NULL auto_increment,
  ID_user int(6) NOT NULL,
  Token varchar(100) NOT NULL,
  Estado varchar(20) NOT NULL,
  Fecha varchar(22) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
  //$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."token (ID,ID_user,Token,Estado,Fecha) VALUES ();");

//TABLA: vcard
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."vcard (ID int(11) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  profile varchar(100) NOT NULL,
  logo varchar(100) NOT NULL,
  nombre varchar(150) NOT NULL,
  descripcion varchar(250) NOT NULL,
  puesto varchar(100) NOT NULL,
  empresa varchar(100) NOT NULL,
  tel varchar(50) NOT NULL,
  tel_ofi varchar(50) NOT NULL,
  cell varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  web varchar(100) NOT NULL,
  fb varchar(150) NOT NULL,
  tw varchar(150) NOT NULL,
  lk varchar(150) NOT NULL,
  ins varchar(150) NOT NULL,
  f_create varchar(20) NOT NULL,
  f_update varchar(20) NOT NULL,
  vcard tinyint(1) NOT NULL,
  ID_user int(11) NOT NULL,
  user varchar(50) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard (ID, cover, profile, logo, nombre, descripcion, puesto, empresa, tel, tel_ofi, cell, email, web, fb, tw, lk, ins, f_create, f_update, vcard, ID_user, user, visible) VALUES (1, 'foto.png', 'rforesta', '', 'Rodrigo Foresta', '', 'Manager', 'Billnex', '', '', '+54 9 3534 19 6770', 'rodrigo.foresta@thebillnex.com', 'https://www.thebillnex.com', '', '', '#', 'https://www.instagram.com/billnex', '19/08/2020 10:38', '07/09/2020 19:13', 1, 1, 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard (ID, cover, profile, logo, nombre, descripcion, puesto, empresa, tel, tel_ofi, cell, email, web, fb, tw, lk, ins, f_create, f_update, vcard, ID_user, user, visible) VALUES (2, 'foto.png', 'jparra', '', 'Juan Parra', '', 'Manager', 'Billnex', '', '', '+1(754)210-0433', 'juan.parra@thebillnex.com', 'https://www.thebillnex.com', '', '', '#', 'https://www.instagram.com/billnex', '22/08/2020 17:04', '11/09/2020 21:03', 1, 1, 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard (ID, cover, profile, logo, nombre, descripcion, puesto, empresa, tel, tel_ofi, cell, email, web, fb, tw, lk, ins, f_create, f_update, vcard, ID_user, user, visible) VALUES (3, 'foto_capital.png', 'dmiranda', '', 'Daniel Miranda Mejia', '', 'Manager', 'Capital', '', '', '442 104 6067', 'dmiranda@capitalsft.com', 'https://www.capitalsft.com', '', '', 'https://www.linkedin.com/company/13990038/admin/', '', '22/08/2020 21:28', '30/08/2020 12:14', 1, 1, 'admin', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard (ID, cover, profile, logo, nombre, descripcion, puesto, empresa, tel, tel_ofi, cell, email, web, fb, tw, lk, ins, f_create, f_update, vcard, ID_user, user, visible) VALUES (4, 'foto_capital.png', 'pbetancourt', '', 'Ponciano Betancourt', '', 'Manager', 'Capital', '', '', '442 347 0504', 'pbetancourt@capitalsft.com', 'https://www.capitalsft.com', '', '', 'https://www.linkedin.com/company/13990038/admin/', '', '22/08/2020 21:39', '30/08/2020 13:17', 1, 1, 'usuario', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard (ID, cover, profile, logo, nombre, descripcion, puesto, empresa, tel, tel_ofi, cell, email, web, fb, tw, lk, ins, f_create, f_update, vcard, ID_user, user, visible) VALUES (5, 'giganteh.jpg', 'memojl', '', 'Guillermo Jimenez Lopez', 'Desarrollo de Paginas Web y Marketing Digital', 'Desarrollador web', 'Multiportal', '', '', '4426002842', 'multiportal@outlook.com', 'http://multiportal.com.mx', 'https://facebook.com/', '', 'https://www.linkedin.com/', 'https://www.instagram.com/', '2020-09-11 22:11:58', '2020-09-11 22:17:34', 1, 1, 'admin', 1);");

//TABLA: vcard_empresas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."vcard_empresas (ID int(6) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  empresa varchar(100) NOT NULL,
  web varchar(150) NOT NULL,
  tel varchar(25) NOT NULL,
  email varchar(50) NOT NULL,
  ID_user int(10) NOT NULL,
  user varchar(50) NOT NULL,
  f_create varchar(25) NOT NULL,
  f_update varchar(25) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_empresas (ID, cover, empresa, web, tel, email, ID_user, user, f_create, f_update, visible) VALUES (1, 'multiportal.jpg', 'Multiportal', 'http://multiportal.com.mx', '442602842', 'multiportal@outlook.com', 1, 'admin', '2020-09-05', '2020-09-05', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_empresas (ID, cover, empresa, web, tel, email, ID_user, user, f_create, f_update, visible) VALUES (2, 'nodisponible.jpg', 'Billnex', 'https://thebillnex.com/', '4421234567', 'contacto@thebillnex.com', 1, 'admin', '2020-09-05', '2020-09-05', 1);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_empresas (ID, cover, empresa, web, tel, email, ID_user, user, f_create, f_update, visible) VALUES (3, 'nodisponible.jpg', 'Capital', 'https://api.capitalinvestment.mx/', '4421234567', 'contacto@capitalinvestment.mx', 1, 'admin', '2020-09-05', '2020-09-05', 1);");

//TABLA: vcard_plan
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."vcard_plan (ID int(6) unsigned NOT NULL auto_increment,
  plan varchar(100) NOT NULL,
  price decimal(6,2) NOT NULL,
  lim_card int(9) NOT NULL,
  lim_emp int(6) NOT NULL,
  nivel int(2) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_plan (ID, plan, price, lim_card, lim_emp, nivel) VALUES (1, 'black', '3000.00', 0, 0, 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_plan (ID, plan, price, lim_card, lim_emp, nivel) VALUES (2, 'oro', '1000.00', 1000, 5, 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_plan (ID, plan, price, lim_card, lim_emp, nivel) VALUES (3, 'plata', '300.00', 100, 1, 0);");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."vcard_plan (ID, plan, price, lim_card, lim_emp, nivel) VALUES (4, 'bronce', '0.00', 1, 1, 0);");

//TABLA: visitas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."visitas (ID int(9) unsigned NOT NULL auto_increment,
  IPv4 bigint(11) NOT NULL,
  ip varchar(20) NOT NULL,
  info_nave varchar(300) NOT NULL,
  navegador varchar(50) NOT NULL,
  version varchar(100) NOT NULL,
  os varchar(50) NOT NULL,
  pais varchar(100) NOT NULL,
  user varchar(50) NOT NULL,
  page varchar(500) NOT NULL,
  refer varchar(500) NOT NULL,
  vhref varchar(500) NOT NULL,
  modulo varchar(50) NOT NULL,
  ext varchar(50) NOT NULL,
  idp varchar(50) NOT NULL,
  salida_pag datetime NOT NULL,
  fecha varchar(20) NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
}
?>