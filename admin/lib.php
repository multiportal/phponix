<?php 
/**********************************************************
Author: Guillermo Jiménez López
Author URI: https://www.multiportal.com.mx
SISTEMA PHPONIX
Version Actual: 2.8.2
F.Creación: 26/03/2015
F.Modficación: 20/03/2021
Descripción: Aplicación web multiproposito.
/**********************************************************
v.2.8.2 - TOKEN
-Seguridad: Se agrego Token(Funcional!!!)
-CAMBIO DE DIAGONAL AL FINAL EN $pag_url & $path_root
/**********************************************************
v.2.8.1 - API
-Se creo API Rest General (/api)
/**********************************************************
v.2.8.0 - TOKEN  
-Seguridad: Se agrego Token(variable no funciona)
-Comprobacion si existen las API URL.
-Se agrego varible para archivos css y js:$ver_file
-Se agrego Path para consultas JSON ($path_jsonWS,$path_jsonDB;)
-Transformacion de modulos a AJAX
1-MODULO: Servicios 
2-MODULO: Portafolio
3-MODULO: Productos
4-MODULO: Blog
*Preparación para las WPA
**Nuevas Funcionalidades
/**********************************************************
v.2.7.8 - CONSULTAS TIEMPO REAL
-Opcion: Activador de Ajax
-Fix: Mejoras en las funciones Ajax
-Lista de correos en menu panel cms
/**********************************************************
v.2.7.3(php7) - SEGURIDAD
-Comprobar datos de acceso de sesion
-Codigo de Seguridad
-Registro de usuario con codigo de activacion
-Encriptación del password
/**********************************************************
v.2.6.6
-Modificacion de variables
-Modificacion a la funcion: getRandomCode() y error_reporting()
-Formularios ajax modulo: servicios en ajax.
-Modulo contacto ajax - form v2.1.
/**********************************************************
v.2.6.3
-Se agregan funciones ajax.
-Se agrego la variable $frm=$_GET['frm'];
/**********************************************************
v.2.5.1
-Se agrego la funcion push_simple($enviar,$nombre,$mensaje).
-Funciones ajax para email(mensajes) en dashboard.
/**********************************************************
v.2.4.8
-Se agregaron nuevas varibles (wapp) en la tabla de config.
/**********************************************************
v.2.4.7
-Se agregaron nuevas varibles para la Liciencia del sistema.
-Se agrego funcion enciptar() y cil().
/**********************************************************
v.2.4.6
-Se agregaron nuevas varibles.
-Se agrego funcion slider().
/**********************************************************
//Colocar en lib.php
/*---------------------------------------------------------------------------------------------------------------------*/
//--VARIABLES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
//Funcion para quitar los Notice (Avisos) de PHP7
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
// Desactivar toda notificación de error
//error_reporting(0);

$year		= date('Y');
$month		= date('m');
$day		= date('d');
$time		= date('Gis');
$fecha		= date('Y-m-d');
$date		= date("Y-m-d H:i:s");
$serv_proto = (isset($_SERVER['SERVER_PROTOCOL']))?$_SERVER['SERVER_PROTOCOL']:''; //Protocolo de Internet
//$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://'; //Protocolo de Internet
$protocol   = (isset($_SERVER['HTTPS']))?'https://':'http://';  //Protocolo de Internet
$host		= $_SERVER['HTTP_HOST'];			//Nombre del dominio (dominio.com).
$ip_address = $_SERVER['REMOTE_ADDR'];			//Se obtiene la direccion ip del visitante de la pagina web.
$ip			= ($ip_address!='' && $ip_address!=NULL && $ip_address!='::1')?$ip_address:gethostbyname($host);
$IPv4 		= ip2long($ip);						//Direccion IPv4 
$pag_self 	= $_SERVER['PHP_SELF'];			    //Se obtiene la raiz y el nombre de la pagina.
$pag_url 	= $_SERVER['REQUEST_URI'];		    //Se obtiene la url de la pagina incluyendo variables.
$pag_name 	= basename($_SERVER['PHP_SELF']);   //Nombre de la pagina.
$refer 		= (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';
/*VARIABLES GET*/
$mod 		= (isset($_GET['mod']))?$_GET['mod']:'Home';
$ext 		= (isset($_GET['ext']))?$_GET['ext']:'';
switch(true){case($ext=='admin/index'):$ext2='admin';break;case($ext=='miembros/index'):$ext2='miembros';break;default:$ext2=$ext;break;}
$opc		= (isset($_GET['opc']))?$_GET['opc']:'';
$action 	= (isset($_GET['action']))?$_GET['action']:'';
$ctrl 		= (isset($_GET['ctrl']))?$_GET['ctrl']:'';
$frm 		= (isset($_GET['frm']))?$_GET['frm']:'';
$form		= (isset($_GET['form']))?$_GET['form']:'';//Variable para mostrar formulario crud
$id 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id general
$idp 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id producto
$idm		= (isset($_GET['idm']))?$_GET['idm']:'';//Variable de id para mail en formularios de contacto
$idf 		= (isset($_GET['idf']))?$_GET['idf']:'';//Variable bandera
$vhref 		= (isset($_GET['vhref']))?$_GET['vhref']:''; //Variable de seguimiento.
$tabla      = (isset($_GET['tabla']))?$_GET['tabla']:'';//Variable de Tabla. 

//$token = bin2hex(random_bytes(64));
$ver_file   = ($host=='localhost')?'ver='.$time:'ver='.$date;
$path_mod   = 'modulos/'.$mod.'/';
$path_jsonDB= 'bloques/webservices/rest/json/';
$path_jsonWS= 'bloques/ws/t/?t=';
$path_api = 'api/';
date_default_timezone_set("America/Mexico_City");


$path_root=sql_opc('config','path_root','ID',1);
/*Var Servidor en modo seguro*/ //$page_url=$dominio.$path_root; //$page_url=($mod=='Home')?$URL:$dominio.$path_root;
$page_url=(isset($_SERVER['HTTPS']))?'https://'.$host.$path_root:'http://'.$host.$path_root;
/***************************** CAMBIO DE DIAGONAL AL FINAL EN $pag_url ***************************/

//--FUNCIONES SISTEMA-///////////////////////////////////////////////////////////////////////////////
/*CONFIGURACION*/
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."config WHERE ID='1';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	$logo=$row['logo'];
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
	//$tel2=$row['tel2'];
	$phone=$row['phone'];
	$wapp=$row['wapp'];
	$webMail=$row['webMail'];
	$contactMail=$row['contactMail'];
	//$contactMail2=$row['contactMail2'];
	$mode=$row['mode'];
	$chartset=$row['chartset'];
	$dboard=$row['dboard'];
	$dboard2=$row['dboard2'];
	$direc=$row['direc'];
	//$direc2=$row['direc2'];	
	$CoR=$row['CoR'];
	$CoE=$row['CoE'];
	$BCC=$row['BCC'];
	$CoP=$row['CoP'];
	$fb_web=$row['fb'];
	$tw_web=$row['tw'];
	$gp_web=$row['gp'];
	$lk_web=$row['lk'];
	$yt_web=$row['yt'];
	$ins_web=$row['ins'];
	$ls_web=$row['licencia'];
	$ver_web=$row['version'];
}

$https_dominio     = 'https://'.$host.'/';
$protocolo_dominio = ($dominio==$https_dominio)?'https://'.$host:'http://'.$host; 

$dominio    = $protocolo_dominio.'/';       //Dominio Estructurado
$dominio1   = $protocolo_dominio;           //Dominio Simple
$url        = $dominio1.$pag_self;			//Se obtiene la url de la pagina.
$URL        = $dominio1.$pag_url;			//Se obtiene la url completa, incluyendo variables.

/*Meta*/
$meta_chartset='
<!--Caracteres-->
<meta charset="'.$chartset.'">
<!--meta http-equiv="Content-Type" content="text/html; charset='.$chartset.'" /-->
';
/*TEMA*/
$sql_tema=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."temas WHERE selec='1';") or print mysqli_error($mysqli); 
$cont_tema=mysqli_num_rows($sql_tema);
if($cont_tema!=0){
	while($rowtema=mysqli_fetch_array($sql_tema)){
		$tema=$rowtema['tema'];
		$subtema=$rowtema['subtema'];
	}
}else{echo '<div>No hay Tema para la p&aacute;gina.!</div>';}
/*CAMBIO DE TEMA TEMPORAL----------------------------------------------------------------------------*/
//comprobar($form_login,$log_usuarios,$sal,$ses,$log,$U,$P);
//user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
//$tema = ($tema_login!='')?$tema_login:$tema;
/*---------------------------------------------------------------------------------------------------*/
$tema_previo=(isset($_GET['tema_previo']))?$_GET['tema_previo']:'';
$tema = ($tema_previo!='')?$tema_previo:$tema;
$tema = ($subtema!='' && $subtema!=NULL)? $tema.'/'.$subtema : $tema;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones WHERE nom='wordpress';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){$valor=$row['valor'];}
$path_t=($valor==1)?'wp-content/themes/':'temas/';
$path_tema=$path_t.$tema.'/';
$ruta_mod='modulos/'.$mod.'/';

/*CONSULTA MODULO*/
$sql_mod=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos WHERE modulo='{$mod}';") or print mysqli_error($mysqli); 
$cont_mod=mysqli_num_rows($sql_mod);
if($cont_mod==0){
	//echo '<div id="alert-system"><div class="alert">El modulo no existe en la DB! '.$back.'</div></div>';
	header('Location: '.$page_url.'404.php');
}else{
	if($row_mod=mysqli_fetch_array($sql_mod)){
		$ID_mod=$row_mod['ID'];
		$nombre_mod=$row_mod['nombre'];
		$modulo_mod=$row_mod['modulo'];
		$description_mod=$row_mod['description'];
		$dashboard_mod=$row_mod['dashboard'];
		$nivel_mod=$row_mod['nivel'];
		$home_mod=$row_mod['home'];
		$visible_mod=$row_mod['visible'];
		$activo_mod=$row_mod['activo'];
		$sname_mod=$row_mod['sname'];
		$icono_mod=$row_mod['icono'];
		$link_mod=$row_mod['link'];
		$qmod=$modulo_mod;
	}
}

