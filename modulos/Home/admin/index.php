<?php 
if(isset($_SESSION["username"])){
//	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
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
  case($opc=='style_var'):
?>
<style>label{display:inherit;}label span{float:right;} .fa-trash, .fa.close{color:#c00; cursor:pointer;}</style>
<div class="col-lg-5 col-xs-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Agregar Variable.</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <form id="add-form" role="form">
            <div class="box-body">
            	<div class="form-group">
              	<label for="nom">Nombre Opcion</label>
          			<input type="text" class="form-control" id="nom" name="nom" value="">
          		</div>
							<div class="form-group">
          			<label folr="contenido">Descripción</label>
              	<input type="text" class="form-control" id="contenido" name="contenido" value="">
              </div>
              <div class="form-group">
              	<input type="hidden" class="form-control" id="visible" name="visible" value="1">
              </div>
            </div>
            <div class="box-footer">
              <button class="btn btn-primary btn-guardar">Guardar</button>
            </div>
          </form>
        </div>
      </div><!-- /.row-->
    </div>
    <!-- /.box-body-->      
  </div>
  <!-- /.box-default-->
</div>
<div class="col-lg-7 col-xs-12">
  <div id="aviso2"></div>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Estilos y variables.</h3>
    </div>
    <!-- /.box-header -->
    <form id="edit-form" role="form">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
            <div id="reg-form" class="box-body"></div>
        </div>
      </div><!-- /.row-->
    </div>
    <!-- /.box-body-->
    <div class="box-footer">
    	<input type="submit" id="Guardar" name="Guardar" class="btn btn-primary" value="Guardar">
    </div>
    </form>      
  </div>
  <!-- /.box-default-->
</div>

<?php
  break;
  case($opc=='tema'):

    if($_POST['Guardar']){



    }

?>

	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Configuraci&oacute;n Tema.</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<div class="row">
        	<form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
            <div class="col-md-12"><?php echo $aviso;?></div>
            <div class="col-md-12">              
              <div class="form-group">
                <label for="logo">Background</label>
                <?php echo $file;?>
              </div>
			</div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="f_color">Color de Fondo</label>
                <input type="text" class="form-control" id="f_color" name="f_color" value="<?php echo $bg_color;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="titulo">Fuente</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $font;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="dominio">Tama&ntilde;o de Fuente</label>
                <input type="text" class="form-control" id="dominio" name="dominio" value="<?php echo $font_size;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="path_root">Color de Fuente</label>
                <input type="text" class="form-control" id="path_root" name="path_root" value="<?php echo $color_font;?>">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="analytics">CSS</label>
                <textarea class="form-control" id="analytics" name="analytics" style="height:110px;"><?php echo $css_web;?></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-12">
        		<div class="box-footer">
        			<input type="submit" id="Guardar" name="Guardar" class="btn btn-primary" value="Guardar">
        		</div>
			</div>
        	</form>
            </div><!-- /.row-->
    	</div><!-- /.box-body-->      
	</div><!-- /.box-default-->
<?php
  break;
	case($opc=='popup'):
    $file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
    <img src="'.$page_url.$path_tema.'img/aviso.jpg" style="width:150px;"> <a href="javascript:up(1);">Subir Foto</a><div id="upload">';	
  
  if($_POST['Aceptar']){
  //$cover=$_POST['cover'];
  //datos del arhivo 
  $repositor=$path_tema.'img';
  $nombre_archivo = $_FILES['userfile']['name']; 
  $tipo_archivo = $_FILES['userfile']['type']; 
  $tamano_archivo = $_FILES['userfile']['size']; 
  $path_archivo = $repositor."/aviso.jpg";//.$nombre_archivo;
  //compruebo si las características del archivo son las que deseo 
    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 10000000))) { 
        $file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
    }else{ 
        if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
        $file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
        <img src="'.$page_url.$repositor.'/aviso.jpg" style="width:150px;">
        <a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
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
                <h3 class="box-title">Subir Imagen para Ventana Emergente</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
                <div class="box-body">
                  <div class="form-group">
                    <label for="cover">Imagen</label>
                    <?php echo $file;?>
                  </div>
                </div>
                <!-- /.box-body -->
  
                <!--div class="box-footer">
                  <input type="submit" name="Guardar" class="btn btn-primary" value="Guardar"> 
                  <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
                </div-->
              </form>
            </div>
            <!-- /.box -->
      </div>
    <!-- /.col-->
  
  <?php
  break;
  case($opc=='ima_top'):

if($_POST['Aceptar']){
$ID=$_POST['ID_ima'];
//datos del arhivo 
$repositor='modulos/Home/media/top';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$aviso1='El archivo NO ha sido aceptado';
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			/*$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/media/elementos/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';*/			
			$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."menu_web SET ima_top='{$nombre_archivo}' WHERE ID='{$ID}';") or print mysqli_error($mysqli);
		}
		else{
			$aviso1='Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse';
		}
	}
	validar_aviso($save,'Se ha actualizado la imagen del registro: '.$ID,$aviso1.' No se puedo guardar intentelo nuevamente',$aviso);
	//recargar(5,$URL,$target);	
