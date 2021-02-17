<?php
include '../../../admin/conexion.php';
include '../../../apps/dashboards/AdminLTE/function.php';

$path_LTE='assets/plugins/AdminLTE/';
$ima=$_GET['ima'];
$pdf=$_GET['pdf'];
$id=$_GET['id'];
$val=$_GET['val'];
if($val<=-1){
	if($pdf!=''){$ti='Cambiar Pdf';$img_actual='<div>Imagen Actual:<br><img src="../fotos/pdf_icon.png" width="54" /></div><p>'.$pdf.'</p>';}else{$ti='Subir Pdf';$img_actual='';}
}else{
	if($ima!=''){$ti='Cambiar Imagen';$img_actual='<div>Imagen Actual:<br><img src="../fotos/'.$ima.'" width="100" /></div><p></p>';}else{$ti='Subir Imagen';$img_actual='';}
}

switch(true){
	case($val==-5):
		$tag_sql="pdf5";
	break;
	case($val==-4):
		$tag_sql="pdf4";
	break;
	case($val==-3):
		$tag_sql="pdf3";
	break;
	case($val==-2):
		$tag_sql="pdf2";
	break;
	case($val==-1):
		$tag_sql="pdf1";
	break;
	case($val==1):
		$tag_sql="imagen1";
	break;
	case($val==2):
		$tag_sql="imagen2";
	break;
	case($val==3):
		$tag_sql="imagen3";
	break;
	case($val==4):
		$tag_sql="imagen4";
	break;
	case($val==5):
		$tag_sql="imagen5";
	break;
	default:
		$tag_sql="cover";
	break;
}
$file='<input name="userfile" type="file">';
$boton='
<div class="box-footer">
	<input name="Aceptar" type="submit" class="btn btn-primary" value="Guardar">
    <!--button type="submit" class="btn btn-primary">Guardar</button--> 
</div>';

if($_POST['Aceptar']){
//datos del arhivo 
//if($val<=-1)
if($val>=0){$repositor='../fotos';$tipos=array('gif','jpeg','png');$size_file='10000000';/*imagen*/}else{$repositor='../pdf';$tipos=array('pdf','pdf','pdf');$size_file='1000000000';/*archivo*/}
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_file = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 

	if(!((strpos($tipo_archivo, $tipos[0]) || strpos($tipo_archivo, $tipos[1]) || strpos($tipo_archivo, $tipos[2])) && ($tamano_archivo<$size_file))) { 
    	$file= '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Error!</h4> El tipo de archivo NO ha sido aceptado.</div>
		<input type="file" name="userfile">';
	}else{ 
    	if (@copy($_FILES['userfile']['tmp_name'], $path_file)){//se cambio la funcion "move_uploaded_file" por "copy" para que las imagenes tuvieran los mismos permisos
			mysqli_query($mysqli,"UPDATE ".$DBprefix."productos SET ".$tag_sql."='{$nombre_archivo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
    		$file='<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Correcto!</h4> El archivo se actualizado correctamente.</div>';
			$boton='';
			$URL=$page_url.'index.php?mod=productos&ext=admin/index&&opc=producto&action=form&ctrl=edit&id='.$id;$target='_parent';
			recargar(3,$URL,$target);
		}
		else{
			$file='<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Error!</h4> Ocurri&oacute; alg&uacute;n error al subir el fichero. No se puedo guardar intentelo nuevamente.</div>
			<input type="file" name="userfile">';
		}
	}
}

open_page_LTE();
?>
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom"><?php echo $ti;?> <?php echo $val=($val!=-1)?$val:'';?></label>
                  <?php echo $img_actual.$file;?>
                </div>
              </div>
              <!-- /.box-body -->
              <?php echo $boton;?>
            </form>
<?php 
close_page();
?>