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
	case($action=='add'):
editor_tiny_mce();
if($_POST['Guardar']){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."pages (titulo,contenido,activo) VALUES ('{$titulo}','{$contenido}','{$activo}');") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El contenido del Nosotros se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}
?>
	<div class="col-md-12">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Nosotros Contenido</h3>
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
$activo=$reg['activo'];
}
if($_POST['Guardar']){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."pages SET titulo='{$titulo}', contenido='{$contenido}', activo='{$activo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El contenido del Nosotros se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}
?>
	<div class="col-md-12">
    	<?php echo $aviso;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Nosotros Contenido</h3>
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
<div class="col-xs-12">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">Tabla <?php echo $mod;?></h3>
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."pages;") or print mysqli_error($mysqli); 
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
		</div><!-- /.box -->
        
	</div><!-- /.col -->
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