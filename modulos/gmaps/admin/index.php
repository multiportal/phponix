<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
	include 'functions.php';
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
	case($opc=='ubicaciones'):

switch(true){
 case($action=='add'):
if($_POST['Guardar']){
	$nombre=$_POST['nom'];
	$adres=$_POST['adres'];
	$des=$_POST['descripcion'];
	$info=$_POST['info'];
	$precio=$_POST['precio'];
	$tel=$_POST['tel'];
	$cover=$_POST['cover'];
	$nivel=$_POST['nivel'];
	$rol=$_POST['rol'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$alta=$_POST['alta'];
	//$fmod=$_POST['fmod'];
	$visible=$_POST['visible'];
	$activo=$_POST['activo'];
	html_iso($nombre,$adres,$des,$info);
    if($nombre=='' && $info==''){
        $error = " *Los campos estan vacios.\\n\\r"; $c++; 
    }
	if($nombre=='' || $info==''){
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
    $save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."map_ubicacion (nom,adres,descripcion,info,precio,tel,cover,nivel,rol,lat,lng,alta,visible,activo) VALUES ('{$nombre}','{$adres}','{$des}','{$info}','{$precio}','{$tel}','{$cover}','{$nivel}','{$rol}','{$lat}','{$lng}','{$alta}','{$visible}','{$activo}');") or print mysqli_error($mysqli);
	validar_aviso($save,'Se ha agregado la ubicaci&oacute;n correctamente','No se agrego la ubicaci&oacute;n, intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
    }
}

$file='
<a href="javascript:up(1);">Subir Imagen</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/images/fotos';
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
			<img src="'.$page_url.'modulos/'.$mod.'/images/fotos/'.$nombre_archivo.'" style="width:150px;">
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
              <h3 class="box-title">Agregar Ubicaci&oacute;n</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Cover</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="nom">Titulo</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="adres">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="adres" name="adres" value="<?php echo $adres;?>">
                </div>
                <div class="form-group">
                  <label for="lat">Lat</label>
                  <input type="text" class="form-control" id="lat" name="lat" value="<?php echo $lat;?>">
                </div>
                <div class="form-group">
                  <label for="lng">Lng</label>
                  <input type="text" class="form-control" id="lng" name="lng" value="<?php echo $lng;?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="info">Informaci&oacute;n</label>
                  <textarea class="form-control" id="info" name="info"><?php echo $info;?></textarea>
                </div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_config WHERE ID=1;") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
	$on_costo=$reg['on_costo'];
}
if($on_costo==1){
?>                
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>">
                </div>
<?php }?>                
                <div class="form-group">
                  <label for="tel">Tel</label>
                  <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel;?>">
                </div>
                <div class="form-group">
                  <label for="nivel">Nivel</label>
                  <input type="text" class="form-control" id="nivel" name="nivel" value="<?php echo $nivel;?>">
                </div>
                <div class="form-group">
                  <label for="rol">Rol</label>
                  <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $rol;?>">
                </div>
                <div class="form-group">
                  <label for="fmod">Fecha de Alta</label>
                  <!--input type="hidden" class="form-control" id="fmod" name="fmod" value="<?php echo $date;?>"-->
   				  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $date;?>"><!--FECHA ALTA-->
                </div>
                <div class="form-group">
                  <label for="visible">Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div> 
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel1=($activo=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel1=($activo=='1') ? 'selected' : '';?>>Si</option>
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
 case($action=='edit' && !empty($_GET['id'])):
$id=$_GET['id'];
$sqle=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_ubicacion WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sqle)){
	$nombre=$reg['nom'];
	$adres=$reg['adres'];
	$des=$reg['descripcion'];
	$info=$reg['info'];
	$precio=$reg['precio'];
	$tel=$reg['tel'];
	$cover=$reg['cover'];
	$nivel=$reg['nivel'];
	$rol=$reg['rol'];
	$lat=$reg['lat'];
	$lng=$reg['lng'];
	$alta=$reg['alta'];
	$fmod=$reg['fmod'];
	$visible=$reg['visible'];
	$activo=$reg['activo'];
}
 
