<?php
include '../../../admin/conexion.php';
include '../../../apps/dashboards/functions.php';
include 'functions.php';

switch(true){
	case($action=='select_cate'):
		$ID_cate=$_REQUEST["elegido"];
		$data=query_opc('productos_cate','categoria','ID',$ID_cate);
		echo $data;
	break;
	case($action=='select_cate_subcate'):
		$ID_cate=$_REQUEST["elegido"];
		select_sub_cate($ID_cate,$ID_sub_cate);
	break;
	case($action=='delete'):
		$id=$_POST['id'];
		$tabla=validacion_tabla($tabla);
		delete($id);
	break;
	case($action=='edit' || $action=='add'):
		acciones();
	break;
	case($action=='subir_cover'):
		$val=(isset($_GET['val']))?$_GET['val']:'';
		$cover = 'nodisponible1.jpg';
		$file=file_ima($cover);
	
		//datos del arhivo 
		$repositor='../fotos';
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
			  $f=($val!='')?file_ima2($nombre_archivo):file_ima($nombre_archivo);
			  $file='<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <b>Correcto:</b> El archivo '.$val.' se subio correctamente.</div>'.$f;
		  }else{
			  $file='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <b>Error:</b> Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</div>'.$file;
		  }
		}
		echo $file;	
	break;
	default:
        listado($th,$btn_modal);    
    break;
}
?>