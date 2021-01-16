<?php 
/*
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."home_config WHERE activo=1;") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	$id_h=$row['ID'];
	$titulo=$row['titulo'];
	$contenido=$row['contenido'];
	$activo=$row['activo'];
}
*/
function html_iso(&$menu1,&$tit_sec){
global $chartset;
	if($chartset=='iso-8859-1'){
		$menu1=htmlentities($menu1, ENT_COMPAT,'ISO-8859-1', true);
		$tit_sec=htmlentities($tit_sec, ENT_COMPAT,'ISO-8859-1', true);
	}
}

function html_iso_slider(&$tit1,&$tit2,&$btn){
global $chartset;
 if($chartset=='iso-8859-1'){
	$tit1=htmlentities($tit1, ENT_COMPAT,'ISO-8859-1', true);
	$tit2=htmlentities($tit2, ENT_COMPAT,'ISO-8859-1', true);
	$btn=htmlentities($btn, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function html_iso_testimonio(&$pro,&$comentario){
global $chartset;
 if($chartset=='iso-8859-1'){
	$pro=htmlentities($pro, ENT_COMPAT,'ISO-8859-1', true);
	$comentario=htmlentities($comentario, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function select_menu($subm){
global $mysqli,$DBprefix;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE subm='' ORDER BY ID ASC;") or print mysqli_error($mysqli);
echo '<select class="form-control" id="subm" name="subm">
<option value="">Seleccionar Menu</option>';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row['ID']==$subm) ? ' selected' : '';
		echo '<option value="'.$row['ID'].'"'.$seleccion.'>'.$row['menu'].'</option>';
	}
echo '</select>';	
}

/*
function productos_nuevos_promo($secc){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$tema_previo;
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

$nomt='productos';
$fjson=$nomt.'.json';
$path_JSON='modulos/productos/'.$fjson;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$nomt.'/';}
$op_f=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
echo $op_f;

 if($path_JSON){
 $objData=file_get_contents($path_JSON);
 $Data=json_decode($objData,true);
 $i=0;
	foreach ($Data as $rowm){$i++;
		$replace1=array(' ','.',',','(',')','/','á','é','í','ó','ú','Á','É','Í','Ó','Ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ');
		$replace2=array('-','-','-','-','-','-','a','e','i','o','u','A','E','I','O','U','a','e','i','o','u','A','E','I','O','U','n','N');

		$ID=$rowm['ID'];
		$codigo=$rowm['clave'];
		$producto=str_replace($replace1,$replace2,$rowm['nombre']);
		$nom_producto=$rowm['nombre'];
		$cover=$rowm['cover'];
		$descripcion=$rowm['descripcion'];
		$marca=$rowm['marca'];
		$tipo=$rowm['tipo'];
		$precio=$rowm['precio'];
		$moneda=$rowm['moneda'];
		$unidad=$rowm['unidad'];
		$stock=$rowm['stock'];
		$ID_cate=$rowm['ID_cate'];
		$ID_sub_cate=$rowm['ID_sub_cate'];
		$ID_sub_cate2=$rowm['ID_sub_cate2'];
		$ID_marca=$rowm['ID_marca'];
		$url_name=$rowm['url_name'];
		$imagen1=$rowm['imagen1'];
		$imagen2=$rowm['imagen2'];
		$imagen3=$rowm['imagen3'];
		$imagen4=$rowm['imagen4'];
		$imagen5=$rowm['imagen5'];
		$cate=$rowm['cate'];
		$resena=$rowm['resena'];
		$nuevo=$rowm['nuevo'];
		$promo=$rowm['promo'];
		$descuento=$rowm['descuento'];
		$tags=$rowm['tags'];
		$land=$rowm['land'];
		$file=$rowm['file'];
		$pdf1=$rowm['pdf1'];
		$pdf2=$rowm['pdf2'];
		$pdf3=$rowm['pdf3'];
		$pdf4=$rowm['pdf4'];
		$pdf5=$rowm['pdf5'];
		$alta=$rowm['alta'];
		$fmod=$rowm['fmod'];
		//$user=$rowm['user'];
		$visible=$rowm['visible'];
		$link_zp=($tema_previo!='' || $link_pro==1)?$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_p:$page_url.'productos/item/'.$ID.'-'.$producto;

		$vista_rapida=($b_vista_rapida==1)?'<a href="#" class="btn-quickview">Vista Rapida</a>':'';
		$rate=($e_rates==1)?'   <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- End .product-container -->':'';
		$price=($ver_precio==1)?'<div class="price-box">
                                    <span class="product-price">$'.$precio.' '.$moneda.'</span>
                                </div><!-- End .price-box -->':'';
		$ver_mas=($b_ver_pro==1)?'<div class="btn-pro-box">
                                	<a href="'.$link_zp.'" class="btn-cer">Ver Producto</a>
                                </div>':'';
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
	

		if($visible==1 && $nuevo==1 && $secc=='nuevos'){
			echo '
                        <div class="product">
                            <figure class="product-image-container">
                                <a href="'.$link_zp.'" class="product-image">
                                    <img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="product">
                                </a>
								<div class="btn-nuevo2">Nuevo</div>                             
								'.$vista_rapida.'	
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
                            </div><!-- End .product-details -->
                        </div>';		
		}//if
		if($visible==1 && $promo==1 && $secc=='promos'){
			echo '
                        <div class="product">
                            <figure class="product-image-container">
                                <a href="'.$link_zp.'" class="product-image">
                                    <img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" alt="product">
                                </a>                            
								'.$vista_rapida.'	
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
                            </div><!-- End .product-details -->
                        </div>';		
		}//if		
	}//foreach
 }//ifelse{
			echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay productos disponibles.</div>
				  </div>';
		}
}//if

*/

?>