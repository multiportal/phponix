<?php
//Poner condicional IF
include '../../admin/conexion.php';
open_page_form();
$username='';
$mod='forget';
log_visitas($username);


if($_POST['email']){
$email=$_POST['email'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE email='{$email}';") or print mysqli_error($mysqli);
$num_log=mysqli_num_rows($sql);
	if($num_log!=0){
		if($row=mysqli_fetch_array($sql)){
			$username=$row['username'];
			//$password=$row['password'];
			$email=$row['email'];
		}
		$num_u = strlen($username);
		$n=$num_u+5;
		$password = substr($actualizacion,$n);
			/*Configuraciones de envio*
			ini_set('sendmail_from', 'webmaster@fibremex.com.mx');
			ini_set('SMTP','mail.fibremex.com.mx');
			ini_set('smtp_port',26);
			/*---*/
			$para=$email;
			$titulo=$page_name.' - Cambio de Password';
			$message = "<html><body style='font-family:Verdana, Geneva, sans-serif; font-size: 13px;'>".
						"<p>Recuperaci&oacute;n de Contrase&ntilde;a - Sistema PHPonix</p>".
						"<table style='font-family:Verdana, Geneva, sans-serif; font-size:13px;'>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Usuario:</td><td style='background-color: #eee;'>".$username."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Correo:</td><td style='background-color: #fff;'>".$email."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #eee;'>Password:</td><td style='background-color: #eee;'>".$password."</td></tr>";
    		$message .="</table></body></html>";
			$header = "From: Sistema PHPONIX" . "\n";
  			$header .= 'MIME-Version: 1.0' . "\r\n";
    		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		 
			
			mail($para,$titulo,$message,$header);
			
			echo '<div style="text-align:center; color:#fff;">
			<img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" />
			<br>
			Su contrase&ntilde;a se ha enviado a la cuenta de correo que nos proporciono. !Gracias!<br>
			<img src="'.$page_url.$path_tema.'images/loading.gif" width="50" height="50"><br>
			Redireccionando, espere por favor.<br>
			</div>';
			$URL=$page_url.'admin/';
			recargar($seg=5,$URL,$target);
			exit();
	}
	else{
		echo '<div style="text-align:center; color:#f00;">El correo no se encuentra registrado.</div>';
	}
}
echo '
<div class="container">
	<header>
		<div><img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" /></div>
		<h2>Ingrese su cuenta de correo.</h2>
		<div class="support-note">
		<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
		</div>
	</header>
	<section class="main">
		<form name="form1" class="form-4" method="POST" action="'.$URL.'">
	    <p>
	        <input type="text" id="email" name="email" placeholder="Correo Electronico" required> 
	    </p>
	    <p>
	        <input type="submit" name="enviar" value="Enviar">
	    </p>       
		</form>
			<div style="text-align:center;">
				<a href="'.$page_url.'admin/" class="alogin">Regresar</a>
			</div>
	</section>
</div>';
close_page();
?>
