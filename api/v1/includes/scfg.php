<?php 
$h_s='phponix.webcindario.com';
if($_SERVER['HTTP_HOST']==$h_s || $_SERVER['HTTP_HOST']=='www.'.$h_s){
$db_host = "mysql.webcindario.com";// Localhost
$db_base = "";      // Nombre de la Base de Datos
$db_user = "";      // Usuario de la Base de Datos
$db_pass = "";     	// Password de la Base de Datos 
}else{
$db_host = "localhost";     // Localhost
$db_base = "phponix";    // Nombre de la Base de Datos
$db_user = "root";        	// Usuario de la Base de Datos
$db_pass = "";     	// Password de la Base de Datos
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
$DBprefix = "php_";		// Prefijo para las tablas de la Base de datos.
$path_root = ($_SERVER['HTTP_HOST']=='localhost')?'MisSitios/phponix/':'';

/*DEFINITION OF VARIABLES FOR PHP7*/
define('DB_DRIVER',$config['driver']);
define('DB_HOST',$config['host']);
define('DB_USER',$config['username']);
define('DB_PASSWORD',$config['password']);
define('DB_DB',$config['database']);
define('DB_PORT',$config['port']);
define('DB_CHARSET',$config['charset']);
?>