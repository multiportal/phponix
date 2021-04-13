<?php
//include_once '../admin/conexion/PDO.php';
include '../admin/scfg.php';
//Funcion para quitar los Notice (Avisos) de PHP7
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);//$host	 = $_SERVER['HTTP_HOST'];$dominio = 'http://'.$host.'/';
//Variables
$bootstrap='<link href="../assets/bootstrap/b-4.5.0/css/bootstrap.css" rel="stylesheet" type="text/css">'."\r\n";
$tabla=(isset($_GET['tabla']))?$_GET['tabla']:'';//exit();
$id=(isset($_GET['id']))?$_GET['id']:'';
validacion_tabla();

//CONEXION
function conexion(){
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB); //conexión ala base de datos por medio de misqli poo
    if($mysqli->connect_errno > 0){ //si retorna algun error
        return("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]"); //se muestra el error
    }else{ //si no retorna el error
        $mysqli->query("SET NAMES 'utf8'"); //codifica las consultas a utf-8
        return $mysqli; //retorna la conexión a la base de datos mysql
    }
}

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

//Validación
function validacion_tabla(){
global $mysqli,$DBprefix,$tabla,$bootstrap;
$mysqli=conexion();
    if($tabla!='signup' && $tabla!='token' && $tabla!=NULL){
        $tabla = ($tabla==$DBprefix.'signup' || $tabla==$DBprefix.'token')?$tabla:$DBprefix.$tabla;        
        $sql = mysqli_query($mysqli,"DESCRIBE ".$tabla.";");
        if($sql){
            return $tabla;//$tabla=($tabla==$DBprefix.'signup')?$tabla:$DBprefix.$tabla;
        }else{
            echo $bootstrap.'<div class="alert alert-danger"><b>ERROR:</b> La Tabla no existe.<div>';exit();
        }
    }else{
        echo $bootstrap.'<div class="alert alert-warning"><b>PRECAUCIÓN:</b> No hay datos que mostrar<div>';exit();
    }
}

//Obtener campos para insert
function getCampos($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = "$param";
    }
    return implode(", ", $filterParams);
}

//Obtener valores para insert
function getValores($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = ":$param";
    }
    return implode(", ", $filterParams);
}

//Obtener parametros para updates
function getParams($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
}

//Asociar todos los parametros a un sql
function bindAllValues($statement, $params){
	foreach($params as $param => $value){
		$statement->bindValue(':'.$param, $value);
	}
	return $statement;
}

//INDEX
function all(){
global $conec, $tabla;
    $sql = $conec->prepare("SELECT * FROM $tabla");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data=$sql->fetchAll();//$data[]=$json;
    //mysqli_set_charset($conec, 'utf8');
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($data);
}

//STORE
function store($id){
global $conec, $tabla;
    $sql = $conec->prepare("SELECT * FROM $tabla where ID=:id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    $data[]=$json;
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($data);
}

//INSERT
function insert(){
global $conec,$tabla;
    $input = $_POST;
    $campos = getCampos($input); //echo $campos;
    $valores = getValores($input); //echo $valores;
    $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
    $statement = $conec->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $conec->lastInsertId();
    if($postId){
      //$input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      header('Content-Type: application/json');
      echo json_encode($input);
    }    
}

//UPDATE
function update($id){
global $conec,$tabla;
    $input = $_POST;//print_r($input); 
    $postId = $id; 
    $fields = getParams($input); //echo $fields;//exit();
    $sql = "UPDATE $tabla SET $fields WHERE ID='$postId'";
    $statement = $conec->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($input);
}

//DELETE
function delete($id){
global $conec,$tabla;
    $statement = $conec->prepare("DELETE FROM $tabla where ID=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    echo 'El registro '.$id.' ha sido eliminado.';  
}
 ?>