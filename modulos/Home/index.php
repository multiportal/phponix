<?php
include 'admin/functions.php';
sql_opciones('slide_active',$valor);
if($valor==1){include 'media/slide/'.$tema.'.php';}
pages($mod,$ext,$contenido,$activo);
if($activo==1){
	echo $contenido;
}else{
    include $tema.'.php';
}
?>
