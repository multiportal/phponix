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

<?php 
switch(true){
 case($action=='add'):
 $URL='http://'.$host.$pag_url; 
if($_POST['Guardar']){
	$cover=$_POST['cover'];
	$titulo=$_POST['titulo'];
	$des=$_POST['descripcion'];
	$contenido=$_POST['contenido'];
	$tag=$_POST['tag'];
	$autor=$_POST['autor'];
	//$fmod=$_POST['fmod'];
	$fecha=$_POST['fecha'];
	$visible=$_POST['visible'];
	html_iso($titulo,$des,$tag,$autor);
    if($titulo=='' && $des==''){
        $error = " *Los campos estan vacios.\\n\\r"; $c++; 
    }
	if($titulo=='' || $des==''){
        $error = " *El campo esta vacio.\\n\\r"; $c++; 
    }
    if($c > 0){
        $aviso='
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
            </div>
            ';
    }else{
    $save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."blog (cover,titulo,descripcion,contenido,tag,autor,fecha,visible) VALUES ('{$cover}','{$titulo}','{$des}','{$contenido}','{$tag}','{$autor}','{$fecha}','{$visible}');") or print mysqli_error($mysqli);
	validar_aviso($save,'Se ha agregado la entrada correctamente','No se agrego la entrada, intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
    }
}

$file='
<a href="javascript:up(1);">Subir Imagen</a><div id="upload"></div>
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
            $file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:150px;">
            <a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>';
        }
        else{
            $file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
        }
    }
//unlink($URL);
}
?>
    <div class="col-md-6">
        <?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Entrada</h3>
            </div>
            <!-- /.box-header -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="contenido">Contenido</label>
                  <textarea class="form-control" id="contenido" name="contenido"><?php echo $contenido;?></textarea>
                </div>
                <div class="form-group">
                  <label for="tag">Tag</label>
                  <input type="text" class="form-control" id="tag" name="tag" value="<?php echo $tag;?>">
                </div>
                <div class="form-group">
                  <label for="autor">Autor</label>
                  <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $username;?>">
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha de Alta</label>
                  <!--input type="text" class="form-control" id="fmod" name="fmod" value="<?php echo $date;?>"-->
   				  <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $date;?>"><!--FECHA ALTA-->
                </div>
                <!--div class="form-group">
                  <label for="f_ini">Fecha Inicio</label>
                	<div class='input-group date' id='datetimepicker6'>
                		<input type='text' class="form-control" id="f_ini" name="f_ini" value="<?php echo $date;?>">
                		<span class="input-group-addon">
                    		<span class="glyphicon glyphicon-calendar"></span>
                		</span>
            		</div>
                </div-->
                <div class="form-group">
                  <label for="visible">Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div> 
              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar">
                <!--button type="submit" class="btn btn-primary">Guardar</button-->
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
            <!-- form start -->
          </div>
          <!-- /.box -->
    </div>
    <!-- /.col-->
<?php 
 break;
 case($action=='edit' && !empty($_GET['id'])):
$id=$_GET['id'];
$sqle=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sqle)){
	$cover=$reg['cover'];
	$titulo=$reg['titulo'];
	$des=$reg['descripcion'];
	$contenido=$reg['contenido'];
	$tag=$reg['tag'];
	$autor=$reg['autor'];
	$fmod=$reg['fmod'];
	$fecha=$reg['fecha'];
	$visible=$reg['visible'];
}
 
if($_POST['Guardar']){
	$cover=$_POST['cover'];
	$titulo=$_POST['titulo'];
	$des=$_POST['descripcion'];
	$contenido=$_POST['contenido'];
	$tag=$_POST['tag'];
	$autor=$_POST['autor'];
	$fmod=$_POST['fmod'];
	$fecha=$_POST['fecha'];
	$visible=$_POST['visible'];
	html_iso($titulo,$des,$tag,$autor);
    if($titulo=='' && $des==''){
        $error = " *Los campos estan vacios.\\n\\r"; $c++; 
    }
	if($titulo=='' || $des==''){
        $error = " *El campo esta vacio.\\n\\r"; $c++; 
    }
    if($c > 0){
        $aviso='
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
            </div>
            ';
    }else{
    $save=mysqli_query($mysqli,"UPDATE ".$DBprefix."blog SET cover='{$cover}', titulo='{$titulo}', descripcion='{$des}', contenido='{$contenido}', tag='{$tag}', autor='{$autor}', fmod='{$fmod}', fecha='{$fecha}', visible='{$visible}' WHERE id='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'Se ha actualizado la entrada correctamente','No se puedo ha actualizado la entrada, intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
    }
}

$cover=($cover!='')?$cover:'nodisponible1.jpg';
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" style="width:150px;">
<a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>
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
            $file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:150px;">
            <a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>';
        }
        else{
            $file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
        }
    }
//unlink($URL);
}
?>
    <div class="col-md-6">
        <?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Entrada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="contenido">Contenido</label>
                  <textarea class="form-control" id="contenido" name="contenido"><?php echo $contenido;?></textarea>
                </div>
                <div class="form-group">
                  <label for="tag">Tag</label>
                  <input type="text" class="form-control" id="tag" name="tag" value="<?php echo $tag;?>">
                </div>
                <div class="form-group">
                  <label for="autor">Autor</label>
                  <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $autor;?>">
                </div>
                <div class="form-group">
                  <label for="fmod">Fecha de Modificacion</label>
                  <input type="text" class="form-control" id="fmod" name="fmod" value="<?php echo $date;?>">
   				  <input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>"><!--FECHA ALTA-->
                </div>
                <!--div class="form-group">
                  <label for="f_ini">Fecha Inicio</label>
                	<div class='input-group date' id='datetimepicker6'>
                		<input type='text' class="form-control" id="f_ini" name="f_ini" value="<?php echo $date;?>">
                		<span class="input-group-addon">
                    		<span class="glyphicon glyphicon-calendar"></span>
                		</span>
            		</div>
                </div-->
                <div class="form-group">
                  <label for="visible">Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div> 
              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar">
                <!--button type="submit" class="btn btn-primary">Guardar</button-->
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </div>
    <!-- /.col-->
<?php 
 break;
 default:
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar entrada "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."blog WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
	<div id="desc" class="hidden-xs" style="text-align:center;">Agregar nueva entrada</div>
</div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id		= $reg['ID'];
$cover	= $reg['cover'];
$titulo = $reg['titulo'];
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
	<div id="title"><b>'.$titulo.'</b></div>
	<div id="desc" class="hidden-xs">'.$des.'</div>
</div>';
}
?>
<div class="col-md-12">
        <?php 
		$query="SELECT * FROM ".$DBprefix."blog WHERE visible=1 ORDER BY ID DESC;";
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

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>