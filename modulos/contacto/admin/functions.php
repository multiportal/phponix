<?php
function html_iso_contacto(&$nombre,&$email,&$subject,&$msj){
global $chartset;
 if($chartset=='iso-8859-1'){
 	$nombre = htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$email=htmlentities($email, ENT_COMPAT,'ISO-8859-1', true);
	$subject = htmlentities($subject, ENT_COMPAT,'ISO-8859-1', true);
	$msj = htmlentities($msj, ENT_COMPAT,'ISO-8859-1', true);	
 }
}

function html_iso_forms(&$titulo,&$des,&$tag,&$autor){
global $chartset;
 if($chartset=='iso-8859-1'){
	$titulo=htmlentities($titulo, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$tag = htmlentities($tag, ENT_COMPAT,'ISO-8859-1', true);	
	$autor=htmlentities($autor, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function t_map(&$lat,&$lng,&$zoom){
global $mysqli,$DBprefix,$page_url;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_config WHERE ID=1;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$lat=$row['lat'];
	$lng=$row['lng'];
	$zoom=$row['zoom'];
	$icono=$row['cover'];
	$on_costo=$row['on_costo'];
 }
}
?>