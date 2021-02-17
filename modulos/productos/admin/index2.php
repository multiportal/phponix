<?php
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
include 'functions.php';
editor_tiny_mce();
sql_opciones('tiny_text_des',$valor);
$tiny_text=$valor;
?>
<style>#title{height:40px;}#desc{height:30px;}</style>
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
switch(true){//switch1
 case($opc=='marcas')://switch1/marcas
	switch(true){//switch2/marcas/formulario 
		case($action=='form'):
			switch(true){//switch2/marcas/formulario/controles
				case($ctrl=='add'):
				$titulo='Agregar';
				break;
				case($ctrl=='edit' && !empty($_GET['id'])):
				$titulo='Editar';
				break;
			}//Fin:switch2/marcas/formulario/controles
?>
<!--Formulario-->
Formulario
<!--/Formulario-->
<?php	
		break;//Fin:switch2/marcas/formulario
		default:
?>
<!--Lista-->
Lista
<!--/Lista-->
<?php			
		break;
	}//Fin:switch2/marcas/
 break;//Fin:Marcas
 case($opc=='subcategoria')://switch1/subcategoria
	switch(true){//switch2/sbcategoria/formulario 
		case($action=='form'):
			switch(true){//switch2/sbcategoria/formulario/controles
				case($ctrl=='add'):
				$titulo='Agregar';
				break;
				case($ctrl=='edit' && !empty($_GET['id'])):
				$titulo='Editar';
				break;
			}//Fin:switch2/subcategoria/formulario/controles
?>
<!--Formulario-->
Formulario
<!--/Formulario-->
<?php	
		break;//Fin:switch2/subcategoria/formulario
		default:
?>
<!--Lista-->
Lista
<!--/Lista-->
<?php			
		break;
	}//Fin:switch2/subcategoria/
 break;//Fin:Subcategoria
 case($opc=='categoria')://switch1/categoria
	switch(true){//switch2/categoria/formulario 
		case($action=='form'):
			switch(true){//switch2/categoria/formulario/controles
				case($ctrl=='add'):
				$titulo='Agregar';
				break;
				case($ctrl=='edit' && !empty($_GET['id'])):
				$titulo='Editar';
				break;
			}//Fin:switch2/categoria/formulario/controles
?>
<!--Formulario-->
Formulario
<!--/Formulario-->
<?php	
		break;//Fin:switch2/categoria/formulario
		default:
?>
<!--Lista-->
Lista
<!--/Lista-->
<?php			
		break;
	}//Fin:switch2/categoria/
 break;//Fin:Categoria
 case($opc=='producto')://switch1/producto
	switch(true){//switch2/producto/formulario 
		case($action=='form'):
			switch(true){//switch2/producto/formulario/controles
				case($ctrl=='add'):
				$icon_ctrl='<i class="fa fa-plus"></i>';
				$titulo=$m='Agregar';

				break;
				case($ctrl=='edit' && !empty($_GET['id'])):
				$icon_ctrl='<i class="fa fa-edit"></i>';
				$titulo='Editar';$m='Cambiar';$id=$_GET['id'];
?>
				<script>
				function subir(val,file){
 				 if(val==-1){
				 	window.open("<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php?id='.$id;?>&val="+val+"&pdf="+file,"ima_subir");
 				 }else{
					window.open("<?php echo $page_url.'modulos/'.$mod.'/admin/editar_subir.php?id='.$id;?>&val="+val+"&ima="+file,"ima_subir");
 				 }
				}
				</script>
				<script type="text/javascript">
    			function borrar(n){
				 if(n==0){n='';}	
    				var r=confirm("Realmente desea eliminar esta Archivo"+n+"?.");
    				if(r==true){
<?php
					print " window.location.href='{$page_url}index.php?mod={$mod}&ext={$ext}&opc={$opc}&action={$action}&ctrl=edit&id={$id}&img='+n+'&delete=1'; ";
					$num_img=$_GET['img'];
					if($num_img==0){$c_img='cover';}elseif($num_img<=-1){$c_img='pdf'.abs($num_img);}else{$c_img='imagen'.$num_img;}
					if($_GET['delete']==1 && !empty($_GET['delete'])){mysqli_query($mysqli,"UPDATE ".$DBprefix."productos SET ".$c_img."='' WHERE ID='".$_GET['id']."';") or print mysqli_error($mysqli);}
    			?>}
    			}
				</script>  
<?php 
				if($_GET['delete']==1 && !empty($_GET['delete'])){
					$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action='.$action.'&ctrl=edit&id='.$id;
					recargar(1,$URL,$target);
				}
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
			}//Fin:switch2/producto/formulario/controles

$cover=($cover!='')?$cover:'nodisponible.jpg';

$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" style="width:150px;">
<div><a href="javascript:up(1);">'.$m.' Imagen</a><div id="upload"></div></div>';

/*CONTROL DE IMAGENES*/
$imagen=array($cover,$ima1,$ima2,$ima3,$ima4,$ima5);
for($i=0;$i<=5;$i++){
	if($i==0){$avi='Cambiar';$avi2='';$img_data='<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$imagen[$i].'" width="100%"><br>';
	$img='
	<div class="form-group">
		<input type="hidden" class="form-control" id="cover" name="cover" value="'.$imagen[$i].'">
		<div>
			'.$img_data.'
			<div><a href="javascript:up(1);">'.$avi.' Imagen </a> '.$avi2.'<div id="upload"></div></div> 
		</div>
	</div>';
	}
	else{
		if($imagen[$i]!=''){
			$avi='Cambiar';
			$avi2=' | <a href="javascript:borrar('.$i.');">Borrar</a>';
			$img_data='<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$imagen[$i].'" width="50px"><br>';
		}else{
			$avi='Subir';
			$avi2='';
			$img_data='';
		}
		$img='
		<div class="form-group">
			<!--label for="ima'.$i.'">Imagen '.$i.'</label-->
			<input type="hidden" class="form-control" id="ima'.$i.'" name="ima'.$i.'" value="'.$imagen[$i].'">
			<div>
				'.$img_data.'
				<div><a href="javascript:subir_ima('.$i.');">'.$avi.' Imagen '.$i.'</a> '.$avi2.'<div id="uploadima'.$i.'"></div></div> 
			</div>
		</div>';
	}
	$file_ima[]=$img;	
}

if($_POST['Guardar']){
//$ID=$_POST['ID'];
$codigo=$_POST['codigo'];
//$clave=$_POST['clave'];
$nombre=$_POST['nom'];
//$tit=$_POST['titulo'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
//$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$tipo=$_POST['tipo'];
$precio=$_POST['precio'];
$moneda=$_POST['moneda'];
$unidad=$_POST['unidad'];
$peso=$_POST['peso'];
$color=$_POST['color'];
$medidas=$_POST['medidas'];
$stock=$_POST['stock'];
$serie=$_POST['serie'];
$lote=$_POST['lote'];					
$ID_cate=$_POST['cate'];
$ID_sub_cate=$_POST['subcate'];
//$ID_sub_cate2=$_POST['ID_sub_cate2'];
$ID_marca=$_POST['marcas'];
//$url_name=$_POST['url_name'];
//$cate=$_POST['cate'];
$resena=$_POST['resena'];
$nuevo=$_POST['nuevo'];
$promo=$_POST['promo'];
$descuento=$_POST['descuento'];
$clasificacion=$_POST['clasificacion'];
$tags=$_POST['tags'];
//$land=$_POST['land'];
//$file=$reg['file'];
$fmod=$_POST['fmod'];
$user=$_POST['user'];
$alta=$_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$pdf1 = $_POST['pdf1'];
$pdf2 = $_POST['pdf2'];
$pdf3 = $_POST['pdf3'];
$pdf4 = $_POST['pdf4'];
$pdf5 = $_POST['pdf5'];

//Conversion iso
html_iso_productos($nombre,$modelo,$des);
	if($nombre == '' && $visible == ''){
		$error = "*Los campos estan vacios.\\n\\r"; $c++; 
	}
	if($c > 0){
		$aviso='
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> '.$error.'
			</div>
			';
	}else{
	if($ctrl=='edit'){
		$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."productos SET codigo='{$codigo}',nombre='{$nombre}',cover='{$cover}',descripcion='{$des}',modelo='{$modelo}',precio='{$precio}',moneda='{$moneda}',unidad='{$unidad}',peso='{$peso}',color='{$color}',medidas='{$medidas}',stock='{$stock}',serie='{$serie}',lote='{$lote}',ID_cate='{$ID_cate}',ID_sub_cate='{$ID_sub_cate}',ID_marca='{$ID_marca}',resena='{$resena}',nuevo='{$nuevo}',promo='{$promo}',descuento='{$descuento}',clasificacion='{$clasificacion}',tags='{$tags}',fmod='{$fmod}',user='{$user}',alta='{$alta}',imagen1='{$ima1}',imagen2='{$ima2}',imagen3='{$ima3}',imagen4='{$ima4}',imagen5='{$ima5}',pdf1='{$pdf1}',pdf2='{$pdf2}',pdf3='{$pdf3}',pdf4='{$pdf4}',pdf5='{$pdf5}',visible='{$visible}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
	}else{
		$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."productos (codigo,nombre,cover,descripcion,modelo,precio,moneda,unidad,peso,color,medidas,stock,serie,lote,ID_cate,ID_sub_cate,ID_marca,resena,nuevo,promo,descuento,clasificacion,tags,fmod,user,alta,imagen1,imagen2,imagen3,imagen3,imagen4,imagen5,pdf1,pdf2,pdf3,pdf4,pdf5,visible) VALUES ('{$codigo}','{$nombre}','{$cover}',{$des},'{$modelo}','{$precio}','{$moneda}','{$unidad}','{$peso}','{$color}','{$medidas}','{$stock}','{$serie}','{$lote}','{$ID_cate}','{$ID_sub_cate}','{$ID_marca}','{$resena}','{$nuevo}','{$promo}','{$descuento}','{$clasificacion}','{$tags}',{'$fmod'},'{$user}',{'$alta'},imagen1='{$ima1}','{$ima2}','{$ima3}','{$ima4}','{$ima5}','{$pdf1}','{$pdf2}','{$pdf3}','{$pdf4}','{$pdf5}','{$visible})") or print mysqli_error($mysqli);
	}
	validar_aviso($save,'El producto se ha guardo correctamente','No se puedo guardar intentelo nuevamente',$aviso);
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(3,$URL,$target);
	}
}

if($_POST['Aceptar'] || $_POST['Aceptarima1'] || $_POST['Aceptarima2'] || $_POST['Aceptarima3'] || $_POST['Aceptarima4'] || $_POST['Aceptarima5'] || $_POST['Aceptarpdf1'] || $_POST['Aceptarpdf2'] || $_POST['Aceptarpdf3'] || $_POST['Aceptarpdf4'] || $_POST['Aceptarpdf5']){

$aceptar=$_POST['Aceptar'];
$aceptar1=$_POST['Aceptarima1'];
$aceptar2=$_POST['Aceptarima2'];
$aceptar3=$_POST['Aceptarima3'];
$aceptar4=$_POST['Aceptarima4'];
$aceptar5=$_POST['Aceptarima5'];

$success=array($aceptar,$aceptar1,$aceptar2,$aceptar3,$aceptar4,$aceptar5);
	 
//if($_POST['Aceptar']){
//$ID=$_POST['ID'];
$codigo=$_POST['codigo'];
//$clave=$_POST['clave'];
$nombre=$_POST['nom'];
//$tit=$_POST['titulo'];
$cover=$_POST['cover'];
//$foto=$_POST['foto'];
$des=$_POST['des'];
//$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$tipo=$_POST['tipo'];
$precio=$_POST['precio'];
$moneda=$_POST['moneda'];
$unidad=$_POST['unidad'];
$peso=$_POST['peso'];
$color=$_POST['color'];
$medidas=$_POST['medidas'];
$stock=$_POST['stock'];
$serie=$_POST['serie'];
$lote=$_POST['lote'];					
$ID_cate=$_POST['cate'];
$ID_sub_cate=$_POST['subcate'];
//$ID_sub_cate2=$_POST['ID_sub_cate2'];
$ID_marca=$_POST['marcas'];
//$url_name=$_POST['url_name'];
//$cate=$_POST['cate'];
$resena=$_POST['resena'];
$nuevo=$_POST['nuevo'];
$promo=$_POST['promo'];
$descuento=$_POST['descuento'];
$clasificacion=$_POST['clasificacion'];
$tags=$_POST['tags'];
//$land=$_POST['land'];
//$file=$reg['file'];
$fmod=$_POST['fmod'];
$user=$_POST['user'];
$alta=$_POST['alta'];
$visible=$_POST['visible'];
$ima1 = $_POST['ima1'];
$ima2 = $_POST['ima2'];
$ima3 = $_POST['ima3'];
$ima4 = $_POST['ima4'];
$ima5 = $_POST['ima5'];
$pdf1 = $_POST['pdf1'];
$pdf2 = $_POST['pdf2'];
$pdf3 = $_POST['pdf3'];
$pdf4 = $_POST['pdf4'];
$pdf5 = $_POST['pdf5'];

$imagen=array($cover,$ima1,$ima2,$ima3,$ima4,$ima5);
//datos del arhivo 
$repositor='modulos/'.$mod.'/fotos';
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$path_archivo = $repositor."/".$nombre_archivo;
//compruebo si las características del archivo son las que deseo 
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    	$im='<span style=" font-weight:bold; color:#f00;">El archivo NO ha sido aceptado.</span><br>'.$file_ima[$i];
		$file_ima[$i]=$im;
	}else{ 
    	if (@move_uploaded_file($_FILES['userfile']['tmp_name'],$path_archivo)){
			for($i=0;$i<=5;$i++){

				if($success[$i]!=''){
					$im='
					<div class="form-group">
					<!--label for="ima'.$i.'">Imagen '.$i.'</label-->
					<input type="hidden" class="form-control" id="ima'.$i.'" name="ima'.$i.'" value="'.$nombre_archivo.'">
					<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$nombre_archivo.'" style="width:50px;">
					<div><a href="javascript:subir_ima('.$i.');">Cambiar Imagen '.$i.'</a> | <a href="javascript:borrar('.$i.');">Borrar</a><div id="uploadima'.$i.'"></div></div>
					</div>';
					$file_ima[$i]=$im;
				}else{
					
					
						if($imagen[$i]!=''){$avi='Cambiar';$avi2=' | <a href="javascript:borrar('.$i.');">Borrar</a>';
							$img_data='<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$imagen[$i].'" width="50px"><br>';
						}else{$avi='Subir';$avi2='';$img_data='';}
						$im='
						<div class="form-group">
						<!--label for="ima'.$i.'">Imagen '.$i.'</label-->
						<input type="hidden" class="form-control" id="ima'.$i.'" name="ima'.$i.'" value="'.$imagen[$i].'">
						'.$img_data.'
						<div><a href="javascript:subir_ima('.$i.');">'.$avi.' Imagen '.$i.'</a> '.$avi2.'<div id="uploadima'.$i.'"></div></div>
						</div>';

						$file_ima[$i]=$im;
				}
			}
		}else{
			$im='<span style=" font-weight:bold; color:#f00;">Ocurrió algún error al subir el fichero. No pudo guardarse.</span><br>'.$file_ima[$i];
			$file_ima[$i]=$im;
		}
	}
//unlink($URL);
}


