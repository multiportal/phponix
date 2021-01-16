<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
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
	<div class="row">
<?php 
switch(true){
	case($action=='add'):
if($_POST['Guardar']){
$nom=$_POST['nom'];
$modulo=$_POST['modulo'];
$des=$_POST['des'];
$nivel=$_POST['nivel'];
$home=$_POST['home'];
$activo=$_POST['activo'];
$sname=$_POST['sname'];
$icono=$_POST['icono'];
$link=$_POST['link'];
$visible=$_POST['visible'];
	if($nom == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."modulos (nombre,modulo,description,nivel,home,activo,sname,icono,link,visible) VALUES ('{$nom}','{$modulo}','{$des}','{$nivel}','{$home}','{$activo}','{$sname}','{$icono}','{$link}','{$visible}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
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
              <h3 class="box-title">Agregar Nuevo Modulo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="modulo">Modulo</label>
                  <select class="form-control" id="modulo" name="modulo">
                  <option value="">Elije un Modulo</option>
                  <?php listar_directorios_ruta('./modulos/');?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <input type="text" class="form-control" id="des" name="des" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="link">Link</label>
                  <input type="text" class="form-control" id="link" name="link" value="index.php?mod=">
                </div>
                <div class="form-group">
                  <label for="icono">Icono</label>
                  <select class="form-control selectpicker" id="icono" name="icono">
                  <option value="">Elije una Icono</option>
<?php
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."iconos;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){
	echo '<option value="'.$row['fa_icon'].'" data-content="<i class=\'fa '.$row['fa_icon'].'\'></i> '.$row['nom'].'" '.$sel.'></option>';
}
?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nivel">Nivel</label>
                  <select class="form-control" id="nivel" name="nivel">
                  	<option value="-1" <?php echo $sel=($nivel==-1) ? 'selected' : '';?>>Administrador</option>
                    <option value="0" <?php echo $sel=($nivel==0) ? 'selected' : '';?>>Todos</option>
                    <option value="1" <?php echo $sel=($nivel==1) ? 'selected' : '';?>>Usuario</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="home">Home</label>
                  <select class="form-control" id="home" name="home">
                    <option value="0" <?php echo $sel=($home==0) ? 'selected' : '';?>>0</option>
                    <option value="1" <?php echo $sel=($home==1) ? 'selected' : '';?>>1</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sname">Mostrar Nombre de Modulo</label>
                  <select class="form-control" id="sname" name="sname">
                    <option value="false" <?php echo $sel=($sname=='false') ? 'selected' : '';?>>No</option>
                    <option value="true" <?php echo $sel=($sname=='true') ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
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

$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$nom=$reg['nombre'];
$modulo = $reg['modulo'];
$des=$reg['description'];
$nivel=$reg['nivel'];
$home=$reg['home'];
$activo=$reg['activo'];
$sname=$reg['sname'];
$icono=$reg['icono'];
$link=$reg['link'];
$visible=$reg['visible'];
}

if($_POST['Guardar']){
$nom=$_POST['nom'];
$modulo=$_POST['modulo'];
$des=$_POST['des'];
$nivel=$_POST['nivel'];
$home=$_POST['home'];
$activo=$_POST['activo'];
$sname=$_POST['sname'];
$icono=$_POST['icono'];
$link=$_POST['link'];
$visible=$_POST['visible'];
	if($nom == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."modulos SET nombre='{$nom}', modulo='{$modulo}', description='{$des}', nivel='{$nivel}', home='{$home}', activo='{$activo}', sname='{$sname}', icono='{$icono}', link='{$link}', visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
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
              <h3 class="box-title">Editar Modulo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="form-group">
                  <label for="modulo">Modulo</label>
                  <!--input type="text" class="form-control" id="modulo" name="modulo" value="<?php echo $modulo;?>"-->
                  <select class="form-control" id="modulo" name="modulo">
                  <option value="">Elije una Modulo</option>
                  <?php listar_directorios_ruta('./modulos/');?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="des">Descripci&oacute;n</label>
                  <input type="text" class="form-control" id="des" name="des" value="<?php echo $des;?>">
                </div>
                <div class="form-group">
                  <label for="link">Link</label>
                  <input type="text" class="form-control" id="link" name="link" value="<?php echo $link;?>">
                </div>
                <div class="form-group">
                  <label for="icono">Icono</label>
                  <select class="form-control selectpicker" id="icono" name="icono">
                  <option value="">Elije una Icono</option>
<?php
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."iconos;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){
	$sel=($row['fa_icon']==$icono)?'selected':'';
	echo '<option value="'.$row['fa_icon'].'" data-content="<i class=\'fa '.$row['fa_icon'].'\'></i> '.$row['nom'].'" '.$sel.'></option>';
}
?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nivel">Nivel</label>
                  <select class="form-control" id="nivel" name="nivel">
                  	<option value="-1" <?php echo $sel=($nivel==-1) ? 'selected' : '';?>>Administrador</option>
                    <option value="0" <?php echo $sel=($nivel==0) ? 'selected' : '';?>>Todos</option>
                    <option value="1" <?php echo $sel=($nivel==1) ? 'selected' : '';?>>Usuario</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="home">Home</label>
                  <select class="form-control" id="home" name="home">
                    <option value="0" <?php echo $sel=($home==0) ? 'selected' : '';?>>0</option>
                    <option value="1" <?php echo $sel=($home==1) ? 'selected' : '';?>>1</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sname">Mostrar Nombre de Modulo</label>
                  <select class="form-control" id="sname" name="sname">
                    <option value="false" <?php echo $sel=($sname=='false') ? 'selected' : '';?>>No</option>
                    <option value="true" <?php echo $sel=($sname=='true') ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $sel=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($visible==1) ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
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
	default://modulos
?>
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este Modulo "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."modulos WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
}
?>
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
                  <th>Nombre</th>
                  <th>Modulo</th>
                  <th>Nivel</th>
                  <th>Home</th>
                  <th>Visible</th>
                  <th>Activo</th>
                  <th>sname</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$reg['ID'].'</td>
                  <td>'.$reg['nombre'].'</td>
				  <td>'.$reg['modulo'].'</td>
				  <td>'.$reg['nivel'].'</td>
				  <td>'.$reg['home'].'</td>
				  <td>'.$reg['visible'].'</td>
				  <td>'.$reg['activo'].'</td>
				  <td>'.$reg['sname'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Modulo</th>
                  <th>Nivel</th>
                  <th>Home</th>
                  <th>Visible</th>
                  <th>Activo</th>
                  <th>sname</th>
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
	break;//modulos
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