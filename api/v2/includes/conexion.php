<?php
//File of settings...
function searchFile($path_file){
 return $val=(file_exists($path_file))?1:0;
}

$path_file = '../../admin/scfg.php';
$ex_scfg = searchFile($path_file);
if($ex_scfg==1){
    include '../../admin/scfg.php';
}else{
    include 'scfg.php';
}

//Protec tables
$tab_signup = $DBprefix.'signup'; //($ex_scfg==1 || $DBprefix!='')?$DBprefix.'signup':'signup';
$tab_token = $DBprefix.'token'; //($ex_scfg==1 || $DBprefix!='')?$DBprefix.'token':'token';
$tokenCookie = (isset($_COOKIE['token']) && $sel_apiType=='restfull')?$_COOKIE['token']:'';
/*Functions to connect to the database*********************************************************/
//CONEXION PDO
function connect_pdo(){
    try {
        $conexion = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_DB.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD);
        // set the PDO error mode to exception
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
}

//CONEXION MYSQLI
function connect_mysqli(){
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB); //conexión ala base de datos por medio de misqli poo
    if($mysqli->connect_errno > 0){ //si retorna algun error
        return("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]"); //se muestra el error
    }else{ //si no retorna el error
        $mysqli->query("SET NAMES 'utf8'"); //codifica las consultas a utf-8
        return $mysqli; //retorna la conexión a la base de datos mysql
    }
}

//CONEXION SQLITE
function connect_sqlite($dbSQLite){
    $sqlite = new PDO("sqlite:".$dbSQLite);
    if($sqlite){// Conections successfull
        return $sqlite;
    }else{
        echo '<div>Error: No se ha conectado con la Base Datos</div>';
    }
}

/*Function to check driver **************************************************/
switch ($config['driver']) {
    case 'sqlsrv':
        $conec = connect_pdo();
    break;
    case 'mysql':
        $conec = connect_pdo();
    break;
    case 'mysqli':
        $conec = connect_mysqli();
    break;
    case 'sqlite':
        $conec = connect_sqlite($dbSQLite);
    break;
    default:
        $conec = connect_pdo();
    break;
}

include 'lib.php';
include 'functions.php';
?>