<?php 
if(isset($_SESSION["username"])){
  if($_SESSION["level"]>=-1 && $_SESSION["level"]<=5){
include 'admin/functions.php';
sql_opciones('AJAX',$val_ajax);
switch(true){
  case($dboard2=='Nifty'):
    echo '<h1>Nifty</h1>';
  break;
	case($dboard2=='gentelella'):
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Gestor de contenido web.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $page_url.'index.php?mod=dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>


            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-bar-chart"></i></div>
                  <div class="count">
                  <?php 
                  if($val_ajax==1){ 
                    compact_ajax('num_visitas','num_visitas','apps/dashboards/notificaciones.php?opc=num_visitas&activo=0',2,0);
                  }else{visitas_hoy();
                  }?>
                  </div>
                  <h3>Visitas Hoy</h3>
                  <p><a href="<?php echo $page_url;?>index.php?mod=estadisticas">Ver m&aacute;s</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-envelope"></i></div>
                  <div class="count">
              <?php 
              if($val_ajax==1){
                compact_ajax('num_email3','num_email3','apps/dashboards/notificaciones.php?opc=num_email&activo=0',2,0); 
              }else{
                mensajes_recibidos();
              }?> 
                  </div>
                  <h3>Mensajes</h3>
                  <p><a href="<?php echo $page_url;?>index.php?mod=mailbox">Ver m&aacute;s</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">
              <?php
              if($val_ajax==1){
                compact_ajax('num_blog','num_blog','apps/dashboards/notificaciones.php?opc=num_blog&activo=0',2,0);
              }else{
                num_blog();
              }?>                  </div>
                  <h3>Blog</h3>
                  <p><a href="<?php echo $page_url;?>index.php?mod=blog">Ver m&aacute;s</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-calendar"></i></div>
                  <div class="count"><?php echo $fecha;?></div>
                  <h3>Fecha</h3>
                  <p><a href="#">Ver m&aacute;s</a></p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Accesos <small>R&aacute;pidos</small></h2>
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
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <ul class="quick-list">
                        <li><div id="tit-lr"><i class="fa fa-sticky-note-o"></i><a href="<?php echo $page_url;?>index.php?mod=sys&ext=admin/index&opc=temas">Temas</a></div>Tema actual para la p&aacute;gina web: <strong><?php echo $tema;?></strong></li>
                        <li><div id="tit-lr"><i class="fa fa-cog"></i><a href="<?php echo $page_url;?>index.php?mod=sys&ext=admin/index">Configuraci&oacute;n General</a></div>Configuraci&oacute;n y administraci&oacute;n del sistema.</li>
                        <li><div id="tit-lr"><i class="fa fa-user"></i><a href="<?php echo $page_url;?>index.php?mod=usuarios&ext=admin/index">Usuarios</a></div>Administaci&oacute;n y gesti&oacute;n de usuarios.</li>
                        <li><div id="tit-lr"><i class="fa fa-cubes"></i><a href="<?php echo $page_url;?>index.php?mod=sys&ext=modulos">Modulos</a></div>Configuraci&oacute;n y administraci&oacute;n de Modulos del sistema.</li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>

		<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Notificaciones Chat</h3>

              <div class="box-tools pull-right">
                <!--
                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header ->
            <div class="box-body" style="display: block;">
              <!-- Conversations are loaded here ->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left ->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">Admin</span>
                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                  </div>
                  <!-- /.direct-chat-info ->
                  <img class="direct-chat-img" src="<?php echo $page_url;?>modulos/usuarios/fotos/sinfoto.png" alt="Message User Image">
                  <!-- /.direct-chat-img ->
                  <div class="direct-chat-text">
                    Is this template really for free? That's unbelievable!
                  </div>
                  <!-- /.direct-chat-text ->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message to the right ->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                  </div>
                  <!-- /.direct-chat-info ->
                  <img class="direct-chat-img" src="<?php echo $page_url;?>modulos/usuarios/fotos/sinfoto.png" alt="Message User Image">
                  <!-- /.direct-chat-img ->
                  <div class="direct-chat-text">
                    You better believe it!
                  </div>
                  <!-- /.direct-chat-text ->
                </div>
                <!-- /.direct-chat-msg ->
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here ->
              <div class="direct-chat-contacts">
                <ul class="contacts-list">
                  <li>
                    <a href="#">
                      <img class="contacts-list-img" src="<?php echo $page_url;?>modulos/usuarios/fotos/sinfoto.png" alt="User Image">

                      <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                        <span class="contacts-list-msg">How have you been? I was...</span>
                      </div>
                      <!-- /.contacts-list-info ->
                    </a>
                  </li>
                  <!-- End Contact Item ->
                </ul>
                <!-- /.contatcts-list ->
              </div>
              <!-- /.direct-chat-pane ->
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="display: block;">
              <form action="" method="post">
                <div class="input-group">
                  <input type="text" id="mensaje" name="mensaje" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                      	<input type="hidden" id="nombre" name="nombre" value="<?php echo $username;?>">
                        <input type="hidden" id="enviar" name="enviar" value="ok">
                        <!--button type="submit" class="btn btn-primary btn-flat">Send</button-->
                        <input type="submit" class="btn btn-primary btn-flat" value="Enviar">
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
		</div><!--/col-->


<!--Bar Chart->              
              <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
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
                  <!--div class="x_content"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                    <canvas id="lineChart" width="481" height="240" style="width: 481px; height: 240px;"></canvas>
                  </div->

                  <div class="x_content">

                    <canvas id="lineChart" width="481" height="240" style="width: 481px; height: 240px;"></canvas>

                  </div>

                </div>
              </div>
<!--/Bar Chart-->
			</div>              
<?php
	break;
	case($dboard2=='AdminLTE'):
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Gestor de contenido web.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $page_url.'index.php?mod=dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">

		<div class="col-md-4 col-md-offset-1 col-xs-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?php echo $page_url.$path_dashboard;?>dist/img/photo1.png') center center;">
              <h3 class="widget-user-username"><?php echo $_SESSION["nombre"].' '.$_SESSION["apaterno"];?></h3>
              <h5 class="widget-user-desc"><?php echo $puesto_login;?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo $page_url.'modulos/usuarios/fotos/'.$foto_login;?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $nivel_login;?></h5>
                    <span class="description-text">Nivel</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-8 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $_SESSION["lastlogin"];?></h5>
                    <span class="description-text">Ultima Sesi&oacute;n</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!--/.box-->
          </div><!-- /.box box-widget widget-user -->

<?php
	if(isset($_SESSION["username"])){
   		if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
?>
<!--Atajos del Administrador-->
<div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-title">Administrador</h3>
      <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
         </button>
         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <ul class="products-list product-list-in-box">
         <li class="item">
            <div class="product-img">
               <img src="<?php echo $page_url.$path_tema;?>images/cover.jpg" alt="Product Image">
            </div>
            <div class="product-info">
               Tema:
               <a href="<?php echo $page_url;?>index.php?mod=sys&ext=admin/index&opc=temas" class="product-title">
                  <?php echo $tema;?>
                  <!--span class="label label-warning pull-right">$1800</span-->
               </a>
               <span class="product-description">
               Tema actual para la p&aacute;gina web: <?php echo $page_name;?>
               </span>
            </div>
         </li>
         <!-- /.item -->
         <li class="item">
            <div class="product-img">
               <!--img src="<?php echo $page_url.$path_tema;?>" alt="Product Image"-->
               <i class="fa fa-cog" style="font-size:40px; padding:5px 0 0 5px;"></i>
            </div>
            <div class="product-info">
               <a href="<?php echo $page_url;?>index.php?mod=sys&ext=admin/index" class="product-title">
                  Configuraci&oacute;n General
                  <!--span class="label label-info pull-right">$700</span-->
               </a>

               <span class="product-description">
               Configuraci&oacute;n y administraci&oacute;n del sistema.
               </span>
            </div>
         </li>
         <!-- /.item -->
         <li class="item">
            <div class="product-img">
               <!--img src="<?php echo $page_url.$path_tema;?>" alt="Product Image"-->
               <i class="fa fa-users" style="font-size:40px; padding:5px 0 0 5px;"></i>
            </div>
            <div class="product-info">
               <a href="<?php echo $page_url;?>index.php?mod=usuarios&ext=admin/index" class="product-title">
                  Usuarios
                  <!--span class="label label-info pull-right">$700</span-->
               </a>
               <span class="product-description">
               Administaci&oacute;n y gesti&oacute;n de usuarios.
               </span>
            </div>
         </li>
         <!-- /.item -->
         <li class="item">
            <div class="product-img">
               <!--img src="<?php echo $page_url.$path_tema;?>" alt="Product Image"-->
               <i class="fa fa-cubes" style="font-size:40px; padding:5px 0 0 5px;"></i>
            </div>
            <div class="product-info">
               <a href="<?php echo $page_url;?>index.php?mod=sys&ext=modulos" class="product-title">
                  Modulos
                  <!--span class="label label-info pull-right">$700</span-->
               </a>
               <span class="product-description">
               Configuraci&oacute;n y administraci&oacute;n de Modulos del sistema.
               </span>
            </div>
         </li>
         <!-- /.item -->
      </ul>
   </div>
   <!-- /.box-body -->
   <div class="box-footer text-center">
      <a target="_blank" href="<?php echo $page_url;?>apps/dashboards/AdminLTE/documentation/index.html" class="uppercase">Documentaci&oacute;n</a>
   </div>
   <!-- /.box-footer -->
</div>
<!--/Atajos del Administrador-->
<?php
		}   
	}
?>
        </div><!-- /.col-->

		<div class="col-lg-6 col-sm-12 col-xs-12">
		<div class="col-lg-6 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
              <?php 
              if($val_ajax==1){ 
                compact_ajax('num_visitas','num_visitas','apps/dashboards/notificaciones.php?opc=num_visitas&activo=0',2,0);
              }else{visitas_hoy();
              }?>
              </h3>
              <p>Visitas Hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $page_url;?>index.php?mod=estadisticas&ext=admin/index" class="small-box-footer">Ver M&aacute;s <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

		<div class="col-lg-6 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $fecha;?></h3>
              <p>Fecha</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">Ver M&aacute;s <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

		<div class="col-lg-6 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              <?php 
              if($val_ajax==1){
                compact_ajax('num_email3','num_email3','apps/dashboards/notificaciones.php?opc=num_email&activo=0',2,0); 
              }else{
                mensajes_recibidos();
              }?> 
              </h3>
              <p>Mensajes</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="<?php echo $page_url;?>index.php?mod=mailbox" class="small-box-footer">Ver M&aacute;s <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<!--?php widget_info_blog();?-->
		<div class="col-lg-6 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>
              <?php
              if($val_ajax==1){
                compact_ajax('num_blog','num_blog','apps/dashboards/notificaciones.php?opc=num_blog&activo=0',2,0);
              }else{
                num_blog();
              }?>    
              </h3>
              <p>Entradas Blog</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments"></i>
            </div>
            <a href="<?php echo $page_url;?>index.php?mod=blog&ext=admin/index" class="small-box-footer">Ver M&aacute;s <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

		</div>


		<?php include '_form.php';?>

	</div><!-- /.row-->
    </section>
    <!-- /.content -->
<?php
	break;	
}
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';header("Location: ".$page_url."index.php");}
}else{header("Location: ".$page_url."index.php");}
?>