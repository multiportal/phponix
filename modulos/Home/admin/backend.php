<?php
include '../../../admin/conexion.php';
include 'functions.php';
switch (true) {
	case ($opc=='edit-var'):
	if($_POST){
		$n=count($_POST);
		for($i=1;$i<$n;$i++){
			$Id=$_POST['ID'][$i];
			$nom=$_POST['nom'][$i];
			$val=$_POST['val'][$i];
			$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."css2 SET nom='{$nom}', contenido='{$val}' WHERE ID='{$Id}';") or print mysqli_error($mysqli);			
		}
		validar_aviso($save,'Estilos Actualizado!','Fallo Actualización!',$aviso);
		echo $aviso;
	}
	break;
	case ($opc=='add-var'):
	if($_POST){
		$tabla=validacion_tabla('css2');
		$save = insert();  
		validar_aviso($save,'Estilos Agregado!','No se agrego!',$aviso);
		echo $aviso;
	}	
	break;
	case ($opc=='delete-var'):
	if($_POST){
		$id=$_POST['ID'];
		$tabla=validacion_tabla('css2');
		delete($id);
	}	
	break;
	default:
	
	break;
}
?>