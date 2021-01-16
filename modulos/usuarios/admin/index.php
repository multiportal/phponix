<?php 
if(isset($_SESSION["username"]) && ($_SESSION["level"]==-1 || $_SESSION["level"]==1)){
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $nombre_mod;?>
        <small><?php echo $description_mod;?></small>
      </h1>
	  <?php menu_rutas();?>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
 		<?php //panel_menu();?>
	</div>
    <!-- /.row-->

<?php 
switch(true){
	case($action=='add'):
if($_POST['Guardar']){
	$username_u=$_POST["username"];
	$password_u=$_POST["password"];
	// Encriptamos "Ciframos" el password
	$pass1=sha1(md5($password_u));
    $email_u=$_POST["email"];
    $nivel_u=$_POST["level"];
    $lastlogin_u=$_POST["lastlogin"];         
	$tema_u=$_POST["tema"];
	$nombre_u=$_POST["nombre"];
	$apaterno_u=$_POST["apaterno"];
    $amaterno_u=$_POST["amaterno"];
	$foto_u=$_POST["foto"];
	$cover_u=$_POST["cover"];		 
	$tel_u=$_POST["tel"];
	$ext_u=$_POST["ext"];
	$fnac_u=$_POST["fnac"];
	$fb_u=$_POST["fb"];
	$tw_u=$_POST["tw"];
	$puesto_u=$_POST["puesto"];
	$ndepa_u=$_POST["ndepa"];
	$depa_u=$_POST["depa"];
	//$departamento_u=$_POST["departamento"];
	$empresa_u=$_POST["empresa"];
	$adress_u=$_POST["adress"];
	$direccion_u=$_POST["direccion"];
	$mpio_u=$_POST["mpio"];
	$edo_u=$_POST["edo"];
	$genero_u=$_POST["genero"];
	$exp_u=$_POST["exp"];
	$likes_u=$_POST["likes"];
	$filtro_u=$_POST["filtro"];
	$zona_u=$_POST["zona"];
	$alta_u=$_POST["alta"];
	$actualizacion_u=$_POST["actualizacion"];
	$page_u=$_POST["page"];
	$nivel_oper_u=$_POST["nivel_oper"];
	$rol_u=$_POST["rol"];
	$activo_u=$_POST["activo"];

	if($username_u == '' && $activo == ''){
		$error = "  *Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (username,password,email,level,lastlogin,tema,nombre,apaterno,amaterno,foto,cover,tel,ext,fnac,fb,tw,puesto,ndepa,depa,empresa,adress,direccion,mpio,edo,genero,exp,likes,filtro,zona,alta,actualizacion,page,nivel_oper,rol,activo) VALUES ('{$username_u}','{$pass1}','{$email_u}','{$nivel_u}','{$lastlogin_u}','{$tema_u}','{$nombre_u}','{$apaterno_u}','{$amaterno_u}','{$foto_u}','{$cover_u}','{$tel_u}','{$ext_u}','{$fnac_u}','{$fb_u}','{$tw_u}','{$puesto_u}','{$ndepa_u}','{$depa_u}','{$empresa_u}','{$adress_u}','{$direccion_u}','{$mpio_u}','{$edo_u}','{$genero_u}','{$exp_u}','{$likes_u}','{$filtro_u}','{$zona_u}','{$alta_u}','".$username_u."2019x".$password_u."','{$page_u}','{$nivel_oper_u}','{$rol_u}','{$activo_u}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El usuario se ha guardo correctamente','No se puedo guardar intentenlo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);	
	}
}

$file='<input type="hidden" class="form-control" id="foto" name="foto" value="'.$foto_u.'">
<a href="javascript:up(1);">Subir Foto</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="foto" name="foto" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}
?>
<div class="row">
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Foto</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $username_u;?>">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $password_u;?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $email_u;?>">
                </div>
                <div class="form-group">
                  <label for="level">Nivel</label>
                  <input type="text" class="form-control" id="level" name="level" value="<?php echo $nivel_u;?>">
                </div>
                <div class="form-group">
                  <label for="lastlogin">Ultimo Acceso</label>
                  <input type="text" class="form-control" id="lastlogin" name="lastlogin" value="<?php echo $lastlogin_u;?>">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_u;?>">
                </div>
                <div class="form-group">
                  <label for="apaterno">Apellido Paterno</label>
                  <input type="text" class="form-control" id="apaterno" name="apaterno" value="<?php echo $apaterno_u;?>">
                </div>
                <div class="form-group">
                  <label for="amaterno">Apellido Materno</label>
                  <input type="text" class="form-control" id="amaterno" name="amaterno" value="<?php echo $amaterno_u;?>">
                </div>
                <div class="form-group">
                  <label for="fnac">Fecha Nacimiento</label>
                  <input type="text" class="form-control" id="fnac" name="fnac" value="<?php echo $fnac_u;?>">
                </div>
                <div class="form-group">
                  <label for="genero">Genero</label>
                  <select class="form-control" id="genero" name="genero">
                    <option value="M" <?php echo $gen=($genero_u==0) ? 'selected' : '';?>>Masculino</option>
                    <option value="F" <?php echo $gen=($genero_u==1) ? 'selected' : '';?>>Femenino</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tema">Tema Personal</label>
                  <input type="text" class="form-control" id="tema" name="tema" value="<?php echo $tema_u;?>">
                </div>
                <div class="form-group">
                  <label for="puesto">Puesto</label>
                  <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo $puesto_u;?>">
                </div>
                <div class="form-group">
                  <label for="depa">Departamento</label>
                  <input type="text" class="form-control" id="depa" name="depa" value="<?php echo $depa_u;?>">
                </div>
                <div class="form-group">
                  <label for="empresa">Empresa</label>
                  <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $empresa_u;?>">
                </div>
                <div class="form-group">
                  <label for="direccion">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion_u;?>">
                </div>
                <div class="form-group">
                  <label for="mpio">Municipio</label>
                  <input type="text" class="form-control" id="mpio" name="mpio" value="<?php echo $mpio_u;?>">
                </div>
                <div class="form-group">
                  <label for="edo">Estado</label>
                  <input type="text" class="form-control" id="edo" name="edo" value="<?php echo $edo_u;?>">
                </div>
                <div class="form-group">
                  <label for="alta">Alta</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $alta_u;?>">
                </div>
                <div class="form-group">
                  <label for="tel">Telefono</label>
                  <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel_u;?>">
                </div>
                <div class="form-group">
                  <label for="ext">Ext.</label>
                  <input type="text" class="form-control" id="ext" name="ext" value="<?php echo $ext_u;?>">
                </div>
                <div class="form-group">
                  <label for="fb">Facebook</label>
                  <input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb_u;?>">
                </div>
                <div class="form-group">
                  <label for="tw">Twitter</label>
                  <input type="text" class="form-control" id="tw" name="tw" value="<?php echo $tw_u;?>">
                </div>
				<div class="form-group">
                  <label>Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $seleccion=($activo_u==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($activo_u==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" name="Guardar" class="btn btn-primary" value="Guardar"> 
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </div>
	<!-- /.col-->
</div>
<!-- /.row -->
<?php
	break;
	case($action=='edit' && !empty($_GET['id'])):

$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	//$ID_u=$row["ID"];
	$username_u=$row["username"];
	$password_u=$row["password"];
    $email_u=$row["email"];
    $nivel_u=$row["level"];
    $lastlogin_u=$row["lastlogin"];         
	$tema_u=$row["tema"];
	$nombre_u=$row["nombre"];
	$apaterno_u=$row["apaterno"];
    $amaterno_u=$row["amaterno"];
	$foto_u=$row["foto"];
	$cover_u=$row["cover"];		 
	$tel_u=$row["tel"];
	$ext_u=$row["ext"];
	$fnac_u=$row["fnac"];
	$fb_u=$row["fb"];
	$tw_u=$row["tw"];
	$puesto_u=$row["puesto"];
	$ndepa_u=$row["ndepa"];
	$depa_u=$row["depa"];
	//$departamento_u=$row["departamento"];
	$empresa_u=$row["empresa"];
	$adress_u=$row["adress"];
	$direccion_u=$row["direccion"];
	$mpio_u=$row["mpio"];
	$edo_u=$row["edo"];
	$genero_u=$row["genero"];
	$exp_u=$row["exp"];
	$likes_u=$row["likes"];
	$filtro_u=$row["filtro"];
	$zona_u=$row["zona"];
	$alta_u=$row["alta"];
	$actualizacion_u=$row["actualizacion"];
	$page_u=$row["page"];
	$nivel_oper_u=$row["nivel_oper"];
	$rol_u=$row["rol"];
	$activo_u=$row["activo"];

	$num_u = strlen($username_u);
	$n=$num_u+5;
	$pass = substr($actualizacion_u,$n);
}

if($_POST['Guardar']){
	$ID_u=$_POST["ID"];
	$username_u=$_POST["username"];
	$password_u=$_POST["password"];
	// Encriptamos "Ciframos" el password
	$pass1=sha1(md5($password_u));
    $email_u=$_POST["email"];
    $nivel_u=$_POST["level"];
    $lastlogin_u=$_POST["lastlogin"];         
	$tema_u=$_POST["tema"];
	$nombre_u=$_POST["nombre"];
	$apaterno_u=$_POST["apaterno"];
    $amaterno_u=$_POST["amaterno"];
	$foto_u=$_POST["foto"];
	$cover_u=$_POST["cover"];		 
	$tel_u=$_POST["tel"];
	$ext_u=$_POST["ext"];
	$fnac_u=$_POST["fnac"];
	$fb_u=$_POST["fb"];
	$tw_u=$_POST["tw"];
	$puesto_u=$_POST["puesto"];
	$ndepa_u=$_POST["ndepa"];
	$depa_u=$_POST["depa"];
	//$departamento_u=$_POST["departamento"];
	$empresa_u=$_POST["empresa"];
	$adress_u=$_POST["adress"];
	$direccion_u=$_POST["direccion"];
	$mpio_u=$_POST["mpio"];
	$edo_u=$_POST["edo"];
	$genero_u=$_POST["genero"];
	$exp_u=$_POST["exp"];
	$likes_u=$_POST["likes"];
	$filtro_u=$_POST["filtro"];
	$zona_u=$_POST["zona"];
	$alta_u=$_POST["alta"];
	$actualizacion_u=$_POST["actualizacion"];
	$page_u=$_POST["page"];
	$nivel_oper_u=$_POST["nivel_oper"];
	$rol_u=$_POST["rol"];
	$activo_u=$_POST["activo"];

	if($username_u == '' && $activo == ''){
		$error = "  *Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."signup SET username='{$username_u}',password='{$pass1}',email='$email_u',level='{$nivel_u}',lastlogin='{$lastlogin_u}',tema='{$tema_u}',nombre='{$nombre_u}',apaterno='{$apaterno_u}',amaterno='{$amaterno_u}',foto='{$foto_u}',cover='{$cover}',tel='{$tel_u}',ext='{$ext_u}',fnac='{$fnac_u}',fb='{$fb_u}',tw='{$tw_u}',puesto='{$puesto_u}',ndepa='{$ndepa_u}',depa='{$depa_u}',empresa='{$empresa_u}',	adress='{$adress_u}',direccion='{$direccion_u}',mpio='{$mpio_u}',edo='{$edo_u}',genero='{$genero_u}',exp='{$exp_u}',likes='{$likes_u}',filtro='{$filtro_u}',zona='{$zona_u}',alta='{$alta_u}',actualizacion='".$username_u."2019x".$password_u."',page='{$page_u}',nivel_oper='{$nivel_oper_u}',rol='{$rol_u}',activo='{$activo_u}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'El usuario se ha guardo correctamente','No se puedo guardar intentenlo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);	
	}
}

$file='<input type="hidden" class="form-control" id="foto" name="foto" value="'.$foto_u.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$foto_u.'" style="width:150px;">
<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="foto" name="foto" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}
?>
<div class="row">
	<div class="col-md-6">
