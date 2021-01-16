<?php 
function html_iso(&$nombre,&$cate,&$des){
global $chartset;
 if($chartset=='iso-8859-1'){
	$nombre=htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	//$resena = $resena, ENT_COMPAT,'ISO-8859-1', true);	
	$cate=htmlentities($cate, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function select_cate($cate){
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate ORDER BY ID_cate ASC;") or print mysqli_error($mysqli);
echo '<select class="form-control" id="cate" name="cate">';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row['ID_cate']==$cate) ? 'selected' : '';
		echo '<option value="'.$row['ID_cate'].'" '.$seleccion.'>'.$row['categoria'].'</option>';
	}
echo '</select>';	
}

function select_sub_cate($cate,$subcate){
global $mysqli,$DBprefix,$opc;
$cond=($opc=='edit')?"WHERE ID_cate='{$cate}' ":'';	
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate ".$condi."ORDER BY ID_sub_cate ASC;") or print mysqli_error($mysqli);
echo '<select class="form-control" id="subcate" name="subcate">
<option value="">Seleccionar</option>';
	while($row=mysqli_fetch_array($sql)){
		$sql1=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate='".$row['ID_cate']."' ORDER BY ID_cate ASC;") or print mysqli_error($mysqli);
		while($row1=mysqli_fetch_array($sql1)){$categoria=$row1['categoria'];}
		$seleccion=($row['ID_sub_cate']==$subcate) ? 'selected' : '';
		echo '<option value="'.$row['ID_sub_cate'].'" '.$seleccion.'>'.$row['subcategoria'].'-'.$categoria.'</option>';
	}
echo '</select>';	
}

function menu_categoria(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$id,$idp;	
$replace=array(' ','.',',','(',')');
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
if($mod=='productos' && $ext=='categoria'){
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 AND ID_cate='{$idp}' ORDER BY ord") or print mysqli_error($mysqli);
	if($row=mysqli_fetch_array($sql)){$ID_cate=$row['ID_cate'];}
	if($ID_cate==$idp){
		echo '<style>.cate_'.$ID_cate.'{border-bottom:2px solid #c00;}</style>';
	}
}
//Menu-Subcategoria
if($mod=='productos' && $ext=='subcategoria'){
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 AND ID_sub_cate='{$idp}' ORDER BY ord") or print mysqli_error($mysqli);
	if($row=mysqli_fetch_array($sql)){$ID_sub_cate=$row['ID_sub_cate'];$ID_cate=$row['ID_cate'];}
	if($ID_sub_cate==$idp){
		echo '<style>.subcat_'.$ID_sub_cate.'{border-bottom:2px solid #c00;}.cate_'.$ID_cate.'{border-bottom:2px solid #c00;}</style>';
	}
}
//MENU
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 ORDER BY ord") or print mysqli_error($mysqli);
	while($row=mysqli_fetch_array($sql)){$icon=$row['icon'];$categoria=str_replace($replace,"-",$row['categoria']);
		$link1=($_GET['tema_previo']!='')?$page_url.'index.php?mod=productos&ext=categoria&id='.$row['ID_cate'].'&tema_previo='.$_GET['tema_previo']:$page_url.'productos/categoria/'.$row['ID_cate'].'-'.$categoria;
		$icono=($icon=='' && $icon==NULL)?'<div id="circulo"></div>&nbsp;&nbsp;':'<i class="fa '.$icon.'"></i>&nbsp;&nbsp;';
		echo '<div class="mypets">'.$icono.'<a class="cate_'.$row['ID_cate'].'" href="'.$link1.'">'.$row['categoria'].'</a></div>'."\n";
		echo '<div class="thepet">'."\n";
        $sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 AND ID_cate={$row[ID_cate]} ORDER BY ID_sub_cate") or print mysqli_error($mysqli);
        while($row2=mysqli_fetch_array($sql2)){$sub_cate=ucfirst($row2["subcategoria"]);$subcategoria=str_replace($replace,"-",$row2['subcategoria']);
			$link2=($_GET['tema_previo']!='')?$page_url.'index.php?mod=productos&ext=subcategoria&id='.$row2['ID_sub_cate'].'&tema_previo='.$_GET['tema_previo']:$page_url.'productos/subcategoria/'.$row2['ID_sub_cate'].'-'.$subcategoria;
            echo '<i class="fa fa-plus"></i>&nbsp;&nbsp;-<a class="subcat_'.$row2['ID_sub_cate'].'" href="'.$link2.'">'.wordwrap($sub_cate, 75, '<br>').'</a><div id="espacio"></div>';				       
        }
        echo '</div>'."\n";
	}
}

function item_productos($id){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$visible=$reg['visible'];
		
		if($visible==1 && $ID_cate==$id && $ID_sub_cate==0){
		$objData2=file_get_contents("modulos/productos/categorias.json");
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $row){
				$ID_cate2=$row['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$row['categoria'];
				}
			}
			
		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--['.$i.'] -'.$reg['ID'].'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_producto.'</p>
					<!--('.$ID_cate.')-->
               		<h4 style="">'.$categoria.'</h4>
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE visible=1 AND ID_cate=".$id." AND ID_sub_cate=0 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		//$visible=$reg['visible'];

		$sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate=".$ID_cate.";") or print mysqli_error($mysqli); 
		while($row=mysqli_fetch_array($sql2)){$categoria=$row['categoria'];}

		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--'.$reg['ID'].'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_producto.'</p>
					<!--('.$ID_cate.')-->
               		<h4 style="">'.$categoria.'</h4>
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

function item_subproductos($id,$idp){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$visible=$reg['visible'];

		if($visible==1 && $ID_sub_cate==$id){
		$objData2=file_get_contents("modulos/productos/categorias.json");
		$Data2=json_decode($objData2,true);
			foreach ($Data2 as $row){
				$ID_cate2=$row['ID_cate'];
				if($ID_cate==$ID_cate2){
					$categoria=$row['categoria'];
				}
			}

		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--['.$i.'] -'.$reg['ID'].'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_producto.'</p>
					<!--('.$ID_cate.')-->
               		<h4 style="">'.$categoria.'</h4>
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos WHERE visible=1 AND ID_sub_cate=".$id." ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		//$visible=$reg['visible'];

		$sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate=".$ID_cate.";") or print mysqli_error($mysqli); 
		while($row=mysqli_fetch_array($sql2)){$categoria=$row['categoria'];}

		$tema_p=$_GET['tema_previo'];
		$link_zp=($tema_p!='')?'<a href="'.$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.'&tema_previo='.$tema_p.'">':'<a href="'.$page_url.'productos/item/'.$ID.'-'.$producto.'">';
		echo '<!--'.$reg['ID'].'-->
         <div class="column mcb-column one-third column_column ">
		 	'.$link_zp.'
            <div class="column_attr clearfix align_center" style="">
               <div class="cover-img"><img src="'.$page_url.'modulos/productos/fotos/'.$cover.'" width="270" height="270"></div>
               <div class="info-content">
               		<p class="themecolor">'.$nom_producto.'</p>
					<!--('.$ID_cate.')-->
               		<h4 style="">'.$categoria.'</h4>
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
		$ID_cate=$reg['ID_cate'];
		$replace=array(' ','.',',','(',')');
		$categoria=str_replace($replace,"-",$reg['categoria']);
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 ORDER BY ID_cate ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID_cate=$reg['ID_cate'];
		$replace=array(' ','.',',','(',')');
		$categoria=str_replace($replace,"-",$reg['categoria']);
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
		$ID_sub_cate=$reg['ID_sub_cate'];
		$ID_cate=$reg['ID_cate'];
		$replace=array(' ','.',',','(',')');
		$subcategoria=str_replace($replace,"-",$reg['subcategoria']);
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
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 AND ID_cate=".$id." ORDER BY ID_sub_cate ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID_sub_cate=$reg['ID_sub_cate'];
		$ID_cate=$reg['ID_cate'];
		$replace=array(' ','.',',','(',')');
		$subcategoria=str_replace($replace,"-",$reg['subcategoria']);
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

function one_producto($id){
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$resena=$reg['resena'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$pdf=$reg['file'];
		$tipo=$reg['tipo'];
		$visible=$reg['visible'];
		if($visible==1 && $ID==$id){
		$pdf_img=($pdf!='')?'<img src="'.$page_url.'modulos/productos/fotos/pdf_icon.png" width="25"> <a target="_blank" href="'.$page_url.'modulos/productos/pdf/'.$pdf.'" class="al">DESCARGA FICHAS TECNICAS</a>':'&nbsp;';
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
		$nom_producto=$reg['nombre'];
		$descripcion=$reg['descripcion'];
		$resena=$reg['resena'];
		$ID_cate=$reg['ID_cate'];
		$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$pdf=$reg['file'];
		$tipo=$reg['tipo'];
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
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
		$replace=array(' ','.',',','(',')');
		$producto=str_replace($replace,"-",$reg['nombre']);
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