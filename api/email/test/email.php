<?php
$para    = 'memojl08@gmail.com';
//$BCC     = 'multiportal@outlook.com';
$email   = 'multiportal@outlook.com';
$title   = 'Contacto Web';
$headers = 'From: ' . $email . "\r\n";
//$headers .= ($BCC)?'Bcc: ' . $BCC . "\r\n":'';
$headers .= 'Reply-To: ' . $email . "\r\n" .
  'MIME-Version: 1.0' . "\r\n" .
  'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//'X-Mailer: PHP/' . phpversion();
$message = 'MENSAJE  DE PRUEBA';
//SEND
$success = @mail($para, $title, $message, $headers);
// Condicional
echo $send = ($success)?'ok':'fail';