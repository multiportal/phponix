<?php
/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES WEB SERVICES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
include '../../../admin/scfg.php';
//Funcion para quitar los Notice (Avisos) de PHP7
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
/*|///CONEXION///|*/
function conexion(){
 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB); //conexión ala base de datos por medio de misqli poo
 if($mysqli->connect_errno > 0){ //si retorna algun error
 	return("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]"); //se muestra el error
 }else{ //si no retorna el error
 	$mysqli->query("SET NAMES 'utf8'"); //codifica las consultas a utf-8
 	return $mysqli; //retorna la conexión a la base de datos mysql
 }
}

/*|///WEBSERVICES///|*/
function ws_tabla($tabla,$ajax){
global $DBprefix;
	if($ajax==1){mysqli_set_charset(conexion(), 'utf8');}
	if($tabla!='signup'){
		$query="SELECT * FROM ".$DBprefix.$tabla."";
	}else{
		echo '<div>No hay datos que mostrar.</div>';exit();
	}
	$sql=mysqli_query(conexion(),$query) or print mysqli_error(conexion());
	$json = array();
	while($row = mysqli_fetch_assoc($sql)){$json[]=$row;}
	if($ajax==1){
		$data = json_encode($json);
	}else{
		$data=json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		header('Content-Type: application/json');
	}
	echo $data;
}
	
function ws_query($query,$ajax,$d){
global $DBprefix;
	if($ajax==1){mysqli_set_charset(conexion(), 'utf8');}
	$sql=mysqli_query(conexion(),$query) or print mysqli_error(conexion());
	$json = array();
	while($row = mysqli_fetch_assoc($sql)){$json[]=$row;}
	if($ajax==1){
		$data=($d!=1)?json_encode($json):json_encode($json[0]);
	}else{
		$data=json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		header('Content-Type: application/json');
	}
	echo $data;
}
/*|///WEBSERVICES///|*/
	
?>
