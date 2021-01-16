<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
	include 'functions.php';
?>
<style>
#desc{ width:100%;height:50px;text-align:left;}
</style>

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
 		<?php panel_menu();?>
	</div>
    <!-- /.row-->
	<div class="row">
<?php 
switch(true){
	case($opc=='opciones'):
	switch(true){
		default:
//options($checks,$num_rows);
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
 while($row=mysqli_fetch_array($sql)){
  $ID=$row['ID'];
  $val=$row['valor'];
  $checked=($val==1)?'checked':'';
  $nom=$row['nom'];
  if($ID!=12){
  $checks.='
              <!-- checkbox -->
              <div class="form-group">
                <label Id="'.$ID.'">
          <span>'.$ID.'. </span>
          <!--div class="icheckbox_minimal-blue '.$checked.'" aria-checked="true" aria-disabled="false" style="position: relative;"-->
            <input type="checkbox" data-idRegistro="'.$ID.'" id="opc'.$ID.'" name="opc'.$ID.'" class="minimal" style="position: absolute; opacity: 0;"'.$checked.'>
          <!--/div-->                  
                  <span>'.$nom.'</span>
                </label>
              </div>
  ';
  }
 }  
if($_POST['Guardar']){
//var_dump($_POST);
$opc1=$_POST['opc1'];
$opc2=$_POST['opc2'];
$opc3=$_POST['opc3'];
$opc4=$_POST['opc4'];
$opc5=$_POST['opc5'];
$opc6=$_POST['opc6'];
$opc7=$_POST['opc7'];
$opc8=$_POST['opc8'];
$opc9=$_POST['opc9'];
$opc10=$_POST['opc10'];
$opc11=$_POST['opc11'];
//$opc12=$_POST['opc12'];
$opc13=$_POST['opc13'];
$opc14=$_POST['opc14'];
$opc15=$_POST['opc15'];
$opc16=$_POST['opc16'];
$opc17=$_POST['opc17'];
$opc18=$_POST['opc18'];
$opc19=$_POST['opc19'];
$opc20=$_POST['opc20'];
$opc21=$_POST['opc21'];
$opc22=$_POST['opc22'];
$opc23=$_POST['opc23'];
$opc24=$_POST['opc24'];
$opc25=$_POST['opc25'];
$opc26=$_POST['opc26'];
$opc27=$_POST['opc27'];
$opc28=$_POST['opc28'];
$opc29=$_POST['opc29'];
$opc30=$_POST['opc30'];
$opc31=$_POST['opc31'];
$opc32=$_POST['opc32'];
$opc33=$_POST['opc33'];
$opc34=$_POST['opc34'];
$opc35=$_POST['opc35'];
$opc36=(isset($_POST['opc36']))?$_POST['opc36']:'';
$opc37=(isset($_POST['opc37']))?$_POST['opc37']:'';
$opc38=(isset($_POST['opc38']))?$_POST['opc38']:'';
$opc39=(isset($_POST['opc39']))?$_POST['opc39']:'';
$opc40=(isset($_POST['opc40']))?$_POST['opc40']:'';
$opc41=(isset($_POST['opc41']))?$_POST['opc41']:'';
$opc42=(isset($_POST['opc42']))?$_POST['opc42']:'';
$opc43=(isset($_POST['opc43']))?$_POST['opc43']:'';
$opc44=(isset($_POST['opc44']))?$_POST['opc44']:'';
$opc45=(isset($_POST['opc45']))?$_POST['opc45']:'';
$opc46=(isset($_POST['opc46']))?$_POST['opc46']:'';
$opc47=(isset($_POST['opc47']))?$_POST['opc47']:'';
$opc48=(isset($_POST['opc48']))?$_POST['opc48']:'';
$opc49=(isset($_POST['opc49']))?$_POST['opc49']:'';
$opc50=(isset($_POST['opc50']))?$_POST['opc50']:'';

$arr_opc=array('',$opc1,$opc2,$opc3,$opc4,$opc5,$opc6,$opc7,$opc8,$opc9,$opc10,$opc11,$opc12,$opc13,$opc14,$opc15,$opc16,$opc17,$opc18,$opc19,$opc20,$opc21,$opc22,$opc23,$opc24,$opc25,$opc26,$opc27,$opc28,$opc29,$opc30,$opc31,$opc32,$opc33,$opc34,$opc35,$opc36,$opc37,$opc38,$opc39,$opc40,$opc41,$opc42,$opc43,$opc44,$opc45,$opc46,$opc47,$opc48,$opc49,$opc50);
for($i=1;$i<=$num_rows;$i++){
	$valores=($arr_opc[$i]=='on')?1:0;
	if($i==12){
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones WHERE ID=12;") or print mysqli_error($mysqli);
		if($row=mysqli_fetch_array($sql)){$valores=$row['valor'];}	
	}
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor='{$valores}' WHERE ID='{$i}';") or print mysqli_error($mysqli);
}
	validar_aviso($save,'Se han actualizado las opciones','No se puedo actualizar las opciones intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);	
}
sql_opciones('AJAX',$val_ajax);
if($val_ajax==1){header("Location:".$page_url."index.php?mod=sys&ext=opciones");}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
		<div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Opciones del Sistema (<?php echo $num_rows;?>)</h3>
            </div>
            <div class="box-body">
              <!-- Minimal style -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
			         <?php echo $checks;?>
              <div class="box-footer">
                <input type="submit" name="Guardar" class="btn btn-primary" value="Guardar"> 
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
              </div>

			      </form>
            </div>
        </div>
	</div>
<?php		
		break;
	}
	break;
	case($opc=='sitemap'):

	$path_archivo='sitemap.xml';
	if(file_exists('./'.$path_archivo)){
		$site_map='<a target="_blank" class="btn btn-primary" href="'.$page_url.$path_archivo.'">Ver Sitemap</a> | <a class="btn btn-primary" href="'.$page_url.'sitemap.php">Actualizar Sitemap</a>';
	}else{
		$site_map='<a class="btn btn-primary" href="'.$page_url.'sitemap.php">Crear Sitemap</a>';}
?>
	<div class="col-md-6"><?php echo $site_map;?></div>
<?php
	break;

	case($opc=='backup'):
	switch(true){
		case($action=='add'):
		break;
		case($action=='edit' && !empty($_GET['id'])):
		break;
		default:
		break;
	}
	break;

	case($opc=='bloquear'):
	switch(true){
		case($action=='add'):

if($_POST['Guardar']){
$ip_b=$_POST['ip'];
$bloqueo=$_POST['bloqueo'];
$alta=$_POST['alta'];
	if($ip_b == '' && $alta == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."ipbann (ip,bloqueo,alta) VALUES ('{$ip_b}','{$bloqueo}','{$alta}');") or print mysqli_error($mysqli);
	validar_aviso($save,'El ip se ha bloqueado correctamente','No se puedo bloquear la ip intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);	
	}
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar IP bloqueada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
              <div class="box-body">
                <div class="form-group">
                  <label for="ip">IP</label>
                  <input type="text" class="form-control" id="ip" name="ip" value="<?php echo $ip_b;?>">
                </div>
                <div class="form-group">
                  <label for="bloqueo">Bloqueo</label>
                  <select class="form-control" id="bloqueo" name="bloqueo">
                    <option value="0" <?php echo $sel=($bloqueo==0) ? 'selected' : '';?>>Bloquear Web</option>
                    <option value="1" <?php echo $sel=($bloqueo==1) ? 'selected' : '';?>>Bloquear Login</option>
                  </select>
                </div>
				<div class="form-group">
                  <label folr="alta">Alta</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $date;?>">
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."ipbann WHERE ID='{$id}';") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$ip_b=$reg['ip'];
$bloqueo=$reg['bloqueo'];
$alta=$reg['alta'];
}

if($_POST['Guardar']){
$ip_b=$_POST['ip'];
$bloqueo=$_POST['bloqueo'];
$alta=$_POST['alta'];
	if($ip_b == '' && $alta == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."ipbann SET ip='{$ip_b}', bloqueo='{$bloqueo}', alta='{$alta}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'El ip se ha bloqueado correctamente','No se puedo bloquear la ip intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);	
	}
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar IP bloqueada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
              <div class="box-body">
                <div class="form-group">
                  <label for="ip">IP</label>
                  <input type="text" class="form-control" id="ip" name="ip" value="<?php echo $ip_b;?>">
                </div>
                <div class="form-group">
                  <label for="bloqueo">Bloqueo</label>
                  <select class="form-control" id="bloqueo" name="bloqueo">
                    <option value="0" <?php echo $sel=($bloqueo==0) ? 'selected' : '';?>>Bloquear Web</option>
                    <option value="1" <?php echo $sel=($bloqueo==1) ? 'selected' : '';?>>Bloquear Login</option>
                  </select>
                </div>
				<div class="form-group">
                  <label folr="alta">Alta</label>
                  <input type="text" class="form-control" id="alta" name="alta" value="<?php echo $alta;?>">
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
    var r=confirm("Realmente desea eliminar la IP "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."ipbann WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
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
              <h3 class="box-title">Tabla Bloqueo de IP</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>IP</th>
                  <th>Bloqueo</th>
                  <th>Alta</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."ipbann ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td>'.$reg['ip'].'</td>
				  <td>'.$reg['bloqueo'].'</td>
				  <td>'.$reg['alta'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>IP</th>
                  <th>Bloqueo</th>
                  <th>Alta</th>
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
<?php		
		break;
	}
	break;

	case($opc=='logs'):
	switch(true){
		/*case($action=='add'):
		break;
		case($action=='edit' && !empty($_GET['id'])):
		break;*/
		default:
?>
<div class="col-xs-12">
<!--
<div style="width:100%;overflow:auto;">
	<div style="width:1400px;height:750px;">
-->
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla LOGS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" style="font-size:10px;">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Ip</th>
                  <th>Fecha</th>
                  <th>URL</th>
                  <th>Refer</th>
                  <th>Vhref</th>
                  <th>Mod</th>
                  <th>Ext</th>
                  <th>Idp</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."visitas;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){
$id=$row['ID'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td>'.$row['user'].'</td>
                  <td>'.$row['ip'].'</td>
                  <td>'.$row['fecha'].'</td>
                  <td style="font-size:9px">'.$row['page'].'</td>
                  <td style="font-size:9px">'.$row['refer'].'</td>
				  <td>'.$row['vhref'].'</td>
                  <td>'.$row['modulo'].'</td>
                  <td>'.$row['ext'].'</td>
                  <td>'.$row['idp'].'</td>
 
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Ip</th>
                  <th>Fecha</th>
                  <th>URL</th>
                  <th>Refer</th>
                  <th>Vhref</th>
                  <th>Mod</th>
                  <th>Ext</th>
                  <th>Idp</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
</div>
<!-- /.col-xs-12 -->
<?php
		break;
	}
	break;

	case($opc=='temas'):
	switch(true){
		case($action=='add'):
if($_POST['Guardar']){
$tema=$_POST['tema'];
$subtema=$_POST['sub_tema'];
$selec=$_POST['selec'];
$nivel=$_POST['nivel'];

	if($tema == ''){
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
	if($selec==1){
		mysqli_query($mysqli,"UPDATE ".$DBprefix."temas SET selec=0 WHERE tema!='{$tema}'");	
	}
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."temas (tema,subtema,selec,nivel) VALUES ('{$tema}','{$subtema}','{$selec}','{$nivel}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El tema se ha guardo correctamente','No se puedo guardar intentelo nuevament',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=temas';
	recargar(3,$URL,$target);		
	}
}
?>
	<div class="col-md-6 col-md-offset-3 col-xs-12">
    <?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Tema</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
              <div class="box-body">
				<div class="form-group">
                  <label for="tema">Nombre del Tema</label>
                  <!--input type="text" class="form-control" id="tema" name="tema"-->
                  <select class="form-control" id="tema" name="tema">
                  <?php listar_directorios_ruta('./temas/');?>
                  </select>
                </div>
				<div class="form-group">
                  <label for="sub_tema">Subtema</label>
                  <input type="text" class="form-control" id="sub_tema" name="sub_tema">
                </div> 
				<div class="form-group">
                  <label>Tema actual</label>
                  <select class="form-control" id="selec" name="selec">
                    <option value="0" selected>No</option>
                    <option value="1">Si</option>
                  </select>
                </div>
				<div class="form-group">
                  <label for="nivel">Nivel</label>
                  <input type="text" class="form-control" id="nivel" name="nivel" value="0">
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
		case($action=='activar' && !empty($_GET['id'])):
$id=$_GET['id'];

if($_POST['Activo']){	
$act1=mysqli_query($mysqli,"UPDATE ".$DBprefix."temas SET selec=1 WHERE ID='{$id}';");
$act2=mysqli_query($mysqli,"UPDATE ".$DBprefix."temas SET selec=0 WHERE ID!='{$id}';");
	if($act1){
		if($act2){
			echo '<div class="alert alert-success" role="alert" style="width:600px; margin:0px auto;">
			<h4><i class="icon fa fa-check"></i> Correcto!</h4> Se ha cambiado el Tema correctamente. 
			<a href="javascript:back();">Regresar</a>
			</div>';
			$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
			recargar(2,$URL,$target);
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Error!</h4>No activo este Tema intentelo nuevamente.
		<a href="javascript:back();">Regresar</a>
		</div>';
	}
}

		break;
		default: 
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este Tema"+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."temas WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  

<div class="col-xs-12">
<a href="<?php echo $page_url.'?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>">
<div style="font-size:20px; text-align:center; padding:2px 0;"><i class="fa fa-plus"></i></div>
</a>
<div id="title" style="text-align:center;"><b>Nuevo</b></div>
<div id="desc" class="hidden-xs" style="text-align:center;">Agregar nuevo tema</div>
</div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."temas;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){$id=$reg['ID'];$tema=$reg['tema'];$selec=$reg['selec'];
$nombre_fichero = './'.$path_t.$tema.'/images/cover.jpg';
if(file_exists($nombre_fichero)){$cover=$page_url.$path_t.$tema.'/images/cover.jpg';}else{$cover=$page_url.$path_tema.'images/nocover.jpg';}
if($selec==0){$seleccion='<span style="float:left;color:#f00;">Activo: No';
$boton='<!--button onClick="javascript:document.location.href=\''.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=activar&id='.$id.'\';">Activar</button-->
	<div style="float:left;width:60px;">
		<form name="form1" action="'.$URL.'&action=activar&id='.$id.'" method="post"><input type="submit" name="Activo" value="Activar"></form>
	</div> | ';
}else{$seleccion='<span style="float:left;color:#0f0;">Activo: Si';$boton='<button onClick="javascript:document.location.href=\''.$page_url.'index.php\';">Ver p&aacute;gina</button> | ';}
echo '
<div class="col-xs-12 col-md-3">
	<div>
		<img src="'.$cover.'" width="100%">
		<div style="width:100%; height:20px;">
			'.$seleccion.'</span>
			<span style="float:right;">
			'.$boton.'<button onClick="dtema'.$id.'()" data-toggle="modal" data-target="#myModal">Detalles</button> | <a target="_blank" href="'.$page_url.'index.php?tema_previo='.$tema.'" title="Vista Previa"><i class="fa fa-eye"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a>
			</span>
		</div>
	</div>
	<div id="title"><b>'.$tema.'</b></div>
</div>
<script>function dtema'.$id.'(){window.open("'.$page_url.$path_t.$tema.'/info.php","dt");}</script>
';
}
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalles del Tema</h4>
      </div>
      <div class="modal-body">
      	<div><iframe name="dt" frameborder="0" scrolling="auto" width="100%" height="400px" src="<?php echo $page_url.$path_tema.'info.php';?>"></iframe></div>
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
	}
	break;

	case($opc=='iconos'):
	switch(true){
		case($action=='add'):

if($_POST['Guardar']){
$nom=$_POST['nom'];
$fa_icon=$_POST['fa_icon'];
$icon=$_POST['icon'];
$tipo=$_POST['tipo'];	

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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."iconos (nom,fa_icon,icon,tipo) VALUES ('$nom','$fa_icon','$icon','$tipo');") or print mysqli_error($mysqli);
	validar_aviso($save,'El icono se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=iconos';
	recargar(3,$URL,$target);		
	}
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Icono</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="fa_icon">Icon</label>
                  <input type="text" class="form-control" id="fa_icon" name="fa_icon" value="<?php echo $fa_icon;?>">
                </div>
                <div class="form-group">
                  <label for="icon">Etiqueta</label>
                  <textarea class="form-control" id="icon" name="icon"><i class="fa"></i></textarea>
                </div>
                <div class="form-group">
                  <label for="tipo">Tipo</label>
                  <select class="form-control" id="tipo" name="tipo">
                    <option value="awesome" <?php echo $sel=($tipo=='awesome') ? 'selected' : '';?>>awesome</option>
                    <option value="bootstrap" <?php echo $sel=($tipo=='bootstrap') ? 'selected' : '';?>>bootstrap</option>
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."iconos WHERE ID={$id};") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	$id=$row['ID'];$nom=$row['nom'];$fa_icon=$row['fa_icon'];$icon=$row['icon'];$tipo=$row['tipo'];
}
if($_POST['Guardar']){
$nom=$_POST['nom'];
$fa_icon=$_POST['fa_icon'];
$icon=$_POST['icon'];
$tipo=$_POST['tipo'];	

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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."iconos SET nom='{$nom}', fa_icon='{$fa_icon}', icon='{$icon}', tipo='{$tipo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'El icono se ha guardo correctamente','No se puedo guardar intentelo nuevament',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=iconos';
	recargar(3,$URL,$target);		
	}
}
?>
	<div class="col-md-6">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Icono</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="iso-8859-1">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="fa_icon">Icon</label>
                  <input type="text" class="form-control" id="fa_icon" name="fa_icon" value="<?php echo $fa_icon;?>">
                </div>
                <div class="form-group">
                  <label for="icon">Etiqueta</label>
                  <textarea class="form-control" id="icon" name="icon"><?php echo $icon;?></textarea>
                </div>
                <div class="form-group">
                  <label for="tipo">Tipo</label>
                  <select class="form-control" id="tipo" name="tipo">
                    <option value="awesome" <?php echo $sel=($tipo=='awesome') ? 'selected' : '';?>>awesome</option>
                    <option value="bootstrap" <?php echo $sel=($tipo=='bootstrap') ? 'selected' : '';?>>bootstrap</option>
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
    var r=confirm("Realmente desea eliminar este Icono "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."iconos WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  
<div class="col-xs-12">
	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla Iconos</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Icono</th>
                  <th>Tipo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."iconos;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){
	$id=$row['ID'];$nom=$row['nom'];$fa_icon=$row['fa_icon'];$icon=$row['icon'];$tipo=$row['tipo'];
echo '
                <tr>
                  <td>'.$id.'</td>
                  <td>'.$nom.'</td>
				  <td>'.$icon.' - '.$fa_icon.'</td>
				  <td>'.$tipo.'</td>
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
                  <th>Icono</th>
                  <th>Tipo</th>
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
<?php
		break;
	}
	break;
	default:
if($_POST['Guardar']){$id=1;
$logo1=$_POST['logo'];
$page_name1=$_POST['p_name'];
$title1=$_POST['titulo'];
$dominio1=$_POST['dominio'];
$path_root1=$_POST['path_root'];
$page_url1=$_POST['page_url'];
$keywords1=$_POST['keywords'];
$description1=$_POST['description'];
$metas1=$_POST['metas'];
$google_analytics1=$_POST['analytics'];
$tel2=$_POST['tel1'];
$phone=$_POST['phone'];
$wapp=$_POST['wapp'];
$webMail1=$_POST['webmail'];
$contactMail1=$_POST['contactmail'];
$page_mode1=$_POST['page_mode'];
$chartset1=$_POST['chartset'];
$modulo_login1=$_POST['modulo_login'];
$dashboard1=$_POST['dashboard'];
$fb_web1=$_POST['fb_web'];
$tw_web1=$_POST['tw_web'];
$gp_web1=$_POST['gp_web'];
$lk_web1=$_POST['lk_web'];
$yt_web1=$_POST['yt_web'];
$ins_web1=$_POST['ins_web'];

html_iso($page_name1,$title1,$keywords1,$description1);
analytics($google_analytics1);

	if($page_name1 == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."config SET logo='{$logo1}', page_name='{$page_name1}', title='{$title1}', dominio='{$dominio1}', path_root='{$path_root1}', page_url='{$page_url1}', keyword='{$keywords1}', description='{$description1}', metas='{$metas1}', g_analytics='{$google_analytics1}', tel='{$tel2}', phone='{$phone}', wapp='{$wapp}', webMail='{$webMail1}', contactMail='{$contactMail1}', mode='{$page_mode1}', chartset='{$chartset1}', dboard='{$modulo_login1}', dboard2='{$dashboard1}', fb='{$fb_web1}', tw='{$tw_web1}', gp='{$gp_web1}', lk='{$lk_web1}', yt='{$yt_web1}', ins='{$ins_web1}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	validar_aviso($save,'Se han guardo las configuraciones correctamente','No se guardaron las configuraciones intentelo nuevamente',$aviso);
	//$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);	
	}
}

$logo=($logo!='')?$logo:'logo-onix.png';
$file='<input type="hidden" class="form-control" id="logo" name="logo" value="'.$logo.'">
<img src="'.$page_url.$path_tema.'images/'.$logo.'" style="width:150px;">
<a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>
';

if($_POST['Aceptar']){
//datos del arhivo 
$repositor=$path_tema.'images';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
        $file='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file;
    }else{ 
        if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
            $file='<input type="hidden" class="form-control" id="logo" name="logo" value="'.$nombre_archivo.'">
			<img src="'.$page_url.$path_tema.'/images/'.$nombre_archivo.'" style="width:150px;">
            <a href="javascript:up(1);">Cambiar Imagen</a><div id="upload"></div>';
        }
        else{
            $file='<span style=" font-weight:bold; color:#f00;">Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.</span><br>'.$file;
        }
    }
//unlink($URL);
}


