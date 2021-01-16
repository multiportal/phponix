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
 		<?php panel_menu();?>
	</div>
    <!-- /.row-->
	<div class="row">

<?php 
switch(true){
	case($opc=='forms'):
	editor_tiny_mce();

switch(true){
	case($action=='add'):
if($_POST['Guardar']){
$seccion=$_POST['seccion'];
$modulo=$_POST['modulo'];
$email=$_POST['email'];
$bcc=$_POST['bcc'];
$CoE=$_POST['CoE'];
$CoP=$_POST['CoP'];
$usuario=$_POST['usuario'];
$url_m=$_POST['url_m'];
$fecha=$_POST['fecha'];
$activo=$_POST['activo'];

	if($seccion == '' && $modulo == ''){
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
	$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto_forms (seccion,modulo,email,bcc,CoE,CoP,usuario,url_m,fecha,activo) VALUES ('{$seccion}','{$modulo}','{$email}','{$bcc}','{$CoE}','{$CoP}','{$usuario}','{$url_m}','{$fecha}','{$activo}')") or print mysqli_error($mysqli);
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=forms';
	recargar(3,$URL,$target);
	}
}
?>
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
                  <label for="seccion">Seccion</label>
                  <input type="text" class="form-control" id="seccion" name="seccion" value="<?php echo $seccion;?>">
                </div>
                <div class="form-group">
                  <label for="modulo">Modulo</label>
                  <select class="form-control" id="modulo" name="modulo">
                  <option value="">Elije un Modulo</option>
                  <?php select_modulos($modulo,0);?>                  
                  </select>
                </div>
                <div class="form-group">
                  <label for="email">Correo Recepci&oacute;n (CoR)</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>">
                </div>
                <div class="form-group">
                  <label for="CoP">Correo Prueba (CoP)</label>
                  <input type="text" class="form-control" id="CoP" name="CoP" value="<?php echo $CoP;?>">
                </div>
                <div class="form-group">
                  <label for="bcc">BCC</label>
                  <input type="text" class="form-control" id="bcc" name="bcc" value="<?php echo $bcc;?>">
                </div>
                <div class="form-group">
                  <label for="CoE">Correo Envio (CoE)</label>
                  <input type="text" class="form-control" id="CoE" name="CoE" value="<?php echo $CoE;?>">
                </div>
                <div class="form-group">
                  <label for="usuario">Usuarios</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>">
                </div>
                <div class="form-group">
                  <label for="url_m">URL</label>
                  <input type="text" class="form-control" id="url_m" name="url_m" value="<?php echo $url_m;?>">
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel=($activo=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($activo=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
               	<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $date;?>">

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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."contacto_forms WHERE ID='{$id}';") or print mysqli_error($mysqli); 
if($reg=mysqli_fetch_array($sql)){
$seccion=$reg['seccion'];
$modulo=$reg['modulo'];
$email=$reg['email'];
$bcc=$reg['bcc'];
$CoE=$reg['CoE'];
$CoP=$reg['CoP'];
$usuario=$reg['usuario'];
$url_m=$reg['url_m'];
$fecha=$reg['fecha'];
$activo=$reg['activo'];
}

if($_POST['Guardar']){
$seccion=$_POST['seccion'];
$modulo=$_POST['modulo'];
$email=$_POST['email'];
$bcc=$_POST['bcc'];
$CoE=$_POST['CoE'];
$CoP=$_POST['CoP'];
$usuario=$_POST['usuario'];
$url_m=$_POST['url_m'];
$fecha=$_POST['fecha'];
$activo=$_POST['activo'];

	if($seccion == '' && $modulo == ''){
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
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."contacto_forms SET seccion='{$seccion}', modulo='{$modulo}', email='{$email}', bcc='{$bcc}', CoE='{$CoE}', CoP='{$CoP}', usuario='{$usuario}', url_m='{$url_m}', fecha='{$fecha}', activo='{$activo}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'El modulo se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=forms';
	recargar(3,$URL,$target);
	}
}
?>
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
                  <label for="seccion">Seccion</label>
                  <input type="text" class="form-control" id="seccion" name="seccion" value="<?php echo $seccion;?>">
                </div>
                <div class="form-group">
                  <label for="modulo">Modulo</label>
                  <select class="form-control" id="modulo" name="modulo">
                  <option value="">Elije un Modulo</option>
                  <?php select_modulos($modulo,0);?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="email">Correo Recepci&oacute;n (CoR)</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>">
                </div>
                <div class="form-group">
                  <label for="CoP">Correo Prueba (CoP)</label>
                  <input type="text" class="form-control" id="CoP" name="CoP" value="<?php echo $CoP;?>">
                </div>
                <div class="form-group">
                  <label for="bcc">BCC</label>
                  <input type="text" class="form-control" id="bcc" name="bcc" value="<?php echo $bcc;?>">
                </div>
                <div class="form-group">
                  <label for="CoE">Correo Envio (CoE)</label>
                  <input type="text" class="form-control" id="CoE" name="CoE" value="<?php echo $CoE;?>">
                </div>
                <div class="form-group">
                  <label for="usuario">Usuarios</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>">
                </div>
                <div class="form-group">
                  <label for="url_m">URL</label>
                  <input type="text" class="form-control" id="url_m" name="url_m" value="<?php echo $url_m;?>">
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <select class="form-control" id="activo" name="activo">
                    <option value="0" <?php echo $sel=($activo=='0') ? 'selected' : '';?>>No</option>
                    <option value="1" <?php echo $sel=($activo=='1') ? 'selected' : '';?>>Si</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
               	<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>">

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
    var r=confirm("Realmente desea eliminar este Registro "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"DELETE FROM ".$DBprefix."contacto_forms WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=forms';
	recargar(3,$URL,$target);
}
?>
	<div class="col-xs-12">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla Modulos</h3>
			  <span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=forms&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Seccion</th>
                  <th>Modulo</th>
                  <th>CoR</th>
                  <th>BCC</th>
                  <th>CoE</th>
                  <th>CoP</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."contacto_forms ORDER BY ID ASC;") or print mysqli_error($mysqli); 
while($reg=mysqli_fetch_array($sql)){
$id=$reg['ID'];
echo '
                <tr>
                  <td>'.$id.'</td>
				  <td>'.$reg['seccion'].'</td>
				  <td>'.$reg['modulo'].'</td>
				  <td>'.$reg['email'].'</td>
				  <td>'.$reg['bcc'].'</td>
				  <td>'.$reg['CoE'].'</td>
				  <td>'.$reg['CoP'].'</td>
				  <td>'.$reg['activo'].'</td>
				  <td><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=forms&action=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
';
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Seccion</th>
                  <th>Modulo</th>
                  <th>CoR</th>
                  <th>BCC</th>
                  <th>CoE</th>
                  <th>CoP</th>
                  <th>Activo</th>
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

if(isset($_POST['Guardar'])){
$direc=htmlentities($_POST['direc'], ENT_COMPAT,'ISO-8859-1', true);
//$webMail=$_POST['webMail'];
$contactMail=$_POST['contactMail'];
$tel1=$_POST['tel'];

$CoR=$_POST['CoR'];
$CoE=$_POST['CoE'];
$BCC=$_POST['BCC'];
$CoP=$_POST['CoP'];

	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."config SET direc='{$direc}', contactMail='{$contactMail}', CoR='{$CoR}', CoE='{$CoE}', BCC='{$BCC}', CoP='{$CoP}', tel='{$tel1}' WHERE ID=1;") or print mysqli_error($mysqli);
	//validar_aviso($save,'mensaje_bien','mensaje_mal',&$aviso)
	validar_aviso($save,'Se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	//$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc;
	recargar(3,$URL,$target);
}
?>
<div class="col-md-10 col-md-offset-1 col-xs-12">
	<div><?php echo $aviso;?></div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#config" data-toggle="tab">Configuraciones</a></li>
              <li><a href="#form" data-toggle="tab">Avanzado</a></li>
              <!--li><a href="#settings" data-toggle="tab">Settings</a></li-->
            </ul>
            <div class="tab-content">

			  <div class="active tab-pane" id="config">
                <form name="form1" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
                  <div class="form-group">
                    <label for="direc" class="col-sm-2 control-label">Direcci&oacute;n</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="direc" name="direc" value="<?php echo $direc;?>" placeholder="Direccion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="webMail" class="col-sm-2 control-label">Web Mail</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="webMail" name="webMail" value="<?php echo $webMail;?>" disabled placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactMail" class="col-sm-2 control-label">Contact Mail</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="contactMail" name="contactMail" value="<?php echo $contactMail;?>" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel1;?>" placeholder="Telefono">
                    </div>
                  </div>
				<hr>
                  <div class="form-group">
                    <label for="CoR" class="col-sm-2 control-label">CoR</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="CoR" name="CoR" value="<?php echo $CoR;?>" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="CoE" class="col-sm-2 control-label">CoE</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="CoE" name="CoE" value="<?php echo $CoE;?>" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="BCC" class="col-sm-2 control-label">BCC</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="BCC" name="BCC" value="<?php echo $BCC;?>" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="CoP" class="col-sm-2 control-label">CoP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="CoP" name="CoP" value="<?php echo $CoP;?>" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="Guardar" id="Guardar" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="form">
                <form name="form1" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $URL;?>" accept-charset="<?php echo $chartset;?>">
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Nombre
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Email
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Tel
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Asunto
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Mensaje
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Domicilio (Direcci&oacute;n)
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              </div>
              <!-- /.tab-pane -->

              </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

<?php	
	break;
}
?>
		</div><!-- /.row-->
    </section><!-- /.content -->
<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>