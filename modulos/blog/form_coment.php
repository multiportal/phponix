<?php
//include '../../admin/conexion.php';
//include 'admin/functions.php';

	if($_POST['nom']!=NULL && $_POST['email']!=NULL && $_POST['comment']!=NULL){
	$nom=$_POST['nom'];
	$email=$_POST['email'];
	$comment=$_POST['comment'];
	$fecha=$_POST['fecha'];
	$id_b=$_POST['id_b'];
	$ip=$_POST['ip'];
	
	$nombre = htmlentities($nom, ENT_COMPAT,'UTF-8', true);
	$msj = htmlentities($comment, ENT_COMPAT,'UTF-8', true);

	$sec='comentarios_log';
	$cat_list='blog';
	$titulo='BLOG';

	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."blog_coment (ip,nombre,email,comentario,id_b,fecha,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$msj}','{$id_b}','{$fecha}','1');") or print mysqli_error($mysqli); 
	validar_aviso($save,'Su comentario ha sido enviado, gracias','Hubo un problema al enviar su comentario, por favor intentelo nuevamente',$aviso);
	//mail($para,$titulo,$message,$header);
	}else{
		$aviso='
		<div class="alert alert-danger alert-dismissible">
            <b><i class="icon fa fa-ban"></i> Error!</b> Hubo un problema al <i>enviar</i> su comentario, por favor intentelo nuevamente.
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		</div>';
	}
echo $aviso;
?>
