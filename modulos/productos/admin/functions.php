<?php
switch(true){case($opc=='categoria'):$tab='cate';break;case($opc=='subcategoria'):$tab='sub_cate';break;default:$tab='productos';break;}
include 'conf_'.$tab.'.php';
function url_api(){global $page_url;$tabla=table();return $url_api=$page_url.'api/'.$tabla.'/';}
$btn_modal=($bmodal==1)?'data-toggle="modal" data-target="#modalForm"':'';
$tabla=table();
$url_api=url_api();
/** BACKEND */ ////////////////////////////////////////////////////////////////////////////////////
function categoria($ID_cate){
$tabla='productos_cate';
$data = query_data($tabla, $url_api=NULL);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID=$dato['ID'];
            if($ID==$ID_cate){
              $categoria=$dato['categoria'];
            }
        }
        return $categoria;
    }    
}

function jQuery_select_cate_subcate(){
echo '
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#ID_cate").on(\'change\', function () {
        $("#ID_cate option:selected").each(function () {
            elegido=$(this).val();            
            $.post("modulos/productos/admin/backend.php?action=select_cate_subcate", { elegido: elegido }, function(resp){
                $("#ID_sub_cate").html(resp);
            });
            $.post("modulos/productos/admin/backend.php?action=select_cate", { elegido: elegido }, function(data){
                $("#cate").val(data);
            });             	
        });
   });
});
</script>
';
}

function select_cate($cate){
$tabla='productos_cate';
$data = query_data($tabla, $url_api);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID_cate=$dato['ID'];$clave=$dato['ord'];$categoria=$dato['categoria'];
            $seleccion=($ID_cate==$cate)?'selected' : '';
            $option.='<option value="'.$ID_cate.'" '.$seleccion.'>'.$clave.' '.$categoria.'</option>';
        }
    }
echo '<option value="">Seleccionar Categoría</option>'.$option;
}

function select_sub_cate($ID_cate,$ID_sub_cate){
$tabla='productos_sub_cate';
$data = query_data($tabla, $url_api);
if ($data != '' & $data != NULL) {
    foreach ($data as $campo => $dato) {
        $ID=$dato['ID'];$clave=$dato['ord'];$subcategoria=$dato['subcategoria'];
        if($dato['ID_cate']==$ID_cate){
            $seleccion=($ID==$ID_sub_cate)?'selected' : '';
            $option.='<option value="'.$ID.'" '.$seleccion.'>'.$clave.' '.$subcategoria.'</option>';
        }
    }
}
echo '<option value="">Seleccionar Subcategoría</option>'.$option;	
}

function select_marcas($ID_marca){
$tabla='productos_marcas';
$data = query_data($tabla, $url_api);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID=$dato['ID'];$nombre=$dato['nombre'];
            $seleccion=($ID==$ID_marca)?'selected' : '';
            $option.='<option value="'.$ID.'" '.$seleccion.'>'.$nombre.'</option>';
        }
    }
echo '<option value="">Seleccionar Marca</option>'.$option;
}
/** FRONTEND */ ////////////////////////////////////////////////////////////////////////////////////
function cadena_replace(&$replace1,&$replace2){
	$replace1=array(' ','.',',','(',')','/','"','á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ','&ntilde;','&Ntilde;');
	$replace2=array('-','-','-','-','-','-','-','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','n','N','n','N');
}

