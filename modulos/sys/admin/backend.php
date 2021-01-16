<?php
include '../../../admin/conexion.php';
include 'functions.php';

switch(true){
  case($opc=='num_opciones'):
	options($checks,$num_rows);
	echo $num_rows;
  break;	
  case($opc=='registros'):
	options($checks,$num_rows);
	echo $checks;
  break;
  case($opc=='add'):
 	if(isset($_POST['nom'])) {
  		$nom=$_POST['nom'];
  		$des=$_POST['descripcion'];
		$valor=$_POST['valor'];
  		$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."opciones (nom,descripcion,valor) VALUES ('{$nom}','{$des}','{$valor}');") or print mysqli_error($mysqli);
  		echo 'Tarea agregada correctamente'; 
	}
  break;
  case($opc=='edit'): 
	if(isset($_POST['ID'])) {
  		$id=$_POST['ID'];
		$valor=$_POST['valor'];
		$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor='{$valor}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'Se actualizado la opcion '.$id.' correctamente'; 
  	}
  break;
  case($opc=='opciones'):
	if($_POST['Guardar']){
		unset($_POST['Guardar'],$_POST['refer']);
		$arr_opc=$_POST;
		$num_array=count($arr_opc);
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor='0' WHERE valor=1;") or print mysqli_error($mysqli);
	 	foreach ($_POST as $clave=>$val){
			//$out.='<div>'.$clave."=".$val.'</div>';
			if($val!=12){
				$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor='1' WHERE ID='{$val}';") or print mysqli_error($mysqli);
			}			
   		}
		validar_aviso($save,'Se han actualizado '.$num_array.' opciones','No se puedo actualizar las opciones intentelo nuevamente',$aviso);
		//$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
		recargar(3,$URL,$target);	
	}	
  break;
}
?>