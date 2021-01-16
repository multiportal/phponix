<?php 
include 'functions.php';

$servidor_temp='../../';

if(isset($_GET['paso'])){$opc=$_GET['paso'];}else{$opc='';}

$form='';
$form1='';
$form2='';
$form3='';
$form4='';
$aviso_2='';
$aviso_3='';
$aviso_4='';

switch(true){
	case($opc==1):
	$class1='selected';$isdone1='1';
	$class2='disabled';$isdone2='0';
	$class3='disabled';$isdone3='0';
	$class4='disabled';$isdone4='0';
	$form1='
	<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?paso=2">
	<div class="col-lg-10 col-xs-12">
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="servidor">Nombre del Servidor:</label>
            	<input type="text" class="form-control" id="servidor" name="servidor" value="localhost" placeholder="localhost">
        	</div>
		</div>
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="usuario">Nombre de Usuario:</label>
            	<input type="text" class="form-control" id="usuario" name="usuario" value="" placeholder="Nombre de usuario">
        	</div>
		</div>
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="pass">Password:</label>
            	<input type="password" class="form-control" id="pass" name="pass" value="" placeholder="password">
        	</div>
		</div>
		<!--div id="div_local">
			<a href="javascript:add_server_local(1);"><i class="fa fa-plus-circle"></i> Agregar Servidor Local</a>
		</div-->
		<div class="col-lg-12" class="text-center">
			<a class="buttonPrevious btn btn-primary" href="javascript:history.go(-1);">Anterior</a>
			<input type="submit" id="enviar" name="enviar" class="buttonNext btn btn-success" value="Siguiente">
		</div>
	</div>  
	</form>	
	';
	break;
	case($opc==2):
	$class1='done';$isdone1='1';
	$class2='selected';$isdone2='1';
	$class3='disabled';$isdone3='0';
	$class4='disabled';$isdone4='0';
	$aviso_1='';
	$form1='';
	
$db_server = $_POST['servidor'];    
$db_username = $_POST['usuario'];       
$db_password = $_POST['pass'];     	 
$db_database = (isset($_POST['database']))?$_POST['database']:'';
//$prefijo = $_POST['prefijo'];
$path_f='../';
/*CREAR ARCHIVO SCFG.PHP*/
$prefijo='';
file_scfg($db_server,$db_username,$db_password,$db_database,$prefijo,$path_f,$aviso2,$val);
/*COMPROBAR CONEXION*/
if($val==1){include '../scfg.php';}
	$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	
	if($link){
		$sql=mysqli_query($link,"SHOW DATABASES");//$db=mysql_list_dbs(); // obtenemos una lista de las bases de datos del servidor
		$num_db=mysqli_num_rows($sql); //vemos cuantas BD hay
		$select_db='Seleccione: <select name="database"><option selected value="">-- Base de datos --</option>';
		while ($fila=mysqli_fetch_assoc($sql)) {
    		$nombre_bd=$fila['Database'];
    		$select_db.='<option value="'.$nombre_bd.'">'.$nombre_bd.'</option>';
		}
		$select_db.='</select> ('.$num_db.')';

		if(mysqli_select_db($link,DB_DB)){
			$aviso_2='<li class="text-success"><i class="fa fa-check"></i> <b>Correcto:</b> Se ha conectado correctamente al servidor y seleccionado la base de datos.</li>';
		}else{
			$aviso_2='<li class="text-success"><i class="fa fa-check"></i> <b>Correcto:</b> Se ha conectado correctamente al servidor.</li>
			<li class="text-warning"><i class="fa fa-exclamation-triangle"></i> <b>Precauci&oacute;n:</b> No se ha seleccionado la base de datos. Nota: Para corregir el problema cree la base de datos o seleccione alguna.</li>';
			$form2='
			<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?paso=3">
			<div class="col-lg-8 col-xs-12">
				<input name="servidor" type="hidden" size="22" value="'.DB_HOST.'">
				<input name="usuario" type="hidden" size="22" value="'.DB_USER.'">
				<input name="pass" type="pass" size="22" value="'.DB_PASSWORD.'" style="visibility:hidden;">
				
				<div class="col-lg-12">
    				<div class="form-group">		
        				<label for="pass"><b>Ahora seleccione o agregue una base de datos.</b></label>
						<div id="div_combo">
							'.$select_db.' <a href="javascript:add_select_text(1);"><i class="fa fa-plus-circle"></i> Agregar Base de Datos</a>
						</div>
        			</div>
				</div>
				<div class="col-lg-12">
    				<div class="form-group">
        				<label for="prefijo">Prefijo para Tablas:</label>
            			<input type="text" class="form-control" id="prefijo" name="prefijo" value="php_" placeholder="php_">
        			</div>
				</div>
				<div class="col-lg-12" class="text-center">
					<a class="buttonPrevious btn btn-primary" href="javascript:history.go(-1);">Anterior</a>
					<input type="submit" id="enviar" name="enviar" class="buttonNext btn btn-success" value="Siguiente">
				</div>
			</div>
			</form>';
		}
	}else{
		$aviso_2='<li class="text-danger"><i class="fa fa-times"></i> <b>Error:</b> Hubo un problema al hacer sus configuraciones intentelo nuevamente. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></li>';
		//$form='<div class="alert alert-danger" role="alert">No se ha conectado al servidor. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></div>';
	}
	break;
	case($opc==3):
	$class1='done';$isdone1='1';
	$class2='done';$isdone2='1';
	$class3='selected';$isdone3='1';
	$class4='disabled';$isdone4='0';
	$aviso_1=$aviso_2='';
	$form1=$form2='';


$db_server = $_POST['servidor'];    
$db_username = $_POST['usuario'];       
$db_password = $_POST['pass'];     	 
$db_database = $_POST['database'];
$prefijo = $_POST['prefijo'];
$path_f='../';
/*CREAR ARCHIVO SCFG.PHP*/
file_scfg($db_server,$db_username,$db_password,$db_database,$prefijo,$path_f,$aviso2,$val);

/*COMPROBAR CONEXION*/
if($val==1){include '../scfg.php';}
$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

/*CREAR BASE DE DATOS*/
if(isset($db_database)){
	$sql_db='CREATE DATABASE '.$db_database.' CHARACTER SET latin1 COLLATE latin1_swedish_ci';
	$crear_db=mysqli_query($link,$sql_db);
	$aviso1=(!$crear_db==1)?'<li class="text-danger"><i class="fa fa-times"></i> No sea creado la base de datos.</li>':'<li class="text-success"><i class="fa fa-check"></i> Se ha creado la base de datos: <b>'.$db_database.' ('.$crear_db.')</b></li>';
}
	
/*COMPROBAR LINK*/
if($link){
	if(mysqli_select_db($link,DB_DB)){
		$aviso_3='<li class="text-success"><i class="fa fa-check"></i> <b>Correcto:</b> Se ha conectado correctamente al servidor y seleccionado la base de datos.</li>';
		$mysqli=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
		$DBprefix=$prefijo;
	}else{
		$aviso_3='<li class="text-success"><i class="fa fa-check></i> <b>Correcto:</b> Se ha conectado correctamente al servidor.</li>
		<li class="text-warning"><i class="fa fa-exclamation-triangle"></i> <b>Precauci&oacute;n:</b> No se ha seleccionado la base de datos. Nota: Para corregir el problema cree la base de datos o seleccione alguna.</li>';
	}
}else{
	$aviso_3='<li class="text-danger"><i class="fa fa-times"></i> <b>Error:</b> Hubo un problema al hacer sus configuraciones intentelo nuevamente. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></li>';
}

crear_tablas_registros($crear_tablas);
if(!$crear_tablas==1){
	$aviso1='<li class="text-danger"><i class="fa fa-times"></i> <b>Error:</b> No se ha creado ninguna tabla.</li>';
	$form3='<a class="alert-link" href="javascript:history.go(-1);">Regresar</a>';	
}
else{
	//include '../conexion.php';
	$aviso1='<li class="text-success"><i class="fa fa-check"></i> <b>Correcto:</b> Se han creado la tablas.</li>';
	$form3='
	<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?paso=4">
	<div class="col-lg-10 col-xs-12">
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="dominio">Nombre del Dominio:</label>
            	<input type="text" class="form-control" id="dominio" name="dominio" value="" placeholder="http://dominio.com">
        	</div>
		</div>
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="path_r">Carpeta Raiz:</label>
            	<input type="text" class="form-control" id="path_r" name="path_r" value="" placeholder="/carpeta">
        	</div>
		</div>
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="namep">Nombre de la Pagina</label>
            	<input type="text" class="form-control" id="namep" name="namep" value="" placeholder="">
        	</div>
		</div>
		<div class="col-lg-12" class="text-center">
			<a class="buttonPrevious btn btn-primary" href="javascript:history.go(-1);">Anterior</a>
			<input type="submit" id="enviar" name="enviar" class="buttonNext btn btn-success" value="Siguiente">
		</div>
	</div>  
	</form>	
	<div>
	</div>';
}
$aviso_3=$aviso_3.$aviso1.$aviso2;

	break;
	case($opc==4):
	$class1='done';$isdone1='1';
	$class2='done';$isdone2='1';
	$class3='done';$isdone3='1';
	$class4='selected';$isdone4='1';
	$aviso1=$aviso_2=$aviso_3='';
	$form1=$form2=$form3='';	
	
	include '../conexion.php';
	$dominio=$_POST['dominio'];
	$path_root=$_POST['path_r'];
	$page_name=$_POST['namep'];
	$page_url=$dominio.$path_root.'/';
	
	$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."config SET dominio='{$dominio}/', path_root='{$path_root}', page_url='{$page_url}', page_name='{$page_name}', title='{$page_name}' WHERE ID=1;") or print mysqli_error($mysqli);
	$form4='<div class="alert alert-success text-center" role="alert">
		Usuario: admin<br>
		Password: 123456<br>
		<a href="'.$page_url.'admin" class="btn btn-default">Iniciar</a>
	</div>';
	
	break;
	default:
	$class1='disabled';$isdone1='0';
	$class2='disabled';$isdone2='0';
	$class3='disabled';$isdone3='0';
	$class4='disabled';$isdone4='0';

	$form='<div style="text-align:center;">
	<H1>&iexcl;BIENVENIDO!</H1>
	<H4>Para iniciar la instalaci&oacute;n de PHPONIX de click en el boton \'Comenzar\'.</H4>
		<div class="col-lg-12" class="text-center" style="text-align:center; margin:50px auto;">
			<a href="index.php?paso=1" class="btn btn-default">Comenzar Instalaci&oacute;n</a>
		</div>	
	</div>';
	break;	
}
?>