<?php 
include '../../../admin/conexion.php';

switch(true){
  case ($opc=='list'):
	ws_tabla('tareas',1);
  break;
  case ($opc=='buscar'):
	$search=$_POST['search'];
	if(!empty($search)){
  		$query="SELECT * FROM ".$DBprefix."tareas WHERE nom LIKE '%{$search}%'";
  		ws_query($query,1,0);
	}
  break;
  case ($opc=='add'):
	if(isset($_POST['nom'])) {
  		$nom=$_POST['nom'];
  		$des=$_POST['des'];
  		$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."tareas(nom,descripcion) VALUES('{$nom}','{$des}');") or print mysqli_error($mysqli);
  		echo 'Tarea agregada correctamente'; 
	}
  break;
  case ($opc=='edit'):
	if(isset($_POST['id'])){
  		$nom = $_POST['nom']; 
  		$des = $_POST['des'];
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."tareas SET nom='{$nom}',descripcion='{$des}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea '.$id.' ha sido actualizada';  
	}
  break;
  case ($opc=='edit_form'):
	if(isset($_POST['id'])){
  		$id=mysqli_real_escape_string($mysqli, $_POST['id']);  
  		$query="SELECT * FROM ".$DBprefix."tareas WHERE ID=$id";
  		ws_query($query,1,1);
	}
  break;
  case ($opc=='delete'):
	if(isset($_POST['id'])){
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix."tareas WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea ha sido borrada '.$id;  
	}
  break;
}
?>