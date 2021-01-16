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
$server = "'.$db_server.'";     			// often localhost
$username = "'.$db_username.'";       		// Your MySQL server username
$password = "'.$db_password.'";     	// Your MySQL server password 
$database = "'.$db_database.'";      		// If you fill in nothing database.
}else{
$server = "localhost";     		// often localhost
$username = "root";       		// Your MySQL server username
$password = "";     		// Your MySQL server password 
$database = "'.$db_database.'";      		// If you fill in nothing database.
}
$DBprefix = "'.$prefijo.'";            		// the prefix for the tables in the database (can be left blank)
/*DEFINICION DE VARIABLES PARA PHP7*/
define(\'DB_HOST\',$server);
define(\'DB_USER\',$username);
define(\'DB_PASSWORD\',$password);
define(\'DB_DB\',$database);
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
	echo \'<div style="color:fff;background:#f00;padding:2px;position:absolute;z-index:100;width:100%;font-weight:bold;font-family:arial;font-size:12px;text-align:center;">500 Internal Server Error: No se ha conectado al servidor MySQL. Posiblemente la p&aacute;gina no funcione correctamente.</div>\';
	include \'500.html\';//500 Internal Server Error
	exit();
}else{$select_db=@mysqli_select_db($mysqli,DB_DB);
if(!$select_db){
	echo \'<div style="color:fff;background:#f00;padding:2px;position:absolute;z-index:100;width:100%;font-weight:bold;font-family:arial;font-size:12px;text-align:center;">500 Internal Server Error: No se pudo establecer conexion con la base de datos. Posiblemente la p&aacute;gina no funcione correctamente.</div>\';
	include \'500.html\';//500 Internal Server Error
	exit();
}
$mysqli=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
}

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
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."access (ID,user,ip,navegador,os,code,fecha) VALUES (1, 'admin', '127.0.0.1', 'CHROME', 'WIN', '944950', '2019-06-06 03:35:27');");

//TABLA: blog
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."blog (ID int(11) unsigned NOT NULL auto_increment,
  cover varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  descripcion varchar(200) NOT NULL,
  contenido text NOT NULL,
  tag varchar(200) NOT NULL,
  autor varchar(100) NOT NULL,
  fmod varchar(21) NOT NULL,
  fecha varchar(21) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
//$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (ID,tema,subtema,selec,nivel) VALUES ('1','default','','1','0');");

//TABLA: blog_coment
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."blog_coment (ID int(11) unsigned NOT NULL auto_increment,
  ip varchar(18) NOT NULL,
  nombre varchar(100) NOT NULL,
  email varchar(50) NOT NULL,
  comentario varchar(500) NOT NULL,
  id_b int(3) NOT NULL,
  fecha varchar(21) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: comp
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."comp (ID int(6) unsigned NOT NULL auto_increment,
  page varchar(50) default NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp (ID,page) VALUES ('1','usuarios/login.php');");

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
  metas text NOT NULL,
  g_analytics varchar(500) NOT NULL,
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
  licencia varchar(300) NOT NULL,
  version varchar(50) NOT NULL,

  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."config (ID,logo,dominio,metas,g_analytics,mode,chartset,dboard,dboard2,licencia,version) VALUES ('1','logo.png','http://localhost/','<!--Responsive Meta--><meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\"><!-- META-TAGS generadas por http://metatags.miarroba.es --><META NAME=\"DC.Language\" SCHEME=\"RFC1766\" CONTENT=\"Spanish\"><META NAME=\"AUTHOR\" CONTENT=\"Guillermo Jimenez\"><META NAME=\"REPLY-TO\" CONTENT=\"multiportal@outlook.com\"><LINK REV=\"made\" href=\"mailto:multiportal@outlook.com\">','<!--Google Analytics-->','page','utf-8','dashboard','AdminLTE','cms-px31q2hponix31q2x.admx31q2in458x31q2x.202x31q26.05.x31q212.01x31q2.2.4.x31q27x31q2','3.0.1');");

//TABLA: contacto
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."contacto (ID int(9) unsigned NOT NULL auto_increment,
  ip varchar(25) NOT NULL,
  nombre varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  tel varchar(20) NOT NULL,
  asunto varchar(150) NOT NULL,
  msj text NOT NULL,
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  cat_list varchar(50) NOT NULL,
  seccion varchar(50) NOT NULL,
  tabla varchar(50) NOT NULL,
  adjuntos text NOT NULL,
  visto tinyint(1) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

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
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: depa
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."depa (ID int(2) unsigned NOT NULL auto_increment,
  nombre varchar(100) NOT NULL,
  list_depa varchar(100) NOT NULL,
  puesto varchar(100) NOT NULL,
  nivel int(1) NOT NULL,
  icono varchar(50) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
//$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp (ID,page) VALUES ('1','usuarios/login.php');");

//TABLA: histo_backupdb
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."histo_backupdb (ID int(9) unsigned NOT NULL auto_increment,
  fecha varchar(50) NOT NULL,
  archivo varchar(200) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: home_config
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."home_config (ID int(1) unsigned NOT NULL auto_increment,
  titulo varchar(200) NOT NULL,
  contenido text NOT NULL,
  selc tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: iconos
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."iconos (ID int(6) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  fa_icon varchar(100) NOT NULL,
  icon text NOT NULL,
  tipo varchar(100) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
//$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp (ID,page) VALUES ('1','usuarios/login.php');");

//TABLA: ipbann
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."ipbann (ID int(11) unsigned NOT NULL auto_increment,
  ip varchar(256) NOT NULL DEFAULT '',
  bloqueo tinyint(1) NOT NULL,
  alta timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: landingpage_seccion
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."landingpage_seccion (ID int(6) unsigned NOT NULL auto_increment,
  seccion varchar(100) NOT NULL,
  tit varchar(150) NOT NULL,
  conte varchar(254) NOT NULL,
  visible varchar(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: menu_admin
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."menu_admin (ID int(6) unsigned NOT NULL auto_increment,
  nom_menu varchar(50) NOT NULL,
  icono varchar(50) NOT NULL,
  link text NOT NULL,
  nivel int(1) NOT NULL,
  ID_menu_adm int(2) NOT NULL,
  ID_mod int(2) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
//$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."comp (ID,page) VALUES ('1','usuarios/login.php');");

//TABLA: menu_web
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."menu_web (ID int(6) unsigned NOT NULL auto_increment,
  menu varchar(50) NOT NULL,
  url varchar(254) NOT NULL,
  modulo varchar(100) NOT NULL,
  ext varchar(50) NOT NULL,
  ord varchar(2) NOT NULL,
  subm varchar(3) NOT NULL,
  visible tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID,menu,url,modulo,ext,ord,subm,visible) VALUES (1,'Nosotros','nosotros/','nosotros','',1,'',0);");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID,menu,url,modulo,ext,ord,subm,visible) VALUES (2,'Portafolio','portafolio/','portafolio','',2,'',0);");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID,menu,url,modulo,ext,ord,subm,visible) VALUES (3,'Blog','blog/','blog','',3,'',0);");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (ID,menu,url,modulo,ext,ord,subm,visible) VALUES (4,'Contacto','contacto/','contacto','',4,'',1);");

