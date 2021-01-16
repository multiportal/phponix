<?php 
include 'functions1.php';
$servidor_temp='../../';
$opc=$_GET['opc'];

switch(true){
	case($opc=='paso1'):
	$form='
	<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?opc=paso2">
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
            	<input type="text" class="form-control" id="usuario" name="usuario" value="root" placeholder="root">
        	</div>
		</div>
		<div class="col-lg-12">
    		<div class="form-group">
        		<label for="pass">Password:</label>
            	<input type="password" class="form-control" id="pass" name="pass" value="" placeholder="password">
        	</div>
		</div>
		<div id="div_local">
			<a href="javascript:add_server_local(1);"><i class="fa fa-plus-circle"></i> Agregar Servidor Local</a>
		</div>
		<div class="col-lg-12" class="text-center">
			<input type="submit" id="enviar" name="enviar" class="btn btn-default" value="Aceptar">
		</div>
	</div>  
	</form>	
	';
	break;
	case($opc=='paso2'):
$db_server = $_POST['servidor'];    
$db_username = $_POST['usuario'];       
$db_password = $_POST['pass'];     	 
$db_database = $_POST['database'];
//$db_database2 = $_POST['database2'];
//$prefijo = $_POST['prefijo'];
$path_f='../';
/*CREAR ARCHIVO SCFG.PHP*/
file_scfg($db_server,$db_username,$db_password,$db_database,$db_database2,$prefijo,$path_f,$aviso2,$val);
/*COMPROBAR CONEXION*/
if($val==1){
	include '../scfg.php';
}

$link = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if($link){
		$db=mysql_list_dbs(); // obtenemos una lista de las bases de datos del servidor
		$num_db=mysql_num_rows($db); //vemos cuantas BD hay
		$select_db='Seleccione: <select name="database"><option selected value="">-- Base de datos --</option>';
		for($m=0;$m<$num_db;$m++){
				$nombre_bd = mysql_dbname($db,$m); 
				$select_db.= '<option value="'.$nombre_bd.'">'.$nombre_bd.'</option>';
		}
		$select_db.='</select>';

		if(mysql_select_db(DB_DB,$link)){
			$aviso='<div class="alert alert-success" role="alert">Correcto: Se ha conectado correctamente al servidor y seleccionado la base de datos.</div>';
		}else{
			$aviso='<div class="alert alert-success" role="alert">Correcto: Se ha conectado correctamente al servidor.</div>
			<div class="alert alert-warning" role="alert">Precauci&oacute;n: No se ha seleccionado la base de datos.</div> 
			<div class="alert alert-info" role="alert">Info: Para corregir el problema cree la base de datos o seleccione alguna.</div>';
			$form='
			<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?opc=paso3">
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
					<input type="submit" id="enviar" name="enviar" class="btn btn-default" value="Aceptar">
				</div>
			</div>
			</form>';
		}
	}else{
		$aviso='<div class="alert alert-danger" role="alert">Error: Hubo un problema al hacer sus configuraciones intentelo nuevamente. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></div>';
		//$form='<div class="alert alert-danger" role="alert">No se ha conectado al servidor. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></div>';
	}
	break;
	case($opc=='paso3'):
$db_server = $_POST['servidor'];    
$db_username = $_POST['usuario'];       
$db_password = $_POST['pass'];     	 
$db_database = $_POST['database'];
$db_database2 = $_POST['database2'];
$prefijo = $_POST['prefijo'];
$path_f='../';
/*CREAR ARCHIVO SCFG.PHP*/
file_scfg($db_server,$db_username,$db_password,$db_database,$db_database2,$prefijo,$path_f,$aviso2,$val);

/*COMPROBAR CONEXION*/
if($val==1){
	include '../scfg.php';
}

$link = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

/*CREAR BASE DE DATOS*/
	if(isset($db_database2)){
		$sql_db='CREATE DATABASE '.$db_database2.' CHARACTER SET latin1 COLLATE latin1_swedish_ci';
		$crear_db=mysql_query($sql_db,$link);
		$aviso1=(!$crear_db==1)?'<div class="alert alert-danger" role="alert">No sea creado la base de datos.</div>':'<div class="alert alert-success" role="alert">Se ha creado la base de datos: <b>'.$basedatos.' ('.$crear_db.')</b></div>';
	}
	
/*COMPROBAR LINK*/
	if($link){
		if(mysql_select_db(DB_DB,$link)){
			$aviso='<div class="alert alert-success" role="alert">Correcto: Se ha conectado correctamente al servidor y seleccionado la base de datos.</div>';
			$mysqli=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
			$DBprefix=$prefijo;
		}else{
			$aviso='<div class="alert alert-success" role="alert">Correcto: Se ha conectado correctamente al servidor.</div>
			<div class="alert alert-warning" role="alert">Precauci&oacute;n: No se ha seleccionado la base de datos.</div> 
			<div class="alert alert-info" role="alert">Info: Para corregir el problema cree la base de datos o seleccione alguna.</div>';
		}
	}else{
		$aviso='<div class="alert alert-danger" role="alert">Error: Hubo un problema al hacer sus configuraciones intentelo nuevamente. <a class="alert-link" href="javascript:history.go(-1);">Regresar</a></div>';
	}

crear_tablas_registros($crear_tablas);
if(!$crear_tablas==1){
	$aviso1='<div class="alert alert-danger" role="alert">Error: No se ha creado ninguna tabla.</div>';
	$form='<a class="alert-link" href="javascript:history.go(-1);">Regresar</a>';	
}
else{
	include '../conexion.php';
	$aviso1='<div class="alert alert-success" role="alert">Correcto: Se han creado la tablas.</div>';
	$form='
	<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?opc=paso4">
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
			<input type="submit" id="enviar" name="enviar" class="btn btn-default" value="Aceptar">
		</div>
	</div>  
	</form>	
	<div>
	<a class="alert-link" href="javascript:history.go(-1);">Regresar</a> | <a href="index.php?opc=paso4">Crear Librerias</a>
	</div>';
}

	$aviso=$aviso.$aviso1.$aviso2;
	break;
	case($opc=='paso4'):
	include '../conexion.php';
	$dominio=$_POST['dominio'];
	$path_root=$_POST['path_r'];
	$page_name=$_POST['namep'];
	$page_url=$dominio.$path_root.'/';
	
	$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."config SET dominio='{$dominio}/', path_root='{$path_root}', page_url='{$page_url}', page_name='{$page_name}', title='{$page_name}' WHERE ID=1;") or print mysqli_error($mysqli);
	
	$form='<div style="text-align:center;">
	Usuario: admin<br>
	Password: 123456<br>
	<a href="'.$page_url.'admin">Iniciar</a>
	</div>';
	
	break;
	default:
	$form='<div style="text-align:center;">
	<H1>&iexcl;BIENVENIDO!</H1>
	<H4>Para iniciar la instalaci&oacute;n de PHPONIX de click en el boton \'Comenzar\'.</H4>
	<form name="form1" method="POST" action="'.$_SERVER['PHP_SELF'].'?opc=paso1">
		<div class="col-lg-12" class="text-center" style="text-align:center; margin:50px auto;">
			<input type="submit" id="enviar" name="enviar" class="btn btn-default" value="Comenzar Instalaci&oacute;n">
		</div>
	</form>
	</div>';
	break;	
}
?>
<html>
<head>
<title>Instalador - PHPONIX</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $servidor_temp;?>favicon.ico">
<!--link rel="stylesheet" type="text/css" href="../../assets/css/style.css" /-->
<link rel="stylesheet" type="text/css" href="../../assets/bootstrap/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $servidor_temp;?>assets/css/font-awesome-4.7.0/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $servidor_temp;?>temas/default/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $servidor_temp;?>admin/install/install.css" />
<script>
function add_select_text(val){
	if(val==1){	
		document.getElementById('div_combo').innerHTML='<input type="text" class="form-control" id="database2" name="database2" value=""><div><a href="javascript:add_select_text(0);">Cancelar</a></div>';
	}
	else{
		document.getElementById('div_combo').innerHTML='<?php echo $select_db;?> <a href="javascript:add_select_text(1);"><i class="fa fa-plus-circle"></i> Agregar Base de Datos</a>';
	}
}

