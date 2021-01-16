<?php
include '../../../admin/conexion.php';
include '../../../apps/dashboards/functions.php';
include 'functions.php';

switch(true){
  case($opc=='opcion'):

  break;	
  case($opc=='items'):
	servicios($ext);
  break;	
  default:
  	$tabla='servicios';
	switch(true){
	  case($action=='buscar'):
		$q=$_POST['q'];
		if(!empty($q)){
  			$query="SELECT ID,clave,cover,titulo,precio,cate,visible FROM ".$DBprefix.$tabla." WHERE titulo LIKE '%{$q}%'";
		}else{$query="SELECT * FROM ".$DBprefix.$tabla."";}
  		ws_query($query,1,0);
	  break;
	  case($action=='delete'):
		if(isset($_POST['id'])){
  			$id=$_POST['id'];
  			$sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix.$tabla." WHERE ID='{$id}';") or print mysqli_error($mysqli);
  			echo 'La tarea ha sido borrada '.$id;  
		}	  
	  break;
	  case($action=='edit' || $action=='add'):
$id=$_POST['id'];	  
$clave=$_POST['clave'];
$cover=$_POST['cover'];
$titulo=$_POST['titulo'];
$des=$_POST['des'];
$precio=$_POST['precio'];
$cate=$_POST['cate'];
$alta=$_POST['alta'];
$fmod=$_POST['fmod'];
$user=$_POST['user'];
$visible=$_POST['visible'];
$c=0;
html_iso_servicios($titulo);
	if($titulo=='' || $visible==''){
		$error = "  *El campo esta vacio.\\n\\r"; $c++; 
	}
	if($titulo=='' && $visible==''){
		$error = "  *Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
			</div>
			';
	}else{
		if($action=='edit'){$edi='editado';
			$save=mysqli_query($mysqli,"UPDATE ".$DBprefix.$tabla." SET clave='{$clave}', cover='{$cover}', titulo='{$titulo}', descripcion='{$des}', precio='{$precio}', cate='{$cate}', fmod='{$fmod}', user='{$user}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
		}else{$edi='agregado';
			$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix.$tabla." (clave,cover,titulo,descripcion,precio,cate,alta,user,visible) VALUES ('{$clave}','{$cover}','{$titulo}','{$des}','{$precio}','{$cate}','{$alta}','{$user}','{$visible}')") or print mysqli_error($mysqli);
		}	
		$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.$cond_opc;	
		recargar(5,$URL,$target);
	}
	validar_aviso($save,'El Servicio se ha '.$edi.' correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	echo $aviso;

	  break;
	  case($action=='subir_cover'):
//if($_POST['Aceptar']){
if($cover==''){$cover='nodisponible1.jpg';}
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" style="width:200px;" title="'.$cover.'">
<a href="javascript:up_cover(1);">Cambiar Foto</a><div id="upload"></div>';

//datos del arhivo 
$repositor='../fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:200px;">
			<a href="javascript:up_cover(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
echo $file;
//unlink($URL);
//}
	  
	  break;
	  default:
	  
	$modo = (isset($_REQUEST['mode'])&& $_REQUEST['mode'] !=NULL)?$_REQUEST['mode']:'';
	if($modo == 'ajax'){$cond_opc=($opc!='')?'&opc='.$opc:'';
		//include ''; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 8; //la cantidad de registros que desea mostrar		
		$adjacents  = 1; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		//$count_query=mysqli_query($mysqli,"SELECT count(*) AS numrows FROM tcer_productos ");
		//if($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla."") or print mysqli_error($mysqli);
		$numrows=mysqli_num_rows($sql);
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';$rep1=array('_','cion');$rep2=array(' ','ci&oacute;n');
		//consulta principal para recuperar los datos
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." ORDER BY ID LIMIT {$offset},{$per_page};") or print mysqli_error($mysqli);		
		if($numrows>0){$j=0;
			while($row=mysqli_fetch_array($sql)){$j++;
$id	= $row['ID'];
$clave=$row['clave'];
$titulo=$row['titulo'];
$cover=$row['cover'];
$des=$row['descripcion'];
$precio=$row['precio'];
$cate=ucfirst(str_replace($rep1,$rep2,$row['cate']));
$visible = $row['visible'];
$cover=($cover!='')?$cover:'nodisponible.jpg';
$seleccion=($visible==0)?'<span style="color:#e00;"><i class="fa fa-close" title="Desactivado"></i></span>':'<span style="color:#0f0;"><i class="fa fa-check" title="Activo"></i></span>';
$activo=($visible==1)?'<span class="label label-success">Activo</span>':'<span class="label label-danger">Desactivado</span>';
				if($action=='listado' && !empty($action)){
$listado.='
	<tr>
		<td class="text-center">'.$clave.'</td>
		<td class="text-center">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" alt="Product Image" class="img-rounded" width="60">
		</td>
		<td>'.$titulo.'</td>
		<td class="text-center">'.$cate.'</td>
		<td class="text-right">'.$precio.'</td>
		<td class="text-center">'.$activo.'</td>
		<td>
			<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index'.$cond_opc.'&form=1&action=edit&id='.$id.'" alt="Editar"><i class="fa fa-edit"></i></a> | 
			<a href="#" taskid="'.$id.'" class="task-delete" alt="Borrar"><i class="fa fa-trash"></i></a>

			<!--div class="btn-group pull-right">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
				<ul class="dropdown-menu">
					<li><a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index'.$cond_opc.'&form=1&action=edit&id='.$id.'"><i class="fa fa-edit"></i> Editar</a></li>
					<li><a href="#" taskid="'.$id.'" class="task-delete"><i class="fa fa-trash"></i> Borrar</a></li>
				</ul>
			</div><!-- /btn-group -->
    	</td>
	</tr>';
					}else{
$listado.='
	<div class="col-md-3 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
       			<h3 class="box-title">C&oacute;digo: <b>'.$clave.'</b></h3>
				<span class="controles">'.$seleccion.'
					<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index'.$cond_opc.'&form=1&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="#" taskid="'.$id.'" class="task-delete" title="Borrar"><i class="fa fa-trash"></i></a>
				</span>
			</div>
			<div class="box-body">
				<div class="ima-size">
					<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" class="img-responsive ima-size">
				</div>
				<div id="title"><strong>'.$titulo.'</strong></div>	
			</div><!-- /.box-body -->
		</div>
	</div>';
	}
}//WHILE

			if($action=='listado' && !empty($action)){
?>
					<div class="box-body">                        
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-striped ">
			 	 				<tbody>
								<tr>
									<th class="text-center">Clave</th>
									<th class="text-center">Imagen</th>
									<th>Titulo</th>
									<th class="text-center">Categoria</th>
									<th class="text-center">Precio</th>
                                    <th class="text-center">Estado</th>
									<th>Acciones</th>
								</tr>
								<?php echo $listado;?>
								</tbody>
							</table>
						</div>	
					</div><!-- /.box-body -->
<?php			
			}else{echo '<div class="box-body">'.$listado.'</div>';}?>
					<div class="box-footer clearfix">				
					Mostrando <?php echo $ini=$id-($j-1);?> al <?php echo $id;?> de <?php echo $numrows;?> registros<?php echo paginate($reload, $page, $total_pages, $adjacents);?>					
					</div>
<?php 			
		}else{//$numrows
			echo '
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Error</h4> No hay datos para mostrar.
            </div>';
		}
	}


	  break;
	}			
  break;
}
?>