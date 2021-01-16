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

function portafolio(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
sql_opciones('link_var',$valor);
$menu_json='portafolio.json';
$path_JSON='modulos/portafolio/'.$menu_json;

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
		$cate=str_replace('_',' ',$reg['cate']);
		$nom=str_replace(' ','-',$reg['nombre']);
		if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
		$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod=portafolio&ext=item&id='.$ID.$tema_p:$page_url.'portafolio/item/'.$ID.'-'.$nom;
		echo '<!--['.$i.'] -'.$reg['ID'].'-->
                              <article class="portfolio portfolio-grid portfolio-col-4 '.$reg['cate'].' post-'.$i.' type-portfolio status-publish has-post-thumbnail hentry portfolio_cat-'.$reg['cate'].'">
                                 <span class="entry-title" style="display: none;">'.$reg['nombre'].'</span><span class="vcard" style="display: none;"><span class="fn"><a href="#" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T10:06:56+00:00</span>
                                 <div class="portfolio-item default"> <a class="text-decoration-none portfolio-link" href="'.$link_zp.'"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="'.$page_url.'modulos/portafolio/fotos/'.$reg['cover'].'" alt="" /> <span class="thumb-info-title"> <span class="thumb-info-inner">'.$reg['nombre'].'</span> <span class="thumb-info-type">'.$cate.'</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fa fa-link"></i></span> </span> </span> </span> </a></div>
                              </article>
			';
		}else{
				echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay item.</div>
				</div>
  				';

		}
	}
	echo '<!-- /blog.json -->';
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
		$cate=str_replace('_',' ',$reg['cate']);
		$nom=str_replace('_',' ',$reg['nombre']);
		if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
		$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod=portafolio&ext=item&id='.$ID.$tema_p:$page_url.'portafolio/item/'.$ID.'-'.$nom;
		echo'<!-- '.$reg['ID'].'-->
                              <article class="portfolio portfolio-grid portfolio-col-4 '.$reg['cate'].' post-'.$i.' type-portfolio status-publish has-post-thumbnail hentry portfolio_cat-'.$reg['cate'].'">
                                 <span class="entry-title" style="display: none;">'.$reg['nombre'].'</span><span class="vcard" style="display: none;"><span class="fn"><a href="#" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T10:06:56+00:00</span>
                                 <div class="portfolio-item default"> <a class="text-decoration-none portfolio-link" href="'.$link_zp.'"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="'.$page_url.'modulos/portafolio/fotos/'.$reg['cover'].'" alt="" /> <span class="thumb-info-title"> <span class="thumb-info-inner">'.$reg['nombre'].'</span> <span class="thumb-info-type">'.$cate.'</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fa fa-link"></i></span> </span> </span> </span> </a></div>
                              </article>
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