//TABLA: mode_page
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."mode_page (ID int(2) unsigned NOT NULL auto_increment,
  page_mode varchar(100) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;");
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
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (1, 'admin', 'admin', '', 0, 0, 0, 0, 0, 'false', '', '');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (2, 'Dashboard', 'dashboard', '', 1, -1, 0, 0, 1, 'false', '', 'index.php?mod=dashboard');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (3, 'Home', 'Home', 'Administración y gestión del Home.', 0, 0, 1, 1, 1, 'false', 'fa-home', 'index.php?mod=Home');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (4, 'Usuarios', 'usuarios', 'Administación y gestión de usuarios.', 0, -1, 0, 1, 1, 'false', 'fa-users', 'index.php?mod=usuarios');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (5, 'Nosotros', 'nosotros', 'Administración del contenido del modulo de nosotros.', 0, 0, 0, 0, 0, 'false', 'fa-users', 'index.php?mod=nosotros');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (6, 'Portafolio', 'portafolio', 'Administración y gestión del portafolio.', 0, 0, 0, 1, 1, 'false', 'fa-briefcase', 'index.php?mod=portafolio');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (7, 'Blog', 'blog', 'Administración del contenido del modulo de blog.', 0, 0, 0, 0, 0, 'false', 'fa-comments', 'index.php?mod=blog');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (8, 'Contacto', 'contacto', 'Consultas del modulo de contacto.', 0, 0, 0, 1, 1, 'false', 'fa-map-marker', 'index.php?mod=contacto');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (9, 'Sistema', 'sys', 'Configuración y administración del sistema.', 1, -1, 0, 1, 1, 'false', 'fa-gear', 'index.php?mod=sys');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (10, 'Estadistica', 'estadisticas', 'Estadisticas de trafico. ', 0, -1, 0, 1, 1, 'false', 'fa-bar-chart', 'index.php?mod=estadisticas');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (11, 'Formularios', 'forms', 'Administracion de Formularios para la web.', 1, 1, 0, 0, 0, 'false', 'fa-pencil-square-o', 'index.php?mod=forms');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (12, 'Mailbox', 'mailbox', 'Mailbox de formularios', 1, 1, 0, 1, 1, 'false', ' fa-envelope', 'index.php?mod=mailbox');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (13, 'Ecommerce', 'ecommerce', 'Administración y gestión del modulo ecommerce.', 0, 1, 0, 0, 0, 'false', 'fa-shopping-cart', 'index.php?mod=ecommerce');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (14, 'Marketing', 'marketing', '', 0, 1, 0, 0, 0, 'false', 'fa-globe', 'index.php?mod=marketing');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (15, 'Productos', 'productos', 'Administración de productos', 0, 1, 0, 0, 0, 'false', 'fa-shopping-cart', 'index.php?mod=productos');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (16, 'Gmaps', 'gmaps', 'Mapas de Google', 0, 0, 0, 0, 0, 'false', 'fa-map', 'index.php?mod=gmaps');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (17, 'Chat', 'chat', 'Administración del modulo chat.', 0, 1, 0, 0, 0, 'false', 'fa-commenting', 'index.php?mod=chat');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (ID,nombre,modulo,description,dashboard,nivel,home,visible,activo,sname,icono,link) VALUES (18, 'Directorio', 'directorio', 'Administrador del modulo de Directorio.', 0, 1, 0, 0, 0, 'false', 'fa-globe', 'index.php?mod=directorio');");

