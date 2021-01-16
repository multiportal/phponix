<?php 
include ('../../admin/conexion.php');
include ('functions.php');

switch(true){
 case($_GET['opc']=='test'):
	sesion($form_login);	
	user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
	$tabla=$_GET['t'];
	leer_json_php($tabla,$Data);
	file_json($tabla,$path_JSON);
 break;
 case($_GET['opc']=='num_email'):
	mensajes_recibidos();
 break;
 case($_GET['opc']=='reg_email'):
 	num_email($num_email,$msj_email,$ID_e);
	echo $msj_email; 
 break;
 case($_GET['opc']=='num_visitas'):
	visitas_hoy(); 
 break;
 case($_GET['opc']=='num_noti'):
 	num_noti($num_noti,$msj_noti,$ID_n);
	echo $num_noti; 
 break;
 case($_GET['opc']=='reg_noti'):
 	num_noti($num_noti,$msj_noti,$ID_n);
	echo '<!--ID:'.$ID_n.'-->
	<li><a href="#" class="text-black"><i class="fa fa-users text-aqua"></i> '.$msj_noti.'</a></li>'; 
 break;
 case($_GET['opc']=='num_tareas'):
	num_tareas($num_tareas,$nom_tarea,$ID_t);
	echo $num_tareas;
 break;
 case($_GET['opc']=='reg_tareas'):
	num_tareas($num_tareas,$nom_tarea,$ID_t);
	echo '<!--ID:'.$ID_t.'-->
	<li><a href="#" class="text-black"><i class="fa fa-flag text-aqua"></i> '.$nom_tarea.'</a></li>'; 
 break;
 case($_GET['opc']=='num_blog'):
	num_blog(); 
 break;

 case($_GET['opc']=='noti_chrome'):

header('Content-Type: application/json'); //mediante header establece que es un archivo json
$id=$_REQUEST['ID_user']; //obtiene la variable id por post o get
//include '../../../admin/conexion.php';
$mysqli = conecta(); //conecta la base de datos
$sql = $mysqli->query("SELECT * FROM ".$DBprefix."notificacion WHERE ID_user='1' AND visto='0' AND activo='1'"); //consulta los mensajes no leidos=0 y activos=1 del propietario
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
 
 break;
}
?>