function html_iso_productos(&$nombre,&$modelo,&$des){
global $chartset;
 if($chartset=='iso-8859-1'){
	$nombre=htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$modelo=htmlentities($modelo, ENT_COMPAT,'ISO-8859-1', true);	
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function html_iso_cate(&$cate){
global $chartset;
 if($chartset=='iso-8859-1'){
	$cate=htmlentities($cate, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function html_iso_subcate(&$subcate,&$cate,&$des){
global $chartset;
 if($chartset=='iso-8859-1'){
	$subcate=htmlentities($subcate, ENT_COMPAT,'ISO-8859-1', true);
	$cate=htmlentities($cate, ENT_COMPAT,'ISO-8859-1', true);
	$des=htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function control_cover($cover,&$file,$m){
global $page_url,$mod,$ext;
$cover=($cover!='')?$cover:'nodisponible.jpg';
$file='<input type="hidden" class="form-control" id="cover" name="cover" value="'.$cover.'">
<div><img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" style="width:100%;"></div>
<div><a href="javascript:up(1);">'.$m.' Imagen</a><div id="upload"></div></div>
';
}

function flechas($id){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID>'{$id}' AND visible=1 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$sig=$row['ID'];
	cadena_replace($replace1,$replace2);
	$nombre_sig=str_replace($replace1,$replace2,$row['nombre']);	
 }else{$sig=0;}

 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID<'{$id}' AND visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$ant=$row['ID'];
	cadena_replace($replace1,$replace2);
	$nombre_ant=str_replace($replace1,$replace2,$row['nombre']);	
 }else{$ant=0;}

 if($ant!=0){
 echo '<a href="'.$page_url.$mod.'/item/'.$ant.'-'.$nombre_ant.'/" rel="prev">
		<i class="fa fa-chevron-left" title="Anterior"></i>
	  </a>';
 }else{echo '<i class="fa fa-chevron-left" title="Anterior" style="line-height:40px"></i>';}
 echo '&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="'.$page_url.'productos/"><i class="fa fa-th" title="Productos"></i></a>
      &nbsp;&nbsp;&nbsp;&nbsp;';   
 if($sig!=0){
 echo '<a href="'.$page_url.$mod.'/item/'.$sig.'-'.$nombre_sig.'/" rel="next">
      	<i class="fa fa-chevron-right" title="Siguiente"></i>
      </a>';
 }else{echo '<i class="fa fa-chevron-right" title="Siguiente" style="line-height:40px"></i>';}
}

function flechas1($id){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID>'{$id}' AND visible=1 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$sig=$row['ID'];
 }else{$sig=0;}

 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE ID<'{$id}' AND visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){
	$ant=$row['ID'];
 }else{$ant=0;}

 if($ant!=0){
 echo '<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$ant.'" rel="prev">
		<i class="fa fa-chevron-left" title="Anterior"></i>
	  </a>';
 }else{echo '<i class="fa fa-chevron-left" title="Anterior" style="line-height:40px"></i>';}
 echo '&nbsp;&nbsp;&nbsp;&nbsp;
      <!--a href="'.$page_url.'productos/"><i class="fa fa-th" title="Productos"></i></a-->
      &nbsp;&nbsp;&nbsp;&nbsp;';   
 if($sig!=0){
 echo '<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&action=edit&id='.$sig.'" rel="next">
      	<i class="fa fa-chevron-right" title="Siguiente"></i>
      </a>';
 }else{echo '<i class="fa fa-chevron-right" title="Siguiente" style="line-height:40px"></i>';}
}

function item_productos($id){
global $mysqli,$DBprefix,$tema,$page_url,$path_tema,$mod,$ext,$opc,$tema_previo;

sql_opciones('link_productos',$valor);
$link_pro=$valor;
sql_opciones('b_vista_rapida',$valor);
$b_vista_rapida=$valor;
sql_opciones('mostrar_precio',$valor);
$ver_precio=$valor;
sql_opciones('mostrar_nombre',$valor);
$ver_nombre=$valor;
sql_opciones('b_ver_pro',$valor);
$b_ver_pro=$valor;
sql_opciones('b_cotizar',$valor);
$b_cotizar=$valor;
sql_opciones('b_cart',$valor);
$b_cart=$valor;
sql_opciones('e_rates',$valor);
$e_rates=$valor;

//$topic='topic';
$nomt='productos';
$fjson=$nomt.'.json';
$path_JSON='modulos/productos/'.$fjson;
 if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$nomt.'/';}
 echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 	$i=0;$n=0;
	foreach ($Data as $rowm1){$n++;}
	echo '<!-- n:'.$n.' -->';
	if($n!=0){
	 foreach ($Data as $rowm){$i++;
		$ID=$rowm['ID'];
		$codigo=$rowm['codigo'];
		$clave=$rowm['clave'];
		$nom_producto=$rowm['nombre'];
		$tit=$rowm['titulo'];
		$cover=$rowm['cover'];
		$foto=$rowm['foto'];
		$descripcion=$rowm['descripcion'];
		$marca=$rowm['marca'];
		$modelo=$rowm['modelo'];
		$tipo=$rowm['tipo'];
		$precio=$rowm['precio'];
		$moneda=$rowm['moneda'];
		$unidad=$rowm['unidad'];
		$peso=$rowm['peso'];
		$color=$rowm['color'];
		$medidas=$rowm['medidas'];
		$stock=$rowm['stock'];
		$serie=$rowm['serie'];
		$lote=$rowm['lote'];					
		$ID_cate=$rowm['cate'];
		$ID_sub_cate=$rowm['ID_sub_cate'];
		$ID_sub_cate2=$rowm['ID_sub_cate2'];
		$ID_marca=$rowm['ID_marca'];
		$url_name=$rowm['url_name'];
		$cate=$rowm['cate'];
		$resena=$rowm['resena'];
		$nuevo=$rowm['nuevo'];
		$promo=$rowm['promo'];
		$descuento=$rowm['descuento'];
		$clasificacion=$rowm['clasificacion'];
		$tags=$rowm['tags'];
		$land=$rowm['land'];
		//$file=$rowm['file'];
		$fmod=$rowm['fmod'];
		//$user=$rowm['user'];
		$alta=$rowm['alta'];
		$ima1 = $rowm['imagen1'];
		$ima2 = $rowm['imagen2'];
		$ima3 = $rowm['imagen3'];
		$ima4 = $rowm['imagen4'];
		$ima5 = $rowm['imagen5'];
		$pdf1 = $rowm['pdf1'];
		$pdf2 = $rowm['pdf2'];
		$pdf3 = $rowm['pdf3'];
		$pdf4 = $rowm['pdf4'];
		$pdf5 = $rowm['pdf5'];
		$visible=$rowm['visible'];

		//setlocale(LC_MONETARY, 'es_MX');
		$precio=number_format($precio, 2, '.', ',');
		
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$nom_producto);

		if($visible==1 && $ID_cate==$id && $ID_sub_cate==0){
		//if($visible==1 && $ID_sub_cate==$id){
		/*CATEGORIA*******************************************************************/	
		$nomt2='categorias';
		$fjson2=$nomt2.'.json';
		$path_JSON2='modulos/productos/'.$nomt2;
 		if(!file_exists($path_JSON2)){$path_JSON2=$page_url.'bloques/ws/t/productos_cate/';}
		echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson2.' -->'."\n\r":'<!-- '.$fjson2.' URL:('.$path_JSON2.')-->'."\n\r";
		$objData2=file_get_contents($path_JSON2);
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $rowm2){
				$ID_cate2=$rowm2['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$rowm2['categoria'];
				}
			}
		/*****************************************************************************/
		$link_zp=($tema_previo!='')?$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_previo:$page_url.'productos/item/'.$ID.'-'.$producto;
		$vista_rapida=($b_vista_rapida==1)?'<a href="#" class="btn-quickview">Vista Rapida</a>':'';
		$rate=($e_rates==1)?'   <div class="ratings-container"><div class="product-ratings"><span class="ratings" style="width:80%"></span><!-- End .ratings --></div><!-- End .product-ratings --></div><!-- End .product-container -->':'';
		$price=($ver_precio==1)?'<div class="price-box"><span class="product-price">$'.$precio.' '.$moneda.'</span></div><!-- End .price-box -->':'';
		$ver_mas=($b_ver_pro==1)?'<div class="btn-pro-box"><a href="'.$link_zp.'" class="btn-cer-pro">Ver Producto</a></div>':'';
		$cart=($b_cart==1)?'<div class="product-action">
                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                        <span>Add to Wishlist</span>
                                    </a>

                                    <a href="#" class="paction add-cart" title="Add to Cart">
                                        <span>Agregar Carrito</span>
                                    </a>

                                    <a href="#" class="paction add-compare" title="Add to Compare">
                                        <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->':'';


		echo '<!--['.$i.'] -'.$ID.'-->
               <div class="col-6 col-md-4">
                  <div class="product">
                     <figure class="product-image-container">
                        <!--a href="product.html" class="product-image"--><a href="'.$link_zp.'">
                        <img src="'.$page_url.'modulos/productos/fotos/Manijas.png" alt="product">
                        </a>
                        '.$vista_rapida.'
                        <!--span class="product-label label-sale">Promoci&oacute;n</span-->
                        <!--span class="product-label label-hot">Nuevo</span-->
                     </figure>
                     <div class="product-details">
					 	'.$rate.'
                        <h2 class="product-title">
                           <a href="'.$link_zp.'">'.$nom_producto.'</a>
                        </h2>
                        <div class="codigo-box">
                            <span>C&oacute;digo: '.$codigo.'</span>
                        </div>
						'.$price.'
						'.$ver_mas.'
						'.$cart.'
                     </div>
                     <!-- End .product-details -->
                  </div>
                  <!-- End .product -->
               </div>
               <!-- End .col-md-4 -->	
		';			
		}//if
	 }//foreach
	}else{echo'<li><div class="entry-media">Por el momento No hay promociones.</div></li>';}
 }//if
}