//TABLA: notificacion
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."notificacion (ID int(11) unsigned NOT NULL auto_increment,
  ID_user int(11) NOT NULL,
  ID_user2 varchar(11) NOT NULL,
  nombre_envio varchar(255) NOT NULL,
  mensaje text NOT NULL,
  visto tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  fecha varchar(22) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: opciones
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."opciones (ID int(6) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  descripcion text NOT NULL,
  valor varchar(50) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES ('1','google_analytics','','0');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES ('2','form_registro','','0');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES ('3','geo_loc_visitas','','0');");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (ID,nom,descripcion,valor) VALUES ('4','slide_active','','1');");

//TABLA: pages
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."pages (ID int(6) unsigned NOT NULL auto_increment,
  titulo varchar(100) NOT NULL,
  contenido text NOT NULL,
  modulo varchar(50) NOT NULL,
  ext varchar(50) NOT NULL,
  url varchar(250) NOT NULL,
  fmod varchar(20) NOT NULL,
  alta varchar(20) NOT NULL,
  visible tinyint(1) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: registros
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."registros (ID int(9) unsigned NOT NULL auto_increment,
  ip varchar(25) NOT NULL,
  nombre varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  tel varchar(20) NOT NULL,
  asunto varchar(150) NOT NULL,
  msj text NOT NULL,
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  cat_list varchar(50) NOT NULL,
  seccion varchar(50) NOT NULL,
  tabla varchar(50) NOT NULL,
  adjuntos text NOT NULL,
  visto tinyint(1) NOT NULL,
  visible tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

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
  genero varchar(20) NOT NULL,
  exp varchar(1000) NOT NULL,
  likes int(6) NOT NULL,
  filtro varchar(50) NOT NULL,
  zona varchar(50) NOT NULL,
  alta varchar(20) NOT NULL,
  actualizacion varchar(20) NOT NULL,
  page varchar(250) NOT NULL,
  nivel_oper int(2) NOT NULL,
  rol int(2) NOT NULL,
  activo tinyint(1) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (ID,username,password,email,level,nombre,foto,cover,puesto,alta,activo) VALUES ('1','admin','123456','multiportal@outlook.com','-1','admin','sinfoto.png','sinfoto.png','administrador','2019-01-01 00:00:00','1');");

//TABLA: tareas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."tareas (ID int(11) unsigned NOT NULL auto_increment,
  nom varchar(100) NOT NULL,
  descripcion varchar(250) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

//TABLA: temas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."temas (ID int(3) unsigned NOT NULL auto_increment,
  tema varchar(100) NOT NULL,
  subtema varchar(100) NOT NULL,
  selec tinyint(1) NOT NULL,
  nivel varchar(2) NOT NULL,
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");
$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (ID,tema,subtema,selec,nivel) VALUES ('1','default','','1','0');");

//TABLA: visitas
$crear_tablas=mysqli_query($mysqli,"CREATE TABLE ".$DBprefix."visitas (ID int(9) unsigned NOT NULL auto_increment,
IPv4 bigint(11) NOT NULL,
ip varchar(20) NOT NULL,
info_nave varchar(100) NOT NULL,
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
  PRIMARY KEY (ID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
}
?>