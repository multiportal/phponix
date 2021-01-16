<?php
include '../../../admin/conexion.php';
include '../../../apps/dashboards/AdminLTE/function.php';

$path_LTE='assets/plugins/AdminLTE/';
$ima=$_GET['ima'];
$id=$_GET['id'];
$val=$_GET['val'];
if($ima!=''){$ti='Cambiar';$img_actual='<div>Imagen Actual:<br><img src="../fotos/'.$ima.'" width="100" /></div><p></p>';}else{$ti='Subir';$img_actual='';}
if($val==1){$tag_sql="imagen1";}
else if($val==2){$tag_sql="imagen2";}
else if($val==3){$tag_sql="imagen3";}
else if($val==4){$tag_sql="imagen4";}
else if($val==5){$tag_sql="imagen5";}
else{$tag_sql="cover";}
$file='<input name="userfile" type="file">';
$boton='
<div class="box-footer">
	<input name="Aceptar" type="submit" class="btn btn-primary" value="Guardar">
    <!--button type="submit" class="btn btn-primary">Guardar</button--> 
</div>';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='../fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_file = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 10000000))) { 
    	$file= '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Error!</h4> El tipo de archivo NO ha sido aceptado.</div>
		<input type="file" name="userfile">'.$boton;
	}else{ 
    	if (@copy($_FILES['userfile']['tmp_name'], $path_file)){//se cambio la funcion #move_uploaded_file" por "copy" para que las imagenes tuvieran los mismos permisos
			mysqli_query($mysqli,"UPDATE ".$DBprefix."portafolio SET ".$tag_sql."='{$nombre_archivo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
    		$file='<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Correcto!</h4> El archivo se actualizado correctamente.</div>';
			$boton='';
			$URL=$page_url.'index.php?mod=portafolio&ext=admin/index&action=edit&id='.$id;$target='_parent';
			recargar(5,$URL,$target);
		}
		else{
			$file='<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Error!</h4> Ocurri&oacute; alg&uacute;n error al subir el fichero. No se puedo guardar intentelo nuevamente.</div>
			<input type="file" name="userfile">'.$boton;
		}
	}
}

open_page_LTE();
?>
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom"><?php echo $ti;?> Imagen <?php echo $val;?></label>
                  <?php echo $img_actual.$file;?>
                </div>
              </div>
              <!-- /.box-body -->
              <?php echo $boton;?>
            </form>
<?php 
close_page();
?>