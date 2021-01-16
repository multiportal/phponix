<?php 
include './install/admin/functions.php';
buscar_archivo1('scfg.php',$val);
if($val!=1){header ('Location: install/');}else{include ('./conexion.php');}
if(isset($BLOCK)&&$BLOCK==0){header('Location: '.$page_url);}
sesion($form_login);
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."comp WHERE ID=1;") or print mysqli_error($mysqli); 
if($rowp=mysqli_fetch_array($sql)){$log_usuarios=$rowp['page'];}
$U=(isset($_POST['username']))?$_POST['username']:'';
$P=(isset($_POST['password']))?$_POST['password']:'';
$sal=(isset($_POST['salir']))?$_POST['salir']:'';
$log=(isset($_POST['login']))?$_POST['login']:'';
$ses=(isset($_POST['sesion']))?$_POST['sesion']:'';
comprobar($form_login,$log_usuarios,$sal,$ses,$log,$U,$P);
open_page_form();
include '../modulos/'.$log_usuarios;
close_page();
?>