<?php
//include 'admin/functions.php';
/*
if(isset($_POST['enviar'])){
	$nom=$_POST['nom'];
	$ape=$_POST['ape'];
	$nombre=$nom.' '.$ape;
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$subject=$_POST['asunto'];
	$msj=$_POST['msj'];
	//$nombre = htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	//$nombre = htmlentities($nombre);
	html_iso_contacto($nombre,$email,$subject,$msj);    
	if($nombre==' ' && $email=='' && $subject=='' && $msj==''){
        $error = " *Los campos estan vacios.\n\r"; $c++;
    }
	if($nombre!='' || $email!='' || $subject!='' || $msj!=''){
       	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $error .= "<br>  *Ingrese una direcci&oacute;n de correo v&aacute;lida.\n\r"; $c++; }
	}
	if($nombre!='' && $email!='' && $subject!='' && $msj!=''){        
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $error .= "<br>  *Ingrese una direcci&oacute;n de correo v&aacute;lida.\n\r"; $c++; }
   	}
	if($nombre==' '){$error.='<br> *Falta Nombre'; $c++;}
	if($tel==''){$error.='<br> *Falta Telefono'; $c++;}
	if($subject==''){$error.='<br> *Falta Asunto'; $c++;}
	if($msj==''){$error.='<br> *Falta Mensaje'; $c++;}

	if($c > 0){
        $aviso='
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
            </div>
            ';
    }else{

			$sec='contacto';
			$cat_list='inbox';
			email_forms($CoR1,$CoE1,$BCC1);
			$para=$CoR1;
			$de=$email;

			//$titulo=($subject=='')?'CONTACTO - PHPONIX':'CONTACTO - '.$subject;
			$titulo='Contacto Web PHPONIX';						

			$message = "<html><body style='font-family:Verdana, Geneva, sans-serif; font-size: 13px;'>".
						"<p>Mensaje enviado a tr&aacute;ves de la p&aacute;gina web Contacto de {$page_name}.</p>".
						"<table style='font-family:Verdana, Geneva, sans-serif; font-size:13px;'>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Usuario:</td><td style='background-color: #fff;'>".$nombre."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Tel:</td><td style='background-color: #eee;'>".$tel."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Correo:</td><td style='background-color: #fff;'>".$email."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Asunto:</td><td style='background-color: #eee;'>".$subject."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Mensaje:</td><td style='background-color: #fff;'>".$msj."</td></tr>";
    		$message .="</table></body></html>";
			$header = "From: {$nombre}" . "<{$CoE1}/>\r\n";
			if($BCC1!=''){$header .= "Bcc: {$BCC1}\r\n";}
  			$header .= 'MIME-Version: 1.0' . "\r\n";
    		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";					 

			$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ip,nombre,email,tel,asunto,msj,cat_list,seccion,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$tel}','{$titulo}','{$msj}','{$cat_list}','{$sec}','1');") or print mysqli_error($mysqli); 
			validar_aviso($save,'Su mensaje ha sido enviado a '.$para.' gracias ','Hubo un problema al enviar su email, por favor intentelo nuevamente',$aviso);
			if($save){@mail($para,$titulo,$message,$header);}
		}
}
*/
$id=$_GET['id'];
if($id!=''){
	$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor={$id} WHERE nom='email_test'");
	$sql1=mysqli_query($mysqli,"SELECT url FROM ".$DBprefix."menu_web WHERE modulo='{$mod}'");	
	if($row=mysqli_fetch_array($sql1)){$url1=$row['url'];}
	sql_opciones('link_var',$valor);
	$URL=($valor==1)?$page_url.'index.php?mod=contacto':$page_url.$url1;	
	recargar(1,$URL,$target);		
}

sql_opciones('email_test',$valor);
$act_prueba=($valor==1)?'<a href="'.$page_url.'index.php?mod=contacto&id=0" style="color:#f00;">Desactivar Prueba</a>':'<a href="'.$page_url.'index.php?mod=contacto&id=1" style="color:#0ff;">Activar Prueba</a>';

if($nivel_login==-1 && $username=='admin'){
	email_forms($CoR1,$CoE1,$BCC1);	
	$aviso.= '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-info"></i> Info</h4>
				['.$act_prueba.'] [<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index"><i class="fa fa-gear"></i> Config. Contacto</a>] [<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index&opc=forms"><i class="fa fa-pencil-square-o"></i> Correos de Formulario</a>]<br>
                Email Recepci&oacute;n: '.$CoR1.' | '.$BCC1.' <br>
				Email Envio: '.$CoE1.'				
          </div>';
}
?>
<div><?php echo $aviso;?></div>
<!-- form message -->
<div class="row">
	<div class="col-12">
    	<div class="alert alert-success contact__msg" style="display:none;" role="alert">
        	Tu mensaje fue enviado exitosamente.
		</div>
	</div>
</div>
<!-- end message -->
<form class="contact__form" method="post" action="<?php echo $page_url;?>modulos/contacto/form/mail.php">
<div class="lm-col-12 xs-col-12">
	<div class="lm-col-6 xs-col-12">
    	<div class="form-group">
        	<label for="nombre">Nombre*</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
        </div>
	</div>
   	<div class="lm-col-6 xs-col-12">
    	<div class="form-group">
        	<label for="mail">Correo Electr&oacute;nico*</label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
        </div>
	</div>
   	<div class="lm-col-6 xs-col-12">
    	<div class="form-group">
        	<label for="tel">Tel&eacute;fono*</label>
            <input type="tel" class="form-control" id="tel" name="tel" required autocomplete="off">
        </div>
	</div>
   	<div class="lm-col-6 xs-col-12">        
    	<div class="form-group">
        	<label for="subject">Asunto*</label>
            <input type="text" class="form-control" id="asunto" name="asunto" required autocomplete="off">
        </div>
	</div>

    	<div class="form-group">
        	<label for="msj">Mensaje*</label>
            <textarea class="form-control" id="msj" name="msj" cols="20" rows="10" required></textarea>
        </div>
</div>

<div class="lm-col-12 xs-col-12" style="text-align:right;">
	<input type="submit" id="enviar" name="enviar" class="btn btn-danger" value="ENVIAR">
</div>
</form>
<script src="<?php echo $page_url.'modulos/contacto/form/form.js';?>"></script>