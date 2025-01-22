<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//FUNCIONES ESPECIALES MOD: VCARD
$proyecto = $_GET['proyecto'];//'cloudphp';
$host = $_SERVER['HTTP_HOST']; //Nombre del dominio (dominio.com).
$dominio = ($host=='localhost')?'http://'.$host.'/':'https://'.$host.'/';
$path_app = ($proyecto=='vcardappjs' || $host=='vcardappjs.herokuapp.com')?'app/':'';
$path_root = ($host=='localhost')?'MisSitios/'.$proyecto.'/'.$path_app:$path_app;
$page_url = $dominio.$path_root;
$mod = (isset($_GET['mod']))?$_GET['mod']:'';
$action = (isset($_GET['action']))?$_GET['action']:'';
//$mod = 'tarjetas';

function file_ima($cover){
//global $page_url,$mod;
   //$url_ima=($mod=='perfil')?$page_url.'upload/files/images/photos/':'';
   $file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
   <img id="ima" src="'.$cover.'" style="width:150px;" title="'.$cover.'">
   <div id="upload"><a href="javascript:up(1);">Cambiar Foto</a></div>';
   return $file;
}

function file_imaBg($cover){
global $page_url,$mod,$path_app;
   //$url_ima=($mod=='perfil')?$page_url.'upload/files/images/photos/':'';
   $file='<input type="hidden" class="form-control" id="coverbg" name="coverbg" value="'.$page_url.$path_app.'upload/files/images/photos/'.$cover.'">
   <img id="ima2" src="'.$page_url.$path_app.'upload/files/images/photos/'.$cover.'" style="width:150px;" title="'.$cover.'">
   <div id="upload2"><a href="javascript:up2(1);">Cambiar Fondo</a></div>';
   return $file;
}

switch(true){
  case($action=='subir_cover'):
	$cover = 'upload/files/images/photos/sinfoto.png';
	$file=file_imaBg($cover);

	//datos del arhivo 
	$repositor='../images/photos/';
	$nombre_archivo = $_FILES['userfile']['name']; 
	$tipo_archivo = $_FILES['userfile']['type']; 
	$tamano_archivo = $_FILES['userfile']['size']; 
	$path_archivo = $repositor."/".$nombre_archivo;
	//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
  		$file='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Error:</b> El archivo NO ha sido aceptado.</div>'.$file;
	}else{ 
  	  if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
  		$file='<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Correcto:</b> El archivo se subio correctamente.</div>'.file_imaBg($nombre_archivo);
	  }else{
  		$file='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Error:</b> Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</div>'.$file;
	  }
	}
	echo $file;
  break;
  case($action=='subir_coverbg'):
	$cover = 'upload/files/images/photos/sinfoto.png';
	$file=file_imaBg($cover);

	//datos del arhivo 
	$repositor='../images/photos/';
	$nombre_archivo = $_FILES['userfile2']['name']; 
	$tipo_archivo = $_FILES['userfile2']['type']; 
	$tamano_archivo = $_FILES['userfile2']['size']; 
	$path_archivo = $repositor."/".$nombre_archivo;
	//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
  		$file='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Error:</b> El archivo NO ha sido aceptado.</div>'.$file;
	}else{ 
  	  if (@move_uploaded_file($_FILES['userfile2']['tmp_name'],$path_archivo)){
  		$file='<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Correcto:</b> El archivo se subio correctamente.</div>'.file_imaBg($nombre_archivo);
	  }else{
  		$file='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<b>Error:</b> Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</div>'.$file;
	  }
	}
	echo $file;    
  break;
  default:
  $cover = 'upload/cloudinary/assets/img/sinfoto.png';
  //datos del arhivo 
  $repositor='../images/photos/';
  $nombre_archivo = $_FILES['file']['name'];
  $tipo_archivo = $_FILES['file']['type'];
  $tamano_archivo = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name']; 
  $path_archivo = $repositor.$nombre_archivo;
  //compruebo si las características del archivo son las que deseo 
  if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
		$mensaje='<b>Error:</b> El archivo NO ha sido aceptado.';
  }else{ 
	  if (@move_uploaded_file($file_tmp,$path_archivo)){
		$mensaje='<b>Correcto:</b> El archivo se subio correctamente.';
	}else{
		$mensaje='<b>Error:</b> Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.';
	}
  }
  header("HTTP/1.1 200 OK");
  header('Content-Type: application/json');
  $resultado['mensaje'] = $mensaje;
  $resultado['url'] = $page_url.'upload/files/images/photos/'.$nombre_archivo;
  echo json_encode($resultado);
  break;
}