<?php 
ob_start();
sesion($form_login);
comprobar($form_login,$log_usuarios,$sal,$ses,$log,$U,$P);
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
//log_visitas($username);
if(!empty($username) && ($nivel_mod==-1 || $dashboard_mod==1) && $mod!='usuarios' || ($ext=='admin/index' || $ext=='miembros/index' || $ext=='perfil_sesion')){
include ($path_dashboard.'index.php');
}else if($mod=='usuarios' && $ext=='registro'){bodymodulos();}
else{include ('index.html');}
ob_end_flush();
?>