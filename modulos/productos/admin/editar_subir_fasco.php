<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
		include 'functions.php';
editor_tiny_mce();
sql_opciones('tiny_text_des',$valor);
$tiny_text=$valor;
?>
<style>#title{height:40px;}#desc{height:30px;}</style>
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
	case($opc=="subcategoria"):
	switch(true){
	case($action=='add'):
if($_POST['Guardar']){
$subcate=$_POST['subcategoria'];
$ord=$_POST['ord'];
$cate=$_POST['cate'];
$cover=$_POST['cover'];
$visible=$_POST['visible'];
html_iso_subcate($subcate,$cate,$des);
	if($subcate == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos_sub_cate (subcategoria,ord,ID_cate,cover,visible) VALUES ('{$subcate}','{$ord}','{$cate}','{$cover}','{$visible}');") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'La Subcategoria se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}
/*
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="nodisponible.jpg">
<a href="javascript:up(1);">Subir Imagen</a><div id="upload"></div>
';
*/
$cover=($cover!='')?$cover:'nodisponible.jpg';
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
            $file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
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
              <h3 class="box-title">Agregar SubCategoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="subcategoria">SubCategoria</label>
                  <input type="text" class="form-control" id="subcategoria" name="subcategoria" value="<?php echo $subcate;?>">
                </div>
                <div class="form-group">
                  <label for="ord">Orden</label>
                  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
   				  <?php select_cate($cate);?>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
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
<?php
	break;
	case($action=='edit' && !empty($_GET['id'])):
$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE ID_sub_cate='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$subcate=$reg['subcategoria'];
$ord=$reg['ord'];
$cate=$reg['ID_cate'];
$cover=$reg['cover'];
$visible=$reg['visible'];
}

if($_POST['Guardar']){
$subcate=$_POST['subcategoria'];
$ord=$_POST['ord'];
$cate=$_POST['cate'];
$cover=$_POST['cover'];
$visible=$_POST['visible'];
html_iso_subcate($subcate,$cate,$des);
	if($subcate == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."productos_sub_cate SET subcategoria='{$subcate}', ord='{$ord}', ID_cate='{$cate}', cover='{$cover}', visible='{$visible}' WHERE ID_sub_cate='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'La subcategoria se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}

$cover=($cover!='')?$cover:'nodisponible.jpg';
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
            $file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
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
              <h3 class="box-title">Editar SubCategoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="subcategoria">SubCategoria</label>
                  <input type="text" class="form-control" id=sub"categoria" name="subcategoria" value="<?php echo $subcate;?>">
                </div>
                <div class="form-group">
                  <label for="ord">Orden</label>
                  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
   				  <?php select_cate($cate);?>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
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
<?php
	break;
	default:
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar esta Subcategoria "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."productos_sub_cate WHERE ID_sub_cate='".$_GET['id']."';") or print mysqli_error($mysqli);
	}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(1,$URL,$target);
}
?>

<div class="col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Subcategoria</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Subcategoria</th>
                  <th>Categoria</th>
                  <th>Orden</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID_sub_cate'];
echo '
                <tr>
                  <td>'.$reg['ID_sub_cate'].'</td>
                  <td>'.$reg['subcategoria'].'</td>
                  <td>'.$reg['ID_cate'].'</td>
				  <td>'.$reg['ord'].'</td>
				  <td>'.$reg['visible'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Subcategoria</th>
                  <th>Categoria</th>
                  <th>Orden</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
        
        <?php 
		$query="SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 ORDER BY ord ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/','subcategorias.json');
		?>
	</div><!-- /.col -->
</div><!-- /.col-xs-12 -->
<?php
	break;
	}

	break;//subcateoria
	case($opc=="categoria"):

	switch(true){
	case($action=='add'):
if($_POST['Guardar']){
$cate=$_POST['categoria'];
$ord=$_POST['ord'];
$cover=$_POST['cover'];
$des=$_POST['des'];
$resena=$_POST['resena'];
$visible=$_POST['visible'];
html_iso_cate($cate);

	if($cate == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos_cate (categoria,ord,cover,visible) VALUES ('{$cate}','{$ord}','{$cover}','{$visible}');") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'La categoria se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}
$cover=($cover!='')?$cover:'nodisponible.jpg';
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
            $file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
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
              <h3 class="box-title">Agregar Categoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $cate;?>">
                </div>
                <!--div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <textarea class="form-control" id="des" name="des"><?php echo $des;?></textarea>
                </div>
                <div class="form-group">
                  <label for="resena">Rese&nacute;a</label>
                  <textarea class="form-control" id="resena" name="resena"><?php echo $resena;?></textarea>
                </div-->
                <div class="form-group">
                  <label for="ord">Orden</label>
                  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>">
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
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
<?php
	break;
	case($action=='edit' && !empty($_GET['id'])):
$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$cate=$reg['categoria'];
$cover=$reg['cover'];
//$des=$reg['descripcion'];
//$resena=$reg['resena'];
$ord=$reg['ord'];
$visible=$reg['visible'];
}

if($_POST['Guardar']){
$cate=$_POST['categoria'];
$cover=$_POST['cover'];
//$des=$_POST['des'];
//$resena=$_POST['resena'];
$ord=$_POST['ord'];
$visible=$_POST['visible'];
html_iso_cate($cate);

	if($cate == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."productos_cate SET categoria='{$cate}', ord='{$ord}', cover='{$cover}', visible='{$visible}' WHERE ID_cate='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'La categoria se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}
$cover=($cover!='')?$cover:'nodisponible.jpg';
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
            $file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
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
              <h3 class="box-title">Editar Categoria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $cate;?>">
                </div>
                <!--div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <textarea class="form-control" id="des" name="des"><?php echo $des;?></textarea>
                </div>
                <div class="form-group">
                  <label for="resena">Rese&nacute;a</label>
                  <textarea class="form-control" id="resena" name="resena"><?php echo $resena;?></textarea>
                </div-->
                <div class="form-group">
                  <label for="ord">Orden</label>
                  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>">
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
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
<?php
	break;
	default:
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar esta Categoria "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."productos_cate WHERE ID_cate='".$_GET['id']."';") or print mysqli_error($mysqli);
	}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(1,$URL,$target);
}
?>

<div class="col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Categoria</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Categoria</th>
                  <th>Orden</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID_cate'];
echo '
                <tr>
                  <td>'.$reg['ID_cate'].'</td>
                  <td>'.$reg['categoria'].'</td>
				  <td>'.$reg['ord'].'</td>
				  <td>'.$reg['visible'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Categoria</th>
                  <th>Orden</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
        
        <?php 
		$query="SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 ORDER BY ord ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/','categorias.json');
		?>
	</div><!-- /.col -->
</div><!-- /.col-xs-12 -->
<?php
	break;
	}


	break;//categoria
	default:

switch(true){
	case($action=='add'):
if($_POST['Guardar']){
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$des=$_POST['des'];
$resena=$_POST['resena'];
$precio=$_POST['precio'];
$moneda=$_POST['moneda'];
$unidad=$_POST['unidad'];
$stock=$_POST['stock'];
$cate=$_POST['cate'];
$subcate=$_POST['subcate'];
$alta=$_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$pdf1=$_POST['pdf1'];
//Conversion iso
html_iso($nombre,$cate,$des);

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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (cover,clave,nombre,descripcion,resena,precio,moneda,unidad,stock,cate,ID_cate,ID_sub_cate,imagen1,imagen2,imagen3,imagen4,imagen5,alta,visible,user) VALUES ('{$cover}','{$clave}','{$nombre}','{$des}','{$resena}','{$precio}','{$moneda}','{$unidad}','{$stock}','{$cate}','{$cate}','{$subcate}','{$ima1}','{$ima2}','{$ima3}','{$ima4}','{$ima5}','{$alta}','{$visible}','{$username}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El producto se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
//*/
}

$file='<input type="hidden" class="form-control" id="cover" name="cover" value="nodisponible.jpg">
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

$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
$cate = $_POST['cate'];
$subcate = $_POST['subcate'];
$resena = $_POST['resena'];
$alta = $_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
//Conversion iso
html_iso($nombre,$cate,$des1);
$aceptar_p=array($aceptar,$aceptar1,$aceptar2,$aceptar3,$aceptar4,$aceptar5);
$ima_array=array($cover,$ima1,$ima2,$ima3,$ima3,$ima4,$ima5);

if($cover!=''){
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" width="200px"><br>
<a href="javascript:upima(0);">Cambiar Imagen</a><div id="upload"></div>';
}
/*
$file_array=array($file,$file1,$file2,$file3,$file4,$file5);
for($i=1;$i<=5;$i++){
	if($ima_array[$i]!=''){
		$file[$i]='<input type="hidden" class="form-control" id="ima'.$i.'" name="ima'.$i.'" value="'.$ima_array[$i].'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima_array[$i].'" width="300px"><br>
<a href="javascript:upima('.$i.');">Cambiar Imagen</a><div id="upload'.$i.'"></div>';
	}
}*/
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
			$file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
			}
			if($aceptar1!=''){
			$file1='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file1;
			}
			if($aceptar2!=''){
			$file2='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file2;
			}
			if($aceptar3!=''){
			$file3='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file3;
			}
			if($aceptar4!=''){
			$file4='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file4;
			}
			if($aceptar5!=''){
			$file5='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file5;
			}

		}
	}
}
//*
//$imagen=array($cover,$ima1,$ima2,$ima3,$ima4,$ima5);
$file_ima=array('',$file1,$file2,$file3,$file4,$file5);
for($i=1;$i<=5;$i++){
$up_images.='
<div class="form-group">
	<label for="ima'.$i.'">Imagen '.$i.'</label>
	<div>
	'.$file_ima[$i].'
	</div>
</div>';
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Nuevo producto</h3>
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
                  <label for="clave">Clave</label>
                  <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave;?>">
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <?php if($tiny_text==1){echo '<textarea class="form-control" id="des" name="des" rows="8">'.$des.'</textarea>';}else{echo '<input type="text" class="form-control" id="des" name="des" value="'.$des.'">';}?>
                </div>
                <div class="form-group">
                  <label for="resena">Rese&ntilde;a</label>
                  <textarea class="form-control" id="resena" name="resena" rows="8"><?php echo $resena;?></textarea>
                </div>
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" id="precio" name="precio" value="0.00">
                </div>
                <div class="form-group">
                  <label for="moneda">Moneda</label>
                  <input type="text" class="form-control" id="moneda" name="moneda" value="MNX">
                </div>
                <div class="form-group">
                  <label for="unidad">Unidad</label>
                  <input type="text" class="form-control" id="unidad" name="unidad" value="PZ">
                </div>
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" value="0">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
   				  <?php select_cate($cate);?>
                </div>
                <div class="form-group">
                  <label for="subcate">SubCategoria</label>
   				  <?php select_sub_cate($cate,$subcate);?>
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
function subir(val,file){
 if(val<=-1){
window.open("<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php?id='.$id;?>&val="+val+"&pdf="+file,"ima_subir");
 }else{
window.open("<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php?id='.$id;?>&val="+val+"&ima="+file,"ima_subir");
 }
}
</script>
<script type="text/javascript">
    function borrar(n){
	if(n==0){n='';}	
    var r=confirm("Realmente desea eliminar esta Archivo"+n+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$page_url}index.php?mod={$mod}&ext={$ext}&action={$action}&id={$id}&img='+n+'&delete=1'; ";
	$num_img=$_GET['img'];
	if($num_img==0){
		$c_img='cover';
	}
	elseif($num_img<=-1){
		/*if($num_img==-1){
			$num_img='';
		}*/
		$c_img='pdf'.abs($num_img);
	}
	else{
	$c_img='imagen'.$num_img;
	}
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"UPDATE ".$DBprefix."productos SET ".$c_img."='' WHERE ID='".$_GET['id']."';") or print mysqli_error($mysqli);}
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$cover=$reg['cover'];
//$foto=$reg['foto'];
$clave=$reg['clave'];
$nombre=$reg['nombre'];//$nombre = htmlentities($reg['nombre'], ENT_COMPAT,'ISO-8859-1', true);
$des=$reg['descripcion'];//$des = htmlentities($reg['descripcion'], ENT_COMPAT,'ISO-8859-1', true);
$resena = $reg['resena'];
$precio=$reg['precio'];
$moneda = $reg['moneda'];
$unidad=$reg['unidad'];
$stock = $reg['stock'];
$cate = $reg['cate'];
$subcate = $reg['ID_sub_cate'];
$alta = $reg['alta'];
$visible=$reg['visible'];
$ima1 = $reg['imagen1'];
$ima2 = $reg['imagen2'];
$ima3 = $reg['imagen3'];
$ima4 = $reg['imagen4'];
$ima5 = $reg['imagen5'];
$pdf1 = $reg['pdf1'];
$pdf2 = $reg['pdf2'];
$pdf3 = $reg['pdf3'];
$pdf4 = $reg['pdf4'];
$pdf5 = $reg['pdf5'];
}

