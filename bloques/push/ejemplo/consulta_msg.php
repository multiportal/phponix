<?php
header('Content-Type: application/json'); //mediante header establece que es un archivo json
$id=$_REQUEST['ID_user']; //obtiene la variable id por post o get
include '../../../admin/conexion.php';
 
$mysqli = conecta(); //conecta la base de datos
$sql = $mysqli->query("SELECT * FROM ".$DBprefix."notificacion WHERE ID_user='$id' AND visto='0' AND activo='1'"); //consulta los mensajes no leidos=0 y activos=1 del propietario
$num_row = $sql->num_rows; //verifica el numero de mensajes 
if($num_row > 0){ // si el numero de mensajes es mayor a 0
	while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) { //genera el while para recorrer todos los mensajes
    	$msg[]=array('num_msg'=>$num_row,'texto'=>$row['mensaje'],'emisor'=> $row['nombre_envio']); //los almacena en un arreglo de arreglos
        $mysqli->query("UPDATE ".$DBprefix."notificacion SET visto='1' WHERE ID='".$row['ID']."'"); //hace el update de mensaje leido
    }       
}else{ //si no hay información retorna un array vacio que posteriormente se convertira a un json nulo        
	$msg[]=array('num_msg'=>$num_row,'texto'=>$row['mensaje'],'emisor'=> $row['nombre_envio']);        
} 
echo json_encode($msg,JSON_PRETTY_PRINT); //lo codifica a json, JSON_PRETTY_PRINT lo hace agradable a la vista
?>