<?php
/*VARIABLES DE ENTORNO[.ENV]*/
$archivo = __DIR__ . "/.env";//__DIR__ . "/../.env";
$VAR_ENV = parse_ini_file($archivo, true);
$sis=$VAR_ENV['Sistema'];
$con=$VAR_ENV['Conexion'];
$em=$VAR_ENV['Email'];

$sys_name=$sis['name_sys'];
$sys_ver=$sis['ver_sys'];

$driver=$con['driver'];
$db_host=$con['host'];
$db_base=$con['database'];
$db_user=$con['username'];
$db_pass=$con['password'];
$db_port=$con['port'];
$db_charset=$con['charset'];

$smtp=$em['smtp'];
$user_mail=$em['user_mail'];
$pass_mail=$em['pass_mail'];
$port_mail=$em['port_mail'];

//echo 'Variable: '.$smtp;