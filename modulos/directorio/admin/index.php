<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
	include 'functions.php';
editor_tiny_mce();
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
$cover=$_POST['cover'];
$nom=$_POST['nom'];
$url_link=$_POST['url_link'];
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$des=$_POST['des'];
$filtro=$_POST['filtro'];
$user=$_POST['user'];
$fecha=$_POST['fecha'];

	if($nom == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."directorio (cover,nom,url_link,usuario,pass,des,filtro,user,fecha) VALUES ('{$cover}','{$nom}','{$url_link}','{$usuario}','{$pass}','{$des}','{$filtro}','{$user}','{$fecha}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}

if($cover==''){$cover='nodisponible.jpg';}
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<a href="javascript:up(1);">Subir Foto</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/img';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/img/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}

js_select_text($filtro,'filtro','directorio',$ctrl_sel);
?>
<div class="row">
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Nuevo Registro</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="Covel">Cover</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>">
                </div>
                <div class="form-group">
                  <label for="pass">Password</label>
                  <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $pass;?>">
                </div>
                <div class="form-group">
                  <label for="filtro">Filtro</label>
                  <input type="text" class="form-control" id="filtro" name="filtro" value="<?php echo $filtro;?>">
                </div>
                <div class="form-group">
                  <label for="url_link">URL</label>
                  <input type="text" class="form-control" id="url_link" name="url_link" value="<?php echo $url_link;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <textarea class="form-control" id="des" name="des"><?php echo $des;?></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
             	<input type="hidden" class="form-control" id="user" name="user" value="<?php echo $username;?>">
               	<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $date;?>">

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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."directorio WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$cover=$reg['cover'];
$nom=$reg['nom'];
$url_link = $reg['url_link'];
$usuario=$reg['usuario'];
$pass=$reg['pass'];
$des=$reg['des'];
$filtro=$reg['filtro'];
$user=$reg['user'];
$fecha=$reg['fecha'];
}

if($_POST['Guardar']){
$cover=$_POST['cover'];
$nom=$_POST['nom'];
$url_link=$_POST['url_link'];
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$des=$_POST['des'];
$filtro=$_POST['filtro'];
$user=$_POST['user'];
$fecha=$_POST['fecha'];

	if($nom == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."directorio SET cover='{$cover}', nom='{$nom}', url_link='{$url_link}', usuario='{$usuario}', pass='{$pass}', des='{$des}', filtro='{$filtro}', user='{$username}', fecha='{$fecha}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}

$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/img/'.$cover.'" style="width:100px;">
<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/img';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/img/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}

js_select_text($filtro,'filtro','directorio',$ctrl_sel);
?>
<div class="row">
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Registro</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Cover</label>
				  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>">
                </div>
                <div class="form-group">
                  <label for="pass">Password</label>
                  <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $pass;?>">
                </div>
                <div class="form-group">
                  <label for="filtro">Filtro</label>
                  <?php echo $ctrl_sel;?>
                  <!--input type="text" class="form-control" id="filtro" name="filtro" value="<?php echo $filtro;?>"-->
                </div>
                <div class="form-group">
                  <label for="url_link">URL</label>
                  <input type="text" class="form-control" id="url_link" name="url_link" value="<?php echo $url_link;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <textarea class="form-control" id="des" name="des"><?php echo $des;?></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
             	<input type="hidden" class="form-control" id="user" name="user" value="<?php echo $user;?>">
               	<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>">

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
	default://modulos
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este Registro "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."directorio WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
}
?>

<div class="row">
<div class="col-xs-12">

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla Modulos</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Cover</th>
                  <th>Nombre</th>
                  <!--th>Url</th-->
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Filtro</th>
				  <th>Descripcion</th>
                  <!--th>Usuario</th-->
                  <!--th>Fecha</th-->
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."directorio ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td><img src="'.$page_url.'modulos/'.$mod.'/img/'.$reg['cover'].'" width="20"></td>
				  <td><a target="_blank" href="'.$reg['url_link'].'">'.$reg['nom'].'</a></td>
				  <!--td>'.$reg['url_link'].'</td-->
				  <td>'.$reg['usuario'].'</td>
				  <td>'.$reg['pass'].'</td>
				  <td>'.$reg['filtro'].'</td>
				  <td>'.$reg['des'].'</td>
				  <!--td>'.$reg['user'].'</td-->
				  <!--td>'.$reg['fecha'].'</td-->
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Cover</th>
                  <th>Nombre</th>
                  <!--th>Url</th-->
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Filtro</th>
				  <th>Descripcion</th>
                  <!--th>Usuario</th-->
                  <!--th>Fecha</th-->
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
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>