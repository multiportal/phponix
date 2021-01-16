<?php include '../../../admin/conexion/_functions.ws.php';
$t=$_GET['t'];
$ajax=($_GET['ajax']!='' && $_GET['ajax']!=NULL)?$_GET['ajax']:0;
ws_tabla($t,$ajax);
?>
