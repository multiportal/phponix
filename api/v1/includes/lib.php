<?php 
/*---------------------------------------------------------------------------------------------------------------------*/
//Funcion para quitar los Notice (Avisos) de PHP7
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
/*---------------------------------------------------------------------------------------------------------------------*/
//--VARIABLES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
/*VARIABLES DEL SISTEMA*/
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
$ext 		= (isset($_GET['ext']))?$_GET['ext']:'index';
switch(true){case($ext=='admin/index'):$ext2='admin';break;case($ext=='miembros/index'):$ext2='miembros';break;default:$ext2=$ext;break;}
$opc		= (isset($_GET['opc']))?$_GET['opc']:'';
$action 	= (isset($_GET['action']))?$_GET['action']:'';
$ctrl 		= (isset($_GET['ctrl']))?$_GET['ctrl']:'';
//$frm 		= (isset($_GET['frm']))?$_GET['frm']:'';
$form		= (isset($_GET['form']))?$_GET['form']:'';//Variable para mostrar formulario crud
$id 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id general
$idp 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id producto
$idm		= (isset($_GET['idm']))?$_GET['idm']:'';//Variable de id para mail en formularios de contacto
$idf 		= (isset($_GET['idf']))?$_GET['idf']:'';//Variable bandera
$vhref 		= (isset($_GET['vhref']))?$_GET['vhref']:''; //Variable de seguimiento.
$tabla      = (isset($_GET['tabla']))?$_GET['tabla']:'';//Variable de Tabla. 

$dominio    = $protocol.$host.'/';          //Dominio Estructurado
$dominio1   = $protocol.$host;              //Dominio Simple
$url        = $dominio1.$pag_self;			//Se obtiene la url de la pagina.
$URL        = $dominio1.$pag_url;			//Se obtiene la url completa, incluyendo variables.

$host_dom   = 'https://'.$host.'/';
$host_dominio = ($dominio==$host_dom)?'https://'.$host.'/':'http://'.$host.'/';

$path_root  = ($ex_scfg!=1)?$path_root:sql_opc('config','path_root','ID',1);
$page_url   = ($ex_scfg!=1)?$dominio.$path_root:sql_opc('config','page_url','ID',1); //$page_url=($mod=='Home')?$URL:$dominio.$path_root;

/*---VARIABLES DE PAGINA---*/
$meta_chartset='<!--Caracteres-->'."\r\n".'<meta charset="utf-8">'."\r\n".'';
$style='<link href="'.$page_url.'assets/css/style.css" rel="stylesheet" type="text/css">'."\r\n";
$font_awesome='<link href="'.$page_url.'assets/font-awesome/f-5.14.0-web/css/all.css" rel="stylesheet" type="text/css">'."\r\n";
$bootstrap='<link href="'.$page_url.'assets/bootstrap/b-4.5.0/css/bootstrap.css" rel="stylesheet" type="text/css">'."\r\n";
$bootstrapjs='<script src="'.$page_url.'assets/bootstrap/b-4.5.0/js/bootstrap.js" type="text/javascript" language="javascript"></script>'."\r\n";
$javascript='<script src="'.$page_url.'assets/js/main.js" type="text/javascript" language="javascript"></script>'."\r\n";
$jQuery='<script src="'.$page_url.'assets/jq/jQuery.js"></script>'."\r\n";
$jQuery10='<script src="https://code.jquery.com/jquery-1.10.2.js"></script>'."\r\n";
$base_target='<base target="_blank">'."\r\n";
$back='<a href="javascript:history.go(-1);">Regresar</a>';
$back2='<a href="'.$page_url.'">Regresar Inicio</a>';
$inicio='<a href="'.$page_url.'">Inicio</a>';
$admin='<a href="'.$page_url.'admin/">Admin</a>';
$login='<a href="'.$page_url.'login/">Login</a>';

/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
function sql_opc($tabla,$campo,$opcion,$val){
global $conec,$DBprefix;//$mysqli=conexion();
    $sql="SELECT * FROM ".$DBprefix.$tabla." WHERE {$opcion}='{$val}';";
    $query=$conec->prepare($sql);
    $query->execute();
    if($row=$query->fetch()){$dato=$row[$campo];}
    return $dato;
}

?>