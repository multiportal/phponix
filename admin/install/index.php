<?php 
include 'admin/backend.php';
$servidor_temp='http://'.$_SERVER['HTTP_HOST'].'/';
$path_root='MisSitios/adminCAT/';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instalador | PHPONIX</title>

    <!-- Bootstrap -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
	<link href="../../assets/css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./assets/css/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./assets/css/custom.min.css" rel="stylesheet">
<style>.actionBar{display:none;}</style>
<?php $sel_db=(isset($select_db))?$select_db:'';
echo '
<script>
function add_select_text(val){
  if(val==1){ 
    document.getElementById(\'div_combo\').innerHTML=\'<input type="text" class="form-control" id="database" name="database" value=""><div><a href="javascript:add_select_text(0);">Cancelar</a></div>\';
  }else{
    document.getElementById(\'div_combo\').innerHTML=\''.$sel_db.' <a href="javascript:add_select_text(1);"><i class="fa fa-plus-circle"></i> Agregar Base de Datos</a>\';
  }
}

function add_server_local(val){
  if(val==1){ 
    document.getElementById(\'div_local\').innerHTML=\'<a href="javascript:add_server_local(0);">x Cancelar</a><div class="col-lg-12"><div class="form-group"><label for="usuario">Nombre de Usuario:</label><input type="text" class="form-control" id="usuario_local" name="usuario_local" value="root" placeholder="root"></div></div><div class="col-lg-12"><div class="form-group"><label for="pass">Password:</label><input type="password" class="form-control" id="pass_local" name="pass_local" value="" placeholder="password"></div></div>\';
  }else{
    document.getElementById(\'div_local\').innerHTML=\'<a href="javascript:add_server_local(1);"><i class="fa fa-plus-circle"></i> Agregar Servidor Local</a>\';
  }
}
</script>
';
?>
<!--script>
function add_select_text(val){
	if(val==1){	
		document.getElementById('div_combo').innerHTML='<input type="text" class="form-control" id="database" name="database" value=""><div><a href="javascript:add_select_text(0);">Cancelar</a></div>';
	}else{
		document.getElementById('div_combo').innerHTML=' <a href="javascript:add_select_text(1);"><i class="fa fa-plus-circle"></i> Agregar Base de Datos</a>';
	}
}

function add_server_local(val){
	if(val==1){	
		document.getElementById('div_local').innerHTML='<a href="javascript:add_server_local(0);">x Cancelar</a><div class="col-lg-12"><div class="form-group"><label for="usuario">Nombre de Usuario:</label><input type="text" class="form-control" id="usuario_local" name="usuario_local" value="root" placeholder="root"></div></div><div class="col-lg-12"><div class="form-group"><label for="pass">Password:</label><input type="password" class="form-control" id="pass_local" name="pass_local" value="" placeholder="password"></div></div>';
	}else{
		document.getElementById('div_local').innerHTML='<a href="javascript:add_server_local(1);"><i class="fa fa-plus-circle"></i> Agregar Servidor Local</a>';
	}
}
</script-->
</head>
<body class="login">
    <div class="container body">
    	<div class="clearfix" style="padding:20px;"></div>
		<div class="col-lg-offset-1 col-lg-10">
        	<div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Guia de Instalaci&oacute;n <small></small></h2>
                    <!--ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#"></a>
                          </li>
                          <li><a href="#"></a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>Llena los siguientes datos del formulario, este te guiara paso a paso para la instalaci&oacute;n del cms.</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1" <?php echo 'class="'.$class1.'" isdone="'.$isdone1.'" rel="1"';?>>
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                PASO 1<br />
                                <small>Paso 1 Servidor DB</small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" <?php echo 'class="'.$class2.'" isdone="'.$isdone2.'" rel="2"';?>>
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                PASO 2<br />
                            	<small>Paso 2 Selecci&oacute;n DB</small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" <?php echo 'class="'.$class3.'" isdone="'.$isdone3.'" rel="3"';?>>
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                PASO 3<br />
                            	<small>Paso 3 Creaci&oacute;n de Tablas</small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4" <?php echo 'class="'.$class4.'" isdone="'.$isdone4.'" rel="4"';?>>
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                PASO 4<br />
                            	<small>Paso 4 Final</small>
                            </span>
                          </a>
                        </li>
                      </ul>
                      <!--?php echo $resultados;?-->
                      <div id="step-0">
                      	<?php echo $form;?>
                      </div>
                      <div id="step-1">                      	
                      	<?php echo $form1;?>
                      </div>
                      <div id="step-2">
                      	<?php echo $form2;?>
                        <ul class="list-unstyled text-left">
                      	<?php echo $aviso_2;?>
                        </ul>
                      </div>
                      <div id="step-3">
                      	<?php echo $form3;?>
                        <ul class="list-unstyled text-left">
                      	<?php echo $aviso_3;?>
                        </ul>
                      </div>
                      <div id="step-4">
                       	<?php echo $form4;?>
                      	<ul class="list-unstyled text-left">
						<?php echo $aviso_4;?>
                        </ul>
                      </div>

                    </div>
                    <!-- End SmartWizard Content -->

                  </div>
                </div>                
              </div>


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Bootstrap AdminLTE Template by <a href="https://phponix.webcindario.com">PHPONIX</a>
          </div>
        </footer>
        <!-- /footer content -->

      		</div><!--/row-->
		</div>
    </div>

    <!-- jQuery -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="./assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="./assets/js/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="./assets/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <!--script src="./assets/js/custom.min.js"></script-->

</body>
</html>