//unlink($URL);
}
?>
<script>
function subir(val,id,ima){
  if(val==1){
	document.getElementById('upload'+id).innerHTML = '<span style="float:right;"><a href="javascript:subir(0,'+id+',0);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><form name="form1" method="post" enctype="multipart/form-data"><input type="file" name="userfile" class="required" size="40" style="font-size: 0.9em;"><br><input type="hidden" id="ID_ima" name="ID_ima" value="'+id+'"><input type="submit" name="Aceptar" value="Aceptar"></form>';
  }else{
	document.getElementById('upload'+id).innerHTML = '';  
  }
}
</script>

<div clas="col-md-12 col-xs-12">
	<div><?php echo $aviso;?></div>
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Menu Web - Imagenes Top</h3><span style="float:right;"></span>
			<!--span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span-->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen Top</th>
                  <th>Modulo</th>                 
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="registros">
<?php 
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE subm='';") or print mysqli_error($mysqli); 
	while($reg=mysqli_fetch_array($sql)){
		$id=$reg['ID'];
		$top=$reg['ima_top'];
		$ima_top=($top!='')?'<img src="'.$page_url.'modulos/Home/media/top/'.$top.'" width="50px">'.$top.'':'No hay imagen';
		$modulo=$reg['modulo'];
		$visible=$reg['visible'];
		echo '
                <tr>
                  <td>'.$id.'</td>
                  <td>'.$ima_top.'</td>
				  <td>'.$modulo.'</td>
				  <td>'.$visible.'</td>
				  <!--td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td-->
				  <td><a href="javascript:subir(1,'.$id.',\''.$top.'\');" title="Editar"><i class="fa fa-edit"></i></a><div id="upload'.$id.'"></div></td>
                </tr>';
	}

?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Imagen Top</th>
                  <th>Modulo</th>                
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
</div><!-- /.col-xs-12 -->        
<div clas="col-md-12 col-xs-12">
        <?php 
		//$query="SELECT * FROM ".$DBprefix."menu_web ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		//crear_json($query,'modulos/Home/','ima_top.json');
		?>
</div>
<?php
	break;
	case($opc=='elementos'):
	switch(true){
		case($action=='form'):
		editor_tiny_mce();
		switch(true){
			case($ctrl=='add'):
			$titulo='Agregar';
			if($cover==''){$cover='nodisponible.jpg';}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<a href="javascript:up(1);">Subir Foto</a><div id="upload"></div>
			';			
			break;
			case($ctrl=='edit' && !empty($_GET['id'])):
			$titulo='Editar';
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
    var r=confirm("Realmente desea eliminar este Archivo"+n+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$page_url}index.php?mod={$mod}&ext={$ext}&opc={$opc}&action=form&ctrl=edit&id={$id}&img='+n+'&delete=1'; ";
	$num_img=$_GET['img'];
	if($num_img==0){$c_img='cover';}elseif($num_img<=-1){if($num_img==-1){$num_img='';}$c_img='file'.$num_img;}else{$c_img='ima'.$num_img;}
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"UPDATE ".$DBprefix."home_elementos SET ".$c_img."='' WHERE ID='".$_GET['id']."';") or print mysqli_error($mysqli);}
    ?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id=1';
	recargar(1,$URL,$target);
}

			$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."home_elementos WHERE ID='{$id}';") or print mysqli_error($mysqli); 
			if($reg=mysqli_fetch_array($sql)){
				$id=$reg['ID'];
				$foto=$reg['foto'];
				$tit1=$reg['tit1'];
				$tit2=$reg['tit2'];
				$exp=$reg['exp'];
				$pro=$reg['pro'];
				$cli=$reg['cli'];
				$txt1=$reg['txt1'];
				$txt2=$reg['txt2'];
				$txt3=$reg['txt3'];
				$txt4=$reg['txt4'];
				$ima0=$reg['ima0'];
				$ima1=$reg['ima1'];
				$ima2=$reg['ima2'];
				$ima3=$reg['ima3'];
				$ima4=$reg['ima4'];
				$ima5=$reg['ima5'];
				$ima6=$reg['ima6'];
			}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<img src="'.$page_url.'modulos/'.$mod.'/media/testimonios/'.$cover.'" style="width:100px;" title="'.$cover.'">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>
			';
			break;
		}

