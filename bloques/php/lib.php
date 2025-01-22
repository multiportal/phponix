<?php
//Funcion para quitar los Notice (Avisos) de PHP7
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
// Desactivar toda notificación de error
//error_reporting(0);

/*---------------------------------------------------------------------------------------------------------------------*/
//--VARIABLES--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/
/*VARIABLES DEL SISTEMA*/
$year		    = date('Y');
$month		  = date('m');
$day		    = date('d');
$time		    = date('Gis');
$fecha		  = date('Y-m-d');
$date		    = date("Y-m-d H:i:s");
$serv_proto = (isset($_SERVER['SERVER_PROTOCOL']))?$_SERVER['SERVER_PROTOCOL']:''; //Protocolo de Internet
//$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://'; //Protocolo de Internet
$protocol   = (isset($_SERVER['HTTPS']))?'https://':'http://';  //Protocolo de Internet
$host		    = $_SERVER['HTTP_HOST'];			//Nombre del dominio (dominio.com).
$ip_address = $_SERVER['REMOTE_ADDR'];			//Se obtiene la direccion ip del visitante de la pagina web.
$ip			    = ($ip_address!='' && $ip_address!=NULL && $ip_address!='::1')?$ip_address:gethostbyname($host);
$IPv4 		  = ip2long($ip);						//Direccion IPv4 
$pag_self 	= $_SERVER['PHP_SELF'];			    //Se obtiene la raiz y el nombre de la pagina.
$pag_url 	  = $_SERVER['REQUEST_URI'];		    //Se obtiene la url de la pagina incluyendo variables.
$pag_name 	= basename($_SERVER['PHP_SELF']);   //Nombre de la pagina.
$refer 		  = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';

/*VARIABLES GET*/
$mod 		= (isset($_GET['mod']))?$_GET['mod']:'Home';
$ext 		= (isset($_GET['ext']))?$_GET['ext']:'index';
switch(true){case($ext=='admin/index'):$ext2='admin';break;case($ext=='miembros/index'):$ext2='miembros';break;default:$ext2=$ext;break;}
$opc		= (isset($_GET['opc']))?$_GET['opc']:'';
$action = (isset($_GET['action']))?$_GET['action']:'';
$ctrl 	= (isset($_GET['ctrl']))?$_GET['ctrl']:'';
//$frm 	= (isset($_GET['frm']))?$_GET['frm']:'';
$form		= (isset($_GET['form']))?$_GET['form']:'';//Variable para mostrar formulario crud
$id 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id general
$idp 		= (isset($_GET['id']))?$_GET['id']:'';//Variable de id producto
$idm		= (isset($_GET['idm']))?$_GET['idm']:'';//Variable de id para mail en formularios de contacto
$idf 		= (isset($_GET['idf']))?$_GET['idf']:'';//Variable bandera
$vhref 	= (isset($_GET['vhref']))?$_GET['vhref']:''; //Variable de seguimiento.
$tabla  = (isset($_GET['tabla']))?$_GET['tabla']:'';//Variable de Tabla. 

$dominio    = $protocol.$host.'/';          //Dominio Estructurado
$dominio1   = $protocol.$host;              //Dominio Simple
$url        = $dominio1.$pag_self;			//Se obtiene la url de la pagina.
$URL        = $dominio1.$pag_url;			//Se obtiene la url completa, incluyendo variables.

$host_dom   = 'https://'.$host.'/';
$host_dominio = ($dominio==$host_dom)?'https://'.$host.'/':'http://'.$host.'/';

//$token = bin2hex(random_bytes(64));
$ver_file   = ($host=='localhost')?'ver='.$time:'ver='.$date;
$path_mod   = 'modulos/'.$mod.'/';
$path_jsonDB= 'bloques/webservices/rest/json/';
$path_jsonWS= 'bloques/ws/t/?t=';
date_default_timezone_set("America/Mexico_City");

$path_root=query_opc_curl('m_config','https://mandragorajs.firebaseio.com/m_config.json','path_root','ID',1);
$page_url=$dominio.$path_root;

///
$path_root=($host=='localhost')?'MisSitios/mandragoraJSF/':$path_root;
$prot=($host=='mandragorajsf.herokuapp.com')?'https://':'http://';
$page_url=$prot.$host.'/'.$path_root;
///

/*CONSULTA CONFIG*/
$row=query_row_curl('m_config','https://mandragorajs.firebaseio.com/m_config.json','ID',1);//print_r($row);
$logo=$row['logo'];
$page_name=$row['page_name'];
$title=$row['title'];
//$dominio=($row['dominio'])?$row['dominio']:$dominio;
$path_root=($row['path_root'])?$row['path_root']:$path_root;
//$page_url=$row['page_url'];
$keywords=$row['keyword'];
$description=$row['description'];
$metas=$row['metas'];
$google_analytics=$row['g_analytics'];
$tel=$row['tel'];
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
$wv_web=$row['wv'];
$ls_web=$row['licencia'];
$ver_web=$row['version'];

