<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
		include 'functions.php';
editor_tiny_mce();
?>
<script>
function add_cate_porta(val){
	if(val==1){	
		document.getElementById('cate_porta').innerHTML='<input type="text" class="form-control" id="cate" name="cate" value=""><div><a href="javascript:add_cate_porta(0);">Cancelar</a></div>';
	}
	else{
		document.getElementById('cate_porta').innerHTML='<?php cate_porta($cate);?><div><a href="javascript:add_cate_porta(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div>';
	}
}
</script>
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
<?php
switch(true){
	case($action=='add'):
if($_POST['Guardar']){
//$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
$cate = $_POST['cate'];
$resena = $_POST['resena'];
$alta = $_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$url_page=$_POST['url_page'];
//Conversion iso
html_iso_porta($nombre,$des,$resena1,$cate);

	if($nombre == '' && $visible == ''){
		$error = "*Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> '.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."portafolio (nombre,cover,descripcion,cate,resena,imagen1,imagen2,imagen3,imagen4,imagen5,alta,visible,user,url_page) VALUES ('{$nombre}','{$cover}','{$des}','{$cate}','{$resena}','{$ima1}','{$ima2}','{$ima3}','{$ima4}','{$ima5}','{$alta}','{$visible}','{$username}','{$url_page}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El portafolio se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
//*/
}

$file='<input type="hidden" class="form-control" id="cover" name="cover">
<a href="javascript:upima(0);">Subir Imagen</a><div id="upload"></div>';
$file1='<input type="hidden" class="form-control" id="ima1" name="ima1">
<a href="javascript:upima(1);">Subir Imagen</a><div id="upload1"></div>';
$file2='<input type="hidden" class="form-control" id="ima2" name="ima2">
<a href="javascript:upima(2);">Subir Imagen</a><div id="upload2"></div>';
$file3='<input type="hidden" class="form-control" id="ima3" name="ima3">
<a href="javascript:upima(3);">Subir Imagen</a><div id="upload3"></div>';
$file4='<input type="hidden" class="form-control" id="ima4" name="ima3">
<a href="javascript:upima(4);">Subir Imagen</a><div id="upload4"></div>';
$file5='<input type="hidden" class="form-control" id="ima5" name="ima5">
<a href="javascript:upima(5);">Subir Imagen</a><div id="upload5"></div>';

if($_POST['Aceptar'] || $_POST['Aceptar1'] || $_POST['Aceptar2'] || $_POST['Aceptar3'] || $_POST['Aceptar4'] || $_POST['Aceptar5']){
unset($_POST['Guardar']);
$aceptar=$_POST['Aceptar'];
$aceptar1=$_POST['Aceptar1'];
$aceptar2=$_POST['Aceptar2'];
$aceptar3=$_POST['Aceptar3'];
$aceptar4=$_POST['Aceptar4'];
$aceptar5=$_POST['Aceptar5'];

//$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
$cate = $_POST['cate'];
$resena = $_POST['resena'];
$alta = $_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$url_page=$_POST['url_page'];
//Conversion iso
html_iso_porta($nombre,$des,$resena1,$cate);

if($cover!=''){
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" width="200px"><br>
<a href="javascript:upima(0);">Cambiar Imagen</a><div id="upload"></div>';
}
if($ima1!=''){
$file1='<input type="hidden" class="form-control" id="ima1" name="ima1" value="'.$ima1.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima1.'" width="300px"><br>
<a href="javascript:upima(1);">Cambiar Imagen</a><div id="upload1"></div>';
}
if($ima2!=''){
$file2='<input type="hidden" class="form-control" id="ima2" name="ima2" value="'.$ima2.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima2.'" width="300px"><br>
<a href="javascript:upima(2);">Cambiar Imagen</a><div id="upload2"></div>';
}
if($ima3!=''){
$file3='<input type="hidden" class="form-control" id="ima3" name="ima3" value="'.$ima3.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima3.'" width="300px"><br>
<a href="javascript:upima(3);">Cambiar Imagen</a><div id="upload3"></div>';
}
if($ima4!=''){
$file4='<input type="hidden" class="form-control" id="ima4" name="ima4" value="'.$ima4.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima4.'" width="300px"><br>
<a href="javascript:upima(4);">Cambiar Imagen</a><div id="upload4"></div>';
}
if($ima5!=''){
$file5='<input type="hidden" class="form-control" id="ima5" name="ima5" value="'.$ima5.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima5.'" width="300px"><br>
<a href="javascript:upima(5);">Cambiar Imagen</a><div id="upload5"></div>';
}
//echo '<div>Hubo post: Aceptar</div>';
//datos del arhivo 
$repositor='modulos/'.$mod.'/fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_file = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
//*
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
		if($aceptar!=''){
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
		}
		if($aceptar1!=''){
    	$file1='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file1;
		}
		if($aceptar2!=''){
    	$file2='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file2;
		}
		if($aceptar3!=''){
    	$file3='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file3;
		}
		if($aceptar4!=''){
    	$file4='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file4;
		}
		if($aceptar5!=''){
    	$file5='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file5;
		}
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'], $path_file)){//se cambio la funcion #move_uploaded_file" por "copy" para que las imagenes tuvieran los mismos permisos
    		if($aceptar!=''){
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:200px;"><br>
			<a href="javascript:upima(0);">Cambiar Imagen</a><div id="upload"></div>';
			}
			if($aceptar1!=''){
			$file1='<input type="hidden" class="form-control" id="ima1" name="ima1" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:300px;"><br>
			<a href="javascript:upima(1);">Cambiar Imagen</a><div id="upload1"></div>';
			}
			if($aceptar2!=''){
			$file2='<input type="hidden" class="form-control" id="ima2" name="ima2" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:300px;"><br>
			<a href="javascript:upima(2);">Cambiar Imagen</a><div id="upload2"></div>';
			}
			if($aceptar3!=''){
			$file3='<input type="hidden" class="form-control" id="ima3" name="ima3" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:300px;"><br>
			<a href="javascript:upima(3);">Cambiar Imagen</a><div id="upload3"></div>';
			}
			if($aceptar4!=''){
			$file4='<input type="hidden" class="form-control" id="ima4" name="ima4" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:300px;"><br>
			<a href="javascript:upima(4);">Cambiar Imagen</a><div id="upload4"></div>';
			}
			if($aceptar5!=''){
			$file5='<input type="hidden" class="form-control" id="ima5" name="ima5" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:300px;"><br>
			<a href="javascript:upima(5);">Cambiar Imagen</a><div id="upload5"></div>';
			}

		}
		else{
			if($aceptar!=''){
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
			}
			if($aceptar1!=''){
			$file1='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file1;
			}
			if($aceptar2!=''){
			$file2='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file2;
			}
			if($aceptar3!=''){
			$file3='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file3;
			}
			if($aceptar4!=''){
			$file4='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file4;
			}
			if($aceptar5!=''){
			$file5='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file5;
			}

		}
	}
}

//*
$imagen=array($cover,$ima1,$ima2,$ima3,$ima4,$ima5);
for($i=1;$i<=5;$i++){
if($i==1){
	$file_ima=$file1;
}
if($i==2){
	$file_ima=$file2;
}
if($i==3){
	$file_ima=$file3;
}
if($i==4){
	$file_ima=$file4;
}
if($i==5){
	$file_ima=$file5;
}

$up_images.='
<div class="form-group">
	<label for="ima'.$i.'">Imagen '.$i.'</label>
	<div>
	'.$file_ima.'
	</div>
</div>';
}
?>

	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Nuevo Portafolio</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Cover</label>
                  <div>
				  	<?php echo $file;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <input type="text" class="form-control" id="des" name="des" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="url_page">URL Pagina</label>
                  <input type="text" class="form-control" id="url_page" name="url_page" value="<?php echo $url_page;?>">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
				  <div id="cate_porta"><?php cate_porta($cate);?><div><a href="javascript:add_cate_porta(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div></div>
                  <!--input type="text" class="form-control" id="cate" name="cate" value="<?php echo $cate;?>"-->
                </div>
                <div class="form-group">
                  <label for="resena">Rese&ntilde;a</label>
                  <textarea class="form-control" id="resena" name="resena" rows="8">
                        <div class="post-content m-t-sm">
                           <div class="post-gap-small"></div>
							<p>Descripcion</p>
                        </div>
                        <div class="post-gap"></div>
                        <ul class="portfolio-details">
                           <li>
                              <h5>Caracterisiticas</h5>
                              <ul class="list list-skills icons list-unstyled list-inline">
                                 <li><i class="fa fa-check-circle"></i> Backend</li>
                                 <li><i class="fa fa-check-circle"></i> Logo</li>
                              </ul>
                           </li>
                           <li>
                              <h5>Tecnologias</h5>
                              <p>PHP, MySQL</p>
                           </li>
                           <li>
                              <h5>Desarrollado por:</h5>
                              <p>[:MULTIPORTAL:]</p>
                           </li>
                        </ul>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="alta">Fecha Alta</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $date;?>">
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
				<?php echo $up_images;?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              	<input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar">
                <!--button type="submit" class="btn btn-primary">Guardar</button--> 
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php
	break;
	case ($action=='edit' && !empty($_GET['id'])):
$id=$_GET['id'];
?>
<script>
function subir(val,ima){
window.open("<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php?id='.$id;?>&val="+val+"&ima="+ima,"ima_subir");
}
</script>
<script type="text/javascript">
    function borrar(n){
	if(n==0){n='';}	
    var r=confirm("Realmente desea eliminar esta Imagen"+n+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$page_url}index.php?mod={$mod}&ext={$ext}&action={$action}&id={$id}&img='+n+'&delete=1'; ";
	$num_img=$_GET['img'];
	if($num_img==0){$c_img='cover';}else{$c_img='imagen'.$num_img;}
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"UPDATE ".$DBprefix."portafolio SET ".$c_img."='' WHERE ID='".$_GET['id']."';") or print mysqli_error($mysqli);}
    ?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id;
	recargar(1,$URL,$target);
}
?>