if($_POST['Guardar']){
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$clave=$_POST['clave'];
$nombre=$_POST['nom'];
$des=$_POST['des'];
$resena=$_POST['resena'];
$precio=$_POST['precio'];
$moneda=$_POST['moneda'];
$unidad=$_POST['unidad'];
$stock=$_POST['stock'];
$cate=$_POST['cate'];
$subcate=$_POST['subcate'];
$alta=$_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$pdf1 = $_POST['pdf1'];
$pdf2 = $_POST['pdf2'];
$pdf3 = $_POST['pdf3'];
$pdf4 = $_POST['pdf4'];
$pdf5 = $_POST['pdf5'];

//Conversion iso
html_iso($nombre,$cate,$des1);

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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."productos SET cover='{$cover}', clave='{$clave}', nombre='{$nombre}', descripcion='{$des}', resena='{$resena}', precio='{$precio}', moneda='{$moneda}', unidad='{$unidad}', stock='{$stock}', cate='{$cate}', ID_cate='{$cate}', ID_sub_cate='{$subcate}', imagen1='{$ima1}', imagen2='{$ima2}', imagen3='{$ima3}', imagen4='{$ima4}', imagen5='{$ima5}', alta='{$alta}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'El producto se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
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
              <h3 class="box-title">Editar producto</h3>
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
                  <a href="#" onClick="subir(0,'<?php echo $cover;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Imagen</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="clave">Clave</label>
                  <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave;?>">
                </div>
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <?php if($tiny_text==1){echo '<textarea class="form-control" id="des" name="des" rows="8">'.$des.'</textarea>';}else{echo '<input type="text" class="form-control" id="des" name="des" value="'.$des.'">';}?>
                </div>
                <div class="form-group">
                  <label for="resena">Rese&ntilde;a</label>
                  <textarea class="form-control" id="resena" name="resena" rows="8"><?php echo $resena;?></textarea>
                </div>
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>">
                </div>
                <div class="form-group">
                  <label for="moneda">Moneda</label>
                  <input type="text" class="form-control" id="moneda" name="moneda" value="MNX">
                </div>
                <div class="form-group">
                  <label for="unidad">Unidad</label>
                  <input type="text" class="form-control" id="unidad" name="unidad" value="<?php echo $unidad;?>">
                </div>
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock;?>">
                </div>
                <div class="form-group">
                  <label for="cate">Categoria</label>
				  <?php select_cate($cate);?>
                </div>
                <div class="form-group">
                  <label for="subcate">SubCategoria</label>
   				  <?php select_sub_cate($cate,$subcate);?>
                </div>
                <div class="form-group">
                  <label for="alta">Fecha Alta</label>
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
                <div class="form-group">
                  <label for="pdf1">Archivo PDF 1</label>
                  <input type="hidden" class="form-control" id="pdf1" name="pdf1" value="<?php echo $pdf1;?>">
                  <div>
				  <?php if($pdf1!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(-1);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/pdf_icon.png';?>" width="53px"> <?php echo $pdf1;?><br>
				  <?php }else{$avi='Subir';$avi2='';}?>
                  <a href="#" onClick="subir(-1,'<?php echo $pdf1;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Pdf1</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pdf2">Archivo PDF 2</label>
                  <input type="hidden" class="form-control" id="pdf2" name="pdf2" value="<?php echo $pdf2;?>">
                  <div>
				  <?php if($pdf2!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(-2);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/pdf_icon.png';?>" width="53px"> <?php echo $pdf2;?><br>
				  <?php }else{$avi='Subir';$avi2='';}?>
                  <a href="#" onClick="subir(-2,'<?php echo $pdf2;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Pdf</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pdf3">Archivo PDF 3</label>
                  <input type="hidden" class="form-control" id="pdf3" name="pdf3" value="<?php echo $pdf3;?>">
                  <div>
				  <?php if($pdf3!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(-3);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/pdf_icon.png';?>" width="53px"> <?php echo $pdf3;?><br>
				  <?php }else{$avi='Subir';$avi2='';}?>
                  <a href="#" onClick="subir(-3,'<?php echo $pdf3;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Pdf</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pdf4">Archivo PDF 4</label>
                  <input type="hidden" class="form-control" id="pdf4" name="pdf4" value="<?php echo $pdf4;?>">
                  <div>
				  <?php if($pdf4!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(-4);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/pdf_icon.png';?>" width="53px"> <?php echo $pdf4;?><br>
				  <?php }else{$avi='Subir';$avi2='';}?>
                  <a href="#" onClick="subir(-4,'<?php echo $pdf4;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Pdf</a> <?php echo $avi2;?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pdf5">Archivo PDF 5</label>
                  <input type="hidden" class="form-control" id="pdf5" name="pdf5" value="<?php echo $pdf5;?>">
                  <div>
				  <?php if($pdf5!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar(-5);">Borrar</a>';?>
                  <img src="<?php echo $page_url.'modulos/'.$mod.'/fotos/pdf_icon.png';?>" width="53px"> <?php echo $pdf5;?><br>
				  <?php }else{$avi='Subir';$avi2='';}?>
                  <a href="#" onClick="subir(-5,'<?php echo $pdf5;?>');" data-toggle="modal" data-target="#myModal"><?php echo $avi;?> Pdf</a> <?php echo $avi2;?>
                  </div>
                </div>


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
    var r=confirm("Realmente desea eliminar este producto "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."productos WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
	<div id="desc" class="hidden-xs" style="text-align:center;">Agregar nuevo producto</div>
</div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos ORDER BY ID DESC;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
while($reg=mysqli_fetch_array($sql)){
$id		= $reg['ID'];
$nombre = $reg['nombre'];
$cover	= $reg['cover'];
$des 	= $reg['descripcion'];
$visible= $reg['visible'];
$seleccion=($visible==0) ? '<span style="float:left;color:#f00;">Visible: No</span>' : '<span style="float:left;color:#0f0;">Visible: Si</span>';
$cover=($cover!='')?$cover:'nodisponible.jpg';
echo '
<div class="col-xs-12 col-md-3">
	<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" width="100%">
	<div style="width:100%; height:20px;">'.$seleccion.'
	<span style="float:right;">
		<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a>
	</span>
	</div>
	<div id="title"><b>'.$nombre.'</b></div>
	<div id="desc" class="hidden-xs">'.substr($des,0,75).'</div>
</div>';
}
?>
<div class="col-md-12">
<div style="padding-top:50px;">Total de Registros: <b><?php echo $num_rows;?></b></div>
<hr>
        <?php 
		$query="SELECT * FROM ".$DBprefix."productos WHERE visible=1 ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/',$mod.'.json');
		?>
</div>         
        
</div><!-- /.col-xs-12 -->

<?php
	break;
}
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
        <h4 class="modal-title" id="myModalLabel">Archivos de producto</h4>
      </div>
      <div class="modal-body">
      	<div><iframe name="ima_subir" frameborder="0" scrolling="auto" width="100%" height="400px" src="<?php echo $page_url.'modulos/productos/admin/editar_subir.php';?>"></iframe></div>
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