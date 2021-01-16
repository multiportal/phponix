<?php
include '../../admin/conexion.php';
	$id=$_GET['id'];
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog_coment WHERE id_b='{$id}' AND visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
	$num_rows=mysqli_num_rows($sql);
  	if($num_rows!=0){
		while($row=mysqli_fetch_array($sql)){
			echo'
			<div id="cont-coment">
				<div>'.$row['nombre'].' ['.$row['fecha'].']</div>
				<div>'.$row['comentario'].'</div>
			</div>
			<hr>
			';
		}
	}else{
		echo'<div id="cont-coment">No hay comentarios.</div>';
	}
?>