/*CONSULTA MODULO*/
$row1=query_row_curl('modulos','https://mandragorajs.firebaseio.com/m_modulos.json','modulo',$mod);//print_r($row1);
$ID_mod=$row1['ID'];
$nombre_mod=$row1['nombre'];
$modulo_mod=$row1['modulo'];
$description_mod=$row1['description'];
$dashboard_mod=$row1['dashboard'];
$nivel_mod=$row1['nivel'];
$home_mod=$row1['home'];
$visible_mod=$row1['visible'];
$activo_mod=$row1['activo'];
$sname_mod=$row1['sname'];
$icono_mod=$row1['icono'];
$link_mod=$row1['link'];

/*CONSULTA TEMA*/
$tema=query_opc_curl('m_temas','http://localhost/MisSitios/mandragoraJSF/api/v1/temas','tema','selec',1);//echo $tema;
$subtema=query_opc_curl('m_temas','https://mandragorajs.firebaseio.com/m_temas.json','subtema','selec',1);

$tema_previo=(isset($_GET['tema_previo']))?$_GET['tema_previo']:'';
$tema = ($tema_previo!='' && $tema_previo!=NULL)?$tema_previo:$tema;

$tema = ($subtema!='' && $subtema!=NULL)? $tema.'/'.$subtema : $tema;
$val_wp=query_opc_curl('opciones','https://mandragorajs.firebaseio.com/m_opciones.json','valor','nom','wordpress');//echo $val_wp;
$path_t=($val_wp==1)?'wp-content/themes/':'temas/';
$path_tema=$path_t.$tema.'/';

$path_dashboard='apps/dashboards/'.$dboard2.'/';//$path_LTE='assets/plugins/AdminLTE/';/*---VARIABLES PARA ADMIN-LTE---*/
$ruta_tema='./'.$path_tema.'index.html';
$ruta_modulo='./modulos/'.$mod.'/'.$ext.'.php';
/*---VARIABLES DE PAGINA---*/
$meta_chartset='<!--Caracteres-->'."\r\n".'<meta charset="'.$chartset.'">'."\r\n".'';
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

/*---CODE LICENCE---*/
$ncod='x31q2';
$cms=substr($ls_web,0,3);
/*--- VARIABLES BLOQUEO-IP ---*/
$BLOCK=query_opc_curl('ipbann','https://mandragorajs.firebaseio.com/m_ipbann.json','bloqueo','ip',$ip);
if($BLOCK==''){$cil=$ls_web;if($cil==''){$BLOCK=1;}}
/**[WARNING]********************************************************************************** */
if($url==$dominio.$path_root || $url==$dominio.$path_root.'index.html'){
    if($tema==''){echo $bootstrap.'<div class="alert alert-warning">No hay Tema para la página!</div>';}
    if($ID_mod=='' || $activo_mod==0){echo '<div class="alert alert-danger"><b>Inactivo:</b> ['.$activo_mod.']</div>';header('Location: '.$page_url.'404.php');}
    if(file_exists($ruta_tema)){$alert='<div class="alert alert-success">'.$ruta_tema.'</div>';}else{echo $bootstrap.'<div class="alert alert-danger"><b>Error:</b> La ruta del tema No existe '.$ruta_tema.'</div>';}
    if(file_exists($ruta_modulo)){$alert='<div class="alert alert-success">'.$ruta_modulo.'</div>';}else{echo $bootstrap.'<div class="alert alert-danger"><b>Error:</b> El modulo No existe. '.$ruta_modulo.' '.$back.'</div>';/*header('Location: '.$page_url.'404.php');*/}
}
if($BLOCK==0 && isset($BLOCK)){echo $bootstrap.'<div class="alert alert-danger">Su ip ha sido baneada ('.$BLOCK.')</div>';}
if($BLOCK==1){$aviso=$bootstrap.'<div class="alert alert-warning">Su ip ha sido baneada ('.$BLOCK.')</div>';}
/*---------------------------------------------------------------------------------------------------------------------*/
//--FUNCIONES DE CONSULTAS BASICAS--//////////////////////////////////////////////////////////////////////////////
/*---------------------------------------------------------------------------------------------------------------------*/

function query_row_curl($t_rama,$url,$campo,$id){
  //$url='https://mandragorajs.firebaseio.com/'.$t_rama.'.json';
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,$url);
  $response=curl_exec($ch);
  curl_close($ch);
  //print_r($response);
  $data=json_decode($response,true);
  foreach($data as $key => $value){
    $b_id=$data[$key][$campo];
    if($b_id==$id){//$index=$key;
        $row=$data[$key];
    }
  }
  return $row;
}

function query_opc_curl($t_rama,$url,$res,$campo,$val){
  //$url='https://mandragorajs.firebaseio.com/'.$t_rama.'.json';
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,$url);
  $response=curl_exec($ch);
  curl_close($ch);
  //print_r($response);
  $data=json_decode($response,true);
  foreach($data as $key => $value){
    $selec=$data[$key][$campo];
    if($selec==$val){$tema=$data[$key][$res];}
  }
  return $tema;    
}



