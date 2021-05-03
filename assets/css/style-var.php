<?php 
$archivo=fopen('assets/css/style-var.css','w');
$contenido=$css;
fwrite($archivo, $contenido);
fclose($archivo);
if($archivo == false){
 	echo '<!--No se ha podido crear el archivo.-->';
}else{
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$page_url.'assets/css/style-var.css?'.$date.'" />'."\r\n";
}
?>