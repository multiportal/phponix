<?php
include '../../../admin/conexion.php';
include 'functions.php';
switch (true) {
	case ($opc=='edit-var'):
	if($_POST){
		foreach ($_POST['ID'] as $key) {
			$Id=$_POST['ID'][$key];
			$nom=$_POST['nom'][$key];
			$val=$_POST['val'][$key];
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