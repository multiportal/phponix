<?php
include '../../../admin/conexion.php';
include 'functions.php';
$secc=$_GET['secc'];
switch(true){
case($secc=='ima_top'):

$table='menu_web';
switch(true){
  case($opc=='registros'):
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$table." WHERE subm='' AND visible=1;") or print mysqli_error($mysqli); 
	while($reg=mysqli_fetch_array($sql)){
		$id=$reg['ID'];
		$ima_top=$reg['top'];
		$modulo=$reg['modulo'];
		$visible=$reg['visible'];
		echo '
                <tr>
                  <td>'.$id.'</td>
                  <td><img src="'.$page_url.$path_tema.'images/'.$ima_top.'" width="50px">'.$ima_top.'</td>
				  <td>'.$modulo.'</td>
				  <td>'.$visible.'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>';
	}
  break;
  case ($opc=='list'):
	$query="SELECT * FROM ".$DBprefix.$table." WHERE subm='' AND visible=1";
	ws_query($query,1,0);
  break;
  case ($opc=='buscar'):
	$search=$_POST['search'];
	if(!empty($search)){
  		$query="SELECT * FROM ".$DBprefix.$table." WHERE nom LIKE '%{$search}%'";
  		ws_query($query,1,0);
	}
  break;
  case ($opc=='add'):
	if(isset($_POST['nom'])) {
  		$nom=$_POST['nom'];
  		$des=$_POST['des'];
  		$sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix.$table."(nom,descripcion) VALUES('{$nom}','{$des}');") or print mysqli_error($mysqli);
  		echo 'Tarea agregada correctamente'; 
	}
  break;
  case ($opc=='edit'):
	if(isset($_POST['id'])){
  		$nom = $_POST['nom']; 
  		$des = $_POST['des'];
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix.$table." SET nom='{$nom}',descripcion='{$des}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea '.$id.' ha sido actualizada';  
	}
  break;
  case ($opc=='edit_form'):
	if(isset($_POST['id'])){
  		$id=mysqli_real_escape_string($mysqli, $_POST['id']);  
  		$query="SELECT * FROM ".$DBprefix.$table." WHERE ID=$id";
  		ws_query($query,1,1);
	}
  break;
  case ($opc=='delete'):
	if(isset($_POST['id'])){
  		$id = $_POST['id'];
  		$sql=mysqli_query($mysqli,"DELETE FROM ".$DBprefix.$table." WHERE ID='{$id}';") or print mysqli_error($mysqli);
  		echo 'La tarea ha sido borrada '.$id;  
	}
  break;
}

break;
}
?>