function item_subproductos($id,$idp){
global $mysqli,$DBprefix,$tema,$page_url,$path_tema,$mod,$ext,$opc,$tema_previo;

sql_opciones('link_productos',$valor);
$link_pro=$valor;
sql_opciones('b_vista_rapida',$valor);
$b_vista_rapida=$valor;
sql_opciones('mostrar_precio',$valor);
$ver_precio=$valor;
sql_opciones('mostrar_nombre',$valor);
$ver_nombre=$valor;
sql_opciones('b_ver_pro',$valor);
$b_ver_pro=$valor;
sql_opciones('b_cotizar',$valor);
$b_cotizar=$valor;
sql_opciones('b_cart',$valor);
$b_cart=$valor;
sql_opciones('e_rates',$valor);
$e_rates=$valor;

//$topic='topic';
$nomt='productos';
$fjson=$nomt.'.json';
$path_JSON='modulos/productos/'.$fjson;
 if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$nomt.'/';}
 echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 	$i=0;$n=0;
	foreach ($Data as $rowm1){$n++;}
	echo '<!-- n:'.$n.' -->';
	if($n!=0){
	 foreach ($Data as $rowm){$i++;
		$ID=$rowm['ID'];
		$codigo=$rowm['codigo'];
		$clave=$rowm['clave'];
		$nom_producto=$rowm['nombre'];
		$tit=$rowm['titulo'];
		$cover=$rowm['cover'];
		$foto=$rowm['foto'];
		$descripcion=$rowm['descripcion'];
		$marca=$rowm['marca'];
		$modelo=$rowm['modelo'];
		$tipo=$rowm['tipo'];
		$precio=$rowm['precio'];
		$moneda=$rowm['moneda'];
		$unidad=$rowm['unidad'];
		$peso=$rowm['peso'];
		$color=$rowm['color'];
		$medidas=$rowm['medidas'];
		$stock=$rowm['stock'];
		$serie=$rowm['serie'];
		$lote=$rowm['lote'];					
		$ID_cate=$rowm['cate'];
		$ID_sub_cate=$rowm['ID_sub_cate'];
		$ID_sub_cate2=$rowm['ID_sub_cate2'];
		$ID_marca=$rowm['ID_marca'];
		$url_name=$rowm['url_name'];
		$cate=$rowm['cate'];
		$resena=$rowm['resena'];
		$nuevo=$rowm['nuevo'];
		$promo=$rowm['promo'];
		$descuento=$rowm['descuento'];
		$clasificacion=$rowm['clasificacion'];
		$tags=$rowm['tags'];
		$land=$rowm['land'];
		//$file=$rowm['file'];
		$fmod=$rowm['fmod'];
		//$user=$rowm['user'];
		$alta=$rowm['alta'];
		$ima1 = $rowm['imagen1'];
		$ima2 = $rowm['imagen2'];
		$ima3 = $rowm['imagen3'];
		$ima4 = $rowm['imagen4'];
		$ima5 = $rowm['imagen5'];
		$pdf1 = $rowm['pdf1'];
		$pdf2 = $rowm['pdf2'];
		$pdf3 = $rowm['pdf3'];
		$pdf4 = $rowm['pdf4'];
		$pdf5 = $rowm['pdf5'];
		$visible=$rowm['visible'];

		//setlocale(LC_MONETARY, 'es_MX');
		$precio=number_format($precio, 2, '.', ',');
		
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$nom_producto);

		if($visible==1 && $ID_sub_cate==$id){
		/*CATEGORIA*******************************************************************/	
		$nomt2='categorias';
		$fjson2=$nomt2.'.json';
		$path_JSON2='modulos/productos/'.$nomt2;
 		if(!file_exists($path_JSON2)){$path_JSON2=$page_url.'bloques/ws/t/productos_cate/';}
		echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson2.' -->'."\n\r":'<!-- '.$fjson2.' URL:('.$path_JSON2.')-->'."\n\r";
		$objData2=file_get_contents($path_JSON2);
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $rowm2){
				$ID_cate2=$rowm2['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$rowm2['categoria'];
				}
			}
		/*****************************************************************************/
		$link_zp=($tema_previo!='')?$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_previo:$page_url.'productos/item/'.$ID.'-'.$producto;
		$vista_rapida=($b_vista_rapida==1)?'<a href="#" class="btn-quickview">Vista Rapida</a>':'';
		$rate=($e_rates==1)?'   <div class="ratings-container"><div class="product-ratings"><span class="ratings" style="width:80%"></span><!-- End .ratings --></div><!-- End .product-ratings --></div><!-- End .product-container -->':'';
		$price=($ver_precio==1)?'<div class="price-box"><span class="product-price">$'.$precio.' '.$moneda.'</span></div><!-- End .price-box -->':'';
		$ver_mas=($b_ver_pro==1)?'<div class="btn-pro-box"><a href="'.$link_zp.'" class="btn-cer-pro">Ver Producto</a></div>':'';
		$cart=($b_cart==1)?'<div class="product-action">
                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                        <span>Add to Wishlist</span>
                                    </a>

                                    <a href="#" class="paction add-cart" title="Add to Cart">
                                        <span>Agregar Carrito</span>
                                    </a>

                                    <a href="#" class="paction add-compare" title="Add to Compare">
                                        <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->':'';


		echo '<!--['.$i.'] -'.$ID.'-->
               <div class="col-6 col-md-4">
                  <div class="product">
                     <figure class="product-image-container">
                        <!--a href="product.html" class="product-image"--><a href="'.$link_zp.'">
                        <img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="product">
                        </a>
                        '.$vista_rapida.'
                        <!--span class="product-label label-sale">Promoci&oacute;n</span-->
                        <!--span class="product-label label-hot">Nuevo</span-->
                     </figure>
                     <div class="product-details">
					 	'.$rate.'
                        <h2 class="product-title">
                           <a href="'.$link_zp.'">'.$nom_producto.'</a>
                        </h2>
                        <div class="codigo-box">
                            <span>C&oacute;digo: '.$codigo.'</span>
                        </div>
						'.$price.'
						'.$ver_mas.'
						'.$cart.'
                     </div>
                     <!-- End .product-details -->
                  </div>
                  <!-- End .product -->
               </div>
               <!-- End .col-md-4 -->	
		';			
		}//if
	 }//foreach
	}else{echo'<li><div class="entry-media">Por el momento No hay promociones.</div></li>';}
 }//if
}

