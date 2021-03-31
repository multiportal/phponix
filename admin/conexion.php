<?php
include 'scfg.php';
//COMPROBACION DE CONEXION AL SERVIDOR
$mysqli=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$mysqli){
	echo '<div class="alert alert-danger">500 Internal Server Error: No se ha conectado al servidor MySQL. Posiblemente la p&aacute;gina no funcione correctamente.</div>';
	include '500.php';//500 Internal Server Error
	exit();
}else{$select_db=@mysqli_select_db($mysqli,DB_DB);
	if(!$select_db){
		echo '<div class="alert alert-danger">500 Internal Server Error: No se pudo establecer conexion con la base de datos. Posiblemente la p&aacute;gina no funcione correctamente.</div>';
		include '500.php';//500 Internal Server Error
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
 	$mysqli->query("SET NAMES 'utf8'"); //codifica las consultas a utf-8
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

include 'lib.php';
?>