<?php
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."portafolio WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
//$clave=$reg['clave'];
$nombre=$reg['nombre'];//$nombre = htmlentities($reg['nombre'], ENT_COMPAT,'ISO-8859-1', true);
$cover=$reg['cover'];
//$foto=$reg['foto'];
$des=$reg['descripcion'];//$des = htmlentities($reg['descripcion'], ENT_COMPAT,'ISO-8859-1', true);
$cate = $reg['cate'];
$resena = $reg['resena'];
$ima1 = $reg['imagen1'];
$ima2 = $reg['imagen2'];
$ima3 = $reg['imagen3'];
$ima4 = $reg['imagen4'];
$ima5 = $reg['imagen5'];
$alta = $reg['alta'];
$visible=$reg['visible'];
$url_page=$reg['url_page'];
}

if($_POST['Guardar']){
//$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
$cate = $_POST['cate'];
$resena = $_POST['resena'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$alta = $_POST['alta'];
$visible=$_POST['visible'];
$url_page=$_POST['url_page'];
//Conversion iso
html_iso_porta($nombre,$des,$resena1,$cate);

	if($nombre == '' && $visible == ''){
		$error = "*Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> '.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."portafolio SET nombre='{$nombre}', cover='{$cover}', descripcion='{$des}', cate='{$cate}', resena='{$resena}', imagen1='{$ima1}', imagen2='{$ima2}', imagen3='{$ima3}', imagen4='{$ima4}', imagen5='{$ima5}', alta='{$alta}', visible='{$visible}', url_page='{$url_page}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'El portafolio se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}

$imagen=array($cover,$ima1,$ima2,$ima3,$ima4,$ima5);
for($i=1;$i<=5;$i++){
	if($imagen[$i]!=''){
		$avi='Cambiar';
		$avi2=' | <a href="javascript:borrar('.$i.');">Borrar</a>';
		$img_data='<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$imagen[$i].'" width="300px"><br>';
	}else{
		$avi='Subir';
		$avi2='';
		$img_data='';
	}
$img_src.='
<div class="form-group">
	<label for="ima'.$i.'">Imagen '.$i.'</label>
	<input type="hidden" class="form-control" id="ima'.$i.'" name="ima'.$i.'" value="'.$imagen[$i].'">
	<div>
	'.$img_data.'
	<a href="#" onClick="subir('.$i.',\''.$imagen[$i].'\');" data-toggle="modal" data-target="#myModal">'.$avi.' Imagen '.$i.'</a> '.$avi2.' 
	</div>
</div>
';
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Portafolio</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Cover</label>
                  <input type="hidden" class="form-control" id="cover" name="cover" value="<?php echo $cover;?>">
                  <div>
				  <?php if($cover!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(0);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/'.$cover;?>" width="200px"><br>
				  <?php }else{$avi='Subir';}?>
                  <a href="#" onClick="subir(0,'<?php echo $ima;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Imagen</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="url_page">URL Pagina</label>
                  <input type="text" class="form-control" id="url_page" name="url_page" value="<?php echo $url_page;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <input type="text" class="form-control" id="des" name="des" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
				  <div id="cate_porta"><?php cate_porta($cate);?><div><a href="javascript:add_cate_porta(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div></div>
                  <!--input type="text" class="form-control" id="cate" name="cate" value="<?php echo $cate;?>"-->
                </div>
                <div class="form-group">
                  <label for="resena">Rese&ntilde;a</label>
                  <textarea class="form-control" id="resena" name="resena" rows="8"><?php echo $resena;?></textarea>
                </div>
                <div class="form-group">
                  <label for="alta">Fecha</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $alta;?>">
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
				<?php echo $img_src;?>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar">
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php
	break;
	default:
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este Portafolio "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."portafolio WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
	}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(1,$URL,$target);
}
?>

<div class="col-xs-12">

<div class="col-xs-12">
	<a href="<?php echo $page_url.'?mod='.$mod.'&ext='.$ext.'&action=add';?>">
	<div style="font-size:20px; text-align:center; padding:2px 0;"><i class="fa fa-plus"></i></div>
	</a>
	<div id="title" style="text-align:center;"><b>Nuevo</b></div>
	<div id="desc" class="hidden-xs" style="text-align:center;">Agregar nuevo portafolio</div>
</div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."portafolio ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id		= $reg['ID'];
$nombre = $reg['nombre'];
$cover	= $reg['cover'];
$des 	= $reg['descripcion'];
$visible= $reg['visible'];
$seleccion=($visible==0) ? '<span style="float:left;color:#f00;">Visible: No</span>' : '<span style="float:left;color:#0f0;">Visible: Si</span>';
$cover=($cover!='')?$cover:'nodisponible1.jpg';
echo '
<div class="col-xs-12 col-md-3">
	<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" width="100%">
	<div style="width:100%; height:20px;">'.$seleccion.'
	<span style="float:right;">
		<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a>
	</span>
	</div>
	<div id="title"><b>'.$nombre.'</b></div>
	<div id="desc" class="hidden-xs">'.$des.'</div>
</div>';
}
?>
<div class="col-md-12">
        <?php 
		$query="SELECT * FROM ".$DBprefix."portafolio WHERE visible=1 ORDER BY ID DESC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/',$mod.'.json');
		?>
</div>         
        
</div><!-- /.col-xs-12 -->

<?php
	break;
}
?>
	</div>
    <!-- /.row-->
    </section>
    <!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Imagenes de Portafolio</h4>
      </div>
      <div class="modal-body">
      	<div><iframe name="ima_subir" frameborder="0" scrolling="auto" width="100%" height="400px" src="<?php echo $page_url.'modulos/portafolio/admin/editar_subir.php';?>"></iframe></div>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
      -->
    </div>
  </div>
</div>
<!-- Fin Modal -->



<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>