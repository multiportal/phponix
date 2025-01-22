<?php 
function html_iso_porta(&$nombre,&$des,&$resena,&$cate){
global $chartset;
 if($chartset=='iso-8859-1'){
	$nombre=htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$resena = htmlentities($resena, ENT_COMPAT,'ISO-8859-1', true);	
	$cate=htmlentities($cate, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function cadena_replace(&$replace1,&$replace2){
		$replace1=array(' ','.',',','(',')','/','"','á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;');
		$replace2=array('-','-','-','-','-','-','-','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U');
}

function cate_porta($cate){
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT DISTINCT cate FROM ".$DBprefix."portafolio;") or print mysqli_error($mysqli);
echo '<select class="form-control" id="cate" name="cate">';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row['cate']==$cate) ? 'selected' : '';
		echo '<option value="'.$row['cate'].'" '.$seleccion.'>'.$row['cate'].'</option>';
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
//Menu--Item
if($mod=='productos' && $ext=='item'){
	nombre_cate_subcate($idp,$data_cate_subcate);
	$ID_cate=$data_cate_subcate[1];
	$ID_sub_cate=$data_cate_subcate[3];
	//echo '['.$idp.'] '.$ID_cate.'-'.$ID_sub_cate;
	if($idp!='' && $ID_cate!='' && $ID_sub_cate!=''){
		echo '<style>.subcat_'.$ID_sub_cate.'{border-bottom:2px solid #c00;}.cate_'.$ID_cate.'{border-bottom:2px solid #c00;}</style>';
	}
}
//MENU
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE visible=1 ORDER BY ord") or print mysqli_error($mysqli);
	while($row=mysqli_fetch_array($sql)){$icon=$row['icon'];
		cadena_replace($replace1,$replace2);
		$categoria=str_replace($replace1,$replace2,$row['categoria']);

		$link1=($_GET['tema_previo']!='')?$page_url.'index.php?mod=productos&ext=categoria&id='.$row['ID_cate'].'&tema_previo='.$_GET['tema_previo']:$page_url.'productos/categoria/'.$row['ID_cate'].'-'.$categoria;
		$icono=($icon=='' && $icon==NULL)?'<div id="circulo"></div>&nbsp;&nbsp;':'<i class="fa '.$icon.'"></i>&nbsp;&nbsp;';
		echo '<div class="mypets">'.$icono.'<a class="cate_'.$row['ID_cate'].'" href="'.$link1.'">'.$row['categoria'].'</a></div>'."\n";
		echo '<div class="thepet">'."\n";
        $sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE visible=1 AND ID_cate={$row[ID_cate]} ORDER BY ID_sub_cate") or print mysqli_error($mysqli);
        while($row2=mysqli_fetch_array($sql2)){$sub_cate=ucfirst($row2["subcategoria"]);
			cadena_replace($replace1,$replace2);
			$subcategoria=str_replace($replace1,$replace2,$row2['subcategoria']);

			$link2=($_GET['tema_previo']!='')?$page_url.'index.php?mod=productos&ext=subcategoria&id='.$row2['ID_sub_cate'].'&tema_previo='.$_GET['tema_previo']:$page_url.'productos/subcategoria/'.$row2['ID_sub_cate'].'-'.$subcategoria;
            echo '<i class="fa fa-plus"></i>&nbsp;&nbsp;-<a class="subcat_'.$row2['ID_sub_cate'].'" href="'.$link2.'">'.wordwrap($sub_cate, 75, '<br>').'</a><div id="espacio"></div>';				       
        }
        echo '</div>'."\n";
	}
	//echo '<p>&nbsp;</p><hr>';
	//echo '<p style="color:#333; font-size:10px;">*Las im&aacute;genes son referencia gr&aacute;fica del producto</p>';
}

function js_select_text($sel,$nom_ctrl,$id_ele,$col,$table){
/*
$sel=$cate;
$nom_ctrl='cate';
$id_ele='cate_porta';
$col='cate';
$table='portafolio';
*/	
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT DISTINCT ".$col." FROM ".$DBprefix.$table.";") or print mysqli_error($mysqli);
$selector='<select class="form-control" id="'.$nom_ctrl.'" name="'.$nom_ctrl.'">';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row[$col]==$sel) ? 'selected' : '';
		$selector.='<option value="'.$row[$col].'" '.$seleccion.'>'.$row[$col].'</option>';
	}
$selector='</select>';	

echo '
<script>
function add_select_text(val){
	if(val==1){	
		document.getElementById(\''.$id_ele.'\').innerHTML=\'<input type="text" class="form-control" id="'.$nom_ctrl.'" name="'.$nom_ctrl.'" value=""><div><a href="javascript:add_select_text(0);">Cancelar</a></div>\';
	}
	else{
		document.getElementById(\''.$id_ele.'\').innerHTML=\''.$selector.'<div><a href="javascript:add_select_text(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div>\';
	}
}
</script>
';
}

function cate_porta2(){
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT DISTINCT cate FROM ".$DBprefix."portafolio;") or print mysqli_error($mysqli);
	while($row=mysqli_fetch_array($sql)){
		$cate=str_replace('_',' ',$row['cate']);
		echo '<li data-filter="'.$row['cate'].'"><a href="#">'.$cate.'</a></li>';
	}
}

function catalogos(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
sql_opciones('link_var',$valor);
$menu_json='catalogos.json';
$path_JSON='modulos/catalogos/'.$menu_json;

if(file_exists($path_JSON)){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- portafolio.json -->';
	foreach ($Data as $reg){$i++;
		$visible=$reg['visible'];
		if($visible==1){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$nombre=$reg['nombre'];
		$resena=$reg['resena'];
		$pdf=$reg['file'];
		$cate=str_replace('_',' ',$reg['cate']);
		$nom=str_replace(' ','-',$reg['nombre']);
		if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
		$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod=portafolio&ext=item&id='.$ID.$tema_p:$page_url.'portafolio/item/'.$ID.'-'.$nom;
		echo '<!--['.$i.'] -'.$reg['ID'].'-->
                            <div class="column mcb-column one column_column ">
                            	<div class="column_attr clearfix" style="background-color:#eee; color:#666; padding:15px;">
                                	<div id="box_img"><img src="'.$page_url.'modulos/catalogos/fotos/'.$cover.'" style="width:100%"></div>
                                	<div id="box_content">
									<div id="tit_red">'.$nombre.'</div>
                                    <div id="des_cat">'.$resena.'</div>
                                	<div id="box_btn"><a target="_blank" href="'.$page_url.'modulos/catalogos/pdf/'.$pdf.'" class="btn_red">DESCARGAR</a></div>
									</div>
                                </div>
                           	</div>
			';
		}else{
				echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay item.</div>
				</div>
  				';

		}
	}
	echo '<!-- /portafolio.json -->';
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay item.</div>
		</div>
  ';
 }
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."portafolio WHERE visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$nombre=$reg['nombre'];
		$resena=$reg['resena'];
		$pdf=$reg['file'];
		$cate=str_replace('_',' ',$reg['cate']);
		$nom=str_replace(' ','-',$reg['nombre']);
		if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
		$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod=portafolio&ext=item&id='.$ID.$tema_p:$page_url.'portafolio/item/'.$ID.'-'.$nom;
		echo'<!-- '.$reg['ID'].'-->
                            <div class="column mcb-column one column_column ">
                            	<div class="column_attr clearfix" style="background-color:#eee; color:#666; padding:15px;">
                                	<div id="box_img"><img src="'.$page_url.'modulos/catalogos/fotos/'.$cover.'" style="width:100%"></div>
                                	<div id="box_content">
									<div id="tit_red">'.$nombre.'</div>
                                    <div id="des_cat">'.$resena.'</div>
                                	<div id="box_btn"><a target="_blank" href="'.$page_url.'modulos/catalogos/pdf/'.$pdf.'" class="btn_red">DESCARGAR</a></div>
									</div>
                                </div>
                           	</div>
		';
	}
	echo '<!--/ mysql -->';
  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay item.</div>
		</div>
  ';
  }
 }
}


