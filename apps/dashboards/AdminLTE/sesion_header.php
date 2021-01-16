<?php 
if(isset($_SESSION["username"])){
  sql_opciones('AJAX',$val_ajax);
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $page_url;?>index.php?mod=dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">
                <?php 
                if($val_ajax==1){ 
                  compact_ajax('num_email1','num_email1','apps/dashboards/notificaciones.php?opc=num_email&activo=0',2,0);
                }else{
                  mensajes_recibidos();
                }?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ud. tiene 
                <?php 
                if($val_ajax==1){
                  compact_ajax('num_email2','num_email2','apps/dashboards/notificaciones.php?opc=num_email&activo=0',2,0);
                }else{
                  mensajes_recibidos();
                }?> mensajes nuevos</li>
              <li>
                <!-- inner menu: contains the actual data -->
               <!--ul class="menu"-->
                  <!-- start message -->
                  <?php 
                  if($val_ajax==1){
                    //compact_ajax('reg_email','reg_email','apps/dashboards/notificaciones.php?opc=reg_email&activo=0',2,0);
                    compact_ajax_msj('reg_email','<ul id="reg_email" class="menu"></ul>','apps/dashboards/notificaciones.php?opc=reg_email&activo=0',2,0);
                  }else{num_email($num_email,$msj_email,$ID_e);
                    echo '<ul class="menu">'.$msj_email.'</ul>';
                  }
                  ?>
                  <!-- end message -->
                <!--/ul-->
              </li>
              <li class="footer"><a href="<?php echo $page_url.'index.php?mod=mailbox';?>">Ver todos los mensajes</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">
                <?php 
                if($val_ajax==1){
                  compact_ajax('num_noti','num_noti','apps/dashboards/notificaciones.php?opc=num_noti&activo=0',2,0);
                }else{num_noti($num_noti,$msj_noti,$ID_n);
                  echo $num_noti;
                }?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 
                <?php
                if($val_ajax==1){ 
                  compact_ajax('num_noti1','num_noti1','apps/dashboards/notificaciones.php?opc=num_noti&activo=0',2,0);
                }else{  
                  echo $num_noti;
                }?> nuevas notificaci&oacute;nes</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  if($val_ajax==1){ 
                    compact_ajax('reg_noti','reg_noti','apps/dashboards/notificaciones.php?opc=reg_noti&activo=0',2,0);
                  }else{num_noti($num_noti,$msj_noti,$ID_n);
                    echo '<!--ID:'.$ID_n.'-->
                    <li><a href="#" class="text-black"><i class="fa fa-users text-aqua"></i> '.$msj_noti.'</a></li>';
                  }?>
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todas las notificaciones</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">
              	<?php 
                if($val_ajax==1){
                  compact_ajax('num_tareas','num_tareas','apps/dashboards/notificaciones.php?opc=num_tareas&activo=0',2,0);
                }else{num_tareas($num_tareas,$nom_tarea,$ID_t);
                  echo $num_tareas;
                }?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tu tienes 
                <?php 
                if($val_ajax==1){
                  compact_ajax('num_tareas1','num_tareas1','apps/dashboards/notificaciones.php?opc=num_tareas&activo=0',2,0);
                }else{
                  echo $num_tareas;
                }?>
              tareas</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php                   
                  if($val_ajax==1){
                    compact_ajax('reg_tareas','reg_tareas','apps/dashboards/notificaciones.php?opc=reg_tareas&activo=0',2,0);
                  }else{num_tareas($num_tareas,$nom_tarea,$ID_t);
                    echo '<!--ID:'.$ID_t.'-->
                    <li><a href="#" class="text-black"><i class="fa fa-flag text-aqua"></i> '.$nom_tarea.'</a></li>';
                  }?>
                </ul>
              </li>
              <li class="footer">
                <a href="#">Ver todas las tareas</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $page_url.'modulos/usuarios/fotos/'.$foto_login;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $username;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $page_url.'modulos/usuarios/fotos/'.$foto_login;?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nombre_login.' '.$apaterno_login;?> - <?php echo $_SESSION["puesto"];?>
                  <small>Miembro desde <?php echo $alta_login;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!--a href="#">Followers</a-->
                    ID: <?php echo $ID_login;?>
                  </div>
                  <div class="col-xs-4 text-center">
                    <!--a href="#">Sales</a-->
                  </div>
                  <div class="col-xs-4 text-center">
                  	Nivel: <?php echo $nivel_login;?>
                    <!--a href="#">Friends</a-->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $page_url.'index.php';?>?mod=usuarios&ext=perfil_sesion" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div style="float:left;width:100px;margin:0 22px;">
                  &nbsp;<a target="_blank" href="<?php echo $page_url.'index.php';?>" class="btn btn-default btn-flat">Ver P&aacute;gina</a>&nbsp;
                </div>
                <div class="pull-right">
                  <a href="<?php echo logout($ID_login);?>" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <?php if($nivel_login==-1){?>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          <?php }?>
          <li>
          	<a href="<?php echo logout($ID_login);?>" title="Salir"><i class="fa fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<?php 
}
?>