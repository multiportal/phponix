<?php
include '../../admin/conexion.php';
switch(true){
	case ($mode=='page' || $mode=='landingpage'): 
		$URL_log=$page_url.'index.php';
	break;
	default:/*$mode=='intranet'*/
		$URL_log=$page_url.'admin/';
	break;
}
$token=htmlspecialchars($_COOKIE["token"]);
mysqli_query($mysqli,"UPDATE ".$DBprefix."token SET Estado='Inactivo' WHERE Token='".$token."';") or print mysqli_error($mysqli);
setcookie("token","",time()-1,"/");
$ultimologin=date("Y-m-d H:i:s");
mysqli_query($mysqli,"UPDATE ".$DBprefix."signup SET lastlogin='".$ultimologin."' WHERE ID='".$_GET["id"]."';") or print mysqli_error($mysqli);
$log_usuarios='usuarios/login.php';
$row=query_row('signup','ID',$id);
if($row){$ID_login=$row["ID"];$username=$row["username"];}
$mod='Logout';
log_visitas($username);
session_start();
session_unset();
session_destroy();
open_page();
echo '<style>@import url('.$page_url.'assets/bootstrap/bootstrap.css);</style>';
echo '<div style="text-align:center;">
<img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" />
<br>
La sesion ha sido cerrada<br>
<img src="'.$page_url.$path_tema.'images/loading.gif" width="50" height="50"><br>
Redireccionando, espere por favor.<br>
</div>';
echo '<script>localStorage.clear();//storage.clear();</script>';
recargar($seg=3,$URL_log,'');
close_page();
?>