switch(true){
 case($dboard2=='gentelella'):
?>
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Configuraci&oacute;n general.</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    <br>

        	<form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
            <div class="col-md-12"><?php echo $aviso;?></div>
            <div class="col-md-12">              
              <div class="form-group">
                <label for="logo">Logo</label>
                <?php echo $file;?>
              </div>
			</div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="p_name">Nombre de la P&aacute;gina</label>
                <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo $page_name;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $title;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="dominio">Dominio (Ejemplo: http://localhost/)</label>
                <input type="text" class="form-control" id="dominio" name="dominio" value="<?php echo $dominio;?>" placeholder="Ejemplo: dominio.com">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="path_root">Path_root (Sin '/' final)</label>
                <input type="text" class="form-control" id="path_root" name="path_root" value="<?php echo $path_root;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="page_url">Page_url (Ejemplo: http://localhost/MisSitios/)</label>
                <input type="text" class="form-control" id="page_url" name="page_url" value="<?php echo $page_url;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $keywords;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="page_mode">Page Mode</label>
                <select class="form-control" id="page_mode" name="page_mode">
					<?php page_mode($mode);?>                
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="chartset">Chartset</label>
                <select class="form-control" id="chartset" name="chartset">
                	<option value="utf-8" <?php echo $sel=($chartset=='utf-8') ? 'selected' : '';?>>UTF-8</option>
                    <option value="iso-8859-1" <?php echo $sel=($chartset=='iso-8859-1') ? 'selected' : '';?>>ISO-8859-1</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="modulo_login">Modulo_Login</label>
                <select class="form-control" id="modulo_login" name="modulo_login">
					<?php listar_directorios_ruta('./modulos/');?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="dashboard">Dashboard</label>
                <select class="form-control" id="dashboard" name="dashboard">
                	<?php echo select_dashboard('./apps/dashboards/');?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="description">Descripci&oacute;n</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="metas">Metas</label>
                <textarea class="form-control" id="metas" name="metas" style="height:110px;"><?php echo $metas;?></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="analytics">Google Analytics</label>
                <textarea class="form-control" id="analytics" name="analytics" style="height:110px;"><?php echo $google_analytics;?></textarea>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="tel1">Tel</label>
                <input type="text" class="form-control" id="tel1" name="tel1" value="<?php echo $tel1;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="wapp">Whatsapp</label>
                <input type="text" class="form-control" id="wapp" name="wapp" value="<?php echo $wapp;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="webmail">Web Mail</label>
                <input type="text" class="form-control" id="webmail" name="webmail" value="<?php echo $webMail;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="contactmail">Contact Mail</label>
                <input type="text" class="form-control" id="contactmail" name="contactmail" value="<?php echo $contactMail;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="fb_web">Facebook</label>
                <input type="text" class="form-control" id="fb_web" name="fb_web" value="<?php echo $fb_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="tw_web">Twitter</label>
                <input type="text" class="form-control" id="tw_web" name="tw_web" value="<?php echo $tw_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="gp_web">Google +</label>
                <input type="text" class="form-control" id="gp_web" name="gp_web" value="<?php echo $gp_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="lk_web">LinkedIn</label>
                <input type="text" class="form-control" id="lk_web" name="lk_web" value="<?php echo $lk_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="yt_web">Youtube</label>
                <input type="text" class="form-control" id="yt_web" name="yt_web" value="<?php echo $yt_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="ins_web">Instagram</label>
                <input type="text" class="form-control" id="ins_web" name="ins_web" value="<?php echo $ins_web;?>">
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

                  </div>
                </div>                
              </div>
<?php
 break;
 case($dboard2=='AdminLTE'):
?>
	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Configuraci&oacute;n general.</h3>

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
                <label for="logo">Logo</label>
                <?php echo $file;?>
              </div>
			</div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="p_name">Nombre de la P&aacute;gina</label>
                <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo $page_name;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $title;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="dominio">Dominio (Ejemplo: http://localhost/)</label>
                <input type="text" class="form-control" id="dominio" name="dominio" value="<?php echo $dominio;?>" placeholder="Ejemplo: dominio.com">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="path_root">Path_root (Sin '/' final)</label>
                <input type="text" class="form-control" id="path_root" name="path_root" value="<?php echo $path_root;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="page_url">Page_url (Ejemplo: http://localhost/MisSitios/)</label>
                <input type="text" class="form-control" id="page_url" name="page_url" value="<?php echo $page_url;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $keywords;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="page_mode">Page Mode</label>
                <select class="form-control" id="page_mode" name="page_mode">
					<?php page_mode($mode);?>                
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="chartset">Chartset</label>
                <select class="form-control" id="chartset" name="chartset">
                	<option value="utf-8" <?php echo $sel=($chartset=='utf-8') ? 'selected' : '';?>>UTF-8</option>
                    <option value="iso-8859-1" <?php echo $sel=($chartset=='iso-8859-1') ? 'selected' : '';?>>ISO-8859-1</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="modulo_login">Modulo_Login</label>
                <select class="form-control" id="modulo_login" name="modulo_login">
					<?php listar_directorios_ruta('./modulos/');?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="dashboard">Dashboard</label>
                <select class="form-control" id="dashboard" name="dashboard">
                	<?php echo select_dashboard('./apps/dashboards/');?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="description">Descripci&oacute;n</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="metas">Metas</label>
                <textarea class="form-control" id="metas" name="metas" style="height:110px;"><?php echo $metas;?></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="analytics">Google Analytics</label>
                <textarea class="form-control" id="analytics" name="analytics" style="height:110px;"><?php echo $google_analytics;?></textarea>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="tel1">Tel</label>
                <input type="text" class="form-control" id="tel1" name="tel1" value="<?php echo $tel1;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="wapp">Whatsapp</label>
                <input type="text" class="form-control" id="wapp" name="wapp" value="<?php echo $wapp;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="webmail">Web Mail</label>
                <input type="text" class="form-control" id="webmail" name="webmail" value="<?php echo $webMail;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="contactmail">Contact Mail</label>
                <input type="text" class="form-control" id="contactmail" name="contactmail" value="<?php echo $contactMail;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="fb_web">Facebook</label>
                <input type="text" class="form-control" id="fb_web" name="fb_web" value="<?php echo $fb_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="tw_web">Twitter</label>
                <input type="text" class="form-control" id="tw_web" name="tw_web" value="<?php echo $tw_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="gp_web">Google +</label>
                <input type="text" class="form-control" id="gp_web" name="gp_web" value="<?php echo $gp_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="lk_web">LinkedIn</label>
                <input type="text" class="form-control" id="lk_web" name="lk_web" value="<?php echo $lk_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="yt_web">Youtube</label>
                <input type="text" class="form-control" id="yt_web" name="yt_web" value="<?php echo $yt_web;?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="ins_web">Instagram</label>
                <input type="text" class="form-control" id="ins_web" name="ins_web" value="<?php echo $ins_web;?>">
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
 }
	break;
}
?>
            <div class="col-md-12" style="padding:20px 0 15px 0; text-align:right;">VERSION SYS 3.2.7-25.05.2020</div>            			

	</div>
	<!-- /.row -->
    </section>
    <!-- /.content -->
<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>