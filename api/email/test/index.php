<?php
//include_once '../../v2/includes/conexion.php';
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
//header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
//header('Content-Type: text/html; charset=utf-8');
//header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
$page_name = 'Arkon Data';
$para    = 'marketing@arkondata.com';
$BCC     = 'multiportal@outlook.com';
$title   = 'Contacto Web';
$empresa = ($_GET['empresa']) ? $_GET['empresa'] : null;
$email   = ($_GET['email']) ? $_GET['email'] : null;
$nombre   = ($_GET['nombre']) ? $_GET['nombre'] : null;

# Contenido del correo
$message = '
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
    .bg_gris{background-color:#F5F5F5;}
    .center{text-align:center;}
    .right{text-align:right;}
    .footer{background-color:#444;color:#fff;font-size:12px;font-weight:bold;text-align:center;padding:6px}
    </style>
    </head>
    <body>
    <div>
        <table class="fuente1" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="6" class="dominio"><img src="https://memojl.github.io/arkon-test/wp-content/themes/arkontheme/images/logo-arkon-data.png" alt="Logo" style="width:90px" /><a target="_blank" href="#">www.' . $_SERVER['HTTP_HOST'] . '</a></td>
        </tr>
        <tr>
            <td colspan="6" class="fuente1">Mensaje recibido desde la pagina web <b><a target="_blank" href="#">' . $page_name . '</a></b> a tr&aacute;ves de la secci&oacute;n <b>Contacto</b>.<br /><br /></td>
        </tr>
          <tr>
            <td colspan="6" class="fuente1 center" style="border-top:2px solid #333;"><br /></td>
        </tr>
          <tr>
            <td colspan="6" class="fuente1"></td>
        </tr>
          <tr>
            <td colspan="2" class="fuente2">Nombre:</td>
            <td colspan="4">' . $nombre . '</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Empresa:</td>
            <td colspan="4">' . $empresa . '</td>
          </tr>
          <tr>
            <td colspan="2" class="fuente2">Correo:</td>
            <td colspan="4">' . $email . '</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2"></td>
            </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" align="right"></td>
            </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="6" class="footer">Formulario de Contacto v.2.1</td>
          </tr>  
        </table>
    </div>
    </body></html>
  ';

//$message = '<p>Mensaje de prueba.</p>';

$headers = 'From: ' . $email . "\r\n";
$headers .= ($BCC)?'Bcc: ' . $BCC . "\r\n":'';
$headers .= 'Reply-To: ' . $email . "\r\n" .
  'MIME-Version: 1.0' . "\r\n" .
  'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//'X-Mailer: PHP/' . phpversion();

//SEND
$success = @mail($para, $title, $message, $headers);
// Condicional
$send = ($success)?'ok':'fail';

if($success){
  header("HTTP/1.1 200 OK");
  header('Content-Type: application/json');
  $meta = array("status" => "success", "http_code" => 200, "date_time" => date('c'), "message" => "ok");
  $resultado['status'] = "Correcto";
  $resultado['mensaje'] = "Mensaje {$send}!";
  $res['metadata'] = $meta;
  $res['status_send'] = $send; 
  $res['data'] = $resultado;
  echo json_encode($res);
} else {
  Error('ERROR: No pudimos enviar tu mensaje.');
}


//ERROR
function Error($error){
  //global $tabla;
  $msg = $error;
  $status = 'Error';
  $msg_box = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>' . $status . ':</strong> ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

  header("HTTP/1.1 200 OK");
  header('Content-Type: application/json');
  $meta = array("status" => "error", "http_code" => 200, "date_time" => date('c'), "message" => "bad");
  $resultado['status'] = $status;
  $resultado['mensaje'] = $msg;
  $resultado['html'] = $msg_box;
  /*if ($tabla == 'upload_files') {
        $resultado['name'] = '';
        $resultado['url'] = '';
    }*/
  $res['metadata'] = $meta;
  $res['data'] = $resultado;
  echo json_encode($res); //echo json_encode($resultado);
}
