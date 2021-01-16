<?php
if(isset($_SESSION["username"])){
    if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
include 'admin/functions.php';
sql_opciones('AJAX',$val_ajax);
if($val_ajax==0){
  header("Location:".$page_url."index.php?mod=sys&ext=admin/index&opc=opciones");
}
?>
<style>#title{height:40px;}</style>
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
        	<div class="col-md-12">
           		<?php echo $aviso.$out;?>
			</div>

			<div class="col-lg-6 col-xs-12">
 				<div class="box box-primary">
    				<div class="box-header">
        				<h3 class="box-title">Opciones del Sistema (<?php compact_ajax('num_opciones','num_opciones','modulos/sys/admin/backend.php?opc=num_opciones',2,0);?>)</h3>
        			</div>
        			<!-- /.box-header -->
        			<div class="box-body">
			  			<form id="edit-form">
                        <div class="card">
                        	<div id="reg_opciones" class="card-body"></div> 
                        </div>
						</form>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col-->

			<div class="col-lg-6 col-xs-12">
          		<div class="box box-primary collapsed-box">
            		<div class="box-header with-border">
        				<h3 class="box-title">Agregar Opcion</h3>
                        <div class="box-tools pull-right">
                			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              			</div>
        			</div>
        			<!-- /.box-header -->
        			<div class="box-body">
                    	<form id="add-form">
              			<div class="box-body">
                			<div class="form-group">
                 				<label for="nom">Nombre Opcion</label>
                  				<input type="text" class="form-control" id="nom" name="nom" value="">
                			</div>
							<div class="form-group">
                  				<label folr="descripcion">Descripci&oacute;n</label>
                  				<input type="text" class="form-control" id="descripcion" name="descripcion" value="">
                			</div>
                			<div class="form-group">
                 				<label for="valor">Valor</label>
                  				<input type="text" class="form-control" id="valor" name="valor" value="0">
                			</div>

              			</div>
              			<!-- /.box-body -->
              			<div class="box-footer">
                			<input type="submit" name="Guardar1" class="btn btn-primary" value="Guardar"> 
              			</div>
						</form>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col-->
        
        </div><!--/.row-->
	</section>
<?php     
  }else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>