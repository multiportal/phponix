<?php
//--FUNCIONES SISTEMA-///////////////////////////////////////////////////////////////////////////////
/*TABLA:CONFIGURACION*/

$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."config WHERE ID='1';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	$page_name=$row['page_name'];
	$title=$row['title'];
	$dominio=$row['dominio'];
	$path_root=$row['path_root'];
	$page_url=$row['page_url'];
	$keywords=$row['keyword'];
	$description=$row['description'];
	$metas=$row['metas'];
	$google_analytics=$row['g_analytics'];
	$tel1=$row['tel'];
	$phone=$row['phone'];
	$webMail=$row['webMail'];
	$contactMail=$row['contactMail'];
	$mode=$row['mode'];
	$chartset=$row['chartset'];
	$dboard=$row['dboard'];
	$dboard2=$row['dboard2'];
	$direc=$row['direc'];
	$CoR=$row['CoR'];
	$CoE=$row['CoE'];
	$BCC=$row['BCC'];
	$CoP=$row['CoP'];
	$fb_web=$row['fb'];
	$tw_web=$row['tw'];
	$gp_web=$row['gp'];
	$lk_web=$row['lk'];
	$yt_web=$row['yt'];
}
$host_s='https://'.$host;
$host_d=($dominio==$host_s.'/')?'https://'.$host:'http://'.$host;
//echo $dominio.' = '.$host_d;
$url=$host_d.$pag_self;			//Se obtiene la url de la pagina.
$URL=$host_d.$pag_url;			//Se obtiene la url completa, incluyendo variables.

/*TABLA:CONFIGURACION*/
$sql_tema=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."temas WHERE selec='1';") or print mysqli_error($mysqli); 
$cont_tema=mysqli_num_rows($sql_tema);

if($cont_tema!=0){
	while($rowtema=mysqli_fetch_array($sql_tema)){
		$tema=$rowtema['tema'];
		$subtema=$rowtema['subtema'];
	}
}else{echo 'No hay Tema para la p&aacute;gina.!';}
/*VARIABLES DE TEMA----------------------------------------------------------------------------*/
$tema_previo=$_GET['tema_previo'];
$tema = ($tema_previo!='')?$tema_previo:$tema;
$tema = ($subtema!='' && $subtema!=NULL)? $tema.'/'.$subtema : $tema;

$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones WHERE nom='wordpress';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){$valor=$row['valor'];}

$path_t=($valor==1)?'wp-content/themes/':'temas/';
$path_tema=$path_t.$tema.'/';
$path_mod='modulos/'.$mod.'/';

//Varibles Compuestas
$meta_chartset='
<!--Carateres-->
<meta http-equiv="Content-Type" content="text/html; charset='.$chartset.'" />
';

/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES DE CONSULTAS BASICAS--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
function conexion(){
 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB); //conexión ala base de datos por medio de misqli poo
 if($mysqli->connect_errno > 0){ //si retorna algun error
 	return("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]"); //se muestra el error
 }else{ //si no retorna el error
 	$mysqli->query("SET NAMES 'utf8'"); //codifica las consultas a utf-8
 	return $mysqli; //retorna la conexión a la base de datos mysql
 }
}

function query_data($tabla,$url_api){
global $page_url,$path_jsonDB,$path_jsonWS;
	$path_JSON=$path_jsonDB.$tabla.'.json';
	if(!file_exists($path_JSON)){$path_JSON=$page_url.$path_jsonWS.$tabla;}
	$path_JSON=($url_api)?$url_api:$path_JSON;
	//echo $path_JSON;
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);
	usort($Data, function($a, $b){return strnatcmp($a['ord'], $b['ord']);});//Orden del menu
	return $Data;
}

function query_config($tabla,$campo,$id,&$index,&$row){
	$data=query_data($tabla,$url_api);
	//DATOS
	foreach($data as $key => $value){
		$b_id=$data[$key][$campo];
		if($b_id==$id){
			$index=$key;
			$row=$data[$key];//print_r($row);
		}
	}
}

function query_all_tabla($tabla,$url_api){
global $page_url,$path_jsonDB,$path_jsonWS;
	$Data=query_data($tabla,$url_api);
	print_r($Data);
}

query_config($tabla='config','ID',1,$row);
$page_name=$row['page_name'];

/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/

function sql_opciones($opcion,&$valor){
global $mysqli,$DBprefix;//$mysqli=conecta();
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones WHERE nom='{$opcion}';") or print mysqli_error($mysqli); 
	if($row=mysqli_fetch_array($sql)){$valor=$row['valor'];}
}


/******/
/*|///LEER JSON///|*/
function leer_json_php($tabla,&$Data,&$ruta_origen){
global $page_url,$username,$nivel_login;
$tabla_json=$tabla.'.json';
$path_JSON='bloques/webservices/rest/json/'.$tabla_json;
if(!file_exists($path_JSON)){sql_opciones('link_var',$valor);$path_JSON=($valor==1)?$page_url.'bloques/ws/t/?t='.$tabla:$page_url.'bloques/ws/t/'.$tabla.'/';}
$ruta_origen=($nivel_login!=-1)?'<!-- '.$tabla_json.' -->'."\n\r":'<!-- '.$tabla_json.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 }
}

function file_json($tabla,&$path_JSON,&$ruta_origen){
global $page_url,$username,$nivel_login;
$tabla_json=$tabla.'.json';
$path_JSON='bloques/webservices/rest/json/'.$tabla_json;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t='.$tabla;}
$ruta_origen=($nivel_login!=-1)?'<!-- '.$tabla_json.' -->'."\n\r":'<!-- '.$tabla_json.' URL:('.$path_JSON.')-->'."\n\r";
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