/*---VARIABLES DE PAGINA---*/
$style='<link href="'.$page_url.'assets/css/style.css" rel="stylesheet" type="text/css">'."\r\n";
$font_awesome='<link href="'.$page_url.'assets/css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">'."\r\n";
$bootstrap='<link href="'.$page_url.'assets/bootstrap/bootstrap.css" rel="stylesheet" type="text/css">'."\r\n";
$bootstrapjs='<script src="'.$page_url.'assets/bootstrap/bootstrap.js" type="text/javascript" language="javascript"></script>'."\r\n";
$javascript='<script src="'.$page_url.'assets/js/main.js" type="text/javascript" language="javascript"></script>'."\r\n";
$jQuery='<script src="'.$page_url.'assets/jq/jQuery.js"></script>'."\r\n";
$jQuery10='<script src="https://code.jquery.com/jquery-1.10.2.js"></script>'."\r\n";
$base_target='<base target="_blank">'."\r\n";
$back='<a href="javascript:history.go(-1);">Regresar</a>';
$back2='<a href="'.$page_url.'">Regresar Inicio</a>';
$inicio='<a href="'.$page_url.'">Inicio</a>';
$admin='<a href="'.$page_url.'admin/">Admin</a>';
$login='<a href="'.$page_url.'login/">Login</a>';
/*---VARIABLES PARA ADMIN-LTE---*/
$path_dashboard='apps/dashboards/'.$dboard2.'/';//$path_LTE='assets/plugins/AdminLTE/';
/*---CODE LICENCE---*/
$ncod='x31q2';
$cms=substr($ls_web,0,3);
/*--- VARIABLES BLOQUEO-IP ---*/
$ip_block=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."ipbann WHERE ip='".$ip."';") or print mysqli_error($mysqli);
$num_block=mysqli_num_rows($ip_block);
if($num_block!=0){
	if($rowip=mysqli_fetch_array($ip_block)){
		$BLOCK=$rowip['bloqueo'];
	}
}else{
	$cil=$ls_web;
	if($cil==''){$BLOCK=1;}
}

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
/////////////////////////////////////////////////////////////////////////////////////////////////
function todo($tabla){
	$sql = 'SELECT * FROM '.$tabla.' ORDER BY ID ASC';
	return @mysqli_query(conexion(),$sql);
}

function consulta($tabla=NULL,$condiciones=NULL){
	if($tabla==NULL || $condiciones==NULL){
		die('Debe proporcionarse la tabla y las condiciones de b&uacute;squeda.');
		exit();
	}
	$sql = "SELECT * FROM ".$tabla." WHERE ".$condiciones;
	if($recurso = mysqli_query(conexion(),$sql)) return $recurso;
	else return FALSE;
}

function borrar($tabla=NULL,$condiciones=NULL){
	echo "Tabla: ".$tabla;
	echo "<br>Condiciones: ".$condiciones;
	if($tabla==NULL || $condiciones==NULL){
		die('Debe proporcionarse la tabla y las condiciones de b&uacute;squeda.');
		exit();
	}
	$sql= "DELETE FROM ".$tabla." WHERE ".$condiciones;	
	$recurso = mysqli_query(conexion(),$sql);
	return mysql_affected_rows();
}

function consulta_tabla_ID($tabla,$ID,&$row){
global $mysqli,$DBprefix;
	$query="SELECT * FROM ".$DBprefix.$tabla." WHERE ".$ID.";";
	$sql=mysqli_query($mysqli,$query) or print mysqli_error($mysqli);
	$array_campos=array();
	if($r=mysqli_fetch_assoc($sql)){$array_campos[] = $r;}
	$row=array_unique($array_campos[0]);
}
/////////////////////////////////////////////////////////////////////////////////////////////////


//Validación
function validacion_tabla($tabla){
global $bootstrap,$DBprefix;
$mysqli=conexion();
    if($tabla!='signup' && $tabla!=NULL){
        $sql = mysqli_query($mysqli,"DESCRIBE ".$DBprefix.$tabla.";");
        if($sql){
            return $tabla=($tabla==$DBprefix.'signup')?$tabla:$DBprefix.$tabla;
        }else{
            echo $bootstrap.'<div class="alert alert-danger"><b>ERROR:</b> La Tabla no existe.<div>';exit();
        }
    }else{
        echo $bootstrap.'<div class="alert alert-warning"><b>PRECAUCIÓN:</b> No hay datos que mostrar<div>';exit();
    }
}
//validacion_tabla();

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
//FUNCIONES PARA API REST ////////////////////////////////////////////////////////////////////////////

//INDEX
function all(){
global $conec,$DBprefix,$tabla;
    $sql = $conec->prepare("SELECT * FROM $tabla");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data=$sql->fetchAll();//$data[]=$json;
    //mysqli_set_charset($conec, 'utf8');
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($data);
}

function all_tabla(){
global $conec,$DBprefix,$tabla;
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
global $conec,$DBprefix,$tabla;
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
global $conec,$DBprefix,$tabla;
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
      //header("HTTP/1.1 200 OK");
      //header('Content-Type: application/json');
	  //echo json_encode($input);
	  $save=1;
	}else{$save=null;}
	return $save;    
}

//UPDATE
function update($id){
global $conec,$DBprefix,$tabla,$chartset;
    $input = $_POST; 
    $postId = $id; 
    $fields = getParams($input); //echo $fields;//exit();
    $sql = "UPDATE $tabla SET $fields WHERE ID='$postId'";
    $statement = $conec->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    //header("HTTP/1.1 200 OK");
    //header('Content-Type: application/json');
	//echo json_encode($input);
	if($statement){$save=1;}else{$save=null;}
	return $save;
}

