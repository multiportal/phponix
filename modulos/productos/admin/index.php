<?php
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
include 'functions.php';
editor_tiny_mce();
sql_opciones('tiny_text_des',$valor);
$tiny_text=$valor;
$vistas=($opc!='' && $opc=='producto')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'"><i class="fa fa-list"></i></a> | <i class="fa fa-th-large"></i>':'<i class="fa fa-list"></i> | <a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc=producto"><i class="fa fa-th-large"></i></a>';
?>
<style>
#title{height:40px;text-align:center;}
#desc{height:30px;}
.content{min-height:0px;}
.ima-size{height:250px;}
.controles{float:right;font-size:20px;}
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $nombre_mod;?>
        <small><?php echo $description_mod;?></small>
      </h1>
	  <?php menu_rutas();?>
    </section>

<?php
switch(true){//switch1
  case($opc=='marcas')://switch1/marcas
?>

<?php
  break;
  case($opc=='categoria')://switch1/categoria
?>

<?php
  break;
  case($opc=='subcategoria')://switch1/subcategoria
?>

<?php
  break;
  case($opc=='subcategoria2')://switch1/subcategoria2
?>

<?php
  break;
  case($opc=='producto')://switch1/producto
	switch(true){
		case($frm==1):
		jQuery_select_cate_subcate();
			switch(true){
				case($action=='add'):
				$icon_ctrl='<i class="fa fa-plus"></i>';
				$titulo=$m='Agregar';
				break;
				case($action=='edit' && !empty($_GET['id'])):
				$icon_ctrl='<i class="fa fa-edit"></i>';
				$titulo='Editar';$m='Cambiar';$id=$_GET['id'];

				$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID='{$id}';") or print mysqli_error($mysqli); 
				if($reg=mysqli_fetch_array($sql)){
					$ID=$reg['ID'];
					$codigo=$reg['codigo'];
					$clave=$reg['clave'];
					$nombre=$reg['nombre'];
					$tit=$reg['titulo'];
					$cover=$reg['cover'];
					$foto=$reg['foto'];
					$des=$reg['descripcion'];
					$marca=$reg['marca'];
					$modelo=$reg['modelo'];
					$tipo=$reg['tipo'];
					$precio=$reg['precio'];
					$moneda=$reg['moneda'];
					$unidad=$reg['unidad'];
					$peso=$reg['peso'];
					$color=$reg['color'];
					$medidas=$reg['medidas'];
					$stock=$reg['stock'];
					$serie=$reg['serie'];
					$lote=$reg['lote'];					
					$ID_cate=$reg['ID_cate'];
					$ID_sub_cate=$reg['ID_sub_cate'];
					$ID_sub_cate2=$reg['ID_sub_cate2'];
					$ID_marca=$reg['ID_marca'];
					$url_name=$reg['url_name'];
					$cate=$reg['cate'];
					$resena=$reg['resena'];
					$nuevo=$reg['nuevo'];
					$promo=$reg['promo'];
					$descuento=$reg['descuento'];
					$clasificacion=$reg['clasificacion'];
					$tags=$reg['tags'];
					$land=$reg['land'];
					//$file=$reg['file'];
					$fmod=$reg['fmod'];
					$user=$reg['user'];
					$alta=$reg['alta'];
					$visible=$reg['visible'];
					$ima1 = $reg['imagen1'];
					$ima2 = $reg['imagen2'];
					$ima3 = $reg['imagen3'];
					$ima4 = $reg['imagen4'];
					$ima5 = $reg['imagen5'];
					$pdf1 = $reg['pdf1'];
					$pdf2 = $reg['pdf2'];
					$pdf3 = $reg['pdf3'];
					$pdf4 = $reg['pdf4'];
					$pdf5 = $reg['pdf5'];
				}

				break;
			}
?>
<section class="content">
	<div class="row">
<!--Formulario-->
<div class="col-md-12">
    <?php echo $aviso;?>
	<section class="content-header" style="padding-top:10px;">
	  <h1><?php echo $icon_ctrl.' '.$titulo;?> Producto: <?php echo $nombre.' '.$modelo;?></h1>
	</section>
    <div style="height:20px;"></div>
	<form name="form1" role="form" method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo $URL;?>">
	<div class="col-md-3">
    	<div class="box box-success">
        	<div class="box-header">
        		<h3 class="box-title">Imagen</h3>
        	</div>
        	<div class="box-body">
                <?php echo $file_ima[0];?>
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
                <?php echo $ima_src;?>
                <?php echo $pdf_src;?>
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
                  		<label class="col-md-4 control-label" for="codigo">C&oacute;digo</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo;?>"></div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="nom">Nombre</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nombre;?>"></div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="precio">Precio</label>
                        <div class="col-md-8">
                        <div class="input-group">
                        <span class="input-group-addon">$</span>
                  		<input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>">
                        </div></div>
                	</div>
                </div>
            	<div class="col-md-6">
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="marca">Marca</label>
                        <div class="col-md-8">
                        	<?php select_marcas($ID_marca);?>
                        </div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="modelo">Modelo</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo;?>"></div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="moneda">Moneda</label>
                        <div class="col-md-8">
                        <select class="form-control" id="moneda" name="moneda">
                    		<option value="MXN" <?php echo $selec=($moneda=='MXN') ? 'selected' : '';?>>MXN</option>
                    		<option value="USD" <?php echo $selec=($moneda=='USD') ? 'selected' : '';?>>USD</option>
                  		</select>                  
                        </div>
                	</div>
                </div>
            	<div class="col-md-12">
                	<div class="form-group">
                  		<label class="col-md-2 control-label" for="des">Descripci&oacute;n Corta</label>
                        <div class="col-md-10">
                        <?php if($tiny_text==1){echo '<textarea class="form-control" id="des" name="des" rows="8">'.$des.'</textarea>';}else{echo '<input type="text" class="form-control" id="des" name="des" value="'.$des.'">';}?>
                        </div>
                	</div>
				</div>
            	<div class="col-md-12">
                	<div class="form-group">
                  		<label class="col-md-2 control-label" for="resena">Descripci&oacute;n</label>
                        <div class="col-md-10">
                        <textarea class="form-control" id="resena" name="resena" rows="8" style="width:100%;"><?php echo $resena;?></textarea>
                        </div>
                	</div>
				</div>
            	<div class="col-md-6">
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="nuevo">Nuevo</label>
                        <div class="col-md-8">
                  		<select class="form-control" id="nuevo" name="nuevo">
                    		<option value="0" <?php echo $sel=($nuevo==0) ? 'selected' : '';?>>No</option>
                    		<option value="1" <?php echo $sel=($nuevo==1) ? 'selected' : '';?>>Si</option>
                  		</select>              
                        </div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="unidad">Unidad</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="unidad" name="unidad" value="<?php echo $unidad;?>"></div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="cate">Categoria</label>
                        <div class="col-md-8">
				  		<?php select_cate($ID_cate);?>
                        </div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="alta">Alta</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="alta" name="alta" value="<?php echo $f=($ctrl=='edit')?$alta:$date;?>"></div>
                	</div>
                </div>
            	<div class="col-md-6">
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="promo">Promo</label>
                        <div class="col-md-8">
                  		<select class="form-control" id="promo" name="promo">
                    		<option value="0" <?php echo $sel=($promo==0) ? 'selected' : '';?>>No</option>
                    		<option value="1" <?php echo $sel=($promo==1) ? 'selected' : '';?>>Si</option>
                  		</select>              
                        </div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="stock">Stock</label>
                        <div class="col-md-8">
                  		<input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock;?>"></div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="subcate">Subcategoria</label>
                        <div class="col-md-8">
   				  		<?php select_sub_cate($ID_cate,$ID_sub_cate);?>
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="col-md-4 control-label" for="visible">Activo</label>
                        <div class="col-md-8">
                  		<select class="form-control" id="visible" name="visible">
                    		<option value="0" <?php echo $seleccion=($visible==0) ? 'selected' : '';?>>No</option>
                    		<option value="1" <?php echo $seleccion=($visible==1) ? 'selected' : '';?>>Si</option>
                  		</select>              
                        </div>
                	</div>
                </div>

        	</div><!-- /.box-body -->
            <div class="box-footer text-right">
            	<input type="hidden" class="form-control" id="fmod" name="fmod" value="<?php echo $date;?>">
            	<input type="hidden" class="form-control" id="user" name="user" value="<?php echo $user;?>">
                <input id="Guardar" name="Guardar" type="submit" class="btn btn-success" value="Guardar">
                <button type="button" class="btn btn-default" onClick="javascript:window.history.go(-1);">Cancelar</button>
            </div>
        </div>
    </div>
	</form>
</div>
<!--/Formulario-->
	</div><!--/row-->
</section>    

<?php
		break;//frm==1

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
					<h3 class="box-title">Listado de Productos <?php echo $frm;?></h3><span style="float:right;"><?php echo $vistas;?></span>
				</div><!-- /.box-header -->
            	<div id="loader" class="text-center"><img src="<?php echo $page_url;?>modulos/productos/img/loader.gif"></div>
				<div class="outer_div"></div>                
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->		          		  
</section>
<!--/Content-->
<?php
		
		break;//frm:defult
	}
  break;//opc=producto
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
					<h3 class="box-title">Listado de Productos</h3><span style="float:right;"><?php echo $vistas;?></span>
				</div><!-- /.box-header -->

            	<div id="loader" class="text-center"><img src="<?php echo $page_url;?>modulos/productos/img/loader.gif"></div>
				<div class="outer_div"></div>                

			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->		          		  
</section>
<!--/Content-->
<?php
  break;
}
?>        
<!-- Modal Productos -->
<div class="modal fade" id="Producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar/Editar Producto</h4>
      </div>
      <div class="modal-body">
      	<div>FORMULARIO</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<?php 
