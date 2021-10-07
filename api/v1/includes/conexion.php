<?php
function buscar_archivo1($path_file){
 return $val=(file_exists($path_file))?1:0;
}

$path_file = '../../admin/scfg.php';
$ex_scfg = buscar_archivo1($path_file);
if($ex_scfg==1){
    include '../../admin/scfg.php';
}else{
    include 'scfg.php';
}

$tab_signup = $DBprefix.'signup'; //($ex_scfg==1 || $DBprefix!='')?$DBprefix.'signup':'signup';
$tab_token = $DBprefix.'token'; //($ex_scfg==1 || $DBprefix!='')?$DBprefix.'token':'token';

//CONEXION MYSQLI
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

include 'sqlite.php';
if($dbSQLite!=''){
    $conec=connect_sqlite($dbSQLite);
}else{
    $conec=connect();
    $mysqli=conexion();
}

include 'lib.php';
include 'functions.php';
?>