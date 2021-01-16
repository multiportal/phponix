<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
		header("Location: ".$page_url."index.php?mod=sys&ext=admin/index");        
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

		<div id="cont-user">Administrador del modulo: <?php echo $mod;?>.</div>

	</div>
    <!-- /.row-->
    </section>
    <!-- /.content -->

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>