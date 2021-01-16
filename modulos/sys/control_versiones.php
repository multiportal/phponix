<?php
if(isset($_SESSION["username"])){
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
			<div class="col-xs-12">
				<div class="box">
    				<div class="box-header">
        				<h3 class="box-title">Licencia</h3>
						<span style="float: right;"><a href="<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=add';?>" title="Agregar Menu"><i class="fa fa-plus-square"></i></a></span>
        			</div>
        			<!-- /.box-header -->
        			<div class="box-body">
        			<table id="example1" class="table table-bordered table-striped">
            			<thead>
                		<tr>
                  			<th>ID</th>
                  			<th>Nombre</th>
                  			<th>Vencimiento</th>
                            <th>Ultima Version</th>
                            <th>Status</th>
                            <th>Descripcion</th>                            
                		</tr>
                		</thead>
                		<tbody>
                        	<?php mostrar_api_version();?>
                            <?php api_version($nom_ver,$vencimiento,$ultimate,$status,$des_ver);
							echo '<tr><td>'.$ID.'</td><td>'.$nom_ver.'</td><td>'.$vencimiento.'</td><td>'.$ultimate.'</td><td>'.$status.'</td><td>'.$des_ver.'</td></tr>';?>
						</tbody>
              		</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col-->
        </div><!--/.row-->
	</section>
<?php	
}
?>