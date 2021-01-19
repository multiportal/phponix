<?php
/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES WEB SERVICES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
include '../../../admin/scfg.php';
//Funcion para quitar los Notice (Avisos) de PHP7
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);//
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
//CONSULTA CONFIG
function sql_row($tabla,$campo,$id){
global $mysqli,$DBprefix;$mysqli=conexion();
    $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." WHERE {$campo}='{$id}';") or print mysqli_error($mysqli);
    $array_campos=array();
    if($r=mysqli_fetch_assoc($sql)){$array_campos[] = $r;}//$row=array_unique($array_campos[0]);
    return $r;
}
$row=sql_row('config','ID',1);
$page_url=$row['page_url'];
//Variables
$bootstrap='<link href="'.$page_url.'assets/bootstrap/b-4.5.0/css/bootstrap.css" rel="stylesheet" type="text/css">'."\r\n";
/*|///WEBSERVICES///|*/
function ws_tabla($tabla,$id,$ajax){
global $DBprefix,$bootstrap;
	$show=($id)?" WHERE ID={$id}":'';
	if($ajax==1){mysqli_set_charset(conexion(), 'utf8');}
	if($tabla!='signup'){		
		$query="SELECT * FROM ".$DBprefix.$tabla.$show."";
	}else{
		echo $bootstrap.'<div class="alert alert-danger">No hay datos que mostrar<div>';exit();
	}
	$sql=mysqli_query(conexion(),$query) or print mysqli_error(conexion());
	$json = array();
	while($row = mysqli_fetch_assoc($sql)){$json[]=$row;}
	if($ajax==1){
		$data = json_encode($json);
	}else{
		$data=json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);		
	}
	if($data=='' || $data==NULL || $data=='[]'){
		header('Content-Type: text/html; charset=utf-8');
		echo $bootstrap.'<div class="alert alert-danger">La consulta no existe<div>';
	}else{
		header('Content-Type: application/json');
		echo $data;
	}

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