//DELETE
function delete($id){
global $conec,$DBprefix,$tabla;
    $statement = $conec->prepare("DELETE FROM $tabla where ID=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    echo 'El registro '.$id.' ha sido eliminado.';  
}
/*
//BORRAR
function borrar($id){
global $DBprefix,$tabla;
	if($id){
  		$sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix.$tabla." WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'El registro ha sido borrada '.$id;  
	}
}
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////

//--FUNCIONES CRUD JSON--//////////////////////////////////////////////////////////////////////////////
//FUNCION DATA 
function query_data($tabla,$url_api){
global $page_url,$path_jsonDB,$path_jsonWS;
    $path_JSON=$path_jsonDB.$tabla.'.json';
    if(!file_exists($path_JSON)){$path_JSON=$page_url.$path_jsonWS.$tabla;}
    $path_JSON=($url_api)?$url_api:$path_JSON;//echo $path_JSON;
    $objData=file_get_contents($path_JSON);//*Tarda consulta
    $Data=json_decode($objData,true);//usort($Data, function($a, $b){return strnatcmp($a['ord'], $b['ord']);});//Orden del menu
    return $Data;
}

function query_data2($ord,$tabla,$url_api){
global $page_url,$path_jsonDB,$path_jsonWS;
    $path_JSON=$path_jsonDB.$tabla.'.json';
    if(!file_exists($path_JSON)){$path_JSON=$page_url.$path_jsonWS.$tabla;}
    $path_JSON=($url_api)?$url_api:$path_JSON;//echo $path_JSON;
    $objData=file_get_contents($path_JSON);//*Tarda consulta
	$Data=json_decode($objData,true);
	usort($Data, function($a, $b){return strnatcmp($a[$ord], $b[$ord]);});//Orden 
    return $Data;
}

function ws_query_data($query,$ajax,$d,$rest){
global $mysqli,$DBprefix,$page_url,$URL,$mod,$ext,$id,$idp,$idf,$opc,$action;
	if($ajax==1){mysqli_set_charset($mysqli, 'utf8');}
 	$sql=mysqli_query($mysqli,$query) or print mysqli_error($mysqli);
 	$json = array();
 	while($row = mysqli_fetch_assoc($sql)){$json[]=$row;}
 	if($ajax==1){
 		$data=($d!=1)?json_encode($json):json_encode($json[0]);
 	}else{
 		$data=json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
 		header('Content-Type: application/json');
	}
	if($rest==1){echo $data;}else{
		$Data=json_decode($data,true);//usort($Data, function($b, $a){return strnatcmp($a['ID'], $b['ID']);});//Orden
		return $Data;
	}  	
}

//[LISTAR/INDEX] MOSTRAR TODA LA TABLA CON CONTROLES CRUD 
function query_all_tabla($tabla,$url_api,$crud){
global $page_url,$path_jsonDB,$path_jsonWS;//echo $tabla;
    $display=($crud!=0)?'':'none';
    $data=query_data($tabla,$url_api);//print_r($data);
    //CAMPOS
    $i=0;
    foreach($data as $key){$i++;
        if($i==1){
            foreach($key as $datos=>$value){
                $campos.='<th>'.$datos.'</th>'."\n";
            }  
        }  
    }
    $campos.='<th style="display:'.$display.';">Acciones</th>'."\n";
    echo '<tr>'.$campos.'</tr>'."\n";
    //DATOS
    foreach($data as $key => $value){        
        //if($key!=0){
            $row=$data[$key];$key=$row['ID'];
            echo '<tr id="'.$key.'">'."\n";   
            foreach($row as $datos=>$value){//echo '<td>'.$row[$datos].'</td>'."\n";
                echo '<td>'.str_limit($value,28,'...').'</td>'."\n";
            }
            echo '<td style="display:'.$display.';"><button class="btn btn-secondary btn-edit"><i class="fa fa-edit"></i></button> | <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></td>';
            echo '</tr>'."\n";
        //}
    }
}

//[LISTAR/INDEX] MOSTRAR TABLA CON CONFIGURACION DE CAMPOS, ORDEN-ID Y CONTROLES CRUD
//EXAMPLE: query_tabla($index='ID',$th,$tabla,$url_api,$crud=1);
function query_tabla($index,$th,$tabla,$url_api,$crud){
global $page_url,$path_jsonDB,$path_jsonWS;
    $display=($crud!=0)?'':'none';
    $data=query_data($tabla,$url_api);//print_r($data);
    usort($data, function($a, $b){global $index;return strnatcmp($a[$index], $b[$index]);});//Orden por ID
    //CAMPOS
    $i=0;$campos='<th style="display:'.$display.';">Acciones</th>'."\n";
    if($th!=''){
        for($j=0;$j<count($th);$j++){
            $campos.='<th>'.$th[$j].'</th>'."\n";
        }
    }else{
        foreach($data as $key){$i++;
            if($i==1){
                foreach($key as $datos=>$value){
                    $campos.='<th>'.$datos.'</th>'."\n";
                }  
            }  
        }   
    }
    echo '<tr>'.$campos.'</tr>'."\n";
    //DATOS
    foreach($data as $key => $value){
        //if($key!=0){
            $row=$data[$key];if($index!=''){$key=$row['ID'];}
            echo '<tr id="'.$key.'">'."\n";
            echo '<td style="display:'.$display.';"><button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#addVcard"><i class="fa fa-edit"></i></button> | <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></td>';   
            if($th!=''){
                for($j=0;$j<count($th);$j++){$datos=$th[$j];
                    echo '<td>'.$row[$datos].'</td>'."\n";
                }
            }else{
                foreach($row as $datos=>$value){//echo '<td>'.$row[$datos].'</td>'."\n";
                    echo '<td>'.$value.'</td>'."\n";
                }
            }
            echo '</tr>'."\n";
        //}
    }
}

//EXAMPLE: query_tabla2($index='ID',$th,$thc=0,$tabla,$url_api,$crud=0);
function query_tabla2($index,$th,$thc,$tabla,$url_api,$crud){
global $page_url,$path_jsonDB,$path_jsonWS;
    $display=($crud!=0)?'':'none';
    $data=query_data($tabla,$url_api);//print_r($data);
    usort($data, function($a, $b){global $index;return strnatcmp($a[$index], $b[$index]);});//Orden por ID
    //CAMPOS
    $i=0;$campos='<th style="display:'.$display.';">Acciones</th>'."\n";	
	if($th!=''){
        for($j=0;$j<count($th);$j++){
            $campos.='<th>'.$th[$j].'</th>'."\n";
        }
    }else{
        foreach($data as $key){$i++;
            if($i==1){
                foreach($key as $datos=>$value){
                    $campos.='<th>'.$datos.'</th>'."\n";
                }  
            }  
        }   
	}
	if($thc==1){echo '<thead><tr>'.$campos.'</tr></thead>'."\n";}
    //DATOS
    foreach($data as $key => $value){
        //if($key!=0){
            $row=$data[$key];if($index!=''){$key=$row['ID'];}
            echo '<tbody><tr id="'.$key.'">'."\n";
            echo '<td style="display:'.$display.';"><button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#addVcard"><i class="fa fa-edit"></i></button> | <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></td>';   
            if($th!=''){
                for($j=0;$j<count($th);$j++){$datos=$th[$j];
                    echo '<td>'.$row[$datos].'</td>'."\n";
                }
            }else{
                foreach($row as $datos=>$value){//echo '<td>'.$row[$datos].'</td>'."\n";
                    echo '<td>'.$value.'</td>'."\n";
                }
            }
            echo '</tr></tbody>'."\n";
        //}
    }
}

//BUSCAR CON AJAX
function query_buscar($tabla,$url_api,$campo,$val){
    $data=query_data($tabla,$url_api);
    //DATOS
    foreach($data as $key => $value){
        $row=$data[$key];
        $b_val = $data[$key][$campo];
        $valor = ucwords($val);
        $bus   = strpos($b_val, $valor);
        if($bus==$val){//$index=$key;           
            echo '
            <div class="public-user-block block">
            <div class="row d-flex align-items-center">                   
              <div class="col-lg-4 d-flex align-items-center">
                <div class="order">'.$row['ID'].'</div>
                <div class="avatar" style="background:url('.$row['cover'].');background-repeat:no-repeat;background-size:cover;background-position:center;"></div>
                <a href="'.$page_url.'profile/'.$row['profile'].'" class="name">
                  <strong class="d-block">'.$row['nombre'].'</strong>
                  <span class="d-block">'.$row['profile'].'</span>
                </a>
              </div>
              <div class="col-lg-4 text-center">
                <div class="contributions">'.$row['puesto'].'</div>
              </div>
              <div class="col-lg-4">
                <div class="details d-flex">
                  <div class="item"><i class="fa fa-calendar"></i><strong>'.$row['f_create'].'</strong></div>
                </div>
              </div>
            </div>
          </div>
            ';
        }
    }
}

//[GET-SHOW][ID] Buscar ID/CAMPO y Mostrar un registro ///////////////////////////////////////////////
function query_row($tabla,$campo,$id){
    $data=query_data($tabla,$url_api);
    //DATOS
    foreach($data as $key => $value){
        $b_id=$data[$key][$campo];
        if($b_id==$id){//$index=$key;
            $row=$data[$key];
        }
    }
    return $row;
}

function sql_row($tabla,$campo,$id){
global $mysqli,$DBprefix;
    $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." WHERE {$campo}='{$id}';") or print mysqli_error($mysqli);
    $array_campos=array();
    if($r=mysqli_fetch_assoc($sql)){$array_campos[] = $r;}
    //$row=array_unique($array_campos[0]);
    return $r;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//Buscar un valor en especifico ////////////////////////////////////////////////////////////////////////
function query_opc($tabla,$campo,$opcion,$val){
    $data=query_data($tabla,$url_api);
    foreach($data as $key => $value){
        $selec=$data[$key][$opcion];
        if($selec==$val){$dato=$data[$key][$campo];}
    }
    return $dato;    
}

function sql_opc($tabla,$campo,$opcion,$val){
global $mysqli,$DBprefix;//$mysqli=conexion();
    $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." WHERE {$opcion}='{$val}';") or print mysqli_error($mysqli); 
    if($row=mysqli_fetch_array($sql)){$dato=$row[$campo];}
    return $dato;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////

  
/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
function variables(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;
}

function encriptar($ls_web1,&$ls_encrip){
global $ncod,$ver_web;
 $l=-5;
 for($i=1;$i<=9;$i++){$l+=5;
	$ls_encrip.=substr($ls_web1.'.'.$ver_web,$l,5).$ncod;
 }
}
//encriptar($ls_web1,$ls_encrip);
function cil(&$cil,&$sas_lic,&$control,&$vence,&$tcil,&$pw_admin){
global $ls_web,$ncod,$cms;
 if($cms!='cms'){/*LICENCIA STANDAR*///$standar='X01X-XX19-X05X-XX12';
 	$sas_lic=$ls_web;
 	$control=substr($sas_lic,1,2);
 	$d=substr($sas_lic,-2,2);
 	$m=substr($sas_lic,11,2);
 	$y=substr($sas_lic,7,2);
 	$vence='20'.$y.'-'.$m.'-'.$d;
	$tcil='standar';
 }else{/*DESENCRIPTAR LICENCIA*/
 	$sas_lic=str_replace($ncod,'',$ls_web);
 	$control=substr($sas_lic,-8,2);
 	$fvence=substr($sas_lic,-19,10);
 	$vence=str_replace('.','-',$fvence);
  	$pw_admin=substr($sas_lic,12,9);
	$tcil='prueba';
 }
$cil=$sas_lic;
}
cil($cil,$sas_lic,$control,$vence,$tcil,$pw_admin);

function get_client_ip() {
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function listar_directorios_ruta($ruta){
global $mysqli,$DBprefix,$mod,$ext,$id,$idp,$idf,$opc,$action,$dboard;
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) { 
      if ($dh = opendir($ruta)) { 
         while (($file = readdir($dh)) !== false){ $i++; 
			if (is_dir($ruta.$file) && $file!="." && $file!=".."){
				if($mod=='sys' && $ext=='admin/index'){
					$num_reg=($file==$dboard)?1:0;
				}else{
					$sql_modu=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos WHERE modulo='{$file}' AND ID='{$_GET[id]}';") or print mysqli_error($mysqli); 
					$num_reg=mysqli_num_rows($sql_modu);
				}
				$sel=($num_reg==1)?'selected':'';
				$carpeta.= '<option value="'.$file.'" '.$sel.'>'.$file.'</option>';
			}
         } 
      closedir($dh); 
      } 
   }else{echo '<option>Ruta NO valida</option>';}
echo $carpeta;   
}

function select_dashboard($ruta){
global $mysqli,$DBprefix,$mod,$ext,$id,$idp,$idf,$opc,$action,$dboard;
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) { 
      if ($dh = opendir($ruta)) { 
         while (($file = readdir($dh)) !== false){ $i++; 
			if (is_dir($ruta.$file) && $file!="." && $file!=".."){
				$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."config;") or print mysqli_error($mysqli); 
				if($row=mysqli_fetch_array($sql)){$dash=$row['dboard2'];}
				$sel=($dash==$file)?'selected':'';
				$carpeta.= '<option value="'.$file.'" '.$sel.'>'.$file.'</option>';
			}
         } 
      closedir($dh); 
      } 
   }else{echo '<option>Ruta NO valida</option>';}
echo $carpeta;   
}

function select_modulos($modulo1,$mod_switch){
global $mysqli,$DBprefix,$mod;
 if($mod_switch==1){
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos ORDER BY modulo ASC;") or print mysqli_error($mysqli); 
	while($row=mysqli_fetch_array($sql)){
		$nombre=$row['nombre'];
		$modulo=$row['modulo'];
		$sel=($modulo==$modulo1)?' selected':'';
		echo '<option value="'.$modulo.'"'.$sel.'>'.$nombre.'</option>';
	}
 }else{
	$ruta='./modulos/';
	if(is_dir($ruta)){
		if($dh=opendir($ruta)){
			while(($file=readdir($dh))!==false){$i++;
				if(is_dir($ruta.$file) && $file!="." && $file!=".."){
					$modulo=$file;
					$sel=($modulo==$modulo1)?' selected':'';
					echo '<option value="'.$modulo.'"'.$sel.'>'.$modulo.'</option>';
				}
			} 
      		closedir($dh); 
      	} 
	}else{echo "<div>No es ruta valida</div>";}
 }
}

function navegador(){
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME","TRIDENT","PHOENIX","FIREBIRD","OPR","OPERA/","PRESTO","MAXTHON");
	$os=array("WIN","MAC","LINUX","OS/2","BeOS","ANDROID","IPHONE");
	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";
	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent){
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s){
			if($parent=="TRIDENT"){$parent="INTERNET EXPLORER";}
			if($parent=="OPR" || $parent=="OPERA/" || $parent=="PRESTO"){$parent="OPERA";}
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
	}
	# obtenemos el sistema operativo
	foreach($os as $val){
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			//if($val=="WIN"){$val="WINDOWS";}
			$info['os'] = $val;
	}
	# devolvemos el array de valores
	return $info;
}

function geoiploc(){global $host;
error_reporting(E_ALL & ~E_NOTICE);
sql_opciones('geo_loc_visitas',$valor);
if($valor==1){include("geoiploc/geoiploc.php");}
  if (empty($_POST['checkip'])){
	$ip_addr = $_SERVER["REMOTE_ADDR"];
	$ip=($ip_addr!='' && $ip_addr!=NULL && $ip_addr!='::1')?$ip_addr:gethostbyname($host);
  }
  else{
	$ip = $_POST['checkip']; 
  }
$country=getCountryFromIP($ip, " NamE");
$code_pais=getCountryFromIP($ip, "code");
$country=$country.'-'.$code_pais;
return $country;
}

