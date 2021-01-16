<?php
include '../../admin/conexion.php';
switch(true){
	case ($mode=='page' || $mode=='landingpage'): 
		$URL_log=$page_url.'index.php';
	break;
	default://$mode=='intranet'
		$URL_log=$page_url.'admin/';
	break;
}
$ultimologin=date("Y-m-d H:i:s");
mysqli_query($mysqli,"UPDATE ".$DBprefix."signup SET lastlogin='".$ultimologin."' WHERE ID='".$_GET["id"]."';") or print mysqli_error($mysqli);
$log_usuarios='usuarios/login.php';

$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE ID='".$_GET['id']."';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){$ID_login=$row["ID"];$username=$row["username"];}
$mod='Logout';
log_visitas($username);

session_start();
session_unset();
session_destroy();
open_page();
recargar($seg=3,$URL_log,'');
echo '<div style="text-align:center;">
<img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" />
<br>
La sesion ha sido cerrada<br>
<img src="'.$page_url.$path_tema.'images/loading.gif" width="50" height="50"><br>
Redireccionando, espere por favor.<br>
</div>';
close_page();
?>