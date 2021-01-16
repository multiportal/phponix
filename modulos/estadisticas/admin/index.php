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
 		<?php //panel_menu();?>
	<div class="panel panel-default">
  		<div class="panel-heading">
    		<h3 class="panel-title">Panel <span style="float:right;"><a href="#" title="Info del modulo: sys"><i class="fa fa-info-circle"></i></a></span></h3>
  		</div>
  		<div class="panel-body">
			<span><a href="index.php?mod=estadisticas&ext=admin/index"><i class="fa fa-bar-chart"></i><sup><i class="fa fa-calendar"></i></sup> Visitas Mensuales</a></span> | <span><a href="index.php?mod=estadisticas&ext=admin/index&opc=semana"><i class="fa fa-bar-chart"></i><sup><i class="fa fa-calendar-minus-o"></i></sup> Visitas Semanales</a></span> | 
  		</div>
	</div>
    
	</div>
    <!-- /.row-->
	<div class="row">
<?php 
switch(true){
 case($opc=='semana'):
$semana=$_POST['sem'];
obtener_semana($semana,$sem,$option,$tot_v);
?>
	<div class="col-md-8">
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Visitas Semanales</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

				  <div class="col-md-12">
    				<form name="form1" method="post" action="<?php echo $URL;?>">
    					<div class="form-group">
        				<label for="sem">Semana:</label>
    						<select id="sem" name="sem" onChange="envio();">
							   <?php echo $option;?>
        				</select>
                <span>Total de visitas esta semana: <b><?php echo $tot_v;?></b></span>
    					</div>
					  </form>
    			</div>

              <div class="chart">
                <canvas id="barChart" style="height: 300px; width: 467px;" height="300" width="467"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div><!-- /.col -->
	<div class="col-md-4">
        
  </div><!-- /.col -->

<?php
 break;
 default:
?>
	<div class="col-md-8">
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Visitas Mensuales - <?php echo $ano=(isset($_POST['years']))?$_POST['years']:$year;?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

          <div class="col-md-12">
            <form name="form1" method="post" action="<?php echo $URL;?>">
              <div class="form-group">
                <label for="years">A&ntilde;o:</label>
                <select id="years" name="years" onChange="envio();">
                <?php select_year();?>
                </select>
              </div>
            </form>
          </div>

              <div class="chart">
                <canvas id="barChart" style="height: 300px; width: 467px;" height="300" width="467"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div><!-- /.col -->
	<div class="col-md-4">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Visitas de Referencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> <span class="label label-info">Redes Sociales</span></strong>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-facebook"></i> Facebook</b> <a class="pull-right"><?php visitas_ref('facebook.com');?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-twitter"></i> Twitter</b> <a class="pull-right"><?php visitas_ref('twitter.com');?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-google-plus"></i> Google Plus</b> <a class="pull-right"><?php visitas_ref('plus.google.com');?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-linkedin"></i> LinkedIn</b> <a class="pull-right"><?php visitas_ref('linkedin.com');?></a>
                </li>
              </ul>
              
              <strong><i class="fa fa-book margin-r-5"></i> <span class="label label-danger">Busqueda</span></strong>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-google"></i> Google</b> <a class="pull-right"><?php visitas_ref('google.com');?></a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
        
    </div><!-- /.col -->
<?php 
	break;
}
?>
	</div><!--/.row-->
    </section>
    <!-- /.content -->

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n. Le recomendamos '.$back.'.</div>';}
}else{header("Location: ".$page_url."index.php?mod=usuarios");}
?>