<?php 
include '../../admin/conexion.php';

$opc=$_GET['opc'];
switch(true){
	case ($opc=='buscar'):

$search=$_POST['search'];
if(!empty($search)){
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."tareas WHERE nom LIKE '%{$search}%';") or print mysqli_error($mysqli);
	$json=array();
	while($row=mysqli_fetch_assoc($sql)){
		$json[]=$row;
	}
	$jsonstring=json_encode($json);
	echo $jsonstring;
}

	break;
	case ($opc=='add'):

if(isset($_POST['nom'])) {
  # echo $_POST['nom'] . ', ' . $_POST['descripcion'];
  $nom=$_POST['nom'];
  $des=$_POST['des'];
  $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."tareas(nom,descripcion) VALUES('{$nom}','{$des}');") or print mysqli_error($mysqli);
  echo 'Tarea agregada correctamente'; 
}

	break;
	case ($opc=='delete'):

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix."tareas WHERE ID='{$id}';") or print mysqli_error($mysqli);
  echo 'La tarea ha sido borrada '.$id;  
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
  $id = mysqli_real_escape_string($mysqli, $_POST['id']);  
  $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."tareas WHERE ID='{$id}';") or print mysqli_error($mysqli);
  $json = array();
  while($row = mysqli_fetch_assoc($sql)){$json[] = $row;}
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

	break;
	case ($opc=='list'):

  $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."tareas;") or print mysqli_error($mysqli);
  $json = array();
  while($row = mysqli_fetch_assoc($sql)){$json[]=$row;}
  $jsonstring = json_encode($json);
  echo $jsonstring;

	break;

}
?>