<?php //if(($username=='admin' && $nivel_login==-1 && $id==1) || ($username!='admin' && $nivel_logon>=-1 && $id!=1)){?>    
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Foto</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $username_u;?>">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $pass;?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $email_u;?>">
                </div>
                <div class="form-group">
                  <label for="level">Nivel</label>
                  <input type="text" class="form-control" id="level" name="level" value="<?php echo $nivel_u;?>">
                </div>
                <div class="form-group">
                  <label for="lastlogin">Ultimo Acceso</label>
                  <input type="text" class="form-control" id="lastlogin" name="lastlogin" value="<?php echo $lastlogin_u;?>">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_u;?>">
                </div>
                <div class="form-group">
                  <label for="apaterno">Apellido Paterno</label>
                  <input type="text" class="form-control" id="apaterno" name="apaterno" value="<?php echo $apaterno_u;?>">
                </div>
                <div class="form-group">
                  <label for="amaterno">Apellido Materno</label>
                  <input type="text" class="form-control" id="amaterno" name="amaterno" value="<?php echo $amaterno_u;?>">
                </div>
                <div class="form-group">
                  <label for="fnac">Fecha Nacimiento</label>
                  <input type="text" class="form-control" id="fnac" name="fnac" value="<?php echo $fnac_u;?>">
                </div>
                <div class="form-group">
                  <label for="genero">Genero</label>
                  <select class="form-control" id="genero" name="genero">
                    <option value="M" <?php echo $gen=($genero_u==0) ? 'selected' : '';?>>Masculino</option>
                    <option value="F" <?php echo $gen=($genero_u==1) ? 'selected' : '';?>>Femenino</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tema">Tema Personal</label>
                  <input type="text" class="form-control" id="tema" name="tema" value="<?php echo $tema_u;?>">
                </div>
                <div class="form-group">
                  <label for="puesto">Puesto</label>
                  <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo $puesto_u;?>">
                </div>
                <div class="form-group">
                  <label for="depa">Departamento</label>
                  <input type="text" class="form-control" id="depa" name="depa" value="<?php echo $depa_u;?>">
                </div>
                <div class="form-group">
                  <label for="empresa">Empresa</label>
                  <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $empresa_u;?>">
                </div>
                <div class="form-group">
                  <label for="direccion">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion_u;?>">
                </div>
                <div class="form-group">
                  <label for="mpio">Municipio</label>
                  <input type="text" class="form-control" id="mpio" name="mpio" value="<?php echo $mpio_u;?>">
                </div>
                <div class="form-group">
                  <label for="edo">Estado</label>
                  <input type="text" class="form-control" id="edo" name="edo" value="<?php echo $edo_u;?>">
                </div>
                <div class="form-group">
                  <label for="alta">Alta</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $alta_u;?>">
                </div>
                <div class="form-group">
                  <label for="tel">Telefono</label>
                  <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel_u;?>">
                </div>
                <div class="form-group">
                  <label for="ext">Ext.</label>
                  <input type="text" class="form-control" id="ext" name="ext" value="<?php echo $ext_u;?>">
                </div>
                <div class="form-group">
                  <label for="fb">Facebook</label>
                  <input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb_u;?>">
                </div>
                <div class="form-group">
                  <label for="tw">Twitter</label>
                  <input type="text" class="form-control" id="tw" name="tw" value="<?php echo $tw_u;?>">
                </div>
				<div class="form-group">
                  <label>Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $seleccion=($activo_u==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($activo_u==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" name="Guardar" class="btn btn-primary" value="Guardar"> 
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
<?php //}else{echo $username.'|'.$nivel_login.'|'.$id;} ?>
    </div>
	<!-- /.col-->
</div>
<!-- /.row -->

<?php	
	break;
	default://modulos
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este Usuario "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."signup WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  

<div class="row">
<div class="col-xs-12">

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla Usuarios</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Email</th>
                  <th>Nivel</th>
                  <th>Ultima Sesion</th>
                  <th>Puesto</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$cond=($username!='admin')?"WHERE username!='admin '":'';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup {$cond}ORDER BY ID;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){
$id=$row['ID'];
$username_u=$row["username"];
$password_u=$row["password"];
$email_u=$row["email"];
$nivel_u=$row["level"];
$lastlogin_u=$row["lastlogin"];         
$puesto_u=$row["puesto"];
$activo_u=$row["activo"];

echo '
	<tr>
    	<td>'.$id.'</td>
        <td>'.$username_u.'</td>';
if($username!='demo'){echo '<td>'.$password_u.'</td>';}else{echo '<td></td>';}
echo '		
		<td>'.$email_u.'</td>
		<td>'.$nivel_u.'</td>
		<td>'.$lastlogin_u.'</td>
		<td>'.$puesto_u.'</td>
		<td>'.$activo_u.'</td>
		<td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
	</tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Email</th>
                  <th>Nivel</th>
                  <th>Ultima Sesion</th>
                  <th>Puesto</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

</div>
<!-- /.col-xs-12 -->
</div>
<!-- /.row-->
<?php
	break;//modulos
}
?>
    </section>
    <!-- /.content -->
 
<?php
	//}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>