jQuery_select_cate_subcate();
?>
<!--Formulario-->
<div class="col-md-12">
    <?php echo $aviso;?>
	<section class="content-header">
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
				<?php echo $file_ima[1];?>
                <?php echo $file_ima[2];?>
                <?php echo $file_ima[3];?>
                <?php echo $file_ima[4];?>
                <?php echo $file_ima[5];?>
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
<?php	
		break;//Fin:switch2/producto/formulario
		default:
?>
<!--Lista-->
<script type="text/javascript">
    function confirm1(id){
    var r=confirm("Realmente desea eliminar este producto "+id+"?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		mysqli_query($mysqli,"DELETE FROM ".$DBprefix."productos WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
	}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$URL=$page_url.'index.php?mod='.$mod.'&ext='.$ext;
	recargar(1,$URL,$target);
}
?>
<div class="col-xs-12">
 <div class="col-xs-12">
	<a href="<?php echo $page_url.'?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=add';?>">
	<div style="font-size:20px; text-align:center; padding:2px 0;"><i class="fa fa-plus"></i></div>
	</a>
	<div id="title" style="text-align:center;"><b>Nuevo</b></div>
	<div id="desc" class="hidden-xs" style="text-align:center;">Agregar nuevo producto</div>
 </div>
<?php 
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos ORDER BY ID DESC;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
while($reg=mysqli_fetch_array($sql)){
$id	= $reg['ID'];
$codigo=$reg['codigo'];
$nombre = $reg['nombre'];
$modelo = $reg['modelo'];
$cover = $reg['cover'];
$des = $reg['descripcion'];
$visible = $reg['visible'];
$seleccion=($visible==0)?'<span style="float:left;color:#f00;">Visible: No</span>':'<span style="float:left;color:#0f0;">Visible: Si</span>';
$cover=($cover!='')?$cover:'nodisponible.jpg';
echo '
 <div class="col-xs-12 col-md-3">
    	<div class="box box-success">
        	<div class="box-header">
        		<h3 class="box-title">C&oacute;digo: <b>'.$codigo.'</b></h3>
        	</div>
        	<div class="box-body">
	<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" width="100%">
	<div id="title" style="height:60px;">'.$nombre.' '.$modelo.'</div>
	<div style="width:100%; height:18px;">'.$seleccion.'
	<span style="float:right;font-size:18px;">
		<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'&action=form&ctrl=edit&id='.$id.'" title="Editar"><i class="fa fa-edit"></i></a> | <a href="javascript:confirm1('.$id.');" title="Borrar"><i class="fa fa-trash"></i></a>
	</span>
	</div>
	<div id="desc" class="hidden-xs"></div>
        	</div><!-- /.box-body -->
        </div>
 </div>';
}
?>
 <div class="col-md-12 col-xs-12">
	<div style="padding-top:50px;">Total de Registros: <b><?php echo $num_rows;?></b></div>
	<hr>
        <?php 
		$query="SELECT * FROM ".$DBprefix."productos WHERE visible=1 ORDER BY ID ASC;";
		//crear_json($query:'consulta',$path_f:'ruta del archivo',$nombre_archivo:'nombre_archivo')
		crear_json($query,'modulos/'.$mod.'/',$mod.'.json');
		?>
 </div>         
</div><!-- /.col-xs-12 -->
<!--/Lista-->
<?php			
		break;
	}//Fin:switch2/producto/
 break;//Fin:Producto
 default:
?>
<!--CONFIGURACIONES-->
<?php header("Location: ".$page_url."index.php?mod=productos&ext=admin/index&opc=producto");?>
<!--/CONFIGURACIONES-->
<?php
 break;
}//Fin:switch1
?>    
	</div>
    <!-- /.row-->
    </section>
    <!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Archivos de producto</h4>
      </div>
      <div class="modal-body">
      	<div><iframe name="ima_subir" frameborder="0" scrolling="auto" width="100%" height="400px" src="<?php echo $page_url.'modulos/productos/admin/editar_subir.php';?>"></iframe></div>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
      -->
    </div>
  </div>
</div>
<!-- Fin Modal -->
<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>