<?php
include 'scfg.php';
//COMPROBACION DE CONEXION AL SERVIDOR
$mysqli = new mysqli($db_host, $db_user, $db_user);
if(!$mysqli){
  echo '<div style="color:fff;background:#f00;padding:2px;position:absolute;z-index:100;width:100%;font-weight:bold;font-family:arial;font-size:12px;text-align:center;">500 Internal Server Error: No se ha conectado al servidor MySQL. Posiblemente la p&aacute;gina no funcione correctamente.</div>';
  include '500.html';//500 Internal Server Error
  exit();
}else{$select_db=@mysqli_select_db($mysqli,DB_DB);
  if(!$select_db){
	echo '<div style="color:fff;background:#f00;padding:2px;position:absolute;z-index:100;width:100%;font-weight:bold;font-family:arial;font-size:12px;text-align:center;">500 Internal Server Error: No se pudo establecer conexion con la base de datos. Posiblemente la p&aacute;gina no funcione correctamente.</div>';
	include '500.html';//500 Internal Server Error
	exit();
  }
  $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_base);
}
include 'lib.php';
?>