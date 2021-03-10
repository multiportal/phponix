<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){		
		include 'functions.php';
		editor_tiny_mce();//sql_opciones('tiny_text_des',$valor);$tiny_text=$valor;
?>
<style>
.ima-size{height: 170px;}
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
	case($opc=='categoria'):
	$tabla='productos_cate';

switch(true){
	case($form==1):
		switch(true){
			case($action=='add'):
				$titulo1='<i class="fa fa-plus"></i> Agregar';$edo='Subir';
				$query = "SELECT * FROM ".$DBprefix.$tabla." ORDER BY ID DESC LIMIT 0,1";
        		$data = ws_query_data($query,1,0,0);//print_r($data);$numrows = count($data);
				foreach($data as $row){$ord=$row['ord']+1;}
			break;
			case($action=='edit' && !empty($_GET['id'])):
				$titulo1='<i class="fa fa-edit"></i> Editar';$edo='Cambiar';$id=$_GET['id'];
				$row=query_row($tabla,'ID',$id);
				if($row){
					$ID=$row['ID'];
					$cover=$row['cover'];
					$categoria=$row['categoria'];
					$ord=$row['ord'];
					$des=$row['descripcion'];
					$visible=$row['visible'];
				}
			break;
		}
		//$array_ima=array(1=>$imagen1,$imagen2,$imagen3,$imagen4,$imagen5);
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
                <div class="form-group col-md-3">
				  
				  	<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Imagen Principal</h3>
        				</div>
        				<div class="box-body">
						<div id="imagen"><?php echo $file;?></div>
        				</div><!-- /.box-body -->
        			</div>

                </div>
				<div class="col-md-9">
					<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Detalles de <?php echo $opc;?></h3>
        				</div>
        				<div class="box-body">
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-12">
							  <div class="form-group">
                  				<label for="categoria">Nombre de Categoria</label>
                  				<input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $categoria;?>" autocomplete="off">
                			  </div>
							  <div class="form-group">
                  				<label for="descripcion">Descripci&oacute;n</label>
                       			<textarea class="form-control" id="descripcion" name="descripcion" rows="8" style="width:100%;"><?php echo $des;?></textarea>
                			  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                  				  <label for="ord">Orden Código</label>
                        		  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>" autocomplete="off">
                				</div>
							</div>
							<div class="col-md-6">
                				<div class="form-group">
                  				  <label for="visible">Activo</label>
                               	  <select class="form-control" id="visible" name="visible">
                    				<option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    				<option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  				  </select>              
                				</div>
                			</div>
        				</div><!-- /.box-body -->
        			</div>
				</div>

              </div><!-- /.box-body -->
              <div class="box-footer text-right">
              	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">				                
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar"> 
                <a class="btn btn-default" href="<?php echo $refer;?>">Cancelar</a>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php //jQuery_select_cate_subcate();//cate_porta_js($cate,'cate','cate_sel');
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
					<h3 class="box-title">Listado de <?php echo $opc;?></h3><span style="float:right;"><a href="javascript:refrescar();"><i class="fa fa-refresh"></i></a> <?php btnVistas($large);?></span>
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

	break;
	case($opc=='subcategoria'):
	$tabla='productos_sub_cate';

switch(true){
	case($form==1):
		switch(true){
			case($action=='add'):
				$titulo1='<i class="fa fa-plus"></i> Agregar';$edo='Subir';
				/**/				
			break;
			case($action=='edit' && !empty($_GET['id'])):
				$titulo1='<i class="fa fa-edit"></i> Editar';$edo='Cambiar';$id=$_GET['id'];
				$row=query_row($tabla,'ID',$id);
				if($row){
					$ID=$row['ID'];
					$cover=$row['cover'];
					$subcategoria=$row['subcategoria'];
					$ord=$row['ord'];
					$ID_cate=$row['ID_cate'];
					$des=$row['descripcion'];
					$visible=$row['visible'];
				}
			break;
		}
		//$array_ima=array(1=>$imagen1,$imagen2,$imagen3,$imagen4,$imagen5);
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
                <div class="form-group col-md-3">
				  
				  	<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Imagen Principal</h3>
        				</div>
        				<div class="box-body">
						<div id="imagen"><?php echo $file;?></div>
        				</div><!-- /.box-body -->
        			</div>

                </div>
				<div class="col-md-9">
					<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Detalles de <?php echo $opc;?></h3>
        				</div>
        				<div class="box-body">
							<div class="col-md-6">
							  <div class="form-group">
                  				<label for="subcategoria">Nombre de SubCategoria</label>
                  				<input type="text" class="form-control" id="subcategoria" name="subcategoria" value="<?php echo $categoria;?>" autocomplete="off">
                			  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                  				  <label for="ID_cate">Categoria</label>
								  <select class="form-control" id="ID_cate" name="ID_cate">
								    <?php select_cate($ID_cate);?>
								  </select>
								  <input type="hidden" class="form-control" id="cate" name="cate" value="<?php echo $cate;?>">
                				</div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
                  				<label for="descripcion">Descripci&oacute;n</label>
                       			<textarea class="form-control" id="descripcion" name="descripcion" rows="8" style="width:100%;"><?php echo $des;?></textarea>
                			  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                  				  <label for="ord">Orden Código</label>
                        		  <input type="text" class="form-control" id="ord" name="ord" value="<?php echo $ord;?>" autocomplete="off">
                				</div>
							</div>
							<div class="col-md-6">
                				<div class="form-group">
                  				  <label for="visible">Activo</label>
                               	  <select class="form-control" id="visible" name="visible">
                    				<option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    				<option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  				  </select>              
                				</div>
                			</div>
        				</div><!-- /.box-body -->
        			</div>
				</div>

              </div><!-- /.box-body -->
              <div class="box-footer text-right">
              	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">				                
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-primary" value="Guardar"> 
                <a class="btn btn-default" href="<?php echo $refer;?>">Cancelar</a>
              </div>
            </form>
          </div><!-- /.box -->
    </div><!-- /.col-->
<?php //jQuery_select_cate_subcate();//cate_porta_js($cate,'cate','cate_sel');
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
					<h3 class="box-title">Listado de <?php echo $opc;?></h3><span style="float:right;"><a href="javascript:refrescar();"><i class="fa fa-refresh"></i></a> <?php btnVistas($large);?></span>
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

	break;
	default:

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
					$ID=$row['ID'];
					$codigo=$row['codigo'];
					$clave=$row['clave'];
					$nombre=$row['nombre'];
					$tit=$row['titulo'];
					$cover=$row['cover'];
					$foto=$row['foto'];
					$des=$row['descripcion'];
					$marca=$row['marca'];
					$modelo=$row['modelo'];
					$tipo=$row['tipo'];
					$precio=$row['precio'];
					$moneda=$row['moneda'];
					$unidad=$row['unidad'];
					$peso=$row['peso'];
					$color=$row['color'];
					$medidas=$row['medidas'];
					$stock=$row['stock'];
					$serie=$row['serie'];
					$lote=$row['lote'];					
					$ID_cate=$row['ID_cate'];
					$ID_sub_cate=$row['ID_sub_cate'];
					$ID_sub_cate2=$row['ID_sub_cate2'];
					$ID_marca=$row['ID_marca'];
					$url_name=$row['url_name'];
					$cate=$row['cate'];
					$resena=$row['resena'];
					$nuevo=$row['nuevo'];
					$promo=$row['promo'];
					$descuento=$row['descuento'];
					$clasificacion=$row['clasificacion'];
					$tags=$row['tags'];
					$land=$row['land'];
					//$file=$row['file'];
					$fmod=$row['fmod'];
					$user=$row['user'];
					$alta=$row['alta'];
					$imagen1 = $row['imagen1'];
					$imagen2 = $row['imagen2'];
					$imagen3 = $row['imagen3'];
					$imagen4 = $row['imagen4'];
					$imagen5 = $row['imagen5'];
					$pdf1 = $row['pdf1'];
					$pdf2 = $row['pdf2'];
					$pdf3 = $row['pdf3'];
					$pdf4 = $row['pdf4'];
					$pdf5 = $row['pdf5'];
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
              <h3 class="box-title"><?php echo $titulo1.' '.$tit_accion;?> - <?php echo $nombre.' ('.$modelo.')';?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form1" name="form1" role="form" method="POST" enctype="multipart/form-data" action="">
              <div class="box-body">
                <div class="form-group col-md-3">
				  
				  	<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Imagen Principal</h3>
        				</div>
        				<div class="box-body">
						<div id="imagen"><?php echo $file;?></div>
        				</div><!-- /.box-body -->
        			</div>
					<div class="box box-success collapsed-box">
        				<div class="box-header with-border">
            				<h3 class="box-title">Archivos Adjuntos</h3>
              				<div class="box-tools pull-right">
                				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              				</div><!-- /.box-tools -->
            			</div><!-- /.box-header -->
            			<div class="box-body">
							<?php if($imas==1){imagenes($array_ima);}?>
                        </div><!-- /.box-body -->
        			</div><!-- /.box -->

                </div>
				<div class="col-md-9">
					<div class="box box-success">
        				<div class="box-header">
        					<h3 class="box-title">Detalles del Producto</h3>
        				</div>
        				<div class="box-body">
							<div class="col-md-6">
							  <div class="form-group">
                  				<label for="codigo">Código</label>
                  				<input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo;?>" autocomplete="off">
                			  </div>
							  <div class="form-group">
                  				<label for="nombre">Nombre</label>
                  				<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>" autocomplete="off">
                			  </div>
							  <div class="form-group">
                  				<label for="precio">Precio</label>
                  				<div class="input-group">
                        		  <span class="input-group-addon">$</span>
                  				  <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>" autocomplete="off">
                        		</div>
                			  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
                  				<label for="ID_marca">Marca</label>
								<select class="form-control" id="ID_marca" name="ID_marca">
									<?php select_marcas($ID_marca);?>
								</select>
                			  </div>
							  <div class="form-group">
                  				<label for="modelo">Modelo</label>
                  				<input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo;?>" autocomplete="off">
                			  </div>
							  <div class="form-group">
                  				<label for="moneda">Moneda</label>
								  <select class="form-control" id="moneda" name="moneda">
                    				<option value="MXN" <?php echo $selec=($moneda=='MXN') ? 'selected' : '';?>>MXN</option>
                    				<option value="USD" <?php echo $selec=($moneda=='USD') ? 'selected' : '';?>>USD</option>
                  				  </select>
                			  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
                  				<label for="resena">Descripci&oacute;n Corta</label>
								<input type="text" class="form-control" id="resena" name="resena" value="<?php echo $resena;?>" autocomplete="off">
                			  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
                  				<label for="descripcion">Descripci&oacute;n</label>
                       			<textarea class="form-control" id="descripcion" name="descripcion" rows="8" style="width:100%;"><?php echo $des;?></textarea>
                			  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                  				  <label for="nuevo">Nuevo</label>
                   				  <select class="form-control" id="nuevo" name="nuevo">
                    				<option value="0" <?php echo $sel=($nuevo==0) ? 'selected' : '';?>>No</option>
                    				<option value="1" <?php echo $sel=($nuevo==1) ? 'selected' : '';?>>Si</option>
                  				  </select>              
                        		</div>
								<div class="form-group">
                  				  <label for="unidad">Unidad</label>
                        		  <input type="text" class="form-control" id="unidad" name="unidad" value="<?php echo $unidad;?>" autocomplete="off">
                				</div>
								<div class="form-group">
                  				  <label for="ID_cate">Categoria</label>
								  <select class="form-control" id="ID_cate" name="ID_cate">
								    <?php select_cate($ID_cate);?>
								  </select>
								  <input type="hidden" class="form-control" id="cate" name="cate" value="<?php echo $cate;?>">
                				</div>
								<div class="form-group">
                  				  <label for="alta1">Alta</label>
                        		  <input type="text" class="form-control" id="alta1" name="alta1" value="<?php echo $alta;?>" autocomplete="off">
                				</div>
							</div>
							<div class="col-md-6">
                				<div class="form-group">
                  				  <label class="control-label" for="promo">Promo</label>
                  					<select class="form-control" id="promo" name="promo">
                    				  <option value="0" <?php echo $sel=($promo==0) ? 'selected' : '';?>>No</option>
                    				  <option value="1" <?php echo $sel=($promo==1) ? 'selected' : '';?>>Si</option>
                  					</select>              
                        		</div>
                				<div class="form-group">
                  				  <label for="stock">Stock</label>
                  				  <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock;?>">
                	       		</div>
                				<div class="form-group">
                  				  <label for="ID_sub_cate">Subcategoria</label>
								  <select class="form-control" id="ID_sub_cate" name="ID_sub_cate">
									<?php select_sub_cate($ID_cate,$ID_sub_cate);?>
								  </select>
                				</div>
                				<div class="form-group">
                  				  <label for="visible">Activo</label>
                               	  <select class="form-control" id="visible" name="visible">
                    				<option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    				<option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  				  </select>              
                				</div>
                			</div>
        				</div><!-- /.box-body -->
        			</div>
				</div>

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
<?php jQuery_select_cate_subcate();//cate_porta_js($cate,'cate','cate_sel');
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

break;
}
?>	
	</div><!-- /.row-->
</section><!-- /.content -->
<?php 
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>