function log_visitas($username){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer;
sql_opciones('geo_loc_visitas',$valor);
if($valor==1){$country=geoiploc();}else{$country='';}
$info=navegador();
$_POST['refer']=$URL;
if($refer==''){$refer=$_POST['refer'];}
//$username=$_SESSION['id'];
$ext=(isset($_GET['ext']))?$_GET['ext']:'';
mysqli_query($mysqli,"INSERT INTO ".$DBprefix."visitas (info_nave,navegador,version,os,pais,user,IPv4,ip,page,refer,vhref,modulo,ext,idp,salida_pag,fecha) VALUES ('".$_SERVER['HTTP_USER_AGENT']."','".$info["browser"]."','".$info["version"]."','".$info["os"]."','{$country}','{$username}','{$IPv4}','{$ip}','{$URL}','{$refer}','{$vhref}','{$mod}','{$ext}','{$idp}','{$date}','{$date}')") or print mysqli_error($mysqli);
}
//log_visitas($username);

function sql_opciones($opcion,&$valor){
global $mysqli,$DBprefix;
$mysqli=conecta();
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones WHERE nom='{$opcion}';") or print mysqli_error($mysqli); 
	if($row=mysqli_fetch_array($sql)){$valor=$row['valor'];}
}

function buscar_archivo($path_file,&$link_file,&$aviso){
global $page_url,$mod,$ext;
 if(file_exists($path_file)){
	$aviso='El archivo existe.';
	$link_file=$page_url.$path_file;
 }else{
	$aviso='El archivo no existe.';
	$link_file=$page_url.'#';
 }
}

//crear_archivo($path_f,$nombre_archivo,$contenido,&$path_file)
function crear_archivo($path_f,$nombre_archivo,$contenido,&$path_file){
//$path_f='';$nombre_archivo='';$contenido='';
$path_file=$path_f.$nombre_archivo;
$archivo=fopen($path_file, "w+");
fwrite($archivo, $contenido);
fclose($archivo);
}

/*|///CREAR JSON///|*/
//crear_json('consulta','path_ruta','nombre_archivo')
function crear_json($query,$path_f,$nombre_archivo){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$id,$idp,$idf,$opc,$action;
$sql=mysqli_query($mysqli,$query) or print mysqli_error($mysqli);
$rows=array();
while($r=mysqli_fetch_assoc($sql)){$rows[] = $r;}
$contenido=json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$aviso=($contenido!='')? '<div>Se han capturados los datos.</div>': '<div style="color:#f00;">Error: No se han capturados los datos.</div>';
crear_archivo($path_f,$nombre_archivo,$contenido,$path_file);
if(file_exists($path_file)){$aviso.='<div>Se ha creado el archivo ('.$nombre_archivo.') correctamente.</div>';}else{$aviso.='<div>No se ha creado el archivo ('.$nombre.') correctamente.</div>';}
echo $aviso;
}

/*|///LEER JSON///|*/
function leer_json_php($tabla,&$Data){
global $page_url,$username,$nivel_login;
$tabla_json=$tabla.'.json';
$path_JSON='bloques/webservices/rest/json/'.$tabla_json;
if(!file_exists($path_JSON)){sql_opciones('link_var',$valor);$path_JSON=($valor==1)?$page_url.'bloques/ws/t/?t='.$tabla:$page_url.'bloques/ws/t/'.$tabla.'/';}
echo $rut_origen=($nivel_login!=-1)?'<!-- '.$tabla_json.' -->'."\n\r":'<!-- '.$tabla_json.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 }
}

function file_json($tabla,&$path_JSON){
global $page_url,$username,$nivel_login;
$tabla_json=$tabla.'.json';
$path_JSON='bloques/webservices/rest/json/'.$tabla_json;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t='.$tabla;}
echo $rut_origen=($nivel_login!=-1)?'<!-- '.$tabla_json.' -->'."\n\r":'<!-- '.$tabla_json.' URL:('.$path_JSON.')-->'."\n\r";
}

function mostrar_api_version(){
//$path_JSON='https://phponix.webcindario.com/bloques/ws/t/?t=api_version';
file_json('api_version',$path_JSON);
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 	$i=0;$n=0;
	foreach ($Data as $rowm1){$n++;}
	echo '<!-- Total:'.$n.' -->';
	if($n!=0){
		foreach ($Data as $rowm){$i++;
			$ID=$rowm['ID'];
			$nom_ver=$rowm['nom'];
			$vencimiento=$rowm['vence'];
			$ultimate=$rowm['ultimate'];
			$status=$rowm['status'];
			$des_ver=$rowm['des_ver'];
			//if($visible==1){}
			echo '<tr><td>'.$ID.'</td><td>'.$nom_ver.'</td><td>'.$vencimiento.'</td><td>'.$ultimate.'</td><td>'.$status.'</td><td>'.$des_ver.'</td></tr>';
	 	}
	}else{echo '<div>No hay datos que mostrar.</div>';}
 }
}

function api_version(&$nom_ver,&$vencimiento,&$ultimate,&$status,&$des_ver){
//$path_JSON='http://phponix.webcindario.com/bloques/ws/t/?t=api_version';
file_json('api_version',$path_JSON);
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 	$i=0;$n=0;
	foreach ($Data as $rowm1){$n++;}
	//echo '<!-- Total:'.$n.' -->';
	if($n!=0){
		foreach ($Data as $rowm){$i++;
			$ID=$rowm['ID'];
			$nom_ver=$rowm['nom'];
			$vencimiento=$rowm['vence'];
			$ultimate=$rowm['ultimate'];
			$status=$rowm['status'];
			$des_ver=$rowm['des_ver'];
			//if($visible==1){}
	 	}
	}//else{echo '<div>No hay datos que mostrar.</div>';}
 }
}

/*|///WEBSERVICES///|*/
function ws_tabla($tabla,$ajax){
global $mysqli,$DBprefix,$page_url,$URL,$mod,$ext,$id,$idp,$idf,$opc,$action;
 if($ajax==1){mysqli_set_charset($mysqli, 'utf8');}
 if($tabla!='signup'){
	 $query="SELECT * FROM ".$DBprefix.$tabla."";
 }else{
	 echo '<div>No hay datos que mostrar.</div>';exit();
 }
 $sql=mysqli_query($mysqli,$query) or print mysqli_error($mysqli);
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
global $mysqli,$DBprefix,$page_url,$URL,$mod,$ext,$id,$idp,$idf,$opc,$action;
 if($ajax==1){mysqli_set_charset($mysqli, 'utf8');}
 $sql=mysqli_query($mysqli,$query) or print mysqli_error($mysqli);
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

function validacion_json($path_JSON,&$Data){
sql_opciones('validacion_json',$valor);
 if($valor==1){
	$rCURL = curl_init();
	curl_setopt($rCURL, CURLOPT_URL, $path_JSON);
	curl_setopt($rCURL, CURLOPT_HEADER, 0);
	curl_setopt($rCURL, CURLOPT_RETURNTRANSFER, 1);
	$aData = curl_exec($rCURL);
	curl_close($rCURL);
	$Data=json_decode($aData,true);
 }else{
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);  
 }
}

function pages($mod,$ext,&$contenido,&$activo){
global $mysqli,$DBprefix;
$cond=($ext!='')?"modulo='{$mod}'":"modulo='{$mod}' AND ext='{$ext}'";
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."pages WHERE ".$cond." AND activo=1;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$id_h=$row['ID'];
	$titulo=$row['titulo'];
	$contenido=$row['contenido'];
	$alta=$row['alta'];
	$fmod=$row['fmod'];
	$url_page=$row['url'];
	$activo=$row['activo'];
 }
}

//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
function validar_aviso($save,$msj_bien,$msj_mal,&$aviso){
		if($save){
			$aviso='
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Correcto!</h4> '.$msj_bien.'.
            </div>
			';
		}else{
			$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> '.$msj_mal.'.
			</div>
			';
		}
}

function validar_aviso2($save,$msj_bien,$msj_mal,&$aviso){
		if($save){
			$aviso='
			<div class="alert alert-success alert-dismissible">
                <b><i class="icon fa fa-check"></i> Correcto!</hb> '.$msj_bien.'.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            </div>
			';
		}else{
			$aviso='
			<div class="alert alert-danger alert-dismissible">
                <b><i class="icon fa fa-ban"></i> Error!</b> '.$msj_mal.'.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			</div>
			';
		}
}

function recargar($seg,$URL,$target){
$target=($target!='')?$target:'_parent';
echo '<script>
var cont='.$seg.';
var ida=true;
setTimeout("entrar()",1000);
function entrar(){
	if(cont>-1 && ida==true){cont-=1;}
	else{ida=false;}
	if(cont==0){ventana = window.open("'.$URL.'","'.$target.'");}
	setTimeout("entrar()",1000);
}
</script>';
}

function fecha_php(){
global $fecha;
echo '
<script language="JavaScript">
//Configuracion de la funcion: [hora.js].
function fecha(){
var dt = new Date();
var hora = dt.getHours();
var minuto = dt.getMinutes();
var segundo = dt.getSeconds();
var valtime = ((hora<10)? "0" : "")+hora;
valtime += ((minuto<10)? ":0" : ":")+minuto;
valtime += ((segundo<10)? ":0" : ":")+segundo;
tiempo = setTimeout(\'fecha()\',1000)
//document.getElementById("fecha").innerHTML = "'.$fecha.' " + valtime;}
document.getElementById("fecha").value = "'.$fecha.' " + valtime;}
window.onload = fecha;
</script>';
}

function jQuery(){
global $jQuery10;
	echo '<!--jQuery 1.10.2 servidor CDN-->';
	echo $jQuery10;
	echo '<!--Fin de jQuery 1.10.2-->';
}

function basic_page(){
global $style,$javascript;
echo $style;
echo $javascript;
}

function style(){
global $page_url,$tema,$path_t,$path_tema,$date;
include ('assets/css/style.php');
}

function style_var($css){
global $page_url,$tema,$path_t,$path_tema,$date;
include ('assets/css/style-var.php');
}

function css_web(){
global $mysqli,$DBprefix,$url,$page_url,$mod,$ext,$opc,$tema,$path_tema,$tema_previo;
$css2='css2';
$path_JSON='bloques/webservices/rest/json/'.$css2.'.json';
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t='.$css2;}
	if($path_JSON){
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);
	usort($Data, function($a, $b){return strnatcmp($a['ID'], $b['ID']);});//Orden del menu
	$i=0;
	//if($_SESSION['level']!=-1){echo '<!-- .json -->'."\n\r";}else{echo '<!-- .json URL:('.$path_JSON.')-->'."\n\r";}	
		foreach ($Data as $rowm){$i++;
			$ID_css=$rowm['ID'];
			$nom_css=$rowm['nom'];
			$contenido_css=$rowm['contenido'];
			$visible=$rowm['visible'];			
			if($visible==1){
				$css_web.='--'.$nom_css.':'.$contenido_css.';'."\r\n";
			}
		}
		$root_var='/*css-vars*/
:root{
 '.$css_web.'
}';
		return $root_var; 
	}
}

