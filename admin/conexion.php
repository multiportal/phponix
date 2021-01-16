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
include 'lib.php';
?>