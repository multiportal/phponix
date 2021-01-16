<?php 
if(isset($_SESSION["username"]) && ($_SESSION["level"]==-1 || $_SESSION["level"]==1)){
 //$path_LTE='assets/plugins/AdminLTE/';

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

<?php 
switch(true){
	case ($_GET["opc"]=='edit'):

	break;
	default:
?>

<div class="row">
<div class="col-xs-12">

	 	  <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $page_url.'modulos/usuarios/fotos/'.$foto_login;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $username;?></h3>

              <p class="text-muted text-center"><?php echo $puesto_login;?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Nombre</b> <a class="pull-right"><?php echo $nombre_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Apellido  Paterno</b> <a class="pull-right"><?php echo $apaterno_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Apellido Materno</b> <a class="pull-right"><?php echo $amaterno_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Password</b> <a class="pull-right"><?php echo $password;?></a>
                </li>
                <li class="list-group-item">
                  <b>Nivel</b> <a class="pull-right"><?php echo $nivel_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $email_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Genero</b> <a class="pull-right"><?php echo $genero=($genero_login=='M')?'Masculino':'Femenino';?></a>
                </li>
                <li class="list-group-item">
                  <b>Fecha de Nacimiento</b> <a class="pull-right"><?php echo $fnac_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Empresa</b> <a class="pull-right"><?php echo $empresa_login;?></a>
                </li>
                <li class="list-group-item">
                  <b>Departamento</b> <a class="pull-right"><?php echo $depa_login;?></a>
                </li>
              </ul>

              <a href="<?php echo $page_url.'index.php?mod=usuarios&ext=admin/index&action=edit&id='.$ID_login;?>" class="btn btn-primary"><b>Editar</b></a>
            </div>
            <!-- /.box-body -->
          </div>


</div>
<!-- /.col-xs-12 -->
</div><!--div row-->
<?php 
break;
}
?>
    </section>
    <!-- /.content -->
 
<?php
	//}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>