if($_POST['Guardar']){
$foto=$_POST['foto'];
$tit1=$_POST['tit1'];
$tit2=$_POST['tit2'];
$exp=$_POST['exp'];
$pro=$_POST['pro'];
$cli=$_POST['cli'];
$txt1=$_POST['txt1'];
$txt2=$_POST['txt2'];
$txt3=$_POST['txt3'];
$txt4=$_POST['txt4'];
$ima0=$_POST['ima0'];
$ima1=$_POST['ima1'];
$ima2=$_POST['ima2'];
$ima3=$_POST['ima3'];
$ima4=$_POST['ima4'];
$ima5=$_POST['ima5'];
$ima6=$_POST['ima6'];
//html_iso_testimonio($pro,$comentario);
	if($tit1=='' || $tit2==''){
		$error = "  *El campo esta vacio.\\n\\r"; $c++; 
	}
	if($tit1=='' && $tit2==''){
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
	if($ctrl=='edit'){
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."home_elementos SET  tit1='{$tit1}',tit2='{$tit2}',exp='{$exp}',pro='{$pro}',cli='{$cli}',txt1='{$txt1}',txt2='{$txt2}',txt3='{$txt3}',txt4='{$txt4}',ima0='{$ima0}',ima1='{$ima1}',ima2='{$ima2}',ima3='{$ima3}',ima4='{$ima4}',ima5='{$ima5}',ima6='{$ima6}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	}else{
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."home_elementos (tit1,tit2,exp,pro,cli,txt1,txt2,txt3,txt4,ima0,ima1,ima2,ima3,ima4,ima5,ima6) VALUES ('{$tit1}','{$tit2}','{$exp}','{$pro}','{$cli}','{$txt1}','{$txt2}','{$txt3}','{$txt4}','{$ima0}','{$ima1}','{$ima2}','{$ima3}','{$ima4}','{$ima5}','{$ima6}')") or print mysqli_error($mysqli);
	}	
	validar_aviso($save,'El Testimonio se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id=1';
	recargar(3,$URL,$target);
	}
}