function style_tema(){
global $tema;
	$row=query_row('css','tema',$tema);//print_r($row);
	$css='/*css-vars*/
:root{
  --c-bg:'.$row['fondo'].';
  --f-family:'.$row['fuente'].';
  --f-size:'.$row['size'].';
  --f-color:'.$row['color'].';
}
*{
  font-family: var(--f-family);
}
body{
  background:var(--f-bg);
  font-size:var(--f-size);
  color:var(--f-color);
  line-height: 26px;
  margin: 0;
}
	';
	return $css;
}

function open_page_form(){
global $logo,$page_name,$page_url,$path_t,$path_tema;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
echo '<html>'."\r\n";
echo '<head><title>'.$page_name.' - Login</title>'."\r\n";
echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'."\r\n";
echo '<link rel="shortcut icon" type="image/x-icon" href="'.$page_url.'favicon.ico">'."\r\n";
basic_page();
echo $bootstrap.'
<link rel="stylesheet" type="text/css" href="'.$page_url.'assets/css/bg_sesion.css" />
<style>	
	@import url(https://fonts.googleapis.com/css?family=Raleway:400,700);
	body {
		background: #eee url('.$page_url.$path_tema.'images/bg/1.jpg) no-repeat center top;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
	}
	.container > header h1,
	.container > header h2 {
		color: #fff;
		text-shadow: 0 1px 1px rgba(0,0,0,0.7);
	}
</style>
'."\r\n"; 
echo '</head>'."\r\n";
echo '<body>'."\r\n";
}

function open_page(){
global $logo,$page_name,$page_url;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
echo '<html>'."\r\n";
echo '<head><title>'.$page_name.'</title>'."\r\n";
echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'."\r\n";
echo '<link rel="shortcut icon" type="image/x-icon" href="'.$page_url.'favicon.ico">'."\r\n";
basic_page();
echo '</head>'."\r\n";
echo '<body>'."\r\n";
}

function close_page(){
	echo "\r\n";
	echo '</body></html>';
}

function page_index(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;
global $dominio,$dominio1;
if($url==$dominio.$path_root || $url==$dominio.$path_root.'index.php' && $cont_tema!=0){
		//echo 'Ruta del tema: /'.$path_tema.'index.php';
		include ('./'.$path_tema.'index.php');
		
	}
	else{
		basic_page();
		echo '<div>'.$url.' = '.$dominio.$path_root.'index.php</div>';
		echo 'Ruta del tema: /'.$path_tema.'index.php';
		echo '<div class="alert">La pagina no existe! <span>'.$avi.'</span> '.$back.' </div>';
	}	
}

function listar_archivos(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);

$mod=$_GET['mod'];
$ext=$_GET['ext'];
// abrir un directorio y listarlo recursivo 
if (is_dir($ruta_mod)) { 
	if ($dh = opendir($ruta_mod)) { 
		while (($file = readdir($dh)) !== false){
			if ($file!="." && $file!=".." && substr($file,-4)==".php"){
				if($ext && $ext!='admin/index' && $ext!='miembros/index'){$ext1=$ext.'.php';}else{$ext1='index.php';}
				if($file==$ext1){
				//if($file=='index.php'){
					$index=1;
				}
			}
		} 
		closedir($dh); 
	} 
}
else{
	basic_page();
	echo '<div id="alert-system"><div class="alert">Archivos No listados! '.$back.'</div></div>';
}
// Selecciona la pagina index.php de cada modulo.
if($index!=1){
	//basic_page();
	echo '<div id="alert-system">
	<div class="alert">La pagina no existe! '.$back.'</div>
	</div>';
}
else{
	//if($mod!=$qmod && $mod!='' && $mod!=NULL){$mod=$mod;}else{$mod='Home';}
	if($mod!='' && $mod!=NULL){$mod=$mod;}else{$mod='Home';}	
	if($ext!='' && $ext!=NULL){$ext=$ext;}else{$ext='index';}
	if($activo_mod==1){
		include ('./modulos/'.$mod.'/'.$ext.'.php');
	}else{
		echo '<div id="alert-system"><div class="alert">Modulo No activado!</div></div>';
	}
}

}

function bodymodulos(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;
global $dominio,$dominio1;
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
  if($url==$dominio.$path_root.'index.php' && $mod!='' && $mod!=NULL){
	if($mod!=$qmod && $activo_mod!=1){
		echo '<div id="alert-system"><div class="alert">El modulo no existe o no esta activo! '.$back.'</div></div>';
	}else{
		listar_archivos();
	}
  }
}

function user_permisos(){
}

function user_login(&$ID_login,&$username,&$email_login,&$nivel_login,&$last_login,&$tema_login,&$nombre_login,&$apaterno_login,&$amaterno_login,&$foto_login,&$cover_login,&$tel_login,&$ext_login,&$fnac_login,&$fb_login,&$tw_login,&$puesto_login,$ndepa_login,&$depa_login,&$empresa_login,&$adress_login,&$direccion_login,&$mpio_login,&$edo_login,&$genero_login,&$exp_login,&$like_login,&$filtro_login,&$zona_login,&$alta_login,&$actualizacion_login,&$page_login,&$nivel_oper_login,&$rol_login){
global $mysqli,$DBprefix;

$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE ID='".$_SESSION['ID']."';") or print mysqli_error($mysqli); 
	if($row=mysqli_fetch_array($sql)){
		 $ID_login=$row["ID"];
		 $username=$row["username"];
         $email_login=$row["email"];
         $nivel_login=$row["level"];
         $last_login=$row["lastlogin"];         
		 $tema_login=$row["tema"];
		 $nombre_login=$row["nombre"];
		 $apaterno_login=$row["apaterno"];
         $amaterno_login=$row["amaterno"];
		 $foto_login=$row["foto"];
		 $cover_login=$row["cover"];		 
		 $tel_login=$row["tel"];
		 $ext_login=$row["ext"];
		 $fnac_login=$row["fnac"];
		 $fb_login=$row["fb"];
		 $tw_login=$row["tw"];
		 $puesto_login=$row["puesto"];
		 $ndepa_login=$row["ndepa"];
		 $depa_login=$row["depa"];
		 //$departamento_login=$row["departamento"];
		 $empresa_login=$row["empresa"];
		 $adress_login=$row["adress"];
		 $direccion_login=$row["direccion"];
		 $mpio_login=$row["mpio"];
		 $edo_login=$row["edo"];
		 $genero_login=$row["genero"];
		 $exp_login=$row["exp"];
		 $like_login=$row["like"];
		 $filtro_login=$row["filtro"];
		 $zona_login=$row["zona"];
		 $alta_login=$row["alta"];
		 $actualizacion_login=$row["actualizacion"];
		 $page_login=$row["page"];
		 $nivel_oper_login=$row["nivel_oper"];
		 $rol_login=$row["rol"];
		 $activo_login=$row["activo"];
	}
}

function sesion(&$form_login){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;

if($URL==$page_url.'admin/'){$mod='Login';}else{$mod=$mod;}
setcookie("username","",time()-1,"/");
setcookie("password","",time()-1,"/");
session_start();
if(isset($_SESSION["username"]) && !isset($BLOCK) && $_SESSION["activo"]==1){
	$form_login='<div class="container">
					<header>
						<div></div>
						<h1>Bienvenido '.$_SESSION['username'].'</h1>
						<h2>Ha iniciado sesi&oacute;n correctamente. '.$BLOCK.'</h2>
						<h2><a href="'.$page_url.'index.php?mod='.$dboard.'" class="botonfib">Continuar</a> | <a href="'.$page_url.'modulos/usuarios/logout.php?id='.$_SESSION['ID'].'" class="botonfib">Salir</a></h2>
						<div class="support-note">
						<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
						</div>
					</header>
				</div>';
	$username=$_SESSION['username'];
	log_visitas($username);
}else if(isset($_SESSION["username"]) && $BLOCK==1){
	if($sas_lic==''){$lincia='<div style="color:#fff;">Su Licencia a Expirado ('.$vence.')</div>';}else{$lincia='';}
	$form_login='<div class="container">
					<header>
						<h1 style="color:#f00;">ACCESO BLOQUEADO</h1>
						'.$lincia.'
						<div class="support-note">
						<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
						</div>
					</header>
				</div>';
	//$sqlnivel=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos WHERE modulo='{$mod}';") or print mysqli_error($mysqli);
	//if($rownivel=mysqli_fetch_array($sqlnivel)){$niv=$rownivel['nivel'];}	
	if($nivel_mod==-1 || $ext=='admin/index'){header("Location: ".$page_url."admin/");}
	//log_visitas();
}else if($_SESSION["username"]=='' && $BLOCK==1){
	$form_login='<div class="container">
					<header>
						<h1 style="color:#f00;">ACCESO BLOQUEADO</h1>
						<div class="support-note">
						<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
						</div>
					</header>
				</div>';
	log_visitas('Usuario-bloquedo1');
}else if(isset($_SESSION["username"]) && $_SESSION["activo"]==0){
	$form_login='<div class="container">
					<header>
						<h1 style="color:#f00;">Su cuenta no esta activada.</h1>
						<h2><a href="'.$page_url.'modulos/usuarios/registro.php?code=1" class="botonfib">Activar Cuenta</a> | <a href="'.$page_url.'modulos/usuarios/logout.php?id='.$_SESSION['ID'].'" class="botonfib">Salir</a></h2>
						<div class="support-note">
						<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
						</div>
					</header>
				</div>';
	if($nivel_mod==-1 || $ext=='admin/index'){header("Location: ".$page_url."admin/");}
}else{
	$form_login='
	<div class="container">
			<header>
				<h1>Ingrese a su cuenta</h1>
				<h2>No tiene una cuenta registrese <a href="'.$page_url.'modulos/usuarios/registro.php">aqu&iacute;</a>.</h2>
				<div class="support-note">
					<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
				</div>
			</header>
		<section class="main">
			<form name="login_ebook" class="form-4" method="POST" action="'.$URL.'">
				    <h1>Login</h1>
				    <p>
				        <label for="login">Usuario</label>
				        <input type="text" name="username" placeholder="Usuario" required autocomplete="off">
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" name="password" placeholder="Password" required autocomplete="off"> 
				    </p>
				    <p>
				        <input type="submit" id="sesion" name="sesion" value="Entrar">
				    </p>       
			</form>
			<div style="text-align:center;">
				<a href="'.$page_url.'">Inicio</a> | <a href="'.$page_url.'modulos/usuarios/forget.php" class="alogin">Olvidaste t&uacute; contrase&ntilde;a?</a>
			</div>
		</section>
	</div>		
	';
	$username=(isset($_SESSION['username']))?$_SESSION['username']:'';
	log_visitas($username);
	}
}

