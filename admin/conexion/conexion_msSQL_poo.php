<?php
//include 'scfg.php';
//COMPROBACION DE CONEXION AL SERVIDOR SQL
$server = 'leqro.fortiddns.com, 50638';
$database = 'SAENEO5BAK';//$database = 'NEOCOM';
$username = 'sa';
$password = 'neocom2013*';

$SQL = new PDO('odbc:Driver={SQL Server}; Server=' . $server . '; Database=' . $database . '; Uid=' . $username . '; Pwd=' . $password . ';');
if(!$SQL){
  echo '<div style="color:fff;background:#f00;padding:2px;position:absolute;z-index:100;width:100%;font-weight:bold;font-family:arial;font-size:12px;text-align:center;">500 Internal Server Error: No se ha conectado al servidor MySQL. Posiblemente la p&aacute;gina no funcione correctamente.</div>';
  //include '500.html';//500 Internal Server Error
  exit();
}
include 'lib.php';
?>