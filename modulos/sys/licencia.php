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
                  			<th>Info</th>
                		</tr>
                		</thead>
                		<tbody>
						<tr>
                        	<td>1</td>
                            <td>Licencia <?php echo $tcil;?></td>
                            <td><?php echo $ls_web;if($_SESSION["level"]==-1 && $_SESSION["username"]=='admin'){echo '['.$cil.']';}?></td>
                        </tr>    
						<tr>
                        	<td>2</td>
                            <td>Control</td>
                            <td><?php echo $control;?></td>
                        </tr>    
						<tr>
                        	<td>3</td>
                            <td>Vencimiento</td>
                            <td><?php echo $vence.'/'.$fecha;?></td>
                        </tr>    
						<tr>
                        	<td>4</td>
                            <td>Versi&oacute;n</td>
                            <td><?php echo $ver_web;?></td>
                        </tr>    
<?php
if($_SESSION["level"]==-1 && $_SESSION["username"]=='admin'){
?>
						<tr>
                        	<td>5</td>
                            <td>CODE</td>
                            <td><?php echo $ncod;?></td>
                        </tr>    
						<tr>
                        	<td>6</td>
                            <td>pw_admin</td>
                            <td><?php echo $pw_admin;?></td>
                        </tr>    
<?php
}
?>
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