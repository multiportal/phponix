<?php
include '../../admin/conexion.php';
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
/*
			$para='memojl08@gmail.com,contacto@samsung-healthcare.mx';
			$de=$email;
			$titulo='SAMSUNG HEALTHCARE - CONTACTO';
			$message = "<html><body style='font-family:Verdana, Geneva, sans-serif; font-size: 13px;'>".
						"<p>Mensaje enviado a tráves de la página web Contacto de {$page_name}.</p>".
						"<table style='font-family:Verdana, Geneva, sans-serif; font-size:13px;'>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Usuario:</td><td style='background-color: #eee;'>".$nombre."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Tel:</td><td style='background-color: #fff;'>".$tel."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Correo:</td><td style='background-color: #fff;'>".$email."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Mensaje:</td><td style='background-color: #eee;'>".$msj."</td></tr>";
    		$message .="</table></body></html>";
			$header = "From: SAMSUNG HEALTHCARE - Contacto" . "<contacto@samsung-healthcare.mx>\r\n";
  			$header .= 'MIME-Version: 1.0' . "\r\n";
    		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		 
*/
			$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."blog_coment (ip,nombre,email,comentario,id_b,fecha,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$msj}','{$id_b}','{$fecha}','1');") or print mysqli_error($mysqli); 
			validar_aviso2($save,'Su comentario ha sido enviado, gracias','Hubo un problema al enviar su comentario, por favor intentelo nuevamente',$aviso);
			//mail($para,$titulo,$message,$header);

	}else{
			$aviso='
			<div class="alert alert-danger alert-dismissible">
                <b><i class="icon fa fa-ban"></i> Error!</b> Hubo un problema al <i>enviar</i> su comentario, por favor intentelo nuevamente.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			</div>
			';
	}
echo $aviso;
?>