function comprobar(&$form_login,&$log_usuarios,$sal,$ses,$log,$U,$P){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;

if($sal){
	$log_usuarios='usuarios/logout.php';
}else if($log){
	$log_usuarios='usuarios/login.php';
	mysqli_query($mysqli,"UPDATE ".$DBprefix."comp SET page='{$log_usuarios}' WHERE ID=1;") or print mysqli_error($mysqli);
}else{
 if($ses){
    $login 	= htmlspecialchars(trim($U));
    $pass 	= trim($P);
	$pass1	= ($pass=='123456')?$pass:sha1(md5($pass));// Encriptamos "Ciframos" el password
	$info=navegador();
	$navegador=$info['browser'];
	$os=$info['os'];
	$code=$_POST['code'];

	if(isset($code)){
		$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."access (user,ip,navegador,os,code,fecha) VALUES ('{$U}','{$ip}','{$navegador}','{$os}','{$code}','{$date}');") or print mysqli_error($mysqli);
	}

	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."access WHERE (user='{$login}' && ip='{$ip}' && navegador='{$navegador}' && os='{$os}') OR (user='{$login}' && code='{$code}');") or print mysqli_error($mysqli);
	if(mysqli_num_rows($sql)){
	/*PASSWORD*********/
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE username='{$login}' && password='{$pass1}';") or print mysqli_error($mysqli); 
    	if(mysqli_num_rows($sql)){
		 $array=mysqli_fetch_array($sql);
		 $_SESSION["ID"]=$array["ID"];
		 $_SESSION["username"]=$array["username"];
         $_SESSION["email"]=$array["email"];
         $_SESSION["level"]=$array["level"];
         $_SESSION["lastlogin"]=$array["lastlogin"];         
		 $_SESSION["tema"]=$array["tema"];
		 $_SESSION["nombre"]=$array["nombre"];
		 $_SESSION["apaterno"]=$array["apaterno"];
         $_SESSION["amaterno"]=$array["amaterno"];
		 $_SESSION["foto"]=$array["foto"];
		 $_SESSION["cover"]=$array["cover"];		 
		 $_SESSION["tel"]=$array["tel"];
		 $_SESSION["ext"]=$array["ext"];
		 $_SESSION["fnac"]=$array["fnac"];
		 $_SESSION["fb"]=$array["fb"];
		 $_SESSION["tw"]=$array["tw"];
		 $_SESSION["puesto"]=$array["puesto"];
		 $_SESSION["ndepa"]=$array["ndepa"];
		 $_SESSION["depa"]=$array["depa"];
		 //$_SESSION["departamento"]=$array["departamento"];
		 $_SESSION["empresa"]=$array["empresa"];
		 $_SESSION["adress"]=$array["adress"];
		 $_SESSION["direccion"]=$array["direccion"];
		 $_SESSION["mpio"]=$array["mpio"];
		 $_SESSION["edo"]=$array["edo"];
		 $_SESSION["genero"]=$array["genero"];
		 $_SESSION["exp"]=$array["exp"];
		 $_SESSION["like"]=(isset($array["like"]))?$array["like"]:'';
		 $_SESSION["filtro"]=$array["filtro"];
		 $_SESSION["zona"]=$array["zona"];
		 $_SESSION["alta"]=$array["alta"];
		 $_SESSION["actualizacion"]=$array["actualizacion"];
		 $_SESSION["page"]=$array["page"];
		 $_SESSION["nivel_oper"]=$array["nivel_oper"];
		 $_SESSION["rol"]=$array["rol"];
		 $_SESSION["activo"]=$array["activo"];

		 if($pass!='123456' && $pass!=''){
			switch(true){
				case ($mode=='page' || $mode=='intranet' || $mode=='landingpage'): //Antes case ($mode=='page' || $mode=='landingpage'):
					$URL_log=$page_url.'index.php?mod='.$dboard;
				break;/*
				case ($mode=='page'): //Antes case ($mode=='intranet'):
					$URL_log=$page_url.'index.php';
				break;*/
				default:
					$URL_log=$page_url.'admin/';
				break;
			}			

			$token = Token();
			$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."token (ID_user,Token,Estado,Fecha) VALUES ('{$_SESSION["ID"]}','{$token}','Activo','{$date}');") or print mysqli_error($mysqli);			
			setcookie("token",$token,time()+(60+60+24+31),"/");
			$form_login=recargar($seg=3,$URL_log,'').'
				<div class="container">
					<header>
						<div></div>
						<h1>Bienvenido '.$_SESSION['username'].'</h1>
						<h2>Ha iniciado sesi&oacute;n correctamente.</h2>
						<h2><a href="'.$URL_log.'" class="botonfib">Continuar</a></h2>
						<div class="support-note">
						<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
						</div>
					</header>
				</div>';
		 }else{
			$form_login="";
			include ('../modulos/usuarios/chance_pass.php');
		 }
		}else{
			$form_login='<div style="padding:10px 0 0 0; text-align:center;">No has iniciado sesion. '.$back.'</div>';
		}
	/*PASSWORD*******************/
	}else{
		
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."access WHERE user='{$U}'") or print mysqli_error($mysqli);
		if($row=mysqli_fetch_array($sql)){$codigo=$row['code'];}		
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE username='{$login}' AND password='{$pass1}'") or print mysqli_error($mysqli);
		if($row=mysqli_fetch_array($sql)){$para=$row['email']; $codigo=($codigo!='')?$codigo:$row['codigo'];}

		$asunto = $page_name.' - Sistema de Verificacion';
		$header  = "From: ".$page_name." - C&oacute;digo de Usuario" . "<".$contactMail.">\r\n";
  		$header .= 'MIME-Version: 1.0' . "\r\n";
    	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	$message = 'Codigo de Seguridad: '.$codigo;
		 
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ip,nombre,email,para,tel,titulo,asunto,msj,cat_list,seccion,tabla,adjuntos,visto,status,ID_login,ID_user,visible) VALUES ('{$ip}','{$U}','{$para}','{$contactMail}','','','{$asunto}','{$message}','inbox','contacto','','','0','1','1','1','1');") or print mysqli_error($mysqli);
		validar_aviso($save,'Revise su correo','Error:Hubo un problema al enviar el correo',$aviso);
		mail($para,$asunto,$message,$header);		
		
		$form_login='
			<div class="container">
				<header>
					<h2 style="color:#ff0;">AVISO: Hemos detectado algo inusual en su inicio de sesion.</h2>
					<h2>Para continuar ingrese su password y el c&oacute;digo de Seguridad<BR>que le enviamos a su cuenta de correo.</h2>
					<div>'.$aviso.'</div>
				</header>
				<section class="main">
					<form name="login_ebook" class="form-4" method="POST" action="'.$URL.'">
				    	<h1>C&oacute;digo de Seguridad</h1>
				    	<p>
				        	<label for="code">Codigo</label>
				        	<input type="text" name="code" placeholder="Codigo" required autocomplete="off"> 
				    	</p>
				    	<p>
				    		<label for="username">Usuario</label>
				    		<input type="text" name="username" placeholder="Usuario" required autocomplete="off" value="'.$U.'">
				        </p>
				        <p>
				        	<label for="password">Password</label>
				        	<input type="password" name="password" placeholder="Password" required autocomplete="off"> 
				    	</p>
				    	<p>
				        	<input type="submit" id="sesion" name="sesion" value="Entrar">
				    	</p>       
					</form>
					<div style="text-align:center;">
						<a href="'.$page_url.'">Inicio</a> | <a href="'.$page_url.'modulos/usuarios/forget.php" class="alogin">Olvidaste t&uacute; contrase&ntilde;a?</a>
					</div>
				</section>
			</div>';
	}
  }
 }
}

function envio_mail($de,$para,$titulo,$intro,$contenido,$tabla,$condi,$sec,$cat_list,$msj_bien,$msj_mal,&$aviso){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time,$ver_file;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL,$token,$path_jsonWS,$path_jsonDB;
global $mod,$ext,$id,$idp,$idf,$vhref,$refer,$opc,$action,$ctrl,$form,$frm,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$wapp,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;

			$message  = '<html><body style="font-family:Verdana, Geneva, sans-serif; font-size: 13px;">'.
						'<table style="font-family:Verdana, Geneva, sans-serif; font-size:13px;">';
    		$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2"><img src="'.$page_url.$path_tema.'/images/logo.min.png"></td></tr>';
			$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2">'.$intro.'</td></tr>';
    		$message .= $contenido;
    		$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2"></td></tr>';
    		$message .='</table></body></html>';

			$header  = "From: ".$page_name." - Registro Usuario" . "<".$de.">\r\n";
  			$header .= 'MIME-Version: 1.0' . "\r\n";
    		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		 

			$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix.$tabla." ".$condi.";") or print mysqli_error($mysqli); 
			validar_aviso($save,$msj_bien,$msj_mal,$aviso);
			mail($para,$titulo,$message,$header);
}

function message_registro($email,$contenido,&$para,&$titulo,&$msj_bien,&$msj_mal,&$message,&$header,$sel){//seleccion sistema:1 | cliente:0
global $page_url,$page_name,$contactMail,$URL;
if($sel==1){
    $para=$contactMail;
    $de=$email;
    $titulo='Nuevo Usuario Registrado - Web '.$page_name;
    $intro='<p style="text-align:center">Nuevo Usuario Registrado - Mensaje enviado a tr&aacute;ves de la p&aacute;gina web de '.$page_name.'.</p>';
    $msj_bien='El registro se guardo correctamente. <a href="'.$page_url.'admin" style="color:#444;">Regresar</a>';
    $msj_mal='Hubo un problema y el registro no se guardo, intentelo nuevamente. <a href="'.$URL.'" style="color:#444;">Regresar</a>';
}else{
    $para=$email;
    $de=$contactMail;            
    $titulo='Mensaje de Bienvenida - Web '.$page_name;
    $intro='<p style="text-align:center">Bienvenido - Web '.$page_name.'<br>
    Ud. a quedado registrado en nuestra p&aacute;gina web acontinuaci&oacute;n le enviamos los datos de su cuenta.<br> 
    Para activar su cuenta haga clic <a href="'.$page_url.'modulos/usuarios/registro.php?code=1">aqu&iacute;</a> e ingrese su c&oacute;digo de activaci&oacute;n.
    </p>';
    $msj_bien='Ud. se ha registrado correctamente, gracias. <a href="'.$page_url.'admin/" style="color:#111;">Iniciar Sesi&oacute;n</a><br>Revise su cuenta de correo donde recibira un mensaje con el codigo de activacion de su cuenta.<br>Para activar su cuenta haga clic <a href="'.$page_url.'modulos/usuarios/registro.php?code=1" style="color:#111;">aqu&iacute;</a> e ingrese su c&oacute;digo de activaci&oacute;n.';
    $msj_mal='Hubo un problema al registrarse, por favor intentelo nuevamente. <a href="'.$URL.'" style="color:#444;">Regresar</a>';
}

$message  = '<html><body style="font-family:Verdana, Geneva, sans-serif; font-size: 13px;">'.
            '<table style="font-family:Verdana, Geneva, sans-serif; font-size:13px;">';
$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2"><img src="'.$page_url.'temas/default/images/logo.min.png"></td></tr>';
$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2">'.$intro.'</td></tr>';
$message .= $contenido;
$message .= '<tr><td align="center" style="background-color: #fff;" colspan="2"></td></tr>';
$message .='</table></body></html>';

$header  = "From: ".$page_name." - Registro Usuario" . "<".$de.">\r\n";
$header .= 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
}

