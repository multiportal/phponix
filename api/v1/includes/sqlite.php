<?php 
$dbSQLite='';//'../db/links.db'; //Nombre de la base de datos

//Conexion a la base de datos Sqlite
function connect_sqlite($dbSQLite){
    $sqlite = new PDO("sqlite:".$dbSQLite);
    if($sqlite){
        //echo '<div>Conectado con la Base Datos</div>';
        return $sqlite;
    }else{
        echo '<div>Error: No se ha conectado con la Base Datos</div>';
    }
}



