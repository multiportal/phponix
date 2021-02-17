<?php
include '../../../admin/conexion.php';
include 'functions.php';

switch(true){
  case ($action=='list'):
	ws_tabla('tareas',1);
  break;
  case ($action=='buscar'):
	$search=$_POST['search'];
	if(!empty($search)){
  		$query="SELECT * FROM ".$DBprefix."tareas WHERE nom LIKE '%{$search}%'";
  		ws_query($query,1,0);
	}
  break;
  case ($action=='add'):
	if(isset($_POST['nom'])) {
  		$nom=$_POST['nom'];
  		$des=$_POST['des'];
  		$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."tareas(nom,descripcion) VALUES('{$nom}','{$des}');") or print mysqli_error($mysqli);
  		echo 'Tarea agregada correctamente'; 
	}
  break;
  case ($action=='edit'):
	if(isset($_POST['id'])){
  		$nom = $_POST['nom']; 
  		$des = $_POST['des'];
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."tareas SET nom='{$nom}',descripcion='{$des}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea '.$id.' ha sido actualizada';  
	}
  break;
  case ($action=='edit_form'):
	if(isset($_POST['id'])){
  		$id=mysqli_real_escape_string($mysqli, $_POST['id']);  
  		$query="SELECT * FROM ".$DBprefix."tareas WHERE ID=$id";
  		ws_query($query,1,1);
	}
  break;
  case ($action=='delete'):
	if(isset($_POST['id'])){
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix."tareas WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea ha sido borrada '.$id;  
	}
  break;
  default:

	$modo = (isset($_REQUEST['mode'])&& $_REQUEST['mode'] !=NULL)?$_REQUEST['mode']:'';
	if($modo == 'ajax'){
		//include ''; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 8; //la cantidad de registros que desea mostrar		
		$adjacents  = 1; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		//$count_query=mysqli_query($mysqli,"SELECT count(*) AS numrows FROM tcer_productos ");
		//if($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos") or print mysqli_error($mysqli);
		$numrows=mysqli_num_rows($sql);
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';
		//consulta principal para recuperar los datos
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos ORDER BY ID LIMIT {$offset},{$per_page};") or print mysqli_error($mysqli);		
		if($numrows>0){$j=0;
			while($row=mysqli_fetch_array($sql)){$j++;
$id	= $row['ID'];
$codigo = $row['codigo'];
$nombre = $row['nombre'];
$modelo = $row['modelo'];
$cover = $row['cover'];
$stock = $row['stock'];
$des = $row['descripcion'];
$marca = $row['marca'];
$precio = $row['precio'];
$visible = $row['visible'];
$cover=($cover!='')?$cover:'nodisponible.jpg';
$seleccion=($visible==0)?'<span style="color:#e00;"><i class="fa fa-close" title="Desactivado"></i></span>':'<span style="color:#0f0;"><i class="fa fa-check" title="Activo"></i></span>';
$activo=($visible==1)?'<span class="label label-success">Activo</span>':'<span class="label label-danger">Desactivado</span>';
				if($opc=='producto'){
$listado.='
<div class="col-lg-3 col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
       		<h3 class="box-title">C&oacute;digo: <b>'.$codigo.'</b></h3>
			<span class="controles">'.$seleccion.'
				<a href="'.$page_url.'index.php?mod=productos&ext=admin/index&opc='.$opc.'&frm=1&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a>
			</span>
		</div>
		<div class="box-body">
			<div class="ima-size">
				<img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" class="img-responsive">
			</div>
			<div id="title"><strong>'.$nombre.' '.$modelo.'</strong></div>	
		</div><!-- /.box-body -->
	</div>
</div>';
					}else{
$listado.='	
	<tr>
		<td class="text-center">'.$codigo.'</td>
		<td class="text-center">
			<img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="Product Image" class="img-rounded" width="60">
		</td>
		<td class="vcenter">06P4069</td>
		<td>'.$nombre.'</td>
		<td>'.$marca.'</td>
		<td class="text-center">'.$activo.'</td>
		<td class="text-center">'.$stock.'</td>
		<td class="text-right">'.$precio.'</td>
		<td>
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
				<ul class="dropdown-menu">
					<li><a href="'.$page_url.'index.php?mod=productos&ext=admin/index&opc=producto&frm=1&action=edit&id='.$id.'"><i class="fa fa-edit"></i> Editar</a></li>
					<li><a href="#" data-toggle="modal" data-target="#barcodeModal" data-id="10" data-product_code="'.$codigo.'" data-product_name="'.$nombre.'"><i class="fa fa-barcode"></i> C&oacute;digo de barra</a></li>
					<li><a href="#" onclick="eliminar(10)"><i class="fa fa-trash"></i> Borrar</a></li>
				</ul>
			</div><!-- /btn-group -->
    	</td>
	</tr>';
	}
}//WHILE

			if($opc=='producto'){echo $listado;}else{
?>
					<div class="box-body">                        
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-striped ">
			 	 				<tbody>
								<tr>
									<th class="text-center">C&oacute;digo</th>
									<th class="text-center">Imagen</th>
									<th>Modelo </th>
									<th>Producto </th>
									<th>Fabricante </th>
									<th class="text-center">Estado</th>
									<th class="text-center">Stock</th>
									<th class="text-right">Precio</th>
									<th class="text-center">Acciones</th>
								</tr>
								<?php echo $listado;?>
								</tbody>
							</table>
						</div>	
					</div><!-- /.box-body -->
<?php }//$opc==''?>
					<div class="box-footer clearfix">				
					Mostrando <?php echo $ini=$id-($j-1);?> al <?php echo $id;?> de <?php echo $numrows;?> registros<?php echo paginate1($reload, $page, $total_pages, $adjacents);?>					
					</div>		
<?php 			
}else{//$numrows
?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Error</h4> No hay datos para mostrar.
            </div>
			<?php
		}
	}
  
  break;
}
?>