if($_POST['Aceptar']){
//$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$tit1=$_POST['tit1'];
$tit2=$_POST['tit2'];
$exp=$_POST['exp'];
$pro=$_POST['pro'];
$cli=$_POST['cli'];
$txt1=$_POST['txt1'];
$txt2=$_POST['txt2'];
$txt3=$_POST['txt3'];
$txt4=$_POST['txt4'];
$ima0=$_POST['ima0'];
$ima1=$_POST['ima1'];
$ima2=$_POST['ima2'];
$ima3=$_POST['ima3'];
$ima4=$_POST['ima4'];
$ima5=$_POST['ima5'];
$ima6=$_POST['ima6'];
//datos del arhivo 
$repositor='modulos/'.$mod.'/media/elementos';
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
			<img src="'.$page_url.'modulos/'.$mod.'/media/elementos/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}

$imagen=array($ima0,$ima1,$ima2,$ima3,$ima4,$ima5,$ima6);
for($i=1;$i<=6;$i++){
	if($imagen[$i]!=''){
		$avi='Cambiar';
		$avi2=' | <a href="javascript:borrar('.$i.');">Borrar</a>';
		$img_data='<img src="'.$page_url.'modulos/'.$mod.'/media/elementos/'.$imagen[$i].'" width="150px" title="'.$imagen[$i].'"><br>';
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
              <h3 class="box-title"><?php echo $titulo;?> Elementos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <!--div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div-->
                <div class="form-group">
                  <label for="tit1">Titulo 1</label>
                  <textarea class="form-control" id="tit1" name="tit1"><?php echo $tit1;?></textarea>
                </div>
                <div class="form-group">
                  <label for="tit2">Titulo 2</label>
                  <textarea class="form-control" id="tit2" name="tit2"><?php echo $tit2;?></textarea>
                </div>
                <div class="form-group">
                  <label for="exp">A&ntilde;os de Experiencia</label>
                  <input type="text" class="form-control" id="exp" name="exp" value="<?php echo $exp;?>">
                </div>
                <div class="form-group">
                  <label for="pro">Num. Proyectos</label>
                  <input type="text" class="form-control" id="pro" name="pro" value="<?php echo $pro;?>">
                </div>
                <div class="form-group">
                  <label for="cli">Num. Clientes</label>
                  <input type="text" class="form-control" id="cli" name="cli" value="<?php echo $cli;?>">
                </div>
                <div class="form-group">
                  <label for="txt1">Texto 1</label>
                  <textarea class="form-control" id="txt1" name="txt1"><?php echo $txt1;?></textarea>
                </div>
                <div class="form-group">
                  <label for="txt2">Texto 2</label>
                  <textarea class="form-control" id="txt2" name="txt2"><?php echo $txt2;?></textarea>                
                </div>
                <div class="form-group">
                  <label for="txt3">Texto 3</label>
                  <textarea class="form-control" id="txt3" name="txt3"><?php echo $txt3;?></textarea>
                </div>
                <div class="form-group">
                  <label for="txt4">Texto 4</label>
                  <textarea class="form-control" id="txt4" name="txt4"><?php echo $txt4;?></textarea>
                </div>
				<?php echo $img_src;?>                
				<!--div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div-->
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Archivos de producto</h4>
      </div>
      <div class="modal-body">
      	<div><iframe name="ima_subir" frameborder="0" scrolling="auto" width="100%" height="400px" src="<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php';?>"></iframe></div>
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
		break;
		default:
//Redireccionar
header("Location: ".$page_url."index.php?mod=".$mod."&ext=".$ext."&opc=".$opc."&action=form&ctrl=edit&id=1");
		break;
	}
	break;
	case($opc=='testimonios'):
	switch(true){
		case($action=='form'):
		switch(true){
			case($ctrl=='add'):
			$titulo='Agregar';
			if($cover==''){$cover='nodisponible.jpg';}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<a href="javascript:up(1);">Subir Foto</a><div id="upload"></div>
			';			
			break;
			case($ctrl=='edit' && !empty($_GET['id'])):
			$titulo='Editar';
			$id=$_GET['id'];
			$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."testimonios WHERE ID='{$id}';") or print mysqli_error($mysqli); 
			if($reg=mysqli_fetch_array($sql)){
				$id=$reg['ID'];
				$cover=$reg['cover'];
				$pro=$reg['pro'];
				$comentario=$reg['comentario'];
				$visible=$reg['visible'];
			}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<img src="'.$page_url.'modulos/'.$mod.'/media/testimonios/'.$cover.'" style="width:100px;" title="'.$cover.'">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>
			';
			break;
		}

if($_POST['Guardar']){
$cover=$_POST['cover'];
$pro=$_POST['pro'];
$comentario=$_POST['comentario'];
$visible=$_POST['visible'];
html_iso_testimonio($pro,$comentario);
	if($pro=='' || $comentario==''){
		$error = "  *El campo esta vacio.\\n\\r"; $c++; 
	}
	if($pro=='' && $comentario==''){
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
	if($ctrl=='edit'){
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."testimonios SET cover='{$cover}', pro='{$pro}', comentario='{$comentario}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	}else{
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."testimonios (cover,pro,comentario,visible) VALUES ('{$cover}','{$pro}','{$comentario}','{$visible}')") or print mysqli_error($mysqli);
	}	
	validar_aviso($save,'El Testimonio se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}

if($_POST['Aceptar']){
//$cover=$_POST['cover'];
$pro=$_POST['pro'];
$comentario=$_POST['comentario'];
$visible=$_POST['visible'];
//datos del arhivo 
$repositor='modulos/'.$mod.'/media/testimonios';
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
			<img src="'.$page_url.'modulos/'.$mod.'/media/testimonios/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
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
              <h3 class="box-title"><?php echo $titulo;?> Testimonio</h3>
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
                  <label for="pro">Profesi&oacute;n</label>
                  <input type="text" class="form-control" id="pro" name="pro" value="<?php echo $pro;?>">
                </div>
                <div class="form-group">
                  <label for="comentario">Comentario</label>
                  <input type="text" class="form-control" id="comentario" name="comentario" value="<?php echo $comentario;?>">
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
    var r=confirm("Realmente desea eliminar el Testimonio "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."testimonios WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
<div clas="col-md-12 col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Testimonio</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Profesi&oacute;n</th>
                  <th>Comentario</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."testimonios;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
$cover=$reg['cover'];
$pro=$reg['pro'];
$comentario=$reg['comentario'];
$visible=$reg['visible'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td align="center"><img src="'.$page_url.'modulos/'.$mod.'/media/testimonios/'.$cover.'" title="'.$cover.'" alt="'.$cover.'" width="100px"></td>
				  <td>'.$pro.'</td>
                  <td>'.$comentario.'</td>
				  <td>'.$visible.'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Profesi&oacute;n</th>
                  <th>Comentario</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
</div><!-- /.col-xs-12 -->
	<div clas="col-md-12 col-xs-12">
        <?php 
		$query="SELECT * FROM ".$DBprefix."testimonios WHERE visible=1 ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/','testimonios.json');
		?>
	</div>                 
<?php
		break;
	}
	break;
	case($opc=='slider'):
	switch(true){
		case($action=='form'):
		switch(true){
			case($ctrl=='add'):
			$titulo='Agregar';
			if($cover==''){$cover='nodisponible.jpg';}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<a href="javascript:up(1);">Subir Foto</a><div id="upload"></div>
			';			
			break;
			case($ctrl=='edit' && !empty($_GET['id'])):
			$titulo='Editar';
			$id=$_GET['id'];
			$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."slider WHERE ID='{$id}';") or print mysqli_error($mysqli); 
			if($reg=mysqli_fetch_array($sql)){
				$id=$reg['ID'];
				$cover=$reg['ima'];
				$tit1=$reg['tit1'];
				$tit2=$reg['tit2'];
				$btn=$reg['btn_nom'];
				$url_s=$reg['url'];
				$tema_slider=$reg['tema_slider'];
				$visible=$reg['visible'];
			}
			$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
			<img src="'.$page_url.'modulos/'.$mod.'/media/slide/'.$cover.'" style="width:100%;" title="'.$cover.'">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>
			';
			break;
		}
		
if($_POST['Guardar']){
$cover=$_POST['cover'];
$tit1=$_POST['tit1'];
$tit2=$_POST['tit2'];
$btn=$_POST['btn'];
$url_s1=$_POST['url'];
$tema_slider=$_POST['tema_slider'];
$visible=$_POST['visible'];
$url_s=str_replace('watch?v=','embed/',$url_s1);
html_iso_slider($tit1,$tit2,$btn);
	if($tit1 == ''){
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
	if($ctrl=='edit'){
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."slider SET ima='{$cover}', tit1='{$tit1}', tit2='{$tit2}', btn_nom='{$btn}', url='{$url_s}', tema_slider='{$tema_slider}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	}else{
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."slider (ima,tit1,tit2,btn_nom,url,tema_slider,visible) VALUES ('{$cover}','{$tit1}','{$tit2}','{$btn}','{$url_s}','{$tema_slider}','{$visible}')") or print mysqli_error($mysqli);
	}	
	validar_aviso($save,'El Diapositiva se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}

if($_POST['Aceptar']){
//$cover=$_POST['cover'];
$tit1=$_POST['tit1'];
$tit2=$_POST['tit2'];
$btn=$_POST['btn'];
$url_s=$_POST['url'];
$tema_slider=$_POST['tema_slider'];
$visible=$_POST['visible'];
//datos del arhivo 
$repositor='modulos/'.$mod.'/media/slide';
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
			<img src="'.$page_url.'modulos/'.$mod.'/media/slide/'.$nombre_archivo.'" style="width:150px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
		}
		else{
			$file='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file;
		}
	}
//unlink($URL);
}

//CONSULTAR TEMAS
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."temas;") or print mysqli_error($mysqli); 
//$select_tema='<select class="form-control" id="tema_slider" name="tema_slider">';
while($reg=mysqli_fetch_array($sql)){
	$id=$reg['ID'];
	$tema=$reg['tema'];
	$selec=$reg['selec'];
	$act=($selec==1)?' selected':'';
	$select_tema.='<option value="'.$tema.'"'.$act.'>'.$tema.'</option>';
}
//$select_tema='</select>';	
?>
	<div class="col-md-12">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $titulo;?> Slider</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">

              <div class="col-md-6">
              <div class="form-group">
                  <label for="cover">Imagen</label>
                  <?php echo $file;?>
                </div>
                <div class="form-group">
                  <label for="btn">Nombre Boton</label>
                  <input type="text" class="form-control" id="btn" name="btn" value="<?php echo $btn;?>">
                </div>
                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" id="url" name="url" value="<?php echo $url_s;?>">
                </div>              
              </div>
              <div class="col-md-6">
              
                <div class="form-group">
                  <label for="tit1">Titulo 1</label>
                  <input type="text" class="form-control" id="tit1" name="tit1" value="<?php echo $tit1;?>">
                </div>
                <div class="form-group">
                  <label for="tit1">Titulo 2</label>
                  <!--input type="text" class="form-control" id="tit2" name="tit2" value="<?php echo $tit2;?>"-->
                  <textarea class="form-control" id="tit2" name="tit2" style="height:73px;"><?php echo $tit2;?></textarea>
                </div>
				        <div class="form-group">
                  <label for="tema_slider">Tema</label>
                  <!--input type="text" class="form-control" id="tema" name="tema"-->
                  <select class="form-control" id="tema_slider" name="tema_slider">
                  <?php echo $select_tema;?>
                  </select>
                </div>
				        <div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
              </div>
              </div><!-- /.box-body -->

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
    var r=confirm("Realmente desea eliminar esta Diapositiva "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."slider WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
<div clas="col-md-12 col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Slider</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Titulo1</th>
                  <th>Titulo2</th>
                  <th>Boton</th>
                  <th>Tema</th>
                  <th>URL</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."slider WHERE tema_slider='{$tema}';") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
$cover=$reg['ima'];
$tit1=$reg['tit1'];
$tit2=$reg['tit2'];
$btn=$reg['btn_nom'];
$url_s=$reg['url'];
$tema_slider=$reg['tema_slider'];
$visible=$reg['visible'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td align="center"><img src="'.$page_url.'modulos/'.$mod.'/media/slide/'.$cover.'" title="'.$cover.'" alt="'.$cover.'" width="100px"></td>
				  <td>'.$tit1.'</td>
                  <td>'.$tit2.'</td>
				  <td>'.$btn.'</td>
				  <td>'.$tema_slider.'</td>
                  <td>'.$url_s.'</td>
				  <td>'.$visible.'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Titulo1</th>
                  <th>Titulo2</th>
                  <th>Boton</th>
                  <th>Tema</th>
                  <th>URL</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
</div><!-- /.col-xs-12 -->
	<div clas="col-md-12 col-xs-12">
        <?php 
		$query="SELECT * FROM ".$DBprefix."slider WHERE visible=1 ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/','slider_'.$tema.'.json');
		?>
	</div>         
<?php
		break;				
	}	
	break;	
	case($opc=='menu_web'):
	switch(true){
	  case($action=='form'):
	  	editor_tiny_mce();
		switch(true){
			case($ctrl=='add'):
				$titulo='Agregar';$ext1=$ext;$sub='Subir';
			break;
			case($ctrl=='edit' && !empty($_GET['id'])):
				$titulo='Editar';$id=$_GET['id'];$sub='Cambiar';
				$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE ID='{$id}';") or print mysqli_error($mysqli); 
				if($reg=mysqli_fetch_array($sql)){
					$menu1=$reg['menu'];
					$url1 = $reg['url'];
					$ord=$reg['ord'];
					$modulo=$reg['modulo'];
					$ext1=$reg['ext'];
					$tit_sec=$reg['tit_sec'];
					$des_sec=$reg['des_sec'];
					$ima_top=$reg['ima_top'];
					$subm=$reg['subm'];
					$visible=$reg['visible'];
				}
			break;
		}
		
if($ima_top==''){$ima_top='gris.png';}

$file='<input type="hidden" class="form-control" id="ima_top" name="ima_top" value="'.$ima_top.'">
<img src="'.$page_url.'modulos/'.$mod.'/media/top/'.$ima_top.'" style="width:200px;" title="'.$ima_top.'">
<a href="javascript:up(1);">'.$sub.' Foto</a><div id="upload"></div>';

if($_POST['Guardar']){
$menu1=$_POST['menu'];
$url1=$_POST['url'];
$ord=$_POST['ord'];
$modulo=$_POST['mo'];
$ext1=$_POST['ext1'];
$tit_sec=$_POST['tit_sec'];
$des_sec=$_POST['des_sec'];
$ima_top=$_POST['ima_top'];
$subm=$_POST['subm'];
$visible=$_POST['visible'];
html_iso($menu1,$tit_sec);
	if($menu1 == '' && $visible == ''){
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
	if($ctrl=='edit'){
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."menu_web SET menu='{$menu1}', url='{$url1}', ord='{$ord}', modulo='{$modulo}', ext='{$ext1}', tit_sec='{$tit_sec}', des_sec='{$des_sec}', ima_top='{$ima_top}', subm='{$subm}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	}else{
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_web (menu,url,ord,modulo,ext,tit_sec,des_sec,ima_top,subm,visible) VALUES ('{$menu1}','{$url1}','{$ord}','{$modulo}','{$ext1}','{$tit_sec}','{$des_sec}','{$ima_top}','{$subm}','{$visible}');") or print mysqli_error($mysqli);
	}	
	validar_aviso($save,'El menu se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
	}
}

if($_POST['Aceptar']){
//$cover=$_POST['cover'];
$menu1=$_POST['menu'];
$url1=$_POST['url'];
$ord=$_POST['ord'];
$modulo=$_POST['mo'];
$ext1=$_POST['ext1'];
$tit_sec=$_POST['tit_sec'];
$des_sec=$_POST['des_sec'];
$ima_top=$_POST['ima_top'];
$subm=$_POST['subm'];
$visible=$_POST['visible'];
//datos del arhivo 
$repositor='modulos/'.$mod.'/media/top';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			$file='<input type="hidden" class="form-control" id="ima_top" name="ima_top" value="'.$nombre_archivo.'">
			<img src="'.$page_url.'modulos/'.$mod.'/media/top/'.$nombre_archivo.'" style="width:200px;">
			<a href="javascript:up(1);">Cambiar Foto</a><div id="upload"></div>';
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
              <h3 class="box-title"><?php echo $titulo;?> Menu Web</h3>
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
                  <label for="menu">Menu</label>
                  <input type="text" class="form-control" id="menu" name="menu" value="<?php echo $menu1;?>">
                </div>
                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" id="url" name="url" value="<?php echo $url1;?>">
                </div>
                <div class="form-group">
                  <label for="ord">Orden</label>
                  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>">
                </div>
                <div class="form-group">
                  <label for="mo">Modulo</label>
                  <input type="text" class="form-control" id="mo" name="mo" value="<?php echo $modulo;?>">
                </div>
                <div class="form-group">
                  <label for="ext1">Ext</label>
                  <input type="text" class="form-control" id="ext1" name="ext1" value="<?php echo $ext1;?>">
                </div>
                <div class="form-group">
                  <label for="tit_sec">Titulo de Seccion</label>
                  <input type="text" class="form-control" id="tit_sec" name="tit_sec" value="<?php echo $tit_sec;?>">
                </div>
                <div class="form-group">
                  <label for="des_sec">Descripci&oacute;n de Seccion</label>
                  <textarea class="form-control" id="des_sec" name="des_sec"><?php echo $des_sec;?></textarea>
                </div>
                <div class="form-group">
                  <label for="subm">SubMenu</label>
                  <?php select_menu($subm);?>
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
    var r=confirm("Realmente desea eliminar este Menu "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."menu_web WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
<style>td{font-size:12px;}</style>
<div clas="col-md-12 col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Menu Web</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Menu</th>
                  <th>url</th>
                  <th>Orden</th>
                  <th>SubMenu</th> 
                  <th>Modulo</th>
                  <th>Ext</th>                                   
                  <th>Banner</th>                                   
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
$itop=$reg['ima_top'];
$ima_top=($itop!='')?'<img src="'.$page_url.'modulos/Home/media/top/'.$itop.'" width="50px">'.$itop.'':'No hay imagen';
echo '
                <tr>
                  <td>'.$reg['ID'].'</td>
                  <td>'.$reg['menu'].'</td>
				  <td>'.$reg['url'].'</td>
				  <td>'.$reg['ord'].'</td>
				  <td>'.$reg['subm'].'</td>
				  <td>'.$reg['modulo'].'</td>
  				  <td>'.$reg['ext'].'</td>
  				  <td>'.$ima_top.'</td>
				  <td>'.$reg['visible'].'</td>
				  <td style="font-size:14px;"><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Menu</th>
                  <th>url</th>
                  <th>Orden</th>
                  <th>SubMenu</th>
                  <th>Modulo</th>
                  <th>Ext</th>
                  <th>Banner</th>                
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
</div><!-- /.col-xs-12 -->
<div clas="col-md-12 col-xs-12">
        <?php 
		$query="SELECT * FROM ".$DBprefix."menu_web WHERE visible=1 ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,$path_tema.'menu/','menu.json');
		?>
</div>        
<?php	  
	  break;
	}
	break;
	case($action=='add'):
editor_tiny_mce();
if($_POST['Guardar']){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
$tema=$_POST['tema'];
$modulo=$_POST['modulo'];
$activo=$_POST['activo'];
	if($titulo == ''){
		$error = "  *El campo esta vacio.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."pages (titulo,contenido,tema,modulo,activo) VALUES ('{$titulo}','{$contenido}','{$tema}','{$modulo}','{$activo}');") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El contenido del Home se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}
?>
	<div clas="col-md-12 col-xs-12">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Home Contenido</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="contenido">Contenido</label>
                  <textarea class="form-control" id="contenido" name="contenido" style="height:300px;"><?php echo $contenido;?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label for="tema">Tema</label>
                  <input type="text" class="form-control" id="tema" name="tema" value="<?php echo $tema;?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="modulo">Modulo</label>
                  <input type="text" class="form-control" id="modulo" name="modulo" value="<?php echo $mod;?>">
                </div>
				<div class="form-group col-md-6">
                  <label>Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel=($activo==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($activo==1) ? 'selected' : '';?>>Si</option>
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
editor_tiny_mce();
$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."pages WHERE ID='{$id}';") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
$titulo=$reg['titulo'];
$contenido=$reg['contenido'];
$tema=$reg['tema'];
$modulo=$reg['modulo'];
$activo=$reg['activo'];
}
if($_POST['Guardar']){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
$tema=$_POST['tema'];
$modulo=$_POST['modulo'];
$activo=$_POST['activo'];
	if($titulo == ''){
		$error = "  *El campo esta vacio.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
			</div>
			';
	}else{
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."pages SET titulo='{$titulo}', contenido='{$contenido}', tema='{$tema}', modulo='{$modulo}', activo='{$activo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El contenido del Home se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}
?>
	<div clas="col-md-12 col-xs-12">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Home Contenido</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="contenido">Contenido</label>
                  <textarea class="form-control" id="contenido" name="contenido" style="height:300px;"><?php echo $contenido;?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label for="tema">Tema</label>
                  <input type="text" class="form-control" id="tema" name="tema" value="<?php echo $tema;?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="modulo">Modulo</label>
                  <input type="text" class="form-control" id="modulo" name="modulo" value="<?php echo $modulo;?>">
                </div>
				<div class="form-group col-md-6">
                  <label>Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel=($activo==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($activo==1) ? 'selected' : '';?>>Si</option>
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
    var r=confirm("Realmente desea eliminar este Contenido "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."pages WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
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
<div clas="col-md-12 col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla Home Config</h3>
			<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                <tr>
                  <th>ID</th>
                  <th>Titulo</th>
                  <th>Contenido</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."pages WHERE modulo='{$mod}';") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
$titulo=$reg['titulo'];
$contenido=$reg['contenido'];
$activo=$reg['activo'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td>'.$titulo.'</td>
				  <td></td>
				  <td>'.$activo.'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Titulo</th>
                  <th>Contenido</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
			</div><!-- /.box-body -->
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
//	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>