$var=($opc!='')?'?opc=producto':'';
$contenido='
// JavaScript Document
	$(document).ready(function(){
		load(1);
	});

	function load(page){
		var parametros = {"mode":"ajax","page":page};
		$("#loader").fadeIn(\'slow\');
		$.ajax({
			url:\'modulos/productos/admin/backend.php'.$var.'\',
			data: parametros,
			beforeSend: function(objeto){
			$("#loader").html("<img src=\'modulos/productos/img/loader.gif\'>");
			},
			success:function(data){
				//$(".outer_div").html(data).fadeIn(\'slow\');
				$(".outer_div").html(data);
				$("#loader").html("");
			}
		});
	}

$(document).ready(function(){
	// Global Settings
	//let edit = false;
 	//console.log(\'jQuery esta funcionando\');
	//listar();
	//registros();
	$("#task-result").hide();

	//REGISTROS
	/*
	function registros(){
		$.ajax({
			type: \'POST\',
			url: \'modulos/sys/admin/backend.php?opc=registros\',
			success: function(response) {			
				$("#reg_opciones").html(response);
	   		}
		});
	}
	setInterval(registros, 5000);*/

	//LISTAR
	/*
	function listar(){
		$.ajax({
			url: \'admin/backend.php?opc=list\',
			type: \'POST\',
			//dataType : \'json\',
			success: function(response){
				let tasks=JSON.parse(response);
				let template="";
				
				tasks.forEach(task=>{
        		template += `
                  <tr taskId="${task.ID}">
                  <td>${task.ID}</td>
                  <td>
                  <a href="#" class="task-item">${task.nom}</a>
                  </td>
                  <td>${task.descripcion}</td>
                  <td>
                    <button class="task-delete btn btn-danger">Borrar</button>
                  </td>
                  </tr>
                `
					});
				$("#task").html(template);
			}
		});
	}
	setInterval(listar,30000);*/

	//BUSCAR
	/*	
	$("#search").keyup(function(e){
	  if($("#search").val()){
		let search=$("#search").val();
		$.ajax({
			url: \'admin/backend.php?opc=buscar\',
			type: \'POST\',
			data: {search},
			success: function(response){
				let tasks=JSON.parse(response);
				let template="";
				
				tasks.forEach(task=>{
        		template += `
                  <tr taskId="${task.ID}">
                  <td>${task.ID}</td>
                  <td>
                  <a href="#" class="task-item">${task.nom}</a>
                  </td>
                  <td>${task.descripcion}</td>
                  <td>
                    <button class="task-delete btn btn-danger">Borrar</button>
                  </td>
                  </tr>
                `
				});
				$("#task").html(template);
				//$("#task-result").show();
			}
		});
	  }	 
	});*/

	//AGREGAR/EDITAR
	/*
	$("#task-form").submit(function(e){
		e.preventDefault();
		const postData={
			nom: $("#nom").val(),
			des: $("#des").val(),
      		id: $("#taskId").val()
		};
		const url = edit === false ? \'admin/backend.php?opc=add\' : \'admin/backend.php?opc=edit\';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log(response);
			$("#task-form").trigger(\'reset\');	
			listar();
			edit = false;
		});
	});	*/

	//editar_form
	/*
	$(document).on(\'click\',\'.task-item\',function(){	
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr(\'taskId\');
      	$.post(\'admin/backend.php?opc=edit_form\', {id}, (response) => {
			console.log(response);
			const task=JSON.parse(response);
      		$("#nom").val(task.nom);
      		$("#des").val(task.descripcion);
      		$("#taskId").val(task.ID);
      		edit = true;
        });		
	});*/

	//BORRAR
	/*
	$(document).on(\'click\',\'.task-delete\',function(){
      if(confirm("Esta seguro de eliminar esta tarea?")) {
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr(\'taskId\');
      	$.post(\'admin/backend.php?opc=delete\', {id}, (response) => {
			console.log(response);
          	listar();
        });
	  }
	});	*/
	
});
';
crear_archivo('modulos/'.$mod.'/js/','ajax_'.$mod.'.js',$contenido,$path_file);
?>    

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>