function one_portafolio($id,&$datos_porta){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;

$menu_json='portafolio.json';
$path_JSON='modulos/portafolio/'.$menu_json;

if(file_exists($path_JSON) && filesize($path_JSON)!=0){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- portafolio.json -->';
	foreach ($Data as $reg){$i++;
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$replace=array(' ','.',',','(',')');
		$nombre=str_replace($replace,"-",$reg['nombre']);
		$descripcion=$reg['descripcion'];
		$resena=$reg['resena'];
		$cate=$reg['cate'];
		$url_p=$reg['url_page'];
		//$ID_cate=$reg['ID_cate'];
		//$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$imagen2=$reg['imagen2'];
		$imagen3=$reg['imagen3'];
		$imagen4=$reg['imagen4'];
		$imagen5=$reg['imagen5'];
		$visible=$reg['visible'];
		$visible=$reg['visible'];
		if($visible==1 && $ID==$id){
		$datos_porta=array($ID,$cover,$nombre,$descripcion,$resena,$cate,$imagen1,$imagen2,$imagen3,$imagen4,$imagen5,$url_p,$visible);
		//echo '<!--['.$i.'] -'.$reg['ID'].'-->';
		}
	}
 }
	echo '<!-- /portafolio.json -->';
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."portafolio WHERE visible=1 AND ID=".$id." ORDER BY ID ASC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	if($reg=mysqli_fetch_array($sql)){
		$ID=$reg['ID'];
		$cover=$reg['cover'];
		$replace=array(' ','.',',','(',')');
		$nombre=str_replace($replace,"-",$reg['nombre']);
		$descripcion=$reg['descripcion'];
		$resena=$reg['resena'];
		$cate=$reg['cate'];
		$url_p=$reg['url_page'];
		//$ID_cate=$reg['ID_cate'];
		//$ID_sub_cate=$reg['ID_sub_cate'];
		$imagen1=$reg['imagen1'];
		$imagen2=$reg['imagen2'];
		$imagen3=$reg['imagen3'];
		$imagen4=$reg['imagen4'];
		$imagen5=$reg['imagen5'];
		$visible=$reg['visible'];
		$datos_porta=array($ID,$cover,$nombre,$descripcion,$resena,$cate,$imagen1,$imagen2,$imagen3,$imagen4,$imagen5,$url_p,$visible);
		//echo '<!--'.$reg['ID'].'-->';
	}
  }/*
  else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay productos disponibles.</div>
		</div>
  ';
  }*/
	echo '<!--/ mysql -->';
 }
}
?>