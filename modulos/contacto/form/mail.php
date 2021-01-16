<?php
include '../../../admin/conexion.php';
function html_iso_contacto(&$nombre,&$subject,&$msj){
global $chartset;
 if($chartset=='iso-8859-1'){
 	$nombre = htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$subject = htmlentities($subject, ENT_COMPAT,'ISO-8859-1', true);
	$msj = htmlentities($msj, ENT_COMPAT,'ISO-8859-1', true);	
 }
}

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        # Envío de datos
		    $title = 'Contacto Web '.$page_name;
        $subject = $_POST["asunto"];
        $subject = ($subject!='')?$subject:'Contacto Web';
        $nombre = str_replace(array("\r","\n"),array(" "," ") , strip_tags($_POST["nombre"]));
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $tel = $_POST["tel"];
        $msj = $_POST["msj"];
		    html_iso_contacto($nombre,$subject,$msj);
        #Reemplazar este correo por el correo electrónico del destinatario
		    $de=$email;
		    $sec=$mod='contacto';
		    $cat_list='inbox';
		    email_forms($CoR1,$CoE1,$BCC1);
		    $para=$CoR1;

        if (empty($nombre) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($tel) OR empty($subject) OR empty($msj)) {
            # Establecer un código de respuesta y salida.
            http_response_code(400);
            echo "Por favor completa el formulario y vuelve a intentarlo.";
            exit;
        }

        # Contenido del correo
		$message='
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
    <style type="text/css">
    .fuente1,.fuente2,.fuente3{
	    font-family: Calibri, "Trebuchet MS";
	    font-size:11px;
	    color:#000;
	    text-align:left;}
    .fuente2{font-size:12px; font-weight:700;}
    .fuente3{font-size:13px; font-weight:bold;}
    .fuente1 a{
	    font-family: Calibri, "Trebuchet MS";
	    font-size:12px;
	    color:#444;/*color de link*/
	    text-decoration:none;}
    .dominio, .dominio a{font-size:22px;font-weight:bold;text-align:left;vertical-align:bottom;}
    .bg_gris{background-color:#F5F5F5;}/*Color de fondo*/
    .center{text-align:center;}
    .right{text-align:right;}
    .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}/*pie*/
    </style>
    </head>
    <body>
    <div>
        <table class="fuente1" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="6" class="dominio"><img src="'.$page_url.$path_tema.'images/'.$logo.'" alt="Logo" style="width:90px" />&nbsp;&nbsp;<a target="_blank" href="'.$page_url.'">www.'.$_SERVER['HTTP_HOST'].'</a></td>
          </tr>    
    
          <tr>
            <td colspan="6" class="fuente1">Mensaje recibido desde la p&aacute;gina web <b><a target="_blank" href="'.$page_url.'">'.$page_name.'</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br><br></td>
        </tr>
          <tr>
            <td colspan="6" class="fuente1 center" style="border-top:2px solid #333;"><br></td>
        </tr>
          <tr>
            <td colspan="6" class="fuente1">&nbsp;</td>
        </tr>
          <tr>
            <td colspan="2" class="fuente2">Nombre:</td>
            <td colspan="4">'.$nombre.'</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Correo:</td>
            <td colspan="4">'.$email.'</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Telefono:</td>
            <td colspan="4">'.$tel.'</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Asunto:</td>
            <td colspan="4">'.$subject.'</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Mensaje:</td>
            <td colspan="4">'.$msj.'</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2"></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2" align="right"></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="6" class="footer">Formulario de Contacto v.2.1</td>
          </tr>  
        </table>
    </div>
    </body></html>';

        # Encabezados de correo electrónico.
      $headers = "From: {$nombre} <$email>". "\r\n";
      if($BCC1!=''){$headers .= "Bcc: {$BCC1}\r\n";}
  		$headers .= 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";					 

        # Envía el correo.
        if($_SERVER['HTTP_HOST']!='localhost'){
          $success = @mail($para, $title, $message, $headers);
        }else{
          $success=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ip,nombre,email,para,de,tel,titulo,asunto,msj,fecha,cat_list,seccion,tabla,adjuntos,visto,status,ID_login,ID_user,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$CoE1}','{$de}','{$tel}','{$title}','{$subject}','{$message}','{$date}','{$cat_list}','{$sec}','','','0','1','1','1','1');") or print mysqli_error($mysqli);
        }
        if($success) {
          if($_SERVER['HTTP_HOST']!='localhost'){
            $save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ip,nombre,email,para,de,tel,titulo,asunto,msj,fecha,cat_list,seccion,tabla,adjuntos,visto,status,ID_login,ID_user,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$CoE1}','{$de}','{$tel}','{$title}','{$subject}','{$message}','{$date}','{$cat_list}','{$sec}','','','0','1','1','1','1');") or print mysqli_error($mysqli);
          }	        # Establece un código de respuesta 200 (correcto).
          http_response_code(200);
          echo "Gracias! Tu mensaje ha sido enviado a ".$para;			
        }else {
          # Establezce un código de respuesta 500 (error interno del servidor).
          http_response_code(500);
          echo "Error: No pudimos enviar tu mensaje.";
        }

    } else {
        # No es una solicitud POST, establezce un código de respuesta 403 (prohibido).
        http_response_code(403);
        echo "Hubo un problema con tu envío, intenta de nuevo.";
    }
?>
