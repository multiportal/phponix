<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){		
		include 'functions.php';
		editor_tiny_mce();//sql_opciones('tiny_text_des',$valor);$tiny_text=$valor;
?>
<style>
.ima-size{height: 100px;}
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
				$row=query_row($tabla,'ID',$id);
				if($row){
					$clave=$row['clave'];
					$cover=$row['cover'];
					$nombre=$row['nombre'];
					$FT=$row['FT'];
					$resena=$row['resena'];
					$descripcion=$row['descripcion'];
					$precio=$row['precio'];
					$cate=$row['cate'];
					$alta=$row['alta'];
					$url_p=$row['url_page'];
					$imagen1=$row['imagen1'];
					$imagen2=$row['imagen2'];
					$imagen3=$row['imagen3'];
					$imagen4=$row['imagen4'];
					$imagen5=$row['imagen5'];
					$visible=$row['visible'];
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
              <h3 class="box-title"><?php echo $titulo1.' '.$tit_accion;?></h3>
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
				<div class="col-md-8">
                  <div class="col-md-6">
				  	<div class="form-group">
                  		<label for="clave">Clave</label>
                  		<input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave;?>" autocomplete="off">
                	</div>
                	<div class="form-group">
                  		<label for="nombre">Nombre</label>
                  		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>" required autocomplete="off">
                	</div>
                	<div class="form-group">
                  		<label for="url_page">URL P&aacute;gina</label>
                  		<input type="text" class="form-control" id="url_page" name="url_page" value="<?php echo $url_p;?>" autocomplete="off">
                	</div>
					<div class="form-group">
						<label for="cate">Categoria</label>
                  		<div id="cate_sel"></div>
					</div>
                  </div>
				  <div class="col-md-6">
				  	<div class="form-group">
                  		<label for="resena">Descripción Corta</label>
                  		<input type="text" class="form-control" id="resena" name="resena" value="<?php echo $resena;?>" autocomplete="off">
                	</div>
				  	<div class="form-group">
                  		<label for="precio">Precio</label>
                  		<input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>" autocomplete="off">
                	</div>
                	<div class="form-group">
                  		<label for="FT">Fecha de Termino</label>
                  		<input type="text" class="form-control" id="FT" name="FT" value="<?php echo $FT;?>" autocomplete="off">
                	</div>
					<div class="form-group">
                  		<label>Visible</label>
                  		<select class="form-control" id="visible" name="visible">
                    		<option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    		<option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  		</select>
                	</div>
				  </div>
				  <div class="form-group col-md-12">
                  	<label for="descripcion">Descripci&oacute;n</label>
                  	<textarea class="form-control" id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
                  </div>
                </div>
                <!--?php echo $img_src;?-->
              </div><!-- /.box-body -->
              <div class="box-footer text-right">
                <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $username;?>">
                <?php $date1=($action=='add')?$date:$alta;$date2=($action=='edit')?$date:'';?>
              	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
              	<input type="hidden" class="form-control" id="alta" name="alta" value="<?php echo $date1;?>">
                <input type="hidden" class="form-control" id="fmod" name="fmod" value="<?php echo $date2;?>">				                
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar"> 
                <a class="btn btn-default" href="<?php echo $refer;?>">Cancelar</a>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php cate_porta_js($cate,'cate','cate_sel');
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
					<h3 class="box-title">Listado de <?php echo $mod;?></h3><span style="float:right;"><a href="javascript:refrescar();"><i class="fa fa-refresh"></i></a> <?php btnVistas($large);?></span>
				</div><!-- /.box-header -->

            	<div id="loader" class="text-center"><img src="<?php echo $page_url;?>apps/dashboards/loader.gif"></div>
				<div class="outer_div"></div>                

			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->		          		  
	<div class="col-md-12 col-xs-12">
	<?php crear_ws($tabla);?>
	</div>         
</section>
<!--/Content-->
<?php
	//ajaxCrud($large,$campos,$imas=1,$tinyMCE=1);
	ajaxCrud($large,$campos,$th,$imas,1);
	break;
}
?>	
	</div><!-- /.row-->
</section><!-- /.content -->
<?php 
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>