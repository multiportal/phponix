<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){		
		include 'functions.php';
		editor_tiny_mce();//sql_opciones('tiny_text_des',$valor);$tiny_text=$valor;
		//$vistas=btnVistas(0);
		$imas=0;
?>
<style>
.ima-size{height: 180px;}
@media screen and (max-width: 766px){
	.ima-size{height: inherit;}
}
</style>
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
<?php 
switch(true){
	case($form==1):
		switch(true){
			case($action=='add'):
				$titulo1='<i class="fa fa-plus"></i> Agregar';$edo='Subir';$precio='0.00';
			break;
			case($action=='edit' && !empty($_GET['id'])):
				$titulo1='<i class="fa fa-edit"></i> Editar';$edo='Cambiar';$id=$_GET['id'];
				//$row=query_row($tabla,'ID',$id);
				if($row){
				}
			break;
		}
		$array_ima=array(1=>$imagen1,$imagen2,$imagen3,$imagen4,$imagen5);
		$file=file_ima($cover);
?>
<div id="aviso"><?php echo $aviso;?></div>
<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $titulo1;?> Promo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form1" name="form1" role="form" method="POST" enctype="multipart/form-data" action="">
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="cover">Imagen</label>
                  <div id="imagen"><?php echo $file;?></div>
				  <hr>
				  <?php if($imas==1){imagenes($array_ima);}?>                  
                </div>
                <!--?php echo $img_src;?-->
              </div><!-- /.box-body -->
              <div class="box-footer text-right">
                <!--input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar"--> 
                <a class="btn btn-default" href="<?php echo $refer;?>">Cancelar</a>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php //cate_porta_js($cate,'cate','cate_sel');
	break;
	default:
?>
<!-- Main content -->
<!--header-->
<section class="content">
	<div class="row">
    	<?php head_producto();?>
	</div><!--/row-->
</section>    
<!--/header-->
<!--Content-->
<section class="content">					
	<div class="row">
		<div class="col-md-12 col-xs-12">
        	<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Listado de <?php echo $mod;?></h3><span style="float:right;"><?php echo $vistas;?></span>
				</div><!-- /.box-header -->

            	<div id="loader" class="text-center"><img src="<?php echo $page_url;?>apps/dashboards/loader.gif"></div>
				<div class="outer_div"></div>                
                
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->		          		  
	<div class="col-md-12 col-xs-12">
	<?php //crear_ws($tabla);?>
	</div>         
</section>
<!--/Content-->
<?php
	//ajaxCrud($large,$campos,$imas=1,$tinyMCE=1);
	//ajaxCrud($large,$campos,$th,$imas,1);
	break;
}
?>	
	</div><!-- /.row-->
</section><!-- /.content -->
<?php 
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>