function add_server_local(val){
	if(val==1){	
		document.getElementById('div_local').innerHTML='<a href="javascript:add_server_local(0);">x Cancelar</a><div class="col-lg-12"><div class="form-group"><label for="usuario">Nombre de Usuario:</label><input type="text" class="form-control" id="usuario_local" name="usuario_local" value="root" placeholder="root"></div></div><div class="col-lg-12"><div class="form-group"><label for="pass">Password:</label><input type="password" class="form-control" id="pass_local" name="pass_local" value="" placeholder="password"></div></div>';
	}
	else{
		document.getElementById('div_local').innerHTML='<a href="javascript:add_server_local(1);"><i class="fa fa-plus-circle"></i> Agregar Servidor Local</a>';
	}
}
</script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="text-center"><span><img class="img-responsive" src="<?php echo $servidor_temp;?>temas/default/images/logo.min.png"></span> </div>
    	<div class="tit-install">Instalador - Pasos de Configuraci&oacute;n.</div>
<!--CONTENIDO-->
<div class="col-lg-12">
	<div class="col-lg-3">
    	<div class="list-group-item">
        	<ul class="list-unstyled">
            	<li><a title="paso0" href="index.php"<?php echo $active=($opc=='')?' class="active"':'';?>><i class="fa fa-home"></i> Inicio</a></li>
        		<li><a title="paso1" href="#"<?php echo $active=($opc=='paso1')?' class="active"':'';?>><i class="fa fa-sitemap"></i> Configuraci&oacute;n del Servidor</a></li>
        		<li><a title="paso2" href="#"<?php echo $active=($opc=='paso2')?' class="active"':'';?>><i class="fa fa-database"></i> Base de Datos</a></li>
        		<li><a title="paso3" href="#"<?php echo $active=($opc=='paso3')?' class="active"':'';?>><i class="fa fa-terminal"></i> Conexion - TablasDB</a></li>
        		<li><a title="paso4" href="#"<?php echo $active=($opc=='paso4')?' class="active"':'';?>><i class="fa fa-book"></i> Librerias</a></li>
        	</ul>
            <hr>
            <?php echo $aviso;?>
        </div>
	</div>
	<div class="col-lg-9">
		<div class="list-group-item content-step">
			<?php echo $form;?>
		</div>  
	</div>
</div>
<!--/CONTENIDO-->
	</div>
</div>
</body>
</html>