function one_producto($id){
global $mysqli,$DBprefix,$tema,$page_url,$path_tema,$mod,$ext,$opc,$tema_previo;
sql_opciones('link_productos',$valor);
$link_pro=$valor;
sql_opciones('mostrar_precio',$valor);
$ver_precio=$valor;
sql_opciones('b_cotizar',$valor);
$b_cotizar=$valor;
sql_opciones('b_cart',$valor);
$b_cart=$valor;
sql_opciones('e_rates',$valor);
$e_rates=$valor;

//$topic='topic';
$nomt='productos';
$fjson=$nomt.'.json';
$path_JSON='modulos/productos/'.$fjson;
 if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$nomt.'/';}
 echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
 	$objData=file_get_contents($path_JSON);
 	$Data=json_decode($objData,true);
 	$i=0;$n=0;
	foreach ($Data as $rowm1){$n++;}
	echo '<!-- n:'.$n.' -->';
	if($n!=0){
	 foreach ($Data as $rowm){$i++;
		$ID=$rowm['ID'];
		$codigo=$rowm['codigo'];
		$clave=$rowm['clave'];
		$nom_producto=$rowm['nombre'];
		$tit=$rowm['titulo'];
		$cover=$rowm['cover'];
		$foto=$rowm['foto'];
		$descripcion=$rowm['descripcion'];
		$marca=$rowm['marca'];
		$modelo=$rowm['modelo'];
		$tipo=$rowm['tipo'];
		$precio=$rowm['precio'];
		$moneda=$rowm['moneda'];
		$unidad=$rowm['unidad'];
		$peso=$rowm['peso'];
		$color=$rowm['color'];
		$medidas=$rowm['medidas'];
		$stock=$rowm['stock'];
		$serie=$rowm['serie'];
		$lote=$rowm['lote'];					
		$ID_cate=$rowm['cate'];
		$ID_sub_cate=$rowm['ID_sub_cate'];
		$ID_sub_cate2=$rowm['ID_sub_cate2'];
		$ID_marca=$rowm['ID_marca'];
		$url_name=$rowm['url_name'];
		$cate=$rowm['cate'];
		$resena=$rowm['resena'];
		$nuevo=$rowm['nuevo'];
		$promo=$rowm['promo'];
		$descuento=$rowm['descuento'];
		$clasificacion=$rowm['clasificacion'];
		$tags=$rowm['tags'];
		$land=$rowm['land'];
		//$file=$rowm['file'];
		$fmod=$rowm['fmod'];
		//$user=$rowm['user'];
		$alta=$rowm['alta'];
		$ima1 = $rowm['imagen1'];
		$ima2 = $rowm['imagen2'];
		$ima3 = $rowm['imagen3'];
		$ima4 = $rowm['imagen4'];
		$ima5 = $rowm['imagen5'];
		$pdf1 = $rowm['pdf1'];
		$pdf2 = $rowm['pdf2'];
		$pdf3 = $rowm['pdf3'];
		$pdf4 = $rowm['pdf4'];
		$pdf5 = $rowm['pdf5'];
		$visible=$rowm['visible'];

		//setlocale(LC_MONETARY, 'es_MX');
		$precio=number_format($precio, 2, '.', ',');
		
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$nom_producto);

		if($visible==1 && $ID==$id){
		/*CATEGORIA*******************************************************************/	
		$nomt2='categorias';
		$fjson2=$nomt2.'.json';
		$path_JSON2='modulos/productos/'.$nomt2;
 		if(!file_exists($path_JSON2)){$path_JSON2=$page_url.'bloques/ws/t/productos_cate/';}
		echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson2.' -->'."\n\r":'<!-- '.$fjson2.' URL:('.$path_JSON2.')-->'."\n\r";
		$objData2=file_get_contents($path_JSON2);
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $rowm2){
				$ID_cate2=$rowm2['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$rowm2['categoria'];
				}
			}
		/*****************************************************************************/

		echo '<!-- ID:'.$ID.' -->
      <div class="col-lg-9">
         <div class="product-single-container product-single-default">
            <div class="row">
               <div class="col-lg-7 col-md-6 product-single-gallery">
                  <div class="product-slider-container product-item">
                     <div class="product-single-carousel owl-carousel owl-theme">';
if($ima1!=''){
echo '
                        <div class="product-item">
                           <img class="product-single-image" src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima1.'" data-zoom-image="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima1.'"/>
                        </div>';}
if($ima2!=''){
echo '
                        <div class="product-item">
                           <img class="product-single-image" src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima2.'" data-zoom-image="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima2.'"/>
                        </div>';}
if($ima3!=''){
echo '
                        <div class="product-item">
                           <img class="product-single-image" src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima3.'" data-zoom-image="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima3.'"/>
                        </div>';}
if($ima4!=''){
echo '
                        <div class="product-item">
                           <img class="product-single-image" src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima4.'" data-zoom-image="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima4.'"/>
                        </div>';}
if($ima5!=''){
echo '
                        <div class="product-item">
                           <img class="product-single-image" src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima5.'" data-zoom-image="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima5.'"/>
                        </div>';}

echo '
                     </div>
                     <!-- End .product-single-carousel -->
                     <span class="prod-full-screen">
                     <i class="icon-plus"></i>
                     </span>
                  </div>
                  <div class="prod-thumbnail row owl-dots" id=\'carousel-custom-dots\'>';
if($ima1!=''){
echo '
                     <div class="col-3 owl-dot">
                        <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima1.'"/>
                     </div>';}
if($ima2!=''){
echo '
                     <div class="col-3 owl-dot">
                        <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima2.'"/>
                     </div>';}
if($ima3!=''){
echo '
                     <div class="col-3 owl-dot">
                        <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima3.'"/>
                     </div>';}
if($ima4!=''){
echo '
                     <div class="col-3 owl-dot">
                        <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima4.'"/>
                     </div>';}
if($ima5!=''){
echo '
                     <div class="col-3 owl-dot">
                        <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$ima5.'"/>
                     </div>';}

echo '
                  </div>
               </div>
               <!-- End .col-lg-7 -->
               <div class="col-lg-5 col-md-6">
                  <div class="product-single-details">
                     <h1 class="product-title">'.$nom_producto.'</h1>
                     <h4 class="sub-tit">'.$modelo.'</h4>
                     <div class="codigo-box2">
                            <span>C&oacute;digo: '.$codigo.'</span>
                     </div>';
if($ver_precio==1){
echo'
                     <div class="price-box">
                        <!--span class="old-price">$81.00</span-->
                        <span class="product-price">$'.$precio.' '.$moneda.'</span>
                     </div>';}
echo '
                     <!-- End .price-box -->
                     <div class="ratings-container">
                        <div class="product-ratings">
                           <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                        </div>
                        <!-- End .product-ratings -->
                        <!--a href="#" class="rating-link">( 6 Reviews )</a-->
                     </div>
                     <!-- End .product-container -->
                     <div class="product-desc">
                        <p>'.$descripcion.'</p>

                     </div>
                     <!-- End .product-desc -->
                     <div class="price-box">
                     	<img src="'.$page_url.'modulos/'.$mod.'/fotos/elco.png">
                     </div>
                     <!-- End -->';
				if($b_cart==1){
					echo '                     
					 <div class="product-action product-all-icons">
                        <div class="product-single-qty">
                           <input class="horizontal-quantity form-control" type="text">
                        </div>
                        <!-- End .product-single-qty -->
                        <a href="#" class="paction add-cart" title="Add to Cart">
                        <span>Agregar al Carrito</span>
                        </a>
                     </div>
					 <!-- End .product-action -->';}
echo '					 
                  </div>
                  <!-- End .product-single-details -->
               </div>
               <!-- End .col-lg-5 -->
            </div>
            <!-- End .row -->
         </div>
         <!-- End .product-single-container -->
         <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Descripci&oacute;n</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Dudas</a>
               </li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                  <div class="product-desc-content">
				  	'.$resena.'
                  </div>
                  <!-- End .product-desc-content -->
               </div>
               <!-- End .tab-pane -->
               <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                  <div class="product-reviews-content">
                     <div class="add-product-review">
                        <p>Escribenos las dudas que tengas sobre este producto.</p>
                        <form action="#">
                           <div class="col-lg-6" style="float:left;">
                           <div class="form-group">
                              <input type="text" class="form-control form-control-sm" required>
                           </div></div>
                           <!-- End .form-group -->
                           <div class="col-lg-6" style="float:left;">
                           <div class="form-group">
                              <input type="text" class="form-control form-control-sm" required>
                           </div></div>
                           <!-- End .form-group -->
                           <div class="col-lg-12">
                           <div class="form-group mb-2">
                              <textarea rows="6" class="form-control form-control-sm" style="width:100% !important; max-width:100% !important;"></textarea>
                           </div></div>
                           <!-- End .form-group -->
                           <input type="submit" class="btn btn-primary" value="Submit Review">
                        </form>
                     </div>
                     <!-- End .add-product-review -->
                  </div>
                  <!-- End .product-reviews-content -->
               </div>
               <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
         </div>
         <!-- End .product-single-tabs -->
      </div>
      <!-- End .col-lg-9 -->

              <!-- /End -->	
		';			
		}//if
	 }//foreach
	}else{echo'<li><div class="entry-media">Por el momento No hay promociones.</div></li>';}
 }//if
}

/*********************************************************************************************/
function breadcrumbStore($id){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$idp;
cadena_replace($replace1,$replace2);
	echo '<li class="breadcrumb-item"><a href="'.$page_url.$mod.'/">'.$mod.'</a></li>';

	if($ext!=''){
		//$nom_producto=sql_opc('productos','nombre','ID',$idp);
		if($ext=='item'){
		$producto = sql_row('productos','ID',$idp);
		$id_producto = $producto['ID'];
		$nom_producto = $producto['nombre'];
		//$ID_cate = $producto['ID_cate'];
		$ID_sub_cate = $producto['ID_sub_cate'];
		}

		if($ext=='item' || $ext=='subcategoria'){
		$IDsc = ($ext=='subcategoria')?$idp:$ID_sub_cate;
		$sub_categorias = sql_row('productos_sub_cate','ID',$IDsc);
		$nom_subcate = $sub_categorias['subcategoria'];
		$ID_cate = $sub_categorias['ID_cate'];
		$subcate=str_replace($replace1,$replace2,$nom_subcate);
		}

		if($ext=='item' || $ext=='subcategoria' || $ext=='categoria'){
		$IDc = ($ext=='categoria')?$idp:$ID_cate;
		$categorias = sql_row('productos_cate','ID',$IDc);
		$nom_cate = $categorias['categoria'];
		$cate=str_replace($replace1,$replace2,$nom_cate);
		}

		echo ($ext=='item' || $ext=='subcategoria' || $ext=='categoria')?'<li class="breadcrumb-item"><a href="'.$page_url.$mod.'/categoria/'.$IDc.'-'.$cate.'">'.$IDc.'-'.$nom_cate.'</a></li>':'';
		echo ($ext=='item' || $ext=='subcategoria')?'<li class="breadcrumb-item"><a href="'.$page_url.$mod.'/subcategoria/'.$IDsc.'-'.$subcate.'">'.$IDsc.'-'.$nom_subcate.'</a></li>':'';
		echo ($ext=='item')?'<li class="breadcrumb-item">'.$id_producto.'-'.$nom_producto.'</li>':'';
	}
}

function menu_categoria(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$id,$idp,$tema_previo;	
cadena_replace($replace1,$replace2);

echo '
<link href="'.$page_url.'modulos/productos/css/menup.css" rel="stylesheet">
<script src="'.$page_url.'modulos/productos/js/ddaccordion.js" type="text/javascript"></script>
<script type="text/javascript">
//Initialize first demo:
ddaccordion.init({
    headerclass: "mypets", //Shared CSS class name of headers group-compartido CSS nombre de la clase de grupo encabezados
    contentclass: "thepet", //Shared CSS class name of contents group-compartido CSS nombre de la clase de grupo de contenidos
    revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"-Reveal contenido cuando el usuario hace clic o onmouseover la cabecera ? Valor válido: " click", " clickgo " , o " mouseover "
    mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover-si revealtype = " mouseover " , establecer el retardo en milisegundos antes de cabecera expande onMouseover
    collapseprev: true, //Collapse previous content (so only one open at any time)? true/false-//Contraer contenido anterior ( lo único abierto en cualquier momento) ? verdadero / falso 
    defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.-//índice de contenido ( s ) abierta por defecto [ index1 , index2 , etc] . [] Denota ningún contenido .
    onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
    animatedefault: true, //Should contents open by default be animated into view?-En caso de contenidos abiertos por defecto será animado a la vista ?
    persiststate: true, //persist state of opened contents within browser session?-//persistir estado de contenidos abiertos en la sesión del navegador ?
    toggleclass: ["", "openpet"], //Two CSS classes to be applied to the header when it\'s collapsed and expanded, respectively ["class1", "class2"]-// Dos clases CSS que se aplicarán a la cabecera cuando se derrumbó y se expandió , respectivamente [" class1 " , " clase 2 " ]
    togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it\'s collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)-//HTML adicional añade a la cabecera cuando se derrumbó y se expandió , respectivamente [" posición" , " html1 " , " HTML2 " ] ( ver docs )
    animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"-//velocidad de la animación : entero en milisegundos ( es decir : 200 ), o palabras clave "rápida", "normal " , o "lento"
    oninit:function(headers, expandedindices){ //custom code to run when headers have initalized-//código personalizado para ejecutarse cuando cabeceras han initalized
        //do nothing
    },
    onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
        //do nothing
    }
})
</script>
';
//Menu-Categoria
if($ext=='categoria'){//$ID_cate=sql_opc('productos_cate','ID','ID',$idp);
	if($idp){
		echo '<style>.cate_'.$idp.'{color:#77BD1E !important;background:#eee;border-bottom:0px solid #c00;font-weight:700;}</style>';
	}
}
//Menu-Subcategoria
if($ext=='subcategoria'){//$ID_sub_cate=sql_opc('productos_sub_cate','ID','ID',$idp);
	$ID_cate=sql_opc('productos_sub_cate','ID_cate','ID',$idp);
	if($idp){
		echo '<style>.subcat_'.$idp.'{color:#77BD1E !important;background:#eee;border-bottom:0px solid #c00;font-weight:700;}.cate_'.$ID_cate.'{color:#77BD1E !important;background:#eee;border-bottom:0px solid #c00;font-weight:700;}</style>';
	}
}
//Menu-Item
if($ext=='item'){
	$row = sql_row('productos','ID',$idp);
	$ID_sub_cate = $row['ID_sub_cate'];
	$ID_cate = $row['ID_cate'];
	if($ID_sub_cate && $ID_cate){
		echo '<style>.subcat_'.$ID_sub_cate.'{color:#77BD1E !important;background:#eee;border-bottom:0px solid #c00;font-weight:700;}.cate_'.$ID_cate.'{color:#77BD1E !important;background:#eee;border-bottom:0px solid #c00;font-weight:700;}</style>';
	}
}

//MENU
	$sql=sqlQuery('productos_cate', 'WHERE visible=1 ORDER BY ord ASC');//print_r($rows);
	while($row=mysqli_fetch_array($sql)){
		$ID_cate = $row['ID'];
		$ID_ord = $row['ord'];
		$icon=$row['icon'];
		$cate = $row['categoria'];
		$categoria=str_replace($replace1,$replace2,$cate);
		$link1=($tema_previo='')?$page_url.'index.php?mod=productos&ext=categoria&id='.$ID_cate.'&tema_previo='.$tema_previo:$page_url.'productos/categoria/'.$ID_cate.'-'.$categoria;
		//$icono=($icon=='' && $icon==NULL)?'<div id="circulo"></div>&nbsp;&nbsp;':'<i class="fa '.$icon.'"></i>&nbsp;&nbsp;';
		echo '<div class="mypets">'.$icono.'<a class="cate_'.$ID_cate.'" href="'.$link1.'">'.$ID_ord.'&nbsp;'.$cate.'</a></div>'."\n";
		echo '<div class="thepet">'."\n";
		$sql2=sqlQuery('productos_sub_cate', 'WHERE visible=1 AND ID_cate='.$ID_cate.' ORDER BY ID ASC');//print_r($rows);
		while($row2=mysqli_fetch_array($sql2)){
			$ID_sub_cate = $row2['ID'];
			$ID_ord2=$row2['ord'];
			$sub_cate=ucfirst($row2["subcategoria"]);
			$subcategoria=str_replace($replace1,$replace2,$row2['subcategoria']);
			$link2=($tema_previo!='')?$page_url.'index.php?mod=productos&ext=subcategoria&id='.$ID_sub_cate.'&tema_previo='.$tema_previo:$page_url.'productos/subcategoria/'.$ID_sub_cate.'-'.$subcategoria;
            echo '<!--i class="fa fa-plus"></i--><a class="subcat_'.$ID_sub_cate.'" href="'.$link2.'">'.$ID_ord.$ID_ord2.'&nbsp;'.wordwrap($sub_cate, 75, '<br>').'</a>';				       
		}
		echo '</div>'."\n";
	}
}

function item_cate(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;

$menu_json='categorias.json';
$path_JSON='modulos/productos/'.$menu_json;

if(file_exists($path_JSON) && filesize($path_JSON)!=0){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- categorias.json -->';
	foreach ($Data as $reg){$i++;
		$ID_cate=$reg['ID'];
		cadena_replace($replace1,$replace2);
		$categoria=str_replace($replace1,$replace2,$reg['categoria']);
		$nom_categoria=$reg['categoria'];
		$cover=$reg['cover'];
		$visible=$reg['visible'];

		if($visible==1){
$tema_p=$_GET['tema_previo'];
$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=categoria&id='.$ID_cate.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/categoria/'.$ID_cate.'-'.$categoria.'">';
		echo '<!--['.$i.'] -'.$ID_cate.'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_categoria.'</p>
               		<!--h4 style="">'.$nom_categoria.'</h4-->
			   </div>
               <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                  <!--div class="image_wrapper"><img class="scale-with-grid" src="https://themes.muffingroup.com/be/agro/wp-content/uploads/2015/06/home_agro_heading_icon2.png" alt="home_agro_heading_icon2" title="home_agro_heading_icon2" width="27" height="24"></div-->
               </div>
               <!--hr class="no_line" style="margin: 0 auto 20px;"-->
               <!--a class="button  button_size_2 button_theme button_js" href="#"><span class="button_label">Read more</span></a-->
            </div>
			</a>
         </div>
			';
		}
	}
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
 }
 echo '<!-- /categorias.json -->';
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID_cate=$reg['ID'];
		cadena_replace($replace1,$replace2);
		$categoria=str_replace($replace1,$replace2,$reg['categoria']);
		$nom_categoria=$reg['categoria'];
		$cover=$reg['cover'];
		//$visible=$reg['visible'];
$tema_p=$_GET['tema_previo'];
$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=categoria&id='.$ID_cate.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/categoria/'.$ID_cate.'-'.$categoria.'">';
		echo'<!--'.$ID_cate.'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_categoria.'</p>
               		<!--h4 style="">'.$nom_categoria.'</h4-->
			   </div>
               <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                  <!--div class="image_wrapper"><img class="scale-with-grid" src="https://themes.muffingroup.com/be/agro/wp-content/uploads/2015/06/home_agro_heading_icon2.png" alt="home_agro_heading_icon2" title="home_agro_heading_icon2" width="27" height="24"></div-->
               </div>
               <!--hr class="no_line" style="margin: 0 auto 20px;"-->
               <!--a class="button  button_size_2 button_theme button_js" href="#"><span class="button_label">Read more</span></a-->
            </div>
			</a>
         </div>
		';
	}

  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
  }
  echo '<!--/ mysql -->';
 }
}

function item_sub_cate($id){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;

$menu_json='subcategorias.json';
$path_JSON='modulos/productos/'.$menu_json;

if(file_exists($path_JSON) && filesize($path_JSON)!=0){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- subcategoria.json -->';
	foreach ($Data as $reg){$i++;
		$ID_sub_cate=$reg['ID'];
		$ID_cate=$reg['ID_cate'];
		cadena_replace($replace1,$replace2);
		$subcategoria=str_replace($replace1,$replace2,$reg['subcategoria']);
		$nom_subcategoria=$reg['subcategoria'];
		$cover=$reg['cover'];
		$visible=$reg['visible'];		
		if($visible==1 && $ID_cate==$id){
$tema_p=$_GET['tema_previo'];
$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=subcategoria&id='.$ID_sub_cate.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/subcategoria/'.$ID_sub_cate.'-'.$subcategoria.'">';
		echo '<!--['.$i.'] -'.$ID_sub_cate.'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_subcategoria.'</p>
               		<!--h4 style="">'.$nom_subcategoria.'</h4-->
			   </div>
               <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                  <!--div class="image_wrapper"><img class="scale-with-grid" src="https://themes.muffingroup.com/be/agro/wp-content/uploads/2015/06/home_agro_heading_icon2.png" alt="home_agro_heading_icon2" title="home_agro_heading_icon2" width="27" height="24"></div-->
               </div>
               <!--hr class="no_line" style="margin: 0 auto 20px;"-->
               <!--a class="button  button_size_2 button_theme button_js" href="#"><span class="button_label">Read more</span></a-->
            </div>
			</a>
         </div>
		 	';
		}
	}
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
 }
	echo '<!-- /subcategorias.json -->';
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 AND ID_cate=".$id." ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID_sub_cate=$reg['ID'];
		$ID_cate=$reg['ID_cate'];
		cadena_replace($replace1,$replace2);
		$subcategoria=str_replace($replace1,$replace2,$reg['subcategoria']);
		$nom_subcategoria=$reg['subcategoria'];
		$cover=$reg['cover'];
		//$visible=$reg['visible'];
$tema_p=$_GET['tema_previo'];
$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=subcategoria&id='.$ID_sub_cate.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/subcategoria/'.$ID_sub_cate.'-'.$subcategoria.'">';
		echo'<!-- '.$ID_sub_cate.'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_subcategoria.'</p>
               		<!--h4 style="">'.$nom_subcategoria.'</h4-->
			   </div>
               <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                  <!--div class="image_wrapper"><img class="scale-with-grid" src="https://themes.muffingroup.com/be/agro/wp-content/uploads/2015/06/home_agro_heading_icon2.png" alt="home_agro_heading_icon2" title="home_agro_heading_icon2" width="27" height="24"></div-->
               </div>
               <!--hr class="no_line" style="margin: 0 auto 20px;"-->
               <!--a class="button  button_size_2 button_theme button_js" href="#"><span class="button_label">Read more</span></a-->
            </div>
			</a>
         </div>
		';
	}
  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
  }
	echo '<!--/ mysql -->';
 }
}

function one_producto2($id){
global $mysqli,$DBprefix,$page_url,$path_tema,$mod,$ext,$opc;

$menu_json='productos.json';
$path_JSON='modulos/productos/'.$menu_json;

if(file_exists($path_JSON) && filesize($path_JSON)!=0){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- productos.json -->';
	foreach ($Data as $reg){$i++;
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$precio=$reg['precio'];
		$moneda=$reg['moneda'];
		$codigo=$reg['clave'];
		$resena=$reg['resena'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$imagen2=$reg['imagen2'];
		$imagen3=$reg['imagen3'];
		$imagen4=$reg['imagen4'];
		$imagen5=$reg['imagen5'];
		$pdf=$reg['file'];
		$tipo=$reg['tipo'];
		$visible=$reg['visible'];
		
		//setlocale(LC_MONETARY, 'es_MX');
		$precio=number_format($reg['precio'], 2, '.', ',');

		
		if($visible==1 && $ID==$id){
		$pdf_img=($pdf!='')?'<img src="'.$page_url.'modulos/productos/fotos/pdf_icon.png" width="25"> <a target="_blank" href="'.$page_url.'modulos/productos/pdf/'.$pdf.'" class="al">DESCARGA FICHAS TECNICAS</a>':'&nbsp;';
/*
		echo '<!--['.$i.'] -'.$ID.'-->	
<div class="section mcb-section   " style="padding-top:0px; padding-bottom:0px; background-color:">
   <div class="section_wrapper mcb-section-inner">
      <div class="wrap mcb-wrap one clearfix" style="">
         <div class="mcb-wrap-inner">
            <div class="column mcb-column two-third column_hover_box ">
               <div class="hover_box">
                  <a href="#">
                     <div class="hover_box_wrapper"><img class="visible_photo scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="img1" width="575" height="575"><img class="hidden_photo scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="img2" width="575" height="575"></div>
                  </a>
               </div>
            </div>
            <div class="column mcb-column one-third column_column ">
               <div class="column_attr clearfix" style="">
                  <div style="margin: 0px 5% 0 10px;">
                     <p class="themecolor">'.$nom_producto.'</p>
					 <div class="cat">'.$tipo.'</div>
               		 <div class="column_attr clearfix" style="">
                  		<div style="background: url('.$page_url.$path_tema.'img/home_agro_sep.png) repeat-x; height: 3px;"></div>
                  		<hr class="no_line" style="margin: 0 auto 20px;">
               		 </div>
                     <div style="text-align:justify">'.$descripcion.'</div>
					 <p>'.$pdf_img.'</p>
                     <p style="text-align:justify">'.$resena.'</p>
                  </div>
               </div>
            </div>
            <!--div class="column mcb-column one column_column "></div-->
         </div>
      </div>
   </div>
</div>		
		';
*/		
		echo '
                    <div class="col-lg-9">
                        <div class="product-single-container product-single-default">
                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                    <div class="product-single-gallery">
                                        <div class="product-slider-container product-item">
                                            <div class="product-single-carousel owl-carousel owl-theme">
';
if($imagen1!=''){
echo'
<div class="product-item"><img class="product-single-image" src="'.$page_url.'modulos/productos/fotos/'.$imagen1.'" data-zoom-image="'.$page_url.'modulos/productos/fotos/'.$imagen1.'"/></div>';
}
if($imagen2!=''){
echo'
<div class="product-item"><img class="product-single-image" src="'.$page_url.'modulos/productos/fotos/'.$imagen2.'" data-zoom-image="'.$page_url.'modulos/productos/fotos/'.$imagen2.'"/></div>';
}
if($imagen3!=''){
echo'
<div class="product-item"><img class="product-single-image" src="'.$page_url.'modulos/productos/fotos/'.$imagen3.'" data-zoom-image="'.$page_url.'modulos/productos/fotos/'.$imagen3.'"/></div>';
}
if($imagen4!=''){
echo'
<div class="product-item"><img class="product-single-image" src="'.$page_url.'modulos/productos/fotos/'.$imagen4.'" data-zoom-image="'.$page_url.'modulos/productos/fotos/'.$imagen4.'"/></div>';
}
if($imagen5!=''){
echo'
<div class="product-item"><img class="product-single-image" src="'.$page_url.'modulos/productos/fotos/'.$imagen5.'" data-zoom-image="'.$page_url.'modulos/productos/fotos/'.$imagen5.'"/></div>';
}
echo '												
                                            </div>
                                            <!-- End .product-single-carousel -->
                                            <span class="prod-full-screen">
                                                <i class="icon-plus"></i>
                                            </span>
                                        </div>
                                        <div class="prod-thumbnail row owl-dots" id="carousel-custom-dots">
';
if($imagen1!=''){
echo'<div class="col-3 owl-dot"><img src="'.$page_url.'modulos/productos/fotos/'.$imagen1.'"/></div>';
}
if($imagen2!=''){
echo'<div class="col-3 owl-dot"><img src="'.$page_url.'modulos/productos/fotos/'.$imagen2.'"/></div>';
}
if($imagen3!=''){
echo'<div class="col-3 owl-dot"><img src="'.$page_url.'modulos/productos/fotos/'.$imagen3.'"/></div>';
}
if($imagen4!=''){
echo'<div class="col-3 owl-dot"><img src="'.$page_url.'modulos/productos/fotos/'.$imagen4.'"/></div>';
}
if($imagen5!=''){
echo'<div class="col-3 owl-dot"><img src="'.$page_url.'modulos/productos/fotos/'.$imagen5.'"/></div>';
}
echo '
                                        </div>
                                    </div><!-- End .product-single-gallery -->
                                </div><!-- End .col-lg-7 -->

                                <div class="col-lg-5 col-md-6">
                                    <div class="product-single-details">
                                        <h1 class="product-title">'.$nom_producto.'</h1>

                                        <div class="ratings-container">
											Código: '.$codigo.'
                                        </div><!-- End .product-container -->

                                        <div class="price-box">
                                            <span class="old-price"></span>
                                            <span class="product-price">$'.$precio.' '.$moneda.'</span>
                                        </div><!-- End .price-box -->

                                        <div class="product-desc">
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.</p>
                                        </div><!-- End .product-desc -->

                                        <div class="product-filters-container">
                                            <div class="product-single-filter">
                                                <label>Colors:</label>
                                                <ul class="config-swatch-list">
                                                    <li class="active">
                                                        <a href="#" style="background-color: #6085a5;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #ab6e6e;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #b19970;"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" style="background-color: #11426b;"></a>
                                                    </li>
                                                </ul>
                                            </div><!-- End .product-single-filter -->
                                        </div><!-- End .product-filters-container -->

                                        <div class="product-action">
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control" type="text">
                                            </div><!-- End .product-single-qty -->

                                            <a href="cart.html" class="paction add-cart" title="Add to Cart">
                                                <span>Add to Cart</span>
                                            </a>
                                        </div><!-- End .product-action -->

                                        <div class="product-single-share">
                                            <label>Share:</label>
                                            <!-- www.addthis.com share plugin-->
                                            <div class="addthis_inline_share_toolbox"></div>
                                        </div><!-- End .product single-share -->
                                    </div><!-- End .product-single-details -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-single-container -->
                        <div class="product-single-collapse" id="productAccordion">
                            <div class="product-collapse-panel">
                                <h3 class="product-collapse-title">
                                    <a data-toggle="collapse" href="#product-collapse-desc" role="button" aria-expanded="true" aria-controls="product-collapse-desc">Description</a>
                                </h3>

                                <div class="product-collapse-body collapse show" id="product-collapse-desc" data-parent="#productAccordion">
                                    <div class="collapse-body-wrapper">
                                        <div class="product-desc-content">
											'.$resena.'
											<hr>
                                            <img src="'.$page_url.'modulos/productos/fotos/nodisponible.jpg" alt="image desc" class="float-right">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                            <ul>
                                                <li><i class="icon-ok"></i>Any Product types that You want - Simple, Configurable</li>
                                                <li><i class="icon-ok"></i>Downloadable/Digital Products, Virtual Products</li>
                                                <li><i class="icon-ok"></i>Inventory Management with Backordered items</li>
                                            </ul>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>

                                            <br>

                                            <div class="row">
                                                <div class="col-sm-6 col-md-4">
                                                    <div class="feature-box feature-box-simple text-center">
                                                        <i class="icon-star"></i>

                                                        <div class="feature-box-content">
                                                            <h3>Dedicated Service</h3>
                                                            <p>Consult our specialists for help with an order, customization, or design advice</p>
                                                        </div><!-- End .feature-box-content -->
                                                    </div><!-- End .feature-box -->
                                                </div><!-- End .col-md-4 -->
                                                
                                                <div class="col-sm-6 col-md-4">
                                                    <div class="feature-box feature-box-simple text-center">
                                                        <i class="icon-reply"></i>

                                                        <div class="feature-box-content">
                                                            <h3>Free Returns</h3>
                                                            <p>We stand behind our goods and services and want you to be satisfied with them.</p>
                                                        </div><!-- End .feature-box-content -->
                                                    </div><!-- End .feature-box -->
                                                </div><!-- End .col-md-4 -->

                                                <div class="col-sm-6 col-md-4">
                                                    <div class="feature-box feature-box-simple text-center">
                                                        <i class="icon-paper-plane"></i>

                                                        <div class="feature-box-content">
                                                            <h3>International Shipping</h3>
                                                            <p>Currently over 50 countries qualify for express international shipping.</p>
                                                        </div><!-- End .feature-box-content -->
                                                    </div><!-- End .feature-box -->
                                                </div><!-- End .col-md-4 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .product-desc-content -->
                                    </div><!-- End .collapse-body-wrapper -->
                                </div><!-- End .product-collapse-body -->
                            </div><!-- End .product-collapse-panel -->

                            <div class="product-collapse-panel">
                                <h3 class="product-collapse-title">
                                    <a class="collapsed" data-toggle="collapse" href="#product-collapse-tags" role="button" aria-expanded="false" aria-controls="product-collapse-tags">Tags</a>
                                </h3>

                                <div class="product-collapse-body collapse" id="product-collapse-tags" data-parent="#productAccordion">
                                    <div class="collapse-body-wrapper">
                                        <div class="product-tags-content">
                                            <form action="#">
                                                <h4>Add Your Tags:</h4>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" required>
                                                    <input type="submit" class="btn btn-primary" value="Add Tags">
                                                </div><!-- End .form-group -->
                                            </form>
                                            <p class="note">Use spaces to separate tags. Use single quotes (*) for phrases.</p>
                                        </div><!-- End .product-tags-content -->
                                    </div><!-- End .collapse-body-wrapper -->
                                </div><!-- End .product-collapse-body -->
                            </div><!-- End .product-collapse-panel -->

                            <div class="product-collapse-panel">
                                <h3 class="product-collapse-title">
                                    <a class="collapsed" data-toggle="collapse" href="#product-reviews-content" role="button" aria-expanded="false" aria-controls="product-collapse-reviews">Reviews</a>
                                </h3>

                                <div class="product-collapse-body collapse" id="product-reviews-content" data-parent="#productAccordion">
                                    <div class="collapse-body-wrapper">
                                        <div class="product-reviews-content">
                                            <div class="collateral-box">
                                                <ul>
                                                    <li>Be the first to review this product</li>
                                                </ul>
                                            </div><!-- End .collateral-box -->

                                            <div class="add-product-review">
                                                <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                                <p>How do you rate this product? *</p>

                                                <form action="#">
                                                    <table class="ratings-table">
                                                        <thead>
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Quality</td>
                                                                <td>
                                                                    <input type="radio" name="ratings[1]" id="Quality_1" value="1" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="ratings[1]" id="Quality_2" value="2" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="ratings[1]" id="Quality_3" value="3" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="ratings[1]" id="Quality_4" value="4" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="ratings[1]" id="Quality_5" value="5" class="radio">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Value</td>
                                                                <td>
                                                                    <input type="radio" name="value[1]" id="Value_1" value="1" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="value[1]" id="Value_2" value="2" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="value[1]" id="Value_3" value="3" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="value[1]" id="Value_4" value="4" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="value[1]" id="Value_5" value="5" class="radio">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Price</td>
                                                                <td>
                                                                    <input type="radio" name="price[1]" id="Price_1" value="1" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="price[1]" id="Price_2" value="2" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="price[1]" id="Price_3" value="3" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="price[1]" id="Price_4" value="4" class="radio">
                                                                </td>
                                                                <td>
                                                                    <input type="radio" name="price[1]" id="Price_5" value="5" class="radio">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="form-group">
                                                        <label>Nickname <span class="required">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" required>
                                                    </div><!-- End .form-group -->
                                                    <div class="form-group">
                                                        <label>Summary of Your Review <span class="required">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" required>
                                                    </div><!-- End .form-group -->
                                                    <div class="form-group mb-2">
                                                        <label>Review <span class="required">*</span></label>
                                                        <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                                    </div><!-- End .form-group -->

                                                    <input type="submit" class="btn btn-primary" value="Submit Review">
                                                </form>
                                            </div><!-- End .add-product-review -->
                                        </div><!-- End .product-reviews-content -->
                                    </div><!-- End .collapse-body-wrapper -->
                                </div><!-- End .product-collapse-body -->
                            </div><!-- End .product-collapse-panel -->
                        </div><!-- End .product-single-collapse -->

		';		
		}
	}
	if($i==0){
				echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay productos disponibles.</div>
				</div>
  				';
	}
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
 }
	echo '<!-- /productos.json -->';
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE visible=1 AND ID=".$id." ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	if($reg=mysqli_fetch_array($sql)){

		$ID=$reg['ID'];
		$cover=$reg['cover'];
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$precio=$reg['precio'];
		$moneda=$reg['moneda'];
		$codigo=$reg['clave'];
		$resena=$reg['resena'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$imagen2=$reg['imagen2'];
		$imagen3=$reg['imagen3'];
		$imagen4=$reg['imagen4'];
		$imagen5=$reg['imagen5'];
		$pdf=$reg['file'];
		$tipo=$reg['tipo'];
		$visible=$reg['visible'];
		
		//setlocale(LC_MONETARY, 'es_MX');
		$precio=number_format($reg['precio'], 2, '.', ',');
		//$visible=$reg['visible'];
		$pdf_img=($pdf!='')?'<img src="'.$page_url.'modulos/productos/fotos/pdf_icon.png" width="25"> <a target="_blank" href="'.$page_url.'modulos/productos/pdf/'.$pdf.'" class="al">DESCARGA FICHAS TECNICAS</a>':'&nbsp;';
		echo '<!--'.$reg['ID'].'-->
<div class="section mcb-section   " style="padding-top:0px; padding-bottom:0px; background-color:">
   <div class="section_wrapper mcb-section-inner">
      <div class="wrap mcb-wrap one clearfix" style="">
         <div class="mcb-wrap-inner">
            <div class="column mcb-column two-third column_hover_box ">
               <div class="hover_box">
                  <a href="#">
                     <div class="hover_box_wrapper"><img class="visible_photo scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="img1" width="575" height="575"><img class="hidden_photo scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="img2" width="575" height="575"></div>
                  </a>
               </div>
            </div>
            <div class="column mcb-column one-third column_column ">
               <div class="column_attr clearfix" style="">
                  <div style="margin: 0px 5% 0 10px;">
                     <p class="themecolor">'.$nom_producto.'</p>
					 <div class="cat">'.$tipo.'</div>
               		 <div class="column_attr clearfix" style="">
                  		<div style="background: url('.$page_url.$path_tema.'img/home_agro_sep.png) repeat-x; height: 3px;"></div>
                  		<hr class="no_line" style="margin: 0 auto 20px;">
               		 </div>
                     <div style="text-align:justify">'.$descripcion.'</div>
					 <p>'.$pdf_img.'</p>
                     <p style="text-align:justify">'.$resena.'</p>
                  </div>
               </div>
            </div>
            <!--div class="column mcb-column one column_column "></div-->
         </div>
      </div>
   </div>
</div>		
			';
	}
  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
  }
	echo '<!--/ mysql -->';
 }
}


function productos_destacados(){
global $mysqli,$DBprefix,$page_url,$path_tema,$mod,$ext,$opc;
sql_opciones('link_productos',$valor);
$menu_json='productos.json';
$path_JSON='modulos/productos/'.$menu_json;

if(file_exists($path_JSON) && filesize($path_JSON)!=0){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);

if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- productos.json -->';
	foreach ($Data as $reg){$i++;
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$destacado=$reg['land'];
		$visible=$reg['visible'];
		
		if($visible==1 && $destacado==1){
		$objData2=file_get_contents("modulos/productos/categorias.json");
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $row){
				$ID_cate2=$row['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$row['categoria'];
				}
			}
			
		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod=productos&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--['.$i.'] -'.$reg['ID'].'-->
<!--
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_producto.'</p>
					<!--('.$ID_cate.')->
               		<h4 style="">'.$categoria.'</h4>
			   </div>
               <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                  <!--div class="image_wrapper"><img class="scale-with-grid" src="https://themes.muffingroup.com/be/agro/wp-content/uploads/2015/06/home_agro_heading_icon2.png" alt="home_agro_heading_icon2" title="home_agro_heading_icon2" width="27" height="24"></div->
               </div>
               <!--hr class="no_line" style="margin: 0 auto 20px;"->
               <!--a class="button  button_size_2 button_theme button_js" href="#"><span class="button_label">Read more</span></a->
            </div>
			</a>
         </div>
-->
                                        <div class="column mcb-column one-fourth column_column  column-margin-">
                                            <div class="column_attr clearfix align_center" style=" padding:0 3% 0 0;">
                                                <hr class="no_line" style="margin: 0 auto 20px;" />
                                                <div style="padding: 20px 6%; background: url('.$page_url.$path_tema.'img/home_agro_sep2.png) repeat-y right top">
												'.$link_zp.'
                                                <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                                    <div class="image_wrapper"><img class="scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="home_agro_product1s" width="380" height="282" /></div>
                                                </div>
                                                    <p style="font-weight:700; text-transform:uppercase;" class="themecolor">'.$nom_producto.'</p>
                                                    <p style="color:#444; font-weight:700;">'.$categoria.'</p>
                                                    <!--p style="margin: 0px;"><i class="icon-doc-text themecolor"></i> <a href="#">Phasellus fermen</a></p-->
                                                </div>
												</a>
                                            </div>
                                        </div>
			';
		}
	}
	if($i==0){
				echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay productos disponibles.</div>
				</div>
  				';
	}

 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
 }
 echo '<!-- /productos.json -->';
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE visible=1 AND land=1 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		cadena_replace($replace1,$replace2);
		$producto=str_replace($replace1,$replace2,$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		//$visible=$reg['visible'];

		$sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate=".$ID_cate.";") or print mysqli_error($mysqli); 
		while($row=mysqli_fetch_array($sql2)){$categoria=$row['categoria'];}

		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod=productos&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--'.$reg['ID'].'-->
                                        <div class="column mcb-column one-fourth column_column  column-margin-">
                                            <div class="column_attr clearfix align_center" style=" padding:0 3% 0 0;">
                                                <hr class="no_line" style="margin: 0 auto 20px;" />
                                                <div style="padding: 20px 6%; background: url('.$page_url.$path_tema.'img/home_agro_sep2.png) repeat-y right top">
												'.$link_zp.'
                                                <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                                    <div class="image_wrapper"><img class="scale-with-grid" src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="home_agro_product1s" width="380" height="282" /></div>
                                                </div>
                                                    <p style="font-weight:700; text-transform:uppercase;" class="themecolor">'.$nom_producto.'</p>
                                                    <p style="color:#444; font-weight:700;">'.$categoria.'</p>
                                                    <!--p style="margin: 0px;"><i class="icon-doc-text themecolor"></i> <a href="#">Phasellus fermen</a></p-->
                                                </div>
												</a>
                                            </div>
                                        </div>
			';
	}
  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
  }
 echo '<!--/ mysql -->';
 }
}
?>