<?php 
/*
function pages($mod,$ext,&$contenido,&$activo){
global $mysqli,$DBprefix;
$cond=($ext!='')?"modulo='{$mod}'":"modulo='{$mod}' AND ext='{$ext}'";
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."pages WHERE ".$cond." AND activo=1;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$id_h=$row['ID'];
	$titulo=$row['titulo'];
	$contenido=$row['contenido'];
	$alta=$row['alta'];
	$fmod=$row['fmod'];
	$url_page=$row['url'];
	$activo=$row['activo'];
 }
}
*/
?>