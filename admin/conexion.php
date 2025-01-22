<?php
include 'scfg.php';

// COMPROBACIÓN DE CONEXIÓN AL SERVIDOR Y BASE DE DATOS
//CONEXION PDO
function connect_pdo() {
	try {
		$conexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_DB . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD);
		// set the PDO error mode to exception
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexion;
	} catch (PDOException $exception) {
		exit($exception->getMessage());
	}
}

//CONEXION MYSQLI
function connect_mysqli() {
	try {
		// Intentar conectar al servidor y a la base de datos
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
		// Verificar si hay errores en la conexión
		if ($mysqli->connect_error) {
			throw new Exception('500 Internal Server Error: No se ha podido conectar al servidor MySQL o a la base de datos.');
		}
		return $mysqli;
	} catch (Exception $e) {
		// Mostrar mensaje de error y cargar página personalizada
		echo '<div class="alert alert-danger mb-0">500 Internal Server Error: No se ha podido conectar al servidor MySQL o a la base de datos.</div>';
		include './500.php'; // Página de error
		exit(); // Terminar ejecución
	}

}

//CONEXION PDO MYSQLI
function connect_PDO_mysqli(){
    try {
        $mysqli = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8mb4", DB_USER, DB_PASSWORD);
        // set the PDO error mode to exception
        $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $mysqli;
    } catch (PDOException $exception) {
        // Mostrar mensaje de error y cargar página personalizada
		echo '<div class="alert alert-danger mb-0">500 Internal Server Error: No se ha podido conectar al servidor MySQL o a la base de datos.</div>';
		include './500.php'; // Página de error
		exit(); // Terminar ejecución
    }
}

//CONEXION SQLITE 
function connect_sqlite($dbSQLite) {
	$sqlite = new PDO("sqlite:" . $dbSQLite);
	if ($sqlite) { // Conections successfull
		return $sqlite;
	} else {
		echo '<div>Error: No se ha conectado con la Base Datos</div>';
	}
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

$conec = connect_PDO_mysqli();

//COMPROBACION DE CONEXION AL SERVIDOR
/*$mysqli=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
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
}*/

/*Function to check driver **************************************************/
switch ($config['driver']) {
	case 'sqlsrv':
		$mysqli = connect_pdo();
		break;
	case 'mysql':
		$mysqli = connect_pdo();
		break;
	case 'mysqli':
		$mysqli = connect_mysqli();
		break;
	case 'mysqliPDO':
		$mysqli = connect_PDO_mysqli();
		break;
	case 'sqlite':
		$mysqli = connect_sqlite($dbSQLite);
		break;
	default:
		$mysqli = connect_PDO_mysqli();
		break;
}

include 'lib.php';