if($_POST['Guardar']){
	$nombre=$_POST['nom'];
	$adres=$_POST['adres'];
	$des=$_POST['descripcion'];
	$info=$_POST['info'];
	$precio=$_POST['precio'];
	$tel=$_POST['tel'];
	$cover=$_POST['cover'];
	$nivel=$_POST['nivel'];
	$rol=$_POST['rol'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$alta=$_POST['alta'];
	$fmod=$_POST['fmod'];
	$visible=$_POST['visible'];
	$activo=$_POST['activo'];
	html_iso($nombre,$adres,$des,$info);
    if($nombre=='' && $info==''){
        $error = " *Los campos estan vacios.\\n\\r"; $c++; 
    }
	if($nombre=='' || $info==''){
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
    $save=mysqli_query($mysqli,"UPDATE ".$DBprefix."map_ubicacion SET nom='{$nombre}', adres='{$adres}', descripcion='{$des}', info='{$info}', precio='{$precio}', tel='{$tel}', cover='{$cover}', nivel='{$nivel}', rol='{$rol}', lat='{$lat}', lng='{$lng}', fmod='{$fmod}', visible='{$visible}', activo='{$activo}' WHERE id='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'Se ha actualizado la ubicaci&oacute;n correctamente','No se puedo ha actualizado la ubicaci&oacute;n, intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
    }
}

$cover=($cover!='')?$cover:'nodisponible1.jpg';
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/images/fotos/'.$cover.'" style="width:150px;">
<a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor='modulos/'.$mod.'/images/fotos';
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
			<img src="'.$page_url.'modulos/'.$mod.'/images/fotos/'.$nombre_archivo.'" style="width:150px;">
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
              <h3 class="box-title">Editar Ubicaci&oacute;n</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="cover">Cover</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="nom">Titulo</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="adres">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="adres" name="adres" value="<?php echo $adres;?>">
                </div>
                <div class="form-group">
                  <label for="lat">Lat</label>
                  <input type="text" class="form-control" id="lat" name="lat" value="<?php echo $lat;?>">
                </div>
                <div class="form-group">
                  <label for="lng">Lng</label>
                  <input type="text" class="form-control" id="lng" name="lng" value="<?php echo $lng;?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="info">Informaci&oacute;n</label>
                  <textarea class="form-control" id="info" name="info"><?php echo $info;?></textarea>
                </div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_config WHERE ID=1;") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
	$on_costo=$reg['on_costo'];
}
if($on_costo==1){
?>                
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>">
                </div>
<?php }?>                
                <div class="form-group">
                  <label for="tel">Tel</label>
                  <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel;?>">
                </div>
                <div class="form-group">
                  <label for="nivel">Nivel</label>
                  <input type="text" class="form-control" id="nivel" name="nivel" value="<?php echo $nivel;?>">
                </div>
                <div class="form-group">
                  <label for="rol">Rol</label>
                  <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $rol;?>">
                </div>
                <div class="form-group">
                  <label for="fmod">Fecha de Modificacion</label>
                  <input type="text" class="form-control" id="fmod" name="fmod" value="<?php echo $date;?>">
   				  <input type="hidden" class="form-control" id="alta" name="alta" value="<?php echo $alta;?>"><!--FECHA ALTA-->
                </div>
                <div class="form-group">
                  <label for="visible">Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div> 
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel1=($activo=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel1=($activo=='1') ? 'selected' : '';?>>Si</option>
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
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."map_ubicacion WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
        	<h3 class="box-title">Tabla map_ubicacion</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Info</th>
                  <th>Tel</th>
                  <th>lat</th> 
                  <th>lng</th>                 
                  <th>Visible</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_ubicacion;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$reg['ID'].'</td>
                  <td>'.$reg['nom'].'</td>
				  <td style="font-size:10px">'.$reg['adres'].'</td>
  				  <td style="font-size:10px">'.$reg['info'].'</td>
				  <td>'.$reg['tel'].'</td>
				  <td>'.$reg['lat'].'</td>
				  <td>'.$reg['lng'].'</td>
				  <td>'.$reg['visible'].'</td>
				  <td>'.$reg['activo'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Info</th>
                  <th>Tel</th>
                  <th>lat</th> 
                  <th>lng</th>                 
                  <th>Visible</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
        
        <?php 
		$query="SELECT * FROM ".$DBprefix."map_ubicacion;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/js/','data-ubicacion.json');
		?>
	</div><!-- /.col -->
</div><!-- /.col-xs-12 -->
   
<?php
 break;
}
	break;
	default:
$sqle=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_config WHERE ID=1;") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sqle)){
	$nombre=$reg['nom'];
	$lat=$reg['lat'];
	$lng=$reg['lng'];
	$zoom=$reg['zoom'];
	$on_costo=$reg['on_costo'];
}
 
if($_POST['Guardar']){
	$nombre=$_POST['nom'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$zoom=$_POST['zoom'];
	$on_costo=$_POST['on_costo'];
    if($lat=='' && $lng==''){
        $error = " *Los campos estan vacios.\\n\\r"; $c++; 
    }
	if($lat=='' || $lng==''){
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
    $save=mysqli_query($mysqli,"UPDATE ".$DBprefix."map_config SET nom='{$nombre}', lat='{$lat}', lng='{$lng}', zoom='{$zoom}', on_costo='{$on_costo}' WHERE id=1;") or print mysqli_error($mysqli);
	validar_aviso($save,'Se ha actualizado la ubicaci&oacute;n correctamente','No se puedo ha actualizado la ubicaci&oacute;n, intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
    }
}

?>
    <div class="col-md-6">
        <?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Configuraci&oacute;n Ubicaci&oacute;n Regional</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                  <label for="lat">Lat</label>
                  <input type="text" class="form-control" id="lat" name="lat" value="<?php echo $lat;?>">
                </div>
                <div class="form-group">
                  <label for="lng">Lng</label>
                  <input type="text" class="form-control" id="lng" name="lng" value="<?php echo $lng;?>">
                </div>
                <div class="form-group">
                  <label for="zoom">Zoom</label>
                  <input type="text" class="form-control" id="zoom" name="zoom" value="<?php echo $zoom;?>">
                </div>
                <div class="form-group">
                  <label for="on_costo">Activar Costo</label>
                  <select class="form-control" id="on_costo" name="on_costo">
                    <option value="0" <?php echo $sel=($on_costo=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($on_costo=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar">
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </div>
    <!-- /.col-->

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