function email_forms(&$CoR1,&$CoE1,&$BCC1){
global $mysqli,$DBprefix,$mod,$CoR,$CoE,$BCC,$CoP;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."contacto_forms WHERE modulo='{$mod}' AND activo=1;") or print mysqli_error($mysqli);
$num_rows=mysqli_num_rows($sql);
 if($num_rows==1){
	while($row=mysqli_fetch_array($sql)){
		$CoR1=$row['email'];
		$CoE1=$row['CoE'];
		$BCC1=$row['bcc'];
		$CoP1=$row['CoP'];		
	}
 }else{
	$CoR1=$CoR;
	$CoE1=$CoE;
	$BCC1=$BCC;
	$CoP1=$CoP;		
 }
 sql_opciones('email_test',$valor);
 if($valor==1){
	$CoR1=$CoP1;
 }
}
//

function getRandomCode(){
  $n=(isset($_GET['pin']))?5:50;
  $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $su = strlen($an) - 1;
  for($i=0;$i<=$n;$i++){
	$code.=substr($an, rand(0, $su), 1);
  }
  return $code;
}

function form_push($nombre,$mensaje){
global $mysqli,$DBprefix,$date;
 if(isset($mensaje)){
	mysqli_query($mysqli,"INSERT INTO ".$DBprefix."notificacion (ID_user,ID_user2,nombre_envio,mensaje,visto,activo,fecha) VALUES ('1','1','$nombre','$mensaje','0','1','{$date}');") or print mysqli_error($mysqli);	 
 }	
}

function ajax_content1($url_ajax,$seg,$jqs){
global $mysqli,$DBprefix,$mod,$ext,$idp;
if($jqs==1){echo '<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>';}
echo '<script>
/* Parametros mandatorios*/
    var seconds = '.$seg.'; // el tiempo en que se refresca
	var divid = "contenido"; // el div que quieres actualizar!
	var url = "'.$url_ajax.'"; // el archivo que ira en el div

	function refreshdiv(){
		// The XMLHttpRequest object
		var xmlHttp;
		try{
			xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
			}
			catch (e){
				try{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
					alert("Tu explorador no soporta AJAX.");
					return false;
				}
			}
		}
		// Timestamp for preventing IE caching the GET request
		var timestamp = parseInt(new Date().getTime().toString().substring(0, 10));
		var nocacheurl = url+"?t="+timestamp;
		// The code...
		xmlHttp.onreadystatechange=function(){
			if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
				document.getElementById(divid).innerHTML=xmlHttp.responseText;
				setTimeout(\'refreshdiv()\',seconds*1000);
			}
		}
		xmlHttp.open("GET",nocacheurl,true);
		xmlHttp.send(null);
	}
	// Empieza la función de refrescar
	window.onload = function(){
		refreshdiv(); // corremos inmediatamente la funcion
	}
</script>
<span id="contenido"></span>';
}

function ajax_content2($url_ajax,$seg,$jqs){
global $mysqli,$DBprefix,$mod,$ext,$idp;
if($jqs==1){echo '<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>';}
echo'
<script>
  var RequestObject = false;
   //directorio donde tenemos el archivo ajax.php
  var Archivo = "'.$url_ajax.'";
  // el tiempo X que tardará en actualizarse 
  window.setInterval("actualizacion_reloj()", '.$seg.'000);
  if (window.XMLHttpRequest) RequestObject = new XMLHttpRequest();
  if (window.ActiveXObject) RequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  function ReqChange() { 
  // Si se ha recibido la información correctamente
    if (RequestObject.readyState==4) {
     // si la información es válida 
     if (RequestObject.responseText.indexOf(\'invalid\') == -1) {
     // Buscamos la div con id online 
       document.getElementById("online").innerHTML = RequestObject.responseText;
     } else { 
     // Por si hay algun error 
	   document.getElementById("online").innerHTML = "Error llamando"; 
     }
    } 
  }
  function llamadaAjax() {
    // Mensaje a mostrar mientras se obtiene la información remota...
    document.getElementById("online").innerHTML = ""; 
    // Preparamos la obtención de datos
    RequestObject.open("GET", Archivo+"?"+Math.random() , true);
    RequestObject.onreadystatechange = ReqChange; 
    // Enviamos
    RequestObject.send(null);
  }
  function actualizacion_reloj() {
   llamadaAjax();
 }
</script>
<span id="online"></span>';
}

function compact_ajax($fun,$tag_id,$url_ajax,$seg,$jqs){
echo '<script>
//$(document).ready(function() {	
	function '.$fun.'(){
		$.ajax({
			type: \'POST\',
			url: \''.$url_ajax.'\',
			success: function(respuesta) {			
				$(\'#'.$tag_id.'\').html(respuesta);
	   		}
		});
	}
	setInterval('.$fun.', '.$seg.'000);//setInterval(function(){'.$fun.'();},'.$seg.'000)//Actualizamos cada '.$seg.' segundo    	
	window.onload='.$fun.';
//});
</script>';
if($tag_id!=''){echo '<span id="'.$tag_id.'"></span>';}
}

function compact_ajax2($fun,$tag_id,$url_ajax,$seg,$jqs,$span){
echo '<script>
	function '.$fun.'(){
		$.ajax({
			type: \'POST\',
			url: \''.$url_ajax.'\',
			success: function(respuesta) {			
				$(\'#'.$tag_id.'\').html(respuesta);
	   		}
		});
	}
	setInterval('.$fun.', '.$seg.'000);
	window.onload='.$fun.';
</script>';
if($span==1){echo '<span id="'.$tag_id.'"></span>';}
}

function ajax_crud($campos,$template,$tiny){
global $page_url,$URL,$mod,$ext,$id,$idp,$idf,$opc,$form,$action,$ctrl;
$cond_action=($action!='')?'&action='.$action:'';
$edit=($action=='edit')?'true':'false';
$tiny=($tiny==1)?'tinyMCE.triggerSave();':'';
$contenido='
// JavaScript Document
	function load(page){
		var parametros = {"mode":"ajax","page":page};
		$("#loader").fadeIn(\'slow\');
		$.ajax({
			url:\'modulos/'.$mod.'/admin/backend.php?mod='.$mod.$cond_action.'\',
			data: parametros,
			beforeSend: function(objeto){
				$("#loader").html("<img src=\'apps/dashboards/loader.gif\'>");
			},
			success:function(data){
				$(".outer_div").html(data);
				$("#loader").html("");
			}
		});
	}

$(document).ready(function(){
	// Global Settings
	//console.log(\'jQuery esta funcionando\');
	let edit = '.$edit.';
	load(1);	
 	//listar();
	//$("#task-result").hide();

	/*$(document).on("click","#listado",function(){
		listado(1);
	});*/

	function listado(page){
		var parametros = {"mode":"ajax","page":page};
		$("#loader").fadeIn(\'slow\');
		$.ajax({
			url:\'modulos/'.$mod.'/admin/backend.php?mod='.$mod.'&action=listado\',
			data: parametros,
			beforeSend: function(objeto){
				$("#loader").html("<img src=\'modulos/'.$mod.'/img/loader.gif\'>");
			},
			success:function(data){
				$(".outer_div").html(data);
				$("#loader").html("");
			}
		});
	}

	//LISTAR
	/*
	function listar(){
		$.ajax({
			url: \'modulos/'.$mod.'/admin/backend.php?action=list\',
			type: \'POST\',
			//dataType : \'json\',
			success: function(response){
				let tasks=JSON.parse(response);
				let template="";
				
				tasks.forEach(task=>{
        		template += `
                  <tr taskId="${task.ID}">
                  <td>${task.ID}</td>
                  <td>
                  <a href="#" class="task-item">${task.nom}</a>
                  </td>
                  <td>${task.descripcion}</td>
                  <td>
                    <button class="task-delete btn btn-danger">Borrar</button>
                  </td>
                  </tr>
                `
					});
				$("#task").html(template);
			}
		});
	}
	setInterval(listar,30000);*/

	//AGREGAR/EDITAR
	$("#form1").submit(function(e){
		e.preventDefault();
		'.$tiny.'
		const postData={
			'.$campos.'
		};
		const url = edit === false ? \'modulos/'.$mod.'/admin/backend.php?mod='.$mod.'&ext='.$ext.'&action=add\' : \'modulos/'.$mod.'/admin/backend.php?mod='.$mod.'&ext='.$ext.'&action=edit\';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log("Se ha actualizado el registro.");			
			$("#aviso").html(response).fadeIn("slow");
			$("#aviso").fadeOut(6000);
			//$("form1").trigger(\'reset\');	
			//listar();
			//edit = false;
		});
	});

	//editar_form
	/*
	$(document).on(\'click\',\'.task-item\',function(){	
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr(\'taskId\');
      	$.post(\'modulos/'.$mod.'/admin/backend.php?action=edit_form\', {id}, (response) => {
			console.log(response);
			const task=JSON.parse(response);
      		$("#nom").val(task.nom);
      		$("#des").val(task.descripcion);
      		$("#taskId").val(task.ID);
      		edit = true;
        });		
	});*/

	//BORRAR
	$(document).on(\'click\',\'.task-delete\',function(){
	  const element = $(this)[0];
      const id = $(element).attr(\'taskId\');
      if(confirm("Esta seguro de eliminar este Servicio"+id+"?")) {
      	$.post(\'modulos/'.$mod.'/admin/backend.php?action=delete\', {id}, (response) => {
			console.log(response);
          	load(1);
        });
	  }
	});

	//SUBIR COVER
	$(document).on(\'click\',\'#Aceptar\',function(e){		
		e.preventDefault();
		var frmData=new FormData;
		frmData.append("userfile",$("input[name=userfile]")[0].files[0]);
		//console.log(\'Se cargo Imagen\');		
		$.ajax({
			url: \'modulos/'.$mod.'/admin/backend.php?mod='.$mod.'&action=subir_cover\',
			type: \'POST\',
			data: frmData,
			processData:false,
			contentType:false,
			cache:false,
			beforeSend: function(data){
				$("#imagen").html("Subiendo Imagen");
			},
			success: function(data){
				//$("#form1").trigger("reset");
				$("#imagen").html(data);
				console.log("Subido Correctamente");
			}
		});
		//return false;
	});

	//BUSCAR
	$("#q").keyup(function(e){
	  if($("#q").val()){
		let q=$("#q").val();
		$.ajax({
			url: \'modulos/'.$mod.'/admin/backend.php?action=buscar\',
			type: \'POST\',
			data: {q},
			success: function(response){
				let tasks=JSON.parse(response);
				console.log(response);
				let template=\'<div class="box-body">\';
				let sel="";
				tasks.forEach(task=>{
				visible=`${task.visible}`;
				sel=(visible==0)?\'<span style="color:#e00;"><i class="fa fa-close" title="Desactivado"></i></span>\':\'<span style="color:#0f0;"><i class="fa fa-check" title="Activo"></i></span>\';	
        		template += `'.$template.'`
				});
				$(".outer_div").html(template+"</div>");
			}
		});
	  }	 
	});
	
});
';
crear_archivo('modulos/'.$mod.'/js/','ajax_'.$mod.'.js',$contenido,$path_file);
}

function visitas_total(){
global $mysqli,$DBprefix,$year,$month,$day;
$sql=mysqli_query($mysqli,"SELECT DISTINCT ip FROM ".$DBprefix."visitas WHERE fecha<='{$year}-{$month}-31 23:59:59';") or print mysqli_error($mysqli);
$visitas_total=mysqli_num_rows($sql);
echo $visitas_total;
}

function logout($ID_login){
global $page_url;	
	$logout = $page_url.'modulos/usuarios/logout.php?id='.$ID_login.'&co='.getRandomCode();
return $logout;
}

function url_exists($url = NULL) { 
    if(empty($url)){return false;}
 
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );
    $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
    // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
    if(isset($http_response_header)){
        sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode ); 
        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }
     }else {
         return false;
     }
}

