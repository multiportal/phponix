<?php
include '../../../admin/conexion.php';
include '../../../apps/dashboards/functions.php';
include 'functions.php';

switch(true){
	case($action=='comentarios'):
		$i=0;
		$IDB=$_REQUEST['IDB'];
		$tabla='blog_coment';
		$data = query_data($tabla,$url_api=NULL);
		foreach ($data as $row) {$i++;
			$ID=$row['ID'];
			$id_b=$row['id_b'];
			$visible=$row['visible'];
			if($visible==1 && $id_b==$IDB){
				if($tema=='porto'){
					$comentarios.='
						<li>
                           <div class="comment">
                              <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                 <img class="avatar" alt="" src="'.$page_url.'modulos/blog/fotos/sinfoto.png">
                              </div>
                              <div class="comment-block">
                                 <div class="comment-arrow"></div>
                                 <span class="comment-by">
                                 <strong>'.$row['nombre'].'</strong>
                                 <span class="float-right">
                                 <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                 </span>
                                 </span>
                                 <p>'.$row['comentario'].'</p>
                                 <span class="date float-right">'.$row['fecha'].'</span>
                              </div>
                           </div>
                        </li>
					';
				}else{
					$comentarios.='
					<div id="cont-coment">
						<div>'.$row['nombre'].' ['.$row['fecha'].']</div>
						<div>'.$row['comentario'].'</div>
					</div>
					<hr>';
				}
			}		
		}
		echo '<h4 class="mb-3">Comentarios ('.$i.')</h4>'.$comentarios;
	break;
	case($action=='addcoment'):
		//$tabla=validacion_tabla('blog_coment');
		//insert();
		include '../form_coment.php';
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