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
$nom_menu=$_POST['nom_menu'];
$icono=$_POST['icono'];
$link=$_POST['link'];
$nivel=$_POST['nivel'];
$ID_adm=$_POST['ID_menu_adm'];
$ID_mod=$_POST['ID_mod'];
$visible=$_POST['visible'];
	if($nom_menu == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."menu_admin (nom_menu,icono,link,nivel,ID_menu_adm,ID_mod,visible) VALUES ('{$nom_menu}','{$icono}','{$link}','{$nivel}','{$ID_adm}','{$ID_mod}','{$visible}')") or print mysqli_error($mysqli);
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
              <h3 class="box-title">Agregar Menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom_menu">Nombre Menu</label>
                  <input type="text" class="form-control" id="nom_menu" name="nom_menu" value="<?php echo $nom_menu;?>">
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
                  <label for="link">Link</label>
                  <input type="text" class="form-control" id="link" name="link" value="<?php echo $link;?>">
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
                  <label for="ID_menu_adm">ID_adm</label>
				  <?php sel_menu_adm();?>
                </div>
                <div class="form-group">
                  <label for="ID_mod">ID_mod</label>
                  <?php sel_menu_mod();?>
                  </select>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$nom_menu=$reg['nom_menu'];
$icono=$reg['icono'];
$link=$reg['link'];
$nivel=$reg['nivel'];
$ID_adm=$reg['ID_menu_adm'];
$ID_mod=$reg['ID_mod'];
$visible=$reg['visible'];
}

if($_POST['Guardar']){
$nom_menu=$_POST['nom_menu'];
$icono=$_POST['icono'];
$link=$_POST['link'];
$nivel=$_POST['nivel'];
$ID_adm=$_POST['ID_menu_adm'];
$ID_mod=$_POST['ID_mod'];
$visible=$_POST['visible'];
	if($nom_menu == '' && $visible == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."menu_admin SET nom_menu='{$nom_menu}',icono='{$icono}',link='{$link}',nivel='{$nivel}',ID_menu_adm='{$ID_adm}',ID_mod='{$ID_mod}',visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
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
              <h3 class="box-title">Editar Menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form name="form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nom_menu">Nombre Menu</label>
                  <input type="text" class="form-control" id="nom_menu" name="nom_menu" value="<?php echo $nom_menu;?>">
                </div>
                <div class="form-group">
                  <label for="icono">Icono</label>
                  <select class="form-control selectpicker" id="icono" name="icono">
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
                  <label for="link">Link</label>
                  <input type="text" class="form-control" id="link" name="link" value="<?php echo $link;?>">
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
                  <label for="ID_menu_adm">ID_adm</label>
				  <?php sel_menu_adm();?>
                </div>
                <div class="form-group">
                  <label for="ID_mod">ID_mod</label>
                  <?php sel_menu_mod();?>
                  </select>
                </div>
				<div class="form-group">
                  <label>Visible</label>
                  <select class="form-control" id="visible" name="visible">
                    <option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
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
    var r=confirm("Realmente desea eliminar el Menu "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."menu_admin WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
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
              <h3 class="box-title">Tabla Menu Admin</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Menu</th>
                  <th>link</th>
                  <th>Nivel</th>
                  <th>ID_adm</th>
                  <th>ID_mod</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$reg['ID'].'</td>
                  <td>'.$reg['nom_menu'].'</td>
				  <td>'.$reg['link'].'</td>
				  <td>'.$reg['nivel'].'</td>
				  <td>'.$reg['ID_menu_adm'].'</td>
				  <td>'.$reg['ID_mod'].'</td>
				  <td>'.$reg['visible'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Menu</th>
                  <th>link</th>
                  <th>Nivel</th>
                  <th>ID_adm</th>
                  <th>ID_mod</th>
                  <th>Visible</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
<?php
	break;//modulos
}
?>
	</div>
	<!-- /.row -->
    </section>
    <!-- /.content -->

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>