function crear_manifest(){
global $page_url,$path_root,$path_tema,$pag_name,$page_name,$title;
$contenido='{
	"name": "'.$page_name.'",
	"short_name": "'.$page_name.'",
	"description": "'.$title.'",
	"scope": ".",
	"start_url": "'.$page_url.'",
	"display": "standalone",
	"orientation": "portrait",
	"theme_color": "#000",
	"background_color": "#fff",
	"icons": [
	  {
		"src": "icon/apple-icon-180x180.png",
		"sizes": "180x180",
		"type": "image/png"
	  },
	  {
		"src": "icon/apple-icon-152x152.png",
		"sizes": "152x152",
		"type": "image/png"
	  }
	]
  }  
';	
	crear_archivo('bloques/WPA/','manifest.json',$contenido,$path_file);	
	if(file_exists('./'.$path_file)){
		echo '<link rel="manifest" href="'.$page_url.'bloques/WPA/manifest.json">';
	}
}

function crear_sw($path_wpa){
global $page_url,$path_root,$path_tema,$pag_name;
$contenido='//Service Worker sw.js / index.php
self.addEventListener(\'install\', function(event) {
  console.log(\'[Service Worker] Instalando Service Worker (sw.js)...\', event);
  event.waitUntil(
	caches.open(\'static\').then(function(cache) {
	  cache.addAll([\'/'.$path_root.'\', \'/'.$path_root.'index.php\', \'/'.$path_root.'bloques/WPA/manifest.json\',\'/'.$path_root.'bloques/WPA/appCon.js\']);
	})
  );
});

self.addEventListener(\'activate\', function(event) {
  console.log(\'[Service Worker] Activando Service Worker (sw.js)...\', event);
});

self.addEventListener(\'fetch\', function(event) {//console.log(event.request.url);
  event.respondWith(
	  caches.match(event.request).then(function(response) {
		if (response) {
		  return response;
		} else {
		  return fetch(event.request).then(function(res) {
			return caches.open(\'dynamic\').then(function(cache) {
			  //cache.put(event.request.url, res.clone()).then(()=>{cache.delete(\'/'.$path_root.'admin/\');});
			  cache.put(event.request.url, res.clone()).then(()=>{cache.delete(event.request.url);});
			  return res;
			});
		  });
		}
	  })
  ); 
});  

';
//$path_sw='sw.js';
crear_archivo($path_wpa,'sw.js',$contenido,$path_file);
	if(file_exists('./'.$path_file)){
		echo '<script src="'.$page_url.$path_file.'" type="text/javascript"></script>';
	}
}

function crear_appCon($path_wpa){
global $page_url,$path_root,$path_tema,$pag_name;
$contenido='//appCon.js index.php
if (\'serviceWorker\' in navigator) {
	navigator.serviceWorker.register(\'/'.$path_root.'sw.js\').then(function(registration) {
		console.log(
		  \'Service Worker registro correcto con scope: \',
		  registration.scope
		);
	  }).catch(function(err) {
		console.log(\'Service Worker registro fallo: \', err);
	  });
  }  ';
//$path_appCon=$path_wpa.'appCon.js';
crear_archivo($path_wpa,'appCon.js',$contenido,$path_file);
	if(file_exists('./'.$path_file)){
		echo '<script src="'.$page_url.$path_file.'" type="text/javascript"></script>';
	}
}

function API_WPA(){
global $page_url,$path_root,$path_tema,$page_name;
	sql_opciones('api_WPA',$valor);
	$path_wpa='bloques/WPA/';
	if($valor==1){
		crear_sw('');
		crear_appCon($path_wpa);
	}else{
		unlink('sw.js');
		unlink($path_wpa.'appCon.js');
		clear_sw();
	}
}

function icon(){
global $page_url,$path_tema,$page_name,$title,$description;
	echo '<meta name="'.$page_name.'" content="Add to Home">
	'.crear_manifest().'
	<link  rel = "apple-touch-icon"  tallas = "57x57"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-57x57.png" > 
	<link  rel = "apple-touch-icon"  tallas = "60x60"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-60x60.png" > 
	<link  rel = "apple-touch-icon "  tamanos = " 72x72 "  href = "'.$page_url.'bloques/WPA/icon/apple-icon-72x72.png " > 
	<link  rel = "apple-touch-icon "  tamanos = "76x76"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-76x76.png" > 
	<link  rel = "apple-touch-icon "  tamanos = " 114x114 "  href = "'.$page_url.'bloques/WPA/icon/apple-icon-114x114.png "> 
	<link  rel = "apple-touch-icon"  tallas = "120x120"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-120x120.png" > 
	<link  rel = "apple-touch-icon"  tallas = "144x144"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-144x144.png" > 
	<link  rel = "apple-touch-icon "  tamanos = " 152x152 "  href = "'.$page_url.'bloques/WPA/icon/apple-icon-152x152.png" > 
	<link  rel = "apple-touch-icon "  tamanos = "180x180"  href = "'.$page_url.'bloques/WPA/icon/apple-icon-180x180.png" > 
	<link  rel = "icon"  type = "image/png"  tallas = "16x16"  href = "'.$page_url.'bloques/WPA/icon/favicon-16x16.png" > 
	<link  rel = "icon"  type = "image/png"  tamanos = "32x32"  href = "'.$page_url.'bloques/WPA/icon/favicon-32x32.png" > 
	<link  rel = "icon"  type = "image/png"  tallas = "96x96"  href = "'.$page_url.'bloques/WPA/icon/favicon-96x96.png" > 
	<link  rel = "icon"  type = "image/png"  tamanos = "192x192"  href = "'.$page_url.'bloques/WPA/icon/android-icon-192x192.png" > 
	<!-- link  rel = "manifest" href="/manifest.json" --> 
	<meta  name ="msapplication-TileColor"  content = "#ffffff" > 
	<meta  name = "msapplication-TileImage"  content = "'.$page_url.'bloques/WPA/icon/ms-icon-144x144.png" > 
	<meta  name = "theme-color"  content = "#ffffff" >
	<!-- iconos -->
	<link rel="apple-touch-icon" href="'.$page_url.'bloques/WPA/icon/apple-icon-180x180.png">
	<link rel="shortcut icon" sizes="16x16" href="'.$page_url.'bloques/WPA/icon/favicon-16x16.png">
	<link rel="shortcut icon" sizes="196x196" href="'.$page_url.'bloques/WPA/icon/favicon-96x96.png">
	<link rel="apple-touch-icon-precomposed" href="'.$page_url.'bloques/WPA/icon/apple-icon-152x152.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<!-- SOCIAL MEDIA META -->
	<meta property="og:description" content="'.$description.'">
	<meta property="og:image" content="'.$page_url.'bloques/WPA/icon/apple-icon-180x180.png">
	<meta property="og:site_name" content="'.$page_name.'">
	<meta property="og:title" content="'.$title.'">
	<meta property="og:type" content="website">
	<meta property="og:url" content="'.$dominio.'">
	';
}

function str_limit($value,$limit=100,$end){
	if (mb_strwidth($value, 'UTF-8') <= $limit) {
		return $value;
	}
	return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}

/*
function cadena_replace(&$replace1,&$replace2){
	$replace1=array(' ','.',',','(',')','/','"','á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ','&ntilde;','&Ntilde;','&','amp;');
	$replace2=array('-','-','-','-','-','-','-','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','n','N','n','N','','');
}*/

function Token(){
	$token=sha1(uniqid(rand(),true));//Generador de Token
	return $token;
}

function RanUrl(){
	$ran_url = substr(md5(microtime()), rand(0,26), 5);//Generador Random de 5 caracteres
	return $ran_url;
}

function ssl(){
global $host,$path_root;
	echo '<script>
	const protocol = window.location.protocol;
	console.log("protocol=" + protocol);
	if(protocol=="http:"){window.location="https://'.$host.$path_root.'";}
	</script>';
}

function clear_sw(){
	echo '<script>
	navigator.serviceWorker.getRegistrations().then(function(registrations) {
		for(let registration of registrations) {
		 registration.unregister()
		}});
	</script>';
}
?>